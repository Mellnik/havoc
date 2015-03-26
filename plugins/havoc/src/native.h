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

#pragma once

#ifndef _NATIVE_H_
#define _NATIVE_H_

#include "main.h"

namespace Native
{
	cell AMX_NATIVE_CALL Init(AMX *amx, cell *params);
	cell AMX_NATIVE_CALL Exit(AMX *amx, cell *params);
	cell AMX_NATIVE_CALL ServerLog(AMX *amx, cell *params);
	cell AMX_NATIVE_CALL AddTeleport(AMX *amx, cell *params);
	cell AMX_NATIVE_CALL GetTeleportDialogString(AMX *amx, cell *params);
	cell AMX_NATIVE_CALL ProcessTeleportRequest(AMX *amx, cell *params);
	cell AMX_NATIVE_CALL OutputTeleportInfo(AMX *amx, cell *params);
	cell AMX_NATIVE_CALL UnixtimeToDate(AMX *amx, cell *params);
	cell AMX_NATIVE_CALL StringReplace(AMX *amx, cell *params);
	cell AMX_NATIVE_CALL Whirlpool(AMX *amx, cell *params);
	cell AMX_NATIVE_CALL RMD160(AMX *amx, cell *params);
	cell AMX_NATIVE_CALL CSPRNG(AMX *amx, cell *params);
	cell AMX_NATIVE_CALL FormatColorCodes(AMX *amx, cell *params);
}

#endif /* _NATIVE_H_ */