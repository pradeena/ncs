<?php
defined("BASEPATH") or exit("No Direct Script Allowed"); 
//$action=isset($_REQUEST["action"])? $_REQUEST["action"]:"list_search_results";
$pg  = isset($_GET['pg']) ? $_GET['pg'] : 1;
$start_from = ($pg-1) * 10;
?> 
<style type="text/css">  
h1{font-size: 28px;
    line-height: 35px;
    margin: 0 0 6px;}
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
	height:380px; 
	width:500px; 
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
@media(max-width:767px){
	.owl-stage-outer{height: 240px!important;}
}
</style> 
<script>
function Clge_enquiryValidate()
{  
	var Cenq_fstname=Clge_enquiry.Cenq_fstname.value;
	var Cenq_lstname=Clge_enquiry.Cenq_lstname.value;
	var Cenq_email=Clge_enquiry.Cenq_email.value;
	var Cenq_enquirytypeid=Clge_enquiry.Cenq_enquirytypeid.value;
	var Cenq_clgeid=Clge_enquiry.Cenq_clgeid.value;
	var Cenq_enquiry_statusid=Clge_enquiry.Cenq_enquiry_statusid.value;
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
		$.post("<?php echo base_url()?>enquiry/general_EnquiryAjax",{CEcmntsced_usercomment:CEcmntsced_usercomment,Cenq_fstname:Cenq_fstname,Cenq_lstname:Cenq_lstname,Cenq_email:Cenq_email,Cenq_enquirytypeid:Cenq_enquirytypeid,Cenq_clgeid:Cenq_clgeid,Cenq_enquiry_statusid:Cenq_enquiry_statusid},function(data){
			$("#rsultMsg").html(data);
		});
	}   
	return false;
}
</script>
<script>
$(document).ready(function(){
	$("p").each(function() {
    var $this = $(this);
    $(this).html($(this).replace(/&nbsp;/gi,'')).text();
});
})
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
					<h5 class="sub-title"><span style="color:#666"><?php echo $row_total_recordfound["count"];?> Results for </span> - <?php echo $this->input->get("qry");?></h5>
					<ol class="breadcrumb">
						<li><a href="<?php echo base_url();?>">Home</a></li>
						<li class="active">Search Results</li>
					</ol><!-- Breadcrumb -->
				</div><!-- Page Header Wrapper -->
			</div><!-- Coloumn -->
		</div><!-- Row -->
	</div><!-- Container -->
