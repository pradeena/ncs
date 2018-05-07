<?php
defined("BASEPATH") or exit("No Direct Script Allowed"); 
$action=isset($_REQUEST["action"])? $_REQUEST["action"]:"list_search_results";
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

<script type="text/javascript" src="<?php echo base_url();?>/assets/js/prettify.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/assets/js/jquery.slimscroll.js"></script>
<script type="text/javascript">
    $(function(){

      $('#testDiv').slimScroll({
          alwaysVisible: true,
          railVisible: true
      });
    });
</script>
<script type="text/javascript">
    $(function(){

      $('#testDiv1').slimScroll({
          alwaysVisible: true,
          railVisible: true
      });
    });
</script>
<script type="text/javascript">
    $(function(){

      $('#testDiv2').slimScroll({
          alwaysVisible: true,
          railVisible: true
      });
    });
</script>
<script type="text/javascript">

  //enable syntax highlighter
  prettyPrint();

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-3112455-22']);
  _gaq.push(['_setDomainName', 'none']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>

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

<div class="search1">
		<div class="search-container">
    <form action="">
      <input type="text" placeholder="Search.." name="search" id="next">
      <button type="submit"  class="btn1"><i class="fa fa-search"></i></button>
    </form>
  
	</div>
<div id="testDiv">
		<li><input type="radio">Cambridge University (27 )</li>
		<li><input type="radio">Central Board Of Secondary Education (3 )</li>
		<li><input type="radio">Council For Technical Education And Vocational Training (7 )</li>
		<li><input type="radio">Karnataka State Open University (1 )</li>
		<li><input type="radio">Kathmandu University (4 )</li>
		<li><input type="radio">Lincoln University College (1 )</li>
		<li><input type="radio">London Metropolitan University (1 )</li>
		<li><input type="radio">Lovely Professional University (1 )</li>
		<li><input type="radio">Mid-Western University (3 )</li>
		<li><input type="radio">National Examination Board (123 )</li>
		<li><input type="radio">Patan Academy Of Health Sciences (1 )</li>
		<li><input type="radio">Pokhara University (7 )</li>
		<li><input type="radio">Purbanchal University (10 )</li>
		<li><input type="radio">SIKKIM MANIPAL UNIVERSITY (4 )</li>
		<li><input type="radio">Tribhuvan University (66 )</li>
		<li><input type="radio">University Of Northampton (1 )</li>


</div>
  </div>





													<?php /*foreach($result_list_university as $row_list_university) { ?>  
													<form name="UnivFilter" method="post" action=""> 
													<li><input  onclick="return goto(this.value)" name="Univ_filter" type="radio" value="<?php echo base_url();?>index.php/search?qry=<?php echo $this->input->get("qry"); ?>&univid=<?php echo $row_list_university["Univ_id"]; ?>"  <?php if($this->input->get("univid")==$row_list_university["Univ_id"]){ echo "checked";}?>> <?php echo ucwords($row_list_university["Univ_name"]);?> (<?php echo $row_list_university["total_college"] ; ?> )</li> 
													<?php } */?>
													
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
													<div id="testDiv2">

		<li><input type="radio">33700 (1 )</li>
		<li><input type="radio"> Baglung (1 )</li>
		<li><input type="radio">Baitadi (1 )</li>
		<li><input type="radio">Bhairahawa (6 )</li>
		<li><input type="radio">Bhaktapur (8 )</li>
		<li><input type="radio">Bharatpur (3 )</li>
		<li><input type="radio">Biratnagar (5 )</li>
		<li><input type="radio">Birgunj (5 )</li>
		<li><input type="radio">Butwal (3 )</li>
		<li><input type="radio">Chapur (1 )</li>
		<li><input type="radio">Chitwan (4 )</li>
		<li><input type="radio">Dang (1 )</li>
		<li><input type="radio">Dang-Deukhuri (1 )</li>
		<li><input type="radio">Dekhuri (1 )</li>
		<li><input type="radio">Dhangadhi (1 )</li>
		<li><input type="radio">Dharahari (1 )</li>

		<li><input type="radio">Dharan (2 )</li>
		<li><input type="radio">Gaur (3 )</li>
		<li><input type="radio">Ghorahi (1 )</li>
		<li><input type="radio">Hetauda (2 )</li>
		<li><input type="radio">Ilam (1 )</li>
		<li><input type="radio">Jhapa (2 )</li>
		<li><input type="radio">Kailali (2 )</li>
		<li><input type="radio">Kanchanpur (1 )</li>
		<li><input type="radio">Kapilvastu (1 )</li>
		<li><input type="radio">Kathmandu (106 )</li>
		<li><input type="radio">Kavre (1 )</li>
		<li><input type="radio">Kavrepalanchok (1 )</li>
		<li><input type="radio">Kirtipur (2 )</li>
		<li><input type="radio">Lalitpur (10 )</li>
		<li><input type="radio">Lamjung (1 )</li>
		<li><input type="radio">Madhyapur Thimi (1 )</li>

		<li><input type="radio">Morang (2 )</li>
		<li><input type="radio">Nawalparasi (2 )</li>
		<li><input type="radio">Nepalgunj (2 )</li>
		<li><input type="radio">Palpa (1 )</li>
		<li><input type="radio">Patan (4 )</li>
		<li><input type="radio">Pokhara (16 )</li>
		<li><input type="radio">Rampur (1 )</li>
		<li><input type="radio">Rupandehi (2 )</li>
		<li><input type="radio">Sallaghari (1 )</li>
		<li><input type="radio">Sunsari (2 )</li>
		<li><input type="radio">Surkhet (10 )</li>
		<li><input type="radio">Tulsipur (1 )</li>

</div>


													<?php /*foreach($result_list_cities as $row_list_cities) { ?>   
													<li><input type="radio" onclick="return goto_city(this.value)" name="City_filter" value="<?php echo base_url();?>index.php/search?qry=<?php echo $this->input->get("qry"); ?>&cty=<?php echo $row_list_cities["Clge_city"]; ?>" <?php if($this->input->get("cty")==$row_list_cities["Clge_city"]){ echo "checked";}?>> <?php echo ucwords($row_list_cities["Clge_city"]);  ?> (<?php echo $row_list_cities["total_college"];?> )</li> 
													<?php }*/?> 
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

													<div id="testDiv1">
		<li><input type="radio">Agriculture (4 )</li>
		<li><input type="radio">Arts (1 )</li>
		<li><input type="radio">Commerce (2 )</li>
		<li><input type="radio">Computer And IT (1 )</li>
		<li><input type="radio">Computer Science (3 )</li>
		<li><input type="radio">Engineering (3 )</li>
		<li><input type="radio">Humanities & Social Sciences (1 )</li>
		<li><input type="radio">Management (1 )</li>
		<li><input type="radio">Medical & Allied Sciences (8 )</li>
		<li><input type="radio">Nursing (6 )</li>
		<li><input type="radio">Pharmacy (4 )</li>
		<li><input type="radio">Public Health (4 )</li>
		<li><input type="radio">Science (19 )</li>

</div>
													<?php /*foreach($result_list_category as $row_list_category) { ?>   
													<li><input type="radio" onclick="return goto_category(this.value)" name="Category_filter" value="<?php echo base_url();?>index.php/search?qry=<?php echo $row_list_category["Cfaculty_name"]; ?>" <?php if($this->input->get("cat")==$row_list_category["Cfaculty_name"]){ echo "checked";}?>> <?php echo ucwords($row_list_category["Cfaculty_name"]);  ?> (<?php echo $row_list_category["total_college"];?> )</li> 
													<?php }*/?> 
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
					<h5 class="sub-title"><?php //echo $row_college_details["Clge_name"]; ?></h5>
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
<div class="container">
<!-- Header -->
		<nav class="header one-page-header navbar navbar-default navbar-fixed-top courses-header one-page-nav-scrolling one-page-nav__fixed" data-role="navigation">
			<div class="container-fluid g-pr-40 g-pl-40">
				<div class="menu-container page-scroll">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-ex1-collapse g-pt-25 g-sm-pt-0">
					<div class="menu-container">
						<ul class="nav navbar-nav">
							<li class="page-scroll home nav__text">
								<a href="#body">Highlight</a>
							</li>
							<li class="page-scroll nav__text">
								<a href="#snapshot">Snapshot</a>
							</li>
							<li class="page-scroll nav__text">
								<a href="#about">About</a>
							</li>
							<li class="page-scroll nav__text">
								<a href="#courses">Courses</a>
							</li>
							<li class="page-scroll nav__text">
								<a href="#gallery">Gallery</a>
							</li>
						</ul>
					</div>
				</div>
				<!-- /.navbar-collapse -->
			</div>
			<!-- /.container -->
		</nav>
		<!-- End Header -->
<div role="main" class="main">  
	 <div class="page-default" style="background:#fff">   
	<div class="container">
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-59ac196ae086ffda"></script>
	<section class="promo-section" id="body">
		<div class="row"> 
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="collegeSearchGrid">
					<ul>
						<li class="imgSize"><img src="<?php echo FILE_PATH; ?>uploads/colleges/thumbs/<?php echo $image_logo; ?>" class="img-responsive" alt="<?php echo $row_college_details["Clge_name"]; ?>">
						</li>
						<li>
							<ul>
								<li>
									<h1>
										<label><?php echo $row_college_details["Clge_name"]; ?>
										<?php if($row_college_details["Clge_verified_id"]==1){ ?>
										<img src="<?php echo FILE_PATH; ?>uploads/colleges/thumbs/verified.png" style="height:30px; width:30px">
										<?php }?></label>
									</h1>
								</li>
								<li>
									<div class="rating"><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
									</div>
								</li>
								<li><?php echo $row_college_details["Clge_address1"] .' ,'.$row_college_details["Clge_city"].', '.$row_college_details["Cntry_name"]; ?></li>
								
								<li><span class="cat" style="margin:0;"><?php echo $row_college_details["Ctype_name"]; ?></span></li>
							</ul>
						</li>
						<li class="pull-right course-meta-icons">
							
							<?php if($row_college_details["CDetails_googleplus_link"]!=""){?>
							<span  style="color:blue" class="googleplus"><a title="googleplus" target="_blank" href="<?php echo $row_college_details["CDetails_googleplus_link"];?>"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a></span><?php }?>
							<?php if($row_college_details["CDetails_facebook_link"]!=""){?>
							<span style="color:blue" class="facebook"><a href="<?php echo $row_college_details["CDetails_facebook_link"];?>" target="_blank" title="Facebook"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></span><?php }?>
							<?php if($row_college_details["CDetails_twitter_link"]!=""){?>
							<span style="color:blue" class="twitter"><a href="<?php echo $row_college_details["CDetails_twitter_link"];?>" target="_blank" title="Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></span><?php }?>
							<?php if($row_college_details["CDetails_youtube_link"]!=""){?>
							<span style="color:red" class="youtube"><a style="color:red;" title="Youtube" target="_blank" href="<?php echo $row_college_details["CDetails_youtube_link"];?>"><i class="fa fa-youtube" style="color:red;" aria-hidden="true"></i></a></span><?php }?>
							
							<div class="clearfix"></div>
							<div style="margin-top:40px">
							<?php if($row_college_details["CDetails_ebrochure"]==''){echo " ";} else {?>
						<a href="<?php echo FILE_PATH;?>uploads/college-e-brochure/<?php echo $row_college_details["CDetails_ebrochure"]; ?>" class="btn btn-info" download>E-Brochure</a>
						<?php }?>
						<?php if(!$this->session->userdata("is_loged_in")){?>
							<a href="<?php echo base_url();?>login?redirect=college/<?php echo $row_college_details["Clge_id"]; ?>/<?php echo $clge_url; ?>#collegeEnquiry" class="btn btn-info" id="myBtn">Enquiry</a> 
						<?php } else { ?>
						<a href="<?php echo base_url();?>college/<?php echo $row_college_details["Clge_id"]; ?>/<?php echo $clge_url; ?>#collegeEnquiry" class="btn btn-info" id="myBtn">Enquiry</a>
						<meta http-equiv="X-UA-Compatible" content="IE=edge" />
						<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="widget" style=" background-color: #fff; border: 0px solid #ccc; margin-top:10px;">
						<?php if($this->session->userdata("is_loged_in")){ 
								foreach($result_user_details as $row_user_details)?>
							 
							<div id="collegeEnquiry"> 
								<a href="#" class="cancel">&times;</a><br/><br/>
								<center><span id="rsultMsg1"></span></center><br/>
								<center><b>Enquiry To <?php echo $row_college_details["Clge_name"]; ?></b></center><br/>	
								<form name="enquiry" action="" method="post" onsubmit="return Clge_rand_enquiryValidate();"  enctype="multipart/form-data"  >
									<input type="hidden" name="do_enquiry" value="true"> 
									<input type="hidden" name="Clge_name" value="<?php echo ucwords($row_college_details["Clge_name"]); ?>"> 
									<input type="hidden" name="Cenq_clgeid" value="<?php echo ucwords($row_college_details["Clge_id"]); ?>"> 
									<input type="hidden" name="Cenq_fstname" value="<?php echo ucwords($row_user_details["User_fstname"]); ?>"> 
									<input type="hidden" name="Cenq_lstname" value="<?php echo ucwords($row_user_details["User_lstname"]); ?>"> 
									<input type="hidden" name="Cenq_email" value="<?php echo ucwords($row_user_details["User_email"]); ?>"> 
									<input type="hidden" name="Cenq_contactno" value="<?php echo ucwords($row_user_details["User_mobileno"]); ?>"> 	
									<input type="hidden" name="Cenq_enquirytypeid" value="1">
									<input type="hidden" name="Cenq_enquiry_statusid" value="1">
									<div class="form-group">
										<select name="Cenq_clgecourseid" onchange="return duplicatecollegeCourseAjax(this.value)" class="form-control select1">
											<option value=""><b>Select Programs (Or Course)</b></option>
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
											$this->db->where("Clge_id",$row_college_details["Clge_id"]);
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
									<center>
										<textarea rows="10" cols="70" name="CEcmntsced_usercomment" value="<?php echo $this->input->post("CEcmntsced_usercomment"); ?>" placeholder="Specify Enquiry Details"></textarea><br/>
									</center>
										<b><span style="color:red" id="CEcmntsced_usercomment"></span></b><hr/>
									<center>
										<button type="submit"  name="enquiry" class="btn btn-primary">Submit</button>
										<button type="reset" class="btn btn-primary">Reset</button>
									</center>
								</form>
							</div> 
							<div id="cover" > 
							</div>
						<?php } ?>	
						<hr/>
					</div><!-- Widget --> 
				</div>
						
						<?php }?>
						</div>
						</li>
					</ul>
				</div> 
				<div class="clearfix"></div>
				<div class="col-sm-6 col-sm-6 col-xs-12"> 
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
												<a href="#"><img class="img-responsive" src="<?php echo FILE_PATH; ?>uploads/college-gallery/thumbs/<?php echo $image; ?>" alt="<?php echo $row_college_gallery["CPgallery_image"];?>" style="width:100%;height:370px;"></a>  
											</div><!-- News Wrapper -->
										</div>
									<?php } ?>
							</div><!-- carousel --> 
						</div>
					</div><!-- Column -->
					<div class="col-sm-6 col-sm-6 col-xs-12">
						<div class="course-full-detail" style="margin-top:10px;">
								<?php if($row_college_details["CDetails_tour_videos"]==''){echo " ";} else {?>
								<iframe width="100%" height="370px" src="https://www.youtube.com/embed/<?php echo $row_college_details["CDetails_tour_videos"];?>?ecver=1" frameborder="0"></iframe> 
								<?PHP } ?>
				
						</div> 
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-12" style="display:none;"> 
				<aside class="sidebar" style="background-color:#fff!important; border:1px solid #d1d1d1;">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="widget" style=" background-color: #fff; border: 0px solid #ccc;">
						
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
									<input type="hidden" name="Cenq_contactno" value="<?php echo ucwords($row_user_details["User_mobileno"]); ?>"> 
									<input type="hidden" name="Cenq_enquirytypeid" value="1">	
									<input type="hidden" name="Cenq_enquiry_statusid" value="1">	
									<center>
										<textarea rows="7" cols="40" name="CEcmntsced_usercomment" value="<?php echo $this->input->post("CEcmntsced_usercomment"); ?>" placeholder="Specify Enquiry Details"></textarea><br/>
										<b><span style="color:red" id="CEcmntsced_usercomment"></span></b><hr/>
										<button type="submit"  name="enquiry" class="btn btn-primary">Submit Enquiry</button> 
										<button type="reset" class="btn btn-white">Reset</button>
									</center>
								</form>
							</div> 
							<div id="cover" > 
							</div>
						<?php } ?>	
						<hr/>
					</div><!-- Widget --> 
				</div>
				
				<div class="clearfix"></div>
				</aside><!-- aside -->	
			</div><!-- Column --> 
		</section>
		  <section id="snapshot">
			<div class="col-md-12 col-sm-12 col-xs-12"> 
				<div class="row course-single collegeSearchGrid">   	
					
						<div class="course-detail "> 
							<div class="course-meta">
								<?php 
								$db3=$this->load->database("db3",true);
								$db3=$db3->database;
								$this->db->from("$db3.college_courses");
								$this->db->join("$db3.college_faculty","college_faculty.Cfaculty_id=college_courses.Clgecourse_facultyid");
								$this->db->where("Clgecourse_college_id",$row_college_details["Clge_id"]);
								$this->db->group_by("Cfaculty_name");
								$query_faculty=$this->db->get();
								$result_faculty=$query_faculty->result_array();
								foreach($result_faculty as $row_faculty) {
								?>
								<span class="cat"><?php echo $row_faculty["Cfaculty_name"]; ?></span>  
								<?php }?>
								
								<h4 class="title"><?php echo $row_college_details["Clge_name"]; ?> Snapshot 
 									 <?php /*<b style="margin-left: 25cm"><a title="Share This College on Facebook" 
   									 href="http://www.facebook.com/sharer.php?s=100
   									 &p[url]=<?php echo base_url();?>college/<?php echo $row_college_details["Clge_id"]; ?>/<?php echo $clge_url; ?>" 
  									  onclick="javascript:window.open(this.href,
   									'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
    									 <img width="50px" height="50px" src="<?php echo FILE_PATH; ?>uploads/colleges/thumbs/facebook.png" 
     									  alt="Facebook" />
									</a></b>*/ ?> </h4>
								<div style="border-bottom:1px solid #ccc;"></div>
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
								<section>
								</section>
								<section>
								</section>	
								<div class="clearfix"></div>
								
					<div class="clearfix"></div>
					
								<!-- row -->
							</div>
						</div><!-- Course Detail -->
					
				</div><!-- Course Wrapper -->  	
			</div>
		</section><!-- Column -->
		</div><!-- Row -->  
							</div> -->
							
			<div class="clearfix"></div>
