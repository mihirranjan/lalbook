<?php $this->load->view('header'); ?>
<div class="clsMinContent clearfix">
<?php $this->load->view('sidebar'); ?>
<!--MAIN-->
<?php 
//All escrow transaction
 $projectAward = 0 ;
	  $note = 0;
	  $j = 0;
	  $awardcount = 0;
	  $awards       = array();
	  $unreadmsg    = array();
	  $notify       = '';
	  foreach($awardProjects->result() as $res)
	    {
			//Calculate the Job awards
			$awardDate   = current_date($res->job_award_date);
			$created     = current_date($res->created);
			$currentDate = current_date(get_est_time());
			
			if($awardDate == $currentDate)
			  {
			  	$projectAward             = $projectAward +1;
				$awards[$projectAward]    = $res->id;
			  }
			$awardcount = $awardcount  +  1;  
			$unreadAward[$awardcount]  = $res->id;  
			$category  = explode(',',$res->job_categories);

			//Calculate the Job notification
            if(isset($categoryname))
			{
				foreach($categoryname[0] as $rec)
				  {
					if(in_array($rec,$category))
					  {
						if($created == $currentDate)
						  {
							 $note       = $note +1;
							 $notify[$note]     = $res->id; 
							 
						  }	 
						break;
					  }
				  }
			 } 
			  
		}
		
		//Calculate the Job invitation
		$res            = array();   // get the project id
		$projectId  =array();   //merge array
		$projectInvite  =array();   //merge array
		$unreadInvitation = array();
		foreach($projectInvitation->result() as $invite)
		  {
		  	if(current_date($invite->invite_date) == $currentDate)
			  {
			  	$res = explode(',',$invite->job_id);
				$projectId = array_merge($projectId,$res);
			  }
			$res = explode(',',$invite->job_id);  
			$unreadInvitation =  array_merge($unreadInvitation,$res); 
		  }
		$projectInvite = array_unique($projectId);
		$projectInvitecount = count($projectInvite);     
		$unreadInvitation = array_unique($unreadInvitation);
		$unreadInvitationcount = count($unreadInvitation);
		$mailCount = 0;
		$unreadcount = 0;
		foreach($mailList->result() as $mail)
		  {
		  	if(current_date($mail->created) == $currentDate)
			{
                $mailCount = $mailCount + 1; 
				$mailData[$mailCount] = $mail->id;
			}
			$unreadcount = $unreadcount + 1;
			$unreadmsg[$unreadcount] = $mail->id;
		  }
		 //Add comma between values for post values to controller 
		if($notify)
		  $notify = implode(',',$notify);
 	    if(isset($awards))
		  $awards = implode(',',$awards);
		if(isset($projectInvite))
		  $projectInvite = implode(',',$projectInvite);
 	    if(isset($mailData))
		   $mailData = implode(',',$mailData);
		if(isset($unreadmsg))
		   $unreadmsg = implode(',',$unreadmsg);
		if(isset($unreadAward))   
		   $unreadAward = implode(',',$unreadAward);
	  //Show the last transaction
	 // $transactions1 = $transactions1;	
	
     $transaction_detail = $transaction->row();
	 //print_r($transaction_detail);
	 if(empty($transaction_detail))
	 {
	$no=0;
	 }
	 else
	 {
	
	 $no = count($transaction_detail);
	 }
	   
?>


