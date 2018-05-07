<?php 
defined("BASEPATH") OR exit("No Direct Script Allowed");
class Preference extends CI_Controller
{
	public function __construct()
	{
		parent::__construct(); 
		$this->load->model("preference_model");
	}  
	public function create()
	{   
		if($this->input->is_ajax_request()){
			$val = $this->input->post();
			if(empty($val))
			{
				echo "<b style='color:red'> Your preference is empty. select data you want to set as your preference</b>";
			}
			else
			{
				$faculty = (isset($val['faculty'])) ? json_encode($val['faculty']) : '';
				$university = (isset($val['university'])) ? json_encode($val['university']) : '';
				$district = (isset($val['district'])) ? json_encode($val['district']) : '';
				if($set = $this->preference_model->setPreference($faculty,$university,$district))
				{
					echo $set;
				} else {
					echo $set;
				}
			}
		}  
	}

}
?>