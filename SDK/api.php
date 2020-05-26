
<?php

class login_system{
	
	static $login_url;
	static $site_url;
	static $current_url;
	
	function __construct(){
		require("config.php");
		self::$login_url = $config["login_url"];
		self::$site_url = $config["site_url"];
		self::$current_url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
	}

	public static function status(){
		@session_start();
		if(@$_GET["logout"]==true){
			unset($_SESSION["user"]);
			header("Location:".self::getlogouturl($_GET["continue"]));
		}else if(isset($_SESSION["user"])){
			return (object)array( "login"=>true, "data"=>$_SESSION["user"], "url"=>"http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?logout=true" );
		}else if(isset($_GET["cookie"])){
			$cookie = $_GET["cookie"];
			$data = file_get_contents(self::$login_url."api/user.php?cookie=".$cookie);
			$data = json_decode($data);
			if($data->status === "success"){
				$_SESSION["user"] = $data->result;
				header("Location:".$_SERVER['PHP_SELF']);
			}else if($data->status === "error"){
				if($data->result === "notfound"){
					// cookie not found
				}else{
					throw new exception("Login API returned an error status");
				}
			}else{
				throw new exception("Unexpected API result");
			}
		}else{
			return (object)array( "login"=>false, "data"=>null, "url"=>self::getloginurl(self::$current_url) );;
		}
	}

	public static function getinfobyaccount($uid){
		$data = file_get_contents(self::$login_url."api/getinfo.php?account=".$uid);
		$data = json_decode($data);
		if($data->status === "success"){
			return $data->result;
		}else if($data->status === "error"){
			if($data->result === "notfound"){
				return false;
			}else{
				throw new exception("Login API returned an error status");
			}
		}else{
			throw new exception("Unexpected API result");
		}
	}

	public static function getinfobyid($uid){
		$data = file_get_contents(self::$login_url."api/getinfo.php?uid=".$uid);
		$data = json_decode($data);
		if($data->status === "success"){
			return $data->result;
		}else if($data->status === "error"){
			if($data->result === "notfound"){
				// cookie not found
			}else{
				throw new exception("Login API returned an error status");
			}
		}else{
			throw new exception("Unexpected API result");
		}
	}

	public static function getloginurl($continue=null){
		return self::geturl("login", (is_null($continue)?self::$current_url:$continue));
	}

	public static function getlogouturl($continue=null){
		return self::geturl("login", (is_null($continue)?self::$site_url:$continue));
	}

	private static function geturl($page, $continue){
		return self::$login_url . "$page.php?continue=" . urlencode($continue);
	}
	
}
