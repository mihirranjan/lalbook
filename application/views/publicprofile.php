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
.clsCompantDetails p {
    margin: 15px 0!important;
}
.clsAccDetails{
	padding:5px 0 !important;
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
		
	<script src="<?php echo base_url();?>application/js/jquery-1.9.1.js"></script>
	<script src="<?php echo base_url();?>application/js/main.js"></script>
	<script src="<?php echo base_url();?>application/js/jquery-ui.js"></script>
	<script src="<?php echo base_url();?>application/js/jquery.betterTooltip.js"></script>
	<script type="text/javascript">
function moveMouse(id,desc,image){
//alert(image);
$("#infoDiv").show();
$("#infoDiv").html('<p>Price:'+id+'</p><p>Description:'+desc+'</p><p class="Prod"> <b>Product</b></p><p class="Prodimg"> <img src="<?php echo base_url();?>uploads/'+image+'" height=100 widht=100 class="prdct"/></p>');

}
</script>
	<style type="text/css">
	.bubbleInfo {
    position: relative;
}

.popup {
    position: absolute;
    display: none; /* keeps the popup hidden if no JS available */
}
        
   
  .popup td#topleft {
    background-image: url("http://static.jqueryfordesigners.com/demo/images/coda/bubble-1.png");
}
.popup td.top {
    background-image: url("http://static.jqueryfordesigners.com/demo/images/coda/bubble-2.png");
}
.popup td#topright {
    background-image: url("http://static.jqueryfordesigners.com/demo/images/coda/bubble-3.png");
}

.popup td.left {
    background-image: url("http://static.jqueryfordesigners.com/demo/images/coda/bubble-4.png");
}

.popup td.right {
    background-image: url("http://static.jqueryfordesigners.com/demo/images/coda/bubble-5.png");
}

.popup td#bottomleft {
    background-image: url("http://static.jqueryfordesigners.com/demo/images/coda/bubble-6.png");
}
.popup td.bottom {
    background-image: url("http://static.jqueryfordesigners.com/demo/images/coda/bubble-7.png");
    text-align: center;
}

.popup td#bottomright {
    background-image: url("http://static.jqueryfordesigners.com/demo/images/coda/bubble-8.png");
}
.popup td.corner {
    height: 15px;
    width: 19px;
}
.popup td.bottom img {
    display: block;
    margin: 0 auto;
}
.popup table.popup-contents {
    background-color: #FFFFFF;
    color: #666666;
    font-family: "Lucida Grande","Lucida Sans Unicode","Lucida Sans",sans-serif;
    font-size: 12px;
    line-height: 1.2em;
}
table.popup-contents th {
    text-align: right;
    text-transform: lowercase;
}

