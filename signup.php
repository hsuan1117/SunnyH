<?php
require_once("system.php");
$signupfail=false;
$E["POST"]=$_POST;
if(isset($_POST["account"])){
	if($_POST["account"]==""){
		$signupfail=true;
		$E["msg"].="Account is empty. ";
	}
	if($_POST["password"]==""){
		$signupfail=true;
		$E["msg"].="Password is empty. ";
	}else if($_POST["password2"]==""){
		$signupfail=true;
		$E["msg"].="Confirm is empty. ";
	}else if($_POST["password"]!==$_POST["password2"]){
		$signupfail=true;
		$E["msg"].="Password isn't match. ";
	}
	if($_POST["nickname"]==""){
		$signupfail=true;
		$E["msg"].="Name is empty. ";
	}
	if($_POST["email"]==""){
		$signupfail=true;
		$E["msg"].="E-mail is empty. ";
	}
	if(!$signupfail){
		$checkaccount = checkPassword($_POST["account"]);
		$checkemail = checkPassword($_POST["email"]);
		if($checkaccount === -1 && $checkemail === -1){
			try{
				$db = PDO_prepare("INSERT INTO `table:account` (`account`, `password`, `email`, `nickname`) VALUES (:account, :password, :email, :nickname)");
				$db->bindValue("account", $_POST["account"]);
				$db->bindValue("password", crypt($_POST["password"]));
				$db->bindValue("email", $_POST["email"]);
				$db->bindValue("nickname", $_POST["nickname"]);
				$db->execute();
			}catch(PDOException $e){
				die("SQL ERROR: " . $e->getMessage());
			}

			$E["msg"] = "Signup succeed. Please login.";
			require("template/blank.php");
			header('refresh: 3;url=login.php');
		}else {
			if($checkaccount !== -1){
				$E["msg"].="Account is exist. ";
				$E["POST"]["account"]="";
			}
			if($checkemail !== -1){
				$E["msg"].="Email is exist. ";
				$E["POST"]["email"]="";
			}
			require("template/signup.php");
		}
	}else{
		require("template/signup.php");
	}
}else{
	require("template/signup.php");
}