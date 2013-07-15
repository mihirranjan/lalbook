<div class="clsTab">
                      <ul class="clearfix">
					   <li  <?php if ( $_SERVER['REQUEST_URI'] == '/lalbook/index.php/account' ){ ?>class="clsActive" <?php } ?>><a href="<?php  echo site_url('account'); ?>">My Profile</a></li> 
                      <!--<li><a href="#">Browse</a></li>-->
                      <li  <?php if ( $_SERVER['REQUEST_URI'] == '/lalbook/index.php/mybusiness' ){ ?>class="clsActive" <?php } ?>><a href="<?php  echo site_url('mybusiness'); ?>">My Business</a></li>
                         <li  <?php if ( $_SERVER['REQUEST_URI'] == '/lalbook/index.php/messages/viewMessage' ){ ?>class="clsActive" <?php } ?>><a href="<?php  echo site_url('messages/viewMessage'); ?>">My Messages</a></li>
						   <!--<li><a href="<?php  echo site_url('requirement/create'); ?>"><?php echo $this->lang->line('Post Requirement'); ?></a></li>        -->       
                      </ul>
                      
                      </div>
					   