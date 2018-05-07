<?php 
defined("BASEPATH") OR exit("No Direct Script Allowed");
class Start_test_model extends CI_Model
{ 
	public function test_start_end_time_model()
	{
		$db9=$this->load->database("db9",true);
		$db9=$db9->database;
		$this->db->where("Utest_start_time!=","0000-00-00 00:00:00");
		$this->db->where("Utest_id",$this->input->get("test_id"));
		$query_existing_time=$this->db->get("$db9.users_test");
		if($query_existing_time->num_rows() > 0)
		{ 
			$row_existing_time=$query_existing_time->row();
			return $row_existing_time->Utest_start_time; 
		}
		else
		{
			date_default_timezone_set("Asia/kathmandu");
			$start_time=date("Y-m-d h:i:s");
			$data=array(
				"Utest_start_time" => $start_time,
				"Utest_end_time" => $start_time
			);
			$this->db->where("Utest_id",$this->input->get("test_id"));
			if($this->db->update("$db9.users_test",$data))
			{
				return $start_time;
			}
		}
		
	}
	public function set_user_questions_model($Etest_exmschedule_id,$Eschedule_total_marks,$Eschedule_total_questions)
	{
		$db9=$this->load->database("db9",true);
		$db9=$db9->database;
		$this->db->where("Uans_usr_testid",$this->input->get("test_id"));
		$this->db->from("$db9.user_answer");
		$this->db->join("$db9.exam_questions","exam_questions.Equestion_id=user_answer.Uans_quesid");
		$this->db->join("$db9.exam_test","exam_test.Etest_quesid=user_answer.Uans_quesid");
		$query_duplicate_questionSet=$this->db->get();
		if($query_duplicate_questionSet->num_rows() > 0)
		{
			return $query_duplicate_questionSet->result_array();
		}
		else
		{
			$this->db->select("Etest_quesid");
			$this->db->where("Etest_exmschedule_id",$Etest_exmschedule_id);
			$this->db->order_by("rand()");
			$this->db->limit($Eschedule_total_questions);
			$query_get_questions=$this->db->get("$db9.exam_test");
			$result_get_quetions=$query_get_questions->result_array();
			foreach($result_get_quetions as $row_get_quetions)
			{
				$data=array(
					"Uans_usr_testid" => $this->input->get("test_id"),
					"Uans_quesid" => $row_get_quetions["Etest_quesid"],
				);
				$this->db->insert("$db9.user_answer",$data);
			}
			$this->db->where("Uans_usr_testid",$this->input->get("test_id"));
			$this->db->from("$db9.user_answer");
			$this->db->join("$db9.exam_questions","exam_questions.Equestion_id=user_answer.Uans_quesid");
			$this->db->join("$db9.exam_test","exam_test.Etest_quesid=user_answer.Uans_quesid");
			$query_list_questionSet=$this->db->get();
			return $query_list_questionSet->result_array();
		}
	}   
	public function Add_Testanswer_model($Uans_usr_testid,$Uans_quesid,$Uans_ans,$Uans_ans_desc,$Uans_ans_marks)
	{    
		date_default_timezone_set("Asia/kathmandu");
		$db9=$this->load->database("db9",true);
		$db9=$db9->database;  
		$update_answer_data=array(
				"Uans_ans" => $Uans_ans,
				"Uans_ans_desc" => $Uans_ans_desc,
				"Uans_ans_marks" => $Uans_ans_marks
			);
			$this->db->where("Uans_usr_testid",$Uans_usr_testid);
			$this->db->where("Uans_quesid",$Uans_quesid);  
			if($this->db->update("$db9.user_answer",$update_answer_data))
			{
				$data=array(
					"Utest_end_time" =>date("Y-m-d h:i:s")
				); 
				$this->db->where("Utest_id",$Uans_usr_testid); 
				if($this->db->update("$db9.users_test",$data))
				{
					$this->db->where("Eresult_usr_testid",$Uans_usr_testid);
					$query_duplicate_result=$this->db->get("$db9.exam_results"); 
					if($query_duplicate_result->num_rows() >0)
					{ 
						$row_duplicate_result=$query_duplicate_result->row();
						$Eresult_score=$row_duplicate_result->Eresult_score+$Uans_ans_marks;
						$data_updt_result=array( "Eresult_score" => $Eresult_score);
						$this->db->where("Eresult_usr_testid",$Uans_usr_testid);
						if($this->db->update("$db9.exam_results",$data_updt_result))
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
						$data_insert_result=array( 
							"Eresult_usr_testid" => $Uans_usr_testid,
							"Eresult_score" => $Uans_ans_marks
							);
						if($this->db->insert("$db9.exam_results",$data_insert_result))
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
					return false;
				} 
			}
			else
			{
				return false;
			} 
	}
	public function close_exam_model($Uans_usr_testid,$Uans_ans_marks)
	{
		date_default_timezone_set("Asia/kathmandu");
		$db9=$this->load->database("db9",true);
		$db9=$db9->database;
		/*$this->db->select_sum("Uans_ans_marks");
		$this->db->where("Uans_usr_testid",$Uans_usr_testid);
		$query_totalMarks=$this->db->get("$db9.user_answer");
		$row_totalMarks=$query_totalMarks->row();
		$Eresult_score=$row_totalMarks->Uans_ans_marks;
		$data_score=array(
			"Eresult_usr_testid" => $Uans_usr_testid,
			"Eresult_score" => $Eresult_score,
		);
		$this->db->insert("$db9.exam_results",$data_score);*/
		$data=array(
			"Utest_status" => 0,
			"Utest_end_time" =>date("Y-m-d h:i:s")
		);
		$this->db->where("Utest_id",$Uans_usr_testid);
		if($this->db->update("$db9.users_test",$data))
		{
			$this->db->where("Eresult_usr_testid",$Uans_usr_testid);
			$query_duplicate_result=$this->db->get("$db9.exam_results");
			if($query_duplicate_result->num_rows() > 0)
			{
				$row_duplicate_result=$query_duplicate_result->row();
				$Eresult_score=$row_duplicate_result->Eresult_score+$Uans_ans_marks;
				$data_updt_result=array( "Eresult_score" => $Eresult_score);
				$this->db->where("Eresult_usr_testid",$Uans_usr_testid);
				if($this->db->update("$db9.exam_results",$data_updt_result))
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
				$data_insert_result=array( 
					"Eresult_score" => $Uans_ans_marks,
					"Eresult_usr_testid" => $Uans_usr_testid
					);
				if($this->db->insert("$db9.exam_results",$data_insert_result))
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
			return false;
		}
	}
	public function update_end_time_model($Utest_id)
	{
		$db9=$this->load->database("db9",true);
		$db9=$db9->database;   
		date_default_timezone_set("Asia/kathmandu");
		$data=array(
					"Utest_end_time" =>date("Y-m-d h:i:s")
					);
		$this->db->where("Utest_id",$Utest_id);
		if($this->db->update("$db9.users_test",$data))
		{
			return true;
		}
		else
		{
			return false;
		} 
	}
	public function endTest_model($test_id)
	{
		date_default_timezone_set("Asia/kathmandu");
		$db9=$this->load->database("db9",true);
		$db9=$db9->database; 
		$data=array(
			"Utest_status" => 0,
			"Utest_end_time" =>date("Y-m-d h:i:s")
		);
		$this->db->where("Utest_id",$test_id);
		if($this->db->update("$db9.users_test",$data))
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