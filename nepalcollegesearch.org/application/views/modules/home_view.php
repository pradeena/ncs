<?php
defined("BASEPATH") or exit("No Direct Script Allowed")
?> 
<script> 
function validateForum()
{ 
	var Fques_question=Forum.Fques_question.value;
	Fques_question=Fques_question.trim();
	if(Fques_question=="" || Fques_question==null)
	{
		document.getElementById("Fques_question").innerHTML="* Required";
		Forum.Fques_question.focus();
		return false;
	}
	if(Fques_question!="" || Fques_question!=null)
	{
		document.getElementById("Fques_question").innerHTML="";
		$.post("<?php echo base_url();?>All_ajax_CRUD/ask_questionAjaxHome",{Fques_question:Fques_question},function(data){  
			$("#QusMsg").html(data);
		});   
		setTimeout(resetForm, 1000);
		$('#QusMsg').delay(1000).fadeOut();
	} 
	//document.getElementById("myForm").reset(2000); 
}
function resetForm(){
    $("form#myForm")[0].reset(); // Use the form.reset function
}
</script>
	<!-- Section -->
	<div class="comment">
		<h1 style="text-transform:none">Helping Thousands of Students to find the best <br/>course and college of their need.</h1>
	</div>
	<div class="top">
	<section class="typo-dark bg-grey">
		<div class="container">  
			<div class="row">
				<center><h1>Featured Colleges In Nepal</h1> </center>
				<!-- Item Begins --> 
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
					<?php foreach($result_college as $row_college) { 
						if($row_college["Clge_logo"]=='') {$image="no-image.jpg";} else{ $image=$row_college["Clge_logo"]; }
						$clge_url=str_replace(" ","-",$row_college["Clge_name"]." ".$row_college["Clge_city"]);
						$clge_url=preg_replace('/[^A-Za-z0-9\-]/','',$clge_url);
						$clge_url=strtolower($clge_url);
					?>
					<div class="blog-wrap" style="min-height: 433px;">
						<!-- Blog Image Wrapper -->
						<div class="blog-img-wrap" style="border-bottom: 1px solid #ccc;margin-top: 0px;">
							<img src="<?php echo FILE_PATH; ?>uploads/colleges/thumbs/campuskit_138_68.jpg<?php //echo $image; ?>" class="img-responsive center-block" alt="<?php echo $row_college["Clge_name"]; ?>" style="width:138px;height:68px;"> 
							<!--<h6 class="post-type bg-yellow">&nbsp;<i class="fa fa-bank"></i>&nbsp;</h6>-->
						</div><!-- Blog Wraper -->
						<!-- Blog Detail Wrapper -->
						<div class="blog-details">
						<div style="min-height:69px">
							<h5><a href="<?php echo base_url();?>college/<?php echo $row_college["Clge_id"]; ?>/<?php echo $clge_url; ?>"><?php echo $row_college["Clge_name"]; ?></a> </h5> 
							<p style="margin-bottom: 0;text-align: center;"><?php echo $row_college["Clge_city"]; ?>,<?php echo $row_college["Cntry_name"]; ?></p>
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
								$this->db->where("Clgecourse_college_id",$row_college["Clge_id"]);
								$query_college_course=$this->db->get();
								$row_college_course=$query_college_course->row();
							?> 
								<li><i class="fa fa-book"></i></li>
								<li><?php echo $row_college_course->Course_name; ?> <?php if($row_college_course->total_course>0){?>+<?php echo $row_college_course->total_course-1; ?> Courses<?php } else {echo "NA";} ?></li> 
							</ul><!-- Blog Meta -->  
							<ul class="blog-meta facilityBlog">
								<?php 
									$db3=$this->load->database("db3",true);
									$db3=$db3->database;
									$this->db->select("Facility_id,Clgefacility_facilityid,Clgefacility_clgeid,Facility_name,Facility_icon");
									$this->db->from("$db3.college_facilities");
									$this->db->join("$db3.facilities","facilities.Facility_id=college_facilities.Clgefacility_facilityid");
									$this->db->where("Clgefacility_clgeid",$row_college["Clge_id"]);
									$query_facility=$this->db->get();
									$result_facility=$query_facility->result_array();
									foreach($result_facility as $row_facility) {
								?>
								<li title="<?php echo $row_facility["Facility_name"];?>"> <?php echo $row_facility["Facility_icon"];?></li>
								<?php }?>
							</ul>  
							<div class="text-center" style="margin-top:38px;">
							<a class="btn" href="<?php echo base_url();?>college/<?php echo $row_college["Clge_id"]; ?>/<?php echo $clge_url; ?>">View Details</a> 
							</div>
						</div><!-- Blog Detail Wrapper -->
					</div><!-- Blog Wrapper -->
					<?php }?>
				</div>  
			</div><!-- Row -->
		</div><!-- Container -->
	</section><!-- Section -->
