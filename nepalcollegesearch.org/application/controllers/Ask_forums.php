<?php
defined("BASEPATH") or exit("No Direct Script Allowed");
class Ask_forums extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("forums_model");
	}
	/* ask forum */
	public function index()
	{
		$data["meta_title"]="Nepal College Search - Ask Forums ";
		$this->load->view("similar/header_view",$data);
		$this->load->view("similar/menu_view");
		$data["action"]="ask_forum_qus";   
		$this->load->view("modules/forums_view",$data);  
		$this->load->view("similar/footer_view"); 
	}
}
?>