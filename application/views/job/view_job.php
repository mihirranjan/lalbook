<div class="Container">
<?php $this->load->view('header'); 
$url = "";
$url_data = $_SERVER['REQUEST_URI'];
if(isset($_SERVER['HTTP_REFERER'])){
	$url_ref = $_SERVER['HTTP_REFERER'];
	if (false !== strpos($url_ref,'mybusiness') && false !== strpos($url_data,'job') && false !== strpos($url_data,'view')) {
		$url = site_url('mybusiness');
	}else{
		$url = site_url('seller');
	}
}else{
	$url = site_url('seller');
}
?>


<div style="position:relative; margin-bottom: 4px;">
    <a href="<?php echo $url; ?>" ><img src="<?php echo image_url();?>back.png"></a>
    <div style="position: absolute; left: 28px; color: rgb(102, 102, 102); font-size: 12px; top: 9px; text-decoration: underline; cursor: pointer;">
		<a href="<?php echo $url; ?>" >Back</a><div>
</div>
</div>
</div>
	
<?php //$this->load->view('sidebar'); ?>

<!--MAIN-->
<style type="text/css">


</style>

<link href="<?php echo base_url(); ?>application/css/css/bidpopup.css" rel="stylesheet" type="text/css" /> 
<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url();?>application/css/css/popupstyle.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>application/css/css/msgpop.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>application/css/css/msgtobidder.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>application/css/css/amoutedit.css" />

<script type="text/javascript" src='<?php echo base_url();?>application/js/fornotlogin.js'></script>
<script type="text/javascript" src='<?php echo base_url();?>application/js/msgtobidder.js'></script>
<script type="text/javascript" src='<?php echo base_url();?>application/js/messagepop.js'></script>
<script type="text/javascript" src='<?php echo base_url();?>application/js/bidpopup.js'></script>
<script type="text/javascript" src="<?php echo base_url();?>application/js/editamt.js"></script>

   


	<script type="text/javascript">
	$(document).ready(function(){
		$(".datepick-popup").css("z-index","99999999999");
	$('.place').click(function() {
    var id = $(this).attr('id');
	var logeduserid = $("#userid").val();
	//alert(logeduserid);biduserid
	var biduser=$("#biduserid").val();
	var jobids=$("#jobid").val();
	var jobemail=$("#emails").val();
	var usercredits=$("#usercredit").val();
	var jobnamee=$("#jobname").val();
	var bidder=$("#bidderemail").val();
	//alert(usercredits);
	var tojob=$("#toidjob").val();
	var bidername=$("#biddername").val();
	var bidamount=$("#bidamount").val();
	var jobbudget=$("#jobamount").val();
	
	//alert(tojob);
	$("#bidid").val(jobids);
	$("#jobid").val(jobids);
	$("#bidjob").val(biduser);
	$("#fromid").val(biduser);
	$("#toid").val(tojob);
	$("#usrmailid").val(jobemail);
	$("#tomail").val(jobemail);
	$("#usercr").val(usercredits);
	$("#jobnames").val(jobnamee);
	$("#bideremail").val(bidder);
	$("#biddernamee").val(bidername);
	$("#jobamt").val(jobbudget);
	
	
   // alert(logeduserid);
});
$('.msgcls').click(function() {
    var id = $(this).attr('id');
	var logeduserid = $("#userid").val();
	//alert(logeduserid);biduserid
	var biduser=$("#biduserid").val();
	var jobids=$("#jobid").val();
	var jobemail=$("#emails").val();
	var usercredits=$("#usercredit").val();
	//alert(usercredits);
	var tojob=$("#toidjob").val();
	var bidemail=$("#bidderemail").val();
	//alert(tojob);
	$("#bidid").val(jobids);
	$("#jobidss").val(jobids);
	$("#bidjob").val(biduser);
	$("#fromid").val(biduser);
	$("#toid").val(tojob);
	$("#usrmailid").val(jobemail);
	$("#tomail").val(jobemail);
	$("#usercr").val(usercredits);
	$("#biddermailid").val(bidemail);
	
   // alert(logeduserid);
});
$('.tomsg').click(function() {
    var id = $(this).attr('id');
	var logeduserid = $("#userid").val();
	//alert(logeduserid);biduserid
	var biduser=$("#biduserjob").val();
	//alert(biduser);
	var jobids=$("#jobid").val();
	var jobemail=$("#emails").val();
	var usercredits=$("#usercredit").val();
	//alert(usercredits);
	var tojob=$("#toidjob").val();
	var bidemail=$("#bidderemail").val();
	//alert(tojob);
	$("#bidid").val(jobids);
	$("#ujobidss").val(jobids);
	$("#bidjob").val(biduser);
	$("#fromuid").val(biduser);
	$("#touid").val(tojob);
	$("#usrmailid").val(jobemail);
	$("#toemail").val(jobemail);
	$("#usercr").val(usercredits);
	$("#bidderumailid").val(bidemail);
	
   // alert(logeduserid);
});
$('.amtedit').click(function() {
var editedamt = $("#awardamt").val();
$(".amttoaward").val(editedamt);
var bidsid=$("#bidtblid").val();
$("#bidsid").val(bidsid);
});
});
</script>

