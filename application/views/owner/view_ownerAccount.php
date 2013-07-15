<?php $this->load->view('header'); ?>
<div class="clsMinContent clearfix">
<?php $this->load->view('sidebar'); ?>
<!--MAIN-->

<div id="main">
  <!--POST JOB-->
  <?php $this->load->view('view_accountMenu');
        
        $currentDate = current_date(get_est_time());
		$mailCount = 0;
		$unreadcount = 0;
		$mailData = array();
		$unreadmsg = array();
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
 	    if(isset($mailData))
		   $mailData = implode(',',$mailData);
		if(isset($unreadmsg))
		$unreadmsg = implode(',',$unreadmsg);
	   
	   $transactions1 = $transactions1;	
	   //pr($transaction->result());  
	   $transactions = $transaction->row(); $no = count($transactions);
	   ?>
   
  <div class="clsTabs clsInnerCommon clsInfoBox">
   
                       
						<table width="96%" cellspacing="1" cellpadding="1" style="background:none!important;">
                         <tbody>
                            <tr>
								<td width="47%" class="vtop" > 
									<h3><span class="clsFileManager"><?php echo $this->lang->line('Owner Account Management'); ?></span></h3>
								</td>
									<td width="47%" class="vtop">
							  
							  <h3><span class="clsNewMethod"><?php echo $this->lang->line('Subscription Details'); ?></span></h3>
								</td>
							</tr>
							<tr>
								<td>
								<div class="clsBuyerWidth clearfix">
						
						<div class="clsImageDiv clsFloatLeft clsAcc">
                        <p class="clsBorder"><a href="<?php echo site_url('owner/viewProfile/'.$loggedInUser->id);?>">
								<?php
								if($loggedInUser->logo != NULL)
								echo '<img src="'.uimage_url(get_thumb($loggedInUser->logo)).'" />';
								else
								echo '<img src="'.image_url('noImage.jpg').'" width="49" height="48" />';
											?>
								</a></p>
						</div>
						
						
						<div class="clsContentDiv">
						
						<p class="clsSitelinks"><?php echo $this->lang->line('Welcome'); ?>  <a class="glow" href="<?php echo site_url('owner/viewProfile/'.$loggedInUser->id); ?>"><?php echo $loggedInUser->user_name; ?>!</a>
						<?php 
			
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
						(<?php if(($loggedInUser->num_reviews) !='0') { ?><img height="7" border="0" width="81" alt="10.00/10" src="<?php echo image_url('rating_'.$loggedInUser->user_rating.'.gif');?>"/> <b><?php } if(($loggedInUser->num_reviews) !='0') echo $loggedInUser->num_reviews; if(($loggedInUser->num_reviews) =='0') echo 'No Feedback Yet';?> </b> <a href="<?php echo site_url('owner/review/'.$loggedInUser->id);?>">  <?php if(($loggedInUser->num_reviews) !='0') echo $this->lang->line('reviews');?></a>) </p>
                        <p><?php echo $this->lang->line('Account Balance:').$currency;?> <?php if(isset($userAvailableBalance)) echo number_format($userAvailableBalance, 2, '.', ''); ?></p>
						<p></p>
						<form name="mailList1" action="<?php echo site_url('messages/mailList'); ?>" method="post">
                          <input name="unread" type="hidden" value="unread" />
                          <input name="mailData1" type="hidden" value="<?php echo $unreadmsg; ?>" />
                          <div class="buttonwrapperSafari">
						  <p><span class="clsSpan"><?php echo $this->lang->line('You are having'); ?> <b style="color:green;"> <?php echo $unreadcount;?> </b></span>
                            <?php  if($unreadcount > 0) { ?>
                            <a class="buttonBlack" href="#" onclick="javascript:document.mailList1.submit();"><span>
                            <?php  echo $this->lang->line('View All'); ?>
                            </span></a>
                            <?php } ?>
                          </p>
						  </div>
						 
                        </form>
                        <!--<p> <font color="#6b80a1"><?php echo $this->lang->line('Local time');?> </font><?php echo show_date(time()); ?></p>-->
                        <!--2 col -->
                       </div>
					   
					
		</div>
								</td>
								<td valign="top">
									<div class="clsLeft "> <?php 
						
				         if(isset($packagesList))
						 {
						  foreach($packagesList->result() as $package)
						    {?>
				      <p><span class="clsSpan"><?php echo $this->lang->line('Package Name:');?></span>  <span><?php echo $package_name=$package->package_name;?></span></p>
								
                                <p><span class="clsSpan"><?php echo $this->lang->line('Validity Date:');?></span><span><?php echo date('d/m/Y',$package->end_date);?></span></p>
                                  <p><span class="clsSpan"><?php echo $this->lang->line('Amount:');?></span><span><?php echo $package->amount;?></span></p>
				<?php        }
				}
				else
				{?>
					
				  <p><span class="clsSpan"><?php echo $this->lang->line('No Package Found');?></span></p>
				  <?php
				}
			 ?></div>
								</td>
							</tr>
						</tbody>
					</table>
						
	
                        <table width="96%" cellspacing="1" cellpadding="1" style="background:none!important;">
                          <tbody>
                            <tr>

                              <td width="47%" class="vtop"><h3><span class="clsPMB"><?php echo $this->lang->line('My Job Notification');?></span></h3>
								<table width="60%" style="margin:5px 0 0 4em !important;background:none !important;">
								  <tbody>
								  <tr>
								
                                  <form name="mailList" action="<?php echo site_url('messages/mailList'); ?>" method="post">

                                  <input name="newmail" type="hidden" value="newmail" />
                                  <input name="mailData" type="hidden" value="<?php echo $mailData; ?>" />

								  <td width="30%">
								 <p style="padding:0!important;"> <?php echo $this->lang->line('Job Mail List'); ?>:</p>
                                  </td>
								  <td >
								  <b style="color:green;">
								  <?php echo $mailCount;?>
								  </b>
								  </td>
								  <td >
								    <?php  

												if($mailCount > 0) 
												 { ?>
                                    <a class="buttonBlack" href="#" onclick="javascript:document.mailList.submit();"> <span><?php echo $this->lang->line('View All'); ?></span></a>
                                    <?php 
												 } ?>
								  </td>
								  </tr>
								  </tbody>
								  </table>
                                </form>
								
								
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

                                <p><span class="clsSpan"><?php echo $this->lang->line('Amount:');?></span><?php echo $currency;?><span><?php echo $transactions->amount;?></span></p>
                                
								<p><span class="clsSpan"><?php echo $this->lang->line('Description:');?></span><span><?php echo $transactions->description;?>

                                  <?php foreach($projectList->result() as $result) { if($result->id == $transactions->job_id) echo $result->job_name; } ?>

                                  </span></p>
								<p><span class="clsSpan"><?php echo $this->lang->line('Date:');?></span><span><?php echo get_datetime($transactions->transaction_time);?></span></p>
                                
								<div class="buttonwrapper">
								<p><a href="<?php echo site_url('account/transaction'); ?>" class="buttonBlack"><span><?php echo $this->lang->line('View All');?></span></a></p>

								</div>
                                <?php } ?>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                        <h3><span class="clsToreviw"><?php echo $this->lang->line('Members to Review');?></span></h3>
                        <table width="96%" cellspacing="1" cellpadding="2">
                          <tbody>
                            <tr>
                              <td width="4%" class="dt"><?php echo $this->lang->line('S.No');?></td>
                              <td width="26%" class="dt"><?php echo $this->lang->line('Job Name');?> </td>
                              <td width="26%" class="dt"><?php echo $this->lang->line('Job Winner');?> </td>
                              <td width="16%" class="dt"><?php echo $this->lang->line('Bid Price');?></td>
                              <td width="16%" class="dt"><?php echo $this->lang->line('Options');?></td>
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
                              <td><?php echo getLowestBid($closedProject->id,$closedProject->employee_id); ?></td>
                              <td><a href="<?php echo site_url('owner/reviewEmployee/'.$closedProject->id);?>">
							   <?php
							  $reviewDetails = getReviewStatus($closedProject->id,$closedProject->employee_id);
							  $reviewDetails = $reviewDetails->row();
							  if(!is_object($reviewDetails))
							 	 echo $this->lang->line('Review');
							  else
							  	echo $this->lang->line('view review');
							  ?></a> </td>
                            </tr>
                            <?php		
															$i++;						
														}//For Each End - Latest Job Traversal															
													}//If - End Check For Latest Jobs
													
													
											  else
											  {
											  echo '<tr><td colspan=5><p class="clsNoResult">'.$this->lang->line('No Jobs').'</p></td></tr>';
											  }?>
												 
                          </tbody>
                        </table>
                        <h3><span class="clsEscrow"><?php echo $this->lang->line('My Escrow Account');?></span></h3>
                        <table width="98%" cellspacing="1" cellpadding="2">
                          <tbody>
                            <tr>
                              <td width="5%" class="dt"><?php echo $this->lang->line('SI.No');?></td>
                              <td width="15%" class="dt"><?php echo $this->lang->line('From');?></td>
                              <td width="15%" class="dt"><?php echo $this->lang->line('To');?></td>
                              <td width="15%" class="dt"><?php echo $this->lang->line('Amount');?> </td>
                              <td width="20%" class="dt"><?php echo $this->lang->line('Date');?></td>
                              <td width="15%" class="dt"><?php echo $this->lang->line('Job');?></td>
                              <td width="13%" class="dt"><?php echo $this->lang->line('Status');?></td>
                            </tr>
                            <?php $i=1; $k=0;
						        foreach($transactions1->result() as $res)
								{ $i=$i+1; 
								  if($i%2 == 0)
								    {
								    $class ="dt1 dt0";
									$class1 = "dt1";
									}
								  else
								    {
								    $class ="dt2 dt0";	
									$class1 = "dt2";
									}
									  $k=$k+1;
										?>
                            <tr>
                              <td class="<?php echo $class; ?>"><?php echo $k; ?></td>
                              <td class="<?php echo $class1; ?>"><?php foreach($usersList->result() as $user) { if($user->id == $res->creator_id) { ?>
                                <a href="<?php if($user->role_id == '1') echo site_url('owner/viewProfile/'.$user->id); if($user->role_id=='2') echo site_url('employee/viewProfile/'.$user->id);?>">
                                <?php  echo $user->user_name; break; } }  ?>
                                </a></td>
                              <td class="<?php echo $class1; ?>"><?php foreach($usersList->result() as $user) { if($user->id == $res->reciever_id) { ?>
                                <a href="<?php if($user->role_id == '1') echo site_url('owner/viewProfile/'.$user->id); if($user->role_id=='2') echo site_url('employee/viewProfile/'.$user->id);?>">
                                <?php  echo $user->user_name; break; } }  ?>
                                </a></td>
                              <td class="<?php echo $class1; ?>"><?php echo $currency.' ';?> <?php echo $res->amount; ?></td>
                              <td class="<?php echo $class1; ?>"><?php echo get_datetime($res->transaction_time); ?></td>
                              <td class="<?php echo $class1; ?>"><span class="clsEswDate">
                                <?php foreach($projectList->result() as $result) { if($result->id == $res->job_id){ ?>
                                <a href="<?php echo site_url('job/view/'.$result->id); ?>">
                                <?php  echo $result->job_name; } } ?>
                                </a></span></td>
                              <td class="<?php echo $class1; ?>"><?php echo $res->status; ?>
							   <?php if($res->status == 'Pending') { ?>
							<a href="<?php echo site_url('escrow/releaseEscrow/'.$res->id); ?>"> <span class="clsEscrow1"><img alt="Escrow Release" title="Escrow Release" height="15" src="<?php echo image_url('release.png')?>"/></a></span></a>
						   <?php } ?>
							   </td>
                              <?php 
								} 
								if($k=='0')
								   {
									echo '<td colspan="7">';
									echo '<p class="clsNoResult">There is no Deposit Transaction</p>';
									echo '</td>';
								   }	
								?>
                            </tr>
                          </tbody>
                        </table>
     
    <div class="alignRight"> </div>
  </div>
  <!--END OF POST JOB-->
</div>
<!--END OF MAIN-->
<script type="text/javascript">
function confirmation()
{
	res = confirm('Do you really cancel the escrow payemt');
	return res;
	
}	
</script>
</div></div>
<?php $this->load->view('footer'); ?>

