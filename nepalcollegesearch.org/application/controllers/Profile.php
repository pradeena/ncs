<?php 
defined("BASEPATH") OR exit("No Direct Script Allowed");
class Profile extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("profile_model");	
	}
	public function index()
	{  
	if($this->session->userdata("is_loged_in"))
	{
		$this->load->view("similar/header_view");
		$this->load->view("similar/menu_view"); 
		if(isset($_POST["update_user"]) && $_POST["do_update_user"]=="true")
		{ 
			if($_FILES["User_profile_pic"]['name']=='')
			{
				$realfile=$this->input->post("user_profilepic_hidden");
				if($this->profile_model->update_user_model($realfile))
				{
					$data["msg"]='<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
					<h4><i class="icon fa fa-check"></i> Successfully Updated</h4> 
					</div><meta http-equiv="refresh" content="1;url='.base_url().'profile">';							
				}
				else
				{
					$data["msg"]='<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
					<h4><i class="icon fa fa-warning"></i> Not Updated</h4> 
					</div>';
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
					$data["msg"]='<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
						<h4><i class="icon fa fa-warning"></i>'.$this->upload->display_errors().'</h4> 
						</div>';
				}
				else
				{
					if($this->profile_model->update_user_model($realfile))
					{
						$delete_image=$this->input->post('user_profilepic_hidden');
						if($delete_image!=''){ unlink('admin/uploads/users/thumbs/'.$delete_image); }
						$data = array('upload_data' => $this->upload->data());
						$data["msg"]='<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
						<h4><i class="icon fa fa-check"></i> Successfully Updated</h4> 
						</div><meta http-equiv="refresh" content="1;url='.base_url().'profile">';		
					}
					else
					{
						$data["msg"]='<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
						<h4><i class="icon fa fa-warning"></i> Not Updated</h4> 
						</div>';
					}
				}
			}	
		}
		/* admin password change code goes here  */
		if(isset($_POST["change_password"]) && $_POST["do_change_password"]=="true")
		{
			if($this->profile_model->change_user_password_model())
			{
				$this->session->sess_destroy();
				$data["msg"]='<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
					<h4><i class="icon fa fa-check"></i> Password Updated</h4> 
					</div>
					<meta http-equiv="refresh" content="1;url='.base_url().'login">';
			}
			else
			{
				$data["msg"]='<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
							<h4><i class="icon fa fa-warning"></i> Not Updated</h4> 
							</div>';
			}
		}
		$data["result_individual_user"]=$this->profile_model->list_individual_user_model();
		$this->load->view("modules/profile_view",$data);  
		$this->load->view("similar/footer_view"); 
	}
	}
}
?>