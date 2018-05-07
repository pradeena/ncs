<?php
defined("BASEPATH") or exit("No Direct Script Allowed");
class Enquiry extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("common/loggedin_user_info_model"); 
		$this->load->model("enquiry_model"); 
		$this->load->model("register_model");
	}

	public function createEnquiry()
	{
		if($this->input->is_ajax_request())
		{
			$CEcmntsced_usercomment = $this->input->post("CEcmntsced_usercomment");
			$Cenq_clgeid = $this->input->post("Cenq_clgeid");
			$Cenq_clgecourseid = $this->input->post("Cenq_clgecourseid"); 
			$userDetails = $this->loggedin_user_info_model->user_details_model(); 
			foreach ($userDetails as $key => $user) 
			$Cenq_fstname = $user['User_fstname'];	
			$Cenq_lstname = $user['User_lstname'];	
			$Cenq_email = $user['User_email'];	
			$Cenq_contactno = $user['User_mobileno'];
			$Cenq_userid = $this->session->userdata("myid");	
			if($this->enquiry_model->createEnquiry($Cenq_fstname, $Cenq_lstname, $Cenq_email, $Cenq_contactno, $Cenq_clgeid, $Cenq_clgecourseid,$CEcmntsced_usercomment, $Cenq_userid))
			{
				echo "<img height='30' width='30' src='".base_url()."img/a1.png'><span style='color:green'>Enquiry completed</span>"; 
			} else {
				echo "<img height='30' width='30' src='".base_url()."img/a2.png'><span style='color:red'>Enquiry not completed</span>"; 
			}
		} 
	}
	public function createNewUserEnquiry()
	{
		if($Cenq_userid = $this->enquiry_model->checkDuplicateUser($this->input->post("email")))
		{
			$CEcmntsced_usercomment = $this->input->post("CEcmntsced_usercomment");
			$Cenq_clgeid = $this->input->post("Cenq_clgeid");
			$Cenq_clgecourseid = $this->input->post("Cenq_clgecourseid");  
			$Cenq_fstname = $this->input->post("fstname");	
			$Cenq_lstname = $this->input->post("lstname");	
			$Cenq_email = $this->input->post("email");	
			$Cenq_contactno = $this->input->post("mobileno");
			$Cenq_userid = $Cenq_userid;	
			if($this->enquiry_model->createEnquiry($Cenq_fstname, $Cenq_lstname, $Cenq_email, $Cenq_contactno, $Cenq_clgeid, $Cenq_clgecourseid,$CEcmntsced_usercomment,$Cenq_userid))
			{
				echo "<img height='30' width='30' src='".base_url()."img/a1.png'><span style='color:green'>Enquiry completed. You can check you enquiry status at you dashboard</span>"; 
			} else {
				echo "<img height='30' width='30' src='".base_url()."img/a2.png'><span style='color:red'>Enquiry not completed</span>"; 
			}
		}
		else
		{
			$activation_email=md5(uniqid());
			$Login_password = uniqid();
			if($Cenq_userid=$this->register_model->create_user_account_model($activation_email,$Login_password))
			{
				$CEcmntsced_usercomment = $this->input->post("CEcmntsced_usercomment");
				$Cenq_clgeid = $this->input->post("Cenq_clgeid");
				$Cenq_clgecourseid = $this->input->post("Cenq_clgecourseid");  
				$Cenq_fstname = $this->input->post("fstname");	
				$Cenq_lstname = $this->input->post("lstname");	
				$Cenq_email = $this->input->post("email");	
				$Cenq_contactno = $this->input->post("mobileno");
				$Cenq_userid = $Cenq_userid;	
				if($this->enquiry_model->createEnquiry($Cenq_fstname, $Cenq_lstname, $Cenq_email, $Cenq_contactno, $Cenq_clgeid, $Cenq_clgecourseid,$CEcmntsced_usercomment,$Cenq_userid))
				{
					$subject = "Activate your Account at ".SITE_NAME;
					$sendTo = $this->input->post("email");
					$message = "Account Verification is Required!<hr><br/> Hi ".$this->input->post("fstname").", <br/> <br/>
                               Thank you for registering at ".SITE_NAME."! <br/>
                               Please click onto the link below to confirm your email address and activate your account.<br/><br/> <br/><a href='".base_url()."register/activate?myid=$Cenq_userid&verify=$activation_email'>Click here to Activate</a> <br/> <br/>If the above activation link doesn't work, please use the below URL and activate your account..<br/>
                               ".base_url()."register/activate?myid=$Cenq_userid&verify=$activation_email <br/> <br/> Below is your login details <br/> <br/>
                               username : ".$Cenq_email."<br/>
                               password : ".$Login_password."<br/><br/>
                               Got a question or need clarifications? You can write us at ".SUPPORT_EMAILID." <br/> <br/>
                               Sincerely, <br/>
                               The ".SITE_NAME." Support Team"; 
                    Send_email::sendMail($sendTo, $subject, $message);           
					echo "<img height='30' width='30' src='".base_url()."img/a1.png'><span style='color:green'>Enquiry completed. Hey you look like new to ".SITE_NAME.". We created account for you. Please check your email for account activation and after activatig your account keep track your enquiry at your profile</span>"; 
				} else {
					echo "<img height='30' width='30' src='".base_url()."img/a2.png'><span style='color:red'>Enquiry not completed</span>"; 
				}
			} 
		}
	}
	/*public function check_duplicate_admission_enquiry($Cenq_email,$Cenq_clgecourseid)
	{
		if($this->my_enquiry_model->check_duplicate_admission_enquiry_model($Cenq_email,$Cenq_clgecourseid))
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}*/
	/*public function index()
	{ 
		if(isset($_POST["search_college"]) && $_POST["do_search_college"]=="true")	
		{
			$search_keyword=$this->input->post("search_keyword");
			$data["result_college_search"]=$this->my_enquiry_model->do_search_college_model($search_keyword); 
			$data["result_list_university"]=$this->my_enquiry_model->list_university_model($search_keyword);  
			$data["result_list_cities"]=$this->my_enquiry_model->list_cities_model($search_keyword);
		}
		if(isset($_POST["enquiry"]) && $_POST["do_enquiry"]=="true")
		{ 
			$result_enquiry_type=$this->my_enquiry_model->enquiry_type_model($this->input->post("Cenq_enquirytypeid"));
			foreach($result_enquiry_type as $row_enquiry_type)
			$CEtype_name=$row_enquiry_type["CEtype_name"];
			$Clge_name=$this->input->post("Clge_name");
			$Cenq_contactno=$this->input->post("Cenq_contactno");
			$name=$this->input->post("Cenq_fstname").' '.$this->input->post("Cenq_lstname");
			$CEcmntsced_usercomment=$this->input->post("CEcmntsced_usercomment");
			$Cenq_enquirytypeid=$this->input->post("Cenq_enquirytypeid");
			$Cenq_regdate=date('Y-m-d H:i:s'); 
			if($Cenq_enquirytypeid=="1")
			{  
				if($this->my_enquiry_model->do_general_enquiry_model($Cenq_regdate))
				{ 
					$data["msg"]='<div class="alert alert-success alert-dismissable"> 
							<h4><i class="icon fa fa-check"></i> Success , Please Refferd To Your Email.</h4> 
							</div><meta http-equiv="refresh" content="3;url='.base_url().'enquiry'.'">';
				}
				else
				{
					$data["msg"]='<div class="alert alert-danger alert-dismissable"> 
							<h4><i class="icon fa fa-warning"></i> Something Went Wrong , Enquiry Not Completed</h4> 
							</div>';
				}
			}
			else
			{ 
				$result_enquiry_program=$this->my_enquiry_model->enquiry_program_model($this->input->post("Cenq_clgecourseid"));
				foreach($result_enquiry_program as $row_enquiry_program)
				$program=$row_enquiry_program["Course_name"];
				$level=$row_enquiry_program["Course_type_name"];
				$Univ_name=$row_enquiry_program["Univ_name"];
				$check_val=$this->check_duplicate_admission_enquiry($this->input->post("Cenq_email"),$this->input->post("Cenq_clgecourseid"));
				if($check_val==1)
				{
					$data["msg"]='<div class="alert alert-danger alert-dismissable"> 
							<h4><i class="icon fa fa-warning"></i> Already Applied</h4> 
							</div>';
				}
				else
				{ 
					if($this->my_enquiry_model->admission_enquiry_for_old_user_model($Cenq_regdate))
					{
						$data["msg"]='<div class="alert alert-success alert-dismissable"> 
						<h4><i class="icon fa fa-check"></i> Enquiry Done Please Visit Your Nbs Dashboard To Keep Track of enuiry status Or Check Your Email Address </h4> 
							</div><meta http-equiv="refresh" content="3;url='.base_url().'enquiry'.'">';
					}
					else
					{
						$data["msg"]='<div class="alert alert-danger alert-dismissable"> 
						<h4><i class="icon fa fa-warning"></i> Something Went Wrong , Enquiry Not Completed</h4> 
						</div>';
					}
				}	
			}
		}
		if($this->session->userdata("is_loged_in"))
		{  
			if($result_user_details=$this->loggedin_user_info_model->user_details_model())
			{  	  
				$data["result_user_details"]=$this->loggedin_user_info_model->user_details_model();
				$data["result_my_enquiry"]=$this->my_enquiry_model->list_my_enquiry_model(); 
				$data["result_course_model"]=$this->my_enquiry_model->list_course_model();
				$data["result_individual_enquiry_student"]=$this->my_enquiry_model->individual_enquiry_student_model();
				$data["result_college_details"]=$this->my_enquiry_model->view_college_details_model();
				$this->load->view("common/header_view",$data);   
				$this->load->view("common/my_enquiry_view"); 
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
	public function sort_college_resultAjax()
	{
		$search_keyword=$this->input->post("search_keyword");
		$Univ_id=$this->input->post("Univ_id");
		$Clge_city=$this->input->post("Clge_city");
		if($Univ_id=='all' && $Clge_city=='all')
		{
			$result_sort_college=$this->my_enquiry_model->all_universities_and_cities_model($search_keyword);
		}
		elseif($Univ_id=='all' && $Clge_city!='all')
		{
			$result_sort_college=$this->my_enquiry_model->all_universities_model($search_keyword,$Clge_city);
		}
		elseif($Univ_id!='all' && $Clge_city=='all')
		{
			$result_sort_college=$this->my_enquiry_model->all_cities_model($search_keyword,$Univ_id);
		}
		else
		{
			$result_sort_college=$this->my_enquiry_model->both_universities_and_cities_model($search_keyword,$Clge_city,$Univ_id);
		}
	?>
						<div class="box-body">
							<table id="example2" class="table table-bordered table-striped">
								<thead>
									<tr> 
										<th></th> 
										<th></th> 
									</tr>
								</thead>
								<tbody>  
								<?php 
								$SrNo=1;
								foreach($result_sort_college as $row_sort_college)	
								{
									if($row_sort_college["Clge_logo"]=='') {$image="no-image.jpg";} else{ $image=$row_sort_college["Clge_logo"]; }
								?>
									<tr style="font-size:15px;text-transform:capitalize"> 
										<td>
											<img src="<?php echo base_url(); ?>./admin/uploads/colleges/thumbs/<?php echo $image; ?>" class="img-square" width="170px" alt="<?php echo $row_sort_college["Clge_logo"]; ?>" />
										</td>
										<td>
											<a href="<?php echo base_url();?>enquiry?action=view_college_details&clgeid=<?php echo $row_sort_college["Clge_id"];?>"  target="_blank"><b><?php echo $row_sort_college["Clge_name"]; ?> (<?php echo $row_sort_college["Ctype_name"]; ?>)</b></a><br/> 
											Address :- <?php echo $row_sort_college["Clge_address1"]; ?> , <?php echo $row_sort_college["Clge_address2"]; ?> , <?php echo $row_sort_college["Clge_postcode"]; ?> , <?php echo $row_sort_college["Clge_city"]; ?> , <?php echo $row_sort_college["Dist_name"]; ?> , <?php echo $row_sort_college["Zon_name"]; ?> , <?php echo $row_sort_college["Cntry_name"]; ?><br/> 
											Email :- <?php echo $row_sort_college["Clge_email"]; ?> <br/>
											Number :- <?php echo $row_sort_college["Clge_contct_no"]; ?> <br/>
											<a class="btn btn-info" href="<?php echo base_url();?>enquiry?action=do_enquiry&clgeid=<?php echo $row_sort_college["Clge_id"];?>"  target="_blank">Enquiry Now</a>&nbsp;&nbsp;
											<a class="btn btn-success" href="<?php echo base_url();?>enquiry?action=view_college_details&clgeid=<?php echo $row_sort_college["Clge_id"];?>" target="_blank">More Details</a>
										</td>    
									</tr>  
								<?php } ?>	
								</tbody>
							</table>
						</div>	
	<?php
	}	
	public function general_EnquiryAjax()
	{   
		if(isset($_POST["Cenq_fstname"]))
		{
			$Cenq_regdate=date('Y-m-d H:i:s');
			if($this->my_enquiry_model->do_general_enquiryAjax_model($Cenq_regdate))
			{ 
				echo '<b style="color:green"><i class="icon fa fa-check"></i> Enquiry Done!</b><meta http-equiv="refresh" content="3;url='.base_url().'enquiry'.'">';
			}
			else
			{
				echo '<b style="color:red"><i class="icon fa fa-warning"></i>Enquiry Not Done!</b> ';
			}
		}	
		else
		{
			redirect(base_url()."page_not_found");
		}
	}*/
}
?>