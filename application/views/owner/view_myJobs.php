<div class="Container">
<?php $this->load->view('header'); ?>
<div class="clsMinContent clearfix">
<div id="selMain clearfix"> 
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
<div id="Innermain">
      <!--POST JOB-->
      <div class="clsInnerpageCommon">        
                            <div class="clsInnerCommon">

                              <h2><?php echo $this->lang->line('View My Jobs');?></h2>
							 <h3><span class="clsPMB"><?php echo $this->lang->line('My Open Jobs');?></span></h3>
                              <?php
							
								//Show Flash Message
							
								if($msg = $this->session->flashdata('flash_message'))
								{
									echo $msg;
								}
								?>
							   <table cellspacing="1" cellpadding="5" width="98%" class="clsBusiness">

                                <tbody><tr>
                              						  
								  <td width="5%" class="dt"><?php echo $this->lang->line('S.No');?></td>
                                  <td width="20%" class="dt"><?php echo $this->lang->line('Job Name');?></td>
                                  <td width="5%" class="dt"><?php echo $this->lang->line('Bids');?></td>
								  <td width="12%" class="dt"><?php echo $this->lang->line('Lowest Bid');?></td>
								  <td width="10%" class="dt"><?php echo $this->lang->line('Avg Bid');?></td>
								  <td width="10%" class="dt"><?php echo $this->lang->line('Status');?></td>
								  <td width="16%" class="dt"><?php echo $this->lang->line('Posted');?> </td>
								  <td width="10%" class="dt"><?php echo $this->lang->line('Options');?></td>
								  <td width="10%" class="dt"><?php echo $this->lang->line('Type');?></td>
                                </tr>
								<?php
						  	if(isset($myJobs) and $myJobs->num_rows()>0)
							{
								$i=0;
								foreach($myJobs->result() as $myJobs)
								{
									if($i%2==0)
										$class = 'dt1 dt0';
									else 
										$class = 'dt2 dt0';	
									?>
									<tr class="<?php echo $class; ?>">
									<td ><?php echo $i+1;?></td>
									  <td><a href="<?php echo site_url('job/view/'.$myJobs->id); ?>"><?php echo $myJobs->job_name; ?></a><?php if($myJobs->is_urgent == 1) { ?>
                                    &nbsp;<img src="<?php echo image_url('urgent2.gif');?>" width="14" height="14" title="Urgent job" alt="<?php echo $this->lang->line('Urgent Job'); ?>" />
                                    <?php } 
								   if($myJobs->is_feature == 1) { ?>
                                    &nbsp;&nbsp;<img src="<?php echo image_url('featured2.gif');?>" width="14" height="14" title="Featured job" alt="<?php echo $this->lang->line('Featured Job'); ?>" />
                                    <? }
									if($myJobs->is_private == 1) {?>
									
									 &nbsp;&nbsp;<img src="<?php echo image_url('private.png');?>" width="14" height="14" title="private job" alt="<?php echo $this->lang->line('Private Job'); ?>" /><?php }
									 ?></td> <td> <?php echo $numbids = getNumBid($myJobs->id);?> </td><td> <?php echo getLowBid($myJobs->id);?> </td><td> <?php echo getBidsInfo($myJobs->id); ?> </td><td>
									  <?php 
		
									  echo getProjectStatus($myJobs->job_status);
		                         
								      ?>
								  </td><td><?php echo get_date($myJobs->created);?></td><td>
								  <?php 
								  if($numbids != 0 && ($myJobs->job_status == 0 || $myJobs->job_status == 1) || $myJobs->flag==1 ){ 
								  ?>
								  <a href="<?php echo site_url('job/pickEmployee/'.$myJobs->id);?>"><?php echo $this->lang->line('Pick Employee');?></a>
								  
								  <?php } 
								  if($myJobs->job_status == 0 && $myJobs->flag ==1 )
								  { ?>
									 <a href="<?php echo site_url('job/cancelJob/'.$myJobs->id); ?>"> <?php echo $this->lang->line('Cancel');?> </a>  <?php 
								  }
								  if($myJobs->job_status == 0 && $myJobs->flag ==0 )
								  { ?>
									 <a href="<?php echo site_url('job/cancelJob/'.$myJobs->id); ?>"> <?php echo $this->lang->line('Cancel');?> </a>  <?php 
								  }
								  if($myJobs->flag ==0){
								  ?>
								  
								  <a href="<?php echo site_url('job/extendBid/'.$myJobs->id);?>"><?php echo $this->lang->line('Extend');?></a>
								  <?php } ?>
								  </td>
								  <td>
								  <?php  if($myJobs->flag == 0)
								  
								 {
								 echo "Job"; }
								 else
								 {
								 echo "Job";
								 }?>
								  
								  </td></tr>
							       <?php		
						  			$i++;						
								}//For Each End - Latest Job Traversal															
							}//If - End Check For Latest Jobs
							else{
							
							echo "<tr><td colspan='9'><p class='clsNoResult'>".$this->lang->line('No Jobs')."</p></td></tr>";
							}
						  ?>
                              </tbody></table>


							  <!--PAGING-->
							  <?php if(isset($pagination)) echo $pagination;?>
							 <!--END OF PAGING-->
							 <h3><span class="clsClosedJob"><?php echo $this->lang->line('Closed Jobs');?></span></h3> 
  <table cellspacing="1" cellpadding="2" width="96%" class="clsBusiness">
                                <tbody><tr>
                                  <td width="5%" class="dt"><?php echo $this->lang->line('Sl.No');?></td>
                                  <td width="25%" class="dt"><?php echo $this->lang->line('Job Name');?></td>
								  <td width="25%" class="dt"><?php echo $this->lang->line('Job Winner');?></td>
                                  <td width="10%" class="dt"><?php echo $this->lang->line('Bid Price');?></td>
								  <td width="25%" class="dt"><?php echo $this->lang->line('Options');?></td>
								  
								   <td width="25%" class="dt"><?php echo $this->lang->line('Type');?></td>
                                </tr>
                          <?php
						  	if(isset($closedJobs) and $closedJobs->num_rows()>0)
							{
								$i=0;
								foreach($closedJobs->result() as $closedJob)
								{
								 $condition=array('subscriptionuser.username'=>$closedJob->userid);
								$certified2= $this->credential_model->getCertificateUser($condition);
									$reviewDetails = getReviewStatus($closedJob->id,$closedJob->employee_id);
									
									$reviewDetails = $reviewDetails->row();
									
								 
																
									if($i%2==0)
										$class = 'dt1 dt0';
									else 
										$class = 'dt2 dt0';	
									?>
                                   <tr class="<?php echo $class; ?>">
                                    <td><?php echo $i+1;?></td><td><a href="<?php echo site_url('job/view/'.$closedJob->id); ?>"><?php echo $closedJob->job_name; ?></a><?php if($closedJob->is_urgent == 1) { ?>
                                   &nbsp; <img src="<?php echo image_url('urgent2.gif');?>" width="14" height="14" title="Urgent project" alt="<?php echo $this->lang->line('Urgent Project'); ?>" />
                                    <?php } 
								   if($closedJob->is_feature == 1) { ?>
                                    &nbsp;&nbsp;<img src="<?php echo image_url('featured2.gif');?>" width="14" height="14" title="Featured project" alt="<?php echo $this->lang->line('Featured Project'); ?>" />
                                    <? }
									if($closedJob->is_private == 1) {?>
									
									&nbsp;&nbsp;<img src="<?php echo image_url('private.png');?>" width="14" height="14" title="private project" alt="<?php echo $this->lang->line('Private Project'); ?>" /><?php }
									 ?></td><td><a href="<?php echo site_url('employee/viewProfile/'.$closedJob->userid);?>"><?php echo $closedJob->user_name; ?></a>
								<?php	if(count($certified2->result())>0)
								{?>
								<img src="<?php echo image_url('certified.gif');?>" title="<?php echo $this->lang->line('Certified Member') ?>" alt="<?php  echo $this->lang->line('Certified Member')?>" />
								<?php }?>
									 </td><td> <?php echo getLowestBid($closedJob->id,$closedJob->employee_id); ?> </td><td> <a href="<?php echo site_url('owner/reviewEmployee/'.$closedJob->id);?>"><?php echo $this->lang->line('view review');?></a></td><td>
								  <?php  if($closedJob->flag == 0)
								  
								 {
								 echo "Job"; }
								 else
								 {
								 echo "Job";
								 }?>
								  
								  </td></tr>
                          <?php		
						  			$i++;		
																
								}//For Each End - Latest Job Traversal															
							}//If - End Check For Latest Jobs
							else{
							
							echo "<tr><td colspan='9'><p class='clsNoResult'>".$this->lang->line('No Jobs')."</p<</td></tr>";
							}
						  ?>
                              </tbody></table>		
							  
							  <h3><span class="clsOptDetial"><?php echo $this->lang->line('Bookmark').' '.$this->lang->line('Jobs');?></span></h3> 
                             <table cellspacing="1" cellpadding="2" width="96%" class="clsBusiness">
                                <tbody><tr>
                                  <td width="5%" class="dt"><?php echo $this->lang->line('Sl.No');?></td>
                                  <td width="20%" class="dt"><?php echo $this->lang->line('Job Name');?></td>
								  <td width="17%" class="dt"><?php echo $this->lang->line('Creator Name');?></td>
								  <td width="13%" class="dt"><?php echo $this->lang->line('Bid Amount');?></td>
								  <td width="15%" class="dt"><?php echo $this->lang->line('Posted');?></td>
								  <td width="10%" class="dt"><?php echo $this->lang->line('Status');?></td>
								  <td width="10%" class="dt"><?php echo $this->lang->line('Options');?></td>
								   <td width="8%" class="dt"><?php echo $this->lang->line('Type');?></td>
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
									<td><a href="<?php echo site_url('owner/viewProfile/'.$bookMark->creator_id);?>"><?php foreach($getUsers->result() as $user) { if($user->id == $bookMark->creator_id) { echo $user->user_name;
									
									 $condition=array('subscriptionuser.username'=>$user->id);
								$certified1= $this->credential_model->getCertificateUser($condition);
										if(count($certified1->result())>0)
								{?>
								<img src="<?php echo image_url('certified.gif');?>" />
								<?php }
									 break; } } ?></a> </td>
									<td> <?php if(isset($bookMark->budget_min) or ($bookMark->budget_max)) echo $currency.' '.$bookMark->budget_min.' - '.$bookMark->budget_max; else echo 'N/A'; ?> </td>
									<td><?php echo get_date($bookMark->created);?></td>
									<td><?php echo getProjectStatus($bookMark->job_status); ?></td>
									<td><a href="<?php echo site_url('owner/remove/'.$bookMark->job_id); ?>"><?php echo $this->lang->line('Remove');?></a></td>
									<td>
								  <?php  if($bookMark->flag == 0)
								  
								 {
								 echo "Job"; }
								 else
								 {
								 echo "Job";
								 }?>
								  
								  </td>
									
								  </tr>
                          <?php		
						  			$i++;						
								}//For Each End - Latest Job Traversal															
							}//If - End Check For Latest Jobs
							else{
							
							echo "<tr><td colspan='9'><p class='clsNoResult'>".$this->lang->line('No Jobs')."</p></td></tr>";
							}
						  ?>
                              </tbody></table>		
							  <?php if(isset($pagination1)) echo $pagination1;?>
							  
							 <!--END OF PAGING-->
                          </div>
      </div>
      <!--END OF POST JOB-->
    </div>
<!--END OF MAIN-->
  </div>  </div>
  
  </div></div></div></div></div></div></div></div></div></div></div>
<?php $this->load->view('home_footer'); ?>