<?php $this->load->view('ajax_form_pages'); ?>
<?php

if(isset($bids) and $bids->num_rows()>0)
						 {
						 //print_r($buyrequirement);
						
						  foreach($bids->result() as $bid)
						    {
							
							$bidid=$bid->job_id;
							//echo $bidid;
							}
							}
		//Get Job Info
		if(isset($this->loggedInUser->id))
 	    {
		 	$bid = $bids->row();
			
			if(is_object($bid))

		  $action = site_url('job/editBid'.$bidid);

		else

		   $action = site_url('job/createBid/');
		}
		$job = $jobs->row();

		
//print_r($job);
?>








<div class="clsMinContent clearfix">
<?php //$this->load->view('sidebar'); ?>
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
<div id="Innermain">
      <!--POST JOB-->
      <div class="clsInnerpageCommon">        
                            <div class="clsInnerCommon">
	  <?php

								//Show Flash error Message

								if($msg = $this->session->flashdata('flash_message'))

								{

								  echo $msg;

								}

							

								?>
	
	
					<div class="clsViewPost">
						<div class="clsLeftPost">
							<div class="">
								<div class="clsHeadingLeft clsFloatLeft">
									<h2 class="job_title"><?php echo  ucfirst($job->looking_for); ?></h2>
									<div class="header_txt_h4">
									Categories : <?php echo $job->category;?>, Type : <?php $tpe=$job->requirements; if($tpe==1){ echo "Products";} if($tpe==2){ echo "Services";} if($tpe==3){ echo "Product & Services";}?>
									</div>
								</div>
								<div style="clear:both;"></div>
							</div>
							<div class="underline_title">&nbsp;</div>
							<div style="clear:both;"></div>
							<div class="jobDesc-bd">
								<div class="header_tsubxt_h4">Description</div>
								<div class="underline_subtitle">&nbsp;</div>	
								<div class="proj_descr">
									<span id="less_desc"><?php echo $desc = (strlen($job->description)>200)? substr($job->description,0, 200)."...<a class='view_more_less' onclick='javascript:$(\"#more_desc\").show();$(\"#less_desc\").hide();'>more</a>":$job->description ;?></span>
									<span id="more_desc" style="display:none;" ><?php echo $job->description."...<a class='view_more_less' onclick='javascript:$(\"#less_desc\").show();$(\"#more_desc\").hide();'>less<a>";?></span>
								</div>
								
								<div style="clear:both;"></div>
								
								<div class="header_tsubxt_h3 ">Posted By</div>
								<div class="underline_subtitle">&nbsp;</div>
								
								<div class="post_by">
									<div class="clsLikePost paddless clearfix">
									<!-- <img src="<?php echo image_url();?>/map-sampleimg.jpg" />-->
									<?php
									$userid=$job->creator_id;
									//echo "SELECT * FROM users WHERE id = $userid";
									$q = "SELECT * FROM users WHERE id = $userid";
									$query = $this->db->query($q,array($job->creator_id));
									$ncomments = $query->result_array();
									//print_r($query);exit;
									if(isset($ncomments[0]['logo']))
									{
									$blog_e->n_comments = $ncomments[0]['logo'];
									}
									if(isset($ncomments[0]['city']))
									{

									$blog_e->n_commentss = $ncomments[0]['city'];

									}
									if(isset($ncomments[0]['state']))
									{
									$blog_e->state = $ncomments[0]['state'];
									}
									if(isset($ncomments[0]['user_verify']))
									{
									$blog->verifyuser=$ncomments[0]['user_verify'];
									}
									if(isset($ncomments[0]['email']))
									{
									$blog->email=$ncomments[0]['email'];
									}
									//echo $blog->email;
									//$blog_e->n_bids=
									//print_r($ncomments);exit;
									//echo $blog_e->n_comments;
									if(isset($ncomments[0]['logo']))
									{
									?>

									<img  style="border: 1px solid #E6E6E6;" src="<?php echo base_url();?>files/logos/<?php echo $blog_e->n_comments;?>" width="50" height="50" />
									<?php 
									}
									if(!isset($ncomments[0]['logo']))

									echo '<img  style="border: 1px solid #E6E6E6;" src="'.image_url('no-image.jpg').'" width="50" height="50" />';

									?>
									<!--   <div class="clsArrow"></div> -->


									<div class="clsLikePostDet"> 

									<p class="clsAuthornm width_rating">				 
									<span class="rating_absolute"> 
								
									<?php 
									// $usrid=$userdetails->userid;
									$qr= "SELECT SUM(rating) AS rating,COUNT(id) as reviews FROM reviews WHERE userid = $userid";
									//echo "SELECT COUNT(job_id) AS count FROM bids WHERE job_id = $jobidd";
									$querys = $this->db->query($qr,array($job->creator_id));
									$ncommentss = $querys->result_array();
									//print_r($query);exit;
									$blog_e->n_comments = $ncommentss[0]['rating'];
									$blog_e->n_commentse = $ncommentss[0]['reviews'];
									$count=$blog_e->n_commentse;
									if($count>1) {
									//echo "count";
									$Totalbid=$blog_e->n_comments;
									$ratings=$Totalbid/5;
									// echo $ratings;
									}
									else{
									$ratings=$blog_e->n_comments;
									}
									?>
									
									<?php /*echo  $ratings; if(($ratings<0) && ($ratings==0)){ echo "0yellow.png"; } elseif(($ratings>0) && ($ratings<1)) { echo "0_5yellow.png";} elseif(($ratings>1) && ($ratings<2)) {  echo "1_5yellow.png"; } elseif(($ratings>2) && ($ratings<3)) {  echo "2_5yellow.png"; } elseif(($ratings>3) && ($ratings<4)) {  echo "3_5yellow.png"; } elseif(($ratings>4) && ($ratings<5)) {  echo "4_5yellow.png"; } elseif($ratings>5) {  echo "5yellow.png"; } elseif(($ratings==1)){  echo  "1yellow.png"; } elseif(($ratings==2)){  echo  "2yellow.png"; } elseif(($ratings==3)){  echo  "3yellow.png"; } elseif(($ratings==4)){  echo  "4yellow.png"; } elseif(($ratings==5)){  echo  "5yellow.png"; }*/ ?>
									<!-- <img alt="" src="<?php echo image_url();?>/<?php /*if($ratings<1.9)
									{echo "0yellow.png";} else { echo  $ratings."yellow.png";}*/ if(($ratings<0) && ($ratings==0)){ echo "0yellow.png"; } elseif(($ratings>0) && ($ratings<1)) { echo "0_5yellow.png";} elseif(($ratings>1) && ($ratings<2)) {  echo "1_5yellow.png"; } elseif(($ratings>2) && ($ratings<3)) {  echo "2_5yellow.png"; } elseif(($ratings>3) && ($ratings<4)) {  echo "3_5yellow.png"; } elseif(($ratings>4) && ($ratings<5)) {  echo "4_5yellow.png"; } elseif($ratings>5) {  echo "5yellow.png"; } elseif(($ratings==1)){  echo  "1yellow.png"; } elseif(($ratings==2)){  echo  "2yellow.png"; } elseif(($ratings==3)){  echo  "3yellow.png"; } elseif(($ratings==4)){  echo  "4yellow.png"; } elseif(($ratings==5)){  echo  "5yellow.png"; }?>">-->

									<?php  // echo $ratings."fghdfgh";if(($ratings<0) && ($ratings==0)  && ($ratings==NULL)){ echo "0yellow.png"; } ?>
									<?php if($count>100) {
									$Totalbid=$blog_e->n_comments;
									$ratings=$blog_e->n_comments/$blog_e->n_commentse;
									// echo $ratings;
									?>
									<img src="<?php echo image_url();?>/<?php if(($ratings>1) && ($ratings<2)) {  echo "1_5yellow.png"; } elseif(($ratings>2) && ($ratings<3)) {  echo "2_5yellow.png"; } elseif(($ratings>3) && ($ratings<4)) {  echo "3_5yellow.png"; } elseif(($ratings>4) && ($ratings<5)) {  echo "4_5yellow.png"; } elseif($ratings>5) {  echo "5yellow.png"; } elseif(($ratings==1)){  echo  "1yellow.png"; } elseif(($ratings==2)){  echo  "2yellow.png"; } elseif(($ratings==3)){  echo  "3yellow.png"; } elseif(($ratings==4)){  echo  "4yellow.png"; } elseif(($ratings==5)){  echo  "5yellow.png"; } ?>" />
									<?php 
									}
									else{
									$ratings=$ncommentss[0]['rating'];
									$blog_e->n_comments =$ncommentss[0]['rating'];
									?>

									<img src="<?php echo image_url();?>/<?php if(($blog_e->n_comments<0) || ($blog_e->n_comments==0)  || ($ratings==NULL)){ echo "0yellow.png"; } elseif(($ratings>0) || ($ratings<1)) { echo "0_5yellow.png";}  ?>" />
									<?php 	
									}
									?>


									<!--<span><?php echo $ratings;?>/5</span>--></span><a href="<?php echo site_url('users/view/'.$job->creator_id);?>"><?php echo $job->user_name;?></a></p>

									<p>Location :
									<?php  echo $result_sta = (isset($blog_e->state)) ? $blog_e->state :"N/A";?>,
									<?php  echo $result_com = (isset($blog_e->n_commentss)) ? $blog_e->n_commentss :"N/A";?>
									</p> 

									<p class="clsNoBorder">Posted  by <span><?php echo date('l,M d',$job->created)?></span> </p>
									<p><span class="review">
									<a href="<?php echo site_url('users/view/'.$job->creator_id);?>#tabs-3">
									<?php echo $blog_e->n_commentse;?> Reviews</a>
									</span>
									</p>


									</div>
									</div>
									
									<div class="verify_class">
									
									<?php if($blog->verifyuser==1)
									{?>
									
									<p class="tooltip Verify"><a href="#" class="tooltip">Verified <span> <strong>This User Is Verified By Admin</strong></a><span> 
									</p>
									<?php } else{ ?>
									<p class="NotVerify"><a href="#" class="tooltip">Not Verified <span>  
									<strong>This User Is Not Verified By Admin</strong></a><span></p> 
									<?php } ?>
									</div>
								</div>	
								<div style="clear:both;"></div>
							</div>
							<div class="job_details">
								<div class="clsBidBut">
									<ul class="clearfix">

									<?php 
									if($loggedInUser){ 
										$logusid=$loggedInUser->id;
										$qrrey= "SELECT COUNT(user_id) as count FROM bids WHERE user_id=$logusid";
										//echo "SELECT COUNT(job_id) AS count FROM bids WHERE job_id = $jobidd";
										$qwr = $this->db->query($qrrey,array($loggedInUser->id));
										$placebid = $qwr->result_array();
										//print_r($query);exit;
										$record->bidrec = $placebid[0]['count'];
										if($loggedInUser->id!=$job->creator_id &&  $job->status == 'open' && $record->bidrec!=100){
											?><p><a href="#" class="popup-bid place"><input type="button" class="clsBut" value="Bid" /></a><?php 
										} 
									}?>
									
									<?php 
									if(!$loggedInUser){ 

										?><p style="	text-align:center;clear:both;padding:10px 0;"><a href="#" class="nopopup-bid place" ><input type="button" class="clsBut" value="Bid" /></a>
									<?php }
									
									if($loggedInUser){ 
										if($loggedInUser->id!=$job->creator_id &&  $job->status == 'open'){?>
											<a href="#<?php //echo site_url('messages/viewMessage');?>" style="cursor:pointer" class="msgcls">
											<input type="button" class="clsBut" value="Message" /></a></p>
									<?php }
									} ?>
									</ul> 
								</div>
								
								<div class="clsGigStatus ">

								<div class="clsStatus pstatus">
								<?php if($job->awarded_user == '0' || $job->status == 'open'){ ?>
								<img src="<?php echo image_url('open_bidding.png');?>" />
								<?php } if($job->status == 'wip'){?>
								<img src="<?php echo image_url('sealed.png');?>" />
								<?php } if($job->status == 'awarded'){?>
								<img src="<?php echo image_url('bid_award.png');?>" />
								<?php } if($job->status == 'completed'){?>
								<img src="<?php echo image_url('bid_complete.png');?>" />
								<?php }?>

								<?php //echo $job->city;?>
								</div>

								<h3>Job Status</h3> 

								<!--<div class="clsBudget">
								<?php //print_r($job);exit;?>
								<?php  //print_r($jobMsg->result());
								if(isset($jobMsg) && $jobMsg->num_rows()>0){
								foreach($jobMsg->result() as $msg){
								$bidamt=$msg->bid_amount;
								// print_r($msg);
								// echo $bidamt;
								}
								}
								//print_r($msg);exit;
								?>
								<p>Budget : <?php if($job->budget!= '') echo "<span>".'Rs'.$job->budget."</span>"; else echo 'N/A'; ?> </p>
								</div>-->
								<p> Budget : <span class="rupee"><?php if($job->budget!= '') echo "<span>".'Rs'.$job->budget."</span>"; else echo 'N/A'; ?></span></p>
								<?php 
								$jobsids= $job->buy_id;
								//echo "SELECT COUNT(id) as count, SUM(bid_amount) as sum  FROM bids WHERE job_id=$jobsids";
								$qry= "SELECT COUNT(id) as count, SUM(bid_amount) as sum  FROM bids WHERE job_id=$jobsids";
								//echo "SELECT COUNT(job_id) AS count FROM bids WHERE job_id = $jobidd";
								$queryys = $this->db->query($qry,array($job->buy_id));
								$nbidss = $queryys->result_array();
								//print_r($query);exit;
								$bid_rec->number = $nbidss[0]['count'];

								$bid_rec->amaounts=$nbidss[0]['sum'];
								if($bid_rec->number>1)
								{
								$avgbid=$bid_rec->amaounts/$bid_rec->number;
								}
								else{
								$avgbid=$bid_rec->amaounts;
								}



								?>
								<p>Avg Bid : <span class="rupee">  <?php $avg=$avgbid; if($avg!='') echo $avg; else echo "No Bids"?> </span></p>
								<p>Bid End Date : <?php  echo $strdt=date("d-m-Y",strtotime($job->end_date));?></p>
								<p>Project ID : <?php echo $job->buy_id;?></p>
								<?php if($loggedInUser){ $usid=$loggedInUser->id; 
								$qs= "SELECT * FROM users WHERE id = $usid";
								$queryys = $this->db->query($qs,array($loggedInUser->id));
								$bidcredits = $queryys->result_array();
								//  print_r($bidcredits);exit; 
								$blog_e->n_credits = $bidcredits[0]['credit'];
								$blog_e->email=$bidcredits[0]['email'];
								$blog_e->username=$bidcredits[0]['user_name'];
								?>
								<form name="" method="post">
								<input type="hidden" name="creatorid" value="<?php echo $job->creator_id;?>" id="toidjob" />
								<input type="hidden" name="jobid" value="<?php echo $job->buy_id;?>" id="jobid"/>
								<input type="hidden" name="biduserid" value="<?php echo $job->awarded_user;?>" id="biduserjob" />
								<input type="hidden" name="jobname" value="<?php echo $job->looking_for;?>" id="jobname" />
								<input type="hidden" name="userid" value="<?php echo $loggedInUser->id;?>" id="biduserid"/>
								<input type="hidden" name="jobuseremail"  value="<?php  echo $blog->email;?>" id="emails"/>
								<input type="hidden" name="credit" value="<?php echo $blog_e->n_credits;?>" id="usercredit" />
								<input type="hidden" name="bideremail" value="<?php echo $blog_e->email;?>" id="bidderemail" />
								<input type="hidden" name="bidername" value="<?php echo $blog_e->username;?>" id="biddername" />

								<input type="hidden" name="jobbudget" value="<?php echo $job->budget;?>" id="jobamount" />

											</form>
											<?php } ?>
								</div>
							</div>
							<div style="clear:both;"></div>
							
						</div>
						
						
						
						</div>
					</div>
					
					<div class="underline_subtitle1">&nbsp;</div>
						  
 <?php if($loggedInUser){?>
<?php //print_r($loggedInUser);?>
                       <div class="clsPostIcons">

					   <div id="selCommentpost">
					    <?php 
					  
					   if(isset($bids)){
					  
					   foreach($bids->result()as $bids){
					  
					  //print_r($bids);exit;
					   ?>
					   <div class="clscmtBlock" >
					   <div class="clspostImg">
					   <?php   if($bids->logo!= '')
		{
?>
		
		<img src="<?php echo base_url();?>files/logos/<?php echo $bids->logo;?>" height="100" width="100" />
<?php 
		}
		if($bids->logo== '')

		echo '<img src="'.image_url('no-image.jpg').'" width="50" height="50" />';

		?>
			
					   </div>
					 <!-- <div class="clsArrow"></div> --> 
					   <div class="clsCmntDesc">
				
					   <div class="BidDetails">
					   <ul class="clearfix">
					   <li class="clsBidRate">
					   				   <div class="clsLikePostDet"> 
						   
		<p class="clsAuthornm"><span> <!--<img src="<?php echo image_url();?>map_star.jpg" />--><!--<img alt="10.00/10" src="<?php //echo image_url('rating_'.$job->user_rating.'.png');?><?php echo image_url('5-satr.png');?>"/>-->
						  <?php 
					  $usrid=$bids->user_id;
					  $qrs= "SELECT SUM(rating) AS rating,COUNT(id) as reviews FROM reviews WHERE userid =$usrid";
							//echo "SELECT COUNT(job_id) AS count FROM bids WHERE job_id = $jobidd";
 $queryss = $this->db->query($qrs,array($bids->user_id));
       $ncommentsss = $queryss->result_array();
	   //print_r($query);exit;
	$blog_e->n_commentts = $ncommentsss[0]['rating'];
	$blog_e->n_commentse = $ncommentsss[0]['reviews'];
	$count=$blog_e->n_commentse;
	if($count>1) {
	 $Totalbid=$blog_e->n_commentts;
	 $ratings=$Totalbid/5;
	 }
	 else{
	  $ratings=$blog_e->n_commentts;
	  }
	 
	 ?>
		
					<?php //print_r($bids); exit;?>
						   <!--<img alt="" src="<?php echo image_url();?>/<?php /*if($ratings<1.9)
					  {echo "0yellow.png";} else { echo  $ratings."yellow.png";}*/
					   if(($ratings<0) && ($ratings==0)){ echo "0yellow.png"; } elseif(($ratings>0) && ($ratings<1)) { echo "0_5yellow.png";} elseif(($ratings>1) && ($ratings<2)) {  echo "1_5yellow.png"; } elseif(($ratings>2) && ($ratings<3)) {  echo "2_5yellow.png"; } elseif(($ratings>3) && ($ratings<4)) {  echo "3_5yellow.png"; } elseif(($ratings>4) && ($ratings<5)) {  echo "4_5yellow.png"; } elseif($ratings>5) {  echo "5yellow.png"; } elseif(($ratings==1)){  echo  "1yellow.png"; } elseif(($ratings==2)){  echo  "2yellow.png"; } elseif(($ratings==3)){  echo  "3yellow.png"; } elseif(($ratings==4)){  echo  "4yellow.png"; } elseif(($ratings==5)){  echo  "5yellow.png"; }
					  ?>">-->
					  
					    <?php  // echo $ratings."fghdfgh";if(($ratings<0) && ($ratings==0)  && ($ratings==NULL)){ echo "0yellow.png"; } ?>
	<?php if($count>1) {
	 $Totalbid=$blog_e->n_commentts;
	 $ratings=$blog_e->n_commentts/$blog_e->n_commentse;
	// echo $ratings;
	 ?>
	 <img src="<?php echo image_url();?>/<?php if(($ratings>1) || ($ratings<2)) {  echo "1_5yellow.png"; } elseif(($ratings>2) ||($ratings<3)) {  echo "2_5yellow.png"; } elseif(($ratings>3) || ($ratings<4)) {  echo "3_5yellow.png"; } elseif(($ratings>4) || ($ratings<5)) {  echo "4_5yellow.png"; } elseif($ratings>5) {  echo "5yellow.png"; } elseif(($ratings==1)){  echo  "1yellow.png"; } elseif(($ratings==2)){  echo  "2yellow.png"; } elseif(($ratings==3)){  echo  "3yellow.png"; } elseif(($ratings==4)){  echo  "4yellow.png"; } elseif(($ratings==5)){  echo  "5yellow.png"; } ?>" />
	 <?php 
	 }
	 else{
	 $ratings=$ncommentsss[0]['rating'];
	$blog_e->n_comments =$ncommentsss[0]['rating'];
	?>
	
	<img src="<?php echo image_url();?>/<?php if(($blog_e->n_comments<0) || ($blog_e->n_comments==0)  || ($ratings==NULL)){ echo "0yellow.png"; } elseif(($ratings>0) || ($ratings<1)) { echo "0_5yellow.png";}  ?>" />
<?php 	
	 }
	 ?>
					  
					  
					  
					  <!--<span><?php echo $ratings;?>/5</span>--></span><a href="<?php echo site_url('users/view/'.$bids->user_id);?>"> <?php echo $bids->user_name;?></a></p><?php //print_r($job);exit;?>
					<p>Location : 
						<?php  echo $result_sta = (isset($bids->state)) ? $bids->state :"N/A";?>,
						<?php  echo $result_com = (isset($bids->n_commentss)) ? $bids->n_commentss :"N/A";?>

					</p> 


					<p class="clsNoBorder">posted on:<span><?php $bidstrdate=$bids->bid_time; echo $strdt=date("d-m-Y",strtotime($bidstrdate));?></span>  </p>
					<p><span class="review">
						<a href="<?php echo site_url('users/view/'.$bids->user_id);?>"><?php echo $blog_e->n_commentse;?> Reviews</a></span>
					</p>

					  <!--<p> <img alt="10.00/10" src="<?php echo image_url('rating_'.$bids->user_rating.'.png');?>"/></p>-->
					   </div>
					   </li>
					   <?php $verify=$bids->user_verify;
					  if($verify==1)
{?>
                       <li style="width:149px; margin:0 auto;padding:20px 0;">
						<div style=" padding: 8px 28px;"><p class="Verify"><a href="#" class="tooltip">Verified<span>  <strong>This User is verified by Admin</strong></span></a></p></div></li><?php } else{
					   ?>
					    <li style="width:150px; margin:0 auto;padding:20px 0;"><div style=" padding: 10px;"><p class="NotVerify"><a href="#" class="tooltip">Not Verified<span>  <strong>This User is not verified by Admin</strong></span></a></p></div></li>
						<?php } ?>
					 <!--  <li class="clsBidAmnt">
					   <div class="">
					   <p>Bid:</p>
					   
					   </div>
					   </li>
					 <li class="clsBidDelivery">
					   <div class="">
					     <p>Delivery Time:</p>
					   <p><?php echo $bids->bid_days.' day,'.$bids->bid_hours.' hour';?></p>
					   </div>
					   </li>-->
					   <li class="clsNoBorder">
                       
					   
						<!-- BID BOX -->
						<div class="BidBox">
						<?php  
							$usrid=$bids->user_id;
							$jbid=$bids->job_id;
							$awrdeuser= "SELECT COUNT(id) AS jobcount FROM buy_requirement WHERE awarded_user=$usrid and id=$jbid";
							//echo $awrdeuser;
							$userrec= $this->db->query($awrdeuser);
							$userrec = $userrec->result_array();
						
							$blog_e->awarded = $userrec[0]['jobcount'];
						?>
						<?php if($blog_e->awarded!=0) {?>
							<span style="float:right"> <img src="<?php echo image_url();?>award_icon.png" /></span>
						<?php }?>
						
						<div class="bidDet">
							<h3>Bid Status</h3>
							<p><span  class="redrupee"><?php echo $bids->bid_amount;?></span></p>
							<p>Bid Date :<span>&nbsp;<?php $bidstrdate=$bids->bid_days; echo $strdt=date("d-m-Y",strtotime($bidstrdate));?></span></p>
						</div>
						</span>
						</li>

						</ul>
						<div class="clsCmtAward">
						<?php
						$bidusers=$bids->user_id;
						if($bidusers!=$loggedInUser->id && $loggedInUser->id==$job->creator_id ){
						?>

						<div class="">
							<p>
							<a href="javascript:return false;"  class="tomsg"><input type="button" class="buttonBlackShad" value="Message" /></a>
							<?php   if($job->status == 'open'){?>
							<form method="post" action="<?php echo site_url('job/awardBid');?>">
								<input type="hidden" name="bidid" value="<?php echo $bids->bidid;?>" id=""/>
								<input type="hidden" name="jobid" value="<?php echo $job->buy_id;?>" id="bidtblid"/>
								<input type="hidden" name="bidamnt" value="<?php echo $bids->bid_amount;?>" id="awardamt" />

								<input type="submit" name="pickBid" class="buttonBlackShad" value="Award"  onclick="return confirm('Are you sure you want to award?')">
							</form>
							<a href="javascript:return false;" class="amtedit">
								<input type="button" class="buttonBlackShad" value="EditAmount" />
							</a>
							<?php } ?>

							</p>
						</div>
						<?php } ?>
						</div>
						</div>
					   
					   
					   
					   
					   
					   
					   
					   
					   
					   
					   
					   
					   </div>
				    <div class="Cmnts"><p><label style="color:#000;"><b>Description </b></label>:&nbsp;&nbsp;<span style="float:right;width:825px;display:block;text-align:left;"> <?php echo $bids->bid_desc;?></span></div>
					   </div>
					   <?php }}else{?>
						<div class="clsNocmtBlock">
					  <!-- <div class="clspostImg">
					     <img src="<?php echo image_url();?>/map-sampleimg.jpg" />
						<?php echo '<img src="'.image_url('no-image.jpg').'" width="50" height="50" />'; ?>
					   </div>-->
					 <!-- <div class="clsArrow"></div> -->
	    <!--<div class="clsCmntDesc">-->

 					   <div class="BidDetails" style="min-height:30px;border-bottom:none!important;">
					<div class="clsNobidmsg"><p>  No Bids Placed Yet</p></div>
					  <!-- </div>-->
 					   
 					   </div>
 					   </div>
 					   <?php } ?>
					   </div>
					   
                       
					   <?php }?>
					   </div>
   					    </div>
						</div>
                       </div>
					   
                       </div>
                     </div>  
                     
           </div></div></div></div></div></div></div></div> </div></div>          
                     </div>
			
			</div>	
			</div>	

 <!--END OF POST JOB-->


	 
<?php //$this->load->view('footer'); ?>
<?php $this->load->view('home_footer'); ?>
   




</body>
</html>