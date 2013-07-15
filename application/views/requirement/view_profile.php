<?php $this->load->view('header'); ?>


<div class="clsMinContent clearfix">
<?php $this->load->view('sidebar'); ?>
<style>
.clsInnerCommon li{
	background:none!important;
	padding:0 !important;
}
.clsOptionalDetails li {
    list-style-type: none!important;
}
.clsOptionalDetails ul {
    padding-left: 1em !important;
}
.clsInnerCommon form p, .clsPostProject p, .clsInnerCommon p, .clsInnerCommon ul {
    padding-left: 0 !important;
}
.clsInnerCommon ul {
    padding-left: 2em !important;
}
.clsPostProject li ul {
    background: none repeat scroll 0 0 hsl(0, 0%, 97%);
    border-bottom: 1px dashed hsl(0, 0%, 87%);
    margin: 0 20px 10px 0;
    padding: 10px !important;
}
.clsFloatedList{
    clear: both;
    overflow: hidden;
    padding: 10px !important;
}
.clsPercent50 {
    width: 60%!important;
}
.clsOptionalDetails li.clSNoBack ul:hover{
	background:#EFEDED;
	}
/*.clsOptionalDetails ul:hover{
	background:#EDF8FE;
}*/
li h5{
	margin-top:5px;
}
.clsPostProject label{
	float:left;
	width:120px;
	text-align:left;
	display:block;
}
.vcard > ul > li:first-child {
    border-top: 1px dashed #DCDCDC;
}
.vcard .v-heading {
    background: none repeat scroll 0 0 #F0F9FF;
    font-weight: 700;
}
.vcard > ul > li {
   /* border-bottom: 1px dashed #DCDCDC;*/
    overflow: hidden;
    padding: 8px;
}
.vcard > ul {
    list-style: none outside none;
    margin: 10px 0 0 120px;
    overflow: hidden;
}
.vcard .thumbnail {
    float: left;
}
.thumbnail {
    border: 1px solid #DDDDDD;
    border-radius: 4px 4px 4px 4px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.055);
    display: block;
    line-height: 20px;
    padding: 4px;
    transition: all 0.2s ease-in-out 0s;
}
.row-fluid div[class*="span"] {
    min-height: 1px;
}
.row-fluid .span12 {
    width: 100%;
	line-height:20px;
}
.row-fluid [class*="span"] {
    -moz-box-sizing: border-box;
    display: block;
    float: left;
    margin-left: 2.5641%;
    min-height: 30px;
    width: 100%;
}
.row-fluid .span12 {
    width: 100%;
	line-height:23px;
}
.row-fluid:before, .row-fluid:after {
    content: "";
    display: table;
    line-height: 0;
}
.row-fluid {
    width: 96%;
}

.vcard > ul {
    list-style: none outside none;
}
.vcard .vcard-item {
    margin-left: 120px;
}
.vcard .item-key {
    color: #888888;
    float: left;
}
ul.unstyled, ol.unstyled {
    list-style: none outside none;
    margin-left: 0;
}
.sepH_b {
    margin-bottom: 10px;
}
ul.unstyled, ol.unstyled {
    list-style: none outside none;
}
</style>
<script type="text/javascript" src="<?php echo base_url();?>application/js/jquery.1.4.2.js"></script>
<script type="text/javascript">
window.onload = function(){
$('#hideforimg').hide();
$('#imgform').hide();
});
</script>
<script type="text/javascript">

$(document).ready(function() {

$('#hideforimg').hide();
$('#imgform').hide();
$('#hideusrname').hide();
$('#showusrnm').hide();
$('#hidelocation').hide();
 $('#forlocation').hide();
   $('#forimg').click(function(){
     $('#imgform').toggle(700);
	 $('#hideforimg').toggle(700);
	 $('#forimg').hide(700);
   });
    $('#hideforimg').click(function(){
     $('#imgform').hide(700);
	 $('#hideforimg').hide(700);
	 $('#forimg').toggle(700);
   });
    $('#usrname').click(function(){
	$('#hideusrname').toggle(700);
   $('#showusrnm').toggle(700);
	
	 $('#usrname').hide(700);
   });
   $('#hideusrname').click(function(){
	$('#usrname').toggle(700);
   $('#showusrnm').hide(700);
	
	 $('#hideusrname').hide(700);
   });
  
   $('#showlocation').click(function(){
	$('#hidelocation').toggle(700);
   $('#forlocation').toggle(700);
	
	 $('#showlocation').hide(700);
   });
   
   $('#hidelocation').click(function(){
	$('#showlocation').toggle(700);
   $('#forlocation').hide(700);
	
	 $('#hidelocation').hide(700);
   });
   
   $('#showh1').click(function(){
     $('div.showhide,h1').show();
   });
   $('#toggleh1').click(function(){
     $('div.showhide,h1').toggle();
   });
 });
 </script>
  <!--MAIN-->
    <div id="main">
	<?php $this->load->view('view_accountMenu'); ?>
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
    
      <!--POST JOB-->
      <div class="clsInnerCommon">
        
                            <div class="clsPostProject clsSitelinks">
							
                              <h2><?php echo 'My Profile';?> </h2>
							
							  <?php  
								//Show Flash Error Message
							
								if($msg = $this->session->flashdata('flash_message'))
									{
									echo $msg;
									}
									
								 								  
								  
								  ?>
								
                          
                            
                         

