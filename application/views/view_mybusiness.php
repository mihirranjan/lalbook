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
	
	
  <?php $this->load->view('header'); ?>
  <link href="<?php echo base_url(); ?>application/css/css/bidpopup.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/application/css/css/msgpop.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/application/css/css/msgtobidder.css" />
  <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url();?>application/css/css/popupstyle.css" />
    <script type="text/javascript" src="<?php echo base_url();?>/application/js/ratingpop.js" />
  </script>
   <script type="text/javascript" src="<?php echo base_url();?>/application/js/sellerrating.js" />
  </script>
 <!-- <script type="text/javascript" src="<?php echo base_url();?>/application/js/jquerypop.js" />
  </script>-->
  <!--<script type="text/javascript" src="<?php echo base_url();?>/application/js/sellerrating.js" />
  </script>-->
  <script type="text/javascript" src='<?php echo base_url();?>application/js/fornotlogin.js'></script>
  <script type="text/javascript">
jQuery(function($) {

	$("a.popup").click(function() {
			loading(); // loading
			setTimeout(function(){ // then show popup, deley in .5 second
				loadPopup(); // function show popup
			}, 500); // .5 second
	return false;
	});

	/* event for close the popup */
	$("div.closed").hover(
					function() {
						$('span.ecsp_tooltip').show();
					},
					function () {
    					$('span.ecsp_tooltip').hide();
  					}
				);

	$("div.closed").click(function() {
		disablePopup();  // function close pop up
	});

	$(this).keyup(function(event) {
		if (event.which == 27) { // 27 is 'Ecs' in the keyboard
			disablePopup();  // function close pop up
		}
	});

	$('a.livebox').click(function() {
		alert('Hello World!');
	return false;
	});

	 /************** start: functions. **************/
	function loading() {
		$("div.loader").show();
	}
	function closeloading() {
		$("div.loader").fadeOut('normal');
	}

	var popupStatus = 0; // set value

	function loadPopup() {
		if(popupStatus == 0) { // if value is 0, show popup
			closeloading(); // fadeout loading
			$("#Popup").fadeIn(0500); // fadein popup div
			$("#backgroundPopup").css("opacity", "0.7"); // css opacity, supports IE7, IE8
			$("#backgroundPopup").fadeIn(0001);
			popupStatus = 1; // and set value to 1
		}
	}

	function disablePopup() {
		if(popupStatus == 1) { // if value is 1, close popup
			$("#Popup").fadeOut("normal");
			$("#backgroundPopup").fadeOut("normal");
			popupStatus = 0;  // and set value to 0
		}
	}
	/************** end: functions. **************/
}); // jQuery End
</script>
<style>
		.page_no{
			background-color: #E5E5E5;
			border: 1px solid #C10100;
			color: #444444;
			font-size: 12px;
			font-weight: bold;
			height: 10px;
			margin-right: 3px;
			padding: 3px 10px;
			cursor:pointer;
		}
		.page_no:hover{
			background-color: #CCCCCC;
		}
	
		.black_overlay{
			display: none;
			position: absolute;
			top: 0%;
			left: 0%;
			width: 100%;
			height: 100%;
			/*background-color: black;*/
			z-index:1001;
			-moz-opacity: 0.8;
			opacity:.80;
			filter: alpha(opacity=80);
		}
		.white_content {
    background-color: #444444;
    border: 5px solid #3D3737;
    color: #FFFFFF;
    display: none;
    height: 30%;
    left: 30%;
    overflow: auto;
    padding: 16px;
    position: absolute;
    top: 25%;
    width: 35%;
    z-index: 1002;
}

	</style>
  	<!--<script src="<?php echo base_url();?>application/js/jquery-ui.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>application/css/css/jquery-ui.css" />-->
   	<style type="text/css">
	div.closed {
    background: url("<?php echo image_url();?>/closebox.png") no-repeat scroll 0 0 transparent;
    bottom: 24px;
    cursor: pointer;
    float: right;
    height: 30px;
    left: 27px;
    position: relative;
    width: 30px;
}
span.ecsp_tooltip {
    background: none repeat scroll 0 0 #000000;
    border-radius: 2px 2px 2px 2px;
    color: #FFFFFF;
    display: none;
    font-size: 11px;
    height: 16px;
    opacity: 0.7;
    padding: 4px 3px 2px 5px;
    position: absolute;
    right: -62px;
    text-align: center;
    top: -51px;
    width: 93px;
}
span.arrow {
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
    border-top: 7px solid #000000;
    display: block;
    height: 1px;
    left: 40px;
    position: relative;
    top: 3px;
    width: 1px;
}
div#pop_content {
    margin: 20px;
}
#pop_content p{
	margin:7px 0;
	 font: 14px tahoma;
	 clear:both;
	 overflow:hidden;
}
#pop_content p label{
	float:left;
	text-align:left;
	display:block;
	width:140px;
	
}
	#backgroundPopup {
	z-index:1;
	position: fixed;
	display:none;
	height:100%;
	width:100%;
	background:#000000;
	top:0px;
	left:0px;
}
#Popup {
	font-family: "lucida grande",tahoma,verdana,arial,sans-serif;
    background: none repeat scroll 0 0 #444444;
    border: 5px solid #3D3737;
    border-radius: 3px 3px 3px 3px;
    color: #fff;
    display: none;
	font-size: 14px;
    left: 28%;
    /* margin-left: -402px; */
    position: fixed;
    top: 40%;
    width: 500px;
    z-index: 2;
}
	#backgroundPopup {
	z-index:1;
	position: fixed;
	display:none;
	height:100%;
	width:100%;
	background:#000000;
	top:0px;
	left:0px;
}
#toPopup {
	font-family: "lucida grande",tahoma,verdana,arial,sans-serif;
    background: none repeat scroll 0 0 #444444;
    border: 5px solid #3D3737;
    border-radius: 3px 3px 3px 3px;
    color: #fff;
    display: none;
	font-size: 14px;
    left: 28%;
    /*margin-left: -402px;*/
    position: fixed;
    top: 40%;
    width: 500px;
    z-index: 2;
}
div.loader {
    background: url("../img/loading.gif") no-repeat scroll 0 0 transparent;
    height: 32px;
    width: 32px;
	display: none;
	z-index: 9999;
	top: 40%;
	left: 50%;
	position: absolute;
	margin-left: -10px;
}
div.close {
    background: url("<?php echo image_url();?>/closebox.png") no-repeat scroll 0 0 transparent;
    bottom: 24px;
    cursor: pointer;
    float: right;
    height: 30px;
    left: 27px;
    position: relative;
    width: 30px;
}
span.ecs_tooltip {
    background: none repeat scroll 0 0 #000000;
    border-radius: 2px 2px 2px 2px;
    color: #FFFFFF;
    display: none;
    font-size: 11px;
    height: 16px;
    opacity: 0.7;
    padding: 4px 3px 2px 5px;
    position: absolute;
    right: -62px;
    text-align: center;
    top: -51px;
    width: 93px;
}
span.arrow {
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
    border-top: 7px solid #000000;
    display: block;
    height: 1px;
    left: 40px;
    position: relative;
    top: 3px;
    width: 1px;
}
div#popup_content {
    margin:20px;
	 font: 14px tahoma;
}
.clsAccDetails{
	padding: 5px 0 0;
}
.ajaxpopforminner h3 span#showrs{
float:left !important;
}
</style>
   
    <script>
	  $j=jQuery.noConflict();

