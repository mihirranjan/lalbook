<?php $this->load->view('header'); ?>
<div class="clsMinContent clearfix">
<?php $this->load->view('sidebar'); ?>
<!--MAIN-->
<div id="main">
  <!--POST JOB-->
  <div class="clsInnerpageCommon">
    
                        <div class="clsInnerCommon">
                          <h2><?php echo $this->lang->line('view_case');?> - <?php echo $jobCase->job_name;?></h2>
						  <?php
							//Show Flash Message
							if($msg = $this->session->flashdata('flash_message'))
							{
								echo $msg;
							}	
							?>
						  <div class="clsHeads">
                            <div class="clsHeadingLeft clsFloatLeft">
                              <h3><span class="clsCaseDetails"><?php echo $this->lang->line('case details');?></span></h3>
                            </div>
                            <div class="clsHeadingRight clsFloatRight">
                              <p class="clsFloatRight"> <span class="clsPostProject"> <a href="<?php echo site_url('cancel/viewopenCases');?>" class="buttonBlack"><span><?php echo $this->lang->line("view open cases");?></span></a></span> <span class="clsPostProject"> <a href="<?php echo site_url('cancel/viewClosedCases');?>" class="buttonBlack"><span><?php echo $this->lang->line("view closed cases");?></span></a></span></p>
                            </div>
                          </div>
                          <div class="clsSitelinks clsEditProfile">
                            <form method="post" action="" name="myForm">
                              <?=form_token();?>
                              <p><span><?php echo $this->lang->line('job_title'); ?>:</span><a href="<?php echo site_url('job/view/'.$jobCase->job_id);?>" class="glow"><?php echo $jobCase->job_name;?></a></p>
                              <p><span><?php echo $this->lang->line('job_id'); ?>:</span><?php echo $jobCase->job_id;?></p>
                              <p><span><?php echo $this->lang->line('Owner'); ?>:</span><a href="<?php echo site_url('owner/viewProfile/'.$jobCase->creator_id);?>" class="glow"> <?php echo getUserDetails($jobCase->creator_id,'user_name');?></a></p>
                              <p><span><?php echo $this->lang->line('Employee'); ?>:</span><a href="<?php echo site_url('employee/viewProfile/'.$jobCase->employee_id);?>" class="glow"><?php echo getUserDetails($jobCase->employee_id,'user_name');?></a></p>
                              <p><span><?php echo $this->lang->line('Case Type');?>:</span><?php echo $jobCase->case_type;?></p>
                              <p><span><?php echo $this->lang->line('Case Reason');?>:</span><?php echo $jobCase->case_reason;?></p>
                              <p><span><?php echo $this->lang->line('payment_requested')?>:</span>$<?php echo $jobCase->payment;?></p>
                              <br>
                              <h3><span class="clsResolutionBoard"><?php echo $this->lang->line('Resolution board comments');?></span></h3>
                              <table width="96%" cellspacing="1" cellpadding="2">
                                <tr>
                                  <td width="20%" class="dt"><?php echo $this->lang->line('Author');?></td>
                                  <td width="80%" class="dt"><?php echo $this->lang->line('Comment');?> </td>
                                </tr>
                                <tr class="dt2 dt0">
                                  <td><?php echo getUserDetails($jobCase->user_id,'user_name')."<br><br>".get_date($jobCase->created);?></td>
                                  <td><?php echo str_replace("\n", "<br>", $jobCase->problem_description);
								  if($this->loggedInUser->id == $jobCase->user_id && $jobCase->private_comments != "")
								  echo "<br><br><b>Private:<br>".str_replace("\n", "<br>", $jobCase->private_comments)."</b>"; ?></td>
                                </tr>
                                <?php
									if(isset($caseResolution) and $caseResolution->num_rows()>0)
									{
										$i=0;
										foreach($caseResolution->result() as $caseResolution)
										{
											if($i%2==0)
												$class = 'dt1 dt0';
											else 
												$class = 'dt2 dt0';	
											?>
                                <tr class="<?php echo $class; ?>">
                                  <td><?php 
								  if($caseResolution->user_id != '0') 
								  $uname = getUserDetails($caseResolution->user_id,'user_name');
								  else
								  $uname = getAdminDetails($caseResolution->admin_id,'admin_name');
								  echo $uname."<br><br>".get_date($caseResolution->created);?></td>
                                  <td><?php
								  if($caseResolution->problem_description != "")
								  echo str_replace("\n", "<br>", $caseResolution->problem_description);
								  if($this->loggedInUser->id == $caseResolution->user_id && $caseResolution->private_comments != "")
								  echo "<br><br><b>Private:<br>".str_replace("\n", "<br>", $caseResolution->private_comments)."</b>";
								  if($caseResolution->updates != "")
								  echo "<br><br><b>".$this->lang->line('update')."</b>:".$caseResolution->updates;
								  ?></td>
                                </tr>
                                <?php		
										$i++;						
										}//For Each End - Latest Job Traversal
								}//If - End Check For Latest Jobs
		
								  ?>
                                </tbody>
                                
                              </table>
							  <?php
							  if($jobCase->status == 'open'){
							  ?>
                              <h3><span class="clsRespond"><?php echo $this->lang->line('Respond');?></span></h3>
                              <p><span><?php echo $this->lang->line('problem_description')."<br>(".$this->lang->line('public').")"; ?>:</span>
                                <textarea rows="10" name="problem_description" cols="60" onKeyDown="textCounter(document.myForm.problem_description,document.myForm.remLen2,250)" onKeyUp="textCounter(document.myForm.problem_description,document.myForm.remLen2,250)"><?php echo set_value('problem_description'); ?></textarea>
                                <?php echo form_error('problem_description'); ?> </p>
                              <p><span>&nbsp;</span>
                                <input readonly type="text" name="remLen2" size="3" maxlength="3" value="250">
                                &nbsp;<?php echo $this->lang->line('Characters Left') ?></p>
                              <p><span><?php echo $this->lang->line('comments')."<br>(".$this->lang->line('private').")"; ?>:</span>
                                <textarea rows="10" name="comments" cols="60" onKeyDown="textCounter(document.myForm.comments,document.myForm.remLen3,250)" onKeyUp="textCounter(document.myForm.comments,document.myForm.remLen3,250)"><?php echo set_value('comments'); ?></textarea>
                                <?php echo form_error('comments'); ?> </p>
                              <p><span>&nbsp;</span>
                                <input readonly type="text" name="remLen3" size="3" maxlength="3" value="250">
                                &nbsp;<?php echo $this->lang->line('Characters Left') ?></p>
                              <p><span><?php echo $this->lang->line('Request_staff');?>:</span>
                                <select name="updates">
                                  <option value="0" selected="selected">Select</option>
                                  <option value="<?php echo $this->lang->line('staff_intervention');?>"><?php echo $this->lang->line('staff_intervention');?></option>
                                  <option value="<?php echo $this->lang->line('dispute_case');?>"><?php echo $this->lang->line('dispute_case');?></option>
                                </select>
                              </p>
                              <p><span>&nbsp;</span>
                                <input type="hidden" name="case_id" value="<?php echo $jobCase->id;?>" />
                                <input type="hidden" name="project_id" value="<?php echo $jobCase->job_id;?>" />
                                <input type="submit" class="clsSmall" value="<?php echo $this->lang->line('Respond'); ?>" name="respondCase" />
                              </p>
							  <?php } 
							  else{
							  echo '<input type="hidden" name="case_id" value="'.$jobCase->id.'" />';
							  echo "<p><span>&nbsp;</span><input type=submit name=reopen value='".$this->lang->line('Reopen the case')."'/></p>";
							  }
							  ?>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

<!--END OF POST JOB-->
</div>
<?php $this->load->view('footer'); ?>
