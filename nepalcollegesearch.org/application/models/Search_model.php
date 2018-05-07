<?php
defined("BASEPATH") or exit("No Direct Script Allowed");
class Search_model extends CI_Model
{ 
	public function do_total_recordfoundmodel($search_keyword)
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
		$this->db->select("COUNT(distinct Clge_id) as count");
		$this->db->from("$db3.college");
		$this->db->join("$db3.college_details",'college_details.CDetails_clgeid =college.Clge_id');
		$this->db->join("$db3.college_type",'college_type.Ctype_id =college.Clge_type_id'); 
		$this->db->join("$db2.country",'country.Cntry_id =college.Clge_country_id'); 
		$this->db->join("$db3.college_courses",'college_courses.Clgecourse_college_id=college.Clge_id');
		$this->db->join("$db4.university_courses",'university_courses.Ucourse_id=college_courses.Clgecourse_univcourseid');
		$this->db->join("$db4.courses",'courses.Course_id =university_courses.Ucourse_courseid'); 
		/*for ($i=0; $i<$count_array; $i++) 
		{ 
			$this->db->or_where('Clge_name like "%'.$keyword_new[$i].'%"');  
			$this->db->or_where('Clge_city like "%'.$keyword_new[$i].'%"');  
			$this->db->or_where('Course_name like "%'.$keyword_new[$i].'%"');   	
		} */
		$this->db->or_where('(Clge_city like "%'.$search_keyword.'%"');
		$this->db->or_where('Clge_name like "%'.$search_keyword.'%"');
		$this->db->or_where('Course_name like "%'.$search_keyword.'%"');
		$this->db->or_where('Course_short_name like "%'.$search_keyword.'%")');
		if(isset($_GET["univid"]))
		{
			$this->db->where("Ucourse_universityid",$this->input->get("univid"));
		}	
		if(isset($_GET["cty"]))
		{
			$this->db->where("Clge_city",$this->input->get("cty"));
		}	
		
