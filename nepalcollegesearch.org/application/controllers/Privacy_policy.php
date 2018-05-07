<?php 
defined("BASEPATH") OR exit("No Direct Script Allowed");
class Privacy_policy extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("privacy_policy_model");	
	}
	/* list all frequently ask questions */
	public function index()
	{  
		$data["meta_title"]="Privacy-policy | NCS Online";
		$data["meta_description"]="Have Privacy and policy regarding NCS Online? Know it all here.";
		$this->load->view("similar/header_view",$data);
		$this->load->view("similar/menu_view"); 
		$data["result_list_pti_poli"]=$this->privacy_policy_model->list_pri_poli_model();
		$this->load->view("modules/Privacy_policy_view",$data);  
		$this->load->view("similar/footer_view"); 
	}

}
?>