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
					<h5 class="sub-title">PRIVACY POLICY AND STATEMENT</h5>
					<ol class="breadcrumb">
						<li><a href="<?php echo base_url();?>">Home</a></li>
						<li class="active">Privacy-policy</li>
					</ol><!-- Breadcrumb -->
				</div><!-- Page Header Wrapper -->
			</div><!-- Coloumn -->
		</div><!-- Row -->
	</div><!-- Container -->
</div><!-- Page Header --> 
<!-- Page Main -->
<div role="main" class="main"> 
	<div class="page-default">
		<!-- Container -->
		<div class="container">
			<div class="row">
				<!-- Page Content -->
				<div class="col-md-12">
					<ul class="row course-container course-list">
						<li class="col-sm-12">
							<div class="container">
								<div class="row">
									<div class="col-md-12">
										<div class="panel-group accordion" id="accordion" role="tablist" aria-multiselectable="true">
											<?php $SrNo=1; foreach($result_list_pti_poli as $row_list_pti_poli){  ; ?>
												<div class="panel panel-default">
													<div class="panel-heading" role="tab" id="headingTwo">
														<h4 class="panel-title">
															<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse1<?php echo $SrNo; ?>" aria-expanded="false" aria-controls="collapseTwo">
															<?php echo $SrNo.'.'.$row_list_pti_poli["privacy_points"] ;?>
															</a>
														</h4>
													</div>
													<div id="collapse1<?php echo $SrNo; $SrNo++;?>" class="panel-collapse collapse" role="tabpane1" aria-labelledby="headingOne">
														<div class="panel-body">
															<p><?php echo $row_list_pti_poli["privacy_details"];?></p>
														</div>
													</div>
												</div><?php }  ?>
										</div><!-- Tab -->
									</div><!-- Column -->
								</div><!-- Row -->
							</div><!-- Container -->
						</li>
						<!-- Pagination -->
					</ul><!-- Row -->
				</div><!-- Column -->
			</div><!-- Row -->		
		</div><!-- Container -->
	</div><!-- Page Default -->   