<?php
if(!defined("IN_SYSTEM"))
	die("Access Denied");
?>

<?php require("header.php"); ?>

<section>
	
	<h3>Login</h3>
	<form method="POST">
		<div class="row uniform 50%">
			<div class="12u 12u$(xsmall)">
				<input type="text" name="account" placeholder="Account/E-mail" />
			</div>
			<div class="12u$ 12u$(xsmall)">
				<input type="password" name="password" placeholder="Password" />
			</div>
			<div class="12u$">
				<ul class="actions">
					<li><input type="submit" value="login" class="special" /></li>
					<li><a href="signup.php" class="button alt">signup</a></li>
				</ul>
			</div>
		</div>
	</form>
	
</section>

<?php require("footer.php"); ?>
