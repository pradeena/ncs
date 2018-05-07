<?php
defined("BASEPATH") or exit("No Direct Script Allowed");
class Student_college_details_model extends CI_Model
{
	public function get_student_college_details_model()
	{
		$db3=$this->load->database("db3",true);
		$db3=$db3->database;  
		$this->db->from("$db3.college_students cstd");  
		$this->db->join("$db3.college clge","clge.Clge_id=cstd.Clge_std_college_id"); 
		$this->db->where("Clge_std_user_id",$this->session->userdata("myid")); 
		$query_student_college_details=$this->db->get();
		return $query_student_college_details->result_array();
	}
}
?>