<?php

#set database host name
define ("DB_HOST", "localhost");

#set MYSQL database username
define ("DB_USER", "root");

#set MYSQL database password
define ("DB_PASS", "");

#set the name of the database
define ("DB_NAME", "cheapomail");


//Establishing a connection to the server
$access = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Connection could not be established.");

//Selecting the database to read from.
$dbsel = mysql_select_db(DB_NAME, $access) or die("An error occur while accessing the CheapoMail");


?>