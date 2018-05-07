<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
				<center>
					<h1>Oops,</h1>
					<p>We could not find the page you were looking for. Meanwhile, you may</p>
					<a href="<?php echo base_url(); ?>" class="btn"><i class="fa fa-home"></i> Back to home</a><br/><br/><h5 style="color:#1E90FF"><b>OR</b> <h5 style="color:#1E90FF"><b>Search Your Query Here</b></h5></center>
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