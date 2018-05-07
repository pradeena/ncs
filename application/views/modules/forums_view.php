<?php
defined("BASEPATH") or exit("No Direct Script Allowed");
?>
<script> 
/* validate ask forum */
function validateForum()
{ 
	var Fques_question=Forum.Fques_question.value;
	Fques_question=Fques_question.trim();
	if(Fques_question=="" || Fques_question==null)
	{
		document.getElementById("Fques_question").innerHTML="* Required";
		Forum.Fques_question.focus();
		return false;
	}
	if(Fques_question!="" || Fques_question!=null)
	{
		document.getElementById("Fques_question").innerHTML="";
		$.post("<?php echo base_url();?>All_ajax_CRUD/ask_questionAjax",{Fques_question:Fques_question},function(data){  
			$("#QusMsg").html(data);
		});    
	}  
} 
/* validate submit forum answer */
function validateAnswerForum()
{
	var Fans_forumqusid=AnsForum.Fans_forumqusid.value;
	var Fans_answer=AnsForum.Fans_answer.value;
	Fans_answer=Fans_answer.trim();
	if(Fans_answer=="" || Fans_answer==null)
	{
		document.getElementById("Fans_answer").innerHTML="* Required";
		AnsForum.Fans_answer.focus();
		return false;
	}
	if(Fans_answer!="" || Fans_answer!=null)
	{
		document.getElementById("Fans_answer").innerHTML="";
		$.post("<?php echo base_url();?>All_ajax_CRUD/submit_answerAjax",{Fans_answer:Fans_answer,Fans_forumqusid:Fans_forumqusid},function(data){  
			$("#AnsMsg").html(data);
		});    
	} 
}
</script>
<style>
h4{font-weight:400;}
.question{color:#F67B7B;}
.post-comments{margin-top: 0;}
.blog-single h4{margin: 10px 0;font-size: 17px;line-height: 9px;}
</style>
<?php 
/* list all forums */
if($action=="list_questions")
{
	foreach($result_total_recordfound as $row_total_recordfound)
?>
<div class="page-header internalPages">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<!-- Page Header Wrapper -->
				<div class="page-header-wrapper">  
					<h5 class="sub-title">Nepal College Search (CampusKit) - Forums & Discussion</h5>
					<ol class="breadcrumb">
						<li><a href="<?php echo base_url();?>">Home</a></li>
						<li class="active">Forums</li>
					</ol><!-- Breadcrumb -->
				</div><!-- Page Header Wrapper -->
			</div><!-- Coloumn -->
		</div><!-- Row -->
	</div><!-- Container -->
</div><!-- Page Header --> 
<div role="main" class="main"> 
	<section class="element-animation-section">
		<div class="container">
			<div class="row"><br/>
				<div class="col-md-12">  
					<div class="panel-group"> 
					<?php 
					$Srno=1;
					foreach($result_list_forum_questions as $row_list_forum_questions)
					{
						$url=str_replace(" ","-",$row_list_forum_questions["Fques_question"]);
						$url=preg_replace('/[^A-Za-z0-9\-]/', '', $url); 
						$url=strtolower($url);
						$db2=$this->load->database("db2",true);
						$db2=$db2->database;
						$this->db->where("Fans_forumqusid",$row_list_forum_questions["Fques_id"]);
						$sql_ans_count=$this->db->get("$db2.forums_answers");
						if($this->session->userdata("is_loged_in"))
						{
							if($this->session->userdata("myid")==$row_list_forum_questions["User_id"])
							{
								$askby="You";
							}
							else
							{ 
								$askby=ucwords($row_list_forum_questions["User_fstname"]).' '.ucwords($row_list_forum_questions["User_lstname"]); 
							}
						}
						else
						{
							$askby=ucwords($row_list_forum_questions["User_fstname"]).' '.ucwords($row_list_forum_questions["User_lstname"]);
						}
					?>	 
						<div class="panel panel">
							<div class="panel-heading" >
								<h4 class="panel-title">
									<a href="<?php echo base_url();?>forums/<?php echo $row_list_forum_questions["Fques_id"]?>/<?php echo $url;?>">
									<?php echo $Srno.'. '.ucwords($row_list_forum_questions["Fques_question"]);?></a>
									<div class="clearfix"></div>
									<p style="font-size:12px;">Asked By <i class="fa fa-angle-right" aria-hidden="true"></i> <span class="question"><?php echo $askby;?></span> &nbsp;&nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;&nbsp;<?php $date=strtotime($row_list_forum_questions["Aques_regdate"]); echo $data=date("Y-m-d",$date);?> &nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;&nbsp;  <?php if($sql_ans_count->num_rows()>0){?> <a href="<?php echo base_url();?>forums/<?php echo $row_list_forum_questions["Fques_id"]?>/<?php echo $url;?>"><?php  echo $sql_ans_count->num_rows();?> Answers </a><?php } else { echo $sql_ans_count->num_rows().' Answers';;}?>
								</h4>
							</div> 
						</div> 
					<?php $Srno++; }?>	
					</div><!-- Tab -->
							<h5 style="text-align:left;">Ask questions on Career and Education Queries</h5>
							<?php if($this->session->userdata("is_loged_in")){?>
								<span id="QusMsg"></span> 
								<form method="post" name="Forum" action="" id="myForm">
									<div class="input-text form-group" style="margin-top:20px;">
										<textarea rows="10" cols="30" type="text" name="Fques_question"  class="input-name form-control" placeholder="Ask Your Question"></textarea>
										<b><span id="Fques_question" style="color:red"></span></b>
									</div>  
									<center> <button type="button" onclick="return validateForum();" class="btn">Ask Now</button></center>
								</form>	 
							<?php } else {?>
									<br/>
									<center> <a href="<?php echo base_url();?>login?redirect=ask-forums" class="btn"><i class="fa fa-lock"></i> Login To Ask Question</button></a></center>
							<?php } ?> 
						<?php
						$total_pages = ceil($row_total_recordfound["count"] /10); 
						?>
						<nav class="text-center">
							<ul class="pagination"> 
								<?php 
								for($i=1; $i<=$total_pages; $i++) 
								{ 
									$pag=isset($_GET['pg'])?$_GET['pg']:""; 
									if($i==intval($pag))
									{ 
								?>
										<li><a  <?php if($pag==$i){ echo "style='background:#2196f3'";}?> href="<?php echo base_url();?>forums/<?php echo $i;?>"><?php echo $i;?></a></li> 
									<?php } else {?>
										<li><a  <?php if($pag==$i){ echo "style='background:#2196f3'";}?> class="btn" href="<?php echo base_url();?>forums/<?php echo $i;?>"><?php echo $i;?></a></li> 	
								<?php }}?>	 
							</ul>
						</nav><!-- Pagination -->
				</div><!-- Column --> 
			</div><!-- Row -->
		</div><!-- Container -->
	</section><!-- Section -->
<?php
}
/* list individual forums with answers */
elseif($action=="forum_answer_details")
{
	$db2=$this->load->database("db2",true);
	$db2=$db2->database; 
	foreach($result_indiv_forum_questions as $row_indiv_forum_questions)
	$this->db->where("Fans_forumqusid",$row_indiv_forum_questions["Fques_id"]);
	$sql_ans_count=$this->db->get("$db2.forums_answers");
	$url=str_replace(" ","-",$row_indiv_forum_questions["Fques_question"]);
	$url=preg_replace('/[^A-Za-z0-9\-]/', '', $url); 
	$url=strtolower($url);
?> 
<div class="page-header internalPages">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<!-- Page Header Wrapper -->
				<div class="page-header-wrapper">  
					<h5 class="sub-title"><?php echo $row_indiv_forum_questions["Fques_question"];?></h5>
					<ol class="breadcrumb">
						<li><a href="<?php echo base_url();?>">Home</a></li>
						<li><a href="<?php echo base_url();?>forums">Forums</a></li>
					</ol><!-- Breadcrumb -->
				</div><!-- Page Header Wrapper -->
			</div><!-- Coloumn -->
		</div><!-- Row -->
	</div><!-- Container -->
</div><!-- Page Header -->  
<div role="main" class="main">
	<div class="page-default">
		<!-- Container -->
		<div class="container">
			<div class="row"> 
				<div class="col-xs-12 blog-single">
					<?php
						if($this->session->userdata("is_loged_in"))
						{
							if($this->session->userdata("myid")==$row_indiv_forum_questions["User_id"])
							{
								$askby="You";
							}
							else
							{ 
								$askby=ucwords($row_indiv_forum_questions["User_fstname"]).' '.ucwords($row_indiv_forum_questions["User_lstname"]); 
							}
						}
						else
						{
							$askby=ucwords($row_indiv_forum_questions["User_fstname"]).' '.ucwords($row_indiv_forum_questions["User_lstname"]);
						}
					?>
					<div id="post-comment"  class="post-block post-comments clearfix">
						<h4><b><?php echo $row_indiv_forum_questions["Fques_question"];?></b></h4>
						<p style="font-size:12px;">Asked By <i class="fa fa-angle-right" aria-hidden="true"></i> <span class="question"><?php echo $askby;?></span> &nbsp;&nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;&nbsp;<?php $date=strtotime($row_indiv_forum_questions["Aques_regdate"]); echo $data=date("Y-m-d",$date);?> &nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;&nbsp;  Total Answers <?php echo $sql_ans_count->num_rows();?> &nbsp;&nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;&nbsp;  <a href="<?php echo base_url();?>ask-forums">Ask Question</a> </p>
						<!-- Comments -->
						<ul class="comments">
						<?php 
						foreach($result_indiv_forum_ans as $row_indiv_forum_ans)
						{
							if($row_indiv_forum_ans["User_profile_pic"]==""){$image="no-image.jpg";} else {$image=$row_indiv_forum_ans["User_profile_pic"];}
						?>
							<li> 
								<div class="comment">
									<div class="img-thumbnail">
										<img src="<?php echo base_url();?>admin/uploads/users/thumbs/<?php echo $image;?>" alt="<?php echo $image;?>" class="avatar img-responsive" height="80" width="80">
									</div>
									<div class="comment-block">
										<div class="comment-arrow"></div>
										<span class="comment-by">
											<strong>
											<?php 
											if($this->session->userdata("is_loged_in"))
											{
												if($this->session->userdata("myid")==$row_indiv_forum_ans["User_id"])
												{
													$ansby="You";
												}
												else
												{ 
													$ansby=ucwords($row_indiv_forum_ans["User_fstname"]).' '.ucwords($row_indiv_forum_ans["User_lstname"]); 
												}
											}
											else
											{
												$ansby=ucwords($row_indiv_forum_ans["User_fstname"]).' '.ucwords($row_indiv_forum_ans["User_lstname"]);
											} 
													echo $ansby;
											?></strong> 
										</span><!-- Comment By -->
										<p><?php echo $row_indiv_forum_ans["Fans_answer"];?></p>
										<span class="date pull-right"><?php echo $row_indiv_forum_ans["Fans_replydate"];?></span>
									</div><!-- Comment Block -->
								</div><!-- Comment --> 
							</li><hr/>
						<?php } ?>	
						</ul><!-- Comments Full -->
					</div><!-- Post Comments -->
							<h5><b>Can you help? Nepal College Search depends on everyone sharing their knowledge. If you're able to answer this question, please do!</b></h5>
							<?php if($this->session->userdata("is_loged_in")){?>
								<span id="AnsMsg"></span> 
								<form method="post" name="AnsForum" action="" id="myForm">
									<div class="input-text form-group" style="margin-top:20px;">
										<textarea rows="10" cols="30" name="Fans_answer"  class="input-name form-control" placeholder="Post Your Answer"></textarea>
										<b><span id="Fans_answer" style="color:red"></span></b>
									</div>  
									<input type="hidden" name="Fans_forumqusid" value="<?php echo $row_indiv_forum_questions["Fques_id"];?>">
									<center> <button type="button" onclick="return validateAnswerForum();" class="btn">Post Your Answer</button></center>
								</form>	 
							<?php } else {?>
									<br/>
									<center> <a href="<?php echo base_url();?>login?redirect=forums/<?php echo $row_indiv_forum_questions["Fques_id"]?>/<?php echo $url;?>" class="btn"><i class="fa fa-lock"></i> Login To Post Your Answer</button></a></center>
							<?php } ?>
				</div><!-- Column -->
			</div><!-- Row -->
		</div><!-- Container -->
	</div>
<?php	
}
/* all forums question*/
elseif($action=="ask_forum_qus")
{
?>
<div class="page-header internalPages">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<!-- Page Header Wrapper -->
				<div class="page-header-wrapper">  
					<h5 class="sub-title">Nepal College Search (CampusKit) - Forums & Discussion</h5>
					<ol class="breadcrumb">
						<li><a href="<?php echo base_url();?>">Home</a></li>
						<li><a href="<?php echo base_url();?>forums">Forums</a></li>
						<li class="active">Ask Questions</li>
					</ol><!-- Breadcrumb -->
				</div><!-- Page Header Wrapper -->
			</div><!-- Coloumn -->
		</div><!-- Row -->
	</div><!-- Container -->
</div><!-- Page Header --> 

<div role="main" class="main">
	<div class="page-default">
		<!-- Container -->
		<div class="container">
			<div class="row">
				<!-- Blog Column -->
				<div class="col-xs-12 blog-single"> 
							<h5><b>Ask questions on Career and Education Queries</b></h5>
							<?php if($this->session->userdata("is_loged_in")){?>
								<span id="QusMsg"></span> 
								<form method="post" name="Forum" action="" id="myForm">
									<div class="input-text form-group" style="margin-top:20px;">
										<textarea rows="10" cols="30" type="text" name="Fques_question"  class="input-name form-control" placeholder="Ask Your Question"></textarea>
										<b><span id="Fques_question" style="color:red"></span></b>
									</div>  
									<center> <button type="button" onclick="return validateForum();" class="btn">Ask Now</button></center>
								</form>	 
							<?php } else {?>
									<br/>
									<center> <a href="<?php echo base_url();?>login?redirect=ask-forums" class="btn"><i class="fa fa-lock"></i> Login To Ask Question</button></a></center>
							<?php } ?>
				</div><!-- Column -->
			</div><!-- Row -->
		</div><!-- Container -->
	</div>
<?php	
}
?>	