<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
class Curl {

	 public function simple_get($url)
	 {
			$curl = curl_init(); // Set some options - we are passing in a useragent too here
			curl_setopt_array($curl, array(
								CURLOPT_RETURNTRANSFER => 1,
								CURLOPT_URL => $url,
								CURLOPT_USERAGENT => 'Codular Sample cURL Request'
								)); 
			$resp = curl_exec($curl);// Send the request & save response to $resp 
			curl_close($curl);// Close request to clear up some resources
			return $resp;
	 } 
} 
