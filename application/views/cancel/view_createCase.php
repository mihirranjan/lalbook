<?php $this->load->view('header'); ?>
<div class="clsMinContent clearfix">
<?php $this->load->view('sidebar'); ?>
<!--MAIN-->
<div id="main">
  <!--POST JOB-->
  <div class="clsInnerpageCommon">
   
                        <div class="clsInnerCommon">
						<h2><?php echo $this->lang->line('Open new case');?></h2>
                          <div class="clsSitelinks clsEditProfile">
                            <form method="post" action="" name="myForm">
							<?=form_token();?>
							  <p><span><?php echo $this->lang->line('job_title'); ?>:</span><a href="<?php echo site_url('job/view/'.$job->id);?>" class="glow"><?php echo $job->job_name;?></a></p>
							  <p><span><?php echo $this->lang->line('job_id'); ?>:</span><?php echo $job->id;?></p>
							  <p><span><?php echo $this->lang->line('Owner'); ?>:</span><a href="<?php echo site_url('owner/viewProfile/'.$job->userid);?>" class="glow"><?php echo $job->user_name;?></a></p>
							  <p><span><?php echo $this->lang->line('Employee'); ?>:</span><a href="<?php echo site_url('employee/viewProfile/'.$employee->id);?>" class="glow"><?php echo $employee->user_name;?></a></p>
							  <p><span><?php echo $this->lang->line('Case Type');?>:</span>
							  <select name="case_type">
						      <option value="Cancel"><?php echo $this->lang->line('job_cancel');?></option>
							  <option value="Dispute"><?php echo $this->lang->line('job_dispute');?></option>
						      </select></p>
                            <p><span><?php echo $this->lang->line('Case Reason');?>:</span>
							  <select name="case_reason">
						      <option value="<?php echo $this->lang->line('dispute over quality of service');?>"><?php echo $this->lang->line('dispute over quality of service');?></option>
							  <option value="<?php echo $this->lang->line('service not rendered');?>"><?php echo $this->lang->line('service not rendered');?></option>
							  <option value="<?php echo $this->lang->line('Job description changed');?>"><?php echo $this->lang->line('Job description changed');?></option>
							  <option value="<?php echo $this->lang->line('payment not recieved');?>"><?php echo $this->lang->line('payment not recieved');?></option>
							  <option value="<?php echo $this->lang->line('no communication');?>"><?php echo $this->lang->line('no communication');?></option>
							  <option value="<?php echo $this->lang->line('mutual cancellation');?>"><?php echo $this->lang->line('mutual cancellation');?></option>
							  <option value="<?php echo $this->lang->line('other');?>"><?php echo $this->lang->line('other');?></option>
						       </select></p>
							   
							   <p><span><?php echo $this->lang->line('job_description')."<br>(".$this->lang->line('public').")"; ?>:</span>
                                <textarea rows="10" name="problem_description" cols="60" onKeyDown="textCounter(document.myForm.problem_description,document.myForm.remLen2,250)" onKeyUp="textCounter(document.myForm.problem_description,document.myForm.remLen2,250)"><?php echo set_value('job_description'); ?></textarea>
                                <?php echo form_error('job_description'); ?> </p>
                              <p><span>&nbsp;</span>
                                <input readonly type="text" name="remLen2" size="3" maxlength="3" value="250">
                                &nbsp;<?php echo $this->lang->line('Characters Left') ?></p>
								
								<p><span><?php echo $this->lang->line('comments')."<br>(".$this->lang->line('private').")"; ?>:</span>
                                <textarea rows="10" name="comments" cols="60" onKeyDown="textCounter(document.myForm.comments,document.myForm.remLen3,250)" onKeyUp="textCounter(document.myForm.comments,document.myForm.remLen3,250)"><?php echo set_value('comments'); ?></textarea>
                                <?php echo form_error('comments'); ?> </p>
                              <p><span>&nbsp;</span>
                                <input readonly type="text" name="remLen3" size="3" maxlength="3" value="250">
                                &nbsp;<?php echo $this->lang->line('Characters Left') ?></p>
								
								<p><span><?php echo $this->lang->line('Review');?>:</span>
							  <select name="review">
						      <option value="<?php echo $this->lang->line('remove review');?>"><?php echo $this->lang->line('remove review');?></option>
							  <option value="<?php echo $this->lang->line('add review');?>"><?php echo $this->lang->line('add review');?></option>
							  <option value="<?php echo $this->lang->line('dont change');?>"><?php echo $this->lang->line('dont change');?></option>
						       </select></p>
							   
							   <p><span>&nbsp;</span><?php echo $this->lang->line('Payment need');?>:$<input name="payment" type="text" value="<?php echo set_value('payment'); ?>" size="10"><?php echo form_error('payment'); ?>
							   </p>
							   <p><span>&nbsp;</span>
							   <input type="hidden" name="project_id" value="<?php echo $job->id;?>" />
                                <input type="submit" class="clsLogin_but" value="<?php echo $this->lang->line('Submit'); ?>" name="createCase" />
                              </p>
                            </form>
                           
                          </div>
                        </div>
                      </div>
                    
                  </div>
                </div>
              </div>

<!--END OF POST JOB-->
</div>
<?php $this->load->view('footer'); ?>