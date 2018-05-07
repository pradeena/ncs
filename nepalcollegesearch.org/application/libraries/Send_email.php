<?php
defined("BASEPATH") or die("No direct script allowed");
CLass Send_email 
{
	public static function sendMail($sendTo, $subject, $message)
	{ 
        $CI =   &get_instance();
		$CI->load->library("email"); 
		$CI->load->library('email'); 
		$CI->email->from(EMAIL_FROM,EMAIL_FROM_NAME);
		$CI->email->to($sendTo);
		$CI->email->set_mailtype("html");
		$CI->email->subject($subject);
		return $data_email["email_msg"] = $message;
		$message= $CI->load->view(MAILER_FILE_NAME,$data_email,TRUE); 
		$CI->email->message($message); 
		$CI->email->send(); 
	}
}
?>