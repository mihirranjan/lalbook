<?php  



 
if(!isset($_POST['editdamount']) || trim($_POST['editdamount'])=="")
{ 
// echo "{'errors': [{'field': 'message','error': 'This field is required.'}], 'success': false}";
 $return_arr["errors"]=array(array('field'=>'editdamount','error'=>'This field is required.'));
 $return_arr["success"]= false;
 echo json_encode($return_arr);
 return ;
}




// if(isset($_POST['fulname']))
$jobid=$_POST['hidden_bidamnt'];
$editedamt=$_POST['editdamount'];
 if($editedamt!='')
 {
  
 $con=mysql_connect("localhost","maventri_lalbook",")uA4DQS#o(L6") or die("error in connection".mysql_error());
mysql_select_db("maventri_lalbooks",$con);

$usersign="update buy_requirement set awarded_amount=$editedamt where id=$jobid";
$res=mysql_query($usersign);
$awardeamt=mysql_query("update reviews set awarded_amount=$editedamt where job_id=$jobid");

//$updateuser=mysql_query("update users set credit='$tot' where id='$bidder_id'") or die("Error in update user".mysql_error());
$return_arr["success"]= true;
  echo json_encode($return_arr);	 
 
 }
 /*if (isset($_POST['would_recommend']))
 $recommend=$_POST['would_recommend'];
 if(isset($_POST['want_newsletter']))
 $news=$_POST['want_newsletter'];*/
 

 



?>