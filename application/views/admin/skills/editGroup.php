<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/sidebar'); ?>
<div id="main">
  <div class="clsSettings">
    <div class="clsMainSettings">
	
	 <div class="inner_t">
      <div class="inner_r">
        <div class="inner_b">
          <div class="inner_l">
            <div class="inner_tl">
              <div class="inner_tr">
                <div class="inner_bl">
                  <div class="inner_br"> 
	
      <?php
		//Show Flash Message
		if($msg = $this->session->flashdata('flash_message'))
		{
			echo $msg;
		}		
	  ?>
	  <?php
	  	//Content of a group
		if(isset($groups) and $groups->num_rows()>0)
		{
			$group = $groups->row();
	  ?>
	   <div class="clsTitle">
	 	<h3><?php echo $this->lang->line('edit_group'); ?></h3>
		</div>
		
       <table width="700" class="table">
		 <form method="post" action="<?php echo admin_url('skills/editGroup/'.$group->id)?>">
        <tr><td>
          <?php echo $this->lang->line('group_name'); ?><span class="clsRed">*</span></td><td>
          <input class="clsTextBox" type="text" name="group_name" value="<?php echo $group->group_name; ?>"/>
          <?php echo form_error('group_name'); ?> </td></tr>
        <tr><td>
          <?php echo $this->lang->line('descritpion'); ?></td><td>
		  <textarea name="descritpion" class="clsTextArea"><?php echo $group->descritpion; ?></textarea>
          <?php echo form_error('descritpion'); ?> </td></tr>
        <tr><td></td><td>
		  <input type="hidden" name="operation" value="edit" />
		  <input type="hidden" name="id"  value="<?php echo $group->id; ?>"/>
          <input type="submit" class="clsSubmitBt1" value="<?php echo $this->lang->line('submit'); ?>"  name="editGroup"/>
		  <a href="#" onclick="history.go(-1);return false;"><input type="button" value="Back"  class="clsSubmitBt1"></a> 
        </td></tr>
      </form>
	  </table>
	  <?php
	  }
	  ?>
	  
	  
	  </div></div></div></div></div></div></div></div>
	  
	  
    </div>
  </div>
  <!-- End of clsSettings -->
</div>
<!-- End Of Main -->
<?php $this->load->view('admin/footer'); ?>
