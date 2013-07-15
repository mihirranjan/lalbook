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

.clsPostIcons #tabs ul li {
    margin: 0 4px 0 0 !important;
	  width: auto!important;
}
#tabs ul li.active, #tabs ul li:hover, #tabs ul li {
    background: none repeat scroll 0 0 transparent;
}
#tabs ul li, #tabs ul li.active, #tabs ul li:hover {
    width: auto!important;
}
.clsAccDetails {
    float: right;
    padding: 5px 0 !important;
    width: 310px;
}
</style>
<style type="text/css">
 a.tooltip {outline:none; } a.tooltip strong {line-height:30px;} a.tooltip:hover {text-decoration:none;} a.tooltip span { z-index:10;display:none; padding:14px 20px; margin-top:60px; margin-left:-160px; width:240px; line-height:16px; } a.tooltip:hover span{ display:inline; position:absolute; border:2px solid #FFF; color:#EEE; background:#000 url(src/css-tooltip-gradient-bg.png) repeat-x 0 0; } .callout {z-index:20;position:absolute;border:0;top:-14px;left:120px;} /*CSS3 extras*/ a.tooltip span { border-radius:2px; -moz-border-radius: 2px; -webkit-border-radius: 2px; -moz-box-shadow: 0px 0px 8px 4px #666; -webkit-box-shadow: 0px 0px 8px 4px #666; box-shadow: 0px 0px 8px 4px #666; opacity: 0.8; }
.loading {
	display:none;
}
.pagingnav {
    clear: both;
    float: right;
    margin: 0 auto;
    overflow: hidden;
    width: auto;}
 
 .pagingnav p{
 text-align:center;
 }
  .pagingnav p span a{
  background:#c00000;
  color:#fff;
  display:block;padding:3px 5px;
  float:left;
     margin:0 5px 0 0;
  }
   .pagingnav p span.clsActive{
   background:transparent;
   padding:3px 5px;
   color:#000;
   float:left;
   margin:0 5px 0 0;
   }
 </style>
</head>

<body>
<div class="Container">

	<?php $this->load->view('header'); ?>
	<script type="text/javascript" src='<?php echo base_url();?>application/js/jquery-1.4.1.min.js'></script>
	<!--<script type="text/javascript" src="<?php echo base_url();?>application/js/jsDatePick.jquery.min.1.3.js"></script>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url();?>application/css/css/jsDatePick_ltr.min.css" />-->
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url();?>application/css/css/popupstyle.css" />
	<link href="<?php echo base_url(); ?>application/css/css/bidpopup.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src='<?php echo base_url();?>application/js/bidpopup.js'></script>
	<script type="text/javascript" src='<?php echo base_url();?>application/js/fornotlogin.js'></script>
	
	<script type="text/javascript">
	$(document).ready(function(){
	$('.place').click(function() {
			var id = $(this).attr('id');
			var logeduserid = $("#userid").val();
			//alert(logeduserid);
			var useremail=$("#usermail").val();
			var usercredits=$("#usercredit").val();
				var bidder=$("#bidderemail").val();
			//alert(usercredits);
			$("#bidid").val(id);
			$("#usrid").val(logeduserid);
			$("#usrmailid").val(useremail);
			$("#usercr").val(usercredits);
		   // alert(logeduserid);
		   var jobnamee=$("#jobname").val();
		   var bidername=$("#biddername").val();
			var bidamount=$("#bidamount").val();
			var jobbudget=$("#jobamount").val();
			$("#jobnames").val(jobnamee);
			$("#bideremail").val(bidder);
			$("#biddernamee").val(bidername);
			$("#jobamt").val(jobbudget);
	});

		
		function lastPostFunc() {
			var url = webroot+"index.php/seller/sellerscrollPagination";
			$(".ajax_loader").show();
			//send a query to server side to present new content
			$.post(url,{current_page:$('#current_page').val(),budget:$('#budget').val(),keyword:$('#keyword').val(),country:$('#country').val(),category:$('#category').val(),bstype:$('#bstype').val()},function(res) {
				$(".ajax_loader").hide();
				$("#resultHolder").append(res);

			});
		};

	//When scroll down, the scroller is at the bottom with the function below and fire the lastPostFunc function
	$(window).scroll(function() {

		if ($(window).scrollTop() == $(document).height() - $(window).height()) {
			
			var  page = parseInt($('#current_page').val());
				page  = parseInt(page+1);
		
			$('#current_page').val(page);
			if($('#total_page').val()<=$('#current_page').val()){
				//$(".loading").show();
				lastPostFunc();
			}else{
			
			//$('.loadingend').show();
			}
			
		}
	});
		
		
	});
</script>

<link type="text/css" href="<?php echo base_url();?>application/css/css/jquery.datepick.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>application/js/jquery.datepick.js"></script>
<script type="text/javascript">
$(function() {
	$('.popupDatepicker').datepick();
	$('#inlineDatepicker').datepick({onSelect: showDate});
});

function showDate(date) {
	alert('The date chosen is ' + date);
}
</script>
<?php 
/**
 * trims text to a space then adds ellipses if desired
 * @param string $input text to trim
 * @param int $length in characters to trim to
 * @param bool $ellipses if ellipses (...) are to be added
 * @param bool $strip_html if html tags are to be stripped
 * @return string
 */
function trim_text($input, $length, $ellipses = true, $strip_html = true) {
	//strip tags, if desired
	if ($strip_html) {
		$input = strip_tags($input);
	}

	//no need to trim, already shorter than trim length
	if (strlen($input) <= $length) {
		return $input;
	}

	//find last space within length
	$last_space = strrpos(substr($input, 0, $length), ' ');
	$trimmed_text = substr($input, 0, $last_space);

	//add ellipses (...)
	if ($ellipses) {
		$trimmed_text .= '...';
	}

	return $trimmed_text;
}
?>
	<form method="post"  id="bidform" class="bidform" style="display:none" action="">  
	
<div class='bidformwrapper'>
      <div class="ajaxpopforminner">
				<h2>Place Your Bid  <a class="button cancel"><span class="inner"><img src="<?php echo image_url();?>close.png" /></span></a></h2>
			<input type="hidden" id="bidid" name="hidden_bidid"/>
			<input type="hidden" id="usrid" name="hidden_userid"/>
			<input type="hidden" id="usrmailid" name="hidden_mail"/>
			<input type="hidden" id="usercr" name="hidden_credit" />
			<input type="hidden" id="jobnames" name="hidden_jobname" />
			<input type="hidden" id="bideremail" name="hidden_bideremail" />
			<input type="hidden" id="biddernamee" name="hidder_bidername" />
			<input type="hidden" id="jobamt" name="hidden_jobamount" />  
			
			<fieldset>
				  <label for="help-us-email">Quote Your Price(All price in Rs.)*:</label>
				  <div class="field"><input type="text" name="bidamount" id="help-us-bidamount" value="" /></div>
			</fieldset>
			 <fieldset>
				  <label for="help-us-email">Enter End-Date*:</label>
				  <div class="field">
				  <input type="text" name="deliverdate" id="help-us-deliverdate" class="popupDatepicker"  value=""  />
				  </div>
			</fieldset>
        <fieldset>
          <label for="help-us-email">Message to the buyer(Optional):</label>
          <div class="field"><textarea  name="desc" id="help-us-desc" cols="10" rows="3"></textarea></div>
        </fieldset>
		
      </div>
      <div class="buttons">
        <div class="submit-bid" style="text-align: center;width: 77px;margin: 0 auto;"><input type="submit" class="button form-submit-bid clsBut" name="Complete This Bid" value="send"/><!--<span class="inner">Send</span>--></div>
		<p style="clear: both; font-weight: bold; padding: 10px 0px; text-align: center; margin: 0px 50px;">*1 Credit Point Will Be Deducted From Your Available Bidding Credits</p>
      
      </div>
  </div>    
    <!-- Toggle and show this on success -->
    <div style="display:none" id="bidform-success">
      <div class="inner">
        <h2>Thank you For Your Bid</h2>
        <h4>we will send your contact details along with your quoted price to this buyer..</h4>
      </div>
      <div class="buttons">
      <a class="button cancel"><span class="inner">Close</span></a>
      </div>
    </div>
     </form>
	 <form method="post"  id="nologin" class="nobidform bidform" style="display:none" action="">  
	
<!--<div id="nologin" style="display:none" class="nobidform">-->
<div class='bidformwrapper'>
      <div class="ajaxpopforminner" style=" background: none repeat scroll 0 0 #fff !important; min-height: 100px; text-align: center;padding:10px;line-height:30px;">
	 <h3> <a class="button close"><span class="inner" style="padding:0 0 5px !important;"><img src="http://demo.maventricks.com/lalbook/application/css/images/close_but.png" /></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please<br /> Login To Place<br /> Your Bid </h3>
	  </div> 
	  </div>
	  </form>
   <!--<div id="selSearch">
    <p><label>Search Jobs</label>
	  <form id="search" name="search" method="get" action="<?php echo site_url('home/search'); ?>">
	  <input type="text" name="keyword"  onblur="placeholder='Search Products'" onfocus="placeholder=''" placeholder='Search Products' id="inputTextboxes" class="clsSertxt">
      <select class="clsTopSelect"><option>Search for Buy Requirement</option><option>Search for Merchant</option></select>
 <!--<input type="text" value="Search for product bids" class="clsSertxt">-->
<!-- <input type="submit" value="" class="clsGobut">
 </form></p>
    </div>-->
     <?php $this->load->view('home_search'); ?>
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
					   <?php if($loggedInUser)
				   {
				 
					    if(isset($userrecords))
						 {
						
						  foreach($userrecords->result() as $userdetails)
						    {
							
							$usrcredits=$userdetails->credit;
							//print_r($userdetails);
							}
							//echo $usrcredits;
							?>
                      <li <?php if($usrcredits!=0) { echo 'class="clsNoBorder"';} ?>>Bidding credits Available:<span> <?php echo $usrcredits;?>&nbsp;credits</span></li>
					  <?php if($usrcredits==0) 
					  {
					  ?>
                      <li class="clsNoBorder"><a href="#">Refill</a></li>
					  <?php } 
					  }}?>
                      </ul>
                      </div>
                     <!-- <div class="clsTab">
					  
                      <ul class="clearfix">
					  
                     
                     <li class="clsActive"><a href="<?php  echo site_url('seller'); ?>">Browse</a></li>
                           <!--<li><a href="<?php  echo site_url('requirement/create'); ?>"><?php echo $this->lang->line('Post Requirement'); ?></a></li>               -->
                     <!-- </ul>
                      
                      </div>-->
                      <div id="selProfile" class="clearfix">                      
                      <div class="clsBusinessOption">
					   <?php if(!$loggedInUser)
				   {?>
                    <!-- <span><a href="#"><img src="<?php echo image_url();?>/signup_img.png" alt="" /></a></span>-->
					 <?php } ?>
                      <h2>Search Options</h2>                      
                      </div> 
                      <div class="clsLeftsideBox">
                      
                      <div class="clsLeftbar">
                           <h3>Search Box</h3>
					  <form id="searchrequirement" name="searchrequirement" method="post" action="<?php echo site_url('seller/index');?>">
                      <p><input id="keyword" type="text" class="clsSerText" onblur="placeholder='Search'" onfocus="placeholder=''" placeholder='Search' name="keyword" value="<?php echo set_value('keyword'); ?>"/></p>
					  <h3>Business Type</h3>
					    <p><select id="bstype" name="bstype"  class="clspostselect">
						<option value="">Select</option>
		
			
						<option value="1" <?php echo set_select('bstype', '1', TRUE); ?>>Products</option>
                       <option value="2" <?php echo set_select('bstype', '2'); ?>> Services</option>
                       

			
		
	</select></p>
                      <h3>Budget</h3>
                      <p><select  id="budget" name="budget"  class="clspostselect">
		<option value="">Select</option>
		
			
			<option value="<10,000" <?php echo set_select('budget', '<10,000', TRUE); ?>>&lt;10,000</option>
                       <option value="10,000 - 1,00,000" <?php echo set_select('budget', '10,000 - 1,00,000'); ?>> 10,000 - 1,00,000</option>
                        <option value="1,00,000 - 10,00,000" <?php echo set_select('budget', '1,00,000 - 10,00,000'); ?>>1,00,000 - 10,00,000</option>
                        <option value="10,00,000 - 1,00,00,000" <?php echo set_select('budget', '10,00,000 - 1,00,00,000'); ?>>10,00,000 - 1,00,00,000</option>
                       <option value=">1,00,00,000" <?php echo set_select('budget', '>1,00,00,000'); ?>>&gt;1,00,00,000</option>

			
		
	</select></p>
                       <h3>Location</h3>
                      <p><select name="country" id="country" ><option value="">Select Location</option>
	 <?php
		
		if(isset($countries) and $countries->num_rows()>0)
		{
 			foreach($countries->result() as $country)
			{ ?>
	 <option value="<?php echo $country->country_symbol;?>"><?php echo $country->country_name;?></option>
	 <?php }}?>
	 </select></p>
                       <h3>Catagory</h3>
                      <p><select name="category" id="category" ><option value="">Select Category</option>
					  <?php if(isset($categorries) and $categorries->num_rows()>0)
		{
 			foreach($categorries->result() as $cate)
			{ 
			$catg=$cate->category;
			
			?>
	 <option value="<?php echo $catg;?>"<?php 
				 
					    if(isset($userrecords))
						 {
						
						  foreach($userrecords->result() as $userdetails)
						    {
							
							$categr=$userdetails->industry_type;
							if($cate->category==$userdetails->industry_type) 
							{ 
							echo "selected";
							}
							 }
							}
							
							?>
							><?php echo $catg;?></option>
	 <?php }}?>
	 </select></p>
                      <p style="margin:10px 0 0;"><input type="submit" class="clsCommonbut" value="search" name="search"/></p>
					  </form>
					     <!--<div class="clsAdver">
    <p><img src="<?php echo image_url();?>/sidebar_img.jpg" alt="" /></p>
    <p class="clsAlign"><a href="#">Click Here</a></p>
    </div>-->
    
                      </div> 
                      <!--<p style="width:180px;margin:0 auto;"><img src="<?php echo image_url();?>/100_bid.png" alt="" /></p>-->
                  </div>
<?php  if(isset($searches)){
				  
		if(isset($searches) and $searches->num_rows()>0)
				{
				
				echo '<div id="resultHolder">';
				echo '<input type="hidden" id="total_page" value="'.ceil(count($searches->result())/6).'" />  
			<input type="hidden" id="current_page" value="1" />';
					foreach($searches->result() as $searchresult)
					{
							$reqimages=$searchresult->requirement_image;
							//echo '<pre>'; print_r($searchresult);//exit;
							?>
							
            <div class="clsBrowser clearfix"> 
						 <div class="clsLeftbrowse">
							  <form name="" method="post">
										<input type="hidden" value="<?php echo $searchresult->credit; ?>"  id="usercredit"/>
									  <?php if($loggedInUser)
											{ ?>
								   
										<input type="hidden" value="<?php echo $loggedInUser->id; ?>"  id="userid"/>
										<input type="hidden" value="<?php echo $loggedInUser->email; ?>"  id="usermail"/>
									  
									  
									   <?php } ?>
							  </form>
										<?php if($reqimages){ ?>
										<img class='thumbnail' src='<?php echo base_url();?>files/job_attachment/<?php echo $reqimages;?>' alt="" />
									<?php }else{ ?>
										<img src="<?php echo image_url();?>/dgff.png" alt="" />
									<?php } ?>
									<h3><a href="<?php echo site_url('job/view/'.$searchresult->buy_id);?>"><?php echo $searchresult->looking_for;?></a></h3>
									<p><span>Location : <?php echo $searchresult->country_symbol;?>,<?php echo $searchresult->state;?></span></p>
									<p><span>Posted : <?php $postdt=$searchresult->created;  echo get_datetime($searchresult->created);?></span></p>
                     
								  <div class="clsCatg">
										<h3><span><label style="color:#333;">Type</label> :&nbsp;<?php $btype=$searchresult->requirements; 
										if($btype==1){ echo "Products";} if($btype==2){echo "Services";} if($btype==3){echo "Products & Services";}?></span>
										<label style="color:#333;">Category </label>:&nbsp;<?php echo $searchresult->category;?></h3>
										<div class="clsCatgDesc">
												<p><?php $desctiption = $searchresult->description; $length = 100; echo trim_text ($desctiption, $length, $ellipses = true, $strip_html = true); ?></p>
												
										  </div>
												<p class="clsAlign"><a style="text-decoration:underline;" href="<?php echo site_url('job/view/'.$searchresult->buy_id);?>">View more</a></p>
								  </div>
                      
						</div> 
					  
                                 <div class="clsLeftserBox">
										<div class="clsRightbar">
						 
											<p>
												<label>Buyer </label>:<span><?php echo ucfirst($searchresult->user_name);?></span>
											</p>
											<?php $jobidd=$searchresult->buy_id;
											//echo "SELECT COUNT(job_id) AS count FROM bids WHERE job_id = $jobidd";
											$q = "SELECT SUM(bid_amount) AS sum,COUNT(job_id) AS count FROM bids WHERE job_id = $jobidd";
											//$rest= $this->db->query($q);
														//$results = $rest->result();
														$query = $this->db->query($q,array($searchresult->buy_id));
												   $ncomments = $query->result_array();
												   //print_r($query);exit;
												$blog_e->avgbid = $ncomments[0]['sum'];
												$blog_e->counts = $ncomments[0]['count'];
											?>
											<p><label>Avg.Bid </label>:<span><?php if($blog_e->counts>1){ if(isset($blog_e->avgbid)) { echo $blog_e->avgbid/$blog_e->counts;?><img src="<?php echo image_url();?>rupee_icon.png"  /> <?php } } 
											elseif(isset($blog_e->avgbid) || ($blog_e->avgbid!='') || ($blog_e->avgbid!=NULL) ){ echo round($blog_e->avgbid,1);?> <?php  } else { echo "No bids";}?></span></p>
											<p><label>Budget </label>:<span> <?php echo $searchresult->budget;?></span><img src="<?php echo image_url();?>rupee_icon.png" /></p>
											<p><label>Bid End Date </label>:<span><?php echo $searchresult->end_date;?></span></p>
											<p><label>Project ID </label>:<span><?php echo $searchresult->buy_id;?></span></p>
											<?php $verifyusers=$searchresult->user_verify;?>

										<p style="text-align:center;">
										<?php if($verifyusers==1)
										{
										?>
										<a href="#" class="tooltip"> <input type="button" class="clsVerify" value="Verified" /> <span> <strong>User Verified By Lalbook</strong></a> 
										<?php } ?>
										<?php if($verifyusers==0)
										{
										?>
										<a href="#" class="tooltip"><input type="button" class="clsVerify" value="Not Verified" />
										<span>  <strong>User Not Verified By Lalbook</strong></a>  
										<?php } ?>
										</p> 
									</div>
										   <?php
										 //  print_r($searchresult);exit;
								$jobpostedid=$searchresult->creator_id;
										//   echo $jobpostedid;
											if($loggedInUser && $loggedInUser->id!=$jobpostedid)
										   { 
										
										   ?>
											<!--<p style="	text-align:center;clear:both;padding:10px 0;"><a href="#" class="popup-bid place" id="<?php echo $searchresult->buy_id;?>"><img src="<?php echo image_url();?>/bid_img.jpg" alt="" /></a></p>-->
											<?php }?>
											 <?php if(!$loggedInUser)
										   { 
										 //  echo $loggedInUser->user_id;exit;
											?>
														  
									<p style="	text-align:center;clear:both;padding:10px 0;"><a href="#" class="nopopup-bid place" ><img src="<?php echo image_url();?>/bid_img.jpg" alt="" /></a></p>
									<?php } ?>
								</div>
            </div>
			<?php 	}
				
				 echo '</div>';
				 echo '<div class="loading clsBrowser" style="border:0;"><img src="'.base_url().'/application/images/loader.gif" /></div>';
				 echo '<div  class="loadingend clsBrowser" style="border:0;display:none;">No record found</div>';
				}
				else{
				  
				   ?>
                       <div class="clsBrowser clearfix" style="border:none;">
                       <div class="clsNoResult"> 
                       <div style="width:400px;margin:0px auto;padding:50px 0 0;"> 
                       <p><span>Sorry</span><br /> <?php echo "Your Search Did Not";?><br/><?php echo "Match Any Requirement";?></p>
						</div></div></div>
						<?php } ?>
				  
				  
				  
				  
				  
				  
				  
				  
				  
					   
					  <?php }
					  else {
					  
					   if(isset($buyrequirement) and $buyrequirement->num_rows()>0)
						 {
						//echo $buyrequirement->num_rows();
						  foreach($buyrequirement->result() as $requires)
						    {
							
							$reqimage=$requires->requirement_image;
							$useridd=$requires->creator_id;
							$credit=$requires->credit;
							//print_r($requires);exit;
							?>
							<?php //echo "files/job_attachment/". $reqimage;?>
                             <div class="clsBrowser clearfix"> 
                      <div class="clsLeftbrowse">
					  
					 <?php  
					 
					 echo $requires->requirement_image; exit;
					 
					 if($requires->requirement_image!=''){ ?>
					<?php //echo $reqimage; ?>
							<img class='thumbnail' src='<?php echo base_url();?>files/job_attachment/<?php echo $reqimage;?>' alt="" />
							<?php } else 
							{ ?>
							<img src="<?php echo image_url();?>/dgff.png" alt="" />
							<?php } ?>
                     <!-- <img src="/browse_img1.jpg" alt="" />-->
                      <h3><a href="<?php echo site_url('job/view/'.$requires->buy_id);?>"><?php echo $requires->looking_for;?></a></h3>
                      <p><span>Location : <?php echo $requires->country_symbol;?>,<?php echo $requires->state;?></span></p>
                      <p><span>Posted : <?php $postdt=$requires->created;  echo get_datetime($requires->created);?></span></p>
                   
                      <div class="clsCatg">
                      <h3><span><label style="color:#333;">Type </label>:&nbsp;<?php $btype=$requires->requirements; if($btype==1){ echo "Products";} if($btype==2){echo "Services";} if($btype==3){echo "Products & Services";}?></span><label  style="color:#333;">Category</label> :&nbsp;<?php echo $requires->category;?></h3>
					<div class="clsCatgDesc">
                      <p><?php echo $requires->description;?></p>
                      </div>
					     <p><span>Tags :<?php echo $requires->tags;?></span></p>
                      <p class="clsAlign"><a style="text-decoration:underline;" href="<?php echo site_url('job/view/'.$requires->buy_id);?>">View more</a></p>
                      </div>
                      
                      </div> 
					  
                                 <div class="clsLeftserBox">
                                 <!--<div class="clsRightbar">
                                 <h3>Make an informed decision</h3>
                                 <p>Get quotes from menchants to help you in making the right decision for your business.</p>
                                 <p>This service will always be FREE for you.</p>
                                 </div>-->
                                 
                		<div class="clsRightbar">
						 <?php  if(isset($bidjob) and $bidjob->num_rows()>0)
						 {
						
						//echo $buyrequirement->num_rows();
						  foreach($bidjob->result() as $bidsc)
						    {
							$bidamt=$bidsc->bid_amount;
							$nobids=count($bidsc->bidid);
							$totalbid=$bidamt/$nobids;
							//print_r($bidsc);exit;
							}
							}
							?>
							<?php  $jobidd=$requires->buy_id;
							//echo "SELECT SUM(bid_amount) AS tot,COUNT(id) AS totid  FROM bids WHERE job_id = $jobidd";
					  $q = "SELECT SUM(bid_amount) AS tot,COUNT(id) AS totid  FROM bids WHERE job_id = $jobidd";
							//echo "SELECT COUNT(job_id) AS count FROM bids WHERE job_id = $jobidd";
 $query = $this->db->query($q,array($requires->buy_id));
       $ncomments = $query->result_array();
	  // print_r($query);exit;
	$blog_e->n_comments = $ncomments[0]['tot'];
	$blog_e->n_comments1 = $ncomments[0]['totid'];

	
	?>
<p><label>Buyer </label>:<span><a href="<?php if(isset($loggedInUser->id)){if($loggedInUser->id==$requires->creator_id){ echo site_url('account');} else { echo site_url('users/view/'.$useridd);}} else { echo site_url('users/view/'.$useridd);}?>">
<?php echo $requires->user_name;?></a></span></p>
<p><label>Avg.Bid </label>:<span><?php if($blog_e->n_comments1!=0)
	{
	echo $n_bidsavg=$blog_e->n_comments/$blog_e->n_comments1;
	} else { echo "No bids";}?><img src="<?php echo image_url();?>rupee_icon.png" /></span></p>
<p><label>Budget </label>:<span> <?php echo $requires->budget;?></span><img src="<?php echo image_url();?>rupee_icon.png" /></p>
<p><label>Bid End Date </label>:<span><?php echo $requires->end_date;?></span></p>
<p><label>Project ID </label>:<span><?php echo $requires->buy_id;?></span></p>
<?php $verifyuser=$requires->user_verify;?>

<p style="text-align:center;">
<?php if($verifyuser==1)
{
?>
<a href="#" class="tooltip"> <input type="button" class="clsVerify" value="Verified" /> <span> <strong>User Verified By Lalbook</strong></a> </span> </a>
<?php } ?>
<?php if($verifyuser==0)
{
?>
<a href="#" class="tooltip"> <input type="button" class="clsVerify" value="Not Verified" />
<span>   <strong>User Not Verified By Lalbook</strong></span> </a>
<?php } ?>
</p> 
                    </div>
					
	   
                   <?php $status=$requires->status;
				   //echo $status;
				   if($loggedInUser && $loggedInUser->id!=$useridd && $requires->status=='open')
				   { 
				   $usid=$loggedInUser->id; 
$qs= "SELECT COUNT(user_id) as total FROM bids WHERE user_id = $usid and job_id=$requires->buy_id";
       $queryys = $this->db->query($qs,array($loggedInUser->id));
       $bidcredits = $queryys->result_array();
	  $blog_e->total = $bidcredits[0]['total'];
	 //echo $blog_e->total;
	 if($blog_e->total!=1)
	 {
				   ?>
                    <p style="	text-align:center;clear:both;padding:10px 0;"><a href="#" class="popup-bid place" id="<?php echo $requires->buy_id;?>"><img src="<?php echo image_url();?>/bid_img.jpg" alt="" /></a></p>
					<?php } }?>
                     <?php if(!$loggedInUser)
				   { 
					?>
					 
<p style="	text-align:center;clear:both;padding:10px 0;"><a href="#" class="nopopup-bid place" ><img src="<?php echo image_url();?>/bid_img.jpg" alt="" /></a></p>
<?php } ?>
                        </div>
                         </div>
						<?php } ?>
						  <?php if($loggedInUser)
				   { 
						$logid=$loggedInUser->id;
							//echo "SELECT SUM(bid_amount) AS tot,COUNT(id) AS totid  FROM bids WHERE job_id = $jobidd";
					  $qrr = "SELECT *  FROM users WHERE id = $logid";
							//echo "SELECT COUNT(job_id) AS count FROM bids WHERE job_id = $jobidd";
 $querrry = $this->db->query($qrr,array($loggedInUser->id));
       $ncomments_credit= $querrry->result_array();
	   $blog_e->credit = $ncomments_credit[0]['credit'];
	   ?>
						<form name="" method="post">
					  <input type="hidden" value="<?php echo  $blog_e->credit;?>"  id="usercredit"/>
					 
					  <input type="hidden" value="<?php echo $loggedInUser->id; ?>"  id="userid"/>
					   <input type="hidden" value="<?php echo $loggedInUser->email; ?>"  id="usermail"/>
					    <input type="hidden" value="<?php echo $loggedInUser->email; ?>"  id="bidderemail"/>
					   <input type="hidden" value="<?php echo $requires->looking_for;?>" id="jobname" />
					    <input type="hidden" value="<?php echo $loggedInUser->user_name;?>" id="biddername" />
						<input type="hidden" name="jobbudget" value="<?php echo $requires->budget;?>" id="jobamount" />
					   <?php } ?>
					  </form> 
					  
					      <div class="pagination">   <?php if(isset($pagination1)) {echo $pagination1; }else if(isset($pagination)) {echo $pagination;}?></div>
					  <?php } else{  ?>
                       <div class="clsBrowser clearfix" style="border:none;"> 
                            <div class="clsNoResult">
                            <div style="width:400px;margin:0px auto;padding:50px 0 0;"> 
							
											
							
							
                       <p><span>Sorry</span><br /> <?php echo "Your Search Did Not ";?><br/><?php echo " Match Any Requirement";?></p>
                       </div>
						</div></div>
                      
						</div>
						

						
						<?php }  }?>
                 
                     
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
     <?php $this->load->view('home_footer'); ?>
</body>
</html>