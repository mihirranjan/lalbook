<?php
	session_start();
	
	if($_SESSION['baseurl'] == '')
		$url	= '../../';
	else
		$url	= $_SESSION['baseurl']; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/common.css" rel="stylesheet" type="text/css" /> 
<link href="css/style.css" rel="stylesheet" type="text/css" /> 
<title>BIDONN Step-4</title>
</head>

<body>
<div id="container">
<div id="header" class="clearfix">
                    
						<div id="selLeftHeader">
                         <h1><a href="http://demo.maventricks.com/bidonn">BIDONN</a></h1>
						</div>
						<div id="selRightHeader">
						<ul>
					<li><a href="http://demo.maventricks.com/bidonn" target="_blank">BIDONN</a></li>
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
												    <img src="images/s4.jpg" alt="Step-1" />
							</div>
                        <!--RC-->
                        <div id="selMain">
						<p class="clsHead">Installation is Completed Succesfully.</p>
						<p>
						<!--Installation Complete, will be redirected to the home page. If not <a href="<?php echo $url; ?>">click here</a>.-->
	Congratulations!! You have successfully installed BIDONN script on your server!<br /><br />
	 
	Please choose appropriate  action:<br>
	<br>Good Luck!<br />
	
	
						</p>
						
						
						
						</div>
						<p class="clsAlign"><input type="button" name="home" value="Site Home" class="clsbtn" onClick="window.location='<?php echo $url; ?>'">&nbsp;&nbsp;&nbsp;<input class="clsbtn" type="button" name="home" value="Site Admin" onClick="window.location='<?php echo $url; ?>index.php/administration'"></p>
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
