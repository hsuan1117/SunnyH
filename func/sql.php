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

function checkPassword($account,$password)
{
	$password = passwordHash($password);
	$db = createPDO();
	try{
		$dbc = $db->prepare("SELECT * FROM `account` WHERE `account`=? and `password`=?");
		$dbc->bindValue(1, $account, PDO::PARAM_STR);
		$dbc->bindValue(2, $password, PDO::PARAM_STR);
		$dbc->execute();
		return $dbc->rowCount() === 1;
	}catch(PDOException $e){
		die($e->getMessage() . "SQL ERROR");
	}
}

function passwordHash($password)
{
	$password = $password."blabla Login";
	return crypt($password,substr($password, 0, 5));
}