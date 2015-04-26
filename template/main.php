<?php
if(!defined("IN_SYSTEM"))
	die("Access Denied");
?>

<?php require("header.php"); ?>

<center>
<?php if($E["login"]===true){ ?>
	your nickname: <?=$E["nick"]?><br>
	your account: <?=$E["acct"]?>
	<a href="logout.php?continue=index.php">logout</a>
<?php }else{ ?>
	<a href="login.php">login</a>
<?php } ?>
</center>

<?php require("footer.php"); ?>
