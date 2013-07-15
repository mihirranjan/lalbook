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
      <div class="clsNav">
		<ul>
			<li class="clsNoBorder"><a href="<?php echo admin_url('siteSettings/dbBackup')?>"><?php echo $this->lang->line('db_backup');?></a></li>
		</ul>
      </div>
	  <div class="clsTitle">
	   <h3 align="left"><?php echo $this->lang->line('website_settings'); ?></h3>
	   </div>
	  
		 <form action="<?php echo admin_url('siteSettings'); ?>" method="post" enctype="multipart/form-data">
		 <table class="table1" cellpadding="2" cellspacing="0">
		<tbody>
       <tr>
          <td class="clsName"><?php echo $this->lang->line('website_title'); ?><span class="clsRed">*</span></td>
          <td class="clsMailIds"><input class="clsTextBox" type="text" name="site_title" value="<?php if(isset($settings['SITE_TITLE'])) echo $settings['SITE_TITLE']; ?>"   />
          <?php echo form_error('site_title'); ?></td></tr>
       <tr>
         <td><?php echo $this->lang->line('website_slogan'); ?><span class="clsRed">*</span></td>
          <td><input class="clsTextBox" type="text" name="site_slogan" value="<?php if(isset($settings['SITE_SLOGAN'])) echo $settings['SITE_SLOGAN']; ?>" />
          <?php echo form_error('site_slogan'); ?></td></tr>
		  <tr>
         <td><?php echo $this->lang->line('site_url'); ?><span class="clsRed">*</span></td>
          <td><input class="clsTextBox" type="text" name="base_url" value="<?php if(isset($settings['BASE_URL'])) echo $settings['BASE_URL']; ?>"  />
          <?php echo form_error('base_url'); ?> </td></tr>
		<tr>
          <td><?php echo $this->lang->line('website_admin_mail'); ?><span class="clsRed">*</span></td>
           <td><input class="clsTextBox" type="text" name="site_admin_mail" value="<?php if(isset($settings['SITE_ADMIN_MAIL'])) echo $settings['SITE_ADMIN_MAIL']; ?>"  />
          <?php echo form_error('site_admin_mail'); ?></td></tr>  
        <tr>
		<!-- <INPUT TYPE="hidden" NAME="site_language" value='<?php //if(isset($settings['LANGUAGE_CODE'])) echo $settings['LANGUAGE_CODE']; ?>'> -->
		<tr>
          <td><?php echo $this->lang->line('language code'); ?><span class="clsRed">*</span></td>
           <td><input class="clsTextBox" type="text" name="site_language" value="<?php if(isset($settings['LANGUAGE_CODE'])) echo $settings['LANGUAGE_CODE']; ?>"  />
          <?php echo form_error('language_code'); ?></td></tr>  
        <tr> 
		
          <td><?php echo $this->lang->line('website_closed'); ?><span class="clsRed">*</span></td>
           <td><input type="radio"  class="clsRadioBut" name="site_status"  value="1" <?php if(isset($settings['SITE_STATUS']) and $settings['SITE_STATUS']==1)  echo 'checked="checked"'; ?>  />
          <?php echo $this->lang->line('On');?>
          <input type="radio" name="site_status" class="clsRadioBut"  value="0"<?php if(isset($settings['SITE_STATUS']) and $settings['SITE_STATUS']==0)  echo 'checked="checked"';   ?>  />
          <?php echo $this->lang->line('Off');?></td></tr>
        <tr>
          <td><?php echo $this->lang->line('closed_message'); ?><span class="clsRed">*</span></td>
          <td><textarea class="clsTextArea" name="offline_message"><?php if(isset($settings['OFFLINE_MESSAGE'])) echo $settings['OFFLINE_MESSAGE']; ?> 
