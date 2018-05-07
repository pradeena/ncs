<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Dashboard extends CI_Controller { 
	public function index()
	{
		$this->load->view("modules/free_users_view/common/header");
		$this->load->view("modules/free_users_view/common/menu");
		$this->load->view("modules/free_users_view/home");
		$this->load->view("modules/free_users_view/common/footer");
	}	
}
?>