</div><!-- Page Header -->
<div role="main" class="main"> 
	<div class="page-default">
		<!-- Container -->
		<div class="container">
			<div class="row">
				<!-- Sidebar -->
				<div class="filterNew"></div>
				<div class="col-md-3 mobilefilter show">
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
</script>
										<div id="collapseThree" class="panel-expanded expanded" role="tabpanel" aria-labelledby="headingThree">
											<div class="panel-body">
												<ul class="go-widget">
													<?php foreach($result_list_university as $row_list_university) { ?>  
													<form name="UnivFilter" method="post" action=""> 
													<li><input  onclick="return goto(this.value)" name="Univ_filter" type="radio" value="<?php echo base_url();?>index.php/search?qry=<?php echo $this->input->get("qry"); ?>&univid=<?php echo $row_list_university["Univ_id"]; ?>" > <?php echo ucwords($row_list_university["Univ_name"]);?> (<?php echo $row_list_university["total_college"] ; ?> )</li> 
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
													<li><input type="radio" onclick="return goto_city(this.value)" name="City_filter" value="<?php echo base_url();?>index.php/search?qry=<?php echo $this->input->get("qry"); ?>&cty=<?php echo $row_list_cities["Clge_city"]; ?>" > <?php echo ucwords($row_list_cities["Clge_city"]);  ?> (<?php echo $row_list_cities["total_college"];?> )</li> 
													<?php }?> 
												</ul>
												</form>
											</div>
										</div>
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
								<!-- Course Banner Image -->
								<div class="col-sm-12 col-sm-12 col-xs-12">
									<div class="course-banner-wrap" style="margin:0 auto;">
										<a href="<?php echo base_url();?>college/<?php echo $row_search_college_or_course["Clge_id"]; ?>/<?php echo $clge_url; ?>">
										<img src="<?php echo FILE_PATH; ?>uploads/colleges/thumbs/<?php echo $image; ?>" class="img-responsive center-block" alt="<?php echo $row_search_college_or_course["Clge_name"]; ?>" style="width:200px;">
										<div class="cat"><?php echo $row_search_college_or_course["Ctype_name"]; ?></div>
										</a>
									</div><!-- Course Banner Image -->
								</div><!-- Column -->	
								<!-- Course Detail -->
								<div class="col-sm-12 col-xs-12 col-sm-12">
									<div class="course-detail-wrap">
										<!-- Course Content -->
										<div class="course-content">
											<h5><a href="<?php echo base_url();?>college/<?php echo $row_search_college_or_course["Clge_id"]; ?>/<?php echo $clge_url; ?>"><?php echo ucwords($row_search_college_or_course["Clge_name"]); ?> </a>  <span><?php echo $row_search_college_or_course["Clge_city"]; ?> , <?php echo $row_search_college_or_course["Cntry_name"]; ?></span></h5>
											<div>
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
											</div>
											<p class="text-center"><a href="<?php echo base_url();?>course/<?php echo $row_search_college_or_course["Clgecourse_id"];?>/<?php echo $clge_course_url;?>"><?php echo $row_search_college_or_course["Course_name"]; ?></a></p> 
											<p class="text-center">Course Duration:<?php echo $row_search_college_or_course["Clgecourse_duration"];?> Years</p>
											
												<div class="row">
													<div class="col-md-12">
														<table class="table table-bordered"> 
															<tbody>
																<tr style="font-size:13px;">
																	<td><b>Course Status</b></td>
																	<td><b>Total Fees (₹)</b></td>
																	<td><b>Exam Required</b></td>
																	<td><a href="#"><b>0 Reviews</b></a></td>
																</tr>
																<tr style="font-size:10px">
																	<td><?php if($row_search_college_or_course["Clgecourse_status"]==1){ echo "Currently Active";}else{echo "Currently Inactive";}?></td>
																	<td><?php if($row_search_college_or_course["Clgecourse_fee"]==""){ echo "NA";}else{echo $row_search_college_or_course["Clgecourse_fee"];}?></td>
																	<td><?php if($row_search_college_or_course["Clgecourse_req_exam"]==""){ echo "NA";}else{ echo $row_search_college_or_course["Clgecourse_req_exam"];}?></td>
																	<td><a href="#"><i class="fa fa-user"></i> 0 Questions on this course</a></td>
																</tr>
															</tbody> 
														</table>
													</div><!-- Column -->
												</div><!-- Row -->
											<div class="text-center">
											<a href="<?php echo base_url();?>course/<?php echo $row_search_college_or_course["Clgecourse_id"];?>/<?php echo $clge_course_url;?>" class="btn"> <i class="fa fa-eye"></i>  <b>View Details</b></a>
											<?php if($row_search_college_or_course["CDetails_ebrochure"]!=""){?> 
												<a class="btn btn-info" href="<?php echo FILE_PATH;?>uploads/college-e-brochure/<?php echo $row_search_college_or_course["CDetails_ebrochure"]; ?>" download><i class="fa fa-download"></i>  <b>College E-brochure</b></a>
											<?php }?>	
											</div>
										</div><!-- Course Content -->
									</div><!-- Course Detail -->
								</div><!-- Column -->	
							</div>
							</div><!-- Course Wrapper --><hr/>
						</li><!-- List -->
							<?php } ?>
						<!-- Pagination -->
						<?php
						$total_pages = ceil($row_total_recordfound["count"] /10); 
						?>
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
					</ol><!-- Breadcrumb -->
				</div><!-- Page Header Wrapper -->
			</div><!-- Coloumn -->
		</div><!-- Row -->
	</div><!-- Container -->
