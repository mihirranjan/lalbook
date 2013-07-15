<?php $this->load->view('header'); ?>
<div class="clsMinContent clearfix">
<?php $this->load->view('sidebar'); ?>
<style>
.clsInnerCommon form p {
    padding-left:1em !important;
}
</style>
<!--MAIN-->
<?php
$userData = $userInfo->row();
?>
  <div id="main">
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
   
                            <div class="clsInnerCommon clsFormSpan"> 
                              <h2><?php echo $this->lang->line('edit_account'); ?></h2>
                             
							   <form method="post" action="<?php echo site_url('owner/editProfile/'.$userData->activation_key) ;  ?>" enctype="multipart/form-data">
							   
						        <p><span><?php echo $this->lang->line('username'); ?>:</span>&nbsp;<?php echo $userData->user_name; ?></p>
                              <p><span><?php echo $this->lang->line('pick_password'); ?>:</span>
                                <input type="password" size="25"  name="pwd" value=""/> <?php if(form_error('pwd')) { echo form_error('pwd'); echo '<br>'; } ?>
                              </p>
							  <p><?php if(form_error('name')) { echo '<span>&nbsp;</span>'; echo form_error('name'); echo ''; }?></p>							  
                              <p><span><?php echo $this->lang->line('name/company'); ?></span>
									<input type="text" size="25" value="<?php echo $userData->name; ?>" name="name" />
                              </p>
                              <p class="clsPTB0"><span>&nbsp;</span><small><?php echo $this->lang->line('disp_others'); ?></small></p>
                              <p><span><?php echo 'Email Address'; ?>:</span>
								 <input type="text" size="25" value="<?php echo $userData->email; ?>" name="email" />
						      </p>
                              <p class="clsPTB0"><span>&nbsp;</span><small><?php echo $this->lang->line('disp_others'); ?></small></p>
		
                                <h3><span class="clsOptContact"><?php echo 'optional contact details'; ?> <?php echo $this->lang->line('(');?><a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'"><?php echo $this->lang->line('privacy_policy'); ?></a><?php echo $this->lang->line(')');?> </span></h3>
									 <div id="light" class="white_content"> 
		<div style="border-bottom: 2px solid rgb(232, 232, 232);"><span class="clsClose"><a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'" >
		<img src="<?php echo image_url('blacklist.png'); ?>" />
		</a></span>
		
		<?php if(isset($page_content) and $page_content->num_rows()>0)
			{
			foreach($page_content->result() as $page) { echo '<p style="padding:0 0 5px !important;"><b>'.$page->page_title.'</b></p></div><div class="ClsPrivacyDesc">'.$page->content.'</div>';}	} ?> </div>
		 <div id="fade" class="black_overlay"></div> 
									 <p>
										<span> <?php echo $this->lang->line('MSN:');?></span> 
										  <input type="text" name="contact_msn" value="<?php if(isset($userContact->msn)) echo $userContact->msn ;?>" size="25"/>
									  </p>
									 
									  <p>
										<span> <?php echo $this->lang->line('Gtalk:');?></span> 
										  <input name="contact_gtalk" type="text" id="contact_gtalk" value="<?php if(isset($userContact->gtalk)){echo $userContact->gtalk; }?><?php echo set_value('contact_gtalk');?>" size="25"/>
									  </p>
									  <p>
										 <span > <?php echo $this->lang->line('Yahoo:');?></span> 
										  <input name="contact_yahoo" type="text" id="contact_yahoo" value="<?php if(isset($userContact->yahoo)){echo $userContact->yahoo; }?><?php echo set_value('contact_yahoo');?>" size="25"/>
									  </p>
									  <p>
										 <span > <?php echo $this->lang->line('Skype:');?></span> 
										  <input type="text" name="contact_skype" value="<?php if(isset($userContact->skype)){echo $userContact->skype; }?><?php echo set_value('contact_skype');?>" size="25"/>
										 
									  </p>
									
                        
								<p><span><?php echo $this->lang->line('your_profile_op'); ?></span>
								  <textarea rows="10" name="profile" cols="50"><?php echo $userData->profile_desc; ?></textarea> 
								  <?php echo form_error('profile'); ?>
								</p>  
								
                                <p><span><?php echo $this->lang->line('your_pic_logo'); ?></span>
								
								  <input type="file" name="logo"/>
								  <small><?php echo $this->lang->line('max_bytes'); ?></small> <?php echo form_error('logo'); ?>
								</p>
								<p><span><?php echo $this->lang->line('Current Photo'); ?> : </span>
								<?php if($userData->logo){?>
                                  <img src="<?php echo uimage_url(get_thumb($userData->logo));?>"/>
								  <a href="<?php echo site_url('employee/removePhoto/'.$userData->id."/1");?>" onclick="return confirm('Do you want to delete this image?');"><img src="<?php echo image_url('delete.png');?>" border="0" alt="delete" title="delete"/></a>
                                  <?php } 
								  else
								  echo '<img src="'.image_url('noImage.jpg').'" width="49" height="48" />';
								  ?></p>
                                <p><span><?php echo $this->lang->line('new_job_noti'); ?></span>
														
                                  <select name="notify_project" size="1">
									 <option value="">None</option>
									  <option value="Instantly" <?php echo set_select('notify_project', 'Instantly'); ?> <?php if($userData->job_notify=='Instantly') echo 'selected="selected"'; ?>>Instantly</option>
									  <option value="Hourly" <?php echo set_select('notify_project', 'Hourly'); ?> <?php if($userData->job_notify=='Hourly') echo 'selected="selected"'; ?>>Hourly</option>
									  <option value="Daily" <?php echo set_select('notify_project', 'Daily'); ?> <?php if($userData->job_notify=='Daily') echo 'selected="selected"'; ?>>Daily</option>
									 
								  </select> <?php echo form_error('notify_project'); ?></p>
		                        
                                <p><span><?php echo $this->lang->line('new_message_noti'); ?></span>
								
								 <select name="notify_message" size="1">
								  <option value="">None</option>
								  <option value="Instantly"  <?php echo set_select('notify_message', 'Instantly'); ?><?php if($userData->message_notify=='Instantly') echo 'selected="selected"'; ?>>Instantly</option>
								  <option value="Hourly" <?php echo set_select('notify_message', 'Hourly'); ?> <?php if($userData->message_notify=='Hourly') echo 'selected="selected"'; ?>>Hourly</option>
								  <option value="Daily"  <?php echo set_select('notify_message', 'Daily'); ?><?php if($userData->message_notify=='Daily') echo 'selected="selected"'; ?>>Daily</option> 
							     </select>  <?php echo form_error('notify_message'); ?>
                                </p>
								
								
                              <p> <span><?php echo $this->lang->line('country'); ?></span>
							  
                                <select name="country" size="1">
									<option value="">None</option>
									<?php
										if(isset($countries) and $countries->num_rows()>0)
										{
											foreach($countries->result() as $country)
											{
									?>
											<option value="<?php echo $country->country_symbol; ?>" <?php echo set_select('country', $country->country_symbol); ?><?php if($userData->country_symbol==$country->country_symbol) echo 'selected="selected"'; ?> ><?php echo $country->country_name; ?></option>
									<?php
												}//Foreach End
											}//If End
										?>
							  </select> <?php echo form_error('country_symbol'); ?></p>
							  <p><span><?php echo $this->lang->line('state/province'); ?></span>
                                 <input type="text" name="state" value="<?php echo $userData->state; ?><?php echo set_value('state'); ?>" maxlength="50" size="30"/></p>
							  <p> <span><?php echo $this->lang->line('city'); ?></span>
							      <input type="text" name="city" value="<?php echo $userData->city; ?><?php echo set_value('city'); ?>" maxlength="50" size="25"/>
							  </p>	  
							 
                              <!--<p><span>&nbsp;</span><input type="checkbox" name="signup_agree_contact" value="1" <?php echo set_checkbox('signup_agree_contact', '1'); ?>/ >
									<?php echo $this->lang->line('Display my own status.');?></span>
								  <?php echo form_error('signup_agree_contact'); ?>
							   </p>-->
								  
                              <p><span>&nbsp;</span><input type="hidden" name="confirmKey" value="<?php echo $userData->activation_key; ?>" />
	                             <input type="submit" class="clsLogin_but" value="<?php echo $this->lang->line('Edit'); ?>" name="editOwnerProfile" /></p>
								
						
								</form>
                              
							  </div>
							  
										  </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!--end of RC -->    
                            </div>
		
      <!--END OF POST JOB-->
    </div></div>
<!--END OF MAIN-->
<?php $this->load->view('footer'); ?>
