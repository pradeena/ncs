<?php 
defined("BASEPATH") OR exit("No Direct Script Allowed");
class Online_test_model extends CI_Model
{ 
	public function get_instruction_model($Utest_id)
	{
		$db9=$this->load->database("db9",true);
		$db9=$db9->database; 
		$this->db->from("$db9.users_test");
		$this->db->join("$db9.exam_schedule",'exam_schedule.Eschedule_id=users_test.Utest_exmschedule_id');
		$this->db->where("Utest_id",$Utest_id);
		$query_instruction=$this->db->get();
		return $query_instruction->result_array();
	}
	function user_test_model()
	{
		$db9=$this->load->database("db9",true);
		$db9=$db9->database;
		$this->db->select("*,COUNT(*) as count");
		$this->db->from("$db9.users_test");
		$this->db->join("$db9.exam_schedule",'exam_schedule.Eschedule_id=users_test.Utest_exmschedule_id');
		$this->db->where("Utest_status",1);
		$this->db->where("Eschedule_status",1);
		$this->db->where("Eschedule_test_enable",1);
		$this->db->where("Utest_userid",$this->session->userdata("myid"));
		$query_user_test=$this->db->get();
		return $query_user_test->result_array();
	}
	public function verify_test_code_model()
	{
		$db9=$this->load->database("db9",true);
		$db9=$db9->database;
		$this->db->where("Eschedule_id",$this->input->post("Eschedule_id"));
		$this->db->where("Eschedule_code",trim($this->input->post("Eschedule_code")));
		$query_verif_TestCode=$this->db->get("$db9.exam_schedule");
		if($query_verif_TestCode->num_rows() > 0)
		{
			$data=array("Utest_verify_testcode" => 1);
			$this->db->where("Utest_id",$this->input->get("test_id"));
			if($this->db->update("$db9.users_test",$data))
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