<?php $this->load->view('header'); ?>
<div class="clsMinContent clearfix">
<?php $this->load->view('sidebar'); ?>

<!--MAIN-->
<div id="main">
      <!--POST JOB-->
      <div class="clsInnerpageCommon">
       
                            <div class="clsInnerCommon">
                             <h2><?php echo $this->lang->line('Report Violation') ?></h2>
								
								<p><?php echo $this->lang->line('Report Violation content'); ?></p>
								<?php
								$userInfo = $loggedInUser;
								$postSimilar =  $postSimilar->row();
								?>
								<?php
								//Show Flash error Message
								if($msg = $this->session->flashdata('flash_message'))
								{
								  echo $msg;
								}?>
								<?php
								if(isset($getUsers))
								  $getUsers = $getUsers->row();
								if(isset($getBids))
								  $getBids  = $getBids->row();
								
								?>
								<h3><span class="clsInvoice"><?php echo $this->lang->line('Reporting'); ?> <a href="<?php echo site_url('job/view/'.$postSimilar->id); ?>"><?php echo $postSimilar->job_name; ?></a></span></h3> 
								<form action="<?php echo site_url('job/bidReport/'.$getBids->id); ?>" name="projectReport" method="post">
									
									<p><span><b><?php echo $this->lang->line('username'); ?></b></span>
									   <span><a href="<?php echo site_url('employee/viewProfile/'.$getUsers->id); ?>"><?php echo $getUsers->user_name; ?></a></span>
									</p>
									<p><span><label><b><?php echo $this->lang->line('Job');?></b></label></span>
									   <span><label><a href="<?php echo site_url('job/view/'.$postSimilar->id); ?>"><?php echo $postSimilar->job_name; ?></a></label></span>
									</p>
									<p><span><label><b><?php echo $this->lang->line('Comment'); ?></b></label></span></p>
									<p><span><textarea name="report" rows="10" cols="70" ></textarea></span></p>
									
									<p><span>&nbsp;</span><?php echo $this->lang->line('Report Violation hint'); ?></p>
									<input type="hidden" name="projectid" value="<?php echo $postSimilar->id;?>" />	
									<input type="hidden" name="projectname" value="<?php echo $postSimilar->job_name;?>" />
									<p><input type="submit" class="clsLoginlarge_but" name="submitReport" value="<?php echo $this->lang->line('Report Violation');?>" /></p>
								</form>

                     
        </div>
      </div>
      <!--END OF POST JOB
	  -->
    </div>
	</div></div>
<!--END OF MAIN-->
<?php $this->load->view('footer'); ?>