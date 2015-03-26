/*======================================================================*\
|| #################################################################### ||
|| # Project Havoc Server						        			  # ||
|| # ---------------------------------------------------------------- # ||
|| # Copyright (c)2011-2015 Havoc Server			  				  # ||
|| # Created by Mellnik                                               # ||
|| # ---------------------------------------------------------------- # ||
|| # https://havocserver.com		                      			  # ||
|| #################################################################### ||
\*======================================================================*/

#include <cstring>
#include <limits>
#include <ctime>
#include <fstream>

#include <cryptopp/hex.h>
#include <cryptopp/filters.h>
#include <cryptopp/integer.h>
#include <cryptopp/osrng.h>
#include <cryptopp/ripemd.h>
#include <cryptopp/whrlpool.h>

#include "native.h"
#include "teleport.h"

void ReplaceAll(std::string &str, const std::string &from, const std::string &to);

/* NC_Init(nc_version) */
cell AMX_NATIVE_CALL Native::Init(AMX *amx, cell *params)
{
	static const uint32_t ParamCount = 1;
	PARAM_CHECK(ParamCount, "NC_Init");
	
	int32_t clientVersion = params[1];
	
	if (clientVersion != CORE_VERSION)
	{
		logprintf("[HAVOC] Version mismatch 0x%X, expect 0x%X.", clientVersion, CORE_VERSION);
		return 0;
	}	
	return 1;
}

/* NC_Exit() */
cell AMX_NATIVE_CALL Native::Exit(AMX *amx, cell *params)
{
	// For /gmx
	pTeleport.reset(new Teleport());
	return 1;
}

/* ServerLog(const file[], const data[]) */
cell AMX_NATIVE_CALL Native::ServerLog(AMX *amx, cell *params)
{
	static const uint32_t ParamCount = 2;
	PARAM_CHECK(ParamCount, "ServerLog");
	
	char *file = NULL, *data = NULL;
	amx_StrParam(amx, params[1], file);
	amx_StrParam(amx, params[2], data);
	
	std::ofstream outfile;
	outfile.open(file, std::ofstream::app);
	outfile << data;
	outfile.close();
	return 1;
}

/* NC_AddTeleport(tp_category, const tp_name[], const tp_cmd[], Float:x, Float:y, Float:z) */
cell AMX_NATIVE_CALL Native::AddTeleport(AMX *amx, cell *params)
{
	static const uint32_t ParamCount = 6;
	PARAM_CHECK(ParamCount, "NC_AddTeleport");
	
	if (params[1] < 0 || params[1] >= MAX_TELE_CATEGORIES)
	{
		logprintf("[HAVOC] Invalid teleport category.");
		return 0;
	}
	
	if (pTeleport->GetCategorySize(params[1]) >= MAX_TELES_PER_CATEGORY)
	{
		logprintf("[HAVOC] Teleport category %i max capacity reached.", params[1]);
		return 0;
	}
	
	char *tp_name = NULL, *tp_cmd = NULL;
	amx_StrParam(amx, params[2], tp_name);
	amx_StrParam(amx, params[3], tp_cmd);
	
	if (tp_name == NULL || tp_cmd == NULL)
	{
		logprintf("[HAVOC] Could not retrieve strings in AddTeleport (NULL).");
		return 0;
	}
	
	if (std::strlen(tp_cmd) > MAX_TELE_COMMAND_NAME)
	{
		logprintf("[HAVOC] tp_cmd %s size overflow (%i), allowed: %i.", tp_cmd, std::strlen(tp_cmd), MAX_TELE_COMMAND_NAME);
		return 0;
	}
	
	Teleport_t *tp = new Teleport_t(params[1], tp_name, tp_cmd, amx_ftoc(params[4]), amx_ftoc(params[5]), amx_ftoc(params[6]));
	
	std::strcat(pTeleport->g_TeleportDialogString[params[1]], tp_name);
	std::strcat(pTeleport->g_TeleportDialogString[params[1]], " (/");
	std::strcat(pTeleport->g_TeleportDialogString[params[1]], tp_cmd);
	std::strcat(pTeleport->g_TeleportDialogString[params[1]], ")\n");
	
	pTeleport->AddTeleport((int32_t)params[1], tp);
	return 1;
}