<div class="row-fluid">
								<div class="span12">
								  <?php  if(isset($userrecords))
						 {
						  foreach($userrecords->result() as $userdetails)
						    {?>

									<div class="vcard">
									<?php $usrimg=$userdetails->logo; 
									if(!isset($usrimg))
									{
									?>
										<img class="thumbnail" src="http://www.placehold.it/80x80/EFEFEF/AAAAAA" alt="" />
										<?php } ?>
										<?php if(isset($usrimg)){ ?>
										<img class='thumbnail' src='<?php echo base_ur();?>files/logos/<?php echo $usrimg;?>' alt="" />
										<?php } ?>
										<a href="#" style="color:#009966" id="forimg">Edit</a>
										<a href="#" style="color:#009966" id="hideforimg">Hide</a>
										<ul id="imgform">
										<li class="v-heading">
										<h3>Change Your Profile Image:</h3>
										<form name="forimage" enctype="multipart/form-data" action="<?php echo site_url('myprofile/editProfile');?>" method="post">
										<input type="file" name="forimge" />
										<input type="submit" name="changeimage" value="Change" />
										 <?php echo form_error('forimge'); ?>
										</form>
										</li>
										</ul>
										<ul>
											<li class="v-heading">
												<h3>User info</h3>
											</li>
											<li>
												<span class="item-key">User Name:</span>
												<div class="vcard-item"><?php echo $userdetails->user_name;?> &nbsp;<a href="#" style="color:#009966" id="usrname">Edit</a> &nbsp;<a href="#" style="color:#009966" id="hideusrname">Hide</a></div>
											</li>
											<li id="showusrnm" class="v-heading">
											<h3>Change Your Public User Name:</h3>
											<form name="forname" enctype="multipart/form-data" action="<?php echo site_url('myprofile/editProfile');?>" method="post">
										<input type="text" name="forname" />
										<input type="submit" name="cahngename" value="Change" />
										 <?php echo form_error('forname'); ?>
										</form>
										</li>
											
											<li>
												<span class="item-key">Location:</span>
												<div class="vcard-item"><?php echo $userdetails->city;?> &nbsp;<a href="#" style="color:#009966" id="showlocation">Edit</a>
												&nbsp;<a href="#" style="color:#009966" id="hidelocation">Hide</a>
												
												</div>
											</li>
											<li id="forlocation" class="v-heading">
											<h3>Change Your Location:</h3>
											<form name="forlocation" enctype="multipart/form-data">
										<input type="text" name="forlocation" />
										<input type="submit" name="cahngelocation" value="Change" />
										 <?php echo form_error('forlocation'); ?>
										</form>
										</li>
											
											
												</ul>
										<ul>
											<li class="v-heading">
												<h3>Company Details</h3>
											</li>
											<li>
												<span class="item-key">Company Name:</span>
												<div class="vcard-item"><?php echo $userdetails->organisation;?></div>
											</li>
											<li>
												<span class="item-key">Address:</span>
												<div class="vcard-item"><?php echo $userdetails->address;?></div>
											</li>
											<li>
												<span class="item-key">Land Line:</span>
												<div class="vcard-item"><?php echo $userdetails->phone;?></div>
											</li>
											<li>
												<span class="item-key">Mobile No:</span>
												<div class="vcard-item"><?php echo $userdetails->mobile;?>&nbsp;<a href="#" style="color:#009966">Edit</a></div>
											</li>
											<li>
												<span class="item-key">Business Type:</span>
												<div class="vcard-item"><?php $btype=$userdetails->business_type; if($btype==1) echo "products/services"; else{ echo "products & services"; }?></div>
											</li>
											<!--<li>
												<span class="item-key">Industry:</span>
												<div class="vcard-item">Male</div>
											</li>-->
											<li>
												<span class="item-key">Website:</span>
												<div class="vcard-item"><?php echo $userdetails->website;?> &nbsp;<a href="#" style="color:#009966">Edit</a></div>
											</li>
											</ul>
											
												<!--<span class="item-key">Signature</span>
												<div class="vcard-item">
													Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi id quam orci, in ornare sapien. Nulla ultrices vestibulum erat a ullamcorper. Fusce eu nisl at nulla tempus posuere.
												</div>
											</li>-->
											<li class="v-heading">
												<h3>About Us</h3>
											</li>
											<li>
												<ul class="unstyled sepH_b item-list">
													<li><p><?php echo $userdetails->aboutus;?></p></li>
													
												</ul>
												
											</li>
											<?php } }
											?>
										</ul>
									</div>
								</div>
							</div>
							
							</div>
                          </div>    
      <!--END OF POST JOB-->
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
	 		 
    <!--END OF MAIN-->
<script type="text/javascript">

function formSubmit()
{
var form = document.createElement("form");
//alert(form.);
form.setAttribute("target", "_blank");
}

/* For laod favouriteusers list into the textarea box */
function loadProgrammers(num)
{
   document.getElementById('private_listfill').value += num;
   return TRUE;
}

//Set the properties of textarea box disabled */
function check_private(formname)
{
  document.getElementById('private_listfill').disabled = !document.getElementById('is_private').checked;
  document.getElementById('private_listfill').value="";
}
</script>
</div></div></div>
<?php $this->load->view('footer'); ?>