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
	   <div class="clsTitle">
	 	<h3 align="left"><?php echo $this->lang->line('add_group'); ?></h3>
		</div>
		
      <table width="700" class="table">
	   <form method="post" action="<?php echo admin_url('skills/addGroup')?>">
         <tr><td>
          <?php echo $this->lang->line('group_name'); ?><span class="clsRed">*</span></td><td>
          <input class="clsTextBox" type="text" name="group_name" value="<?php echo set_value('group_name'); ?>"/>
          <?php echo form_error('group_name'); ?> </td></tr>
        <tr><td>
         <?php echo $this->lang->line('descritpion'); ?></td><td>
		  <textarea name="descritpion" class="clsTextArea"><?php echo set_value('descritpion'); ?></textarea>
          <?php echo form_error('descritpion'); ?> </td></tr>
        <tr><td></td><td>
		  <input type="hidden" name="operation" value="add" />
          <input type="submit" class="clsSubmitBt1" value="<?php echo $this->lang->line('submit'); ?>"  name="addGroup"/>
        </td></tr>
      </form>
	  </table>
	  
	  </div></div></div></div></div></div></div></div></div></div>
	  
	  
    </div>
  </div>
  <!-- End of clsSettings -->
</div>
<!-- End Of Main -->
<?php $this->load->view('admin/footer'); ?>
