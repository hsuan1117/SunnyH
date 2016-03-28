<?php
if(!defined("IN_SYSTEM"))
	die("Access Denied");
?>

<?php require("header.php"); ?>

<center>
<h3>Signup</h3>
<form method="POST">
	<div class="row uniform 50%">
		<div class="2u 12u$(xsmall)"></div><div class="1u 12u$(xsmall)">Account:</div><div class="7u 12u$(xsmall)"><input type="text" name="account" required value="<?=@$E["POST"]["account"]?>" placeholder="Between 3 and 32 alphabetic characters or numerical digits. Cannot be changed." pattern="[A-Za-z0-9]{3,32}" maxlength="32"></div><div class="2u$ 12u$(xsmall)"></div>
		<div class="2u 12u$(xsmall)"></div><div class="1u 12u$(xsmall)">Password:</div><div class="7u 12u$(xsmall)"><input type="password" name="password" required placeholder="At least 6 characters." pattern=".{6,}" /></div><div class="2u$ 12u$(xsmall)"></div>
		<div class="2u 12u$(xsmall)"></div><div class="1u 12u$(xsmall)">Confirm:</div><div class="7u 12u$(xsmall)"><input type="password" name="password2" required placeholder="Re-enter your password."></div><div class="2u$ 12u$(xsmall)"></div>
		<div class="2u 12u$(xsmall)"></div><div class="1u 12u$(xsmall)">Nickname:</div><div class="7u 12u$(xsmall)"><input type="text" name="nickname" required value="<?=@$E["POST"]["nickname"]?>" placeholder="Everyone will identify you from your nickname."></div><div class="2u$ 12u$(xsmall)"></div>
		<div class="2u 12u$(xsmall)"></div><div class="1u 12u$(xsmall)">Realname:</div><div class="7u 12u$(xsmall)"><input type="text" name="realname" required value="<?=@$E["POST"]["realname"]?>" placeholder="Enter your real Chinese name. You will be blocked because of fake name."></div><div class="2u$ 12u$(xsmall)"></div>
		<div class="2u 12u$(xsmall)"></div><div class="1u 12u$(xsmall)">Email:</div><div class="7u 12u$(xsmall)"><input type="email" name="email" required value="<?=@$E["POST"]["email"]?>" placeholder="Enter your email address, and you can receive the mail."></div><div class="2u$ 12u$(xsmall)"></div>
		<div class="2u 12u$(xsmall)"></div><div class="1u 12u$(xsmall)"></div><div class="7u 12u$(xsmall)"><input type="submit" value="signup" class="special"></div><div class="2u$ 12u$(xsmall)"></div>
	</div>
</form>
</center>

<?php require("footer.php"); ?>
