<?php $this->load->view('header'); ?>
<div class="clsMinContent clearfix">
<?php $this->load->view('sidebar'); ?>
<!--MAIN-->
<div id="main">
  <!--POST JOB-->
  <div class="clsViewMyProject">
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
   
                        <div class="clsInnerCommon clsSitelinks">
                          <h2><?php echo $this->lang->line('new_owner_signup'); ?></h2>
                          <?php
							//Show Flash Message
							if($msg = $this->session->flashdata('flash_message'))
							{
								echo $msg;
							}	?>
                          <!--SIGN-UP-->
                          <div id="selSignUp">
                            <h3><span class="clsNewBuyer"><?php echo $this->lang->line('new_owner_signup'); ?></span></h3>
                            <form method="post" action="<?php echo site_url('owner/signup'); ?>">
                              <?=form_token(); ?>
                              <input type="hidden" name="new" value="user"/>
                              <!--<p><?php echo $this->lang->line('not_a_owner'); ?>? <a href="<?php echo site_url('employee/signup'); ?>"><?php echo $this->lang->line('click_here'); ?></a> <?php echo $this->lang->line('to_sign_employee'); ?></p>-->
                              <p><strong><?php echo $this->lang->line('email_address'); ?>:</strong>
                                <input type="text" name="email" size="40" value="<?php echo set_value('email'); ?>"/>
                                <input type="submit" class="clsLogin_but" value="<?php echo $this->lang->line('Submit');?>" name="ownerSignup"/>
                                <?php echo form_error('email'); ?><br />
                                <small><?php echo $this->lang->line('provide_valid_mail'); ?>.
								<?php if(isset($page_content) and $page_content->num_rows()>0)
								 {
								  foreach($page_content->result() as $page) {?> 
								  <a href="<?php echo site_url('page/'.$page->url);?>"><?php echo $this->lang->line('view_privacy_policy'); ?></a>.<?php }} ?></small></p>
                            </form>
                          </div>
                          <br />
                       <!--   <div id="selSignUp2">
                            <h3><span class="clsResend"><?php echo $this->lang->line('Resend activation link');?></span></h3>
                            <br />
                            <form method="post" action="<?php echo site_url('owner/resendActivationLink'); ?>">
                              <p><strong><?php echo $this->lang->line('email_address'); ?>:</strong>
                                <input type="text" name="email2" size="40" value="<?php echo set_value('email2'); ?>"/>
                                <input type="submit" class="clsLogin_but" value="<?php echo $this->lang->line('Submit');?>" name="resend"/>
                                <?php echo form_error('email2'); ?><br />
                              </p>
                            </form>
                          </div>-->
                          <!--SIGN-UP-->
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
                    </div>
<!--END OF MAIN-->
</div></div>
<?php $this->load->view('footer'); ?>