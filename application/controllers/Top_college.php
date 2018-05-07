<?php 
defined("BASEPATH") OR exit("No Direct Script Allowed");
class Top_college extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("top_college_model");
	}
	public function index()
	{ 
		$data["meta_title"]="Top Colleges in Nepal - Rankings, Admission, Fee, Contact, Reviews 2017-18 | NCS Online";
		$data["meta_description"]="List of Top Colleges in Nepal 2017 with Rankings, Admission, Fee, Contact, Reviews, Admission.";
		$this->load->view("similar/header_view",$data);
		$this->load->view("similar/menu_view");  
		$data["result_top_college"]=$this->top_college_model->list_top_college_model();
		$this->load->view("modules/top_college_view",$data);
		$this->load->view("similar/footer_view");
	}
}
?>