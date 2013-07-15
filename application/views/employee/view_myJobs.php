<?php $this->load->view('header'); ?>
<div class="clsMinContent clearfix">
<?php $this->load->view('sidebar'); ?>
<!--MAIN-->
 <div id="main">
  <?php
		//Show Flash Message
		if($msg = $this->session->flashdata('flash_message'))
		{
			echo $msg;
		}
  ?>
      <!--MY JOBS-->
      <div class="clsInnerpageCommon">
   
                            <div class="clsInnerCommon">
                              <h2><?php echo $this->lang->line('View My Jobs');?></h2>
							 <h3><span class="clsHigh"><?php echo $this->lang->line('Jobs_bidding_on');?></span></h3>
                             <table cellspacing="1" cellpadding="2" width="98%">
                                <tbody><tr>
                                  <td width="3%" class="dt"><?php echo $this->lang->line('SI.No');?></td>
                                  <td width="24%" class="dt"><?php echo $this->lang->line('Job Name');?></td>
								  <td width="16%" class="dt"><?php echo $this->lang->line('Required Escrow');?></td>
                                  <td width="5%" class="dt"><?php echo $this->lang->line('Bids');?></td>
								  <td width="10%" class="dt"><?php echo $this->lang->line('Avg Bid');?></td>
								  <td width="10%" class="dt"><?php echo $this->lang->line('Status');?></td>
								  <td width="15%" class="dt"><?php echo $this->lang->line('Posted');?></td>
								  <td width="15%" class="dt"><?php echo $this->lang->line('Options');?></td>
                                </tr>
								<?php
						  	
						  	if(isset($biddingProjects) and $biddingProjects->num_rows()>0)
							{
								$i=0;
								foreach($biddingProjects->result() as $latestProject)
								{
									if($i%2==0)
										$class = 'dt1';
									else 
										$class = 'dt2';	
									?>
                                <tr>
                                  <td class="<?php echo $class;?> dt0"><?php echo $i+1;?>.</td>
                                  <td class="<?php echo $class;?>"><a href="<?php echo site_url('job/view/'.$latestProject->id); ?>"><?php echo $latestProject->job_name; ?><?php if($latestProject->is_urgent == 1) { ?>
                                    &nbsp;<img src="<?php echo image_url('urgent2.gif');?>" width="14" height="14" title="Urgent project" alt="<?php echo $this->lang->line('Urgent Job'); ?>" />
                                    <?php } 
								   if($latestProject->is_feature == 1) { ?>
                                    &nbsp;&nbsp;<img src="<?php echo image_url('featured2.gif');?>" width="14" height="14" title="Featured project" alt="<?php echo $this->lang->line('Featured Job'); ?>" />
                                    <? }
									if($latestProject->is_private == 1) {?>
									
									 &nbsp;&nbsp;<img src="<?php echo image_url('private1.png');?>" width="14" height="14" title="private project" alt="<?php echo $this->lang->line('Private Job'); ?>" /><?php }
									 ?></a></td>
								  <td class="<?php echo $class;?>"><?php if($latestProject->escrow_flag==1){echo $this->lang->line('Yes'); }else{echo $this->lang->line('No');}?></td>
                                  <td class="<?php echo $class;?>"><?php echo getNumBid($latestProject->id);?></td>
                                  <td class="<?php echo $class;?>"><?php echo getBidsInfo($latestProject->id); ?></td>
								  <td class="<?php echo $class;?>"><?php echo getProjectStatus($latestProject->job_status);?></td>
								  <td class="<?php echo $class;?>"><?php echo get_date($latestProject->created);?></td>
                                  <td class="<?php echo $class;?>">
								  <?php if($latestProject->employee_id == $programmer_id){  ?>
								  <a href="<?php echo site_url('job/acceptJob/'.$latestProject->id."/".$latestProject->checkstamp);?>" onclick="return confirm('Do you want to accept the Job?');"><?php echo $this->lang->line('Accept');?></a>/<a href="<?php echo site_url('job/denyJob/'.$latestProject->id)."/".$latestProject->checkstamp;?>" onclick="return confirm('Do you want to deny the Job?');"><?php echo $this->lang->line('Deny');?></a>
								  <?php } else {?>
								  <a href="<?php echo site_url('employee/retractBid/'.$latestProject->bidid);?>"><?php echo $this->lang->line('Retract your bid');?></a>
								  <?php } ?>
								  </td>
                                </tr>
                              <?php		
						  			$i++;						
								}//For Each End - Latest Job Traversal															
							}//If - End Check For Latest Jobs
							else{
							
							echo "<tr><td colspan='8'>".$this->lang->line('No Jobs')."</td></tr>";
							}
						  ?>
                              </tbody></table>
							  <?php if(isset($pagination)) echo $pagination;?>
							 <h3><span class="clsOptDetial"><?php echo $this->lang->line('Jobs_won');?></span></h3> 
                             <table cellspacing="1" cellpadding="2" width="98%">
                                <tbody><tr>
                                  <td width="5%" class="dt"><?php echo $this->lang->line('SI.No');?></td>
                                  <td width="30%" class="dt"><?php echo $this->lang->line('Job Name');?></td>
								  <td width="10%" class="dt"><?php echo $this->lang->line('Bids');?></td>
                                  <td width="10%" class="dt"><?php echo $this->lang->line('Avg Bid');?></td>
								  <td width="10%" class="dt"><?php echo $this->lang->line('Status');?></td>
								  <td width="15%" class="dt"><?php echo $this->lang->line('Posted');?> </td> 
								  <td width="15%" class="dt"><?php echo $this->lang->line('Options');?></td>
                                </tr>
								 <?php
						  	
						  	if(isset($wonBids) and $wonBids->num_rows()>0)
							{
								$i=0;
								foreach($wonBids->result() as $wonBid)
								{
									$reviewDetails = getReviewStatusProgrammer($wonBid->id,$wonBid->employee_id);
									
									$reviewDetails = $reviewDetails->row();
									
								 if(!is_object($reviewDetails))
							     {	
								
									if($i%2==0)
										$class = 'dt1';
									else 
										$class = 'dt2';
									?>
                               <tr>
                                 <td class="<?php echo $class;?> dt0"><?php echo $i+1;?></td>
                                  <td class="<?php echo $class;?>"><a href="<?php echo site_url('job/view/'.$wonBid->id); ?>"><?php echo $wonBid->job_name; ?></a><?php if($wonBid->is_urgent == 1) { ?>
                                    &nbsp;<img src="<?php echo image_url('urgent2.gif');?>" width="14" height="14" title="Urgent Job" alt="<?php echo $this->lang->line('Urgent Job'); ?>" />
                                    <?php } 
								   if($wonBid->is_feature == 1) { ?>
                                    &nbsp;&nbsp;<img src="<?php echo image_url('featured2.gif');?>" width="14" height="14" title="Featured Job" alt="<?php echo $this->lang->line('Featured Job'); ?>" />
                                    <? }
									if($wonBid->is_private == 1) {?>
									
									 &nbsp;&nbsp;<img src="<?php echo image_url('private.png');?>" width="14" height="14" title="private Job" alt="<?php echo $this->lang->line('Private Job'); ?>" /><?php }
									 ?></td>
								  <td class="<?php echo $class;?>"><?php echo getNumBid($wonBid->id);?></td>
                                  <td class="<?php echo $class;?>"><?php echo getBidsInfo($wonBid->id); ?></td>
								  <td class="<?php echo $class;?>"><?php echo getProjectStatus($wonBid->job_status);?></td>
								  <td class="<?php echo $class;?>"><?php echo get_date($wonBid->created);?></td> 
								  <td class="<?php echo $class;?>"><a href="<?php echo site_url('employee/reviewOwner/'.$wonBid->id);?>"><?php echo $this->lang->line('Review');?></a></td>
                                </tr>
                                <?php		
						  			$i++;		
								 }					
								}//For Each End - Latest Job Traversal															
							}//If - End Check For Latest Jobs
							else{
							
							echo "<tr><td colspan='8'>".$this->lang->line('No Jobs')."</td></tr>";
							}
						  ?>
                              </tbody></table>									 
								 <h3><span class="clsOptDetial"><?php echo $this->lang->line('Bookmark').' '.$this->lang->line('Jobs');?></span></h3> 
                             <table cellspacing="1" cellpadding="2" width="98%">
                                <tbody><tr>
                                  <td width="3%" class="dt"><?php echo $this->lang->line('Sl.No');?></td>
                                  <td width="25%" class="dt"><?php echo $this->lang->line('Job Name');?></td>
								  <td width="20%" class="dt"><?php echo $this->lang->line('Creator Name');?></td>
								  <td width="15%" class="dt"><?php echo $this->lang->line('Bid Amount');?></td>
								  <td width="15%" class="dt"><?php echo $this->lang->line('Posted');?></td>
								  <td width="10%" class="dt"><?php echo $this->lang->line('Status');?></td>
								  <td width="10%" class="dt"><?php echo $this->lang->line('Options');?></td>
                                </tr>
                          <?php
						  	if(isset($bookMark) and $bookMark->num_rows()>0)
							{
								$i=0;
								foreach($bookMark->result() as $bookMark)
								{
									if($i%2==0)
										$class = 'dt1 dt0';
									else 
										$class = 'dt2 dt0';	
									?>
                                   <tr class="<?php echo $class; ?>">
                                    <td><?php echo $i+1;?></td>
									<td><a href="<?php echo site_url('job/view/'.$bookMark->job_id); ?>"><?php echo $bookMark->job_name; ?></a><?php if($bookMark->is_urgent == 1) { ?>
                                    &nbsp;<img src="<?php echo image_url('urgent2.gif');?>" width="14" height="14" title="Urgent job" alt="<?php echo $this->lang->line('Urgent Job'); ?>" />
                                    <?php } 
								   if($bookMark->is_feature == 1) { ?>
                                    &nbsp;&nbsp;<img src="<?php echo image_url('featured2.gif');?>" width="14" height="14" title="Featured job" alt="<?php echo $this->lang->line('Featured Job'); ?>" />
                                    <? }
									if($bookMark->is_private == 1) {?>
									
									 &nbsp;&nbsp;<img src="<?php echo image_url('private.png');?>" width="14" height="14" title="private job" alt="<?php echo $this->lang->line('Private Job'); ?>" /><?php }
									 ?></td>
									<td><a href="<?php echo site_url('owner/viewProfile/'.$bookMark->creator_id);?>"><?php foreach($getUsers->result() as $user) { if($user->id == $bookMark->creator_id) { echo $user->user_name; break; } } ?></a> </td>
									<td> <?php if(isset($bookMark->budget_min) or ($bookMark->budget_max)) echo '$ '.$bookMark->budget_min.' - '.$bookMark->budget_max; else echo 'N/A'; ?> </td>
									<td><?php echo get_date($bookMark->created);?></td>
									<td><?php echo getProjectStatus($bookMark->job_status); ?></td>
									<td><a href="<?php echo site_url('employee/remove/'.$bookMark->job_id); ?>"><?php echo $this->lang->line('Remove');?></a></td>
								  </tr>
                          <?php		
						  			$i++;						
								}//For Each End - Latest Job Traversal															
							}//If - End Check For Latest Jobs
							else{
							
							echo "<tr><td colspan='8'>".$this->lang->line('No Jobs')."</td></tr>";
							}
						  ?>
                              </tbody></table>		
							  <?php if(isset($pagination1)) echo $pagination1;?>
								
										 
                            </div>
                          </div>
    
      <!--END OF POST JOB-->
    </div>

<!--END OF MAIN-->
</div></div>
<?php $this->load->view('footer'); ?>