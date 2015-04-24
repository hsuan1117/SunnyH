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
		die("SQL ERROR: " . $e->getMessage());
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
		make_json_result("success",$result);
	}catch(PDOExsception $e){
		die("SQL ERROR: " . $e->getMessage());
	}
}else{
	make_json_result("error","need variable: cookie");
}