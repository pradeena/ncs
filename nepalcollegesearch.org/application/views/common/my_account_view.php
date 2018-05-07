<?php
defined("BASEPATH") or exit("No Direct Script Allowed"); 
foreach($result_user_details as $row_user_details)
if($row_user_details["User_profile_pic"]==''){$image="no-image.jpg";} else {$image=$row_user_details["User_profile_pic"];}
?> 
<script>
/*------------------------------------------------------------------------------
Validate Form While Updating users Profile
-------------------------------------------------------------------------------*/
function validate_updateadmin()
{ 
	var User_fstname=users.User_fstname.value;  
		User_fstname=User_fstname.trim();
	var User_lstname=users.User_lstname.value;
		User_lstname=User_lstname.trim(); 
	var User_mobileno=users.User_mobileno.value; 
		User_mobileno=User_mobileno.trim();
	if(User_fstname=="" || User_fstname==null)
	{
		document.getElementById("User_fstname").innerHTML="* Required";
		users.User_fstname.focus();
		return false;
	}
	if(User_fstname!="" || User_fstname!=null)
	{
		document.getElementById("User_fstname").innerHTML=""; 
	} 
	if(User_lstname=="" || User_lstname==null)
	{
		document.getElementById("User_lstname").innerHTML="* Required";
		users.User_lstname.focus();
		return false;
	}
	if(User_lstname!="" || User_lstname!=null)
	{
		document.getElementById("User_lstname").innerHTML=""; 
	}  
		var User_profile_pic=users.User_profile_pic.value; 
		var User_profile_pic_hidden=users.User_profile_pic_hidden.value; 
		var User_email=users.User_email.value; 
		$("#loading_update").show();
		$.post("<?php echo base_url(); ?>my_account/update_profile_ajax",{User_fstname:User_fstname,User_lstname:User_lstname,User_email:User_email,User_mobileno:User_mobileno,User_profile_pic:User_profile_pic,User_profile_pic_hidden:User_profile_pic_hidden},function(data){
			$("#loading_update").hide();
			$("#updateMsg").html(data);
		}); 
}
</script>
<script>
/*------------------------------------------------------------------------------
Validate Form While Updating Password
-------------------------------------------------------------------------------*/
function validate_changepassword()
{
	var old_password=password.old_password.value;
	old_password=old_password.trim(); 
	var Login_password=password.Login_password.value;
	Login_password=Login_password.trim();
	var cpassword=password.cpassword.value;
	cpassword=cpassword.trim();
	if(old_password=='' || old_password==null)
	{
		document.getElementById("old_password").innerHTML="* Required";
		password.old_password.focus();
		return false;
	} 
	if(old_password!='' || old_password!=null)
	{
		document.getElementById("old_password").innerHTML="";
	} 
	if(Login_password=='' || Login_password==null)
	{
		document.getElementById("Login_password").innerHTML="* Required";
		password.Login_password.focus();
		return false;
	}
	if(Login_password!='' || Login_password!=null)
	{
		document.getElementById("Login_password").innerHTML="";
	}
	if(cpassword=='' || cpassword==null)
	{
		document.getElementById("cpassword").innerHTML="* Required";
		password.cpassword.focus();
		return false;
	}
	if(cpassword!='' || cpassword!=null)
	{
		document.getElementById("cpassword").innerHTML="";
	}
	if(Login_password != cpassword)
	{
		document.getElementById("notmatch").innerHTML='<i class="icon fa fa-warning"></i> Password Not Match. Re-enter password'; 
		return false;
	}
	if(Login_password==cpassword) 
	{ 
		var User_email=password.User_email.value;
		var Login_username=password.Login_username.value;
		$("#loading").show();
		$.post("<?php echo base_url(); ?>my_account/change_password_ajax",{old_password:old_password,Login_password:Login_password,cpassword:cpassword,User_email:User_email,Login_username:Login_username},function(data){
			$("#loading").hide();
			$("#change_passwordMsg").html(data);
		}); 
	}
}
</script> 
	
	 <div class="content-wrapper">
		<section class="content-header"> 
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
				<li class="active">Profile</li>
			</ol>
        </section><br/>
        <div class="container"> 
          <!-- Content Header (Page header) --> 
          <!-- Main content -->
           <section class="content">   	   
			<div class="row"> 
				<div class="col-md-14"> 
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs pull-right">
							<li><a href="#login_logs" data-toggle="tab"><b>Login Logs</b></a></li>
							<li><a href="#change_password" data-toggle="tab"><b>Update Password</b></a></li> 
							<li><a href="#update_user_profile" data-toggle="tab"><b>Update profile</b></a></li> 
							<li class="active"><a href="#free_user_profile" data-toggle="tab"><b>My Profile </b></a></li> 
							<li class="pull-left header">
								<i class="fa fa fa-gear"></i> My Account
							</li>
						</ul> 
						<div class="tab-content">
							 
							<div class="tab-pane" id="login_logs">
								<div class="box">
									<div class="box-header"> 
									</div><!-- /.box-header -->
									<div class="box-body">
										<table id="example1" class="table table-bordered table-striped">
											<thead>
												<tr>
													<th>SrNo</th>
													<th>Login Ip</th> 
													<th>Login Date</th>  
													<th>Total Login Through Same Ip </th> 
												</tr>
											</thead>
											<tbody>
											<?php 
											/* show users login logs details */
											$SrNo=1; 
											foreach($result_user_login_logs as $row_user_login_logs)	
											{ 
											?>
												<tr>
													<td><?php echo $SrNo; $SrNo++; ?></td>  
													<td><?php echo $row_user_login_logs["Log_login_ip"];?></td> 
													<td><?php echo $row_user_login_logs["Log_login_time"];?></td> 
													<td>
														<?php echo $row_user_login_logs["count"]; ?> 
													</td>
												</tr> 
											<?php } ?>	
											</tbody> 
										</table>
									</div><!-- /.box-body -->
								</div><!-- /.box -->
							</div>   
							<div class="tab-pane" id="change_password">
							<div class="box">
								<div class="box-header">   
									<!-- Loading (remove the following to stop the loading)--> 
									<span id="change_passwordMsg">
									</span>  
									<span id="loading" style="display:none">
										<div class="overlay">
											<i style="color:#DC143C" class="fa fa-refresh fa-spin"></i>
										</div>
									</span>	
								</div><!-- /.box-header -->
								<div class="box-body">
									<div class="col-md-8"> 
									<div class="box box-primary"> 
										<form name="password" action="" enctype="multipart/form-data"  method="post" role="form">
											<input type="hidden" name="do_change_password" value="true"> 
												<div class="box-body"> 				
													<input type="hidden" name="Login_username" value="<?php echo $row_user_details["Login_username"];?>">
													<input type="hidden" name="Login_last_password" value="<?php echo $row_user_details["Login_password"]; ?>">
													<input type="hidden" name="User_email" value="<?php echo $row_user_details["User_email"];?>">
													<div class="form-group">
														<label>Old Password *</label>
														<input type="password" class="form-control"  name="old_password" placeholder="Enter Old Password">
														<b><span id="old_password" style="color:red"></span></b> 
													</div>
													<div class="form-group">
														<label>Password *</label>
														<input type="password" class="form-control"  name="Login_password" placeholder="Enter Password">
														<b><span id="Login_password" style="color:red"></span></b> 
													</div>
													<div class="form-group">
														<label>Conform Password *</label>
														<input type="password" class="form-control"  name="cpassword" placeholder="Enter Conform Password">
														<b><span id="cpassword" style="color:red"></span></b>
														<b align="center"><span style="color:red;" id="notmatch"></span></b>
													</div>  
												</div> 
												<div class="box-footer">
													<button type="button" onclick="return validate_changepassword()" class="btn btn-white">Change Password</button>
													<button type="reset" class="btn btn-default">Reset</button><br/><br/>
													<b><a href="#"> Forget Password?</b></a>
												</div>
										</form>
									</div> 
									</div>
								</div><!-- /.box-body -->
							</div><!-- /.box -->
						</div>
						<div class="tab-pane" id="update_user_profile">
							<div class="box">
								<div class="box-header"><!-- Loading (remove the following to stop the loading)--> 
									<span id="updateMsg">
									</span>  
									<span id="loading_update" style="display:none">
										<div class="overlay">
											<i style="color:#DC143C" class="fa fa-refresh fa-spin"></i>
										</div>
									</span>	
								</div><!-- /.box-header -->
								<div class="box-body">
									<div class="col-md-6"> 
										<div class="box box-primary"> 
											<form name="users" action="" enctype="multipart/form-data"  method="post" role="form">
												<input type="hidden" name="do_update_profile" value="true">
												<div class="box-body">
													<div class="form-group">
														<label>First Name *</label>
														<input type="text" class="form-control"  name="User_fstname" placeholder="Enter First Name" value="<?php echo $row_user_details["User_fstname"];?>">
														<b><span id="User_fstname" style="color:red"></span></b>
													</div>
													<div class="form-group">
														<label>Last Name *</label>
														<input type="text" class="form-control"  name="User_lstname" placeholder="Enter Last Name" value="<?php echo $row_user_details["User_lstname"];?>">
														<b><span id="User_lstname" style="color:red"></span></b>
													</div>  
													<div class="form-group">
														<label>Email</label>
														<input type="email" class="form-control"  name="User_email" placeholder="Enter Email" value="<?php echo $row_user_details["User_email"];?>" disabled>
														<input type="hidden" class="form-control"  name="User_email" placeholder="Enter Email" value="<?php echo $row_user_details["User_email"];?>">
														<b><span id="User_email" style="color:red"></span></b> 
													</div> 
													<div class="form-group">
														<label>Contact Number</label>
														<input type="text" class="form-control"  name="User_mobileno" placeholder="Enter Branch Contact Number" value="<?php echo $row_user_details["User_mobileno"];?>" disabled>
														<b><span id="User_mobileno" style="color:red"></span></b>
													</div>
													<input type="hidden" class="form-control"  name="User_mobileno" value="<?php echo $row_user_details["User_mobileno"];?>">
													<div class="form-group"> 
														<label>Existing Profile Image</label>
															<input type="hidden" class="form-control" name="User_profile_pic_hidden" 
																value="<?php  echo $row_user_details["User_profile_pic"]; ?>">
															<?php
															if($row_user_details["User_profile_pic"]=="") { $image='no-image.jpg'; } else { $image=$row_user_details["User_profile_pic"]; }
															?>
															<img src="<?php echo base_url(); ?>admin/uploads/users/thumbs/<?php echo $image; ?>" class="img-circle" width="50px" alt="<?php echo $row_user_details["User_fstname"]; ?>" /> 
													</div> 
													<div class="form-group">
														<label>User Profile Pic</label>
														<div class="box-body pad">
															<input type="file" class="form-control" name="User_profile_pic" value="<?php  echo $this->input->post("User_profile_pic"); ?>">
														</div> 
													</div>  		
												</div> 
												<div class="box-footer">
													<button type="button"  onclick="return validate_updateadmin()" class="btn btn-white">Update</button>
													<button type="reset" class="btn btn-default">Reset</button>
												</div>
											</form>
										</div> 
									</div>
								</div><!-- /.box-body -->
							</div><!-- /.box -->
						</div> 
						<div class="tab-pane active" id="free_user_profile">  
							<div class="box">
								<div class="box-header"> 
								</div><!-- /.box-header -->
								<div class="box-body">
									<table class="table table-bordered table-striped">
										<thead> 
											<tr>
												<th style="background:lightgray">Profile Picture</th>
												<th> 
													<?php if($row_user_details["User_profile_pic"]==""){ $image="no-image.jpg"; } else 
														{$image=$row_user_details["User_profile_pic"];} ?>
													<img src="<?php echo FILE_PATH; ?>uploads/users/thumbs/<?php echo $image; ?>" class="img-circle" width="50px" alt="<?php echo $row_user_details["User_fstname"]; ?>" /> 
												</th> 
											</tr>
											<tr>
												<th style="background:lightgray">Name</th>
												<th><?php echo strtoupper($row_user_details["User_fstname"]).' '.strtoupper($row_user_details["User_lstname"]); ?></th> 
											</tr>
											<tr>
												<th style="background:lightgray">Email</th>
												<th><?php echo $row_user_details["User_email"]; ?></th> 
											</tr>
											<tr>
												<th style="background:lightgray">Contact Number</th>
												<th><?php echo $row_user_details["User_mobileno"]; ?></th> 
											</tr>  
											<tr>
												<th style="background:lightgray">Access Type</th>
												<th>
													<?php echo $row_user_details["Access_group_name"]; ?>
													<?php if($row_user_details["Login_accesstype_id"]=="1"){?>
													<br/><br/><a href="#"><b>Upgrade Membership</b></a>
													<?php }?>
												</th> 
											</tr> 
											<tr>
												<th style="background:lightgray">Register Date</th>
												<th><?php echo $row_user_details["User_regdate"]; ?></th> 
											</tr> 
											<tr>
												<th style="background:lightgray">Last Login Ip</th>
												<th><?php echo $row_user_details["Login_last_login_ip"]; ?></th> 
											</tr> 
											<tr>
												<th style="background:lightgray">Last Login Date</th>
												<th><?php echo $row_user_details["Login_last_logindate"]; ?></th> 
											</tr> 
											<tr>
												<th style="background:lightgray">users Status</th>
												<th>
												<?php 
												if($row_user_details["User_status"]==1) 
												{
													echo "<b style='color:green'><i class='fa  fa-check-circle'></i> Active</b>";
												}
												else
												{
													echo "<b style='color:red'><i class='fa  fa-times-circle'></i> Not Active</b>";
												}
												?> 
												</th> 
											</tr>  
										</thead> 
									</table>
								</div>
							</div>	
						</div>
						</div> 
					</div> 
				</div> 
			</div>  
		</section> 
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->