<?php
defined("BASEPATH") or exit("No Direct Script Allowed");  
$pg  = isset($_GET['pg']) ? $_GET['pg'] : 1;
$start_from = ($pg-1) * 5;
?> 
<script>
/* validate submit comment form */
function validateComment()
{ 
	var Ncomment_newsid=CommentPost.Ncomment_newsid.value; 
	var Ncomment_comment=CommentPost.Ncomment_comment.value;
	Ncomment_comment=Ncomment_comment.trim();
	if(Ncomment_comment=="" || Ncomment_comment==null)
	{
		document.getElementById("Ncomment_comment").innerHTML="* Required";
		CommentPost.Ncomment_comment.focus();
		return false;
	}
	if(Ncomment_comment!="" || Ncomment_comment!=null)
	{
		document.getElementById("Ncomment_comment").innerHTML="";
		$.post("<?php echo base_url();?>All_ajax_CRUD/do_commentAjax",{Ncomment_comment:Ncomment_comment,Ncomment_newsid:Ncomment_newsid},function(data){  
			$("#CmntMsg").html(data);
		});    
	}  
}
</script>
<style>
.typo-dark{padding-top:20px;}
.widget-title{font-weight:bold;font-family:uppercase;background:#fff;border-bottom:1px solid #ccc;font-family:'Droid Sans';font-weight:bold;}
.widget h5{font-weight:600;font-size:16px!important;}
.thumbnail-widget li{padding:5px;border-bottom: 1px dashed #e3e4e5;}
.thumbnail-widget li:nth-last-child(1){border-bottom: 0px dashed #e3e4e5;}
.thumbnail-widget .thumb-content{padding-left: 10px;vertical-align: top;}
.thumbnail-widget .thumb-content a{font-size:13px!important;}
.thumbnail-widget span{color: #ccc;font-size: 12px;}
.thumbnail-widget .thumb-wrap{margin-right:0;}
.widget{margin-bottom:20px;}
.badge{margin-top: 5px;}
.go-widget li a {
    display: block;
    padding: 5px 20px;
    position: relative;
}
.go-widget li a:hover {
    padding: 5px 20px;
}
.go-widget li a::before {
    content: "";
    font-family: universh-icon;
    font-size: 13px;
    font-weight: bold;
    left: 6px!important;
    line-height: inherit;
    margin-right: 10px;
    position: absolute;
    top: 10px;
	opacity: 0;
}
.go-widget li a:hover::before {
   left: 0;
	opacity: 1;
}
.go-widget li a::before,
.go-widget li a:hover::before, .go-widget .badge{
	/*-webkit-transition:all 350ms ease-in-out 0s;
	   -moz-transition:all 350ms ease-in-out 0s;
	    -ms-transition:all 350ms ease-in-out 0s;
	     -o-transition:all 350ms ease-in-out 0s;
		    transition:all 350ms ease-in-out 0s; */
}
/* Tag Widget */
.blog-wrap{min-height: 238px;}
h4 {
    font-size: 17px;
    font-weight: bold;
    line-height: 18px;
    margin: 10px 0 14px;
}
ul.blog-meta li {
    display: inline-block;
    float: left;
    font-size: 13px;
    position: relative;
    text-align: left;
    width: 50%;
	margin-bottom:5px;
}
.blog-details p{margin-bottom: 0;line-height: 1.4;font-size:12px;}
nav .pagination {
    margin-top: 0;
}
table{background:#fff; width:100%; border:1px solid #ccc;}
table tr{background:#fff; border-bottom:1px solid #F2F2F2;}
table tr:nth-child(odd){background:#F2F2F2;}
table tr td{padding:6px;}
table tr th{background:#E1E1E1; border-bottom:1px solid #ccc;}
.blog-single h4{margin:10px 0;}
.related-content a{background:none;text-align:center; box-shadow:none!important;}
.owl-stage-outer{height:auto;}
.blog-single-details h3{border-bottom:0px solid #808080!important;width:100%!important;margin-bottom:0!important;font-size:18px!important;line-height:22px!important;}
</style>
<?php
/* List All updates with or without categories view page*/
if($action=="list_updates")
{	 	
?>
<div class="page-header internalPages">
	<div class="container">
		<div class="row">
			<div class="col-xs-12"> 
				<div class="page-header-wrapper">  
					<h5 class="sub-title">List Latest Updates</h5>
					<ol class="breadcrumb">
						<li><a href="<?php echo base_url();?>">Home</a></li>
						<li class="active">Updates</li>
					</ol><!-- Breadcrumb -->
				</div><!-- Page Header Wrapper -->
			</div><!-- Coloumn -->
		</div><!-- Row -->
	</div><!-- Container -->
</div><!-- Page Header --> 
<div role="main" class="main">
	<div class="page-default bg-grey typo-dark"> 
		<div class="container">
			<div class="row"> 
				<div class="col-md-3"> 
					<aside class="sidebar">  
						<!-- Widget -->
						<div class="widget">
							<h5 class="widget-title">Categories</h5>
							<ul class="go-widget">
							<?php
							$db10=$this->load->database("db10",true);
							$db10=$db10->database; 
							$this->db->order_by("category","ASC");
							$sql_category=$this->db->get("$db10.news_category");
							$res_category=$sql_category->result_array();
							foreach($res_category as $row_category)
							{
								$url=str_replace(" ","-",$row_category["category"]); 
								$url=preg_replace('/[^A-Za-z0-9\-]/','',$url);
								$url=strtolower($url);
								$this->db->where("news_category_id",$row_category["id"]);
								$this->db->where("status",1);
								$sql_total_content=$this->db->get("$db10.news");
							?>
								<li><a href="<?php echo base_url();?>updates/category/<?php echo $row_category["id"]; ?>/<?php echo $url;?>"><i class="fa fa-angle-right" aria-hidden="true"></i>&nbsp;&nbsp;<?php echo ucwords($row_category["category"]); ?><span class="badge"><?php echo $sql_total_content->num_rows(); ?></span></a></li> 
							<?php } ?>	
							</ul>
						</div><!-- Widget -->  
						<div class="widget">
							<h5 class="widget-title">Latest Post</h5>
							<div class="clearfix"></div>
							<ul class="thumbnail-widget" style="margin-top:10px;">
							<?php
								$db10=$this->load->database("db10",true);
								$db10=$db10->database;
								$this->db->select("news_id,featured_image,content_title");
								$this->db->from("$db10.news");
								$this->db->join("$db10.news_category",'news_category.id =news.news_category_id');
								$this->db->order_by("posted_date","DESC");	
								$this->db->where("status",1); 
								$this->db->limit(10);
								$query_latest_post=$this->db->get();
								$res_latest_post=$query_latest_post->result_array();
								foreach($res_latest_post as $ros_latest_post)
								{
									if($ros_latest_post["featured_image"]=='') {$image_latest_post="no-image.jpg";} else{ $image_latest_post=$ros_latest_post["featured_image"]; } 
									$url=str_replace(" ","-",$ros_latest_post["content_title"]);
									$url=preg_replace('/[^A-Za-z0-9\-]/', '', $url); 
									$url=strtolower($url);
							?>	
								<li>
									<div class="thumb-wrap">
										<img alt="<?php echo $ros_latest_post["content_title"]; ?>" src="<?php echo FILE_PATH; ?>uploads/news-article-event/thumbs/<?php echo $image_latest_post; ?>" style="width:80px;height:80px;border: 1px solid #ccc;">
									</div>
									<div class="thumb-content"><a href="<?php echo base_url();?>updates/<?php echo $ros_latest_post["news_id"];?>/<?php echo $url;?>"><?php echo $ros_latest_post["content_title"]; ?></a></div>	
								</li> 
								<?php } ?>	
							</ul><!-- Thumbnail Widget -->
						</div><!-- Widget -->  
					</aside><!-- aside -->	
				</div><!-- Column --> 
				<div class="col-md-9">
					<ul class="row"> 
						<li class="col-xs-12 blog-list-wrap">
							<?php 
								foreach($result_total_recordfound as $row_total_recordfound) 
								if($row_total_recordfound["count"] < 1)
								{
									echo '<center><h1><b>Oops!</b></h1></center><h5 class="sub-title"> No Any Record Found</h5> ';
								}
								else
								{
							?>  
							<?php 
								foreach($result_updated_News_article as $row_updated_News_article){  
								if($row_updated_News_article["featured_image"]=='') {$image="no-image.jpg";} else{ $image=$row_updated_News_article["featured_image"]; } 
								$url=str_replace(" ","-",$row_updated_News_article["content_title"]);
								$url=preg_replace('/[^A-Za-z0-9\-]/', '', $url); 
								$url=strtolower($url); 
							?>
							<div class="row blog-wrap">
								<div class="col-sm-5">
									<div class="blog-img-wrap">
										<a href="<?php echo base_url();?>updates/<?php echo $row_updated_News_article["news_id"];?>/<?php echo $url;?>"><img src="<?php echo FILE_PATH; ?>uploads/news-article-event/thumbs/<?php echo $image; ?>" class="img-square img-responsive" alt="<?php echo $row_updated_News_article["content_title"]; ?>" /></a>
										<h6 class="post-type">&nbsp;<i class="fa fa-image"></i>&nbsp;</h6>
									</div><!-- Blog Image  Wrapper -->
								</div><!-- Blog Wrapper --> 
								<div class="col-sm-7">
									<div class="blog-details">
										<h4><a href="<?php echo base_url();?>updates/<?php echo $row_updated_News_article["news_id"];?>/<?php echo $url;?>"><?php echo $row_updated_News_article["content_title"];?></a></h4>
										<ul class="blog-meta">
											<li><i class="fa fa-calendar-o"></i><?php echo $row_updated_News_article["posted_date"]; ?></li> 
									<li><i class="fa fa-comments"></i> 22</li>
									<li><i class="fa fa-folder"></i> <?php echo $row_updated_News_article["category"];?></li>
										</ul><!-- Blog Meta -->
										<div class="clearfix"></div>
										<p><?php echo $row_updated_News_article["content_detail_half"];?> ...</p>
										<div class="clearfix"></div>
										<a class="btn" style="margin-top:10px;margin-bottom:10px;" href="<?php echo base_url();?>updates/<?php echo $row_updated_News_article["news_id"];?>/<?php echo $url;?>">Read More</a>
									</div><!-- Blog Detail Wrapper -->
								</div><!-- Blog Detail Column -->
							</div><!-- Blog Wrapper -->
								<?php } }?> 
							<hr class="md">
						</li><!-- Column -->  
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
										<?php if($news_category_id==""){?>
										<li><a  <?php if($pag==$i){ echo "style='background:#2196f3'";}?> href="<?php echo base_url();?>updates/<?php echo $i; ?>"><?php echo $i;?></a></li> 
										<?php } else {?>
											<li><a  <?php if($pag==$i){ echo "style='background:#2196f3'";}?> href="<?php echo base_url();?>updates/category/<?php echo $news_category_id?>/<?php echo $category_name?>/<?php echo $i; ?>"><?php echo $i;?></a></li> 
										<?php }?>
									<?php } else {?>
										<?php if($news_category_id==""){?>
										<li><a  <?php if($pag==$i){ echo "style='background:#2196f3'";}?> class="btn" href="<?php echo base_url();?>updates/<?php echo $i; ?>"><?php echo $i;?></a></li> 
										<?php } else {?>
										<li><a  <?php if($pag==$i){ echo "style='background:#2196f3'";}?> class="btn" href="<?php echo base_url();?>updates/category/<?php echo $news_category_id?>/<?php echo $category_name?>/<?php echo $i; ?>"><?php echo $i;?></a></li>
										<?php }?>										
								<?php }}?>	 
							</ul>
						</nav><!-- Pagination -->
					</ul><!-- Row -->
				</div><!-- Column -->
			</div><!-- Row -->	
		</div><!-- Container -->
	</div><!-- Page Default -->  
<?php 
 }
/* individual updates view page*/
else if($action=="view_news_details")
{
	foreach($result_individual_updated_News_article as $row_individual_updated_News_article)
	if($row_individual_updated_News_article["featured_image"]=='') {$image="no-image.jpg";} else{ $image=$row_individual_updated_News_article["featured_image"]; } 
	$url=str_replace(" ","-",$row_individual_updated_News_article["content_title"]);
	$url=preg_replace('/[^A-Za-z0-9\-]/', '', $url); 
	$url=strtolower($url);
?> 
<div class="page-header internalPages">
	<div class="container">
		<div class="row">
			<div class="col-xs-12"> 
				<div class="page-header-wrapper">  
					<h5 class="sub-title"><?php //echo $row_individual_updated_News_article["content_title"];?></h5>
					<ol class="breadcrumb">
						<li><a href="<?php echo base_url();?>">Home</a></li>
						<li><a href="<?php echo base_url();?>updates">Updates</a></li>
						<li><?php echo $row_individual_updated_News_article["content_title"];?></li>
					</ol><!-- Breadcrumb -->
				</div><!-- Page Header Wrapper -->
			</div><!-- Coloumn -->
		</div><!-- Row -->
	</div><!-- Container -->
</div><!-- Page Header -->  
<div role="main" class="main">
	<div class="page-default bg-grey typo-dark"> 
		<div class="container">
			<div class="row"> 
				<div class="col-md-3"> 
					<aside class="sidebar"> 
						<div class="widget">
							<h5 class="widget-title">Categories</h5>
							<div class="clearfix"></div>
							<ul class="go-widget">
							<?php
							$db10=$this->load->database("db10",true);
							$db10=$db10->database; 
							$this->db->order_by("category","ASC");
							$sql_category=$this->db->get("$db10.news_category");
							$res_category=$sql_category->result_array();
							foreach($res_category as $row_category)
							{
								$url=str_replace(" ","-",$row_category["category"]); 
								$url=preg_replace('/[^A-Za-z0-9\-]/','',$url);
								$url=strtolower($url);
								$this->db->where("news_category_id",$row_category["id"]);
								$sql_total_content=$this->db->get("$db10.news");
							?>
								<li><a href="<?php echo base_url();?>updates/category/<?php echo $row_category["id"]; ?>/<?php echo $url;?>"><?php echo ucwords($row_category["category"]); ?><span class="badge"><?php echo $sql_total_content->num_rows(); ?></span></a></li> 
							<?php } ?>	
							</ul>
						</div><!-- Widget -->  
						<div class="widget">
							<h5 class="widget-title">Latest Post</h5>
							<div class="clearfix"></div>
							<ul class="thumbnail-widget">
							<?php
								$db10=$this->load->database("db10",true);
								$db10=$db10->database;
								$this->db->select("news_id,featured_image,content_title");
								$this->db->from("$db10.news");
								$this->db->join("$db10.news_category",'news_category.id =news.news_category_id');
								$this->db->order_by("posted_date","DESC");	
								$this->db->where("status",1);
								$this->db->where("news_id!=",$row_individual_updated_News_article["news_id"]);
								$this->db->limit(10);
								$query_latest_post=$this->db->get();
								$res_latest_post=$query_latest_post->result_array();
								foreach($res_latest_post as $ros_latest_post)
								{
									if($ros_latest_post["featured_image"]=='') {$image_latest_post="no-image.jpg";} else{ $image_latest_post=$ros_latest_post["featured_image"]; } 
									$url=str_replace(" ","-",$ros_latest_post["content_title"]);
									$url=preg_replace('/[^A-Za-z0-9\-]/', '', $url); 
									$url=strtolower($url);
							?>	
								<li>
									<div class="thumb-wrap">
										<img alt="<?php echo $ros_latest_post["content_title"]; ?>" style="width:80px;height:80px;border: 1px solid #ccc;" src="<?php echo FILE_PATH; ?>uploads/news-article-event/thumbs/<?php echo $image_latest_post; ?>">
									</div>
									<div class="thumb-content"><a href="<?php echo base_url();?>updates/<?php echo $ros_latest_post["news_id"];?>/<?php echo $url;?>"><?php echo $ros_latest_post["content_title"]; ?></a></div>	
								</li> 
								<?php } ?>	
							</ul><!-- Thumbnail Widget -->
						</div><!-- Widget -->  
					</aside><!-- aside -->	
				</div><!-- Column --> 
				<div class="col-md-9">
					<div class="row"> 
						<div class="col-xs-12 blog-single">
							<div class="blog-single-wrap">
								<div class="blog-img-wrap" style="margin-top:0;">
									<img width="900" height="400" src="<?php echo FILE_PATH; ?>uploads/news-article-event/thumbs/<?php echo $image; ?>" class="img-responsive" alt="<?php echo $row_individual_updated_News_article["content_title"]; ?>">
								</div> 
								<div class="blog-single-details">
									<h1 style="font-size:30px"><?php echo  $row_individual_updated_News_article["content_title"];?></h1>
									<ul class="blog-meta"> 
										<li><i class="fa fa-folder"></i> <?php echo  $row_individual_updated_News_article["category"];?></li>
									</ul><!-- Blog Meta --> 
									<div class="clearfix"></div>
									<p><?php echo  $row_individual_updated_News_article["content_detail"];?></p>
								</div><!-- Blog Detail Wrapper -->
							</div><!-- Blog Wrapper --> 
							<div class="share" style="margin-top:0;">
								<h5>Share Post : </h5>
								<ul class="social-icons">
									<li class="facebook"><a href="http://www.facebook.com/" alt="facebook" target="_blank" title="Facebook">Facebook</a></li>
									<li class="twitter"><a href="http://www.twitter.com/" alt="twitter" target="_blank" title="Twitter">Twitter</a></li>
									<li class="linkedin"><a href="http://www.linkedin.com/" alt="linkedin" target="_blank" title="Linkedin">Linkedin</a></li>
									<li class="mail"><a href="http://www.gmail.com/" alt="gmail" target="_blank" title="mail">mail</a></li>
									<li class="googleplus"><a href="http://www.googleplus.com/" alt="googleplus" target="_blank" title="googleplus">googleplus</a></li>
									<li class="wordpress"><a href="http://www.wordpress.com/" alt="wordpress" target="_blank" title="wordpress">wordpress</a></li>
									<li class="instagram"><a href="http://www.instagram.com/" alt="instagram" target="_blank" title="instagram">instagram</a></li>
								</ul><!-- Blog Social Share -->
							</div><!-- Blog Share Post --> 
							<?php
								$db10=$this->load->database("db10",true);
								$db10=$db10->database;
								$this->db->select("featured_image,content_title,news_id");
								$this->db->from("$db10.news");
								$this->db->join("$db10.news_category",'news_category.id =news.news_category_id');
								$this->db->order_by("posted_date","DESC");	
								$this->db->where("status",1);
								$this->db->where("id",$row_individual_updated_News_article["id"]);
								$this->db->where("news_id!=",$row_individual_updated_News_article["news_id"]);
								$this->db->limit(10);
								$query_related_post=$this->db->get();
								if($query_related_post->num_rows() > 0) { echo '<h4>Related Post : </h4>'; }
							?>
							<div class="owl-carousel" 
								data-animatein="" 
								data-animateout="" 
								data-margin="30" 
								data-loop="true" 
								data-merge="true" 
								data-nav="true" 
								data-dots="false" 
								data-stagepadding="" 
								data-items="1" 
								data-mobile="1" 
								data-tablet="3" 
								data-desktopsmall="3"  
								data-desktop="3" 
								data-autoplay="true" 
								data-delay="3000" 
								data-navigation="true"> 
							<?php
								$res_related_post=$query_related_post->result_array();
								foreach($res_related_post as $ros_related_post)
								{
									if($ros_related_post["featured_image"]=='') {$image_related_post="no-image.jpg";} else{ $image_related_post=$ros_related_post["featured_image"]; } 
									$url=str_replace(" ","-",$ros_related_post["content_title"]);
									$url=preg_replace('/[^A-Za-z0-9\-]/', '', $url); 
									$url=strtolower($url);
							?>	
								<div class="item"> 
									<div class="related-wrap" style="height:270px;border:1px solid #ccc;background:#fff;"> 
										<div class="img-wrap">
											<img alt="<?php echo $ros_related_post["content_title"]; ?>" src="<?php echo FILE_PATH; ?>uploads/news-article-event/thumbs/<?php echo $image_related_post; ?>" style="width:100%;height:120px;">
										</div> 
										<div class="related-content">
											<a href="<?php echo base_url();?>updates/<?php echo $ros_related_post["news_id"];?>/<?php echo $url;?>" title="Read More"><?php echo $ros_related_post["content_title"]; ?></a>
										</div><!-- Related Content Wrapper -->
									</div><!-- Related Wrapper -->
								</div><!-- Item --> 
								<?php } ?>	
							</div><!-- Related Post -->
							<h4>Comments</h4>
						<ul class="comments">
						<?php 
						foreach($result_indiv_updated_News_article_cmnts as $row_indiv_cmnt)
						{
							if($row_indiv_cmnt["User_profile_pic"]==""){$image="no-image.jpg";} else {$image=$row_indiv_cmnt["User_profile_pic"];}
						?>
							<li> 
								<div class="comment">
									<div class="img-thumbnail">
										<img src="<?php echo FILE_PATH;?>uploads/users/thumbs/<?php echo $image;?>" alt="<?php echo $row_indiv_cmnt["User_fstname"].''.$row_indiv_cmnt["User_lstname"];?>" class="avatar img-responsive" height="80" width="80">
									</div>
									<div class="comment-block">
										<div class="comment-arrow"></div>
										<span class="comment-by">
											<strong>
											<?php 
											if($this->session->userdata("is_loged_in"))
											{
												if($this->session->userdata("myid")==$row_indiv_cmnt["User_id"])
												{
													$ansby="You";
												}
												else
												{ 
													$ansby=ucwords($row_indiv_cmnt["User_fstname"]).' '.ucwords($row_indiv_cmnt["User_lstname"]); 
												}
											}
											else
											{
												$ansby=ucwords($row_indiv_cmnt["User_fstname"]).' '.ucwords($row_indiv_cmnt["User_lstname"]);
											} 
													echo $ansby;
											?></strong> 
										</span><!-- Comment By -->
										<p><?php echo $row_indiv_cmnt["Ncomment_comment"];?></p>
										<span class="date pull-right"><?php echo $row_indiv_cmnt["Ncomment_replydate"];?></span>
									</div><!-- Comment Block -->
								</div><!-- Comment --> 
							</li><hr/>
						<?php } ?>	
						</ul><!-- Comments Full --> 
							<h5 style="text-align:left;">Post a comment</h5>
							<?php if($this->session->userdata("is_loged_in")){?>
								<span id="CmntMsg"></span> 
								<form method="post" name="CommentPost" action="" id="myForm">
									<div class="input-text form-group" style="margin-top:20px;">
										<input type="text" name="Ncomment_comment"  class="input-name form-control" placeholder="Comment Here">
										<b><span id="Ncomment_comment" style="color:red"></span></b>
									</div> 
									<input type="hidden" name="Ncomment_newsid" value="<?php echo $row_individual_updated_News_article["news_id"];?>">
									<center> <button type="button" onclick="return validateComment();" class="btn">Comment</button></center>
								</form>	 
							<?php } else {?>
									<br/>
									<center> <a href="<?php echo base_url();?>login?redirect=updates/<?php echo $row_individual_updated_News_article["news_id"];?>/<?php echo $url;?>" class="btn"><i class="fa fa-lock"></i> Login To Comment</button></a></center>
							<?php } ?>
						</div><!-- Column -->
					</div><!-- Row -->
				</div><!-- Column -->
			</div><!-- Row -->
		</div><!-- Container -->
	</div><!-- Page Default --> 
<?php	
	}
?>	