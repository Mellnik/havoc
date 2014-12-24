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

#ifndef _PLUGIN_H_
#define _PLUGIN_H_

#include <memory>
#include <list>

#include "main.h"

class Plugin
{
public:
	Plugin() { }
	~Plugin() { }

	void EraseAmx(AMX *amx);
	void AddAmx(AMX *amx);
	std::list<AMX *> &GetAmxList();

private:
	std::list<AMX *> amx_List;
};

extern std::unique_ptr<Plugin> pPlugin;

#endif /* _PLUGIN_H_ */
