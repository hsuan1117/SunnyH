<?php
require_once("system.php");

$E['facebook']['app_id']=$config['facebook']['app_id'];

if(isset($_POST["account"]) && isset($_POST["password"])){
	$user = checkPassword($_POST["account"],$_POST["password"]);
	if($user !== -1 && $user !== -2){
		createCookie($user);
		header("Refresh: 3");
	}else{
		$E["msg"] = _("login_fail");
		require("template/login.php");
	}
}else if(isset($_GET["fblogin"])){
	require("func/facebook-php-sdk-v4/src/Facebook/autoload.php");
	$fb = new Facebook\Facebook([
		'app_id' => $config['facebook']['app_id'],
		'app_secret' => $config['facebook']['app_secret'],
		'default_graph_version' => 'v2.5',
		]);
	$helper = $fb->getJavaScriptHelper();
	try {
		$accessToken = $helper->getAccessToken();
		if (! isset($accessToken)) {
			$E["msg"] = _("fb_login_fail");
			require("template/login.php");
		} else {
			$response = $fb->get('/me',$accessToken->getValue())->getDecodedBody();
			$db = PDO_prepare("SELECT `id` FROM `table:account` WHERE `fbid`=:fbid");
			$db->bindValue("fbid", $response["id"], PDO::PARAM_STR);
			$db->execute();
			if($db->rowCount()>0){
				$user = $db->fetchAll()[0];
				createCookie($user);
				header('refresh: 3;url=login.php?continue='.urlencode($_GET["continue"]));
			} else {
				$E["msg"] = _("fb_unconnect");
				require("template/login.php");
			}
		}
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		$E["msg"] = _("fb_login_fail");
		require("template/login.php");
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		$E["msg"] = _("fb_login_fail");
		require("template/login.php");
	}
}else if(($uid=checklogin())!==false){
	if(isset($_GET["continue"])){
		if(checkURL($_GET["continue"])){
			header("Location: ".$_GET["continue"]."?cookie=".$_COOKIE["login"]);
		}else {
			$E["msg"]=_("block_link");
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
	global $config, $E;
	$E["msg"] = _("login_ok");
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
