<?php
if(!defined("IN_SYSTEM"))
	die("Access Denied");

function PDO_prepare($statement)
{
	global $config;
	$dbconf = $config["DB"];
	try{
		$db = new PDO("mysql:host=$dbconf[host]; dbname=$dbconf[dbname]; charset=$dbconf[charset]", $dbconf["user"], $dbconf["pwd"]);
	}catch(PDOException $e){
		exit("Error establishing DB connection: <br>" . $e->getMessage());
	}
	
	$statement = str_replace("table:",$dbconf["tablepre"],$statement);
	try{
		return $db->prepare($statement);
	}catch(PDOException $e){
		die("SQL ERROR: " . $e->getMessage());
	}
}