<?php

# DON'T CHANGE THIS FILE IF YOU WANT TO EDIT CONFIGURATION
# If you want to change, make "config.php" in the same directory and put the configurations you want to change in it.

# DB
$config["DB"]["host"] = "localhost";
$config["DB"]["dbname"] = "login";
$config["DB"]["charset"] = "utf8";
$config["DB"]["user"] = "";
$config["DB"]["pwd"] = "";
$config["DB"]["tablepre"] = "";

# session
$config["session"]["keep_login"] = true; //If set to false, the cookie expire at the end of the session.
$config["session"]["expire"] = 30; //unit: days; If keep_login==false, the expire time in db is still set to it.
$config["session"]["cookie_path"] = "/";
$config["session"]["cookie_domain"] = ".tfcis.org";


if(file_exists('config.php'))
{
    require_once('config.php');
}