</div>
	<!-- Section -->
	<div class="top-c">
	<section class="typo-dark">
		<div class="container">  
			<div class="row">
				<center><h2>Top Courses In Nepal</h2> </center>
				<!-- Item Begins -->
				<div class="owl-carousel show-nav-hover dots-dark nav-square dots-square navigation-color" data-animatein="zoomIn" data-animateout="slideOutDown" data-items="1" data-margin="30" data-loop="true" data-merge="true" data-nav="true" data-dots="false" data-stagepadding="" data-mobile="1" data-tablet="3" data-desktopsmall="3"  data-desktop="4" data-autoplay="false" data-delay="3000" data-navigation="true"> 
					<!-- Blog Grid Wrapper -->
					<?php foreach($result_courses as $row_courses) { 
						if($row_courses["Course_logo"]=='') {$image="no-image.jpg";} else{ $image=$row_courses["Course_logo"]; } 
					?>
					<div class="blog-wrap1">
					<div class="blog-wrap" style="background:#F6F6F6;">
						<!-- Blog Image Wrapper -->
						<div class="blog-img-wrap" style="border-bottom: 1px solid #ccc;margin-top: 0px;">
							<img src="<?php echo FILE_PATH; ?>uploads/courses/thumbs/campuskit_190_80.png<?php //echo $image; ?>" class="img-responsive center-block" alt="<?php echo $row_courses["Course_name"]; ?>" style="width:215px;height:80px;">
							
						</div><!-- Blog Wraper -->
						<!-- Blog Detail Wrapper -->
						<div class="blog-details" style="background:#F6F6F6">
							<div style="min-height:60px">
							<h5><a href="<?php base_url();?>index.php/search?qry=<?php echo $row_courses["Course_name"]; ?>"><b style="font-size:13px"><?php echo ucwords($row_courses["Course_name"]); ?></b></a></h5>  
							</div>
							<div class="clearfix"></div>
							<?php /*<div style="font-size:13px;padding-top:20px;" class="text-center">Fee Approx Rs.1-2 Lakh Total</div>*/?>
							<div class="clearfix"></div>
							<div class="text-center">
							<a href="<?php base_url();?>index.php/search?qry=<?php echo $row_courses["Course_name"]; ?>" style="padding-top:10px;">(<?php echo $row_courses["total_instituation"]; ?> Institutions)</a>
							</div>
							<div class="clearfix"></div>
							<div class="text-center" style="margin-top:20px;">
							<a class="btn" href="<?php base_url();?>index.php/search?qry=<?php echo $row_courses["Course_name"]; ?>">Learn More</a>
							</div>
						</div><!-- Blog Detail Wrapper -->
					</div>
				</div><!-- Blog Wrapper --> 
					<?php } ?>
				</div>	
			</div><!-- Row -->
		</div><!-- Container -->
	</section>
</div><!-- Section -->
<div class="explore">
	<section class="typo-dark" style="border-top:1px solid #CACACA;">
		<div class="container">  
			<div class="row">
				<center><h3 class="title width36">Explore Colleges and Courses</h3> </center>
				<p class="text-center" style="line-height:140%;margin-bottom:40px;">Campuskit helps you to
