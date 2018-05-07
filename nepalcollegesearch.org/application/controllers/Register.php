<?php
defined("BASEPATH") or exit("No Direct Script Allowed");
class Register extends CI_Controller
{
	public function __construct()
	{
		parent::__construct(); 
		$this->load->model("register_model");
		$this->load->library('curl'); 
		$this->load->library('session');		
		$this->load->library("form_validation");
	} 
	public function check_duplicate_email($email)
	{
		if($this->register_model->check_duplicate_email_model($email))
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	public function check_duplicate_mobileno($mobileno)
	{
		if($this->register_model->check_duplicate_mobileno_model($mobileno))
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	public function index()
	{
		if($this->session->userdata("is_loged_in"))
		{
			redirect(base_url()."dashboard");
		}
		$data["meta_title"]="Register | NCS Online";
		$data["meta_description"]="Join NCS Online today - it only takes a few seconds.";
		$this->load->view("similar/header_view",$data);  
		$this->load->view("similar/menu_view"); 
		$data=""; 
		if(isset($_POST["create_account"]) && $_POST["do_create_account"]=="true")	
		{
			$recaptchaResponse = trim($this->input->post('g-recaptcha-response'));	
			$userIp=$this->input->ip_address();
			$secret='6LdMOhkUAAAAAFcP7P4tYZoYcu7hno8-k7g1Kzfr';
			$url="https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$recaptchaResponse."&remoteip=".$userIp; 
			$response = $this->curl->simple_get($url); 
			$status= json_decode($response, true); 
			if($status['success'])
			{      	
				$this->form_validation->set_rules("fstname","First Name","required|trim");	 
				$this->form_validation->set_rules("lstname","Last Name","required|trim");	 
				$this->form_validation->set_rules("email","Email","required|trim");	  
				$this->form_validation->set_rules("password","Password","required|trim|md5");	 
				$this->form_validation->set_rules("mobileno","Mobile Number","required|trim|regex_match[/^[0-9]{10,15}$/]");
				$this->form_validation->set_message('mobileno','regex_match','Moblie Number Should Be 10 Or Between 10-15 Digits');
				if($this->form_validation->run()==false)
				{
					$data["msg"]='<div class="alert alert-danger" role="alert"><p><i style="color:red" class="fa fa-warning"></i> '.validation_errors().'</p></div>';
				}	
				else
				{ 
					$check_dupEmail=$this->check_duplicate_email($this->input->post("email"));
					if($check_dupEmail==1)
					{
						$data["msg"]='<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
						<h4><i class="icon fa fa-warning"></i></h4>
						Hey! Looks like you are already registered with us. Try Login from <a href="'.base_url().'login">here</a></div>';
					}
					else
					{
						$check_dupMobileno=$this->check_duplicate_mobileno($this->input->post("mobileno"));
						if($check_dupMobileno==1)
						{
							$data["msg"]='<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
							<h4><i class="icon fa fa-warning"></i></h4>
							Hey! Looks like you are already registered with us. Try Login from <a href="'.base_url().'login">here</a></div>';
						}
						else
						{
							$activation_email=md5(uniqid());
							if($id=$this->register_model->create_user_account_model($activation_email, $this->input->post("password")))
							{
								$fstname=$this->input->post("fstname"); 
								$this->load->library('email'); 
								$this->email->from(EMAIL_FROM,EMAIL_FROM_NAME);
								$this->email->to($this->input->post("email"));
								$this->email->set_mailtype("html");
								$this->email->subject("Activate your Account at ".SITE_NAME."");
								$data_email["email_msg"]="Account Verification is Required!<hr><br/> Hi $fstname, <br/> <br/>
                                           Thank you for registering at ".SITE_NAME."! <br/>
                                           Please click onto the link below to confirm your email address and activate your account.<br/><br/> <br/><a href='".base_url()."register/activate?myid=$id&verify=$activation_email'>Click here to Activate</a> <br/> <br/>If the above activation link doesn't work, please use the below URL and activate your account..<br/>
                                           ".base_url()."register/activate?myid=$id&verify=$activation_email <br/> <br/>
                                           Got a question or need clarifications? You can write us at ".SUPPORT_EMAILID." <br/> <br/>
                                           Sincerely, <br/>
                                           The ".SITE_NAME." Support Team"; 
								$message= $this->load->view(MAILER_FILE_NAME,$data_email,TRUE); 
								$this->email->message($message); 
								$this->email->send(); 
								$data["msg"]='<div class="alert alert-success" role="alert"><p><i class="fa fa-check"></i> Successful!</h4>
									Thank you for showing your interest in '.SITE_NAME.'! <br/>
									Please click onto the link we have sent in your email address to activate your account.
									</div><meta http-equiv=refresh content="2;url='.base_url().'login">';  
							} 
							else
							{
								$data["msg"]='<div class="alert alert-danger" role="alert"><p><i style="color:red" class="fa fa-warning"></i> Something Went Wrong. Account Not Created</p></div>';
							}
						}
					}
				}					
			}
			else
			{
				$this->session->set_flashdata('flashSuccess', '<div class="alert alert-danger" role="alert"><p><i style="color:red" class="fa fa-warning"></i> Sorry Google Recaptcha Unsuccessful!!</p></div>');
			}
		}
		$this->load->view("modules/register_view",$data);  
		$this->load->view("similar/footer_view");  
	} 
	/* Function Or Method For Account Verification */
	public function activate()
	{
		/* Retriving id and email activation from string url for account activation*/
		$id=$this->input->get("myid");
		$email_activation=$this->input->get("verify"); 
		/* Load do_verify_account function of register model with two parameters to verify user account. if success then show success msg*/
		if($this->register_model->do_verify_account($id,$email_activation))
		{
			echo '<h3 style="text-align:center">Account Verified Successfully. <br/><a href="'.base_url().'login">Click here</a> to login to account.</h3>';
		}
		/* if account verification failed then show this message */
		else
		{
			echo '<h3 style="text-align:center">Requested Token in Invalid.<br/> Please check your email for Account Activation. <br/><a href="'.base_url().'register/resend_verify_email?sendid='.$id.'&send=again">Click here</a> to resend Email Activation link.</h3>';
		}
	}
	/* Function Or Method For Resending Verivication Email */
	public function resend_verify_email()
	{
		if($this->input->get("send")=="again")
		{
			$id=$this->input->get("sendid"); /* geting id from string url */ 
			/* load get_email_activation From register model with one parameter to resend verification email on the basis of user id */
			if($email_datas=$this->register_model->get_email_activation($id))
			{
				/* Retriving returning data from get_email_activation function of register model */
				$name=$email_datas["name"]; 
				$email= $email_datas["email"]; 
				$activation_email= $email_datas["activation"];
				/* Initializing Email Data For re-sending Email */
				$this->load->library('email',array('mailtype' => 'text or html')); 
				$this->email->from(EMAIL_FROM,EMAIL_FROM_NAME);
				$this->email->to($email);
				$this->email->subject("Activate your Account at ".SITE_NAME);
				$this->email->set_mailtype("html");
				$data_email["email_msg"]="Account Verification is Required!<hr><br/> Hi $name, <br/> <br/>
                                           Thank you for registering at ".SITE_NAME."! <br/>
                                           Please click onto the link below to confirm your email address and activate your account.<br/><br/> <br/><a href='".base_url()."register/activate?myid=$id&verify=$activation_email'>Click here to Activate</a> <br/> <br/>If the above activation link doesn't work, please use the below URL and activate your account..<br/>
                                           ".base_url()."register/activate?myid=$id&verify=$activation_email <br/> <br/>
                                           Got a question or need clarifications? You can write us at ".SUPPORT_EMAILID." <br/> <br/>
                                           Sincerely, <br/>
                                           The ".SITE_NAME." Support Team";  
				$message= $this->load->view(MAILER_FILE_NAME,$data_email,TRUE); 
				$this->email->message($message); 
				/* If email is successfully send then show success message to user */
				if($this->email->send())
				{
					echo '<h3 style="text-align:center">Thank You , Please click onto the link we have sent in your email address to activate your account. .</h3>';
				}
				
			}	
			/* If we dont get email data through string url id then show email dosem't exit message */
			else
			{
				echo '<h3 style="text-align:center">Email Id Dose not Exits .</h3>';
			}				
		}
		/* If we are getting send not equal to again from string url then show  Something Went Wrong*/		
		else
		{
			echo '<h3 style="text-align:center">Something Went Wrong.....</h3>';
		}
	}
}
?>