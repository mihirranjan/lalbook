<?php $this->load->view('header'); ?>
<div class="clsMinContent clearfix">
<?php $this->load->view('sidebar'); ?>
<!--MAIN-->
<style>
.clsInnerCommon li{
	background:none!important;
	padding:0 !important;
}
.clsOptionalDetails li {
    list-style-type: none!important;
}
.clsOptionalDetails ul {
    padding-left: 1em !important;
}
.clsInnerCommon form p, .clsPostProject p, .clsInnerCommon p, .clsInnerCommon ul {
    padding-left: 0 !important;
}
.clsInnerCommon ul {
    padding-left: 2em !important;
}
.clsPostProject li ul {
    background: none repeat scroll 0 0 hsl(0, 0%, 97%);
    border-bottom: 1px dashed hsl(0, 0%, 87%);
    margin: 0 20px 10px 0;
    padding: 10px !important;
}
.clsFloatedList{
    clear: both;
    overflow: hidden;
    padding: 10px !important;
}
.clsPercent50 {
    width: 60%!important;
}
.clsPostProject li ul:hover{
background:#EFEDED;
}
.clsOptionalDetails li.clSNoBack ul:hover{
	background:#EFEDED;
	}
/*.clsOptionalDetails ul:hover{
	background:#EDF8FE;
}*/
li h5{
	margin-top:5px;
}
.clsPostProject label{
	float:left;
	width:120px;
	text-align:left;
	display:block;
}
</style>
<div id="main">
  <!--INNER NAVIGATION-->
  <!--END OF INNER NAVIGATION-->
  <!--POST A JOB-->
  <div class="clsPostProject">
      
                            <div class="clsInnerCommon clsSitelinks">
								<h2><?php echo $this->lang->line('Post a Job');?></h2>
								
								<?php 
								
							//Show Flash Error Message
							if($msg = $this->session->flashdata('flash_message'))
								{
								echo $msg;
								}
							  ?>
							  <?php
									//echo $project_name;
								?>
							   <?php $this->load->view('job/view_draft'); ?>
								<p> <?php echo $this->lang->line('note1');?> <a href="#"><?php echo $this->lang->line('Click here');?></a> <?php echo $this->lang->line('to post a job listing instead.');?> </p>
								<h3><span class="clsFileManager"><?php echo $this->lang->line('Account Login Details...');?></span></h3>

				<p class="clsSitelinks"><?php echo $this->lang->line('You are currently logged in as');?> <a class="glow" href="<?php if($loggedInUser->role_id == '1') $res = 'owner'; else $res = 'employee'; echo site_url($res.'/viewprofile/'.$loggedInUser->id); ?>"><?php if(isset($loggedInUser) and is_object($loggedInUser))  echo $loggedInUser->user_name;?></a><?php 

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


								 (<a href="<?php echo site_url('users/logout'); ?>"><?php echo $this->lang->line('Logout') ?></a>).</p>
								<form method="post" action="<?php echo site_url('job/create'); ?>"  enctype="multipart/form-data">
								<h3><span class="clsOptDetial"><?php echo $this->lang->line('Required Job Details...');?></span></h3>			 
															<?php 
								foreach($draftJobs->result() as $draft)
								  { 
								   if($draftJobsid == $draft->id)
									{  
									
									?>
									
									<ul>
									 <li>
									   <h5><?php echo $this->lang->line('Project Name');?></h5>
									   <p><?php echo $this->lang->line('Do not put a domain/URL in your job name.');?></p>
									   <p><input name="projectName" value="<?php echo $draft->job_name; ?>" maxlength="50" size="50" type="text"/></p>
									 </li>
									 <li>
										<h5><?php echo $this->lang->line('Describe the job in detail:');?></h5>
										<?php echo $this->lang->line('Do not post any contact info');?> ( <a href="#"><?php echo $this->lang->line('Why?');?></a> | <a href="#"><?php echo $this->lang->line('Review Terms');?></a> )
										<p>
										  <textarea rows="10" name="description" cols="70"><?php echo $draft->description; ?></textarea>
										   <?php //echo form_error('description'); ?>
										</p>
									  
										<p><?php echo $this->lang->line('Tip');?></p>
									 </li>	
									 <li>	
									  <?php echo $this->lang->line('Job Type: (Make up to 5 selections.)');?>
										 <!--OPTION LIST-->
								<?php
									 //calculate no of days to open
									 $no_of_days = count_days($draft->created,$draft->enddate) - 1;
									
									 $res = explode(',',$draft->job_categories);
										if(isset($groupsWithCategories) and count($groupsWithCategories)>0 )
										{
											foreach($groupsWithCategories as $groupsWithCategory)
											{
												if($groupsWithCategory['num_categories']>0)
												{				
													?>
													<p><u><?php echo $groupsWithCategory['group_name']?></u></p>
													<div id="selProgrammingOptions">
													  <table>
														  
													  <?php $i=0;
														foreach($groupsWithCategory['categories']->result() as $category)
														{  
														if($i%3 ==0)
															echo '<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
													  ?>
														<td><label><input onClick="count(this.form)" name="categories[]" value="<?php echo $category->id; ?>" <?php if(in_array($category->category_name,$res)) echo 'checked="checked"'; ?>
														   <?php //echo set_checkbox('categories[]', $category->id); ?> type="checkbox"/><?php echo $category->category_name;  ?>
														  </td>
													<?php if($i%3 ==2)
															 echo '</tr>';
														   $i = $i + 1; ?>					  
														
													<?php
														} //Foreach End - Traverse Category
													?>
													  </table>
													</div>
													<?php
												}//Check For Cateogry Availability
										} //For Each Travesal - For Group
									}//If End - Check For Group Existence
								?>
								<!--OPTION LIST end here-->
									</li>
									<li>	
										<p><b><?php echo $this->lang->line('I want my job to stay open for bidding for');?></b>
                                        
										<select name="openDays">
										<?php for($i=1;$i<=$project_period;$i++){?>
										<option value="<?php echo $i;?>" <?php if(isset($no_of_days)) { if($no_of_days == $i) echo "selected"; }?>><?php echo $i;?></option>
										<?php } ?>
										</select>&nbsp;<?php echo $this->lang->line('days');?></p>
										
										<!-- OPTIONAL JOB DETAILS-->
										
									  </li>
		<li><p><label><b>Country</b></label><select name="country" size="1"  onchange="getCountry(this.value)" style="width: 202px;">
		<option value="">Select</option>
		<?php
		
		if(isset($countries) and $countries->num_rows()>0)
		{
			foreach($countries->result() as $country)
			{
			
			//$post_country = $country->country_name;
			
			?>
 <option value="<?php echo $country->country_name; ?>"  <?php if($country->country_name==$draft->country) echo 'selected="selected"';?>><?php echo $country->country_name; ?>
 </option>
			<?php
			}
		//Foreach End
		}//If End
		?>
	</select>

	</p></li>
	
<li><p><label><b>State</b></label><input name="state" value="<?php echo $draft->state; ?>" size="30" type="text"/></p></li>

<li><p><label><b>City</b></label><input name="city" value="<?php echo $draft->city; ?>"  size="30" type="text"/></p></li>    

								  </ul>  
										 
										<h3><span class="clsInvoice"><?php echo $this->lang->line('Optional Job Details...');?></span></h3>
										  <ul class="NoBullet">
									
																<p><h5><?php echo $this->lang->line('Attachment:');?>
																  <img src="<?php echo image_url('clip.gif'); ?>" width="15" height="13" />
																  <input name="attachment" type="file"/>
																 <small style="color:red;" ><?php echo $this->lang->line('allowed files'); ?></small>	
																  <?php 
																   $filesize = '0';
																   foreach($fileInfo->result() as $fileDate)
																	 {
																	   $filesize =$filesize + $fileDate->file_size;
																	 } ?>	 
																  
																</p>
																</h5>
																<p><small><?php echo $this->lang->line('info'); ?> <?php echo round($filesize/1024,2);?> <?php echo $this->lang->line('info1');?> <?php echo $maximum_size.' MB'; ?></small></p></li>
										  <li>
											<p><b><?php echo $this->lang->line('Job Budget:');?></b></p>
											<p><?php echo $this->lang->line('Minimum:');?>&nbsp;<span> <?php echo $currency;?>
											  <input name="budget_min" value="<?php echo $draft->budget_min; ?>" size="5" type="text"/> <?php //echo form_error('budget_min'); ?>
											  </span></p>
											  
											<p><?php echo $this->lang->line('Maximum:');?><span><?php echo $currency;?>
											  <input name="budget_max" value="<?php echo $draft->budget_max; ?>" size="5" type="text"/><?php //echo form_error('budget_max'); ?>
											  </span></p>
										  </li>
										  <li class="clSNoBack">
											<ul class="clsFloatedList clearfix">
											  <li class="clsPercent30">
												<input  name="is_feature" value="1" type="checkbox" <?php if($draft->is_feature == '1') echo 'checked';?> />
												<b><?php echo $this->lang->line('Make Job');?> <a href="#" target="_blank"><?php echo $this->lang->line('Featured');?></a>&nbsp; <img src="<?php echo image_url('featured2.gif');?>" width="14" height="14" title="Featured project" alt="<?php echo $this->lang->line('Featured Project'); ?>" /></b> </li>
											  <li class="clsPercent10"> <?php echo $currency;?> <?php echo $feature_project; ?>
											
											  </li>
											  <li class="clsPercent50"> <?php echo $this->lang->line('pro1');?> <a href="#" target="_blank"><?php echo $this->lang->line('Click here');?></a> <?php echo $this->lang->line('read');?></li>
											</ul>
											<ul class="clsFloatedList clearfix">
											  <li class="clsPercent30">
												<input name="is_urgent" value="1" type="checkbox" <?php if($draft->is_urgent == '1') echo 'checked';?>  />
												<b><?php echo $this->lang->line('Make Job Urgent');?>&nbsp;<img src="<?php echo image_url('urgent2.gif');?>" width="14" height="14" title="Urgent project" alt="<?php echo $this->lang->line('Urgent Project'); ?>" /></b> </li>
											  <li class="clsPercent10"> <?php echo $currency;?> <?php echo $urgent_project; ?></li>
											  <li class="clsPercent50"> <?php echo $this->lang->line('pro2');?> <a href="#"><?php echo $this->lang->line('urgent projects');?></a> <?php echo $this->lang->line('page. This option is free if you are a');?> <a href="#" target="_blank"><?php echo $this->lang->line('Certified Member');?></a>. <?php echo $this->lang->line('If your project is');?> <a href="#" target="_blank"><?php echo $this->lang->line('Featured');?></a> <?php echo $this->lang->line('the urgent fee is only $1.').$currency.'1';?> </li>
											</ul>
											<ul class="clsFloatedList clearfix">
											  <li class="clsPercent30">
												<input  name="is_hide_bids" value="1" type="checkbox" <?php if($draft->is_hide_bids == '1') echo 'checked';?>  />
												<b><?php echo $this->lang->line('Hide Job Bids');?></b></li>
											  <li class="clsPercent10"> <?php echo $currency;?><?php echo $hide_project; ?></li>
											  <li class="clsPercent50"> <?php echo $this->lang->line('pro3');?> <a href="#" target="_blank"><?php echo $this->lang->line('Featured');?></a>, <?php echo $this->lang->line('Private or Urgent, or if you are a');?> <a href="#" target="_blank"><?php echo $this->lang->line('Certified Member');?></a>. </li>
											</ul>
										
								  <ul class="clsFloatedList clearfix">
								  <li class="clsPercent30">
									
									 <input type="checkbox" name="is_private" value="1" onClick="check_private(this.form)" <?php if($draft->is_private == '1') echo 'checked';?> /><b> <?php echo $this->lang->line('Private Invitation'); ?>&nbsp;<img src="<?php echo image_url('private.png');?>" width="14" height="14" title="private Job" alt="<?php echo $this->lang->line('Private Project'); ?>" /></b><br /> </li>
									  <li class="clsPercent10"> <?php echo $currency;?> <?php echo $private_project; ?></li>
									  <li class="clsPercent50"> <?php echo $this->lang->line('Private Messages'); ?><br /><br /><?php echo $this->lang->line('list'); ?></p></li>
									</ul>
									</li>
									<li>
									<?php if($draft->is_private==0) { ?>
									<ul class="clsLiFloat clsClearFix">
									  <li class="clsDeatils"><b><?php echo $this->lang->line('Invite Programmers'); ?></b><br /><br />
									   <span><a href="#private_list" onClick="javascript:loadProgrammers('<?php foreach($favouriteUsers->result() as $users) {  
									   echo $users->user_name.',\n';  } ?>');"><?php echo $this->lang->line('Invite Favourite'); ?></a> </span></li>
									   <li class="clsRate"></li>
									  <li class="clsDescription"> <span><textarea name="private_list" id="private_listfill" rows="7" cols="30" disabled="disabled" ><?php echo $draft->private_users;?></textarea></span></li>
									 </ul> 
									 <?php } else {?>
									 <ul class="clsLiFloat clsClearFix">
									  <li class="clsDeatils"><b><?php echo $this->lang->line('Invite Programmers'); ?></b><br /><br />
									   <span><a href="#private_list" onClick="javascript:loadProgrammers('<?php foreach($favouriteUsers->result() as $users) {  
									   echo $users->user_name.',\n';  } ?>');"><?php echo $this->lang->line('Invite Favourite'); ?></a> </span></li>
									   <li class="clsRate"></li>
									  <li class="clsDescription"> <span><textarea name="private_list" id="private_listfill" rows="7" cols="30" ><?php echo $draft->private_users;?></textarea></span></li>
									 </ul> 
									 <?php }?>
									</li>
									<li>
									
									
									<p>
									  <input class="clsLoginbig_but" value="<?php echo $this->lang->line('Save Draft');?>" name="saveDraft" type="submit"/>
									  <input class="clsLoginbig_but" value="<?php echo $this->lang->line('Preview Job');?>" name="previewJob" type="submit" onClick="javascript:return formSubmit()" />
									  <input class="clsLoginbig_but" value="<?php echo $this->lang->line('Submit Job');?>" name="submitJob" type="submit" />
									  <?php if(isset($draft->id)) { ?>
									       <input class="clsLoginlarge_but" value="<?php echo $this->lang->line('Discard');?>" name="Discard" type="button" onClick="javascript:submitDraft()" />		  
									  <?php } ?>
									
									</p>
								  </li>
								</ul>
								</form><?php 
							   }
							  } ?>
							   
							 
						    </div>
						        	<input name="projectid" value="<?php if(isset($draft->id)) echo $draft->id; ?>"type="hidden"/>
									 <form action="<?php echo site_url('job/draftView'); ?>" method="post" name="draftform" id="draft">
							          <input name="draftId" value="<?php if(isset($draft->id)) echo $draft->id; ?>"type="hidden"/>
							       </form>
													  </div>

      <!--END OF POST JOB-->


  </div>
</div></div>
<!--END OF MAIN-->

<script type="text/javascript">
function submitDraft()
{
	if($('#draftId').value!='')
	{
		$('#draftForm').submit();
	}
}
</script>
<script type="text/javascript">
/* For laod favouriteusers list into the textarea box */
function loadProgrammers(num)
{
   document.getElementById('private_listfill').value += num;
   return TRUE;
}

//Set the properties of textarea box disabled */
function check_private(formname)
{
  formname.private_list.disabled = ! formname.is_private.checked;
  formname.private_list.value="";
}
</script>
<?php $this->load->view('footer'); ?>