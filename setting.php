<?php
require_once("system.php");

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
	$E["info"]["fbname"] = $data["fbname"];
	require("func/facebook-php-sdk-v4/src/Facebook/autoload.php");
	$fb = new Facebook\Facebook([
		'app_id' => $config['facebook']['app_id'],
		'app_secret' => $config['facebook']['app_secret'],
		'default_graph_version' => 'v2.5',
		]);
	$helper = $fb->getRedirectLoginHelper();
	$E["info"]["fbloginurl"] = $helper->getLoginUrl($config["site"]["url"]."connect.php?connect");

}catch(PDOExsception $e){
	die("SQL ERROR: " . $e->getMessage());
}
require("template/setting.php");