/* NC_GetTeleportDialogString(tp_category, dest[], len = sizeof(dest)) */
cell AMX_NATIVE_CALL Native::GetTeleportDialogString(AMX *amx, cell *params)
{
	static const uint32_t ParamCount = 3;
	PARAM_CHECK(ParamCount, "NC_GetTeleportDialogString");
	
	if (params[1] < 0 || params[1] >= MAX_TELE_CATEGORIES)
	{
		logprintf("[HAVOC] Invalid teleport category.");
		return 0;
	}
	
	cell *amx_Addr = NULL;
	amx_GetAddr(amx, params[2], &amx_Addr);
	if (amx_Addr == NULL)
	{
		logprintf("[HAVOC] [debug] CRASH DETECTED! amx_Addr = NULL from amx_GetAddr in GetTeleportDialogString");
		return 0;
	}
	
	amx_SetString(amx_Addr, pTeleport->g_TeleportDialogString[params[1]], 0, 0, params[3] > 0 ? params[3] : std::strlen(pTeleport->g_TeleportDialogString[params[1]]) + 1);
	return 1;
}

/* NC_ProcessTeleportRequest(tp_category, input, dest[], len = sizeof(dest)) */
cell AMX_NATIVE_CALL Native::ProcessTeleportRequest(AMX *amx, cell *params)
{
	static const uint32_t ParamCount = 4;
	PARAM_CHECK(ParamCount, "NC_ProcessTeleportRequest");

	if (params[1] < 0 || params[1] > MAX_TELE_CATEGORIES)
	{
		logprintf("[HAVOC] Invalid tp category");
		return 0;
	}
	
	if (params[2] >= MAX_TELES_PER_CATEGORY || params[2] < 0)
	{
		logprintf("[HAVOC] Invalid input exceeds restrictions, %i, %i", params[1], params[2]);
		return 0;
	}
	
	auto ReqTeleport = pTeleport->GetTeleport(params[1], params[2]);
	
	if (ReqTeleport == NULL || ReqTeleport == nullptr)
	{
		logprintf("[HAVOC] [debug] CRASH DETECTED! ReqTeleport == NULL");
		return 0;
	}
	
	cell *amx_Addr = NULL;
	amx_GetAddr(amx, params[3], &amx_Addr);
	if (amx_Addr == NULL)
	{
		logprintf("[HAVOC] [debug] CRASH DETECTED! amx_Addr = NULL from amx_GetAddr in ProcessTeleportRequest");
		return 0;
	}
	
	amx_SetString(amx_Addr, ReqTeleport->CCommand, 0, 0, params[4] > 0 ? params[4] : std::strlen(ReqTeleport->CCommand) + 1);
	return 1;
}

/* NC_OutputTeleportInfo() */
cell AMX_NATIVE_CALL Native::OutputTeleportInfo(AMX *amx, cell *params)
{
	for (int32_t i = 0; i < MAX_TELE_CATEGORIES; ++i)
	{
		logprintf("[HAVOC] TP Category %i: %i TPs", i, pTeleport->GetCategorySize(i));
	}
	return 1;
}

/* NC_UnixtimeToDate(dest[], unixtime, len = sizeof(dest)) */
cell AMX_NATIVE_CALL Native::UnixtimeToDate(AMX *amx, cell *params)
{
	static const uint32_t ParamCount = 3;
	PARAM_CHECK(ParamCount, "NC_UnixtimeToDate");
	
	if (params[2] < 0 || params[2] > std::numeric_limits<int>::max())
	{
		logprintf("[HAVOC] Invalid unixtime provided in UnixtimeToDate");
		return 0;
	}
	
	std::time_t unixt = params[2];
	struct tm *ntime = localtime(&unixt);
	
	char date[50];
	std::strftime(date, sizeof(date), "%d/%m/%Y %H:%M:%S", ntime);
	
	cell *amx_Addr = NULL;
	amx_GetAddr(amx, params[1], &amx_Addr);
	if (amx_Addr == NULL)
	{
		logprintf("[HAVOC] [debug] CRASH DETECTED! amx_Addr = NULL from amx_GetAddr in UnixtimeToDate");
		return 0;
	}
	
	amx_SetString(amx_Addr, date, 0, 0, params[3] > 0 ? params[3] : std::strlen(date));
	return 1;
}

