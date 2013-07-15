<?php $this->load->view('header'); ?>
<div class="clsMinContent clearfix">
<?php $this->load->view('sidebar'); ?>
<!--MAIN-->
<?php
		//Get Job Info
     	$job = $jobs->row();
?>

<style>
.clsIcons{
margin-right:20px;
}
table.clsSitelinks {
position:relative;
z-index:9;
}
</style>

<div id="main">
      <!--POST JOB-->
      <div class="clsInnerpageCommon">

							<?php  if($job->flag==0) {?>
							
                              <h2><?php echo $this->lang->line('Job');?>: <?php echo $job->job_name; ?></h2><? }else {?>
							  <h2><?php echo $this->lang->line('Job Listing');?>: <?php echo $job->job_name; ?></h2>
							  <?php }?>
							  
							<div class="clsHeads clearfix">
<div class="clsLeft_head">
<div class="clsRight_head">
<div class="clsCen_head">
                            <div class="clsHeadingLeft clsFloatLeft">
                         <?php  if($job->flag==0) {?>
                              <h3><span class="clsViewPro"><?php echo 'View Job'; ?></span></h3><?php }else {?>
							   <h3><span class="clsViewPro"><?php echo 'View JobList'; ?></span></h3><?php }?>
              </div>
                             <div class="clsHeadingRight clsFloatRight">
							
							<?php
							
							
			
		 if(isset($loggedInUser->role_id))
		 {
			if($loggedInUser->role_id =='1' && ($job->job_status == 0 || $job->job_status == 1) && $loggedInUser->id==$job->creator_id && $job->employee_id==0)
			{ 
				
		          echo '<a class="clsIcons clsFloatLeft" href="'.site_url('job/cancelJob/'.$job->id).'"><img alt="Cancel" title="Cancel" src="'.image_url('cancel.png').'"/></a>'; 
		          echo '<a class="clsIcons clsFloatLeft" href="'.site_url('job/extendBid/'.$job->id).'"><img alt="Extend" title="Extend" src="'.image_url('extend.png').'"/></a>'; 
	        }
         }	  				
							
							 if(isset($loggedInUser->role_id))

							   {

								if($loggedInUser->role_id == 1 and $job->flag==0) 

								   {	 ?>

                            <span class="clsPostProject"> <a class="buttonBlack" href="<?php if (!isset($loggedInUser->role_id)) echo site_url('users/login'); else  echo site_url('job/postJob/'.$job->id); ?>"><span><?php echo $this->lang->line('Post Similar Job'); ?></span></a></span>
							   <?php } elseif($loggedInUser->role_id == 1) {?>
							   <span class="clsPostProject"> <a class="buttonBlack" href="<?php if (!isset($loggedInUser->role_id)) echo site_url('users/login'); else  echo site_url('joblist/postjoblist/'.$job->id); ?>"><span><?php echo $this->lang->line('Post Similar Job'); ?></span></a></span>
							   
							   
							   <?php }?>
							   <span class="clsManage">

                                <?php

  							   if(isset($loggedInUser))

							   {

								if ($loggedInUser->role_id == 1 && $job->flag==0) 

								   { ?>

                                <a class="buttonBlack" href="<?php echo site_url('job/manageJob/'.$job->id); ?>"><span><?php echo $this->lang->line('Manage');?></span></a>

                                <?php } 
								elseif($loggedInUser->role_id == 1)
								{?>
								
								 <a class="buttonBlack" href="<?php echo site_url('joblist/manageJoblist/'.$job->id); ?>"><span><?php echo $this->lang->line('Manage');?></span></a>
								
								<?php }

							  }

							if (!isset($loggedInUser->role_id))

							   {	 ?>

                                <a href="<?php echo site_url('users/login'); ?>"><?php echo $this->lang->line('Manage');?></a>

                                <?php } ?>
                                </span>

                             
							  
							  
							  
							    <?php

								   } 
							   
							   ?>
				<span class="clsBookMark"><a class="buttonBlack" href="<?php if (!isset($loggedInUser->role_id)) echo site_url('users/login'); else echo site_url('bookmark/'.$job->id); ?>"><span><?php echo $this->lang->line('Book Mark'); ?></span></a></span>
				
							
				         <?php
						 

							if(isset($loggedInUser->role_id))

							   {

								if($loggedInUser->role_id =='2') 

								   {	
								    ?>

                              <span style="float:right;width:90px;position:relative;top:5px;right:0;left:0px;line-height:24px;">  <a href="<?php  echo site_url('memberList/addFavouriteUsers/'.$job->userid); ?>"><img src="<?php echo image_url('star_g.png'); ?>" width="24" height="24" title="Add To Favourite"  alt="Add To Favourite" /> </a> <a href="<?php echo site_url('memberList/addBlockedUsers/'.$job->userid); ?>"><img src="<?php echo image_url('block_g.png'); ?>" width="24" height="24" alt="BlackList User" title="BlackList User"/> </a> <a href="<?php echo site_url('job/jobReport/'.$job->id); ?>"><img src="<?php echo image_url('com_g.png'); ?>" height="24" width="24" alt="Report Project Violation" title="Report Job Violation"/> </a></span>

                                <?php 

								   } 

							   }

							   else

							   { ?>

                               <span style="float:right;width:90px;position:relative;top:5px;right:0;left:0px;line-height:24px;">   <a href="<?php  echo site_url('users/login'); ?>"><img src="<?php echo image_url('star_g.png'); ?>" width="24" height="24"  alt="Add To Favourite"/> </a> <a href="<?php echo site_url('users/login'); ?>"><img src="<?php echo image_url('block_g.png'); ?>" width="24" height="24" alt="BlackList User"/> </a> <a href="<?php echo site_url('users/login'); ?>"><img src="<?php echo image_url('com_g.png'); ?>" height="24" width="24" alt="Report Job Violation"/> </a></span>

                                <?php } 

							   ?>
                            </div>
							
			</div></div></div>	 
							
							
                          </div>
                          <div class="mapimg"><!--<p><img src="http://demo.maventricks.com/bidonn_1.1/application/css/images/map-icon.png" /></p>-->