</div><!-- Page Header -->
<div role="main" class="main">  
	<div class="page-default">   
	<div class="container">
		<div class="row"> 
			<div class="col-md-3 col-sm-3 col-xs-12"> 
				<aside class="sidebar" style="background-color:#fff!important; border:1px solid #d1d1d1;">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="widget" style=" background-color: #fff; border: 0px solid #ccc;">
						<ul class="social-icons color1">
							<?php if($row_college_details["CDetails_googleplus_link"]!=""){?>
							<li class="googleplus"><a title="googleplus" target="_blank" href="<?php echo $row_college_details["CDetails_googleplus_link"];?>">googleplus</a></li><?php }?>
							<?php if($row_college_details["CDetails_facebook_link"]!=""){?>
							<li class="facebook"><a href="<?php echo $row_college_details["CDetails_facebook_link"];?>" target="_blank" title="Facebook">Facebook</a></li><?php }?>
							<?php if($row_college_details["CDetails_twitter_link"]!=""){?>
							<li class="twitter"><a href="<?php echo $row_college_details["CDetails_twitter_link"];?>" target="_blank" title="Twitter">Twitter</a></li><?php }?>
							<?php if($row_college_details["CDetails_youtube_link"]!=""){?>
							<li class="youtube"><a title="pinterest" target="_blank" href="<?php echo $row_college_details["CDetails_youtube_link"];?>">Youtube</a></li><?php }?>
						</ul>
					</div><!-- Widget --> 
				</div>
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="widget" style=" background-color: #fff; border: 0px solid #ccc; margin-top:10px;">
						<?php if($this->session->userdata("is_loged_in")){ 
								foreach($result_user_details as $row_user_details)?>
							<a href="#collegeEnquiry" class="btn btn-info" style="width:100px" id="myBtn"><i class="fa fa-pencil"></i> <br>Enquiry</a> 
							<div id="collegeEnquiry"> 
								<a href="#" class="cancel">&times;</a><br/><br/><center><span id="rsultMsg"></span></center><br/>
								<center><b>Enquiry To <?php echo $row_college_details["Clge_name"]; ?></b></center><br/>	
								<form name="Clge_enquiry" action="" onsubmit="return Clge_enquiryValidate();" method="post" >
									<input type="hidden" name="Clge_name" value="<?php echo ucwords($row_college_details["Clge_name"]); ?>"> 
									<input type="hidden" name="Cenq_clgeid" value="<?php echo ucwords($row_college_details["Clge_id"]); ?>"> 
									<input type="hidden" name="Cenq_fstname" value="<?php echo ucwords($row_user_details["User_fstname"]); ?>"> 
									<input type="hidden" name="Cenq_lstname" value="<?php echo ucwords($row_user_details["User_lstname"]); ?>"> 
									<input type="hidden" name="Cenq_email" value="<?php echo ucwords($row_user_details["User_email"]); ?>"> 
									<input type="hidden" name="Cenq_enquirytypeid" value="1">	
									<input type="hidden" name="Cenq_enquiry_statusid" value="1">	
									<center>
										<textarea rows="7" cols="40" name="CEcmntsced_usercomment" value="<?php echo $this->input->post("CEcmntsced_usercomment"); ?>" placeholder="Specify Enquiry Details"></textarea><br/>
										<b><span style="color:red" id="CEcmntsced_usercomment"></span></b><hr/>
										<input type="submit" class="btn"  value="Submit"> 
										<input type="reset" class="btn" value="Reset" style="background:lightgray">
									</center>
								</form>
							</div> 
							<div id="cover" > 
							</div>
						<?php } ?>	
						<?php if($row_college_details["CDetails_ebrochure"]==''){echo " ";} else {?>
						<a style="width:100px" href="<?php echo FILE_PATH;?>uploads/college-e-brochure/<?php echo $row_college_details["CDetails_ebrochure"]; ?>" class="btn btn-info" download><i class="fa fa-download"></i> <br>E-Brochure</a>
						<?php }?>
						<?php if(!$this->session->userdata("is_loged_in")){?>
							<a href="<?php echo base_url();?>login?redirect=college/<?php echo $row_college_details["Clge_id"]; ?>/<?php echo $clge_url; ?>#collegeEnquiry" class="btn btn-info" style="width:100px" id="myBtn"><i class="fa fa-pencil"></i> <br>Enquiry</a> 
						<?php } ?><hr/>
					</div><!-- Widget --> 
				</div>
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="widget" style=" background-color: #fff; border: 0px solid #ccc;">
						<?php /*<h5 class="widget-title"  style="color:#1E90FF">Faces Of Kings</h5>
						<ul class="thumbnail-widget thumb-circle">
							<li>
								<div class="thumb-wrap">
									<img width="66" height="66" alt="Thumb" class="img-responsive" src="<?php echo base_url()?>assets/images/default/13.jpg">
								</div>
								<div class="thumb-content"><h5><a href="#">Narottam Aiyal</a></h5><span>Principal</span></div>	
							</li>
							<li>
								<div class="thumb-wrap">
									<img width="66" height="66" alt="Thumb" class="img-responsive" src="<?php echo base_url()?>assets/images/default/11.jpg">
								</div>
								<div class="thumb-content"><h5><a href="#">Som Prasad Pudasaini</a></h5><span>Chairman</span></div>	
							</li>
							<li>
								<div class="thumb-wrap">
									<img width="66" height="66" alt="Thumb" class="img-responsive" src="<?php echo base_url()?>assets/images/default/12.jpg">
								</div>
								<div class="thumb-content"><h5><a href="#">Ranjan Pokharel</a></h5><span>Student</span></div>	
							</li>
						</ul>*/?>
					</div><!-- Widget --> 
				</div>
				<div class="clearfix"></div>
				</aside><!-- aside -->	
			</div><!-- Column --> 
			<div class="col-md-9"> 
				<div class="row course-single">   	
					<div class="col-sm-12">
						<div class="course-detail"> 
							<div class="course-meta">
								<?php 
								$db3=$this->load->database("db3",true);
								$db3=$db3->database;
								$this->db->from("$db3.college_courses");
								$this->db->join("$db3.college_faculty","college_faculty.Cfaculty_id=college_courses.Clgecourse_facultyid");
								$this->db->where("Clgecourse_college_id",$row_college_details["Clge_id"]);
								$query_faculty=$this->db->get();
								$result_faculty=$query_faculty->result_array();
								foreach($result_faculty as $row_faculty) {
								?>
								<span class="cat"><?php echo $row_faculty["Cfaculty_name"]; ?></span>  
								<?php }?>
								<div class="rating"><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span></div><br/><br/>
								<h4 class="title"><img src="<?php echo FILE_PATH; ?>uploads/colleges/thumbs/<?php echo $image_logo; ?>" class="img-responsive center-block" alt="<?php echo $row_college_details["Clge_name"]; ?>" style="width:200px;"><h1><?php echo $row_college_details["Clge_name"]; ?></h1></h4>
								<ul class="course-meta-icons"> 
									<?php if($row_college_details["CDetails_total_students"]!=0){?>
									<li><i class="fa fa-users"></i><span>Total Students : </span><span><?php echo $row_college_details["CDetails_total_students"]; ?></span></li>
									<?php } ?>
									<li><i class="fa fa-bank"></i><span>College Type : </span><span><?php echo $row_college_details["Ctype_name"]; ?></span></li>
									<li><i class="fa fa-clock-o"></i><span>Estabilished :</span><span><?php echo $row_college_details["Clge_est_yr"]; ?></span></li>
									<li><i class="fa fa-clock-o"></i><span>Contact :</span><span><?php echo $row_college_details["Clge_contct_no"]; ?></span></li>
									<li><i class="fa fa-envelope-o"></i><span>Contact Email :</span><span><?php echo $row_college_details["Clge_email"]; ?></span></li>
									<li><i class="fa fa-map-marker"></i><span>Address :</span><span><?php echo $row_college_details["Clge_address1"].', '.$row_college_details["Clge_city"].', '.$row_college_details["Cntry_name"]; ?></span></li>
								</ul>
								<section>
								</section>
								<section>
								</section>
								<div class="clearfix"></div>
								<div class="col-sm-12"> 
									<?php 
										$db3=$this->load->database("db3",true);
										$db3=$db3->database;
										$this->db->select("*");
										$this->db->from("$db3.college_photos_gallery");
										$this->db->where("CPgallery_clgeid",$Clge_id);
										$this->db->where("CPgallery_make_cover",'1');
										$query_college_gallery_image=$this->db->get(); 
										$result_college_gallery=$query_college_gallery_image->result_array();
									?> 
						<div class="owl-crousel" <?php if($query_college_gallery_image->num_rows() < 2) { ?> style="display:none"<?php } ?>>  
							<div class="owl-carousel dots-inline" 
									data-animatein="" 
									data-animateout="" 
									data-items="1" data-margin="" 
									data-loop="true" 
									data-merge="true" 
									data-nav="true" 
									data-dots="true" 
									data-stagepadding="" 
									data-mobile="1" 
									data-tablet="1" 
									data-desktopsmall="1"  
									data-desktop="1" 
									data-autoplay="false" 
									data-delay="3000" 
									data-navigation="true"> 
									<?php 
										foreach($result_college_gallery as $row_college_gallery)
										{
										if($row_college_gallery["CPgallery_image"]=='') {$image="no-image.jpg";} else{ $image=$row_college_gallery["CPgallery_image"]; } ?>
										<div class="item"> 
											<div class="news-wrap">
												<a href="#"><img class="img-responsive" src="<?php echo FILE_PATH; ?>uploads/college-gallery/thumbs/<?php echo $image; ?>" alt="<?php echo $row_college_gallery["CPgallery_image"];?>" style="width:100%"></a>  
											</div><!-- News Wrapper -->
										</div>
									<?php } ?>
							</div><!-- carousel --> 
						</div>
					</div><!-- Column -->
					<div class="clearfix"></div>
					
								<div class="course-full-detail"> 
								<h4 style="padding:0 10px 10px;margin:0px!important;font-size:24px;">ABOUT COLLEGE</h4> 
								<div id="hide_fulldetails_<?php echo $SrNo;?>">
								<?php echo $row_college_details["CDetails_description"]; ?>
								
								<?php if($row_college_details["CDetails_tour_videos"]==''){echo " ";} else {?>
								<iframe width="854" height="480" src="https://www.youtube.com/embed/<?php echo $row_college_details["CDetails_tour_videos"];?>?ecver=1" frameborder="0"></iframe> 
								<?PHP } ?>
				
				</div> 
			</div><!-- row -->
							</div>
						</div><!-- Course Detail -->
					</div><!-- Column -->	
				</div><!-- Course Wrapper -->  	
			</div><!-- Column -->
		</div><!-- Row -->  
							</div>
							
			<div class="clearfix"></div>
