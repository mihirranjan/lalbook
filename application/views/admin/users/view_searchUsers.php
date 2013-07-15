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
				  
	<div class="clsTop clearfix">
          <div class="clsNav">
          <ul>
            <li><a href="<?php echo admin_url('users/searchUsers');?>"><b><?php echo $this->lang->line('Search'); ?></b></a></li>
			<li><a href="<?php echo admin_url('users/addUsers');?>"><b><?php echo $this->lang->line('Add users'); ?></b></a></li>
			<li class="clsNoBorder"><a href="<?php echo admin_url('users/viewUsers');?>"><b><?php echo $this->lang->line('View All'); ?></b></a></li>
          </ul>
        </div>
		<div class="clsTitle">
            <h3><?php echo $this->lang->line('Search User'); ?></h3>
        </div>
      </div>
	     <?php
			//Show Flash Message
			if($msg = $this->session->flashdata('flash_message'))
			{
				echo $msg;
			}
	  	?>
      <!--END OF TOP TITLE & RESET-->
      <div class="clsTable1">
		<table class="table" cellpadding="2" cellspacing="0">
		 <form name="searchTransaction" action="" method="post">
		     <tr><td><?php echo $this->lang->line('Username'); ?></td><td><input type="text" name="username" id="username" /><?php echo form_error('username'); ?></td></tr>
			    <tr><td></td><td>Or</td></tr>
			  <tr><td><?php echo $this->lang->line('Email'); ?></td><td><input type="text" name="email" id="email" /><?php echo form_error('email'); ?></td></td>
			<!--  <tr><td><?php echo $this->lang->line('user_type'); ?></td><td><select name="type" class="textbox" style="width:16%;">
                  <option value="1">Owner</option>
				  <option value="2">Employee</option>
                </select></td></tr>-->
			<tr><td></td><td><input type="submit" name="searchUsers" value="<?php echo $this->lang->line('search');?>" class="clsSubmitBt1" /></td></tr>
		 </form>
		 </table>
      </div>
	  <!--PAGING-->
	  	<?php if(isset($pagination_outbox)) echo $pagination_outbox;?>
	 <!--END OF PAGING-->
	 
	  </div></div></div></div></div></div></div></div></div></div>   
	 
    </div>
    <!--END OF MID WRAPPER-->
  </div>
  <!-- End of clsSettings -->
</div>
<!-- End Of Main -->
<?php $this->load->view('admin/footer'); ?>