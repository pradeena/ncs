<?php 
?>

<script type="text/javascript">
	function sendNewUserEnquiry(){ 
		var Cenq_clgeid = <?= trim($clge_id); ?>;
		var Cenq_clgecourseid = <?= ($courseid) ? $courseid : '0'; ?>;
		var fstname = NewUserEnquiry.fstname.value;
		fstname = fstname.trim(); 
		var lstname = NewUserEnquiry.lstname.value;
		lstname = lstname.trim(); 
		var email = NewUserEnquiry.email.value;
		email = email.trim(); 
		var mobileno = NewUserEnquiry.mobileno.value;
		mobileno = mobileno.trim(); 
		var CEcmntsced_usercomment = NewUserEnquiry.CEcmntsced_usercomment.value;
		CEcmntsced_usercomment = CEcmntsced_usercomment.trim(); 
		if(fstname=="" || fstname==null)
		{
			document.getElementById("fstname").innerHTML="* This field is required";
			NewUserEnquiry.fstname.focus();
			return false;
		}
		if(fstname!="" || fstname!=null)
		{
			document.getElementById("fstname").innerHTML="";   		
		}
		if(lstname=="" || lstname==null)
		{
			document.getElementById("lstname").innerHTML="* This field is required";
			NewUserEnquiry.lstname.focus();
			return false;
		}
		if(lstname!="" || lstname!=null)
		{
			document.getElementById("lstname").innerHTML="";   		
		}
		if(email=="" || email==null)
		{
			document.getElementById("email").innerHTML="* This field is required";
			NewUserEnquiry.email.focus();
			return false;
		}
		if(email!="" || email!=null)
		{
			document.getElementById("email").innerHTML="";   		
		}
		if(mobileno=="" || mobileno==null)
		{
			document.getElementById("mobileno").innerHTML="* This field is required";
			NewUserEnquiry.mobileno.focus();
			return false;
		}
		if(mobileno!="" || mobileno!=null)
		{
			document.getElementById("mobileno").innerHTML="";   		
		}
		if(CEcmntsced_usercomment=="" || CEcmntsced_usercomment==null)
		{
			document.getElementById("CEcmntsced_usercomment").innerHTML="* This field is required";
			NewUserEnquiry.CEcmntsced_usercomment.focus();
			return false;
		}
		if(CEcmntsced_usercomment!="" || CEcmntsced_usercomment!=null)
		{
			document.getElementById("CEcmntsced_usercomment").innerHTML=""; 
			$("#loading_icon").show();
			$.post("<?= base_url(); ?>enquiry/createNewUserEnquiry", { fstname:fstname, lstname:lstname, email:email, mobileno:mobileno, Cenq_clgeid:Cenq_clgeid, Cenq_clgecourseid:Cenq_clgecourseid, CEcmntsced_usercomment:CEcmntsced_usercomment}, 
			function(data){
				$("#loading_icon").hide();
				$("#SuccessMsg").html(data); 
			});
			setTimeout(resetEnquiryForm, 3000);  	
			setTimeout(resetMessage, 7000); 	
		}
  		return false;
	}


	function sendEnquiry(){ 
		var Cenq_clgeid = <?= trim($clge_id); ?>;
		var Cenq_clgecourseid = <?= ($courseid) ? $courseid : '0'; ?>;
		var CEcmntsced_usercomment = Enquiry.CEcmntsced_usercomment.value;
		CEcmntsced_usercomment = CEcmntsced_usercomment.trim(); 
		if(CEcmntsced_usercomment=="" || CEcmntsced_usercomment==null)
		{
			document.getElementById("CEcmntsced_usercomment").innerHTML="* This field is required";
			Enquiry.CEcmntsced_usercomment.focus();
			return false;
		}
		if(CEcmntsced_usercomment!="" || CEcmntsced_usercomment!=null)
		{
			document.getElementById("CEcmntsced_usercomment").innerHTML=""; 
			$("#loading_icon").show();
			$.post("<?= base_url(); ?>enquiry/createEnquiry", { Cenq_clgeid:Cenq_clgeid, Cenq_clgecourseid:Cenq_clgecourseid, CEcmntsced_usercomment:CEcmntsced_usercomment}, 
			function(data){
				$("#loading_icon").hide();
				$("#SuccessMsg").html(data); 
			});
			setTimeout(resetEnquiryForm, 3000);  
			setTimeout(resetMessage, 5000);  		
		}
  		return false;
	}
	function resetEnquiryForm(){
    	$("form#myEnquiryForm")[0].reset();
	  	//$('#SuccessMsg').hide();  
	}
	function resetMessage(){  
	  	$('#SuccessMsg').hide();  
	}
