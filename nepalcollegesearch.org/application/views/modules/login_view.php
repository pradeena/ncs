<?php
defined("BASEPATH") or exit("No Direct Script Allowed"); 
if(isset($_GET["redirect"])){$redirect=base_url().$_GET["redirect"];}else{$redirect=base_url()."dashboard";}  
?>	
<script>
function otp_form_ajax()
{
	var user_email_mob=OTPForm.user_email_mob.value;
	user_email_mob=user_email_mob.trim(); 
	if(user_email_mob==null || user_email_mob=="")
	{
		document.getElementById("user_email_mob").innerHTML="*Required";
		OTPForm.user_email_mob.focus();
		return false;
	}
	else
	{
		$.post("<?php echo base_url();?>login/open_otp_form_ajax",{user_email_mob:user_email_mob},function(data){
		  $("#show_otp_form").html(data);
		});
	}
	return false;	
}
function otp_login_validate()
{
	var redirect='<?php echo $redirect; ?>';
	var Login_username=OTPLogin.Login_username.value;
	var user_otp=OTPLogin.user_otp.value;
	user_otp=user_otp.trim();
	if(user_otp==null || user_otp=="")
	{
		document.getElementById("user_otp").innerHTML="*Required";
		OTPLogin.user_otp.focus();
		return false;
	}
	if(user_otp!=null || user_otp!="")
	{
		document.getElementById("user_otp").innerHTML=""; 
		$.post("<?php echo base_url();?>login/do_otp_logincheck_ajax",{user_otp:user_otp,Login_username:Login_username,redirect:redirect},function(data){
		  $("#otpLoginErrMsg").html(data);
		});
	}
	return false;
}
</script>
<script> 
function login_validate()
{
	var email_or_mobileno=loginForm.email_or_mobileno.value;
	email_or_mobileno=email_or_mobileno.trim();
	var password=loginForm.password.value;
	password=password.trim();
	if(email_or_mobileno==null || email_or_mobileno=="")
	{
		document.getElementById("email_or_mobileno").innerHTML="*Required";
		loginForm.email_or_mobileno.focus();
		return false;
	}
	if(email_or_mobileno!=null || email_or_mobileno!="")
	{
		document.getElementById("email_or_mobileno").innerHTML=""; 
	}
	if(password==null || password=="")
	{
		document.getElementById("password").innerHTML="*Required";
		loginForm.password.focus();
		return false;
	}
	if(password!=null || password!="")
	{
		document.getElementById("password").innerHTML=""; 
	}
} 
</script>
<div class="page-header internalPages">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<!-- Page Header Wrapper -->
				<div class="page-header-wrapper">  
					<h5 class="sub-title">Nepal College Search (CampusKit) - Member Login     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b style="color:red">For New Institution Registration -</b> <a href="http://www.campuskit.org/register-your-institution">Click Here</a> <b style="color:black">[ Register As a College ]</b></h5>
					<ol class="breadcrumb">
						<li><a href="<?php echo base_url();?>">Home</a></li>
						<li class="active">Login</li>
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
			<div class="row shop-forms">
				<div class="col-sm-6">
					<div class="content-box bg-lgrey" style="min-height:356px">
						<h4 class="title">Welcome to Nepal College Search (CampusKit) - Login to Continue</h4>  
						<span style="color:#FF0000"><?php if(isset($msg)){echo $msg;}?></span> 
						<form action="" method="post" onsubmit="return login_validate();" name="loginForm">
							<input type="hidden" name="do_login" value="true">
							<div class="row">
								<div class="form-group">
									<div class="col-md-12"> 
										<input type="text" placeholder="User Name Or Mobile Number" value="<?php echo $this->input->post("email_or_mobileno");?>" name="email_or_mobileno"  class="form-control" autofocus >
										<b><span style="color:red" id="email_or_mobileno"> </span></b>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<div class="col-md-12">
										<input type="password" class="form-control" placeholder="Password" name="password" class="form-control">
										<b><span style="color:red" id="password"> </span> </b>
									</div><a style="color:#2196f3" class="pull-right" href="<?php echo base_url();?>reset">(Forget Password?)</a>
								</div>
							</div><hr/>
							<div class="row">
								<div class="col-md-6">
									<span class="remember-box checkbox">
										<label for="rememberme">
											Don't have an account yet ? <a href="<?php echo base_url();?>register" style="color:#2196f3"><b>Create Account</b></a> 
										</label>
									</span>
								</div>
								<div class="col-md-6">
									<input type="submit" name="login" value="login"  class="btn pull-right" data-loading-text="Loading...">
										
								</div>
							</div>
						</form> 
					</div>
				</div>
				<div class="col-sm-6">
					<div class="content-box bg-lgrey" style="min-height:356px">
						<h4>Login With OTP</h4>
						<span id="otpLoginErrMsg"></span>
						<div id="show_otp_form">
						</div>
						<div id="EnterOtpForm">
						<form name="OTPForm"action="" id="" method="post" onsubmit="return otp_form_ajax();">
							<input type="hidden" name="do_otp_login" value="true">
							<input type="hidden" name="Login_username" value="'.$Login_username.'">
							<div class="row">
								<div class="form-group">
									<div class="col-md-12"> 
										<input type="text" class="form-control" placeholder="Enter Email Or Phone" value="<?php echo $this->input->post("user_email_mob");?>" name="user_email_mob" autofocus />
										<b><span style="color:red" id="user_email_mob"> </span></b>
									</div>
								</div>
							</div> <hr/>
							<div class="row">
								<div class="col-md-6">
									<span class="remember-box checkbox"> 
									</span>
								</div>
								<div class="col-md-6">
									<input type="submit" name="otp_login" value="Request OTP"  class="btn pull-right" data-loading-text="Loading..."> 	
								</div>
							</div>  
						</form>
						</div>
						<center><b>-OR-</b></center>
						<center><?php //if(!empty($authUrl)) { echo '<a href="'.$authUrl.'"><img height="40" width="200" src="img/flogin.png" alt=""/></a>';}?></center> 
						<center><?php if(!empty($authUrlGoogle)) { echo '<a href="'.$authUrlGoogle.'"><img height="40" width="200" src="img/google-login.png" alt=""/></a>';}?></center>
					</div>
				</div>
			</div><!-- Row -->
			
		</div><!-- Container -->
	</div><!-- Page Default -->
</div><!-- Page Main -->