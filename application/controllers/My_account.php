<?php
defined("BASEPATH") or exit("No Direct Script Allowed");
class My_account extends CI_Controller
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
				$data["result_user_details"]=$this->loggedin_user_info_model->user_details_model(); 
				$data["result_user_login_logs"]=$this->loggedin_user_info_model->user_login_logs_model(); 
				$this->load->view("common/header_view",$data);   
				$this->load->view("common/my_account_view"); 
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
	public function change_password_ajax()
	{
		$old_password=$this->input->post("old_password");
		$Login_password=$this->input->post("Login_password");
		$cpassword=$this->input->post("cpassword");
		$result_user_details=$this->loggedin_user_info_model->user_details_model();
		foreach($result_user_details as $row_user_details)
		if(md5($old_password)!=$row_user_details["Login_password"])
		{
			echo ' <h4 style="color:red"><i class="icon fa fa-warning"></i> Warning! Old Password Is Invalid.</h4> ';
		}
		else
		{
			$User_email=$this->input->post("User_email"); 
			$Login_username=$this->input->post("Login_username");
			$Login_password=$this->input->post("Login_password"); $this->email->from("webmaster@nbsonline.org","NBSonline Webmaster Team");
			$this->email->to($this->input->post("User_email"));
			$this->email->subject("Password Changed For NBSonline User");
			$this->email->set_mailtype("html");
			$message="Hii $User_email You password has been changed. This is your new login access details <br/> username :- $Login_username <br/> Password:- $Login_password <br/>
			http://www.enterprise.nbsonline.org/login<br/> Thank You.";
			$this->email->message($message);
			if($this->loggedin_user_info_model->change_my_password_model())
			{ 
				if($this->email->send())
				{
					echo '<h4 style="color:green"><i class="icon fa fa-check"></i> Successfully Updated</h4><meta http-equiv="refresh" content="1;url='.base_url().'my_account">'; 
				}
				else
				{
					echo '<div class="alert alert-danger alert-dismissable">
						<h4 style="color:red><i class="icon fa fa-warning"></i> Email Not Sent</h4> 
						</div>';
				}
			}
			else
			{
				echo '<h4 style="color:red><i class="icon fa fa-warning"></i> Not Updated</h4>';
			}
		}
	}
	public function update_profile_ajax()
	{ 
		if($this->input->post("User_profile_pic")=='')
				{
					$realfile=$this->input->post("User_profile_pic");
					if($this->loggedin_user_info_model->update_my_profile_model($realfile))
					{
						echo '<h4 style="color:green"><i class="icon fa fa-check"></i> Successfully Updated</h4> 
						<meta http-equiv="refresh" content="1;url='.base_url().'my_account">';							
					}
					else
					{
						echo '<h4 style="color:green><i class="icon fa fa-warning"></i> Not Updated</h4> ';
					}
				}
				else
				{
					$config['upload_path']='admin/uploads/users/thumbs/';
					$config["allowed_types"]='gif|GIF|jpg|JPG|jpeg|JPEG|png|PNG';
					$config["max_size"]=100;
					$config["max_width"]=1024;
					$config["max_height"]=768;   
					$name=$this->input->post("User_fstname");
					$ext = strtolower(pathinfo($this->input->post("User_profile_pic"), PATHINFO_EXTENSION)); 
					$name=str_replace(' ', '-', $name);
					$name=preg_replace('/[^A-Za-z0-9\-]/', '', $name);
					$realfile = time().$name.'.'.$ext; 
					$config['file_name'] = $realfile;
					$this->load->library("upload",$config); 
					if(!$this->upload->do_upload('User_profile_pic'))
					{
						echo '<h4 style="color:red><i class="icon fa fa-warning"></i>'.$this->upload->display_errors().'</h4>';
					}
					else
					{
						if($this->loggedin_user_info_model->update_my_profile_model($realfile))
						{
							$delete_image=$this->input->post('User_profile_pic');
							if($delete_image!=''){ unlink("admin/uploads/users/thumbs/".$delete_image); }
							$data = array('upload_data' => $this->upload->data()); 
							echo '<h4 style="color:green"><i class="icon fa fa-check"></i> Successfully Updated</h4>'; 							
						}
						else
						{
							echo '<h4 style="color:red><i class="icon fa fa-warning"></i> Not Updated</h4>';
						}
					}
				}
	}
}
?>