<?php
	$keyword = "";
	$types = 1;
	if(isset($_POST['keyword'])){
		$keyword = $_POST['keyword'];
	}
	if(isset($_POST['types'])){
		$types = $_POST['types'];
	}
?>

<div id="selSearch">
	<p><label>Search</label>
	<form id="search"  name="search" method="post" action="<?php echo site_url('home/search'); ?>">
		<input value="<?php echo $keyword?>" type="text" name="keyword"  onblur="placeholder='Search Products'" onfocus="placeholder=''" placeholder='Search Products' id="inputTextboxes" class="clsSertxt">
		<select class="clsTopSelect" name="types">
			<option value="1" <?php echo $result = ($types == 1 ) ? "selected":""; ?> >Search for Buy Requirement</option>
			<option value="2" <?php echo $result = ($types == 2 ) ? "selected":""; ?> >Search for Merchant</option>
		</select>
	<input type="submit" value="" class="clsGobut">
</form></p>
</div>