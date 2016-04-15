<?php
if(!defined("IN_SYSTEM"))
	die("Access Denied");
?>

<?php require("header.php"); ?>

<center>
<h3><?php echo _("Setting");?></h3>
<form method="POST">
	<div class="row uniform 50%">
		<div class="2u 12u$(xsmall)"></div><div class="1u 12u$(xsmall)"><?php echo _("Account");?>:</div><div class="7u 12u$(xsmall)"><?=@$E["info"]["account"]?></div><div class="2u$ 12u$(xsmall)"></div>
		<div class="2u 12u$(xsmall)"></div><div class="1u 12u$(xsmall)"><?php echo _("Password");?>:</div><div class="7u 12u$(xsmall)"><input type="password" name="password" placeholder="<?php echo _("Password_placeholder");?>" pattern=".{6,}" /></div><div class="2u$ 12u$(xsmall)"></div>
		<div class="2u 12u$(xsmall)"></div><div class="1u 12u$(xsmall)"><?php echo _("Confirm");?>:</div><div class="7u 12u$(xsmall)"><input type="password" name="password2" placeholder="<?php echo _("Confirm_placeholder");?>"></div><div class="2u$ 12u$(xsmall)"></div>
		<div class="2u 12u$(xsmall)"></div><div class="1u 12u$(xsmall)"><?php echo _("Nickname");?>:</div><div class="7u 12u$(xsmall)"><input type="text" name="nickname" required value="<?=@$E["info"]["nickname"]?>" placeholder="<?php echo _("Nickname_placeholder");?>"></div><div class="2u$ 12u$(xsmall)"></div>
		<div class="2u 12u$(xsmall)"></div><div class="1u 12u$(xsmall)"><?php echo _("Realname");?>:</div><div class="7u 12u$(xsmall)"><input type="text" name="realname" required value="<?=@$E["info"]["realname"]?>" placeholder="<?php echo _("Realname_placeholder");?>"></div><div class="2u$ 12u$(xsmall)"></div>
		<div class="2u 12u$(xsmall)"></div><div class="1u 12u$(xsmall)"><?php echo _("Email");?>:</div><div class="7u 12u$(xsmall)"><input type="email" name="email" required value="<?=@$E["info"]["email"]?>" placeholder="<?php echo _("Email_placeholder");?>"></div><div class="2u$ 12u$(xsmall)"></div>
		<div class="2u 12u$(xsmall)"></div><div class="1u 12u$(xsmall)">Facebook:</div><div class="7u 12u$(xsmall)">
			<?php
			if(@$E["info"]["fbid"]==""){
				?><a href="<?php echo htmlspecialchars($E["info"]["fbloginurl"]); ?>" class="button alt icon fa-facebook"><?php echo _("connect");?></a><?php
			} else {
				echo $E["info"]["fbname"]; ?> <a href="connect.php?disconnect" class="button alt icon fa-facebook"><?php echo _("disconnect");?></a><?php
			}
			?>
		</div><div class="2u$ 12u$(xsmall)"></div>
		<div class="2u 12u$(xsmall)"></div><div class="1u 12u$(xsmall)"></div>
		<div class="7u 12u$(xsmall)">
			<ul class="actions">
				<li><input type="submit" value="<?php echo _("edit");?>"></li>
			</ul>
		</div>
		<div class="2u$ 12u$(xsmall)"></div>
	</div>
</form>
</center>

<?php require("footer.php"); ?>
