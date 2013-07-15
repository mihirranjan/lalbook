<?php $this->load->view('header_profile'); ?>

<div class="Container">
<div class="clsMinContent clearfix">
<!--MAIN-->
<?php
		$usersInbox = $usersInbox;
		//Get the outbox mails
		$usersOutbox = $usersOutbox;
?>
<?php $innerClass='selected';?>

  <link rel="stylesheet" href="<?php echo base_url();?>application/css/css/jquery-ui.css">
   <script src="<?php echo base_url();?>application/js/jquery-ui.js"></script>
<div class="clsMinContent clearfix">
<?php //$this->load->view('sidebar'); ?>
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
                        <div class="clsAccDetails">
                          <ul class="clearfix">
                            <?php  if(isset($userrecords) and $userrecords->num_rows()>0)
						 {
						 //print_r($buyrequirement);
						
						  foreach($userrecords->result() as $requirementbid)
						    {
							
							$usrcredits=$requirementbid->credit;
							//print_r($usrcredits);
							}
							//echo $usrcredits;
							?>
							<form name="credit" method="post">
							<input type="hidden" value="<?php echo $usrcredits;?>" id="creditavailable" />
							</form>
                            <li <?php if($usrcredits!=0) { echo 'class="clsNoBorder"';} ?>>Bidding credits Available:<span> <?php echo $usrcredits;?>&nbsp;credits</span></li>
                            <?php if($usrcredits==0) 
					  {
					  ?>
                            <li class="clsNoBorder"><a href="#">Refill</a></li>
                            <?php } 
					  }?>
                          </ul>
                        </div>
                        <?php $this->load->view('view_innermenu'); ?>
                      </div>
<div id="Innermain">
      <!--POST JOB-->
      <div class="clsInnerpageCommon">        
                            <div class="clsInnerCommon">

                        <!--<div class="clsEditProfile clsSitelinks">
                          <h3><span class="clsPMB"><?php echo $this->lang->line('Job Mail Board'); ?></span></h3>-->
						  <?php //print_r($project->id);exit;?>
                          <!--<p class="clsSitelinks"><span><?php echo $this->lang->line('user');?>:</span> <a class="glow" href="<?php if($loggedInUser->role_id == '1') $res = 'owner';  echo site_url($res.'/viewprofile/'.$loggedInUser->id); ?>"> <?php echo $loggedInUser->user_name; ?></a>
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
                          <p><span><?php echo $this->lang->line('User ID:');?></span> <?php echo $this->loggedInUser->id; ?></p>-->
                          <?php 
							  
								 if($msg = $this->session->flashdata('flash_message'))
									{
									echo $msg;
									}
							?>
                      
                        <!--  <form action="<?php echo site_url('messages/searchInbox'); ?>" method="post">
                            <input type="hidden" value="<?php echo $logged_userrole; ?>" name="user_role"/>
                            <input type="hidden" value="<?php echo $loggedInUser->id; ?>" name="logged_id"/>
                            <p>
                              <input type="text" name="keyword" value="" id="keyword" />
                              <select name="searchmail"  id="userinfo">
                                <option name="projectid" value="projectid">Job Id</option>
                                <?php 
							 if($logged_userrole == '2')
							   { ?>
                                <option name="user" value="user">Owner</option>
                                <?php 
							   } 
							if($logged_userrole == '1')	
							   { ?>
                                <option name="user" value="user">Employee</option>
                                <?php
							   } ?>
                              </select>
                              <input type="submit" value="<?php echo $this->lang->line('Go');?>" class="clsMini"/>
                            </p>
                          </form>
						  <br />
                        </div>-->
					 <script>
