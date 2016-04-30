<?php
if(!defined("IN_SYSTEM"))
	die("Access Denied");
?>

<?php require("header.php"); ?>

<script src='https://www.google.com/recaptcha/api.js?hl=<?php echo $E["locale"]; ?>'></script>
<center>
<h3><?php echo _("Signup");?></h3>
<form method="POST">
	<div class="row uniform 50%">
		<div class="2u 12u$(xsmall)"></div><div class="1u 12u$(xsmall)"><?php echo _("Account");?>:</div><div class="7u 12u$(xsmall)"><input type="text" name="account" required value="<?=@$E["POST"]["account"]?>" placeholder="<?php echo _("signup_Account_placeholder");?>" pattern="[A-Za-z][A-Za-z0-9]{2,31}" maxlength="32"></div><div class="2u$ 12u$(xsmall)"></div>
		<div class="2u 12u$(xsmall)"></div><div class="1u 12u$(xsmall)"><?php echo _("Password");?>:</div><div class="7u 12u$(xsmall)"><input type="password" name="password" required placeholder="<?php echo _("Password_placeholder");?>" pattern=".{6,}" /></div><div class="2u$ 12u$(xsmall)"></div>
		<div class="2u 12u$(xsmall)"></div><div class="1u 12u$(xsmall)"><?php echo _("Confirm");?>:</div><div class="7u 12u$(xsmall)"><input type="password" name="password2" required placeholder="<?php echo _("Confirm_placeholder");?>"></div><div class="2u$ 12u$(xsmall)"></div>
		<div class="2u 12u$(xsmall)"></div><div class="1u 12u$(xsmall)"><?php echo _("Nickname");?>:</div><div class="7u 12u$(xsmall)"><input type="text" name="nickname" required value="<?=@$E["POST"]["nickname"]?>" placeholder="<?php echo _("Nickname_placeholder");?>"></div><div class="2u$ 12u$(xsmall)"></div>
		<div class="2u 12u$(xsmall)"></div><div class="1u 12u$(xsmall)"><?php echo _("Realname");?>:</div><div class="7u 12u$(xsmall)"><input type="text" name="realname" required value="<?=@$E["POST"]["realname"]?>" placeholder="<?php echo _("Realname_placeholder");?>"></div><div class="2u$ 12u$(xsmall)"></div>
		<div class="2u 12u$(xsmall)"></div><div class="1u 12u$(xsmall)"><?php echo _("Email");?>:</div><div class="7u 12u$(xsmall)"><input type="email" name="email" required value="<?=@$E["POST"]["email"]?>" placeholder="<?php echo _("Email_placeholder");?>"></div><div class="2u$ 12u$(xsmall)"></div>
		<div class="2u 12u$(xsmall)"></div><div class="1u 12u$(xsmall)"></div><div class="7u 12u$(xsmall)"><div class="g-recaptcha" data-sitekey="<?php echo $config['reCAPTCHA']['site_key']; ?>"></div></div><div class="2u$ 12u$(xsmall)"></div>
		<div class="2u 12u$(xsmall)"></div><div class="1u 12u$(xsmall)"></div>
		<div class="7u 12u$(xsmall)">
			<ul class="actions">
				<li><input type="submit" value="<?php echo _("signup");?>" class="special"></li>
			</ul>
		</div>
		<div class="2u$ 12u$(xsmall)"></div>
	</div>
</form>
</center>

<?php require("footer.php"); ?>
