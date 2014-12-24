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

#include "teleport.h"

std::unique_ptr<Teleport> pTeleport;

void Teleport::AddTeleport(int32_t category, Teleport_t *tp)
{
	m_Teleports[category].push_back(tp);
}

int32_t Teleport::GetCategorySize(int32_t category)
{
	return m_Teleports[category].size();
}

Teleport_t *Teleport::GetTeleport(int32_t category, int32_t port)
{
	return m_Teleports[category][port];
}