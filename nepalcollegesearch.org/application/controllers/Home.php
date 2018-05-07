<?php 
defined("BASEPATH") OR exit("No Direct Script Allowed");
class Home extends CI_Controller
{
	/* constructor to load home model */
	public function __construct()
	{
		parent::__construct();
		$this->load->model("home_model");	
	}
	/* default function for Home Controller */
	public function index()
	{   
		$this->load->view("similar/header_view");  
		$this->load->view("similar/menu_view");  
		$this->load->view("modules/slider_view");
		$data["result_college"]=$this->home_model->list_college_details_model(); /* show 25 colleges in home page */
		$data["result_courses"]=$this->home_model->list_course_model(); /* show 25 courses in home page */
		$this->load->view("modules/home_view",$data);  
		$this->load->view("similar/footer_view");   
	} 
	/* check duplicate subscriber for newsletter subscription  */
	public function duplicate_subscriber($SUB_email)
	{
		if($this->home_model->check_duplicate_subscriber_model($SUB_email))
		{
			return 1;
		}
		else
		{
			return 0;
		}
	} 
	/* Add subscribe for newsletter */
	public function subscribeNewLetterAjax()
	{
		$SUB_email=$this->input->post("SUB_email");
		if(isset($SUB_email))
		{
			$check_val=$this->duplicate_subscriber($this->input->post("SUB_email"));
			if($check_val==1)
			{ 
				echo '<div class="alert alert-danger alert-dismissible" role="alert"> 
						<strong style="color:red">you are already subscribed for newsletter!</strong>
					</div>';	  
			}
			else
			{
				if($this->home_model->do_add_subscribe_email_model($SUB_email))
				{
					/* Semd subscribe for newsletter email to user*/
					$this->load->library("email");
					$this->email->from(EMAIL_FROM,EMAIL_FROM_NAME);
					$this->email->to($SUB_email);
					$this->email->set_mailtype("html");
					$this->email->subject("Subscribe ".SITE_NAME." Newsletter");
					$data_email["email_msg"]="Thanks for subscribing to newsletter from ".SITE_NAME.". You'll now get email each time we add new college or course and we promise we won't stuff your inbox with repackaged college or course updates<hr/>Best Regards <br/> ".SITE_NAME." Team";
					$message=$this->load->view(MAILER_FILE_NAME,$data_email,TRUE);
					$this->email->message($message);
					$this->email->send();
					echo '<div class="alert alert-success alert-dismissible" role="alert"> 
						<strong  style="color:green">Thank You For Subscribe '.SITE_NAME.' Newsletter.</strong>  
					</div>'; 
				}
				else
				{
					echo '<div class="alert alert-danger alert-dismissible" role="alert"> 
						<strong style="color:red">Not Subscribe!</strong>
					</div>';
				}
			}
		} 	
		else
		{
			redirect(base_url()."page_not_found");
		}
	}	
	public function Add_prefer_faculty()
	{
		$Cfaculty_id=$this->input->post("Cfaculty_id");
		if($this->home_model->prefer_faculty_model($Cfaculty_id))
		{
			echo "<img height='30' width='30' src='".base_url()."img/a1.png'><span style='color:green'>Saved</span>";
			//echo "<meta http-equiv='refresh' content='1;url=".base_url().">";
		}
		else
		{
			echo "<img height='30' width='30' src='".base_url()."img/a2.png'><span style='color:red'>Not Saved</span>";
		}
		
	}
	public function Add_prefer_course()
	{
		$Course_type_id=$this->input->post("Course_type_id");
		if($this->home_model->prefer_course_model($Course_type_id))
		{
			echo "<img height='30' width='30' src='".base_url()."img/a1.png'><span style='color:green'>Saved</span>";
			//echo "<meta http-equiv='refresh' content='1;url=".base_url().">";
		}
		else
		{
			echo "<img height='30' width='30' src='".base_url()."img/a2.png'><span style='color:red'>Not Saved</span>";
		}
		
	}
	public function Add_prefer_city()
	{
		$Clge_city=$this->input->post("Clge_city");
		if($this->home_model->prefer_city_model($Clge_city))
		{
			echo "<img height='30' width='30' src='".base_url()."img/a1.png'><span style='color:green'>Saved</span>";
			//echo "<meta http-equiv='refresh' content='1;url=".base_url().">";
		}
		else
		{
			echo "<img height='30' width='30' src='".base_url()."img/a2.png'><span style='color:red'>Not Saved</span>";
		}
		
	}
}
?>