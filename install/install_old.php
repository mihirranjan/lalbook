<?php
	session_start();
	
	include "db.php";
			
	$baseURL	= 'http://' . $_SERVER['SERVER_NAME'] . str_replace('\\', '/', $_SERVER['PHP_SELF']);

	$length		= strlen($baseURL) - strlen('install/install.php');
	
	$length2		= strlen($_SERVER['PHP_SELF']) - strlen('install/install.php');
	
	$folder	= substr($_SERVER['PHP_SELF'], 0, $length2);
	
	//$folder = str_replace("/"," ",$folder);
	
	$baseURL	= substr($baseURL, 0, $length);

	$mysqlHost	= '';
	$mysqlUname	= '';
	$mysqlPass	= '';
	$mysqlDB	= '';
	
	if(	isset($_POST['submit']) && $_POST['submit'] == 'Submit' &&
		trim($_POST['base_url']) != '' &&
		trim($_POST['mysql_host']) != '' &&
		trim($_POST['mysql_uname']) != '' && 
		trim($_POST['mysql_db']) != '')
	{
		$error	= '';
		$link = @osc_db_connect(trim($_POST['mysql_host']), trim($_POST['mysql_uname']), trim($_POST['mysql_password']));
		if (!$link) 
		{
		   $error = 'Could not connect to the host specified. Error: ' . mysql_error();
		}
		else
		{
			//Connected successfully
			$db_selected = @osc_db_select_db(trim($_POST['mysql_db']));
			
			if (!$db_selected) 
			{
			   $error	= $error . '<BR>Can\'t use the database specified. Error: ' . mysql_error();
			}
			
			//mysql_close($link);
		}

		$baseURL	= trim($_POST['base_url']);
		$mysqlHost	= trim($_POST['mysql_host']);
		$mysqlUname	= trim($_POST['mysql_uname']);
		$mysqlPass	= trim($_POST['mysql_password']);
		$mysqlDB	= trim($_POST['mysql_db']);
		
		if($error == '')
		{			
			$basePath	= dirname(__FILE__);
			
			$db_error = false;
			$sql_file = $basePath . '/bidonn.sql';
	
			osc_set_time_limit(0);

			osc_db_install($mysqlDB, $sql_file);

			/* Create the config file */
			$file1		= file_get_contents($basePath . '/temp/config1.cfg');
			$file2		= trim($_POST['base_url']);
			$file3		= file_get_contents($basePath . '/temp/config2.cfg');
			
			$file4 		= '$config[\'hostname\'] = "'. trim($_POST['mysql_host']) .'";
$config[\'db_username\'] = "'. trim($_POST['mysql_uname']) .'";
$config[\'db_password\'] = "'. trim($_POST['mysql_password']) .'";
$config[\'db\'] = "'. trim($_POST['mysql_db']) .'";';

			$file5		= file_get_contents($basePath . '/temp/config3.cfg');
			$file6		= trim($_POST['folder']);
			$file7		= file_get_contents($basePath . '/temp/config4.cfg');
			
			$configFile	= $file1 . $file2 . $file3 . $file4 . $file5 . $file6 . $file7;
			
			$handle	= fopen('config.php', 'w+');
			if($handle)
			{
				fwrite($handle, $configFile);
				fclose($handle);
			}
			
			//Copy the config file
			if(file_exists($basePath . '../application/config/config.php'))
			{
				if(file_exists($basePath . '../application/config/config.php.bak'))
					@unlink($basePath . '../application/config/config.php.bak');
					
				@rename($basePath . '../application/config/config.php', $basePath . '../application/config/config.php.bak');
			}
				
			@chmod($basePath . '/../application/config/config.php', 0777);
			copy($basePath . '/config.php', $basePath . '/../application/config/config.php');
		
			
			$_SESSION['baseurl'] = trim($_POST['base_url']);
			$_SESSION['mysql_host'] = trim($_POST['mysql_host']);
			$_SESSION['mysql_uname'] = trim($_POST['mysql_uname']);
			$_SESSION['mysql_password'] = trim($_POST['mysql_password']);
			$_SESSION['mysql_db'] = trim($_POST['mysql_db']);
			
			rename($basePath . '/install.php', $basePath . '/install_old.php');
			header('Location: siteDetails.php');
		}
	}
	elseif(isset($_POST['submit']) && $_POST['submit'] == 'Submit')
	{
		$baseURL	= trim($_POST['base_url']);
		$mysqlHost	= trim($_POST['mysql_host']);
		$mysqlUname	= trim($_POST['mysql_uname']);
		$mysqlPass	= trim($_POST['mysql_password']);
		$mysqlDB	= trim($_POST['mysql_db']);
		
		$error = 'All the fields are required';
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/common.css" rel="stylesheet" type="text/css" /> 
<link href="css/style.css" rel="stylesheet" type="text/css" /> 
<title>BIDONN Step-2</title>
</head>

<body>
<div id="container">
<div id="header" class="clearfix">
					
						<div id="selLeftHeader">
                        <h1><a href="http://product.maventricks.com/bidonn">BIDONN</a></h1>
						</div>
						<div id="selRightHeader">
						<ul>
					<li><a href="http://product.maventricks.com/bidonn" target="_blank">BIDONN</a></li>
					<li class="clsNoBg"><a href="http://maventricks.com" target="_blank">Maventricks</a></li>
 					</ul>
					</div>
					</div>
				

	
	
						

	               <div id="main">
    <div class="block">
      <div class="b_t">
        <div class="b_r">
          <div class="b_b">
            <div class="b_l">
              <div class="b_tl">
                <div class="b_tr">
                  <div class="b_bl">
                    <div class="b_br">
                      <div class="cls100_p">
					  <div id="selBanner">
                        							<h2>BIDONN Installation Steps</h2>
												    <img src="images/s2.jpg" alt="Step-1" />
							</div>
                        <!--RC-->
                        <div id="selMain" class="clsclearfix">
						<h2>Database Server</h2>
						<div class="clsContant">
						<div class="clsForm">
						
						  <?php
	// PHP5?
	if(!version_compare(phpversion(), '5.0', '>=')) {
		echo 'OOps!! <strong>Installation error:</strong> in order to run BIDONN you need PHP5. Your current PHP version is: ' . phpversion();
	} 
	else
	{
		if(isset($error))
		echo '<div id="error" class="error"><font>' . $error . '</font></div><BR>';
	?> 
		<br><br>
		<form name="installFrm" method="post" action="">
				<table width="70%" cellpadding="12" cellspacing="0" border="0">
					<tr>
						<td width="25%"><span>Base URL:</span></td>
						<td><p><input class="clst" type="text" name="base_url" size="50" value="<?php echo $baseURL; ?>" />&nbsp;<font><?php if(isset($_POST['submit']) && $_POST['submit'] == 'Submit' && trim($_POST['base_url']) == '') echo 'Please Enter Base URL*';?></font></p></td>
					</tr>
				</table>             
						<table width="70%" cellpadding="12" cellspacing="0" border="0">
					<tr>
						<td width="25%"><span>Host Name:</span></td>
						<td><p><input type="text"  class="clst" name="mysql_host" size="50" value="<?php echo $mysqlHost; ?>" />&nbsp;<font><?php if(isset($_POST['submit']) && $_POST['submit'] == 'Submit' && trim($_POST['mysql_host']) == '') echo 'Please Enter Host Name*';?></font></p></td>
					</tr>
					<tr>
						<td width="25%"><span>User Name:</span></td>
						
						<td><p><input type="text" class="clst" name="mysql_uname" size="50" value="<?php echo $mysqlUname; ?>" />&nbsp;<font><?php if(isset($_POST['submit']) && $_POST['submit'] == 'Submit' && trim($_POST['mysql_uname']) == '')echo 'Please Enter User Name*';?></font></p></td>
					</tr>
					<tr>
						<td width="25%"><span>Password:</span></td>
						
						<td><p><input type="text" class="clst" name="mysql_password" size="50" value="<?php echo $mysqlPass; ?>" />&nbsp;<font><?php if(isset($_POST['submit']) && $_POST['submit'] == 'Submit' &&trim($_POST['mysql_password']) == '') echo 'Please Enter Password*';?></font></p></td>
					</tr>
					<tr>
						<td width="25%"><span>Database Name:</span></td>
						<td><p><input type="text" class="clst" name="mysql_db" size="50" value="<?php echo $mysqlDB; ?>" />&nbsp;<font><?php if(isset($_POST['submit']) && $_POST['submit'] == 'Submit' && trim($_POST['mysql_db']) == '') echo 'Please Enter Database Name*';?></font></p></td>
					</tr>
				</table>             
		
		<br><br>
		<table width="70%" cellpadding="12" cellspacing="0" border="0">
			<tr>
				<td width="25%"><p> <font>*  Require</font></p></td>
				<td>&nbsp;&nbsp;
				<input type="hidden" name="folder" value="<?php echo $folder; ?>">

				</td>
			</tr>
		</table></div>
						</div>
	   <p style="text-align: right;"><input type="submit" name="submit" value="Submit" class="clsbtn"></p>
	</form>
	<?php
    } // End of else
    ?>
						   
						
						
						</div>
								
						</div>
                        <!--RC-->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
	  <div id="footer">
	<p>Copyright &copy; 2012 BIDONN (Copyright Policy, Trademark Policy) </p>
	</div>              </div>
    <!--end of RC-->
	
	
	
</body>

</html>