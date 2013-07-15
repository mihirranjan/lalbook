<?php $this->load->view('header'); ?>
<div class="clsMinContent clearfix">
<?php $this->load->view('sidebar'); ?>
<!--MAIN-->
<div id="main">
      <!--POST JOB-->
      <div class="clsInnerpageCommon">
                           <div class="clsInnerCommon">
                             <h2><?php echo $this->lang->line('Report Violation') ?></h2>
							   <p style="padding-left:10px !important;"><?php echo $this->lang->line('Report Violation content'); ?></p>
								<?php
								$userInfo = $loggedInUser;
								$postSimilar =  $postSimilar->row();
								
								?>
								<?php
								//Show Flash error Message  for deposit minimum amount
								if($msg = $this->session->flashdata('flash_message'))
								{
								  echo $msg;
								}?>
								<h3><span class="clsOptContact"><?php echo $this->lang->line('Reporting'); ?> <a href="<?php echo site_url('job/view/'.$postSimilar->id); ?>"><?php echo $postSimilar->job_name; ?></a></span></h3> 
								<form action="<?php echo site_url('job/jobReport/'.$postSimilar->id); ?>" name="projectReport" method="post">
									<p> <label><?php echo $this->lang->line('Job');?></label>
									<label><a href="<?php echo site_url('job/view/'.$postSimilar->id); ?>"><b><?php echo $postSimilar->job_name; ?></b></a></label></p>
									<p><b><?php echo $this->lang->line('Comment'); ?> </b><input type="text" name="report" size="60"   /></p>
									<p><?php echo $this->lang->line('Report Violation hint'); ?></p>
									<input type="hidden" name="projectname" value="<?php echo $postSimilar->job_name;?>" />
									<p><input type="submit" class="clsLoginlarge_but" name="submitReport" value="<?php echo $this->lang->line('Report Violation');?>" /></p>
								</form>
								<br />
                            </div>
                          
      </div>
      <!--END OF POST JOB-->
    </div>
<!--END OF MAIN-->
</div></div>
<?php $this->load->view('footer'); ?>