table.popup-contents td {
    text-align: left;
}
  .popup td.left {
    background-image: url("http://static.jqueryfordesigners.com/demo/images/coda/bubble-4.png");
}     
</style>
<style type="text/css">
 a.tooltip {outline:none; } a.tooltip strong {line-height:30px;} a.tooltip:hover {text-decoration:none;} a.tooltip span { z-index:10;display:none; padding:14px 20px; margin-top:60px; margin-left:-160px; width:240px; line-height:16px; } a.tooltip:hover span{ display:inline; position:absolute; border:2px solid #FFF; color:#EEE; background:#000 url(src/css-tooltip-gradient-bg.png) repeat-x 0 0; } .callout {z-index:20;position:absolute;border:0;top:-14px;left:120px;} /*CSS3 extras*/ a.tooltip span { border-radius:2px; -moz-border-radius: 2px; -webkit-border-radius: 2px; -moz-box-shadow: 0px 0px 8px 4px #666; -webkit-box-shadow: 0px 0px 8px 4px #666; box-shadow: 0px 0px 8px 4px #666; opacity: 0.8; }
 </style>
<style>


    ul.enlarge{
    list-style-type:none; /*remove the bullet point*/
    margin-left:0;
	float:left;
	width:525px;
    }
    ul.enlarge li{
	    margin: 0 5px 15px 0 !important;
    display:inline-block; /*places the images in a line*/
    position: relative;
	min-height:125px;
    z-index: 0; /*resets the stack order of the list items - later we'll increase this*/
/*    margin:5px 30px 0 20px;
*/    }
    ul.enlarge img{
/*    background-color:#eae9d4;
    padding: 6px;
    -webkit-box-shadow: 0 0 6px rgba(132, 132, 132, .75);
    -moz-box-s    box-shadow: 0 0 6px rgba(132, 132, 132, .75);
hadow: 0 0 6px rgba(132, 132, 132, .75);
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;*/
    }
    ul.enlarge span{
    position:absolute;
    left: -9999px;
    background:#f1f1f1 !important;
    padding: 10px;
    font-family: 'Droid Sans', sans-serif;
    font-size:.9em;
    text-align: center;
    color: #333;
   /* -webkit-box-shadow: 0 0 20px rgba(0,0,0, .75));
    -moz-box-shadow: 0 0 20px rgba(0,0,0, .75);
   box-shadow: 0 0 20px rgba(0,0,0, .75);
    -webkit-border-radius: 8px;
    -moz-border-radius: 8px; */
    border-radius:8px; 
    }
    ul.enlarge li:hover{
    z-index: 50;
    cursor:pointer;
    }
    ul.enlarge span img{
    padding:2px;
    background:#ccc;
    }
    ul.enlarge li:hover span{
	 color: #333333 !important;
    left: -20px;
    padding: 10px !important;
    top: -175px;
	
 /*    top: -220px;the distance from the bottom of the thumbnail to the top of the popup image*/
  /*  left: -20px; distance from the left of the thumbnail to the left of the popup image*/
    }
    ul.enlarge li:hover:nth-child(2) span{
    left: -100px;
    }
    ul.enlarge li:hover:nth-child(3) span{
    left: -200px;
    }
    /**IE Hacks - see http://css3pie.com/ for more info on how to use CS3Pie and to download the latest version**/
    ul.enlarge img, ul.enlarge span{
    behavior: url(pie/PIE.htc);
    } 
</style>
<style>
pre{
	display:block;
	font:100% "Courier New", Courier, monospace;
	padding:10px;
	border:1px solid #bae2f0;
	background:#e3f4f9;	
	margin:.5em 0;
	overflow:auto;
	width:800px;
}

img{border:none;}
/*ul,li{
	margin:0;
	padding:0;
}
li{
	list-style:none;
	float:left;
	display:inline;
	margin-right:10px;
}*/



/*  */

#preview{
	position:absolute;
	border:1px solid #ccc;
	background:#333;
	padding:5px;
	display:none;
	color:#fff;
	}

