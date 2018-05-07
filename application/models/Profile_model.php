<?php
defined("BASEPATH") or exit("No Direct Script Allowed");
class Profile_model extends CI_Model
{
	public function list_individual_user_model()
	{
		$db1=$this->load->database("db1",true);
		$db1=$db1->database;
		$this->db->select("*,COUNT(*) as count");	
		$this->db->from("$db1.users");
		$this->db->join("$db1.user_login","user_login.Login_user_id=users.User_id",'left');
		$this->db->join("$db1.access_type","access_type.Atype_id=user_login.Login_accesstype_id",'left');
		$this->db->where("User_id",$this->session->userdata("myid"));
		$query_individual_admins=$this->db->get();
		return $query_individual_admins->result_array();
	}
	public function update_user_model($realfile)
	{
		$data=array(
			"User_fstname" => trim($this->input->post("User_fstname")),
			"User_lstname" => trim($this->input->post("User_lstname")),
			"User_mobileno" => trim($this->input->post("User_mobileno")),
			"User_gender" => trim($this->input->post("User_gender")),
			"User_profile_pic" => $realfile
		);
		$db1=$this->load->database("db1",true);
		$db1=$db1->database;
		$this->db->where("User_id",$this->session->userdata("myid"));
		$query_update_user=$this->db->update("$db1.users",$data);
		if($query_update_user)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function change_user_password_model()
	{
		$data=array( 
			"Login_password" => md5(trim($this->input->post("Login_password"))),
			"Login_last_password" => $this->input->post("user_login_password") 
		);
		$db1=$this->load->database("db1",true);
		$db1=$db1->database;
		$this->db->where("Login_user_id",$this->session->userdata("myid"));
		$query_change_password=$this->db->update("$db1.user_login",$data);
		if($query_change_password)
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