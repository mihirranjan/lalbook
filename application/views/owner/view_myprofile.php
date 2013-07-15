<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LalBook</title>
<!--<link rel="stylesheet" type="text/css" href="css/common.css" />-->
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
    </div>-->
	<?php $this->load->view('header'); ?>
	<script type="text/javascript">
	$(document).ready(function() {
   $('#prof').hide();
   $('#hideprof').hide();
   $('#editprof').click(function(){
     $('#prof').show();
	  $('#hideprof').show();
   });
   $('#hideprof').click(function(){
   $('#prof').hide();
    $('#hideprof').hide();
   });
   
 });
 </script>
	<script type="text/javascript" src="<?php echo base_url();?>application/js/reCopy.js"></script>
<script type="text/javascript">
$(function(){
  var removeLink = ' <a class="remove" href="#" onclick="$(this).parent().slideUp(function(){ $(this).remove() }); return false">remove</a>';
$('a.add').relCopy({ append: removeLink});	
$('a.addone').relCopy({ append: removeLink});	
$('a.addfile').relCopy({ append: removeLink});
});
</script>
<style type="text/css">
body{ font-family:Arial, Helvetica, sans-serif; font-size:13px; }
.remove {color:#cc0000}
.input{ border: solid 1px #006699; padding:3px}

</style>
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
					   <?php  if(isset($userrecords))
						 {
						
						  foreach($userrecords->result() as $userdetails)
						    {
							
							$usrcredits=$userdetails->credit;?>
                      <li <?php if($usrcredits!=0) { echo 'class="clsNoBorder"';} ?>>Bidding credits Available:<span> <?php echo $userdetails->credit;?>&nbsp;credits</span></li>
					  <?php if($usrcredits==0) 
					  {
					  ?>
                      <li class="clsNoBorder"><a href="#">Refill</a></li>
					  <?php } ?>
                      </ul>
                      </div>
                      <!--<div class="clsTab">
                      <ul class="clearfix">
					   <li class="clsActive"><a href="<?php  echo site_url('account'); ?>">My Profile</a></li> 
                      <!--<li><a href="#">Browse</a></li>-->
                 <!--     <li><a href="<?php  echo site_url('mybusiness'); ?>">My Business</a></li>
                           <!--<li><a href="<?php  echo site_url('requirement/create'); ?>"><?php echo $this->lang->line('Post Requirement'); ?></a></li>        -->       
                     <!-- </ul>
                      
                      </div>--><?php $this->load->view('view_innermenu'); ?>
                      <div id="selProfile" class="clearfix">
                      <div class="clsProfileRight">
                      <p>Reputation :</p>
                      <p><img src="<?php echo image_url();?>/rating_sta.jpg" alt="" /><span>4.1/5.0</span></p>
                      <p class="Align"><a href="#">250 Reviews</a></p>
                      </div>
                      <div class="clsProfileLeft">
                      <div class="clsProfileDetails clearfix">
                      <div class="clsprofileimg">
					 

									<div class="vcard">
									
									<?php 
									$usrimg=$userdetails->logo; 
									
									if(!isset($usrimg))
									{
									
									?>
                      <img src="<?php echo image_url();?>/profile_img.jpg" alt="" />
					  	<?php } ?>
						<?php if(isset($usrimg)){ ?>
										<img class='thumbnail' src='<?php echo base_url();?>files/logos/<?php echo $usrimg;?>' alt="" />
										<?php } ?>
                      </div>
                      <div class="clsProfileInfo">
                      <p>MavenTricks DES <span><img src="<?php echo image_url();?>/tick_icon.png" alt="" /> Verified</span></p>
                      <p>Location : <?php echo $userdetails->city;?><span><a href="#" id="editprof">Edit</a></span></p>
                      </div>
                      
</div>
<div class="clsCompantDetails">
<?php  
								//Show Flash Error Message
							
								/*if($msg = $this->session->flashdata('flash_message'))
									{
									echo $msg;
									}*/
									
								 								  
								  
								  ?>
<h3>Company Details</h3>
<form name="profile" enctype="multipart/form-data" action="<?php echo site_url('account/updateuserprofile/'.$userdetails->activation_key) ;  ?>" method="post">

<p id="prof"><label>Change your image:</label><input type="file" name="profilepic" /><small style="color:red;" ><?php echo $this->lang->line('allowed files'); ?></small><span> <a href="#" id="hideprof">remove</a></p>
<?php echo form_error('profilepic'); ?>
<p><label>Company Name : </label><input type="text" class="clsCTxt" value="<?php echo $userdetails->organisation;?>" name="companyname" /><!--<span><a href="#">Edit</a></span>--></p><?php echo form_error('companyname'); ?>

<p><label>Address : </label><textarea cols="28" rows="7" name="adrs" ><?php echo $userdetails->address;?></textarea><!--<span><a href="#">Edit</a></span>--></p>
<?php echo form_error('adrs'); ?>
<p><label>Landline : </label><p class="cloneone"><input type="text" class="clsCTxt" value="<?php echo $userdetails->phone;?>" name="landline[]" /></p><span><!--<a href="#">Edit</a>-->&nbsp;<a href="#" class="addone" rel=".cloneone"><img src="<?php echo image_url();?>/plus_icon.png" alt="" /></a></span></p>
<?php echo form_error('landline[]'); ?>
<p><label>Mobile No. : </label><p class="clone"><input type="text" class="clsCTxt" value="<?php echo $userdetails->mobile;?>" name="mobile[]"/></p><span><!--<a href="#">Edit</a>-->&nbsp;<a href="#" class="add" rel=".clone"><img src="<?php echo image_url();?>/plus_icon.png" alt="" /></a></span></p>
<?php echo form_error('mobile[]'); ?>
<p><label>Business Type :</label><select name="bstype"><option value="1" <?php $btype=$userdetails->business_type; if($btype==1) {echo "selected";}?>>Product</option><option value="2" <?php if($btype==2) { echo "selected";}?>>Service</option></select><!--<span><a href="#">Edit</a></span>--></p>
<?php echo form_error('bstype'); ?>
<p><label>Industry :</label><!--<input type="text" class="clsCTxt" value="Maventricks" />--><select name="indsutry"><option value="1" <?php $btype=$userdetails->business_type; if($btype==1) {echo "selected";}?>>Product</option><option value="2" <?php if($btype==2) { echo "selected";}?>>Service</option></select><!--<span><a href="#">Edit</a></span>--></p>
<?php echo form_error('indsutry'); ?>
<p><label>Website :</label><input type="text" class="clsCTxt" value="<?php echo $userdetails->website;?>" name="webs"/><!--<span><a href="#">Edit</a></span>--></p>
<?php echo form_error('webs'); ?>
<p><label>About US :</label><textarea cols="45" rows="7" name="about" ><?php echo $userdetails->aboutus;?></textarea><!--<span><a href="#">Edit</a></span>--></p>
<?php echo form_error('about'); ?>
<p><label>&nbsp;</label><input type="submit" class="clsCommonbut" value="Submit" name="editmyProfile"/></p>



</form>
<?php } }
											?>
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
    
    </div> </div>
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
    </div>
	<?php $this->load->view('home_footer'); ?>
    
</body>
</html>
