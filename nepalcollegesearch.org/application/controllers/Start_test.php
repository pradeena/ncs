<?php 
defined("BASEPATH") OR exit("No Direct Script Allowed");
class Start_test extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("common/loggedin_user_info_model"); 
		$this->load->model("common/start_test_model");  
		$this->load->model("common/online_test_model");
	}
	public function index()
	{
		if($this->session->userdata("is_loged_in"))
		{  
			if($result_user_details=$this->loggedin_user_info_model->user_details_model())
			{  	  
				$data["result_user_details"]=$this->loggedin_user_info_model->user_details_model();   
				$result_user_test=$this->online_test_model->user_test_model();
				foreach($result_user_test as $row_user_test)
				if($row_user_test["count"] < 1)
				{
					redirect(base_url()."page_not_found");
				}	
				$data["start_time"]=$this->start_test_model->test_start_end_time_model();
				$data["result_set_user_questions"]=$this->start_test_model->set_user_questions_model($row_user_test["Eschedule_id"],$row_user_test["Eschedule_total_marks"],$row_user_test["Eschedule_total_questions"]);
				$data["Eschedule_id"]=$row_user_test["Eschedule_id"];	
				$data["Eschedule_minutes"]=$row_user_test["Eschedule_minutes"];	
				$data["Utest_start_time"]=$row_user_test["Utest_start_time"];	
				$data["Utest_end_time"]=$row_user_test["Utest_end_time"];	
				$data["Eschedule_total_questions"]=$row_user_test["Eschedule_total_questions"];	
				$data["Eschedule_total_marks"]=$row_user_test["Eschedule_total_marks"];	
				$this->load->view("common/header1_view",$data);  
				$this->load->view("common/start_test_view"); 
				$this->load->view("common/footer_view");
			}
			else
			{
				$this->session->sess_destroy();
					redirect(base_url()."login");
			}  
		}
		else
		{
			$this->session->sess_destroy();
			redirect(base_url()."login");
		}  
	}  
	public function Add_TestanswerAjax()
	{
		$Uans_usr_testid=$this->input->post("Uans_usr_testid");
		$Uans_quesid=$this->input->post("Uans_quesid"); 
		$Uans_ans=$this->input->post("Uans_ans"); 
		$Uans_ans_desc=$this->input->post("Uans_ans_desc");
		$Equestion_qustypeid=$this->input->post("Equestion_qustypeid");
		$Equestion_ans_true=$this->input->post("Equestion_ans_true");
		if($Equestion_qustypeid==1)
		{
			if($Equestion_ans_true==$Uans_ans)
			{ 	
				$Uans_ans_marks=$this->input->post("Etest_marks");
			}
			else{$Uans_ans_marks=0;}
		}
		else
		{
			$Uans_ans_marks=0;
		}  
		$this->start_test_model->Add_Testanswer_model($Uans_usr_testid,$Uans_quesid,$Uans_ans,$Uans_ans_desc,$Uans_ans_marks);
		if($this->start_test_model->Add_Testanswer_model($Uans_usr_testid,$Uans_quesid,$Uans_ans,$Uans_ans_desc,$Uans_ans_marks))
		{
			echo "";
		}
		else
		{
			echo "";
		}
	}
	public function submitTestAjax()
	{
		$Uans_usr_testid=$this->input->post("Uans_usr_testid");
		$Uans_quesid=$this->input->post("Uans_quesid"); 
		$Uans_ans=$this->input->post("Uans_ans"); 
		$Uans_ans_desc=$this->input->post("Uans_ans_desc");
		$Equestion_qustypeid=$this->input->post("Equestion_qustypeid");
		$Equestion_ans_true=$this->input->post("Equestion_ans_true"); 
		if($Equestion_qustypeid==1)
		{
			if($Equestion_ans_true==$Uans_ans)
			{ 	
				$Uans_ans_marks=$this->input->post("Etest_marks");
			}
			else{$Uans_ans_marks=0;}
		}
		else
		{
			$Uans_ans_marks=0;
		}   
		if($this->start_test_model->Add_Testanswer_model($Uans_usr_testid,$Uans_quesid,$Uans_ans,$Uans_ans_desc,$Uans_ans_marks))
		{		
			if($this->start_test_model->close_exam_model($Uans_usr_testid,$Uans_ans_marks))	
			{
				echo "<img height='30' width='30' src='".base_url()."img/a1.png'><span style='color:green'> Exam Submitted Successfully</span>";
				echo "<meta http-equiv='refresh' content='1;url=".base_url()."online_test'>";
			}
			else
			{
				echo "";
			}  
		}	
		else
		{
			echo "";
		}
	}
	public function update_end_timeAjax()
	{
		$test_id=$this->input->post("test_id");
		if($this->start_test_model->update_end_time_model($test_id))
		{
			echo "<img height='30' width='30' src='".base_url()."img/a1.png'><span style='color:green'><i class='fa fa-clock'></i> Timer Updated</span>";
		}
		else
		{
			echo "";	
		}
	}
	public function endTestAjax()
	{
		$test_id=$this->input->post("test_id");
		if($this->start_test_model->endTest_model($test_id))
		{
			echo "<img height='30' width='30' src='".base_url()."img/a1.png'><span style='color:green'> Exam Submitted Successfully</span>";
			echo "<meta http-equiv='refresh' content='1;url=".base_url()."online_test'>";
		}
		else
		{
			echo "";	
		}
	}
	public function closeTest()
	{
		$test_id=$this->input->get("test_id");
		if($this->start_test_model->endTest_model($test_id))
		{ 
			redirect(base_url()."online_test");
		}
		else
		{
			echo "";	
		}
	}
}
?>