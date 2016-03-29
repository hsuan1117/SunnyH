<?php
if(!defined("IN_SYSTEM"))
	die("Access Denied");
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>TFcis Login</title>
	
	<!-- templated.co -->
	<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
	<script src="js/jquery.min.js"></script>
	<script src="js/skel.min.js"></script>
	<script src="js/skel-layers.min.js"></script>
	<script src="js/init.js"></script>
	<noscript>
		<link rel="stylesheet" href="css/skel.css" />
		<link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="css/style-xlarge.css" />
	</noscript>
	<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->

</head>

<body>
	<header id="header">
		<a href="./">
			<h1 style="color:#999">TFcis <span style="color:#ffffff">Login</span> Integration System</h1>
		</a>
		<nav id="nav">
			<ul>
				<li><a href="index.php"><?php echo _("Home");?></a></li>
				<li><a href="setting.php"><?php echo _("Setting");?></a></li>
				
				<?php if(@$E["login"]===true){ ?>
					<li><?=$E["nick"]?>(<?=$E["acct"]?>)</li>
					<li><a href="logout.php?continue=index.php" style="color:#FFF"><?php echo _("logout");?></a></li>
				<?php }else{ ?>
					<li><a href="login.php" style="color:#FFF"><?php echo _("login");?>/<?php echo _("signup");?></a></li>
				<?php } ?>
				<li><select id="locale" onchange="document.location='http://'+location.host+location.pathname+'?locale='+this.value;">
					<?php foreach ($config["locale"] as $locale) {
						echo '<option value="'.$locale.'" style="background-color: #000;" '.($E["locale"]==$locale?"selected":"").'>'.$locale.'</option>';
					}?>
				</select></li>
			</ul>
		</nav>
	</header>
	
<?php if(!@$E['main']){ ?>
	<section id="main" class="wrapper">
		<div class="container">
<?php } ?>
	
	<?php
		if($E["msg"]!="")
			echo "<blockquote>$E[msg]</blockquote>";
	?>