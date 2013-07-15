<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/sidebar'); ?>
<script type="text/javascript" src="<?php echo base_url() ?>app/js/datetimepicker.js"></script>

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
	   //if(isset($usersList)) pr($usersList);
		//Show Flash Message
		if($msg = $this->session->flashdata('flash_message'))
		{
			echo $msg;
		}
	  ?>
  
    <div class="clsMidWrapper">
      <!--MID WRAPPER-->
      <!--TOP TITLE & RESET-->
      <div class="clsTop clsClearFixSub">
        
        <div class="clsNav">
          <ul>
           <li><a href="<?php echo admin_url('packages/searchSubscriptionpayment');?>"><?php echo $this->lang->line('Search Subscription Payment'); ?></a></li>
			<li class="clsNoBorder"><a href="<?php echo admin_url('packages/viewsubscriptionpayment');?>"><?php echo $this->lang->line('View subscription Payment'); ?></a></li>
          </ul>
        </div>
		<div class="clsTitle">
          <h3><?php echo $this->lang->line('Search Subscription Payment'); ?></h3>
        </div>
      </div>
      <!--END OF TOP TITLE & RESET-->
	 
      <div class="clsTab">
	  <table class="table" cellpadding="2" cellspacing="0">
		 <form name="searchPackage" action="<?php echo admin_url('packages/searchSubscriptionpayment');?>" method="post">
		    
		     <tr><td class="clsName"><?php echo $this->lang->line('username'); ?></td><td class="clsMailIds"> <input type="Text" id="username" name="username" maxlength="20" size="20"></td>
			 </tr>
			 <tr><td></td><td><input type="submit" name="searchUsers" value="<?php echo $this->lang->line('search');?>" class="clsSubmitBt1" /></td></tr>
		 </form>
	  </table>	 
      </div>
	  <!--PAGING-->
	  	<?php if(isset($pagination_outbox)) echo $pagination_outbox;?>
	 <!--END OF PAGING-->
    </div>
    <!--END OF MID WRAPPER-->
	
	 </div></div></div></div></div></div></div></div></div></div> 
    
    </div>
  </div>
  <!-- End of clsSettings -->
</div>
<!-- End Of Main -->
<?php $this->load->view('admin/footer'); ?>
