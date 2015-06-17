<?php
if(!defined("IN_SYSTEM"))
	die("Access Denied");
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>TFcis Login Integration System</title>
</head>
<body topmargin="0" leftmargin="0">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="100%" height="100" align="center" valign="middle" bgcolor="#F0F0F0" style="font-weight: bold;">
			<span style="font-size: 36px;color: #999"><span style="color: #000;">TFcis</span> <span style="color: #000;">L</span>ogin <span style="color: #000;">I</span>ntegration <span style="color: #000;">S</span>ystem</span><br>
			<span style="color: #999">台南一中資訊社整合登入系統</span>
		</td>
		<td bgcolor="#F0F0F0" style="text-align: right" colspan="2"><div id="headerimg" style="display:none;"><img src="http://www.tfcis.org/images/TFcisweb3_03.gif" height="100px"></div></td>
		<script>if(document.body.clientWidth>=900)headerimg.style.display="";</script>
	</tr>
	</table>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td height="25" valign="middle" bgcolor="#0000FF" style="color: #FFF">
			<div style="float:left;">
			&nbsp;&nbsp;&nbsp;&nbsp;<a href="./" style="color:#FFF" >Home</a>
			&nbsp;&nbsp;&nbsp;&nbsp;<a href="./setting.php" style="color:#FFF" >Setting</a>
			</div>
		</td>
		<td height="25" valign="middle" bgcolor="#0000FF" style="text-align: right; color: #FFF;">
			<?php if(@$E["login"]===true){ ?>
				<?=$E["nick"]?>(<?=$E["acct"]?>)
				<a href="logout.php?continue=index.php" style="color:#FFF">logout</a>
			<?php }else{ ?>
				<a href="login.php" style="color:#FFF">login</a>
			<?php } ?>
			&nbsp;&nbsp;
		</td>
	</tr>
	</table>
	<center>
		<?=$E["msg"]?>
	</center>