<?php
defined("BASEPATH") or exit("No Direct Script Allowed");
class Loggedin_user_info_model extends CI_Model
{
	public function user_details_model()
	{
		$db1=$this->load->database("db1",true);
		$db1=$db1->database;
		$this->db->from("$db1.users usr");
		$this->db->join("$db1.user_login ul","ul.Login_user_id=usr.User_id");
		$this->db->join("$db1.users_access_group acg","acg.Access_group_id=ul.Login_accesstype_id");
		$this->db->where("User_id",$this->session->userdata("myid"));
		$this->db->where("Login_logintoken",$this->session->userdata("logintoken"));
		$query_user_details=$this->db->get();
		if($query_user_details->num_rows() > 0)
		{ 
			return $query_user_details->result_array();
		}
		else
		{
			return false;
		}
	}
	public function user_login_logs_model()
	{
		$db1=$this->load->database("db1",true);
		$db1=$db1->database; 
		$this->db->select("*"); 
		$this->db->where("Log_user_id",$this->session->userdata("myid")); 
		$this->db->limit(5);
		$query_user_login_logs=$this->db->get("$db1.user_logs");
		return $query_user_login_logs->result_array();
	} 
	public function updateProfile($User_fstname, $User_lstname, $User_gender)
	{
		$data=array(
			"User_fstname" => $User_fstname,
			"User_lstname" => $User_lstname,
			"User_gender" => $User_gender 
		);
		$db1=$this->load->database("db1",true);
		$db1=$db1->database;
		$this->db->where("User_id",$this->session->userdata("myid")); 
		if($this->db->update("$db1.users",$data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function uploadProfile($realfile)
	{
		$data=array(
			"User_profile_pic" => $realfile, 
		);
		$db1=$this->load->database("db1",true);
		$db1=$db1->database;
		$this->db->where("User_id",$this->session->userdata("myid")); 
		if($this->db->update("$db1.users",$data))
		{
			return true;
		}
		else
		{
			return false;
		}

	}
	public function checkOldPassword($oldPassword)
	{
		$db1=$this->load->database("db1",true);
		$db1=$db1->database;
		$this->db->where("Login_user_id",$this->session->userdata("myid"));
		$this->db->where("Login_password",$oldPassword);
		$qry = $this->db->get("$db1.user_login");
		if($qry->num_rows()==1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function changePassword($oldPassword, $Login_password)
	{ 
		$data=array( 
			"Login_password" => $Login_password	,
			"Login_last_password" => $oldPassword
		);
		$db1=$this->load->database("db1",true);
		$db1=$db1->database;
		$this->db->where("Login_user_id",$this->session->userdata("myid")); 
		if($this->db->update("$db1.user_login",$data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function change_my_password_model()
	{
		$Login_password=$this->input->post("Login_password");
		$Login_password=md5(trim($Login_password));
		$data=array( 
			"Login_password" => $Login_password	,
			"Login_last_password" => $this->input->post("Login_last_password") 
		);
		$db1=$this->load->database("db1",true);
		$db1=$db1->database;
		$this->db->where("Login_user_id",$this->session->userdata("myid"));
		$query_change_mypassword=$this->db->update("$db1.user_login",$data);
		if($query_change_mypassword)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function update_my_profile_model($realfile)
	{
		$data=array(
			"User_fstname" => $this->input->post("User_fstname"),
			"User_lstname" => $this->input->post("User_lstname"),
			"User_mobileno" => $this->input->post("User_mobileno"),
			"User_profile_pic" => $realfile
		);
		$db1=$this->load->database("db1",true);
		$db1=$db1->database;
		$this->db->where("User_id",$this->session->userdata("myid"));
		$query_my_admin_profile=$this->db->update("$db1.users",$data);
		if($query_my_admin_profile)
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