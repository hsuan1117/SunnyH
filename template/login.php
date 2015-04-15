<?php
if(!defined("IN_SYSTEM"))
	die("Access Denied");
?>

<?php require("header.php"); ?>

<form method="POST">
	Account/E-mail: <input type="text" name="account"><br>
	Password: <input type="password" name="password"><br>
	<input type="submit" value="login">
</form>

<?php require("footer.php"); ?>
