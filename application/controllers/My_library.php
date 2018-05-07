<?php
defined("BASEPATH") or exit("No Direct Script Allowed");
class My_library extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("common/loggedin_user_info_model"); 
		$this->load->model("apps/college_students/my_library_model"); 
		$this->load->model("apps/college_students/student_college_details_model"); 
	}
	public function index()
	{ 
		if($this->session->userdata("is_loged_in"))
		{  
			if($result_user_details=$this->loggedin_user_info_model->user_details_model())
			{  	  
				$data["result_user_details"]=$this->loggedin_user_info_model->user_details_model();  
				$data["result_inout_limit"]=$this->my_library_model->inout_limit_model();
				$data["result_library_issue_books"]=$this->my_library_model->library_issue_books_model();
				$data["result_individual_library_issue_book"]=$this->my_library_model->individual_library_issue_book_model();
				$data["result_issue_book_inventory_location"]=$this->my_library_model->issue_book_inventory_location_model();
				$data["result_library_issued_history"]=$this->my_library_model->library_issued_history_model(); 
				$result_student_college_details=$this->student_college_details_model->get_student_college_details_model();
				foreach($result_student_college_details as $row_student_college_details)
				$Clge_id=$row_student_college_details["Clge_id"];
				if(isset($_POST["search_book_inventory"]))
				{
					$data["result_book_search_inventory"]=$this->my_library_model->do_search_book_inventory_model($Clge_id);
				} 
				$this->load->view("common/header_view",$data); 
				$this->load->view("apps/college_students/my_library_view"); 
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
	public function send_bookissue_request()
	{
		$CBinv_id=$this->input->get("invid");
		$result_student_college_details=$this->student_college_details_model->get_student_college_details_model();
		foreach($result_student_college_details as $row_student_college_details)
		$Clge_id=$row_student_college_details["Clge_id"];
		if($this->my_library_model->send_bookissue_request_model($CBinv_id,$Clge_id))
		{
			redirect(base_url().'my_library');
		}
	}
}
?>