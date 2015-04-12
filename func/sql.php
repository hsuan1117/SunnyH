<?php
if(!defined("IN_SYSTEM"))
	die("Access Denied");

require_once("../config/config.php");
function createPDO()
{
	global $config;
	$dbconf = $config["DB"];
	try{
		return new PDO("mysql:host=$dbconf[host]; dbname=$dbconf[dbname]; charset=$dbconf[charset]", $dbconf["user"], $dbconf["pwd"]);
	}catch(PDOException $e){
		exit("Error establishing DB connection: <br>" . $e->getMessage());
	}
}