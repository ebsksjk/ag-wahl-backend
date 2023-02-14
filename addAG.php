<?php
	
	require 'DBconnect.php';
	
	$agName 	= $_GET['name'];
	$lehrer 	= $_GET['lehrer'];
	$abJg		= $_GET['abJg'];
	$bisJg		= $_GET['bisJg'];
	$aktiv		= $_GET['aktiv'];
	$gender		= $_GET['gender'];
	$maxTlnZahl = $_GET['maxTeilZahl'];
	
	$aktiv = ($aktiv == "true" ? 1 : 0);
	
	$smt = "INSERT INTO AGs (Name, AbJg, BisJg, MaxTeilnZahl, VorgGeschlecht, Lehrer, Aktiv) VALUES ('".$agName."',".$abJg.",".$bisJg.",".$maxTlnZahl.",'".$gender."','".$lehrer."',".$aktiv.");";
	
	//echo $smt;
	
	try {
		$DBASE->query($smt);
		echo "0";
	} catch (PDOException $e) {
		echo "1";
	}
?>