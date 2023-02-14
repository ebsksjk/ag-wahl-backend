<?php
	header('Content-type: text/plain; charset=utf-8');
	
	include 'DBconnect.php';
	
	$args = array();
	$returns = array();
	$i = 0;
	
	foreach ($_POST as $key => $value) {
		
		if($value == "0xDEADBEEF") {
			
			$n_aktiv = ($args[7] == 'true') ? 1 : 0;
			
			$DBASE->query("UPDATE AGs SET Name = '".$args[1]."', AbJg=".$args[2].", BisJg=".$args[3].", MaxTeilnZahl=".$args[4].",VorgGeschlecht=".$args[5].", Lehrer='".$args[6]."', Aktiv=".$n_aktiv." WHERE ID=".$args[0].";");
			
			$returns[] = ($args);
			$args = array();
		} else {
			$args[] =($value);
		}
		
		$i = $i + 1;
	}
	
	echo json_encode(array($i));
?>