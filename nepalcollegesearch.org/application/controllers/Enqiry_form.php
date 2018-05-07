<?php
defined("BASEPATH") or exit("No Direct Script Allowed");
class Enqiry_form extends CI_Controller
{ 
	/* Constructor To Load Home Model */
	public function __construct()
	{
		parent::__construct();
		$this->load->model("common/enquiry_form_model");
	}
	public function check_duplicate_admission_enquiry($Cenq_email,$Cenq_clgecourseid)
	{
		if($this->home_model->check_duplicate_admission_enquiry_model($Cenq_email,$Cenq_clgecourseid))
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	/* Default Function For Home Controller */
	public function index()
	{ 
		$this->load->view("common/header_view"); 
		if(isset($_POST["search_college"]) && $_POST["do_search_college"]=="true")	
		{
			$search_keyword=$this->input->post("search_keyword");
			$data["result_college_search"]=$this->enquiry_form_model->do_search_college_model($search_keyword); 
			$data["result_list_university"]=$this->enquiry_form_model->list_university_model($search_keyword);  
			$data["result_list_cities"]=$this->enquiry_form_model->list_cities_model($search_keyword);
		}
		if(isset($_POST["enquiry"]) && $_POST["do_enquiry"]=="true")
		{ 
			$result_enquiry_type=$this->enquiry_form_model->enquiry_type_model($this->input->post("Cenq_enquirytypeid"));
			foreach($result_enquiry_type as $row_enquiry_type)
			$CEtype_name=$row_enquiry_type["CEtype_name"];
			$Clge_name=$this->input->post("Clge_name");
			$name=$this->input->post("Cenq_fstname").' '.$this->input->post("Cenq_lstname");
			$CEcmntsced_usercomment=$this->input->post("CEcmntsced_usercomment");
			$Cenq_enquirytypeid=$this->input->post("Cenq_enquirytypeid");
			$Cenq_regdate=date('Y-m-d H:i:s');
			$this->email->set_newline("\r\n");
			$this->email->from("webmaster@nbsonline.org","NBSonline Webmaster Team");
			$this->email->to($this->input->post("Cenq_email"));
			$this->email->set_mailtype("html");
			if($Cenq_enquirytypeid=="1")
			{ 
				$this->email->subject("Thank You For Enquiry At ".$Clge_name);
				$data_email["email_msg"]='<p>Hi '.$name.',</p>
					<p>Thank you for your Showing interest in '.$Clge_name.'.</p>
					<p>Below Is Your Enquiry Details</p><hr/>
					<p><b>Enquiry Date & Time :-</b> '.$Cenq_regdate.'</p>
					<p><b>Message:-</b> '.$CEcmntsced_usercomment.'.</p><hr/><br/>
					<p>Best Regards</p><p>'.$Clge_name.'</p>';
				$message= $this->load->view('nbs_mailer.php',$data_email,TRUE); 
				$this->email->set_mailtype("html");
				$this->email->message($message);
				if($this->enquiry_form_model->do_general_enquiry_model($Cenq_regdate))
				{
					$this->email->send();
					$data["msg"]='<div class="alert alert-success alert-dismissable"> 
							<h4><i class="icon fa fa-check"></i> Success , Please Refferd To Your Email.</h4> 
							</div><meta http-equiv="refresh" content="3;url='.base_url().'">';
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
				$result_enquiry_program=$this->enquiry_form_model->enquiry_program_model($this->input->post("Cenq_clgecourseid"));
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
					$check_val_user=$this->check_duplicate_user($this->input->post("Cenq_email"));
					if($check_val_user==1)
					{  
						$this->email->subject("Thank You For Enquiry At ".$Clge_name);
						$data_email["email_msg"]='<p>Hi '.$name.',</p>
							<p>Thank you for your Showing interest in '.$Clge_name.'.</p>
							<p>Below Is Your Enquiry Details</p><hr/>
							<p><b>Enquiry Date & Time :-</b> '.$Cenq_regdate.'</p>
							<p><b>Program (Or Course) :-</b>  '.$program.'</p>
							<p><b>Program Level (Or Course Type) :-</b>  '.$level.' </p>
							<p><b>Uniersity :-</b>  '.$Univ_name.'</p>
							<p><b>Message:-</b> '.$CEcmntsced_usercomment.'.</p><hr/><br/>
							<p>Best Regards</p><p>'.$Clge_name.'</p>'; 
						$message= $this->load->view('nbs_mailer.php',$data_email,TRUE); 
						$this->email->set_mailtype("html");
						$this->email->message($message);
						if($this->enquiry_form_model->admission_enquiry_for_old_user_model($Cenq_regdate))
						{
							$this->email->send();
							$data["msg"]='<div class="alert alert-success alert-dismissable"> 
							<h4><i class="icon fa fa-check"></i> Enquiry Done Please Visit Your Nbs Dashboard To Keep Track of enquiry status Or Check Your Email Address </h4> 
							</div><meta http-equiv="refresh" content="3;url='.base_url().'">';
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
						$Login_username=$this->input->post("Cenq_email");
						$bytes = openssl_random_pseudo_bytes(4);
						$Login_password = bin2hex($bytes);  
						$this->email->subject("Register To NBSonline");
						$data_user_email["email_msg"]='<p>Hi '.$name.',</p>
							<p>Welcome to NBSOnline. One stop destination for digital education system. You can access to NBS system using below credential:</p><hr/>
							<p><b>Username:</b> '.$Login_username.'</p>
							<p><b>Password:</b> '.$Login_password.'</p><hr/>
							<p>Best Regards</p>
							<p><b>NBSOnline</b></p>';
						$message= $this->load->view('nbs_mailer.php',$data_user_email,TRUE); 
						$this->email->set_mailtype("html");
						$this->email->message($message);
						if($this->enquiry_form_model->admission_enquiry_for_new_user_model($Login_password,$Cenq_regdate))
						{
							$this->email->send(); 
							$this->email->subject("Thank You For Enquiry At ".$Clge_name);
							$data_email["email_msg"]='<p>Hi '.$name.',</p>
								<p>Thank you for your Showing interest in '.$Clge_name.'.</p>
								<p>Below Is Your Enquiry Details</p><hr/>
								<p><b>Enquiry Date & Time :-</b> '.$Cenq_regdate.'</p>
								<p><b>Program (Or Course) :-</b>  '.$program.'</p>
								<p><b>Program Level (Or Course Type) :-</b>  '.$level.' </p>
								<p><b>Uniersity :-</b>  '.$Univ_name.'</p>
								<p><b>Message:-</b> '.$CEcmntsced_usercomment.'.</p><hr/><br/>
								<p>Best Regards</p><p>'.$Clge_name.'</p>'; 
							$message= $this->load->view('nbs_mailer.php',$data_email,TRUE); 
							$this->email->set_mailtype("html");
							$this->email->message($message);
							$this->email->send();
							$data["msg"]='<div class="alert alert-success alert-dismissable"> 
							<h4><i class="icon fa fa-check"></i> Enquiry Done And Congrats You Are Now Become NBSOnline Users.For Login Access Details Please Check Your Email & Keep Track Your Enquiry Request By your NBBSonline Dashboard </h4> 
							</div><meta http-equiv="refresh" content="3;url='.base_url().'">';
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
		}
		/* calling view_college_details_model To return Individual College Details */ 
		$data["result_college_details"]=$this->enquiry_form_model->view_college_details_model();
		$this->load->view("common/enquiry_form_view",$data); 
		$this->load->view("common/footer_view"); 
	}
	public function sort_college_resultAjax()
	{
		$search_keyword=$this->input->post("search_keyword");
		$Univ_id=$this->input->post("Univ_id");
		$Clge_city=$this->input->post("Clge_city");
		if($Univ_id=='all' && $Clge_city=='all')
		{
			$result_sort_college=$this->enquiry_form_model->all_universities_and_cities_model($search_keyword);
		}
		elseif($Univ_id=='all' && $Clge_city!='all')
		{
			$result_sort_college=$this->enquiry_form_model->all_universities_model($search_keyword,$Clge_city);
		}
		elseif($Univ_id!='all' && $Clge_city=='all')
		{
			$result_sort_college=$this->enquiry_form_model->all_cities_model($search_keyword,$Univ_id);
		}
		else
		{
			$result_sort_college=$this->enquiry_form_model->both_universities_and_cities_model($search_keyword,$Clge_city,$Univ_id);
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
											<img src="<?php echo base_url(); ?>../admin/uploads/colleges/thumbs/<?php echo $image; ?>" class="img-square" width="170px" alt="<?php echo $row_sort_college["Clge_logo"]; ?>" />
										</td>
										<td>
											<a href="<?php echo base_url();?>home?action=view_college_details&clgeid=<?php echo $row_sort_college["Clge_id"];?>"  target="_blank"><b><?php echo $row_sort_college["Clge_name"]; ?> (<?php echo $row_sort_college["Ctype_name"]; ?>)</b></a><br/> 
											Address :- <?php echo $row_sort_college["Clge_address1"]; ?> , <?php echo $row_sort_college["Clge_address2"]; ?> , <?php echo $row_sort_college["Clge_postcode"]; ?> , <?php echo $row_sort_college["Clge_city"]; ?> , <?php echo $row_sort_college["Dist_name"]; ?> , <?php echo $row_sort_college["Zon_name"]; ?> , <?php echo $row_sort_college["Cntry_name"]; ?><br/> 
											Email :- <?php echo $row_sort_college["Clge_email"]; ?> <br/>
											Number :- <?php echo $row_sort_college["Clge_contct_no"]; ?> <br/>
											<a class="btn btn-info" href="<?php echo base_url();?>home?action=do_enquiry&clgeid=<?php echo $row_sort_college["Clge_id"];?>"  target="_blank">Enquiry Now</a>&nbsp;&nbsp;
											<a class="btn btn-success" href="<?php echo base_url();?>home?action=view_college_details&clgeid=<?php echo $row_sort_college["Clge_id"];?>" target="_blank">More Details</a>
										</td>    
									</tr>  
								<?php } ?>	
								</tbody>
							</table>
						</div>	
	<?php
	}	
}
?>