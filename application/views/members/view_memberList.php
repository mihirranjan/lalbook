<?php $this->load->view('header'); ?>
<div class="clsMinContent clearfix">
<?php $this->load->view('sidebar'); ?>
<!--MAIN-->

<div id="main">
<!--DEPOSITE PAGE-->
<div  id="selDeposit">
	  <?php $this->load->view('view_accountMenu'); 
	  //public $role;
	 // pr($usersList);

	  $usersLists = $usersList;
	  $role = $loggedInUser->role_id;
	  ?>
	  <div class="clsTabs clsInnerCommon clsUserList">
       
						  <div class="clsEditProfile clsSitelinks"> 
							<h3><span class="clsTransfer"><?php echo $this->lang->line('Member List');?></span></h3>      
							                        
							  <?php
								//Show Flash Message
								if($msg = $this->session->flashdata('flash_message'))
								{
									echo $msg;
								}
								
								?>
								
							<p class="clsSitelinks"><span>
							   <?php echo '<b>'.$this->lang->line('Member').'</b>';?> :</span>
									<a class="glow" href="<?php if($loggedInUser->role_id == '1') { echo site_url('owner/viewProfile/'.$loggedInUser->id);   } 
									   if($loggedInUser->role_id == '2') 
										 { 
										   echo site_url('owner/viewProfile/'.$loggedInUser->id);
										 } ?>" >
										<?php echo $loggedInUser->user_name; ?>
									</a>
									<?php 
							 $condition1=array('subscriptionuser.username'=>$loggedInUser->id);
								$certified1= $this->credential_model->getCertificateUser($condition1);
								if($certified1->num_rows()>0)
			                    {
							       foreach($certified1->result() as $certificate)
				                     {
									$user_id=$certificate->username;
									$id=$certificate->id;
									$condition=array('subscriptionuser.flag'=>1,'subscriptionuser.id'=>$id);
					                $userlists= $this->credential_model->getCertificateUser($condition);
									// get the validity
									$validdate=$userlists->row();
									$end_date=$validdate->valid; 
									$created_date=$validdate->created;
									$valid_date=date('d/m/Y',$created_date);
								    $next=$created_date+($end_date * 24 * 60 * 60);
									$next_day= date('d/m/Y', $next) ."\n";
							        if(time()<=$next)
								    {?>
								<img src="<?php echo image_url('certified.gif');?>"  title="<?php echo $this->lang->line('Certified Member') ?>" alt="<?php  echo $this->lang->line('Certified Member')?>"/>
								<?php } 
								  }
								   }?>

									</p>
							   <p><span><?php echo '<b>'.$this->lang->line('member id').'</b>';?> :</span> <?php echo $loggedInUser->id;  ?></p>
						</div>
							<h3><span class="clsMyOpen"><?php echo $this->lang->line('favorite member');?></span></h3>
							<table width="96%" cellspacing="1" cellpadding="2">
                                <tbody><tr>
                                  <td width="11%" class="dt"><?php echo '<b>'.$this->lang->line('Member Id').'</b>'; ?> </td>
                                  <td width="50%" class="dt"><?php echo '<b>'.$this->lang->line('Member Name').'</b>'; ?></td>
								  <td width="20%" class="dt">Move</td>
								  <td width="15%" class="dt">Option</td>
                                </tr>
                                
								<?php if(isset($favouriteUsers) and $favouriteUsers->num_rows()>0)
							    {
							   
							    $i=0;
							    foreach($favouriteUsers->result() as $res)
								 { 
								 if( $res->user_role == '1')
								 {  
						         $i=$i+1; 
								  if($i%2 == 0)
								    {
								    $class ="dt1 dt0";
									$class1 = "dt1";
									}
								  else
								    {
								    $class ="dt2 dt0";	
									$class1 = "dt2";
									}
										?> 
										<tr class="<?php echo $class; ?>">
										<td><?php echo $res->user_id; ?> </td>
										<td><?php
										  foreach($usersList as $users)
										   { 
											 if($res->user_id == $users->id) 
											   {  ?>
												 <a href="<?php if($users->role_id == '1') { echo site_url('owner/viewProfile/'.$users->id);   } 
												   if($users->role_id == '2') 
												   { 
													 echo site_url('employee/viewProfile/'.$users->id);
													} ?>">
													<?php echo $users->user_name;?>
													<?php $condition=array('subscriptionuser.username'=>$res->id);
								$certified= $this->credential_model->getCertificateUser($condition);?>
													<?php 
							 $condition1=array('subscriptionuser.username'=>$loggedInUser->id);
								$certified1= $this->credential_model->getCertificateUser($condition1);
								if($certified1->num_rows()>0)
			                    {
							       foreach($certified1->result() as $certificate)
				                     {
									$user_id=$certificate->username;
									$id=$certificate->id;
									$condition=array('subscriptionuser.flag'=>1,'subscriptionuser.id'=>$id);
					                $userlists= $this->credential_model->getCertificateUser($condition);
									// get the validity
									$validdate=$userlists->row();
									$end_date=$validdate->valid; 
									$created_date=$validdate->created;
									$valid_date=date('d/m/Y',$created_date);
								    $next=$created_date+($end_date * 24 * 60 * 60);
									$next_day= date('d/m/Y', $next) ."\n";
							        if(time()<=$next)
								    {?>
								<img src="<?php echo image_url('certified.gif');?>"  title="<?php echo $this->lang->line('Certified Member') ?>" alt="<?php  echo $this->lang->line('Certified Member')?>"/>
								<?php } 
								  }
								   }?>

												<?php 	
													 break; 
												}
											} //foreach end here   ?>
												 </a>
										 </td>
										<td>
										  <a href="<?php echo site_url('memberList/changeUser/'.$res->user_id); ?>">
										  <?php echo $this->lang->line('move block'); ?>
										  </a>
										</td>
										<td>
										  <a href="<?php echo site_url('memberList/deleteUser/'.$res->user_id); ?>">
										  <?php echo $this->lang->line('Delete'); ?>
										  </a>
										</td></tr>
										 <?php 	
										 
									  }
								  }
							  } else{ ?>
									<tr><td colspan="4"><p class="clsNoResult"><?php echo  'No Results Found.';?></p></td></tr>
								<?php }?>	  	  	
			
								</tbody>
							</table>
							 <form name="add_favourite_list" action="<?php echo site_url('memberList/addFavourite'); ?>" method="post">
							  <p style="padding-left:0 !important;"><label style="float:left;width:180px;text-align:left;display:block;"><?php 
							  if($loggedInUser->role_id == '2')
								{
								   echo $this->lang->line('Add Owner to favorites');
								}
							  if($loggedInUser->role_id == '1')
								{
								   echo $this->lang->line('Add Employee to favorites');
								}	
							  ?></label>
							  <input type="hidden" name="role" value="1">
							  <input type="hidden" name="creator_id" value="<?php echo $loggedInUser->id; ?>" />
							  <input type="hidden" name="creator_role" value="<?php echo $loggedInUser->role_id; ?>" />
							  <input type="text" name="add_favourite" value="<?php echo set_value('add_favourite'); ?>"/><?php echo form_error('add_favourite'); ?>							</p>
							  <p class="clsRight" style="padding-left:0 !important;"><label style="float:left;width:180px;text-align:left;display:block;">&nbsp;</label><input style="margin:0 !important;" type="submit" name"addBlock" class="clsLoginbig_but" value="<?php echo $this->lang->line('Add Member');?>" /></p>
							  

						  </form>
							<h3><span class="clsMyClose"><?php echo $this->lang->line('Blocked member');?></span></h3>
							<table width="96%" cellspacing="1" cellpadding="2">
                                <tbody><tr>
                                  <td width="11%" class="dt"><?php echo '<b>'.$this->lang->line('Member Id').'</b>'; ?> </td>
                                  <td width="50%" class="dt"><?php echo '<b>'.$this->lang->line('Member Name').'</b>'; ?></td>
								   <td width="20%" class="dt">Move</td>
								  <td width="15%" class="dt">Option</td>
                                </tr>
							
								
                  <?php if(isset($favouriteUsers) and $favouriteUsers->num_rows()>0)
			      {
				   
				   $i=0;
				   foreach($favouriteUsers->result() as $res)
				     { 
					   if( $res->user_role == '2')
					     {  
						         $i=$i+1; 
								  if($i%2 == 0)
								    {
								    $class ="dt1 dt0";
									$class1 = "dt1";
									}
								  else
								    {
								    $class ="dt2 dt0";	
									$class1 = "dt2";
									}
						  
										?>
										<tr class="<?php echo $class; ?>">
										<td><?php echo $res->user_id; ?> </td>
										<td><?php
										  foreach($usersList as $users)
										   { 
											 if($res->user_id == $users->id) 
											   {  ?>
												 <a href="<?php if($users->role_id == '1') { echo site_url('owner/viewProfile/'.$users->id);   } 
												   if($users->role_id == '2') 
												   { 
													 echo site_url('employee/viewProfile/'.$users->id);

													} ?>"><?php echo $users->user_name;?>
													<?php 
							  $condition1=array('subscriptionuser.username'=>$users->id);
								$certified1= $this->credential_model->getCertificateUser($condition1);
								if($certified1->num_rows()>0)
			                    {
									// get the validity
									$validdate=$certified1->row();
									$end_date=$validdate->valid; 
									$created_date=$validdate->created;
									$valid_date=date('d/m/Y',$created_date);
								    $next=$created_date+($end_date * 24 * 60 * 60);
									$next_day= date('d/m/Y', $next) ."\n";
							        if(time()<=$next)
								    {?>
								<img src="<?php echo image_url('certified.gif');?>"  title="<?php echo $this->lang->line('Certified Member') ?>" alt="<?php  echo $this->lang->line('Certified Member')?>"/>
								<?php } 
								   }
								   
								   

													break; 
												}
											} //foreach end here   ?>
												 </a>
										 </td>
										<td>
										  <a href="<?php echo site_url('memberList/changeUser/'.$res->user_id); ?>">
										  <?php echo $this->lang->line('move favourite'); ?>
										  </a>
										</td>
										<td>
										  <a href="<?php echo site_url('memberList/deleteUser/'.$res->user_id); ?>">
										  <?php echo $this->lang->line('Delete'); ?>
										  </a>
										</td></tr>
										 <?php 	
										 
									  }
								  }
							  } else{ ?>
									<tr><td colspan="4"><p class="clsNoResult"><?php echo  'No Results Found.';?></p></td></tr>
								<?php }?>  	  	
			
								</tbody>
							</table>
					 
							<form name="add_block_list" action="<?php echo site_url('memberList/addBlock'); ?>" method="post">
								 <p style="padding-left:0 !important;"> <label style="float:left;width:145px;text-align:left;display:block;"><?php 
								  if($loggedInUser->role_id == '2')
									{
									   echo $this->lang->line('Blacklist a Owner');
									}
								  if($loggedInUser->role_id == '1')
									{
									   echo $this->lang->line('Blacklist a Employee');
									}	
								  ?></label>
								  <input type="hidden" name="role" value="2">
								  <input type="hidden" name="creator_id" value="<?php echo $loggedInUser->id; ?>" />
								  <input type="hidden" name="creator_role" value="<?php echo $loggedInUser->role_id; ?>" />
								  <input type="text" name="add_block" value="<?php echo set_value('add_block'); ?>"/><?php echo form_error('add_block'); ?></p>
								  
								<p class="clsRight" style="padding-left:0 !important;"><label style="float:left;width:145px;text-align:left;display:block;">&nbsp;</label> <input type="submit"  style="margin:0 !important;" name"addBlock" class="clsLoginbig_but" value="<?php echo $this->lang->line('Ban Member');?>" /></p>
						    </form>
			 
							
                        
      	<div class="alignRight">
		</div>
	  </div>
      <!--END OF POST JOB-->
     </div>
	 </div></div></div>
<?php $this->load->view('footer'); ?>
