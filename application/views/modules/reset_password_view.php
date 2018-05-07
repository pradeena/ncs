<?php defined("BASEPATH") or exit ("NO Direct Script Allowed."); ?>
<script> 
function reset_password_validate()
{
	var password=resetForm.password.value; 
	if(password==null || password=="")
	{
		document.getElementById("password").innerHTML="*Required";
		resetForm.password.focus();
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
					<h5 class="sub-title">Reset Password</h5>
					<ol class="breadcrumb">
						<li><a href="<?php echo base_url();?>">Home</a></li>
						<li class="active">Reset Password</li>
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
						<h4 class="title">Please enter new password.</h4>  
						<span style="color:#FF0000"><?php if(isset($msg)){echo $msg;}?></span> 
						<form  name="resetForm" action="" method="post" onsubmit="return reset_password_validate();"> 
							<input type="hidden" name="do_reset_password" value="true">
							<input type="hidden" name="forgetid" value="<?php if(isset($_GET["forgetid"])) echo $_GET["forgetid"];?>">
							<input type="hidden" name="forgetverify" value="<?php if(isset($_GET["forgetverify"])) echo $_GET["forgetverify"];?>">
							<div class="row">
								<div class="form-group">
									<div class="col-md-12"> 
										<input type="password" class="form-control" placeholder="Enter Password" name="password" autofocus />
										<span style="color:red" id="password"> </span>
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
									<input type="submit" name="reset_password" value="Reset Password"  class="btn pull-right" data-loading-text="Loading..."> 
								</div>
							</div>
						</form> 
					</div>
				</div> 
			</div><!-- Row -->
			
		</div><!-- Container -->
	</div><!-- Page Default -->
</div><!-- Page Main -->