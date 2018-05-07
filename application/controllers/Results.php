<?php
defined("BASEPATH") or exit("No Direct Script Allowed");
class Results extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("common/loggedin_user_info_model");  
		$this->load->model("common/results_model");  
	} 
	public function index()
	{  
		if($this->session->userdata("is_loged_in"))
		{  
			if($result_user_details=$this->loggedin_user_info_model->user_details_model())
			{  	  
				$data["result_user_details"]=$this->loggedin_user_info_model->user_details_model(); 
				$data["result_list_test_results"]=$this->results_model->list_test_results_model(); 
				$this->load->view("common/header_view",$data);   
				$this->load->view("common/results_view"); 
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
}
?>