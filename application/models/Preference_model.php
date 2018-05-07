<?php
defined("BASEPATH") or exit("No Direct Script Allowed");
class Preference_model extends CI_Model
{ 
	public function setPreference($faculty,$university,$district)
	{
		$db2 = $this->load->database("db2",true);
		$db2 = $db2->database; 
		$this->db->where("pref_userid",$this->session->userdata("myid"));
		$qry = $this->db->get("$db2.user_search_preference");
		if($qry->num_rows() == 1){
			$data = array(  
				'pref_faculty' => $faculty, 
				'pref_university' => $university, 
				'pref_district' => $district, 
				'pref_modifiedon' => date('Y-m-d H:i:s'), 
			);
			$this->db->where("pref_userid",$this->session->userdata("myid"));
			$this->db->update("$db2.user_search_preference",$data);
			return "<b style='color:green'> Your preference is updated.</b>";
		} else {
			$data = array(
				'pref_userid' => $this->session->userdata("myid"), 
				'pref_faculty' => $faculty, 
				'pref_university' => $university, 
				'pref_district' => $district, 
			);
			$this->db->insert("$db2.user_search_preference",$data);
			return "<b style='color:green'> Your preference is set.</b>";;
		}
	}
}
