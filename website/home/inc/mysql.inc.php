<?php
define("SQL_HOST", "::1");
define("SQL_USER", "havocserver");
define("SQL_PASS", "");
define("SQL_DATA", "havocserver");

$mysqli = new mysqli(SQL_HOST, SQL_USER, SQL_PASS, SQL_DATA);

if($mysqli->connect_errno)
{
	printf("Connection failed: %s\n", $mysqli->connect_error);
	exit(1);
}
?>