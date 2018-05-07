<?php
defined("BASEPATH") or exit("No Direct Script Allowed");
class Forums extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("forums_model");
	}
	/* list all Forums*/
	public function index($pg=1)
	{
		if(isset($_GET["action"]))
		{
			redirect(base_url()."page_not_found");
		}
		$data["meta_title"]="Forums & Discussion | NCS Online (CampusKit)";
		$data["meta_description"]="Popular education forum for students to Discuss of Nepal colleges, university, institute, exam, Admission.";
		$this->load->view("similar/header_view",$data);
		$this->load->view("similar/menu_view");
		$data["action"]="list_questions";
		$data["pg"]=$pg;
		$data["result_list_forum_questions"]=$this->forums_model->list_forum_questions_model($pg);  
		$data["result_total_recordfound"]=$this->forums_model->do_total_recordfoundmodel(); 
		$this->load->view("modules/forums_view",$data);  
		$this->load->view("similar/footer_view"); 
	}
	/* list Forums answers */
	public function view_forum_answers($Fques_id,$Fques_question)
	{
		$Fques_question=str_replace("-"," ",$Fques_question);
		$data["meta_title"]="Nepal College Search - forums - ".$Fques_question;
		$this->load->view("similar/header_view",$data);
		$this->load->view("similar/menu_view");
		$data["action"]="forum_answer_details";  
		$data["result_indiv_forum_questions"]=$this->forums_model->indiv_forum_questions_model($Fques_id);
		$result_indiv_forum_questions=$this->forums_model->indiv_forum_questions_model($Fques_id);
		foreach($result_indiv_forum_questions as $row_indiv_forum_questions)
		if($row_indiv_forum_questions["count"] < 1)
		{
			redirect(base_url()."page_not_found");
		}
		$data["result_indiv_forum_ans"]=$this->forums_model->indiv_forum_ans_model($Fques_id);      
		$this->load->view("modules/forums_view",$data);  
		$this->load->view("similar/footer_view");
	} 
}
?>