<?php
defined("BASEPATH") or exit ("No DIrect Script Allowed");
class Register_model extends CI_Model
{
	/* Model Function For user registration */
	public function create_user_account_model($activation_email,$Login_password)
	{
		$this->load->database(); 
		$data=array(
					"User_fstname" => $this->input->post("fstname"),
					"User_lstname" => $this->input->post("lstname"),
					"User_email" => $this->input->post("email"),
					"User_mobileno" => $this->input->post("mobileno"),
					"User_suspension" => 1,
					); 
		$query_users=$this->db->insert("users",$data); 
		if($query_users)	
		{ 
			$this->db->where('User_email',$this->input->post("email"));
			$query=$this->db->get("users"); 
			if($query)
			{ 
				$row=$query->row(); 
				$data_user_login=array
				(
					"Login_user_id" => $row->User_id,
					"Login_username" => $row->User_email,
					"Login_password" => $Login_password,
					"Login_accesstype_id" => 1,
					"Login_activation_email" => $activation_email		
				);
				$query_user_login=$this->db->insert("user_login",$data_user_login); 
				if($query_user_login)
				{ 
					return $row->User_id; 
				}
				else return false;
			}
			else return false;
		}
		else return false;
	}
	/* Model Function For Account Verification */
	public function do_verify_account($id,$email_activation)
	{
		/* Select Query For Account Verification through id and email_activation from database*/
		$this->db->where("Login_user_id",$id);
		$this->db->where("Login_activation_email",$email_activation);
		$query_check=$this->db->get("user_login"); 
		/* if getting user date then execute further code */
		if($query_check->num_rows() > 0)
		{
			$this->db->where("User_id",$id); 
			$data=array(
				"User_status" => 1 
			);
			/* query For Updating user status for account activation  */
			$query_update_status=$this->db->update("users",$data);
			if($query_update_status)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	/* Model Function For getting email activation from database through id for resending activation email*/
	public function get_email_activation($id)
	{
		/* fetching user information through id from database for resending activation email */
		$this->db->select('User_fstname, User_email, Login_activation_email');
		$this->db->from('user_login');
		$this->db->join('users', 'users.User_id = user_login.Login_user_id');
		$this->db->where("Login_user_id",$id);
		$query_emailActivation=$this->db->get();
		/*if get userdata then executer further code*/
		if($query_emailActivation->num_rows() > 0)
		{
			$row_emailActication=$query_emailActivation->row();
			/* return user information in array formate to resend_verify_email function of register controller*/
			return $data=array(
						"name" => $row_emailActication->User_fstname,
						"email" =>$row_emailActication->User_email ,
						"activation" => $row_emailActication->Login_activation_email,
			);
		}
		/* if not get userdata then return false */
		else 
		{
			return false;
		}
	} 
	public function check_duplicate_email_model($email)
	{
		$db1=$this->load->database("db1",true);
		$db1=$db1->database;
		$this->db->where("User_email",$email);
		$qry_duplicateEmail=$this->db->get("$db1.users");
		if($qry_duplicateEmail->num_rows() > 0)	
		{
			return true;
		}			
		else
		{
			return false;
		}
	}
	public function check_duplicate_mobileno_model($mobileno)
	{
		$db1=$this->load->database("db1",true);
		$db1=$db1->database;
		$this->db->where("User_mobileno",$mobileno);
		$qry_duplicateMobileno=$this->db->get("$db1.users");
		if($qry_duplicateMobileno->num_rows() > 0)	
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