$(function() {
$( "#tabs" ).tabs();
});
</script>







	
                  <div class="clsSearchResults">
                  
                  <h3>Messages</h3>
                  <div class="clsBusinessOption">
                    <ul class="clearfix">
                        <form id="message-mode-form" name="messagemode-form" method="post" action="<?php echo site_url('messages/viewMessage') ?>">
                          <li>
                            <input type="radio" <?php if($this->session->userdata('message_mode') == 'buyer') echo 'checked' ?> id="buyerview" name="message-mode" value="buyer" class="clsRadio mmode">
                            Buyer View</li>
                          <li>
                            <input type="radio" <?php if($this->session->userdata('message_mode') == 'seller') echo 'checked' ?> id="sellerview" name="message-mode" value="seller" class="clsRadio mmode">
                            Seller View</li>
                        </form>
                      </ul>  
                    </div>
                  <div class="MsgSearch">
                  <p>
				  <form method="post" action="<?php echo site_url('messages/searchMessage');?>">
				  <input type="text" class="clsMsgTxt" placeholder="User Name" onblur="placeholder='User Name'" onfocus="placeholder=''" name="keyword" /><input type="submit" class="clsMsgBut" value="Submit" />
				  </form>
				  </p>
                  </div>
                  
                  
						<div id="tabs">
<ul style="left:0; width: auto;">
<li><a href="#tabs-1">InBox</a></li>
<li><a href="#tabs-2">OutBox</a></li>

