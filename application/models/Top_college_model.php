<?php
defined("BASEPATH") or exit("No Direct Script Allowed");
class Top_college_model extends CI_Model
{  
	public $university;
	public $faculty;
	public $district;
	public function __construct()
	{
		$db2= $this->load->database("db2",true);
		$db2 = $db2->database;
		$this->db->where('pref_userid',$this->session->userdata("myid"));
		$qry = $this->db->get("$db2.user_search_preference");
		if($qry->num_rows() > 0)
		{
			$row = $qry->row(); 
			$this->university = json_decode($row->pref_university);
			$this->faculty = json_decode($row->pref_faculty);
			$this->district = json_decode($row->pref_district);   
		}
	}
	public function list_top_college_model()
	{
		$db3=$this->load->database("db3",true);
		$db3=$db3->database;
		$db4=$this->load->database("db4",true);
		$db4=$db4->database;
		$db2=$this->load->database("db2",true);
		$db2=$db2->database;
		$this->db->select("*");
		$this->db->from("$db3.college");
		$this->db->join("$db3.college_details",'college_details.CDetails_clgeid =college.Clge_id','left');
		$this->db->join("$db3.college_type",'college_type.Ctype_id =college.Clge_type_id','left'); 
		$this->db->join("$db2.country",'country.Cntry_id =college.Clge_country_id','left'); 
		$this->db->join("$db3.college_courses",'college_courses.Clgecourse_college_id=college.Clge_id','left');
		$this->db->join("$db4.university_courses",'university_courses.Ucourse_id=college_courses.Clgecourse_univcourseid','left');
		$this->db->join("$db4.university",'university.Univ_id=university_courses.Ucourse_universityid','left');
		$this->db->join("$db4.courses",'courses.Course_id =university_courses.Ucourse_courseid','left');
		$this->db->where("Clge_rank",1);
		if(!empty($this->district) && empty($this->faculty) && empty($this->university))
		{
			$this->db->where_in('Clge_district_id',$this->district); 
		} 
		if(!empty($this->district) && !empty($this->faculty) && empty($this->university))
		{
			$this->db->where_in('Clge_district_id',$this->district);
			$this->db->or_where_in('Clgecourse_facultyid',$this->faculty);
		} 
		if(!empty($this->district) && !empty($this->faculty) && !empty($this->university))
		{
			$this->db->where_in('Clge_district_id',$this->district);
			$this->db->or_where_in('Clgecourse_facultyid',$this->faculty);
			$this->db->or_where_in('Univ_id',$this->university);
		}
		if(empty($this->district) && !empty($this->faculty) && empty($this->university))
		{
			$this->db->where_in('Clgecourse_facultyid',$this->faculty); 
		} 
		if(empty($this->district) && !empty($this->faculty) && !empty($this->university))
		{
			$this->db->where_in('Clgecourse_facultyid',$this->faculty);
			$this->db->or_where_in('Univ_id',$this->university); 
		} 
		if(!empty($this->university) && empty($this->district) && empty($this->faculty))
		{
			$this->db->where_in('Univ_id',$this->university);
		}

		$this->db->limit(50);	 
		$this->db->group_by("Clge_id");
		$query_conllege=$this->db->get();
		return $query_conllege->result_array();
	}
}
?>