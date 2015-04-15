<?php
define("IN_SYSTEM",true);
require_once("config/config.php");
require_once("func/sql.php");
require_once("func/checklogin.php");

# template variables
$E = array();
$E["msg"] = "";