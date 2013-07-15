<?php
	session_start();
	
	include "db.php";
	
	function isValidEmail($email){
    return preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email);
	}
	
	if(isset($_POST['site_admin_mail'])){
	$email = trim($_POST['site_admin_mail']);
	
 	if(isValidEmail($email))
		$valid_email = $email;
	else
	 	$email = '';
	}
	
	if(	isset($_POST['submit']) && $_POST['submit'] == 'Submit' &&
		trim($_POST['site_title']) != '' &&
		isset($valid_email)!= '' &&
		trim($_POST['admin_password']) != ''){
	
	osc_db_connect($_SESSION['mysql_host'], $_SESSION['mysql_uname'], $_SESSION['mysql_password']);
  osc_db_select_db($_SESSION['mysql_db']);

  osc_db_query('update settings set string_value = "' . trim($_POST['site_title']) . '",created = "'.time().'" where code = "SITE_TITLE"');
  osc_db_query('update settings set string_value = "' . trim($_POST['site_admin_mail']) . '",created = "'.time().'" where code = "SITE_ADMIN_MAIL"');
   osc_db_query('update settings set string_value = "' . trim($_SESSION['baseurl']) . '",created = "'.time().'" where code = "BASE_URL"');
  
  //echo 'select admin_name from admins where admin_name = "' . trim($HTTP_POST_VARS['admin_name']) . '"';exit;
  $check_query = osc_db_query('select admin_name from admins where admin_name = "' . trim($_POST['admin_name']) . '"');

  if (osc_db_num_rows($check_query)) {
    osc_db_query('update admins set password = "' . trim(hash('sha384',$_POST['admin_password'])) . '" where admin_name = "' . trim($_POST['admin_name']) . '"');
  } else {
    osc_db_query('insert into admins set admin_name = "' . trim($_POST['admin_name']) . '", password = "' . trim(hash('sha384',$_POST['admin_password'])) . '"');
  }
  header('Location: complete.php');
  }
  elseif(isset($_POST['submit']) && $_POST['submit'] == 'Submit')
	{
		$site_title	= trim($_POST['site_title']);
  		$site_admin_mail	= trim($_POST['site_admin_mail']);
		$admin_name	= trim($_POST['admin_name']);
		$admin_password	= trim($_POST['admin_password']);
		
		$error = 'All the fields are required';
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/common.css" rel="stylesheet" type="text/css" /> 
<link href="css/style.css" rel="stylesheet" type="text/css" /> 
<title>BIDONN Step-3</title>
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
												    <img src="images/s3.jpg" alt="Step-1" />
					</div>
                        <!--RC--><form name="settings" method="post" action="">
                        <div id="selMain" class="clsclearfix">
						<h2>Site Settings</h2>
						<div class="clsContant">
						<div class="clsForm">
							<?php
	if(isset($error))
	echo '<div id="error" class="error"><font>' . $error . '</font></div><BR>';
	?>
   
		<br><br>
		
		
				<table width="70%" cellpadding="12" cellspacing="0" border="0">
					<tr>
						<td width="25%"><span>Site Title:</span></td>
						<td><p><input type="text" class="clst"  name="site_title" size="35" value="<?php if(isset($site_title)) echo $site_title; ?>" />&nbsp;<font><?php if(isset($_POST['submit']) && $_POST['submit'] == 'Submit' && trim($_POST['site_title']) == '')echo 'Please Enter site Title*';?></font></p></td>
					</tr>
					
					<tr>
						<td width="25%"><span>Site Admin Email:</span></td>
						<td><p><input type="text" class="clst"  name="site_admin_mail" size="35" value="<?php if(isset($site_admin_mail)) echo $site_admin_mail; ?>" />&nbsp;<font><?php if(isset($_POST['submit']) && $_POST['submit'] == 'Submit' && trim($_POST['site_admin_mail']) == ''){echo 'Please Enter Admin Email Id*';} elseif(isset($_POST['submit']) && $_POST['submit'] == 'Submit' && $email == ''){ echo 'Please Enter Valid Email Id*';}?></font></p></td>
					</tr>
					<tr>
						<td width="25%"><span>Admin Username:</span></td>
						<td><p><input type="text" class="clst"  name="admin_name" size="35" value="<?php if(isset($admin_name)) echo $admin_name; ?>" />&nbsp;<font><?php if(	isset($_POST['submit']) && $_POST['submit'] == 'Submit' &&trim($_POST['admin_name']) == '')echo 'Please Enter Admin Username*';?></font></p></td>
					</tr>
					<tr>
						<td width="25%"><span>Admin Password:</span></td>
						<td><p><input type="text" class="clst"  name="admin_password" size="35" value="<?php if(isset($admin_password)) echo $admin_password; ?>" />&nbsp;<font><?php if(	isset($_POST['submit']) && $_POST['submit'] == 'Submit' && trim($_POST['admin_password']) == '')echo 'Please Enter Admin Password*';?></font></p></td>
					</tr>
				</table>             
		
		<br><br><br>
		<table width="70%" cellpadding="12" cellspacing="0" border="0">
			<tr>
				<td width="25%" colspan="2"><p><font>* required</font></p></td>
				
			</tr>
		</table>
	
	
						</div>
						</div>
							
				<br><br>			
							
							<p class="clsAlign"><input type="submit" name="submit" class="clsbtn" value="Submit" /></p>
								</div></form>
								
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
	                </div>
    <!--end of RC-->
	
	<div id="footer">
	<p>Copyright &copy; 2012 BIDONN (Copyright Policy, Trademark Policy) </p>

	</div>
	
</div>

</body>
</html>