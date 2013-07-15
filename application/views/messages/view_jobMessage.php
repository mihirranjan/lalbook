<?php $this->load->view('header'); ?>
<div class="clsMinContent clearfix">
<?php $this->load->view('sidebar'); ?>
<?php
		//Get Job Info
     	$project = $projects->row();
?>
<div id="main">
      <!--POST JOB-->
      <div class="clsInnerpageCommon">
       
                            <div class="clsInnerCommon">
                             <h2><?php echo $this->lang->line('Messages'); ?></h2>
							 <?php if($project->flag==0) { ?>
							  <h3><span class="clsFeatured"><?php echo 'Job Details'; ?></span></h3>
							  
							  <p><?php echo $this->lang->line('Project'); ?>: <a href="<?php echo site_url('job/view/'.$project->id); ?>"><?php echo $project->job_name; ?></a></p>
							 <br />
							  <h3><span class="clsPMB"><?php echo $this->lang->line('Job Message Board'); ?></span></h3><?php } else
							  {
							  ?>
							  <h3><span class="clsFeatured"><?php echo 'Job Details'; ?></span></h3>
							  
							  <p><?php echo $this->lang->line('Job'); ?>: <a href="<?php echo site_url('job/view/'.$project->id); ?>"><?php echo $project->job_name; ?></a></p>
						
							
							  <h3><span class="clsPMB"><?php echo $this->lang->line('Job Message Board'); ?></span></h3><?php }?>
							  
							   <div class="buttonwrapper" style="overflow:hidden;">
							   <p><a class="buttonBlackShad" href="<?php echo site_url('messages/post/'.$project->id); ?>"><span><?php echo $this->lang->line('Post Message'); ?></span></a></p></div>
                              <table cellpadding="2" cellspacing="1" width="96%">
							   <tr>
		 					  	  <td width="15%" class="dt"><?php echo $this->lang->line('Author'); ?></td>
								  <td width="30%" class="dt"><?php echo 'Date'; ?></td>
								  <td width="21%" class="dt"><?php echo 'Message Type'; ?></td>
								  <td class="dt" width="25%"><?php echo $this->lang->line('Message'); ?></td>
								  <td width="10%" class="dt" align="center"><?php echo $this->lang->line('Options'); ?></td>
							   </tr>
							  <?php $k=0; $i=0;
								if(isset($messages) and $messages->num_rows()>0)
								{
									foreach($messages->result() as $message)
									{
									  if($message->job_id == $project->id)
									   { $i++;
									   if($i%2==0)
									     {
										 	$class='dt1 dt0';
											$class2='dt1';
										 }
									   else
									     {
										 $class='dt2 dt0';
										 $class2='dt2';
										 }	 
							           ?>
									 <tr class=" odd <?php echo $class; ?>">
										  <td class="<?php echo $class2; ?>"><?php echo $message->user_name; $k= $k+1; ?></td>
										  <td class="<?php echo $class2; ?>"><?php echo '# '.$message->id.' posted '.get_datetime($message->created); ?></td>
										  
										  
										   <td class="<?php echo $class2; ?>"><?php
												$user = getUserInformation($message->to_id);
												 if($message->to_id =='0' and $message->job_id == $job->id)
												  {
													   ?>
														 <span class="clsMsgLink"><?php echo $this->lang->line('[');?><?php echo $this->lang->line('Message for Everyone'); 
												   } else {
											?>
										  
										 <?php echo $this->lang->line('[');?><?php echo $this->lang->line('private message for'); ?>
										   <?php
										   		 $user = getUserInformation($message->to_id);
												 if(is_object($user)) 
										   		 	echo $user->user_name;
													 }
											?><?php echo $this->lang->line(']');?></td>
									<td class="<?php echo $class2; ?>">
									 <?php
									 	if($loggedInUser == FALSE)
										{
											if(is_object($loggedInUser) and $loggedInUser->id==$message->from_id and $loggedInUser->id==$message->to_id or $message->to_id =='0')
											{ 
												?>
													<p class="clsAdd clsClearFix">
														<?php echo nl2br($message->message); ?>
													 </p>
												<?php
											}
										}
										else
										{
											if(is_object($loggedInUser) and $loggedInUser->id==$message->from_id or $loggedInUser->id==$message->to_id or $message->to_id =='0' and $message->job_id == $job->id)
											{ 
												?>
													<p class="clsAdd clsMailMsg">
														<?php echo nl2br($message->message); ?>
													 </p></td>
												<?php
											}
										}
										 }
										else
										{
										    $k=0;
																				
										}
										
										?>
										<td class="<?php echo $class2; ?>" align="center">
										<a href="<?php if(!isset($loggedInUser->id)) echo site_url('users/login'); else echo site_url('messages/replyMessage/'.$message->id); ?>">
										<?php 
										if(isset($loggedInUser->user_name)){
										if($message->user_name != $loggedInUser->user_name)
										{ echo $this->lang->line('Reply'); } 
										}
										?></a></td>
										<?php 
										
									}//Foreach End
								} else {
									?>
										<?php echo'<td colspan="5"><p class="clsNoResult">'.$this->lang->line('No Messages Posted').'</p></td>'; ?>
									<?php
								}//If End
							?>
							
							</tr>
							</table>
							<p align="right"><input type="button" name="goback" class="clsLogin_but" value="<?php echo $this->lang->line('Go Back'); ?>" onclick="history.go(-1)"/></p>
							 <!--PAGING-->
								<?php if(isset($pagination_inbox)) echo $pagination_inbox;?>
							 <!--END OF PAGING-->					 
                            </div>
                          </div>
    
      <!--END OF POST JOB-->
    </div>
<!--END OF MAIN-->
</div></div>
<?php $this->load->view('footer'); ?>
