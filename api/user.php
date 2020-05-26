<?php
require_once("../system.php");
require_once("api_core.php");
if(isset($_GET["cookie"])){
	$db = PDO_prepare("SELECT * FROM `table:session` WHERE `cookie`=?");
	try{
		$db->bindValue(1, $_GET["cookie"], PDO::PARAM_STR);
		$db->execute();
		if($db->rowCount() !== 1){
			make_json_result("error","notfound");
			die();
		}
		$uid = $db->fetch()["id"];
	}catch(PDOExsception $e){
		make_json_result("error",$e->getMessage());
		die();
	}
	$db = PDO_prepare("SELECT * FROM `table:account` WHERE `id`=?");
	try{
		$db->bindValue(1,$uid,PDO::PARAM_INT);
		$db->execute();
		$data = $db->fetch();
		$result = array();
		$result["id"] = $data["id"];
		$result["account"] = $data["account"];
		$result["email"] = $data["email"];
		$result["nickname"] = $data["nickname"];
		$result["realname"] = $data["realname"];
		make_json_result("success",$result);
	}catch(PDOExsception $e){
		make_json_result("error",$e->getMessage());
		die();
	}
}else{
	make_json_result("error","need variable: cookie");
}
