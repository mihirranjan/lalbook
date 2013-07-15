<?php $this->load->view('header'); ?>
<div class="clsMinContent clearfix">
<?php $this->load->view('sidebar'); ?>
<!--MAIN-->
<?php
if(isset($job) and $job->num_rows()>0)
{
	$job = $job->row();
	}
?>
<div id="main">
  <!--POST JOB-->
  <div class="clsInnerpageCommon">
    
						  <form method="post">
                        <div class="clsInnerCommon">
                          <h2><? echo $this->lang->line('Extend');?> - <?php echo $job->job_name;?></h2>
                          <p style="padding:0 1em 1em !important;"><?php echo $this->lang->line("Extend this job by");?>
                            <select name="openDays">
							<?php for($i=1;$i<=$project_period;$i++){?>
							<option value="<?php echo $i;?>"><?php echo $i;?></option>
							<?php } ?>
							</select>
                            <?php echo $this->lang->line("days");?></span> </p>
                          <p style="padding:0 1em 1em !important;">
                            <input type="submit" name="extend" value="<?php echo $this->lang->line('Submit');?>" class="clsLogin_but" > 
							<input type="hidden" name="jobid" value="<?php echo $job->id;?>">
							<input type="button" name="goback" class="clsLogin_but" value="<?php echo $this->lang->line('Go Back'); ?>" onclick="history.go(-1)"/>
                          </p>
                        </div>
						</form>
    
    <!--END OF POST JOB-->
  </div>

</div>
</div>
</div>
<!--END OF MAIN-->
<?php $this->load->view('footer'); ?>
