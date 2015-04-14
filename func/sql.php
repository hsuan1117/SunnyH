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

function checkPassword($account,$password) //return true: succeed, 0: wrong pass, -1: no such acct
{
	$db = PDO_prepare("SELECT * FROM `table:account` WHERE `account`=?");
	try{
		$db->bindValue(1, $account, PDO::PARAM_STR);
		$db->execute();
		if($db->rowCount()<1)
			return false;
		$real_pass = $db->fetchAll()[0]["password"];
		return crypt($password,$real_pass) === $real_pass;
	}catch(PDOException $e){
		die("SQL ERROR: " . $e->getMessage());
	}
}