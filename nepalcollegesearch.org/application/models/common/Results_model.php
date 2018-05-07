<?php
defined("BASEPATH") or exit("No Direct Script Allowed");
class Results_model extends CI_Model
{
	public function list_test_results_model()
	{ 
		$db9=$this->load->database("db9",true);
		$db9=$db9->database;
		$this->db->select("*");
		$this->db->from("$db9.users_test");
		$this->db->join("$db9.exam_schedule","exam_schedule.Eschedule_id=users_test.Utest_exmschedule_id");  
		$this->db->join("$db9.exam_results","exam_results.Eresult_usr_testid=users_test.Utest_id");  
		$this->db->join("$db9.exam_name","exam_name.Ename_id=exam_schedule.Eschedule_examnameid");  
		$this->db->join("$db9.exam_types","exam_types.Etype_id=exam_name.Ename_examtypeid");  
		$this->db->where("Utest_userid",$this->session->userdata("myid"));
		$this->db->where("Utest_result_status",1);
		$this->db->where("Utest_status",0);
		$query_list_test_results=$this->db->get();
		return $query_list_test_results->result_array();
	}
}
?>