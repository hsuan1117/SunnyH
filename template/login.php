<?php
if(!defined("IN_SYSTEM"))
	die("Access Denied");
?>

<?php require("header.php"); ?>

<center>
<form method="POST">
	Account/E-mail: <input type="text" name="account"><br>
	Password: <input type="password" name="password"><br>
	<input type="submit" value="login">
</form>
<a href="<?php echo getloginurl($config["site"]["url"].'login.php'); ?>">login with facebook</a><br>
<a href="signup.php">signup</a>
</center>

<?php require("footer.php"); ?>
