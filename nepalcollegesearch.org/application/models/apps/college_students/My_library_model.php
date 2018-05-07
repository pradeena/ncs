<?php
defined("BASEPATH") or exit("No Direct Script Allowed");
class My_library_model extends CI_Model
{
	public function inout_limit_model()
	{
		$db7=$this->load->database("db7",true);
		$db7=$db7->database;
		$db3=$this->load->database("db3",true);
		$db3=$db3->database;
		$this->db->select("*,COUNT(*) as count");
		$this->db->from("$db7.college_library_issued cli");
		$this->db->join("$db7.college_branch_inventory cbi","cbi.CBinv_id=cli.CLissued_invid");
		$this->db->join("$db3.college_students cstd","cstd.Clge_std_user_id=cli.CLissued_userid");  
		$this->db->join("$db3.college_courses cc","cc.Clgecourse_id=cstd.Clge_std_clgecourse_id"); 
		$this->db->where("CLissued_userid",$this->session->userdata("myid")); 
		$query_inout_limit=$this->db->get();
		return $query_inout_limit->result_array();
	}
	public function library_issue_books_model()
	{
		$db1=$this->load->database("db1",true);
		$db1=$db1->database;
		$db6=$this->load->database("db6",true);
		$db6=$db6->database;
		$db7=$this->load->database("db7",true);
		$db7=$db7->database;
		$this->db->from("$db7.college_library_issued cli");
		$this->db->join("$db1.users usr","usr.User_id=cli.CLissued_approved_by",'left'); 
		$this->db->join("$db7.college_branch_inventory cbi","cbi.CBinv_id=cli.CLissued_invid"); 
		$this->db->join("$db6.books bok","bok.Bok_id=cbi.CBinv_bookid");
		$this->db->where("CLissued_userid",$this->session->userdata("myid"));  
		$this->db->order_by("CLissued_request_date","DESC");
		$query_libooks=$this->db->get();
		return $query_libooks->result_array();
	}
	public function individual_library_issue_book_model()
	{
		$db1=$this->load->database("db1",true);
		$db1=$db1->database;
		$db6=$this->load->database("db6",true);
		$db6=$db6->database;
		$db7=$this->load->database("db7",true);
		$db7=$db7->database;
		$this->db->select("*, COUNT(*) as count");
		$this->db->from("$db7.college_library_issued cli");
		$this->db->join("$db1.users usr","usr.User_id=cli.CLissued_approved_by",'left'); 
		$this->db->join("$db7.college_branch_inventory cbi","cbi.CBinv_id=cli.CLissued_invid"); 
		$this->db->join("$db6.books bok","bok.Bok_id=cbi.CBinv_bookid");
		$this->db->where("CLissued_id",$this->input->get("clgeliid")); 
		$this->db->where("CLissued_userid",$this->session->userdata("myid"));  
		$query_individual_libooks=$this->db->get();
		return $query_individual_libooks->result_array();
	}
	public function issue_book_inventory_location_model()
	{
		$db6=$this->load->database("db6",true);
		$db6=$db6->database;
		$db7=$this->load->database("db7",true);
		$db7=$db7->database; 
		$this->db->from("$db7.college_library_issued cli");
		$this->db->join("$db7.college_branch_inventory cbi","cbi.CBinv_id=cli.CLissued_invid"); 
		$this->db->join("$db7.branch_inventory_location bil","bil.BILocation_inventoryid=cbi.CBinv_id");
		$this->db->join("$db7.college_library_branch clb","clb.CLbranch_id=cbi.CBinv_clbid");
		$this->db->join("$db6.branches","branches.Branch_id=clb.CLbranch_branchid");
		$this->db->join("$db6.rack_shelf","rack_shelf.Shelf_id=bil.BILocation_shelf_id");
		$this->db->join("$db6.room_racks","room_racks.Rack_id=rack_shelf.Shelf_rack_id");
		$this->db->join("$db6.branch_rooms","branch_rooms.Room_id=room_racks.Rack_room_id");
		$this->db->where("CLissued_id",$this->input->get("clgeliid")); 
		$this->db->where("CLissued_userid",$this->session->userdata("myid"));
		$query_inv_location=$this->db->get();
		return $query_inv_location->result_array();
	}
	public function library_issued_history_model()
	{
		$db1=$this->load->database("db1",true);
		$db1=$db1->database;
		$db6=$this->load->database("db6",true);
		$db6=$db6->database;
		$db7=$this->load->database("db7",true);
		$db7=$db7->database;
		$this->db->from("$db7.college_library_issued_history clih");
		$this->db->join("$db1.users usr","usr.User_id=clih.CLIhistory_approved_by",'left'); 
		$this->db->join("$db7.college_branch_inventory cbi","cbi.CBinv_id=clih.CLIhistory_invid"); 
		$this->db->join("$db6.books bok","bok.Bok_id=cbi.CBinv_bookid"); 
		$this->db->where("CLIhistory_userid",$this->session->userdata("myid")); 
		$this->db->order_by("CLIhistory_receive_date","DESC");
		$this->db->limit(100);
		$query_lihistory=$this->db->get();
		return $query_lihistory->result_array();
	}
	public function do_search_book_inventory_model($Clge_id)
	{
		$search_keyword=$this->input->post("search_keyword");
		$search_keyword=trim($search_keyword); 
		$keyword_new=explode(" ",$search_keyword);
		$count_array = count($keyword_new);
		$db6=$this->load->database("db6",true);
		$db6=$db6->database;
		$db7=$this->load->database("db7",true);
		$db7=$db7->database;
		$this->db->select("*");
		$this->db->from("$db7.college_branch_inventory");
		$this->db->join("$db7.college_library_branch","college_library_branch.CLbranch_id=college_branch_inventory.CBinv_clbid");
		$this->db->join("$db6.books","books.Bok_id=college_branch_inventory.CBinv_bookid");
		$this->db->join("$db6.books_authors","books_authors.Bauthor_id=books.Bok_author_id",'left');
		$this->db->join("$db6.books_publishers","books_publishers.Bpub_id=books.Bok_publisher_id",'left');
		$this->db->join("$db6.books_sub_categories","books_sub_categories.Bsubcate_id=books.Bok_subcategory_id",'left');
		$this->db->join("$db6.books_categories","books_categories.Bcate_id=books_sub_categories.Bsubcate_category_id",'left');
		$this->db->join("$db6.books_type","books_type.Btype_id=books.Bok_book_type_id",'left'); 
		$this->db->join("$db6.branches","branches.Branch_id=college_library_branch.CLbranch_branchid");
		for ($i=0; $i<$count_array; $i++) 
		{ 
			$this->db->or_like('Bok_name',$keyword_new[$i]);
			$this->db->or_like('Bok_isbn',$keyword_new[$i]);
			$this->db->or_like('Bauthor_name',$keyword_new[$i]); 
			$this->db->or_like('Bpub_name',$keyword_new[$i]); 
			$this->db->or_like('Bsubcate_name',$keyword_new[$i]);
			$this->db->or_like('Bcate_name',$keyword_new[$i]);
			$this->db->or_like('Btype_name',$keyword_new[$i]);
			$this->db->or_like('Branch_name',$keyword_new[$i]);
		}	  	
		$this->db->where("CLbranch_collegeid",$Clge_id); 
		$this->db->order_by("CBinv_entrydate","DESC");
		$this->db->limit(300);
		$query_search_books_inventory=$this->db->get(); 
		return $query_search_books_inventory->result_array();
	}
	public function send_bookissue_request_model($CBinv_id,$Clge_id)
	{
		$db7=$this->load->database("db7",true);
		$db7=$db7->database;
		$data=array(
			"CLissued_userid" => $this->session->userdata("myid"),
			"CLissued_collegeid" => $Clge_id ,
			"CLissued_invid" => $CBinv_id,
			"CLissued_request_date" => date('Y-m-d H:i:s') 
		);
		if($this->db->insert("$db7.college_library_issued",$data))
		{
			return true;
		}			
	}
}
?>