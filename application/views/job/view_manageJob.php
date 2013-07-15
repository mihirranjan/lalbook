<?php $this->load->view('header'); ?>
<div class="clsMinContent clearfix">
<?php $this->load->view('sidebar'); ?>

<style>
.clsOptionalDetails li{
	list-style-type:none;
}
.clsPostProject li {
	background:none !important;
}
.clsInnerCommon ul {
    overflow: hidden;
    padding: 1em 0 1em 3em !important;
}
.clsInnerCommon form p {
    padding: 0.5em 0 0 0 !important;
}
</style>
<!--MAIN-->
<div id="main">
      <!--POST JOB-->
      <div class="clsPostProject">
       
                            <div class="clsInnerCommon">
                              <h2><?php echo $this->lang->line('Manage Job');?></h2>
                             <?php
								$postSimilar = $postSimilar->row();
								
							//Show Flash error Message 
							if($msg = $this->session->flashdata('flash_message'))
								{
								echo $msg;
								}
								
							  ?>
                              <h3><span class="clsFileManager"><?php echo $this->lang->line('Account Login Details...');?></span></h3>
                              <p class="clsSitelinks"><?php echo $this->lang->line('You are currently logged in as');?> <a class="glow" href="<?php if($loggedInUser->role_id == '1') $res = 'owner'; else $res = 'employee'; echo site_url($res.'/viewprofile/'.$loggedInUser->id); ?>"><?php if(isset($loggedInUser) and is_object($loggedInUser))  echo $loggedInUser->user_name;?></a> (<a href="<?php echo site_url('users/logout'); ?>"><?php echo $this->lang->line('Logout') ?></a>).</p>
                              <h3><span class="clsOptDetial"><?php echo $this->lang->line('Required Job Details...');?></span></h3>
							  <form method="post" action="<?php echo site_url('job/manageJob'); ?>"  enctype="multipart/form-data" >
                              <ul>
                                <li>
                                  <h5><?php echo $this->lang->line('Job Name');?></h5>
                                  <p><?php echo $this->lang->line('Do not put a domain/URL in your job name.');?></p>
                                  <p>
                                    <input name="projectName"  value="<?php if (isset($postSimilar->job_name)) echo $postSimilar->job_name; ?>" maxlength="50" size="50" type="text" title="<?php if (isset($postSimilar->job_name)) echo $postSimilar->job_name; ?>" readonly="yes" />
                                  </p>
                                </li>
                                <li>
                                  <h5><?php echo $this->lang->line('Describe the job in detail:');?></h5>
                                  <p><?php echo $this->lang->line('Do not post any contact info');?> <?php echo $this->lang->line('( Why? | Review Terms )');?></p>
                                  <p>
								  <input name="projectid" id="projectid" value="<?php if (isset($postSimilar->id)) echo $postSimilar->id; ?>" type="hidden"/>
								<?php 
								if(isset($update))
								  {?>
									<input name="update" id="update" value="0" type="hidden"/> <?php 
								  }
								?>
								<p>
								  <textarea rows="10" name="description" cols="70" readonly="readonly"><?php if (isset($postSimilar->description)) echo strip_tags($postSimilar->description); ?> </textarea>
								   <?php //echo form_error('description'); ?>
								</p>
								<p><b><?php echo $this->lang->line('Type additional Information Here'); ?></b></p>
								<p>
								  <textarea rows="10" name="add_description" cols="70"></textarea>
								   <?php //echo form_error('description'); ?>
								</p>
                                  <p><?php echo $this->lang->line('Tip');?></p>
                                </li>
								
									<li><h5><b><?php echo $this->lang->line('I want my job to stay open for bidding for');?>
									<select name="openDays">
									<?php for($i=1;$i<=$project_period;$i++){?>
									<option value="<?php echo $i;?>" <?php if(isset($project_period)) { if($project_period == $i) echo 'selected="selected"'; }?> ><?php echo $i;?></option>
									<?php } ?>
									</select>&nbsp;<?php echo $this->lang->line('days');?>
                                  </h5></b></li>
								
                                <li>
                                  <h5><?php echo $this->lang->line('Job Type: (Make up to 5 selections.)');?></span></h5>
                                   <!--OPTION LIST-->
									<?php
										 $res = explode(',',$postSimilar->job_categories);
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
										<td>
										  
										  <label><input onClick="count(this.form)" name="categories[]" value="<?php echo $category->id; ?>" <?php if(in_array($category->category_name,$res)) echo 'checked="checked"'; ?>
										   <?php //echo set_checkbox('categories[]', $category->id); ?> type="checkbox"/><?php echo $category->category_name;  ?>
										  </label>
										  <?php ?>
										  
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
									 echo form_error('categories[]'); 
									?>
									<!--OPTION LIST end here-->
                                </li>
                               <li><p><label><b>Country</b></label><select name="country" size="1"  onchange="getCountry(this.value)" style="width: 185px;">
		<option value="">Select</option>
		<?php
		
		if(isset($countries) and $countries->num_rows()>0)
		{
			foreach($countries->result() as $country)
			{
			
			  $post_country = $postSimilar->country;
			
			?>
			<option value="<?php echo $country->country_name; ?>" <?php if($country->country_name==$post_country)echo 'selected="selected"'; ?>><?php echo $country->country_name; ?></option>
			<?php
			}
		//Foreach End
		}//If End
		?>
	</select>
	<?php echo form_error('country'); ?>
	</p></li>
	