$j(function() {

$('#tabs-2').hide();
$('#tabs1').click(function() {
$('#tabs-1').show();
$('#tabs-2').hide();
});
$('#tabs2').click(function() {
$('#tabs-1').hide();
$('#tabs-2').show();
});
});
</script>

  <script type="text/javascript">
	$(document).ready(function() {
	
	//$( "#tabs" ).tabs();
	$("#rate").click(function() {
	//alert("hi");
	var jobpostid=$("#jobid").val();
	    $("#jobpost").val(jobpostid);
	var bidderid = $("#bidderid").val();
	    $("#biduserid").val(bidderid);
	var biddermailid = $("#bidderemail").val();
	//alert(biddermailid);
	    $("#bidderemailid").val(biddermailid);
	var jobname=$("#jobname").val();
		$("#jobnames").val(jobname);
	var jobposter=$("#jobowner").val();
	//alert(jobposter);
	     $("#poster").val(jobposter);
	var budget=$("#jobbudged").val();
	      $("#jobbudget").val(budget);
    var jobownermail=$("#owneremail").val();
	      $("#ownermail").val(jobownermail);
		  var jobposterid=$("#jobownerid").val();
		  $("#ownerid").val(jobposterid);
	});
	$("#credits").click(function(){
	var credt=$("#creditavailable").val();
	$('div.ajaxpopforminner #showrs').html(credt);
	});
	
	$(".selrrating").click(function() { 
//alert("hi");
	var buyids=$("#jobsid").val();
	  $("#buyid").val(buyids);
	var selrid=$("#slrid").val();
	   $("#selserid").val(selrid);
	 var slremailid=$("#slereml").val();
	    $("#selleremailid").val(slremailid);
	var buyjobname=$("#buyname").val();
	    $("#jobbuynames").val(buyjobname);
   var jobername=$("#creatorname").val();
       $("#postername").val(jobername);
	var buyeremail=$("#creatormail").val();
	   $("#ownermailid").val(buyeremail);
	  var buyerid=$("#creatorid").val();
	// alert(buyerid);
	    $("#ownersid").val(buyerid);
	});
	//alert("hi");
	$("#pastwork").hide();
	$("#postfeedback").hide();
	$("#feedback").click(function() {
	//alert("hi");
	$("#feedback").addClass("clsActive");
	$('#progres').removeClass('clsActive');
	$("#paswrk").removeClass('clsActive');
	$("#postfeedback").show();
	$("#pastwork").hide();
	$("#winpr").hide();
	$("#wrkin").hide();
	$("#selerwrkingp").hide();
	$("#selerfeedb").hide();
	//$("#forseller").hide();
	//$("#forbuyer").hide();
	});
	$("#progres").addClass("clsActive");
	$("#wrkin").hide();
	$("#progres").click(function(){
	//alert("wrkinp");
	$("#progres").addClass("clsActive");
	$("#paswrk").removeClass('clsActive');
	$("#feedback").removeClass('clsActive');
	$("#wrkin").hide();
	$("#pastwork").hide();
	$("#winpr").show();
	$("#postfeedback").hide();
	$("#selerwrkingp").hide();
	$("#selerfeedb").hide();
	});
	$("#paswrk").click(function(){
	//alert("hi");
		//alert("paswrk");
		$("#paswrk").addClass("clsActive");
		$('#progres').removeClass('clsActive');
		$("#feedback").removeClass('clsActive');
		$("#selerwrkingp").hide();
	$("#pastwork").show();
	$("#postfeedback").hide();
	$("#winpr").hide();
	$("#wrkin").hide();
	$("#selerfeedb").hide();
	});
	$("#selerwrkin").addClass("clsActive");
	$("#selerpastwrk").hide();
	$("#slerpask").click(function(){
	$("#slerpask").addClass("clsActive");
	$('#selerwrkin').removeClass('clsActive');
	$('#selerfeedback').removeClass('clsActive');
	$("#selerwrkingp").hide();
	$("#selerpastwrk").show();
	$("#selerhome").hide();
	$("#selerfeedb").hide();
	});
	 
	 
	 $("#selerhome").show();
	 $("#selerwrkingp").hide();
	 $("#selerwrkin").click(function(){
	 $("#slerpask").removeClass("clsActive");
	$('#selerwrkin').addClass('clsActive');
	$('#selerfeedback').removeClass('clsActive');
	 $("#selerpastwrk").hide();
	 $("#selerhome").show();
	 $("#selerwrkingp").hide();
	 $("#selerfeedb").hide();
	 });
	 $("#selerfeedb").hide();
	 $("#selerfeedback").click(function(){
	  $("#slerpask").removeClass("clsActive");
	$('#selerwrkin').removeClass('clsActive');
	$('#selerfeedback').addClass('clsActive');
	 $("#selerhome").hide();
	 $("#selerpastwrk").hide();
	 $("#selerwrkingp").hide();
	 $("#selerfeedb").show();
	 $("#pastwork").hide();
	  });
	 $("#winpr").show();
	$("#forseller").hide();
	 $("#wrkin").hide();
    $("input[name$='view']").click(function() {
        var test = $(this).val();
//alert(test);
 //$("#selerfeedb").hide();
if(test==1)
{
//alert(test);
        $("#forbuyer").show();
		//alert("hi");
		$("#progres").addClass("clsActive");
		$("#winpr").show();
		 $("#forseller").hide();
		 $("#postfeedback").hide();
		 $("#pastwork").hide();
		 $("#wrkin").hide();
		 $("#selerpastwrk").hide();
		 $("#selerwrkingp").hide();
		 $("#selerfeedb").hide();
		}
		if(test==2)
{
//alert("hi");
$("#forbuyer").hide();
$("#selerhome").show();
        $("#forseller").show();
		$("#postfeedback").hide();
		$("#pastwork").hide();
		$("#wrkin").hide();
		$("#selerpastwrk").hide();
		$("#selerwrkingp").hide();
		$("#selerfeedb").hide();
		}
    });
	
});
</script>
  <!--<script type="text/javascript" src="<?php echo base_url();?>/application/js/jquery-1.4.1.min.js"></script>-->
