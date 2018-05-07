<script type="text/javascript">
	function changePassword()
	{  
		var old_password=myPassword.old_password.value;
		var Login_password=myPassword.Login_password.value;
		Login_password=Login_password.trim();
		var cpassword=myPassword.cpassword.value;
		cpassword=cpassword.trim();
		if(old_password=='' || old_password==null)
		{
			document.getElementById("old_password").innerHTML="* Required";
			myPassword.old_password.focus();
			return false;
		} 
		if(old_password!='' || old_password!=null)
		{
			document.getElementById("old_password").innerHTML="";
		} 
		if(Login_password=='' || Login_password==null)
		{
			document.getElementById("Login_password").innerHTML="* Required";
			myPassword.Login_password.focus();
			return false;
		}
		if(Login_password!='' || Login_password!=null)
		{
			document.getElementById("Login_password").innerHTML="";
		}
		if(cpassword=='' || cpassword==null)
		{
			document.getElementById("cpassword").innerHTML="* Required";
			myPassword.cpassword.focus();
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
		if(Login_password == cpassword)
		{
			document.getElementById("notmatch").innerHTML='';  
		}
		$("#loading_icon").show();
		var form = document.myPassword;

		var dataString = $(form).serialize();


		$.ajax({
		    type:'POST',
		    url:'<?= base_url(); ?>account/changePassword',
		    data: dataString,
		    success: function(data){
			 	$("#loading_icon").hide();
		        $('#SuccessMsg').html(data); 
		    }
		}); 
		return false;	
	} 

</script> 

<form name="myPassword" action="" enctype="multipart/form-data"  method="post" onsubmit="return changePassword()" role="form">  
		<div class="box-body"> 	 
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
			<button type="submit"  class="btn btn-white">Change Password</button>
			<button type="reset" class="btn btn-default">Reset</button> 
		</div>
</form>