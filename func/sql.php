<?php
if(!defined("IN_SYSTEM"))
	die("Access Denied");

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

function checkPassword($account,$password) //return true: succeed, 0: wrong pass, -1: no such acct
{
	$db = createPDO();
	try{
		$dbc = $db->prepare("SELECT * FROM `account` WHERE `account`=?");
		$dbc->bindValue(1, $account, PDO::PARAM_STR);
		$dbc->execute();
		if($dbc->rowCount()<1)
			return false;
		$real_pass = $dbc->fetchAll()[0]["password"];
		return crypt($password,$real_pass) === $real_pass;
	}catch(PDOException $e){
		die("SQL ERROR: " . $e->getMessage());
	}
}