<script src="http://maps.google.com/maps?file=api&v=2&key=AIzaSyDKYyWeq_uHVSE-n7aNXeQaEc2n31WX2pE" type="text/javascript"></script>
<script type="text/javascript">
window.onload= homemapload;

    function homemapload() {
    var address="<?php echo $job->city;?>"; 

  	if (GBrowserIsCompatible()) { 
		var map = new GMap(document.getElementById("map_canvas"));
		map.addControl(new GLargeMapControl());
		map.addControl(new GMapTypeControl());
		//map.setCenter(new GLatLng(0,0),14);	
		
		// Create our "tiny" marker icon
		//var blueIcon = new GIcon(G_DEFAULT_ICON);
		//blueIcon.image = "<?php echo image_url('red-pushpin.png');?>";
						
		// Set up our GMarkerOptions object
		//markerOptions = { icon:blueIcon };
		
		var geo = new GClientGeocoder();
 		
		geo.getLatLng(address, function (point) { 
 			if (point != null) {
				map.setCenter(point,7);
				marker = new GMarker(address);
				//map.addOverlay(new GMarker(point,markerOptions));
				map.addOverlay(new GMarker(point));
			} else {
				alert('Could not find address');
			}
		});
	} else {
		alert("Sorry, the Google Maps API is not compatible with this browser");
	}
}
//window.onload=initialize();
//window.onunload=GUnload();
     //]]>
