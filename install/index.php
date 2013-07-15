<?php
session_start();
require_once("../application/config/config.php");
include "db.php";

if(	$config['hostname'] != '' &&
		$config['db_username'] != '' && 
		$config['db'] != '')
	{
$link = @osc_db_connect(trim($config['hostname']), trim($config['db_username']), trim($config['db_password']));

if (!$link) 
{
   $error = 'Could not connect to the host specified. Error: ' . mysql_error();
}
else
{
	//Connected successfully
	$db_selected = @osc_db_select_db(trim($config['db']));
	
	if (!$db_selected) 
	{
	   $error	= $error . '<BR>Can\'t use the database specified. Error: ' . mysql_error();
	}
	
	//mysql_close($link);
}
//echo $error;exit;
$sql = " SHOW TABLES FROM ".trim($config['db']);

$result = osc_db_query($sql);

if (!$result) {
    echo "DB Error, could not list tables\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}

$numtable = osc_db_num_rows($result);

mysql_free_result($result);

if($numtable > 0){
	header("Location: ../");
}

}
$compat_register_globals = true;

if (function_exists('ini_get') && (PHP_VERSION < 4.3) && ((int)ini_get('register_globals') == 0)) {
	$compat_register_globals = false;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/common.css" rel="stylesheet" type="text/css" /> 
<link href="css/style.css" rel="stylesheet" type="text/css" /> 
<title>BIDONN Step-1</title>
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

						
                    
	 <!--RC-->
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
												<img src="images/s1.jpg" alt="Step-1" />
							       </div>
                        <!--RC-->
                        <div id="selMain">
						<h2>New Installation</h2>
						<h3>Version 1.1</h3>
						
<table border="0" width="100%" cellspacing="0" cellpadding="2">
        <tr>
          <td><b>System Requirements - Check the following requirements before installation:</b></td>
          <td align="right"></td>
          <td align="right" width="25"></td>
        </tr>
        <tr>
          <td><li>Linux Server</li></td>
          <td align="right"></td>
          <td align="right"></td>
        </tr>
        <tr>
          <td><li>Apache version</li></td>
          <td align="right"></td>
          <td align="right">2.2.4</td>
        </tr>
        <tr>
          <td><li>PHP version</li></td>
          <td align="right"></td>
          <td align="right">5.3.8</td>
        </tr>
        <tr>
          <td><li>MySQL version</li></td>
          <td align="right"></td>
          <td align="right">5.0.33</td>
        </tr>
		        
      </table>
	  
	  <table border="0" width="100%" cellspacing="0" cellpadding="2">
        <tr>
          <td><b>Information you will need for installation:</b></td>
          <td align="right"></td>
          <td align="right" width="25"></td>
        </tr>
        <tr>
          <td><li>MySQL Host Name (usually 'localhost')</li></td>
          <td align="right"></td>
          <td align="right"></td>
        </tr>
        <tr>
          <td><li>MySQL Username</li></td>
          <td align="right"></td>
          <td align="right"></td>
        </tr>
        <tr>
          <td><li>MySQL Password</li></td>
          <td align="right"></td>
          <td align="right"></td>
        </tr>
        <tr>
          <td><li>MySQL Database Name</li></td>
          <td align="right"></td>
          <td align="right"></td>
        </tr>
        
      </table>
						</p>
					
						</div>
						<p class="clsAlign"><input type="button" name="" class="clsbtn" value="Continue" onClick="window.location='install.php'" /> </p>
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
	<p>Copyright &copy; Maventricks 2013 BIDONN (Copyright Policy, Trademark Policy) </p>
	</div>
	
</div>

</body>
</html>