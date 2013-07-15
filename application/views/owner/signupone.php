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
<style>
#header {
	margin:0 0 20px 0 !important;
	height:70px !important;
}
</style>
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
    </div>-->
	<?php $this->load->view('header'); ?>
    <!-- End of Header -->
    <!-- <div id="selSearch">
   <p><label>Search </label><input type="text" value="Search for product bids" class="clsSertxt"><input type="button" value="" class="clsGobut"></p>
    </div>
    -->
    
    
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
                      <div class="clsPoliicy">
<h2>Company Info </h2>
<div id="selSignupTab">
<ul class="clearfix">
<li class="clsActive"><a href="#">Comapny Info</a></li>
<li style=" left: -17px; position: relative; right: 0;z-index:999;"><a href="#">Business Info</a></li>
</ul>
</div>
<div class="clsSignupForm">
<form name="signupone" id="" enctype="multipart/form-data" method="post">
<p><label>Company Name		</label><input  onblur="placeholder='Companyname'" onfocus="placeholder=''" placeholder='Companyname'  type="text" class="clsSignTxt" value="" name="companyname" value="<?php echo set_value('companyname'); ?>"/></p>
<p><label style="width:173px;">&nbsp;</label><?php echo form_error('companyname');?></p>
<p><label>Company Location	</label><!--<input type="text" class="clsSignTxt" value="" name="location" />--><select name="location" size="1" class="clsSelect">
<option value="">Select Location</option>
                <?php
											if(isset($countries) and $countries->num_rows()>0)
											{
												foreach($countries->result() as $country)
												{
										  ?>
                <option value="<?php echo $country->country_symbol; ?>" <?php echo set_select('country', $country->country_symbol); ?>><?php echo $country->country_name; ?></option>
                <?php
												}//Foreach End
											}//If End
										?>
              </select></p>
<p><label style="width:173px;">&nbsp;</label><?php echo form_error('location');?></p>
<p><label>State				</label><input  onblur="placeholder='State'" onfocus="placeholder=''" placeholder='State' type="text" class="clsSignTxt" value="" name="state" value="<?php echo set_value('state'); ?>"/></p>
<p><label style="width:173px;">&nbsp;</label><?php echo form_error('state');?></p>
<p><label>Pin Code			</label><input  onblur="placeholder='Pincode'" onfocus="placeholder=''" placeholder='Pincode' type="text" class="clsSignTxt" value="<?php echo set_value('pincode'); ?>" name="pincode"/></p>
<p><label style="width:173px;">&nbsp;</label><?php echo form_error('pincode');?></p>
<p><label>Registered Address	</label><textarea  onblur="placeholder='Registered Address'" onfocus="placeholder=''" placeholder='Registered Address '  cols="58" rows="10" name="raddrs"></textarea></p>
<p><label style="width:173px;">&nbsp;</label><?php echo form_error('raddrs');?></p>
<p><label>Mobile				</label><input  onblur="placeholder='Mobile'" onfocus="placeholder=''" placeholder='Mobile' type="text" class="clsSignTxt" name="mobile" value="<?php echo set_value('mobile'); ?>" /></p>
<p><label style="width:173px;">&nbsp;</label><?php echo form_error('mobile');?></p>
<p><label>Landline				</label><input onblur="placeholder='Landline'" onfocus="placeholder=''" placeholder='Landline' type="text" class="clsSignTxt"  name="landline" value="<?php echo set_value('landline'); ?>" /></p>
<p><label style="width:173px;">&nbsp;</label><?php echo form_error('landline');?></p>

<p><label>Quick Summary</label><textarea onblur="placeholder='Summary'" onfocus="placeholder=''" placeholder='Summary' cols="58" rows="10" name="summary"></textarea></p>
<p><label>&nbsp;</label><span style="float:left;width:395px;padding:0 0 10px;display:block;text-align:left;margin:0 0 0 20px;"><small>(Note: A short descrption about your business, company and type of products/service offered )</small></span></p>
<p style="clear:both;overflow:hidden;"><label style="width:173px;">&nbsp;</label><?php echo form_error('summary');?></p>
 <input type="hidden" name="confirmKey" value="<?php echo $this->uri->segment(3); ?>" />
<p style="clear:both;overflow:hidden;"><label>&nbsp;</label><input type="submit" class="clsSignBut" value="Proceed" name="signupone" /></p>
</form>
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
    </div>-->
    <?php $this->load->view('home_footer'); ?>
</body>
</html>
