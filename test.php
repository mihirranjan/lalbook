<?php
$con=mysqli_connect("mysql.lalbook.com","maventricks","usertest","sathick");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
else
	echo "mysql connected";
	
mysqli_close($con);
?>