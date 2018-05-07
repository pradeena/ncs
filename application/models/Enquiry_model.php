<?php
defined("BASEPATH") or exit("No Direct Script Allowed");
class Enquiry_model extends CI_Model
{

	public function createEnquiry($Cenq_fstname, $Cenq_lstname, $Cenq_email, $Cenq_contactno, $Cenq_clgeid, $Cenq_clgecourseid,$CEcmntsced_usercomment, $Cenq_userid)
	{
		$Cenq_regdate = date("Y-m-d H:i:s");
		$db8=$this->load->database("db8",true);
		$db8=$db8->database;
		$data = array(
			'Cenq_fstname' => $Cenq_fstname,
			'Cenq_lstname' => $Cenq_lstname,
			'Cenq_email'   => $Cenq_email,
			'Cenq_contactno' => $Cenq_contactno,
			'Cenq_enquirytypeid' => 1,
			'Cenq_clgecourseid' => $Cenq_clgecourseid,
			'Cenq_userid' => $Cenq_userid,
			'Cenq_clgeid' => $Cenq_clgeid,
			'Cenq_enquiry_statusid' => '1',
			'Cenq_regdate' => $Cenq_regdate
		); 
		if($this->db->insert("$db8.college_enquiry",$data))
		{
			$this->db->where("Cenq_regdate", $Cenq_regdate);
			$this->db->where("Cenq_userid", $Cenq_userid);
			$qry = $this->db->get("$db8.college_enquiry");
			$row = $qry->row(); 
			$data = array(
				"CEcmntsced_enquiryid" => $row->Cenq_id,
				"CEcmntsced_usercomment" => $CEcmntsced_usercomment
			); 

			if($this->db->insert("$db8.college_enquiry_comment_schedule",$data))
			{
				return true;
			}
			else{
				return false;
			}

		}
	}
	public function checkDuplicateUser($User_email)
	{
		$db1=$this->load->database("db1",true);
		$db1=$db1->database;
		$this->db->select("User_id");
		$this->db->where("User_email",$User_email);
		$qry = $this->db->get("$db1.users");
		if($qry->num_rows()==1)
		{
			$row = $qry->row();
			return $row->User_id;
		}
		else {
			return false;
		}
	}
	public function getEnquiry()
	{
		$db1=$this->load->database("db1",true);
		$db1=$db1->database;
		$db8=$this->load->database("db8",true);
		$db8=$db8->database;
		$db3=$this->load->database("db3",true);
		$db3=$db3->database;
		$db4=$this->load->database("db4",true);
		$db4=$db4->database;
		$this->db->from("$db8.college_enquiry");
		$this->db->join("$db8.college_enquiry_status",'college_enquiry_status.CEstatus_id=college_enquiry.Cenq_enquiry_statusid','left'); 
		$this->db->join("$db3.college",'college.Clge_id=college_enquiry.Cenq_clgeid','left');
		$this->db->join("$db3.college_courses",'college_courses.Clgecourse_id=college_enquiry.Cenq_clgecourseid','left');
		$this->db->join("$db4.university_courses",'university_courses.Ucourse_id=college_courses.Clgecourse_univcourseid','left');  
		$this->db->join("$db4.courses",'courses.Course_id =university_courses.Ucourse_courseid','left'); 
		$this->db->join("$db8.college_enquiry_comment_schedule",'college_enquiry_comment_schedule.CEcmntsced_enquiryid =college_enquiry.Cenq_id','left');
		$this->db->where("Cenq_userid",$this->session->userdata("myid")); 
		$this->db->order_by("Cenq_regdate","DESC"); 
		$this->db->limit(10);
		$query_my_enquiry=$this->db->get();
		return $query_my_enquiry->result_array();
	}
}
?>