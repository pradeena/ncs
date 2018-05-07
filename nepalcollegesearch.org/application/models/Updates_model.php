<?php
defined ('BASEPATH') or exit('No Direct Script Allowed');
class Updates_model extends CI_Model
{
	/* List All updates with or without individual categories model function */
	public function list_updated_News_article($news_category_id,$pg)
	{ 
		$start_from = ($pg-1) * 10; 
		$end=$start_from+10; 
		$db10=$this->load->database("db10",true);
		$db10=$db10->database;
		$this->db->select("news_id,featured_image,content_title,posted_date,category,left(content_detail,150) as content_detail_half");
		$this->db->from("$db10.news");
		$this->db->join("$db10.news_category",'news_category.id =news.news_category_id');
		$this->db->order_by("posted_date","DESC");	
		$this->db->where("status",1);
		if($news_category_id!="")
		{
			$this->db->where("news_category_id",$news_category_id);
		}
		$this->db->limit($end,$start_from);
		$query_contents=$this->db->get();
		return $query_contents->result_array();
	}
	/*individual update model function  */
	public function list_individual_updated_News_article($news_id,$content_title)
	{
		$db10=$this->load->database("db10",true);
		$db10=$db10->database;
		$this->db->select("featured_image,content_title,meta_title,meta_description,category,content_title,news_id,content_detail,id,COUNT(news_id) as count");
		$this->db->from("$db10.news");
		$this->db->join("$db10.news_category",'news_category.id =news.news_category_id');
		$this->db->where("news_id",$news_id); 
		$query_contents=$this->db->get();
		return $query_contents->result_array();
	}
	/* List All updates with or without individual categories model function for total record found */
	public function do_total_recordfoundmodel($news_category_id)
	{
		$db10=$this->load->database("db10",true);
		$db10=$db10->database;
		if($news_category_id!="")
		{
			$this->db->where("news_category_id",$news_category_id);
		}	
		$this->db->where("status",1);
		$this->db->select("COUNT(content_title) as count");
		$this->db->from("$db10.news");		
		$this->db->limit(300);
		$query_total_record_found=$this->db->get(); 
		return $query_total_record_found->result_array();
	}
	/* list comments for individual update model function  */
	public function indiv_updated_News_article_cmnts_model($Ncomment_newsid)
	{
		$db1=$this->load->database("db1",true);
		$db1=$db1->database; 
		$db10=$this->load->database("db10",true);
		$db10=$db10->database; 
		$this->db->where("Ncomment_newsid",$Ncomment_newsid); 
		$this->db->order_by("Ncomment_replydate","DESC"); 
		$this->db->from("$db10.news_comment"); 
		$this->db->join("$db1.users","users.User_id=news_comment.Ncomment_userid"); 
		$query_list_cmnts=$this->db->get(); 
		return $query_list_cmnts->result_array();
	}
	/* submit comment for individual update model */
	public function submit_comment_model($Ncomment_comment,$Ncomment_newsid)
	{
		$db10=$this->load->database("db10",true);
		$db10=$db10->database; 
		$data=array(
			"Ncomment_newsid" => $Ncomment_newsid,
			"Ncomment_userid" => $this->session->userdata("myid"),
			"Ncomment_comment" => $Ncomment_comment
		);
		if($this->db->insert("$db10.news_comment",$data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}
?>	