</ul>
				  <div id="tabs-1">
                        <p> <a href="<?php echo site_url('messages/createMessage'); ?>" class="buttonBlackShad"><?php echo $this->lang->line('Compose Job Mail Board');?></a><?php //echo $this->lang->line('user_inbox'); ?><span style="position: relative; top: 7px; left: 10px; right: 0px;">
                        <?php echo $this->lang->line('Message Received:');?><b style="color:#c00000;">
                          <?php if(isset($totalInbox)) echo $totalInbox; ?>
                          </b></span><p>
                          
                          
                        <br /><br/>
						    <?php 
							  //Show Flash error Message  for keyword field is empty
								 if($msg1 = $this->session->flashdata('flash_message1'))
									{
									echo $msg1;
									}
							?>
						
						  <form name="frminbox" action="<?php echo site_url('messages/deleteInbox'); ?>" method="post">
                        <table class="clsSearchTable" width="100%" cellspacing="1" cellpadding="2">
                          <tbody>
                            <tr>
							 <th width="5%" class="dt" align="center"><?php echo $this->lang->line('Delete'); ?></th>
                              <th width="10%" class="dt"><?php echo $this->lang->line('Job Id'); ?></th>
                              <th width="20%" class="dt"><?php echo 'From'; ?></th>
                              <th width="20%" class="dt"><?php echo $this->lang->line('Job Title'); ?></th>
                              <th width="15%" class="dt"><?php echo $this->lang->line('Time'); ?></th>
                              <th width="30%" class="dt" ><?php echo $this->lang->line('Message'); ?></th>
                            </tr>
                            <?php
						  	$total_inbox=0;
									$noshow_total=0;
									//echo $totalOutbox;
									//echo $totalInbox;exit;
						  	if(isset($usersInbox) and $totalInbox>0)
							{
							
								
								$i=0; $j=0;			 
								 ?>
                            <?php
								
									 foreach($usersInbox as $Inbox)
									   { 
									 //  print_r($Inbox);
									   		$total_inbox++;
											
											$deluserid=$Inbox->deluserid;
											$show='yes';
											if($deluserid!='')
											{
											$deluseridarr=explode(',',$deluserid);
											foreach($deluseridarr as $val)
											{
												if($val==$loggedInUser->id)
												{
													$noshow_total++;
													$show='no';
												}
											}
											}
											if($show=='yes')
											{
									   
									   $j=$j+1;
										if($j%2 == 0)
										 {
										  $class  = 'dt1 dt0';
										  $class2 = 'dt1';
										 }
										else
										 {
										  $class  = 'dt2 dt0'; 
										  $class2 = 'dt2';
										 }
										?>
                            <tr class="<?php echo $class; ?>">
							  
                              <?php
									 if(isset($keyword)) 
									   {  
										 if($keyword == $Inbox->job_id or $keyword == '' or $keyword == $Inbox->user_name)    
									        {	?>
                              <div id="masterdiv">
                                 <td width="5%"  align="center">
                                    <input type="checkbox" name="inbox[]"  value="<?php echo $Inbox->message_id; ?>" id="inbox"/>  
                                 </td>
                                <td class="<?php echo $class2; ?>">
                                    <a href="<?php echo site_url('job/view/'.$Inbox->job_id); ?>">
                                        <?php echo $Inbox->job_id; ?></a> 
                                </td>
                                <td class="<?php echo $class2; ?>">
                                <?php 
                                foreach($usersList as $userlist)
                                {
                                    if($userlist->id == $Inbox->from_id )
                                    { ?>
                                        <a href="<?php if($userlist->role_id == '2') echo site_url('users/view/'.$userlist->id); 
                                            else echo site_url('users/view/'.$userlist->id); ?>">
                                        <?php echo $userlist->user_name; ?></a>
                                        <?php break;
                                    }
                                }?>
                                </td>
                                <td class="<?php echo $class2; ?>"><?php 
													 
													foreach($projectList as $plist)
													{
														if($plist->id == $Inbox->job_id )
														  {
															 $len=strlen($plist->looking_for); 
																if($len < 10 )
																  { ?>
                                  <a href="<?php echo site_url('job/view/'.$plist->id) ?>" title="<?php echo $plist->looking_for; ?>"><?php echo $plist->looking_for; ?> </a>
                                  <?php 
																  }
																else
																   {
																		$out = substr($plist->looking_for,0,10).'...';  ?>
                                  <a href="<?php echo site_url('job/view/'.$plist->id) ?>" title="<?php echo $plist->looking_for; ?>"><?php echo $plist->looking_for; ?> </a>
                                  <?php 
																   }
													 
															break;
														  } //if end here
													} //foreach end here ?>
                                </td>
                                <td><?php echo get_date($Inbox->created); ?> </td>
                                <td class="<?php echo $class2; ?>"><a href="<?php echo site_url('job/view/'.$Inbox->job_id); ?>">
                                  <?php $len=strlen($Inbox->message); 
														if($len < 25 )
														{
														   //echo $Inbox->message; 
														   }
														else
														   { ?>
                                  <div class="" onClick="return SwitchMenu('sub<?php echo $res = rand(5, 10000);?>')"> <?php echo substr($Inbox->message,0,25).'...';  ?></div>
                                  <?php  
														   }  
													 ?>
                                  </a><!--</td>-->
                                <!--<td class="<?php echo $class2; ?> dt4">--><p class="clsMailMsg"><span class="submenu" id="sub<?php echo $res;?>" style="display:none">
                                    <?php 
															//echo '<p class="clsNoResult">'.$Inbox->message.'</p>'; 
															 //inner if end here
															$i=$i+1;
																?>
                                    <a href="">Reply</a> </span></p></td>
                               
                              </div>
							  </tr>
                              <?php 
										    }
											
										   
										 } 
										 
										 else 
										 
										 { 
												if($j%2 == 0)
												 {
												  $class  = 'dt1 dt0';
												  $class2 = 'dt1';
												  }
												else
												  {
												  $class  = 'dt2 dt0'; 
												  $class2 = 'dt2';
												  }
												?>
												 <tr class="odd <?php echo $class; ?>">
                              <div id="masterdiv">
                               
                                    <td width="5%"  align="center" class="<?php echo $class2; ?>">
                                        <input type="checkbox" name="inbox[]"  value="<?php echo $Inbox->message_id; ?>"> 

                                    </td>
                                    <td class="<?php echo $class2; ?>"><a href="<?php echo site_url('job/view/'.$Inbox->job_id); ?>">
                                      <?php 
															  echo $Inbox->job_id;
																 
																  ?>
                                      </a> </td>
                                    <td class="<?php echo $class2; ?>"><?php 
													foreach($usersList as $userlist)
													{
													//echo $userlist->id;
														if($userlist->id == $Inbox->from_id )
														  { ?>
                                      <a href="<?php if($userlist->role_id == '2') echo site_url('users/view/'.$userlist->id); else echo site_url('users/view/'.$userlist->id); ?>">
                                      <?php 
															  echo $userlist->user_name; ?>
                                      </a>
                                      <?php 
															break;
														  }
													}?>
                                    </td>
                                    <td class="<?php echo $class2; ?>"><?php 
													 
													foreach($projectList as $plist)
													{
														if($plist->id == $Inbox->job_id )
														  {
															 $len=strlen($plist->looking_for); 
																if($len < 20 )
																  { ?>
                                      <a href="<?php echo site_url('job/view/'.$plist->id) ?>" title="<?php echo $plist->looking_for; ?>"><?php echo $plist->looking_for; ?> </a>
                                      <?php 
																  }
																else
																   {
																	$out = substr($plist->looking_for,0,20).'...';  ?>
                                      <a href="<?php echo site_url('job/view/'.$plist->id) ?>" title="<?php echo $plist->looking_for; ?>"><?php echo $out; ?> </a>
                                      <?php 
																   }
													 
															break;
														  }
													}?>
                                    </td>

									
                                    <td class="<?php echo $class2; ?>"><?php echo get_date($Inbox->created); ?> </td>
                                    <td class="<?php echo $class2; ?> dt4">
                                      <?php $len=strlen($Inbox->message); 
														/*if($len < 35 )
														   echo $Inbox->message; 
														else
														   {*/ ?>
                                      <div class="" onClick=""> <a  title="click To Read" href = "javascript:void(0)" onclick = "toggleMessage(<?php echo $Inbox->message_id ?>)").style.display='block'"><?php echo substr($Inbox->message,0,35).'...';  ?></a>
									  
                    <div id="light<?php echo $Inbox->message_id;?>" class="white_content"><a href = "javascript:void(0)" onclick = "document.getElementById('light<?php echo $Inbox->message_id;?>').style.display='none';document.getElementById('fade').style.display='none'"><img src="<?php echo image_url();?>/closebox.png" alt="close"  style="border: medium none;
    float: right;left: 15px;margin: 0;position: relative;top: -15px;" align="right"></a><p><?php echo $Inbox->message;  ?></p></div>
	<div id="fade" class="black_overlay"></div>					  
									  <!--<div id="Popup">
 <?php /*$msg_id=$Inbox->to_id;
 $query = "update message set notification_status='0'  where to_id=$msg_id";
$res = $this->db->query($query);*/?>
	        <div class="closed"></div>
	        <span class="ecsp_tooltip">Press Esc to close <span class="arrow"></span></span>
	        <div id="pop_content"> 
			
			<p><?php echo $Inbox->message;  ?></p>
		
	        </div> <!--your content end-->
	 
	    <!--</div>--> <!--toPopup end--><!--</div>-->
                                      <?php  
														 //  }
																										
														
														 
													 ?>
                                      <a href="<?php echo site_url('messages/replyMessage/'.$Inbox->message_id); ?>" style="color:#0000FF">Reply</a>
                                      </p>
									  
                                      <p class="clsMailMsg"><span class="submenu" id="sub<?php echo $res;?>" style="display:none">
                                        <?php 
														//	echo '<p class="clsNoResult">'.$Inbox->message.'</p>'; 
															 //inner if end here
															$i=$i+1;
																?>
                                        </span></p></td>
										
                              </div>
							 </tr>
                             <tr id="message<?php echo $Inbox->message_id;?>" class="hidden dt2">
                                <td colspan="6" align="left">
                                    <p  class="message-box" width="100%">
                                        <?php echo $Inbox->message; ?>
                                    </p>
                                </td>
                             </tr>                             
                              <?php 
										    }    ?>
                            
                              <?php 
						  
						  	
						  			$i++;
									
								}	?>  <?php			//If - End Check For inbox display					
							}//For Each End - Latest Job Traversal		
							if($noshow_total==$total_inbox)
							{
								echo '<td colspan="6">'.$this->lang->line('Inbox is Empty').'</td>';
							}	
							}//If - End Check For Latest Jobs
							
							else
							{
								echo '<td colspan="6">'.$this->lang->line('Inbox is Empty').'</td>';
							}
						  ?>
                            </tr>
						<?php
							if(($noshow_total!=$total_inbox)  and ($totalInbox>0) ) 
							{  ?>
					<!--			<tr class="dt3">
							<td colspan="6" align="left">
							
							</td>
							</tr>-->
							<?php }	?>  
                          </tbody>
                        </table>
                        <p><input class="clsRefresh_but" type="submit" value="<?php echo $this->lang->line('Delete');?>" name="Delete" id="del" /></p>
						</form>
						
					<?php if(isset($pagination_inbox)) echo $pagination_inbox;?>
                    </div>
					


						
						<div id="tabs-2">
                        <p><a href="<?php echo site_url('messages/createMessage'); ?>" class="buttonBlackShad"><?php echo $this->lang->line('Compose Job Mail Board');?></a></span><?php //echo $this->lang->line('user_outbox'); ?><span style="position: relative; top: 7px; left: 10px; right: 0px;"><?php echo $this->lang->line('Message Posted:');?> <b style="color:#c00000;">
                          <?php if(isset($totalOutbox)) echo $totalOutbox; ?>
                          </b></span></p>
                        <br />
						     <?php 
							  //Show Flash error Message  for keyword field is empty
								 if($msg2 = $this->session->flashdata('flash_message2'))
									{
									echo $msg2;
									}
							?>
						
						    <form name="frmoutbox" action="<?php echo site_url('messages/deleteOutbox'); ?>" method="post">
                        <table class="clsSearchTable" width="100%" cellspacing="1" cellpadding="2">
                          <tbody>
                            <tr>
							 <th width="5%" class="dt" align="center"><?php echo $this->lang->line('Delete'); ?></th>
                              <th width="10%" class="dt"><?php echo $this->lang->line('Job Id'); ?></th>
                              <th width="20%" class="dt"><?php echo 'From'; ?></th>
                              <th width="20%" class="dt"><?php echo $this->lang->line('Job Title'); ?></th>
                              <th width="15%" class="dt"><?php echo $this->lang->line('Time'); ?></th>
                              <th width="30%" class="dt" ><?php echo $this->lang->line('Message'); ?></th>
                            <!-- <th width="10%" class="dt"><?php echo $this->lang->line('Message'); ?></th>-->
                            </tr>
                            <?php
							$total_outbox=0;
									$noshow_total=0;
						  	if(isset($usersOutbox) and $totalOutbox>0)
							{
							
									 	
								$i=0; $k=0;
								?>
                            <?php foreach($usersOutbox as $outbox)
								{
								$total_outbox++;
								$deluserid=$outbox->deluserid;
											$show='yes';
											if($deluserid!='')
											{
											$deluseridarr=explode(',',$deluserid);
											foreach($deluseridarr as $val)
											{
												if($val==$loggedInUser->id)
												{
													$noshow_total++;
													$show='no';
												}
											}
											}
											if($show=='yes')
											{
									if($i%2==0)
										$class = 'dt1 dt0';
									else 
										$class = 'dt2 dt0';
									?>
                            <?php 
							
								  $i=1; $k=$k+1; 
								   if($k%2==0)
								      {
										$class = 'dt1 dt0';
										$class2= 'dt1';
									  }	
									else 
									  {
										$class = 'dt2 dt0';
										$class2= 'dt2';
									  }	
								   ?>
                          <div id="masterdiv">
						  <?php 
									foreach($usersList as $userlist)
									{
									//print_r($outbox);exit;
										if($userlist->id == $outbox->to_id )
										  {
											?>
                            <tr class="odd <?php echo $class; ?>">
							   <td width="5%"  align="center" class="<?php echo $class2; ?>"><input type="checkbox" name="outbox[]"  value="<?php echo $outbox->message_id; ?>"> </td>
                              <td class="<?php echo $class2; ?>"><a href="<?php echo site_url('job/view/'.$outbox->job_id); ?>"> <?php echo $outbox->job_id; ?></a> </td>
                              <td class="<?php echo $class2; ?>">
                                <a href="<?php if($userlist->role_id == '1') echo site_url('users/view/'.$userlist->id); ?>">
                                <?php 
															  echo $userlist->user_name; ?>
                                </a>
                                
                              </td>
                              <td class="<?php echo $class2; ?>"><?php 
									 
									foreach($projectList as $plist)
									{
										if($plist->id == $outbox->job_id )
										  {
											 $len=strlen($plist->looking_for); 
												if($len < 20 )
												  { ?>
                                <a href="<?php echo site_url('job/view/'.$plist->id) ?>" title="<?php echo $plist->looking_for; ?>"><?php echo $plist->looking_for; ?> </a>
                                <?php 
												  }
												else
												   {
														$out = substr($plist->looking_for,0,20).'...';  ?>
                                <a href="<?php echo site_url('job/view/'.$plist->id) ?>" title="<?php echo $plist->looking_for; ?>"><?php echo $out; ?> </a>
                                <?php 
												   }
									 
											break;
										  }
									}?>
                              </td>
                              <td class="<?php echo $class2; ?>"><?php echo get_date($outbox->created); ?> </td>
                              <td class="dt4 <?php echo $class2; ?>">
                                <?php 
									    
									   /* $len=strlen($outbox->message); 
										if($len < 30)
										    echo $outbox->message; 
										else
										   {*/ ?>
                                <div class="" onClick="return SwitchMenu('sub<?php echo $res = rand(5, 10000);?>')"> <a href = "javascript:void(0)" onclick = "document.getElementById('light<?php echo $outbox->message_id; ?>').style.display='block';document.getElementById('fade').style.display='block'"><?php echo substr($outbox->message,0,30).'...';  ?></a>
					<div id="light<?php echo $outbox->message_id; ?>" class="white_content"><a href = "javascript:void(0)" onclick = "document.getElementById('light<?php echo $outbox->message_id; ?>').style.display='none';document.getElementById('fade').style.display='none'"><img src="<?php echo image_url();?>/closebox.png" alt="close"  style="border: medium none;
    float: right;left: 15px;margin: 0;position: relative;top: -15px;" align="right"></a><p><?php echo $outbox->message;  ?></p></div>
	<div id="fade" class="black_overlay"></div>			
    <!--<div id="Popup2">http://demo.maventricks.com/lalbook/application/css/images//closebox.png
 
	        <div class="closed2"></div>
	        <span class="ecsp_tooltip2">Press Esc to close <span class="arrow2"></span></span>
	        <div id="pop_content2"> 
			
			<p><?php echo $outbox->message;  ?></p>
		
	        </div>--> <!--your content end-->
	 
	    <!--</div> --><!--toPopup end--><!--</div>-->
                                <?php  
										   //}
									 ?>
                              
                                <p class="clsMailMsg"><span class="submenu" id="sub<?php echo $res;?>" style="display:none">
                                  <?php 
											//	echo '<p class="clsNoResult">'.$outbox->message.'</p>'; 
											 //inner if end here
											$i=$i+1;
											?>
                                  </span></p></td>
                          </div>
                          <?php 

									?>
                         
                          
                          <?php		
						  		$i++;						
								}
								}//For Each End - Latest Job Traversal		
								if($noshow_total==$total_outbox)
							{
								echo '<td colspan="6">'.$this->lang->line('Outbox is Empty').'</td>';
							}														
							}//If - End Check For Latest Job
							else
							{
								echo '<td colspan="6">'.$this->lang->line('Outbox is Empty').'</td>';
							}
						  ?>
                          </tr>
						  
						  
						  <?php } } else{ echo "<tr><td colspan='6'>"."Outbox is Empty"."</td></tr>";} ?>
						  	<?php	if(($noshow_total!=$total_outbox)  and ($totalOutbox>0)) 
							{  ?>
						<!--		<tr class="dt3">
							<td colspan="5" align="left">
							
							</td>
							</tr>-->
							<?php }	?>
						 
                          
                          </tbody>
                          
                        </table>
						
						<p><input class="clsRefresh_but" type="submit" value="<?php echo $this->lang->line('Delete');?>" name="Delete" /></p>
						</form>
                        <?php if(isset($pagination_outbox)) echo $pagination_outbox;?>
						</div>
						</div>
                      </div>
                    </div>
                    </div>
    