<?php 
	//foreach($result_college_courses as $row_college_courses)
	//if($row_college_courses["count"] > 0)
	//{
?>	
		<section class="typo-dark" style="padding-top:0;padding-bottom:0;" id="about">
				<div class="container collegeSearchGrid" >  
					
					<h4 class="title">ABOUT COLLEGE</h4>
										<div class="course-full-detail"> 
											<div id="hide_fulldetails_<?php echo $SrNo;?>" style="text-align: justify; text-justify: inter-word;">
												<p><?php echo $row_college_details["CDetails_description"]; ?></p>
				
											</div> 
										</div>
					
				</div><!-- Container -->
		</section><!-- Section -->
			<section class="typo-dark" style="padding-top:0;padding-bottom:0;" id="courses">
				<div class="container collegeSearchGrid" >  
					
					<h4 class="title">COURSES</h4>
					<div style="border-bottom:1px solid #ccc;"></div>
						<div class="owl-carousel show-nav-hover dots-dark nav-square dots-square navigation-color" data-animatein="zoomIn" data-animateout="slideOutDown" data-items="1" data-margin="30" data-loop="true" data-merge="true" data-nav="true" data-dots="false" data-stagepadding="" data-mobile="1" data-tablet="2" data-desktopsmall="3"  data-desktop="4" data-autoplay="false" data-delay="3000" data-navigation="true"> 
								<!-- Blog Grid Wrapper -->
							<?php foreach($result_college_courses as $row_college_courses){
								if($row_college_courses["Course_logo"]=='') {$image="no-image.jpg";} else{ $image=$row_college_courses["Course_logo"]; } 
								$clge_course_url=str_replace(" ","-",$row_college_courses["Course_name"]); 
								$clge_course_url=preg_replace('/[^A-Za-z0-9\-]/','',$clge_course_url);
								$clge_course_url=strtolower($clge_course_url);
							?>
							<div class="blog-wrap" style="background:#F2F2F2;"> 
								<div class="blog-img-wrap" style="border:0px; padding: 5px 2px;">
									<img src="<?php echo FILE_PATH; ?>uploads/courses/thumbs/<?php echo $image; ?>" class="img-responsive" alt="<?php echo $row_college_courses["Course_name"]; ?>" style="width:100%;height:80px;">
									
								</div> 
								<div class="blog-details" style="background:#F2F2F2;">
									<h5><a href="<?php echo base_url();?>course/<?php echo $row_college_courses["Clgecourse_id"];?>/<?php echo $clge_course_url;?>"><?php  echo $row_college_courses["Course_name"]; ?></a></h5>
									<table class="table table-bordered"> 
										<tbody>
											<tr style="font-size:10px;">
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
											<tr style="font-size:12px">
												<td><?php echo $row_college_courses["Univ_name"];?></td>
												<td><?php echo $duration;?></td>
												<td><?php if($morning=="" AND  $day=="" AND $evening==""){ echo "N/A"; }else{ echo $morning.' / '.$day.' / '.$evening; } ?></td> 
											</tr>
										</tbody> 
									</table>  
									<a href="<?php echo base_url();?>course/<?php echo $row_college_courses["Clgecourse_id"];?>/<?php echo $clge_course_url;?>" class="btn btn-block">More Details</a> 
								</div><!-- Blog Detail Wrapper -->
							</div><!-- Blog Wrapper -->  
							<?php } ?> 
						</div>	
					
				</div><!-- Container -->
			</section><!-- Section -->