<div id="main">
  <!--POST JOB-->
  <?php $this->load->view('view_accountMenu'); ?>
  <div class="clsTabs clsInnerCommon clsInfoBox">
  
					  
					  <table width="98%" cellspacing="1" cellpadding="1" style="background:none!important;">
                         <tbody>
                            <tr>
								<td width="47%" class="vtop" > 
									 <h3><span class="clsMyEscrow"><?php echo $this->lang->line('Employee Account Management');?></span></h3>
								</td>
								<td width="47%" class="vtop">
									<h3><span class="clsNewMethod"><?php echo $this->lang->line('Subscription Details'); ?></span></h3>
								</td>
							</tr>
							<tr>
								<td>
									<div id="selDoubleDiv" class="clearfix">
					
						<div class="clsImageDiv clsFloatLeft">
						<p class="clsBorder"><a href="<?php echo site_url('employee/viewProfile/'.$loggedInUser->id);?>">
								<?php
								if($loggedInUser->logo != NULL)
								echo '<img src="'.uimage_url(get_thumb($loggedInUser->logo)).'" />';
								else
								echo '<img src="'.image_url('noImage.jpg').'" width="49" height="48" />';
								?>
								</a></p>
						</div>
						<div class="clsContentDiv">
						 <p class="clsSitelinks"><?php echo $this->lang->line('Welcome'); ?>  <a class="glow" href="<?php echo site_url('employee/viewProfile/'.$loggedInUser->id); ?>"><?php echo $loggedInUser->user_name?></a> <?php 
			
			                 $condition1=array('subscriptionuser.username'=>$loggedInUser->id);
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
!(<?php if(($loggedInUser->num_reviews) !='0') { ?><img height="7" border="0" width="81" alt="10.00/10" src="<?php echo image_url('rating_'.$loggedInUser->user_rating.'.gif');?>"/> <b><?php } if(($loggedInUser->num_reviews) !='0') echo $loggedInUser->num_reviews; if(($loggedInUser->num_reviews) =='0') echo 'No Feedback Yet';?> </b> <a href="<?php echo site_url('employee/review/'.$loggedInUser->id);?>">  <?php if(($loggedInUser->num_reviews) !='0') echo $this->lang->line('reviews');?></a>) </p>
						
                        <form name="mailList1" action="<?php echo site_url('messages/mailList'); ?>" method="post" class="clsSitelinksForm">
                          <input name="unread" type="hidden" value="unread" />
                          <input name="mailData1" type="hidden" value="<?php echo $unreadmsg; ?>" />
                            <?php  if($unreadcount > 0) { ?>
						   <div class="buttonwrapperSafari">
						   <p><span class="clsSpan"><?php echo $this->lang->line('You are having'); ?> <b style="color:green;"> <?php echo $unreadcount;?> </b></span>  <a  href="#" onclick="javascript:document.mailList1.submit();" class="buttonBlack"><span><?php echo $this->lang->line('View All'); ?></span></a>
						   </p>
						   </div>
						   </p>
                            <?php } ?>
                        </form>
						
                       <!-- <p> <font color="#6b80a1"><?php echo $this->lang->line('Local time');?> </font><?php echo show_date(time()); ?> </p>-->
                        </div>
						</div>
								</td>
								<td>
									<div class="clsLeft"> <?php 
						 if(isset($packagesList))
						 {
						  foreach($packagesList->result() as $package)
						  {?>
					 <p><span class="clsSpan"><?php echo $this->lang->line('Package Name:');?></span>  <span><?php echo $package_name=$package->package_name;?></span></p>
								
                                <p><span class="clsSpan"><?php echo $this->lang->line('Validity Date:');?></span><span><?php echo date('d/m/Y',$package->end_date);?></span></p>
                                  <p><span class="clsSpan"><?php echo $this->lang->line('Amount:');?></span><span><?php echo $package->amount;?></span></p>
				     <?php
				   }
				 }
				 else
				 {
				 ?>
				  <p><span class="clsSpan"><?php echo $this->lang->line('No Package Found');?></span></p><?php
				 }
			?></div>
								</td>
							</tr>
							</tbody>
							</table>
					  
					  
					  
                       
                        
                        <table width="96%" cellspacing="1" cellpadding="1" class="clsSafariFix" style="background:none!important;">
                          <tbody>
                            <tr>
                              <td width="47%" class="vtop" ><h3><span class="clsPMB"><?php echo $this->lang->line('My Latest Job Notification');?></span></h3>
                                <?php 
										 
										 										   
										  if($no != '0')
											{ ?>
								 <table width="60%" style="margin:5px 0 0 4em !important;">
								  <tbody>
								  
								  <tr>
                                  <form name="notify" action="<?php echo site_url('messages/notify'); ?>" method="post">
                                  <input name="notifyData" type="hidden" value="<?php if(isset($notify)) echo $notify; ?>" />
								  <td width="30%"><?php echo $this->lang->line('Job Notification'); ?></td>
								  <td><b style="color:green;"> <?php echo $note;?></b></td>
								  <td>								   <?php 
											if($note > 0) 
											{ ?>
                                    <a href="#" onclick="javascript:document.notify.submit();" class="buttonBlack"><span><?php echo $this->lang->line('View All'); ?></span></a>
                                    <?php 
											} ?>
</td>
								</form>
								  </tr>
								  <tr><td>&nbsp;</td><td></td><td></td></tr>
								  <tr>
                                  <form name="awards" action="<?php echo site_url('messages/awards'); ?>" method="post">
                                  <input name="awardsData" type="hidden" value="<?php if(isset($awards)) echo $awards; ?>" />
								  <td width="20%"><?php echo $this->lang->line('Job Award'); ?></td>
								  <td><b style="color:green;"><?php echo $projectAward;?></b></td>
								  <td>								  
										 <?php 
											if($projectAward > 0) 
											{ ?>
                                    <a href="#" onclick="javascript:document.awards.submit();" class="buttonBlack"><span><?php echo $this->lang->line('View All'); ?></span></a>
                                    <?php 
											} ?>
											
								 </td>
								 </form>
								 </tr>
								 <tr><td>&nbsp;</td><td></td><td></td></tr>
								  <tr>
                                   <form name="projectInvite" action="<?php echo site_url('messages/invitation'); ?>" method="post">
                                   <input name="projectInviteData" type="hidden" value="<?php if(isset($projectInvite)) echo $projectInvite; ?>" />
								  <td width="20%"><?php echo $this->lang->line('Job Invitataion'); ?></td>
								  <td><b style="color:green;"><?php echo $projectInvitecount?></b></td>
								  <td>								  
										 <?php 
											if($projectInvitecount > 0) 
											{ ?>
                                    <a href="#" onclick="javascript:document.projectInvite.submit();" class="buttonBlack"><span><?php echo $this->lang->line('View All'); ?></span></a>
                                    <?php 
											} ?>
								 </td>
								 </form>
								 </tr>
								 <tr><td>&nbsp;</td><td></td><td></td></tr>
 								  <tr>
                                    <form name="mailList" action="<?php echo site_url('messages/mailList'); ?>" method="post">
                                  <input name="newmail" type="hidden" value="newmail" />
                                  <input name="mailData" type="hidden" value="<?php if(isset($mailData)) echo $mailData; ?>" />
								  
								  <td width="20%"><?php echo $this->lang->line('Job Mail List'); ?></td>
								  <td><b style="color:green;"><?php echo $mailCount;?></b></td>
								  <td>								  
										<?php 
											if($mailCount > 0) 
											{ ?>
                                    <a class="buttonBlack" href="#" onclick="javascript:document.mailList.submit();"><span><?php echo $this->lang->line('View All'); ?></span></a>
                                    <?php 
											} ?>
								 </td>
								 </form>
								 </tr>

								  </tbody>
								  </table>
                                <?php } ?>
                              </td>
							  
							  
                              <td width="47%" class="vtop">
							  
							  <h3><span class="clsPayMethods"><?php echo $this->lang->line('My Last Transaction');?></span></h3>
                               
							   
							    <p><span class="clsSpan"><?php echo $this->lang->line('My Account Balance:');?></span> <?php echo $currency;?>
                                  <?php  if(isset($userAvailableBalance)) echo number_format($userAvailableBalance, 2, '.', ''); ?>
                                </p>
                                 <?php 
									   if($no == '0')
										{
										
										  echo '<p class="clsClearFix"><span class="clsWidth80"></span><span>There is no Last Transaction</span></p>';
										 
									    }
										if($no != '0')
										{ ?>

                                <p><span class="clsSpan"><?php echo $this->lang->line('Amount:');?></span>$<span><?php echo $transaction_detail->amount;?></span></p>
                                
								<p><span class="clsSpan"><?php echo $this->lang->line('Description:');?></span><span><?php echo $transaction_detail->description;?>

                                  <?php foreach($projectList->result() as $result) { if($result->id == $transaction_detail->job_id) echo $result->job_name; } ?>

                                  </span></p>
								<p><span class="clsSpan"><?php echo $this->lang->line('Date:');?></span><span><?php echo get_datetime($transaction_detail->transaction_time);?></span></p>
                                
								<div class="buttonwrapper">
								<p><a href="<?php echo site_url('account/transaction'); ?>" class="buttonBlack"><span><?php echo $this->lang->line('View All');?></span></a></p>

								</div>
                                <?php } ?>
								</div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                        <h3><span class="clsToreviw"><?php echo $this->lang->line('Members to Review');?></span></h3>
                        <table width="96%" cellspacing="1" cellpadding="2">
                          <tr>
                            <td width="4%" class="dt"><?php echo $this->lang->line('S.No');?></td>
                            <td width="26%" class="dt"><?php echo $this->lang->line('Job Name');?> </td>
                            <td width="26%" class="dt"><?php echo $this->lang->line('Job Winner');?> </td>
                            <td width="16%" class="dt"><?php echo $this->lang->line('Bid Price');?></td>
                            <td width="16%" class="dt"><?php echo $this->lang->line('Options');?> </td>
                          </tr>
                          <?php
									if(isset($closedProjects) and $closedProjects->num_rows()>0)
		
									{
		
										$i=0;
		
										foreach($closedProjects->result() as $closedProject)
		
										{	
		
											if($i%2==0)
		
												$class = 'dt1 dt0';
		
											else 
		
												$class = 'dt2 dt0';	
		
											?>
                          <tr class="<?php echo $class; ?>">
                            <td><?php echo $i+1;?></td>
                            <td><a href="<?php echo site_url('job/view/'.$closedProject->id); ?>"><?php echo $closedProject->job_name; ?></a></td>
                            <td><a href="<?php echo site_url('employee/viewProfile/'.$closedProject->userid);?>"><?php echo $closedProject->user_name; ?></a> </td>
                            <td><?php echo getLowestBid($closedProject->id,$closedProject->employee_id); ?> </td>
									
                            <td><a href="<?php echo site_url('employee/reviewOwner/'.$closedProject->id);?>">
						<?php $reviewDetails = getReviewStatusProgrammer($closedProject->id,$closedProject->employee_id);
							$reviewDetails = $reviewDetails->row();
							if(!is_object($reviewDetails))
										 echo $this->lang->line('Review');
							else
									echo $this->lang->line('view review');
							?>
							</a> </td></tr>
                            <?php		
		
											$i++;						
		
										}//For Each End - Latest job Traversal
								}//If - End Check For Latest Jobs
							  else
											  {
											echo '<tr><td colspan=5>'.$this->lang->line('No Jobs').'</td></tr>';;
											  }
		
								  ?>
                          
                          </tbody>
                        </table>
						
						 <h3><span class="clsOptDetial"><?php echo $this->lang->line('Bookmarked_jobs');?></span></h3> 
                             <table cellspacing="1" cellpadding="2" width="96%">
                                <tbody><tr>
                                  <td width="5%" class="dt"><?php echo $this->lang->line('Sl.No');?></td>
                                  <td width="30%" class="dt"><?php echo $this->lang->line('Job Name');?></td>
								  <td width="20%" class="dt"><?php echo $this->lang->line('Creator Name');?></td>
								  <td width="10%" class="dt"><?php echo $this->lang->line('Bid Amount');?></td>
								  <td width="10%" class="dt"><?php echo $this->lang->line('Posted');?></td>
								  <td width="10%" class="dt"><?php echo $this->lang->line('Status');?></td>
                                </tr>
                          <?php
						  	if(isset($bookMark) and $bookMark->num_rows()>0)
							{
								$i=0;
								foreach($bookMark->result() as $bookMark)
								{
									if($i%2==0)
										$class = 'dt1 dt0';
									else 
										$class = 'dt2 dt0';	
									?>
                                   <tr class="<?php echo $class; ?>">
                                    <td><?php echo $i+1;?></td>
									<td><a href="<?php echo site_url('job/view/'.$bookMark->job_id); ?>"><?php echo $bookMark->job_name; ?></a></td>
									<td><a href="<?php echo site_url('employee/viewProfile/'.$bookMark->creator_id);?>"><?php foreach($getUsers->result() as $user) { if($user->id == $bookMark->creator_id) { echo $user->user_name; break; } } ?></a> </td>
									<td> <?php if(isset($bookMark->budget_min) or ($bookMark->budget_max)) echo '$ '.$bookMark->budget_min.' - '.$bookMark->budget_max; else echo 'N/A'; ?> </td>
									<td><?php echo get_date($bookMark->created);?></td>
									<td><?php echo getProjectStatus($bookMark->job_status); ?></td>
								  </tr>
                          <?php		
						  			$i++;						
								}//For Each End - Latest Project Traversal															
							}//If - End Check For Latest Projects
							else
							   {
									echo '<tr><td colspan="5">There is no Bookmark Jobs</td></tr>';
								}			
		
							
						  ?>
                              </tbody></table>		
							  <?php if(isset($pagination1)) echo $pagination1;?>
						
						
                        <h3><span class="clsEscrow"><?php echo $this->lang->line('My Escrow Account');?></span></h3>
                        <table width="96%" cellspacing="1" cellpadding="2">
                          <tbody>
                            <tr>
                              <td width="4%" class="dt"><?php echo $this->lang->line('SI.No');?></td>
                              <td width="16%" class="dt"><?php echo $this->lang->line('From');?></td>
                              <td width="16%" class="dt"><?php echo $this->lang->line('To');?></td>
                              <td width="5%" class="dt"><?php echo $this->lang->line('Amount');?></td>
                              <td width="14%" class="dt"><?php echo $this->lang->line('Date');?></td>
                              <td width="17%" class="dt"><?php echo $this->lang->line('Job');?></td>
                              <td width="13%" class="dt"><?php echo $this->lang->line('Status');?></td>
                            </tr>
                            <?php $i=1; $k=0;
						      foreach($transactions1->result() as $res)
								{ $i=$i+1; 
								  $k=$k+1;
								  if($i%2 == 0)
								    $class ="dt1 dt0";
								  else
								    $class ="dt2 dt0";	
										?>
                            <tr class="<?php echo $class; ?>">
                              <td><?php echo $k; ?></td>
                              <td ><?php foreach($usersList->result() as $user) { if($user->id == $res->creator_id) { ?>
                                <a href="<?php if($user->role_id == '1') echo site_url('owner/viewProfile/'.$user->id); if($user->role_id=='2') echo site_url('employee/viewProfile/'.$user->id);?>">
                                <?php  echo $user->user_name; break; } }  ?>
                                </a></td>
                              <td ><?php foreach($usersList->result() as $user) { if($user->id == $res->reciever_id) { ?>
                                <a href="<?php if($user->role_id == '1') echo site_url('owner/viewProfile/'.$user->id); if($user->role_id=='2') echo site_url('employee/viewProfile/'.$user->id);?>">
                                <?php  echo $user->user_name; break; } }  ?>
                                </a></td>
                              <td><?php echo $res->amount; ?></td>
                              <td><?php echo get_datetime($res->transaction_time); ?></td>
                              <td ><span class="clsEswDate">
                                <?php foreach($projectList->result() as $result) { if($result->id == $res->job_id){ ?>
                                <a href="<?php echo site_url('job/view/'.$result->id); ?>">
                                <?php  echo $result->job_name; } } ?>
                                </a></span></td>
                              <td><?php echo $res->status; ?> </td>
                              <?php 
								} 
								if($k=='0')
								   {
									echo '<td colspan="5">';
									echo 'There is no Escrow Payment Transaction';
									echo '</td>';
								   }	
								?>
                            </tr>
                          </tbody>
                        </table>

    
  </div>
  <!--END OF POST JOB-->
</div></div></div>
<!--END OF MAIN-->
<?php $this->load->view('footer'); ?>