<li><p><b>State</b><input name="state" value="<?php if (isset($postSimilar->state)) echo $postSimilar->state; ?>" size="30" type="text"/></p><?php echo form_error('state'); ?></li>

<li><p><b>City</b><input name="city" value="<?php if (isset($postSimilar->city)) echo $postSimilar->city; ?>"  size="30" type="text"/></p><?php echo form_error('city'); ?> </li>
                              </ul>
                              <div class="clsOptionalDetails">
                                <h3><span class="clsInvoice"><?php echo $this->lang->line('Optional Job Details...');?></span></h3>
                                <ul>
                                  <li>
                                    <h5><?php echo $this->lang->line('Attachment:');?>
                                      <img src="<?php echo image_url('clip.gif'); ?>" width="15" height="13" />
										  <input name="attachment" type="file"/>
										 <small style="color:red;" ><?php echo $this->lang->line('allowed files'); ?></small>	
										 <?php 
										   $filesize = '0';
										   foreach($fileInfo->result() as $fileDate)
											 {
											   $filesize =$filesize + $fileDate->file_size;
											 } ?>	 
										  <?php //echo form_error('attachment'); ?>
										  
									</h5></li>
										<p><small><?php echo $this->lang->line('info'); ?> <?php echo round($filesize/1024,2);?> <?php echo $this->lang->line('info1');?> <?php echo $maximum_size.' MB'; ?></small></p>
									  <!--END OF POST A JOB-->
									  <li><h5><?php echo $this->lang->line('Job Budget:');?></h5>
										<p><?php echo $this->lang->line('Minimum:');?>&nbsp;<span> $
										  <input name="budget_min" value="<?php if (isset($postSimilar->budget_min)) echo $postSimilar->budget_min; ?>" size="5" type="text"/> <?php echo form_error('budget_min'); ?>
										  </span></p>
										   
										<p><?php echo $this->lang->line('Maximum:');?><span> $
										  <input name="budget_max" value="<?php if (isset($postSimilar->budget_max)) echo $postSimilar->budget_max; ?>" size="5" type="text"/> <?php echo form_error('budget_max'); ?>
										  </span></p>
										   
                                    
                                  </li>
								  <li class="clSNoBack">
								  <?php if($postSimilar->is_feature == 0){?>
									<ul class="clsFloatedList clearfix">
									  <li class="clsPercent30">
										<input  name="is_feature" value="1" type="checkbox" <?php echo set_checkbox('is_feature', '1'); ?> onClick="check_featured(this.form)" />
										<b><?php echo $this->lang->line('Make Job');?> <a href="#" target="_blank"><?php echo $this->lang->line('Featured');?></a> 
										<img src="<?php echo image_url("featured2.gif");?>" width="16" border="0" height="13" alt="."/></b> </li>
									  <li class="clsPercent10"> <?php echo $currency;?><?php echo $feature_project; ?>
									
									  </li>
									  <li class="clsPercent50"><?php echo $this->lang->line('pro1');?> <a href="#" target="_blank"><?php echo $this->lang->line('Click here');?></a> <?php echo $this->lang->line('read');?></li>
									</ul>
									<?php } 
									if($postSimilar->is_urgent == 0){
									?>
									<ul class="clsFloatedList clearfix">
									  <li class="clsPercent30">
										<input name="is_urgent" value="1" type="checkbox" <?php echo set_checkbox('is_urgent', '1'); ?> onClick="check_urgent(this.form)" />
										<b><?php echo $this->lang->line('Make Job Urgent');?><img src="<?php echo image_url("urgent2.gif");?>" width="16" border="0" height="16" alt="."/></b> </li>
									  <li class="clsPercent10"> <?php echo $currency;?><?php echo $urgent_project; ?></li>
									  <li class="clsPercent50"> <?php echo $this->lang->line('pro2');?> <a href="#"><?php echo $this->lang->line('urgent jobs');?></a> <?php echo $this->lang->line('page. This option is free if you are a');?> <a href="#" target="_blank"><?php echo $this->lang->line('Certified Member');?></a>. <?php echo $this->lang->line('If your job is');?> <a href="#" target="_blank"><?php echo $this->lang->line('Featured');?></a> <?php echo $this->lang->line('the urgent fee is only $1.').$currency.'1';?> </li>
									</ul>
									<?php 
									}
									if($postSimilar->is_hide_bids == 0){?>
									<ul class="clsFloatedList clearfix">
									  <li class="clsPercent30">
										<input  name="is_hide_bids" value="1" type="checkbox" <?php echo set_checkbox('is_hide_bids', '1'); ?> />
										<b><?php echo $this->lang->line('Hide Job Bids');?></b></li>
									  <li class="clsPercent10"> <?php echo $currency;?><?php echo $hide_project; ?></li>
									  <li class="clsPercent50"> <?php echo $this->lang->line('pro3');?> <a href="#" target="_blank"><?php echo $this->lang->line('Featured');?></a>, <?php echo $this->lang->line('Private or Urgent, or if you are a');?> <a href="#" target="_blank"><?php echo $this->lang->line('Certified Member');?></a>. 
							
										<?php echo $this->lang->line('This option is free if your job is');?> <a href="#" target="_blank"><?php echo $this->lang->line('Featured');?></a>, <?php echo $this->lang->line('Private or Urgent, or if you are a');?> <a href="$" target="_blank"><?php echo $this->lang->line('Certified Member');?></a>. </li>
										
							       <?php } if($postSimilar->is_private ==0){?>
									</ul>
									 <ul class="clsFloatedList clearfix">
								  <li class="clsPercent30">
									
									 <input type="checkbox" name="is_private" value="1" onClick="check_private(this.form)" <?php echo set_checkbox('is_private', '1'); ?> /><b> <?php echo $this->lang->line('Private Invitation'); ?></b><br /> </li>
									  <li class="clsPercent10"> <?php echo $currency;?><?php echo $hide_project; ?></li>
									  <li class="clsPercent50"> <?php echo $this->lang->line('Private Messages'); ?><br /><br /><?php echo $this->lang->line('list'); ?></p></li>
									</ul>
									</li>
									<li>
									<ul class="clsLiFloat clsClearFix">
									  <li class="clsDeatils"><b><?php echo $this->lang->line('Invite Employees'); ?></b><br /><br />
									   <span><a href="#private_list" onClick="javascript:loadProgrammers('<?php foreach($favouriteUsers->result() as $users) {  
									   echo $users->user_name.',\n';  } ?>');"><?php echo $this->lang->line('Invite Favourite'); ?></a> </span></li>
									   <li class="clsRate"></li>
									  <li class="clsDescription"> <span><textarea name="private_list" id="private_listfill" rows="7" cols="30" ><?php echo $postSimilar->private_users;?></textarea></span></li>
									   <?php echo form_error('private_list');  ?>
									 </ul> 
									</li>
									<?php } ?>
								  </li>
								  </li>
                                  </ul>
							<ul>
                            <li> <p> <input class="clsLogin_but" value="<?php echo $this->lang->line('Submit');?>" name="submitJob" type="submit" /><input class="clsLogin_but" value="<?php echo 'Cancel';?>" name="submitJob" type="submit" /></p></li>
                            </ul>
							 
							  </div>
							  
							 </form>
                            </div>
                          </div>
                       
      <!--END OF POST JOB-->
    </div></div></div>
<!--END OF MAIN-->
<script language="JavaScript">
function formSubmit()
{
var form = document.createElement("form");
form.setAttribute("target", "_blank");
form.setAttribute("name", "myForm");
form.setAttribute("method", "post");
form.setAttribute("action", "<?php //echo site_url('job/create'); ?>");
document.body.appendChild(form);
form.submit();
window.open("<?php echo site_url('job/create'); ?>","myNewWin","width=500,height=300,toolbar=0"); 
}


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
}

</script>
<?php $this->load->view('footer'); ?>