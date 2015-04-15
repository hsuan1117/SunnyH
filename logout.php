<?php
require_once("system.php");

if(isset($_COOKIE["login"])){
	$cookie = $_COOKIE["login"];

	$db = PDO_prepare("DELETE FROM `table:session` WHERE `cookie`=?");
	$db->bindValue(1, $cookie, PDO::PARAM_STR);
	try{
		$db->execute();
	}catch(PDOException $e){
		die("SQL ERROR: " . $e->getMessage());
	}

	setcookie("login",null,-1,$config["session"]["cookie_path"],$config["session"]["domain"],false,true);
}

if(isset($_GET["continue"]))
	header("refresh: 0;url=".$_GET["continue"]);
else
	header("refresh: 0;url=index.php");
