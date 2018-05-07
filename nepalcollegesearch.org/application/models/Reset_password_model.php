<?php
defined("BASEPATH") or exit("No Direct Script Allowed");
/* Forget_password_model start here*/
class Reset_password_model extends CI_Model
{
	/* Function or method for getting password reset data from database through requested email */
	public function send_forget_password_email_model()
	{
		$this->db->where("Login_username",$this->input->post("email"));
		$query=$this->db->get("user_login");
		/* if it return value then execute further code*/
		if($query->num_rows() > 0)
		{
			$row=$query->row();
			return array(
				"forgetid" => $row->Login_user_id,
				"forgetverify" => $row->Login_activation_email
				
			);
		}
		/* if it dosen't return any value then return false to controller*/
		else
		{
			return false;
		}
	}
	/* model function to check valid url or authorize this users from database through url data*/
	public function check_reset_url_model($forgetid,$forgetverify)
	{
		$this->db->where("Login_user_id",$forgetid);
		$this->db->where("Login_activation_email",$forgetverify);
		$query_check=$this->db->get("user_login");
		/* if valid url then return true*/
		if($query_check->num_rows() > 0)
		{
			return true;
		}
		/* if not valid url then return false*/
		else
		{
			return false;
		}
	}
	/* model function for update password query*/
	public function do_reset_password_model()
	{ 
		$this->db->where("Login_user_id",$this->input->post("forgetid"));
		$this->db->where("Login_activation_email",$this->input->post("forgetverify"));
		$query=$this->db->get("user_login");
		/*query for fetching curren password from database*/
		if($query->num_rows() > 0)
		{
			$row=$query->row();
			$Login_last_password=$row->Login_password;
			$this->db->where("Login_user_id",$this->input->post("forgetid"));
			$this->db->where("Login_activation_email",$this->input->post("forgetverify"));
			$data=array(
				"Login_password" => $this->input->post("password"),
				"Login_last_password" => $Login_last_password
			);
			$query_update=$this->db->update("user_login",$data);
			/* if update query execute then return true */
			if($query_update)
			{
				$this->db->where("User_id",$this->input->post("forgetid")); 
				$query_getemail=$this->db->get("users");
				if($query_getemail->num_rows() > 0)
				{
					$row_getemail=$query_getemail->row();
					return $row_getemail->User_email;
				} 
				else return false;
				//return true;
			}
			else return false;
		}
		else return false;
	}
}
?>