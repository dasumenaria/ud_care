<?php
session_start();

	unset($_SESSION['SESSION_ID']);
	unset($_SESSION['SESSION_USERTYPE']);
	unset($_SESSION['SESSION_USERNAME']);
	unset($_SESSION['SESSION_SUBSERVICE']);
	unset($_SESSION['SESSION_REGISTERID']);
		
	header("location:index.php");

?>