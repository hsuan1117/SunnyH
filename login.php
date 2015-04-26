<?php
require_once("system.php");
if(isset($_POST["account"]) && isset($_POST["password"])){
	$user = checkPassword($_POST["account"],$_POST["password"]);
	if($user !== -1 && $user !== -2){
		require("template/header.php");
		?>
		<center>Login succeed.</center>
		<?php
		require("template/footer.php");

		//set cookie
		$hash = randomHash(32);
		if($config["session"]["keep_login"]===false)
			$expire = 0;
		else
			$expire = time()+60*60*24*$config["session"]["expire"];
		setcookie("login",$hash,$expire,$config["session"]["cookie_path"],$config["session"]["domain"],false,true);
		
		//set DB
		$db = PDO_prepare("INSERT INTO `table:session` (`id`, `expire`, `cookie`) VALUES (:id, DATE_ADD(CURDATE(),INTERVAL :expire DAY), :cookie)");
		try{
			$db->bindValue("id", $user["id"], PDO::PARAM_INT);
			$db->bindValue("expire", $config["session"]["expire"]);
			$db->bindValue("cookie", $hash, PDO::PARAM_STR);
			$db->execute();
		}catch(PDOException $e){
			die("SQL ERROR: " . $e->getMessage());
		}
		
		header('refresh: 3;url=');
	}else{
		$E["msg"] = "login failed";
		require("template/login.php");
	}
}else if(($uid=checklogin())!==false){
	if(isset($_GET["continue"])	&& checkURL($_GET["continue"])){
		header("Location:".$_GET["continue"]."?cookie=".$_COOKIE["login"]);
	}else{
		header("Location:index.php");
	}
}else{
	require("template/login.php");
}

function randomHash($len)
{
	$pattern = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	$ptn_len = strlen($pattern);
	$hash = "";
	for($i=0;$i<$len;$i++)
		$hash .= $pattern[mt_rand(0,$ptn_len-1)];
	return $hash;
}