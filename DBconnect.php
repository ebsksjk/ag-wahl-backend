<?php
	
	$file = fopen("login.env", r);
	
	$credentials = explode("->", fgets($file));
	//---------------------------------------------------------------------//
		$usrname 	= trim($credentials[1]);
		$credentials = explode("->", fgets($file));
		$passwrd 	= trim($credentials[1]);
		$credentials = explode("->", fgets($file));
		$DSN 		= trim($credentials[1]);
	//---------------------------------------------------------------------//
	
	$DBASE = null;
	
	try {
		$DBASE = new PDO($DSN, $usrname, $passwrd);
		$DBASE->query("SET NAMES 'utf8';");
	} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die("Die Verbindung zur Datenbank konnte nicht hergestellt werden.");
	}

?>
