<?php
date_default_timezone_set('asia/kolkata');
ini_set('max_execution_time', 100000);
$dbHost = 'localhost';
$dbUser = 'SB_2DaEhspt3hbYF';
$dbPass = 'X}?Tr%AJR0+h';
$dbName ='comfortold';
$con = mysql_connect($dbHost, $dbUser, $dbPass) or die('Error Connecting to MySQL DataBase' .mysql_error());
mysql_select_db($dbName,$con);
?>