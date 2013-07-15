<?php

/*
		Author: Iwebux
		Description: configure db connection
		Copyright: iwebux.com
*/
 $con=mysql_connect("localhost","maventri_lalbook",")uA4DQS#o(L6") or die("error in connection".mysql_error());
mysql_select_db("maventri_lalbooks",$con);

/*Check for data from the browser*/

if(isset($_POST['rownum']))
{
	update_data($_POST['field'],$_POST['value'],$_POST['rownum']);
}

function get_data()
{
	
	$sql = "select * from bids";
	
	$rs = mysql_query($sql);
	
	return $rs;
}
/*Update records in db*/
function update_data($field, $data, $rownum)
{

	
	$sql = "update bids set awarded_amount=$_POST['value'] where id=$_POST['rownum']";
	
	mysql_query($sql) or die("Couldn't connect to db");
	
	
}

?>