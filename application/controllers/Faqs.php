<?php 
defined("BASEPATH") OR exit("No Direct Script Allowed");
class Faqs extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("faqs_model");	
	}
	/* list all frequently ask questions */
	public function index()
	{  
		$data["meta_title"]="Frequently Asked Questions (FAQ) | NCS Online";
		$data["meta_description"]="Have questions regarding NCS Online? Know it all here.";
		$this->load->view("similar/header_view",$data);
		$this->load->view("similar/menu_view"); 
		$data["result_list_faqs"]=$this->faqs_model->list_faqs_model();
		$this->load->view("modules/faqs_view",$data);  
		$this->load->view("similar/footer_view"); 
	}

}
?>