<?php
defined("BASEPATH") or exit("No Direct Script Allowed");
class Forums_model extends CI_Model
{
	/* list all Forums model*/
	public function list_forum_questions_model($pg)
	{ 
		$start_from = ($pg-1) * 10;
		$end=$start_from+10; 
		$db1=$this->load->database("db1",true);
		$db1=$db1->database; 
		$db2=$this->load->database("db2",true);
		$db2=$db2->database;
		$this->db->order_by("Aques_regdate","DESC");	
		$this->db->limit(10,$start_from);
		$this->db->from("$db2.forums_questions"); 
		$this->db->join("$db1.users","users.User_id=forums_questions.Fques_userid"); 
		$sql_forum_qus=$this->db->get();
		return $sql_forum_qus->result_array();
	} 
	/* list all Forums model for total record found*/
	public function do_total_recordfoundmodel()
	{
		$db1=$this->load->database("db1",true);
		$db1=$db1->database; 
		$db2=$this->load->database("db2",true);
		$db2=$db2->database; 
		$this->db->select("COUNT(Fques_id) as count"); 	
		$this->db->limit(300); 
		$this->db->from("$db2.forums_questions"); 
		$this->db->join("$db1.users","users.User_id=forums_questions.Fques_userid"); 
		$query_total_record_found=$this->db->get(); 
		return $query_total_record_found->result_array();
	}
	/* individual Forums model*/
	public function indiv_forum_questions_model($Fques_id)
	{
		$db1=$this->load->database("db1",true);
		$db1=$db1->database;
		$db2=$this->load->database("db2",true);
		$db2=$db2->database; 
		$this->db->select("Fques_id,Fques_question,User_id,User_fstname,User_lstname,Aques_regdate,COUNT(Fques_id) as count");
		$this->db->where("Fques_id",$Fques_id);
		$this->db->from("$db2.forums_questions"); 
		$this->db->join("$db1.users","users.User_id=forums_questions.Fques_userid"); 
		$query_list_forum_qus=$this->db->get(); 
		return $query_list_forum_qus->result_array();
	}
	/* list individual Forums answer list model*/
	public function indiv_forum_ans_model($Fans_forumqusid)
	{
		$db1=$this->load->database("db1",true);
		$db1=$db1->database; 
		$db2=$this->load->database("db2",true);
		$db2=$db2->database; 
		$this->db->where("Fans_forumqusid",$Fans_forumqusid); 
		$this->db->from("$db2.forums_answers"); 
		$this->db->join("$db1.users","users.User_id=forums_answers.Fans_userid"); 
		$query_list_forum_ans=$this->db->get(); 
		return $query_list_forum_ans->result_array();
	}
	/* ask forum question model*/
	public function ask_questionAjax_model($Fques_question)
	{
		$this->load->library('user_agent');
		$browser = $this->agent->browser();
		$browserVersion = $this->agent->version();
		$platform = $this->agent->platform();
		$ip=$this->input->ip_address();
		$browser_details='Browser Name:- '.$browser.' , version:- '.$browserVersion.' , plateform:- '.$platform.' , Ip:- '.$ip;
		$db2=$this->load->database("db2",true);
		$db2=$db2->database;
		$data=array(
			"Fques_userid" => $this->session->userdata("myid"),
			"Fques_question" => $Fques_question,
			"Fques_browser_details" => $browser_details
		);
		if($this->db->insert("$db2.forums_questions",$data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	/* submit forum answer model*/
	public function submit_answerAjax_model($Fans_answer,$Fans_forumqusid)
	{
		$this->load->library('user_agent');
		$browser = $this->agent->browser();
		$browserVersion = $this->agent->version();
		$platform = $this->agent->platform();
		$ip=$this->input->ip_address();
		$browser_details='Browser Name:- '.$browser.' , version:- '.$browserVersion.' , plateform:- '.$platform.' , Ip:- '.$ip;
		$db2=$this->load->database("db2",true);
		$db2=$db2->database;
		$data=array(
			"Fans_forumqusid" => $Fans_forumqusid,
			"Fans_userid" => $this->session->userdata("myid"),
			"Fans_answer" => $Fans_answer,
			"Fans_browser_details" => $browser_details
		);
		if($this->db->insert("$db2.forums_answers",$data))
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