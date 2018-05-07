<?php 
defined("BASEPATH") OR exit("No Direct Script Allowed");
$action=isset($_REQUEST["action"])  ? $_REQUEST["action"]:"select_test";
?> 
<script>
function get_instructionAjax(Utest_id)
{	
	$.post("<?php echo base_url();?>online_test/get_instruction",{Utest_id:Utest_id},function(data)
		{   
			$("#instruction").html(data);
		});
} 
</script>
<script type="text/javascript">
var windowObjectReference = null; // global variable 
function openRequestedPopup(strUrl, strWindowName) {
  if(windowObjectReference == null || windowObjectReference.closed) {
    windowObjectReference = window.open(strUrl, strWindowName,
           "resizable,scrollbars,status");
  } else {
    windowObjectReference.focus();
  };
}
</script> 
<script> 
function validate_testcode()
{
	var Eschedule_code=testCodeForm.Eschedule_code.value;
	Eschedule_code=Eschedule_code.trim();
	if(Eschedule_code=='' || Eschedule_code==null)
	{
		document.getElementById("Eschedule_code").innerHTML="* Enter Test Code";
		testCodeForm.Eschedule_code.focus();
		return false;
	}
	if(Eschedule_code!='' || Eschedule_code!=null)
	{
		document.getElementById("Eschedule_code").innerHTML="";
	}
}
</script> 
<div class="content-wrapper">
<?php 
if($action=="select_test")
{
?> 
    <div class="container"> 
		<section class="content">
			<div class="row">  
				<div class="login-box"> 
					<div class="login-box-body">
						<p class="login-box-msg"><b>You Can Start Your Test By Selecting It & Follow The Instruction Step By Step Which You Will Able To See After Selecting Test</b></p> 
						<form  name="searchForm" action="" method="post"> 
							<input type="hidden" name="do_search_college" value="true">
							<div class="input-group input-group-sm">
								<select class="form-control select2"  name="Utest_id" onchange="return get_instructionAjax(this.value);">
									<option selected disabled>Select Test</option>
									<?php 
										$db9=$this->load->database("db9",true);
										$db9=$db9->database;
										$this->db->select("*");
										$this->db->from("$db9.users_test");
										$this->db->join("$db9.exam_schedule",'exam_schedule.Eschedule_id=users_test.Utest_exmschedule_id'); 
										$this->db->where("Utest_userid",$this->session->userdata("myid"));
										$this->db->where("Eschedule_status",1); 
										$query_userTest=$this->db->get();
										$result_userTest=$query_userTest->result_array();
										foreach($result_userTest as $row_userTest) {
									?>
									<option value="<?php echo $row_userTest["Utest_id"]; ?>">
										<?php echo $row_userTest["Eschedule_name"]; ?></option>
									<?php } ?>
								</select>
								<span class="input-group-btn">
									<button class="btn btn-info btn-flat" type="button"  name="test_schedule" value=""><b><i class="fa fa-map-pin"></i></b></button>
								</span>
							</div>
							<div id="instruction">
							</div>
						</form> 
					</div> 
				</div>
			</div>	
		</section> 
	</div>	
<?php 
}
elseif($action=="verify_test_code")
{  
	foreach($result_user_test as $row_user_test)
	if($row_user_test["count"] < 1)
	{
		redirect(base_url()."page_not_found");
	} 
	elseif($row_user_test["Utest_verify_testcode"]==1)
	{
		redirect(base_url().'online_test?action=proceed&test_id='.$this->input->get("test_id"));
	}
	else {
?>  
    <div class="container"> 
		<section class="content">
			<div class="row">  
				<div class="login-box"> 
					<div class="login-box-body">
					<center><p><b>TEST DETAILS<b></p></center> 
					<table  class="table table-bordered table-striped">
					<thead>
						<tr><th><b>Roll Code</b> </th><th><i><?php echo $row_user_test["Utest_usr_testcode"];?></i></th></tr>
						<tr><th><b>Test Name</b> </th><th><i><?php echo $row_user_test["Eschedule_name"];?></i></th></tr>
						<tr><th><b>Start Time</b> </th><th><i><?php echo $row_user_test["Eschedule_startdate"];?></i></th></tr>
						<tr><th><b>End Time</b> </th><th><i><?php echo $row_user_test["Eschedule_enddate"];?></i></th></tr>
						<tr><th><b>Test Duration</b> </th><th><i><?php echo $row_user_test["Eschedule_minutes"];?> Minutes</i></th></tr>
						<tr><th><b>Total QUestions</b> </th><th><i><?php echo $row_user_test["Eschedule_total_questions"];?></i></th></tr>
						<tr><th><b>Total Marks</b> </th><th><i><?php echo $row_user_test["Eschedule_total_marks"];?></i></th></tr> 
					</thead>
					</table>
						<form  name="testCodeForm" action="" method="post" onsubmit="return validate_testcode()"> 
						<p style="color:red"><?php if(isset($msg)) echo $msg;?></p> 
								<input type="hidden" name="do_verify_test_code" value="true">
								<input type="hidden" name="Eschedule_id" value="<?php echo $row_user_test["Eschedule_id"];?>">
								<div class="form-group"> 
									<input type="text" class="form-control" name="Eschedule_code" placeholder="Please Enter Your Test Code" value="<?php echo $this->input->post("Eschedule_code");?>" style="text-align:center;" >
									<b><span style="color:red" id="Eschedule_code"></span></b>
								</div>	
								<center>
									<small> 
										<button type="submit"  name="verify_test_code" class="btn btn-primary">Verify</button>
										<button type="Reset"  class="btn btn-white">Reset</button>
									</small>
								</center>
						</form> 
					</div> 
				</div>
			</div>	
		</section> 
	</div>	
<?php 
	}
} 
elseif($action=="proceed")
{
	foreach($result_user_test as $row_user_test)
	if($row_user_test["count"] < 1)
	{
		redirect(base_url()."page_not_found");
	}
	if($row_user_test["Utest_verify_testcode"]==0)
	{
		redirect(base_url().'online_test?action=verify_test_code&test_id='.$this->input->get("test_id"));
	}
	else 
	{
		foreach($result_user_details as $row_user_details)
?>
	<div class="container"> 
		<section class="content">
			<div class="row">  
				<div class="login-box"> 
					<div class="login-box-body"> 
						<div>
							<center>
								<h4><b>Good Luck</b> </h4>
								<h4 style="color:blue">Mr/Miss  <?php echo ucwords($row_user_details["User_fstname"]).' '.ucwords($row_user_details["User_lstname"]);?> ... <span class="glyphicon glyphicon-thumbs-up"></span>
								</h4>
								<p style="color:green">The best way to motivate yourself is to stop stressing about what’ll happen when things go wrong and start thinking about how awesome life will be when they go right.</p>
							</center>
						</div><br/>
						<center>
							<small> 
								<a href="<?php echo base_url();?>start_test?test_id=<?php  echo $this->input->get("test_id");?>" class="btn btn-info" onclick="openRequestedPopup(this.href, this.target); return false;">Start Test</a>
							</small>
						</center> 
					</div> 
				</div>
			</div>	
		</section> 
	</div> 
<?php 	
	}
}
?>	
</div>