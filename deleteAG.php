<?php
require  'DBconnect.php';

$befehl = "DELETE FROM AGs WHERE ID =".$_GET['id'];
 
$DBASE->query($befehl);
echo "0";
?>