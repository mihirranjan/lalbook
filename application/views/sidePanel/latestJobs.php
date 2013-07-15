<!--LATEST-->
<!--RC-->
 
                          <div id="selHelp">
                      <h3><?php echo $this->lang->line('Requirements');?></h3>
					  <ul class="links">
					   <?php
						  	if(isset($latestJobs) and $latestJobs->num_rows()>0)
							{
								$i=1;
								foreach($latestJobs->result() as $latestJob)
								{
						?>
                        <li <?php if($latestJobs->num_rows() == $i) 
						echo 'class="clsNoborder"';?>><a href="<?php echo site_url('job/view/'.$latestJob->id); ?>"><?php echo substr($latestJob->job_name,0,23); ?></a>
						 <?php if($latestJob->is_urgent == 1)
								  echo '&nbsp;<img src="'.image_url('urgent.png').'" width="16" height="16" title="Urgent job" alt="Urgent job" />';
								   if($latestJob->is_feature == 1)
								    echo '&nbsp;<img src="',image_url('featured.png').'" width="16" height="16" title="Featured job" alt="Featured job" />';
									if($latestJob->is_private == 1)
								    echo '&nbsp;<img src="',image_url('private.png').'" width="14" height="14" title="Private job" alt="Featured job" />';
									
						 ?>
						</li>
						 <?php		
						  			$i++;						
								}														
							} else{ ?>
									<li><?php echo  'No Results Found.';?></li>
								<?php }?>
						
						  </ul>
						  
                          </div>
       
<!--END OF RC-->
<!--END OF LATEST-->