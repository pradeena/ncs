<?php
defined("BASEPATH") or exit("NO Direct Script Allowed");
class Login_model extends CI_Model
{
	/* function do_login_check for Login Model for verifying user login data through username and password */
	public function do_login_check()
	{
		$this->db->where('(User_mobileno="'.$this->input->post("email_or_mobileno").'" OR Login_username="'.$this->input->post("email_or_mobileno").'")');  
		$this->db->where('Login_password',$this->input->post("password")); 
		$this->db->where('(Login_accesstype_id=1 or Login_accesstype_id=2 or Login_accesstype_id=3)');  
		$this->db->from("users");
		$this->db->join("user_login","user_login.Login_user_id=users.User_id");
		$query=$this->db->get();
		/* if user exit then execute further code */
		if($query->num_rows() > 0)
		{
			/* Initializing some data to update user informatiion while login*/
			$userIp=$this->input->ip_address();
			$userLoginDate=date('Y-m-d H:i:s');
			$loginToken=substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'),0,15); 
			$this->db->where('User_email',$this->input->post("email_or_mobileno")); 
			$this->db->or_where('User_mobileno',$this->input->post("email_or_mobileno")); 
			$this->db->from("users"); 
			$query_select=$this->db->get();
			if($query_select->num_rows() > 0)
			{
				$row_select=$query_select->row();
				$myid=$row_select->User_id; 
				$mystatus=$row_select->User_status; 
				$mysuspension=$row_select->User_suspension; 
				$data=array(
					"Login_last_login_ip" =>$userIp ,
					"Login_last_logindate" =>$userLoginDate ,
					"Login_logintoken" => $loginToken 
				);	  
				$this->db->where('Login_user_id',$myid); 
				$query_update=$this->db->update("user_login",$data);
				if($query_update)
				{
					$log_data=array(
						"Log_user_id" =>$myid ,
						"Log_login_ip" => $userIp,
						"Log_login_time" => $userLoginDate 
					);
					$query_user_log=$this->db->insert("user_logs",$log_data);
					if($query_user_log)
					{
						return array(
							"myid" => $myid,
							"loginToken" => $loginToken, 
							"mystatus" => $mystatus, 
							"mysuspension" => $mysuspension 
						); 	
					} 
					else { return false; }
				}
				else { return false; }
			}
			else { return false; }
		}
		else { return false; }
	}
	/* Check User For Sending Valid OTP Request */
	public function check_user_input_model($user_email_mob)
	{
		$db1=$this->load->database("db1",true);
		$db1=$db1->database;
		$this->db->from("$db1.users");
		$this->db->join("$db1.user_login","user_login.Login_user_id=users.User_id");
		$this->db->where("User_status",1);
		$this->db->where("User_suspension",1);
		$this->db->where("(Login_accesstype_id='1' OR Login_accesstype_id='2' OR Login_accesstype_id='3')"); 
		$this->db->where("User_email",$user_email_mob);
		$this->db->or_where("User_mobileno",$user_email_mob);
		$query_userdata=$this->db->get();
		if($query_userdata->num_rows() > 0)
		{
			$row_userdata=$query_userdata->row();
			return array(
				"User_id" => $row_userdata->User_id,
				"User_email" => $row_userdata->User_email,
				"User_mobileno" => $row_userdata->User_mobileno,
				"Login_username" => $row_userdata->Login_username,
			);
		}
		else
		{
			return false;
		}
		
	}
	/* update otp for users otp login request */
	public function do_update_opt_model($otp,$User_id)
	{ 
		$db1=$this->load->database("db1",true);
		$db1=$db1->database;
		$data=array(
			"Login_otp" => $otp
		);
		$this->db->where("Login_user_id",$User_id);
		if($this->db->update("$db1.user_login",$data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function do_otp_login_check_model($user_otp,$Login_username)
	{
		$this->db->where("Login_otp",trim($user_otp));
		$this->db->where("Login_username",$Login_username);
		$this->db->where('(Login_accesstype_id=1 or Login_accesstype_id=2 or Login_accesstype_id=3)'); 
		$query=$this->db->get("user_login");
		/* if user exit then execute further code */
		if($query->num_rows() > 0)
		{
			/* Initializing some data to update user informatiion while login*/
			$userIp=$this->input->ip_address();
			$userLoginDate=date('Y-m-d H:i:s');
			$loginToken=substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'),0,15);
			$this->db->where("User_email",$Login_username);
			$this->db->from("users"); 
			$query_select=$this->db->get();
			if($query_select->num_rows() > 0)
			{
				$row_select=$query_select->row();
				$myid=$row_select->User_id;
				$mystatus=$row_select->User_status; 
				$mysuspension=$row_select->User_suspension;  
				$this->db->where('Login_user_id',$myid);
				$this->db->where('Login_username',$Login_username);
				$data=array(
					"Login_last_login_ip" =>$userIp ,
					"Login_last_logindate" =>$userLoginDate ,
					"Login_logintoken" => $loginToken 
				);	
				$query_update=$this->db->update("user_login",$data);
				if($query_update)
				{
					$log_data=array(
						"Log_user_id" =>$myid ,
						"Log_login_ip" => $userIp,
						"Log_login_time" => $userLoginDate 
					);
					$query_user_log=$this->db->insert("user_logs",$log_data);
					if($query_user_log)
					{
						return array(
							"myid" => $myid,
							"loginToken" => $loginToken, 
							"mystatus" => $mystatus,
							"mysuspension" => $mysuspension
						); 	
					} 
					else { return false; }
				}
				else { return false; }
			}
			else { return false; }
		}
		else { return false; }
	}
	public function check_social_login($data = array())
	{ 
		$userIp=$this->input->ip_address();
		$userLoginDate=date('Y-m-d H:i:s');
		$loginToken=substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'),0,15); 
		$db1=$this->load->database("db1",true);
		$db1=$db1->database;
		$this->db->from("$db1.user_login");
		$this->db->where(array('Login_oauth_provider'=>$data['oauth_provider'],'Login_oauth_uid'=>$data['oauth_uid']));
		$prevQuery = $this->db->get();
		$prevCheck = $prevQuery->num_rows(); 
		if($prevCheck > 0)
		{
			$prevResult = $prevQuery->row_array();
			$data_User_modified['User_modified'] = date("Y-m-d H:i:s");
			$data_User_modified['User_status'] = 1;
			$update = $this->db->update("$db1.users",$data_User_modified,array('User_id'=>$prevResult['Login_user_id'])); 
			$this->db->where("User_id",$prevResult['Login_user_id']);
			$this->db->from("users"); 
			$query_select=$this->db->get();
			if($query_select->num_rows() > 0)
			{
				$row_select=$query_select->row();
				$myid=$row_select->User_id;
				$mystatus=$row_select->User_status; 
				$mysuspension=$row_select->User_suspension;  
				$this->db->where('Login_user_id',$myid);
				$this->db->where('Login_username',$row_select->User_email);
				$data_login_log=array(
					"Login_last_login_ip" =>$userIp ,
					"Login_last_logindate" =>$userLoginDate ,
					"Login_logintoken" => $loginToken 
				);	
				$query_update=$this->db->update("user_login",$data_login_log);
				if($query_update)
				{
					$log_data=array(
						"Log_user_id" =>$myid ,
						"Log_login_ip" => $userIp,
						"Log_oauth_provider" => $data['oauth_provider'],
						"Log_login_time" => $userLoginDate 
					);
					$query_user_log=$this->db->insert("user_logs",$log_data);
					if($query_user_log)
					{
						return array(
							"myid" => $myid,
							"loginToken" => $loginToken, 
							"mystatus" => $mystatus,
							"mysuspension" => $mysuspension
						); 	
					} 
					else { return false; }
				}
				else { return false; }
			}
			else { return false; }
		}
		else
		{
			$this->db->where("User_email",$data['email']);
			$query_check_user=$this->db->get("$db1.users");
			if($query_check_user->num_rows() > 0)
			{
				$row_check_user=$query_check_user->row();
				$data_usr=array(
					"User_picture_url" => $data['picture_url'],
					"User_profile_url" => $data['profile_url'],
					"User_status" => 1,
				);
				$update_users = $this->db->update("$db1.users",$data_usr,array('User_id'=>$row_check_user->User_id));
				$data_usrLogin=array(
					"Login_last_login_ip" =>$userIp ,
					"Login_last_logindate" =>$userLoginDate ,
					"Login_logintoken" => $loginToken, 
					"Login_oauth_provider" => $data['oauth_provider'],
					"Login_oauth_uid" => $data['oauth_uid']
				);
				if($this->db->update("$db1.user_login",$data_usrLogin,array('Login_user_id'=>$row_check_user->User_id)))
				{
					$myid=$row_check_user->User_id;
					$mystatus=$row_check_user->User_status; 
					$mysuspension=$row_check_user->User_suspension;   
					$log_data=array(
						"Log_user_id" =>$myid ,
						"Log_login_ip" => $userIp,
						"Log_oauth_provider" => $data['oauth_provider'],
						"Log_login_time" => $userLoginDate 
						);
					$query_user_log=$this->db->insert("user_logs",$log_data);
					if($query_user_log)
					{
						return array(
							"myid" => $myid,
							"loginToken" => $loginToken, 
							"mystatus" => 1,
							"mysuspension" => $mysuspension
						); 	
					} 
					else { return false; } 
				}
				else { return false; }
			}
			else
			{ 
				$data_users=array(
				"User_fstname" => $data['first_name'],
				"User_lstname" => $data['last_name'],
				"User_email" => $data['email'],
				"User_gender" => $data['gender'],
				"User_picture_url" => $data['picture_url'],
				"User_profile_url" => $data['profile_url'],
				"User_modified" => date("Y-m-d H:i:s"), 
				"User_status" => 1,
				"User_suspension" => 1,
				);
				if($this->db->insert("$db1.users",$data_users))
				{
					$this->db->where('User_email',$data['email']);
					$query=$this->db->get("users"); 
					if($query)
					{ 
						$row=$query->row();
						$activation_email=md5(uniqid());	
						$data_user_login=array
						(
							"Login_user_id" => $row->User_id,
							"Login_username" => $row->User_email,
							"Login_password" => md5(trim($this->input->post("password"))),
							"Login_accesstype_id" => 1,
							"Login_activation_email" => $activation_email,		
							"Login_oauth_provider" => $data['oauth_provider'],
							"Login_oauth_uid" => $data['oauth_uid']
						);
						$query_user_login=$this->db->insert("$db1.user_login",$data_user_login); 
						if($query_user_login)
						{ 
							$myid=$row->User_id; 
							$mystatus=$row->User_status; 
							$mysuspension=$row->User_suspension;  
							$log_data=array(
									"Log_user_id" =>$myid ,
									"Log_login_ip" => $userIp,
									"Log_oauth_provider" => $data['oauth_provider'],
									"Log_login_time" => $userLoginDate 
								);
							$query_user_log=$this->db->insert("$db1.user_logs",$log_data);
							if($query_user_log)
							{
								return array(
										"myid" => $myid,
										"loginToken" => $loginToken, 
										"mystatus" => $mystatus, 
										"mysuspension" => $mysuspension 
									); 	
							} 
							else { return false; } 
						} else return false;
					} else return false;
				} else return false;
			} 
		}
	}	
}	
?>