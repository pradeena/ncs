<?php 
defined("BASEPATH") OR exit("No Direct Script Allowed");
$action=isset($_REQUEST["action"])  ? $_REQUEST["action"]:"select_test";
?>  
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
<script>
    $(document).ready(function() { 
		timePicker(60);
    });
</script>
<?php
$to_time = strtotime($Utest_end_time);
$from_time = strtotime($Utest_start_time);
$expend_time=round(abs($to_time - $from_time) / 60,2);
$endtime=($Eschedule_minutes-$expend_time)*60;
$endtime=$endtime+60;
if($endtime < 1)
{
	redirect(base_url()."start_test/closeTest?test_id=".$this->input->get("test_id"));
}
?>  
<script> 
	$(document).ready(function() { 
		EndTestTimer(10);
		alert("hello");
    });			 
</script>  
<script>  
                var s;
				var test_id=<?php echo $this->input->get("test_id");?> 
                function timePicker(vr) {

                    if (vr > 0)
                    {
                        if (vr > 1) {
                              $('#successTimerMsg').html('Timer will be updated in next '+ vr+' secounds');
                          
                            
                        } else {
                          
                              $('#successTimerMsg').html('Timer will be updated in next 1 secound');
                        }
                        vr--;
                        s = setTimeout('timePicker(' + vr + ')', 1000);
                    } else {
                        clearInterval(s);
                        
                        $.post('<?php echo base_url();?>start_test/update_end_timeAjax',{test_id},function(r){   
                        $('#successTimerMsg').html(r);
                        s = setTimeout('timePicker(' + 60 + ')', 5000);
                        return false;
                            
                        });
                    }
                }  
</script> 
<script>   
<?php $SrNo=1; foreach($result_set_user_questions as $row_set_user_questions){?>
function next_question<?php echo $SrNo;?>_show()
{
	var Uans_ans_desc=Add_answer<?php echo $SrNo;?>.Uans_ans_desc.value; 
	var Uans_usr_testid=Add_answer<?php echo $SrNo;?>.Uans_usr_testid.value; 
	var Uans_quesid=Add_answer<?php echo $SrNo;?>.Uans_quesid.value;  
	var Uans_ans=Add_answer<?php echo $SrNo;?>.Uans_ans.value;
	var Equestion_qustypeid=Add_answer<?php echo $SrNo;?>.Equestion_qustypeid.value;
	var Equestion_ans_true=Add_answer<?php echo $SrNo;?>.Equestion_ans_true.value;
	var Etest_marks=Add_answer<?php echo $SrNo;?>.Etest_marks.value;
		$.post("<?php echo base_url();?>start_test/Add_TestanswerAjax",{Uans_ans_desc:Uans_ans_desc,Uans_quesid:Uans_quesid,Uans_usr_testid:Uans_usr_testid,Uans_ans:Uans_ans,Equestion_qustypeid:Equestion_qustypeid,Equestion_ans_true:Equestion_ans_true,Etest_marks:Etest_marks},function(data){ 
			$("#successMsg").html(data);
		});
	$("#question_<?php echo $SrNo;?>").hide(); 
	$("#question_<?php echo $SrNo+1;?>").show(); 
}
function back_question<?php echo $SrNo;?>_show()
{ 
	var Uans_ans_desc=Add_answer<?php echo $SrNo;?>.Uans_ans_desc.value; 
	var Uans_usr_testid=Add_answer<?php echo $SrNo;?>.Uans_usr_testid.value; 
	var Uans_quesid=Add_answer<?php echo $SrNo;?>.Uans_quesid.value;  
	var Uans_ans=Add_answer<?php echo $SrNo;?>.Uans_ans.value; 
	var Equestion_qustypeid=Add_answer<?php echo $SrNo;?>.Equestion_qustypeid.value;
	var Equestion_ans_true=Add_answer<?php echo $SrNo;?>.Equestion_ans_true.value;
	var Etest_marks=Add_answer<?php echo $SrNo;?>.Etest_marks.value;
		$.post("<?php echo base_url();?>start_test/Add_TestanswerAjax",{Uans_ans_desc:Uans_ans_desc,Uans_quesid:Uans_quesid,Uans_usr_testid:Uans_usr_testid,Uans_ans:Uans_ans,Equestion_qustypeid:Equestion_qustypeid,Equestion_ans_true:Equestion_ans_true,Etest_marks:Etest_marks},function(data){ 
			$("#successMsg").html(data);
		}); 
	$("#question_<?php echo $SrNo;?>").hide(); 
	$("#question_<?php echo $SrNo-1;?>").show();	
}  
function submitTest<?php echo $SrNo;?>()
{ 
	var Uans_ans_desc=Add_answer<?php echo $SrNo;?>.Uans_ans_desc.value; 
	var Uans_usr_testid=Add_answer<?php echo $SrNo;?>.Uans_usr_testid.value; 
	var Uans_quesid=Add_answer<?php echo $SrNo;?>.Uans_quesid.value;  
	var Uans_ans=Add_answer<?php echo $SrNo;?>.Uans_ans.value; 
	var Equestion_qustypeid=Add_answer<?php echo $SrNo;?>.Equestion_qustypeid.value;
	var Equestion_ans_true=Add_answer<?php echo $SrNo;?>.Equestion_ans_true.value;
	var Etest_marks=Add_answer<?php echo $SrNo;?>.Etest_marks.value;
		$.post("<?php echo base_url();?>start_test/submitTestAjax",{Uans_ans_desc:Uans_ans_desc,Uans_quesid:Uans_quesid,Uans_usr_testid:Uans_usr_testid,Uans_ans:Uans_ans,Equestion_qustypeid:Equestion_qustypeid,Equestion_ans_true:Equestion_ans_true,Etest_marks:Etest_marks},function(data){ 
			$("#successMsg").html(data);
		});
}
<?php $SrNo++; }?>
</script> 
<script>
function my_onkeydown_handler() {
    switch (event.keyCode) {
        case 116 : // 'F5'
            event.preventDefault();
            event.keyCode = 0;
            window.status = "F5 disabled";
            break;
    }
}
document.addEventListener("keydown", my_onkeydown_handler);
</script>
<!-- Disable Copy and Paste-->
<script language='JavaScript1.2'>
function disableselect(e) {
    return false
}

