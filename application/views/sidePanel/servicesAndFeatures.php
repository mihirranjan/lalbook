      <!--SELSERVICES-->
      <!--RC-->

                          <div id="selFeatures">
                            <h3><?php echo $this->lang->line('Services_And_Features');?></h3>
                            <ul class="links">
							<?php 
								if(!isEmployee())
								{
							?>
                              <li><a href="<?php echo site_url('requirement/create'); ?>"><?php echo $this->lang->line('Post buy Requirement');?></a></li>
 							 <?php  
							 }  
							 ?>
							  <?php //if($this->session->userdata('role') == 'admin'){?>
							 <!-- <li><a href="<?php echo site_url('users/login'); ?>"><?php echo $this->lang->line('Login');?> </a></li>
                              <li><a href="<?php echo site_url('owner/signup'); ?>"><?php echo $this->lang->line('SignUp');?> </a></li>
							  <?php //} ?>
                              <li><a href="<?php echo site_url('job/viewAllJobs/is_feature'); ?>"><?php echo $this->lang->line('Featured Jobs');?></a></li>-->
							  
							  <!--<li><a href="<?php echo site_url('cancel/openCase'); ?>"><?php echo $this->lang->line('Cancel Jobs');?></a></li>
                              <li><a href="<?php echo site_url('employee/topEmployees'); ?>"><?php echo $this->lang->line('Top Employees');?></a></li>
							  <li><a href="<?php echo site_url('owner/topOwners'); ?>"><?php echo $this->lang->line('Top Owners');?></a></li>
 							  <li class="clsNoborder"><a href="<?php echo site_url('?c=rss'); ?>"><?php echo $this->lang->line('RSS Feeds');?></a></li>-->
							
                            </ul>
                          </div>
         
      <!--END OF RC-->
      <!--END OF SELSERVICES-->