</script> 
<div id="map_canvas" style="width: 100%; height: 183px;"></div>
						<!-- <img src="<?php echo image_url();?>post-map.jpg" />-->
						 <p class="clsPointer"><?php echo ucfirst($job->city);?>,<?php echo ucfirst($job->state);?></p>
						  </div>
						  	<?php
								//Show Flash error Message
								if($msg = $this->session->flashdata('flash_message'))
								{
								  echo $msg;
								}
							
								?>
                          <table cellspacing="1" cellpadding="2" width="96%" class="clsSitelinks">
						  <?php if($job->flag==0)	
						         {
						           ?>
                            <tbody>
                              <tr>
                                <td width="15%" class="dt"><?php echo $this->lang->line('Job Details');?></td>
                                <td width="200" class="dt">&nbsp;</td>
                              </tr>
                              <tr>
                                <td class="dt1 dt0"><?php echo $this->lang->line('Job');?> <?php echo $this->lang->line('ID');?>:</td>
                                <td class="dt1"><?php echo $job->id; ?></td>
                              </tr>
                              <tr class="odd">
                                <td class="dt2 dt0"><?php echo 'Job Name';?>:</td>
								 <td class="dt2"><?php echo $job->job_name; ?>
								<?php if($job->is_urgent ==1 or $job->is_feature == 1 or $job->is_private ==1) { ?>
                                <?php if($job->is_urgent == 1) { ?>
                                    &nbsp;<img src="<?php echo image_url('urgent.png');?>" width="24" height="24" title="Urgent job" alt="<?php echo $this->lang->line('Urgent Job'); ?>" />
                                    <?php } 
								   if($job->is_feature == 1) { ?>
                                    &nbsp;&nbsp;<img src="<?php echo image_url('featured.png');?>" width="24" height="24" title="Featured job" alt="<?php echo $this->lang->line('Featured Job'); ?>" />
                                    <? }
									if($job->is_private == 1) {?>
									
									 &nbsp;&nbsp;<img src="<?php echo image_url('private.png');?>" width="24" height="24" title="private job" alt="<?php echo $this->lang->line('Private Job'); ?>" /><?php }
									 }
									 ?> </td>
					
                              </tr>
						
							   
                              <tr>
                              <td class="dt1 dt0"><?php echo $this->lang->line('Status');?>:</td>
								<?php $status=getCurrentStatus($job->job_status,$job->employee_id,$job->id)?>
							   <td class="dt1"><?php echo '<b style="color:green;">' .$status['status'].'</b>'; if(isset($status['message']))echo $status['message']; ?> </td>

                              </tr>
                              <tr class="odd">
                                <td class="dt2 dt0"><?php echo $this->lang->line('Budget');?>:</td>
                                <td class="dt2"><?php if($job->budget_min != '0') echo $currency.' '.$job->budget_min; else echo 'N/A'; ?> - <?php if($job->budget_max != '0') echo $currency.' '.$job->budget_max; else echo 'N/A'; ?></td>
                              </tr>
                              <tr>
                                <td class="dt1 dt0"><?php echo $this->lang->line('Created');?>:</td>
                                <td class="dt1"><?php echo get_datetime($job->created);?></td>
                              </tr>
                              <tr class="odd">
                                <td class="dt2 dt0"><?php echo $this->lang->line('Bidding Ends');?>:</td>
                                <td class="dt2"><?php echo get_datetime($job->enddate);?> (<?php echo '<b style="color:red;">'.days_left($job->enddate,$job->id).'</b>';?>)</td>
                              </tr>
                              <tr>
                                <td class="dt1 dt0"><?php echo $this->lang->line('Job Creator');?>:</td>



                                <td class="dt1"><a class="glow" href="<?php echo site_url('owner/viewProfile/'.$job->userid);?>"><?php echo $job->user_name; ?></a><?php $condition1=array('subscriptionuser.username'=>$job->userid);
								$certified1= $this->credential_model->getCertificateUser($condition1);
								if($certified1->num_rows()>0)
			                    {
							       foreach($certified1->result() as $certificate)
				                     {
									$user_id=$certificate->username;
									$id=$certificate->id;
									$condition=array('subscriptionuser.flag'=>1,'subscriptionuser.id'=>$id);
					                $userlists= $this->credential_model->getCertificateUser($condition);
									// get the validity
									$validdate=$userlists->row();
									$end_date=$validdate->valid; 
									$created_date=$validdate->created;
									$valid_date=date('d/m/Y',$created_date);
								    $next=$created_date+($end_date * 24 * 60 * 60);
									$next_day= date('d/m/Y', $next) ."\n";
							        if(time()<=$next)
								    {?>
								<img src="<?php echo image_url('certified.gif');?>"  title="<?php echo $this->lang->line('Certified Member') ?>" alt="<?php  echo $this->lang->line('Certified Member')?>"/>
								<?php } 
								  }
								   }?>


                        <?php if($job->num_reviews == 0)


										echo '(No Feedback Yet) ';
										else{ ?>
									 <img height="7" border="0" width="81" src="<?php echo image_url('rating_'.$job->user_rating.'.gif');?>" alt="rating" /> (<b><?php echo $job->num_reviews;?> </b> <a href="<?php echo site_url('owner/review/'.$job->creator_id);?>"><?php echo $this->lang->line('reviews');?></a> )
									<?php } ?></td>								  
		                        </tr>
                                <tr class="odd">
                                  <td class="dt2 dt0"><?php echo $this->lang->line('Description');?>:</td>
                                  <td class="dt2"><?php echo nl2br($job->description); ?></td>									  
															  
                                </tr>
								<tr>
                                  <td class="dt1 dt0"><?php echo $this->lang->line('Job Type');?>:</td>
                                  <td class="dt1"><?php echo getCategoryLinks($job->job_categories);?></td>								  
		                        </tr>
						
								<? if(isset($job->attachment_name)) { ?>
								<tr class="odd">
                                  <td class="dt1 dt0"><?php echo $this->lang->line('Job Attachment'); ?>:</td>
         <td class="dt1"><?php echo $job->attachment_name; ?><a href="<?php echo site_url('job/download/'.$job->attachment_url);?>" class="clsDown"><img src="<?php echo base_url();?>application/css/images/download1.png" /></a></td>								  								
		                        </tr><?php } ?>
							
                              </tbody><?php }
						  else
						  {?>
						   <tbody>
                              <tr>
                                <td width="15%" class="dt"><?php echo $this->lang->line('JobListing  Details');?></td>
                                <td width="200" class="dt">&nbsp;</td>
                              </tr>
                              <tr>
                                <td class="dt1 dt0"><?php echo $this->lang->line('Job');?> <?php echo $this->lang->line('ID');?>:</td>
                                <td class="dt1"><?php echo $job->id; ?></td>
                              </tr>
                              <tr class="odd">
                                <td class="dt2 dt0"><?php echo $this->lang->line('Job Name');?>:</td>
                                <td class="dt2"><?php echo $job->job_name; ?></td>
                              </tr>
                              <tr>
                              <td class="dt1 dt0"><?php echo $this->lang->line('Status');?>:</td>
								<?php $status=getCurrentStatus($job->job_status,$job->employee_id,$job->id)?>
							   <td class="dt1"><?php echo '<b style="color:green;">' .$status['status'].'</b>'; if(isset($status['message']))echo $status['message']; ?> </td>

                              </tr>
							   
                              <tr class="odd">
                                <td class="dt2 dt0"><?php echo $this->lang->line('Budget');?>:</td>
                                <td class="dt2"><?php echo $job->salary; ?></td>
                              </tr>
                              <tr>
                                <td class="dt1 dt0"><?php echo $this->lang->line('Created');?>:</td>
                                <td class="dt1"><?php echo get_datetime($job->created);?></td>
                              </tr>
							  <tr class="odd">
                                <td class="dt2 dt0"><?php echo $this->lang->line('Closed');?>:</td>
                                 <td class="dt2"><?php echo get_datetime($job->enddate);?> (<?php echo '<b style="color:red;">'.days_left($job->enddate,$job->id).'</b>';?>)</td>
                              </tr>
                              <tr>
                                <td class="dt1 dt0"><?php echo $this->lang->line('Job Creator');?>:</td>
                                <td class="dt1"><a class="glow" href="<?php echo site_url('owner/viewProfile/'.$job->userid);?>"><?php echo $job->user_name; ?></a><?php 
								
								$condition1=array('subscriptionuser.username'=>$job->userid);
								$certified1= $this->credential_model->getCertificateUser($condition1);
								if($certified1->num_rows()>0)
			                    {
							       foreach($certified1->result() as $certificate)
				                     {
									$user_id=$certificate->username;
									$id=$certificate->id;
									$condition=array('subscriptionuser.flag'=>1,'subscriptionuser.id'=>$id);
					                $userlists= $this->credential_model->getCertificateUser($condition);
									// get the validity
									$validdate=$userlists->row();
									$end_date=$validdate->valid; 
									$created_date=$validdate->created;
									$valid_date=date('d/m/Y',$created_date);
								    $next=$created_date+($end_date * 24 * 60 * 60);
									$next_day= date('d/m/Y', $next) ."\n";
							        if(time()<=$next)
								    {?>
								<img src="<?php echo image_url('certified.gif');?>"  title="<?php echo $this->lang->line('Certified Member') ?>" alt="<?php  echo $this->lang->line('Certified Member')?>"/>
								<?php } 
								  }
								   }?>


                                  <?php if($job->num_reviews == 0)

										echo '(No Feedback Yet) ';
										else{ ?>
									 <img height="7" border="0" width="81" src="<?php echo image_url('rating_'.$job->user_rating.'.gif');?>" alt="rating" /> (<b><?php echo $job->num_reviews;?> </b> <a href="<?php echo site_url('owner/review/'.$job->creator_id);?>"><?php echo $this->lang->line('reviews');?></a> )
									<?php  } ?></td>								  
		                        </tr>
                                <tr class="odd">
                                  <td class="dt2 dt0"><?php echo $this->lang->line('Description');?>:</td>
                                  <td class="dt2"><?php echo nl2br($job->description); ?></td>									  
															  
                                </tr>
								 <tr>
                                  <td class="dt1 dt0"><?php echo $this->lang->line('Contact');?>:</td>
                                  <td class="dt1"><?php 
							if(isset($this->loggedInUser->id))
							  { 
							  if($job->contact=='') { 
							  echo "No Contact Found."; }
							  else{
							  echo nl2br($job->contact);
							  }
                                                    
							  } else { ?>
                                                      <a href="<?php echo site_url('users/getData/'.$job->id); ?>">Login</a><?php echo $this->lang->line('view');?>
													 
                                                      <?php 
							  }
						  ?> </td>									  
															  
                                </tr>
								</tr>
						 
								<? if(isset($job->attachment_name)) { ?>
								<tr class="odd">
                                  <td class="dt1 dt0"><?php echo $this->lang->line('Job Attachment'); ?>:</td>
         <td class="dt1"><?php echo $job->attachment_name; ?><a href="<?php echo site_url('job/download/'.$job->attachment_url);?>" class="clsDown"><img src="<?php echo base_url();?>app/css/images/download1.png" /></a></td>								  								
		                        </tr>
							  
						  <?php }
						   } ?>
						  </table>
                          <p style="padding-left:1em !important;"><span class="clsPostProject"><a class="buttonBlackShad" href="<?php echo site_url('messages/job/'.$job->id); ?>"><span><?php echo $this->lang->line('View Job Message Board');?></span></a></span> <span><?php echo $this->lang->line('Message Posted');?>: <b>
                            <?php if(isset($totalMessages)) echo $totalMessages; ?>
                            </b></span></p>
                         <br/>
						  </div> 
                       
                        <!-- Load view my bids -->
                        <div class="clsInnerCommon">
                          <!--RC-->
                         
											<div class="clsHeads clearfix">
