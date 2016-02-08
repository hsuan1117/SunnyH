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
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
</script>
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
					<li><div class="fb-login-button" data-max-rows="1" data-size="xlarge" data-show-faces="false" data-auto-logout-link="false" onlogin="checkLoginState();"></div></li>
					<li><a href="signup.php" class="button alt">signup</a></li>
				</ul>
			</div>
		</div>
	</form>
	
</section>

<?php require("footer.php"); ?>
