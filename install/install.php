<?php
$isCLI = ( php_sapi_name() == 'cli' );
if(!$isCLI)
{
    die("Please run me from the console - not from a web-browser!");
}

require_once("../system.php");

$dbconf = $config["DB"];
$tablepre = $dbconf["tablepre"];
$charset = $dbconf["charset"];

ob_start();
require("install.sql");
$sql = ob_get_contents();
ob_end_clean();

$db = PDO_prepare($sql);
try{
	$db->execute();
	echo "success\n";
}catch(PDOException $e){
	echo "SQL ERROR \n";
	die($e->getMessage());
}