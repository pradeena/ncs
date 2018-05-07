<?php
defined("BASEPATH") or exit("No Direct Script Allowed")
?>   
	<div class="navbar-collapse nav-main-collapse collapse">
		<div class="container">
			<nav class="nav-main mega-menu">
				<ul class="nav nav-pills nav-main" id="mainMenu">
					<li class="mega-menu-item mega-menu-fullwidth mega-menu-halfwidth">
						<a class="toggle" href="<?php  echo base_url();?>">Home</a> 
					</li>
					<li class="mega-menu-item mega-menu-fullwidth mega-menu-halfwidth mega-sub-menu" style="position:relative">
						<a class="toggle" href="#">Courses</a> 
						<div class="courses_list_div arrow_box11" id="main_menu">
                                        <div class="row courses_list" id="bachelors" style="display: block;">
                                            <div class="course_sub_list">
										<?php 
											$db3=$this->load->database("db3",true);
											$db3=$db3->database;
											$this->db->select("Cfaculty_id,Cfaculty_name");
											$this->db->from("$db3.college_faculty");
											$this->db->order_by("Cfaculty_id","ASC");
											$this->db->limit(5);	 
											$query_faculty=$this->db->get();
											$result_faculty=$query_faculty->result_array();
											foreach($result_faculty as $row_faculty) {
										?>
                                                <p><a href="<?php base_url();?>search?qry=<?php echo $row_faculty["Cfaculty_name"]; ?>" class="padding_zero">&nbsp;<span><?php echo $row_faculty["Cfaculty_name"];?></span></a></p>
											<?php }?>
                                            </div>
                                            <div class="course_sub_list">
										<?php 
											$db3=$this->load->database("db3",true);
											$db3=$db3->database;
											$Cfaculty_id=5;
											$this->db->select("Cfaculty_id,Cfaculty_name");
											$this->db->from("$db3.college_faculty");
											$this->db->order_by("Cfaculty_id","ASC");
											$this->db->limit(6,10);
											$query_faculty=$this->db->get();
											$result_faculty=$query_faculty->result_array();
											foreach($result_faculty as $row_faculty) {
										?>
                                                <p><a href="<?php base_url();?>search?qry=<?php echo $row_faculty["Cfaculty_name"]; ?>" class="padding_zero">&nbsp;<span><?php echo $row_faculty["Cfaculty_name"];?></span></a></p>
											<?php }?>
                                            </div>
                                            <div class="course_sub_list">
										<?php 
											$db3=$this->load->database("db3",true);
											$db3=$db3->database;
											$this->db->select("Cfaculty_id,Cfaculty_name");
											$this->db->from("$db3.college_faculty");
											$this->db->order_by("Cfaculty_id","DESC");
											$this->db->limit(5,5);	 
											$query_faculty=$this->db->get();
											$result_faculty=$query_faculty->result_array();
											foreach($result_faculty as $row_faculty) {
										?>
                                                <p><a href="<?php base_url();?>search?qry=<?php echo $row_faculty["Cfaculty_name"]; ?>" class="padding_zero">&nbsp;<span><?php echo $row_faculty["Cfaculty_name"];?></span></a></p>
											<?php }?>
                                            </div>
                                        </div>
                                    </div>
					</li> 
					<li class="mega-menu-item mega-menu-fullwidth mega-menu-halfwidth">
						<a class="toggle" href="<?php  echo base_url();?>top-college">Featured  College</a> 
					</li>
					<li class="mega-menu-item mega-menu-fullwidth mega-menu-halfwidth">
						<a class="toggle" href="<?php  echo base_url();?>updates">News</a> 
					</li>
					<li class="mega-menu-item mega-menu-fullwidth mega-menu-halfwidth">
						<a class="toggle" href="<?php  echo base_url();?>forums">Forums</a> 
					</li> 
					<?php if(!$this->session->userdata("is_loged_in")){?>	 
					<li class="mega-menu-item mega-menu-fullwidth mega-menu-halfwidth">
						<a class="toggle" href="<?php  echo base_url();?>login">Register / Login</a> 
					</li> 
					<?php } else { ?>
					<?php /*<li class="mega-menu-item mega-menu-fullwidth mega-menu-halfwidth">
						<a class="toggle" href="<?php  echo base_url();?>dashboard">My Account</a> 
					</li> */ ?>
					<li class="mega-menu-item mega-menu-fullwidth mega-menu-halfwidth">
						<a class="toggle" href="<?php  echo base_url();?>account">My account</a> 
					</li> 
					<li class="mega-menu-item mega-menu-fullwidth mega-menu-halfwidth">
						<a class="toggle" href="<?php  echo base_url();?>logout">Log Out</a> 
					</li> 
					<?php } ?>
				</ul>
			</nav>
		</div>
	</div>
</header><!-- Header Ends -->