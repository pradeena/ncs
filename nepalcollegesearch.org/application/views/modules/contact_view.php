<?php
/* add user contact message view page*/
defined ('BASEPATH') or exit('No Direct Script Allowed');
?>
<script src='https://www.google.com/recaptcha/api.js'></script> 
<style> .error{  color:red;  } </style>
<script>
function contact_validations()
{
	var contact_name=contact_Tonbs.contact_name.value;
	contact_name=contact_name.trim();
	var contact_email=contact_Tonbs.contact_email.value;
	contact_email=contact_email.trim();
	var contact_mobile=contact_Tonbs.contact_mobile.value;
	contact_mobile=contact_mobile.trim();
	var contact_message=contact_Tonbs.contact_message.value;
	contact_message=contact_message.trim();
	if(contact_name=="" || contact_name==null)
	{
		document.getElementById("contact_name").innerHTML="* Required";
		contact_Tonbs.contact_name.focus();
		return false;
	}
	if(contact_name!="" || contact_name!=null)
	{
		document.getElementById("contact_name").innerHTML="";
	}
	if(contact_email=="" || contact_email==null)
	{
		document.getElementById("contact_email").innerHTML="* Required";
		contact_Tonbs.contact_email.focus();
		return false;
	}
	if(contact_email!="" || contact_email!=null)
	{
		document.getElementById("contact_email").innerHTML="";
	}
	if(contact_mobile!='')
	{
		if(isNaN(contact_mobile))
		{
			document.getElementById("contact_mobile").innerHTML="* Only Number Allowed";
			contact_Tonbs.contact_mobile.focus();
			return false;
		}
		if(contact_mobile.length < 9)
		{
			document.getElementById("contact_mobile").innerHTML="* Contact Number Greater Than 8";
			contact_Tonbs.contact_mobile.focus();
			return false;
		}
		else
		{
			document.getElementById("contact_mobile").innerHTML="";
		}
	}
	if(contact_message=="" || contact_message==null)
	{
		document.getElementById("contact_message").innerHTML="* Required";
		contact_Tonbs.contact_message.focus();
		return false;
	}
	if(contact_message!="" || contact_message!=null)
	{
		document.getElementById("contact_message").innerHTML="";
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
					<h5 class="sub-title">Contact Us</h5>
					<ol class="breadcrumb">
						<li><a href="<?php echo base_url();?>">Home</a></li>
						<li class="active">Contact Us</li>
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
						<h4 class="title">Contact Nepal College Search (CampusKit) Team</h4>  
						<span style="color:#FF0000"><?php if(isset($msg)){echo $msg;}?></span>
						<div class="error"><strong><?=$this->session->flashdata('flashSuccess')?></strong></div> 
					<form name="contact_Tonbs" method="post" action="" onsubmit="return contact_validations()" >
					<input type="hidden" name="do_submit_contact" value="true">
						<!-- Field 1 -->
						<div class="input-text form-group">
							<input type="text" name="contact_name" value="<?php echo $this->input->post("contact_name");?>" class="input-name form-control" placeholder="Full Name *" />
							<b><span style="color:red" id="contact_name"></span></b>
						</div>
						<!-- Field 2 -->
						<div class="input-email form-group">
							<input type="email" name="contact_email" value="<?php echo $this->input->post("contact_email");?>" class="input-email form-control" placeholder="Email *"/>
							<b><span style="color:red" id="contact_email"></span></b>
						</div>
						<!-- Field 3 -->
						<div class="input-text form-group">
							<input type="text" name="contact_mobile" value="<?php echo $this->input->post("contact_mobile");?>" class="input-name form-control" placeholder="Mobile Number *" />
							<b><span style="color:red" id="contact_mobile"></span></b>
						</div>
						<!-- Field 4 -->
						<div class="textarea-message form-group">
							<textarea rows="10" style="margin: 10px -1px 0px 0px; height: 78px; width: 515px;" name="contact_message"  class="textarea-message form-control" value="<?php echo $this->input->post("contact_message");?>" placeholder="Your Message *"><?php echo $this->input->post("contact_message");?></textarea> 
							<b><span style="color:red" id="contact_message"></span></b>
						</div> 
						<div class="input-text form-group">
							<div class="g-recaptcha" data-sitekey="6LdMOhkUAAAAALKVnt-BI2u2pXdGa3nZooXaiCd2" data-callback="recaptchaCallback"></div>
							<span style="color:#F66565" id="texterr"></span>
						</div> 
						<!-- Button -->
						<button class="btn" type="submit" name="submit_contact">Send</button>
					</form>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="content-box bg-lgrey" style="min-height:360px"> 
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.714355222679!2d85.34312781454403!3d27.695222082796906!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19855aa4b11f%3A0x95e1345b7f5cacd4!2sCreative+Clicks+Nepal+Pvt+Ltd!5e0!3m2!1sen!2sin!4v1489835105457" width="500" height="475" frameborder="0" class="googleMap" style="border:0" allowfullscreen></iframe> 
					</div>
				</div>
			</div><!-- Row --> 
		</div><!-- Container -->
	</div><!-- Page Default -->
</div><!-- Page Main -->