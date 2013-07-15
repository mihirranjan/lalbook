      <!--SELSERVICES-->

                          <div id="selLinks">
                             <h3><?php echo $this->lang->line('Welcome'); ?>,<?php if(is_object($loggedInUser))  echo $loggedInUser->user_name;?></h3>
                            <ul class="links">
							  <li><a href="<?php echo site_url('account'); ?>"><?php echo $this->lang->line('Manage Account'); ?></a></li>
 							 <!-- <li><a href="<?php echo site_url('owner/editProfile'); ?>"><?php echo $this->lang->line('edit_profile'); ?></a></li>-->
                               <li><a href="#<?php //echo site_url('owner/viewMyJobs'); ?>"><?php echo $this->lang->line('view my requirements'); ?></a></li>
							   <!-- <li><a href="<?php echo site_url('subscription');?>"><?php echo $this->lang->line('Subscription'); ?></a></li>-->
                               <li class="clsNoborder"><a href="<?php echo site_url('users/logout'); ?>"><?php echo $this->lang->line('Logout'); ?></a></li>
							  
                            </ul>
                      
      </div>
      <!--END OF SELSERVICES-->