</textarea>
          <?php echo form_error('offline_message'); ?> </td></tr>
		  
       <tr>
          <td><?php echo $this->lang->line('Forced Escrow'); ?><span class="clsRed">*</span></td>
         <td><input type="radio"  class="clsRadioBut" name="forced_escrow"  value="1"  <?php if(isset($settings['FORCED_ESCROW']) and $settings['FORCED_ESCROW']==1)  echo 'checked="checked"'; ?>/>
          <?php echo $this->lang->line('Yes');?>
          <input type="radio" name="forced_escrow" class="clsRadioBut" value="0"<?php if(isset($settings['FORCED_ESCROW']) and $settings['FORCED_ESCROW']==0)  echo 'checked="checked"'; ?>/>
          <?php echo $this->lang->line('No');?></td>
		  </tr>
		 <!-- <tr>
          <td><?php echo $this->lang->line('currency type'); ?><span class="clsRed">*</span></td>
          <td><select name="currency">
		  <?php if(isset($currency) and count($currency->num_rows)>0){ foreach($currency->result() as $curr){ ?>
		  <option value="<?php echo $curr->currency_type;?>" <?php if($settings['CURRENCY_TYPE']==$curr->currency_type) echo 'selected="selected"'; ?>><?php echo $curr->currency_name; ?></option>
		  <?php }} ?>
		  </select>
          <?php echo form_error('payment_settings'); ?></td>
		  </tr>	
		  <tr>
          <td><?php echo $this->lang->line('min_balance'); ?><span class="clsRed">*</span></td>
          <td><input class="clsTextBox" type="text" name="payment_settings" value="<?php if(isset($settings['PAYMENT_SETTINGS'])) echo $settings['PAYMENT_SETTINGS']; ?>"/>
          <?php echo form_error('payment_settings'); ?></td></tr>
       <tr>
		   <td><?php echo $this->lang->line('featured_jobs_limit'); ?><span class="clsRed">*</span></td>
          <td><input class="clsTextBox" type="text" name="featured_jobs_limit" value="<?php if(isset($settings['FEATURED_PROJECTS_LIMIT'])) echo $settings['FEATURED_PROJECTS_LIMIT']; ?>"/>
          <?php echo form_error('featured_jobs_limit'); ?></td></tr>
       <tr>
          <td><?php echo $this->lang->line('urgent_jobs_limit'); ?><span class="clsRed">*</span></td>
         <td> <input class="clsTextBox" type="text" name="urgent_jobs_limit" value="<?php if(isset($settings['URGENT_PROJECTS_LIMIT'])) echo $settings['URGENT_PROJECTS_LIMIT']; ?>"/>
          <?php echo form_error('urgent_jobs_limit'); ?></td></tr>
       <tr>
          <td><?php echo $this->lang->line('latest_jobs_limit'); ?><span class="clsRed">*</span></td>
          <td><input class="clsTextBox" type="text" name="latest_jobs_limit" value="<?php if(isset($settings['LATEST_PROJECTS_LIMIT'])) echo $settings['LATEST_PROJECTS_LIMIT']; ?>"/>
          <?php echo form_error('latest_jobs_limit'); ?></td></tr>
        <tr>
          <td><?php echo $this->lang->line('employee_commission_amount'); ?><span class="clsRed">*</span></td>
         <td> <input class="clsTextBox" type="text" name="employee_commission_amount" value="<?php if(isset($settings['PROVIDER_COMMISSION_AMOUNT'])) echo $settings['PROVIDER_COMMISSION_AMOUNT']; ?>"/>
          <?php echo form_error('employee_commission_amount'); ?></td></tr>
       <tr>
          <td><?php echo $this->lang->line('featured_jobs_amount'); ?><span class="clsRed">*</span></td>
         <td> <input class="clsTextBox" type="text" name="featured_jobs_amount" value="<?php if(isset($settings['FEATURED_PROJECT_AMOUNT'])) echo $settings['FEATURED_PROJECT_AMOUNT']; ?>"/>
          <?php echo form_error('featured_jobs_amount'); ?></td></tr>
      <tr>
          <td><?php echo $this->lang->line('urgent_jobs_amount'); ?><span class="clsRed">*</span></td>
          <td><input class="clsTextBox" type="text" name="urgent_jobs_amount" value="<?php if(isset($settings['URGENT_PROJECT_AMOUNT'])) echo $settings['URGENT_PROJECT_AMOUNT']; ?>"/>
          <?php echo form_error('urgent_jobs_amount'); ?></td>
		 <tr>
          <td><?php echo $this->lang->line('joblist_jobs_amount'); ?><span class="clsRed">*</span></td>
          <td><input class="clsTextBox" type="text" name="joblist_jobs_amount" value="<?php if(isset($settings['JOBLISTING_PROJECT_AMOUNT'])) echo $settings['JOBLISTING_PROJECT_AMOUNT']; ?>"/>
          <?php echo form_error('joblist_jobs_amount'); ?></td></tr>
		  
          <tr>
          <td><?php echo $this->lang->line('Joblist_validity_days'); ?><span class="clsRed">*</span></td>
          <td><input class="clsTextBox" type="text" name="joblist_validity_days" value="<?php if(isset($settings['JOBLIST_VALIDITY_LIMIT'])) echo $settings['JOBLIST_VALIDITY_LIMIT']; ?>"/>
          <?php echo form_error('joblist_validity_days'); ?></td></tr>
		  		  
		   
       <tr>
          <td><?php echo $this->lang->line('hide_jobs_amount'); ?><span class="clsRed">*</span></td>
          <td><input class="clsTextBox" type="text" name="hide_jobs_amount" value="<?php if(isset($settings['HIDE_PROJECT_AMOUNT'])) echo $settings['HIDE_PROJECT_AMOUNT']; ?>"/>
          <?php echo form_error('hide_jobs_amount'); ?></td></tr>
		  
		  
		   <tr>
          <td><?php echo $this->lang->line('private_job_amount'); ?><span class="clsRed">*</span></td>
          <td><input class="clsTextBox" type="text" name="private_job_amount" value="<?php if(isset($settings['PRIVATE_PROJECT_AMOUNT'])) echo $settings['PRIVATE_PROJECT_AMOUNT']; ?>"/>
          <?php echo form_error('private_job_amount'); ?></td>
		  </tr>

		 <tr>
          <td><?php echo $this->lang->line('featured_jobs_amount for certificate member'); ?><span class="clsRed">*</span></td>
         <td> <input class="clsTextBox" type="text" name="featured_jobs_amount_cm" value="<?php if(isset($settings['FEATURED_PROJECT_AMOUNT_CM'])) echo $settings['FEATURED_PROJECT_AMOUNT_CM']; ?>"/>
          <?php echo form_error('featured_jobs_amount_cm'); ?></td></tr>
      <tr>
          <td><?php echo $this->lang->line('urgent_jobs_amount for certificate member'); ?><span class="clsRed">*</span></td>
          <td><input class="clsTextBox" type="text" name="urgent_jobs_amount_cm" value="<?php if(isset($settings['URGENT_PROJECT_AMOUNT_CM'])) echo $settings['URGENT_PROJECT_AMOUNT_CM']; ?>"/>
          <?php echo form_error('urgent_jobs_amount_cm'); ?></td>
		 
       <tr>
          <td><?php echo $this->lang->line('hide_jobs_amount for certificate member'); ?><span class="clsRed">*</span></td>
          <td><input class="clsTextBox" type="text" name="hide_jobs_amount_cm" value="<?php if(isset($settings['HIDE_PROJECT_AMOUNT_CM'])) echo $settings['HIDE_PROJECT_AMOUNT_CM']; ?>"/>
          <?php echo form_error('hide_jobs_amount_cm'); ?></td></tr>
		  
		  
		   <tr>
          <td><?php echo $this->lang->line('private_job_amount for certificate member'); ?><span class="clsRed">*</span></td>
          <td><input class="clsTextBox" type="text" name="private_jobs_amount_cm" value="<?php if(isset($settings['PRIVATE_PROJECT_AMOUNT_CM'])) echo $settings['PRIVATE_PROJECT_AMOUNT_CM']; ?>"/>
          <?php echo form_error('private_jobs_amount_cm'); ?></td></tr> -->
		  
       <tr>
          <td><?php echo $this->lang->line('file_manager_limit'); ?><span class="clsRed">*</span></td>
          <td><input class="clsTextBox" type="text" name="file_manager_limit" value="<?php if(isset($settings['USER_FILE_LIMIT'])) echo $settings['USER_FILE_LIMIT']; ?>"/>
          <?php echo form_error('file_manager_limit'); ?></td>
        <tr>
		<tr>

          <td><?php echo $this->lang->line('Twitter Username'); ?></td>

          <td><input class="clsTextBox" type="text" name="twitter_username" value="<?php if(isset($settings['TWITTER_USERNAME'])) echo $settings['TWITTER_USERNAME']; ?>"/>

          <?php echo form_error('twitter_username'); ?></td>

        <tr>

		<tr>

          <td><?php echo $this->lang->line('Twitter Password'); ?></td>

          <td><input class="clsTextBox" type="text" name="twitter_password" value="<?php if(isset($settings['TWITTER_PASSWORD'])) echo $settings['TWITTER_PASSWORD']; ?>"/>

          <?php echo form_error('twitter_password'); ?></td>

        <tr>
		<tr>

          <td><?php echo $this->lang->line('Facebook'); ?></td>

          <td><input class="clsTextBox" type="text" name="facebook" value="<?php if(isset($settings['FACEBOOK'])) echo $settings['FACEBOOK']; ?>"/>

          <?php echo form_error('facebook'); ?></td>

        <tr>
		<tr>

          <td><?php echo $this->lang->line('Twitter'); ?></td>

          <td><input class="clsTextBox" type="text" name="twitter" value="<?php if(isset($settings['TWITTER'])) echo $settings['TWITTER']; ?>"/>

          <?php echo form_error('twitter'); ?></td>

        <tr>
		<tr>

          <td><?php echo $this->lang->line('RSS'); ?></td>

          <td><input class="clsTextBox" type="text" name="rss" value="<?php if(isset($settings['RSS'])) echo $settings['RSS']; ?>"/>

          <?php echo form_error('rss'); ?></td>

        <tr>
		<tr>

          <td><?php echo $this->lang->line('LinkedIn'); ?></td>

          <td><input class="clsTextBox" type="text" name="linkedin" value="<?php if(isset($settings['LINKEDIN'])) echo $settings['LINKEDIN']; ?>"/>

          <?php echo form_error('linkedin'); ?></td>

        <tr>
        <td></td>
          <td><input class="clsSubmitBt1" value="<?php echo $this->lang->line('Submit');?>" name="siteSettings" type="submit">
        </td>
      <!--</form>-->
	  </tr>
	  </tbody></table>
	  </form>
	  </div></div></div></div></div></div></div></div></div></div>
	 
    </div>
  </div>
</div>


<?php $this->load->view('admin/footer'); ?>