<?php 
	//foreach($result_college_courses as $row_college_courses)
	//if($row_college_courses["count"] > 0)
	//{
?>	
		<section class="bg-lgrey typo-dark">
				<div class="container">  
					<div class="row">
						<center><h3 class="title">Top Courses</h3> </center>
						<div class="owl-carousel show-nav-hover dots-dark nav-square dots-square navigation-color" data-animatein="zoomIn" data-animateout="slideOutDown" data-items="1" data-margin="30" data-loop="true" data-merge="true" data-nav="true" data-dots="false" data-stagepadding="" data-mobile="1" data-tablet="2" data-desktopsmall="3"  data-desktop="4" data-autoplay="false" data-delay="3000" data-navigation="true"> 
								<!-- Blog Grid Wrapper -->
							<?php foreach($result_college_courses as $row_college_courses){
								if($row_college_courses["Course_logo"]=='') {$image="no-image.jpg";} else{ $image=$row_college_courses["Course_logo"]; } 
								$clge_course_url=str_replace(" ","-",$row_college_courses["Course_name"]); 
								$clge_course_url=preg_replace('/[^A-Za-z0-9\-]/','',$clge_course_url);
								$clge_course_url=strtolower($clge_course_url);
							?>
							<div class="blog-wrap"> 
								<div class="blog-img-wrap" style="border-bottom:0px!important; padding: 10px 20px; background:none!important">
									<img src="<?php echo FILE_PATH; ?>uploads/courses/thumbs/<?php echo $image; ?>" class="img-responsive" alt="<?php echo $row_college_courses["Course_name"]; ?>">
									
								</div> 
								<div class="blog-details" style="height:318px">
									<h5><a href="<?php echo base_url();?>course/<?php echo $row_college_courses["Clgecourse_id"];?>/<?php echo $clge_course_url;?>"><?php  echo $row_college_courses["Course_name"]; ?></a></h5>
									<table class="table table-bordered"> 
										<tbody>
											<tr style="font-size:12px;">
												<td><b>Course Status</b></td>
												<td><b>Total Fees (₹)</b></td>
												<td><b>Exam Required</b></td> 
											</tr> 
											<tr style="font-size:10px">
												<td>Deemed University</td>
												<td><?php echo $row_college_courses["Clgecourse_fee"];?></td>
												<td><?php  echo $row_college_courses["Clgecourse_req_exam"]; ?></td> 
											</tr>
										</tbody> 
									</table>  
									<a href="<?php echo base_url();?>course/<?php echo $row_college_courses["Clgecourse_id"];?>/<?php echo $clge_course_url;?>" class="btn">More Details</a> 
								</div><!-- Blog Detail Wrapper -->
							</div><!-- Blog Wrapper -->  
							<?php } ?> 
						</div>	
					</div><!-- Row -->
				</div><!-- Container -->
			</section><!-- Section -->
