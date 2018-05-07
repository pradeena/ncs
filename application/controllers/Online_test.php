<?php 
defined("BASEPATH") OR exit("No Direct Script Allowed");
class Online_test extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("common/loggedin_user_info_model"); 
		$this->load->model("common/online_test_model"); 
	}	 
	public function index()
	{ 
		if($this->session->userdata("is_loged_in"))
		{  
			if($result_user_details=$this->loggedin_user_info_model->user_details_model())
			{  	  
				
				$data["result_user_details"]=$this->loggedin_user_info_model->user_details_model();  
				$data["result_user_test"]=$this->online_test_model->user_test_model();
				if(isset($_POST["verify_test_code"]) && $_POST["do_verify_test_code"]=="true")
				{ 
					if($this->online_test_model->verify_test_code_model())
					{
						$data["msg"]="<img height='30' width='30' src='".base_url()."img/a1.png'><span style='color:green'> Verified</span><meta http-equiv='refresh' content='1;url=".base_url()."online_test?action=proceed&test_id=".$this->input->get('test_id')."'>";
					}
					else
					{
						$data["msg"]="<img height='30' width='30' src='".base_url()."img/a2.png'><span style='color:red'> Invalid Test Code. Please Try Again</span>";
					}
				}	
				$this->load->view("common/header_view",$data);  
				$this->load->view("common/online_test_view"); 
				$this->load->view("common/footer_view");
			}
			else
			{
				$this->session->sess_destroy();
					redirect(base_url()."login");
			}  
		}
		else
		{
			$this->session->sess_destroy();
			redirect(base_url()."login");
		} 
	} 
	public function get_instruction()
	{
		$Utest_id=$this->input->post("Utest_id"); 
		$result_get_instruction=$this->online_test_model->get_instruction_model($Utest_id);
		foreach($result_get_instruction as $row_get_instruction)
		if($row_get_instruction["Eschedule_status"]==1){$status="Active"; }else {$status="Inactive";}
		if($row_get_instruction["Eschedule_test_enable"]==1){$enable="ON"; }else {$enable="OFF";}
	?>  
		<hr/><h4><i class="fa fa-newspaper-o"></i> INSTRUCTIONS :</h4>   
		<?php echo $row_get_instruction["Eschedule_instruction"];?><hr/>  
		<center><p><b>TEST TIME TABLE<b></p></center> 
		<table  class="table table-bordered table-striped">
		<thead>
		<tr><th><b>Start Time</b> </th><th><i><?php echo $row_get_instruction["Eschedule_startdate"];?></i></th></tr>
		<tr><th><b>End Time</b> </th><th><i><?php echo $row_get_instruction["Eschedule_enddate"];?></i></th></tr>
		<tr><th><b>Test Duration</b> </th><th><i><?php echo $row_get_instruction["Eschedule_minutes"];?> Minutes</i></th></tr>
		<tr><th><b>Total QUestions</b> </th><th><i><?php echo $row_get_instruction["Eschedule_total_questions"];?></i></th></tr>
		<tr><th><b>Total Marks</b> </th><th><i><?php echo $row_get_instruction["Eschedule_total_marks"];?></i></th></tr>
		<tr><th><b>Test Status</b> </th><th><i><?php echo $status;?></i></th></tr>
		<tr><th><b>Test Enable</b> </th><th><i><?php echo $enable;?></i></th></tr>
		</thead>
		</table>
		<?php if(($row_get_instruction["Utest_status"]==1) && ($row_get_instruction["Eschedule_status"]==1) && ($row_get_instruction["Eschedule_test_enable"]==1)){?> 
		<center>
			<small> 
				<a href="<?php echo base_url();?>online_test?action=verify_test_code&test_id=<?php  echo $row_get_instruction["Utest_id"];?>" class="btn btn-info">Proceed</a>
			</small>
		</center>
		<?php }else{ echo "<hr/>NOTE: <b style='color:red'><i>You Are Currently Inactive For This Test.Please Contact Your Examination Officer For Test Activation Then You Will Able To Proceed</i></b>";?>	
		<center>
			<small> 
				<input type="button" class="btn btn-info" value="PROCEED" disabled>
			</small>
		</center> 
		<?php }?>
	
<?php	
	}
}
?>