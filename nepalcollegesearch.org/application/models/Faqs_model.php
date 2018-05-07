<?php
defined("BASEPATH") or exit("No Direct Script Allowed");
class Faqs_model extends CI_Model
{
	/* list all frequently ask questions model function */
	public function list_faqs_model()
	{
		$db2=$this->load->database("db2",true);
		$db2=$db2->database;
		$this->db->from("$db2.faqs");
		$this->db->order_by("faqs_regdate","DESC");
		$query_faqs=$this->db->get();
		return $query_faqs->result_array();
	}
}
?>