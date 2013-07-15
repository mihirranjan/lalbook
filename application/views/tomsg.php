<?php  

function validEmail($email)
{
   $isValid = true;
   $atIndex = strrpos($email, "@");
   if (is_bool($atIndex) && !$atIndex)
   {
      $isValid = false;
   }
   else
   {
      $domain = substr($email, $atIndex+1);
      $local = substr($email, 0, $atIndex);
      $localLen = strlen($local);
      $domainLen = strlen($domain);
      if ($localLen < 1 || $localLen > 64)
      {
         // local part length exceeded
         $isValid = false;
      }
      else if ($domainLen < 1 || $domainLen > 255)
      {
         // domain part length exceeded
         $isValid = false;
      }
      else if ($local[0] == '.' || $local[$localLen-1] == '.')
      {
         // local part starts or ends with '.'
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $local))
      {
         // local part has two consecutive dots
         $isValid = false;
      }
      else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
      {
         // character not valid in domain part
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $domain))
      {
         // domain part has two consecutive dots
         $isValid = false;
      }
      else if
(!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/',
                 str_replace("\\\\","",$local)))
      {
         // character not valid in local part unless 
         // local part is quoted
         if (!preg_match('/^"(\\\\"|[^"])+"$/',
             str_replace("\\\\","",$local)))
         {
            $isValid = false;
         }
      }
      if ($isValid && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A")))
      {
         // domain not found in DNS
         $isValid = false;
      }
   }
   return $isValid;
}
 $return_arr = array();
 //print_r($_POST);
 

 
if(!isset($_POST['descrpt']) || trim($_POST['descrpt'])=="")
{ 
// echo "{'errors': [{'field': 'message','error': 'This field is required.'}], 'success': false}";
 $return_arr["errors"]=array(array('field'=>'descrpt','error'=>'This field is required.'));
 $return_arr["success"]= false;
 echo json_encode($return_arr);
 return ;
}



$from = 'a.sathick@gmail.com';
$subject = 'Message From Lalbook';
$to = $_POST['hidden_toemail'];


// if(isset($_POST['fulname']))
$to_id=$_POST['hidden_touid'];
$from_id=$_POST['hidden_fromuid'];
 $bidamt=$_POST['bidamount'];
//  if(isset($_POST['email']))
 $jobid=$_POST['hidden_ujobid'];
 // if(isset($_POST['password']))
 $bidhours=$_POST['delivery'];
 
//if(isset($_POST['username']))
$biddesc=$_POST['descrpt'];

$creditavl=$_POST['hidden_credit'];

//$tot=$creditavl-1;
 /*if(($bidamt!='') && ($biddate!='') && ($bidhours!='') && ($biddesc!=''))
 {*/
 if($biddesc!='')
 {
 
 $con=mysql_connect("localhost","maventri_lalbook",")uA4DQS#o(L6") or die("error in connection".mysql_error());
mysql_select_db("maventri_lalbooks",$con);

$usersign="insert into message(job_id,from_id,to_id,message,notification_status) values('$jobid','$to_id','$from_id','$biddesc','1')";
$res=mysql_query($usersign);

//$updateuser=mysql_query("update users set credit='$tot' where id='$bidder_id'") or die("Error in update user".mysql_error());

 
 }
 /*if (isset($_POST['would_recommend']))
 $recommend=$_POST['would_recommend'];
 if(isset($_POST['want_newsletter']))
 $news=$_POST['want_newsletter'];*/
 
   $message = '<html><body>';
$message .= '<div style="background:url(http://demo.maventricks.com/lalbook/application/css/images/email_bg.png) no-repeat center;width:727px;height:318px;border:none;padding:20px 20px 0;margin:0 auto;">';
$message .='<h1 style="height:70px;margin:7px 0 0px;"><a href="#"><img src="http://demo.maventricks.com/lalbook/application/css/images/email_logo.png" alt="" style="border:none;"/></a></h1>';
    $message .='<p style="font:12px Arial, Helvetica, sans-serif;color:#333;margin:10px 0 20px;">You have .. sent Message From Lalbook </p>';
	
    $message .='<p style="font:bold 12px Arial, Helvetica, sans-serif;color:#333;margin:0 0 5px;">From Email : ' ."&nbsp;" .$from .'</p>'; 
	
	 $message .='<p style="font:bold 12px Arial, Helvetica, sans-serif;color:#333;margin:10px 0 5px;text-align:left;">Your Goals :</p>' ."&nbsp;" .$biddesc;
	
		      $message .='<p style="font:bold 12px Arial, Helvetica, sans-serif;color:#333;margin:20px 0 5px;">Best Regards,</p>';
		 $message .='<p style="font:bold 12px Arial, Helvetica, sans-serif;color:#333;margin:0 0 5px;">Lalbook</p>';
		 		$message .= "</div>";
		 		$message .= "</body></html>";
 
 
	  
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