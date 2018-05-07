
<script type="text/javascript">
	function updateProfile()
	{  
		var User_fstname=myProfile.User_fstname.value;  
		User_fstname=User_fstname.trim();
		var User_lstname=myProfile.User_lstname.value;
			User_lstname=User_lstname.trim(); 
		if(User_fstname=="" || User_fstname==null)
		{
			document.getElementById("User_fstname").innerHTML="* Required";
			myProfile.User_fstname.focus();
			return false;
		}
		if(User_fstname!="" || User_fstname!=null)
		{
			document.getElementById("User_fstname").innerHTML=""; 
		} 
		if(User_lstname=="" || User_lstname==null)
		{
			document.getElementById("User_lstname").innerHTML="* Required";
			myProfile.User_lstname.focus();
			return false;
		}
		if(User_lstname!="" || User_lstname!=null)
		{
			document.getElementById("User_lstname").innerHTML=""; 
		}  
		$("#loading_icon").show();
		var form = document.myProfile;

		var dataString = $(form).serialize();


		$.ajax({
		    type:'POST',
		    url:'<?= base_url(); ?>account/update',
		    data: dataString,
		    success: function(data){
			 	$("#loading_icon").hide();
		        $('#SuccessMsg').html(data); 
		    }
		}); 
		return false;	
	} 

</script>  
<form name="myProfile" action="" enctype="multipart/form-data"  onsubmit="return updateProfile()" method="post" role="form"> 
	<div class="box-body">
		<div class="form-group">
			<label>First Name *</label>
			<input type="text" class="form-control"  name="User_fstname" placeholder="Enter First Name" value="<?php echo $user["User_fstname"];?>">
			<b><span id="User_fstname" style="color:red"></span></b>
		</div>
		<div class="form-group">
			<label>Last Name *</label>
			<input type="text" class="form-control"  name="User_lstname" placeholder="Enter Last Name" value="<?php echo $user["User_lstname"];?>">
			<b><span id="User_lstname" style="color:red"></span></b>
		</div>  
		<div class="form-group">
			<label>Email</label>
			<input type="email" class="form-control"  name="User_email" placeholder="Enter Email" value="<?php echo $user["User_email"];?>" disabled>
			<input type="hidden" class="form-control"  name="User_email" placeholder="Enter Email" value="<?php echo $user["User_email"];?>">
			<b><span id="User_email" style="color:red"></span></b> 
		</div> 
		<div class="form-group">
			<label>Contact Number</label>
			<input type="text" class="form-control"  name="User_mobileno" placeholder="Enter Branch Contact Number" value="<?php echo $user["User_mobileno"];?>" disabled>
			<b><span id="User_mobileno" style="color:red"></span></b>
		</div> 
		<div class="form-group">
			<label>Gender *</label>
			<input type="radio"  name="User_gender" value="Male" <?php if($user["User_gender"]=="Male") echo "checked";?>>  Male  
			<input type="radio"  name="User_gender" value="Female" <?php if($user["User_gender"]=="Female") echo "checked";?>>  Female  
			<input type="radio"  name="User_gender" value="Others" <?php if($user["User_gender"]=="Others") echo "checked";?>>  Other 
			<b><span style="color:red" id="User_gender"></span></b>  
		</div>			
	</div> 
	<div class="box-footer">
		<button type="submit"  class="btn btn-white">Save</button>
		<button type="reset" class="btn btn-default">Reset</button>
	</div>
</form>