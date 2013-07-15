<?php
$con=mysql_connect("localhost","maventri_lalbook",")uA4DQS#o(L6") or die("error in connection".mysql_error());
mysql_select_db("maventri_lalbooks",$con);
$file = isset($_FILES['uploadFile']['name']) ? $_FILES['uploadFile'] : '';
$usid=$_POST['usid'];
//echo $usid;
$fileArr = explode("." , $file["name"]);

$ext = $fileArr[count($fileArr)-1];

$allowed = array("jpg", "jpeg", "png", "gif", "bmp");
$rootpath =  $_SERVER['DOCUMENT_ROOT'];
if (in_array($ext, $allowed)){
$imgee=$file["name"];

    move_uploaded_file($file["tmp_name"],$rootpath.'/lalbook/files/logos/'.$file["name"]);
	$qry="update users set logo=$imgee where id=$usid ";
					$rs=mysql_query($qry);
    echo $file["name"];
}else{
    echo "invalid";
}

?>