<?php
defined("BASEPATH") or exit("No Direct Script Allowed");
class Contactus_model extends CI_Model
{
	/* add user contact message model function */
	public function do_add_contactus_details_model()
	{
		$this->load->library('user_agent');
		$browser = $this->agent->browser();
		$browserVersion = $this->agent->version();
		$platform = $this->agent->platform();
		$ip=$this->input->ip_address();
		$browser_details='Browser Name:- '.$browser.' , version:- '.$browserVersion.' , plateform:- '.$platform.' , Ip:- '.$ip;
		$db2=$this->load->database("db2",true);
		$db2=$db2->database;
		$data=array(
			"contact_name" => trim($this->input->post("contact_name")),
			"contact_email" => trim($this->input->post("contact_email")),
			"contact_mobile" => trim($this->input->post("contact_mobile")),
			"contact_message" => trim($this->input->post("contact_message")),
			"contact_browser_details" => $browser_details
		); 
		if($query_users=$this->db->insert("$db2.contact_us",$data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}
?>