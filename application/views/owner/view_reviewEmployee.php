<?php $this->load->view('header'); ?>
<div class="clsMinContent clearfix">
<?php $this->load->view('sidebar'); ?>
<!--MAIN-->
<?php
$projectDetails = $projectDetails->row();
?>

<div id="main">
  <!--POST JOB-->
  <div class="clsInnerpageCommon">
   
                        <div class="clsInnerCommon">
                          <?php 
							  $reviewDetails = $reviewDetails->row();
							  if(is_object($reviewDetails))
							    { 
								$provider = getUserinformation($reviewDetails->employee_id);
								  ?>
                          <h2><?php echo $this->lang->line('Feedback for Employee');?> - <?php echo $provider->user_name;?></h2>
                          <table cellspacing="1" cellpadding="2" width="96%">
                            <tbody>
                              <tr>
                                <td width="10%" class="dt"><?php echo $this->lang->line('Employee');?></td>
                                <td width="20%" class="dt"><?php echo $this->lang->line('Job Name');?> </td>
                                <td width="10%" class="dt"><?php echo $this->lang->line('Job Date');?></td>
                                <td width="10%" class="dt"><?php echo $this->lang->line('Rating');?></td>
								<td width="10%" class="dt"><?php echo $this->lang->line('comments');?></td>
                              </tr>
                              <tr>
                                <td><a href="<?php echo site_url('employee/viewProfile/'.$provider->id);?>"><?php echo $provider->user_name; ?></a></td>
                                <td><a href="<?php echo site_url('job/view/'.$reviewDetails->jobid);?>"><?php echo $reviewDetails->job_name; ?></a></td>
                                <td><?php echo get_date($reviewDetails->created); ?></td>
                                <td><img src="<?php echo image_url('rating_'.$reviewDetails->rating.'.gif');?>" /></td>
								<td><?php echo $reviewDetails->comments; ?></td>
                              </tr>
                            </tbody>
                          </table>
                          <?php
							   } else { ?>
                          <h2><?php echo $this->lang->line('Feedback for Employee');?> - <?php echo $providerDetails->user_name;?></h2>
                          <form action="" method="post" name="form1">
                            <p><?php echo $this->lang->line('How would you rate the Employee');?> <strong><?php echo $providerDetails->user_name;?></strong> <?php echo $this->lang->line('for the job');?> <strong><?php echo $projectDetails->job_name;?></strong></p>
                            <p class="clsEditProfile"><span> <?php echo $this->lang->line('Rating:');?></span>
                              <select id="rate" name="rate">
                                <!--<option selected="" value="1">---------------</option>-->
                                <option value="1">1 (Very Poor)</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5 (Acceptable)</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10 (Excellent)</option>
                              </select>
                            </p>
                            <p class="clsEditProfile"><span> <?php echo $this->lang->line('Comment:');?></span>
                              <textarea id="comment" rows="5" cols="50" name="comment"/></textarea>
                            </p>
                            <input type="hidden" value="<?php echo $projectDetails->id;?>" id="projectid" name="projectid"/>
                            <input type="hidden" value="<?php echo $projectDetails->employee_id;?>" id="providerid" name="providerid"/>
                            <p class="clsEditProfile"> <span>&nbsp;</span> <input type="submit" value="<?php echo $this->lang->line('Submit');?>" name="reviewProgrammer" class="clsLogin_but"/></p>
                          </form>
                          <?php } ?>
                       
    </div>
  </div>
  <!--END OF POST JOB-->
</div>
<!--END OF MAIN-->

</div></div>

<?php $this->load->view('footer'); ?>