<?php
	//}
?>			
			<div class="clearfix"></div>
			<?php foreach($result_count_gallery_image as $row_count_gallery_image) if($row_count_gallery_image["count"] > 0){?>
			<section id="gallery" class="typo-dark bg-grey">
				<div class="container">
				<div class="row">
				
					<div class="col-md-12 col-xs-12 col-sm-12"> 
						<div class="isotope-filters">
						<center><h3 class="title">College Gallery</h3> </center>
							<ul class="nav nav-pills">
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
					</div><!-- Column -->
				</div><!-- Row -->
			</section><!-- Section -->
			<?php }?>
	</div>
	</div>
</div><!-- Page Main --> 
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
					<h5 class="sub-title"><?php echo $row_individual_college_courses["Course_name"];?> - <?php echo $row_individual_college_courses["Course_type_name"];?></h5>
					<ol class="breadcrumb">
						<li><a href="<?php echo base_url();?>">Home</a></li>
						<li><a href="<?php echo base_url();?>college/<?php echo $row_individual_college_courses["Clge_id"]; ?>/<?php echo $clge_url; ?>"><?php echo $row_individual_college_courses["Clge_name"];?></a></li> 
					</ol><!-- Breadcrumb -->
				</div><!-- Page Header Wrapper -->
			</div><!-- Coloumn -->
		</div><!-- Row -->
	</div><!-- Container -->