/* NC_StringReplace(const transform[], const from[], const to[], dest[], len = sizeof(dest)) */
cell AMX_NATIVE_CALL Native::StringReplace(AMX *amx, cell *params)
{
	static const uint32_t ParamCount = 5;
	PARAM_CHECK(ParamCount, "NC_StringReplace");
	
	char *_arg1 = NULL, *_arg2 = NULL, *_arg3 = NULL;
	amx_StrParam(amx, params[1], _arg1);
	amx_StrParam(amx, params[2], _arg2);
	amx_StrParam(amx, params[3], _arg3);
	
	if (_arg1 == NULL || _arg2 == NULL || _arg3 == NULL)
	{
		logprintf("[HAVOC] Could not retrieve strings in StringReplace (NULL).");
		return 0;
	}
	
	std::string transform(_arg1);
	std::string from(_arg2);
	std::string to(_arg3);
	
	size_t begin = transform.find(from);
	if (begin == std::string::npos)
		return -1;
	
	transform.erase(begin, from.length());
	transform.insert(begin, to);
	
	cell *amx_Addr = NULL;
	amx_GetAddr(amx, params[4], &amx_Addr);
	if (amx_Addr == NULL)
	{
		logprintf("[HAVOC] [debug] CRASH DETECTED! amx_Addr = NULL from amx_GetAddr in StringReplace");
		return -1;
	}
	
	amx_SetString(amx_Addr, transform.c_str(), 0, 0, params[5] > 0 ? params[5] : transform.length() + 1);
	return static_cast<cell>(begin);
}

/* NC_Whirlpool(const data[], dest[], len = sizeof(dest)) */
cell AMX_NATIVE_CALL Native::Whirlpool(AMX *amx, cell *params)
{
	static const uint32_t ParamCount = 3;
	PARAM_CHECK(ParamCount, "NC_Whirlpool");

	char *_getstr = NULL;
	amx_StrParam(amx, params[1], _getstr);
	
	if (_getstr == NULL)
		return 0;
	
	std::string data(_getstr);
	std::string hash;
	CryptoPP::Whirlpool h_Whirlpool;
	CryptoPP::StringSource(data, true, new CryptoPP::HashFilter(h_Whirlpool, new CryptoPP::HexEncoder(new CryptoPP::StringSink(hash))));
	
	cell *amx_Addr = NULL;
	amx_GetAddr(amx, params[2], &amx_Addr);
	if (amx_Addr == NULL)
	{
		logprintf("[HAVOC] [debug] CRASH DETECTED! amx_Addr = NULL from amx_GetAddr in Whirlpool");
		return 0;
	}
	
	amx_SetString(amx_Addr, hash.c_str(), 0, 0, params[3] > 0 ? params[3] : hash.length() + 1);
	return 1;
}

/* NC_RMD160(const data[], dest[], len = sizeof(dest)) */
cell AMX_NATIVE_CALL Native::RMD160(AMX *amx, cell *params)
{
	static const uint32_t ParamCount = 3;
	PARAM_CHECK(ParamCount, "NC_RMD160");

	char *_getstr = NULL;
	amx_StrParam(amx, params[1], _getstr);
	
	if (_getstr == NULL)
		return 0;
	
	std::string data(_getstr);
	std::string hash;
	CryptoPP::RIPEMD160 h_RMD;
	CryptoPP::StringSource(data, true, new CryptoPP::HashFilter(h_RMD, new CryptoPP::HexEncoder(new CryptoPP::StringSink(hash))));
	
	cell *amx_Addr = NULL;
	amx_GetAddr(amx, params[2], &amx_Addr);
	if (amx_Addr == NULL)
	{
		logprintf("[HAVOC] [debug] CRASH DETECTED! amx_Addr = NULL from amx_GetAddr in RMD160");
		return 0;
	}
	
	amx_SetString(amx_Addr, hash.c_str(), 0, 0, params[3] > 0 ? params[3] : hash.length() + 1);
	return 1;
}