<!--END OF POST JOB-->
</div>
<!--script -->
<script type="text/javascript">
<!-- Function used to load the corresponding users to make transfer for corresponding job
// Argument                   --     Nil
//Return value                --     Employeename or ownername -->
function load_user()
{
	var url = '<?php echo site_url('transfer/load_users');?>';
	new Ajax.Updater('users_load', url,   {  method     : 'post',
	  parameters : { type_id : $('type_id').value },
	  onLoading  : function ()
	  {
		$('users_load').innerHTML = '<img alt="loading..." src="<?php echo base_url().'images/loading.gif' ?>" />';
	  }
}); //Ajax Object Creation End
													
} //Function load_category end
</script>
<script>
/*
new Ajax.Request('<?php echo site_url('job/showBids/'.$project->id); ?>',
  {
    method:'post',
    onSuccess: function(transport){
      var response = transport.responseText || "no response text";
      document.getElementById('sBids').innerHTML = response
    },
    onFailure: function(){ alert('Something went wrong...') }
  });
function amtSort(ord){
	new Ajax.Request('<?php echo site_url('job/showBids/'.$project->id); ?>'+'/'+ord,
	  {
		method:'get',
		onSuccess: function(transport){
		  var response = transport.responseText || "no response text";
		  document.getElementById('sBids').innerHTML = response
		},
		onFailure: function(){ alert('Something went wrong...') }
	  });
}*/
</script>
<style type="text/css">
.menutitle{
cursor:pointer;
margin-bottom: 5px;
background-color:#ECECFF;
color:#000000;
width:140px;
padding:2px;
text-align:center;
font-weight:bold;
/*/*/border:1px solid #000000;/* */
}