<!--<script type="text/javascript" src="<?php echo base_url();?>/application/js/buyerpop.js"></script>-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>application/css/css/ratingpop.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>application/css/css/buyerpop.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>application/css/css/sllerpop.css" />
  <!-- End of Header -->
  <!-- <div id="selSearch">
    <p><label>Search </label><input type="text" value="Search for product bids" class="clsSertxt"><input type="button" value="" class="clsGobut"></p>
    </div>-->
	
	
	 
	
	
	
	
	
	
	
	<form method="post"  id="ratingpopform" class='ajaxpopform' style="display:none" action=""  >
		<div class='ratingpopformwrapper'>
		<div class="ajaxpopforminner">
		<h2>Rating / Review</h2>
		<input type="hidden" id="jobpost" name="hidden_jobid" />
		<input type="hidden" id="biduserid" name="hidden_bidid"/>
		<input type="hidden" id="bidderemailid" name="hidden_biduseremail"/>
		<input type="hidden" id="jobnames" name="hidden_jobname"/>
		<input type="hidden" id="poster" name="hidden_poster" />
		<input type="hidden" id="jobbudget" name="hidden_budget" />
		<input type="hidden" id="ownermail" name="hidden_ownermail" />
		<input type="hidden" id="ownerid" name="hidden_ownerid" />
		
		<div class="rating-module" id="help-us-rateit">
		<fieldset>
		<h4> Rate The Seller</h4>
			<div class="rating-inline">
			<h5>RATE:</h5>
			<ul class="star-rating">
			  <li id="shopping-stars" class="current-rating" style="width:0"></li>
			  <li><a href="javascript:;" class="star1" id="shopping-rating-1">
				<input type="radio" value="1" name="rating_1" id="shopping-rating-input-1"/>
				1</a></li>
			  <li><a  href="javascript:;" class="star2" id="shopping-rating-2">
				<input type="radio" value="2" name="rating_1" id="shopping-rating-input-2"/>
				2</a></li>
			  <li><a  href="javascript:;" class="star3" id="shopping-rating-3">
				<input type="radio" value="3" name="rating_1" id="shopping-rating-input-3"/>
				3</a></li>
			  <li><a  href="javascript:;" class="star4" id="shopping-rating-4">
				<input type="radio" value="4" name="rating_1" id="shopping-rating-input-4"/>
				4</a></li>
			  <li><a  href="javascript:;" class="star5" id="shopping-rating-5">
				<input type="radio" value="5" name="rating_1" id="shopping-rating-input-5"/>
				5</a></li>
			</ul>
			</div>
		
		</fieldset>
		<fieldset>
		<label for="help-us-message">Review :</label>
		<div class="field">
		<textarea id="help-us-description" name="description" cols="20" rows="5"></textarea>
		</div>
		</fieldset>
		</div>
		</div>
		<div class="buttons">
		<div class="ratings-button"><a  class="button form-ratings-button" id=""><span class="inner">Send</span></a></div>
		<a class="button closed"><span class="inner">Cancel</span></a> </div>
		</div>


		<!-- Toggle and show this on success -->
		<div style="display:none" id="ratingpopform-success">
		<div class="inner">
		<h2>Thank you</h2>
		<h4>We Will Send Your Rating Report Soon To This User</h4>
		</div>
		<div class="buttons"> <a class="button closed"><span class="inner">Close</span></a> </div>
		</div>
	</form>
	
	
  <!--Seller Rating-->
  <form method="post"  id="sellerratingpopform" class='ajaxpopform' style="display:none" action=""  >
    <div class='sellerratingpopformwrapper'>
      <div class="ajaxpopforminner">
        <h2>Rating / Review</h2>
        <input type="hidden" id="buyid" name="hidden_jobsid" />
        <input type="hidden" id="selserid" name="hidden_selrbidid"/>
        <input type="hidden" id="selleremailid" name="hidden_selruseremail"/>
        <input type="hidden" id="jobbuynames" name="hidden_jobbuyname"/>
        <input type="hidden" id="postername" name="hidden_postername" />
        <!--<input type="text" id="jobbudget" name="hidden_budget" />-->
        <input type="hidden" id="ownermailid" name="hidden_ownermailid" />
        <input type="hidden" id="ownersid" name="hidden_ownersid" />
        <!-- <p>Professional web design &amp; excellent programming !</p>-->
        <!--<fieldset>
          <label for="help-us-email">Your email address:</label>
          <div class="field"><input type="text" name="email" id="help-us-email" value="" /></div>
        </fieldset>-->
        <div class="rating-module" id="help-us-rateit">
          <fieldset>
          <h4>Rate The Buyer</h4>
          <!--<div class="rating-inline">
              <h5>RATE:</h5>
              <ul class="star-rating">
                <li id="shopping-stars" class="current-rating" style="width:0"></li>
                <li><a href="javascript:;" class="star1" id="shopping-rating-1">
                  <input type="radio" value="1" name="rating_1" id="shopping-rating-input-1"/>
                  1</a></li>
                <li><a  href="javascript:;" class="star2" id="shopping-rating-2">
                  <input type="radio" value="2" name="rating_1" id="shopping-rating-input-2"/>
                  2</a></li>
                <li><a  href="javascript:;" class="star3" id="shopping-rating-3">
                  <input type="radio" value="3" name="rating_1" id="shopping-rating-input-3"/>
                  3</a></li>
                <li><a  href="javascript:;" class="star4" id="shopping-rating-4">
                  <input type="radio" value="4" name="rating_1" id="shopping-rating-input-4"/>
                  4</a></li>
                <li><a  href="javascript:;" class="star5" id="shopping-rating-5">
                  <input type="radio" value="5" name="rating_1" id="shopping-rating-input-5"/>
                  5</a></li>
              </ul>
            </div>-->
          <div class="rating-inline">
            <h5>Rate:</h5>
            <ul class="star-rating">
              <li id="creating-stars" class="current-rating" style="width:0"></li>
              <li><a  href="javascript:;" class="star1" id="creating-rating-1">
                <input type="radio" value="1" name="rating_2" id="creating-rating-input-1"/>
                1</a></li>
              <li><a  href="javascript:;" class="star2" id="creating-rating-2">
                <input type="radio" value="2" name="rating_2" id="creating-rating-input-2"/>
                2</a></li>
              <li><a  href="javascript:;" class="star3" id="creating-rating-3">
                <input type="radio" value="3" name="rating_2" id="creating-rating-input-3"/>
                3</a></li>
              <li><a  href="javascript:;" class="star4" id="creating-rating-4">
                <input type="radio" value="4" name="rating_2" id="creating-rating-input-4"/>
                4</a></li>
              <li><a  href="javascript:;" class="star5" id="creating-rating-5">
                <input type="radio" value="5" name="rating_2" id="creating-rating-input-5"/>
                5</a></li>
            </ul>
          </div>
          <!-- <div class="rating-inline last">
              <h5>Site:</h5>
              <ul class="star-rating">
                <li id="community-stars" class="current-rating" style="width:0"></li>