<div class="clsLeft_head">
<div class="clsRight_head">
<div class="clsCen_head">
                                              <h3><span class="clsPayments"><?php echo $this->lang->line('Job Bids');?></span></h3>
										</div></div></div>	</div>  
                                              <table cellspacing="1" cellpadding="2" width="98%" class="clsSitelinks">
                                                <tbody>
                                                  <tr>
                                                    <td width="10%" class="dt"><?php echo $this->lang->line('Employees');?></td>
													<td width="20%" class="dt"><?php echo $this->lang->line('Message');?></td>
                                                    <td width="5%" class="dt"><?php echo $this->lang->line('Bids'); ?></td>
                                                    <td width="15%" class="dt"><?php echo $this->lang->line('Delivery Time');?></td>
                                                    <td width="20%" class="dt"><?php echo $this->lang->line('Time of Bid');?></td>
                                                    <td width="18%" class="dt"><?php echo $this->lang->line('Rating');?></td>
													<td width="10%" class="dt"><?php echo $this->lang->line('Options');?></td>
                                                  </tr>
                                                  <?php $i=0;
						  	if(isset($bids) and $bids->num_rows()>0)
							{ 
							foreach($bids->result() as $bid)
								{ $i++;
								if($i%2==0)
								  $class = "dt1 dt0";
							    else
								  $class = "dt2 dt0"; 	  
							?>
                                                  <tr class="<?php echo $class;?>">
												  <?php  
												   $condition1=array('subscriptionuser.username'=>$bid->user_id);
			
								$certified1= $this->credential_model->getCertificateUser($condition1);
								if($certified1->num_rows()>0)
			                    {
							       foreach($certified1->result() as $certificate)
				                     {
									$user_id=$certificate->username;
									$id=$certificate->id;
									$condition=array('subscriptionuser.flag'=>1,'subscriptionuser.id'=>$id);
					                $userlists= $this->credential_model->getCertificateUser($condition);
									// get the validity
									$validdate=$userlists->row();
									$end_date=$validdate->valid; 
									$created_date=$validdate->created;
									$valid_date=date('d/m/Y',$created_date);
								    $next=$created_date+($end_date * 24 * 60 * 60);
									$next_day= date('d/m/Y', $next) ."\n";
							        if(time()<=$next)
								    {?>
								<img src="<?php echo image_url('certified.gif');?>"  title="<?php echo $this->lang->line('Certified Member') ?>" alt="<?php  echo $this->lang->line('Certified Member')?>"/>
								<?php } 
								  }
								   }?>


                                                    <td ><a href="<?php echo site_url('employee/viewProfile/'.$bid->uid);?>"><?php echo $bid->user_name; 
					             //Get the Favourite and Blocked users
								 if(isset($favourite))
								     {
									   foreach($favourite->result() as $result)
									     { 
										    if($result->user_id == $bid->user_id)
											  {
											    if($result->user_role == '1')
													{ ?> <img src="<?php echo image_url('star.jpg'); ?>" title="Favourite User" alt="Favourite User" />
                                                      <?php 
													} 
												if($result->user_role == '2')
													{ ?>
                                                      <img src="<?php echo image_url('cross.jpg'); ?>" title="Blocked User" alt="Blocked User" />
                                                      <?php 
													}
														
											 }
										  }
										}  	?>

                                                    
													


                                                      </a> <?php  $condition=array('subscriptionuser.username'=>$bid->user_id);

								
								$certified1= $this->credential_model->getCertificateUser($condition1);
								if($certified1->num_rows()>0)
			                    {
							       foreach($certified1->result() as $certificate)
				                     {
									$user_id=$certificate->username;
									$id=$certificate->id;
									$condition=array('subscriptionuser.flag'=>1,'subscriptionuser.id'=>$id);
					                $userlists= $this->credential_model->getCertificateUser($condition);
									// get the validity
									$validdate=$userlists->row();
									$end_date=$validdate->valid; 
									$created_date=$validdate->created;
									$valid_date=date('d/m/Y',$created_date);
								    $next=$created_date+($end_date * 24 * 60 * 60);
									$next_day= date('d/m/Y', $next) ."\n";
							        if(time()<=$next)
								    {?>
								<img src="<?php echo image_url('certified.gif');?>"  title="<?php echo $this->lang->line('Certified Member') ?>" alt="<?php  echo $this->lang->line('Certified Member')?>"/>
								<?php } 
								  }
								   }?>

													 


										<?php if(isset($user_details->certifyend))if($user_details->certifyend >= get_est_time()){ ?> <img src="<?php echo image_url('certified.png');  ?>" alt="Special User" border="0" width="10"	height="13"> <?php  }?>			  

											  </td>
													  <td> <?php if (isset($bid->bid_desc))echo $bid->bid_desc; ?></td>
                                                    <td><?php echo $currency.$bid->bid_amount;?></td>
                                                    <td><?php if($bid->bid_hours == 0 && $bid->bid_days == 0) 
											echo $this->lang->line('Immediately'); elseif($bid->bid_days != 0) echo $bid->bid_days.$this->lang->line('days');?>
                                                      &nbsp;
                                                      <?php if($bid->bid_hours != 0) echo $bid->bid_hours." ".$this->lang->line('hours');?>
                                                    </td>
                                                    <td><?php echo get_datetime($bid->bid_time);?></td>
                                                    <td><?php if($bid->num_reviews == 0)
							echo '(No Feedback Yet) ';
							else{ ?>
                                                      <a href="<?php echo site_url('owner/review/'.$bid->uid);?>"> <img height="7" border="0" width="81" alt="rating" src="<?php echo image_url('rating_'.$bid->user_rating.'.gif');?>"/> (<b><?php echo $bid->num_reviews;?> </b> <?php echo $this->lang->line('reviews');?>)</a>
                                                      <?php } ?>
                                                      <?php 
							if(isset($this->loggedInUser->id))
							  { ?>
                                                      <a href="<?php echo site_url('job/bidReport/'.$bid->id); ?>"><img src="<?php echo image_url('icons.png'); ?>" height="28" width="21" alt="Report Job Violation" title="Report Job Violation"/> </a>
                                                      <?php
							  } else { ?>
                                                      <a href="<?php echo site_url('users/login'); ?>"><img src="<?php echo image_url('icons.png'); ?>" height="28" width="21" alt="Report Job Violation"/> </a>
                                                      <?php 
							  }
						  ?> 
						  </td>
				
			<td>							
			<?php if(isset($loggedInUser->role_id))
    	 	 {
				if($loggedInUser->role_id =='1' && ($job->job_status == 0 || $job->job_status == 1) && $loggedInUser->id==$job->creator_id && $job->employee_id==0)
	  		 { 
		 			 
		 			echo '<a class="glow" href="'.site_url('job/selEmployee/'.$bid->id).'">'.$this->lang->line('Pick Employee').'</a>';
			
		  }elseif($loggedInUser->role_id =='1' &&   $loggedInUser->id==$job->creator_id && $job->employee_id!=0)
			 {
						echo 'Already Picked';
			  }
		 } 			
				
		 ?> </td>
													
                                                  </tr>
                                                  <?php } }
					  else{
					  	if($jobRow->is_hide_bids == 1)
							echo ' <tr class="dt2 dt0"><td colspan=8><a href="'.site_url('owner/viewProfile/'.$creatorInfo->id).'">'.$creatorInfo->user_name."</a> ".$this->lang->line('hidden_bids').'.</td></tr>';
						else
						{
						
					              	if(!isEmployee())
	                 	             {
        	                         echo '<tr class="dt2 dt0"><td colspan=8><p class="clsNoResult">'.$this->lang->line('no_bids1').'.</p></td></tr>';
		                             }
									 else
									 {
							echo '<tr class="dt2 dt0"><td colspan=8><p class="clsNoResult">'.$this->lang->line('no_bids').'.</p></td></tr>';
							}
						}
					  }
					  ?>
                                                </tbody>
                                              </table>
                       
                          <!--END OF RC-->
                        </div>
                        <?php 
						if(!isEmployee())
		{
        	$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('You must be logged in as a employee to place a bid')));
			//redirect('info');
		}
				else
			{	
						if($jobRow->job_status == 0)
						{ 
							if(count($tot) > 0)
								$toDisp = $this->lang->line('Edit Bid');
							else
								$toDisp = $this->lang->line('Place Bid');
							?>
											<?php 
							//Check for the job open date is end or not
							if($jobRow->flag== 0)
							{
							
								if(days_left($jobRow->enddate,$projectId) != 'Closed')
								 {  ?>
												<p style="padding-left:1em !important;" ><a href="<?php echo site_url('job/postBid/'.$projectId); ?>" class="buttonBlackShad"><span><?php echo $toDisp;?></span></a></p>
												<br />
												<?php 
								 }
							} 
							else
							{
							               $created_date=$jobRow->created;
								           $end_date=$jobRow->enddate;
					                       $next=$created_date+($end_date * 24 * 60 * 60);
											if(days_left($next,$projectId) != 'Closed')
								 {  ?>
												<p style="padding-left:1em !important;"><a href="<?php echo site_url('job/postBid/'.$projectId); ?>" class="buttonBlackShad"><span><?php echo $toDisp;?></span></a></p>
												
												<?php 
								 }
											
							}
						}
						}?>               
                      </div>
                    </div>  </div>

<!--END OF POST JOB-->
<?php $this->load->view('footer'); ?>
