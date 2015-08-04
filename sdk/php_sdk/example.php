<?php
include("func.php");

login_system::$url = "http://domen111.koding.io/login/";
echo "<pre>";
var_dump(login_system::status());
echo "</pre>";