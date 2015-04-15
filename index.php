<?php
require_once("system.php");

$uid = checklogin();
if($uid!==false){
	$E["login"] = true;
	$db = PDO_prepare("SELECT * FROM `table:account` WHERE `id`=:id");
	$db->bindValue("id", $uid, PDO::PARAM_INT);
	$db->execute();
	$data = $db->fetchAll()[0];
	$E["nick"] = $data["nickname"];
	$E["acct"] = $data["account"];
}
else{
	$E["login"] = false;
}

require("template/main.php");