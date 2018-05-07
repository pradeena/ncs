<?php
/* list all frequently ask questions view */
defined ('BASEPATH') or exit('No Direct Script Allowed');
foreach ($getUserDetails as $key => $user)  
?>
<div class="page-header internalPages">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<!-- Page Header Wrapper -->
				<div class="page-header-wrapper">  
					<h5 class="sub-title">My account details</h5>
					<ol class="breadcrumb">
						<li><a href="<?php echo base_url();?>">Home</a></li>
						<li class="active">My account</li>
					</ol><!-- Breadcrumb -->
				</div><!-- Page Header Wrapper -->
			</div><!-- Coloumn -->
		</div><!-- Row -->
	</div><!-- Container -->
</div><!-- Page Header --> 
<!-- Page Main -->

			<center>	
				<span id="loading_icon" style="display:none;font-size:25px">
					<div class="overlay">
						<i style="color:#DC143C" class="fa fa-refresh fa-spin"></i><br/>
						Saving enquiry .......
					</div>
				</span>
				<b><span id="SuccessMsg"></span><b/> 
				<b><span><?= $msg; ?></span><b/> 
			</center>
<div role="main" class="main">
	<div class="page-default">
		<div class="container">
			<div class="row">
				<div class="col-md-4">  
					
					<div class="panel panel-default">
						<div class="panel-heading"> 
							<center>
								<img src="<?= FILE_PATH ?>uploads/users/thumbs/<?= ($user['User_profile_pic']) ? $user['User_fstname'] : 'no-image.jpg'; ?>" class="img-circle" width="100px"><hr/>
								<form method="post" action="" name="profilePic"  enctype="multipart/form-data">  
								        <!-- The file input field used as target for the file upload widget -->
								        <center>
								        	<input  style="width: 104%;" type="file" name="User_profile_pic" required>
								        </center><br/>	
								        <button type="submit" class="btn btn-info" name="uploadProfilePic"><i class="fa fa-upload"></i> Upload</button> 
								</form>  
							</center>
						</div>
						<div class="panel-body">
							<div class="content-box shadow bg-white"> 
								<table cellspacing="0" class="table">
									<tbody>
										<tr>
											<th> <i class="fa fa-edit"></i></th>
											<td> <strong><span class="amount"><?= ucfirst($user['User_fstname'].' '.$user['User_lstname']) ?></span></strong> </td>
										</tr> 
										<tr>
											<th> <i class="fa fa-envelope"></i></th>
											<td> <strong><span class="amount"><?= $user['User_email'] ?></span></strong> </td>
										</tr>
										<tr>
											<th> <i class="fa fa-mobile"></i> </th>
											<td> <strong><span class="amount"><?= (!empty($user['User_mobileno'])) ?  $user['User_mobileno'] : 'NA';?></span></strong> </td>
										</tr>
										<tr>
											<th> <i class="fa fa-user"></i> </th>
											<td> <strong><span class="amount"><?= (!empty($user['User_gender'])) ?  $user['User_gender'] : 'NA';?></span></strong> </td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div> 
				</div>
				<div class="col-md-8"> 
					<div class="tab" style="margin-top: 0px;"> 
						<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist" style="background: #2579b7;"> 
							<li role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>
							<li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
							<li role="presentation"><a href="#enquiry" aria-controls="enquiry" role="tab" data-toggle="tab">Enquiry</a></li>
							<li role="presentation"><a href="#preferences" aria-controls="preferences" role="tab" data-toggle="tab">Search preferences</a></li>
							<li role="presentation"><a href="#loginDetails" aria-controls="loginDetails" role="tab" data-toggle="tab">Login Details</a></li>
						</ul>
						<!-- Tab panes -->
						<div class="tab-content"> 
							<div role="tabpanel" class="tab-pane fade in active" id="profile">
								<?php $this->load->view('modules/_myProfile',['user' => $user]); ?>
							</div>
							<div role="tabpanel" class="tab-pane fade" id="settings">
								<?php $this->load->view('modules/_changePassword'); ?>
							</div>
							<div role="tabpanel" class="tab-pane fade" id="enquiry"> 
								<table class="table table-bordered">
									<thead>
										<tr> 
											<th>Date</th> 
											<th>College</th>  
											<th>Program(Or Course)</th>    
											<th>Status</th>    
											<th>Action</th>  
										</tr>
									</thead>
									<tbody>
									<?php foreach($getEnquiry as $getEnquiry):?>	
										<tr>  
											<td><?= $getEnquiry['Cenq_regdate'] ?></td> 
											<td><?= $getEnquiry['Clge_name'] ?></td>  
											<td><?= $getEnquiry['Course_name'] ?></td> 
											<td><?= $getEnquiry['CEstatus_name'] ?></td> 
											<td>
												<button type="button"  class="btn btn-promary" data-toggle="modal" data-target="#enquiryModel<?= $getEnquiry['Cenq_id']?>"><i class="fa fa-eye"></i> View Details</button>
												<div class="modal fade" id="enquiryModel<?= $getEnquiry['Cenq_id']?>" role="dialog">
												    <div class="modal-dialog"> 
													      <!-- Modal content-->
													      <div class="modal-content"> 
													        <div class="modal-header">
													          <button type="button" class="close" data-dismiss="modal">&times;</button>
													          <h4 class="modal-title"><i class="fa fa-envelope-o"></i> View enquiry details</h4>  
													        </div>
													        <div class="modal-body">  
																<table class="table table-bordered table-striped">
																	<thead> 
																		<tr>
																			<th style="background:lightgray">College </th>
																			<th>
																				<?php echo ucfirst($getEnquiry["Clge_name"])?>
																			</th> 
																		</tr> 
																		<tr>
																			<th style="background:lightgray">Course</th>
																			<th><?= ($getEnquiry["Cenq_clgecourseid"]) ? $getEnquiry["Course_name"] : 'NA'; ?> </th> 
																		</tr> 
																		<tr>
																			<th style="background:lightgray">Message </th>
																			<th>
																				<?php echo ucfirst($getEnquiry["CEcmntsced_usercomment"])?>
																			</th> 
																		</tr> 
																		<tr>
																			<th style="background:lightgray">Reply message</th>
																			<th><?= ($getEnquiry["CEcmntsced_admincomment"]) ? $getEnquiry["CEcmntsced_admincomment"] : 'NA'; ?> </th> 
																		</tr>  
																		<tr>
																			<th style="background:lightgray">Enquiry at</th>
																			<th>
																				<?php echo $getEnquiry["Cenq_regdate"]?>
																			</th> 
																		</tr>      
																	</thead>	
																</table>
													        </div>
													        <div class="modal-footer">
													          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													        </div>
													      </div> 
												    </div>
											  	</div> 
											</td> 
										</tr> 
									<?php endforeach; ?>	
									</tbody>
								</table> 
							</div>


							<div role="tabpanel" class="tab-pane fade" id="loginDetails"> 
								<table class="table table-bordered">
									<thead>
										<tr> 
											<th>Date</th> 
											<th>Login ip</th>    
										</tr>
									</thead>
									<tbody>
									<?php foreach($getUserLoginDetails as $UserLoginDetails):?>	
										<tr>  
											<td><?= $UserLoginDetails['Log_login_time'] ?></td> 
											<td><?= $UserLoginDetails['Log_login_ip'] ?></td>  
										</tr> 
									<?php endforeach; ?>	
									</tbody>
								</table> 
							</div>

							<div role="tabpanel" class="tab-pane fade" id="preferences"> 
								<?php $this->load->view('modules/_setPreference');?> 
							</div>
							
						</div><!-- Tab Content -->
					</div><!-- Tab -->

				</div><!-- Column -->
			</div><!-- Row -->
		</div><!-- Container -->  
	</div>
</div>						 