<?php
$isCLI = ( php_sapi_name() == 'cli' );
if(!$isCLI)
{
    die("Please run me from the console - not from a web-browser!");
}

require_once("../system.php");
$sql = file_get_contents("./install.sql");
$db = createPDO();
try{
	$db->exec($sql);
	echo "success\n";
}catch(PDOException $e){
	echo "SQL ERROR \n";
	die($e->getMessage());
}