<?php $this->load->view('header'); ?>
<div class="clsMinContent clearfix">
<?php $this->load->view('sidebar'); ?>
<div id="main">
      <!--POST JOB-->
     <?php $this->load->view('view_accountMenu');?>
      <div class="clsTabs clsInnerCommon">
     
				<div class="clsEditProfile clsSitelinks">
				 <h3><span class="clsOptContact"><?php echo $this->lang->line('Invoice Report');
				 $condition1=array('subscriptionuser.username'=>$loggedInUser->id);
					$certified1= $this->credential_model->getCertificateUser($condition1);  
				  ?></span></h3>
				  <p class="clsSitelinks"><span><?php echo $this->lang->line('User name');?> :</span><a class="glow" href="<?php if($loggedInUser->role_id == '1') $res = 'owner'; else $res = 'employee'; echo site_url($res.'/viewprofile/'.$loggedInUser->id); ?>"> <?php echo $loggedInUser->user_name?></a>
				  <?php if(count($certified1->result())>0)
					{?>
					<img src="<?php echo image_url('certified.gif');?>" />
					<?php }?>
				  </p>
					<p><span><?php echo $this->lang->line('Account Balance:');?></span> <?php echo $currency;?> <?php if(isset($userAvailableBalance)) echo $userAvailableBalance.'.00'; ?></p>
				 
					<?php
					$userInfo = $loggedInUser;
					
					$res = $invoiceJob->num_rows();
					if($res <= 0)
					  {
						 echo '<p><b style="color:red;">'.$this->lang->line('There is no payment is closed to view Invoice').'</b></p>';
					  }
					else {  
					?> 
			
				<form name="invoice_form" action="<?php echo site_url('job/invoicePdf'); ?>" method="post">
				<!--<p><span><?php echo $this->lang->line('Job') ?></span>
				  <select  multiple="multiple" name="project_name[]" size="5"> <?php 
					//pr($postSimilar->result());
					foreach($invoiceJob->result() as $res)
					 { 
					   if($res->job_status == '2')      
						 { ?>
							<option><?php echo $res->id.'--'.$res->job_name;?></option> <?php 
						 }
					 }	  ?>
				  </select>
				</p>
				<p><span>&nbsp;</span><?php echo $this->lang->line('You can select multiple jobs by holding down the CTRL key') ?></p>
				<p><span><?php echo $this->lang->line('To') ?></span><textarea rows="10" cols="30" name="user_name"><?php echo $loggedInUser->user_name; ?></textarea></p>
				<p><span>&nbsp;</span><?php echo $this->lang->line('Your name and address') ?></p>
				<p><span><?php echo $this->lang->line('Invoice No') ?></span>   <input type="text" name="invoice_no" value=""/> <?php echo $this->lang->line('Optional') ?></p>
				<p><span>&nbsp;</span>-->
				<table width="98%" cellpadding="5" cellspacing="0">
				<tr>
					<td class="dt" width="5%"><?php echo $this->lang->line('S No.'); ?></td>
					<td class="dt" width="20%"><?php echo $this->lang->line('Job Name'); ?></td>
					<td class="dt" width="15%"><?php echo $this->lang->line('Posted By'); ?></td>
					<td class="dt" width="10%"><?php echo $this->lang->line('Total Bid Amount'); ?></td>
					<td class="dt" width="15%"><?php echo $this->lang->line('Bid Won By'); ?></td>
					<td class="dt" width="15%"><?php echo $this->lang->line('Bid Created'); ?></td>
					<td class="dt" width="10%"><?php echo $this->lang->line('Amount Remaining'); ?></td>
					<td class="dt" width="8%"><?php echo $this->lang->line('Invoice'); ?></td>
				</tr>
				<tr>
				<?php 
					//pr($invoiceJob->result());
					$i=1;
					foreach($invoiceJob->result() as $res)
					 { 
					   if($res->job_status == '2')      
						 { ?>
							<td><?php echo $i;?></td>
							<td><?php echo $res->job_name;?></td>
							<td><?php $creator_id=getUserinformation($res->creator_id);echo ucfirst($creator_id->user_name); ?> </td>
							<td><?php echo $res->bid_amount;?></td>
							<td><?php $won_id=getUserinformation($res->employee_id);echo ucfirst($won_id->user_name);?></td>
							<td><?php echo get_date($res->bid_time);?></td>
							<?php 
							$received_amt='';
							$trans=$this->db->query("select * from transactions where type='Escrow Transfer' and owner_id='$res->creator_id' and employee_id='$res->employee_id' and status='Completed'");
							foreach($trans->result() as $amt){
								$received_amt += $amt->amount;
 							}
							
							$rem_amt =	$res->bid_amount - $received_amt;						
							
							?>
							<td><?php if($received_amt<$res->bid_amount) echo $rem_amt; else echo 'Completed';?></td>
							<td><a class="clsLogin_but"  style="display:block;border:none!important;margin:0;height:30px;line-height:30px;text-decoration:none;" href="<?php echo site_url('job/invoicePdf/'.$res->id.'/'.urlencode($res->job_name).'/'.$res->creator_id.'/'.$res->bid_amount.'/'.$res->employee_id.'/'.$res->bid_time.'/'.$rem_amt );?>" target="_blank"><?php echo $this->lang->line('Invoice'); ?></a></td>
							 <?php 
						 }$i++;
					 }	  ?>
				</table>
				  <!--<input type="submit" value="<?php echo $this->lang->line('Submit');?>" name="invoice" class="clsSmall"/>-->
				</p>
				</form>
				<?php } ?>
				</div>
     
        
      </div>
      <!--END OF POST JOB-->
    </div>
<!--END OF MAIN-->
</div></div>
<?php $this->load->view('footer'); ?>
