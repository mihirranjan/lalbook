<?php  


$con=mysql_connect("mysql.lalbook.com","maventricks","usertest");
$db=mysql_select_db("sathick",$con) or die("database error".mysql_error());
$business_id = $_REQUEST['business_id'];

/*
$con=mysql_connect("localhost","root","") or die("error in connection".mysql_error());
mysql_select_db("lalbook",$con);
*/


function validEmail($email){
	$expression = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.([a-zA-Z]{2,4})$/";
	if (preg_match($expression, $email)) {
		return true;
	} else {
		return false;
	} 
}
$return_arr = array();
 


$nam=$_POST['fulname'];
 if( !isset($_POST['fulname']) || trim($_POST['fulname'])=="")
{ 

// echo "{'errors': [{'field': 'message','error': 'This field is required.'}], 'success': false}";
 $return_arr["errors"]=array(array('field'=>'fulname','error'=>'Please enter your full name.'));
 $return_arr["success"]= false;
 echo json_encode($return_arr);
 return ;
}
if(isset($_POST['fulname']) && strlen($nam)>=10 ||  strlen($nam)<5)
{

// echo "{'errors': [{'field': 'message','error': 'This field is required.'}], 'success': false}";
 $return_arr["errors"]=array(array('field'=>'fulname','error'=>'Full Name must have at most 25 characters.'));
 $return_arr["success"]= false;
 echo json_encode($return_arr);
 return ;
 }

 if(!isset($_POST['email']) || trim($_POST['email'])=="" || !validEmail($_POST['email']))
 { 
    // echo "{'errors': [{'field': 'email', 'error': 'Enter a valid e-mail address.'}], 'success': false}";
     $return_arr["errors"]=array(array('field'=>'email','error'=>'Please enter a valid e-mail address.'));
	 $return_arr["success"]= false;
	 echo json_encode($return_arr);
	 return;
 }
 if(isset($_POST['email']))
 {
 $uemailid=$_POST['email'];
 $useremailid=mysql_query("select email from users where email='$uemailid'");
 $rest=mysql_num_rows($useremailid);
 if($rest>0)
 {
 // echo "{'errors': [{'field': 'email', 'error': 'Enter a valid e-mail address.'}], 'success': false}";
     $return_arr["errors"]=array(array('field'=>'email','error'=>'Sorry Your Email Is Already Registered in Lalbook.'));
	 $return_arr["success"]= false;
	 echo json_encode($return_arr);
	 return;
 
 }
 }
 if( !isset($_POST['username']) || trim($_POST['username'])=="")
{ 
// echo "{'errors': [{'field': 'message','error': 'This field is required.'}], 'success': false}";
 $return_arr["errors"]=array(array('field'=>'username','error'=>'Please enter your username.'));
 $return_arr["success"]= false;
 echo json_encode($return_arr);
 return ;
}
$uname=$_POST['username'];
if(isset($_POST['username']) && strlen($uname)>=16 ||  strlen($uname)<5)
{

// echo "{'errors': [{'field': 'message','error': 'This field is required.'}], 'success': false}";
 $return_arr["errors"]=array(array('field'=>'username','error'=>'Username must have at most 16 characters.'));
 $return_arr["success"]= false;
 echo json_encode($return_arr);
 return ;
 }
if( !isset($_POST['message']) || trim($_POST['message'])=="")
{ 
// echo "{'errors': [{'field': 'message','error': 'This field is required.'}], 'success': false}";
 $return_arr["errors"]=array(array('field'=>'message','error'=>'This field is required.'));
 $return_arr["success"]= false;
 echo json_encode($return_arr);
 return ;
}
$msssg=$_POST['message'];
if(isset($_POST['message']) && strlen($msssg)>200 ||  strlen($msssg)<10)
{

// echo "{'errors': [{'field': 'message','error': 'This field is required.'}], 'success': false}";
 $return_arr["errors"]=array(array('field'=>'message','error'=>'Goals Must be more than 10 characters.'));
 $return_arr["success"]= false;
 echo json_encode($return_arr);
 return ;
 }
$pasw=$_POST['password'];
if( !isset($_POST['password']) || trim($_POST['password'])=="")
{ 
// echo "{'errors': [{'field': 'message','error': 'This field is required.'}], 'success': false}";
 $return_arr["errors"]=array(array('field'=>'password','error'=>'Please enter your password.'));
 $return_arr["success"]= false;
 echo json_encode($return_arr);
 return ;
}
if(isset($_POST['password']) && strlen($pasw)>10)
{

// echo "{'errors': [{'field': 'message','error': 'This field is required.'}], 'success': false}";
 $return_arr["errors"]=array(array('field'=>'password','error'=>'Password must have at least 10 characters.'));
 $return_arr["success"]= false;
 echo json_encode($return_arr);
 return ;
 }
