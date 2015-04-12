<?php
require_once("system.php");
if(isset($_POST["account"]) && isset($_POST["password"]))
{
	if(checkPassword($_POST["account"],$_POST["password"])){
		echo "login succeed";
	}else{
		$E["msg"] = "login failed";
		require("template/main.php");
	}
}
else
{
	require("template/main.php");
}