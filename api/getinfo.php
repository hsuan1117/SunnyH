<?php
require_once("../system.php");
require_once("api_core.php");
if(isset($_GET["account"])){
	$db = PDO_prepare("SELECT * FROM `table:account` WHERE `account`=?");
	try{
		$db->bindValue(1,$_GET["account"]);
		$db->execute();
		$data = $db->fetch();
		if($db->rowCount() !== 1){
			make_json_result("error","notfound");
			die();
		}
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
}else if(isset($_GET["uid"])){
	$db = PDO_prepare("SELECT * FROM `table:account` WHERE `id`=?");
	try{
		$db->bindValue(1,$_GET["uid"]);
		$db->execute();
		$data = $db->fetch();
		if($db->rowCount() !== 1){
			make_json_result("error","notfound");
			die();
		}
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
	make_json_result("error","missing parameters");
}
