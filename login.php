<?php
require_once("system.php");
include_once("func/facebook.php");
use Facebook\FacebookRequest;
if(isset($_POST["account"]) && isset($_POST["password"])){
	$user = checkPassword($_POST["account"],$_POST["password"]);
	if($user !== -1 && $user !== -2){
		createCookie($user);
		header('refresh: 3;url=');
	}else{
		$E["msg"] = "Login failed";
		require("template/login.php");
	}
}else if(checkfblogin($session=getsession($config["site"]["url"]."login.php"))){
	$fbuser=(new FacebookRequest($session, 'GET', '/me?fields=id'))->execute()->getGraphObject()->asArray();
	$db = PDO_prepare("SELECT `id` FROM `table:account` WHERE `fbid`=?");
	$db->bindValue(1, $fbuser["id"], PDO::PARAM_STR);
	$db->execute();
	if($db->rowCount()>0){
		$user = $db->fetchAll()[0];
		createCookie($user);
		header('refresh: 3;url=index.php');
	}else{
		$E["msg"] = "This facebook account hasn't connect to any account.";
		require("template/login.php");
	}
}else if(($uid=checklogin())!==false){
	if(isset($_GET["continue"])){
		if(checkURL($_GET["continue"])){
			header("Location: ".$_GET["continue"]."?cookie=".$_COOKIE["login"]);
		}else {
			$E["msg"]="Blocked link. ";
			require("template/blank.php");
		}
	}else {
		header("Location:index.php");
	}
}else {
	require("template/login.php");
}

function randomHash($len)
{
	$pattern = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	$ptn_len = strlen($pattern);
	$hash = "";
	for($i=0;$i<$len;$i++)
		$hash .= $pattern[mt_rand(0,$ptn_len-1)];
	return $hash;
}

function createCookie($user){
	global $config;
	$E["msg"] = "Login succeed.";
	require("template/blank.php");
	$hash = randomHash(32);
	if($config["session"]["keep_login"]===false)
		$expire = 0;
	else
		$expire = time()+60*60*24*$config["session"]["expire"];
	setcookie("login",$hash,$expire,$config["session"]["cookie_path"],$config["session"]["cookie_domain"],false,true);
	$db = PDO_prepare("INSERT INTO `table:session` (`id`, `expire`, `cookie`) VALUES (:id, DATE_ADD(CURDATE(),INTERVAL :expire DAY), :cookie)");
	try{
		$db->bindValue("id", $user["id"], PDO::PARAM_INT);
		$db->bindValue("expire", $config["session"]["expire"]);
		$db->bindValue("cookie", $hash, PDO::PARAM_STR);
		$db->execute();
	}catch(PDOException $e){
		die("SQL ERROR: " . $e->getMessage());
	}
}