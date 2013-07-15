<?php $this->load->view('header'); ?>
<div class="clsMinContent clearfix">
<?php $this->load->view('sidebar'); ?>
<!--MAIN-->
<div id="main">
      <!--POST JOB-->
      <div class="clsPostProject">
     
                            <div class="clsInnerCommon clsSitelinks">
                              <h2><?php echo $this->lang->line('POST A JOB');?></h2>
                              <?php	$postSimilar = $postSimilar->row();
							    //Show Flash error Message 
							    if($msg = $this->session->flashdata('flash_message'))
								 {
								  echo $msg;
								 }    ?>
							  <h3><span class="clsFeatured"><?php echo $this->lang->line('My Save Jobs:');?></span></h3>
                                <?php $this->load->view('job/view_draft'); ?>
                              
                              <p><?php echo $this->lang->line('Note');?></p>
                              <h3><span class="clsFileManager"><?php echo $this->lang->line('Account Login Details...');?></span></h3>
                              <p class="clsSitelinks"><?php echo $this->lang->line('You are currently logged in as');?> <a class="glow" href="<?php if($loggedInUser->role_id == '1') $res = 'owner'; else $res = 'employee'; echo site_url($res.'/viewprofile/'.$loggedInUser->id); ?>"><?php if(isset($loggedInUser) and is_object($loggedInUser))  echo $loggedInUser->user_name;?></a> (<a href="<?php echo site_url('users/logout'); ?>"><?php echo $this->lang->line('Logout') ?></a>).</p>
                              <h3><span class="clsOptDetial"><?php echo $this->lang->line('Required Job Details...');?></span></h3>
							  <form method="post" action="<?php echo site_url('job/create'); ?>"  enctype="multipart/form-data"  name="myForm" id="myForm">

                              <ul>
                                <li>
                                  
                                     <h5><?php echo $this->lang->line('Job Name');?> : <span class="red"> * </span></h5>
                                     <p style="padding:0 !important;"><?php echo $this->lang->line('Do not put a domain/URL in your job name.');?> </p>
									 <p style="padding:0 !important;"><input name="projectName" value="<?php if (isset($postSimilar->job_name)) echo $postSimilar->job_name; ?>" maxlength="50" size="50" type="text" title="<?php if (isset($postSimilar->job_name)) echo $postSimilar->job_name; ?>"/></p>
                                 
                                </li>
                                <li>
                                  <h5><?php echo $this->lang->line('Describe the project in detail:');?></h5>
								  <p style="padding:0 !important;"><?php echo $this->lang->line('Do not post any contact info');?> ( <a href="#"><?php echo $this->lang->line('Why?');?></a> | <a href="#"><?php echo $this->lang->line('Review Terms');?></a> )</p>
								  <input name="projectid" id="projectid" value="<?php if (isset($postSimilar->id)) echo $postSimilar->id; ?>" type="hidden"/>
									<?php 
									if(isset($update))
									  {?>
										<input name="update" id="update" value="0" type="hidden"/> <?php 
									  }
									?>
									<p style="padding:0 !important;">
									  <textarea rows="10" name="description" cols="70"><?php if (isset($postSimilar->description)) echo $postSimilar->description; ?> </textarea>
									   <?php //echo form_error('description'); ?>
									</p>
                                </li>
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
									  <?php $m=0;
										foreach($groupsWithCategory['categories']->result() as $category)
										{ 
										
										if($m%3 ==0)
										    echo '<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
										?>
										  <label><td><input type="checkbox" onClick="count(this.form)" name="categories[]" value="<?php echo $category->id; ?>" <?php if(in_array($category->category_name,$res)) echo 'checked="checked"'; ?> /><?php echo $category->category_name;  ?></td>
										  </label>
										  <?php if($m%3 ==2)
											   echo '</tr>';
										   $m = $m + 1; ?>
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
                                </li>
                                <li>
                                  <h5><?php echo $this->lang->line('I want my job to stay open for bidding for');?>
                                    <select name="openDays">
									<?php for($i=1;$i<=$project_period;$i++){?>
									<option value="<?php echo $i;?>" <?php if(isset($open_days)) if($open_days == $i) echo "selected"; ?>><?php echo $i;?></option>
									<?php } ?>
									</select>&nbsp;<?php echo $this->lang->line('days');?></h5>
                                </li>
                              </ul>
                              <div class="clsOptionalDetails">
                                <h3><span class="clsInvoice"><?php echo $this->lang->line('Optional Job Details...');?></span></h3>
                                <ul>
                                  <li>
                                    <h5>
                                     <img src="<?php echo image_url('clip.gif'); ?>" width="15" height="13" /><b><?php echo $this->lang->line('Attachment:');?></b>
									  <input name="attachment" type="file"/>
									 <small style="color:red;" ><?php echo $this->lang->line('allowed files'); ?></small>	
									  <?php 
									   $filesize = '0';
									   foreach($fileInfo->result() as $fileDate)
										 {
										   $filesize =$filesize + $fileDate->file_size;
										 } ?>	 
									</h5>
									<p><small><?php echo $this->lang->line('info'); ?> <?php echo round($filesize/1024,2);?> <?php echo $this->lang->line('info1');?> <?php echo $maximum_size.' MB'; ?></small></p>
                                  <li>
                                    <h5><?php echo $this->lang->line('Job Budget:');?></h5>
                                    <p><?php echo $this->lang->line('Minimum:');?>&nbsp;<span> <?php echo $currency;?>
                                        <input name="budget_min" value="<?php if (isset($postSimilar->budget_min)) echo $postSimilar->budget_min; ?>" size="5" type="text"/><?php //echo form_error('budget_min'); ?>
                                      </span></p>
                                    <p><?php echo $this->lang->line('Maximum:');?><span> <?php echo $currency;?>
                                        <input name="budget_max" value="<?php if (isset($postSimilar->budget_max)) echo $postSimilar->budget_max; ?>" size="5" type="text"/><?php //echo form_error('budget_max'); ?>

                                      </span></p>
                                  </li>
                                  <li class="clSNoBack">
                                    <ul class="clsFloatedList clearfix">
                                      <li class="clsPercent30">
                                        <h5>
                                           <input  name="is_feature" value="1" type="checkbox" <?php if (isset($postSimilar->is_feature)) if ($postSimilar->is_feature == 1) echo 'checked'; ?> <?php //echo set_checkbox('is_feature', '1'); ?> />
                                          <?php echo $this->lang->line('Make Job Featured');?> <a target="_blank" href="#"> <img height="13" border="0" width="16" alt="" src="<?php echo image_url('featured2.gif'); ?>"/></a></h5>
                                      </li>
                                      <li class="clsPercent10"><?php echo $currency;?> <?php echo $feature_project; ?></li>
                                      <li class="clsPercent50"> <?php echo $this->lang->line('pro1');?> <a target="_blank" href="#"></a> <?php echo $this->lang->line('read');?>                </ul>
                                    <ul class="clsFloatedList clearfix">
                                      <li class="clsPercent30">
                                        <h5>
                                          <input name="is_urgent" value="1" type="checkbox" <?php if (isset($postSimilar->is_urgent)) if ($postSimilar->is_urgent == 1) echo 'checked'; ?> <?php //echo set_checkbox('is_urgent', '1'); ?> />
                                         <?php echo $this->lang->line('Make Job Urgent');?> <a target="_blank" href="#"> <img height="13" border="0" width="16" alt="" title="<?php echo $this->lang->line('Make Job Urgent');?>" src="<?php echo image_url('urgent2.gif'); ?>"/></a></h5>
                                      </li>
                                      <li class="clsPercent10"><?php echo $currency;?>  <?php echo $urgent_project; ?> </li>
                                      <li class="clsPercent50"> <?php echo $this->lang->line('pro1');?> <a target="_blank" href="#"><?php echo $this->lang->line('Click here');?></a><?php echo $this->lang->line('read');?></li>
                                    </ul>
                                    <ul class="clsFloatedList clearfix">
                                      <li class="clsPercent30">
                                        <h5>
                                         <input  name="is_hide_bids" value="1" type="checkbox" <?php if (isset($postSimilar->is_hide_bids)) if ($postSimilar->is_hide_bids == 1) echo 'checked'; ?> <?php //echo set_checkbox('is_hide_bids', '1'); ?> />
                                          <?php echo $this->lang->line('Hide Job Bids');?> <a target="_blank" href="#"></a></h5>
                                      </li>
                                      <li class="clsPercent10"><?php echo $currency;?> <?php echo $hide_project; ?></li>
                                      <li class="clsPercent50"> <?php echo $this->lang->line('pro1');?> <a target="_blank" href="#"><?php echo $this->lang->line('Click here');?></a> <?php echo $this->lang->line('read');?></li>
                                    </ul>
                                  </li>
                                </ul>
                              </div>
                              <p>
                                <input class="clsLoginbig_but" value="<?php echo $this->lang->line('Save Draft');?>" name="save_draft" type="submit"/>
                                <input class="clsLogin_but" value="<?php echo $this->lang->line('Preview');?>" name="previewJob" type="submit"/>
								  <input class="clsLoginbig_but" value="<?php echo $this->lang->line('Submit Job');?>" name="submitJob" type="submit"/>		  
                              </p>
							  </form>
                            </div>
                          </div>
  
      <!--END OF POST JOB-->
    </div></div></div>
<!--END OF MAIN-->

<script language="JavaScript">
function formSubmit()
{
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
  formname.private_list.value= " ";
}

</script>
<?php $this->load->view('footer'); ?>