function reEnable() {
    return true
}

document.onselectstart = new Function (&quot;return false&quot;)

if (window.sidebar) {
    document.onmousedown = disableselect
    document.onClick = reEnable
}
</script>
<script language="javascript">

function Disable_Control_C() {
var keystroke = String.fromCharCode(event.keyCode).toLowerCase();

if (event.ctrlKey && (keystroke == 'c' || keystroke == 'v')) {
alert("Copy Paste Not Allowed");
event.returnValue = false; // disable Ctrl+C
}
}
</script>
<script>
var isNS = (navigator.appName == "Netscape") ? 1 : 0;

if(navigator.appName == "Netscape") document.captureEvents(Event.MOUSEDOWN||Event.MOUSEUP);

function mischandler(){
return false;
}

function mousehandler(e){
var myevent = (isNS) ? e : event;
var eventbutton = (isNS) ? myevent.which : myevent.button;
if((eventbutton==2)||(eventbutton==3)) return false;
}
document.oncontextmenu = mischandler;
document.onmousedown = mousehandler;
document.onmouseup = mousehandler;

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
<?php
$to_time = strtotime($Utest_end_time);
$from_time = strtotime($Utest_start_time);
$expend_time=round(abs($to_time - $from_time) / 60,2);
?>  
<script language ="javascript"> 
        var tim;
        var min = <?php echo $Eschedule_minutes-$expend_time;?>-1;
		var min = Math.round(min);
        var sec = 60;
        var f = new Date();
        function f1() {
            f2();
            document.getElementById("starttime").innerHTML = "Your started Exam at " + f.getHours() + ":" + f.getMinutes();
        }
        function f2() {
            if (parseInt(sec) > 0) {
                sec = parseInt(sec) - 1;
                document.getElementById("showtime").innerHTML = "Time Left : "+min+" Minutes : " + sec+" Seconds";
                tim = setTimeout("f2()", 1000);
            }
            else {
                if (parseInt(sec) == 0) {
                    min = parseInt(min) - 1;
                    if (parseInt(min) == 0) {
                        clearTimeout(tim);
                        location.href = "default5.aspx";
                    }
                    else {
                        sec = 60;
                        document.getElementById("showtime").innerHTML = "Time Left :" + min + " Minutes : " + sec + " Seconds";
                        tim = setTimeout("f2()", 1000);
                    }
                }
               
            }
        } 
    </script>
