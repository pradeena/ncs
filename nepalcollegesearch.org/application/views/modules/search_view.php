<?php
defined("BASEPATH") or exit("No Direct Script Allowed"); 
//$action=isset($_REQUEST["action"])? $_REQUEST["action"]:"list_search_results";
$pg  = isset($_GET['pg']) ? $_GET['pg'] : 1;
$start_from = ($pg-1) * 10;
?> 
<style type="text/css">  
h1{
	font-size: 28px;
    line-height: 35px;
    margin: 0 0 6px;
  }
.button 
{ 
	width: 150px;
	padding: 10px; 
	background-color: #FF8C00; 
	box-shadow: -8px 8px 10px 3px rgba(0,0,0,0.2); 
	font-weight:bold; text-decoration:none; 
} 
#cover
{ 
	position:fixed; 
	top:0; 
	left:0;
	background:rgba(0,0,0,0.6); 
	z-index:5; width:100%; 
	height:100%; 
	display:none; 
} 
#collegeEnquiry 
{ 
	height:550px; 
	width:600px; 
	margin:0 auto; 
	position:relative; 
	z-index:10; 
	display:none; 
	background: white;
	border:5px solid #cccccc; 
	border-radius:10px;
} 
#collegeEnquiry:target, 
#collegeEnquiry:target + 
#cover
{ 
	display:block; 
	opacity:2; 
} 
.cancel 
{ 
	display:block; 
	position:absolute; 
	top:3px; 
	right:2px; 
	background:rgb(245,245,245); 
	color:black; 
	height:30px; 
	width:35px; 
	font-size:30px; 
	text-decoration:none; 
	text-align:center; 
	font-weight:bold; 
} 
#hide_fulldetails_1 p{font-size:14px!important; line-height:26px!important;}
#hide_fulldetails_1 strong{font-weight:normal!important;}
#hide_fulldetails_1 table{width:100%!important;height:100%!important;}
#myModal .form-control {
    border: 1px solid #ccc;
    border-radius: 2px;
    box-shadow: none;
    height: 30px;
    margin-bottom: 5px;
}
@media(max-width:767px){
	.owl-stage-outer{height: 240px!important;}
}
</style> 