search the colleges and courses of your interest for your best Decisions.</p>
				<!-- Item Begins --> 
				<div class="col-sm-4">
					<!-- Blog Grid Wrapper -->
					<div class="blog-wrap" style="background:#EEEEEE;">  
						<!-- Blog Detail Wrapper -->
						<div class="blog-details" style="background:#EEEEEE;padding:0px;">
							<ul class="blog-meta ask-answer" style="background:#EEEEEE;padding:0px;">
							<center><b>Don’t Know-Ask (Know-Reply)</b></center>
							<p class="text-center">Ask to make best educational Decisions</p>
								<?php 
									$db2=$this->load->database("db2",true);
									$db2=$db2->database; 
									$this->db->select('COUNT(Fques_userid) as total_question');
									$this->db->from("$db2.forums_questions");
									$query_question=$this->db->get();
									$row_question=$query_question->row();
									?>
									<li><center><i class="fa fa-users"></i></center><br/><b><?php echo $row_question->total_question; ?></b><br/> Users Question</li>   
									<li><center><i class="fa fa-check"></i></center><br/><b>Reliable</b><br/> Answers</li>  
									
								<?php 
									$db2=$this->load->database("db2",true);
									$db2=$db2->database; 
									$this->db->select('COUNT(Fans_forumqusid) as total_answer');
									$this->db->from("$db2.forums_answers");
									$query_answer=$this->db->get();
									$row_answer=$query_answer->row();
									?>  
									<li><center><i class="fa fa-clock-o"></i></center><br/><b><?php echo $row_answer->total_answer; ?></b><br/> Users Answer</li>
								
								
							</ul><!-- Blog Meta --> 
							<div class="clearfix"></div>
							<?php if($this->session->userdata("is_loged_in")){?>
								<span id="QusMsg"></span> 
								<form method="post" name="Forum" action="" id="myForm">
									<div class="input-text form-group" style="margin-top:20px;">
										<textarea rows="3" cols="20" name="Fques_question"  class="input-name form-control" placeholder="Ask Your Question"></textarea>
										<b><span id="Fques_question" style="color:red"></span></b>
									</div>  
									<center> <button type="button" onclick="return validateForum();" class="btn">Ask Now</button></center>
								</form>	 
							<?php } else {?>
									<br/>
									<center> <a href="<?php echo base_url();?>login?redirect=ask-forums" class="btn"><i class="fa fa-lock"></i> Login To Ask Question</button></a></center>
							<?php } ?>
						</div><!-- Blog Detail Wrapper -->
					</div><!-- Blog Wrapper -->
				</div><!-- Column --> 
				<!-- Item Begins -->
				<div class="col-sm-4">
					<!-- Blog Grid Wrapper -->
					<div style="padding:10px;min-height:366px;"> 
						<!-- Blog Detail Wrapper -->
						<div class="career">
						<img src="./images/clear-doubt.jpg" class="img-responsive center-block">
						</div>
					</div><!-- Blog Wrapper -->
				</div><!-- Column -->
				<div class="col-sm-4">
					<!-- Blog Grid Wrapper -->
					<div class="blog-wrap" style="background:#EEEEEE;"> 
						<!-- Blog Detail Wrapper -->
						<div class="blog-details" style="background:#EEEEEE;padding:0px;">
							<center><b>Bachelors and Masters Courses </b></center>
							<center>
								<p>Choose your interest of study<br> Select the interested faculty </p>
								
							</center> 
							<center>
								<p><a class="btn" href="<?php base_url();?>index.php/search?qry=science" style="width:200px">Management</a></p> 
								<p><a class="btn" href="<?php base_url();?>index.php/search?qry=commerce" style="width:200px">Engineering</a></p> 
								<p><a class="btn" href="<?php base_url();?>index.php/search?qry=arts & humanities" style="width:200px">Information Tech</a></p> 
							</center>	
						</div><!-- Blog Detail Wrapper -->
					</div><!-- Blog Wrapper -->
				</div><!-- Column -->
			</div><!-- Row -->
		</div><!-- Container -->
	</section>