/* NC_CSPRNG(string_len, dest[], len = sizeof(dest)) */
cell AMX_NATIVE_CALL Native::CSPRNG(AMX *amx, cell *params)
{
	static const uint32_t ParamCount = 3;
	PARAM_CHECK(ParamCount, "NC_CSPRNG");
	
	if (params[1] < 1)
	{
		logprintf("[HAVOC] Invalid string_len in NC_CSPRNG");
		return 0;
	}
	
	std::string random_output;
	CryptoPP::AutoSeededRandomPool RNG;
	CryptoPP::Integer rand_num(RNG, 32);
	
	for (uint32_t i = 0; i < static_cast<uint32_t>(params[1]); ++i)
	{
		uint32_t num;
		
		if (!rand_num.IsConvertableToLong())
			num = std::numeric_limits<unsigned>::max() + static_cast<unsigned>(rand_num.AbsoluteValue().ConvertToLong());
		else
			num = static_cast<uint32_t>(rand_num.AbsoluteValue().ConvertToLong());
			
        num = num % 122;
        if (48 > num)
			num += 48;
		
        if (57 < num && 65 > num)
            num += 7;
		
        if (90 < num && 97 > num)
            num += 6;
		
        random_output += static_cast<char>(num);
        rand_num.Randomize(RNG, 32);
	}
	
	cell *amx_Addr = NULL;
	amx_GetAddr(amx, params[2], &amx_Addr);
	if (amx_Addr == NULL)
	{
		logprintf("[HAVOC] [debug] CRASH DETECTED! amx_Addr = NULL from amx_GetAddr in CSPRNG");
		return 0;
	}
	
	amx_SetString(amx_Addr, random_output.c_str(), 0, 0, params[3] > 0 ? params[3] : random_output.length() + 1);
	return 1;
}

/* NC_FormatColorCodes(string[]) */
cell AMX_NATIVE_CALL Native::FormatColorCodes(AMX *amx, cell *params)
{
	static const uint32_t ParamCount = 1;
	PARAM_CHECK(ParamCount, "NC_FormatColorCodes");
	
	char *message = NULL;
	amx_StrParam(amx, params[1], message);
	
	if (message == NULL)
	{
		logprintf("[HAVOC] Could not retrieve strings in FormatColorCodes (NULL).");
		return 0;
	}
	
	std::string transform(message);
	ReplaceAll(transform, "<red>", "{FF0000}");
	ReplaceAll(transform, "<green>", "{2DFF00}");
	ReplaceAll(transform, "<blue>", "{0087FF}");
	ReplaceAll(transform, "<yellow>", "{DBED15}");
	ReplaceAll(transform, "<white>", "{F0F0F0}");
	transform.erase(0, 3); // Remove '$$$' from the beginning.
	
	cell *amx_Addr = NULL;
	amx_GetAddr(amx, params[1], &amx_Addr);
	if (amx_Addr == NULL)
	{
		logprintf("[HAVOC] [debug] CRASH DETECTED! amx_Addr = NULL from amx_GetAddr in FormatColorCodes");
		return -1;
	}
	
	amx_SetString(amx_Addr, transform.c_str(), 0, 0, 144);
	return 1;
}
/* Speedvergleich mit http://www.emoticode.net/c-plus-plus/replace-all-substring-occurrences-in-std-string.html */
void ReplaceAll(std::string &str, const std::string &from, const std::string &to)
{
    size_t start_pos = 0;
    while ((start_pos = str.find(from, start_pos)) != std::string::npos)
	{
        str.replace(start_pos, from.length(), to);
        start_pos += to.length(); // In case 'to' contains 'from', like replacing 'x' with 'yx'
    }
}