</div><!-- Page Header -->
<div role="main" class="main">
	<div class="page-default">
		<!-- Container -->
		<div class="container">
			<div class="row">
				<!-- Sidebar -->
				<div class="col-md-3">
					<!-- aside -->
					<aside class="sidebar">
						<!-- Widget -->
						<div class="widget">
							
							<ul class="thumbnail-widget">
								<li style="text-align:center;width:100%;border-bottom:1px solid #ccc;">
									<p class="text-center" style="font-weight:400;color:#111;">Get contact details on email/SMS</p>
									<?php if($this->session->userdata("is_loged_in")){
										foreach($result_user_details as $row_user_details)?> 
										<a href="#collegeEnquiry" class="btn text-center"><i class="fa fa-envelope"></i> Get contact</a> 
										<div id="collegeEnquiry"> 
											<a href="#" class="cancel">&times;</a><br/><br/><center><span id="rsultMsg"></span></center><br/>
											<center><b>Enquiry To <?php echo $row_individual_college_courses["Clge_name"]; ?></b></center><br/>	
												<form name="Clge_enquiry" action="" onsubmit="return Clge_enquiryValidate();" method="post" >
												<input type="hidden" name="Clge_name" value="<?php echo ucwords($row_individual_college_courses["Clge_name"]); ?>"> 
												<input type="hidden" name="Cenq_clgeid" value="<?php echo ucwords($row_individual_college_courses["Clge_id"]); ?>"> 
												<input type="hidden" name="Cenq_fstname" value="<?php echo ucwords($row_user_details["User_fstname"]); ?>"> 
												<input type="hidden" name="Cenq_lstname" value="<?php echo ucwords($row_user_details["User_lstname"]); ?>"> 
												<input type="hidden" name="Cenq_email" value="<?php echo ucwords($row_user_details["User_email"]); ?>"> 
												<input type="hidden" name="Cenq_enquirytypeid" value="1">	
												<input type="hidden" name="Cenq_enquiry_statusid" value="1">	
											<center>
												<textarea rows="7" cols="40" name="CEcmntsced_usercomment" value="<?php echo $this->input->post("CEcmntsced_usercomment"); ?>" placeholder="Specify Enquiry Details"></textarea><br/>
												<b><span style="color:red" id="CEcmntsced_usercomment"></span></b><hr/>
												<input type="submit" class="btn"  value="Submit"> 
												<input type="reset" class="btn" value="Reset" style="background:lightgray">
											</center>
											</form>
										</div> 
										<div id="cover" > 
										</div>
									<?php } ?>
									<?php if(!$this->session->userdata("is_loged_in")){?>
										<a href="<?php echo base_url();?>course/<?php echo $row_individual_college_courses["Clgecourse_id"];?>/<?php echo $clge_course_url;?>#collegeEnquiry" class="btn text-center"><i class="fa fa-envelope"></i> Get contact</a> 
									<?php } ?>	
								</li> 
								<li></li> 
								<?php /*
								<li style="text-align:center;width:100%">
									<p class="text-center" style="font-weight:400;color:#111;">Take This Course</p>
									<a href="#" class="btn" style="color:#fff; margin: 5px auto 14px; width: 55%;">TAKE THIS COURSE</a>
								</li>*/?> 
							</ul><!-- Thumbnail Widget -->
						</div><!-- Widget -->	
						<?php /*<div class="widget">
							<h5 class="widget-title">Alumni</h5>
							<ul class="thumbnail-widget">
								<li>
									<div class="thumb-wrap">
										<img width="60" height="60" alt="Thumb" class="img-responsive" src="<?php echo base_url()?>assets/images/default/nashim.jpg">
									</div>
									<div class="thumb-content"><a href="#">Nashim Akhtar</a><span>Leadtrance Technology Founder</span></div>	
								</li>
								<li>
									<div class="thumb-wrap">
										<img width="60" height="60" alt="Thumb" class="img-responsive" src="<?php echo base_url()?>assets/images/default/amitjee.jpg">
									</div>
									<div class="thumb-content"><a href="#">Satyam Raj </a><span>Leadtrance Technology Developer</span></div>	
								</li>
								<li>
									<div class="thumb-wrap">
										<img width="60" height="60" alt="Thumb" class="img-responsive" src="<?php echo base_url()?>assets/images/default/manjar.jpg">
									</div>
									<div class="thumb-content"><a href="#">Manjar Hussain </a><span>Leadtrance Technology  Developer</span></div>	
								</li>
								<li>
									<div class="thumb-wrap">
										<img width="60" height="60" alt="Thumb" class="img-responsive" src="<?php echo base_url()?>assets/images/default/shakil.jpg">
									</div>
									<div class="thumb-content"><a href="#">Shakil J Akhtar</a><span>Leadtrance Technology  Android Developer</span></div>	
								</li>
								<li>
									<div class="thumb-wrap">
										<img width="60" height="60" alt="Thumb" class="img-responsive" src="<?php echo base_url()?>assets/images/default/nausad.jpg">
									</div>
									<div class="thumb-content"><a href="#">Nausad Alam</a><span>Leadtrance Technology  Web-Manager</span></div>	
								</li>
							</ul><!-- Thumbnail Widget -->
						</div><!-- Widget -->*/?>
									
					</aside><!-- aside -->	
				</div><!-- Column -->				
				<!-- Page Content -->
				<div class="col-md-9">
					<!-- Course Wrapper -->
					<div class="row course-single">
						<!-- Course Banner Image -->
						<div class="col-sm-12">
							<div class="owl-crousel" style="display:none;">
							<div class="owl-carousel dots-inline" 
