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

#if defined _havoc_included
	#endinput
#endif
#define _havoc_included

#define CORE_VERSION 0x10

#define MAX_TELE_CATEGORIES 9
#define MAX_TELES_PER_CATEGORY 32
#define MAX_TELE_COMMAND_NAME 16
#define WHIRLPOOL_LENGTH 128

native NC_Init(nc_version = CORE_VERSION);
native NC_Exit();

// Teleport System
native NC_AddTeleport(tp_category, const tp_name[], const tp_cmd[], Float:x, Float:y, Float:z);
native NC_GetTeleportDialogString(tp_category, dest[], len = sizeof(dest));
native NC_ProcessTeleportRequest(tp_category, input, dest[], len = sizeof(dest));
native NC_OutputTeleportInfo();

// General Util
native NC_ServerLog(const file[], const data[]);
native NC_GetStartupTime(tformat = 1);
native NC_UnixtimeToDate(dest[], unixtime, len = sizeof(dest));
native NC_StringReplace(const transform[], const from[], const to[], dest[], len = sizeof(dest));
native NC_FormatColorCodes(string[]);

// Security
native NC_Whirlpool(const data[], dest[], len = sizeof(dest));
native NC_RMD160(const data[], dest[], len = sizeof(dest));
native NC_CSPRNG(string_len, dest[], len = sizeof(dest));