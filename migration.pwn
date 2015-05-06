#include <a_samp>
#include <a_mysql_R39-3>

new pSQL_nef;
new pSQL_havoc;
new bigs[4096];

public OnGameModeInit()
{
	pSQL_nef = mysql_connect();
	pSQL_havoc = mysql_connect();
	
	mysql_tquery(pSQL_nef, "SELECT * FROM `accounts` ORDER BY `id` ASC;", "OnNefRowsRecv");
	return 1;
}

public OnGameModeExit()
{
	mysql_close(pSQL_nef);
	mysql_close(pSQL_havoc);
	return 1;
}

public OnNefRowsRecv()
{
	new rows = cache_get_row_count(pSQL_nef);
	
	for (new i = 0; i < rows; ++i)
	{
		// Get data
		
		// do checks
		
		// upload to new db
		mysql_format(pSQL_havoc, bigs, sizeof(bigs), "INSERT INTO `accounts` VALUES ();");
		mysql_tquery(pSQL_havoc, bigs);
	}
	printf("OnNefRowsRecv loop finished, unprocessed(pSQL_nef): %i, unprocessed(pSQL_havoc): %i", mysql_unprocessed_queries(pSQL_nef), mysql_unprocessed_queries(pSQL_havoc));
	return 1;
}