.submenu{
margin-bottom: 0.5em;
}
</style>
<script type="text/javascript">


var persistmenu="yes" 
var persisttype="sitewide"  

if (document.getElementById){ 
document.write('<style type="text/css">\n')
document.write('.submenu{display: none;}\n')
document.write('</style>\n')
}

function SwitchMenu(obj){
	if(document.getElementById){
		var el = document.getElementById(obj);
		var ar = document.getElementById("masterdiv").getElementsByTagName("span");  
		if(el.style.display == "none")
		{ 
		   el.style.display = "block";
		   return false;
		}
		else{
			el.style.display = "none";
		   return false;
		}
	}
}

function get_cookie(Name) {
var search = Name + "="
var returnvalue = "";
if (document.cookie.length > 0) {
offset = document.cookie.indexOf(search)
if (offset != -1) {
offset += search.length
end = document.cookie.indexOf(";", offset);
if (end == -1) end = document.cookie.length;
returnvalue=unescape(document.cookie.substring(offset, end))
}
}
return returnvalue;
}

function onloadfunction(){
if (persistmenu=="yes"){
var cookiename=(persisttype=="sitewide")? "switchmenu" : window.location.pathname
var cookievalue=get_cookie(cookiename)
if (cookievalue!="")
document.getElementById(cookievalue).style.display="block"
}
}

function savemenustate(){
var inc=1, blockid=""
while (document.getElementById("sub"+inc)){
if (document.getElementById("sub"+inc).style.display=="block"){
blockid="sub"+inc
break
}
inc++
}
var cookiename=(persisttype=="sitewide")? "switchmenu" : window.location.pathname
var cookievalue=(persisttype=="sitewide")? blockid+";path=/" : blockid
document.cookie=cookiename+"="+cookievalue
}

if (window.addEventListener)
window.addEventListener("load", onloadfunction, false)
else if (window.attachEvent)
window.attachEvent("onload", onloadfunction)
else if (document.getElementById)
window.onload=onloadfunction

if (persistmenu=="yes" && document.getElementById)
window.onunload=savemenustate

</script>
</div></div>
</div></div>
</div></div>
</div></div>
</div></div>
</div></div>
</div></div>
<?php $this->load->view('home_footer'); ?>