<li><a  href="javascript:;" class="star1" id="community-rating-1"><input type="radio" value="1" name="rating_3" id="community-rating-input-1"/>1</a></li><li><a  href="javascript:;" class="star2" id="community-rating-2"><input type="radio" value="2" name="rating_3" id="community-rating-input-2"/>2</a></li><li><a  href="javascript:;" class="star3" id="community-rating-3"><input type="radio" value="3" name="rating_3" id="community-rating-input-3"/>3</a></li><li><a  href="javascript:;" class="star4" id="community-rating-4"><input type="radio" value="4" name="rating_3" id="community-rating-input-4"/>4</a></li><li><a  href="javascript:;" class="star5" id="community-rating-5"><input type="radio" value="5" name="rating_3" id="community-rating-input-5"/>5</a></li>
 
              </ul>
            </div>-->
          </fieldset>
          <fieldset>
          <label for="help-us-message">Review:</label>
          <div class="field">
            <textarea id="help-us-sellerdescription" name="sellerdescription" cols="20" rows="5"></textarea>
          </div>
          </fieldset>
        </div>
      </div>
      <div class="buttons">
        <div class="seller-button" style="padding-right: 65px;"><a  class="button form-seller-button" id=""><span class=""><img src="http://demo.maventricks.com/lalbook/application/css/images/SendButton.png" /></span></a></div>
        <a class="button closedrate"><span class=""><img src="http://demo.maventricks.com/lalbook/application/css/images/CancelButton.png" /></span></a> </div>
    </div>
    <!-- Toggle and show this on success -->
    <div style="display:none" id="sellerratingpopform-success">
      <div class="inner">
        <h2>Thank you</h2>
        <h4>We Will Send Your Rating Report Soon To This User</h4>
      </div>
      <div class="buttons"> <a class="button closedrate"><span class="inner">Close</span></a> </div>
    </div>
  </form>
  <?php  if(isset($ratingbids) and $ratingbids->num_rows()>0)
						 {
						 //print_r($buyrequirement);
						
						  foreach($ratingbids->result() as $rating)
						    {
							//print_r($rating);exit;
							?>
  <form name="rating" method="post">
    <!--<input type="hidden" name="jobname" value="<?php echo $rating->
    looking_for;?>" />-->
    <input type="hidden" name="userid" value="<?php echo $rating->user_id;?>" id="bidderid" />
    <input type="hidden" name="useremail" value="<?php echo $rating->email;?>"  id="bidderemail"/>
  </form>
  <?php } }
							?>
							
							<form method="post"  id="nologin" class="nobidform bidform" style="display:none" action="">  
	
