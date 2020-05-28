<?php
/* SunnyH 1.0
 * 
 * License: GPLv3 License
 */
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