if( !isset($_POST['cpassword']) || trim($_POST['cpassword'])=="" || ($_POST['cpassword']!=$_POST['password']))
{ 
// echo "{'errors': [{'field': 'message','error': 'This field is required.'}], 'success': false}";
 $return_arr["errors"]=array(array('field'=>'cpassword','error'=>'This field is required.or Your confirm password is not match with Password'));
 $return_arr["success"]= false;
 echo json_encode($return_arr);
 return ;
}
if( !isset($_POST['terms']) || trim($_POST['terms'])=="" || ($_POST['terms'])!=1)
{ 
// echo "{'errors': [{'field': 'message','error': 'This field is required.'}], 'success': false}";
 //$return_arr["errors"]=array(array('field'=>'terms','error'=>'This field is required.'));
 $return_arr["errors"]=array(array('field'=>'terms','error'=>'In order to use our services, you must agree to Lalbook\'s Terms of Service.'));
 $return_arr["success"]= false;
 echo json_encode($return_arr);
 return ;
}

$from = 'pramod_mitr@ymail.com';
$subject = 'Lalbook signup';
$to = $_POST['email'];
$msg=$_POST['message'];
$activation_key = md5(time());
$created=date("Y-m-d H:i:s");
$confirmationlink='http://'.$_SERVER['HTTP_HOST'].'/lalbook/index.php/owner/confirm/'.$activation_key;
				
$rate1="";
$rate2="";
$rate3="";
$recommend="";
 $news="";
// if(isset($_POST['fulname']))
 $fulnm=$_POST['fulname'];
//  if(isset($_POST['email']))
 $usremail=$_POST['email'];
 // if(isset($_POST['password']))
 $rate3=$_POST['password'];
 //$haspwd=md5($rate3);
$haspwd= hash('sha384',$rate3); 
//if(isset($_POST['username']))
$usrnm=$_POST['username'];
//if(isset($_POST['cpassword']))
$confmp=$_POST['cpassword'];
//if(isset($_POST['terms']))
$trmcond=$_POST['terms'];



 if(($fulnm!='') && ($usremail!='') && ($usrnm!='') && ($msg!='') && ($rate3!='') && ($confmp!='') && ($trmcond!=''))
 {
 
$fulnm = ucfirst($fulnm);//Capitalize First Character
$usersign="insert into users(user_name,fulname,email,role_id,password,activation_key,created,lalbook_goal) values('$usrnm','$fulnm','$usremail','1','$haspwd','$activation_key','$created','$msg')";
$res=mysql_query($usersign);
if(!$res)
{

 $return_arr["errors"]=array(array('error'=>'error in insert.'));
 $return_arr["success"]= false;
 echo json_encode($return_arr);
 return ;
 }
 }


$message = '<html><body>';
$message .= '<div style="background:url(http://demo.maventricks.com/lalbook/application/css/images/email_bg.png) no-repeat center;width:727px;height:318px;border:none;padding:20px 20px 0;margin:0 auto;">';
$message .='<h1 style="height:70px;margin:7px 0 0px;"><a href="#"><img src="http://demo.maventricks.com/lalbook/application/css/images/email_logo.png" alt="" style="border:none;"/></a></h1>';
    $message .='<p style="font:12px Arial, Helvetica, sans-serif;color:#333;margin:10px 0 20px;">Thank you for choosing Lalbook for your posting requirements. Please click here to continue the signup process. </p>';
    $message .='<p style="font:bold 12px Arial, Helvetica, sans-serif;color:#333;margin:0 0 5px;">User Name: </p>' ."&nbsp;" .$usrnm;
	
	 $message .='<p style="font:bold 12px Arial, Helvetica, sans-serif;color:#333;margin:0 0 5px;">Password:</p>' ."&nbsp;" .$rate3;
	
      $message .='<p style="font:bold 12px Arial, Helvetica, sans-serif;color:#333;margin:0 0 5px;">Confirmation Link:</p>';
        $message .='<p style="font:12px Arial, Helvetica, sans-serif;margin:0px 0 20px;"><a href="#" style="color:#c00000;text-decoration:none;">';
		$message .='<a href="'.$confirmationlink.'">'.$confirmationlink.'</a>';
		$message .='</a></p>';
		      $message .='<p style="font:bold 12px Arial, Helvetica, sans-serif;color:#333;margin:0 0 5px;">Best Regards,</p>';
		 $message .='<p style="font:bold 12px Arial, Helvetica, sans-serif;color:#333;margin:0 0 5px;">Team Lalbook</p>';
		 		$message .= "</div>";
		 		$message .= "</body></html>";

/*				
if(mail($to, $subject, $message, "From: $from  \r\nContent-type: text/html\r\n"))
{
*/
if(mail($to, $subject, $message, "From: $from  \r\nContent-type: text/html\r\n"))
{
	$return_arr["success"]= true;
	echo json_encode($return_arr);	 
  
}
else
{
	$return_arr["success"]= false;
	echo json_encode($return_arr);	 
}
 


?>