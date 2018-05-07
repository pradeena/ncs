<?php
defined("BASEPATH") or exit("No Direct Script Allowed");
class Home_model extends CI_Model
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
	/* model to show 15 colleges in home page */
	public function list_college_details_model()
	{ 
		$db2=$this->load->database("db2",true);
		$db2=$db2->database;
		$db3=$this->load->database("db3",true);
		$db3=$db3->database;
		$db4=$this->load->database("db4",true);
		$db4=$db4->database;
		$this->db->select("Clge_logo,Clge_id,Clge_name,Clge_city,Cntry_name,Ctype_name,Clge_district_id,Clgecourse_facultyid,Univ_id");
		$this->db->from("$db3.college");
		$this->db->join("$db3.college_type",'college_type.Ctype_id=college.Clge_type_id','left'); 
		$this->db->join("$db2.country",'country.Cntry_id=college.Clge_country_id','left'); 
		$this->db->from("$db3.college_courses","college_courses.Clgecourse_college_id = college.Clge_id",'left');
		$this->db->join("$db4.university_courses",'university_courses.Ucourse_id =college_courses.Clgecourse_univcourseid','left');
		$this->db->join("$db4.university",'university.Univ_id =university_courses.Ucourse_universityid','left');
		$this->db->where('Clge_status',1);
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
		$this->db->group_by("Clge_id");
		$this->db->order_by("Clge_id","RANDOM");
		$this->db->limit(0,10); 
		$query_result_college=$this->db->get(); 
		return $query_result_college->result_array();
		
	}
	/* model to show 15 courses in home page */
	public function list_course_model()
	{ 
		$db3=$this->load->database("db3",true);
		$db3=$db3->database;
		$db4=$this->load->database("db4",true);
		$db4=$db4->database;
		$this->db->select('Course_logo,Course_name,COUNT(Clgecourse_college_id) as total_instituation');
		$this->db->from("$db3.college_courses");
		$this->db->join("$db4.university_courses",'university_courses.Ucourse_id =college_courses.Clgecourse_univcourseid');
		$this->db->join("$db4.courses",'courses.Course_id =university_courses.Ucourse_courseid');
		if(!empty($this->faculty))
		{
			$this->db->where_in('Clgecourse_facultyid',$this->faculty); 
		} 
		$this->db->group_by("Course_id");
		$this->db->limit(15);
		$this->db->order_by("Course_id","RANDOM");
		$query_course=$this->db->get();
		return $query_course->result_array();
	}
	/* model to check duplicate subscriber for newsletter subscription  */
	public function check_duplicate_subscriber_model($SUB_email)
	{
		$db2=$this->load->database("db2",true);
		$db2=$db2->database;
		$this->db->select("SUB_id");
		$this->db->where("SUB_email",$SUB_email);
		$query_duplicate_subscriber=$this->db->get("$db2.subscribe_news_article_events");
		if($query_duplicate_subscriber->num_rows() > 0)
		{
			return true;
		}	
		else
		{
			return false;
		}
	} 
	/* model to Add subscribe for newsletter */
	public function do_add_subscribe_email_model($SUB_email)
	{
		$this->load->library('user_agent');
		$browser = $this->agent->browser();
		$browserVersion = $this->agent->version();
		$platform = $this->agent->platform();
		$ip=$this->input->ip_address();
		$browser_details='Browser Name:- '.$browser.' , version:- '.$browserVersion.' , plateform:- '.$platform.' , Ip:- '.$ip;
		$db2=$this->load->database("db2",true);
		$db2=$db2->database;
		$data_subscriber=array(
			"SUB_email" => $SUB_email,
			"SUB_browser_details" => $browser_details
		); 
		if($query_subscriber=$this->db->insert("$db2.subscribe_news_article_events",$data_subscriber))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function prefer_faculty_model($Cfaculty_id)
	{
			$db1=$this->load->database("db1",true);
			$db1=$db1->database;
			$this->db->where("Prefer_userid",$this->session->userdata("myid"));
			$query_faculty=$this->db->get("$db1.user_preference");
			//$result_faculty=$query_faculty->row();	
			//foreach($result_faculty as $row_faculty)
		if($query_faculty->num_rows() != 0)
		{
			$db1=$this->load->database("db1",true);
			$db1=$db1->database;
			$this->db->where("Prefer_userid",$this->session->userdata("myid"));
			$query_faculty=$this->db->get("$db1.user_preference");
			$result_faculty=$query_faculty->result_array();
			foreach($result_faculty as $row_faculty)
			{
				$check_available_faculty=$row_faculty["Prefer_facultyid"];
			}
			if($check_available_faculty==0)
			{	
			echo '<script type="text/javascript">alert("Press Ok To Save!");</script>';
						$update_faculty=array(
							"Prefer_facultyid" => $Cfaculty_id
						);
						$this->db->where("Prefer_userid",$this->session->userdata("myid"));
						$this->db->where("Prefer_facultyid",0);
						if($this->db->update("$db1.user_preference",$update_faculty))
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
				$Add_faculty_data=array(
					"Prefer_facultyid" => $Cfaculty_id, 
					"Prefer_userid" => $this->session->userdata("myid")
				); 
				if($this->db->insert("$db1.user_preference",$Add_faculty_data))
				{
					return true;
				}
				else
				{
					return false;
				}
				
			}
		}	
		else
		{
			$Add_faculty_data=array(
				"Prefer_facultyid" => $Cfaculty_id, 
				"Prefer_userid" => $this->session->userdata("myid")
			); 
			if($this->db->insert("$db1.user_preference",$Add_faculty_data))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
	public function prefer_course_model($Course_type_id)
	{
			//echo '<script type="text/javascript">alert("hello!");</script>';
			$db1=$this->load->database("db1",true);
			$db1=$db1->database;
			$this->db->where("Prefer_userid",$this->session->userdata("myid"));
			$query_course=$this->db->get("$db1.user_preference");
			//$result_faculty=$query_course->row();	
		if($query_course->num_rows() != 0)
		{
			$db1=$this->load->database("db1",true);
			$db1=$db1->database;
			$this->db->where("Prefer_userid",$this->session->userdata("myid"));
			$query_course=$this->db->get("$db1.user_preference");
			$result_course=$query_course->result_array();
			foreach($result_course as $row_course)
			{
				$check_available_course=$row_course["Prefer_courseid"];
			}
			if($check_available_course==0)
			{
			echo '<script type="text/javascript">alert("Press Ok To Save!");</script>';
					$update_course=array(
						"Prefer_courseid" => $Course_type_id
					);
					$this->db->where("Prefer_userid",$this->session->userdata("myid"));
					$this->db->where("Prefer_courseid",0);
					if($this->db->update("$db1.user_preference",$update_course))
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
				$Add_course_data=array(
					"Prefer_courseid" => $Course_type_id, 
					"Prefer_userid" => $this->session->userdata("myid")
				); 
				if($this->db->insert("$db1.user_preference",$Add_course_data))
				{
					return true;
				}
				else
				{
					return false;
				}
			}
		}	
		else
		{
			$Add_course_data=array(
				"Prefer_courseid" => $Course_type_id, 
				"Prefer_userid" => $this->session->userdata("myid")
			); 
			if($this->db->insert("$db1.user_preference",$Add_course_data))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
	public function prefer_city_model($Clge_city)
	{
			//echo '<script type="text/javascript">alert("hello!");</script>';
			$db1=$this->load->database("db1",true);
			$db1=$db1->database;
			$this->db->where("Prefer_userid",$this->session->userdata("myid"));
			$query_city=$this->db->get("$db1.user_preference");
			//$result_faculty=$query_course->row();	
		if($query_city->num_rows() != 0)
		{
			$db1=$this->load->database("db1",true);
			$db1=$db1->database;
			$this->db->where("Prefer_userid",$this->session->userdata("myid"));
			$query_city=$this->db->get("$db1.user_preference");
			$result_city=$query_city->result_array();
			foreach($result_city as $row_city)
			{
				$check_available_city=$row_city["Prefer_cityname"];
			}
			if($check_available_city=="")
			{
			echo '<script type="text/javascript">alert("Press Ok To Save!");</script>';
					$update_city=array(
						"Prefer_cityname" => $Clge_city
					);
					$this->db->where("Prefer_userid",$this->session->userdata("myid"));
					$this->db->where("Prefer_cityname",0);
					if($this->db->update("$db1.user_preference",$update_city))
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
				$Add_city_data=array(
					"Prefer_cityname" => $Clge_city, 
					"Prefer_userid" => $this->session->userdata("myid")
				); 
				if($this->db->insert("$db1.user_preference",$Add_city_data))
				{
					return true;
				}
				else
				{
					return false;
				}
			}
		}	
		else
		{
			$Add_city_data=array(
				"Prefer_cityname" => $Clge_city, 
				"Prefer_userid" => $this->session->userdata("myid")
			); 
			if($this->db->insert("$db1.user_preference",$Add_city_data))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
}
?>
	