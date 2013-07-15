<?php $this->load->view('header'); ?>
<div class="clsMinContent clearfix">
<?php $this->load->view('sidebar'); ?>
<!--MAIN-->
<div id="main">
      <!--POST JOB-->
      <?php $this->load->view('view_accountMenu'); ?>
      <div class="clsTabs clsInnerCommon clsInfoBox">
       
                            <div class="clsInnerCommon">
                            <div class="clsEditProfile clsSitelinks">   
							   <h3><span class="clsEscrow"><?php echo $this->lang->line('withdraw_funds'); ?></span></h3>
							<?php $condition1=array('subscriptionuser.username'=>$loggedInUser->id);
								$certified1= $this->credential_model->getCertificateUser($condition1);?>					   
							<p><span><?php echo $this->lang->line('user_name'); ?></span><a class="glow" href="<?php if($loggedInUser->role_id == '1') $res = 'owner'; else $res = 'employee'; echo site_url($res.'/viewprofile/'.$loggedInUser->id); ?>"> <?php echo $loggedInUser->user_name?></a>
							<?php if(count($certified1->result())>0)
								{?>
								<img src="<?php echo image_url('certified.gif');?>" />
								<?php }?>
							</p>
<p><span><?php echo $this->lang->line('Account Balance:');?></span><?php echo $currency;?><?php if(isset($userAvailableBalance)) echo $userAvailableBalance.'.00'; ?></p>

							<form name="withdrawAmount" action="<?php echo site_url('withdraw'); ?>"  method="post">
								<p><span><?php echo $this->lang->line('Withdraw Amount:');?></span> <?php echo $currency;?>
								  <input name="total" size="10" value="<?php echo set_value('total'); ?>"  type="text"/>
								  <?php echo form_error('total'); ?>
								  <?php
								//Show Flash error Message 
								if($msg = $this->session->flashdata('flash_message'))
									{
									echo $msg;
									}
								?>
								</p>
								<p style="overflow:hidden;"><span style="color:#727272;font-style:italic;font-size:11px;"><?php echo $this->lang->line('note'); ?></span></p>

							<h3><span class="clsPayments"><?php echo $this->lang->line('Payment methods');?></span></h3>
							 <?php echo form_error('paymentMethod'); ?>
							<table cellspacing="1" cellpadding="2" width="96%">
                                <tbody><tr>
                                  <td width="100" class="dt"><?php echo $this->lang->line('Payment Method');?></td>
                                  <td width="100" class="dt"><?php echo $this->lang->line('Cost');?></td>
                                  <td width="100" class="dt"><?php echo $this->lang->line('Approval');?></td>
								  <td width="250" class="dt"><?php echo $this->lang->line('Description');?></td>
                                </tr>
                                <tr>
                                  <td class="dt1 dt0"><input value="paypal" class="clsRadiobut" name="paymentMethod" type="radio"  <?php if(isset($amount)) echo "checked"; ?>/>
                        <label><?php echo $this->lang->line('Paypal') ?></label></td>
                                  <td class="dt1"><?php echo $this->lang->line('No Cost');?></td>
                                  <td class="dt1"><?php echo $this->lang->line('Instant*');?></td>
                                  <td class="dt1"><?php echo $this->lang->line('wire1').$currency.$this->lang->line('wire2');?></td>
                                </tr>
                                
                              </tbody></table>
							  <p style="text-align:right;">
								<input  class="clsLogin_but" name="withdrawMoney"  value="<?php echo $this->lang->line('Withdraw'); ?>" type="submit"/>
							  </p>
							</form>
							</div>
							<br />
							<h3><span class="clsDepositTrans"><?php echo $this->lang->line('My Withdraw Transactions');?></span></h3>
							<table cellspacing="1" cellpadding="2" width="98%">
                                <tbody><tr>
                                  <td width="5%" class="dt"><?php echo $this->lang->line('SI.No');?></td>
                                  <td width="25%" class="dt"><?php echo $this->lang->line('To');?></td>
                                  <td width="305" class="dt"><?php echo $this->lang->line('Amount');?></td>
								  <td width="23%" class="dt"><?php echo $this->lang->line('Date');?></td>
								  <td width="18%" class="dt"><?php echo $this->lang->line('Status');?></td>
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
									   <a href="<?php if($user->role_id == '1') echo site_url('owner/viewProfile/'.$user->id); if($user->role_id=='2') echo site_url('employee/viewProfile/'.$user->id);?>"> <?php  echo $user->user_name;
									      $condition=array('subscriptionuser.username'=>$user->id);
								$certified1= $this->credential_model->getCertificateUser($condition);?>
								 <?php if(count($certified1->result())>0)
								{?>
								<img src="<?php echo image_url('certified.gif');?>" />
								<?php }
									    break; } }  ?></a></td>								  
									  <td class="<?php echo $class1; ?>"><?php echo $currency;?> <?php echo $res->amount; ?></td>
									  <td class="<?php echo $class1; ?>"><?php echo get_datetime($res->transaction_time); ?></td>
									  <td class="<?php echo $class1; ?>"><?php echo $res->status; ?> </td> 
									  <?php 
								} 
								if($k=='0')
								   {
									echo '<td colspan="5">';
									echo '<p class="clsNoResult">There is no Transaction</p>';
									echo '</td>';
								   }	
								?>	 </tr> 
                              </tbody></table>
							   <!--PAGING-->
								<?php if(isset($pagination)) echo $pagination;?>
							 <!--END OF PAGING-->

                          </div>
                        </div>
                      </div>
      

</div></div>
<!--END OF MAIN-->
<?php $this->load->view('footer'); ?>
