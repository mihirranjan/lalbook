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
if( !isset($_POST['message']) || trim($_POST['message'])=="")
{ 
// echo "{'errors': [{'field': 'message','error': 'This field is required.'}], 'success': false}";
 $return_arr["errors"]=array(array('field'=>'message','error'=>'This field is required.'));
 $return_arr["success"]= false;
 echo json_encode($return_arr);
 return ;
}
 else if(!isset($_POST['email']) || trim($_POST['email'])=="" || !validEmail($_POST['email']))
 { 
    // echo "{'errors': [{'field': 'email', 'error': 'Enter a valid e-mail address.'}], 'success': false}";
     $return_arr["errors"]=array(array('field'=>'email','error'=>'Enter a valid e-mail address.'));
	 $return_arr["success"]= false;
	 echo json_encode($return_arr);
	 return;
 }
  
//  

$to = 'wpsnowwolf@gmail.com';
$subject = 'birghtyoursite  ajaxpop form';
$from = $_POST['email'];
$msg=$_POST['message'];
$rate1="";
$rate2="";
$rate3="";
$recommend="";
 $news="";
 if(isset($_POST['rating_1']))
 $rate1=$_POST['rating_1'];
  if(isset($_POST['rating_2']))
 $rate2=$_POST['rating_2'];
  if(isset($_POST['rating_3']))
 $rate3=$_POST['rating_3'];
 if (isset($_POST['would_recommend']))
 $recommend=$_POST['would_recommend'];
 if(isset($_POST['want_newsletter']))
 $news=$_POST['want_newsletter'];
$message ="<table border='0' >".	  
	  "<tr><td>email</td><td>$from</td></tr>".
	  "<tr><td> comments </td><td>$msg</td></tr>".
	  "<tr><td>Services:</td><td>$rate1</td></tr>".
	  "<tr><td>tools:</td><td>$rate2</td></tr>".
	  "<tr><td>site:</td><td>$rate3</td></tr>".
	  
	  "</table>";

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