		$this->db->where("Clge_status",1);		
		$this->db->limit(300);
		//$this->db->group_by("Clge_name"); 
		$query_total_record_found=$this->db->get(); 
		return $query_total_record_found->result_array();
	}
	public function do_logedinuser_search_college_or_course_model($search_keyword,$Prefer_cityname,$Prefer_courseid,$Prefer_facultyid)
	{
		//$pg  = isset($_GET['pg']) ? $_GET['pg'] : 1;
		//$start_from = ($pg-1) * 10; 
		$search_keyword=trim($search_keyword); 
		$keyword_new=explode(" ",$search_keyword);
		$count_array = count($keyword_new); 
		$db1=$this->load->database("db1",true);
		$db1=$db1->database; 
		$db3=$this->load->database("db3",true);
		$db3=$db3->database;
		$db4=$this->load->database("db4",true);
		$db4=$db4->database;
		$db2=$this->load->database("db2",true);
		$db2=$db2->database;
		$this->db->select("Clge_id,Clge_name,Clge_city,Clge_logo,Course_name,Course_id,Ctype_name,Cntry_name,Clgecourse_status,Clgecourse_fee,Clgecourse_req_exam,Clgecourse_duration,CDetails_ebrochure,Clgecourse_id,Clge_est_yr,Univ_name,Clge_verified_id");
		$this->db->from("$db3.college");
		$this->db->join("$db3.college_details",'college_details.CDetails_clgeid =college.Clge_id');
		$this->db->join("$db3.college_type",'college_type.Ctype_id =college.Clge_type_id'); 
		$this->db->join("$db2.country",'country.Cntry_id =college.Clge_country_id'); 
		$this->db->join("$db3.college_courses",'college_courses.Clgecourse_college_id=college.Clge_id');
		$this->db->join("$db4.university_courses",'university_courses.Ucourse_id=college_courses.Clgecourse_univcourseid');
		$this->db->join("$db3.college_faculty",'college_faculty.Cfaculty_id=college_courses.Clgecourse_facultyid','left');
		$this->db->join("$db4.university",'university.Univ_id=university_courses.Ucourse_universityid','left');
		$this->db->join("$db4.courses",'courses.Course_id =university_courses.Ucourse_courseid');
		$this->db->join("$db4.courses_type",'courses_type.Course_type_id =courses.Course_ctype_id','left'); 
		//$this->db->join("$db1.user_preference",'user_preference.Prefer_cityname =college.Clge_city','left'); 
		/*for ($i=0; $i<$count_array; $i++) 
		{ 
			$this->db->or_where('Clge_name like "%'.$keyword_new[$i].'%"');  
			$this->db->or_where('Clge_city like "%'.$keyword_new[$i].'%"');  
			$this->db->or_where('Course_name like "%'.$keyword_new[$i].'%"');   	
		} */
			$this->db->or_where('(Clge_city like "%'.$search_keyword.'%"');
			$this->db->or_where('Clge_name like "%'.$search_keyword.'%"');
			$this->db->or_where('Course_name like "%'.$search_keyword.'%"');
			$this->db->or_where('Course_short_name like "%'.$search_keyword.'%")');
		if(isset($_GET["univid"]))
		{
			$this->db->where("Ucourse_universityid",$this->input->get("univid"));
			$this->db->where("Course_type_id",$Prefer_courseid);
		}	
		if(isset($_GET["cty"]))
		{
			$this->db->where("Clge_city",$this->input->get("cty"));
			$this->db->where("Clge_city",$Prefer_cityname);
		}	     
		//$this->db->limit(10,$start_from);
		$this->db->limit(10);
		$this->db->group_by("Clge_name");
		$this->db->or_where("Cfaculty_id",$Prefer_facultyid); 
		$query_search_college_or_course=$this->db->get();
		return $query_search_college_or_course->result_array();
	} 
	public function do_search_college_or_course_model($search_keyword)
	{
		//$pg  = isset($_GET['pg']) ? $_GET['pg'] : 1;
		//$start_from = ($pg-1) * 10; 
		$search_keyword=trim($search_keyword); 
		$keyword_new=explode(" ",$search_keyword);
		$count_array = count($keyword_new); 
		$db3=$this->load->database("db3",true);
		$db3=$db3->database;
		$db4=$this->load->database("db4",true);
		$db4=$db4->database;
		$db2=$this->load->database("db2",true);
		$db2=$db2->database;
		$this->db->select("Clge_id,Clge_name,Clge_city,Clge_logo,Course_name,Course_id,Ctype_name,Cntry_name,Clgecourse_status,Clgecourse_fee,Clgecourse_req_exam,Clgecourse_duration,CDetails_ebrochure,Clgecourse_id,Clge_est_yr,Univ_name,Clge_verified_id");
		$this->db->from("$db3.college");
		$this->db->join("$db3.college_details",'college_details.CDetails_clgeid =college.Clge_id');
		$this->db->join("$db3.college_type",'college_type.Ctype_id =college.Clge_type_id'); 
		$this->db->join("$db2.country",'country.Cntry_id =college.Clge_country_id'); 
		$this->db->join("$db3.college_courses",'college_courses.Clgecourse_college_id=college.Clge_id');
		$this->db->join("$db4.university_courses",'university_courses.Ucourse_id=college_courses.Clgecourse_univcourseid');
		$this->db->join("$db4.university",'university.Univ_id=university_courses.Ucourse_universityid','left');
		$this->db->join("$db4.courses",'courses.Course_id =university_courses.Ucourse_courseid'); 
		/*for ($i=0; $i<$count_array; $i++) 
		{ 
			$this->db->or_where('Clge_name like "%'.$keyword_new[$i].'%"');  
			$this->db->or_where('Clge_city like "%'.$keyword_new[$i].'%"');  
			$this->db->or_where('Course_name like "%'.$keyword_new[$i].'%"');   	
		} */
			$this->db->or_where('(Clge_city like "%'.$search_keyword.'%"');
			$this->db->or_where('Clge_name like "%'.$search_keyword.'%"');
			$this->db->or_where('Course_name like "%'.$search_keyword.'%"');
			$this->db->or_where('Course_short_name like "%'.$search_keyword.'%")');
		if(isset($_GET["univid"]))
		{
			$this->db->where("Ucourse_universityid",$this->input->get("univid"));
		}	
		if(isset($_GET["cty"]))
		{
			$this->db->where("Clge_city",$this->input->get("cty"));
		}	     
		//$this->db->limit(10,$start_from);
		$this->db->limit(10);
		$this->db->group_by("Clge_name");
		$query_search_college_or_course=$this->db->get(); 
		return $query_search_college_or_course->result_array();
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
		$this->db->select("Univ_id,Univ_name,COUNT(distinct Clge_id) as total_college");
		$this->db->from("$db3.college");
		$this->db->join("$db3.college_details",'college_details.CDetails_clgeid =college.Clge_id');
		$this->db->join("$db3.college_type",'college_type.Ctype_id =college.Clge_type_id'); 
		$this->db->join("$db2.country",'country.Cntry_id =college.Clge_country_id'); 
		$this->db->join("$db3.college_courses",'college_courses.Clgecourse_college_id=college.Clge_id');
		$this->db->join("$db4.university_courses",'university_courses.Ucourse_id=college_courses.Clgecourse_univcourseid');
		$this->db->join("$db4.courses",'courses.Course_id =university_courses.Ucourse_courseid'); 
		$this->db->join("$db4.university",'university.Univ_id =university_courses.Ucourse_universityid'); 
		/*for ($i=0; $i<$count_array; $i++) 
		{ 
			$this->db->or_where('Clge_name like "%'.$keyword_new[$i].'%"');  
			$this->db->or_where('Clge_city like "%'.$keyword_new[$i].'%"');  
			$this->db->or_where('Course_name like "%'.$keyword_new[$i].'%"');   	
		} */
		$this->db->or_where('(Clge_city like "%'.$search_keyword.'%"');
		$this->db->or_where('Clge_name like "%'.$search_keyword.'%"');
		$this->db->or_where('Course_name like "%'.$search_keyword.'%"');
		$this->db->or_where('Course_short_name like "%'.$search_keyword.'%")');
		if(isset($_GET["cty"]))
		{
			$this->db->where("Clge_city",$this->input->get("cty"));
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
		$this->db->select("college.Clge_city,COUNT(distinct Clge_id) as total_college");
		$this->db->from("$db3.college");
		$this->db->join("$db3.college_details",'college_details.CDetails_clgeid =college.Clge_id');
		$this->db->join("$db3.college_type",'college_type.Ctype_id =college.Clge_type_id'); 
		$this->db->join("$db2.country",'country.Cntry_id =college.Clge_country_id'); 
		$this->db->join("$db3.college_courses",'college_courses.Clgecourse_college_id=college.Clge_id');
		$this->db->join("$db4.university_courses",'university_courses.Ucourse_id=college_courses.Clgecourse_univcourseid');
		$this->db->join("$db4.courses",'courses.Course_id =university_courses.Ucourse_courseid'); 
		/*for ($i=0; $i<$count_array; $i++) 
		{ 
			$this->db->or_where('Clge_name like "%'.$keyword_new[$i].'%"');  
			$this->db->or_where('Clge_city like "%'.$keyword_new[$i].'%"');  
			$this->db->or_where('Course_name like "%'.$keyword_new[$i].'%"');   	
		} */
		$this->db->or_where('(Clge_city like "%'.$search_keyword.'%"');
		$this->db->or_where('Clge_name like "%'.$search_keyword.'%"');
		$this->db->or_where('Course_name like "%'.$search_keyword.'%"');
		$this->db->or_where('Course_short_name like "%'.$search_keyword.'%")');
		if(isset($_GET["univid"]))
		{
			$this->db->where("Ucourse_universityid",$this->input->get("univid"));
		}	 
		$this->db->order_by("Clge_city","ASC");
		$this->db->group_by("Clge_city"); 
		$query_list_city=$this->db->get(); 
		return $query_list_city->result_array();
	}
	public function list_category_model($search_keyword)
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
		$this->db->select("Cfaculty_id,Cfaculty_name,COUNT(distinct Clge_id) as total_college");
		$this->db->from("$db3.college");
		$this->db->join("$db3.college_details",'college_details.CDetails_clgeid =college.Clge_id');
		$this->db->join("$db3.college_type",'college_type.Ctype_id =college.Clge_type_id'); 
		$this->db->join("$db2.country",'country.Cntry_id =college.Clge_country_id'); 
		$this->db->join("$db3.college_courses",'college_courses.Clgecourse_college_id=college.Clge_id');
		$this->db->join("$db3.college_faculty",'college_faculty.Cfaculty_id=college_courses.Clgecourse_facultyid');
		$this->db->join("$db4.university_courses",'university_courses.Ucourse_id=college_courses.Clgecourse_univcourseid');
		$this->db->join("$db4.courses",'courses.Course_id =university_courses.Ucourse_courseid'); 
		$this->db->join("$db4.university",'university.Univ_id =university_courses.Ucourse_universityid');  
		/*for ($i=0; $i<$count_array; $i++) 
		{ 
			$this->db->or_where('Clge_name like "%'.$keyword_new[$i].'%"');  
			$this->db->or_where('Clge_city like "%'.$keyword_new[$i].'%"');  
			$this->db->or_where('Course_name like "%'.$keyword_new[$i].'%"');   	
		} */
		$this->db->or_where('(Clge_city like "%'.$search_keyword.'%"');
		$this->db->or_where('Clge_name like "%'.$search_keyword.'%"');
		$this->db->or_where('Course_name like "%'.$search_keyword.'%"');
		$this->db->or_where('Course_short_name like "%'.$search_keyword.'%")');
		if(isset($_GET["univid"]) or isset($_GET["cty"]))
		{
			$this->db->where("Ucourse_universityid",$this->input->get("univid"));
			$this->db->or_where("Clge_city",$this->input->get("cty"));

		}	 
		$this->db->order_by("Cfaculty_name","ASC");
		$this->db->group_by("Cfaculty_name"); 
		$query_list_faculty=$this->db->get(); 
		return $query_list_faculty->result_array();
	}
	public function view_college_details_model($Clge_id,$Clge_name)	
	{
		$db3=$this->load->database("db3",true);
		$db3=$db3->database;
		$db4=$this->load->database("db4",true);
		$db4=$db4->database;
		$db2=$this->load->database("db2",true);
		$db2=$db2->database;
		$this->db->select("*,COUNT(Clge_id) as count");
		$this->db->from("$db3.college");
		$this->db->join("$db3.college_details",'college_details.CDetails_clgeid =college.Clge_id');
		$this->db->join("$db3.college_type",'college_type.Ctype_id =college.Clge_type_id','left'); 
		$this->db->join("$db2.country",'country.Cntry_id =college.Clge_country_id','left');
		$this->db->join("$db2.zone",'zone.Zon_id=college.Clge_zone_id','left');
		$this->db->join("$db2.district",'district.Dist_id =college.Clge_district_id','left'); 
		$this->db->join("$db3.college_universities","college_universities.Clge_univ_college_id=college.Clge_id",'left');
		$this->db->join("$db4.university","university.Univ_id=college_universities.Clge_univ_university_id",'left');
		$this->db->where("Clge_id",$Clge_id); 
		$query_college_details=$this->db->get(); 
		return $query_college_details->result_array();
	}
	public function view_college_course_model($Clge_id,$Clge_name)
	{
		$db3=$this->load->database("db3",true);
		$db3=$db3->database;
		$db4=$this->load->database("db4",true);
		$db4=$db4->database;
		$this->db->select("Course_logo,Clgecourse_id,Course_name,Course_short_name,Clgecourse_fee,Clgecourse_req_exam,Clgecourse_morning_shift,Clgecourse_morning_time,Clgecourse_day_shift,Clgecourse_day_time,Clgecourse_evening_shift,Clgecourse_evening_time,Clgecourse_duration,Clgecourse_syllabustype,Univ_name");
		$this->db->from("$db3.college_courses"); 
		$this->db->join("$db4.university_courses",'university_courses.Ucourse_id =college_courses.Clgecourse_univcourseid','left'); 
		$this->db->join("$db4.courses",'courses.Course_id =university_courses.Ucourse_courseid','left'); 
		$this->db->join("$db4.university",'university.Univ_id =university_courses.Ucourse_universityid','left');   
		$this->db->where("Clgecourse_college_id",$Clge_id);
		$this->db->where("Clgecourse_status",1);
		$query_college_course_details=$this->db->get(); 
		return $query_college_course_details->result_array();
		
	}
	public function individual_college_course_model($Clgecourse_id,$Course_name)
	{
		$db2=$this->load->database("db2",true);
		$db2=$db2->database;
		$db3=$this->load->database("db3",true);
		$db3=$db3->database;
		$db4=$this->load->database("db4",true);
		$db4=$db4->database;
		$this->db->select("*,COUNT(Clgecourse_id) count");
		$this->db->from("$db3.college_courses");
		$this->db->join("$db3.college",'college.Clge_id =college_courses.Clgecourse_college_id'); 
		$this->db->join("$db2.country",'country.Cntry_id =college.Clge_country_id','left');
		$this->db->join("$db4.university_courses",'university_courses.Ucourse_id =college_courses.Clgecourse_univcourseid'); 
		$this->db->join("$db4.courses",'courses.Course_id =university_courses.Ucourse_courseid');   
		$this->db->join("$db4.courses_type",'courses_type.Course_type_id =courses.Course_ctype_id');    
		$this->db->join("$db4.university",'university.Univ_id =university_courses.Ucourse_universityid','left');   
		$this->db->where("Clgecourse_id",$Clgecourse_id);
		$this->db->where("Clgecourse_status",1);
		$query_individual_college_course=$this->db->get(); 
		return $query_individual_college_course->result_array();
		
	}
	public function list_college_university_model()
	{ 
		$db3=$this->load->database("db3",true);
		$db3=$db3->database;
		$this->db->select('*,COUNT(Clge_id) as total_affiliated_college');
		$this->db->from("$db3.college_universities");
		$this->db->join("$db3.college",'college.Clge_id =college_universities.Clge_univ_college_id');
		$this->db->group_by("Clge_univ_university_id");
		$query_affiliated_college=$this->db->get();
		return $query_affiliated_college->result_array();
	}
	public function list_album_model($CPalbum_clgeid)
	{ 
		$db3=$this->load->database("db3",true);
		$db3=$db3->database;
		$this->db->select('*,COUNT(CPgallery_id) as count');
		$this->db->from("$db3.college_photos_album");
		$this->db->join("$db3.college_photos_gallery",'college_photos_gallery.CPgallery_calbumid =college_photos_album.CPalbum_id');
		$this->db->order_by("CPalbum_regdate","DESC"); 
		$this->db->group_by("CPalbum_id"); 
		$this->db->where("CPalbum_clgeid",$CPalbum_clgeid);
		$query_list_album=$this->db->get();
		return $query_list_album->result_array();
	} 
	public function list_gallery_image_model($CPgallery_clgeid)
	{ 
		$db3=$this->load->database("db3",true);
		$db3=$db3->database;
		$this->db->select('*');
		$this->db->from("$db3.college_photos_gallery"); 
		$this->db->order_by("CPgallery_regdate","DESC");   
		$this->db->where("CPgallery_clgeid",$CPgallery_clgeid);
		$this->db->limit(9);
		$query_list_gallery_image=$this->db->get();
		return $query_list_gallery_image->result_array();
	} 
	public function count_gallery_image_model($CPgallery_clgeid)
	{ 
		$db3=$this->load->database("db3",true);
		$db3=$db3->database;
		$this->db->select('count(*) as count');
		$this->db->from("$db3.college_photos_gallery");    
		$this->db->where("CPgallery_clgeid",$CPgallery_clgeid);
		$query_count_gallery_image=$this->db->get();
		return $query_count_gallery_image->result_array();
	} 	
	public function do_add_keyword_model($userid)
	{
		$db2=$this->load->database("db2",true);
		$db2=$db2->database;
		$ip=$this->input->ip_address();	
		$this->db->where("Popular_search_name",trim($this->input->get("qry")));
		$this->db->where("Popular_search_userid",$userid);
		$Popular_search_data=$this->db->get("$db2.popular_search");
		$result_Popular_search=$Popular_search_data->row();
		@$Popular_search_name=$result_Popular_search->Popular_search_name;
		@$Popular_search_userid=$result_Popular_search->Popular_search_userid;
		if($Popular_search_name!=$this->input->get("qry"))
		{ 	
			$data=array(
			'Popular_search_name' => $this->input->get("qry"),
			'Popular_search_userid' => $userid,
			'Popular_search_UIP' => $ip,
			'Popular_search_count' => 1
			);
			if($this->db->insert("$db2.popular_search",$data))
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
			$Popular_searchid_count_no=$result_Popular_search->Popular_search_count;
			$data=array(
			'Popular_search_count' => $Popular_searchid_count_no + 1 ,
			'Popular_search_UIP' => $ip
			);
			$this->db->where("Popular_search_name",trim($this->input->get("qry")));
			$this->db->where("Popular_search_userid",$userid);
			if($this->db->update("$db2.popular_search",$data))
			{
				return true;
			}
			else
			{
				return false;
			}
		}	
	}
	public function do_general_enquiryAjax_model($Cenq_regdate,$Cenq_fstname,$Cenq_lstname,$Cenq_email,$Cenq_contactno,$Cenq_enquirytypeid,$Cenq_clgecourseid,$Cenq_clgeid,$Cenq_enquiry_statusid,$CEcmntsced_usercomment)
	{
		$db8=$this->load->database("db8",true);
		$db8=$db8->database;
		$data=array(
			"Cenq_fstname" => trim($Cenq_fstname),
			"Cenq_lstname" => trim($Cenq_lstname),
			"Cenq_email" => trim($Cenq_email),
			"Cenq_contactno" => trim($Cenq_contactno),
			"Cenq_enquirytypeid" => trim($Cenq_enquirytypeid), 
			"Cenq_clgecourseid" => trim($Cenq_clgecourseid), 
			"Cenq_userid" => $this->session->userdata("myid"),
			"Cenq_clgeid" => $Cenq_clgeid,
			"Cenq_enquiry_statusid" => $Cenq_enquiry_statusid,
			"Cenq_regdate" => $Cenq_regdate
		);
		if($this->db->insert("$db8.college_enquiry",$data))
		{
			$this->db->where("Cenq_email",trim($Cenq_email));
			$this->db->where("Cenq_enquirytypeid",trim($Cenq_enquirytypeid));
			$this->db->where("Cenq_regdate",$Cenq_regdate);
			$query_getenquiryid=$this->db->get("$db8.college_enquiry");
			$row_getenquiryid=$query_getenquiryid->row();
			$data_comment=array(
				"CEcmntsced_enquiryid" => $row_getenquiryid->Cenq_id,
				"CEcmntsced_usercomment" => $CEcmntsced_usercomment, 
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
	/*public function check_duplicate_admission_enquiry_model($Cenq_email,$Cenq_clgecourseid)
	{
		$db8=$this->load->database("db8",true);
		$db8=$db8->database;
		$this->db->where("Cenq_email",trim($Cenq_email));
		$this->db->where("Cenq_clgecourseid",$Cenq_clgecourseid);
		$this->db->where("Cenq_clgeid",$this->userdata->post("Cenq_clgeid"));
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
	}*/
	/* Model function to check duplicate College Courses */
	public function check_duplicate_course_model($Cenq_clgecourseid,$Cenq_clgeid)
	{
		$db8=$this->load->database("db8",true);
		$db8=$db8->database;
		$this->db->where("Cenq_clgecourseid",$Cenq_clgecourseid);
		$this->db->where("Cenq_clgeid",$Cenq_clgeid);
		$query_duplicate_courseEnquiry=$this->db->get("$db8.college_enquiry");
		if($query_duplicate_courseEnquiry->num_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function check_duplicate_request_model($Clge_add_email,$Clge_add_clgeid)
	{
		$db3=$this->load->database("db3",true);
		$db3=$db3->database;
		$this->db->where("Clge_add_email",trim($Clge_add_email));
		$this->db->where("Clge_add_clgeid",trim($Clge_add_clgeid));
		$query_duplicate_request=$this->db->get("$db3.college_add_request");
		if($query_duplicate_request->num_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function do_add_request_model($Clge_add_name,$Clge_add_email,$Clge_add_phone,$Clge_add_clgeid)
	{
		$data=array(
			"Clge_add_name" => trim($this->input->post("Clge_add_name")),
			"Clge_add_email" => trim($this->input->post("Clge_add_email")),
			"Clge_add_phone" => trim($this->input->post("Clge_add_phone")),
			"Clge_add_clgeid" => trim($this->input->post("Clge_add_clgeid")),
			"Clge_add_status" => 0
		);
		$db3=$this->load->database("db3",true);
		$db3=$db3->database;
		$query_add_college_request=$this->db->insert("$db3.college_add_request",$data);
		if($query_add_college_request)
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