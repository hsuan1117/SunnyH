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

$uid = checklogin();
if($uid!==false){
	$E["login"] = true;
	$db = PDO_prepare("SELECT * FROM `table:account` WHERE `id`=:id");
	$db->bindValue("id", $uid, PDO::PARAM_INT);
	$db->execute();
	$data = $db->fetchAll()[0];
	$E["nick"] = $data["nickname"];
	$E["acct"] = $data["account"];
	$E["locale"] = $data["locale"];
}else {
	$E["login"] = false;
}

if (isset($_GET["locale"])) {
	$E["locale"] = $_GET["locale"];
}

if (!in_array($E["locale"], $config["locale"])) {
	$E["locale"] = "en_US";
}

putenv("LANG=".$E["locale"]);
setlocale(LC_ALL, $E["locale"]);
bind_textdomain_codeset("login", "UTF-8");
bindtextdomain("login", "locale");
textdomain("login");
