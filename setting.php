<?php
require_once("system.php");
include_once("func/facebook.php");
use Facebook\FacebookRequest;
$uid=checklogin();
if($uid===false){
	header('Location: login.php?continue=setting.php');
}else {
	if(isset($_POST["password"])){
		$db = PDO_prepare("SELECT * FROM `table:account` WHERE `id`=?");
		try{
			$db->bindValue(1,$uid,PDO::PARAM_INT);
			$db->execute();
			$data = $db->fetch();
			$info = array();
			$info["email"] = $data["email"];
			$info["nickname"] = $data["nickname"];
		}catch(PDOExsception $e){
			die("SQL ERROR: " . $e->getMessage());
		}
		if(checkPassword($uid,$_POST["password"]) && $_POST["password"].$_POST["password2"]!=""){
			if($_POST["password"]!=$_POST["password2"]){
				$E["msg"].="Password isn't match. ";
			}else {
				try{
					$db = PDO_prepare("UPDATE `table:account` SET `password`=:password WHERE `id`=:id");
					$db->bindValue("password", crypt($_POST["password"]));
					$db->bindValue("id", $uid);
					$db->execute();
				}catch(PDOException $e){
					die("SQL ERROR: " . $e->getMessage());
				}
				$E["msg"].="Password changed. ";
			}
		}
		if($_POST["nickname"]==""){
			$E["msg"].="Nickname is empty. ";
		}else if($_POST["nickname"]!=$info["nickname"]){
			try{
				$db = PDO_prepare("UPDATE `table:account` SET `nickname`=:nickname WHERE `id`=:id");
				$db->bindValue("nickname", $_POST["nickname"]);
				$db->bindValue("id", $uid);
				$db->execute();
			}catch(PDOException $e){
				die("SQL ERROR: " . $e->getMessage());
			}
			$E["msg"].="Nickname changed. ";
		}
		if($_POST["email"]==""){
			$E["msg"].="E-mail is empty. ";
		}else if($_POST["email"]!=$info["email"]){
			try{
				$db = PDO_prepare("UPDATE `table:account` SET `email`=:email WHERE `id`=:id");
				$db->bindValue("email", $_POST["email"]);
				$db->bindValue("id", $uid);
				$db->execute();
			}catch(PDOException $e){
				die("SQL ERROR: " . $e->getMessage());
			}
			$E["msg"].="E-mail changed. ";
		}
	}else if(@$_POST["facebook"]=="unconnect"){
		$db = PDO_prepare("UPDATE `table:account` SET `fbid`='',`fbtoken`='' WHERE `id`=?");
		try{
			$db->bindValue(1,$uid,PDO::PARAM_INT);
			$db->execute();
		}catch(PDOException $e){
			die("SQL ERROR: " . $e->getMessage());
		}
		$E["msg"].="Facebook unconnected. ";
	}else if(checkfblogin($session=getsession($config["site"]["url"]."setting.php"))){
		$fbuser=(new FacebookRequest($session, 'GET', '/me?fields=id'))->execute()->getGraphObject()->asArray();
		$db = PDO_prepare("UPDATE `table:account` SET `fbid`=:fbid,`fbtoken`=:fbtoken WHERE `id`=:id");
		try{
			$db->bindValue("id",$uid,PDO::PARAM_INT);
			$db->bindValue("fbid",$fbuser["id"],PDO::PARAM_STR);
			$db->bindValue("fbtoken",$session->getToken(),PDO::PARAM_STR);
			$db->execute();
		}catch(PDOException $e){
			die("SQL ERROR: " . $e->getMessage());
		}
		$E["msg"].="Facebook connected. ";
	}
}
$db = PDO_prepare("SELECT * FROM `table:account` WHERE `id`=?");
try{
	$db->bindValue(1,$uid,PDO::PARAM_INT);
	$db->execute();
	$data = $db->fetch();
	$E["info"]["account"] = $data["account"];
	$E["info"]["email"] = $data["email"];
	$E["info"]["nickname"] = $data["nickname"];
	$E["info"]["fbid"] = $data["fbid"];
}catch(PDOExsception $e){
	die("SQL ERROR: " . $e->getMessage());
}
require("template/setting.php");