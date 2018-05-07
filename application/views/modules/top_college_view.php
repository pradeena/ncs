<?php
defined("BASEPATH") or exit("No Direct Script Allowed"); 
?>
<div class="container">
			<div class="row">
					<h1 class="top-heading"> Top Institutions in Nepal </h1>
					<div class="clearfix"></div>
					
<div class="col-xs-12 snippet_side"><div class="listing_tags"><br/>
<div class="sort-filter">
    <div class="dropdown">
        <ul class="dropdown-menu" id="sort_list" aria-labelledby="dropdownMenu">
            <li id="rating" class=""><a href="javascript:void(0)">Highest Rating</a></li>
            <li id="fees_desc" class=""><a href="javascript:void(0)">Highest Fees</a></li>
            <li id="fees_asc" class=""><a href="javascript:void(0)">Lowest Fees</a></li>
        </ul>
    </div>
</div>
</div>
<div class="clearfix"></div>
	<ul class="row"> 
		<li class="col-xs-12 blog-list-wrap">
		<?php
			foreach($result_top_college as $row_top_college)
			{
				if($row_top_college["Clge_logo"]=='') {$college_logo="no-image.jpg";} else{ $college_logo=$row_top_college["Clge_logo"]; } 
				$clge_url=str_replace(" ","-",$row_top_college["Clge_name"]);
				$clge_url=preg_replace('/[^A-Za-z0-9\-]/','',$clge_url);
				$clge_url=strtolower($clge_url);
		?>									
			<div class="col-xs-12 nopadding  listing_snippet automate_ad_snippet">
				<div class="snippet-box">
					<div class="box-left">
						<img class="clgdn_lazyload" alt="<?php echo $row_top_college["Clge_name"]; ?>" data-src="<?php echo FILE_PATH; ?>uploads/colleges/thumbs/<?php echo $college_logo; ?>" src="<?php echo FILE_PATH; ?>uploads/colleges/thumbs/<?php echo $college_logo; ?>">
					</div>
					<div class="box-right">
						<div class="right-top">
							<div class="box-info">
								<div class="img-logo"><img height="60px" width="60px" class="clgdn_lazyload" alt="<?php echo $row_top_college["Clge_name"]; ?> data-src="<?php echo FILE_PATH; ?>uploads/colleges/thumbs/<?php echo $college_logo; ?>" src="<?php echo FILE_PATH; ?>uploads/colleges/thumbs/<?php echo $college_logo; ?>"></div>
								<div class="college_info">
									<a href="<?php echo base_url();?>college/<?php echo $row_top_college["Clge_id"]; ?>/<?php echo $clge_url; ?>"> <?php echo $row_top_college["Clge_name"]; ?> </a><span class="college_location"> <?php echo $row_top_college["Clge_city"];?>, Nepal   </span>
								</div>
							</div>
							<div class="download-broucher ">
							<?php if(!$this->session->userdata("is_loged_in")){?>
							<a rel="nofollow" class="apply-now-button" href="<?php echo base_url();?>login?redirect=college/<?php echo $row_top_college["Clge_id"]; ?>/<?php echo $clge_url; ?>#collegeEnquiry">Enquiry Now </a>
							<?php } ?>
							</div>
						</div>
						<div class="clearfix"></div>
							<ul class="right-middle new">
							<br/>
								<li class="lr"><a target="_blank" href="/university/26007-indian-institute-of-technology-iit-kharagpur/courses-fees"><span class="lr-key"><?php if($row_top_college["Univ_name"]==""){ echo "NA";}else{ echo $row_top_college["Univ_name"];}?> </span><span class="lr-value"> University</span></a></li>
								<li class="lr"><span class="lr-key"><span class="rank-span"><?php if($row_top_college["Clge_est_yr"]=="0000"){ echo "NA";}else{echo $row_top_college["Clge_est_yr"];}?> </span></span><span class="lr-value img-holder"> Estabilished </span></li>
							</ul>
							<div class="wrapper-nav">
								<div class="container-fluid pad-wrap">
									<div class="college_nav">
										<ul class="college_nav_ul">
										<?php 
											$db3=$this->load->database("db3",true);
											$db3=$db3->database;
											$this->db->select("Facility_id,Clgefacility_facilityid,Clgefacility_clgeid,Facility_name,Facility_icon");
											$this->db->from("$db3.college_facilities");
											$this->db->join("$db3.facilities","facilities.Facility_id=college_facilities.Clgefacility_facilityid",'left');
											$this->db->where("Clgefacility_clgeid",$row_top_college["Clge_id"]);
											$query_facility=$this->db->get();
											$result_facility=$query_facility->result_array();
											foreach($result_facility as $row_facility) {
									?>
											<li class="college_tab"><a href="/university/26007-indian-institute-of-technology-iit-kharagpur/courses-fees" class="college_nav_tab first_tab" title="Indian Institute of Technology - [IIT], Kharagpur - Course &amp; Fees Details "> <?php echo $row_facility["Facility_name"];?> </a> <?php echo $row_facility["Facility_icon"];?> 	</li>
											<?php }?>
											<a href="<?php echo base_url();?>college/<?php echo $row_top_college["Clge_id"]; ?>/<?php echo $clge_url; ?>"><span id="flag_two" class="head">DETAILS</span></a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
        
				</div>	
			</div>
	<?php  } ?>
	<hr class="md">
	</li><!-- Column -->  
	</ul>
</div>
			</div>
		</div><!-- Container -->