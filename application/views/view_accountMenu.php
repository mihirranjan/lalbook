	  <!--POST JOB-->
<div align="right" class="clstop"><b><font color="#DD472C"><?php echo $this->lang->line('Local time');?> </font><?php echo show_date(get_est_time()); ?></b></div>
      <div class="slidetabsmenu">
	  <?php if(!isset($innerClass)) { $innerClass=''; } ?>
		<ul>
		 	<!--<li class="<?php if(isset($innerClass1)) { echo $innerClass1;}?>"><a href="<?php  echo site_url('messages/viewMessage'); ?>"><span><?php echo $this->lang->line('Mail');?></span></a></li>-->
			<li class="<?php if(isset($innerClass1)) { echo $innerClass1;}?>"><a href="<?php  echo site_url('myprofile'); ?>"><span><?php echo $this->lang->line('MyProfile');?></span></a></li>
			<li class="<?php if(isset($innerClass1)) { echo $innerClass1;}?>"><a href="<?php  //echo site_url('messages/viewMessage'); ?>"><span><?php echo $this->lang->line('MyBusiness');?></span></a></li>
			<!--<li class="<?php if(isset($innerClass1)) { echo $innerClass1;}?>"><a href="<?php  //echo site_url('messages/viewMessage'); ?>"><span><?php echo $this->lang->line('Browse');?></span></a></li>-->
			
			<!--<li class="<?php if(isset($innerClass1)) { echo $innerClass1;}?>"><a href="<?php  echo site_url('requirement/create'); ?>"><span><?php echo $this->lang->line('PostBuyRequirement');?></span></a></li>-->
		 
			
		 			
		 </ul>
		 <div  style='float:right; padding-right:10px;'>



	<label style="">Credit</label>
	<br />
	<label><?php if(isset($this->loggedInUser))
						 {
						$conditions		= array('users.id' => $this->loggedInUser->id,'users.role_id'=>'1');
						
		
		$usercredits 			= $this->user_model->getUsers($conditions);
		//print_r($usercredits);
						  foreach($usercredits->result() as $usercredit)
						    {
							$credt = $usercredit->credit;
							//print_r($usercredit);exit;
							?>
							<?php echo $credt;
?>
							</label>
							<?php } }?>

</div>
<div style="clear:both"></div>
		</div>
