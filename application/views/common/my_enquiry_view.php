<?php
defined("BASEPATH") or exit("No Direct Script Allowed"); 
$action=isset($_REQUEST["action"])  ? $_REQUEST["action"]:"list_my_enquiry";
?>  
<script>
/*---------------------------------------------------------------------------------
form validation while searching College
*--------------------------------------------------------------------------------*/
function search_validate()
{
	var search_keyword=searchForm.search_keyword.value;
	search_keyword=search_keyword.trim();
	if(search_keyword=="" || search_keyword==null)
	{
		document.getElementById("search_keyword").innerHTML="";
		searchForm.search_keyword.focus();
		return false;
	} 
} 
</script>
<script>
function Clge_enquiryValidate()
{
	var CEcmntsced_usercomment=Clge_enquiry.CEcmntsced_usercomment.value;
	CEcmntsced_usercomment=CEcmntsced_usercomment.trim(); 
	if(CEcmntsced_usercomment=="" || CEcmntsced_usercomment==null)
	{
		document.getElementById("CEcmntsced_usercomment").innerHTML="* Required";
		Clge_enquiry.CEcmntsced_usercomment.focus();
		return false;
	}
	if(CEcmntsced_usercomment!="" || CEcmntsced_usercomment!=null)
	{
		document.getElementById("CEcmntsced_usercomment").innerHTML="";
	} 
	if(Clge_enquiry.Cenq_enquirytypeid.selectedIndex==0)
	{
		document.getElementById("Cenq_enquirytypeid").innerHTML="* Required";
		Clge_enquiry.Cenq_enquirytypeid.focus();
		return false;
	}
	if(Clge_enquiry.Cenq_enquirytypeid.selectedIndex!=0)
	{
		document.getElementById("Cenq_enquirytypeid").innerHTML="";
	}
	if(Clge_enquiry.Cenq_enquirytypeid.value=="2")
	{
		var UPQ_prev_course=Clge_enquiry.UPQ_prev_course.value;
		UPQ_prev_course=UPQ_prev_course.trim();
		var UPQ_prev_clgename=Clge_enquiry.UPQ_prev_clgename.value;
		UPQ_prev_clgename=UPQ_prev_clgename.trim(); 
		var UPQ_prev_marks=Clge_enquiry.UPQ_prev_marks.value;
		UPQ_prev_marks=UPQ_prev_marks.trim();   
		var CEcmntsced_visiting_date=Clge_enquiry.CEcmntsced_visiting_date.value;
		CEcmntsced_visiting_date=CEcmntsced_visiting_date.trim();   
		if(Clge_enquiry.Cenq_clgecourseid.selectedIndex==0)
		{
			document.getElementById("Cenq_clgecourseid").innerHTML="* Required";
			Clge_enquiry.Cenq_clgecourseid.focus();
			return false;
		}
		if(Clge_enquiry.Cenq_clgecourseid.selectedIndex!=0)
		{
			document.getElementById("Cenq_clgecourseid").innerHTML="";
		}
		if(UPQ_prev_course=="" || UPQ_prev_course==null)
		{
			document.getElementById("UPQ_prev_course").innerHTML="* Required";
			Clge_enquiry.UPQ_prev_course.focus();
			return false;
		}
		if(UPQ_prev_course!="" || UPQ_prev_course!=null)
		{
			document.getElementById("UPQ_prev_course").innerHTML="";
		}
		if(Clge_enquiry.UPQ_prev_ctypeid.selectedIndex==0)
		{
			document.getElementById("UPQ_prev_ctypeid").innerHTML="* Required";
			Clge_enquiry.UPQ_prev_ctypeid.focus();
			return false;
		}
		if(Clge_enquiry.UPQ_prev_ctypeid.selectedIndex!=0)
		{
			document.getElementById("UPQ_prev_ctypeid").innerHTML="";
		}
		if(UPQ_prev_clgename=="" || UPQ_prev_clgename==null)
		{
			document.getElementById("UPQ_prev_clgename").innerHTML="* Required";
			Clge_enquiry.UPQ_prev_clgename.focus();
			return false;
		} 
		if(UPQ_prev_clgename!="" || UPQ_prev_clgename!=null)
		{
			document.getElementById("UPQ_prev_clgename").innerHTML="";
		}
		if(UPQ_prev_marks=="" || UPQ_prev_marks==null)
		{
			document.getElementById("UPQ_prev_marks").innerHTML="* Required";
			Clge_enquiry.UPQ_prev_marks.focus();
			return false;
		} 
		if(UPQ_prev_marks!="" || UPQ_prev_marks!=null)
		{
			document.getElementById("UPQ_prev_marks").innerHTML="";
		} 
		if(CEcmntsced_visiting_date=="" || CEcmntsced_visiting_date==null)
		{
			document.getElementById("CEcmntsced_visiting_date").innerHTML="* Required";
			Clge_enquiry.CEcmntsced_visiting_date.focus();
			return false;
		} 
		if(CEcmntsced_visiting_date!="" || CEcmntsced_visiting_date!=null)
		{
			document.getElementById("CEcmntsced_visiting_date").innerHTML="";
		} 	
		if(Clge_enquiry.CEcmntsced_visiting_time.selectedIndex==0)
		{
			document.getElementById("CEcmntsced_visiting_time").innerHTML="* Required";
			Clge_enquiry.CEcmntsced_visiting_time.focus();
			return false;
		}
		if(Clge_enquiry.CEcmntsced_visiting_time.selectedIndex!=0)
		{
			document.getElementById("CEcmntsced_visiting_time").innerHTML="";
		}
	}
}
</script>
<script>
function admissionEnquiryAjax(Cenq_enquirytypeid)
{
	if(Cenq_enquirytypeid=="2")
	{
		$("#showAdmissionForm").show();
	}
	else
	{
		$("#showAdmissionForm").hide();
	}
}
</script>
<script>
function sortresultCollege()
{
	var search_keyword=Sort.search_keyword.value;
	search_keyword=search_keyword.trim();
	var Univ_id=Sort.Univ_id.value;
	Univ_id=Univ_id.trim();
	var Clge_city=Sort.Clge_city.value;
	Clge_city=Clge_city.trim(); 
	$("#loading_search").show();
		$.post("<?php echo base_url(); ?>enquiry/sort_college_resultAjax",{search_keyword:search_keyword,Univ_id:Univ_id,Clge_city:Clge_city},function(data){
			$("#loading_search").hide();
			$("#hidepostResult").hide();
			$("#sortResult").html(data);
		});
}
</script> 
<div class="content-wrapper">
<?php 
if($action=="enquiry_search")
{
?> 
    <div class="container"> 
		<section class="content">
			<div class="row">  
				<div class="login-box"> 
					<div class="login-box-body">
						<p class="login-box-msg">Search College by College Name , Course Type(or Level) , Course (Or Programs)  </b></p> 
						<form  name="searchForm" action="" method="post"  onsubmit="return search_validate();"> 
							<input type="hidden" name="do_search_college" value="true">
							<div class="input-group input-group-sm">
								<input class="form-control" type="text" name="search_keyword" placeholder="Search College here" value="<?php echo $this->input->post("search_keyword"); ?>">
								<span class="input-group-btn">
									<button class="btn btn-info btn-flat" name="search_college" type="submit"><b><i class="fa fa-search"></i> </b></button>
								</span>
							</div>
							<span id="search_keyword"></span>
						</form> 
					</div> 
				</div>
			</div>	
		</section> 
	</div>	     
	<center style="font-size:25px">
		<span id="loading_search" style="display:none">
			<div class="overlay">
				<i style="color:#DC143C" class="fa fa-refresh fa-spin"></i>
			</div>
		</span>
	</center>  
	<?php if(isset($_POST["search_college"])) {?>
	<div class="container"> 
		<section class="content">
			<div class="row">
				<div class="col-xs-14"> 
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">Search Result for <b style="color:red"><?php echo $this->input->post("search_keyword");  ?></b></h3> <br/><br/> 
								<form name="Sort"  action="">
									<input type="hidden" name="search_keyword" value="<?php echo $this->input->post("search_keyword"); ?>">
									<select name="Univ_id" style="height:30px">
										<option value="all">All Uniersity</option>
										<?php  
										foreach($result_list_university as $row_list_university) {?>	 
										<option value="<?php echo $row_list_university["Univ_id"]; ?>"><?php echo ucwords($row_list_university["Univ_name"]); ?></option> 
										<?php } ?>	
									</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<select name="Clge_city" style="height:30px">
										<option value="all">All City</option>
										<?php foreach($result_list_cities as $row_list_cities) { ?>	 
										<option value="<?php echo $row_list_cities["Clge_city"]; ?>"><?php echo ucwords($row_list_cities["Clge_city"]); ?></option> 
										<?php }?>
									</select> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<input type="button" style="height:30px" name="sort_college_result" onclick="return sortresultCollege();" value="Sort">&nbsp;&nbsp;
									<input type="reset" style="height:30px" value="Clear">
								</form>	
						</div><!-- /.box-header --> 
						<div id="sortResult">
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
								foreach($result_college_search as $row_college_search)	
								{
									if($row_college_search["Clge_logo"]=='') {$image="no-image.jpg";} else{ $image=$row_college_search["Clge_logo"]; }
								?>
									<tr style="font-size:15px;text-transform:capitalize"> 
										<td>
											<img src="<?php echo FILE_PATH; ?>uploads/colleges/thumbs/<?php echo $image; ?>" class="img-square" width="170px" alt="<?php echo $row_college_search["Clge_logo"]; ?>" />
										</td>
										<td>
											<a href="<?php echo base_url();?>enquiry?action=view_college_details&clgeid=<?php echo $row_college_search["Clge_id"];?>"  target="_blank"><b><?php echo $row_college_search["Clge_name"]; ?> (<?php echo $row_college_search["Ctype_name"]; ?>)</b></a><br/> 
											Address :- <?php echo $row_college_search["Clge_address1"]; ?> , <?php echo $row_college_search["Clge_address2"]; ?> , <?php echo $row_college_search["Clge_postcode"]; ?> , <?php echo $row_college_search["Clge_city"]; ?> , <?php echo $row_college_search["Dist_name"]; ?> , <?php echo $row_college_search["Zon_name"]; ?> , <?php echo $row_college_search["Cntry_name"]; ?><br/> 
											Email :- <?php echo $row_college_search["Clge_email"]; ?> <br/>
											Number :- <?php echo $row_college_search["Clge_contct_no"]; ?> <br/>
											<a class="btn btn-info" href="<?php echo base_url();?>enquiry?action=do_enquiry&clgeid=<?php echo $row_college_search["Clge_id"];?>"  target="_blank">Enquiry Now</a>&nbsp;&nbsp;
											<a class="btn btn-success" href="<?php echo base_url();?>enquiry?action=view_college_details&clgeid=<?php echo $row_college_search["Clge_id"];?>" target="_blank">More Details</a>
										</td>    
									</tr>  
								<?php } ?>	
								</tbody> 
							</table>
						</div><!-- /.box-body -->  
						</div>
					</div><!-- /.box -->
				</div><!-- /.col -->
			</div><!-- /.row -->
        </section><!-- /.content -->
	</div>
<?php 
	}
}
elseif($action=="view_college_details")
{
	if(!is_numeric($_GET["clgeid"]))
	{
		redirect(base_url()."page_not_found");
	}
	foreach($result_college_details as $row_college_details)
	if($row_college_details["count"] < 1)
	{
		redirect(base_url()."page_not_found");
	}
	else
	{
		if($row_college_details["Clge_logo"]=='') {$image="no-image.jpg";} else{ $image=$row_college_details["Clge_logo"]; }
?>
        <div class="container"> 
        <section class="content-header">
			<h1>   View College Details </h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li> 
				<li class="active">View College</li>
			</ol>
        </section>
		</div>	
        <div class="container">  
			<section class="content"> 
				<div class="row">
					<div class="col-md-14">  
						<ul class="timeline"> 
							<li class="time-label">
								<span class="bg-red">
									Est Year <?php echo $row_college_details["Clge_est_yr"];?>
								</span>
							</li> 
							<li>
								<i class="fa fa-bank bg-blue"></i>
								<div class="timeline-item"> 
									<h3 class="timeline-header"><b><?php echo ucwords($row_college_details["Clge_name"]);?></b></h3>
									<div class="timeline-body">
										<b>College Type :-</b> <?php echo $row_college_details["Ctype_name"]; ?> <hr/>
										<a href="<?php echo base_url();?>enquiry?action=do_enquiry&clgeid=<?php echo $row_college_details["Clge_id"];?>" class="btn btn-info">Get Contact Details on Email/SMS (Or Do Enquiry)</a>
									</div> 
								</div>
							</li> 
							<li>
								<i class="fa fa-globe bg-aqua"></i>
								<div class="timeline-item"> 
									<h3 class="timeline-header no-border"> 
										<b>Address :-</b> <?php echo $row_college_details["Clge_address1"]; ?> , <?php echo $row_college_details["Clge_address2"]; ?> , <?php echo $row_college_details["Clge_postcode"]; ?> , <?php echo $row_college_details["Clge_city"]; ?> , <?php echo $row_college_details["Dist_name"]; ?> , <?php echo $row_college_details["Zon_name"]; ?> , <?php echo $row_college_details["Cntry_name"]; ?><hr/> 
										<b>Contact Email :-</b> <?php echo $row_college_details["Clge_email"]; ?> <hr/>
										<b>Contact Number :-</b> <?php echo $row_college_details["Clge_contct_no"]; ?><hr/> 
										<b>Website :-</b> <?php echo $row_college_details["Clge_website"]; ?><hr/> 
									</h3>
								</div>
							</li> 
							<li>
								<i class="fa fa-book bg-yellow"></i>
								<div class="timeline-item"> 
									<h3 class="timeline-header"><b>Programs (or Coures) Under This College</b></h3>
									<div class="timeline-body">
										<ul style="list-style-type:disc">
										<?php 
											$db3=$this->load->database("db3",true);
											$db3=$db3->database;
											$db4=$this->load->database("db4",true);
											$db4=$db4->database; 
											$this->db->from("$db3.college");
											$this->db->join("$db3.college_courses",'college_courses.Clgecourse_college_id=college.Clge_id','left');
											$this->db->join("$db4.university_courses",'university_courses.Ucourse_id=college_courses.Clgecourse_univcourseid','left');
											$this->db->join("$db4.courses",'courses.Course_id =university_courses.Ucourse_courseid','left');
											$this->db->join("$db4.courses_type",'courses_type.Course_type_id =courses.Course_ctype_id','left');
											$this->db->join("$db4.university",'university.Univ_id =university_courses.Ucourse_universityid','left');
											$this->db->where("Clge_id",$this->input->get("clgeid"));
											$query_college_course=$this->db->get();
											$result_college_course=$query_college_course->result_array(); 
											foreach($result_college_course as $row_college_course)
											{
										?>
											<li><?php echo ucwords($row_college_course["Course_name"]);?> (<?php echo ucwords($row_college_course["Course_type_name"]);?>) - (<?php echo $row_college_course["Univ_name"]; ?>)</li> 
											<?php } ?>	
										</ul>
									</div> 
								</div>
							</li>   
							<li>
								<i class="fa fa-camera bg-purple"></i>
								<div class="timeline-item"> 
									<h3 class="timeline-header"><b>College Gallary</b></h3>
									<div class="timeline-body">
										<img src="<?php echo base_url(); ?>./admin/uploads/colleges/thumbs/<?php echo $image; ?>" width="150px" alt="<?php echo $row_college_details["Clge_logo"]; ?>" class="margin" /> 
										<img src="<?php echo base_url(); ?>./admin/uploads/colleges/thumbs/<?php echo $image; ?>" width="150px" alt="<?php echo $row_college_details["Clge_logo"]; ?>" class="margin" /> 
										<img src="<?php echo base_url(); ?>./admin/uploads/colleges/thumbs/<?php echo $image; ?>" width="150px" alt="<?php echo $row_college_details["Clge_logo"]; ?>" class="margin" /> 
										<img src="<?php echo base_url(); ?>./admin/uploads/colleges/thumbs/<?php echo $image; ?>" width="150px" alt="<?php echo $row_college_details["Clge_logo"]; ?>" class="margin" /> 
										<img src="<?php echo base_url(); ?>./admin/uploads/colleges/thumbs/<?php echo $image; ?>" width="150px" alt="<?php echo $row_college_details["Clge_logo"]; ?>" class="margin" /> 
										<img src="<?php echo base_url(); ?>./admin/uploads/colleges/thumbs/<?php echo $image; ?>" width="150px" alt="<?php echo $row_college_details["Clge_logo"]; ?>" class="margin" /> 
									</div>
								</div>
							</li>  
							<li>
								<i class="fa fa-video-camera bg-maroon"></i>
								<div class="timeline-item"> 
									<h3 class="timeline-header"><b>College Promotional Video</b></h3>
									<div class="timeline-body">
										<div class="embed-responsive embed-responsive-16by9">
											<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/so0B5yRyc-U" frameborder="0" allowfullscreen></iframe>
										</div>
									</div> 
								</div>
							</li>  
						</ul>
					</div><!-- /.col -->
				</div><!-- /.row -->  
			</section><!-- /.content -->
		</div>
<?php	
	}
}
elseif($action=="do_enquiry")
{
	if(!is_numeric($_GET["clgeid"]))
	{
		redirect(base_url()."page_not_found");
	}
	foreach($result_user_details as $row_user_details)
	foreach($result_college_details as $row_college_details)
	if($row_college_details["count"] < 1)
	{
		redirect(base_url()."page_not_found");
	}
	else
	{
		if($row_college_details["Clge_logo"]=='') {$image="no-image.jpg";} else{ $image=$row_college_details["Clge_logo"]; }
?>
    <div class="container"> 
        <section class="content-header">
			<h1>   Enter Enquiry Details </h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li> 
				<li class="active">Fill Enquiry Form</li>
			</ol>
        </section>
	</div>	
    <div class="container"> 
		<section class="content">
			<div class="row">  
				<div class="col-md-6"> 
					<div class="box box-primary"> 
						<p><?php if(isset($msg))echo $msg; ?></p>
						<form  name="Clge_enquiry" method="post" action="" enctype="multipart/form-data" onsubmit="return Clge_enquiryValidate();">
							<input type="hidden" name="do_enquiry" value="true"> 
							<input type="hidden" name="Clge_name" value="<?php echo ucwords($row_college_details["Clge_name"]); ?>"> 
							<input type="hidden" name="Cenq_fstname" value="<?php echo ucwords($row_user_details["User_fstname"]); ?>"> 
							<input type="hidden" name="Cenq_lstname" value="<?php echo ucwords($row_user_details["User_lstname"]); ?>"> 
							<input type="hidden" name="Cenq_email" value="<?php echo ucwords($row_user_details["User_email"]); ?>"> 
							<input type="hidden" name="Cenq_contactno" value="<?php echo ucwords($row_user_details["User_mobileno"]); ?>"> 
							<div class="box-body">
								<div class="form-group">
									<label>Specify In Detail Of Your Request *</label>
									<textarea class="form-control" name="CEcmntsced_usercomment" placeholder="Specify Enquiry Details" value="<?php echo $this->input->post("CEcmntsced_usercomment"); ?>"></textarea>	
									<b><span style="color:red" id="CEcmntsced_usercomment"></span></b>
								</div> 
								<div class="form-group">
									<label>Enquiry Type *</label>
										<select name="Cenq_enquirytypeid" onchange="return admissionEnquiryAjax(this.value);" class="form-control select2">
											<option value="">Select Enquiry Type</option>
											<?php
											$db8=$this->load->database("db8",true);
											$db8=$db8->database;
											$query_enquiry_type=$this->db->get("$db8.college_enquiry_types");
											$result_enquiry_type=$query_enquiry_type->result_array();
											foreach($result_enquiry_type as $row_enquiry_type){
											?>
											<option value="<?php echo $row_enquiry_type["CEtype_id"]; ?>" <?php if($this->input->post("Cenq_enquirytypeid")==$row_enquiry_type["CEtype_id"]) echo "selected";?> ><?php echo ucwords($row_enquiry_type["CEtype_name"]); ?></option> 
											<?php } ?>
										</select>
										<b><span style="color:red" id="Cenq_enquirytypeid"></span></b>
								</div>
								<div id="showAdmissionForm" style="display:none"> 
									<div class="form-group">
										<label>Intrested Programs (Or Course) *</label>
										<select name="Cenq_clgecourseid"  class="form-control select1">
											<option value="">Select Programs (Or Course)</option>
											<?php 
											$db3=$this->load->database("db3",true);
											$db3=$db3->database;
											$db4=$this->load->database("db4",true);
											$db4=$db4->database; 
											$this->db->from("$db3.college");
											$this->db->join("$db3.college_courses",'college_courses.Clgecourse_college_id=college.Clge_id','left');
											$this->db->join("$db4.university_courses",'university_courses.Ucourse_id=college_courses.Clgecourse_univcourseid','left');
											$this->db->join("$db4.courses",'courses.Course_id =university_courses.Ucourse_courseid','left');
											$this->db->join("$db4.courses_type",'courses_type.Course_type_id =courses.Course_ctype_id','left');
											$this->db->join("$db4.university",'university.Univ_id =university_courses.Ucourse_universityid','left');
											$this->db->where("Clge_id",$this->input->get("clgeid"));
											$query_college_course=$this->db->get();
											$result_college_course=$query_college_course->result_array(); 
											foreach($result_college_course as $row_college_course)
											{
											?>
												<option value="<?php echo $row_college_course["Clgecourse_id"]; ?>"><?php echo $row_college_course["Course_name"]; ?> ( <?php echo $row_college_course["Course_type_name"]; ?> ) - (<?php echo $row_college_course["Univ_name"]; ?>) </option>
											<?php } ?>	
										</select>
										<b><span style="color:red" id="Cenq_clgecourseid"></span></b>
									</div> 
									<div class="form-group">
										<label>Previous Program (Or Course) *</label>
										<input type="text" class="form-control" name="UPQ_prev_course" placeholder="Enter Previous Program (Or Course)" value="<?php echo $this->input->post("UPQ_prev_course"); ?>">  
										<b><span style="color:red" id="UPQ_prev_course"></span></b>
									</div>
									<div class="form-group">
										<label>Previous Program Level (Or Course Type) *</label>
										<select name="UPQ_prev_ctypeid" class="form-control select2">
											<option value="">Select Previous Program Level (Or Course Type)</option> 
											<?php 
												$db4=$this->load->database("db4",true);
												$db4=$db4->database;
												$this->db->select('courses_type.*');
												$this->db->from("$db4.courses_type");
												$query_courses_type=$this->db->get(); 
												$result_courses_type=$query_courses_type->result_array();
												foreach($result_courses_type as $row_courses_type) 
											{?>
												<option value="<?php echo $row_courses_type["Course_type_id"]; ?>" <?php if($row_courses_type["Course_type_id"]==$this->input->post("UPQ_prev_ctypeid")) echo "selected";?>><?php echo $row_courses_type["Course_type_name"]; ?></option>
											<?php } ?> 										
										</select>
										<b><span style="color:red" id="UPQ_prev_ctypeid"></span></b>
									</div> 
									<div class="form-group">
										<label>Previous College Or School *</label>
										<input type="text" class="form-control" name="UPQ_prev_clgename" placeholder="Enter Previous Program (Or Course)" value="<?php echo $this->input->post("UPQ_prev_clgename"); ?>">  
										<b><span style="color:red" id="UPQ_prev_clgename"></span></b>
									</div>
									<div class="form-group">
										<label>Marks Obtained (percentage Or cgp) *</label>
										<input type="text" class="form-control" name="UPQ_prev_marks" placeholder="Enter Previous Program (Or Course)" value="<?php echo $this->input->post("UPQ_prev_marks"); ?>">  
										<b><span style="color:red" id="UPQ_prev_marks"></span></b>
									</div>
									<div class="form-group">
										<label>Preffered Visiting Date*</label>
										<input type="date" min="<?php echo date('Y-m-d'); ?>" class="form-control" name="CEcmntsced_visiting_date" placeholder="Enter Previous Program (Or Course)" value="<?php echo $this->input->post("CEcmntsced_visiting_date"); ?>">  
										<b><span style="color:red" id="CEcmntsced_visiting_date"></span></b>
									</div>
									<div class="form-group">
										<label>Preffered Visiting Timing*</label>
										<select name="CEcmntsced_visiting_time" class="form-control select2">
											<option value="">Select Preffered Visiting Timing</option>
											<option value="9am To 11am">9am To 11am</option> 
											<option value="1pm To 3pm">1pm To 3pm</option> 
											<option value="4pm To 5pm">4pm To 5pm</option> 
										</select>
										<b><span style="color:red" id="CEcmntsced_visiting_time"></span></b>
									</div>
								</div>	
							</div><!-- /.box-body -->
							<div class="box-footer">
								<button type="submit"  name="enquiry" class="btn btn-primary">Submit Enquiry</button> 
								<button type="reset" class="btn btn-white">Reset</button> 
							</div>
						</form>
					</div> 
				</div> 
				<div class="col-md-6"> 
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">College Details</h3> 	
						</div> 
						<div class="box-header with-border"> 
							<table class="table table-bordered table-striped">
								<thead> 
									<tr>
										<th style="background:lightgray">Logo</th>
										<th>
											<img src="<?php echo base_url(); ?>./admin/uploads/colleges/thumbs/<?php echo $image; ?>" class="img-circle" width="100px" alt="<?php echo $row_college_details["Clge_logo"]; ?>" />
										</th> 
									</tr> 
									<tr>
										<th style="background:lightgray">Name</th>
										<th>
											<?php echo ucwords($row_college_details["Clge_name"]); ?>
											( <?php echo $row_college_details["Ctype_name"]; ?> )
										</th> 
									</tr> 
									<tr>
										<th style="background:lightgray">Email</th>
										<th><?php echo ucwords($row_college_details["Clge_email"]); ?></th> 
									</tr> 
									<tr>
										<th style="background:lightgray">Contact Number</th>
										<th><?php echo ucwords($row_college_details["Clge_contct_no"]); ?></th> 
									</tr>
									<tr>
										<th style="background:lightgray">Address</th>
										<th>
											<?php echo $row_college_details["Clge_address1"]; ?> , <?php echo $row_college_details["Clge_address2"]; ?> , <?php echo $row_college_details["Clge_postcode"]; ?> , <?php echo $row_college_details["Clge_city"]; ?> , <?php echo $row_college_details["Dist_name"]; ?> , <?php echo $row_college_details["Zon_name"]; ?> , <?php echo $row_college_details["Cntry_name"]; ?>
										</th> 
									</tr>
									<tr>
										<th style="background:lightgray">Offered Program</th>
										<th>
										<ul style="list-style-type:disc">
										<?php 
											$db3=$this->load->database("db3",true);
											$db3=$db3->database;
											$db4=$this->load->database("db4",true);
											$db4=$db4->database; 
											$this->db->from("$db3.college");
											$this->db->join("$db3.college_courses",'college_courses.Clgecourse_college_id=college.Clge_id','left');
											$this->db->join("$db4.university_courses",'university_courses.Ucourse_id=college_courses.Clgecourse_univcourseid','left');
											$this->db->join("$db4.courses",'courses.Course_id =university_courses.Ucourse_courseid','left');
											$this->db->join("$db4.courses_type",'courses_type.Course_type_id =courses.Course_ctype_id','left');
											$this->db->join("$db4.university",'university.Univ_id =university_courses.Ucourse_universityid','left');
											$this->db->where("Clge_id",$this->input->get("clgeid"));
											$query_college_course=$this->db->get();
											$result_college_course=$query_college_course->result_array(); 
											foreach($result_college_course as $row_college_course)
											{
										?>
											<li><?php echo ucwords($row_college_course["Course_name"]);?> (<?php echo ucwords($row_college_course["Course_type_name"]);?>) - (<?php echo $row_college_course["Univ_name"]; ?>) </li> 
											<?php } ?>	
										</ul>
										</th>  
									</tr> 
									<tr>
										<th style="background:lightgray">Website</th>
										<th><?php echo $row_college_details["Clge_website"]; ?></th> 
									</tr> 
								</thead>	
							</table>	
						</div>  
					</div> 
				</div> 
			</div>	
		</section> 
	</div>	 
<?php	
	}
}
elseif($action=="list_my_enquiry")
{
?>	
		<section class="content-header"> 
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li> 
				<li class="active">My Enquiry</li>
			</ol>
    </section>  
	<br/>
	<div class="container">  
		<section class="content">   	   
			<div class="row"> 
				<div class="col-md-14"> 
					<div class="box">
						<div class="box-header">  
							<h3 class="box-title"><b>My Enquiry Details</b></h3> 
							<a href="<?php echo base_url();?>" class="btn btn-primary">New Enquiry</a> 
						</div> 
						<div class="box-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>SrNo</th>
										<th>Enquiry Type</th>
										<th>College</th>  
										<th>Program(Or Course)</th>
										<th>Visiting Schedule</th>     
										<th>Approved By</th>     
										<th>Status</th>  
									</tr>
								</thead>
								<tbody>
								<?php  
								$SrNo=1; 
								foreach($result_my_enquiry as $row_my_enquiry)
								{   
								?>
									<tr>
										<td><?php echo $SrNo; $SrNo++;?></td> 
										<td> <?php echo $row_my_enquiry["CEtype_name"]; ?></td>  
										<td> <?php echo $row_my_enquiry["Clge_name"]; ?> </td>  
										<td>
											<?php if($row_my_enquiry["Cenq_clgecourseid"]){ ?>
											<?php echo $row_my_enquiry["Course_name"]; ?>
											( <?php echo $row_my_enquiry["Course_type_name"]; ?> )
											( <?php echo $row_my_enquiry["Univ_name"]; ?> )
											<?php } else { echo "NA" ;}?>
										</td>  
										<td> <?php
												if($row_my_enquiry["CEcmntsced_visiting_date"]!="0000-00-00")
												{
												echo $row_my_enquiry["CEcmntsced_visiting_date"].'</br>'.$row_my_enquiry["CEcmntsced_visiting_time"];
												} else { echo "NA" ;}?> </td>   
										<td> <?php if($row_my_enquiry["Cenq_approveby"]!=0){ echo $row_my_enquiry["User_fstname"].' '.$row_my_enquiry["User_lstname"]; }else {echo "NA";}?>  </td>   
										<td>
											<?php echo $row_my_enquiry["CEstatus_name"]; ?> <br/>
											<?php if($row_my_enquiry["Cenq_enquiry_statusid"]==3){ ?>
											<a  href="<?php echo base_url();?>admission_form?myid=<?php echo $row_my_enquiry["Cenq_id"];?>" class="btn btn-success">Proceed</a>
											<?php }?>
										</td>
									</tr>
								<?php }?> 
								</tbody>
							</table>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
				</div>
			</div>
		</section>
	</div>	
<?php 
} 
?>	
</div><!-- /.content-wrapper -->