<?php
defined("BASEPATH") or exit("No Direct Script Allowed");
class Privacy_policy_model extends CI_Model
{
	/* list all frequently ask questions model function */
	public function list_pri_poli_model()
	{
		$db2=$this->load->database("db2",true);
		$db2=$db2->database;
		$this->db->from("$db2.privacy_policy");
		$query_pri_poli=$this->db->get();
		return $query_pri_poli->result_array();
	}
}
?>