<?php
	//}
?>			
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
			
				<div class="clearfix"></div>
				<div class="col-sm-12 col-sm-12 col-xs-12"> 
				<?php if(!empty($row_college_details["CDetails_location_map"])){?>
				<iframe src="<?php echo $row_college_details["CDetails_location_map"];?>" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe> <?php } ?>
				</div>
			<?php }?>
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
	</div>
</div>
</div>
	</div>
</div>
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
					<h5 class="sub-title"><?php /* echo $row_individual_college_courses["Course_name"];?> - <?php echo $row_individual_college_courses["Course_type_name"]; */ ?></h5>
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
	<div class="page-default">
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-59ac196ae086ffda"></script>
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
										<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="widget" style=" background-color: #fff; border: 0px solid #ccc; margin-top:10px;">
						<?php if($this->session->userdata("is_loged_in")){ 
								foreach($result_user_details as $row_user_details)?>
							 
							<div id="collegeEnquiry"> 
								<a href="#" class="cancel">&times;</a><br/><br/>
								<center><span id="rsultMsg1"></span></center><br/>
								<center><b>Enquiry To <?php echo $row_individual_college_courses["Clge_name"]; ?></b></center><br/>	
								<form name="enquiry" action="" method="post" onsubmit="return Clge_rand_enquiryValidate();"  enctype="multipart/form-data"  >
									<input type="hidden" name="do_enquiry" value="true"> 
									<input type="hidden" name="Clge_name" value="<?php echo ucwords($row_individual_college_courses["Clge_name"]); ?>"> 
									<input type="hidden" name="Cenq_clgeid" value="<?php echo ucwords($row_individual_college_courses["Clge_id"]); ?>"> 
									<input type="hidden" name="Cenq_fstname" value="<?php echo ucwords($row_user_details["User_fstname"]); ?>"> 
									<input type="hidden" name="Cenq_lstname" value="<?php echo ucwords($row_user_details["User_lstname"]); ?>"> 
									<input type="hidden" name="Cenq_email" value="<?php echo ucwords($row_user_details["User_email"]); ?>"> 
									<input type="hidden" name="Cenq_contactno" value="<?php echo ucwords($row_user_details["User_mobileno"]); ?>"> 	
									<input type="hidden" name="Cenq_enquirytypeid" value="1">
									<input type="hidden" name="Cenq_enquiry_statusid" value="1">
									<div class="form-group">
										<select name="Cenq_clgecourseid" onchange="return duplicatecollegeCourseAjax(this.value)" class="form-control select1">
											<option value=""><b>Select Programs (Or Course)</b></option>
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
											$this->db->where("Clge_id",$row_individual_college_courses["Clge_id"]);
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
									<center>
										<textarea rows="10" cols="70" name="CEcmntsced_usercomment" value="<?php echo $this->input->post("CEcmntsced_usercomment"); ?>" placeholder="Specify Enquiry Details"></textarea><br/>
									</center>
										<b><span style="color:red" id="CEcmntsced_usercomment"></span></b><hr/>
									<center>
										<button type="submit"  name="enquiry" class="btn btn-primary">Submit</button>
										<button type="reset" class="btn btn-primary">Reset</button>
									</center>
								</form>
							</div> 
							<div id="cover" > 
							</div>
						<?php } ?>	
						<hr/>
					</div><!-- Widget --> 
				</div> 
										<div id="cover" > 
										</div>
									<?php } ?>
									<?php if(!$this->session->userdata("is_loged_in")){?>
										<a href="<?php echo base_url();?>course/<?php echo $row_individual_college_courses["Clgecourse_id"];?>/<?php echo $clge_course_url;?>#collegeEnquiry" class="btn text-center"><i class="fa fa-envelope"></i> Get contact</a> 
									<?php } ?>	
								</li> 
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
									<h2><?php echo $row_individual_college_courses["Clge_name"].'<b style="black"> '.$row_individual_college_courses["Course_short_name"].'</b> '."Snapshot"; ?></h2>  
									<h1><?php echo $row_individual_college_courses["Course_name"];?> - <?php echo $row_individual_college_courses["Course_type_name"];?></h1>
									<ul class="course-meta-icons">
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
						</div><!-- Column -->	
					</div><!-- Course Wrapper -->
			<hr/>
		<section class="typo-dark" style="padding-top:0;padding-bottom:0;">
				<div class="container collegeSearchGrid">  
					<ul class="course-meta-icons">
					<h2 class="title">Admission</h2>
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
					
				</div><br/>
				<div class="container collegeSearchGrid">  
					<ul class="course-meta-icons">
					<h2 class="title">Required Documents for Admission</h2>
						<li>
							<?php 
							if($row_individual_college_courses["Clgecourse_documents"]==""){$doc_req="Not Aplicable";}else{$doc_req=$row_individual_college_courses["Clgecourse_documents"];}
							echo $doc_req; ?> 
						</li>
					</ul>
					
				</div><br/>
				<div class="container collegeSearchGrid">  
					<ul class="course-meta-icons">
					<h2 class="title">Graduation Requirements</h2>
						<li>
							<?php 
							if($row_individual_college_courses["Clgecourse_ugpg_reqmts"]==""){$gradu_req="Not Aplicable";}else{$gradu_req=$row_individual_college_courses["Clgecourse_ugpg_reqmts"];}
							echo $gradu_req; ?> 
						</li>
					</ul>
					
				</div><!-- Container -->
		</section><!-- Section --> 
		<?php /*<section class="typo-dark" style="padding-top:0;padding-bottom:0;">
				<div class="container collegeSearchGrid">  
					
					<h4 class="title">ABOUT COURSE</h4>
										<div class="course-full-detail"> 
											<div id="hide_fulldetails" style="text-align: justify; text-justify: inter-word;">
												<p><?php echo $row_individual_college_courses["Clgecourse_details"]; ?></p>
				
											</div> 
										</div>
					
				</div><!-- Container -->
		</section><!-- Section --> */ ?>
					<div class="row course-full-detail view_course_details" style="margin-top: 0;">
						<div class="col-md-12 col-xs-12 col-sm-12"> 
							<?php //<p style="font-weight:500">Description</p> ?>
							<?php //echo $row_individual_college_courses["Clgecourse_details"];?>
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
      
    </div>
  </div>

  <script type="text/javascript">
$('[type="radio"]').click(function () {

            if ($(this).attr('checked')) {

                $(this).removeAttr('checked');
                $(this).prop('checked',false);

            } else {

                $(this).attr('checked', 'checked');

            }
        });
</script>