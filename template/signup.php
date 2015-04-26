<?php
if(!defined("IN_SYSTEM"))
	die("Access Denied");
?>

<?php require("header.php"); ?>

<center>
<form method="POST">
	Account: <input type="text" name="account" required value="<?=$E["POST"]["account"]?>"><br>
	Password: <input type="password" required name="password"><br>
	Confirm: <input type="password" required name="password2"><br>
	Nickname: <input type="text" name="nickname" required value="<?=$E["POST"]["nickname"]?>"><br> 
	E-mail: <input type="email" name="email" required value="<?=$E["POST"]["email"]?>"><br>
	<input type="submit" value="signup">
</form>
</center>

<?php require("footer.php"); ?>
