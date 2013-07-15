<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/sidebar'); ?>

<div id="main">
  <div class="clsSettings">
    <div class="clsMainSettings">
	
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
	
      <?php
			//Show Flash Message
			if($msg = $this->session->flashdata('flash_message'))
			{
				echo $msg;
			}
	  	?>
		<div class="clsTop clsClearFixSub">
          <div class="clsNav">
          <ul>
          <!-- <li><a href="<?php echo admin_url('packages/addsubscriptionpayment');?>"><b><?php echo $this->lang->line('Add Subscription Payment'); ?></b></a></li>-->
			<li><a href="<?php echo admin_url('packages/searchSubscriptionpayment');?>"><?php echo $this->lang->line('Search Subscription Payment'); ?></a></li>
			<li class="clsNoBorder"><a href="<?php echo admin_url('packages/viewsubscriptionpayment');?>"><?php echo $this->lang->line('View subscription Payment'); ?></a></li>
          </ul>
        </div>
		<div class="clsTitle">
          <h3><?php echo $this->lang->line('View subscription Payment'); ?></h3>
        </div>
		
      </div>
	  
      
       <table width="700" class="table">
        <thead>
		  <tr>
		    <th><?php echo $this->lang->line('Userid');?></th>
			<th><?php echo $this->lang->line('Username');?></th>
			<th><?php echo $this->lang->line('Package Name');?></th>
            <th><?Php echo $this->lang->line('Validity');?></th>
           
			<th><?php echo $this->lang->line('Amount');?></th>
			
			
          <!--  <th colspan="2"><span class="functions text-center" id="tip" style="opacity: 1;"> </span></th>-->
          </tr>
        </thead>
        <tbody>
		
	<form action="<?php echo admin_url('packages/managesubscriptionuser'); ?>" name="managePackage" id="managePackage" method="post" >
		<?php $no=1;

		if(isset($subscription_payment) and $subscription_payment->num_rows()>0)
		{
		foreach($subscription_payment->result() as $subscriberdetails)
			{
			
		?>
          <tr>
		    <td><?php echo $subscriberdetails->id;?></td>
			<td><?php echo $subscriberdetails->user_name;?></td>
            <td><?php echo $subscriberdetails->package_name;?></td>
			<td><?php echo $subscriberdetails->total_days;?></td>
			
			<td><?php echo $subscriberdetails->amount;?></td>
          </tr>
		  <?php }
		  }
		
		  else{ ?>
		   <tr>
            <td colspan="5"><?php echo $this->lang->line('No packages found');?></td></tr>
		  <?php }
		  ?>
        </tbody>
      </table>
	
	    <div class="clscenter clearfix">
	  <div id="selLeftAlign">
    </div>
  </div>
  <?php if(isset($pagination)) echo $pagination;?>
</div>

	 </div></div></div></div></div></div></div></div> </div></div> 
	    </div>
    
    </div>
<?php $this->load->view('admin/footer'); ?>

<script type="text/javascript">
function formSubmit()
{
	document.managePackage.submit();
	//document.manageBids.action='<?php //echo admin_url('skills/manageBids'); ?>'; document.manageBids.submit();
}