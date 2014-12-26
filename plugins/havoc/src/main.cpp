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

#include <cstdlib>

#include "plugin.h"
#include "native.h"
#include "teleport.h"
#include "main.h"

logprintf_t logprintf;
extern void *pAMXFunctions;

PLUGIN_EXPORT unsigned int PLUGIN_CALL Supports()
{
	return SUPPORTS_VERSION | SUPPORTS_AMX_NATIVES;
}

PLUGIN_EXPORT bool PLUGIN_CALL Load(void **ppData)
{
	pAMXFunctions = ppData[PLUGIN_DATA_AMX_EXPORTS];
	logprintf = (logprintf_t)ppData[PLUGIN_DATA_LOGPRINTF];

	pPlugin.reset(new Plugin());
	pTeleport.reset(new Teleport());
	
	logprintf("[HAVOC] Core (0x%X) successfully loaded.", CORE_VERSION);
	return true;
}

PLUGIN_EXPORT void PLUGIN_CALL Unload()
{
	pPlugin.reset();
	pTeleport.reset();
	logprintf("[HAVOC] Core unloaded.");
}

const AMX_NATIVE_INFO PluginNatives[] =
{
	{"NC_Init", Native::Init},
	{"NC_ServerLog", Native::ServerLog},
	{"NC_AddTeleport", Native::AddTeleport},
	{"NC_ProcessTeleportRequest", Native::ProcessTeleportRequest},
	{"NC_GetTeleportDialogString", Native::GetTeleportDialogString},
	{"NC_OutputTeleportInfo", Native::OutputTeleportInfo},
	{"NC_UnixtimeToDate", Native::UnixtimeToDate},
	{"NC_StringReplace", Native::StringReplace},
	{"NC_Whirlpool", Native::Whirlpool},
	{"NC_CSPRNG", Native::CSPRNG},
	{NULL, NULL}
};

PLUGIN_EXPORT int PLUGIN_CALL AmxLoad(AMX *amx)
{
	pPlugin->AddAmx(amx);
	return amx_Register(amx, PluginNatives, -1);
}

PLUGIN_EXPORT int PLUGIN_CALL AmxUnload(AMX *amx)
{
	pPlugin->EraseAmx(amx);
	return AMX_ERR_NONE;
}