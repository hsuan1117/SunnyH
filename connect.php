<?php
require_once("system.php");

if(($uid=checklogin())===false){
	$E["msg"] = "Login first.";
	require("template/login.php");
	exit;
}

if(isset($_GET["connect"])){
	require("func/facebook-php-sdk-v4/src/Facebook/autoload.php");
	$fb = new Facebook\Facebook([
		'app_id' => $config['facebook']['app_id'],
		'app_secret' => $config['facebook']['app_secret'],
		'default_graph_version' => 'v2.5',
		]);
	$helper = $fb->getRedirectLoginHelper();
	try {
		$accessToken = $helper->getAccessToken();
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		$E["msg"] = "Facebook connect failed.";
		require("template/blank.php");
		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		$E["msg"] = "Facebook connect failed.";
		require("template/blank.php");
		exit;
	}
	if (! isset($accessToken)) {
		if ($helper->getError()) {
			$E["msg"] = "Facebook connect failed.";
			require("template/blank.php");
		} else {
			$E["msg"] = "Facebook connect failed.";
			require("template/blank.php");
		}
		exit;
	}
	$response = $fb->get('/me',$accessToken->getValue())->getDecodedBody();
	$db = PDO_prepare("UPDATE `table:account` SET `fbid`=:fbid,`fbname`=:fbname WHERE `id`=:uid");
	$db->bindValue("fbid", $response["id"], PDO::PARAM_STR);
	$db->bindValue("fbname", $response["name"], PDO::PARAM_STR);
	$db->bindValue("uid", $uid, PDO::PARAM_STR);
	$t=$db->execute();
	$E["msg"] = "Facebook connect succeed.";
	require("template/blank.php");
	header('refresh: 3;url=setting.php');
}else if(isset($_GET["disconnect"])){
	$db = PDO_prepare("UPDATE `table:account` SET `fbid`='',`fbname`='' WHERE `id`=:uid");
	$db->bindValue("uid", $uid, PDO::PARAM_STR);
	$db->execute();
	$E["msg"] = "Facebook disconnect succeed.";
	require("template/blank.php");
	header('refresh: 3;url=setting.php');
}else {
	$E["msg"] = "Facebook connect failed.";
	require("template/blank.php");
}