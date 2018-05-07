<?php 
defined("BASEPATH") OR exit("No Direct Script Allowed");
class Contact extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("contactus_model"); 
		$this->load->library('curl'); 
		$this->load->library("form_validation");	
	}
	public function index()
	{  
		$data["meta_title"]="Get In Touch with Nepal College Search (CampusKit) Team";
		$data["meta_description"]="We’d love to hear what you think about NCS Online and our service. Submit on-line feedback.";
		$this->load->view("similar/header_view",$data);
		$this->load->view("similar/menu_view"); 
		$data="";
		/* add user contact message*/
		if(isset($_POST["submit_contact"]) && $_POST["do_submit_contact"]=="true")
		{
			$recaptchaResponse = trim($this->input->post('g-recaptcha-response'));	
			$userIp=$this->input->ip_address();
			$secret='6LdMOhkUAAAAAFcP7P4tYZoYcu7hno8-k7g1Kzfr';
			$url="https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$recaptchaResponse."&remoteip=".$userIp; 
			$response = $this->curl->simple_get($url); 
			$status= json_decode($response, true); 
			if($status['success'])
			{   
				$this->form_validation->set_rules("contact_name","Full Name","required|trim");
				$this->form_validation->set_rules("contact_email","Email","required|trim");
				$this->form_validation->set_rules("contact_mobile","Contact Number","required|trim|regex_match[/^[0-9]{10,15}$/]");
				$this->form_validation->set_message("contact_mobile","regex_match","Mobile Number Should be 10 or in between 10-15 digits");
				$this->form_validation->set_rules("contact_message","Message","required|trim");
				$contact_name=$this->input->post("contact_name");
				$contact_email=$this->input->post("contact_email");
				$contact_message=$this->input->post("contact_message"); 
				if($this->form_validation->run()==false)
				{
					$data["msg"]='<div class="alert alert-danger" role="alert"><p><i style="color:red" class="fa fa-warning"></i> '.validation_errors().'</p></div>';
				}	
				else
				{
					/* sending email to user about contact message*/
					$this->load->library('email');
					$this->email->from(EMAIL_FROM,EMAIL_FROM_NAME);
					$this->email->to($this->input->post("contact_email"));
					$this->email->set_mailtype("html");
					$this->email->subject("Contact to ".SITE_NAME."");
					$data_email["email_msg"]="Hii $contact_name your message has been received to ".SITE_NAME." team.You will be contacted shortly by one of our representatives..<br/> ".base_url()."<br/>Your Query :- $contact_message <hr/>Best Regards<br/>".SITE_NAME." Team";
					$message=$this->load->view(MAILER_FILE_NAME,$data_email,true);
					$this->email->message($message); 
					if($this->contactus_model->do_add_contactus_details_model())
					{
						$this->email->send(); 
						$data["msg"]='<div class="alert alert-info" role="alert">
						<p><i class="fa fa-success"></i><b>Thank you for contacting. We will get back in next 24 working hours</b></div>'; 						
					} 
					else
					{
						$data["msg"]='<div class="alert alert-danger" role="alert"><p><i style="color:red" class="fa fa-warning"></i>Enquiry Not Submitted , Something went wrong!</p></div>';
					}
				}
			}
			else
			{
				$this->session->set_flashdata('flashSuccess', '<div class="alert alert-danger" role="alert"><p><i style="color:red" class="fa fa-warning"></i> Sorry Google Recaptcha Unsuccessful!!</p></div>');
			}
		}	
		$this->load->view("modules/contact_view",$data);  
		$this->load->view("similar/footer_view"); 
	}
}
?>	