</script>


	<?php if(!$this->session->userdata("is_loged_in")){?>
		<button type="button"  class="btn btn-promary" data-toggle="modal" data-target="#enquiryModel"><i class="fa fa-plus"></i> Enquiry</button>
		<div class="modal fade" id="enquiryModel" role="dialog">
		    <div class="modal-dialog"> 
			      <!-- Modal content-->
			      <div class="modal-content">
			        <div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          <h4 class="modal-title"><i class="fa fa-envelope-o"></i> Enquiry at <span style="color:green"><?= $clge_name; ?></span> </h4>  
						<center>	
							<span id="loading_icon" style="display:none;font-size:25px">
								<div class="overlay">
									<i style="color:#DC143C" class="fa fa-refresh fa-spin"></i><br/>
									Saving enquiry .......
								</div>
							</span>
							<b><span id="SuccessMsg"></span><b/> 
						</center>
			        </div>
			        <div class="modal-body">
			        	<b>NOTE : All field are required</b>
				          <form role="form" name="NewUserEnquiry" method="post" id="myEnquiryForm" onsubmit="return sendNewUserEnquiry();"> 
				          	<div class="form-group">
				                <label for="email">:</label>
				                <input type="text" class="form-control" placeholder="First name" name="fstname">
								<b><span style="color:red" id="fstname"></span></b>
			            	</div>
				          	<div class="form-group"> 
				                <input type="text" class="form-control" placeholder="Last name" name="lstname">
								<b><span style="color:red" id="lstname"></span></b>
			            	</div>
				          	<div class="form-group"> 
				                <input type="email" class="form-control" placeholder="Email name" name="email">
								<b><span style="color:red" id="email"></span></b>
			            	</div>
				          	<div class="form-group"> 
				                <input type="text" class="form-control" placeholder="Phone" name="mobileno">
								<b><span style="color:red" id="mobileno"></span></b>
			            	</div>
				            <div class="form-group"> 
				              <textarea name="CEcmntsced_usercomment" class="form-control" placeholder="Message" rows='6'></textarea>
								<b><span style="color:red" id="CEcmntsced_usercomment"></span></b>
				            </div> 
				            <button type="submit" class="btn btn-info"><span class='fa fa-envelope'></span> Send enquiry</button>
				            <button type="reset" class="btn btn-default"><span class='glyphicon glyphicon-remove'></span> Cancel</button>
				          </form>
			        </div>
			        <div class="modal-footer">
			          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        </div>
			      </div> 
		    </div>
  		</div> 
	<?php } else { ?>	
			<button type="button"  class="btn btn-promary" data-toggle="modal" data-target="#enquiryModel"><i class="fa fa-plus"></i> Enquiry</button>

			<div class="modal fade" id="enquiryModel" role="dialog">
			    <div class="modal-dialog"> 
				      <!-- Modal content-->
				      <div class="modal-content">
				        <div class="modal-header">
				          <button type="button" class="close" data-dismiss="modal">&times;</button>
				          <h4 class="modal-title"><i class="fa fa-envelope-o"></i> Enquiry at <span style="color:green"><?= $clge_name; ?></span></h4>  
							<center>	
								<span id="loading_icon" style="display:none;font-size:25px">
									<div class="overlay">
										<i style="color:#DC143C" class="fa fa-refresh fa-spin"></i><br/>
										Saving enquiry .......
									</div>
								</span>
								<b><span id="SuccessMsg"></span><b/> 
							</center>
				        </div>
				        <div class="modal-body">
					          <form role="form" name="Enquiry" id="myEnquiryForm" method="post"  onsubmit="return sendEnquiry();"> 
					            <div class="form-group">
					              <label for="email">Details:</label>
					              <textarea name="CEcmntsced_usercomment" class="form-control" rows='6'></textarea>
									<b><span style="color:red" id="CEcmntsced_usercomment"></span></b>
					            </div> 
					            <button type="submit" class="btn btn-info"><span class='fa fa-envelope'></span> Send enquiry</button>
					            <button type="reset" class="btn btn-default"><span class='glyphicon glyphicon-remove'></span> Cancel</button>
					          </form>
				        </div>
				        <div class="modal-footer">
				          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        </div>
				      </div> 
			    </div>
		  	</div> 
	<?php } ?>


    
