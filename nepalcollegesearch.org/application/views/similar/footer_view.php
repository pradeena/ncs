<?php
defined("BASEPATH") or exit("No Direct Script Allowed")
?> 
<!-- Footer -->
<footer id="footer" class="footer-1">
	<div class="main-footer typo-light" style="background:#E6E6E6; padding:10px 0;">
		<div class="container">
			<div class="row">
				<!-- Widget Column -->
				<div class="col-md-3 col-sm-3 col-xs-12 text-left mobile-center" style="border-right:1px solid #ccc">
					<a href="https://play.google.com/store/apps/details?id=org.campuskit.app"><img src="<?php echo base_url();?>assets/images/default/nbs-app.jpg" alt="nepalcollegesearch mobile app"></a>
				</div>
				<div class="col-md-5 col-sm-5 col-xs-12" style="border-right:1px solid #ccc">
					<p>Student Helpline No. : +977-55-521614
					<br>Email : info@nepalcollegesearch.org
					</p>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12">
					<div class="widget subscribe no-box" style="border:0;">
						<center></center>
						<center><b><span id="SUB_email" style="color:red"></span></b></center>
						<h5 class="widget-title" style="color:#111;margin-bottom:10px;line-height:100%;margin-top: 10px;">Subscribe to our Newsletter for latest updates</h5>
						<p class="form-message1" style="display: none;"></p>
						<div class="clearfix"></div> 
						<span id="subscribeMsg">
						</span>
						<form class="input-group subscribe-form" name="subForm" method="post"  onsubmit="return ValidatSubscribe();" id="myForm" action="">
							<div class="form-group has-feedback">
								<input class="form-control" style="height:35px;line-height:31px;padding-top:0;"  value="<?php echo $this->input->post("SUB_email"); ?>" type="email" placeholder="Subscribe" name="SUB_email" >
							</div>
							<span class="input-group-btn">
								<button type="submit" class="btn" style="height:33px;"><span class="glyphicon glyphicon-arrow-right" ></span></button>
							</span>
						</form> 
					</div><!-- Widget -->
				</div>
				
			</div><!-- Row -->
		</div><!-- Container -->		
	</div><!-- Main Footer --> 
	<!-- Footer Copyright -->
	<div class="footer-copyright">
		<div class="container">
			<div class="row">
				<!-- Copy Right Logo -->
				<div class="col-md-2 col-sm-2 col-xs-12 hidden-xs">
					<a class="logo" href="<?php echo base_url();?>">
						<img src="<?php echo base_url();?>assets/images/default/logo1.png" width="211" height="40"  class="img-responsive" alt="NepalCollegeSearch-logo">
					</a>
				</div><!-- Copy Right Logo -->
				<!-- Copy Right Content -->
				<div class="col-md-5 col-sm-5 col-xs-12">
					<p>&copy; Copyright <?php echo date("Y");?>. All Rights Reserved. | By <a href="<?php echo base_url();?>" title="CampusKit">CampusKit  </a></p>
				</div><!-- Copy Right Content -->
				<!-- Copy Right Content -->
				<div class="col-md-2 col-sm-2 col-xs-12">
					<div class="socialNetwork">
						<ul>
							<li class="fb"><a href="#"><img src="<?php echo base_url();?>assets/images/default/fb.jpg" alt="facebook" class="img-responsive"></a></li>
							<li class="tw"><a href="#"><img src="<?php echo base_url();?>assets/images/default/tw.jpg" alt="twitter" class="img-responsive"></a></li>
							<li class="gplus"><a href="#"><img src="<?php echo base_url();?>assets/images/default/gplus.jpg" alt="google plus" class="img-responsive"></a></li>
						</ul>
					</div>
				</div>
				
				<div class="col-md-3 col-sm-3 col-xs-12">
					<nav class="sm-menu">
						<ul>   
							<li><a href="<?php echo base_url();?>faqs">FAQ's</a></li> 
							<li><a href="<?php echo base_url();?>contact">Contact Us</a></li>
							<li><a href="<?php echo base_url();?>latest-update">Updates</a></li>
						</ul>
					</nav><!-- Nav -->
				</div><!-- Copy Right Content -->
			</div><!-- Footer Copyright -->
		</div><!-- Footer Copyright container -->
	</div><!-- Footer Copyright -->
