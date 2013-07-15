<?php $this->load->view('header'); ?>
<div class="clsMinContent clearfix">
<?php $this->load->view('sidebar'); ?>
<!--MAIN-->
<div id="main">
      <!--POST JOB-->
      <div class="clsInnerpageCommon">
        
                            <div class="clsInnerCommon">
                              <h2><?php echo $this->lang->line('Reviews of Owner');?> - <?php echo $userDetails->user_name;?></h2>
                             <table cellspacing="1" cellpadding="2" width="96%">
                                <tbody><tr>
                                  <td width="10%" class="dt"><?php echo $this->lang->line('Rating');?></td>
                                  <td width="20%" class="dt"><?php echo $this->lang->line('Job Name');?> </td>
                                  <td width="10%" class="dt"><?php echo $this->lang->line('Review Date');?></td>
								  <td width="10%" class="dt"><?php echo $this->lang->line('Job status');?></td>
								  <td width="30%" class="dt"><?php echo $this->lang->line('Employee');?></td>	
								  <td width="30%" class="dt"><?php echo $this->lang->line('comments');?></td>							  
                                </tr>
								
								<?php
						  	if(isset($reviewDetails) and $reviewDetails->num_rows()>0)
							{
							$i=0;
							foreach($reviewDetails->result() as $reviewDetail)
							{
								if($i%2==0)
									$class = 'dt1';
								else 
									$class = 'dt2';
							?>
                                  <tr>
                                  <td class="<?php echo $class; ?> dt0"><?php echo $reviewDetail->rating;?><img src="<?php echo image_url('rating_'.$reviewDetail->rating.'.gif');?>" /></td>
                                  <td class="<?php echo $class; ?>"><a href="<?php echo site_url('job/view/'.$reviewDetail->jobid);?>"><?php echo $reviewDetail->job_name; ?></a></td>
                                  <td class="<?php echo $class; ?>"><?php echo get_date($reviewDetail->review_time); ?></td>
                                  <td class="<?php echo $class; ?>"><?php echo getProjectStatus($reviewDetail->job_status);?></td>
                                  <td class="<?php echo $class; ?>">
								  <?php 
							$buyer = getUserInformation($reviewDetail->employee_id);
							?>
								 
							<?php 
							$chj = getAvgReview($reviewDetail->employee_id,'employee_id');
							echo $buyer->user_name;
							?>
							<img src="<?php echo image_url('rating_'.$chj.'.gif');?>" /> ( <a href="<?php echo site_url('employee/review/'.$buyer->id);?>">
							<?php echo getNumReviews($reviewDetail->employee_id,'employee_id')." reviews";?></a> )
								  </td>			
								  <td class="<?php echo $class; ?>"><?php echo $reviewDetail->comments; ?></td>					  
                                 </tr>
                                <?php $i++;} }else{
							
							echo '<tr><td colspan="6">'.$this->lang->line('No records found').'</td></tr>';
							} ?>
							 
                              </tbody></table>
                            </div>
                         
      </div>
      <!--END OF POST JOB-->
    </div>
<!--END OF MAIN-->
</div></div>
<?php $this->load->view('footer'); ?>