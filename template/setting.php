<?php
if(!defined("IN_SYSTEM"))
	die("Access Denied");
?>

<?php require("header.php"); ?>

<center>
<h3>Setting</h3>
<form method="POST">
	<div class="row uniform 50%">
		<div class="2u 12u$(xsmall)"></div><div class="1u 12u$(xsmall)">Account:</div><div class="7u 12u$(xsmall)"><?=@$E["info"]["account"]?></div><div class="2u$ 12u$(xsmall)"></div>
		<div class="2u 12u$(xsmall)"></div><div class="1u 12u$(xsmall)">Password:</div><div class="7u 12u$(xsmall)"><input type="password" name="password" placeholder="At least 6 characters." pattern=".{6,}" /></div><div class="2u$ 12u$(xsmall)"></div>
		<div class="2u 12u$(xsmall)"></div><div class="1u 12u$(xsmall)">Confirm:</div><div class="7u 12u$(xsmall)"><input type="password" name="password2" placeholder="Re-enter your password."></div><div class="2u$ 12u$(xsmall)"></div>
		<div class="2u 12u$(xsmall)"></div><div class="1u 12u$(xsmall)">Nickname:</div><div class="7u 12u$(xsmall)"><input type="text" name="nickname" required value="<?=@$E["info"]["nickname"]?>" placeholder="Everyone will identify you from your nickname."></div><div class="2u$ 12u$(xsmall)"></div>
		<div class="2u 12u$(xsmall)"></div><div class="1u 12u$(xsmall)">Realname:</div><div class="7u 12u$(xsmall)"><input type="text" name="realname" required value="<?=@$E["info"]["realname"]?>" placeholder="Enter your real Chinese name. You will be blocked because of fake name."></div><div class="2u$ 12u$(xsmall)"></div>
		<div class="2u 12u$(xsmall)"></div><div class="1u 12u$(xsmall)">Email:</div><div class="7u 12u$(xsmall)"><input type="email" name="email" required value="<?=@$E["info"]["email"]?>" placeholder="Enter your email address, and you can receive the mail."></div><div class="2u$ 12u$(xsmall)"></div>
		<div class="2u 12u$(xsmall)"></div><div class="1u 12u$(xsmall)">Facebook:</div><div class="7u 12u$(xsmall)">
			<?php
			if(@$E["info"]["fbid"]==""){
				?><a href="<?php echo htmlspecialchars($E["info"]["fbloginurl"]); ?>" class="button alt icon fa-facebook">connect</a><?php
			} else {
				echo $E["info"]["fbname"]; ?> <a href="connect.php?disconnect" class="button alt icon fa-facebook">disconnect</a><?php
			}
			?>
		</div><div class="2u$ 12u$(xsmall)"></div>
		<div class="2u 12u$(xsmall)"></div><div class="1u 12u$(xsmall)"></div><div class="7u 12u$(xsmall)"><input type="submit" value="edit"></div><div class="2u$ 12u$(xsmall)"></div>
	</div>
</form>
</center>

<?php require("footer.php"); ?>
