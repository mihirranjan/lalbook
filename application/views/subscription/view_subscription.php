<?php $this->load->view('header'); ?>
<div class="clsMinContent clearfix">
<?php $this->load->view('sidebar'); ?>
<!--MAIN-->
<script type="text/javascript">

     $(document).ready(function(){ 
	 
	   $("input[type='radio']").click(function(){ 
  	        var v1= $(this).val();
		    $("input[name=custom]").val(v1); //alert(v1);
			var splitamt = v1.split('#');
			var totcomamt= splitamt[3];//alert(totcomamt);
			$("input[name=amount]").val(totcomamt);
	    });
     });
</script>
<div id="main">
  <!--POST JOB-->
  <div class="clsInnerpageCommon">
  
                        <div class="clsInnerCommon">
                          <h2><?php echo $this->config->item('site_title'); ?> &nbsp;-<?php echo $this->lang->line('Subscription Methods'); ?></h2>
						  </div>
						        <?php 
						          if($msg = $this->session->flashdata('flash_message'))
									{
										echo $msg;
									}
								 ?>
						 <?php if(isset($validity) and $validity->num_rows()>0)
							{
								foreach($validity->result() as $valid)
								{ 
									$type = $valid->package_name;
									$date = $valid->updated_date;
								}
								
								//$days = ($date - strtotime(date("Y-m-d"))) / (60 * 60 * 24);
								
 								echo "<p>You currently subscribe the ".$type.".Your subscription will be expired in ".date('m/d/Y',$date).".</p>";
								 
							}else{
						  ?>
						  <form method="post" action="<?php echo $paymentGateways['paypal']['url']; ?>">
                          <table cellspacing="1" cellpadding="7" width="96%">
                            <tbody>
                              <tr>
                                <td width="" class="dt"></td>
                                <td width="" class="dt"><?php echo $this->lang->line('Subscription Type'); ?></td>
								 <td width="" class="dt"><?php echo $this->lang->line('Description'); ?></td>
                                 <td width="" class="dt"><?php echo $this->lang->line('Validity Days'); ?></td>
                                 <td width="" class="dt"><?php echo $this->lang->line('Amount'); ?></td>
                                  
                             <?php $i=0;
						 	if(isset($subscription) and $subscription->num_rows()>0)
							{
								foreach($subscription->result() as $sub)
								{ 
								$i=$i+1;
								if($i%2 == 0)
								  $class = 'dt1 dt0';
								else
								  $class = 'dt2 dt0'; 
								?>
                              <tr class="<?php echo $class; ?>">
                                
                                <td><input type="radio" id="subscribe" name="subscribe" value="<?php echo $sub->id.'#'.$sub->package_name.'#'.$sub->total_days.'#'.$sub->amount; ?>"/></td>
                                <td><?php echo $sub->package_name; ?></td>
								<td><?php echo $sub->description; ?></td>
								<td><?php echo $sub->total_days; ?></td>
                                <td><?php echo $sub->amount; ?></td>
                              </tr>
							  <!--<input type="hidden" name="subsval" value="<?php //echo $sub->id.'#'.$sub->type.'#'.$sub->validity.'#'.$sub->amount; ?>"/>-->
							  <?php }}?>
							  <tr>
								<input type="hidden" name="cmd" value="_xclick">
								<input type="hidden" name="business" value="<?php echo $paymentGateways['paypal']['mail_id']; ?>">
								<input type="hidden" name="item_number" value="1">
								<input type="hidden" name="item_name" value="<?php echo $this->config->item('site_name').'Subscription'; ?>">
								<input type="hidden" name ="amount" value="<?php //echo $total_with_commission; ?>" > 
								<input type="hidden" name="on0" value="0">
								<input type="hidden" name ="custom">
								<input type="hidden" name="currency_code" value="USD">
								<input type="hidden" name="notify_url" value="<?php echo  site_url('payment/paypalIpn'); ?>">
								<input type="hidden" name="return" value="<?php echo  site_url('subscription/success'); ?>">
								<input type="hidden" name="cancel_return" value="<?php echo  site_url('subscription'); ?>">
							  <td align="right" colspan="5"><input type="submit" name="subs" value="Subscribe" class="clsLogin_but"/></td>
							  </tr>
                             </tbody>
                          </table>
						   </form>
						   <?php }?>
                          <!--PAGING-->
                          <?php if(isset($pagination)) echo $pagination; ?>
                          <!--END OF PAGING-->
                        </div>
                      </div>

  <!--END OF POST JOB-->
</div>
	</div></div
><!--END OF MAIN-->
<?php $this->load->view('footer'); ?>