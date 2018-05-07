<?php
defined("BASEPATH") or exit("No Direct Script Allowed");
class My_enquiry_model extends CI_Model
{
	public function list_my_enquiry_model()
	{
		$db1=$this->load->database("db1",true);
		$db1=$db1->database;
		$db8=$this->load->database("db8",true);
		$db8=$db8->database;
		$db3=$this->load->database("db3",true);
		$db3=$db3->database;
		$db4=$this->load->database("db4",true);
		$db4=$db4->database;
		$this->db->from("$db8.college_enquiry");
		$this->db->join("$db8.college_enquiry_status",'college_enquiry_status.CEstatus_id=college_enquiry.Cenq_enquiry_statusid','left');
		$this->db->join("$db8.college_enquiry_types",'college_enquiry_types.CEtype_id=college_enquiry.Cenq_enquirytypeid','left');
		$this->db->join("$db3.college",'college.Clge_id=college_enquiry.Cenq_clgeid','left');
		$this->db->join("$db3.college_courses",'college_courses.Clgecourse_id=college_enquiry.Cenq_clgecourseid','left');
		$this->db->join("$db4.university_courses",'university_courses.Ucourse_id=college_courses.Clgecourse_univcourseid','left');
		$this->db->join("$db4.university",'university.Univ_id =university_courses.Ucourse_universityid','left'); 
		$this->db->join("$db4.courses",'courses.Course_id =university_courses.Ucourse_courseid','left');
		$this->db->join("$db4.courses_type",'courses_type.Course_type_id =courses.Course_ctype_id','left');
		$this->db->join("$db1.users",'users.User_id =college_enquiry.Cenq_approveby','left');
		$this->db->join("$db8.college_enquiry_comment_schedule",'college_enquiry_comment_schedule.CEcmntsced_enquiryid =college_enquiry.Cenq_id','left');
		$this->db->where("Cenq_userid",$this->session->userdata("myid"));
		//$this->db->where("CEcmntsced_active",1);
		$this->db->order_by("Cenq_regdate","DESC"); 
		$query_my_enquiry=$this->db->get();
		return $query_my_enquiry->result_array();
	} 
	public function individual_enquiry_student_model()
	{
		$db8=$this->load->database("db8",true);
		$db8=$db8->database;
		$this->db->select('*,COUNT(*) as count');
		$this->db->from("$db8.college_enquiry");
		//$this->db->where("Cenq_clgeid",$this->session->userdata("clgid"));
		$this->db->where("Cenq_userid",$this->session->userdata("myid"));
		$query_individual=$this->db->get(); 
		return $query_individual->result_array(); 
	}
	public function list_course_model()
	{
		$db4=$this->load->database("db4",true);
		$db4=$db4->database;
		$this->db->select('*');
		$this->db->from("$db4.courses_type");
		$query_course_type=$this->db->get();
		return $query_course_type->result_array();
	}
	public function do_search_college_model($search_keyword)
	{ 
		$search_keyword=trim($search_keyword); 
		$keyword_new=explode(" ",$search_keyword);
		$count_array = count($keyword_new); 
		$db3=$this->load->database("db3",true);
		$db3=$db3->database;
		$db4=$this->load->database("db4",true);
		$db4=$db4->database;
		$db2=$this->load->database("db2",true);
		$db2=$db2->database;
		$this->db->select("*,COUNT(*) as count");
		$this->db->from("$db3.college");
		$this->db->join("$db3.college_type",'college_type.Ctype_id =college.Clge_type_id','left'); 
		$this->db->join("$db2.country",'country.Cntry_id =college.Clge_country_id','left');
		$this->db->join("$db2.zone",'zone.Zon_id=college.Clge_zone_id','left','left');
		$this->db->join("$db2.district",'district.Dist_id =college.Clge_district_id');
		$this->db->join("$db3.college_courses",'college_courses.Clgecourse_college_id=college.Clge_id','left');
		$this->db->join("$db4.university_courses",'university_courses.Ucourse_id=college_courses.Clgecourse_univcourseid','left');
		$this->db->join("$db4.courses",'courses.Course_id =university_courses.Ucourse_courseid','left');
		$this->db->join("$db4.courses_type",'courses_type.Course_type_id =courses.Course_ctype_id','left');
			$this->db->or_where('(Clge_city like "%'.$search_keyword.'%"');
			$this->db->or_where('Clge_name like "%'.$search_keyword.'%"');
			$this->db->or_where('Course_name like "%'.$search_keyword.'%"');
			$this->db->or_where('Course_short_name like "%'.$search_keyword.'%")');
			//$this->db->or_like('Clge_name',$keyword_new[$i]); 
			//$this->db->or_like('Course_type_name',$keyword_new[$i]);
			//$this->db->or_like('Course_name',$keyword_new[$i]);
		
		$this->db->where("Clge_status",1);
		$this->db->order_by("Clge_name","ASC");
		$this->db->group_by("Clge_name");
		$this->db->limit(10);
		$query_search_college=$this->db->get(); 
		return $query_search_college->result_array();
	}
	public function list_university_model($search_keyword)
	{
		$search_keyword=trim($search_keyword); 
		$keyword_new=explode(" ",$search_keyword);
		$count_array = count($keyword_new); 
		$db3=$this->load->database("db3",true);
		$db3=$db3->database;
		$db4=$this->load->database("db4",true);
		$db4=$db4->database;
		$db2=$this->load->database("db2",true);
		$db2=$db2->database;
		$this->db->select("university.*,college.Clge_id");
		$this->db->from("$db3.college");
		$this->db->join("$db3.college_type",'college_type.Ctype_id =college.Clge_type_id','left'); 
		$this->db->join("$db2.country",'country.Cntry_id =college.Clge_country_id','left');
		$this->db->join("$db2.zone",'zone.Zon_id=college.Clge_zone_id','left');
		$this->db->join("$db2.district",'district.Dist_id =college.Clge_district_id','left');
		$this->db->join("$db3.college_courses",'college_courses.Clgecourse_college_id=college.Clge_id','left');
		$this->db->join("$db4.university_courses",'university_courses.Ucourse_id=college_courses.Clgecourse_univcourseid','left');
		$this->db->join("$db4.university",'university.Univ_id =university_courses.Ucourse_universityid','left'); 
		$this->db->join("$db4.courses",'courses.Course_id =university_courses.Ucourse_courseid','left');
		$this->db->join("$db4.courses_type",'courses_type.Course_type_id =courses.Course_ctype_id','left');
		for ($i=0; $i<$count_array; $i++) 
		{ 
			$this->db->or_like('Clge_name',$keyword_new[$i]); 
			$this->db->or_like('Course_type_name',$keyword_new[$i]);
			$this->db->or_like('Course_name',$keyword_new[$i]);
		}	
		$this->db->order_by("Univ_name","ASC");
		$this->db->group_by("Univ_id"); 
		$query_list_university=$this->db->get(); 
		return $query_list_university->result_array();
	}
	public function list_cities_model($search_keyword)
	{
		$search_keyword=trim($search_keyword); 
		$keyword_new=explode(" ",$search_keyword);
		$count_array = count($keyword_new); 
		$db3=$this->load->database("db3",true);
		$db3=$db3->database;
		$db4=$this->load->database("db4",true);
		$db4=$db4->database;
		$db2=$this->load->database("db2",true);
		$db2=$db2->database;
		$this->db->select("college.Clge_city");
		$this->db->from("$db3.college");
		$this->db->join("$db3.college_type",'college_type.Ctype_id =college.Clge_type_id','left'); 
		$this->db->join("$db2.country",'country.Cntry_id =college.Clge_country_id','left');
		$this->db->join("$db2.zone",'zone.Zon_id=college.Clge_zone_id','left');
		$this->db->join("$db2.district",'district.Dist_id =college.Clge_district_id','left');
		$this->db->join("$db3.college_courses",'college_courses.Clgecourse_college_id=college.Clge_id','left');
		$this->db->join("$db4.university_courses",'university_courses.Ucourse_id=college_courses.Clgecourse_univcourseid','left');
		$this->db->join("$db4.university",'university.Univ_id =university_courses.Ucourse_universityid','left'); 
		$this->db->join("$db4.courses",'courses.Course_id =university_courses.Ucourse_courseid','left');
		$this->db->join("$db4.courses_type",'courses_type.Course_type_id =courses.Course_ctype_id','left');
		for ($i=0; $i<$count_array; $i++) 
		{ 
			$this->db->or_like('Clge_name',$keyword_new[$i]); 
			$this->db->or_like('Course_type_name',$keyword_new[$i]);
			$this->db->or_like('Course_name',$keyword_new[$i]);
		}	
		$this->db->order_by("Clge_city","ASC");
		$this->db->group_by("Clge_city"); 
		$query_list_city=$this->db->get(); 
		return $query_list_city->result_array();
	} 
	public function all_universities_and_cities_model($search_keyword)
	{
		$search_keyword=trim($search_keyword); 
		$keyword_new=explode(" ",$search_keyword);
		$count_array = count($keyword_new); 
		$db3=$this->load->database("db3",true);
		$db3=$db3->database;
		$db4=$this->load->database("db4",true);
		$db4=$db4->database;
		$db2=$this->load->database("db2",true);
		$db2=$db2->database;
		$this->db->select("*,COUNT(*) as count");
		$this->db->from("$db3.college");
		$this->db->join("$db3.college_type",'college_type.Ctype_id =college.Clge_type_id','left'); 
		$this->db->join("$db2.country",'country.Cntry_id =college.Clge_country_id','left');
		$this->db->join("$db2.zone",'zone.Zon_id=college.Clge_zone_id','left','left');
		$this->db->join("$db2.district",'district.Dist_id =college.Clge_district_id');
		$this->db->join("$db3.college_courses",'college_courses.Clgecourse_college_id=college.Clge_id','left');
		$this->db->join("$db4.university_courses",'university_courses.Ucourse_id=college_courses.Clgecourse_univcourseid','left');
		$this->db->join("$db4.courses",'courses.Course_id =university_courses.Ucourse_courseid','left');
		$this->db->join("$db4.courses_type",'courses_type.Course_type_id =courses.Course_ctype_id','left');
		for ($i=0; $i<$count_array; $i++) 
		{ 
			$this->db->or_like('Clge_name',$keyword_new[$i]); 
			$this->db->or_like('Course_type_name',$keyword_new[$i]);
			$this->db->or_like('Course_name',$keyword_new[$i]);
		}	
		$this->db->where("Clge_status",1);
		$this->db->order_by("Clge_name","DESC");
		$this->db->group_by("Clge_name");
		$this->db->limit(300);
		$query_all_universities_and_cities=$this->db->get(); 
		return $query_all_universities_and_cities->result_array();
	}
	public function all_universities_model($search_keyword,$Clge_city)
	{
		$search_keyword=trim($search_keyword); 
		$keyword_new=explode(" ",$search_keyword);
		$count_array = count($keyword_new); 
		$db3=$this->load->database("db3",true);
		$db3=$db3->database;
		$db4=$this->load->database("db4",true);
		$db4=$db4->database;
		$db2=$this->load->database("db2",true);
		$db2=$db2->database;
		$this->db->select("*");
		$this->db->from("$db3.college");
		$this->db->join("$db3.college_type",'college_type.Ctype_id =college.Clge_type_id','left'); 
		$this->db->join("$db2.country",'country.Cntry_id =college.Clge_country_id','left');
		$this->db->join("$db2.zone",'zone.Zon_id=college.Clge_zone_id','left');
		$this->db->join("$db2.district",'district.Dist_id =college.Clge_district_id','left');
		$this->db->join("$db3.college_courses",'college_courses.Clgecourse_college_id=college.Clge_id','left');
		$this->db->join("$db4.university_courses",'university_courses.Ucourse_id=college_courses.Clgecourse_univcourseid','left');
		$this->db->join("$db4.university",'university.Univ_id =university_courses.Ucourse_universityid','left'); 
		$this->db->join("$db4.courses",'courses.Course_id =university_courses.Ucourse_courseid','left');
		$this->db->join("$db4.courses_type",'courses_type.Course_type_id =courses.Course_ctype_id','left');
		for ($i=0; $i<$count_array; $i++) 
		{ 
			$this->db->or_like('Clge_name',$keyword_new[$i]); 
			$this->db->or_like('Course_type_name',$keyword_new[$i]);
			$this->db->or_like('Course_name',$keyword_new[$i]);
		}	
		$this->db->where("Clge_status",1);
		$this->db->where("Clge_city",$Clge_city);
		$this->db->order_by("Clge_name","DESC");
		$this->db->group_by("Clge_name");
		$this->db->limit(300);
		$query_all_universities=$this->db->get(); 
		return $query_all_universities->result_array();
	}
	public function all_cities_model($search_keyword,$Univ_id)
	{
		$search_keyword=trim($search_keyword); 
		$keyword_new=explode(" ",$search_keyword);
		$count_array = count($keyword_new); 
		$db3=$this->load->database("db3",true);
		$db3=$db3->database;
		$db4=$this->load->database("db4",true);
		$db4=$db4->database;
		$db2=$this->load->database("db2",true);
		$db2=$db2->database;
		$this->db->select("*");
		$this->db->from("$db3.college");
		$this->db->join("$db3.college_type",'college_type.Ctype_id =college.Clge_type_id','left'); 
		$this->db->join("$db2.country",'country.Cntry_id =college.Clge_country_id','left');
		$this->db->join("$db2.zone",'zone.Zon_id=college.Clge_zone_id','left');
		$this->db->join("$db2.district",'district.Dist_id =college.Clge_district_id','left');
		$this->db->join("$db3.college_courses",'college_courses.Clgecourse_college_id=college.Clge_id','left');
		$this->db->join("$db4.university_courses",'university_courses.Ucourse_id=college_courses.Clgecourse_univcourseid','left');
		$this->db->join("$db4.university",'university.Univ_id =university_courses.Ucourse_universityid','left'); 
		$this->db->join("$db4.courses",'courses.Course_id =university_courses.Ucourse_courseid','left');
		$this->db->join("$db4.courses_type",'courses_type.Course_type_id =courses.Course_ctype_id','left');
		for ($i=0; $i<$count_array; $i++) 
		{ 
			$this->db->or_like('Clge_name',$keyword_new[$i]); 
			$this->db->or_like('Course_type_name',$keyword_new[$i]);
			$this->db->or_like('Course_name',$keyword_new[$i]);
		}	
		$this->db->where("Clge_status",1);
		$this->db->where("Univ_id",$Univ_id);
		$this->db->order_by("Clge_name","DESC");
		$this->db->group_by("Clge_name");
		$this->db->limit(300);
		$query_all_cities=$this->db->get(); 
		return $query_all_cities->result_array();
	}
	public function both_universities_and_cities_model($search_keyword,$Clge_city,$Univ_id)
	{
		$search_keyword=trim($search_keyword); 
		$keyword_new=explode(" ",$search_keyword);
		$count_array = count($keyword_new); 
		$db3=$this->load->database("db3",true);
		$db3=$db3->database;
		$db4=$this->load->database("db4",true);
		$db4=$db4->database;
		$db2=$this->load->database("db2",true);
		$db2=$db2->database;
		$this->db->select("*");
		$this->db->from("$db3.college");
		$this->db->join("$db3.college_type",'college_type.Ctype_id =college.Clge_type_id','left'); 
		$this->db->join("$db2.country",'country.Cntry_id =college.Clge_country_id','left');
		$this->db->join("$db2.zone",'zone.Zon_id=college.Clge_zone_id','left');
		$this->db->join("$db2.district",'district.Dist_id =college.Clge_district_id','left');
		$this->db->join("$db3.college_courses",'college_courses.Clgecourse_college_id=college.Clge_id','left');
		$this->db->join("$db4.university_courses",'university_courses.Ucourse_id=college_courses.Clgecourse_univcourseid','left');
		$this->db->join("$db4.university",'university.Univ_id =university_courses.Ucourse_universityid','left'); 
		$this->db->join("$db4.courses",'courses.Course_id =university_courses.Ucourse_courseid','left');
		$this->db->join("$db4.courses_type",'courses_type.Course_type_id =courses.Course_ctype_id','left');
		for ($i=0; $i<$count_array; $i++) 
		{ 
			$this->db->or_like('Clge_name',$keyword_new[$i]); 
			$this->db->or_like('Course_type_name',$keyword_new[$i]);
			$this->db->or_like('Course_name',$keyword_new[$i]);
		}	
		$this->db->where("Clge_status",1);
		$this->db->where("Univ_id",$Univ_id);
		$this->db->where("Clge_city",$Clge_city);
		$this->db->order_by("Clge_name","DESC");
		$this->db->group_by("Clge_name");
		$this->db->limit(300);
		$query_both_universities_and_cities=$this->db->get(); 
		return $query_both_universities_and_cities->result_array();
	}
	/* College Details Model For Viewing College Details According To Search Result */
	public function view_college_details_model()
	{ 
		$db3=$this->load->database("db3",true);
		$db3=$db3->database;
		$db4=$this->load->database("db4",true);
		$db4=$db4->database;
		$db2=$this->load->database("db2",true);
		$db2=$db2->database;
		$this->db->select("*,COUNT(*) as count");
		$this->db->from("$db3.college");
		$this->db->join("$db3.college_type",'college_type.Ctype_id =college.Clge_type_id','left'); 
		$this->db->join("$db2.country",'country.Cntry_id =college.Clge_country_id','left');
		$this->db->join("$db2.zone",'zone.Zon_id=college.Clge_zone_id','left');
		$this->db->join("$db2.district",'district.Dist_id =college.Clge_district_id','left');
		$this->db->join("$db3.college_courses",'college_courses.Clgecourse_college_id=college.Clge_id','left');
		$this->db->join("$db4.university_courses",'university_courses.Ucourse_id=college_courses.Clgecourse_univcourseid','left'); 
		$this->db->join("$db4.university",'university.Univ_id =university_courses.Ucourse_universityid','left');
		$this->db->where("Clge_id",$this->input->get("clgeid"));
		$this->db->where("Clge_status",1);
		$query_college_details=$this->db->get(); 
		return $query_college_details->result_array();
	}
	public function enquiry_type_model($CEtype_id)
	{
		$db8=$this->load->database("db8",true);
		$db8=$db8->database;
		$this->db->where("CEtype_id",$CEtype_id);
		$qry_enquiry_type=$this->db->get("$db8.college_enquiry_types");
		return $qry_enquiry_type->result_array();
	}
	public function blood_group_details_model()
	{
		$db8=$this->load->database("db8",true);
		$db8=$db8->database;
		$this->db->select("*");
		$this->db->from("$db8.college_enquiry_bloodgroup");
		$query=$this->db->get();
		return $query->result_array();
		
	}
	public function do_general_enquiry_model($Cenq_regdate)
	{
		$db8=$this->load->database("db8",true);
		$db8=$db8->database;
		$data=array(
			"Cenq_fstname" => trim($this->input->post("Cenq_fstname")),
			"Cenq_lstname" => trim($this->input->post("Cenq_lstname")),
			"Cenq_email" => trim($this->input->post("Cenq_email")),
			"Cenq_contactno" => trim($this->input->post("Cenq_contactno")),
			"Cenq_enquirytypeid" => trim($this->input->post("Cenq_enquirytypeid")), 
			"Cenq_userid" => $this->session->userdata("myid"),
			"Cenq_clgeid" => $this->input->get("clgeid"),
			"Cenq_enquiry_statusid" => 1,
			"Cenq_regdate" => $Cenq_regdate
		);
		if($this->db->insert("$db8.college_enquiry",$data))
		{
			$this->db->where("Cenq_email",trim($this->input->post("Cenq_email")));
			$this->db->where("Cenq_enquirytypeid",trim($this->input->post("Cenq_enquirytypeid")));
			$this->db->where("Cenq_regdate",$Cenq_regdate);
			$query_getenquiryid=$this->db->get("$db8.college_enquiry");
			$row_getenquiryid=$query_getenquiryid->row();
			$data_comment=array(
				"CEcmntsced_enquiryid" => $row_getenquiryid->Cenq_id,
				"CEcmntsced_usercomment" => $this->input->post("CEcmntsced_usercomment"), 
				"CEcmntsced_followuptype" => "Request By User",
				"CEcmntsced_active" => 1,
				"CEcmntsced_regdate" => $Cenq_regdate,
			);
			if($this->db->insert("$db8.college_enquiry_comment_schedule",$data_comment))
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
	public function enquiry_program_model($Clgecourse_id)
	{
		$db3=$this->load->database("db3",true);
		$db3=$db3->database;
		$db4=$this->load->database("db4",true);
		$db4=$db4->database;  
		$this->db->from("$db3.college_courses");
		$this->db->join("$db4.university_courses",'university_courses.Ucourse_id=college_courses.Clgecourse_univcourseid','left');
		$this->db->join("$db4.courses",'courses.Course_id =university_courses.Ucourse_courseid','left');
		$this->db->join("$db4.courses_type",'courses_type.Course_type_id =courses.Course_ctype_id','left');
		$this->db->join("$db4.university",'university.Univ_id =university_courses.Ucourse_universityid','left');
		$this->db->where("Clgecourse_id",$Clgecourse_id);
		$query_enquiry_program=$this->db->get();
		return $query_enquiry_program->result_array();
	}
	public function check_duplicate_admission_enquiry_model($Cenq_email,$Cenq_clgecourseid)
	{
		$db8=$this->load->database("db8",true);
		$db8=$db8->database;
		$this->db->where("Cenq_email",trim($Cenq_email));
		$this->db->where("Cenq_clgecourseid",$Cenq_clgecourseid);
		$this->db->where("Cenq_clgeid",$this->input->get("clgeid"));
		$this->db->where("Cenq_enquiry_statusid!=",4);
		$query_duplicate_enquiry=$this->db->get("$db8.college_enquiry");
		if($query_duplicate_enquiry->num_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function admission_enquiry_for_old_user_model($Cenq_regdate)
	{
		$db8=$this->load->database("db8",true);
		$db8=$db8->database;
		$db1=$this->load->database("db1",true);
		$db1=$db1->database;
		$this->db->where("User_email",trim($this->input->post("Cenq_email")));
		$query_user_id=$this->db->get("$db1. users"); 
		$row_user_id=$this->session->userdata("myid");
		$data_enquiry=array(
			"Cenq_fstname" => trim($this->input->post("Cenq_fstname")),
			"Cenq_lstname" => trim($this->input->post("Cenq_lstname")),
			"Cenq_email" => trim($this->input->post("Cenq_email")),
			"Cenq_contactno" => trim($this->input->post("Cenq_contactno")),
			"Cenq_enquirytypeid" => trim($this->input->post("Cenq_enquirytypeid")), 
			"Cenq_clgecourseid" => trim($this->input->post("Cenq_clgecourseid")),      
			"Cenq_userid" => $row_user_id,  
			"Cenq_clgeid" => $this->input->get("clgeid"),
			"Cenq_enquiry_statusid" => 1,
			"Cenq_regdate" => $Cenq_regdate,
			); 
		if($this->db->insert("$db8.college_enquiry",$data_enquiry))	
		{
			$this->db->where("Cenq_email",trim($this->input->post("Cenq_email")));
			$this->db->where("Cenq_enquirytypeid",trim($this->input->post("Cenq_enquirytypeid")));
			$this->db->where("Cenq_regdate",$Cenq_regdate);
			$query_getenquiryid=$this->db->get("$db8.college_enquiry");
			$row_getenquiryid=$query_getenquiryid->row();
			$data_comment=array(
				"CEcmntsced_enquiryid" => $row_getenquiryid->Cenq_id,
				"CEcmntsced_usercomment" => $this->input->post("CEcmntsced_usercomment"),  
				"CEcmntsced_visiting_date" => $this->input->post("CEcmntsced_visiting_date"), 
				"CEcmntsced_visiting_time" => $this->input->post("CEcmntsced_visiting_time"), 
				"CEcmntsced_followuptype" => "Request By User",
				"CEcmntsced_active" => 1,
				"CEcmntsced_regdate" => $Cenq_regdate,
			);
			if($this->db->insert("$db8.college_enquiry_comment_schedule",$data_comment))
			{
				$data_previous_eduDetails=array(
							"UPQ_enquiryid" => $row_getenquiryid->Cenq_id, 
							"UPQ_prev_course" => trim($this->input->post("UPQ_prev_course")),
							"UPQ_prev_ctypeid" => trim($this->input->post("UPQ_prev_ctypeid")),
							"UPQ_prev_marks" => trim($this->input->post("UPQ_prev_marks")),
							"UPQ_prev_clgename" => trim($this->input->post("UPQ_prev_clgename")),
						);
				if($this->db->insert("$db8.users_previous_qualification",$data_previous_eduDetails))
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
		else
		{
			return false;
		}
	}
	public function do_general_enquiryAjax_model($Cenq_regdate)
	{
		$db8=$this->load->database("db8",true);
		$db8=$db8->database;
		$data=array(
			"Cenq_fstname" => trim($this->input->post("Cenq_fstname")),
			"Cenq_lstname" => trim($this->input->post("Cenq_lstname")),
			"Cenq_email" => trim($this->input->post("Cenq_email")),
			"Cenq_contactno" => trim($this->input->post("Cenq_contactno")),
			"Cenq_enquirytypeid" => trim($this->input->post("Cenq_enquirytypeid")), 
			"Cenq_userid" => $this->session->userdata("myid"),
			"Cenq_clgeid" => $this->input->post("Cenq_clgeid"),
			"Cenq_enquiry_statusid" => 1,
			"Cenq_regdate" => $Cenq_regdate
		);
		if($this->db->insert("$db8.college_enquiry",$data))
		{
			$this->db->where("Cenq_email",trim($this->input->post("Cenq_email")));
			$this->db->where("Cenq_enquirytypeid",trim($this->input->post("Cenq_enquirytypeid")));
			$this->db->where("Cenq_regdate",$Cenq_regdate);
			$query_getenquiryid=$this->db->get("$db8.college_enquiry");
			$row_getenquiryid=$query_getenquiryid->row();
			$data_comment=array(
				"CEcmntsced_enquiryid" => $row_getenquiryid->Cenq_id,
				"CEcmntsced_usercomment" => $this->input->post("CEcmntsced_usercomment"), 
				"CEcmntsced_followuptype" => "Request By User",
				"CEcmntsced_active" => 1,
				"CEcmntsced_regdate" => $Cenq_regdate,
			);
			if($this->db->insert("$db8.college_enquiry_comment_schedule",$data_comment))
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
}	
?>