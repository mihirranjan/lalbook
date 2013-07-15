<?php
error_reporting(0);
if(isset($_POST['submitproduct']) and $_SERVER['REQUEST_METHOD'] == "POST"){
$path = $_SERVER['DOCUMENT_ROOT'].'/lalbook/uploads/'; //set your folder path
$con=mysql_connect("localhost","maventri_lalbook",")uA4DQS#o(L6") or die("error in connection".mysql_error());
mysql_select_db("maventri_lalbooks",$con);
$filename = $_FILES['photoimg']['tmp_name']; //get the temporary uploaded image name
$valid_formats = array( "jpg","png", "gif", "bmp", "GIF","JPG","PNG"); //add the formats you want to upload
	$prprice=$_POST['price'];
	$userid=$_POST['user'];
	$description=$_POST['desc'];
	$producname=$_POST['prname'];
		$name = $_FILES['photoimg']['name']; //get the name of the image
		$size = $_FILES['photoimg']['size']; //get the size of the image
		if(($name!='') && ($prprice!=''))
		{
		if(strlen($name)) //check if the file is selected or cancelled after pressing the browse button. 
		{
			list($txt, $ext) = explode(".", $name); //extract the name and extension of the image
			if(in_array($ext,$valid_formats)) //if the file is valid go on.
			{
			if($size < 2098888) // check if the file size is more than 2 mb
			{
			$actual_image_name =  str_replace(" ", "_", $txt)."_".time().".".$ext; //actual image name going to store in your folder
			$tmp = $_FILES['photoimg']['tmp_name']; 
			if(move_uploaded_file($tmp, $path.$actual_image_name) && is_numeric($_POST['price'])) //check the path if it is fine
				{
				
					move_uploaded_file($tmp, $path.$actual_image_name); //move the file to the folder
					$qry="insert into gallery(price,description,gal_image,creator_id,productname) values('$prprice','$description','$actual_image_name','$userid','$producname')";
					$rs=mysql_query($qry);
					if(!$rs)
					{
					echo "<p>ERROR</p>"; 
					}
					else
					{
					echo "<p>Your Product Is Added</p>";
					
					}
					
					
					//display the image after successfully upload
					echo "<img src='http://demo.maventricks.com/lalbook/uploads/".$actual_image_name."'  class='preview'> <input type='hidden' name='actual_image_name' id='actual_image_name' value='$actual_image_name' />";
					
				}
			else
				{
				echo "failed.Please Enter Valide Price";
				}
			}
			else
			{
				echo "Image file size max 2 MB";					
			}
			}
			else
			{
				echo "Invalid file format..";	
			}
		}
		}
		else
		{		
		header('Location: http://demo.maventricks.com/lalbook/index.php/account?id=1');
			echo "Please select image..!";
			
		}	
		 header('refresh: 1; url=http://demo.maventricks.com/lalbook/index.php/account');	
	exit;
	}
?>
