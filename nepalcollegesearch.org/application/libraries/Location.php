<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
class Location {

	 public static function getLocation($ip)
	 {
		$location = file_get_contents('http://ip-api.com/json/'.$ip);
 		return $location=json_decode($location);
	 } 
} 