data-animatein="" 
data-animateout="" 
data-items="1" data-margin="" 
data-loop="true" 
data-merge="true" 
data-nav="true" 
data-dots="true" 
data-stagepadding="" 
data-mobile="1" 
data-tablet="1" 
data-desktopsmall="1"  
data-desktop="1" 
data-autoplay="false" 
data-delay="3000" 
data-navigation="true"> 
<?php
$db3=$this->load->database("db3",true);
$db3=$db3->database;
$this->db->select("*");
$this->db->from("$db3.college_course_cover_photos");
$this->db->where("CCCphoto_collegecourseid",$this->input->get("mycourseid"));
$query_college_course_image=$this->db->get(); 
$result_college_course_image=$query_college_course_image->result_array();
?>
<?php 
foreach($result_college_course_image as $row_college_course_image)
{
if($row_college_course_image["CCCphoto_image"]=='') {$image="no-image.jpg";} else{ $image=$row_college_course_image["CCCphoto_image"]; } ?>
<div class="item"> 
<div class="news-wrap">
<a href="#"><img class="img-responsive" src="<?php echo FILE_PATH; ?>uploads/college-courses-gallery/thumbs/<?php echo $image; ?>" alt="<?php echo $row_college_course_image["CCCphoto_image"];?>" style="width:100%;"></a> 
<div class="news-content"> 
<h5><a href="news-single.html"></a></h5>
<span class="news-meta"></span>
</div><!-- News Content -->
</div><!-- News Wrapper -->
</div>
<?php } ?>
</div><!-- carousel --> 
							</div> 
						</div><!-- Column -->	
						
						<!-- Course Detail -->
						<div class="col-sm-12">
							<div class="course-detail">
								<!-- Course Content -->
								<div class="course-meta margin-top-30">
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
									<div class="rating"><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span></div><br/> <br/> 
									<h1><?php echo $row_individual_college_courses["Clge_name"]; ?></h1>  
									<h2><?php echo $row_individual_college_courses["Course_name"];?> - <?php echo $row_individual_college_courses["Course_type_name"];?></h2>
									<ul class="course-meta-icons">
										<li>
											<i class="fa fa-money"></i><span>Total Tution Fee</span>:- <b>Rs <?php if($row_individual_college_courses["Clgecourse_fee"]==""){echo 'NA';} else {echo $row_individual_college_courses["Clgecourse_fee"];}?></b>
										</li>
										<li>
											<i class="fa fa-users"></i><span>Total Seats</span> :- <b><?php if($row_individual_college_courses["Clgecourse_total_seats"]==0){ echo "NA";} else { echo $row_individual_college_courses["Clgecourse_total_seats"];}?></b>
										</li>
										<li>
											<i class="fa fa-comments"></i><span>Eligibility</span> :- <b><?php echo $row_individual_college_courses["Clgecourse_eligibility"];?></b>
										</li>
										<li>
											<i class="fa fa-graduation-cap"></i><span>Exam Required</span> :- <b><?php echo $row_individual_college_courses["Clgecourse_req_exam"];?></b>
										</li>
										<li>
											<i class="fa fa-clock-o"></i><span>Course Start Date</span> :- <b><?php if($row_individual_college_courses["Clgecourse_adm_opendate"]=='0000-00-00') { echo "NA"; } else { echo $row_individual_college_courses["Clgecourse_adm_opendate"]; }?></b>
										</li>
										<li>
											<i class="fa fa-clock-o"></i><span>Course Duration</span> :- <b><?php echo $row_individual_college_courses["Clgecourse_duration"];?></b>
										</li>
									</ul>
								</div>
							</div><!-- Course Detail -->
						</div><!-- Column -->	
					</div><!-- Course Wrapper -->
			
					<div class="row course-full-detail view_course_details" style="margin-top: 0;">
						<div class="col-md-12 col-xs-12 col-sm-12"> 
							<p style="font-weight:500">Description</p>
							<p><?php echo $row_individual_college_courses["Clgecourse_details"];?></p> 
							<?php /*<h4>Courses Syllabus</h4>
							<table class="table course-table">
								<thead>
									<tr>
										<th> Subject Title </th>
										<th> Credits </th>
										<th> Hours </th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td> 1.1 Introduction to Computer </td>
										<td> 3 </td>
										<td> 32:00 </td>
									</tr>
									<tr>
										<td> 1.2 Principal Of Management </td>
										<td> 3 </td>
										<td> 32:00 </td>
									</tr>
									<tr>
										<td> 1.3 Human Resource Management </td>
										<td> 3 </td>
										<td> 35:30 </td>
									</tr>
									<tr>
										<td> 1.4 Marketing Of Management </td>
										<td> 4 </td>
										<td> 33:00 </td>
									</tr>
								</tbody>
							</table> */?>
							<center><h3 class="title">More Colleges Releated To This Courses</h3> </center>
							
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
								data-desktopsmall="3"  
								data-desktop="3" 
								data-autoplay="false" 
								data-delay="3000" 
								data-navigation="true" style="height:240px;"> 
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
								<div class="item">
									<a href="<?php echo base_url();?>course/<?php echo $row_clgecourse["Clgecourse_id"];?>/<?php echo $clge_course_url;?>"><img class="img-responsive" src="<?php echo FILE_PATH;?>uploads/colleges/thumbs/<?php echo $image;?>" height="400" width="600" alt="<?php echo $image;?>">
									<center><b><?php echo $row_clgecourse["Clge_name"];?></b></center></a>
								</div> 
								<?php }?>
							</div><!-- carousel -->	
						</div><!-- Column -->
					</div><!-- row -->
				</div><!-- Column -->
			</div><!-- Row -->
		</div><!-- Container -->
	</div><!-- Page Default -->
</div><!-- Page Main -->
<?php	
}
?>	