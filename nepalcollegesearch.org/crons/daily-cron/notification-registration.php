<?php
$host="localhost";
$user="cornerka_tester";
$pass="ONLINE@NBS@000";
$db="cornerka_users";
mysql_connect($host,$user,$pass) or die(mysql_error());
mysql_select_db($db) or die(mysql_error());
?>
<?php
$sql="select *
	from notification n 
	join users usr on (n.Notification_userid=usr.User_id)
	join user_login ul on (ul.Login_user_id=usr.User_id)
	where Notification_status='0' limit 0,50";
$res=mysql_query($sql);
while($row=mysql_fetch_array())
{
	$Notification_id=$row["Notification_id"];
	$User_id=$row["User_id"];
	$User_fstname=$row["User_fstname"];
	$User_lstname=$row["User_lstname"];
	$User_email=$row["User_email"];
	$User_mobileno=$row["User_mobileno"];
	$Login_username=$row["Login_username"];
	$psd_text = rand(10000000,99999999);
	$Login_password=md5($psd_text);
	$sql_update_ul="update user_login set Login_password='$Login_password' where Login_user_id='$User_id'";
	if(mysql_query($sql_update_ul))
	{
		$sql_update_notification="update notification set Notification_email='1' , Notification_sms='1' , Notification_status='1' where Notification_id='$Notification_id'";
		if(mysql_query($sql_update_notification))
		{
			$to ="$User_email";
            $subject = "NBSOnline User Registration";
            $message = "Hi, <br/>
					$User_fstname $User_lstname You Are registered For NBSonline User. Below is your login access details<br/><br/> 
                    <b>Username</b>: $Login_username <br/><br/>
                    <b>Password</b>: $psd_text <br/><br/>
                    <br/><br/>
                    Thanks, <br/>
                    <b>NBSOnilne Admin Team</b><br/>
                    http://www.nbsonline.org/beta/<br/>";
            $header= "MIME-Version: 1.0\r\n"; 
            $header.= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 
            $header.= "X-Priority: 1\r\n"; 
            mail($to, $subject, $message, $header,'-f NBSOnilne<webmaster@nbsonline.org>');
		}
	}
}
?>