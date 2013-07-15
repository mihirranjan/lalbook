<?php
// Code for cities.php
$con=mysql_connect("localhost","maventri_lalbook",")uA4DQS#o(L6");
$db=mysql_select_db("maventri_lalbooks",$con) or die("database error".mysql_error());
$business_id = $_GET['id'];


$sql_city = "SELECT * FROM gallery where id='$business_id'";
$result_city = mysql_query($sql_city);
echo "<div id='producdetail' style='border:1px solid black'> ";
while($row_city = mysql_fetch_array($result_city))
{
echo "Price:".$row_city['price']."<br>";
echo "Description:".$row_city['description']."<br>";
echo "<img src='http://demo.maventricks.com/lalbook/uploads/".$row_city['gal_image']"'  >";
}

echo "</div>";

?>