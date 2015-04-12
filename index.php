<?php
require_once("system.php");
if(isset($_POST["account"]) && isset($_POST["password"]))
{
	$db = createPDO();
	$E["msg"] = "succ";
	require("template/main.php");
}
else
{
	require("template/main.php");
}