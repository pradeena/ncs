<?php
defined("BASEPATH") or exit("No Direct Script Allowed")
?>
<style>
/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

/* The Close Button */
.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}
</style> 
<div role="main" class="main"> 
	<div class="rs-container light rev_slider_wrapper">
		<div id="revolutionSlider" class="slider rev_slider" data-plugin-revolution-slider data-plugin-options='{"delay": 9000, "gridwidth": 1170, "gridheight": 500}'>
			<ul>
				<li data-transition="fade" class="typo-dark heavy">
					<img src="<?php echo base_url();?>assets/images/banner/banner1.jpg"  
						alt="nepalcollegesearch banner1"
						data-bgposition="center center" 
						data-bgfit="cover" 
						data-bgrepeat="no-repeat" 
						class="rev-slidebg">  
				</li> 
				<li data-transition="fade" class="typo-dark heavy"> 
					<img src="<?php echo base_url();?>assets/images/banner/banner2.jpg"  
						alt="nepalcollegesearch banner2"
						data-bgposition="center center" 
						data-bgfit="cover" 
						data-bgrepeat="no-repeat" 
						class="rev-slidebg"> 
				</li> 
				<li data-transition="fade" class="typo-dark heavy"> 
					<img src="<?php echo base_url();?>assets/images/banner/banner3.jpg"  
						alt="nepalcollegesearch banner3"
						data-bgposition="center center" 
						data-bgfit="cover" 
						data-bgrepeat="no-repeat" 
						class="rev-slidebg"> 
				</li> 
			</ul>
		</div>
			
	</div><!-- Home Slider --> 
	<!-- Section -->
	<section class="pad-top-none typo-dark">
		<div class="container">
			<div class="slider-below-wrap">
				<div class="row">
					<div class="col-md-offset-1 col-md-10">
						<!-- Search -->
						<div class="search">
							<form id="searchForm" name="searchForm" class="white" action="<?php echo base_url();?>search" method="get" onsubmit="return search_validate();"> 
								<div class="input-group">
									<input type="text" onkeyup="return data_from_databaseAjax(this.value)" class="form-control search" name="qry" id="q" placeholder="Search Courses By College Name , City Name , Courses Name" value="<?php echo $this->input->post("qry"); ?>" required>
									<span class="input-group-btn">
										<button class="btn" type="submit" value=""><i class="fa fa-search"></i></button>
									</span>
								</div>
								<span id="search_keyword"></span>
							</form>
						</div><!-- Search -->
					</div><!-- Column -->
				</div><!-- Slider Below Wrapper -->	
			</div><!-- Row -->
		</div><!-- Container -->
	</section><!-- Section -->