<?php 
defined("BASEPATH") OR exit("No Direct Script Allowed");
class Admission_form extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("common/admission_form_model");
		$this->load->model("common/loggedin_user_info_model"); 
	}
	public function index()
	{
		if($this->session->userdata("is_loged_in"))
		{  
			if($result_user_details=$this->loggedin_user_info_model->user_details_model())
			{  	  
				$data["result_user_details"]=$this->loggedin_user_info_model->user_details_model();  
				if(isset($_POST["update_personal_details"]) && $_POST["do_update_personal_details"])
				{
					if($_FILES["Cenq_profilepic"]["name"]=='')
					{
						$realfile=$this->input->post("Cenq_profilepic_hidden");
						if($this->admission_form_model->update_personal_detail_model($realfile))
						{ 
							$data["msg"]="<img height='30' width='30' src='".base_url()."img/a1.png'><span style='color:green'>Updated Successfully</span><meta http-equiv='refresh' content='1;url=".base_url()."admission_form?myid=".$this->input->get("myid")."'>"; 	
						}
						else
						{
							$data["msg"]="<img height='30' width='30' src='".base_url()."img/a2.png'><span style='color:red'>Not Updated</span>";
						}
					}
					else
					{
						$config['upload_path']='./admin/uploads/users/thumbs/';
						$config["allowed_types"]='gif|GIF|jpg|JPG|jpeg|JPEG|png|PNG';
						$config["max_size"]=100;
						$config["max_width"]=1024;
						$config["max_height"]=768;   
						$name=$this->input->post("Cenq_fstname");
						$ext = strtolower(pathinfo($_FILES["Cenq_profilepic"]['name'], PATHINFO_EXTENSION)); 
						$name=str_replace(' ', '-', $name);
						$name=preg_replace('/[^A-Za-z0-9\-]/', '', $name);
						$realfile = time().$name.'.'.$ext; 
						$config['file_name'] = $realfile;
						$this->load->library("upload",$config);
						if(!$this->upload->do_upload('Cenq_profilepic'))
						{
							$data["msg"]="<img height='30' width='30' src='".base_url()."img/a2.png'><span style='color:red'>".$this->upload->display_errors()."</span>"; 
						}
						else
						{
							if($this->admission_form_model->update_personal_detail_model($realfile))
							{
								$delete_image=$this->input->post('Cenq_profilepic_hidden');
								if($delete_image!=''){ unlink("./admin/uploads/users/thumbs/".$delete_image); }
								$data = array('upload_data' => $this->upload->data());
								//$data["msg"]="<img height='30' width='30' src='".base_url()."img/a1.png'><span style='color:green'>Updated Successfully</span><meta http-equiv='refresh' content='100;url=".base_url()."admission_form?myid=".$this->input->get("myid")."'>";
								redirect(base_url()."admission_form?myid=".$this->input->get("myid"));	
							}
							else
							{
								$data["msg"]="<img height='30' width='30' src='".base_url()."img/a2.png'><span style='color:red'>Not Updated</span>";
							}
						} 
					}
				}
				$data["result_medical_details"]=$this->admission_form_model->medical_details_model();
				$data["result_purpose_details"]=$this->admission_form_model->purpose_details_model();
				$data["result_activities_details"]=$this->admission_form_model->activities_details_model();
				$data["result_list_all_refrences"]=$this->admission_form_model->list_all_refrences_model();
				$data["result_list_all_employment"]=$this->admission_form_model->list_all_employment_model();
				$data["result_list_totalworkexperience"]=$this->admission_form_model->list_totalworkexperience_model();
				$data["result_list_all_family"]=$this->admission_form_model->list_all_family_model();
				$data["result_list_all_currentAddress"]=$this->admission_form_model->list_all_currentAddress_model();
				$data["result_list_all_permanentAddress"]=$this->admission_form_model->list_all_permanentAddress_model();
				$data["result_list_checkpreviouseducation"]=$this->admission_form_model->list_checkpreviouseducation_model();
				$data["result_list_previouseducation"]=$this->admission_form_model->list_previouseducation_model();
				$data["result_presonal_details"]=$this->admission_form_model->personal_details_model(); 
				$this->load->view("common/header_view",$data);  
				if(isset($_POST["upload_marksheet"]))
				{
					$config['upload_path']='./admin/uploads/marksheets/';
					$config["allowed_types"]='gif|GIF|jpg|JPG|jpeg|JPEG|png|PNG|pdf|doc|docx';
					$config["max_size"]=1000;
					$config["max_width"]=1024;
					$config["max_height"]=768;   
					$name=$this->input->post("Cenq_fstname");
					$ext = strtolower(pathinfo($_FILES["UPQfiles_name"]['name'], PATHINFO_EXTENSION)); 
					$name=str_replace(' ', '-', $name);
					$name=preg_replace('/[^A-Za-z0-9\-]/', '', $name);
					$realfile = time().$name.'.'.$ext; 
					$config['file_name'] = $realfile;
					$this->load->library("upload",$config);
					if(!$this->upload->do_upload('UPQfiles_name'))
					{
						$data["msg"]="<img height='30' width='30' src='".base_url()."img/a2.png'><span style='color:red'>".$this->upload->display_errors()."</span>"; 
					}
					else
					{
						if($this->admission_form_model->upload_files_model($realfile))
						{
							$data=array('upload_data'=>$this->upload->data()); 
							$data["msg"]= "<img height='30' width='30' src='".base_url()."img/a1.png'><span style='color:green'>Saved Successfully</span><meta http-equiv='refresh' content='1;url=".base_url()."admission_form?myid=".$this->input->get("myid")."&tab=education'>";
						}
						else
						{
							$data["msg"]="<img height='30' width='30' src='".base_url()."img/a2.png'><span style='color:red'>Not Saved</span>";
						}
					}
				} 
				$this->load->view("common/admission_form_view",$data); 
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
	public function AddUpdatemedicalAjax()
	{
		$CEmedicalcondition_enquiryid=$this->input->post("CEmedicalcondition_enquiryid");
		$CEmedicalcondition_bgid=$this->input->post("CEmedicalcondition_bgid");
		$CEmedicalcondition_details=$this->input->post("CEmedicalcondition_details");
		if($this->admission_form_model->Addupdate_medical_detail_model($CEmedicalcondition_enquiryid,$CEmedicalcondition_bgid,$CEmedicalcondition_details))
		{
			echo "<img height='30' width='30' src='".base_url()."img/a1.png'><span style='color:green'>Saved</span>";
			echo "<meta http-equiv='refresh' content='1;url=".base_url()."admission_form?myid=".$CEmedicalcondition_enquiryid."&tab=medical'>";
		}
		else
		{
			echo "<img height='30' width='30' src='".base_url()."img/a2.png'><span style='color:red'>Not Saved</span>";
		}
	}
	public function AddUpdatepurposeAjax()
	{
		$CEpurpose_enquiryid=$this->input->post("CEpurpose_enquiryid");
		$CEpurpose_details=$this->input->post("CEpurpose_details");
		if($this->admission_form_model->Addupdate_purpose_model($CEpurpose_enquiryid,$CEpurpose_details))
		{
			echo "<img height='30' width='30' src='".base_url()."img/a1.png'><span style='color:green'>Saved</span>";
			echo "<meta http-equiv='refresh' content='1;url=".base_url()."admission_form?myid=".$CEpurpose_enquiryid."&tab=purpose'>";
		}
		else
		{
			echo "<img height='30' width='30' src='".base_url()."img/a2.png'><span style='color:red'>Not Saved</span>";
		}
	}
	public function AddUpdateactivityAjax()
	{
		$CEaward_enquiryid=$this->input->post("CEaward_enquiryid");
		$CEaward_details=$this->input->post("CEaward_details");
		if($this->admission_form_model->Addupdate_activity_model($CEaward_enquiryid,$CEaward_details))
		{
			echo "<img height='30' width='30' src='".base_url()."img/a1.png'><span style='color:green'>Saved</span>";
			echo "<meta http-equiv='refresh' content='1;url=".base_url()."admission_form?myid=".$CEaward_enquiryid."&tab=activities'>";
		}
		else
		{
			echo "<img height='30' width='30' src='".base_url()."img/a2.png'><span style='color:red'>Not Saved</span>";
		}
	} 
	public function add_referenceAjax()
	{
		$CEreferredby_enquiryid=$this->input->post("CEreferredby_enquiryid");
		$CEreferredby_name=$this->input->post("CEreferredby_name");
		$CEreferredby_occupation=$this->input->post("CEreferredby_occupation");
		$CEreferredby_organization=$this->input->post("CEreferredby_organization");
		$CEreferredby_relation=$this->input->post("CEreferredby_relation");
		$CEreferredby_address=$this->input->post("CEreferredby_address");
		$CEreferredby_phoneno=$this->input->post("CEreferredby_phoneno");
		$CEreferredby_mobileno=$this->input->post("CEreferredby_mobileno");
		if($this->admission_form_model->add_reference_model($CEreferredby_enquiryid,$CEreferredby_name,$CEreferredby_occupation,$CEreferredby_organization,$CEreferredby_relation,$CEreferredby_address,$CEreferredby_phoneno,$CEreferredby_mobileno))
		{
			echo "<img height='30' width='30' src='".base_url()."img/a1.png'><span style='color:green'>Added Successfully</span>";
			echo "<meta http-equiv='refresh' content='1;url=".base_url()."admission_form?myid=".$CEreferredby_enquiryid."&tab=references'>";
		}
		else
		{
			echo "<img height='30' width='30' src='".base_url()."img/a2.png'><span style='color:red'>Not Added</span>";
		}
	}
	public function update_referenceAjax()
	{
		$CEreferredby_id=$this->input->post("CEreferredby_id");
		$CEreferredby_enquiryid=$this->input->post("CEreferredby_enquiryid");
		$CEreferredby_name=$this->input->post("CEreferredby_name");
		$CEreferredby_occupation=$this->input->post("CEreferredby_occupation");
		$CEreferredby_organization=$this->input->post("CEreferredby_organization");
		$CEreferredby_relation=$this->input->post("CEreferredby_relation");
		$CEreferredby_address=$this->input->post("CEreferredby_address");
		$CEreferredby_phoneno=$this->input->post("CEreferredby_phoneno");
		$CEreferredby_mobileno=$this->input->post("CEreferredby_mobileno");
		if($this->admission_form_model->update_reference_model($CEreferredby_id,$CEreferredby_name,$CEreferredby_occupation,$CEreferredby_organization,$CEreferredby_relation,$CEreferredby_address,$CEreferredby_phoneno,$CEreferredby_mobileno))
		{
			echo "<img height='30' width='30' src='".base_url()."img/a1.png'><span style='color:green'>Updated Successfully</span>";
			echo "<meta http-equiv='refresh' content='1;url=".base_url()."admission_form?myid=".$CEreferredby_enquiryid."&tab=references'>";
		}
		else
		{
			echo "<img height='30' width='30' src='".base_url()."img/a2.png'><span style='color:red'>Not Updated</span>";
		}
	}
	public function add_employmentAjax()
	{
		$CEemployment_enquiryid=$this->input->post("CEemployment_enquiryid");
		$CEemployment_organization=$this->input->post("CEemployment_organization");
		$CEemployment_address=$this->input->post("CEemployment_address");
		$CEemployment_contactno=$this->input->post("CEemployment_contactno");
		$CEemployment_designation=$this->input->post("CEemployment_designation");
		$CEemployment_keyrole=$this->input->post("CEemployment_keyrole");
		$CEemployment_duration=$this->input->post("CEemployment_duration");
		$CEemployment_fromyr=$this->input->post("CEemployment_fromyr");
		$CEemployment_toyr=$this->input->post("CEemployment_toyr");
		if($this->admission_form_model->add_employment_model($CEemployment_enquiryid,$CEemployment_organization,$CEemployment_address,$CEemployment_contactno,$CEemployment_designation,$CEemployment_keyrole,$CEemployment_duration,$CEemployment_fromyr,$CEemployment_toyr))
		{
			echo "<img height='30' width='30' src='".base_url()."img/a1.png'><span style='color:green'>Added Successfully</span>";
			echo "<meta http-equiv='refresh' content='1;url=".base_url()."admission_form?myid=".$CEemployment_enquiryid."&tab=employment'>";
		}
		else
		{
			echo "<img height='30' width='30' src='".base_url()."img/a2.png'><span style='color:red'>Not Added</span>";
		}
	}
	public function AddUpdateTotalExpAjax()
	{
		$CETWexperience_enquiryid=$this->input->post("CETWexperience_enquiryid");
		$CETWexperience_total=$this->input->post("CETWexperience_total");
		if($this->admission_form_model->add_update_totalexp_model($CETWexperience_enquiryid,$CETWexperience_total))
		{
			echo "<img height='30' width='30' src='".base_url()."img/a1.png'><span style='color:green'>Saved Successfully</span>";
			echo "<meta http-equiv='refresh' content='1;url=".base_url()."admission_form?myid=".$CETWexperience_enquiryid."&tab=employment'>";
		}
		else
		{
			echo "<img height='30' width='30' src='".base_url()."img/a2.png'><span style='color:red'>Not Saved</span>";
		}
	}
	public function update_employmentAjax()
	{
		$CEemployment_id=$this->input->post("CEemployment_id");
		$CEemployment_enquiryid=$this->input->post("CEemployment_enquiryid");
		$CEemployment_organization=$this->input->post("CEemployment_organization");
		$CEemployment_address=$this->input->post("CEemployment_address");
		$CEemployment_contactno=$this->input->post("CEemployment_contactno");
		$CEemployment_designation=$this->input->post("CEemployment_designation");
		$CEemployment_keyrole=$this->input->post("CEemployment_keyrole");
		$CEemployment_duration=$this->input->post("CEemployment_duration");
		$CEemployment_fromyr=$this->input->post("CEemployment_fromyr");
		$CEemployment_toyr=$this->input->post("CEemployment_toyr");
		if($this->admission_form_model->update_employment_model($CEemployment_id,$CEemployment_organization,$CEemployment_address,$CEemployment_contactno,$CEemployment_designation,$CEemployment_keyrole,$CEemployment_duration,$CEemployment_fromyr,$CEemployment_toyr))
		{
			echo "<img height='30' width='30' src='".base_url()."img/a1.png'><span style='color:green'>Updated Successfully</span>";
			echo "<meta http-equiv='refresh' content='1;url=".base_url()."admission_form?myid=".$CEemployment_enquiryid."&tab=employment'>";
		}
		else
		{
			echo "<img height='30' width='30' src='".base_url()."img/a2.png'><span style='color:red'>Not Updated</span>";
		}
	}
	public function updatepreveductaionAjax()
	{
		$UPQ_id=$this->input->post("UPQ_id");
		$UPQ_enquiryid=$this->input->post("UPQ_enquiryid");
		$UPQ_prev_course=$this->input->post("UPQ_prev_course");
		$UPQ_prev_ctypeid=$this->input->post("UPQ_prev_ctypeid");
		$UPQ_prev_marks=$this->input->post("UPQ_prev_marks");
		$UPQ_prev_clgename=$this->input->post("UPQ_prev_clgename");
		$UPQ_prev_clgeaddress=$this->input->post("UPQ_prev_clgeaddress");
		$UPQ_prev_clgeuniversity=$this->input->post("UPQ_prev_clgeuniversity");
		$UPQ_prev_yearofcompletion=$this->input->post("UPQ_prev_yearofcompletion");
		if($this->admission_form_model->update_eductaion_model($UPQ_id,$UPQ_prev_course,$UPQ_prev_ctypeid,$UPQ_prev_marks,$UPQ_prev_clgename,$UPQ_prev_clgeaddress,$UPQ_prev_clgeuniversity,$UPQ_prev_yearofcompletion))
		{
			echo "<img height='30' width='30' src='".base_url()."img/a1.png'><span style='color:green'>Updated Successfully</span>";
			echo "<meta http-equiv='refresh' content='1;url=".base_url()."admission_form?myid=".$UPQ_enquiryid."&tab=education'>";
		}
		else
		{
			echo "<img height='30' width='30' src='".base_url()."img/a2.png'><span style='color:red'>Not Updated</span>";
		}
	}
	public function AddpreveductaionAjax()
	{
		$UPQ_enquiryid=$this->input->post("UPQ_enquiryid");
		$UPQ_prev_course=$this->input->post("UPQ_prev_course");
		$UPQ_prev_ctypeid=$this->input->post("UPQ_prev_ctypeid");
		$UPQ_prev_marks=$this->input->post("UPQ_prev_marks");
		$UPQ_prev_clgename=$this->input->post("UPQ_prev_clgename");
		$UPQ_prev_clgeaddress=$this->input->post("UPQ_prev_clgeaddress");
		$UPQ_prev_clgeuniversity=$this->input->post("UPQ_prev_clgeuniversity");
		$UPQ_prev_yearofcompletion=$this->input->post("UPQ_prev_yearofcompletion");
		if($this->admission_form_model->add_eductaion_model($UPQ_enquiryid,$UPQ_prev_course,$UPQ_prev_ctypeid,$UPQ_prev_marks,$UPQ_prev_clgename,$UPQ_prev_clgeaddress,$UPQ_prev_clgeuniversity,$UPQ_prev_yearofcompletion))
		{
			echo "<img height='30' width='30' src='".base_url()."img/a1.png'><span style='color:green'>Saved Successfully</span>";
			echo "<meta http-equiv='refresh' content='1;url=".base_url()."admission_form?myid=".$UPQ_enquiryid."&tab=education'>";
		}
		else
		{
			echo "<img height='30' width='30' src='".base_url()."img/a2.png'><span style='color:red'>Not Saved</span>";
		}
	}
	public function add_familyAjax()
	{  
		$CEfamily_enquiryid=$this->input->post("CEfamily_enquiryid");
		$CEfamily_familytypeid=$this->input->post("CEfamily_familytypeid");
		$CEfamily_fstname=$this->input->post("CEfamily_fstname");
		$CEfamily_lstname=$this->input->post("CEfamily_lstname");
		$CEfamily_occupation=$this->input->post("CEfamily_occupation");
		$CEfamily_nationality=$this->input->post("CEfamily_nationality");
		$CEfamily_phoneno=$this->input->post("CEfamily_phoneno");
		$CEfamily_mobileno=$this->input->post("CEfamily_mobileno");
		if($this->admission_form_model->add_family_model($CEfamily_enquiryid,$CEfamily_familytypeid,$CEfamily_fstname,$CEfamily_lstname,$CEfamily_occupation,$CEfamily_nationality,$CEfamily_phoneno,$CEfamily_mobileno))
		{
			echo "<img height='30' width='30' src='".base_url()."img/a1.png'><span style='color:green'>Added Successfully</span>";
			echo "<meta http-equiv='refresh' content='1;url=".base_url()."admission_form?myid=".$CEfamily_enquiryid."&tab=family'>";
		}
		else
		{
			echo "<img height='30' width='30' src='".base_url()."img/a2.png'><span style='color:red'>Not Added</span>";
		}
	}
	public function update_familyAjax()
	{  
		$CEfamily_id=$this->input->post("CEfamily_id");
		$CEfamily_enquiryid=$this->input->post("CEfamily_enquiryid");
		$CEfamily_familytypeid=$this->input->post("CEfamily_familytypeid");
		$CEfamily_fstname=$this->input->post("CEfamily_fstname");
		$CEfamily_lstname=$this->input->post("CEfamily_lstname");
		$CEfamily_occupation=$this->input->post("CEfamily_occupation");
		$CEfamily_nationality=$this->input->post("CEfamily_nationality");
		$CEfamily_phoneno=$this->input->post("CEfamily_phoneno");
		$CEfamily_mobileno=$this->input->post("CEfamily_mobileno");
		if($this->admission_form_model->update_family_model($CEfamily_id,$CEfamily_familytypeid,$CEfamily_fstname,$CEfamily_lstname,$CEfamily_occupation,$CEfamily_nationality,$CEfamily_phoneno,$CEfamily_mobileno))
		{
			echo "<img height='30' width='30' src='".base_url()."img/a1.png'><span style='color:green'>Updated Successfully</span>";
			echo "<meta http-equiv='refresh' content='1;url=".base_url()."admission_form?myid=".$CEfamily_enquiryid."&tab=family'>";
		}
		else
		{
			echo "<img height='30' width='30' src='".base_url()."img/a2.png'><span style='color:red'>Not Updated</span>";
		}
	}  
	public function addupdate_currentAddressAjax()
	{
		$CEaddress_enquiryid=$this->input->post("CEaddress_enquiryid");
		$CEaddress_addresstypeid=$this->input->post("CEaddress_addresstypeid");
		$CEaddress_phoneno=$this->input->post("CEaddress_phoneno");
		$CEaddress_mobileno=$this->input->post("CEaddress_mobileno");
		$CEaddress_houseno=$this->input->post("CEaddress_houseno");
		$CEaddress_wardno=$this->input->post("CEaddress_wardno");
		$CEaddress_town_village=$this->input->post("CEaddress_town_village");
		$CEaddress_district=$this->input->post("CEaddress_district");
		$CEaddress_zone=$this->input->post("CEaddress_zone");
		$CEaddress_country=$this->input->post("CEaddress_country");
		$make_permanent=$this->input->post("make_permanent");
		if($this->admission_form_model->addupdate_Address_model($CEaddress_enquiryid,$CEaddress_addresstypeid,$CEaddress_phoneno,$CEaddress_mobileno,$CEaddress_houseno,$CEaddress_wardno,$CEaddress_town_village,$CEaddress_district,$CEaddress_zone,$CEaddress_country))
		{
			if($make_permanent=="yes")
			{
				$CEaddress_addresstypeid=2;
				if($this->admission_form_model->addupdate_Address_model($CEaddress_enquiryid,$CEaddress_addresstypeid,$CEaddress_phoneno,$CEaddress_mobileno,$CEaddress_houseno,$CEaddress_wardno,$CEaddress_town_village,$CEaddress_district,$CEaddress_zone,$CEaddress_country))
				{
					echo "<img height='30' width='30' src='".base_url()."img/a1.png'><span style='color:green'>Saved Successfully</span>";
					echo "<meta http-equiv='refresh' content='1;url=".base_url()."admission_form?myid=".$CEaddress_enquiryid."&tab=contact'>";
				}
				else
				{
					echo "<img height='30' width='30' src='".base_url()."img/a2.png'><span style='color:red'>Not Saved</span>";
				}
			}
			else
			{
				echo "<img height='30' width='30' src='".base_url()."img/a1.png'><span style='color:green'>Saved Successfully</span>";
				echo "<meta http-equiv='refresh' content='1;url=".base_url()."admission_form?myid=".$CEaddress_enquiryid."&tab=contact'>";
			}
		}
		else
		{
			echo "<img height='30' width='30' src='".base_url()."img/a2.png'><span style='color:red'>Not Saved</span>";
		}
	}
	public function addupdate_permanentAddressAjax()
	{
		$CEaddress_enquiryid=$this->input->post("CEaddress_enquiryid");
		$CEaddress_addresstypeid=$this->input->post("CEaddress_addresstypeid");
		$CEaddress_phoneno=$this->input->post("CEaddress_phoneno");
		$CEaddress_mobileno=$this->input->post("CEaddress_mobileno");
		$CEaddress_houseno=$this->input->post("CEaddress_houseno");
		$CEaddress_wardno=$this->input->post("CEaddress_wardno");
		$CEaddress_town_village=$this->input->post("CEaddress_town_village");
		$CEaddress_district=$this->input->post("CEaddress_district");
		$CEaddress_zone=$this->input->post("CEaddress_zone");
		$CEaddress_country=$this->input->post("CEaddress_country"); 
		if($this->admission_form_model->addupdate_Address_model($CEaddress_enquiryid,$CEaddress_addresstypeid,$CEaddress_phoneno,$CEaddress_mobileno,$CEaddress_houseno,$CEaddress_wardno,$CEaddress_town_village,$CEaddress_district,$CEaddress_zone,$CEaddress_country))
		{ 
			echo "<img height='30' width='30' src='".base_url()."img/a1.png'><span style='color:green'>Saved Successfully</span>";
			echo "<meta http-equiv='refresh' content='1;url=".base_url()."admission_form?myid=".$CEaddress_enquiryid."&tab=contact'>"; 
		}
		else
		{
			echo "<img height='30' width='30' src='".base_url()."img/a2.png'><span style='color:red'>Not Saved</span>";
		}
	}
}
?>