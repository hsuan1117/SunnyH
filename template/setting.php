<?php
if(!defined("IN_SYSTEM"))
	die("Access Denied");
?>

<?php require("header.php"); ?>

<center>
<form method="POST">
	Account: <?=@$E["info"]["account"]?><br>
	Password: <input type="password" name="password"><br>
	Confirm: <input type="password" name="password2"><br>
	Nickname: <input type="text" name="nickname" value="<?=@$E["info"]["nickname"]?>"><br> 
	E-mail: <input type="email" name="email" value="<?=@$E["info"]["email"]?>"><br>
	<input type="submit" value="edit">
</form>
<form method="POST">
    Facebook: <input type="hidden" id="facebook" name="facebook" value="unconnect">
	<?php
		if(@$E["info"]["fbid"]==""){
			?>
				<input type="button" onclick="document.location='<?php echo getloginurl($config["site"]["url"].'setting.php'); ?>';" value="connect">
			<?php
		}else {
			echo @$E["info"]["fbid"];
			?>
				<input type="submit" value="unconnect">
			<?php
		}
	?>
</form>
</center>

<?php require("footer.php"); ?>
