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
#header {
	margin:0 0 20px 0 !important;
	height:70px !important;
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
    </div>-->
  <?php $this->load->view('header'); ?>
  <script type="text/javascript">
 function get_cities(business_id)
{

    $.ajax({
       type: "POST",
       url: "http://demo.maventricks.com/lalbook/application/views/industry.php", /* The country id will be sent to this file */
       beforeSend: function () {
      $("#industry").html("<option>Loading ...</option>");
        },
		
       data: "business_id="+business_id,
       success: function(msg){
         $("#industry").html(msg);
       }
       });
} 
</script>
  <!-- End of Header -->
  <!--   <div id="selSearch">
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
                          <h2>Business Info</h2>
                         <div id="selSignupTab">
<ul class="clearfix">
<li><a href="#">Comapny Info</a></li>
<li  class="clsActive" style=" left: -17px; position: relative; right: 0;z-index:999;"><a href="#">Business Info</a></li>
</ul>
</div>
                          <p>Thanks for the Information.Now lets talk some business..</p>
						  
						   <?php
							
								//Show Flash Message
							
								if($msg = $this->session->flashdata('flash_message'))
								{
									echo $msg;
								}
								?>
                          <div class="clsSignupForm">
                            <form name="signuptwo" method="post" enctype="multipart/form-data">
<!--                               <p> -->
<!--                                 <label>Business Name </label> -->
<!--                                 : -->
<!--                                <input  onblur="placeholder='Business Name'" onfocus="placeholder=''" placeholder='Business name' type="text" class="clsSignTxt"  name="businessname" value="<?php echo set_value('businessname'); ?>" /> -->
<!--                               </p> -->
<!--                               <p> -->
                                <label style="width:173px;">&nbsp;</label>
                                <?php echo form_error('businessname'); ?></p>
<!--                               <p> -->
                                <label>Business Type </label>
                                :
                                <select name="bstype" class="clsSelect" onChange='get_cities(this.value)'>
                                  <option value="1" >Product</option>
                                  <option value="2" >Service</option>
                                  <option value="3" >Both</option>
                                </select>
                              </p>
                              <p>
                                <label>&nbsp;</label>
                                <span style="float:left;width:395px;padding:0 0 10px;display:block;text-align:left;margin:0 0 0 20px;"><small>(We Need to know if you deal in products or services or both  )</small></span></p>
                             <p>
                                <label>Industry Type </label>
                                :
                                <select name="industry" class="clsSelect" id="industry" >
                                  <option value="">Select industry</option>
                                </select>
                              </p>
							   <p>
                                <?php echo form_error('industry'); ?></p>
                              <p>
                              <p>
                                <label>&nbsp;</label>
                                <span style="float:left;width:395px;padding:0 0 10px;display:block;text-align:left;margin:0 0 0 20px;"><small>(This will help us in alerting you on bids that are related to your industry )</small></span></p>
                              <!--<p>
                                <label style="width:173px;">&nbsp;</label>
                                <?php echo form_error('bstype'); ?></p>-->
                              <p>
                                <label>Tin Number (Optional) </label>
                                :
                                <input onblur="placeholder='Tin Number'" onfocus="placeholder=''" placeholder='Tin Number' type="text" class="clsSignTxt" value="<?php echo set_value('tinnumber'); ?>"  name="tinnumber" />
                              </p>
                              
                                <label style="width:173px;">&nbsp;</label>
                                <?php echo form_error('tinnumber'); ?></p>
                              <p>
                                <label>Pan Number </label>
                                :
                                <input onblur="placeholder='Pan Number'" onfocus="placeholder=''" placeholder='Pan Number'  type="text" class="clsSignTxt" value="<?php echo set_value('pannumber'); ?>" name="pannumber"/>
                              </p>
                              
                                <label style="width:173px;">&nbsp;</label>
                                <?php echo form_error('pannumber'); ?></p>
                              <p>
                                <label>Business Logo(Optional)</label>
                                :
                                <input type="text" class="clspostTxt req_field"  id="txt_file" name="companylogo" onblur="placeholder='Upload a image file'" onfocus="placeholder=''" placeholder='Upload Your Company Logo' style="width:407px; height:30px"/>
                                <span class="clsCommonbut" id="file_lavel">Upload</span>
                                <input id="file_type" type="file" name="attachments"  />
                              </p>
                              <p>
                                <label>&nbsp;</label>
                                <span style="float:left;width:395px;padding:0 0 10px;display:block;text-align:left;margin:0 0 0 20px;"><small  ><?php echo "jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF" ?></small></span></p>
                              <p>
                                <label style="width:173px;">&nbsp;</label>
                                <?php echo form_error('companylogo'); ?></p>
                              <input type="hidden" name="confirmKey" value="<?php echo $this->uri->segment(3); ?>" />
                              <p>
                             
								                                <label>&nbsp;</label>
                                <input type="submit" class="clsSignBut" value="Complete Registration" name="signuptwo" />
                              </p>
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