</div><!-- Section -->
	<div class="clearfix"></div>
	<section class="bg-lgrey typo-dark" style="padding-bottom:125px;">
		<div class="container">  
			<div class="row"> 
				<!-- Item Begins --> 
				<div class="col-cd-8 col-sm-8 col-xs-12">
					<ul class="blog-meta" style="border-right:1px solid #ccc; padding:0 30px;">
					<center><h3 class="title width36">FEATURED ARTICLES</h3> </center> 	 
					<center>
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
						data-navigation="true" style="height:200px;">
						<?php
						$db10=$this->load->database("db10",true);
						$db10=$db10->database;
						$this->db->select("news_category_id,featured_image,content_title,news_id");
						$this->db->where("news_category_id",4); 
						$this->db->order_by("posted_date","DESC");
						$this->db->limit(25);
						$sql=$this->db->get("$db10.news");
						$result=$sql->result_array();
						foreach($result as $row)
						{
							if($row["featured_image"]=='') {$image="no-image.jpg";} else{ $image=$row["featured_image"]; } 
								$url=str_replace(" ","-",$row["content_title"]);
								$url=preg_replace('/[^A-Za-z0-9\-]/', '', $url); 
								$url=strtolower($url); 
						?>
						
						<div class="item">
							<a href="<?php echo base_url();?>updates/<?php echo $row["news_id"];?>/<?php echo $url;?>" style="color:#111;"><img class="img-responsive" style="height:140px;" src="<?php echo FILE_PATH; ?>uploads/news-article-event/thumbs/campuskit_170_140.jpg<?php //echo $image; ?>" alt="<?php echo $row["content_title"];?>">
							<div class="article-content"><center><?php echo $row["content_title"];?></center></a></div>
						</div> 
					
						<?php } ?>	
					</div><!-- carousel -->		 
					</center>
					</ul>  
				</div> 	
				
				<div class="col-md-4 col-sm-4 col-xs-12 latestupdates">
					<!-- Blog Grid Wrapper -->
					
							<div class="update"><center><p><strong>LATEST UPDATES</strong></p></center></div>
							<ul>
							<?php
							$db10=$this->load->database("db10",true);
							$db10=$db10->database;
							$this->db->select("posted_date,content_title,news_id"); 
							$this->db->order_by("posted_date","DESC");
							$this->db->limit(4);
							$sql=$this->db->get("$db10.news");
							$result=$sql->result_array();
							foreach($result as $row)
							{
								$url=str_replace(" ","-",$row["content_title"]);
								$url=preg_replace('/[^A-Za-z0-9\-]/', '', $url); 
								$url=strtolower($url); 
							?>	
								<li>
									<a href="<?php echo base_url();?>updates/<?php echo $row["news_id"];?>/<?php echo $url;?>"><?php echo $row["content_title"];?></a>
								</li> 
							<?php } ?>	
							</ul>
							</center>  	
						
				</div><!-- Column -->
			</div><!-- Row -->
		</div><!-- Container -->
	</section><!-- Section -->
	<!-- Section -->
	<div class="clearfix"></div>
	<section class="typo-dark bg-grey" style="padding-bottom:55px;">
		<div class="container">
			<div class="row counter-sm"> 
				<center><h3 class="title">Realtime Stats</h3> </center>
				<div class="col-sm-6 col-md-3">
					<div class="count-block dark bg-dark">
						<?php 
							$db3=$this->load->database("db3",true);
							$db3=$db3->database; 
							$this->db->select('COUNT(Clge_id) as total_colleges');
							$this->db->from("$db3.college");
							$query_college=$this->db->get();
							$row_college=$query_college->row();
						?>
						<h5>Institutions</h5>
						<h3 data-count="<?php echo $row_college->total_colleges; ?>" class="count-number"><span class="counter"><?php echo $row_college->total_colleges; ?></span></h3>
						<i class="uni-home"></i>
					</div><!-- Counter Block -->
				</div><!-- Column -->
				<div class="col-sm-6 col-md-3">
					<!-- Count Block -->
					<div class="count-block dark bg-dark">
						<?php 
							$db1=$this->load->database("db1",true);
							$db1=$db1->database; 
							$this->db->select('COUNT(User_id) as total_students');
							$this->db->from("$db1.users");
							$query_students=$this->db->get();
							$row_students=$query_students->row();
						?>
						<h5>Users</h5>
						<h3 data-count="<?php echo $row_students->total_students; ?>" class="count-number"><span class="counter"><?php echo $row_students->total_students; ?></span></h3>
						<i class="uni-talk-man"></i>
					</div><!-- Counter Block -->
				</div><!-- Column -->
				<div class="col-sm-6 col-md-3">
					<!-- Count Block -->
					<div class="count-block dark bg-dark">
						<?php 
							$db4=$this->load->database("db4",true);
							$db4=$db4->database; 
							$this->db->select('COUNT(Course_id) as total_courses');
							$this->db->from("$db4.courses");
							$query_courses=$this->db->get();
							$row_courses=$query_courses->row();
						?>
						<h5>Courses</h5>
						<h3 data-count="<?php echo $row_courses->total_courses; ?>" class="count-number"><span class="counter"><?php echo $row_courses->total_courses; ?></span></h3>
						<i class="uni-pencil"></i>
					</div><!-- Counter Block -->
				</div><!-- Column -->
				<div class="col-sm-6 col-md-3">
					<!-- Count Block -->
					<div class="count-block dark bg-dark">
						<?php 
							$db4=$this->load->database("db4",true);
							$db4=$db4->database;  
							$this->db->select('COUNT(Univ_id) as total_univ'); 
							$this->db->from("$db4.university");
							$query_univ=$this->db->get();
							$row_univ=$query_univ->row();
						?>
						<h5>Universities</h5>
						<h3 data-count="<?php echo $row_univ->total_univ; ?>" class="count-number"><span class="counter"><?php echo $row_univ->total_univ; ?></span></h3>
						<i class="uni-home"></i>
					</div><!-- Counter Block -->
				</div><!-- Column -->
			</div><!-- Row -->
		</div><!-- Container -->
	</section><!-- Section --> 	 
</div><!-- Page Main --> 