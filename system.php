<?php
session_start();
define("IN_SYSTEM",true);
date_default_timezone_set("Asia/Taipei");
require_once("config/default_config.php");
require_once("func/sql.php");
require_once("func/functions.php");

# template variables
$E = array();
$E["msg"] = "";
$E["locale"] = "en_US";

if (isset($_COOKIE["locale"]) && in_array($_COOKIE["locale"], $config["locale"])) {
	$E["locale"] = $_COOKIE["locale"];
}

$uid = checklogin();
if($uid!==false){
	$E["login"] = true;
	$db = PDO_prepare("SELECT * FROM `table:account` WHERE `id`=:id");
	$db->bindValue("id", $uid, PDO::PARAM_INT);
	$db->execute();
	$data = $db->fetchAll()[0];
	$E["nick"] = $data["nickname"];
	$E["acct"] = $data["account"];
	if (in_array($data["locale"], $config["locale"])) {
		$E["locale"] = $data["locale"];
	}
}else {
	$E["login"] = false;
}

if (isset($_GET["locale"]) && in_array($_GET["locale"], $config["locale"])) {
	$E["locale"] = $_GET["locale"];
	if ($E["login"] && $E["locale"] != $data["locale"]) {
		$db = PDO_prepare("UPDATE `table:account` SET `locale`='".$E["locale"]."' WHERE `id`=:id");
		$db->bindValue("id", $uid, PDO::PARAM_INT);
		$db->execute();
	}
}

putenv("LANG=".$E["locale"]);
setlocale(LC_ALL, $E["locale"].".utf8");
bind_textdomain_codeset("login", "UTF-8");
bindtextdomain("login", "locale");
textdomain("login");
setcookie("locale", $E["locale"], time()+60*60*24*30, parse_url($config["site"]["url"], PHP_URL_PATH), parse_url($config["site"]["url"], PHP_URL_HOST));
