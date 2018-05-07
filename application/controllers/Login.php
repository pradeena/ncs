<?php
defined("BASEPATH") or exit("No Direct Script Allowed");
class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct(); 
		$this->load->model("login_model");
		$this->load->library("form_validation"); 
	}
	public function index()
	{
		$data["meta_title"]="Login | NCS Online";
		$data["meta_description"]="Log in to your NCS Online account";
		if(isset($_GET["redirect"])){$redirect=$_GET["redirect"];}else{$redirect="";} 
		if($this->session->userdata("is_loged_in"))
		{ 
			redirect(base_url().$redirect); 
		}
		if(isset($_GET["redirect"])) {$data_googleRedirect=array( "google_redirect" => $redirect); $this->session->set_userdata($data_googleRedirect); } //else{ $this->session->sess_destroy("google_redirect");} 
		$this->load->view("similar/header_view",$data);  
		$this->load->view("similar/menu_view"); 
		$data="";
		
		/*---------------------------------------------------Login Using Facebook Start Here-------------------------------------*/
		include_once APPPATH."libraries/facebook-api-php-codexworld/facebook.php";// Include the facebook api php libraries
		// Facebook API Configuration
		$appId = '103601873506800';
		$appSecret = 'fac445d43a8b61c16efe84f0d24f7360';
		$redirectUrl = base_url().'login/';
		$fbPermissions = 'email';
		//Call Facebook API
		$facebook = new Facebook(array(
				'appId'  => $appId,
				'secret' => $appSecret
				));
		$fbuser = $facebook->getUser(); 
		if ($fbuser) 
		{
			$userProfile = $facebook->api('/me?fields=id,first_name,last_name,email,gender,locale,picture');
            // Preparing data for database insertion
			print_r($userProfile);
			$userData['oauth_provider'] = 'facebook';
			$userData['oauth_uid'] = $userProfile['id'];
            $userData['first_name'] = $userProfile['first_name'];
            $userData['last_name'] = $userProfile['last_name'];
            $userData['email'] = $userProfile['email'];
			$userData['gender'] = $userProfile['gender'];
			//$userData['locale'] = $userProfile['locale'];
            $userData['profile_url'] = 'https://www.facebook.com/'.$userProfile['id'];
            $userData['picture_url'] = $userProfile['picture']['data']['url'];
			// Insert or update user data
            $user_data = $this->login_model->check_social_login($userData);
            if(!empty($user_data))
			{
					/* Retriving Returning data myid,loginToken,mystatus from login model*/
					$myid=$user_data["myid"]; 
					$loginToken=$user_data["loginToken"]; 
					$mystatus=$user_data["mystatus"]; 
					/* Condition To check For user status While Login if status=0 then show inactive message to user */	
					if($mystatus==0)
					{
						$data=array(
							"msg" => '<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
							<h4><i class="icon fa fa-warning"></i> Alert!</h4>
							<p>Your Account is Inactive. Please Verify your Email to continue</p>
							</div>'
						); 
					}
					elseif($user_data["mysuspension"]==0)
					{
						$data=array(
							"msg" => '<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
							<h4><i class="icon fa fa-warning"></i> Alert!</h4>
							<p>Sorry, Your account is Suspended From Nepalcollegesearch(campuskit), Please contact Nepalcollegesearch(campuskit) support Team.</p>
							</div>'
						); 
					}
					/* Condition To check For user status While Login if status=1 then create session and redirect to users Main Controller For Authentication And Authorization */	
					else
					{
						$session_data=array(
							"myid" => $myid,
							"logintoken" => $loginToken, 
							"is_loged_in" => 1
						);
						$this->session->set_userdata($session_data);
						redirect($redirect);
					}
            } 
			else 
			{
               $data['userData'] = array();
            }
        } 
		else 
		{
			$fbuser = '';
            $data['authUrl'] = $facebook->getLoginUrl(array('redirect_uri'=>$redirectUrl.'?redirect='.$redirect.'&fblogin=true','scope'=>$fbPermissions));
        }	
		/*---------------------------------------------------Login Using Facebook End Here-------------------------------------*/	
		/*---------------------------------------------------Login With Google Start Here----------------------------------------*/
	if(!isset($_GET["fblogin"]))	
	{
		include_once APPPATH."libraries/google-api-php-client/Google_Client.php";
		include_once APPPATH."libraries/google-api-php-client/contrib/Google_Oauth2Service.php";
		// Google Project API Credentials
		$clientId = '690037247134-a7u0dh6kaad8jo8ca3q85vhkh5qsv61q.apps.googleusercontent.com';
        $clientSecret = 'n3ChpgXju9h2DYK7hh5WW6NC';
        $redirectUrl = 'http://www.nepalcollegesearch.org/login/';
		// Google Client Configuration
        $gClient = new Google_Client();
        $gClient->setApplicationName('Login to nepalcollegesearch.org');
        $gClient->setClientId($clientId);
        $gClient->setClientSecret($clientSecret);
        $gClient->setRedirectUri($redirectUrl);
        $google_oauthV2 = new Google_Oauth2Service($gClient);
        if (isset($_REQUEST['code'])) 
		{
            $gClient->authenticate();
            $this->session->set_userdata('token', $gClient->getAccessToken());
            redirect($redirectUrl);
        } 
        $token = $this->session->userdata('token');
        if (!empty($token)) 
		{
            $gClient->setAccessToken($token);
        }
        if ($gClient->getAccessToken())
		{
            $userProfile = $google_oauthV2->userinfo->get();
			print_r($userProfile);
            // Preparing data for database insertion
			$userData['oauth_provider'] = 'google';
			$userData['oauth_uid'] = $userProfile['id'];
            $userData['first_name'] = $userProfile['given_name'];
            $userData['last_name'] = $userProfile['family_name'];
            $userData['email'] = $userProfile['email'];
			//$userData['gender'] = $userProfile['gender'];
			$userData['gender'] = "";
			$userData['locale'] = $userProfile['locale'];
            //$userData['profile_url'] = $userProfile['link'];
            $userData['profile_url'] = "";
            $userData['picture_url'] = $userProfile['picture'];
			// Insert or update user data
            $user_data = $this->login_model->check_social_login($userData);
            if(!empty($user_data))
			{ 
					$myid=$user_data["myid"]; 
					$loginToken=$user_data["loginToken"]; 
					$mystatus=$user_data["mystatus"];  	
					if($mystatus==0)
					{
						$data=array(
							"msg" => '<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
							<h4><i class="icon fa fa-warning"></i> Alert!</h4>
							<p>Your Account is Inactive. Please Verify your Email to continue</p>
							</div>'
						); 
					}
					elseif($user_data["mysuspension"]==0)
					{
						$data=array(
							"msg" => '<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
							<h4><i class="icon fa fa-warning"></i> Alert!</h4>
							<p>Sorry, Your account is Suspended From Nepalcollegesearch(campuskit), Please contact Nepalcollegesearch(campuskit) support Team.</p>
							</div>'
						); 
					} 
					else
					{
						$session_data=array(
							"myid" => $myid,
							"logintoken" => $loginToken, 
							"is_loged_in" => 1
						);
						$this->session->set_userdata($session_data);
						redirect(base_url().$this->session->userdata("google_redirect"));
					}
            } else {
               $data['userData'] = array();
            }
        } else {
            $data['authUrlGoogle'] = $gClient->createAuthUrl();
        }
	}	
		/*---------------------------------------------------Login With Google End Here------------------------------------------*/ 
		if(isset($_POST["login"]) && $_POST["do_login"]=="true")
		{
			$this->form_validation->set_rules("email_or_mobileno","email_or_mobileno","trim|required");
			$this->form_validation->set_rules("password","password","md5|trim|required");
			/* If Form validation Run Successfully Then Execute Further Code */
			if($this->form_validation->run())
			{  
				/* Load do_login_check function of Login Model To Check user Login Data From Database  */
				if($user_data=$this->login_model->do_login_check())
				{
					/* Retriving Returning data myid,loginToken,mystatus from login model*/
					$myid=$user_data["myid"]; 
					$loginToken=$user_data["loginToken"]; 
					$mystatus=$user_data["mystatus"]; 
					/* Condition To check For user status While Login if status=0 then show inactive message to user */	
					if($mystatus==0)
					{
						$data=array(
							"msg" => '<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
							<h4><i class="icon fa fa-warning"></i> Alert!</h4>
							<p>Your Account is Inactive. Please Verify your Email to continue</p>
							</div>'
						); 
					}
					elseif($user_data["mysuspension"]==0)
					{
						$data=array(
							"msg" => '<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
							<h4><i class="icon fa fa-warning"></i> Alert!</h4>
							<p>Sorry, Your account is Suspended From Nepalcollegesearch(campuskit), Please contact Nepalcollegesearch(campuskit) support Team.</p>
							</div>'
						); 
					}
					/* Condition To check For user status While Login if status=1 then create session and redirect to users Main Controller For Authentication And Authorization */	
					else
					{
						$session_data=array(
							"myid" => $myid,
							"logintoken" => $loginToken, 
							"is_loged_in" => 1
						);
						$this->session->set_userdata($session_data);
						redirect(base_url().$redirect);
					}
				}
				/* Return False From Login Model do_login_check method or function then Show Login failed Message To User */
				else
				{
					$data=array(
					"msg" => '<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
						<h4><i class="icon fa fa-warning"></i> Alert!</h4>
						The Username or password you entered is incorrect. <a href="'.base_url().'reset">Forgot Password</a>?
					</div>'
					); 
				}
			}
			/* if validation not run then show login failed message to users */
			else
			{
				$data=array(
					"msg" => '<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
						<h4><i class="icon fa fa-warning"></i> Alert!</h4>
						The Username or password you entered is incorrect. <a href="'.base_url().'reset">Forgot Password</a>
					</div>'
				); 
			}	
		}
		$this->load->view("modules/login_view",$data);  
		$this->load->view("similar/footer_view");  
	}
	public function random_otp($size)
	{
		$alpha_key = '';
		$keys = range('a', 'z');
		for ($i = 0; $i < 2; $i++)
		{
			$alpha_key .= $keys[array_rand($keys)];
		}
		$length = $size - 2;
		$key = '';
		$keys = range(0, 9); 
		for ($i = 0; $i < $length; $i++)
		{
			$key .= $keys[array_rand($keys)];
		}
		return $alpha_key . $key;
	}
	public function open_otp_form_ajax()
	{
		$user_email_mob=trim($this->input->post("user_email_mob"));  
		if($userdata=$this->login_model->check_user_input_model($user_email_mob))
		{  
				$User_id=$userdata["User_id"];
				$User_email=$userdata["User_email"];
				$User_mobileno=$userdata["User_mobileno"];
				$Login_username=$userdata["Login_username"];
				$otp=$this->random_otp(6);
				if($this->login_model->do_update_opt_model($otp,$User_id))
				{
					// STEP 1
					// prepare necessary parameters
					/*$client_id = 'premium';
					$username = 'agripricenepal';
					$password = 'abcd1234';
					$token = '5YXNfKQ7aUx2qOXc18SD'; 
					$to='9841854052';
					$text="Your One Time Login Password Is ".$otp; 
					$args = http_build_query(array(
						'token' => '5YXNfKQ7aUx2qOXc18SD',
						'from'  => 'AEC',
						'to'    => $to,
						'text'  => $text));
					$url = "http://api.sparrowsms.com/v2/sms/";
					# Make the call using API.
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					// Response
					$response = curl_exec($ch);
					$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
					curl_close($ch);*/
					$this->load->library("email");
					$this->email->from("webmaster@nepalcollegesearch.org","Nepalcollegesearch Webmaster Team");
					$this->email->to($User_email);
					$this->email->set_mailtype("html");
					$this->email->subject("Your OTP From Nepalcollegesearch");
					$data_email["email_msg"]="Your One Time Login Password Is ".$otp; 
					$message= $this->load->view('nbs_mailer.php',$data_email,TRUE); 
					$this->email->message($message); 
					if($this->email->send())
					{ 
						echo "<script>$('#EnterOtpForm').hide();</script>";
						echo '<form  name="OTPLogin" action="" method="post"  onsubmit="return otp_login_validate();"> 
						<input type="hidden" name="do_otp_login" value="true">
						<input type="hidden" name="Login_username" value="'.$Login_username.'">
						<div class="form-group has-feedback">  
						<input type="text" class="form-control" placeholder="Enter OTP" name="user_otp" autofocus />
						<span class="form-control-feedback"></span>
						<b><span style="color:red" id="user_otp"> </span></b>
						</div> 
						<div class="row">
						<div class="col-xs-8"> 
						</div><!-- /.col -->
						<div class="col-xs-4">
							<input type="submit"  name="otp_login" value="OTP Login" class="btn btn-primary"></button>
						</div><!-- /.col -->
						</div>
						</form>';  
					}
					else
					{
						echo '<div class="alert alert-danger alert-dismissable"> 
							<h4><i class="icon fa fa-warning"></i> Alert!</h4>
							<p>Sorry, Email Not Send</p>
							</div>';
					}
				}	
				else
				{
					echo '<div class="alert alert-danger alert-dismissable"> 
							<h4><i class="icon fa fa-warning"></i> Alert!</h4>
							<p>Sorry, Mobile or Email Not Matched</p>
							</div>';
					//echo '<meta http-equiv="refresh" content="1;">';
				}
		}
		else
		{
			echo '<div class="alert alert-danger alert-dismissable"> 
							<h4><i class="icon fa fa-warning"></i> Alert!</h4>
							<p>Sorry, Mobile or Email Not Matched</p>
							</div>';
			//echo '<meta http-equiv="refresh" content="1;">';				
		}
	}
	public function do_otp_logincheck_ajax()
	{
		$redirect=$this->input->post("redirect");
		$user_otp=$this->input->post("user_otp");
		$Login_username=$this->input->post("Login_username");
			if($user_data=$this->login_model->do_otp_login_check_model($user_otp,$Login_username))
			{
				/* Retriving Returning data myid,loginToken,mystatus from login model*/
					$myid=$user_data["myid"]; 
					$loginToken=$user_data["loginToken"]; 
					$mystatus=$user_data["mystatus"]; 
					/* Condition To check For user status While Login if status=0 then show inactive message to user */	
					if($mystatus==0)
					{
						echo '<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
							<h4><i class="icon fa fa-warning"></i> Alert!</h4>
							<p>Your Account is Inactive. Please Verify your Email to continue</p>
							</div>'; 
					}
					elseif($user_data["mysuspension"]==0)
					{
						echo '<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
							<h4><i class="icon fa fa-warning"></i> Alert!</h4>
							<p>Sorry, Your account is Suspended From Nepalcollegesearch(campuskit), Please contact Nepalcollegesearch(campuskit) support Team.</p>
							</div>'; 
					}
					/* Condition To check For user status While Login if status=1 then create session and redirect to users Main Controller For Authentication And Authorization */	
					else
					{
						$session_data=array(
							"myid" => $myid,
							"logintoken" => $loginToken, 
							"is_loged_in" => 1
						);
						$this->session->set_userdata($session_data); 
						echo '<meta http-equiv="refresh" content="1;url='.$redirect.'">';
					}
			}
			/* Return False From Login Model do_login_check method or function then Show Login failed Message To User */
			else
			{
				echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
						<h4><i class="icon fa fa-warning"></i> Alert!</h4>
						OTP Not Matched!
					</div>'; 
			}
	}
}
?>