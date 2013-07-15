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
if( !isset($_POST['sellerdescription']) || trim($_POST['sellerdescription'])=="")
{ 
// echo "{'errors': [{'field': 'message','error': 'This field is required.'}], 'success': false}";
 $return_arr["errors"]=array(array('field'=>'sellerdescription','error'=>'This field is required.'));
 $return_arr["success"]= false;
 echo json_encode($return_arr);
 return ;
}
 /*else if(!isset($_POST['email']) || trim($_POST['email'])=="" || !validEmail($_POST['email']))
 { 
    // echo "{'errors': [{'field': 'email', 'error': 'Enter a valid e-mail address.'}], 'success': false}";
     $return_arr["errors"]=array(array('field'=>'email','error'=>'Enter a valid e-mail address.'));
	 $return_arr["success"]= false;
	 echo json_encode($return_arr);
	 return;
 }*/
  
//  

//$to = 'a.sathick@gmail.com';
$to=$_POST['hidden_ownermailid']; //Buyer( job owner)
$subject = 'Rating For You On Lalbook';
$from = $_POST['hidden_selruseremail']; //Seller (job Buyer)
$msg=$_POST['sellerdescription'];
$rate1="";
$rate2="";
$rate3="";
$recommend="";
 $news="";
 if(isset($_POST['rating_1']))
 $rate1=$_POST['rating_1'];
 //echo $rate1;
  //if(isset($_POST['rating_2']))
 $rate2=$_POST['rating_2'];
 // echo $rate2;
  if(isset($_POST['rating_3']))
  
 $rate3=$_POST['rating_3'];
  //echo $rate3;
 if (isset($_POST['would_recommend']))
 $recommend=$_POST['would_recommend'];
 if(isset($_POST['want_newsletter']))
 $news=$_POST['want_newsletter'];
 $description=$_POST['sellerdescription'];
 $jobid=$_POST['hidden_jobsid'];
 $ownerid=$_POST['hidden_ownersid'];
 $empid=$_POST['hidden_selrbidid'];
 $reviewerid = $_POST['hidden_reviewerid'];
 
  if($description!='')
 {
 
 $con=mysql_connect("localhost","root","adminpass") or die("error in connection".mysql_error());
mysql_select_db("lalbook",$con) or die("couldnot connect to db".mysql_error());

$usersigns="insert into reviews(comments,rating,job_id,owner_id,employee_id,hold,userid,reviewerid) values('$description','$rate2','$jobid','$ownerid','$empid','2', '$ownerid', '$reviewerid')";
$res=mysql_query($usersigns);
if(!$res)
{
echo "error in insert";
}

$reviews_count = "select count(*) from reviews where job_id = ". $jobid;
$res_count = mysql_query($reviews_count);
pr($res_count);

$updateuser="update buy_requirement set status='completed' where creator_id='$ownerid' and id=$jobid";
//$res1=mysql_query($updateuser);
 if(!$res1)
{
echo "error in insert";
}
 }
 
  
   $message = '<html><body>';
$message .= '<div style="background:url(http://demo.maventricks.com/lalbook/application/css/images/email_bg.png) no-repeat center;width:727px;height:318px;border:none;padding:20px 20px 0;margin:0 auto;">';
$message .='<h1 style="height:70px;margin:7px 0 0px;"><a href="#"><img src="http://demo.maventricks.com/lalbook/application/css/images/email_logo.png" alt="" style="border:none;"/></a></h1>';
  	
    $message .='<p style="font:bold 12px Arial, Helvetica, sans-serif;color:#333;margin:0 0 5px;"> Email : ' ."&nbsp;" .$from .'</p>'; 
	
	  $message .='<p style="font:bold 12px Arial, Helvetica, sans-serif;color:#333;margin:0 0 5px;"> Rate For Your Work : ' ."&nbsp;" .$rate2.'</p>'; 
	
	 $message .='<p style="font:bold 12px Arial, Helvetica, sans-serif;color:#333;margin:10px 0 5px;text-align:left;">Comments :</p>' ."&nbsp;" .$biddesc;
	
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