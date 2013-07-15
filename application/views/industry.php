<?php
if(isset($result_city)){
	//echo "<pre>";print_r($result_city);
	foreach($result_city as $row_city)
	{
		$select = ($ind_id == $row_city->category) ? 'selected' : "";
		echo "<option value='".$row_city->category."'".$select.">".$row_city->category."</option>";
	}
}
?>