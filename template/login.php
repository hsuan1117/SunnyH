<?php
if(!defined("IN_SYSTEM"))
	die("Access Denied");
?>

<?php require("header.php"); ?>

<script>
  function statusChangeCallback(response) {
    if (response.status === 'connected') {
      return true;
    } else if (response.status === 'not_authorized') {
      return false;
    } else {
      return false;
    }
  }
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      if(statusChangeCallback(response))document.location = 'login.php?fblogin<?php echo (isset($_GET["continue"])?"&continue=".urlencode($_GET["continue"]):""); ?>';
    });
  }
  window.fbAsyncInit = function() {
  FB.init({
    appId      : '<?php echo $E['facebook']['app_id']; ?>',
    cookie     : true,
    xfbml      : true,
    version    : 'v2.5'
  });
  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });
  };
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/<?php echo $E["locale"];?>/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
</script>
<section>
	
	<h3><?php echo _("Login");?></h3>
	<form method="POST">
		<div class="row uniform 50%">
			<div class="12u 12u$(xsmall)">
				<input type="text" name="account" placeholder="<?php echo _("Account");?>/<?php echo _("Email");?>" />
			</div>
			<div class="12u$ 12u$(xsmall)">
				<input type="password" name="password" placeholder="<?php echo _("Password");?>" />
			</div>
			<div class="12u$">
				<ul class="actions">
					<li><input type="submit" value="<?php echo _("login");?>" class="special" /></li>
					<li><a href="signup.php" class="button alt"><?php echo _("signup");?></a></li>
          <li><div class="fb-login-button" data-max-rows="1" data-size="xlarge" data-show-faces="false" data-auto-logout-link="false" onlogin="checkLoginState();"></div></li>
				</ul>
			</div>
		</div>
	</form>
	
</section>

<?php require("footer.php"); ?>
