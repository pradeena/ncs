<?php
/* list all frequently ask questions view */
defined ('BASEPATH') or exit('No Direct Script Allowed');
?>
<div class="page-header internalPages">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<!-- Page Header Wrapper -->
				<div class="page-header-wrapper">  
					<h5 class="sub-title">Latest Updates On NCSonline</h5>
					<ol class="breadcrumb">
						<li><a href="<?php echo base_url();?>">Home</a></li>
						<li class="active">Latest Updates</li>
					</ol><!-- Breadcrumb -->
				</div><!-- Page Header Wrapper -->
			</div><!-- Coloumn -->
		</div><!-- Row -->
	</div><!-- Container -->
</div><!-- Page Header --> 
<div role="main" class="main college-search-landing">

	<h1 class="top-heading top-heading-college-new"> SELECT A COLLEGE </h1>
	<div class="clearfix"></div>
	<div class="course-search">

                    <div stye="position:relative;z-index:9"> 
					<form id="searchForm" name="searchForm" class="white" action="<?php echo base_url();?>search" method="get" onsubmit="return search_validate();"> 
                    <input type="text" placeholder="Enter College or University Name..." name="qry" id="searchtext" style="border-radius:5px 0 0 5px;" autocomplete="off" class="ac_input" required> 
                    <button type="submit" id="search_button" class="search_btn"  style="border-radius:0 5px 5px 0;" onclick=" return searchByKeyword();">
                        <i class="fa fa-search" style="font-size: 30px; vertical-align: middle;"></i><span class="hidden-xs" style="font-size:20px;"> Search</span>
                    </button>
                    <div class="ac_results2" style="display: none; position: absolute;"></div></div>
					</form>
               
	</div>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div style="padding: 2px 4px;" class="col-xs-12">
					<?php
					foreach($result_list_faculties as $row_list_faculties)
					{
					?>
                        <div class="panel panel-default mg-0">
                            <div class="panel-body pd-8-15 course-head" style="cursor:pointer;">

                                <div class="media">
                                    <div class="media-left pd-0">
                                        <i class="fa fa-3x fa-cog"></i>
                                    </div>
                                    <div class="media-body pd-left10">
                                        <div class="media-body">
                                            <a class="color-7" href="#engineering_cat"  role="button">
                                                <h4>
                                                    <?php echo $row_list_faculties["Cfaculty_name"];?> <i class="pull-right fa fa-chevron-down" style="font-size:16px;"></i>
                                                </h4>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="engineering_cat" class="panel-footer panel-collapse collapse in">
                                <div class="row">
								<?php
								$db4=$this->load->database("db4",true);
								$db4=$db4->database;
								$db3=$this->load->database("db3",true);
								$db3=$db3->database;
								$this->db->select("Course_id,Course_name,Course_short_name");
								$this->db->from("$db3.college_courses");
								$this->db->join("$db4.university_courses","university_courses.Ucourse_id=college_courses.Clgecourse_univcourseid");
								$this->db->join("$db4.courses","courses.Course_id=university_courses.Ucourse_courseid");
								$this->db->group_by("Course_id"); 
								$this->db->order_by('Course_id', 'RANDOM');
								$this->db->limit(3);
								$qry_course=$this->db->get();
								$res_course=$qry_course->result_array();
								foreach($res_course as $row_course)
								{
									$course_url=str_replace(" ","-",$row_course["Course_name"]);
									$course_url=preg_replace('/[^A-Za-z0-9\-]/','',$course_url);
									$course_url=strtolower($course_url);
								?>
                                        <div class="col-md-4">
                                            <div class="panel panel-default pop_exam">
                                                <div class="panel-heading" style="padding: 5px;">
                                                    <a href="<?php echo base_url();?>popular-course/<?php echo $row_course["Course_id"]; ?>/<?php echo $course_url; ?>" style="color:#000;">
                                                        <div class="media">

                                                            <div style="margin: 3% 0px;" class="media-left pull-right">
                                                                <i class="fa fa-chevron-right"></i>
                                                            </div>
                                                            <div class="media-body">

                                                                <h5 class="media-heading bold mg-0"><?php echo $row_course["Course_short_name"];?>&nbsp;
                                                                    <?php /*<span class="badge" style="background: #grey;">3147</span>*/?>
                                                                </h5>
                                                                <span class="font12"><?php echo $row_course["Course_name"];?></span>

                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>

                                            </div>
                                        </div> 
								<?php } ?>		

                                                                    </div>
                            </div>
                        </div>
						<div class="clearfix"></div>
						<?php } ?>
                    </div>
				</div>
			</div>
		</div>
    <div class="clearfix"></div>
	
	<div id="Gallery" class="content hidden-xs" style="background-color:#FFFFFF; border-top: 1px solid #dfdfdf;">
            <div class="container">

				<div class="gallery-head">
                    <center><h3 style="padding-bottom:0;">POPULAR SEARCHES</h3></center>
                </div>
                <div class="gallery-top">


                  <div class="row">
                    <h5 class="text-center mg-btm-15"><strong>Searches</strong> <hr></h5> 
					<?php
					foreach($result_list_search_keywords as $row_list_search_keywords)
					{
					?>
                            <div class="col-md-3 col-sm-3 footer_heading">
                                <div class="footer_links2">
                                     <p><a target="_blank" href="<?php echo base_url();?>search?qry=<?php echo $row_list_search_keywords["Popular_search_name"];?>"><?php echo $row_list_search_keywords["Popular_search_name"];?></a>
                                    </p>
                                 </div>
                            </div> 
					<?php } ?>		
                                                    </div>
                    <div class="row">
						<h5 class="text-center mg-btm-15"><strong>Top Courses</strong> <hr></h5>
						<?php 
						foreach($result_list_popular_course as $row_list_popular_course)
						{
								$course_url=str_replace(" ","-",$row_list_popular_course["Course_name"]);
								$course_url=preg_replace('/[^A-Za-z0-9\-]/','',$course_url);
								$course_url=strtolower($course_url);
						?>
                            <div class="col-md-3 col-sm-3 footer_heading">
                                <div class="footer_links2">
                                     <p><a target="_blank" href="<?php echo base_url();?>popular-course/<?php echo $row_list_popular_course["Course_id"]; ?>/<?php echo $course_url; ?>"><?php echo $row_list_popular_course["Course_name"];?></a></p>
                                 </div>
                            </div> 
						<?php } ?>	
                    </div>
                                    <div class="clearfix"></div>
                 <div class="row">
                    <h5 class="text-center mg-btm-15"><strong>Entrance Exams </strong><hr></h5>
                                                    <div class="col-md-3 col-sm-3 footer_heading">
                                <div class="footer_links2">
                                     <p><a target="_blank" href="<?php echo base_url();?>">XAT EXAM</a>
                                    </p>
                                 </div>
                            </div>
                                                        <div class="col-md-3 col-sm-3 footer_heading">
                                <div class="footer_links2">
                                     <p><a target="_blank" href="<?php echo base_url();?>">CAT BOOKS</a>
                                    </p>
                                 </div>
                            </div>
                                                        <div class="col-md-3 col-sm-3 footer_heading">
                                <div class="footer_links2">
                                     <p><a target="_blank" href="<?php echo base_url();?>">MAT EXAM PATTERN</a>
                                    </p>
                                 </div>
                            </div>
                                                        <div class="col-md-3 col-sm-3 footer_heading">
                                <div class="footer_links2">
                                     <p><a target="_blank" href="<?php echo base_url();?>">SYLLABUS OF CAT</a>
                                    </p>
                                 </div>
                            </div>
                                                        <div class="col-md-3 col-sm-3 footer_heading">
                                <div class="footer_links2">
                                     <p><a target="_blank" href="<?php echo base_url();?>">AIMA MAT</a>
                                    </p>
                                 </div>
                            </div>
                                                        <div class="col-md-3 col-sm-3 footer_heading">
                                <div class="footer_links2">
                                     <p><a target="_blank" href="<?php echo base_url();?>">CAT EXAM ELIGIBILITY</a>
                                    </p>
                                 </div>
                            </div>
                                                        <div class="col-md-3 col-sm-3 footer_heading">
                                <div class="footer_links2">
                                     <p><a target="_blank" href="<?php echo base_url();?>">MAT EXAM DATE</a>
                                    </p>
                                 </div>
                            </div>
                                                        <div class="col-md-3 col-sm-3 footer_heading">
                                <div class="footer_links2">
                                     <p><a target="_blank" href="<?php echo base_url();?>">SNAP EXAM DATE</a>
                                    </p>
                                 </div>
                            </div>
                                                        <div class="col-md-3 col-sm-3 footer_heading">
                                <div class="footer_links2">
                                     <p><a target="_blank" href="<?php echo base_url();?>">CAT RESULT</a>
                                    </p>
                                 </div>
                            </div>
                                                        <div class="col-md-3 col-sm-3 footer_heading">
                                <div class="footer_links2">
                                     <p><a target="_blank" href="<?php echo base_url();?>">ATMA EXAM</a>
                                    </p>
                                 </div>
                            </div>
                                                        <div class="col-md-3 col-sm-3 footer_heading">
                                <div class="footer_links2">
                                     <p><a target="_blank" href="<?php echo base_url();?>">XAT ADMIT CARD</a>
                                    </p>
                                 </div>
                            </div>
                                                        <div class="col-md-3 col-sm-3 footer_heading">
                                <div class="footer_links2">
                                     <p><a target="_blank" href="<?php echo base_url();?>">IIFT RESULTS</a>
                                    </p>
                                 </div>
                            </div>
                                                        </div>
                                       <div class="row" style="padding-bottom: 10px;">
                    <h5 class="text-center mg-btm-15"><strong>Cutoff &amp; Placement</strong> <hr></h5>
    
                            <div class="col-md-6 col-sm-6">
                                <div class="footer_links2">
                                     <p><a target="_blank" href="<?php echo base_url();?>">Manipal University Placements</a>
                                    </p>
                                 </div>
                            </div>
                            
                            <div class="col-md-6 col-sm-6">
                                <div class="footer_links2">
                                     <p><a target="_blank" href="<?php echo base_url();?>">Manav Rachna International University (MRIU) Cutoff</a>
                                    </p>
                                 </div>
                            </div>
                            
                            <div class="col-md-6 col-sm-6">
                                <div class="footer_links2">
                                     <p><a target="_blank" href="<?php echo base_url();?>">Symbiosis Institute of International Business (SIIB) Placements</a>
                                    </p>
                                 </div>
                            </div>
                            
                            <div class="col-md-6 col-sm-6">
                                <div class="footer_links2">
                                     <p><a target="_blank" href="<?php echo base_url();?>">Sharda University (SU) Cutoff</a>
                                    </p>
                                 </div>
                            </div>
                            
                            <div class="col-md-6 col-sm-6">
                                <div class="footer_links2">
                                     <p><a target="_blank" href="<?php echo base_url();?>">Lovely Professional University (LPU) Cutoff</a>
                                    </p>
                                 </div>
                            </div>
                            
                            <div class="col-md-6 col-sm-6">
                                <div class="footer_links2">
                                     <p><a target="_blank" href="<?php echo base_url();?>">Chandigarh University (CU) Placements</a>
                                    </p>
                                 </div>
                            </div>
                            
                            <div class="col-md-6 col-sm-6">
                                <div class="footer_links2">
                                     <p><a target="_blank" href="<?php echo base_url();?>">Symbiosis Institute of Media &amp; Communication Placements</a>
                                    </p>
                                 </div>
                            </div>
                            
                            <div class="col-md-6 col-sm-6">
                                <div class="footer_links2">
                                     <p><a target="_blank" href="<?php echo base_url();?>">Alliance School of Business Cutoff</a>
                                    </p>
                                 </div>
                            </div>
                            
                            <div class="col-md-6 col-sm-6">
                                <div class="footer_links2">
                                     <p><a target="_blank" href="<?php echo base_url();?>">Alliance College of Engineering and Design Placements</a>
                                    </p>
                                 </div>
                            </div>
                            
                            <div class="col-md-6 col-sm-6">
                                <div class="footer_links2">
                                     <p><a target="_blank" href="<?php echo base_url();?>">Ajeenkya DY Patil University Placements</a>
                                    </p>
                                 </div>
                            </div>
                            
                            <div class="col-md-6 col-sm-6">
                                <div class="footer_links2">
                                     <p><a target="_blank" href="<?php echo base_url();?>">Hindustan University Placements</a>
                                    </p>
                                 </div>
                            </div>
                            
                            <div class="col-md-6 col-sm-6">
                                <div class="footer_links2">
                                     <p><a target="_blank" href="<?php echo base_url();?>">K L University (KLU) Placements</a>
                                    </p>
                                 </div>
                            </div>
                            
                            <div class="col-md-6 col-sm-6">
                                <div class="footer_links2">
                                     <p><a target="_blank" href="<?php echo base_url();?>">Chandigarh Group of Colleges - Jhanjeri (CGC Jhanjeri) Placements</a>
                                    </p>
                                 </div>
                            </div>
                            
                            <div class="col-md-6 col-sm-6">
                                <div class="footer_links2">
                                     <p><a target="_blank" href="<?php echo base_url();?>">Mangalmay Institute of Management &amp; Technology Placements</a>
                                    </p>
                                 </div>
                            </div>
                            
                            <div class="col-md-6 col-sm-6">
                                <div class="footer_links2">
                                     <p><a target="_blank" href="<?php echo base_url();?>">Chandigarh Group of Colleges - Landran (CGC Landran) Placements</a>
                                    </p>
                                 </div>
                            </div>
                            
                            <div class="col-md-6 col-sm-6">
                                <div class="footer_links2">
                                     <p><a target="_blank" href="<?php echo base_url();?>">Jagran Lakecity University Placements</a>
                                    </p>
                                 </div>
                            </div>
                            
                            <div class="col-md-6 col-sm-6">
                                <div class="footer_links2">
                                     <p><a target="_blank" href="<?php echo base_url();?>">IBS - Gurgaon Placements</a>
                                    </p>
                                 </div>
                            </div>
                            
                            <div class="col-md-6 col-sm-6">
                                <div class="footer_links2">
                                     <p><a target="_blank" href="<?php echo base_url();?>">Apeejay Stya University Placements</a>
                                    </p>
                                 </div>
                            </div>
                            
                            <div class="col-md-6 col-sm-6">
                                <div class="footer_links2">
                                     <p><a target="_blank" href="<?php echo base_url();?>">Jain University - School of Engineering &amp; Technology Cutoff</a>
                                    </p>
                                 </div>
                            </div>
                            
                            <div class="col-md-6 col-sm-6">
                                <div class="footer_links2">
                                     <p><a target="_blank" href="<?php echo base_url();?>">GNIOT Group of Institutions Placements</a>
                                    </p>
                                 </div>
                            </div>
                                                </div>
                   
</div></div></div>
	

    </div>