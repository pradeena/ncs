<?php defined("BASEPATH") or exit ("NO Direct Script Allowed."); ?> 
<script> 
function forget_password_validate()
{
	var email=forgetForm.email.value; 
	if(email==null || email=="")
	{
		document.getElementById("email").innerHTML="*Required";
		forgetForm.email.focus();
		return false;
	}
	if(email!=null || email!="")
	{
		document.getElementById("email").innerHTML=""; 
	} 
}
</script> 
<div class="page-header internalPages">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<!-- Page Header Wrapper -->
				<div class="page-header-wrapper">  
					<h5 class="sub-title">Account Management Help</h5>
					<ol class="breadcrumb">
						<li><a href="<?php echo base_url();?>">Home</a></li>
						<li class="active">Reset</li>
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
						<h4 class="title">Please enter your email address. You will receive a link to create a new password via email.</h4>  
						<span style="color:#FF0000"><?php if(isset($msg)){echo $msg;}?></span> 
						<form name="forgetForm" action="" method="post" onsubmit="return forget_password_validate();">
							<input type="hidden" name="do_forget_password" value="true">
							<div class="row">
								<div class="form-group">
									<div class="col-md-12"> 
										<input type="email" class="form-control" placeholder="Enter Email Address" name="email" autofocus />
										<b><span style="color:red" id="email_or_mobileno"> </span></b>
										<span style="color:red" id="email"> </span>
									</div>
								</div>
							</div> <hr/>
							<div class="row">
								<div class="col-md-6">
									<span class="remember-box checkbox">
										<label for="rememberme">  
										</label>
									</span>
								</div>
								<div class="col-md-6">
									<input type="submit" name="forget_password" value="Continue"  class="btn pull-right" data-loading-text="Loading..."> 
								</div>
							</div>
						</form> 
					</div>
				</div> 
			</div><!-- Row -->
			
		</div><!-- Container -->
	</div><!-- Page Default -->
</div><!-- Page Main -->