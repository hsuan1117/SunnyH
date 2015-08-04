<?php

class login_system{
	
	static $url = "http://www.tfcis.org/login/";
	
	/*function user(){
		@session_start();
		if(isset($_SESSION["user"]))
			return $_SESSION["user"];
		else if(isset())
		else if(isset($_COOKIE["login"])){
			
		}
		return false;
	}
	
	function login(){
		
	}
	
	function check(){
		@session_start();
		if(isset($_SESSION["user"]))
			return (object)array( "login"=>true, "data"=>$_SESSION["user"] );
		else
			return (object)array( "login"=>false, "data"=>null );
	}
	
	function user(){
		$cookie = @$_COOKIE["login"];
		if(!isset($cookie))
			return false;
		if(self::$cache_cookie === $cookie)
			return self::$cache_user;
		
		$data = file_get_contents(self::$url."api/user.php?cookie=".$cookie);
		$data = json_decode($data);
		if($data->status === "success"){
			self::$cache_cookie = $cookie;
			return self::$cache_user = $data->result;
		}else if($data->status === "error"){
			if($data->result === "notfound"){
				setcookie("login",null,-1,self::$cookie_path,self::$cookie_domain,false,true);
			}else{
				throw new exception("Login API returned an error status");
			}
		}else{
			throw new exception("Unexpected API result");
		}
	}*/
	
	public function status(){
		@session_start();
		if(isset($_SESSION["user"])){
			return (object)array( "login"=>true, "data"=>$_SESSION["user"], "url"=>self::geturl("logout") );
		}else if(isset($_GET["cookie"])){
			$cookie = $_GET["cookie"];
			$data = file_get_contents(self::$url."api/user.php?cookie=".$cookie);
			$data = json_decode($data);
			if($data->status === "success"){
				$_SESSION["user"] = $data->result;
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
			return (object)array( "login"=>false, "data"=>null, "url"=>self::geturl("login") );;
		}
	}
	
	private function geturl($page){
		$current_url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		return self::$url . "$page.php?continue=" . urlencode($current_url);
	}
	
}

?><pre><?php
session_start();
login_system::$url = "http://domen111.koding.io/login/";
var_dump(login_system::status());
?></pre>