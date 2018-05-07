<?php
defined("BASEPATH") or exit("No Direct Script Allowed");
foreach($result_user_details as $row_user_details)
if($row_user_details["User_profile_pic"]==''){$image="no-image.jpg";} else {$image=$row_user_details["User_profile_pic"];}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>NBSOnline | Nepal Online Education Management System</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url();?>includes/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" /><!-- DATA TABLES -->
    <link href="<?php echo base_url(); ?>./includes/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url();?>includes/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>includes/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>includes/plugins/fullcalendar/fullcalendar.print.css" rel="stylesheet" type="text/css" media="print" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url();?>includes/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="<?php echo base_url(); ?>/includes/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="<?php echo base_url(); ?>includes/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="<?php echo base_url(); ?>includes/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="<?php echo base_url(); ?>includes/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="<?php echo base_url(); ?>includes/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="<?php echo base_url(); ?>includes/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
<!-- Bootstrap Color Picker -->
    <link href="<?php echo base_url(); ?>includes/plugins/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap time Picker -->
    <link href="<?php echo base_url(); ?>includes/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
    <!-- Select2 -->
    <link href="<?php echo base_url(); ?>includes/plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />
	
<!-- Script For Input type date which not support in firefox-->
<script src="http://cdn.jsdelivr.net/webshim/1.12.4/extras/modernizr-custom.js"></script>
<script src="http://cdn.jsdelivr.net/webshim/1.12.4/polyfiller.js"></script>
<script>
webshims.setOptions('waitReady', false);
webshims.setOptions('forms-ext', {types: 'date'});
webshims.polyfill('forms forms-ext');
</script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style>
      .example-modal .modal {
        position: relative;
        top: auto;
        bottom: auto;
        right: auto;
        left: auto;
        display: block;
        z-index: 1;
      }
      .example-modal .modal {
        background: transparent!important;
      }
    </style>
  </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="skin-blue layout-top-nav">
    <div class="wrapper">

      <header class="main-header">
        <nav class="navbar navbar-static-top">
          <div class="container">
            <div class="navbar-header">
              <a href="#" class="navbar-brand"><b> <i class="fa fa-bank"></i> NBSOnline</b></a>
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <i class="fa fa-bars"></i>
              </button>
			  <?php 
					$db3=$this->load->database("db3",true);
					$db3=$db3->database;
					$db9=$this->load->database("db9",true);
					$db9=$db9->database;
					$this->db->select("*");
					$this->db->from("$db9.users_test");
					$this->db->join("$db9.exam_schedule",'exam_schedule.Eschedule_id=users_test.Utest_exmschedule_id');
					$this->db->join("$db9.exam_name",'exam_name.Ename_id=exam_schedule.Eschedule_examnameid');
					$this->db->join("$db3.college",'college.Clge_id=exam_name.Ename_clgeid');
					$this->db->where("Utest_userid",$this->session->userdata("myid"));
					//$this->db->where("Eschedule_status",1);
					$query_schedule=$this->db->get();
					$result_exam_schedule=$query_schedule->result_array();
					foreach($result_exam_schedule as $row_exam_schedule) 
				?>
				<a href="#" class="navbar-brand"><?php echo "<b>".'[ '. $row_exam_schedule["Clge_name"].'</>'." ]".'   '.$row_exam_schedule["Ename_name"].' |  '."";?><?php echo "Good Luck".'  '.ucwords($row_user_details["User_fstname"]).' '.ucwords($row_user_details["User_lstname"]);?></a>
            </div>
          </div><!-- /.container-fluid -->
        </nav>
      </header>