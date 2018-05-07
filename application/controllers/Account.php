<?php
defined("BASEPATH") or exit("No Direct Script Allowed");
class Account extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("common/loggedin_user_info_model"); 
		$this->load->model("enquiry_model"); 
	}
	public function index()
	{  
		$msg ="";
		if(!$this->session->userdata("is_loged_in")) 
		{
			$this->session->sess_destroy();
			redirect(base_url()."login");
		}
		$data["meta_title"]="My account | NCS Online";
		$data["meta_description"]="Have questions regarding NCS Online? Know it all here.";
		$this->load->view("similar/header_view",$data);
		$this->load->view("similar/menu_view"); 
		$getUserDetails=$this->loggedin_user_info_model->user_details_model(); 
		$getUserLoginDetails=$this->loggedin_user_info_model->user_login_logs_model(); 
		if(isset($_POST['uploadProfilePic']))
		{
			if(empty($_FILES["User_profile_pic"]["name"]))
			{
				$msg = "<b style='color:red'> Please select profile picture</b>";
			}
			else{

				$realfile=Uploads::uploadFileName($getUserDetails[0]['User_fstname'],$_FILES["User_profile_pic"]['name']);
				echo $path=FILE_UPLOAD_PATH.'users/thumbs/';
				if(Uploads::uploadImage($realfile,$path,'User_profile_pic')=='true'){
					if($this->loggedin_user_info_model->uploadProfile($realfile))
					{
						if(!empty($getUserDetails[0]['User_profile_pic'])){ unlink($getUserDetails[0]['User_profile_pic']); }
								$msg.='<div class="callout callout-success"><h4><i class="fa fa-check"></i> profile picture updated !! </h4></div><meta http-equiv="refresh" content="1">'; 
					}
					else
					{
						$msg='<div class="callout callout-danger"><h4><i class="fa fa-warning"></i> Not Added!</h4></div>';
					}	
				}
				else{
			echo "<script>alert('hello')</script>";
					$msg=Uploads::uploadImage($realfile,$path,'User_profile_pic');
				}
			}
		}
		$getEnquiry=$this->enquiry_model->getEnquiry();
		$this->load->view("modules/account_view",['getUserDetails' => $getUserDetails, 'getUserLoginDetails' => $getUserLoginDetails, 'getEnquiry' => $getEnquiry, 'msg' => $msg]);  
		$this->load->view("similar/footer_view"); 
	}

	public function update()
	{
		if($this->input->is_ajax_request()){
			$val = $this->input->post(); 
			// var_dump($val);
			if($this->loggedin_user_info_model->updateProfile($val['User_fstname'], $val['User_lstname'], $val['User_gender']))
			{
				echo "<b style='color:green'>Profile updated</b>";
			} else {
				echo "<b style='color:red'> Profile not updated</b>";
			}

		} 
	}
	public function changePassword()
	{
		if($this->input->is_ajax_request()){
			$val = $this->input->post(); 
			$oldPassword = md5($val["old_password"]);

			if($this->loggedin_user_info_model->checkOldPassword($oldPassword)==false)
			{
				echo "<b style='color:red'> your old password is incorrect</b>";
			}
			else{
				//var_dump($val);
				if($this->loggedin_user_info_model->changePassword($oldPassword, md5($val["Login_password"])))
				{
					echo "<b style='color:green'>password changed</b>";
				} else {
					echo "<b style='color:red'> password not changed</b>";
				}
			}
			

		} 
	}
}
?>