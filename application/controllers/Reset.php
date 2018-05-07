<?php
defined("BASEPATH") or exit ("NO Direct Script Allowed");
/* Forget password controller start here */
class Reset extends CI_Controller
{
	public function index()
	{
		$this->load_reset_view();
	}
	public function load_reset_view()
	{ 
		$data["meta_title"]="Nepal College Search - Password Help";
		$this->load->view("similar/header_view",$data);  
		$this->load->view("similar/menu_view");
		if(isset($_POST["forget_password"]) && $_POST["do_forget_password"]=="true")
		{
			$this->load->library("form_validation"); 
			$this->form_validation->set_rules("email","email","is_unique[users.User_email]"); 
			/* Its Check For current Email from database If Not found Then show error message*/
			if($this->form_validation->run())
			{
				$data=array(
					'msg' => '<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
							<h4><i class="icon fa fa-warning"></i> Alert!</h4>
							<p>Sorry, This Email Address Dose not Exit.</p>
							</div>'
				); 
			}
			/*If found Then Execute further code*/
			else
			{
				$this->load->model("reset_password_model");
				/* Loading send_forget_password_email_model function from reset_password_model */
				if($email_data=$this->reset_password_model->send_forget_password_email_model())
				{
					/* Initializing return data from send_forget_password_email_model */
					$forgetid=$email_data["forgetid"];
					$forgetverify=$email_data["forgetverify"];
					$email=$this->input->post("email");
					/* Initializing Email data for sending reset password email to users */
					$this->email->set_mailtype("html");
					$this->email->from("webmaster@campuskit.org","Campuskit Webmaster Team");
					$this->email->to($this->input->post("email"));
					$this->email->subject("Reset Password Link For Campuskit");
					$data_email["email_msg"]="Hii $email Someone has requested a password reset for the Your account:<br/><br/>If this was a mistake, just ignore this email and nothing will happen.<br/><br/>To reset your password, visit the following address:<br/><br/><a href='".base_url()."reset/reset_password?forgetid=$forgetid&forgetverify=$forgetverify'>Click Here For Reset Password</a>";
					$message= $this->load->view('nbs_mailer.php',$data_email,TRUE); 
					$this->email->message($message);
					/* If email Sends then show success message */
					if($this->email->send())
					{
						$data=array(
						'msg' => '<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
							<h4><i class="icon fa fa-check-circle"></i> Success!</h4>
							<p>Password Reset Link has been sent to your email address</p>
							</div><meta http-equiv=refresh content="1;url='.base_url().'login">'
						); 
					}
				}
				/* if send_forget_password_email_model function from reset_password_model return false then show this error message */
				else
				{
					$data=array(
					'msg' => '<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
							<h4><i class="icon fa fa-warning"></i> Alert!</h4>
							<p>Sorry, This Email Address Dose not Exit.</p>
							</div>'
					); 
				}
			}
		}
		$this->load->view("modules/reset_view",$data);  
		$this->load->view("similar/footer_view");  
	} 
	/* -----------------------------------------------------------------------------------------------------------------------------
		Function To load reset password view or check for valid url
	   -----------------------------------------------------------------------------------------------------------------------------*/
	public function reset_password()
	{ 
		$data["meta_title"]="Nepal College Search - Password Help";
		$this->load->view("similar/header_view",$data);  
		$this->load->view("similar/menu_view"); 
		$forgetid=$this->input->get("forgetid");
		$forgetverify=$this->input->get("forgetverify");
		$this->load->model("reset_password_model");
		/* if valid url then execute further code*/
		if($this->reset_password_model->check_reset_url_model($forgetid,$forgetverify))
		{
			$data=""; 
			if(isset($_POST["reset_password"]) && $_POST["do_reset_password"])
			{
				$this->load->library("form_validation");
				$this->form_validation->set_rules("password","password","trim|md5");
				if($this->form_validation->run())
				{
					$this->load->model("reset_password_model");
					/* if reset_password_model model return true then execute further code */
					if($email_data=$this->reset_password_model->do_reset_password_model())
					{
						$email=$email_data;
						/* Initializing Email data for sending  password changed email to users after password changed */
						$this->email->set_mailtype("html");
						$this->email->from("webmaster@campuskit.org","Campuskit Webmaster Team");
						$this->email->to($email);
						$this->email->subject("You've just changed your password");
						$data_email["email_msg"]="Hii $email <br/><br/>You've just changed your password.<br/>If you didn’t change your password, mail us on support@
						 .org.<br/><br/>Yours sincerely, <br/>Campuskit Support Team";
						$message= $this->load->view('nbs_mailer.php',$data_email,TRUE);
						$this->email->message($message);
						/* If email Sends then redirect to login */
						if($this->email->send())
						{
							$data=array(
							'msg' => '<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
							<h4><i class="icon fa fa-check-circle"></i> Success!</h4>
							<p>Password Updated Successfully</p>
							</div><meta http-equiv=refresh content="1;url='.base_url().'login">'
							);  
						} 
					}
					/* if  reset_password_model return false then show unsuccess message for password reset */
					else
					{
						$data=array(
						'msg' => '<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
							<h4><i class="icon fa fa-warning"></i> Alert!</h4>
							<p>Sorry, password Not Updated.</p>
							</div>'
						); 
					}			
				}
			}
			$this->load->view("modules/reset_password_view",$data);  
			$this->load->view("similar/footer_view");  
		}
		/* if not valid url then show unable to access reset page msg*/
		else
		{
			echo '<center><h1>Sorry, you are not authorized to access this page.</h1><p><a href="'.base_url().'login"> Go Back To Login</a><br></p></center>';
		}
	} 
}
?>