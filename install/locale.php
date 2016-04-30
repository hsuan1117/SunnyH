<?php
$isCLI = ( php_sapi_name() == 'cli' );
if(!$isCLI)
{
    die("Please run me from the console - not from a web-browser!");
}

require("../config/config.php");
chdir("../locale");
foreach ($config["locale"] as $locale) {
	system("msgfmt ".$locale."/LC_MESSAGES/login.po -o ".$locale."/LC_MESSAGES/login.mo");
	echo "msgfmt ".$locale."\n";
}
?>