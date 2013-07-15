<?php $this->load->view('header'); ?>

<div class="clsMinContent clearfix">

<?php $this->load->view('sidebar'); ?>
<!--MAIN-->
<div id="main">
      <!--POST JOB-->
      <?php $this->load->view('view_accountMenu'); ?>
      <div class="clsTabs clsInnerCommon clsInfoBox">
      
                            <div class="clsInnerCommon">
                              <h3><span class="clsHigh"><?php echo $this->lang->line('Deposit Funds');?></span></h3>
								<p><?php echo $this->lang->line('User name :');?><?php echo $this->lang->line('user_name'); ?><a href="<?php if($loggedInUser->role_id == '1') $res = 'owner'; else $res = 'employee'; echo site_url($res.'/viewprofile/'.$loggedInUser->id); ?>"> <?php echo $loggedInUser->user_name?></a></p>
								<p><?php echo $this->lang->line('Account Balance:');?> <?php echo $currency;?> <?php if(isset($userAvailableBalance)) echo $userAvailableBalance.'.00'; ?></p>
								<p><font color="#FF0000">The amount includes the paypal commission <?php echo $commission;?>%</font></p>
								  
									<form name="formPaypal" action="<?php echo $paymentGateways['paypal']['url']; ?>"  method="post">
									  <input type="hidden" name="cmd" value="_xclick">
									  <input type="hidden" name="business" value="<?php echo $paymentGateways['paypal']['mail_id']; ?>">
									  <input type="hidden" name="item_number" value="1">
									  <input type="hidden" name="item_name" value="<?php echo $this->config->item('site_name').'Account Deposit'; ?>">
									  <p><label><?php echo $this->lang->line('please confirm to this amount'); ?></label>
									  <input type="text" name ="amount" value="<?php echo $total_with_commission; ?>" readonly="yes" >
									  <input type="hidden" name="on0" value="0">
									   <input type="hidden" name ="custom" value="<?php echo $transactionId."#".$loggedInUser->user_name."#".$this->loggedInUser->email; ?>">
									  <input type="hidden" name="currency_code" value="<?php echo $currency_type; ?>">
									  <input type="hidden" name="notify_url" value="<?php echo  site_url('payment/paypalIpn'); ?>">
									  <input type="hidden" name="return" value="<?php echo  site_url('payment/paymentSuccess'); ?>">
									  <input type="hidden" name="cancel_return" value="<?php echo  site_url('deposit/cancel'); ?>">
									  <input type="submit" name"submit" class="clsLogin_but" value="<?php echo $this->lang->line('submit');?>"/></p>
									  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									 </form>
									<span style="float: right;left: -200px; position: relative; right: 0;top: -55px; width: 70px;"> <form name="confirm_amount" action="<?php echo site_url('deposit'); ?>" method="post">
										<input type="hidden" name ="amount" value="<?php echo $total; ?>" >
										<input type="hidden" name ="transactionId" value="<?php echo $transactionId; ?>" >
										<input type="submit" name="back" value="<?php echo $this->lang->line('Back');?>" class="clsLogin_but" />
									</form> </span>
									<br />
                            </div>
                         
      </div>
    </div>
	
	</div>	</div>
<?php $this->load->view('footer'); ?>