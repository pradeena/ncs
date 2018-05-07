<?php
defined("BASEPATH") or exit("No Direct Script Allowed");
$action=isset($_REQUEST["action"]) ? $_REQUEST["action"]:"list_results";
?>
<div class="content-wrapper"> 
<?php 
if($action=="list_results")
{
?>
	<section class="content-header"> 
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li> 
				<li class="active">Results</li>
			</ol>
    </section> <br/> 
	<div class="container">  
		<section class="content">   	   
			<div class="row"> 
				<div class="col-md-14"> 
					<div class="box">
						<div class="box-header">  
							<h3 class="box-title"><b>List My Results Details</b></h3>  
						</div> 
						<div class="box-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>SrNo</th>
										<th>Test Type</th>
										<th>Roll Code</th> 
										<th>Test Name (Code)</th>
										<th>Start Time</th>  
										<th>End Time</th>          
										<th>Total Marks</th>          
										<th>Score</th>          
										<th>Test Assign Date</th>  
									</tr>
								</thead>
								<tbody> 
								<?php
								$SrNo=1;
								foreach($result_list_test_results as $row_list_test_results)
								{
								?>
									<tr>
										<td><?php echo $SrNo; $SrNo;?></td>  
										<td> <?php echo $row_list_test_results["Etype_name"]; ?> </td>           
										<td> <?php echo $row_list_test_results["Utest_usr_testcode"]; ?> </td>           
										<td>
											<?php echo $row_list_test_results["Eschedule_name"]; ?> (<?php echo $row_list_test_results["Eschedule_code"]; ?>)
										</td>     
										<td><?php echo $row_list_test_results["Utest_start_time"]; ?></td>     
										<td><?php echo $row_list_test_results["Utest_end_time"]; ?></td>     
										<td><?php echo $row_list_test_results["Eschedule_total_marks"]; ?></td>     
										<td><?php echo $row_list_test_results["Eresult_score"]; ?></td>      
										<td><?php echo $row_list_test_results["Utest_regdate"]; ?></td>      
									</tr> 
								<?php }?>	
								</tbody>
							</table>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
				</div>
			</div>
		</section>
	</div>	
<?php 
}?>	
</div>