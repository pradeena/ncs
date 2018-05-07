<?php 
defined("BASEPATH") OR exit("No Direct Script Allowed");
class Test extends CI_Controller
{
	public function index()
	{    
		$data["meta_title"]="Test | NCS Online (CampusKit)";
		$data["meta_description"]="Test View.";
		$this->load->view("similar/header_view",$data);  
		$this->load->view("similar/menu_view"); 		
		$this->load->view("design-test/test_view");	
		$data['hide_primary_nav']  = 1;
		$this->load->view("similar/footer_view",$data); 
	}
	public function college()
	{    
		$data["meta_title"]="Test | NCS Online (CampusKit)";
		$data["meta_description"]="Test View."; 
		$this->load->view("similar/header_view",$data);  
		$this->load->view("similar/menu_view"); 		
		$this->load->view("design-test/college_view");	
		$data['hide_primary_nav']  = 1;
		$this->load->view("similar/footer_view",$data); 
	}
	public function course()
	{    
		$data["meta_title"]="Test | NCS Online (CampusKit)";
		$data["meta_description"]="Test View.";
		$this->load->view("similar/header_view",$data);  
		$this->load->view("similar/menu_view"); 		
		$this->load->view("design-test/course_view");	
		$data['hide_primary_nav']  = 1;
		$this->load->view("similar/footer_view",$data); 
	}
	public function search()
	{    
		$data["meta_title"]="Test | NCS Online (CampusKit)";
		$data["meta_description"]="Test View.";
		$this->load->view("similar/header_view",$data);  
		$this->load->view("similar/menu_view"); 		
		$this->load->view("design-test/search_view");	
		$data['hide_primary_nav']  = 1;
		$this->load->view("similar/footer_view",$data); 
	}
	public function locationDetails()
	{ 
		if($this->session->userdata("analytics"))
		{
			$this->session->userdata("analytics");
		}
		else
		{
			$key=md5(uniqid());
			$this->session->set_userdata(['analytics' => $key]);
		}
		$ip=$this->input->ip_address();
		$this->load->library('location');
		$response=location::getLocation($ip);
		var_dump($response);
		echo $response->city;
	}
}
?>