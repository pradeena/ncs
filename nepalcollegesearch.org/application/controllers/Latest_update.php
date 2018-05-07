<?php 
defined("BASEPATH") OR exit("No Direct Script Allowed");
class Latest_update extends CI_Controller
{
	public function __construct()
	{
		parent::__construct(); 
		$this->load->model("latest_update_model");
	} 
	public function index()
	{  
		$data["meta_title"]="Colleges & Courses in Nepal | NCS Online";
		$data["meta_description"]="Colleges & Courses in Nepal";
		$this->load->view("similar/header_view",$data);
		$this->load->view("similar/menu_view");  
		$data["result_list_search_keywords"]=$this->latest_update_model->list_search_keywords_model();
		$data["result_list_popular_course"]=$this->latest_update_model->list_popular_course_model();
		$data["result_list_faculties"]=$this->latest_update_model->list_faculties_model();
		$this->load->view("modules/latest_update_view",$data);  
		$this->load->view("similar/footer_view"); 
	}

}
?>