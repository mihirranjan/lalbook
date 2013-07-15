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
      <h3><span class="clsInvoice"><?php echo $this->lang->line('add_faq'); ?></span></h3>
	  </div>
	  
      <table class="table" cellpadding="2" cellspacing="0">
	  <form method="post" action="<?php echo admin_url('faq/addFaq')?>">
       <tr><td  width="40%">
         <?php echo $this->lang->line('faq_category'); ?><span class="clsRed">*</span></td><td>
          <select name="faq_category_id" class="usertype">
		  	<option value="" <?php echo set_select('faq_category_id', '', TRUE); ?>><?php echo $this->lang->line('select_category'); ?></option>
			<?php
				if(isset($faqCategories) and $faqCategories->num_rows()>0)
				{
					foreach($faqCategories->result() as $faqCategory)
					{
			?>
						<option value="<?php echo $faqCategory->id; ?>" <?php echo set_select('faq_category_id',$faqCategory->id); ?> ><?php echo $faqCategory->category_name; ?></option>
       		<?php
					}//Foreach End
				}//If End
			?>
		  </select></td></tr>
          <?php echo form_error('faq_category_id'); ?> </p>
       <tr><td>
          <?php echo $this->lang->line('question'); ?><span class="clsRed">*</span></td><td>
		  <textarea class="clsTextArea" name="question"><?php echo set_value('question'); ?></textarea>
          <?php echo form_error('question'); ?> <br />
       </td></tr>
	   <tr><td>
          <?php echo $this->lang->line('answer'); ?><span class="clsRed">*</span></td><td>
		  <textarea class="clsTextArea" name="answer"><?php echo set_value('answer'); ?></textarea>
          <?php echo form_error('answer'); ?> <br />
       </td></tr>
	   <tr><td>
          <?php echo $this->lang->line('Is frequently asked question?');?></td><td>
		  <input  style="position:relative; top:7px;* top:2px;" name="is_frequent" class="clsNoborder" value="Y" type="checkbox" <?php echo set_checkbox('is_frequent', 'Y'); ?>/> <span style="padding-left:5px;"><?php echo $this->lang->line('Yes');?></span>
       </td></tr>
        <tr><td></td><td>
          <input class="clsSubmitBt1" value="<?php echo $this->lang->line('Submit');?>" name="addFaq" type="submit">
		</td></tr>  

      </form>
	  </table>
	  
	  </div></div></div></div></div></div></div></div> </div></div>
	  
    </div>
  </div>
</div>
<?php $this->load->view('admin/footer'); ?>
