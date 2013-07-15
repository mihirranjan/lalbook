<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LalBook</title>
<link rel="stylesheet" type="text/css" href="css/common.css" />
<!--[if IE ]>
<link href="css/iefix.css" rel="stylesheet" type="text/css" />
<![endif]-->
<style>
.main_br {
    min-height: 487px !important;
}
.clsMessage{
    background: none repeat scroll 0 0 #F4F4F4;
    border: 1px solid #DDDDDD;
    border-radius: 10px 10px 10px 10px;
    margin: 130px auto;
    padding: 30px !important;
    width: 400px;
}
.clsMessage h2 {
    border-bottom:none !important;
    color: #565656 !important;
    font: bold 25px Arial,Helvetica,sans-serif !important;
    margin-bottom: 0px!important;
    padding: 10px 0 0px!important;
    text-align: left!important;
    text-transform: capitalize !important;
}
.message div.success,.message div.error{
    color: #5E5E5E !important;
    font: 16px Arial,Helvetica,sans-serif !important;
	text-align: left !important;
}
.message{
    margin: 0 !important;
}
.clsMessage p a{
	color:#c00000 !important;
	font:15px Arial, Helvetica, sans-serif !important;
}
.clsMessage  p{
	clear:both;
	overflow:hidden;
	text-align: left !important;
}
</style>

</head>

<body>
<div class="Container">
    <!-- Header -->
    <!--<div id="header" class="clearfix">
      <div id="selLeftHeader" class="clsFloatLeft">
        <div id="selLogo">
          <h1> <a href="#">Site name</a> </h1>
        </div>
      </div>
      <div id="selRightHeader" class="clsFloatRight">
      <div class="clsMenu">
      <ul class="clearfix">
      <li class="clsActive"><a href="#">About</a></li>
       <li><a href="#">Seller</a></li>
       <li><a href="#">Buyer</a></li>
        <li class="clsNoBorder"><a href="#">Contact us</a></li>
        <li class="clsNoBorder"><a class="clsBut" href="#">Sign Up</a></li>
      </ul>
      </div>
       
      </div>
    </div>--> <?php $this->load->view('header'); ?>
    <!-- End of Header -->
   <!-- <div id="selSearch">
    <p><label>Search </label><input type="text" value="Search for product bids" class="clsSertxt"><input type="button" value="" class="clsGobut"></p>
    </div>-->
    
    
    
    <div id="selMain clearfix">
     <!-- RC -->
    <div class="block">
      <div class="main_t">
        <div class="main_r">
          <div class="main_b">
            <div class="main_l">
              <div class="main_tl">
                <div class="main_tr">
                  <div class="main_bl">
                    <div class="main_br">
                      <div class="cls100_p">
                      <div class="clsMessage">
<h2><?php echo $this->lang->line('Message_Display');?></h2>
<!--<p><img src="<?php echo image_url();?>/error_icon.jpg" alt="" /></p>-->

 <p><?php
								//Show Flash Message
								if($msg = $this->session->flashdata('flash_message'))
								{
									echo $msg;
								}
							   ?>
							   </p>
                               <p><a href="<?php echo site_url('seller');?>">More Information...</a></p>
<!--<p>You must </p>
<h3><span>Log in</span> as  <span>Buyer</span> to </h3>
<p>Post Your Requirements</p>-->
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
                            <!--end of RC -->
    
    </div>
    
    </div>
    <!--<div id="selFooter">
    <div class="clsFooter clearfix">
    <div class="clsLeftfoot">
    <ul class="clearfix">
    <li><a href="#">Post </a></li>

      <li><a href="#">   Blogs  </a></li> 
      <li><a href="#">  Contact  </a></li>
        <li><a href="#"> Feeds  </a></li>
        <li class="clsNoBorder"><a href="#">    Privacy Policy</a></li>
    </ul>
    
    </div>
    <div class="clsRightFoot">
    <p>Lalbook © 2013. All Rights Reserved.</p>
    </div>
    <div class="clsCenterFoot">
    <ul class="clearfix">
    <li><a href="#"><img src="images/f_icon1.jpg" alt="" /></a></li>
     <li><a href="#"><img src="images/f_icon2.jpg" alt="" /></a></li>
      <li><a href="#"><img src="images/f_icon3.jpg" alt="" /></a></li>
    </ul>
    </div>
    
    </div>
    </div>-->
	 <?php $this->load->view('home_footer'); ?>
    
</body>
</html>
