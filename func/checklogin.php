<?php
//return login userid
function checklogin($cookie=null){
	if(is_null($cookie))
		$cookie = $_COOKIE["login"];
	if(!isset($cookie))
		return false;
	//clear expired db data
	try{
		$db = PDO_prepare("DELETE FROM `table:session` WHERE `expire`<CURDATE()");
		$db->execute();
		//check cookie
		$db = PDO_prepare("SELECT `id` FROM `table:session` WHERE `cookie`=:cookie");
		$db->bindValue("cookie", $cookie, PDO::PARAM_STR);
		$db->execute();
		if($db->rowCount()>0){
			$uid = $db->fetchAll()[0]["id"];
			return $uid;
		}else{
			//delete cookie
			setcookie("login",null,-1,$config["session"]["cookie_path"],$config["session"]["domain"],false,true);
			return false;
		}
	}catch(PDOException $e){
		die("SQL ERROR: " . $e->getMessage());
	}
}