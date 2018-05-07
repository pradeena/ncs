<?php 
defined("BASEPATH") OR exit("No Direct Script Allowed");
class Admission_form_model extends CI_Model
{  
	public function medical_details_model()
	{
		$db8=$this->load->database("db8",true);
		$db8=$db8->database;   
		$this->db->select("*,COUNT(*) as count");
		$this->db->where("CEmedicalcondition_enquiryid",$this->input->get("myid"));
		$this->db->from("$db8.college_enquiry_medicalcondition");
		$query_medical_details=$this->db->get();
		return $query_medical_details->result_array();
	}
	public function purpose_details_model()
	{
		$db8=$this->load->database("db8",true);
		$db8=$db8->database;   
		$this->db->select("*,COUNT(*) as count");
		$this->db->where("CEpurpose_enquiryid",$this->input->get("myid"));
		$this->db->from("$db8.college_enquiry_purpose");
		$query_purpose_details=$this->db->get();
		return $query_purpose_details->result_array();
	}
	public function activities_details_model()
	{
		$db8=$this->load->database("db8",true);
		$db8=$db8->database;   
		$this->db->select("*,COUNT(*) as count");
		$this->db->where("CEaward_enquiryid",$this->input->get("myid"));
		$this->db->from("$db8.college_enquiry_award&achievement");
		$query_activities_details=$this->db->get();
		return $query_activities_details->result_array();
	}
	public function list_all_refrences_model()
	{
		$db8=$this->load->database("db8",true);
		$db8=$db8->database;   
		$this->db->from("$db8.college_enquiry_referredby");
		$this->db->where("CEreferredby_enquiryid",$this->input->get("myid"));
		$this->db->order_by("CEreferredby_regdate",'DESC');
		$query_list_all_refrences=$this->db->get();
		return $query_list_all_refrences->result_array();
	}
	public function list_all_employment_model()
	{
		$db8=$this->load->database("db8",true);
		$db8=$db8->database;   
		$this->db->from("$db8.college_enquiry_employment");
		$this->db->where("CEemployment_enquiryid",$this->input->get("myid"));
		$this->db->order_by("CEemployment_regdate",'DESC');
		$query_list_all_employment=$this->db->get();
		return $query_list_all_employment->result_array();
	}
	public function list_totalworkexperience_model()
	{
		$db8=$this->load->database("db8",true);
		$db8=$db8->database;   
		$this->db->select("*,COUNT(*) as count");
		$this->db->where("CETWexperience_enquiryid",$this->input->get("myid"));
		$this->db->from("$db8.college_enquiry_totalwork_experience");
		$query_totalworkexperience=$this->db->get();
		return $query_totalworkexperience->result_array();
	}
	public function list_checkpreviouseducation_model()
	{
		$db8=$this->load->database("db8",true);
		$db8=$db8->database;  
		$this->db->select("*,COUNT(*) as count"); 
		$this->db->from("$db8.users_previous_qualification");
		$this->db->where("UPQ_enquiryid",$this->input->get("myid")); 
		$this->db->where("UPQ_prev_clgeaddress",''); 
		$this->db->where("UPQ_prev_clgeuniversity",''); 
		$query_checkpreviouseducation=$this->db->get();
		return $query_checkpreviouseducation->result_array();
	}
	public function list_previouseducation_model()
	{
		$db4=$this->load->database("db4",true);
		$db4=$db4->database;  
		$db8=$this->load->database("db8",true);
		$db8=$db8->database;   
		$this->db->from("$db8.users_previous_qualification");
		$this->db->join("$db4.courses_type",'courses_type.Course_type_id=users_previous_qualification.UPQ_prev_ctypeid');
		$this->db->where("UPQ_enquiryid",$this->input->get("myid"));   
		$query_previouseducation=$this->db->get();
		return $query_previouseducation->result_array();
	}
	public function list_all_family_model()
	{
		$db8=$this->load->database("db8",true);
		$db8=$db8->database;   
		$this->db->from("$db8.college_enquiry_family");
		$this->db->where("CEfamily_enquiryid",$this->input->get("myid"));
		$this->db->order_by("CEfamily_regdate",'DESC');
		$query_list_all_family=$this->db->get();
		return $query_list_all_family->result_array();
	}
	public function list_all_currentAddress_model()
	{
		$db8=$this->load->database("db8",true);
		$db8=$db8->database;  
		$this->db->select("*,COUNT(*) as count"); 
		$this->db->from("$db8.college_enquiry_address");
		$this->db->where("CEaddress_enquiryid",$this->input->get("myid")); 
		$this->db->where("CEaddress_addresstypeid",1); 
		$query_list_all_currentAddress=$this->db->get();
		return $query_list_all_currentAddress->result_array();
	}
	public function list_all_permanentAddress_model()
	{
		$db8=$this->load->database("db8",true);
		$db8=$db8->database;  
		$this->db->select("*,COUNT(*) as count"); 
		$this->db->from("$db8.college_enquiry_address");
		$this->db->where("CEaddress_enquiryid",$this->input->get("myid")); 
		$this->db->where("CEaddress_addresstypeid",2); 
		$query_list_all_permanentAddress=$this->db->get();
		return $query_list_all_permanentAddress->result_array();
	}
	public function personal_details_model()
	{
		$db8=$this->load->database("db8",true);
		$db8=$db8->database;  
		$this->db->select("*,COUNT(*) as count");
		$this->db->from("$db8.college_enquiry");
		$this->db->where("Cenq_userid",$this->session->userdata("myid"));
		$this->db->where("Cenq_enquiry_statusid",3);
		$this->db->where("Cenq_id",$this->input->get("myid"));
		$query_personal_details=$this->db->get();
		return $query_personal_details->result_array();
	}
	public function Addupdate_medical_detail_model($CEmedicalcondition_enquiryid,$CEmedicalcondition_bgid,$CEmedicalcondition_details)
	{
		$db8=$this->load->database("db8",true);
		$db8=$db8->database;
		$this->db->where("CEmedicalcondition_enquiryid",$CEmedicalcondition_enquiryid);
		$query_duplicate_medical_details=$this->db->get("$db8.college_enquiry_medicalcondition");
		if($query_duplicate_medical_details->num_rows() > 0)
		{
			$data=array(
				"CEmedicalcondition_bgid" => $CEmedicalcondition_bgid,
				"CEmedicalcondition_details" => $CEmedicalcondition_details,
			);
			$this->db->where("CEmedicalcondition_enquiryid",$CEmedicalcondition_enquiryid);
			if($this->db->update("$db8.college_enquiry_medicalcondition",$data))
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
			$data=array(
				"CEmedicalcondition_enquiryid" => $CEmedicalcondition_enquiryid,
				"CEmedicalcondition_bgid" => $CEmedicalcondition_bgid,
				"CEmedicalcondition_details" => $CEmedicalcondition_details,
			); 
			if($this->db->insert("$db8.college_enquiry_medicalcondition",$data))
			{
				return true;
			}
			else
			{
				return false;
			}
		}			
	}
	public function Addupdate_purpose_model($CEpurpose_enquiryid,$CEpurpose_details)
	{
		$db8=$this->load->database("db8",true);
		$db8=$db8->database;
		$this->db->where("CEpurpose_enquiryid",$CEpurpose_enquiryid);
		$query_duplicate_purpose_details=$this->db->get("$db8.college_enquiry_purpose");
		if($query_duplicate_purpose_details->num_rows() > 0)
		{
			$data=array( 
				"CEpurpose_details" => $CEpurpose_details
			);
			$this->db->where("CEpurpose_enquiryid",$CEpurpose_enquiryid);
			if($this->db->update("$db8.college_enquiry_purpose",$data))
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
			$data=array(
				"CEpurpose_enquiryid" => $CEpurpose_enquiryid, 
				"CEpurpose_details" => $CEpurpose_details,
			); 
			if($this->db->insert("$db8.college_enquiry_purpose",$data))
			{
				return true;
			}
			else
			{
				return false;
			}
		}		
	}
	public function Addupdate_activity_model($CEaward_enquiryid,$CEaward_details)
	{
		$db8=$this->load->database("db8",true);
		$db8=$db8->database;
		$this->db->where("CEaward_enquiryid",$CEaward_enquiryid);
		$query_duplicate_activity_details=$this->db->get("$db8.college_enquiry_award&achievement");
		if($query_duplicate_activity_details->num_rows() > 0)
		{
			$data=array( 
				"CEaward_details" => $CEaward_details
			);
			$this->db->where("CEaward_enquiryid",$CEaward_enquiryid);
			if($this->db->update("$db8.college_enquiry_award&achievement",$data))
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
			$data=array(
				"CEaward_enquiryid" => $CEaward_enquiryid, 
				"CEaward_details" => $CEaward_details,
			); 
			if($this->db->insert("$db8.college_enquiry_award&achievement",$data))
			{
				return true;
			}
			else
			{
				return false;
			}
		}	
	}
	public function update_personal_detail_model($realfile)
	{
		$db1=$this->load->database("db1",true);
		$db1=$db1->database; 
		$db8=$this->load->database("db8",true);
		$db8=$db8->database;     
		$data=array(
			"Cenq_fstname" => trim($this->input->post("Cenq_fstname")),
			"Cenq_lstname" => $this->input->post("Cenq_lstname"),
			"Cenq_dob_bs" => $this->input->post("Cenq_dob_bs"),
			"Cenq_dob_ad" => $this->input->post("Cenq_dob_ad"),
			"Cenq_gender" => $this->input->post("Cenq_gender"),
			"Cenq_birth_place" => $this->input->post("Cenq_birth_place"),
			"Cenq_nationality" => $this->input->post("Cenq_nationality"),
			"Cenq_contactno" => $this->input->post("Cenq_contactno"),
			"Cenq_profilepic" => $realfile,
		); 
		$this->db->where("Cenq_id",$this->input->get("myid")); 
		if($this->db->update("$db8.college_enquiry",$data))
		{
			$data_user=array(
			"User_fstname" => trim($this->input->post("Cenq_fstname")),
			"User_lstname" => $this->input->post("Cenq_lstname"), 
			"User_mobileno" => $this->input->post("Cenq_contactno"),
			"User_gender" => $this->input->post("Cenq_gender"), 
			"User_profile_pic" => $realfile,
			);
			$this->db->where("User_id",$this->input->post("User_id"));  
			if($this->db->update("$db1.users",$data_user))
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
	public function add_reference_model($CEreferredby_enquiryid,$CEreferredby_name,$CEreferredby_occupation,$CEreferredby_organization,$CEreferredby_relation,$CEreferredby_address,$CEreferredby_phoneno,$CEreferredby_mobileno)
	{
		
		$db8=$this->load->database("db8",true);
		$db8=$db8->database;
		$data=array(
			"CEreferredby_enquiryid" => $CEreferredby_enquiryid,
			"CEreferredby_name" => $CEreferredby_name,
			"CEreferredby_occupation" => $CEreferredby_occupation,
			"CEreferredby_relation" => $CEreferredby_relation,
			"CEreferredby_organization" => $CEreferredby_organization,
			"CEreferredby_address" => $CEreferredby_address,
			"CEreferredby_phoneno" => $CEreferredby_phoneno,
			"CEreferredby_mobileno" => $CEreferredby_mobileno,
		);
		if($this->db->insert("$db8.college_enquiry_referredby",$data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function update_reference_model($CEreferredby_id,$CEreferredby_name,$CEreferredby_occupation,$CEreferredby_organization,$CEreferredby_relation,$CEreferredby_address,$CEreferredby_phoneno,$CEreferredby_mobileno)
	{
		
		$db8=$this->load->database("db8",true);
		$db8=$db8->database;
		$data=array( 
			"CEreferredby_name" => $CEreferredby_name,
			"CEreferredby_occupation" => $CEreferredby_occupation,
			"CEreferredby_relation" => $CEreferredby_relation,
			"CEreferredby_organization" => $CEreferredby_organization,
			"CEreferredby_address" => $CEreferredby_address,
			"CEreferredby_phoneno" => $CEreferredby_phoneno,
			"CEreferredby_mobileno" => $CEreferredby_mobileno,
		);
		$this->db->where("CEreferredby_id",$CEreferredby_id);
		if($this->db->update("$db8.college_enquiry_referredby",$data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function add_employment_model($CEemployment_enquiryid,$CEemployment_organization,$CEemployment_address,$CEemployment_contactno,$CEemployment_designation,$CEemployment_keyrole,$CEemployment_duration,$CEemployment_fromyr,$CEemployment_toyr)
	{
		$db8=$this->load->database("db8",true);
		$db8=$db8->database;
		$data=array(
			"CEemployment_enquiryid" => $CEemployment_enquiryid,
			"CEemployment_organization" => $CEemployment_organization,
			"CEemployment_address" => $CEemployment_address,
			"CEemployment_contactno" => $CEemployment_contactno,
			"CEemployment_designation" => $CEemployment_designation,
			"CEemployment_keyrole" => $CEemployment_keyrole,
			"CEemployment_duration" => $CEemployment_duration,
			"CEemployment_fromyr" => $CEemployment_fromyr,
			"CEemployment_toyr" => $CEemployment_toyr,
		);
		if($this->db->insert("$db8.college_enquiry_employment",$data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function add_update_totalexp_model($CETWexperience_enquiryid,$CETWexperience_total)
	{
		$db8=$this->load->database("db8",true);
		$db8=$db8->database;
		$this->db->where("CETWexperience_enquiryid",$CETWexperience_enquiryid);
		$query_duplicateworkexp=$this->db->get("$db8.college_enquiry_totalwork_experience");
		if($query_duplicateworkexp->num_rows() > 0)
		{
			$data_update=array(
				"CETWexperience_total" => $CETWexperience_total
			);
			$this->db->where("CETWexperience_enquiryid",$CETWexperience_enquiryid);
			if($this->db->update("$db8.college_enquiry_totalwork_experience",$data_update))
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
			$data_add=array(
				"CETWexperience_enquiryid" => $CETWexperience_enquiryid,
				"CETWexperience_total" => $CETWexperience_total
			); 
			if($this->db->insert("$db8.college_enquiry_totalwork_experience",$data_add))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
	public function update_employment_model($CEemployment_id,$CEemployment_organization,$CEemployment_address,$CEemployment_contactno,$CEemployment_designation,$CEemployment_keyrole,$CEemployment_duration,$CEemployment_fromyr,$CEemployment_toyr)
	{
		$db8=$this->load->database("db8",true);
		$db8=$db8->database;
		$data=array( 
			"CEemployment_organization" => $CEemployment_organization,
			"CEemployment_address" => $CEemployment_address,
			"CEemployment_contactno" => $CEemployment_contactno,
			"CEemployment_designation" => $CEemployment_designation,
			"CEemployment_keyrole" => $CEemployment_keyrole,
			"CEemployment_duration" => $CEemployment_duration,
			"CEemployment_fromyr" => $CEemployment_fromyr,
			"CEemployment_toyr" => $CEemployment_toyr,
		);
		$this->db->where("CEemployment_id",$CEemployment_id);
		if($this->db->update("$db8.college_enquiry_employment",$data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function update_eductaion_model($UPQ_id,$UPQ_prev_course,$UPQ_prev_ctypeid,$UPQ_prev_marks,$UPQ_prev_clgename,$UPQ_prev_clgeaddress,$UPQ_prev_clgeuniversity,$UPQ_prev_yearofcompletion)
	{
		$db8=$this->load->database("db8",true);
		$db8=$db8->database;
		$data=array(
			"UPQ_prev_course" => $UPQ_prev_course,
			"UPQ_prev_ctypeid" => $UPQ_prev_ctypeid,
			"UPQ_prev_marks" => $UPQ_prev_marks,
			"UPQ_prev_clgename" => $UPQ_prev_clgename,
			"UPQ_prev_clgeaddress" => $UPQ_prev_clgeaddress,
			"UPQ_prev_clgeuniversity" => $UPQ_prev_clgeuniversity,
			"UPQ_prev_yearofcompletion" => $UPQ_prev_yearofcompletion, 
		);
		$this->db->where("UPQ_id",$UPQ_id);
		if($this->db->update("$db8.users_previous_qualification",$data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function upload_files_model($realfile)
	{
		$db8=$this->load->database("db8",true);
		$db8=$db8->database;
		$data=array(
			"UPQfiles_qualificationid" => $this->input->post("UPQfiles_qualificationid"),
			"UPQfiles_name" => $realfile
		);
		if($this->db->insert("$db8.users_previous_qualification_files",$data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function add_eductaion_model($UPQ_enquiryid,$UPQ_prev_course,$UPQ_prev_ctypeid,$UPQ_prev_marks,$UPQ_prev_clgename,$UPQ_prev_clgeaddress,$UPQ_prev_clgeuniversity,$UPQ_prev_yearofcompletion)
	{
		$db8=$this->load->database("db8",true);
		$db8=$db8->database;
		$data=array(
			"UPQ_enquiryid" => $UPQ_enquiryid,
			"UPQ_prev_course" => $UPQ_prev_course,
			"UPQ_prev_ctypeid" => $UPQ_prev_ctypeid,
			"UPQ_prev_marks" => $UPQ_prev_marks,
			"UPQ_prev_clgename" => $UPQ_prev_clgename,
			"UPQ_prev_clgeaddress" => $UPQ_prev_clgeaddress,
			"UPQ_prev_clgeuniversity" => $UPQ_prev_clgeuniversity,
			"UPQ_prev_yearofcompletion" => $UPQ_prev_yearofcompletion, 
		); 
		if($this->db->insert("$db8.users_previous_qualification",$data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function add_family_model($CEfamily_enquiryid,$CEfamily_familytypeid,$CEfamily_fstname,$CEfamily_lstname,$CEfamily_occupation,$CEfamily_nationality,$CEfamily_phoneno,$CEfamily_mobileno)
	{
		$db8=$this->load->database("db8",true);
		$db8=$db8->database;
		$data=array(
			"CEfamily_enquiryid" => $CEfamily_enquiryid,
			"CEfamily_familytypeid" => $CEfamily_familytypeid,
			"CEfamily_fstname" => $CEfamily_fstname,
			"CEfamily_lstname" => $CEfamily_lstname,
			"CEfamily_occupation" => $CEfamily_occupation,
			"CEfamily_nationality" => $CEfamily_nationality,
			"CEfamily_phoneno" => $CEfamily_phoneno,
			"CEfamily_mobileno" => $CEfamily_mobileno, 
		);
		if($this->db->insert("$db8.college_enquiry_family",$data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function update_family_model($CEfamily_id,$CEfamily_familytypeid,$CEfamily_fstname,$CEfamily_lstname,$CEfamily_occupation,$CEfamily_nationality,$CEfamily_phoneno,$CEfamily_mobileno)
	{
		$db8=$this->load->database("db8",true);
		$db8=$db8->database;
		$data=array( 
			"CEfamily_familytypeid" => $CEfamily_familytypeid,
			"CEfamily_fstname" => $CEfamily_fstname,
			"CEfamily_lstname" => $CEfamily_lstname,
			"CEfamily_occupation" => $CEfamily_occupation,
			"CEfamily_nationality" => $CEfamily_nationality,
			"CEfamily_phoneno" => $CEfamily_phoneno,
			"CEfamily_mobileno" => $CEfamily_mobileno, 
		);
		$this->db->where("CEfamily_id",$CEfamily_id);
		if($this->db->update("$db8.college_enquiry_family",$data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}  
	public function addupdate_Address_model($CEaddress_enquiryid,$CEaddress_addresstypeid,$CEaddress_phoneno,$CEaddress_mobileno,$CEaddress_houseno,$CEaddress_wardno,$CEaddress_town_village,$CEaddress_district,$CEaddress_zone,$CEaddress_country)
	{
		$db8=$this->load->database("db8",true);
		$db8=$db8->database;
		$this->db->where("CEaddress_enquiryid",$CEaddress_enquiryid);
		$this->db->where("CEaddress_addresstypeid",$CEaddress_addresstypeid);
		$query_duplicateAddress=$this->db->get("$db8.college_enquiry_address");
		if($query_duplicateAddress->num_rows() > 0)
		{
			$data_update=array(
				"CEaddress_phoneno" => $CEaddress_phoneno,
				"CEaddress_mobileno" => $CEaddress_mobileno,
				"CEaddress_houseno" => $CEaddress_houseno,
				"CEaddress_wardno" => $CEaddress_wardno,
				"CEaddress_town_village" => $CEaddress_town_village,
				"CEaddress_district" => $CEaddress_district,
				"CEaddress_zone" => $CEaddress_zone,
				"CEaddress_country" => $CEaddress_country,
			);
			$this->db->where("CEaddress_enquiryid",$CEaddress_enquiryid);
			$this->db->where("CEaddress_addresstypeid",$CEaddress_addresstypeid);
			if($this->db->update("$db8.college_enquiry_address",$data_update))
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
			$data_add=array(
				"CEaddress_enquiryid" => $CEaddress_enquiryid,
				"CEaddress_addresstypeid" => $CEaddress_addresstypeid,
				"CEaddress_phoneno" => $CEaddress_phoneno,
				"CEaddress_mobileno" => $CEaddress_mobileno,
				"CEaddress_houseno" => $CEaddress_houseno,
				"CEaddress_wardno" => $CEaddress_wardno,
				"CEaddress_town_village" => $CEaddress_town_village,
				"CEaddress_district" => $CEaddress_district,
				"CEaddress_zone" => $CEaddress_zone,
				"CEaddress_country" => $CEaddress_country,
			); 
			if($this->db->insert("$db8.college_enquiry_address",$data_add))
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