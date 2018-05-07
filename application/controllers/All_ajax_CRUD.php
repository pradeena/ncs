<?php 
defined("BASEPATH") OR exit("No Direct Script Allowed");
class All_ajax_CRUD extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("forums_model");
		$this->load->model("updates_model");
	}
	/* ask forum from home page*/
	public function ask_questionAjaxHome()
	{
		$Fques_question=$this->input->post("Fques_question");
		if(isset($Fques_question))
		{
			if($this->forums_model->ask_questionAjax_model($Fques_question))
			{
				echo "<br/><img src='".base_url()."img/a1.png' height='30' width='30'> <b style='color:green'>Question Added.</b>";
				echo "<meta http-equiv='refresh' content='1;url=".base_url()."forums'>";
			}
			else
			{
				echo "<br/><img src='".base_url()."img/a1.png' height='30' width='30'> <b style='color:red'>Question Not Added.</b>";
			}
		}	
		else
		{
			redirect(base_url()."page_not_found");
		}
	}
	/* ask forum from forum page*/
	public function ask_questionAjax()
	{
		$Fques_question=$this->input->post("Fques_question");
		if(isset($Fques_question))
		{
			if($this->forums_model->ask_questionAjax_model($Fques_question))
			{
				echo "<br/><img src='".base_url()."img/a1.png' height='30' width='30'> <b style='color:green'>Question Added.</b>";
				echo "<meta http-equiv='refresh' content='1;url=".base_url()."forums'>";
			}
			else
			{
				echo "<br/><img src='".base_url()."img/a1.png' height='30' width='30'> <b style='color:red'>Question Not Added.</b>";
			}
		}	
		else
		{
			redirect(base_url()."page_not_found");
		}	
	}
	/* submit forum answer form individual forum page*/
	public function submit_answerAjax()
	{
		$Fans_answer=$this->input->post("Fans_answer");
		$Fans_forumqusid=$this->input->post("Fans_forumqusid");
		if(isset($Fans_answer))
		{
			if($this->forums_model->submit_answerAjax_model($Fans_answer,$Fans_forumqusid))
			{
				echo "<br/><img src='".base_url()."img/a1.png' height='30' width='30'> <b style='color:green'>Answer Submitted.</b>";
				echo "<meta http-equiv='refresh' content='1'>";
			}
			else
			{
				echo "<br/><img src='".base_url()."img/a1.png' height='30' width='30'> <b style='color:red'>Answer Not Submitted.</b>";
			}
		}	
		else
		{
			redirect(base_url()."page_not_found");
		}	
	}
	/* comment individual update*/
	public function do_commentAjax()
	{
		$Ncomment_comment=$this->input->post("Ncomment_comment");
		$Ncomment_newsid=$this->input->post("Ncomment_newsid");
		if(isset($Ncomment_comment))
		{
			if($this->updates_model->submit_comment_model($Ncomment_comment,$Ncomment_newsid))
			{
				echo "<br/><img src='".base_url()."img/a1.png' height='30' width='30'> <b style='color:green'>Submitted.</b>";
				echo "<meta http-equiv='refresh' content='1'>";
			}
			else
			{
				echo "<br/><img src='".base_url()."img/a1.png' height='30' width='30'> <b style='color:red'>Submitted.</b>";
			}
		}	
		else
		{
			redirect(base_url()."page_not_found");
		}
	}
}
?>