<?php
require("constants.php");

//Create a database connection
$connection = mysql_connect(DB_SERVER,DB_USER,DB_PASS);
if (!$connection) {
	die("Database connection failed: " . mysql_error());
}

//Select a database to use 
$dbSelect = mysql_select_db(DB_NAME,$connection);
if (!$dbSelect) {
	die("Database selection failed: " . mysql_error());
}

//solved retreiving arabic data via SELECT
mysql_query("SET NAMES 'utf8'"); 

