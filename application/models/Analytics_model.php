<?php
defined("BASEPATH") or exit("No Direct Script Allowed");
class Analytics_model extends CI_Model
{ 
	public function setAnalyticsData($session_name,$clge_id,$ccourse_id,$userid)
	{
		return true;
		$this->load->library('user_agent');  
		if($this->agent->robot() || $this->agent->platform()=="Unknown Platform")
		{
			return true;
		}
		else
		{ 
			$db3=$this->load->database("db3",true);
			$db3=$db3->database;
			$ip=$this->input->ip_address();
			$this->load->library('location');
			if(empty($ccourse_id))
			{
				$this->db->select("count");
				$this->db->where('session_name',$session_name);
				$this->db->where('ccourse_id','');
				$qry=$this->db->get("$db3.analytics");
				if($qry->num_rows() > 0)
				{
					$row=$qry->row();
					$data=array(
						'count' => $row->count+1,
						'userid' => $userid,
					);
					$this->db->where('session_name',$session_name);
					$this->db->where('ccourse_id','');
					$this->db->update("$db3.analytics",$data);
					return true;  
				}
				else
				{
					$location=location::getLocation($ip); 
					$data=array(
						'clge_id' => $clge_id,
						'ccourse_id' => $ccourse_id,
						'session_name' => $session_name,
						'ip' => $ip,
						'browser' => $this->agent->browser(),
						'platform' => $this->agent->platform(),
						'browser_version' => $this->agent->version(), 
						'referrer_domain' => $this->agent->referrer(),
						'country' => $location->country,
						'region' => $location->regionName,
						'city' => $location->city,
						'isp' => $location->isp,
						'organization' => $location->org,
						'countryCode' => $location->countryCode,
						'timezone' => $location->timezone,
						'zip' => $location->zip,
						'latitude' => $location->lat,
						'longitude' => $location->lon,
						'count' => 1,
						'userid' => $userid,

					);
					$this->db->insert("$db3.analytics",$data);
					return true;  
				}
			}
			else
			{
				$this->db->select("count");
				$this->db->where('session_name',$session_name);
				$this->db->where('ccourse_id',$ccourse_id);
				$qry=$this->db->get("$db3.analytics");
				if($qry->num_rows() > 0)
				{
					$row=$qry->row();
					$data=array(
						'count' => $row->count+1,
						'userid' => $userid,
					);
					$this->db->where('session_name',$session_name);
					$this->db->where('ccourse_id',$ccourse_id);
					$this->db->update("$db3.analytics",$data);
					return true;  
				}
				else
				{
					$location=location::getLocation($ip); 
					$data=array(
						'clge_id' => $clge_id,
						'ccourse_id' => $ccourse_id,
						'session_name' => $session_name,
						'ip' => $ip,
						'browser' => $this->agent->browser(),
						'platform' => $this->agent->platform(),
						'browser_version' => $this->agent->version(), 
						'referrer_domain' => $this->agent->referrer(),
						'country' => $location->country,
						'region' => $location->regionName,
						'city' => $location->city,
						'isp' => $location->isp,
						'organization' => $location->org,
						'countryCode' => $location->countryCode,
						'timezone' => $location->timezone,
						'zip' => $location->zip,
						'latitude' => $location->lat,
						'longitude' => $location->lon,
						'count' => 1,
						'userid' => $userid,

					);
					$this->db->insert("$db3.analytics",$data);
					return true;  
				}
			}	
		}	   
	}
}
?>