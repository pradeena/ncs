<?php
/* list all frequently ask questions view */
defined ('BASEPATH') or exit('No Direct Script Allowed');
$action=isset($_REQUEST["action"]) ? $_REQUEST["action"]:"view_profile";
?>
<script>
function validate_user()
{
	var User_fstname=user.User_fstname.value; 
	User_fstname=User_fstname.trim();
	var User_lstname=user.User_lstname.value; 
	User_lstname=User_lstname.trim();
	var User_mobileno=user.User_mobileno.value; 
	User_mobileno=User_mobileno.trim();
	if(User_fstname=="" || User_fstname==null)
	{
		document.getElementById("User_fstname").innerHTML="* Required";
		user.User_fstname.focus();
		return false;
	}
	if(User_fstname!="" || User_fstname!=null)
	{
		document.getElementById("User_fstname").innerHTML=""; 
	} 
	if(User_lstname=="" || User_lstname==null)
	{
		document.getElementById("User_lstname").innerHTML="* Required";
		user.User_lstname.focus();
		return false;
	}
	if(User_lstname!="" || User_lstname!=null)
	{
		document.getElementById("User_lstname").innerHTML=""; 
	}      	
	if(User_mobileno!="")
	{
		if(isNaN(User_mobileno))
		{
			document.getElementById("User_mobileno").innerHTML="*Contact Number Dosen't Support Invalid Characters";
			user.User_mobileno.focus();
			return false;
		}
		if(User_mobileno.length < 9)
		{
			document.getElementById("User_mobileno").innerHTML="* Invalid Contact Number";
			user.User_mobileno.focus();
			return false;
		}
	}  
}
function validate_changepassword()
{
	var Login_password=usr.Login_password.value;
	Login_password=Login_password.trim();
	var cpassword=usr.cpassword.value;
	cpassword=cpassword.trim();
	if(Login_password=='' || Login_password==null)
	{
		document.getElementById("Login_password").innerHTML="* Required";
		usr.Login_password.focus();
		return false;
	}
	if(Login_password!='' || Login_password!=null)
	{
		document.getElementById("Login_password").innerHTML="";
	}
	if(cpassword=='' || cpassword==null)
	{
		document.getElementById("cpassword").innerHTML="* Required";
		usr.cpassword.focus();
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
		document.getElementById("notmatch").innerHTML='';
	}
}
</script>
<?php
if($action=="view_profile")
{
	foreach($result_individual_user as $row_individual_user)
?>
		<section class="content-header">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">View Users Details</li>
			</ol>
		</section>
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs pull-right">
							<li class="active"><a href="#user_details" data-toggle="tab"><b>User Details</b></a></li> 
							<li><a href="#edit_user" data-toggle="tab"><b>Edit Profile</b></a></li> 
							<li><a href="#edit_password" data-toggle="tab"><b>Edit Password</b></a></li>  
							<li><a href="#user_log" data-toggle="tab"><b>User Login Log</b></a></li> 
						</ul>
						<div class="tab-content">
							<div class="tab-pane" id="user_log">
								<div class="box">
									<div class="box-header">
										<h3 class="box-title">List User Login Details</h3> 
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
											$SrNo=1; 
											foreach($result_individual_user as $row_individual_user)	
											{ 
											?>
												<tr>
													<td><?php echo $SrNo; $SrNo++; ?></td>  
													<td><?php echo $row_individual_user["Login_last_login_ip"];?></td> 
													<td><?php echo $row_individual_user["Login_last_logindate"];?></td> 
													<td>
														<?php echo $row_individual_user["count"]; ?> 
													</td>
												</tr> 
											<?php } ?>	
											</tbody> 
										</table>
									</div><!-- /.box-body -->
								</div><!-- /.box -->
							</div> 
							<div class="tab-pane" id="edit_password">
								<div class="box">
									<div class="box-header">
										<h3 class="box-title">Edit <?php echo "Password"; ?></h3> 
									</div><!-- /.box-header -->
							<div class="col-md-6"> 
								<div class="box box-primary">
									<div class="box-body">
									<p><?php if(isset($msg))echo $msg; ?></p>
								<form name="usr" action="" enctype="multipart/form-data"  method="post" role="form" onsubmit="return validate_changepassword()">
									<input type="hidden" name="do_change_password" value="true"> 
									<div class="box-body">
										<input type="hidden" name="User_email" value="<?php echo $row_individual_user["User_email"]; ?>">
										<input type="hidden" name="Login_username" value="<?php echo $row_individual_user["Login_username"]; ?>">
										<input type="hidden" name="user_login_password" value="<?php echo $row_individual_user["Login_password"]; ?>">
										<input type="hidden" name="User_id" value="<?php echo $row_individual_user["User_id"]; ?>">
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
										<button type="submit" name="change_password" class="btn btn-primary">Change Password</button>
										<button type="reset" class="btn btn-default">Reset</button>
									</div>
								</form>
									</div><!-- /.box-body -->
								</div>
							</div>
								</div><!-- /.box -->
							</div>  
							<div class="tab-pane" id="edit_user">
								<div class="box">
									<div class="box-header">
										<h4 class="box-title">Edit <?php echo $row_individual_user["User_fstname"].' '.$row_individual_user["User_lstname"].' '."Profile"; ?></h4> 
									</div><!-- /.box-header -->
							<div class="col-md-6"> 
								<div class="box box-primary">
									<div class="box-body">
									<p><?php if(isset($msg))echo $msg; ?></p>
									<form name="user" action="" enctype="multipart/form-data"  method="post" role="form" onsubmit="return validate_user()">
										<input type="hidden" name="do_update_user" value="true"><br/>
										<div class="box-body">
											<div class="form-group">
												<label>First Name *</label>
												<input type="text" class="form-control"  name="User_fstname" placeholder="Enter First Name" value="<?php echo $row_individual_user["User_fstname"]; ?>">
												<b><span id="User_fstname" style="color:red"></span></b>
											</div>
											<div class="form-group">
												<label>Last Name *</label>
												<input type="text" class="form-control"  name="User_lstname" placeholder="Enter Last Name" value="<?php echo $row_individual_user["User_lstname"]; ?>">
												<b><span id="User_lstname" style="color:red"></span></b>
											</div>
											<div class="form-group">
												<label>Email </label>
												<input type="email" class="form-control"  name="User_email" placeholder="Enter Email" value="<?php echo $row_individual_user["User_email"]; ?>" disabled>
											</div>
											<div class="form-group">
												<label>Contact Number</label>
												<input type="text" class="form-control"  name="User_mobileno" placeholder="Contact Number" value="<?php echo $row_individual_user["User_mobileno"]; ?>">
												<b><span id="User_mobileno" style="color:red"></span></b>
											</div>
											<div class="form-group">
												<label>Gender</label>
												<input type="radio"  name="User_gender" value="male" <?php if($row_individual_user["User_gender"]=="male" or $row_individual_user["User_gender"]=="Male"){?> <?php echo "checked";}?>>Male
												<input type="radio"  name="User_gender" value="female" <?php if($row_individual_user["User_gender"]=="female" or $row_individual_user["User_gender"]=="Female"){?> <?php echo "checked";}?>>Female
												
											</div>
											<div class="form-group">
												<div class="box-body pad">
													<label>Existing User Profile Image</label>
													<input type="hidden" class="form-control" name="user_profilepic_hidden" 
													value="<?php  echo $row_individual_user["User_profile_pic"]; ?>">
													<?php
														if($row_individual_user["User_profile_pic"]=="") { $image='no-image.jpg'; } else { $image=$row_individual_user["User_profile_pic"]; }
													?>
													<img src="<?php echo  FILE_PATH; ?>uploads/users/thumbs/<?php echo $image; ?>" class="img-circle" width="50px" alt="<?php echo $row_individual_user["User_fstname"].' '.$row_individual_user["User_lstname"]; ?>" /> 
												</div> 
											</div> 	
											<div class="form-group">
												<label>User Profile Pic</label>
												<div class="box-body pad">
													<input type="file" class="form-control" name="User_profile_pic" value="<?php  echo $this->input->post("User_profile_pic"); ?>">
												</div> 
											</div> 		
										</div> 
										<div class="box-footer">
											<button type="submit" name="update_user" class="btn btn-primary">Update</button>
											<button type="reset" class="btn btn-default">Reset</button>
										</div>
									</form>
									</div><!-- /.box-body -->
								</div>
							</div>
								</div><!-- /.box -->
							</div> 
							<div class="tab-pane active" id="user_details">  
								<div class="box"> 
									<div class="box-body">
										<table class="table table-bordered table-striped">
											<thead> 
												<tr>
													<th style="background:lightgray">Profile Picture</th>
													<th> 
														<?php if($row_individual_user["User_profile_pic"]==""){ $image="no-image.jpg"; } else 
														{$image=$row_individual_user["User_profile_pic"];} ?>
														<img src="<?php echo FILE_PATH;?>uploads/users/thumbs/<?php echo $image;?>" class="img-circle" width="50px" alt="<?php echo $row_individual_user["User_fstname"].' '.$row_individual_user["User_lstname"]; ?>" /> 
													</th> 
												</tr>
												<tr>
													<th style="background:lightgray">Name</th>
													<th><?php  echo ucwords($row_individual_user["User_fstname"].' '.$row_individual_user["User_lstname"]); ?></th> 
												</tr>
												<tr>
													<th style="background:lightgray">Email / Username</th>
													<th><?php echo $row_individual_user["User_email"]; ?></th> 
												</tr> 
												<tr>
													<th style="background:lightgray">Change Password</th>
													<th>
														<a href="#edit_password" class="btn btn-primary" data-toggle="tab" title="Change Password">Change Password <i class="fa fa-key"></i></a>
													</th>	
												</tr>
												<tr>
													<th style="background:lightgray">Contact Number</th>
													<th><?php echo $row_individual_user["User_mobileno"]; ?></th> 
												</tr>  
												<tr>
													<th style="background:lightgray">Gender</th>
													<th><?php 
														if($row_individual_user["User_gender"]==""){$gender="Not Mentation";}else{$gender=$row_individual_user["User_gender"];}
													echo ucwords($gender); ?></th> 
												</tr> 
												<tr>
													<th style="background:lightgray">Access Type</th>
													<th><?php echo $row_individual_user["Atype_name"]; ?></th> 
												</tr> 
												<tr>
													<th style="background:lightgray">Register Date</th>
													<th><?php echo $row_individual_user["User_regdate"]; ?></th> 
												</tr> 
												<tr>
													<th style="background:lightgray">Last Login Ip</th>
													<th><?php echo $row_individual_user["Login_last_login_ip"]; ?></th> 
												</tr> 
												<tr>
													<th style="background:lightgray">Last Login Date</th>
													<th><?php echo $row_individual_user["Login_last_logindate"]; ?></th> 
												</tr> 
											</thead> 
										</table>
									</div><!-- /.box-body -->
								</div><!-- /.box -->
							</div> 
						</div> 
					</div> 
				</div><!-- /.col -->
			</div><!-- /.row -->
        </section><!-- /.content -->
<?php	
}
?>
	</div>
</div>	