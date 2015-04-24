<?php
if(!defined("IN_SYSTEM"))
	die("Access Denied");

function make_json_result($status,$data){
	echo json_encode(array("status"=>$status,"result"=>$data));
}