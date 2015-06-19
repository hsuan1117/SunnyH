<?php
define('FACEBOOK_SDK_V4_SRC_DIR', $config["facebook"]["SDK_V4_SRC_DIR"]);
require_once($config["facebook"]["SDK_autoload_path"]);
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\FacebookRequestException;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\GraphUser;
FacebookSession::setDefaultApplication($config["facebook"]["appid"], $config["facebook"]["appsecret"]);
function getRedirectLoginHelper($url){
	return (new FacebookRedirectLoginHelper($url));
}
function getsession($url){
	$helper = getRedirectLoginHelper($url);
	$session = $helper->getSessionFromRedirect();
	return $session;
}
function checkfblogin($session){
	return ($session&&$session->getSessionInfo()->isValid()===true);
}
function getloginurl($url){
	$helper = getRedirectLoginHelper($url);
	return $helper->getLoginUrl();
}
?>