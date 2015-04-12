<?php
require_once("system.php");
if(!isset($_POST["account"]))
	require("template/main.php");
else
{
	$db = createPDO();
	$E["msg"] = "succ";
	require("template/main.php");
}