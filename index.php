<?php
require_once("system.php");
if(isset($_POST["account"]) && isset($_POST["password"])){
	$user = checkPassword($_POST["account"],$_POST["password"]);
	if($user !== -1 && $user !== -2){
		echo "login succeed";
		
		//set cookie
		$hash = randomHash(32);
		if($config["session"]["keep_login"]===false)
			$expire = 0;
		else
			$expire = mktime().time()+60*60*24*$config["session"]["expire"];
		setcookie("login",$hash,$expire,$config["session"]["cookie_path"],$config["session"]["domain"],false,true);
		
		//set DB
		$db = PDO_prepare("INSERT INTO `table:session` (`id`, `expire`, `cookie`) VALUES (:id, DATE_ADD(CURDATE(),INTERVAL 30 DAY), :cookie)");
		try{
			$db->bindValue("id", $user["id"], PDO::PARAM_INT);
			$db->bindValue("cookie", $hash, PDO::PARAM_STR);
			$db->execute();
		}catch(PDOException $e){
			die("SQL ERROR: " . $e->getMessage());
		}
		
		header('refresh: 0;url=');
	}else{
		$E["msg"] = "login failed";
		require("template/main.php");
	}
}else if(isset($_COOKIE["login"])){
	//clear expired db data
	$db = PDO_prepare("DELETE FROM `table:session` WHERE `expire`<CURDATE()");
	$db->execute();
	//check cookie
	$db = PDO_prepare("SELECT `id` FROM `table:session` WHERE `cookie`=:cookie");
	$db->bindValue("cookie", $_COOKIE["login"], PDO::PARAM_STR);
	$db->execute();
	if($db->rowCount()>0){
		$uid = $db->fetchAll()[0]["id"];
		echo $uid;
	}else{
		setcookie("login",null,-1,$config["session"]["cookie_path"],$config["session"]["domain"],false,true); //delete cookie
		header('refresh: 0;url=');
	}
}else{
	require("template/main.php");
}

function checkPassword($account,$password) //return value: success: user, no such acct: -1, wrong pass: -2
{
	$db = PDO_prepare("SELECT * FROM `table:account` WHERE `account`=?");
	try{
		$db->bindValue(1, $account, PDO::PARAM_STR);
		$db->execute();
		if($db->rowCount()<1)
			return -1;
		$data = $db->fetchAll()[0];
		$real_pass = $data["password"];
		if(crypt($password,$real_pass) !== $real_pass)
			return -2;
		return $data;
	}catch(PDOException $e){
		die("SQL ERROR: " . $e->getMessage());
	}
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