<!--<div id="nologin" style="display:none" class="nobidform">-->
<div class='bidformwrapper'>
      <div class="ajaxpopforminner" style=" background: none repeat scroll 0 0 #fff !important; min-height: 100px; text-align: center;padding:10px;line-height:30px;"><p style="text-align:right;clear:both;overflow:hidden;margin:0 0 20px;"> <a class="button close"><span class="inner" style="padding:0 0 5px !important;"><img src="http://demo.maventricks.com/lalbook/application/css/images/close_but.png" /></span></a></p>
	 <h3 style="margin:0 0 0 15px;"> <span id="showrs"> </span> Credits Available </h3>
	  </div> 
	  </div>
	  </form>
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
                            <?php  if(isset($userrecords) and $userrecords->num_rows()>0)
						 {
						 //print_r($buyrequirement);
						
						  foreach($userrecords->result() as $requirementbid)
						    {
							
							$usrcredits=$requirementbid->credit;
							//print_r($usrcredits);
							}
							//echo $usrcredits;
							?>
							<form name="credit" method="post">
							<input type="hidden" value="<?php echo $usrcredits;?>" id="creditavailable" />
							</form>
							
                            <!-- CREDIT of BID POINT (later we will use)
							<li <?php //if($usrcredits!=0) { 
								//echo 'class="clsNoBorder"';} ?>>Bidding credits Available:<span> 
								<?php //echo $usrcredits;?>&nbsp;credits</span>
							</li>
                            <?php //f($usrcredits==0) {
							?>
								<li class="clsNoBorder"><a href="#">Refill</a></li>
                            <?php //} 
						}?>
							-->
							
                          </ul>
                        </div>
                        <!--<div class="clsTab">
                      <ul class="clearfix">-->
                        <!-- <li><a href="#">Browse</a></li>-->
                        <!-- <li><a href="<?php  echo site_url('account'); ?>">My Profile</a></li> 
                      <li class="clsActive"><a href="<?php  echo site_url('mybusiness'); ?>">My Business</a></li>
                                           
                      </ul>-->
                        <?php $this->load->view('view_innermenu'); ?>
                      </div>
                      <div id="selProfile" class="clearfix">
                        <div class="clsBusinessOption"> <?php if($usrcredits!=0) {?><span><a href="#" class="nopopup-bid place" id="credits">
							<!--<img src="<?php echo image_url();?>/refill_img.png" alt="" />--></a></span><?php } ?>
                          <ul class="clearfix">
                            <form name="mybusns" id="">
                              <li>
                                <input type="radio" class="clsRadio" value="1" name="view" id="buyerview" checked="checked"/>
                                Buyer View</li>
                              <li>
                                <input type="radio" class="clsRadio" value="2" name="view" id="sellerview" />
                                Seller View</li>
                            </form>
                          </ul>
                        </div>
                        <?php
							
								//Show Flash Message
							
								if($msg = $this->session->flashdata('flash_message'))
								{
									echo $msg;
								}
								?>
        
		
		
		
		
		
		
		
	<!-- START : BUYER VIEW-->
		
	<div id="forbuyer">
		<div class="clsBusiMenu" >
			<ul class="clearfix">
			<li class="clsNoBorder" id="progres"><a href="#">Work in Progress</a></li>
			<li class="clsNoBorder" id="paswrk"><a href="#">Past Work</a></li>
			<li class="clsNoBorder" id="feedback"> <a href="#">Post Feedback</a></li>
			</ul>
		</div>
						  
							
		<!-- WIP -->	
		<div id="winpr">
			<script type="text/javascript" charset="utf-8">
				
			$(document).ready(function() {
				$('#byer').dataTable({
					'iDisplayLength': 8
				});
			} );
			</script>
		
			<table class="clsBusiness clearboth" width="100%" cellpadding="0" cellspacing="0" id="byer">
				<thead>
					<tr>
						<th>TiTle </th>
						<th> Bids </th>
						<th> Average Bid </th>
						<th> Start Date </th>
						<th> End Date </th>
						<th>Status </th>
					</tr>
				</thead>
				
			   
				<?php  
				if(isset($buyrequirements) and $buyrequirements->num_rows()>0){
			
				  foreach($buyrequirements->result() as $buyerview){
					$bidcount=$buyerview->buy_id;
					$q = "SELECT COUNT(job_id) AS count FROM bids WHERE job_id = $bidcount";
					$query = $this->db->query($q,array($buyerview->bidid));
					$ncomments = $query->result_array();
					$blog_e->n_comments = $ncomments[0]['count'];

					$Totalbid=$blog_e->n_comments;

					?>
					<tr class="clsOdd">
						<td><a href="<?php echo site_url('job/view/'.$buyerview->buy_id);?>" style="text-decoration:underline">
							<?php echo substr($buyerview->looking_for, 0, 20)."...";?></a>
						</td>
						<td><?php if ($blog_e->n_comments!=0) { echo  $blog_e->n_comments ;} else{echo "No bids";}?></td>
						<td><?php $bidavg=$buyerview->bid_amount; if ($blog_e->n_comments!=0) {$totbid=$bidavg/$blog_e->n_comments; echo $totbid;} else{ echo "No bids";}?>
						</td>
						<td><?php echo get_datetime($buyerview->created);?> </td>
						<td><?php $enddt=$buyerview->end_date; $enddate=date('d-m-Y',strtotime($enddt)); echo $enddate;?>
						</td>
						<td> <?php echo $jobstatus=$buyerview->status; ?></td>
					</tr>
					<?php  
					} 
				}?>
				
			</table>
		</div> 
						  
						  
		<!-- POST WORK -->				  
		<div id="pastwork">
		  
			<script type="text/javascript" charset="utf-8">
				$(document).ready(function() {
					$('#pastwork_tbl').dataTable({
						'iDisplayLength': 8
					});
				} );
			</script>
			
			<table class="clsBusiness clearboth" id="pastwork_tbl" width="100%" cellpadding="0" cellspacing="0" >
				<thead>
					<tr>
					<th>Closed Title </th>
					<th> Bids </th>
					<th> Start Date </th>
					<th> End Date </th>
					<th>Status </th>
					</tr>
				</thead>
				
				
				<?php  
				$keywords1='closed';
				$keywords2='awarded';
				
				$this->db->select('*');
				$this->db->from('buy_requirement');
				$this->db->like('buy_requirement.status','awarded');
				$this->db->or_like('buy_requirement.status','closed');
				$this->db->where(array('creator_id' => $loggedInUser->id)); 
				
				$uid=$loggedInUser->id;
				$like1 = "(b.status LIKE '%$keywords1%'  or b.status LIKE '%$keywords2%')  AND b.creator_id = $uid";
				$query = "SELECT *  from buy_requirement as b where b.creator_id=$uid AND ".$like1."";
				
				$res= $this->db->query($query);
				$result = $res->result();
				
				$requirementclosed=$this->db->query($query);
				
				if(isset($requirementclosed) and $requirementclosed->num_rows()>0){

					foreach($requirementclosed->result() as $closed){
				
						$bidcounts=$closed->id;
						$q = "SELECT COUNT(job_id) AS count FROM bids WHERE job_id = $bidcounts";
						$query = $this->db->query($q,array($closed->id));
						$ncomments = $query->result_array();
						$blog_e->n_comments = $ncomments[0]['count'];
						$Totalbid=$blog_e->n_comments;
						?>
						<tr class="clsOdd">
							<td><a href="<?php echo site_url('job/view/'.$closed->id);?>" style="text-decoration:underline">
								<?php echo substr($closed->looking_for, 0, 20)."...";?></a>
							</td>
							<td><?php if ($blog_e->n_comments!=0) { echo  $blog_e->n_comments ;} else{echo "No bids";}?></td>
							<td><?php echo get_datetime($closed->created);?> </td>
							<td><?php $enddt=$closed->end_date; $enddate=date('d-m-Y',strtotime($enddt)); echo $enddate;?>
							</td>
							
							<td><?php echo $bidavg=$closed->status;?> </td>
						</tr>
				<?php  } 
				} ?>
				
				
			</table>
		</div>
						
						
						
						
						
						
		<!-- WORKING -->					
		<div id="wrkin">
			<script type="text/javascript" charset="utf-8">
				$(document).ready(function() {
					$('#wrkintbl').dataTable({
						'iDisplayLength': 8
					});
				} );
			</script>
			<table class="clsBusiness clearboth" id="wrkintbl" width="100%" cellpadding="0" cellspacing="0" >
				<thead>
					<tr>
					<th>Title </th>
					<th> Bids </th>
					<th> Start Date </th>
					<th> End Date </th>
					<th>Status </th>
				</tr>
				</thead>
				
				
				<?php  
				if(isset($openjobs) and $openjobs->num_rows()>0){
		
					foreach($openjobs->result() as $open){
						$bidcount=$open->buy_id;

						$q = "SELECT COUNT(job_id) AS count FROM bids WHERE job_id = $bidcount";
						$query = $this->db->query($q,array($open->buy_id));
						$ncomments1 = $query->result_array();
						$blog_e->n_comments1 = $ncomments1[0]['count'];
						$Totalbid=$blog_e->n_comments1;
						?>
				  
				  
						<tr class="clsOdd">
							<td><a href="<?php echo site_url('job/view/'.$open->buy_id);?>" style="text-decoration:underline">
								 <?php echo substr($buyerview->looking_for, 0, 20)."...";?></a>
							</td>
							<td><?php if ($blog_e->n_comments1!=0) { echo  $blog_e->n_comments1 ;} else{echo "No bids";}?></td>
							<td><?php echo get_datetime($open->created);?> </td>
							<td><?php $enddt=$open->end_date; $enddate=date('d-m-Y',strtotime($enddt)); echo $enddate;?>
							</td>
							<td><?php echo $bidavg=$open->status;?> </td>
						</tr>
					<?php  
					} 
				}?>
				
				
			</table>
		</div>
		
		<!-- POST FEEDBACK -->	
		<div id="postfeedback">
			<script type="text/javascript" charset="utf-8">
				$(document).ready(function() {
					$('#postfeedbacktbl').dataTable({
						'iDisplayLength': 8
					});
				} );
			</script>	
			<table class="clsBusiness clearboth" id="postfeedbacktbl" width="100%" cellpadding="0" cellspacing="0" >
				<thead>
					<tr>
						<th>Closed Title </th>
						<th> Bids </th>
						<th> Start Date </th>
						<th> End Date </th>
						<th> Review/Rating </th>
						<th>Status </th>
					</tr>
				</thead>
				<tbody>
				
				<?php  
				if(isset($torate) and $torate->num_rows()>0){
					foreach($torate->result() as $completed){
				
						$bidcount=$completed->buy_id; 

						$q = "SELECT  COUNT(job_id) AS count FROM bids WHERE job_id = $bidcount";
						$query = $this->db->query($q,array($completed->buy_id));
						$ncomments = $query->result_array();
						//print_r($query);exit;
						$blog_e->n_comments = $ncomments[0]['count'];
						//print_r($blog_e->n_comments);exit;
						//	$blog_e->n_commentse = $ncomments[0]['user_id'];
						$Totalbid=$blog_e->n_comments;
						// echo ($Totalbid);
						$logedinuser=$loggedInUser->id;

						$qr = "SELECT * FROM reviews WHERE job_id = $bidcount and employee_id=$logedinuser";
						$querry = $this->db->query($qr,array($completed->buy_id));
						$reslt = $querry->result_array();
						//print_r($reslt);exit;

						foreach($reslt as $res){
							//print_r($res);

							if(isset($reslt[0]['comments']))
							{
							$blogge->nn_comments=$reslt[0]['comments'];
							}
							if(isset($reslt[0]['rating']))
							{
							$blogge->nn_commentts=$reslt[0]['rating'];
							}				    

							if(isset($reslt[0]['employee_id']))
							{
							$blogge->nn_commenttss=$reslt[0]['employee_id'];
							$qrr = "SELECT * FROM users WHERE id = $blogge->nn_commenttss";
							$querrys = $this->db->query($qrr,array($blogge->nn_commenttss));
							$reslts = $querrys->result_array();
							if(isset($reslts[0]['user_name']))
							{
							$blogge->username=$reslts[0]['user_name'];
							}
							}
						}
						?>

					<form name="bidrat" method="post">
						<input type="hidden" value="<?php  echo $completed->looking_for;?>" id="jobname" />
						<input type="hidden" value="<?php echo $completed->buy_id;?>" id="jobid" />

						<input type="hidden" value="<?php echo $completed->creator_id;?>" id="jobownerid"/>
						<input type="hidden" name="userid" value="<?php echo $completed->awarded_user;?>" id="bidderid" />
						<?php $bideremail = "SELECT * FROM users WHERE id = $completed->awarded_user";
						$querymail = $this->db->query($bideremail,array($completed->awarded_user));
						$bidemail = $querymail->result_array();
						//print_r($query);exit;
						$blog_e->email = $bidemail[0]['email'];?>
						<input type="hidden" name="useremail" value="<?php echo $blog_e->email;?>"  id="bidderemail"/>
						<input type="hidden" value="<?php echo $completed->email;?>" id="owneremail"/>
						<input type="hidden" value="<?php echo $completed->user_name;?>" id="jobowner"/>
						<input type="hidden" value="<?php echo $completed->budget;?>" id="jobbudged"/>
					</form>
				
					<tr class="clsOdd">
						
						<td><!--<a href="#<?php //echo site_url('job/view/'.$completed->buy_id);?>" class="topopup"><?php echo $completed->looking_for;?></a>-->
						<a  title="click To Read" href = "javascript:void(0)" 
							onclick = "document.getElementById('light<?php echo $completed->buy_id;?>').style.display='block';document.getElementById('fade').style.display='block'">
							<?php echo substr($completed->looking_for, 0, 20)."...";?>
						</a></td>


						<div id="light<?php echo $completed->buy_id;?>" class="white_content">
							<a href = "javascript:void(0)" onclick = "document.getElementById('light<?php echo $completed->buy_id;?>').style.display='none';document.getElementById('fade').style.display='none'"><img src="<?php echo image_url();?>/closebox.png" alt="close" style="border: medium none;
							float: right;left: 15px;margin: 0;position: relative;top: -15px;" align="right"></a>
							<?php if(isset($reslts[0]['user_name']))
							{
							echo "<p>"."Name: " .$blogge->username=$reslts[0]['user_name']."</p><br>";
							}
							else{
							echo "No user"."<br>";
							}
							if(isset($reslt[0]['comments']))
							{
							echo "<p>". "Comments:" .$blogge->nn_comments. "</p><br>";
							}
							else {
							echo "No Comments"."<br>";}
							if(isset($reslt[0]['comments']))
							{
							echo "<p>". "Your Rating:" .$blogge->nn_commentts."</p><br>";
							}
							else {
							echo "No Ratings";}
							?>
						</div>
						<div id="fade" class="black_overlay"></div>	


						<td><?php if ($blog_e->n_comments!=0) { echo  $blog_e->n_comments ;} else{echo "No bids";}?></td>
						<td><?php echo get_datetime($completed->created);?> </td>
						<td><?php $enddt=$completed->end_date; $enddate=date('d-m-Y',strtotime($enddt)); echo $enddate;?>
						</td>
						<?php  if ( $completed->status=="wip")
						{ ?>
						<td><a href="#" class="rating-button"  id="rate"> Review/Rating</a></td>
						<?php } ?>
						<?php  if ($completed->status!="closed" && $blog_e->n_comments==0){?>
						<td><?php echo "No Rating Available";?></td>
						<?php } ?>
						<td><?php echo $bidavg=$completed->status;?> </td>
					</tr>
			  <?php } 
				
				}
			?>
			</tbody>
			
		</table>
	</div>
	
	</div>
	<!-- END - BUYER VIEW-->
	
	
	
	<!-- BUYER VIEW and SELLER VIEW SEPARATOR-->
	
	
	
	<!-- START - SELLER VIEW-->	
	<div id="forseller">
		<div class="clsBusiMenu" >
			<ul class="clearfix">
			<li class="clsNoBorder" id="selerwrkin"><a href="#">Work in Progress</a></li>
			<li class="clsNoBorder" id="slerpask"><a href="#">Past Work</a></li>
			<li class="clsNoBorder" id="selerfeedback"><a href="#">Post FeedBack</a></li>
			</ul>
		</div>
         
		<div id="selerhome" >
		
			<script type="text/javascript" charset="utf-8">
				$(document).ready(function() {
					$('#selerhometbl').dataTable({
						'iDisplayLength': 8
					});
				} );
			</script>	
			
			<table class="clsBusiness clearboth" width="100%" cellpadding="0" cellspacing="0" id="selerhometbl" >
				<thead>
				<tr>
					<th>TiTle </th>
					<th> Amount</th>
					<th> Description</th>
					<th> Start Date</th>
					<th> End Date</th>
					<th>Status </th>
				</tr>
				</thead>
				<?php  
				if(isset($sellerview) and $sellerview->num_rows()>0){
					foreach($sellerview->result() as $seller){
						?>
						<tr class="clsOdd">
						<td ><a href="<?php echo site_url('job/view/'.$seller->buy_id);?>" style="text-decoration:underline">
							 <?php echo substr($seller->looking_for, 0, 20)."...";?></a>
						</td>
						<td><?php echo $seller->bid_amount;?> </td>
						<td>
							 <?php echo substr($seller->bid_desc, 0, 40)."...";?> 
						</td>
						<td><?php  $bidstrdate=$seller->bid_time; echo $strdt=date("d-m-Y",strtotime($bidstrdate)); ?></td>
						<td><?php $enddt=$seller->bid_days; $enddate=date("d-m-Y",strtotime($bidstrdate."+".$enddt. "days"));  echo $enddate;?>
						</td>
						<!--<td><a href="#">Review/Rating</a></td>-->
						<td><?php echo $seller->status;?></td>
						</tr>
						<?php  
					} 
				} ?>
				
				</thead>	
			</table>
		</div>
		
                         
		<div id="selerpastwrk">
			<script type="text/javascript" charset="utf-8">
				$(document).ready(function() {
					$('#selerpastwrktbl').dataTable({
						'iDisplayLength': 8
					});
				} );
			</script>	
			
			<table class="clsBusiness clearboth" id="selerpastwrktbl" width="100%" cellpadding="0" cellspacing="0" >
				<thead>
				<tr>
					<th>TiTle </th>
					<th> Amount</th>
					<th> Description</th>
					<th> Start Date</th>
					<th> End Date</th>
					<th>Status </th>
				</tr>
				</thead>
				
			<?php  if(isset($sellerpast) and $sellerpast->num_rows()>0)
			{

			foreach($sellerpast->result() as $sellerpastwork)
			{
			?>
			<tr class="clsOdd">
			<td ><a href="<?php echo site_url('job/view/'.$sellerpastwork->buy_id);?>" style="text-decoration:underline">
				 <?php echo substr($sellerpastwork->looking_for, 0, 20)."...";?></a>
			</td>
			<td><?php echo $sellerpastwork->bid_amount;?> </td>
			<td>
				<?php echo substr($sellerpastwork->bid_desc, 0, 40)."..." ;?> 
			</td>
			<td><?php  $bidstrdate=$sellerpastwork->bid_time; echo $strdt=date("d-m-Y",strtotime($bidstrdate)); ?></td>
			<td><?php $enddt=$sellerpastwork->bid_days; $enddate=date("d-m-Y",strtotime($bidstrdate."+".$enddt. "days"));  echo $enddate;?>
			</td>
			<!--<td><a href="#">Review/Rating</a></td>-->
			<td><?php echo $sellerpastwork->status;?></td>
			</tr>
			<?php  } }?>
			
			
			</table>
		</div>
						  
						  
                        
		<?php  
		if(isset($creatordetails) and $creatordetails->num_rows()>0){
			foreach($creatordetails->result() as $creator){
				?>
				<form name="creatord"  method="post">
				<input type="hidden" value="<?php echo $creator->email;?>" id="creatormail"/>
				<input type="hidden" value="<?php echo $creator->userid;?>" id="creatorid"/>
				<input type="hidden" value="<?php echo $creator->user_name;?>" id="creatorname"/>
				</form>
				<?php 
			} 
		} ?>
                        
		
		<div id="selerfeedb">
			<script type="text/javascript" charset="utf-8">
				$(document).ready(function() {
					$('#selerfeedbtbl').dataTable({
						'iDisplayLength': 8
					});
				} );
			</script>	
			
			<table id="selerfeedbtbl " class="clsBusiness clearboth" width="100%" cellpadding="0" cellspacing="0" >
				<thead>
				<tr>
					<th>TiTle </th>
					<th> Amount</th>
					<th> Description</th>
					<th> Start Date</th>
					<th> End Date</th>
					<th> Review/Rating</th>
					<th>Status </th>
				</tr>
				</thead>
			<?php  
			if(isset($sellerworking) and $sellerworking->num_rows()>0){
				
				foreach($sellerworking->result() as $sellerfee){?>



			<?php 
			//print_r($sellerfee);exit;
			$crid=$sellerfee->creator_id;
			$q = "SELECT * FROM users WHERE id = $crid";
			$query = $this->db->query($q,array($sellerfee->creator_id));
			$ncomments = $query->result_array();
			//print_r($query);exit;
			$blog_e->n_comments = $ncomments[0]['email'];

			$blog_e->n_commentss = $ncomments[0]['id'];
			$projid=$sellerfee->buy_id;
			$logedinuser=$loggedInUser->id;

			//echo "SELECT * FROM reviews WHERE job_id = $projid and userid=$logedinuser";
			$qrs = "SELECT * FROM reviews WHERE job_id = $projid and employee_id=$logedinuser";
			$queryrs = $this->db->query($qrs,array($sellerfee->buy_id));
			$recrds = $queryrs->result_array();
			foreach($queryrs as $recs)
			{
			//print_r($queryrs);exit;
			if(isset($recrds[0]['comments']))
			{
			$blog_e->no_comments = $recrds[0]['comments'];
			}
			$qrss = "SELECT * FROM users WHERE id =$crid";
			$queryrrs = $this->db->query($qrss,array($sellerfee->buy_id));
			$recrdds = $queryrrs->result_array();
			if(isset($recrdds[0]['user_name']))	    
			{
			$blog_e->no_users=$recrdds[0]['user_name'];
			}
			}
			//print_r($sellerfee);
			?>

			<form name="selrrate"  method="post">
			<input type="hidden" value="<?php echo $sellerfee->looking_for;?>" id="buyname" />
			<input type="hidden" value="<?php echo $sellerfee->buy_id;?>" id="jobsid" />
			<input type="hidden" value="<?php echo $loggedInUser->email;?>" id="slereml"/>
			<input type="hidden" value="<?php echo $loggedInUser->id;?>" id="slrid"/>
			<input type="hidden" value="<?php echo $sellerfee->bidid;?>" id="bidsid"/>
			</form>
			<tr class="clsOdd">
			<td ><!--<a href="#<?php //echo site_url('job/view/'.$sellerfee->buy_id);?>" class="popup"><?php echo $sellerfee->looking_for;?></a>-->
			<a  title="click To Read" href = "javascript:void(0)" onclick = "document.getElementById('light<?php echo $sellerfee->buy_id;?>').style.display='block';document.getElementById('fade').style.display='block'">
				  <?php echo substr($sellerfee->looking_for, 0, 20)."...";?></a>
			</td>


			<div id="light<?php echo $sellerfee->buy_id;?>" class="white_content">
			<a href = "javascript:void(0)" onclick = "document.getElementById('light<?php echo $sellerfee->buy_id;?>').style.display='none';document.getElementById('fade').style.display='none'"><img src="<?php echo image_url();?>/closebox.png" alt="close"  style="border: medium none;
			float: right;left: 15px;margin: 0;position: relative;top: -15px;" align="right"></a>

			<?php  foreach($queryrs as $recs)
			{
			//print_r($queryrs);exit;
			if(isset($recrds[0]['comments']))
			{
			$blog_e->no_comments = $recrds[0]['comments'];
			}  }  if(isset($recrds[0]['comments']))
			{
			echo  "<p>"."Comments: ".ucwords($blog_e->no_comments = $recrds[0]['comments'])."</p>";
			if(isset($recrdds[0]['user_name']))	    
			{
			$blog_e->no_users=$recrdds[0]['user_name'];

			echo "<p>"."From:".  $blog_e->no_users."</p>";
			}} else { echo "No comments";}?>
			</div>
			<div id="fade" class="black_overlay"></div>					  
			<!--<div id="Popup">

			<div class="closed"></div>
			<span class="ecsp_tooltip">Press Esc to close <span class="arrow"></span></span>
			<div id="pop_content"> 

			<p><label> From</label>: <?php  /*if(isset($recrdds[0]['user_name']))	    
			{
			echo $blog_e->no_users=$recrdds[0]['user_name'];
			} 
			else
			{
			echo "No User";}*/

			?><!--your content start-->
			<!--<p><label>Comments Recieved</label>:<span style="float:left;width:310px;float:right;display:block;text-align:left;"> <?php if(isset($recrds[0]['comments']))
			/*{
			echo $blog_e->no_comments = $recrds[0]['comments'];
			} else { echo "No comments";}?> </span></p>
			<p><label> Rating</label>:
			<?php 	 if(isset($recrds[0]['rating'])) 
			{
			echo $blog_e->no_comments = $recrds[0]['rating'];
			} else {echo "no Rating";}*/?></p>
			<p align="center">--><!--<a href="#" class="livebox">Click Here Trigger</a>--><!--</p>-->
			<!--   </div>--> <!--your content end-->

			<!--  </div>--> <!--toPopup end-->
			<td><?php echo $sellerfee->bid_amount;?> </td>
			<td>
				 <?php echo substr($sellerfee->bid_desc, 0, 40)."...";?> 
			</td>
			<td><?php  $bidstrdate=$sellerfee->bid_time; echo $strdt=date("d-m-Y",strtotime($bidstrdate)); ?></td>
			<td><?php $enddt=$sellerfee->bid_days; $enddate=date("d-m-Y",strtotime($bidstrdate."+".$enddt. "days"));  echo $enddate;?>
			</td>
			<td><a href="#" id="sellerrating" class="selrrating"> Review/Rating </a></td>

			<td><?php echo $sellerfee->status;?></td>
			</tr>
			<?php  } ?>  
			<?php 
			} ?>
			
			
			</table>
		</div>
     </div>
	
	<!-- END - SELLER VIEW-->		
						
						
						
						
						
						
						
						
						
						
						
						
						
						
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

	<script type="text/javascript" language="javascript" src="<?php echo base_url();?>/application/js/datatable/jquery.js"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url();?>/application/js/datatable/jquery.dataTables.js"></script>
	
						
</body>
</html>
