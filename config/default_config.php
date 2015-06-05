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
$config["session"]["cookie_domain"] = ".tfcis.org"; //Hint: If you want to set cookie on localhost, use false or empty string.

# site
$config["site"]["available_domain"] = ["/.*tfcis.org$/"];
$config["site"]["url"] = "http://www.tfcis.org/login/";

# facebook app
$config["facebook"]["SDK_autoload_path"] = "facebook-php-sdk-v4-4.0-dev/autoload.php";
$config["facebook"]["SDK_V4_SRC_DIR"] = "facebook-php-sdk-v4-4.0-dev/src/Facebook/";
$config["facebook"]["appid"] = "YOUR_APP_ID";
$config["facebook"]["appsecret"] = "YOUR_APP_SECRET";

@include_once('config.php');
