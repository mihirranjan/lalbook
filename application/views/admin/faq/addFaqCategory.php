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
        </div>
		<div class="clsTitle">
          <h3>Add Faq Catagory<?php //echo $this->lang->line('Edit_bans'); ?></h3>
        </div>
      </div>
	     <?php
		//Show Flash Message
		if($msg = $this->session->flashdata('flash_message'))
		{
			echo $msg;
		}
	  ?>
	 	<!--<h3><?php echo $this->lang->line('add_group'); ?></h3>-->
		
		<table class="table" cellpadding="2" cellspacing="0">
		 <form method="post" action="<?php echo admin_url('faq/addFaqCategory')?>">
        <tr>
		    <td><?php echo $this->lang->line('faq_category_name'); ?><span class="clsRed">*</span></td>
		    <td><input class="clsTextBox" type="text" name="faq_category_name" value="<?php echo set_value('faq_category_name'); ?>"/><?php echo form_error('faq_category_name'); ?></td>
		</tr>
         <tr>
		    <td></td>
			<td> <input type="hidden" name="operation" value="add" />
              <input type="submit" class="clsSubmitBt1" value="<?php echo $this->lang->line('submit'); ?>"  name="addFaqCategory"/>
		    </td>
		</tr>		  

      </form>
	  </table>
	  
	   </div></div></div></div></div></div></div></div> </div></div> 
	  
    </div>
  </div>
  <!-- End of clsSettings -->
</div>
<!-- End Of Main -->
<?php $this->load->view('admin/footer'); ?>
