<?php
if(!defined("IN_SYSTEM"))
	die("Access Denied");
?>

<?php require("header.php"); ?>

<!--<section>
		<form method="POST">
			Account/E-mail: <input type="text" name="account"><br>
			Password: <input type="password" name="password"><br>
			<input type="submit" value="login" class="special">
		</form>
		<a href="<?php echo getloginurl($config["site"]["url"].'login.php'); ?>">login with facebook</a><br>
		<a href="signup.php">signup</a>
</section>-->

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
				</ul>
			</div>
		</div>
	</form>
	
	<ul class="actions small">
		<li><a href="<?=getloginurl($config["site"]["url"].'login.php')?>" class="button alt small">login with facebook</a></li>
		<li><a href="signup.php" class="button alt small">signup</a></li>
	</ul>
	
</section>


<?php require("footer.php"); ?>
