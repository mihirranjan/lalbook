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
	 <!--TOP TITLE & RESET-->
        <div class="clsTop clsClearFixSub">
		<div class="clsNav3">
          <ul>
            <li class="clsNoBorder"><a href="<?php echo admin_url('emailSettings/addemailSettings')?>"><?php echo $this->lang->line('add_email_settings'); ?></a></li>
          </ul>
		  <div class="clsTitle">
          <h3><?php echo $this->lang->line('Email Settings'); ?></h3>
        </div>  
    
      </div>
      <!--END OF TOP TITLE & RESET-->
     </div>
    <div class="clsMidWrapper clearfix">
      <!--MID WRAPPER-->
     
      
        <table class="table2" cellpadding="2" cellspacing="0" align="left">
		  <tr>
          <th><?php echo $this->lang->line('email_template_title'); ?></th>
		  <th><?php echo $this->lang->line('action'); ?></th></tr>
		        
		<?php
		   	if(isset($email_settings))
			{
				foreach($email_settings->result() as $email_setting)
				{ 
					
		?>
			 <tr>
			  <td><?php echo ucfirst($email_setting->title); ?></td>
		
			  <td><a href="<?php echo admin_url('emailSettings/edit/'.$email_setting->id)?>"><img src="<?php echo image_url('edit-new.png'); ?>" alt="Edit" title="Edit" height="" width=""/></a>
			  <a href="<?php echo admin_url('emailSettings/delete/'.$email_setting->id)?>"; onclick="return confirm('Are you sure want to delete??');"> <img height="" width="" src="<?php echo image_url('delete-new.png'); ?>" alt="Delete" width="8" title="Delete" />			  </a></td>
        	</tr>
        <?php
				}//Foreach End
			}//If End
		?>
		</table>
     
    </div>
    <!--END OF MID WRAPPER-->
	
	 </div></div></div></div></div></div></div></div></div></div>
	 
  </div>
  <!-- End of clsSettings -->
</div>
</div>
<!-- End Of Main -->
<?php $this->load->view('admin/footer'); ?>