<script type='text/javascript'>
var isCtrl = false;
document.onkeyup=function(e)
{
    if(e.which == 17)
    isCtrl=false;
}
document.onkeydown=function(e)
{
    if(e.which == 17)
    isCtrl=true;
    if((e.which == 85) || (e.which == 67) && (isCtrl == true))
    {
        return false;
    }
}
var isNS = (navigator.appName == "Netscape") ? 1 : 0;
if(navigator.appName == "Netscape") document.captureEvents(Event.MOUSEDOWN||Event.MOUSEUP);
function mischandler(){
    return false;
}
function mousehandler(e){
    var myevent = (isNS) ? e : event;
    var eventbutton = (isNS) ? myevent.which : myevent.button;
    if((eventbutton==2)||(eventbutton==3)) return false;
}
document.oncontextmenu = mischandler;
document.onmousedown = mousehandler;
document.onmouseup = mousehandler; 
</script>
<div class="content-wrapper"> 
<div id="autoSave"></div>  
    <div class="container"> 
		<center>	
			<span id="loading_icon" style="display:none;font-size:25px">
				<div class="overlay">
					<i style="color:#DC143C" class="fa fa-refresh fa-spin"></i>
				</div>
			</span>
			<span id="successMsg"></span>
			<span id="successTimerMsg"></span>
			<b><?php if(isset($msg)) echo $msg;?></b>
		</center>	
		<section class="content">
			<div class="box box-default">
				<div class="box-body">
					<body onload="f1()" >
						<form id="form1" runat="server">
							<div>
								<table width="100%" align="center">
									<tr>
										<td>
											<form name="timer" method="post">
											<input type="hidden" id="Eschedule_id" value="<?php echo $Eschedule_id; ?>">  
											<div style="text-align:right"><button disabled class="btn btn-danger">Total Marks:- <?php echo $Eschedule_total_marks;?></button>&nbsp;<button disabled class="btn btn-danger">START TIME <?php echo $start_time;?></button>&nbsp;<button disabled class="btn btn-white"><span id="showtime"></span></button> 
											<div id="showtime"></div>  
											</form>
										</td>
									</tr>
								</table>
							</div>
						</form>
					</body>
					<div class="row"><!-- /.col -->
						<div class="col-md-14"> 
							<?php  $SrNo=1; foreach($result_set_user_questions as $row_set_user_questions){?>
							<div id="question_<?php echo $SrNo;?>" <?php if($SrNo!=1){?>style="display:none"<?php }?>>
								<div class="example-modal">
									<form name="Add_answer<?php echo $SrNo;?>" method="post" action="" enctype="multipart/form-data">
									<div class="modal">
										<div class="modal-dialog">
											<div class="modal-content"  class="rightclick">
												<div class="modal-header">
													<p class="modal-title"><h4>Question <?php echo $SrNo;?>.</h4><b><?php echo $row_set_user_questions["Equestion_desc"]; ?></b>( <?php echo $row_set_user_questions["Etest_marks"]; ?> Marks)</p>
												</div>
													<input type="hidden" name="Uans_quesid" value="<?php echo $row_set_user_questions["Uans_quesid"];?>">
													<input type="hidden" name="Equestion_qustypeid" value="<?php echo $row_set_user_questions["Equestion_qustypeid"];?>">
													<input type="hidden" name="Equestion_ans_true" value="<?php echo $row_set_user_questions["Equestion_ans_true"];?>">
													<input type="hidden" name="Etest_marks" value="<?php echo $row_set_user_questions["Etest_marks"];?>">
													<input type="hidden" name="Uans_usr_testid" value="<?php echo $this->input->get("test_id")?>"> 
												<?php if($row_set_user_questions["Equestion_qustypeid"]==1){?>
												<div class="modal-body"> 
													<input type="hidden" name="Uans_ans_desc" value="">
													<input type="radio" name="Uans_ans" value="1" <?php if($row_set_user_questions["Uans_ans"]==1) echo "checked";?>>A. <?php echo $row_set_user_questions["Equestion_ans1"];?><br/>
													<input type="radio" name="Uans_ans" value="2" <?php if($row_set_user_questions["Uans_ans"]==2) echo "checked";?>>B. <?php echo $row_set_user_questions["Equestion_ans2"];?><br/>
													<input type="radio" name="Uans_ans" value="3" <?php if($row_set_user_questions["Uans_ans"]==3) echo "checked";?>>C. <?php echo $row_set_user_questions["Equestion_ans3"];?><br/>
													<input type="radio" name="Uans_ans" value="4" <?php if($row_set_user_questions["Uans_ans"]==4) echo "checked";?>>D. <?php echo $row_set_user_questions["Equestion_ans4"];?>
												</div>
												<?php }
													elseif($row_set_user_questions["Equestion_qustypeid"]==2){?>
												<body onkeydown="javascript:Disable_Control_C()"> 
														<div class="modal-body">	
															<input type="hidden" name="Uans_ans" value="0">
															<textarea rows="10" name="Uans_ans_desc" cols="50" class="form-control" value="<?php  echo $row_set_user_questions["Uans_ans_desc"];?>"><?php echo $row_set_user_questions["Uans_ans_desc"];?></textarea>
														</div>
												</body>
													<?php }?>
												<div class="modal-footer">
													<?php if($SrNo!=1){?>
													<button type="button"  class="btn btn-success" onclick="back_question<?php echo $SrNo;?>_show();"> Back</button>
													<?php } if($Eschedule_total_questions==$SrNo){?> 
													<button type="button"  class="btn btn-info" onclick="return submitTest<?php echo $SrNo;?>();">Submit Test</button>
													<?php } else { ?>
													<button type="button"  class="btn btn-primary" onclick="return next_question<?php echo $SrNo;?>_show();">Next</button>
													<?php }?>
												</div>
											</div><!-- /.modal-content -->
										</div><!-- /.modal-dialog -->
									</div><!-- /.modal -->
									</form>
								</div><!-- /.example-modal -->
							</div> 
								<?php $SrNo++; }?>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</section><!-- /.content -->
	</div> 
</div>
 