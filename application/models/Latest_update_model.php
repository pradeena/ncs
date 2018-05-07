<?php
defined("BASEPATH") or exit("No Direct Script Allowed");
class Latest_update_model extends CI_Model
{  
	public function list_search_keywords_model()
	{
		$db2=$this->load->database("db2",true);
		$db2=$db2->database;
		$this->db->select("Popular_search_name");
		$this->db->group_by("Popular_search_name");
		$this->db->order_by('Popular_search_name', 'RANDOM');
		$this->db->limit(12);
		$qry_search_keywords=$this->db->get("$db2.popular_search");
		return $qry_search_keywords->result_array();
	}
	public function list_popular_course_model()
	{
		$db4=$this->load->database("db4",true);
		$db4=$db4->database;
		$this->db->select("Course_id,Course_name,Course_short_name"); 
		$this->db->order_by('Course_name', 'RANDOM');
		$this->db->limit(12);
		$qry_popular_course=$this->db->get("$db4.courses");
		return $qry_popular_course->result_array();
	}
	public function list_faculties_model()
	{
		$db3=$this->load->database("db3",true);
		$db3=$db3->database;
		$this->db->select("Cfaculty_name,Cfaculty_id");
		$this->db->limit(5);
		$this->db->order_by("Cfaculty_id","RANDOM");
		$qry_faculty=$this->db->get("$db3.college_faculty");
		return $qry_faculty->result_array();
	}
}
?>