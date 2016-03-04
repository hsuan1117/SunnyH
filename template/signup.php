<?php
if(!defined("IN_SYSTEM"))
	die("Access Denied");
?>

<?php require("header.php"); ?>

<h3>Signup</h3>
<form method="POST">
	<div class="row uniform 50%">
		<div class="12u 12u$(xsmall)">
			<input type="text" name="account" required value="<?=@$E["POST"]["account"]?>" placeholder="Account" />
		</div>
		<div class="12u$ 12u$(xsmall)">
			<input type="password" name="password" required placeholder="Password" />
		</div>
		<div class="12u$ 12u$(xsmall)">
			<input type="password" name="password2" required placeholder="Confirm" />
		</div>
		<div class="12u$ 12u$(xsmall)">
			<input type="text" name="nickname" required value="<?=@$E["POST"]["nickname"]?>" placeholder="Nickname" />
		</div>
		<div class="12u$ 12u$(xsmall)">
			<input type="text" name="realname" required value="<?=@$E["POST"]["realname"]?>" placeholder="Realname" />
		</div>
		<div class="12u$ 12u$(xsmall)">
			<input type="email" name="email" required value="<?=@$E["POST"]["email"]?>" placeholder="E-mail" />
		</div>
		<div class="12u$">
			<ul class="actions">
				<li><input type="submit" value="signup" class="special" /></li>
			</ul>
		</div>
	</div>
</form>

<?php require("footer.php"); ?>
