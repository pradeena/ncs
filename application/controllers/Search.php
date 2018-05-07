<?php 
defined("BASEPATH") OR exit("No Direct Script Allowed");
class Search extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("search_model");	
		$this->load->model("analytics_model");	
		$this->load->model("common/my_enquiry_model"); 
		$this->load->model("common/loggedin_user_info_model"); 
	}
	public function check_duplicate_request($Clge_add_email,$Clge_add_clgeid)
	{
		if($this->search_model->check_duplicate_request_model($Clge_add_email,$Clge_add_clgeid))
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
		/*if(isset($_POST["enquiry"]) && $_POST["do_enquiry"]=="true")
		{ 
			$Cenq_enquirytypeid=$this->input->post("Cenq_enquirytypeid");
			$Cenq_regdate=date('Y-m-d H:i:s'); 
			if($Cenq_enquirytypeid=="1")
			{  
				if($this->search_model->do_general_enquiry_model($Cenq_regdate))
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
		}*/
		if(isset($_GET["action"]))
		{
			redirect(base_url()."page_not_found");
		}
		$data["meta_title"]="Nepal College Search - colleges , universities, study in nepal ,".$this->input->get("qry");
		$this->load->view("similar/header_view",$data); 
		$this->load->view("similar/menu_view"); 
		$data["action"]="list_search_results";
		if(isset($_GET["qry"]))	
		{
			//$this->search_model->do_add_keyword_model();	
			$search_keyword=$this->input->get("qry");
			if($this->session->userdata("myid"))
			{	
				$db1=$this->load->database("db1",true);
				$db1=$db1->database; 
				$this->db->from("$db1.user_preference");
				$this->db->where("Prefer_userid",$this->session->userdata("myid"));
				$query_prefer_city=$this->db->get();
				$result_prefer=$query_prefer_city->result_array(); 
				foreach($result_prefer as $row_prefer)
				{
					$Prefer_cityname=$row_prefer["Prefer_cityname"];
					$Prefer_courseid=$row_prefer["Prefer_courseid"];
					$Prefer_facultyid=$row_prefer["Prefer_facultyid"];
				}
				if((($Prefer_cityname!="" AND $Prefer_courseid!=0) or $Prefer_facultyid!=0) or (($Prefer_courseid!=0 And $Prefer_facultyid!=0) or $Prefer_cityname!="") or (($Prefer_facultyid!=0 AND $Prefer_cityname!="") or $Prefer_courseid!=0))
				{
					$data["result_search_college_or_course"]=$this->search_model->do_logedinuser_search_college_or_course_model($search_keyword,$Prefer_cityname,$Prefer_courseid,$Prefer_facultyid);
					$data["result_total_recordfound"]=$this->search_model->do_total_recordfoundmodel($search_keyword); 
					$data["result_list_university"]=$this->search_model->list_university_model($search_keyword);  
					$data["result_list_cities"]=$this->search_model->list_cities_model($search_keyword); 
					$data["result_list_category"]=$this->search_model->list_category_model($search_keyword); 	
				}
				else
				{
					$data["result_search_college_or_course"]=$this->search_model->do_search_college_or_course_model($search_keyword);
					$data["result_total_recordfound"]=$this->search_model->do_total_recordfoundmodel($search_keyword); 
					$data["result_list_university"]=$this->search_model->list_university_model($search_keyword);  
					$data["result_list_cities"]=$this->search_model->list_cities_model($search_keyword); 
					$data["result_list_category"]=$this->search_model->list_category_model($search_keyword); 
				}
			}
			else
			{
				$data["result_search_college_or_course"]=$this->search_model->do_search_college_or_course_model($search_keyword);
				$data["result_total_recordfound"]=$this->search_model->do_total_recordfoundmodel($search_keyword); 
				$data["result_list_university"]=$this->search_model->list_university_model($search_keyword);  
				$data["result_list_cities"]=$this->search_model->list_cities_model($search_keyword); 
				$data["result_list_category"]=$this->search_model->list_category_model($search_keyword); 
			}
		}  
		if(isset($_GET["qry"]))	
		{
			if($this->session->userdata("myid"))
			{
				$userid=$this->session->userdata("myid");
				$this->search_model->do_add_keyword_model($userid);
			}	
			else
			{
				$userid=0;
				$this->search_model->do_add_keyword_model($userid);
			}	
				
		} 
		$this->load->view("modules/search_view",$data);  
		$this->load->view("similar/footer_view",$data);   
	}
	public function college_details($Clge_id,$Clge_name)
	{ 
		$data["action"]="view_college";
		$data["Clge_id"]=$Clge_id; 
		if($this->session->userdata("analytics")) {
			$session_name=$this->session->userdata("analytics");
		} else {
			$session_name=md5(uniqid());
			$this->session->set_userdata(['analytics' => $session_name]);
		}
		if($this->session->userdata("myid")) { $userid=$this->session->userdata("myid");} else {$userid='';}	
		$this->analytics_model->setAnalyticsData($session_name,$Clge_id,$ccourse_id='',$userid);
		$data["result_college_details"]=$this->search_model->view_college_details_model($Clge_id,$Clge_name);
		$result_college_details=$this->search_model->view_college_details_model($Clge_id,$Clge_name);
		foreach($result_college_details	as $row_college_details)
		$result_college_courses=$this->search_model->view_college_course_model($Clge_id,$Clge_name); 
		$courses='';
		$srno=1;
		foreach($result_college_courses	as $row_college_courses)
		{
			if($srno!=1){ $courses=$courses.', '.$row_college_courses["Course_short_name"];} else {$courses=$row_college_courses["Course_short_name"];}
			$srno++;
		} 		
		if($row_college_details["count"] < 1)
		{
			redirect(base_url().'index.php/page_not_found');
		}
		$data["result_college_courses"]=$this->search_model->view_college_course_model($Clge_id,$Clge_name);  
		$data["result_list_album"]=$this->search_model->list_album_model($Clge_id);   
		$data["result_count_gallery_image"]=$this->search_model->count_gallery_image_model($Clge_id);
		$data["result_gallery_image"]=$this->search_model->list_gallery_image_model($Clge_id);
		$cyr=date("Y");
		$nxtyr=str_replace("20","",$cyr+1);
		$data["meta_title"]=$row_college_details["Clge_name"].', '.$row_college_details["Clge_city"].', '.$row_college_details["Cntry_name"].' - Admission, Fee, Contact, Facilities '.$cyr.'-'.$nxtyr.' | NCS Online';
		$data["meta_description"]=$row_college_details["Clge_name"].', '.$row_college_details["Clge_city"].', '.$row_college_details["Cntry_name"].' offers programs like '.$courses .'. Get detailed information about admission, fee structure, contact, facilities & much more.';
		$data["result_user_details"]=$this->loggedin_user_info_model->user_details_model();
		$this->load->view("similar/header_view",$data); 
		$this->load->view("similar/menu_view");     
		$this->load->view("modules/search_view",$data);  
		$this->load->view("similar/footer_view");
	}
	public function course_details($Clgecourse_id,$Course_name)
	{ 
		$data["action"]="view_course";  
		$data["Clgecourse_id"]=$Clgecourse_id;  

		$data["result_individual_college_courses"]=$this->search_model->individual_college_course_model($Clgecourse_id,$Course_name);        
		$result_individual_college_courses=$this->search_model->individual_college_course_model($Clgecourse_id,$Course_name);
		foreach($result_individual_college_courses as $row_individual_college_courses)
		if($row_individual_college_courses["count"] < 1)
		{
			redirect(base_url().'index.php/page_not_found');
		}
		$data["meta_title"]=$row_individual_college_courses["Course_name"].' ('.$row_individual_college_courses["Course_short_name"].') at '.$row_individual_college_courses["Clge_name"].' In '.$row_individual_college_courses["Clge_city"].', '.$row_individual_college_courses["Cntry_name"].' |NCS Online'; 
		$data["meta_description"]=$row_individual_college_courses["Clge_name"].' '.$row_individual_college_courses["Clge_city"].', '.$row_individual_college_courses["Cntry_name"].' offers '.$row_individual_college_courses["Course_name"].' ('.$row_individual_college_courses["Course_short_name"].') course. Get detailed information about admission, fee structure, contact, facilities & much more.';
		/* Set Analytics data start*/
		if($this->session->userdata("analytics")) {
			$session_name=$this->session->userdata("analytics");
		} else {
			$session_name=md5(uniqid());
			$this->session->set_userdata(['analytics' => $session_name]);
		}
		if($this->session->userdata("myid")) { $userid=$this->session->userdata("myid");} else {$userid='';}	
		/* Set Analytics data end*/
		$this->analytics_model->setAnalyticsData($session_name,$row_individual_college_courses["Clge_id"],$Clgecourse_id,$userid);
		$data["result_user_details"]=$this->loggedin_user_info_model->user_details_model();
		$this->load->view("similar/header_view",$data); 
		$this->load->view("similar/menu_view");     
		$this->load->view("modules/search_view",$data);  
		$this->load->view("similar/footer_view");   
	}
	public function general_EnquiryAjax()
	{  
		$Cenq_fstname=$this->input->post("Cenq_fstname");
		$Cenq_lstname=$this->input->post("Cenq_lstname");
		$Cenq_email=$this->input->post("Cenq_email");
		$Cenq_contactno=$this->input->post("Cenq_contactno");
		$Cenq_enquirytypeid=$this->input->post("Cenq_enquirytypeid");
		$Cenq_clgecourseid=$this->input->post("Cenq_clgecourseid");
		$Cenq_clgeid=$this->input->post("Cenq_clgeid");
		$Cenq_enquiry_statusid=$this->input->post("Cenq_enquiry_statusid");
		$CEcmntsced_usercomment=$this->input->post("CEcmntsced_usercomment");
			$Cenq_regdate=date('Y-m-d H:i:s');
			 $enquiry_done=$this->search_model->do_general_enquiryAjax_model($Cenq_regdate,$Cenq_fstname,$Cenq_lstname,$Cenq_email,$Cenq_contactno,$Cenq_enquirytypeid,$Cenq_clgecourseid,$Cenq_clgeid,$Cenq_enquiry_statusid,$CEcmntsced_usercomment);
			
			//echo '<script type="text/javascript">alert("hello!");</script>';
			if($enquiry_done)
			{ 
				echo '<meta http-equiv="refresh" content="0;url='.base_url().'enquiry'.'"><b style="color:green"><i class="icon fa fa-check"></i> Thank You For Enquiry!</b>';
			
					//echo '<script type="text/javascript">alert("hello!");</script>';
			}
			else
			{
				echo '<b style="color:red"><i class="icon fa fa-warning"></i>Enquiry Not Done!</b> ';
			}
	}
	public function Add_college_requestAjax()
	{  
		$check_val=$this->check_duplicate_request($this->input->post("Clge_add_email"),$this->input->post("Clge_add_clgeid"));
		if($check_val==1)
		{
			echo'<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
					<h4><i class="icon fa fa-check"></i> College Already Requested</h4> 
				</div>';
			//echo '<meta http-equiv="refresh" content="2"><b style="color:red"><i class="icon fa fa-warning"></i>College Already Requested</b> ';
		}
		else
		{
			$Clge_add_name=$this->input->post("Clge_add_name");
			$Clge_add_email=$this->input->post("Clge_add_email");
			$Clge_add_phone=$this->input->post("Clge_add_phone");
			$Clge_add_clgeid=$this->input->post("Clge_add_clgeid");
			$this->email->from(EMAIL_FROM,EMAIL_FROM_NAME);
			$this->email->to($this->input->post("Clge_add_email"));
			$this->email->set_mailtype("html");
			$this->email->subject("Add New College To Campuskit");
			$message="Hello $Clge_add_name ,Your Request Has Been Successfully Received TO Campuskit. Our Representative Contact You Very Soon on <br/> E-mail :- $Clge_add_email <br/> Phone:- $Clge_add_phone <br/>webmaster@campuskit.org<br/> Thank You.";
			$this->email->message($message);
			if($this->search_model->do_add_request_model($Clge_add_name,$Clge_add_email,$Clge_add_phone,$Clge_add_clgeid))
			{  
				if($this->email->send())
				{
					echo'<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
							<h4><i class="icon fa fa-check"></i> Request Successfully Submitted</h4> 
							</div>';
					//echo '<meta http-equiv="refresh" content="2"><b style="color:green"><i class="icon fa fa-check"></i> Request Successfully Submitted</b>';
				}
				else
				{
					echo'<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
							<h4><i class="icon fa fa-check"></i> Email Not Sent</h4> 
							</div>';
					//echo '<b style="color:red"><i class="icon fa fa-warning"></i>Email Not Sent</b> ';
				}
			}
		}		
	}
	public function check_duplicate_collegeCourseAjax()
	{ 
		$Cenq_clgecourseid=$this->input->post("Cenq_clgecourseid");
		$Cenq_clgeid=$this->input->post("Cenq_clgeid");
		$Clge_name=$this->input->post("Clge_name");
		if($Cenq_clgecourseid)
		{ 
			if($this->search_model->check_duplicate_course_model($this->input->post("Cenq_clgecourseid"),$Cenq_clgeid))
			{
				echo "<span style='color:red'>This Course Enquiry Already Applied For</span>".'<b style="color:red"> '."$Clge_name".'</b>'.'<meta http-equiv="refresh" content="2;url='.base_url().'enquiry'.'">';
			}
			else
			{
				echo "";
			}
		}	
	}
}
?>