<script>
function Clge_rand_enquiryValidate()
{  
	var Cenq_clgecourseid=enquiry.Cenq_clgecourseid.value;
	var CEcmntsced_usercomment=enquiry.CEcmntsced_usercomment.value;
	CEcmntsced_usercomment=CEcmntsced_usercomment.trim(); 
	if(enquiry.Cenq_clgecourseid.selectedIndex==0)
	{
		document.getElementById("Cenq_clgecourseid").innerHTML="* Required";
		enquiry.Cenq_clgecourseid.focus();
		return false;
	}
	if(enquiry.Cenq_clgecourseid.selectedIndex!=0)
	{
		document.getElementById("Cenq_clgecourseid").innerHTML="";
	}
	if(CEcmntsced_usercomment=="" || CEcmntsced_usercomment==null)
	{
		document.getElementById("CEcmntsced_usercomment").innerHTML="* Required";
		Clge_enquiry.CEcmntsced_usercomment.focus();
		return false;
	}
	var Cenq_fstname=enquiry.Cenq_fstname.value;
	var Cenq_lstname=enquiry.Cenq_lstname.value;
	var Cenq_email=enquiry.Cenq_email.value;
	var Cenq_enquirytypeid=enquiry.Cenq_enquirytypeid.value;
	var Cenq_clgeid=enquiry.Cenq_clgeid.value;
	var Cenq_contactno=enquiry.Cenq_contactno.value;
	var Cenq_clgecourseid=enquiry.Cenq_clgecourseid.value;
	var Cenq_enquiry_statusid=enquiry.Cenq_enquiry_statusid.value;
	if(CEcmntsced_usercomment!="" || CEcmntsced_usercomment!=null)
	{
		$.post("<?php echo base_url();?>search/general_EnquiryAjax",{CEcmntsced_usercomment:CEcmntsced_usercomment,Cenq_fstname:Cenq_fstname,Cenq_lstname:Cenq_lstname,Cenq_email:Cenq_email,Cenq_enquirytypeid:Cenq_enquirytypeid,Cenq_clgeid:Cenq_clgeid,Cenq_contactno:Cenq_contactno,Cenq_enquiry_statusid:Cenq_enquiry_statusid,Cenq_clgecourseid:Cenq_clgecourseid},function(data){
			$("#rsultMsg1").html(data);
		});
	}   
}
</script> 
<script> 
function duplicatecollegeCourseAjax(Cenq_clgecourseid)
{
	var Cenq_clgeid=enquiry.Cenq_clgeid.value;
	var Cenq_clgeid=enquiry.Cenq_clgeid.value;
	var Clge_name=enquiry.Clge_name.value;
	$.post("<?php echo base_url();?>search/check_duplicate_collegeCourseAjax",{Cenq_clgecourseid:Cenq_clgecourseid,Cenq_clgeid:Cenq_clgeid,Clge_name:Clge_name},function(data){
		  $("#rsultMsg1").html(data);
	});
}
</script> 
<?php 
if($action=="list_search_results")
{
	if(!isset($_GET["qry"]) || $_GET["qry"]=="")
	{
		redirect(base_url()."page_not_found");
?> 
<div class="page-header bg-grey typo-dark">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<!-- Page Header Wrapper -->
				<div class="page-header-wrapper"> 
					<h5 class="sub-title">Oops! Record Not Found</h5> 
					<ol class="breadcrumb">
						<li><a href="<?php echo base_url();?>">Home</a></li>
						<li class="active"> Record Not Found</li>
					</ol><!-- Breadcrumb -->
				</div><!-- Page Header Wrapper -->
			</div><!-- Coloumn -->
		</div><!-- Row -->
	</div><!-- Container -->
</div><!-- Page Header -->
<div role="main" class="main"> 
	<div class="page-default">  
	<!-- Section -->
	<section class="pad-top-none typo-dark">
		<div class="container"> 
				<div class="row">
				<center><h5 style="color:#1E90FF"><b>Search Your Query Here</b></h5></center>
					<div class="col-md-offset-1 col-md-10">
						<!-- Search -->
						<div class="search">
							<form id="searchForm" name="searchForm" class="white" action="<?php echo base_url();?>search" method="get" onsubmit="return search_validate();"> 
								<div class="input-group">
									<input type="text" class="form-control search" name="qry" id="q" placeholder="Search Courses By College Name , City Name , Courses Name" value="<?php echo $this->input->post("qry"); ?>" required>
									<span class="input-group-btn">
										<button class="btn" type="submit" value=""><i class="fa fa-search"></i></button>
									</span>
								</div>
								<span id="search_keyword"></span>
							</form>
						</div><!-- Search -->
					</div><!-- Column -->
				</div> 
		</div><!-- Container -->
	</section><!-- Section -->
	</div>
<?php	
	}
	foreach($result_total_recordfound as $row_total_recordfound)
	if($row_total_recordfound["count"]<1)
	{
?>
<div class="page-header bg-grey typo-dark">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<!-- Page Header Wrapper -->
				<div class="page-header-wrapper"> 
					<h5 class="sub-title">Oops! Record Not Found</h5> 
					<ol class="breadcrumb">
						<li><a href="<?php echo base_url();?>">Home</a></li>
						<li class="active"> Record Not Found</li>
					</ol><!-- Breadcrumb -->
				</div><!-- Page Header Wrapper -->
			</div><!-- Coloumn -->
		</div><!-- Row -->
	</div><!-- Container -->
</div><!-- Page Header -->
<div role="main" class="main"> 
	<div class="page-default">  
	<!-- Section -->
	<section class="pad-top-none typo-dark">
		<div class="container"> 
				<div class="row">
				<center><h5 style="color:#1E90FF"><b>Search Your Query Here</b></h5></center>
					<div class="col-md-offset-1 col-md-10">
						<!-- Search -->
						<div class="search">
							<form id="searchForm" name="searchForm" class="white" action="<?php echo base_url();?>search" method="get" onsubmit="return search_validate();"> 
								<div class="input-group">
									<input type="text" class="form-control search" name="qry" id="q" placeholder="Search Courses By College Name , City Name , Courses Name" value="<?php echo $this->input->post("qry"); ?>" required>
									<span class="input-group-btn">
										<button class="btn" type="submit" value=""><i class="fa fa-search"></i></button>
									</span>
								</div>
								<span id="search_keyword"></span>
							</form>
						</div><!-- Search -->
					</div><!-- Column -->
				</div> 
		</div><!-- Container -->
	</section><!-- Section -->
	</div>
<?php		
	}
	else
	{  
?>
<div class="page-header internalPages">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<!-- Page Header Wrapper -->
				<div class="page-header-wrapper"> 
				<?php
					$db4=$this->load->database("db4",true);
					$db4=$db4->database;
					$this->db->from("$db4.courses");
					$this->db->or_where("Course_name",$this->input->get("qry"));
					$this->db->or_where("Course_short_name",$this->input->get("qry"));
					$query1=$this->db->get();  
					$result1=$query1->row();
					@$course_name=$result1->Course_name;
					@$course_short_name=$result1->Course_short_name;
					if((isset($_GET["qry"])==$course_name )or isset($_GET["qry"])==$course_short_name)
					{
					?>
					<h5 class="sub-title"><span style="color:#666"><?php 
					
					echo $row_total_recordfound["count"];
					$db4=$this->load->database("db4",true);
					$db4=$db4->database;
					$this->db->select("*");
					$this->db->from("$db4.university"); 
					$this->db->where("Univ_id",$this->input->get("univid"));
					$query3=$this->db->get();  
					$result3=$query3->result_array();
					foreach($result3 as $row_result3)
					?> College Of </span> - <?php echo $this->input->get("qry");?><span style="color:#666"> in <?php if($this->input->get("cty")){ echo $this->input->get("cty");} if($this->input->get("univid")){ echo $row_result3["Univ_name"];}
					if($this->input->get("cat")){echo $this->input->get("cat");} else {echo "".' '."Nepal";}
					?></span></h5>
					<?php }	else{
					$db3=$this->load->database("db3",true);
					$db3=$db3->database;
					$this->db->from("$db3.college");
					$this->db->where("Clge_name",$this->input->get("qry"));
					$query2=$this->db->get();  
					$result2=$query2->row();
					@$college_name=$result2->Clge_name;
					@$city_name=$result2->Clge_city;
					if((isset($_GET["qry"]))==$college_name or isset($_GET["qry"])==$city_name)
					{
					?>
					<h5 class="sub-title"><span style="color:#666"><?php 	
					echo $row_total_recordfound["count"];?> College Result Of </span> - <?php echo $this->input->get("qry");?> </h5>
					<?php					
					}else
					{?>
					<h5 class="sub-title"><span style="color:#666"><?php 	
					echo $row_total_recordfound["count"];?> College Results Of </span> - <?php 
					if($this->input->get("qry") AND $this->input->get("univid") )
					{
						echo $this->input->get("qry");?> <span style="color:#666"><?php  if($this->input->get("cty")){ echo "in ".' '. $this->input->get("cty");}
					}
					else
					{
						if($this->input->get("qry") AND $this->input->get("cty") )
						{
							echo $this->input->get("qry");?> <span style="color:#666"><?php  if($this->input->get("cty")){ echo "in ".' '. $this->input->get("cty");}
						}
						else
						{
							echo $this->input->get("qry").'<span style="color:#666"> '."(For more Refined Data Click On Filter)".'</span>'."";?> <span style="color:#666"><?php  if($this->input->get("cty")){ echo "in ".' '. $this->input->get("cty");}
						}	
					}
					$db4=$this->load->database("db4",true);
					$db4=$db4->database;
					$this->db->select("*");
					$this->db->from("$db4.university"); 
					$this->db->where("Univ_id",$this->input->get("univid"));
					$query3=$this->db->get();  
					$result3=$query3->result_array();
					foreach($result3 as $row_result3)
					if($this->input->get("univid")){ echo "in ".' '. $row_result3["Univ_name"];}
					if($this->input->get("cat")){echo "in ".' '.$this->input->get("cat");} else {echo "".' '."";}
					?></span> </h5>
					<?php  }
					      }
					?>
					
					<ol class="breadcrumb">
						<li><a href="<?php echo base_url();?>">Home</a></li>
						<li class="active">Search Results</li>
					</ol><!-- Breadcrumb -->
				</div><!-- Page Header Wrapper -->
			</div><!-- Coloumn -->
		</div><!-- Row -->
	</div><!-- Container -->
</div><!-- Page Header -->
	<div class="page-default">  
	<!-- Section --> 
				<div class="row"> 
					<div class="col-md-offset-1 col-md-10">
						<!-- Search -->
						<div class="search">
							<form id="searchForm" name="searchForm" class="white" action="<?php echo base_url();?>search" method="get" onsubmit="return search_validate();"> 
								<div class="input-group">
									<input type="text" class="form-control search" name="qry" id="q" placeholder="Search Courses By College Name , City Name , Courses Name" value="<?php echo $this->input->get("qry"); ?>" required>
									<span class="input-group-btn">
										<button class="btn" type="submit" value=""><i class="fa fa-search"></i></button>
									</span>
								</div>
								<span id="search_keyword"></span>
							</form>
						</div><!-- Search -->
					</div><!-- Column -->
				</div>  
				<?php if($this->session->userdata("is_loged_in")){?> 
		<center>
			<button data-toggle="modal" class="btn btn-info" data-target="#preferenceModel"><i class="fa fa-hand-o-right fa-2x" aria-hidden="true"></i><b><font size="4"> Set Your Preferences For Best Search</font></b></button>
		</center>
		<div class="modal fade" id="preferenceModel" role="dialog">
			<div class="modal-dialog"> 
			    <!-- Modal content-->
			    <div class="modal-content">
					<div class="modal-header">
				      <button type="button" class="close" data-dismiss="modal">&times;</button> 
				    </div>
				     <div class="modal-body">
				     	<?php $this->load->view('modules/_setPreference');?> 
				     </div>
				</div>
			</div>	     
		</div>  
	<?php } else{?> 
	<center>
		<a  href="<?php echo base_url();?>login?redirect=search?qry=<?php echo $_GET['qry'];?>" class="btn btn-info" ><i class="fa fa-hand-o-right fa-2x" aria-hidden="true"></i><b><font size="4">Login to Set  Preferences For Best Search</font></b></a> 
	</center>	
	<?php } ?>
	</div>
<div role="main" class="main"> 
	<div class="page-default">
		<!-- Container -->
		<div class="container">
			<div class="row">
				<!-- Sidebar -->
				<div class="filterNew"></div>
				<div class="col-md-3 col-sm-3 col-xs-12 mobilefilter show">
					<!-- aside -->
					<aside class="sidebar">   
						<!-- Widget -->
						<div class="widget"> 
							<h5>Filter your search</h5>
							<div class="accordion-widget">
								<div class="panel-group accordion" id="accordion" role="tablist" aria-multiselectable="true">
									<div class="panel panel-default"> 
										<div class="panel-heading" role="tab" id="headingThree">
											<h4 class="panel-title">
												<a class="expanded" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Universities</a>
											</h4>
										</div>
<script>
function goto(Univ_filter)
{    
    location=Univ_filter; 
}
function goto_city(City_filter)
{    
    location=City_filter; 
}
function goto_category(Category_filter)
{    
    location=Category_filter; 
}
</script>
										<div id="collapseThree" class="panel-expanded expanded" role="tabpanel" aria-labelledby="headingThree">
											<div class="panel-body">
												<ul class="go-widget">
													<?php foreach($result_list_university as $row_list_university) { ?>  
													<form name="UnivFilter" method="post" action=""> 
													<li><input  onclick="return goto(this.value)" name="Univ_filter" type="radio" value="<?php echo base_url();?>index.php/search?qry=<?php echo $this->input->get("qry"); ?>&univid=<?php echo $row_list_university["Univ_id"]; ?>"  <?php if($this->input->get("univid")==$row_list_university["Univ_id"]){ echo "checked";}?>> <?php echo ucwords($row_list_university["Univ_name"]);?> (<?php echo $row_list_university["total_college"] ; ?> )</li> 
													<?php }?>
													</form>
												</ul>
											</div>
										</div><hr/>  
										<div class="panel-heading" role="tab" id="headingTwo">
											<h4 class="panel-title">
												<a class="expanded" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Location</a>
											</h4>
										</div>
										<div id="collapseTwo" class="panel-expanded expanded" role="tabpanel" aria-labelledby="headingTwo">
											<div class="panel-body">
												<form name="CityFilter" method="post" action="">
												<ul class="go-widget">
													<?php foreach($result_list_cities as $row_list_cities) { ?>   
													<li><input type="radio" onclick="return goto_city(this.value)" name="City_filter" value="<?php echo base_url();?>index.php/search?qry=<?php echo $this->input->get("qry"); ?>&cty=<?php echo $row_list_cities["Clge_city"]; ?>" <?php if($this->input->get("cty")==$row_list_cities["Clge_city"]){ echo "checked";}?>> <?php echo ucwords($row_list_cities["Clge_city"]);  ?> (<?php echo $row_list_cities["total_college"];?> )</li> 
													<?php }?> 
												</ul>
												</form>
											</div>
										</div><hr/>  
										<?php 
										/*$db3=$this->load->database("db3",true);
										$db3=$db3->database;
										$this->db->from("$db3.college_faculty");
										$this->db->where("Cfaculty_name",$this->input->get("qry"));
										$query5=$this->db->get(); 
										$result5=$query5->result_array();
										foreach($result5 as $row_result5)
										if($this->input->get("qry")!=$row_result5["Cfaculty_name"])
										{*/
										?>
										<div class="panel-heading" role="tab" id="headingTwo">
											<h4 class="panel-title">
												<a class="expanded" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Category</a>
											</h4>
										</div>
										<div id="collapseTwo" class="panel-expanded expanded" role="tabpanel" aria-labelledby="headingTwo">
											<div class="panel-body">
												<form name="CategoryFilter" method="post" action="">
												<ul class="go-widget">
													<?php foreach($result_list_category as $row_list_category) { ?>   
													<li><input type="radio" onclick="return goto_category(this.value)" name="Category_filter" value="<?php echo base_url();?>index.php/search?qry=<?php echo $row_list_category["Cfaculty_name"]; ?>" <?php if($this->input->get("cat")==$row_list_category["Cfaculty_name"]){ echo "checked";}?>> <?php echo ucwords($row_list_category["Cfaculty_name"]);  ?> (<?php echo $row_list_category["total_college"];?> )</li> 
													<?php }?> 
												</ul>
												</form>
											</div>
										</div>
										<?php // } ?>
									</div> 
								</div>
							</div>
						</div><!-- Widget -->   
					</aside><!-- aside -->	
				</div><!-- Column -->
				
				<!-- Page Content -->
				<div class="col-md-9 col-sm-9 col-xs-12">
					<ul class="row course-container course-list">
						<?php 
							$SrNo=1;
							foreach($result_search_college_or_course as $row_search_college_or_course)	
							{
								if($row_search_college_or_course["Clge_logo"]=='') {$image="no-image.jpg";} else{ $image=$row_search_college_or_course["Clge_logo"]; }
								$clge_url=str_replace(" ","-",$row_search_college_or_course["Clge_name"]." ".$row_search_college_or_course["Clge_city"]);
								$clge_url=preg_replace('/[^A-Za-z0-9\-]/','',$clge_url);
								$clge_url=strtolower($clge_url);
								$clge_course_url=str_replace(" ","-",$row_search_college_or_course["Course_name"]); 
								$clge_course_url=preg_replace('/[^A-Za-z0-9\-]/','',$clge_course_url);
								$clge_course_url=strtolower($clge_course_url);
						?>
						<li class="col-sm-12">
							<!-- Course Wrapper -->
							<div id="sortResult">
							</div>
							<div id="hidepostResult">
							<div class="row course-wrapper">
								<ul>
									<li>
										<ul>
											<li>
												<a href="<?php echo base_url();?>college/<?php echo $row_search_college_or_course["Clge_id"]; ?>/<?php echo $clge_url; ?>">
										<img src="<?php echo FILE_PATH; ?>uploads/colleges/thumbs/<?php echo $image; ?>" class="img-responsive" alt="<?php echo $row_search_college_or_course["Clge_name"]; ?>" style="width:90px; border:1px solid #ccc; padding:5px;">
										</a>
											</li>
											<li>
												<ul>
													
													<li>
													<table>
														<tr>
														    <th>
																<a href="<?php echo base_url();?>college/<?php echo $row_search_college_or_course["Clge_id"]; ?>/<?php echo $clge_url; ?>"><?php echo ucwords($row_search_college_or_course["Clge_name"]); ?> </a>&nbsp;&nbsp;&nbsp;&nbsp;
															</th>
															<th>
																<?php if($row_search_college_or_course["Clge_verified_id"]==1){ ?>
																<img src="<?php echo FILE_PATH; ?>uploads/colleges/thumbs/verified.png" style="height:30px; width:30px" class="img-responsive" alt="verified"><?php }?>
															</th>
															<th>&nbsp;&nbsp;&nbsp;&nbsp;
																<a class="review" href="#"><strong>0 Reviews</strong></a>
															</th>
														</tr>
													</table>
														
													</li>
													<li class="clgAddress"><?php echo $row_search_college_or_course["Clge_city"]; ?> , <?php echo $row_search_college_or_course["Cntry_name"]; ?></li>
													<li>
													<div class="cat">
													<a href="<?php echo base_url();?>college/<?php echo $row_search_college_or_course["Clge_id"]; ?>/<?php echo $clge_url; ?>">
													<?php echo $row_search_college_or_course["Ctype_name"]; ?>
													</a>
													</div></li>
													
												</ul>
											</li>
											<li class="last-child">
												<ul>
													<li><strong>Estabilished : </strong></li>
													<li><?php if($row_search_college_or_course["Clge_est_yr"]=="0000"){ echo "NA";}else{echo $row_search_college_or_course["Clge_est_yr"];}?></li>
													<li><strong>University : </strong></li>
													<li><?php if($row_search_college_or_course["Univ_name"]==""){ echo "NA";}else{ echo $row_search_college_or_course["Univ_name"];}?></li>
													<!--<li></li>
													<li><a href="#"><i class="fa fa-college_request"></i> 0 Questions on this course</a></li> -->
													
												</ul>
												<a href="<?php echo base_url();?>college/<?php echo $row_search_college_or_course["Clge_id"]; ?>/<?php echo $clge_url; ?>" class="btn" >View Details</a>
									
											</li>
										</ul>
									</li>
									<li class="socialIcon">
										<ul>
											<li>
												<ul class="social-icons">
													<?php 
														$db3=$this->load->database("db3",true);
														$db3=$db3->database;
														$this->db->from("$db3.college_facilities");
														$this->db->join("$db3.facilities","facilities.Facility_id=college_facilities.Clgefacility_facilityid");
														$this->db->where("Clgefacility_clgeid",$row_search_college_or_course["Clge_id"]);
														$query_facility=$this->db->get();
														$result_facility=$query_facility->result_array();
														foreach($result_facility as $row_facility) {
													?>
														<li title="<?php echo $row_facility["Facility_name"];?>">&nbsp;&nbsp;&nbsp;<?php echo $row_facility["Facility_icon"];?> &nbsp;&nbsp;&nbsp;</li>
													<?php }?>
												</ul>
											</li>
											<li>
													<?php 
														$db3=$this->load->database("db3",true);
														$db3=$db3->database;
														$db4=$this->load->database("db4",true);
														$db4=$db4->database;
														$this->db->select("Course_short_name,Course_id,Clgecourse_college_id,Clgecourse_id");
														$this->db->from("$db3.college_courses");
														$this->db->join("$db4.university_courses",'university_courses.Ucourse_id=college_courses.Clgecourse_univcourseid');
														$this->db->join("$db4.courses",'courses.Course_id =university_courses.Ucourse_courseid'); 
														$this->db->where("Clgecourse_college_id",$row_search_college_or_course["Clge_id"]);
														$this->db->limit(3);
														$query_course=$this->db->get();
														$result_coures=$query_course->result_array();
														foreach($result_coures as $row_coures) {
															
													?>
													<a class="collegename" href="<?php echo base_url();?>course/<?php echo $row_coures["Clgecourse_id"];?>/<?php echo $clge_course_url;?>"><?php echo $row_coures["Course_short_name"]; ?></a> |
													<?php }?>
													<a href="<?php echo base_url();?>college/<?php echo $row_search_college_or_course["Clge_id"]; ?>/<?php echo $clge_url; ?>">More</a>
											</li>
											<li>
												<div class="text-right">
											<?php if($row_search_college_or_course["CDetails_ebrochure"]!=""){?> 
												<a class="btn btn-info" href="<?php echo FILE_PATH;?>uploads/college-e-brochure/<?php echo $row_search_college_or_course["CDetails_ebrochure"]; ?>" download>College E-brochure</a>
											<?php }?>	
											</div>
											</li>
										</ul>
									</li>
								</ul>
							</div>
							</div>
						</li><!-- List -->
							<?php } ?>
						<!-- Pagination -->
						<?php
						$total_pages = ceil($row_total_recordfound["count"] /10); 
						?>
						<nav aria-label="Page navigation" style="text-align:right;">
							<ul class="pagination" id="pagination"  style="display:none;"></ul>
						</nav>
						<nav class="text-center">
							<ul class="pagination"> 
								<?php 
								for($i=1; $i<=$total_pages; $i++) 
								{ 
									$pag=isset($_GET['pg'])?$_GET['pg']:""; 
									if($i==intval($pag))
									{ 
								?>
										<li><a  <?php if($pag==$i){ echo "style='background:#2196f3'";}?> href="<?php echo base_url();?>index.php/search?qry=<?php echo $this->input->get("qry");?>&pg=<?php echo $i; if(isset($_GET["cty"])){echo "&cty=".$this->input->get("cty");} if(isset($_GET["univid"])){echo "&univid=".$this->input->get("univid");}?>"><?php echo $i;?></a></li> 
									<?php } else {?>
										<li><a  <?php if($pag==$i){ echo "style='background:#2196f3'";}?> class="btn" href="<?php echo base_url();?>index.php/search?qry=<?php echo $this->input->get("qry");?>&pg=<?php echo $i; if(isset($_GET["cty"])){echo "&cty=".$this->input->get("cty");} if(isset($_GET["univid"])){echo "&univid=".$this->input->get("univid");}?>"><?php echo $i;?></a></li> 	
								<?php }}?>	 
							</ul>
						</nav><!-- Pagination -->
					</ul><!-- Row -->
				</div><!-- Column -->
			</div><!-- Row -->		
		</div><!-- Container -->
	</div><!-- Page Default -->   
<?php 
	}
}
elseif($action=="view_college")
{
	/*if(!is_numeric($_GET["id"]))
	{
		redirect(base_url().'index.php/page_not_found');
	}*/
	foreach($result_college_details as $row_college_details)  
	$SrNo=1;
	if($row_college_details["Clge_logo"]=='') {$image_logo="no-image.jpg";} else{ $image_logo=$row_college_details["Clge_logo"]; }
	$clge_url=str_replace(" ","-",$row_college_details["Clge_name"]." ".$row_college_details["Clge_city"]);
	$clge_url=preg_replace('/[^A-Za-z0-9\-]/','',$clge_url);
	$clge_url=strtolower($clge_url);
?>    	
<div class="page-header internalPages">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<!-- Page Header Wrapper -->
				<div class="page-header-wrapper"> 
					<h5 class="sub-title"><?php echo $row_college_details["Clge_name"]; ?></h5>
					<ol class="breadcrumb">
						<li><a href="<?php echo base_url();?>">Home</a></li> 
						<li><a href="<?php echo base_url();?>search?qry=<?php echo $row_college_details["Clge_city"]; ?>"><?php echo $row_college_details["Clge_city"]; ?></a></li> 
						<li><?php echo $row_college_details["Clge_name"]; ?></li> 
					</ol><!-- Breadcrumb -->
				</div><!-- Page Header Wrapper -->
			</div><!-- Coloumn -->
		</div><!-- Row -->
	</div><!-- Container -->
</div><!-- Page Header -->

<div role="main" class="main">   
	<nav class="one-page-header one-page-header-style-2 navbar navbar-default" role="navigation" id="secondNav">
		<div class="container">
			<div class="menu-container page-scroll">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button> 
				<div class="collapse navbar-collapse navbar-ex1-collapse"  style="background-color: #d1cece;">
					<div class="menu-container">
						<?php /*<ul class="nav navbar-nav">
							<li class="page-scroll home">
								<a class="" href="#home">HOME</a>
							</li>
							<li class="page-scroll">
								<a class="" href="#snap">SNAPSHOT</a>
							</li>
							<li class="page-scroll">
								<a class="" href="#about">ABOUT</a>
							</li>
							<li class="page-scroll">
								<a class="" href="#course">COURSES</a>
							</li>
							<li class="page-scroll">
								<a class="" href="#gallery">PHOTO GALLERY</a>
							</li> 
							<li class="page-scroll">
								<a class="" href="#location">Location</a>
							</li>
						</ul>*/?>
					</div>
				</div>
				<!-- /.navbar-collapse -->
			</div>
			<!-- /.container -->
		</nav>
		<section class="promo-section" id="home">
			<div class="container"> 
				<div class="row margin-bottom-30"  id="home"> 
					<div class="col-md-8 col-sm-12 col-xs-12 md-margin-bottom-40">
						<div class="headline">
							<?php if($row_college_details["Clge_verified_id"]==1){ ?>
								<img src="<?php echo FILE_PATH; ?>uploads/colleges/thumbs/verified.png" style="height:30px; width:30px"> <?php }?>
							<?= $row_college_details["Clge_name"]; ?>
							 - <i><?= $row_college_details["Ctype_name"]; ?></i>
							
						</div>
						<div class="row">
							<div class="col-sm-4">
								<img src="<?php echo FILE_PATH; ?>uploads/colleges/thumbs/<?php echo $image_logo; ?>" class="img-responsive" alt="<?= $row_college_details["Clge_name"]; ?>">
							</div>
							<div class="col-sm-8">
								<p><?= $row_college_details["Clge_address1"] .' ,'.$row_college_details["Clge_city"].', '.$row_college_details["Cntry_name"]; ?></p>
								<ul class="social-icons">	 
									<?php 
										$db3=$this->load->database("db3",true);
										$db3=$db3->database;
										$this->db->from("$db3.college_facilities");
										$this->db->join("$db3.facilities","facilities.Facility_id=college_facilities.Clgefacility_facilityid");
										$this->db->where("Clgefacility_clgeid",$Clge_id);
										$query_facility=$this->db->get();
										$result_facility=$query_facility->result_array();
										foreach($result_facility as $row_facility) {
										?>
										<li title="<?php echo $row_facility["Facility_name"];?>"><?php echo $row_facility["Facility_icon"];?> &nbsp;&nbsp;&nbsp;</li>
									<?php }?>

								</ul> 
								<a href="#" class="btn-u btn-u-lg">E-Brochure</a> 
								<?php $this->load->view('modules/enquiry', ['clge_id' => $row_college_details["Clge_id"],'courseid' => '', 'clge_name' => $row_college_details["Clge_name"]]);?>
							</div>
					</div> 
							
							<blockquote class="hero-unify">
								<p>
									<ul class="list-unstyled margin-bottom-20"><?php if($row_college_details["CDetails_googleplus_link"]!=""){?>
									<span  style="color:blue" class="googleplus"><a title="googleplus" target="_blank" href="<?php echo $row_college_details["CDetails_googleplus_link"];?>"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a></span><?php }?>
									<?php if($row_college_details["CDetails_facebook_link"]!=""){?>
									<span style="color:blue" class="facebook"><a href="<?php echo $row_college_details["CDetails_facebook_link"];?>" target="_blank" title="Facebook"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></span><?php }?>
									<?php if($row_college_details["CDetails_twitter_link"]!=""){?>
									<span style="color:blue" class="twitter"><a href="<?php echo $row_college_details["CDetails_twitter_link"];?>" target="_blank" title="Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></span><?php }?>
									<?php if($row_college_details["CDetails_youtube_link"]!=""){?>
									<span style="color:red" class="youtube"><a style="color:red;" title="Youtube" target="_blank" href="<?php echo $row_college_details["CDetails_youtube_link"];?>"><i class="fa fa-youtube" style="color:red;" aria-hidden="true"></i></a></span><?php }?>
									</ul>
								</p> 
							</blockquote>
				</div><!--/col-md-8--> 
				<div class="col-sm-4 col-sm-4 col-xs-4"> 
					<?php 
						$db3=$this->load->database("db3",true);
						$db3=$db3->database;
						$this->db->from("$db3.college_faces"); 
						$this->db->where('Cfac_clgid',$Clge_id);
						$qry=$this->db->get();
						$row=$qry->result_array();
						if(count($row) > 1){
					?>
						<div class="headline"><center>Faces of <?= $row_college_details["Clge_name"]; ?></center></div>		 
						<div class="owl-crousel" >  
							<div class="owl-carousel show-nav-hover dots-dark nav-square dots-square navigation-color" data-animatein="zoomIn" data-animateout="slideOutDown" data-items="1" data-margin="30" data-loop="true" data-merge="true" data-nav="true" data-dots="false" data-stagepadding="" data-mobile="1" data-tablet="2" data-desktopsmall="1"  data-desktop="1" data-autoplay="true" data-delay="3000" data-navigation="true" background="white"> 
						<?php  
							foreach($row as $row){
						?>		
							<div class="">
							    <div class="best-0">
							    <div class="best-1">
								<table>
									<tr>
										<th style="text-align:left;width: 124px;"> 
											<center><img src="<?php echo FILE_PATH; ?>uploads/college-faces/thumbs/<?= $row['Cfac_pic'] ?>"  style="border-radius:100%;width:66%;height:50%"></center>	
										</th>
										<th style="text-align:left">	
											<?= $row['Cfac_name'];?> <br/> <i style="font-size: 10px"><?= $row['Cfac_designation'];?></i> <br/> <span style="font-size: 12px">Achievement - <?= $row['Cfac_achievement'];?> </span>		
										</th> 
									</tr>  
								</table>  
								</div>
								</div>
							</div>  
						<?php } ?>	
							</div>
						</div>
					<?php } ?>	
					</div><!-- Column -->
			</div> 
		</div>
	</section>
	<section id="snap" class="snap-section">
		<div class="container">
<div class="container collegeSearchGrid">
								<h4 class="title">King's College Snapshot</h4>
								<div class="snap"> 
									<ul class="course-meta-icons"> 
									<?php if($row_college_details["CDetails_total_students"]!=0){?>
									<li><i class="fa fa-users"></i><span>Total Students : </span><span><?php echo $row_college_details["CDetails_total_students"]; ?></span></li>
									<?php } ?>
									<li><i class="fa fa-bank"></i><span>College Type :  </span><span><?php echo $row_college_details["Ctype_name"]; ?></span></li>
									<li><i class="fa fa-calendar"></i><span>Estabilished : </span><span><?php 
										if($row_college_details["Clge_est_yr"]=="0000")
										{$established= " N/A";}else{$established=$row_college_details["Clge_est_yr"];} echo $established; 
									?></span></li>
									<li><i class="fa fa-phone"></i><span>Contact : </span><span><?php 
										if($row_college_details["Clge_contct_no"]=="")
										{$contact= " N/A";}else{$contact=$row_college_details["Clge_contct_no"];}echo $contact; ?></span></li>
									<li><i class="fa fa-envelope-o"></i><span>Email : </span><span><?php  
										if($row_college_details["Clge_email"]=="")
										{$email= " N/A";}else{$email=$row_college_details["Clge_email"];}echo $email; ?></span></li>
									<li><i class="fa fa-map-marker"></i><span>Address : </span><span><?php echo $row_college_details["Clge_address1"].', '.$row_college_details["Clge_city"].', '.$row_college_details["Cntry_name"]; ?></span></li>
									<li><i class="fa fa-bank"></i><span>University : </span><span><?php 
										 echo $row_college_details["Univ_name"]; 
									?></span></li>
								</ul>
								</div>
							</div>
						</div>
	</section>
	<!--  About Section -->
	<section id="about" class="snap-section">
		<div class="container">
<div class="container collegeSearchGrid">
								<h4 class="title">ABOUT COLLEGE</h4>
								<div class="snap">
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-59ac196ae086ffda"></script> 
									<div class="col-md-6">
										<?php if($row_college_details["CDetails_tour_videos"]){?>
										<iframe width="100%" height="370px" src="https://www.youtube.com/embed/<?php echo $row_college_details["CDetails_tour_videos"];?>?ecver=1" frameborder="0"></iframe> 
										<?PHP } else { echo '<img src="'.FILE_PATH.'uploads/video-not-found.png" style="width:100%;height:370px">';}?>
									</div>
									<div class="col-md-6"> 
											<p><?= substr($row_college_details["CDetails_description"], 0,700); ?></p>
											<?php if(strlen($row_college_details["CDetails_description"]) > 700 ) {?>
											<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#readCollegeDetails">Read more</button>
											<?php } ?>


											 	<div class="modal fade" id="readCollegeDetails" role="dialog">
   												 	<div class="modal-dialog"> 
												      <!-- Modal content-->
													      <div class="modal-content">
													        <div class="modal-header">
													          <button type="button" class="close" data-dismiss="modal">&times;</button>
													          <h4 class="modal-title">ABOUT COLLEGE</h4>
													        </div>
													        <div class="modal-body">
													          <p><?= $row_college_details["CDetails_description"]; ?></p>
													        </div>
													        <div class="modal-footer">
													          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													        </div>
													      </div> 
    												</div>
  												</div>



									</div> 
								</div>
							</div>
						</div>
	</section> 
	<section id="course" class="course">
	<div class="container collegeSearchGrid">  
					
					<h4 class="title">COURSES</h4>
					<div style="border-bottom:1px solid #ccc;"></div>
						<div class="owl-carousel show-nav-hover dots-dark nav-square dots-square navigation-color" data-animatein="zoomIn" data-animateout="slideOutDown" data-items="1" data-margin="30" data-loop="true" data-merge="true" data-nav="true" data-dots="false" data-stagepadding="" data-mobile="1" data-tablet="3" data-desktopsmall="3"  data-desktop="4" data-autoplay="false" data-delay="3000" data-navigation="true"> 
						<?php foreach($result_college_courses as $row_college_courses){
								if($row_college_courses["Course_logo"]=='') {$image="no-image.jpg";} else{ $image=$row_college_courses["Course_logo"]; } 
								$clge_course_url=str_replace(" ","-",$row_college_courses["Course_name"]); 
								$clge_course_url=preg_replace('/[^A-Za-z0-9\-]/','',$clge_course_url);
								$clge_course_url=strtolower($clge_course_url);
							?>	
					<!-- Blog Grid Wrapper -->
							<div class="blog-wrap1">
									<div class="blog-wrap" style="background:#F6F6F6;">
										<!-- Blog Image Wrapper -->
										<div class="blog-img-wrap" style="border-bottom: 1px solid #ccc;margin-top: 0px;">
											<img src="<?php echo FILE_PATH; ?>uploads/courses/thumbs/<?php echo $image; ?>" class="img-responsive" alt="<?php echo $row_college_courses["Course_name"]; ?>" style="width:215px;height:80px;">
											
										</div><!-- Blog Wraper -->
										<!-- Blog Detail Wrapper -->
										<div class="blog-details" style="background:#F6F6F6">
											<div style="min-height:60px"> 
											<h5><a href="<?php echo base_url();?>course/<?php echo $row_college_courses["Clgecourse_id"];?>/<?php echo $clge_course_url;?>"><b style="font-size:13px"><?php  echo $row_college_courses["Course_name"]; ?></b></a></h5>
											</div>
											<div class="clearfix"></div>
									<table class="table table-bordered"> 
										<tbody>
											<tr style="font-size:12px;">
												<td><b>University / Board</b></td>
												<td><b>Course Duration</b></td>
												<td><b>Program Shift</b></td> 
											</tr> 
											<?php 
												if($row_college_courses["Clgecourse_morning_shift"]==1)
												{$morning="Morning";} else{$morning="";}
												if($row_college_courses["Clgecourse_day_shift"]==2){$day="Day";} else{$day="";}
												if($row_college_courses["Clgecourse_evening_shift"]==3)
												{$evening="Evening";} else{$evening="";}
											?>
											<?php
												$n=2;
												if($row_college_courses["Clgecourse_syllabustype"]==0)
												{
													$duration=$row_college_courses["Clgecourse_duration"].' '."years";
												}
												else
												{
													
													$duration=$row_college_courses["Clgecourse_duration"]*$n.' '."semesters";
												}
											?>
											<tr style="font-size:10px">
												<td><?php echo $row_college_courses["Univ_name"];?></td>
												<td><?php echo $duration;?></td>
												<td><?php if($morning=="" AND  $day=="" AND $evening==""){ echo "N/A"; }else{ echo $morning.' / '.$day.' / '.$evening; } ?></td> 
											</tr>
										</tbody> 
									</table>  
																		<div class="clearfix"></div> 
											<div class="clearfix"></div>
											<div class="text-center" style="margin-top:20px;">
											<a href="<?php echo base_url();?>course/<?php echo $row_college_courses["Clgecourse_id"];?>/<?php echo $clge_course_url;?>" class="btn btn-block">More Details</a>
											</div>
										</div><!-- Blog Detail Wrapper -->
									</div>
							</div><!-- Blog Wrapper -->   
					<?php } ?>		
			</div>	
					
		</div><!-- Container -->
	</section> 


			<div class="clearfix"></div>
			<?php foreach($result_count_gallery_image as $row_count_gallery_image) if($row_count_gallery_image["count"] > 0){?>
			<section id="gallery" class="typo-dark" style="padding-top:0px;">
				<div class="container collegeSearchGrid">
					<div class="col-md-12 col-xs-12 col-sm-12"> 
						<div class="isotope-filters">
						<h4 class="title">College Gallery</h4>
						<div style="border-bottom:1px solid #ccc;"></div>
							<ul class="nav nav-pills" style="margin-top:20px;">
								<li><a href="#" data-filter=".all" class="filter active">ALL</a></li>
								<?php foreach($result_list_album as $row_list_album){?>
								<li><a href="#" data-filter=".<?php echo $row_list_album["CPalbum_id"];?>" class="filter"><?php echo strtoupper($row_list_album["CPalbum_title"]);?></a></li>
								<?php }?> 
							</ul>
						</div> 
						<div class="isotope-grid grid-three-column has-gutter-space" data-gutter="20" data-columns="3">
							<div class="grid-sizer"></div>
							<?php foreach($result_gallery_image as $row_gallery_image){?>	
							<div class="item all <?php echo $row_gallery_image["CPgallery_calbumid"];?>"> 
								<div class="image-wrapper"> 
									<img src="<?php echo FILE_PATH;?>uploads/college-gallery/thumbs/<?php echo $row_gallery_image["CPgallery_image"];?>" alt="<?php echo $row_gallery_image["CPgallery_image"];?>" width="640" height="360" /> 
									<div class="gallery-detail btns-wrapper"> 
										<a href="<?php echo FILE_PATH;?>uploads/college-gallery/thumbs/<?php echo $row_gallery_image["CPgallery_image"];?>" data-rel="prettyPhoto[portfolio]" class="btn uni-full-screen"></a>
									</div><!-- Gallery Btns Wrapper -->
								</div><!-- Image Wrapper -->
							</div><!-- Portfolio Item -->
							<?php } ?>							
						</div><!-- Gallery Block -->
						</div>
					
				</div><!-- Row -->
			</section><!-- Section -->
			<?php }?>
			
				<div class="clearfix"></div>
<?php if(!empty($row_college_details["CDetails_location_map"])){?>	
<section id="location" class="snap-section">
		<div class="container">
<div class="container collegeSearchGrid">
								<h4 class="title">College Location</h4>
								<div class="snap">
									<div class="col-md-12">
										<iframe src="<?= $row_college_details["CDetails_location_map"]; ?>" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
									</div>  
								</div>
							</div>
						</div>
	</section>
<?php } ?>			 
			<?php if($row_college_details["Clge_verified_id"]!=1){ ?>
			<div class="container">
				<div class="row">
				
					<div class="col-md-12 col-xs-12 col-sm-12"> 
					 <div class="isotope-filters">
					 
						<center><p>Represent this college? Edit/Update Data Anytime. <a href="javascript:void(0);" id="myModalbtn">Request Access</a></p> </center>
					 </div> 
					</div>
				</div><!-- Column -->
			</div><!-- Row -->
			<?php } ?> 
<script>
function validate_request()
{
	var Clge_add_name=college_request.Clge_add_name.value; 
	Clge_add_name=Clge_add_name.trim();
	var Clge_add_phone=college_request.Clge_add_phone.value; 
	Clge_add_phone=Clge_add_phone.trim();
	var Clge_add_email=college_request.Clge_add_email.value; 
	Clge_add_email=Clge_add_email.trim();
	var Clge_add_clgeid=college_request.Clge_add_clgeid.value; 
	Clge_add_clgeid=Clge_add_clgeid.trim();
	if(Clge_add_name=="" || Clge_add_name==null)
	{
		document.getElementById("Clge_add_name").innerHTML="* Required";
		college_request.Clge_add_name.focus();
		return false;
	}
	if(Clge_add_name!="" || Clge_add_name!=null)
	{
		document.getElementById("Clge_add_name").innerHTML=""; 
	}      	
	if(Clge_add_phone!="")
	{
		if(isNaN(Clge_add_phone))
		{
			document.getElementById("Clge_add_phone").innerHTML="*Dosen't Support Invalid Characters";
			college_request.Clge_add_phone.focus();
			return false;
		}
		if(Clge_add_phone.length < 9)
		{
			document.getElementById("Clge_add_phone").innerHTML="* Invalid Contact Number";
			college_request.Clge_add_phone.focus();
			return false;
		}
	} 
	if(Clge_add_email=="" || Clge_add_email==null)
	{
		document.getElementById("Clge_add_email").innerHTML="* Required";
		college_request.Clge_add_email.focus();
		return false;
	}
	if(Clge_add_email!="" || Clge_add_email!=null)
	{
		$.post("<?php echo base_url();?>search/Add_college_requestAjax",{Clge_add_name:Clge_add_name,Clge_add_phone:Clge_add_phone,Clge_add_email:Clge_add_email,Clge_add_clgeid:Clge_add_clgeid},function(data){
		  $("#rsultMsg2").html(data);
		}); 
	} 
}
</script>
 <!-- Modal -->
  <div id="myModal">
    <div class="modal-dialog">
     <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <p class="modal-title"><strong>Request Access Form</strong></p>
        </div>
		<p><?php if(isset($msg))echo $msg; ?></p>
		<center><span id="rsultMsg2"></span></center><br/>
		<form name="college_request" action="" enctype="multipart/form-data"  method="post" role="form" onsubmit="return validate_request()">
			<div class="modal-body">
			<?php //echo $row_college_details["Clge_id"];?>
			<input type="hidden" name="Clge_add_clgeid" value="<?php echo $row_college_details["Clge_id"]; ?>" class="form-control">
			<div class="col-md-4">College Name *</div>
			<div class="col-md-8">
				<input placeholder="Enter College Name" type="text" name="Clge_add_name" value="<?php echo $row_college_details["Clge_name"]; ?>" class="form-control">
				<b><span id="Clge_add_name" style="color:red"></span></b>
			</div>
			<div class="col-md-4">Phone No.</div>
			<div class="col-md-8">
				<input placeholder="College Contact No" type="text" name="Clge_add_phone" value="<?php echo $this->input->post("Clge_add_phone"); ?>" class="form-control">
				<b><span id="Clge_add_phone" style="color:red"></span></b>
			</div>
			<div class="col-md-4">Email *</div>
			<div class="col-md-8">
				<input placeholder="College Email" type="text"  name="Clge_add_email" value="<?php echo $this->input->post("Clge_add_email"); ?>" class="form-control">
				<b><span id="Clge_add_email" style="color:red"></span></b>
			</div>
			<div class="col-md-4">&nbsp;</div>
			<div class="col-md-8">
				<input type="submit" value="Submit" name="add_request" class="btn btn-primary"> 
				<input type="reset" value="Cancel" class="btn btn-primary">
			</div>
		</form>	
		 <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
<?php	
}
elseif($action=="view_course")	
{
	/*if(!is_numeric($_GET["mycourseid"]))
	{
		redirect(base_url().'index.php/page_not_found');
	}*/
	foreach($result_individual_college_courses as $row_individual_college_courses)
	$clge_url=str_replace(" ","-",$row_individual_college_courses["Clge_name"]." ".$row_individual_college_courses["Clge_city"]);
	$clge_url=preg_replace('/[^A-Za-z0-9\-]/','',$clge_url);
	$clge_url=strtolower($clge_url); 
	$clge_course_url=str_replace(" ","-",$row_individual_college_courses["Course_name"]); 
	$clge_course_url=preg_replace('/[^A-Za-z0-9\-]/','',$clge_course_url);
	$clge_course_url=strtolower($clge_course_url);
?>
<div class="page-header internalPages">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<!-- Page Header Wrapper -->
				<div class="page-header-wrapper"> 
					<h5 class="sub-title"><?php  echo $row_individual_college_courses["Course_name"];?> - <?php echo $row_individual_college_courses["Course_type_name"]; ?></h5>
					<ol class="breadcrumb">
						<li><a href="<?php echo base_url();?>">Home</a></li>
						<li><a href="<?php echo base_url();?>college/<?php echo $row_individual_college_courses["Clge_id"]; ?>/<?php echo $clge_url; ?>"><?php echo $row_individual_college_courses["Clge_name"];?></a></li>
						<li><?php echo $row_individual_college_courses["Course_name"];?></li> 
					</ol><!-- Breadcrumb -->
				</div><!-- Page Header Wrapper -->
			</div><!-- Coloumn -->
		</div><!-- Row -->
	</div><!-- Container -->
</div><!-- Page Header -->
<div role="main" class="main">
	<section class="promo-section" id="intro">
		<div class="container">
		<!-- Course Detail -->
		                <div class="container collegeSearchGrid">
						<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
							
								<!-- Course Content -->
								<div class="course-meta margin-top-30">
									<div class="headline"><?= $row_individual_college_courses["Clge_name"]; ?><b style="black"> <?php if(!empty($row_individual_college_courses["Course_short_name"])) { echo $row_individual_college_courses["Course_short_name"]; } else{ $row_individual_college_courses["Course_name"];} ?></b> Snapshot</div> 
									<?php $this->load->view('modules/enquiry', ['clge_id' => $row_individual_college_courses["Clge_id"],'courseid' => $Clgecourse_id, 'clge_name' => $row_individual_college_courses["Clge_name"]]);?> 
									<?php 
									$db3=$this->load->database("db3",true);
									$db3=$db3->database;
									$this->db->from("$db3.college_courses");
									$this->db->join("$db3.college_faculty","college_faculty.Cfaculty_id=college_courses.Clgecourse_facultyid");
									$this->db->where("Clgecourse_id",$Clgecourse_id);
									$query_clgcourse=$this->db->get();
									$result_clgcourse=$query_clgcourse->result_array();
									foreach($result_clgcourse as $row_clgcourse) {
									?>
									<span class="cat bg-yellow"><?php echo $row_clgcourse["Cfaculty_name"];?></span>
									<?php } ?>

									<ul class="course-meta-icons" style="list-style: none;">
										<li>
											<i class="fa fa-university"></i><span>University</span> :- <b><?php 
											echo $row_individual_college_courses["Univ_name"]; ?> </b>
										</li>
										<li>
											<i class="fa fa-file-text"></i><span>Syllabus type</span> :- <b><?php 
											if($row_individual_college_courses["Clgecourse_syllabustype"]==0){$syllabus="Year Wise";}else{$syllabus="Semester Wise";}
											echo $syllabus; ?> </b>
										</li>
										<li>
											<i class="fa fa-clock-o"></i><span>Course Duration</span> :- <b><?php 
											if($row_individual_college_courses["Clgecourse_syllabustype"]==0){
											echo $row_individual_college_courses["Clgecourse_duration"]; echo "".' '. "Year";}else{echo $row_individual_college_courses["Clgecourse_duration"]*2; echo "".' '. "Semesrer";}
												?></b>
										</li>
										<li>
											<i class="fa fa-comments"></i><span>Credit</span> :- <b><?php 
											if($row_individual_college_courses["Clgecourse_credit"]==""){$credit="NA";}else{$credit=$row_individual_college_courses["Clgecourse_credit"];}
											echo $credit; ?> </b>
										</li>
										<li>
											<i class="fa fa-pencil"></i><span>Exam Required</span> :- <b><?php echo $row_individual_college_courses["Clgecourse_req_exam"];?></b>
										</li>
										<li>
											<?php if($row_individual_college_courses["Clgecourse_adm_opendate"]!='0000-00-00') { echo '<i class="fa fa-clock-o"></i><span>Course Start Date</span> :- <b>'; echo $row_individual_college_courses["Clgecourse_adm_opendate"]; }?></b>
										</li>
										<?php if($row_individual_college_courses["Clgecourse_total_seats"]!=0 AND $row_individual_college_courses["Clgecourse_total_seats"]!=""){?>
										<li>
											<?php  echo '<i class="fa fa-users"></i><span>Total Seats</span> :- <b>'; echo $row_individual_college_courses["Clgecourse_total_seats"];?></b>
										</li>
										<?php } ?>
										<?php  if($row_individual_college_courses["Clgecourse_fee"]!="" AND$row_individual_college_courses["Clgecourse_fee"]!="0") {?>
										<li>
											<?php echo '<i class="fa fa-money"></i><span>Total Tution Fee</span>:- <b>Rs '; echo $row_individual_college_courses["Clgecourse_fee"];?></b>
										</li>
										<?php } ?>
										<li>
											<i class="fa fa-book"></i><span>Program Shift</span>  
											<?php 
											if($row_individual_college_courses["Clgecourse_morning_shift"]==0 AND$row_individual_college_courses["Clgecourse_day_shift"]==0 AND$row_individual_college_courses["Clgecourse_evening_shift"]==0){ $shift="N/A"; echo $shift;	}
											else 
											{ 
												if($row_individual_college_courses["Clgecourse_morning_shift"]==1)
												{$shift1="Morning";$time1=$row_individual_college_courses["Clgecourse_morning_time"];?>
												<span> :- <?php echo "".'  '. $shift1.'  ( '.$time1.' )'.""; ?></span><br/>
												<?php } 
												//else{$shift1="Course Of College	";$time1="No Morning Shift";}
												if($row_individual_college_courses["Clgecourse_day_shift"]==2)
												{$shift2="Day";$time2=$row_individual_college_courses["Clgecourse_day_time"];?>
												<span style="margin-left:3.3cm">:-<?php echo "".'  '. $shift2.'  ( '.$time2.' )'.""; ?></span><br/>
												<?php }
												//else{$shift2="Course Of College	";$time2="No Day Shift";}
												if($row_individual_college_courses["Clgecourse_evening_shift"]==3)
												{$shift3="Evening";$time3=$row_individual_college_courses["Clgecourse_evening_time"];?>
												<span style="margin-left:3.3cm">:-<?php echo "".'  '. $shift3.' ( '.$time3. ')'.""; ?></span>
												<?php }
												//else{$shift3="Course Of College	";$time3="No Evening Shift";}
												?> 
											<?php }	?>
										</li>
									</ul>
								</div>
							</div><!-- Course Detail -->
							<div class="col-sm-4 col-sm-4 col-xs-4">  
									 
						<?php 
						$db3=$this->load->database("db3",true);
						$db3=$db3->database;
						$this->db->from("$db3.course_achievers"); 
						$this->db->where('Cachv_ccid',$Clgecourse_id);
						$qry=$this->db->get();
						$row=$qry->result_array(); 
						if(count($row) > 1){
					?>
						<div class="headline"><center>Achievers of <?php if(!empty($row_individual_college_courses["Course_short_name"])) { echo $row_individual_college_courses["Course_short_name"]; } else{ $row_individual_college_courses["Course_name"];} ?></center></div>	
						<div class="owl-crousel" >  
							<div class="owl-carousel show-nav-hover dots-dark nav-square dots-square navigation-color" data-animatein="zoomIn" data-animateout="slideOutDown" data-items="1" data-margin="30" data-loop="true" data-merge="true" data-nav="true" data-dots="false" data-stagepadding="" data-mobile="1" data-tablet="2" data-desktopsmall="1"  data-desktop="1" data-autoplay="false" data-delay="3000" data-navigation="true" background="white"> 
							<?php foreach($row as $achievers): ?>	
								<div class="">
								    <div class="best-0">
									    <div class="best-1">
										<table>
											<tr>
												<th style="text-align:left;width: 124px;"> 
													<center><img src="<?php echo FILE_PATH; ?>uploads/course-achievers/thumbs/<?= $achievers['Cachv_pic'] ?>"  style="border-radius:100%;width:66%;height:50%"></center>	
												</th>
												<th style="text-align:left">	
													<?= $achievers['Cachv_name'];?><br/><i style="font-size: 10px">(<?= $achievers['Cachv_batch'];?> Batch)</i><br/> <span style="font-size: 12px">Achievement - <?= $achievers['Cachv_achievement'];?></span> 		
												</th>  
											</tr>  
										</table>  
										</div>
									</div>
								</div> 
							<?php endforeach; ?>	 
							</div>
						</div>
					<?php } ?>	
					</div>	
						</div><!-- Column -->

						
					</div><!-- Course Wrapper -->
				
	</section>
<?php if(!empty($row_individual_college_courses['Clgecourse_details']))	{?>
<!--  About Section -->
	<section id="highlight" class="promo-section">
		<div class="container">
<div class="container collegeSearchGrid">  
					<div class="headline">About</div>
    <div class="course">
				<p><?= $row_individual_college_courses['Clgecourse_details']?></p>
				</div>
						</div>
	</section>
	<!--  About Section -->
<?php }	?>
<?php if(!empty($row_individual_college_courses['Clgecourse_approvals']))	{?> 
	<section id="highlight" class="promo-section">
		<div class="container">
<div class="container collegeSearchGrid">  
					<div class="headline">Approvals and Affiliation</div>
    <div class="course">
				<p><?= $row_individual_college_courses['Clgecourse_approvals']?></p>
				</div>
						</div>
	</section> 
<?php }	?>
<?php if(!empty($row_individual_college_courses['Clgecourse_scholarship']))	{?> 
	<section id="highlight" class="promo-section">
		<div class="container">
<div class="container collegeSearchGrid">  
					<div class="headline">Financial Aid and Scholarship</div>
    <div class="course">
				<p><?= $row_individual_college_courses['Clgecourse_scholarship']?></p>
				</div>
						</div>
	</section> 
<?php }	?>
	<section id="admission" class="container content-lg">
				<div class="container collegeSearchGrid">  
					<ul class="course-meta-icons">
					<div class="headline">ADMISSION</div>
						<li>
							<?php 
								if($row_individual_college_courses["Clgecourse_pre_reqd_edu"]==""){$preedu="NA";}
								else{$preedu=$row_individual_college_courses["Clgecourse_pre_reqd_edu"];}
							echo "Pre-required Education : ".' '.	$preedu; ?>
						</li>
						<li>
							<?php 
							if($row_individual_college_courses["Clgecourse_eligibility"]==""){$credit="NA";}else{$credit=$row_individual_college_courses["Clgecourse_eligibility"];}
							echo "Eligibility :".' '.$credit; ?> 
						</li>
						<li>
							<?php 
							if($row_individual_college_courses["Clgecourse_adm_opendate"]=="0000-00-00" AND $row_individual_college_courses["Clgecourse_adm_opendate"]=="0000-00-00"){echo "Admission Date :".' '."NA";}else{echo "Admission :".' '.$row_individual_college_courses["Clgecourse_adm_opendate"].' To '.$row_individual_college_courses["Clgecourse_adm_closedate"]; }
							?> 
						</li>
						<li>
							<?php 
							if($row_individual_college_courses["Clgecourse_entrancedae_from"]=="0000-00-00"){
							echo "Entrance date :".' '."NA";}
							if($row_individual_college_courses["Clgecourse_entrancedae_from"]!="0000-00-00" AND $row_individual_college_courses["Clgecourse_entrancedae_to"]=="0000-00-00"){echo "Entrance date :".' '.$row_individual_college_courses["Clgecourse_entrancedae_from"];} 
							if($row_individual_college_courses["Clgecourse_entrancedae_from"]!="0000-00-00" AND $row_individual_college_courses["Clgecourse_entrancedae_to"]!="0000-00-00"){echo "Entrance date :".' '.$row_individual_college_courses["Clgecourse_entrancedae_from"].' To '.$row_individual_college_courses["Clgecourse_entrancedae_to"];}
							?> 
						</li>
					</ul> 
					<div class="row">
						<div class="col-xs-6">
							<div class="admission-req">
								<ul class="course-meta-icons"> 
								<div class="headline">Required Documents for Admission</div>
									<li>
										<?php 
										if($row_individual_college_courses["Clgecourse_documents"]==""){$doc_req="Not Aplicable";}else{$doc_req=$row_individual_college_courses["Clgecourse_documents"];}
										echo $doc_req; ?> 
									</li>
								</ul> 
							</div> 
							<div class="admission-req"> 
							<ul>
								<li><i class="fa fa-angle-right"></i>Passport Size photo 2 pieces</li>
								<li><i class="fa fa-angle-right"></i>Transcripts of all previous education</li>
								<li><i class="fa fa-angle-right"></i>Citizenship photocopy</li>

							</ul> 
							</div>
						</div>	
						<div class="col-xs-6">
							<div class="admission-req">
								<ul class="course-meta-icons"> 
								<div class="headline">Graduation Requirements</div>
									<li>
										<?php 
										if($row_individual_college_courses["Clgecourse_ugpg_reqmts"]==""){$gradu_req="Not Aplicable";}else{$gradu_req=$row_individual_college_courses["Clgecourse_ugpg_reqmts"];}
										echo $gradu_req; ?> 
									</li>
								</ul>
							</div>
						</div>	
					</div>
				</div><br/>
		</section><!-- Section -->  
<?php 
$this->db->where('Cplac_status',1);
$this->db->where('Cplac_ccourseid',$Clgecourse_id);
$this->db->limit('5');
$qry=$this->db->get("$db3.course_placements");
if($qry->num_rows() > 0){
	$row=$qry->result_array();
?>
<section id="course" class="container content-lg">
	<div class="container collegeSearchGrid">  
					<ul class="course-meta-icons">
					<div class="headline">PLACEMENTS</div>
						<div class="owl-carousel" 
						data-animatein="" 
						data-animateout="" 
						data-items="1" 
						data-loop="true" 
						data-merge="true" 
						data-nav="true" 
						data-dots="false" 
						data-margin="" 
						data-stagepadding="" 
						data-mobile="1" 
						data-tablet="2" 
						data-desktopsmall="4"  
						data-desktop="5" 
						data-autoplay="false" 
						data-delay="3000" 
						data-navigation="true">
						<?php  foreach($row as $placement): ?> 
							<div class="item"><img src='<?= FILE_PATH; ?>uploads/college-placements/thumbs/<?php echo (!empty($placement["Cplac_logo"])) ? $placement["Cplac_logo"] : "no-image.jpg"; ?>' alt="<?= $placement["Cplac_company"]; ?>" alt="<?= ucwords($placement["Cplac_company"]); ?>" style="width:100%;height:150px"><center><b><?= ucwords($placement["Cplac_company"]); ?></b></center></div>
						<?php endforeach; ?>	 
					</div> 
					
				</div>
</section> 
<?php  } ?> 
	<section id="course" class="container content-lg">
		<div class="container collegeSearchGrid">    
		<div class="headline">More Colleges Releated To This Courses</div> 
		<div class="owl-carousel dots-inline" 
						data-animatein="" 
						data-animateout="" 
						data-items="1" 
						data-loop="true" 
						data-merge="true" 
						data-nav="true" 
						data-dots="true" 
						data-stagepadding="" 
						data-margin="30"
						data-mobile="1" 
						data-tablet="3" 
						data-desktopsmall="4"  
						data-desktop="4" 
						data-autoplay="false" 
						data-delay="3000" 
						data-navigation="true">
					<!-- Blog Grid Wrapper -->  
					<?php 
								$db3=$this->load->database("db3",true);
								$db3=$db3->database;
								$db4=$this->load->database("db4",true);
								$db4=$db4->database;
								$this->db->from("$db3.college_courses");
								$this->db->join("$db3.college","college.Clge_id=college_courses.Clgecourse_college_id");
								$this->db->join("$db4.university_courses","university_courses.Ucourse_id=college_courses.Clgecourse_univcourseid");
								$this->db->where("Ucourse_courseid",$row_individual_college_courses["Ucourse_courseid"]);
								$this->db->where("Clgecourse_college_id!=",$row_individual_college_courses["Clgecourse_college_id"]);
								$this->db->limit(50);
								$sql_clgecourse=$this->db->get();
								$res_clgecourse=$sql_clgecourse->result_array();
								foreach($res_clgecourse as $row_clgecourse){
									if($row_clgecourse["Clge_logo"]==""){$image='no-image.jpg';} else {$image=$row_clgecourse["Clge_logo"];}	
								$clge_course_url=str_replace(" ","-",$row_individual_college_courses["Course_name"]); 
								$clge_course_url=preg_replace('/[^A-Za-z0-9\-]/','',$clge_course_url);
								$clge_course_url=strtolower($clge_course_url);
					?>
					<div class="blog-wrap" style="min-height: 433px;">
						<!-- Blog Image Wrapper -->
						<div class="blog-img-wrap" style="border-bottom: 1px solid #ccc;margin-top: 0px;">
							<img src="<?php echo FILE_PATH; ?>uploads/colleges/thumbs/<?php echo $image; ?>" class="img-responsive center-block" alt="<?php echo $row_clgecourse["Clge_name"]; ?>" style="width:138px;height:68px;"> 
							<!--<h6 class="post-type bg-yellow">&nbsp;<i class="fa fa-bank"></i>&nbsp;</h6>-->
						</div><!-- Blog Wraper -->   
						<div class="blog-details">
						<div style="min-height:69px">
							<h5><a href="<?php echo base_url();?>college/<?php echo $row_clgecourse["Clge_id"]; ?>/<?php echo $clge_url; ?>"><?php echo $row_clgecourse["Clge_name"]; ?></a> </h5>  
						</div>	
							<ul class="blog-meta">
							<?php 
								$db3=$this->load->database("db3",true);
								$db3=$db3->database; 
								$db4=$this->load->database("db4",true);
								$db4=$db4->database;
								$this->db->select('Course_name,COUNT(Course_id) as total_course');
								$this->db->from("$db3.college_courses");
								$this->db->join("$db4.university_courses",'university_courses.Ucourse_id =college_courses.Clgecourse_univcourseid','left');
								$this->db->join("$db4.university",'university.Univ_id =university_courses.Ucourse_universityid','left');
								$this->db->join("$db4.courses",'courses.Course_id =university_courses.Ucourse_courseid','left');
								$this->db->where("Clgecourse_college_id",$row_clgecourse["Clge_id"]);
								$query_college_course=$this->db->get();
								$row_clgecourse_course=$query_college_course->row();
							?> 
								<li><i class="fa fa-book"></i></li>
								<li><?php echo $row_clgecourse_course->Course_name; ?> <?php if($row_clgecourse_course->total_course>0){?>+<?php echo $row_clgecourse_course->total_course-1; ?> Courses<?php } else {echo "NA";} ?></li> 
							</ul><!-- Blog Meta -->  
							<ul class="blog-meta facilityBlog">
								<?php 
									$db3=$this->load->database("db3",true);
									$db3=$db3->database;
									$this->db->select("Facility_id,Clgefacility_facilityid,Clgefacility_clgeid,Facility_name,Facility_icon");
									$this->db->from("$db3.college_facilities");
									$this->db->join("$db3.facilities","facilities.Facility_id=college_facilities.Clgefacility_facilityid");
									$this->db->where("Clgefacility_clgeid",$row_clgecourse["Clge_id"]);
									$query_facility=$this->db->get();
									$result_facility=$query_facility->result_array();
									foreach($result_facility as $row_facility) {
								?>
								<li title="<?php echo $row_facility["Facility_name"];?>"> <?php echo $row_facility["Facility_icon"];?></li>
								<?php }?>
							</ul>  
							<div class="text-center" style="margin-top:38px;">
							<a class="btn" href="<?php echo base_url();?>college/<?php echo $row_clgecourse["Clge_id"]; ?>/<?php echo $clge_url; ?>">View Details</a> 
							</div>
						</div><!-- Blog Detail Wrapper --> 
					</div><!-- Blog Wrapper -->
					<?php }?>
				</div>  
							
							
					
				</div>
</section>   
</div><!-- Page Main -->
<?php	
}
?>	
      
    </div>
  </div>