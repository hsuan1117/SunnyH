<?php
if(!defined("IN_SYSTEM"))
	die("Access Denied");
?>

<?php require("header.php"); ?>

<center>
<form method="POST">
	<div class="row uniform 50%">
		<div class="4u 12u$(xsmall)"></div><div class="1u 12u$(xsmall)">Account:</div><div class="3u 12u$(xsmall)"><?=@$E["info"]["account"]?></div><div class="4u$ 12u$(xsmall)"></div>
		<div class="4u 12u$(xsmall)"></div><div class="1u 12u$(xsmall)">Password:</div><div class="3u 12u$(xsmall)"><input type="password" name="password"></div><div class="4u$ 12u$(xsmall)"></div>
		<div class="4u 12u$(xsmall)"></div><div class="1u 12u$(xsmall)">Confirm:</div><div class="3u 12u$(xsmall)"><input type="password" name="password2"></div><div class="4u$ 12u$(xsmall)"></div>
		<div class="4u 12u$(xsmall)"></div><div class="1u 12u$(xsmall)">Nickname:</div><div class="3u 12u$(xsmall)"><input type="text" name="nickname" value="<?=@$E["info"]["nickname"]?>"></div><div class="4u$ 12u$(xsmall)"></div>
		<div class="4u 12u$(xsmall)"></div><div class="1u 12u$(xsmall)">E-mail:</div><div class="3u 12u$(xsmall)"><input type="email" name="email" value="<?=@$E["i</div>nfo"]["email"]?>"></div><div class="4u$ 12u$(xsmall)"></div>
		<div class="4u 12u$(xsmall)"></div><div class="1u 12u$(xsmall)"></div><div class="3u 12u$(xsmall)"><input type="submit" value="edit"></div><div class="4u$ 12u$(xsmall)"></div>
	</div>
</form>
</center>

<?php require("footer.php"); ?>
