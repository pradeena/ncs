<?php 
defined("BASEPATH") OR exit("No Direct Script Allowed");
class Updates extends CI_Controller
{
	 public function __construct()
	{
		parent::__construct();
		$this->load->model("updates_model");	
	} 
	/* List All updates for all categories*/
	public function index($pg=1)
	{    
		if(isset($_GET["action"]))
		{
			redirect(base_url()."page_not_found");
		} 
		$data["meta_title"]="Latest Update for All Colleges, Institute, Exam, Admission | NCS Online";
		$data["meta_description"]="Get all latest update for all Colleges, University, Institute, Exam, News, Admission of Nepal at Ncs Online.";
		$this->load->view("similar/header_view",$data); 
		$this->load->view("similar/menu_view"); 
		$data["action"]="list_updates"; 
		$data["pg"]=$pg;
		$data["news_category_id"]="";
		$data["result_updated_News_article"]=$this->updates_model->list_updated_News_article($news_category_id="",$pg);  
		$data["result_total_recordfound"]=$this->updates_model->do_total_recordfoundmodel($news_category_id=""); 
		$this->load->view("modules/updates_view",$data);  
		$this->load->view("similar/footer_view");   
	}  
	/* List individual update*/
	public function view_details($news_id,$content_title)
	{
		$data["action"]="view_news_details"; 
		$data["result_individual_updated_News_article"]=$this->updates_model->list_individual_updated_News_article($news_id,$content_title); 
		$data["result_indiv_updated_News_article_cmnts"]=$this->updates_model->indiv_updated_News_article_cmnts_model($news_id); 
		$result_individual_updated_News_article=$this->updates_model->list_individual_updated_News_article($news_id,$content_title); 
		foreach($result_individual_updated_News_article as $row_individual_updated_News_article)
		if($row_individual_updated_News_article["count"] < 1)
		{
			redirect(base_url().'index.php/page_not_found');
		}
		$data["meta_title"]=$row_individual_updated_News_article["meta_title"].' - NCS Online';
		$data["meta_description"]=$row_individual_updated_News_article["meta_description"];
		$this->load->view("similar/header_view",$data); 
		$this->load->view("similar/menu_view");  
		$this->load->view("modules/updates_view",$data);  
		$this->load->view("similar/footer_view"); 
	}
	/* List All updates with individual categories*/
	public function category($news_category_id="",$category_name,$pg=1)
	{ 
		$this->load->view("similar/header_view"); 
		$this->load->view("similar/menu_view"); 
		$data["action"]="list_updates"; 
		$data["pg"]=$pg;
		$data["news_category_id"]=$news_category_id;
		$data["category_name"]=$category_name;
		$data["result_updated_News_article"]=$this->updates_model->list_updated_News_article($news_category_id,$pg);  
		$data["result_total_recordfound"]=$this->updates_model->do_total_recordfoundmodel($news_category_id); 
		$this->load->view("modules/updates_view",$data);  
		$this->load->view("similar/footer_view");   
	}
}
?>