<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_not_found extends CI_Controller { 
	public function index()
	{
		$data["meta_title"]="Nepal College Search - colleges , universities, study in nepal , record not found , page not found";
		$this->load->view("similar/header_view",$data);
		$this->load->view("similar/menu_view"); 
		$this->load->view('page_not_found_view'); 
		$this->load->view("similar/footer_view"); 
	}
}
?>