</footer>
<!-- Footer --> 
<!-- library -->
<?php if(!isset($_GET["qryssss"])){ ?>
<script src="<?php echo base_url();?>assets/js/lib/jquery.js"></script>
<?php } ?>
<script src="<?php echo base_url();?>assets/js/lib/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/lib/bootstrapValidator.min.js"></script>
<script src="<?php echo base_url();?>assets/js/lib/jquery.appear.js"></script> 
<script src="<?php echo base_url();?>assets/js/lib/owl.carousel.min.js"></script>
<script src="<?php echo base_url();?>assets/js/lib/countdown.js"></script>
<script src="<?php echo base_url();?>assets/js/lib/counter.js"></script>
<script src="<?php echo base_url();?>assets/js/lib/isotope.pkgd.min.js"></script>
<script src="<?php echo base_url();?>assets/js/lib/jquery.easypiechart.min.js"></script>
<script src="<?php echo base_url();?>assets/js/lib/jquery.mb.YTPlayer.min.js"></script>
<script src="<?php echo base_url();?>assets/js/lib/jquery.prettyPhoto.js"></script>
<script src="<?php echo base_url();?>assets/js/lib/jquery.stellar.min.js"></script>
<script src="<?php echo base_url();?>assets/js/lib/menu.js"></script> 
<!-- Revolution Js -->
<script src="<?php echo base_url();?>assets/revolution/js/jquery.themepunch.tools.min.js?rev=5.0"></script>
<script src="<?php echo base_url();?>assets/revolution/js/jquery.themepunch.revolution.min.js?rev=5.0"></script>
<script src="<?php echo base_url();?>assets/js/lib/theme-rs.js"></script> 
<script src="<?php echo base_url();?>assets/js/lib/modernizr.js"></script>
<script src="<?php echo base_url();?>assets/js/lib/modernizr.js"></script>
<!-- Theme Base, Components and Settings -->
<script src="<?php echo base_url();?>assets/js/theme.js"></script>  
<script src="<?php echo base_url();?>assets/js/jquery.twbsPagination.js"></script>
<script type="text/javascript">
    $(function () {
        var obj = $('#pagination').twbsPagination({
            totalPages: 35,
            visiblePages: 10,
            onPageClick: function (event, page) {
                console.info(page);
            }
        });
    });
</script>

<script>
/* Validate Subscribe news letter */
function ValidatSubscribe()
{  
  var SUB_email=subForm.SUB_email.value;  
  SUB_email=SUB_email.trim();
  var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/; 
  if(SUB_email=="" || SUB_email==null)
  {
    document.getElementById("SUB_email").innerHTML="";
    subForm.SUB_email.focus();
    return false;
  }
  if(!filter.test(SUB_email))
  {
    document.getElementById("SUB_email").innerHTML="* Please Enter Valid Email.";
    subForm.SUB_email.focus();
    return false;
  }
  else 
  {
    document.getElementById("SUB_email").innerHTML="";
    $.post("<?php echo base_url();?>home/subscribeNewLetterAjax",{SUB_email:SUB_email},function(data){
      $("#subscribeMsg").html(data);
      $('#subscribeMsg').show();
    });
    setTimeout(resetForm, 3000);  
  }
  return false;
}
function resetForm(){
    $("form#myForm")[0].reset();
  $('#subscribeMsg').hide();  
}
jQuery(document).ready(function(){
  //$.noConflict();
    jQuery("#myBtn").click(function(){
        jQuery("#myModal").modal();
    });
});
</script>

<script src="<?php echo base_url();?>assets/js/jquery.easing.min.js"></script>
<script src="<?php echo base_url();?>assets/js/new-age.min.js"></script>
<?php if(isset($hide_primary_nav) and $hide_primary_nav=='1'){?>
<script>
jQuery(function(a){
	var e = function() {
       if ( a("#header").offset().top > 100  ) {
        a("#header").addClass("hide") 
        a("#secondNav").addClass("navbar-fixed-top") 
        }else{
            a("#header").removeClass("hide") 
            a("#secondNav").removeClass("navbar-fixed-top")
        }
    };
    e(), a(window).scroll(e)
})
</script>
<?php } ?>

</body>
</html>