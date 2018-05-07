<?php
defined("BASEPATH") or exit("No Direct Script Allowed");  
$action=isset($_REQUEST["action"]) ? $_REQUEST["action"]:"list_library_issue_details";
?>
<script>
function searchbookinventory_validate()
{
	var search_keyword=searchBook.search_keyword.value;
	search_keyword=search_keyword.trim();
	if(search_keyword=="" || search_keyword==null)
	{ 
		document.getElementById("search_keyword").innerHTML="";
		searchBook.search_keyword.focus();
        return false;
	} 
}
</script>
<div class="content-wrapper">
<?php 
if($action=="list_library_issue_details")
{
?>
	<section class="content-header"> 
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li> 
			<li class="active">My Library</li>
		</ol> 
	</section><br/> 
	<div class="container">  
		<section class="content">   	   
			<div class="row"> 
				<div class="col-md-14"> 
					<div class="box">
						<div class="box-header">  
							<h3 class="box-title"><b>List Library Issue Books Details</b></h3> 
						</div> 
						<div class="box-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>SrNo</th>
										<th>Image</th>
										<th>Book Name (ISBN)</th>  
										<th>Requested Date</th>
										<th>Issue Date</th> 
										<th>Issue Till Date</th>
										<th>Approve By</th> 
										<th>Status</th>   
										<th>Action</th>  
									</tr>
								</thead>
								<tbody>
								<?php  
								$SrNo=1;
								foreach($result_library_issue_books as $row_library_issue_books)
								{  
									$bokid=$row_library_issue_books["Bok_id"];
									$db6=$this->load->database("db6",true);
									$db6=$db6->database;
									$this->db->select("*,COUNT(*) as imgcount"); 					
									$this->db->where("Bimg_bookid",$bokid); 					
									$this->db->where("Bimg_shorting",'1');
									$result_image=$this->db->get("$db6.books_images");
									$row_image=$result_image->row();
									if($row_image->imgcount==0){ $image="no-image.jpg"; }
									else { $image=$row_image->Bimg_name; }
								?>
									<tr>
										<td><?php echo $SrNo; $SrNo++;?></td>
										<td>
											<img src="<?php echo base_url(); ?>admin/uploads/modules/central_library/books/thumbs/<?php echo $image; ?>" class="img-circle" width="50px" alt="<?php echo $image; ?>" />  
										</td>
										<td>
											<?php echo $row_library_issue_books["Bok_name"]; ?> ( <?php echo $row_library_issue_books["Bok_isbn"]; ?> )
										</td> 
										<td> <?php echo $row_library_issue_books["CLissued_request_date"]; ?> </td> 
										<td>  
											<?php if($row_library_issue_books["CLissued_approved_by"]==0) { echo 'Pending For Approval'; } else {?>
											<?php echo $row_library_issue_books["CLissued_issue_date"]; }?> 
										</td>
										<td>
											<?php if($row_library_issue_books["CLissued_approved_by"]==0) { echo 'Pending For Approval'; } else {?>
											<?php 
												echo $row_library_issue_books["CLissued_issued_till"],'<br/>'; 
												if($row_library_issue_books["CLissued_issued_till"] > date('Y-m-d'))
												{
													$current_date=date('Y-m-d');
													$diff=strtotime($row_library_issue_books["CLissued_issued_till"])-strtotime($current_date); 
													$temp=$diff/86400; // 60 sec/min*60 min/hr*24 hr/day=86400 sec/day
													$days=floor($temp); 
													echo '<b style="color:green">'.$days.' Days Remaining</b>';
												}
												else 
												{
													$current_date=date('Y-m-d');
													$diff=strtotime($current_date)-strtotime($row_library_issue_books["CLissued_issued_till"]); 
													$temp=$diff/86400; // 60 sec/min*60 min/hr*24 hr/day=86400 sec/day
													$days=floor($temp); 
													echo '<b style="color:red">Expired '.$days.' Days Ago</b>';
												}													
											}?> 
										</td>
										<td> 
											<?php if($row_library_issue_books["CLissued_approved_by"]==0) { echo 'Pending For Approval'; } else {?>
											<?php echo ucwords($row_library_issue_books["User_fstname"]).' '.ucwords($row_library_issue_books["User_lstname"]); }?> 
										</td>
										<td> 
											<?php if($row_library_issue_books["CLissued_status"]==0) { echo "Pending";} else {echo 'Approved';}?> 
										</td> 
										<td><a href="<?php echo base_url();?>my_library?action=view_issue_book_details&clgeliid=<?php echo $row_library_issue_books["CLissued_id"]?>" class="btn btn-info"><i class="fa fa-eye"></i></a></td>
									</tr>
								<?php } ?> 
								</tbody>
							</table>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
				</div>
			</div>
		</section>
	</div>	
<?php	
}
elseif($action=="view_issue_book_details")
{	
	if((!is_numeric($_GET["clgeliid"])))
	{
		redirect(base_url().'page_not_found');
	}
	foreach($result_individual_library_issue_book as $row_individual_library_issue_book)
	if($row_individual_library_issue_book["count"] < 1)
	{
		redirect(base_url().'page_not_found');
	}
	else
	{  
?>
	<section class="content-header"> 
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li> 
			<li><a href="<?php echo base_url(); ?>my_library">My Library</a></li>
			<li class="active">View Issue Book Details</li>
		</ol> 
	</section><br/> 
	<div class="container">  
		<section class="content">   	   
			<div class="row"> 
				<div class="col-md-14"> 
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs pull-right">
							<li><a href="#inventory_location" data-toggle="tab"><b>Inventory Location</b></a></li> 
							<li class="active"><a href="#issue_details" data-toggle="tab"><b>Book Issue Details</b></a></li> 
							<li class="pull-left header">
								<i class="fa fa-bank"></i> View Library Issue Book Details 
							</li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane" id="inventory_location">
								<div class="box"> 
									<div class="box-body">
										<table id="example2" class="table table-bordered table-striped">
											<thead>
												<tr>
													<th>SrNo</th>
													<th>Branch</th> 
													<th>Room</th> 
													<th>Rack</th>  
													<th>Shelf</th> 
													<th>Assigned Date</th> 
												</tr>
											</thead>
											<tbody>
											<?php 
											$SrNo=1;  
											foreach($result_issue_book_inventory_location as $row_issue_book_inventory_location)	
											{ 
											?>
												<tr>
													<td><?php echo $SrNo; $SrNo++; ?></td>  
													<td>
														<?php echo ucwords($row_issue_book_inventory_location["Branch_name"]).'( '.$row_issue_book_inventory_location["Branch_code"].' )'; ?>
													</td> 
													<td>
														<?php echo $row_issue_book_inventory_location["Room_name"].' ( '.$row_issue_book_inventory_location["Room_code"].' )'; ?>
													</td> 
													<td>
														<?php echo $row_issue_book_inventory_location["Rack_name"].' ( '.$row_issue_book_inventory_location["Rack_code"].' )'; ?>
													</td>    
													<td>
														<?php echo $row_issue_book_inventory_location["Shelf_name"].' ( '.$row_issue_book_inventory_location["Shelf_code"].' )'; ?>
													</td>     
													<td>
														<?php echo $row_issue_book_inventory_location["BILocation_created_date"]; ?>
													</td>    
												</tr> 
											<?php } ?>	
											</tbody> 
										</table>
									</div><!-- /.box-body -->
								</div><!-- /.box -->
							</div>   
							<div class="tab-pane active" id="issue_details"> 
								<div class="box"> 
									<div class="box-body">
										<table class="table table-bordered table-striped">
											<thead> 
												<tr>
													<th style="background:lightgray">Book Image</th>
													<th>
														<?php 
															$bokid=$row_individual_library_issue_book["Bok_id"];
															$db6=$this->load->database("db6",true);
															$db6=$db6->database;
															$this->db->select("*,COUNT(*) as imgcount"); 					
															$this->db->where("Bimg_bookid",$bokid); 					
															$this->db->where("Bimg_shorting",'1');
															$result_image=$this->db->get("$db6.books_images");
															$row_image=$result_image->row();
															if($row_image->imgcount==0){ $image="no-image.jpg"; }
															else { $image=$row_image->Bimg_name; }
														?> 
														<img src="<?php echo base_url(); ?>admin/uploads/modules/central_library/books/thumbs/<?php echo $image; ?>" class="img-circle" width="50px" alt="<?php echo $image; ?>" />
													</th>  
												</tr>
												<tr>
													<th style="background:lightgray">Book Name</th>
													<th>
														<?php echo ucwords($row_individual_library_issue_book["Bok_name"]);?> 
													</th>  
												</tr>
												<tr>
													<th style="background:lightgray">Requested Date</th>
													<th>
														<?php echo $row_individual_library_issue_book["CLissued_request_date"];?> 
													</th>  
												</tr>
												<tr>
													<th style="background:lightgray">Issue Date</th>
													<th>
														<?php if($row_individual_library_issue_book["CLissued_approved_by"]==0) { echo 'Pending For Approval'; } else {?>
														<?php echo $row_individual_library_issue_book["CLissued_issue_date"]; }?>  
													</th>  
												</tr>
												<tr>
													<th style="background:lightgray">Issued Till Date</th>
													<th>
														<?php if($row_individual_library_issue_book["CLissued_approved_by"]==0) { echo 'Pending For Approval'; } else {?>
														<?php 
														if($row_individual_library_issue_book["CLissued_issued_till"] > date('Y-m-d'))
														{
															$current_date=date('Y-m-d');
															$diff=strtotime($row_individual_library_issue_book["CLissued_issued_till"])-strtotime($current_date); 
															$temp=$diff/86400; // 60 sec/min*60 min/hr*24 hr/day=86400 sec/day
															$days=floor($temp); 
															echo '<b style="color:green">'.$days.' Days Remaining</b>';
														}
														else 
														{
															$current_date=date('Y-m-d');
															$diff=strtotime($current_date)-strtotime($row_individual_library_issue_book["CLissued_issued_till"]); 
															$temp=$diff/86400; // 60 sec/min*60 min/hr*24 hr/day=86400 sec/day
															$days=floor($temp); 
															echo '<b style="color:red">Expired '.$days.' Days Ago</b>';
														}
														}?> 
													</th>  
												</tr>
												<tr>
													<th style="background:lightgray">Approve By</th>
													<th>
														<?php if($row_individual_library_issue_book["CLissued_approved_by"]==0) { echo 'Pending For Approval'; } else {?>
														<?php echo ucwords($row_individual_library_issue_book["User_fstname"]).' '.ucwords($row_individual_library_issue_book["User_lstname"]); }?> 
													</th>  
												</tr>
												<tr>
													<th style="background:lightgray">Library Status</th>
													<th>
														<?php if($row_individual_library_issue_book["CLissued_status"]==0) { echo "Pending";} else {echo 'Approved';}?>  
													</th>  
												</tr>
												<tr>
													<th style="background:lightgray">Librarian Comment</th>
													<th>
														<?php if($row_individual_library_issue_book["CLissued_approved_by"]==0) { echo 'Pending For Approval'; } else {?>
														<?php echo $row_individual_library_issue_book["CLissued_comment"]; }?>  
													</th>  
												</tr> 
												<tr>
													<th style="background:lightgray">Book Total Quantity</th>
													<th>
														<?php echo $row_individual_library_issue_book["CBinv_qty"];?>  
													</th>  
												</tr>
												<tr>
													<th style="background:lightgray">Available Quantity</th>
													<th>
														<?php echo $row_individual_library_issue_book["CBinv_available_qty"];?>  
													</th>  
												</tr>
											</thead> 
										</table>
									</div><!-- /.box-body -->
								</div><!-- /.box -->
							</div> 
						</div> 
					</div> 
				</div>
			</div>	
		</section>
	</div>			
<?php
	}	
}
elseif($action=="list_library_issued_history")
{
?>
	<section class="content-header"> 
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li> 
			<li><a href="<?php echo base_url(); ?>my_library">My Library</a></li>
			<li class="active">List Book Issued History</li>
		</ol> 
	</section><br/> 
	<div class="container">  
		<section class="content">   	   
			<div class="row"> 
				<div class="col-md-14"> 
					<div class="box">
						<div class="box-header">  
							<h3 class="box-title"><b>List Library Issued Books History Details</b></h3> 
						</div> 
						<div class="box-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>SrNo</th>
										<th>Image</th>
										<th>Book Name (ISBN)</th>  
										<th>Requested Date</th>
										<th>Issue Date</th> 
										<th>Issue Till Date</th>
										<th>Receive Date</th>
										<th>Total Fine</th>
										<th>Fine Received</th>
										<th>Fine Concession</th>
										<th>Librarian Comment</th>
										<th>Approve By</th> 
									</tr>
								</thead>
								<tbody>
								<?php  
								$SrNo=1;
								foreach($result_library_issued_history as $row_lissued_history)
								{  
									$bokid=$row_lissued_history["Bok_id"];
									$db6=$this->load->database("db6",true);
									$db6=$db6->database;
									$this->db->select("*,COUNT(*) as imgcount"); 					
									$this->db->where("Bimg_bookid",$bokid); 					
									$this->db->where("Bimg_shorting",'1');
									$result_image=$this->db->get("$db6.books_images");
									$row_image=$result_image->row();
									if($row_image->imgcount==0){ $image="no-image.jpg"; }
									else { $image=$row_image->Bimg_name; }
								?>
									<tr>
										<td><?php echo $SrNo; $SrNo++;?></td>
										<td>
											<img src="<?php echo base_url(); ?>admin/uploads/modules/central_library/books/thumbs/<?php echo $image; ?>" class="img-circle" width="50px" alt="<?php echo $image; ?>" />  
										</td>
										<td>
											<?php echo $row_lissued_history["Bok_name"]; ?> ( <?php echo $row_lissued_history["Bok_isbn"]; ?> )
										</td> 
										<td> <?php echo $row_lissued_history["CLIhistory_request_date"]; ?> </td> 
										<td> <?php echo $row_lissued_history["CLIhistory_issue_date"]; ?> </td>
										<td> <?php echo $row_lissued_history["CLIhistory_issued_till"]; ?> </td>
										<td> <?php echo $row_lissued_history["CLIhistory_receive_date"]; ?> </td>
										<td> <?php echo $row_lissued_history["CLIhistory_fine"]; ?> </td>
										<td> <?php echo $row_lissued_history["CLIhistory_fine_paid"]; ?> </td>
										<td> <?php echo $row_lissued_history["CLIhistory_concession"]; ?> </td>
										<td> <?php echo $row_lissued_history["CLIhistory_comment"]; ?> </td>
										<td> 
											<?php echo ucwords($row_lissued_history["User_fstname"]).' '.ucwords($row_lissued_history["User_lstname"]); ?> 
										</td> 
									</tr>
								<?php } ?> 
								</tbody>
							</table>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
				</div>
			</div>
		</section>
	</div>	
<?php	
}
elseif($action=="issue_new_book")
{
?>
	<section class="content-header"> 
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li> 
			<li><a href="<?php echo base_url(); ?>my_library">My Library</a></li>
			<li class="active">Issue New Book</li>
		</ol> 
	</section><br/> 
	<div class="container">  
		<section class="content">   	   
			<div class="row"> 
				<div class="col-md-14">  
					<div class="login-box">
						<div class="login-box-body">
							<p class="login-box-msg"><b>Search Book Inventory By ISBN , Name , Publisher , Author , category , Type , Library Branch Etc. </b></p>
							<p><?php if(isset($msg)) echo $msg; ?> </p>
							<form  name="searchBook" action="" method ="post" onsubmit="return searchbookinventory_validate();">
								<input type="hidden" name="do_search_book_inventory" value="true">
								<div class="input-group input-group-sm">
									<input class="form-control" type="text" name="search_keyword" placeholder="search book here" value="<?php echo $this->input->post("search_keyword"); ?>">
									<span class="input-group-btn">
										<button class="btn btn-info btn-flat" name="search_book_inventory" type="submit"><b><i class="fa fa-search"></i> </b></button>
									</span>
								</div>
								<span id="search_keyword"></span>
							</form> 
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	<?php if(isset($_POST["search_book_inventory"])){ ?>
	<div class="container">  
		<section class="content">   	   
			<div class="row"> 
				<div class="col-md-14">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">Search Result for <b style="color:red"><?php echo $this->input->post("search_keyword"); ?></b></h3> 
						</div><!-- /.box-header -->
						<div class="box-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>SrNo</th>
										<th>Book Image</th>
										<th>Name(ISBN)</th>  
										<th>Edition</th>  
										<th>Branch</th>  
										<th>Total/Available Quantity</th> 
										<th>Book Author</th> 
										<th>Book Publisher</th> 
										<th>Inventory Status</th> 
										<th>Action</th> 
									</tr>
								</thead>
								</thead>
								<tbody>
								<?php 
								$SrNo=1;
								foreach($result_inout_limit as $row_inout_limit)
								foreach($result_book_search_inventory as $row_book_search_inventory)	
								{
									if($row_book_search_inventory["CBinv_status"]==1){ $status="Active"; } else { $status="Inactive"; }
									$bokid=$row_book_search_inventory["Bok_id"];
									$db6=$this->load->database("db6",true);
									$db6=$db6->database;
									$this->db->select("*,COUNT(*) as imgcount"); 					
									$this->db->where("Bimg_bookid",$bokid);  
									$result_image=$this->db->get("$db6.books_images");
									$row_image=$result_image->row();
									if($row_image->imgcount==0){ $image="no-image.jpg"; }
									else { $image=$row_image->Bimg_name; }
								?>
									<tr>
										<td><?php echo $SrNo; $SrNo++; ?></td>
										<td>
											<img src="<?php echo base_url(); ?>admin/uploads/modules/central_library/books/thumbs/<?php echo $image; ?>" class="img-circle" width="50px" alt="<?php echo $image; ?>" />  
										</td>  
										<td>
											<?php echo $row_book_search_inventory["Bok_name"].' ('.$row_book_search_inventory["Bok_isbn"]; ?> )
										</td> 
										<td><?php echo $row_book_search_inventory["Bok_edition"]; ?></td>
										<td>
											<?php echo $row_book_search_inventory["Branch_name"].' ('.$row_book_search_inventory["Branch_code"]; ?> )
										</td>
										<td>
											<?php echo $row_book_search_inventory["CBinv_qty"]; ?> / <?php echo $row_book_search_inventory["CBinv_available_qty"]; ?>
										</td>   
										<td>
											<?php echo $row_book_search_inventory["Bauthor_name"]; ?>
										</td> 
										<td>
											<?php echo $row_book_search_inventory["Bpub_name"]; ?>
										</td> 										
										<td><?php echo $status; ?></td>  
										<td>
											<?php  	
												if($row_inout_limit["count"] >= $row_inout_limit["Clgecourse_libraryinout_limit"]){ echo "Library Inout Limit Exceed"; }
												elseif($row_book_search_inventory["CBinv_status"]==1) { ?>
												<?php if($row_book_search_inventory["CBinv_available_qty"] > 0) { ?>
												<a href="<?php echo base_url();?>my_library/send_bookissue_request?invid=<?php echo $row_book_search_inventory["CBinv_id"];?>" class="btn btn-info">Send Request</i>
												</a> 
											<?php } else { echo "Out Of Stock";}?>
											<?php } else { echo "Currently Inactive .";}?>
										</td>   
									</tr> 
								<?php } ?>	
								</tbody> 
							</table>
						</div><!-- /.box-body -->
					</div><!-- /.box --> 
				</div>
			</div>
		</section>
	</div>
	<?php } ?> 
<?php	
}
?>
</div>	