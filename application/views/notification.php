<?php  
$con=mysql_connect("localhost","maventri_lalbook",")uA4DQS#o(L6") or die("error in connection".mysql_error());
mysql_select_db("maventri_lalbooks",$con);
$req_id=$_POST['rating'];
$jobid=$_POST['jobid'];
//echo $jobid;
echo "UPDATE message SET notification_status='0' WHERE to_id=$req_id && id=$jobid";
        $query = mysql_query("UPDATE message SET notification_status='0' WHERE to_id=$req_id && id=$jobid")or die("error in ".mysql_error());
       
?>  