/*  */
</style>
<!--<script type="text/javascript">
$(function () {
  $('.bubbleInfo').each(function () {
    // options
    var distance = 10;
    var time = 250;
    var hideDelay = 500;

    var hideDelayTimer = null;

    // tracker
    var beingShown = false;
    var shown = false;
    
    var trigger = $('.trigger', this);
    var popup = $('.popup', this).css('opacity', 0);

    // set the mouseover and mouseout on both element
    $([trigger.get(0), popup.get(0)]).mouseover(function () {
      // stops the hide event if we move from the trigger to the popup element
      if (hideDelayTimer) clearTimeout(hideDelayTimer);

      // don't trigger the animation again if we're being shown, or already visible
      if (beingShown || shown) {
        return;
      } else {
        beingShown = true;

        // reset position of popup box
        popup.css({
          top: -100,
          left: -33,
          display: 'block' // brings the popup back in to view
        })

        // (we're using chaining on the popup) now animate it's opacity and position
        .animate({
          top: '-=' + distance + 'px',
          opacity: 1
        }, time, 'swing', function() {
          // once the animation is complete, set the tracker variables
          beingShown = false;
          shown = true;
        });
      }
    }).mouseout(function () {
      // reset the timer if we get fired again - avoids double animations
      if (hideDelayTimer) clearTimeout(hideDelayTimer);
      
      // store the timer so that it can be cleared in the mouseover if required
      hideDelayTimer = setTimeout(function () {
        hideDelayTimer = null;
        popup.animate({
          top: '-=' + distance + 'px',
          opacity: 0
        }, time, 'swing', function () {
          // once the animate is complete, set the tracker variables
          shown = false;
          // hide the popup entirely after the effect (opacity alone doesn't do the job)
          popup.css('display', 'none');
        });
      }, hideDelay);
    });
  });
});
</script>-->
	<!--<link rel="stylesheet" href="<?php echo base_url();?>application/css/css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
		<script src="<?php echo base_url();?>application/js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function(){
			
				$("area[rel^='prettyPhoto']").prettyPhoto();
				
				$(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000, autoplay_slideshow: true});
				$(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});
		
				$("#custom_content a[rel^='prettyPhoto']:first").prettyPhoto({
					custom_markup: '<div id="map_canvas" style="width:260px; height:265px"></div>',
					changepicturecallback: function(){ initialize(); }
				});

				$("#custom_content a[rel^='prettyPhoto']:last").prettyPhoto({
					custom_markup: '<div id="bsap_1259344" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div><div id="bsap_1237859" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6" style="height:260px"></div><div id="bsap_1251710" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div>',
					changepicturecallback: function(){ _bsap.exec(); }
				});
				
			});
			</script>-->
	<!--<link rel="stylesheet" href="<?php echo base_url();?>application/css/css/jquery-ui.css" />-->
	
	<script type="text/javascript">
	$(function() {
$( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
$( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
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
<script type="text/javascript">
	$(document).ready(function() {
	
   $('#prof').hide();
   $('#tabs4').hide();
   $('#hideprof').hide();
   $('#editprof').click(function(){
     $('#prof').show();
	  $('#hideprof').show();
   });
   $('#hideprof').click(function(){
   $('#prof').hide();
    $('#hideprof').hide();
   });
   $('#gallery').click(function(){
     $('#tabs-1').hide();
	  $('#tabs-2').hide();
	  $('#tabs-3').hide();
	  $('#tabs4').show();
   });
    $('#tabs3').click(function(){
	//alert("hi");
	$('#tabs-1').hide();
	  $('#tabs-2').hide();
	  $('#tabs-3').show();
	  $('#tabs4').hide();
	   });
	    $('#tabs1').click(function(){
	//alert("hi");
	$('#tabs-1').show();
	  $('#tabs-2').hide();
	  $('#tabs-3').hide();
	  $('#tabs4').hide();
	   });
	  $('#editprof').click(function(){
	//alert("hi");
	$('#tabs-1').show();
	  $('#tabs-2').hide();
	  $('#tabs-3').hide();
	  $('#tabs4').hide();
	   }); 
	   $('#tabs2').click(function(){
	//alert("hi");
	$('#tabs-1').hide();
	  $('#tabs-2').show();
	  $('#tabs-3').hide();
	  $('#tabs4').hide();
	   }); 
	   
 });
 </script>
 <script type="text/javascript">
 $(document).ready(function() {
	
 var getid=$('#errorid').val();
 var phot=$('#photoimg').val();
 
	//alert(getid);
	if ((getid!='') && (phot==''))
	{
	$('#tabs-1').hide();
	  $('#tabs-2').hide();
	  $('#tabs-3').hide();
	  $('#tabs-4').show();
	  alert("Please Enter All Fields");
	  }
	   });
	</script>
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

<script type="text/javascript" src="<?php echo base_url();?>application/js/jquery.form.js"></script>
<script type="text/javascript" >
 $(document).ready(function() { 
 
            $('#photoimg').change(function(){ 
				alert("mmmsss");
				$("#previewid").html('');
				$("#previewid").html('<img src="loader.gif" alt="Uploading...."/>');
			$("#imageform").ajaxForm({
						target: '#previewid'
		}).submit();
	});
}); 
</script>
<script type="text/javascript" >
/* $(document).ready(function() { 
 alert("test");
 $('.prductimg').click(function() {
 alert("hi");
 
 var fieldType = $(this).attr('id');
//var fieldType=$('#proimg').val();
    //alert(fieldType);
	$.ajax({
	
            URL: 'http://demo.maventricks.com/lalbook/application/views/ajax-product.php',
            //url: 'test1.txt',
             data:"id="+fieldType ,
            dataType: 'json',
            success: function(msg){
         $("#producdetail").html(msg);
       }
	   alert("hi2");
        });
		alert("hi3");
 });
}); */
</script>

	<!--<div id="producdetail" title="Your Product" style="border:1px solid #999999" data-role="popup" data-theme="e" data-overlay-theme="a" class="ui-content" >
	</div> -->
	<!--<div id='producdetail' style='border:1px solid black'>
	</div>-->
    <!-- End of Header -->
    <!--<div id="selSearch">
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
                     <!-- <div class="clsTab">
                      <ul class="clearfix">
                      <li><a href="#">Browse</a></li>
                      <li><a href="#">My Business</a></li>
                      <li class="clsActive"><a href="#">My Profile</a></li>                      
                      </ul>
                      
                      </div>-->
					 <?php /*?> <?php
//Show Flash Message
if($msg = $this->session->flashdata('flash_message'))
{
	echo $msg;
}
?><?php */?>
					  <?php  if(isset($userrecords))
						 {
						
						  foreach($userrecords->result() as $userdetails)
						    {
							$usrimg=$userdetails->logo; ?>
									<div class="clsAccDetails">
                      <ul class="clearfix">
					   
							<?php $usrcredits=$userdetails->credit;?>
                      <!--<li <?php //if($usrcredits!=0) { echo 'class="clsNoBorder"';} ?>>Bidding credits Available:<span> <?php //echo $userdetails->credit;?>&nbsp;credits</span></li>-->
					  <?php //if($usrcredits==0) 
					 // {
					  ?>
                     <!-- <li class="clsNoBorder"><a href="#">Refill</a></li>-->
					  <?php //} ?>
                      </ul>
                      </div>
					  <?php //$this->load->view('view_innermenu'); ?>
                      <div id="selProfile" class="clearfix">
                      <div class="clsProfileInformation clearfix">
                      <div class="clsLeftProfileInfo">
					  
								<?php	if(!isset($usrimg))
									{
									
									?>
                      <img src="<?php echo image_url();?>/p_img.jpg" alt="" />
					  	<?php } ?>
						
						<?php if(isset($usrimg)){ ?>
										<img class='thumbnail' src='<?php echo base_url();?>files/logos/<?php echo $usrimg;?>' alt="" />
										<?php } ?>
										<p><span><a href="#" id="editprof">&nbsp;</a></span></p>
                                    <!-- <p><span><a href="#" id="editprof">Change Profile Picture</a></span></p>-->
                      </div>
                      <div class="clsRightProfileInfo" style="padding:10px 10px 14px;">
                      <h2>User Profile</h2>
                      <div class="clsProfileRight">
                      <p>Reputation :</p>
					  <?php 
					//  print_r($userdetails);exit;
					  $usrid=$userdetails->userid;
					  $q = "SELECT SUM(rating) AS rating,COUNT(id) as reviews FROM reviews WHERE userid = $usrid";
							//echo "SELECT COUNT(job_id) AS count FROM bids WHERE job_id = $jobidd";
 $query = $this->db->query($q,array($userdetails->userid));
       $ncomments = $query->result_array();
	   //print_r($query);exit;
	$blog_e->n_comments = $ncomments[0]['rating'];
	$blog_e->n_commentse = $ncomments[0]['reviews'];
	$count=$blog_e->n_commentse;
	/*if($count>1) {
	 $Totalbid=$blog_e->n_comments;
	 $ratings=$Totalbid/5;
	 }
	 else{
	  $ratings=$blog_e->n_comments;
	  }*/
	 ?>
                      <p>
					  
					  <!--<img alt="" src="<?php echo image_url();?>/<?php /*if($ratings<1.9)
					   { echo "0yellow.png";} else { echo  $ratings."yellow.png";}*/ if(($ratings<0) && ($ratings==0)){ echo "0yellow.png"; } elseif(($ratings>0) && ($ratings<1)) { echo "0_5yellow.png";} elseif(($ratings>1) && ($ratings<2)) {  echo "1_5yellow.png"; } elseif(($ratings>2) && ($ratings<3)) {  echo "2_5yellow.png"; } elseif(($ratings>3) && ($ratings<4)) {  echo "3_5yellow.png"; } elseif(($ratings>4) && ($ratings<5)) {  echo "4_5yellow.png"; } elseif($ratings>5) {  echo "5yellow.png"; } elseif(($ratings==1)){  echo  "1yellow.png"; } elseif(($ratings==2)){  echo  "2yellow.png"; } elseif(($ratings==3)){  echo  "3yellow.png"; } elseif(($ratings==4)){  echo  "4yellow.png"; } elseif(($ratings==5)){  echo  "5yellow.png"; } ?>">-->
					   <?php if($count>1) {
	 $Totalbid=$blog_e->n_comments;
	 $ratings=$blog_e->n_comments/$blog_e->n_commentse;
	// echo $ratings;
	 ?> 
	 
	 
	 <img src="<?php echo image_url();?>/<?php if(($ratings>1) && ($ratings<2)) {  echo "1_5yellow.png"; } elseif(($ratings>2) && ($ratings<3)) {  echo "2_5yellow.png"; } elseif(($ratings>3) && ($ratings<4)) {  echo "3_5yellow.png"; } elseif(($ratings>4) && ($ratings<5)) {  echo "4_5yellow.png"; } elseif($ratings>5) {  echo "5yellow.png"; } elseif(($ratings==1)){  echo  "1yellow.png"; } elseif(($ratings==2)){  echo  "2yellow.png"; } elseif(($ratings==3)){  echo  "3yellow.png"; } elseif(($ratings==4)){  echo  "4yellow.png"; } elseif(($ratings==5)){  echo  "5yellow.png"; } if(($ratings<0) && ($ratings==0) && ($ratings==NULL)){ echo "0yellow.png"; } elseif(($ratings>0) && ($ratings<1)) { echo "0_5yellow.png";}?>" />
	 <?php 
	 }
	 else{
	  $ratings=$ncomments[0]['rating'];
	$blog_e->n_comments = $ncomments[0]['rating'];
	?>
	
	<img src="<?php echo image_url();?>/<?php if(($ratings<0)|| ($ratings==0) || ($ratings==NULL)){ echo "0yellow.png"; } elseif(($ratings>0) && ($ratings<1)) { echo "0_5yellow.png";}  elseif(($ratings==1)){  echo  "1yellow.png"; } elseif(($ratings==2)){  echo  "2yellow.png"; } elseif(($ratings==3)){  echo  "3yellow.png"; } elseif(($ratings==4)){  echo  "4yellow.png"; } elseif(($ratings==5)){  echo  "5yellow.png"; } ?>" />
<?php 	
	 }
	 ?>
					   
					   
					   <span><?php if($count>1) {
	 $Totalbid=$blog_e->n_comments;
	echo  $ratings=$blog_e->n_comments/$blog_e->n_commentse;}
	else if($blog_e->n_comments!=NULL){
	 $ratings=$ncomments[0]['rating'];
	echo $blog_e->n_comments = $ncomments[0]['rating'];
	}
	else{
	echo "0";}
	?>/5</span></p>
                      <p class="Align"><a  href="#tabs-3" id="tabs3"><?php if($blog_e->n_commentse!=0) { echo $blog_e->n_commentse." Reviews";} else { echo "No Reviews";}?> </a></p>
                      </div>
                      <div class="clsPLeft">
                      <p><label>User Name	</label>:&nbsp;&nbsp;<?php echo $userdetails->user_name;?><span> <?php $verify=$userdetails->user_verify;?><?php if($verify==1)
{
?>
<a href="#" class="tooltip"><input type="button" class="clsVerify" value="Verified" /><span> <!--<img class="callout" src="src/callout_black.gif" />--> <strong>User Verified By Lalbook</strong></span></a> 
<?php } ?>
<?php if($verify==0)
{
?>
<a href="#" class="tooltip"><input type="button" class="clsVerify" value="Not Verified" /><span>
<!-- <img class="callout" src="src/callout_black.gif" />--> <strong>User Not Verified By Lalbook</strong></span></a>
<?php } ?></span></p>
                         <p><label>Location		</label>:&nbsp;&nbsp;<?php echo ucwords($userdetails->state);?>,<?php echo $userdetails->country_symbol;?></p>
                         <p><label>Member Since	</label>:&nbsp;&nbsp;<!--March, 2013--><?php echo date('d-m-Y', strtotime($userdetails->created));?></p>
						
</div>
                      </div>
                                            
                      </div>
					  <div id="tabs">
                      <div class="clsSideTab">
                      <ul class="clearfix">
                      <li><a href="#tabs-1" id="tabs1">My Profile</a></li>
                      <li><a href="#tabs-2" id="tabs2">Gallery View</a></li>
                      <li><a href="#tabs-3" id="tabs3">Review & Rating</a></li>
                      </ul>
                      </div>
					  <div id="tabs-1">
    <div class="clsProfileLeft">
                      
<div class="clsCompantDetails">

<h3>Company Details</h3>


<p><label>Company Name  </label>:&nbsp;&nbsp;<?php echo $userdetails->organisation;?></p>


<p><label>Address </label> :&nbsp;&nbsp;<span style="float: right; text-align: left; display: block; width: 596px;"><?php echo $userdetails->address;?></span></p>

<!--<p class="cloneone"><label>Landline  </label> :<?php echo $userdetails->phone;?>&nbsp;</p>


<p class="clone"><label>Mobile No.  </label> :<?php echo $userdetails->mobile;?></p>-->


<p><label>Business Type </label>:&nbsp;&nbsp;<?php $btype=$userdetails->business_type; if($btype==1) {echo "Product";}?><?php if($btype==2) { echo "Service";}?><?php if($btype==3) { echo "Product & services";}?></p>

<!--<p><label>Industry </label> :<?php echo $btype=$userdetails->industry_type;?></p>-->
<p><label>Industry </label> :&nbsp;&nbsp;<?php echo $btype=$userdetails->industry_type; ?></p>


<p><label>Website </label> :&nbsp;&nbsp;<?php echo $userdetails->website;?></p>


<p><label>About US  </label>:&nbsp;&nbsp;<?php echo $userdetails->aboutus;?></p>








<!--<p><label>&nbsp;</label><input type="button" class="clsCommonbut" value="Submit" /></p>-->


<?php } }
											?> 

</div>


</div>
</div>
<div id="tabs-2">
<div id="selMainCnt"> <?php if(isset($products) && $products->num_rows()>0)
						 {
						
						  foreach($products->result() as $getproduct)
						    {
							$primage=$getproduct->gal_image;
							$prdid=$getproduct->id;
							$desc=$getproduct->description;
							}
							
							?>
                      
                      
                      <div class="clsGalleryList ">
                      <h2>Products & Services<ul ><li></li></ul></h2>
					  <div class="clsProfileRight" id="infoDiv" >
                      <!--<p>Lorem ipsum is a sample text.Lorem ipsum is a sample text.Lorem ipsum is a sample text.</p>
                      <p><b>Price : Rs.76</b></p>-->
					 <p> Price:<?php echo $getproduct->price;?></p>
					 <p> Description: <?php echo $desc;?></p>
					  <p style="text-align:center;color:#333;"><b>Product</b></p>
                      <p style="text-align:center;"> <img src="<?php echo base_url();?>uploads/<?php echo $primage;?>" alt="" class="trigger"  height="100" width="100" /></p>
					  
                      </div>
					  <div class="demo">
                      <ul class="enlarge gallery" id="proimg">
					  
					  <?php  if(isset($products) && $products->num_rows()>0)
						 {
						
						  foreach($products->result() as $getproduct)
						    {
							$primage=$getproduct->gal_image;
							$prdid=$getproduct->id;
							$desc=$getproduct->description;
							?>
					 <li><!--<img src="<?php echo base_url();?>uploads/<?php echo $primage;?>" alt="" class="trigger" height="100px" width="150px"/><span>-->
					 <a href="#" class="showInfo Link1" onmouseover="moveMouse('<?php echo $getproduct->price;?>','<?php echo $desc;?>','<?php echo $primage;?>');"> <img src="<?php echo base_url();?>uploads/<?php echo $primage;?>" alt="" class="trigger"  height="100px" width="150px" /></a>
	<!--<br /><?php echo $getproduct->description;?>
	<br/>Price :Rs.  <?php echo $getproduct->price;?></span>--></li>
                      <li>
					 <!-- <div class="bubbleInfo">--><!--<a href="<?php echo base_url();?>uploads/<?php echo $primage;?>" class="preview" title="<?php echo $getproduct->description;?>  Rs. <?php echo $getproduct->price;?>"><img src="<?php echo base_url();?>uploads/<?php echo $primage;?>" alt="" class="trigger"/></a>-->
					 <!-- <table style="opacity: 0; top: -110px; left: -33px; display: none; background-color:#FFFFFF" id="dpop" class="popup">
        	<tbody><tr>
        		<td id="topleft" class="corner"></td>
        		<td class="top"></td>
        		<td id="topright" class="corner"></td>
        	</tr>

        	<tr>
        		<td class="left"></td>
        		<td><table class="popup-contents">
        			<tbody><tr>
        				<th>Price:</th>
        				<td><?php echo $getproduct->price;?></td>
        			</tr>
        						
        			<tr id="release-notes">
        				<th>Description:</th>
        				<td><?php echo $getproduct->description;?></td>
        			</tr>
        		</tbody></table>

        		</td>
        		<td class="right"></td>    
        	</tr>

        	<tr>
        		<td class="corner" id="bottomleft"></td>
        		<td class="bottom"><!--<img alt="popup tail" src="<?php echo image_url();?>/bubble-tail2.png" height="29" width="30">--></td>
        	<!--	<td id="bottomright" class="corner"></td>
        	</tr>
        </tbody></table>-->
    <!-- your information content -->
	
  
<!--</div>--></li>
					   
					 
					  <?php } ?>
					  
					 <?php  }
					  ?>
					 
                      <!-- <li><img src="<?php echo image_url();?>/g_2.jpg" alt="" /></li>
                        <li><img src="<?php echo image_url();?>/g_3.jpg" alt="" /></li>
                        <li><img src="<?php echo image_url();?>/g_1.jpg" alt="" /></li>
                       <li><img src="<?php echo image_url();?>/g_2.jpg" alt="" /></li>
                        <li class="clsNoMargin"><img src="<?php echo image_url();?>/g_3.jpg" alt="" /></li> 
                        
                        <li><img src="<?php echo image_url();?>/g_1.jpg" alt="" /></li>                        
                       <li><img src="<?php echo image_url();?>/g_2.jpg" alt="" /></li>
                        <li><img src="<?php echo image_url();?>/g_3.jpg" alt="" /></li>
                        <li><img src="<?php echo image_url();?>/g_1.jpg" alt="" /></li>
                       <li><img src="<?php echo image_url();?>/g_2.jpg" alt="" /></li>
                        <li class="clsNoMargin"><img src="<?php echo image_url();?>/g_3.jpg" alt="" /></li> -->           
                      </ul>
					  </div>
                      </div>
                      <?php } else{  ?>
                     
                      <?php echo "No Products Added"; }?>
                      </div>
	</div><!--Tab end--><?php  if(isset($sellerfeeds) && $sellerfeeds->num_rows()>0)
						 {
						$i=0;
					//echo 	$loggedInUser->id;exit;
						  foreach($sellerfeeds->result() as $reviews)
						    {
							$jobname=$reviews->looking_for;
							$jobid=$reviews->job_id;
							}
							}
							?>
	<div id="tabs-3">
	<div id="selMainCnt"> 
                      <h2 style="border-bottom:1px dotted #555; font-size:16px;">Review and Rating</h2>
                      <ul class="clearfix"> 
					  <?php  if(isset($sellerfeeds) && $sellerfeeds->num_rows()>0)
						 {
						$i=0;
					//echo 	$loggedInUser->id;exit;
						  foreach($sellerfeeds->result() as $reviews)
						    {
							//print_r($reviews);exit;
							$ussrid=$reviews->userid;
							$ratingpoint=$reviews->rating;
							//echo $ratingpoint/5;
							if($i%2==0){
						$clsodd="clsOddReview";
						}else{
						$clsodd="clsEvenReview";
						}
							//print_r($reviews);
							?>
                      <li class="<?php echo $clsodd;?>">
                      <div class="clsRatinginfo clearfix">
					   <h2 ><?php echo $reviews->looking_for; 
					    $qrs = "SELECT * FROM bids WHERE user_id = $ussrid";
							//echo "SELECT COUNT(job_id) AS count FROM bids WHERE job_id = $jobidd";
 $querry = $this->db->query($qrs,array($reviews->job_id));
       $ncommenttss = $querry->result_array();
	   //print_r($query);exit;
	$blog_e->n_amount = $ncommenttss[0]['bid_amount'];?> &nbsp;&nbsp;Rs.<?php echo $blog_e->n_amount; ?></h2>
                      <div class="clsRatingstar">
                      <p><img alt="" src="<?php echo image_url();?><?php echo $ratingpoint."yellow.png";?>"><?php echo $ratingpoint;?>/5</p>
                      </div>
                     
                      
                      </div>
                      <div class="clsReviewInfo clearfix">
                      <div class="clsReviewImg">
                      <img src="<?php echo base_url();?>files/logos/<?php echo $reviews->logo;?>" alt="" width="100" height="100" />
                      </div>
                      <div class="clsReviewDesc">
                      <div class="clsLeftR">
                      <div class="clsRightR">
                      <div class="clsCenterR">
                     <ul class="clearfix">
                     <li class="clsActive"><a href="<?php  if($loggedInUser){ if($loggedInUser->id==$ussrid){ echo site_url('account');}} else { echo site_url('users/view/'.$ussrid);}?>"><?php echo $reviews->user_name;?> </a></li>
                      <li class="clsNoBorder"><!--<a href="#">  Flag</a>--></li>
                      </ul>
                      <p><?php echo $reviews->comments;?></p>
                      </div></div></div>
                     
                      </div>
                      
                      <!-- <p class="clsAlign"><a href="#">More</a></p>-->
                      
                      </div>
                      </li>
                      
                      <!--<li class="clsEvenReview">
                      <div class="clsRatinginfo clearfix">
                      <div class="clsRatingstar">
                      <p><img alt="" src="<?php echo image_url();?>/rating.png">4.1/5.0</p>
                      </div>
                      <h2>Electronic Goods</h2>
                      <div class="clsRatingPrice">
                      <p>Rs.15000</p>
                      </div>
                      
                      </div>
                      <div class="clsReviewInfo clearfix">
                      <div class="clsReviewImg">
                      <img src="<?php echo image_url();?>/review_1.jpg" alt="" />
                      </div>
                      <div class="clsReviewDesc">
                      <div class="clsLeftR">
                      <div class="clsRightR">
                      <div class="clsCenterR">
                     <ul class="clearfix">
                     <li class="clsActive"><a href="#">User Profile Name </a></li>
                      <li class="clsNoBorder"><a href="#">  Flag</a></li>
                      </ul>
                      <p>"It is a long established fact that a reader will be distracted by the readable content of a page when looking"</p>
                      </div></div></div>
                     
                      </div>
                      
                       <p class="clsAlign"><a href="#">More</a></p>
                      
                      </div>
                      </li>-->
                      <?php $i++;  } } else{ echo "<p style='text-align:center'>"."No Ratings And Reviews"."</p>";}?>
                     
                      </div>
					  </div>  <!--tab-3-->
					  <!--Tab end-->
	</div>
	<!--<div id="tabs4" >
<div id="selMainCnt">
                      <h2>Add Products</h2>
                      
                      <form name="products"  method="post" enctype="multipart/form-data" id="imageform" action='http://demo.maventricks.com/lalbook/application/views/ajaxupload.php'><input type="hidden" value="<?php if(isset($_REQUEST['id'])) echo $_REQUEST['id'];?>" id='errorid'/>
					  <p><label>Upload Image:</label><div id="pimg"><input type="file" id="photoimg" name="photoimg"  /></div></p>
					  <p><label>Price:</label><input type="text" name="price" value="" class="clsProdtxt"/></p>
					  <input type="hidden" value="<?php echo $loggedInUser->id;?>" name="user"/>
					    <p><label>Description:</label><textarea name="desc" rows="5" cols="24"></textarea></p>
						<p><label>&nbsp;</label><input type="submit" class="clsCommonbut" value="Submit" name="submitproduct"/></p>
						</form>
						<div id="previewid" align="center" >
</div>
                      </div>
	</div>-->

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
