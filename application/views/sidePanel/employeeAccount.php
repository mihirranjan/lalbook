      <!--SELSERVICES-->
	 
                          <div id="selLinks">
                            <h3><?php echo $this->lang->line('Welcome'); ?>,<?php if(is_object($loggedInUser))  echo substr($loggedInUser->user_name,0,15);?></h3>
							 <ul class="links">
							  <li><a href="<?php echo site_url('account'); ?>"><?php echo $this->lang->line('Manage Account'); ?></a></li>
                              <!--<li><a href="<?php echo site_url('employee/viewProfile/'.$loggedInUser->id); ?>"><?php echo $this->lang->line('view_profile'); ?></a></li>-->
							  <li><a href="<?php echo site_url('employee/editProfile'); ?>"><?php echo $this->lang->line('edit_profile'); ?></a></li>
							  <li><a href="<?php echo site_url('employee/viewMyJobs'); ?>"><?php echo $this->lang->line('bidding_on'); ?></a></li>
							  <li><a href="<?php echo site_url('employee/managePortfolio');?>"><?php echo $this->lang->line('manage_portfolio'); ?></a></li>
							  <li><a href="<?php echo site_url('subscription');?>"><?php echo $this->lang->line('Subscription'); ?></a></li>
							  <li class="clsNoborder"><a href="<?php echo site_url('users/logout'); ?>"><?php echo $this->lang->line('Logout'); ?></a></li>
                            </ul>
                          </div>

      <!--END OF SELSERVICES-->