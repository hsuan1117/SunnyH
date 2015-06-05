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
}else {
	$E["login"] = false;
}