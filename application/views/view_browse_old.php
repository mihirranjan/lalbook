<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LalBook</title>
<link rel="stylesheet" type="text/css" href="css/common.css" />
<!--[if IE ]>
<link href="css/iefix.css" rel="stylesheet" type="text/css" />
<![endif]-->
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
	<script language="javascript" type="text/javascript">
<!--
/****************************************************
     Author: Eric King
     Url: http://redrival.com/eak/index.shtml
     This script is free to use as long as this info is left in
     Featured on Dynamic Drive script library (http://www.dynamicdrive.com)
****************************************************/
var win=null;
function NewWindow(mypage,myname,w,h,scroll,pos){
if(pos=="random"){LeftPosition=(screen.width)?Math.floor(Math.random()*(screen.width-w)):100;TopPosition=(screen.height)?Math.floor(Math.random()*((screen.height-h)-75)):100;}
if(pos=="center"){LeftPosition=(screen.width)?(screen.width-w)/2:100;TopPosition=(screen.height)?(screen.height-h)/2:100;}
else if((pos!="center" && pos!="random") || pos==null){LeftPosition=0;TopPosition=20}
settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=yes';
win=window.open(mypage,myname,settings);}
// -->
</script>
    <!-- End of Header -->
    <div id="selSearch">
    <p><label>Search </label><input type="text" value="Search for product bids" class="clsSertxt"><input type="button" value="" class="clsGobut"></p>
    </div>
    
    
    
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
                      <div class="clsAccDetails">
                      <ul class="clearfix">
                      <li>Account Balance :<span> 55 credits</span></li>
                      <li class="clsNoBorder"><a href="#"> Refill</a></li>
                      </ul>
                      </div>
                      
                      <div class="clsTab">
                      <ul class="clearfix">
                      <li class="clsActive"><a href="#">Browse</a></li>
                      <li><a href="#">My Business</a></li>
                      <li ><a href="#">My Profile</a></li>
					  <li><a href="#" onclick="NewWindow(this.href,'mywin','400','400','no','center');return false" onfocus="this.blur()">YourLinkText</a>                      
                      </ul>
                      
                      </div>
                      <div id="selProfile" class="clearfix">
                      <div class="clsSideTab">
                      <ul class="clearfix">
                      <li><a href="#">My Profile</a></li>
                      <li class="clsActive"><a href="#">Gallery View</a></li>
                      <li><a href="#">Review & Rating</a></li>
                      </ul>
                      </div>
                      
                      <div id="selMainCnt">
                      <h2>Products & Services<span>Add Products</span></h2>
                      <div class="clsGalleryList">
                      <ul class="clearfix">
                      <li><img src="<?php echo image_url();?>/g_1.jpg" alt="" /></li>
                       <li><img src="<?php echo image_url();?>/g_2.jpg" alt="" /></li>
                        <li><img src="<?php echo image_url();?>/g_3.jpg" alt="" /></li>
                        <li><img src="<?php echo image_url();?>/g_1.jpg" alt="" /></li>
                       <li><img src="<?php echo image_url();?>/g_2.jpg" alt="" /></li>
                        <li class="clsNoMargin"><img src="<?php echo image_url();?>/g_3.jpg" alt="" /></li> 
                        
                        <li><img src="<?php echo image_url();?>/g_1.jpg" alt="" /></li>                        
                       <li><img src="<?php echo image_url();?>/g_2.jpg" alt="" /></li>
                        <li><img src="<?php echo image_url();?>/g_3.jpg" alt="" /></li>
                        <li><img src="<?php echo image_url();?>/g_1.jpg" alt="" /></li>
                       <li><img src="<?php echo image_url();?>/g_2.jpg" alt="" /></li>
                        <li class="clsNoMargin"><img src="<?php echo image_url();?>/g_3.jpg" alt="" /></li>            
                      </ul>
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
    </div>--><?php $this->load->view('home_footer'); ?>
    
</body>
</html>
