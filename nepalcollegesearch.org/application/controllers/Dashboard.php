<?php
defined("BASEPATH") or exit("No Direct Script Allowed");
class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("common/loggedin_user_info_model");
	}
	public function index()
	{ 
		if($this->session->userdata("is_loged_in"))
		{  
			if($result_user_details=$this->loggedin_user_info_model->user_details_model())
			{  	
				foreach($result_user_details as $row_user_details)
				$myaccesstype=$row_user_details["Login_accesstype_id"];
				$data["result_user_details"]=$this->loggedin_user_info_model->user_details_model();
				if($myaccesstype=='1')
				{
					$this->load->view("common/header_view",$data);   
					$this->load->view("apps/free_users/dashboard_view"); 
					$this->load->view("common/footer_view"); 
				}
				elseif($myaccesstype=='2')
				{
					$this->load->view("common/header_view",$data);   
					$this->load->view("apps/paid_users/dashboard_view"); 
					$this->load->view("common/footer_view"); 
				}
				elseif($myaccesstype=='3')
				{
					$this->load->view("common/header_view",$data);   
					$this->load->view("apps/college_students/dashboard_view"); 
					$this->load->view("common/footer_view"); 
				}	
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