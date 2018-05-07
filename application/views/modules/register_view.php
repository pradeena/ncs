<?php
defined("BASEPATH") or exit("No Direct Script Allowed"); 	
?>
<script src='https://www.google.com/recaptcha/api.js'></script> 
<style> .error{  color:red;  } </style>
<script> 
function register_validate()
{  
	    var fstname=Regform.fstname.value;
		fstname=fstname.trim();
		var lstname=Regform.lstname.value;
		lstname=lstname.trim();
		var email=Regform.email.value;
		email=email.trim();
		var password=Regform.password.value;
		password=password.trim();
		var mobileno=Regform.mobileno.value;
		mobileno=mobileno.trim();
		var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	    if (fstname==null || fstname=="")
	    { 
          document.getElementById("fstname").innerHTML="* Required";
		  Regform.fstname.focus();
          return false; 
        } 
		if (fstname!=null || fstname!="")
	    { 
          document.getElementById("fstname").innerHTML=""; 
        }  	
	    if (lstname==null || lstname=="")
	    { 
          document.getElementById("lstname").innerHTML="* Required";
		  Regform.lstname.focus();
          return false; 
        } 
		if (lstname!=null || lstname!="")
	    { 
          document.getElementById("lstname").innerHTML=""; 
        }  
		if (email==null || email=="")
	    { 
          document.getElementById("email").innerHTML="* Required";
		  Regform.email.focus();
          return false; 
        } 
		if (email!=null || email!="")
	    { 
          document.getElementById("email").innerHTML=""; 
        } 	
		if(!filter.test(email))
		{
			document.getElementById("email").innerHTML="* Inalid Email";
			Regform.email.focus();
			return false; 
		}
		if (filter.test(email))
	    { 
          document.getElementById("email").innerHTML=""; 
        } 	
		if (password==null || password=="")
	    { 
          document.getElementById("password").innerHTML="* Required";
		  Regform.password.focus();
          return false; 
        } 
		if (password!=null || password!="")
	    { 
          document.getElementById("password").innerHTML=""; 
        }  
		if (mobileno==null || mobileno=="")
	    { 
          document.getElementById("mobileno").innerHTML="* Required";
		  Regform.mobileno.focus();
          return false; 
        } 
		if (mobileno!=null || mobileno!="")
	    { 
          document.getElementById("mobileno").innerHTML=""; 
        } 
		if (isNaN(mobileno))
	    { 
          document.getElementById("mobileno").innerHTML="* Mobileno contains illegal characters";
		  Regform.mobileno.focus();
          return false; 
        } 
		if(!isNaN(mobileno)) 
	    { 
          document.getElementById("mobileno").innerHTML=""; 
        } 	
		if (mobileno.length < 10 || mobileno.length > 15)
	    { 
          document.getElementById("mobileno").innerHTML="* Not a valid Mobile Number";
		  Regform.mobileno.focus();
          return false; 
        } 
		else 
	    { 
			document.getElementById("mobileno").innerHTML="";  
        } 	
		var googleResponse = $('#g-recaptcha-response').val();
		if(googleResponse=='')
		{   
			$("#texterr").html("<span>Please check reCaptcha to continue.</span>");
			return false;
		}
}
</script> 
<div class="page-header internalPages">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<!-- Page Header Wrapper -->
				<div class="page-header-wrapper">  
					<h5 class="sub-title">Create Account</h5>
					<ol class="breadcrumb">
						<li><a href="<?php echo base_url();?>">Home</a></li>
						<li class="active">Create Account</li>
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
				<div class="col-sm-12">
					<div class="content-box shadow bg-lgrey">
						<h4 class="title">Create Account For NBSonline</h4>
						<div class="error"><strong><?=$this->session->flashdata('flashSuccess')?></strong></div>						
						<strong><?php if(isset($msg)) echo $msg; ?></strong>	 				
						<form name="Regform" method="post" action="" enctype="multipart/form-data">
							<input type="hidden" name="do_create_account" value="true">
							<div class="row">
								<div class="form-group">
									<div class="col-md-6 col-sm-6 col-xs-12"> 
										<input type="text" name="fstname" class="form-control" value="<?php echo $this->input->post("fstname"); ?>" placeholder="Enter First Name *">
										<span style="color:#F66565" id="fstname"></span>
									</div>
									<div class="col-md-6 col-sm-6 col-xs-12"> 
										<input type="text" name="lstname" value="<?php echo $this->input->post("lstname"); ?>" class="form-control" placeholder="Enter Last Name *">
										<span style="color:#F66565" id="lstname"></span>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="form-group">
									<div class="col-md-6 col-sm-6 col-xs-12"> 
										<input type="email" name="email" class="form-control" value="<?php echo $this->input->post("email"); ?>" placeholder="Enter Email *">
										<b><span style="color:red" id="email"></span></b>
									</div>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input type="password" name="password" class="form-control" placeholder="Enter Password *">
										<span style="color:#F66565" id="password"></span> 
									</div>
								</div>
							</div>
								
							<div class="row">
								<div class="form-group">
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input type="text" name="mobileno" class="form-control" value="<?php echo $this->input->post("mobileno"); ?>" placeholder="Enter Moblile Number *">
										<span style="color:#F66565" id="mobileno"></span> 
									</div>
									<div class="col-md-6 col-sm-6 col-xs-12" style="margin-top:10px;">
										<div class="g-recaptcha" data-sitekey="6LdMOhkUAAAAALKVnt-BI2u2pXdGa3nZooXaiCd2" data-callback="recaptchaCallback"></div>
										<span style="color:#F66565" id="texterr"></span>
									</div>
								</div>	
							</div>	
							
							<div class="row">
								<div class="col-md-6 col-sm-6 col-xs-12">
									<span class="remember-box checkbox">
										<label for="rememberme">
											Alredy Have Account ? <a href="<?php echo base_url();?>login" style="color:#2196f3"><b>Login Here</b></a> 
										</label>
									</span>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="submit" name="create_account" onclick="return register_validate()" id="btnSubmit" value="Create Account" class="btn pull-right" data-loading-text="Loading..."> 
									<div id="disableBtn"> 
									</div>	
								</div>
							</div>
						</form>
					</div>
				</div> 
			</div><!-- Row --> 
		</div><!-- Container -->
	</div><!-- Page Default -->
</div><!-- Page Main --> 