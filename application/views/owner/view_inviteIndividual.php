<?php $this->load->view('header'); ?>
<div class="clsMinContent clearfix">
<?php $this->load->view('sidebar'); ?>
<!--MAIN-->
<div id="main">
   
	<div class="clsContact">
   
                            <div class="clsInnerCommon">
							 <div class="clsContactForm">
								  <?php
								//Show Flash Message
								if($msg = $this->session->flashdata('flash_message'))
								{
									echo $msg;
								}
								$touser = $touser->row();
								?>
								  <!--SIGN-UP-->
						
									<form method="post" action="<?php echo site_url('memberList/inviteEmployee'); ?>">
									  <input type="hidden" name="new" value="user"/>
									  <h2><?php echo $this->lang->line('Invite Employee'); ?></h2>
									  
									  <p><label><?php echo $this->lang->line('From'); ?>:</label><?php echo $loggedInUser->user_name; ?></p>
									  <p><label><?php echo $this->lang->line('To'); ?>:</label><input type="hidden" name="toid" value="<?php echo $touser->id; ?>" /><input type="text" name="touser" readonly="yes" value="<?php echo $touser->user_name; ?>" /></p>
									  <p><label><?php echo $this->lang->line('Job Name'); ?>:</label>	 
										 <select name="projects[]" multiple="multiple" style="width:148px;"> <?php 
											  foreach($projectsList as $user)
											  { ?>
												 <option value="<?php echo $user->id; ?>"><?php echo $user->job_name; ?></option> <?php 
											  } ?>
											  </select>
									  </p>
									  <p><label><?php echo $this->lang->line('Other Member'); ?>:</label>
										 <input type="text" name="otheruser" size="20" value=""/><br />
										 <label>&nbsp;</label>
										 <?php echo $this->lang->line('If your favourite member is not in the dropdown list please enter into the Textbox'); ?>
										 <?php //echo form_error('email'); ?>
										<small><?php echo $this->lang->line('provide_valid_mail'); ?>. <a href="#"><?php echo $this->lang->line('view_privacy_policy'); ?></a>.</small></p>
									<p><label>&nbsp;</label><input type="submit" class="clsLogin_but" value="<?php echo $this->lang->line('Submit');?>" name="inviteProgrammer"/></p>	
									</form>
								  <!--SIGN-UP-->
								 </div>
							 </div>
							
        </div>
   
   </div></div></div>
<!--END OF MAIN-->
<?php $this->load->view('footer'); ?>