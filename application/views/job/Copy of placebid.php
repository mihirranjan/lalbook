<?php  

$con=mysql_connect("mysql.lalbook.com","maventricks","usertest");
$db=mysql_select_db("sathick",$con) or die("database error".mysql_error());
$business_id = $_REQUEST['business_id'];

/*
$con=mysql_connect("localhost","root","") or die("error in connection".mysql_error());
mysql_select_db("lalbook",$con);
*/

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
 

$jobamount=$_POST['hidden_jobamount'];

 if( !isset($_POST['bidamount']) || trim($_POST['bidamount'])=="" || !is_numeric($_POST['bidamount']) )
{ 

// echo "{'errors': [{'field': 'message','error': 'This field is required.'}], 'success': false}";
 $return_arr["errors"]=array(array('field'=>'bidamount','error'=>'This field is required and Bidamount should be integer'));
 $return_arr["success"]= false;
 echo json_encode($return_arr);
 return ;
}
if(isset($_POST['bidamount']))
{
if($jobamount=='<10,000')
{
if(isset($_POST['bidamount']) && $_POST['bidamount']>10000)
{
// echo "{'errors': [{'field': 'message','error': 'This field is required.'}], 'success': false}";
 $return_arr["errors"]=array(array('field'=>'bidamount','error'=>'Sorry your bid Amount is Higher than Job amount.'));
 $return_arr["success"]= false;
 echo json_encode($return_arr);
 return ;
 }
 
 }
 else if($jobamount=='10,000 - 1,00,000')
 {
 if($_POST['bidamount']<10000 && $_POST['bidamount']>100000)
 {
 // echo "{'errors': [{'field': 'message','error': 'This field is required.'}], 'success': false}";
 $return_arr["errors"]=array(array('field'=>'bidamount','error'=>'Sorry your bid Amount is Higher than Job budget.'));
 $return_arr["success"]= false;
 echo json_encode($return_arr);
 return ;
 }
 }
 else if($jobamount=='1,00,000 - 10,00,000')
 {
  if($_POST['bidamount']<100000 && $_POST['bidamount']>1000000)
 {
 // echo "{'errors': [{'field': 'message','error': 'This field is required.'}], 'success': false}";
 $return_arr["errors"]=array(array('field'=>'bidamount','error'=>'Sorry your bid Amount is Higher than Job budget.'));
 $return_arr["success"]= false;
 echo json_encode($return_arr);
 return ;
 }
 }
 else if($jobamount=='10,00,000 - 1,00,00,000')
 {
  if($_POST['bidamount']<1000000 && $_POST['bidamount']>10000000)
 {
 // echo "{'errors': [{'field': 'message','error': 'This field is required.'}], 'success': false}";
 $return_arr["errors"]=array(array('field'=>'bidamount','error'=>'Sorry your bid Amount is Higher than Job budget.'));
 $return_arr["success"]= false;
 echo json_encode($return_arr);
 return ;
 }
 }
}
/* if(!isset($_POST['email']) || trim($_POST['email'])=="" || !validEmail($_POST['email']))
 { 
    // echo "{'errors': [{'field': 'email', 'error': 'Enter a valid e-mail address.'}], 'success': false}";
     $return_arr["errors"]=array(array('field'=>'email','error'=>'Enter a valid e-mail address.'));
	 $return_arr["success"]= false;
	 echo json_encode($return_arr);
	 return;
 }*/
 if( !isset($_POST['deliverdate']) || trim($_POST['deliverdate'])=="")
{ 
// echo "{'errors': [{'field': 'message','error': 'This field is required.'}], 'success': false}";
 $return_arr["errors"]=array(array('field'=>'deliverdate','error'=>'This field is required and Please Enter Number of Days'));
 $return_arr["success"]= false;
 echo json_encode($return_arr);
 return ;
}






// if(isset($_POST['fulname']))
$req_id=$_POST['hidden_bidid'];
$bidder_id=$_POST['hidden_userid'];
 $bidamt=$_POST['bidamount'];
//  if(isset($_POST['email']))
 $biddate=$_POST['deliverdate'];
 // if(isset($_POST['password']))
 $bidhours=$_POST['delivery'];
 
//if(isset($_POST['username']))
$biddesc=$_POST['desc'];
$biddername=$_POST['hidder_bidername'];
$creditavl=$_POST['hidden_credit'];
$bidderemail=$_POST['hidden_bideremail'];
$jobname=$_POST['hidden_jobname'];
$from = $bidderemail;
$subject = 'Your Bid In Lalbook';
$to = $_POST['hidden_mail'];
$tot=$creditavl-1;
 /*if(($bidamt!='') && ($biddate!='') && ($bidhours!='') && ($biddesc!=''))
 {*/
 if($bidamt!='' && $biddate!='')
 {
 

$usersign="insert into bids(job_id,user_id,bid_days,bid_hours,bid_amount,bid_desc) values('$req_id','$bidder_id','$biddate','$bidhours','$bidamt','$biddesc')";
$res=mysql_query($usersign);

$updateuser=mysql_query("update users set credit='$tot' where id='$bidder_id'") or die("Error in update user".mysql_error());


 
 }
 /*if (isset($_POST['would_recommend']))
 $recommend=$_POST['would_recommend'];
 if(isset($_POST['want_newsletter']))
 $news=$_POST['want_newsletter'];*/
 
 
 
 $message = '<html><body>';
$message .= '<div style="background:url(http://demo.maventricks.com/lalbook/application/css/images/email_bg.png) no-repeat center;width:727px;height:318px;border:none;padding:20px 20px 0;margin:0 auto;">';
$message .='<h1 style="height:70px;margin:7px 0 0px;"><a href="#"><img src="http://demo.maventricks.com/lalbook/application/css/images/email_logo.png" alt="" style="border:none;"/></a></h1>';
    $message .='<p style="font:12px Arial, Helvetica, sans-serif;color:#333;margin:10px 0 20px;">You have Received Bids for Your Posted Job.'."&nbsp;"."<b>".ucwords($jobname)."</b>".'</p>';
	
    $message .='<p style="font:bold 12px Arial, Helvetica, sans-serif;color:#333;margin:0 0 5px;">From Email : ' ."&nbsp;". $from.'</p>'; 
	 $message .='<p style="font:bold 12px Arial, Helvetica, sans-serif;color:#333;margin:0 0 5px;">From User : ' ."&nbsp;" .ucwords($biddername) .'</p>'; 
	 $message .='<p style="font:bold 12px Arial, Helvetica, sans-serif;color:#333;margin:0 0 5px;">Bidded Amount : ' ."&nbsp;"."Rs." .$bidamt.'</p>'; 
	 $message .='<p style="font:bold 12px Arial, Helvetica, sans-serif;color:#333;margin:10px 0 5px;text-align:left;">With Message :</p>' ."&nbsp;" .$biddesc;
	
		      $message .='<p style="font:bold 12px Arial, Helvetica, sans-serif;color:#333;margin:20px 0 5px;">Best Regards,</p>';
		 $message .='<p style="font:bold 12px Arial, Helvetica, sans-serif;color:#333;margin:0 0 5px;">Team Lalbook</p>';
		 		$message .= "</div>";
		 		$message .= "</body></html>";

 
 


	  
	  
if(1)
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