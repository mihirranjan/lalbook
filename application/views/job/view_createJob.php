<?php $this->load->view('header'); ?>
<div class="clsMinContent clearfix">
<?php $this->load->view('sidebar'); ?>
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
  <!--MAIN-->
    <div id="main">
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
    
      <!--POST JOB-->
      <div class="clsInnerCommon">
        
                            <div class="clsPostProject clsSitelinks">
                              <h2><?php echo 'Post a Job';?> </h2>
							
							  <?php echo form_error('total'); 
								//Show Flash Error Message
								if($msg = $this->session->flashdata('flash_message'))
									{
									echo $msg;
									}
									
								  if(isset($preview))	
									{ 
									  $preview  =  $preview->row();
									  echo '<h3><p><b>'.$this->lang->line('Please click the link for view Preview Job').'</b>';
									  ?>
									 <b><a href="<?php echo site_url('job/previewJob/'.$preview->id); ?> " target="_blank" style="color:green;" ><?php echo $this->lang->line('Preview');?></a></b></p></h3	> <?php 
									}
								  
								  //Calculate the no of days open the Job
								  if(isset($enddate) and isset($created))	
									$no_of_days = count_days($created,$enddate) - 1;
								  ?>
								<?php   
                             $this->load->view('job/view_draft'); ?>
                              <p style="margin:5px 0 0;"><?php echo $this->lang->line('Note');?></p>
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

                              <h3><span class="clsOptDetial"><?php echo $this->lang->line('Required Job Details...');?></span></h3>
							  <form method="post" action="<?php echo site_url('job/create'); ?>" name="form"  enctype="multipart/form-data">
                              <ul>
                                <li>
                                  <h5><?php echo $this->lang->line('Job Name');?></h5>
                                  <p><?php echo $this->lang->line('Do not put a domain/URL in your job name.');?></p>
                                  <p>
                                   <input name="projectName" value="<?php echo set_value('projectName'); ?>" maxlength="50" size="50" type="text"/>
	                              
                                  </p>
								  <?php echo form_error('projectName'); ?>
                                </li>
                                <li>
                                  <h5><?php echo $this->lang->line('Describe the job in detail:');?></h5>
                                 <!-- <p><?php echo $this->lang->line('Do not post any contact info');?> ( <a href="#"><?php echo $this->lang->line('Why?');?></a> | <a href="#"><?php echo $this->lang->line('Review Terms');?></a> )</p>-->
									<p>
									  <textarea rows="10" name="description" cols="75"><?php echo set_value('description'); ?></textarea>
									   
									</p>
								<?php echo form_error('description'); ?>
                               <!--   <p><?php echo $this->lang->line('Tip');?></p>-->
                                </li>
								<li><h5><b><?php echo $this->lang->line('I want my job to stay open for bidding for');?>
									<select name="openDays">
									
									<?php for($i=1;$i<=$project_period;$i++){?>
									<option value="<?php echo $i;?>" <?php if(isset($project_period)) { if($project_period == $i) echo 'selected="selected"'; }?> ><?php echo $i;?></option>
									<?php } ?>
									</select>&nbsp;<?php echo $this->lang->line('days');?>
                                  </b></h5></li>
                                <li>
                                  <h5><?php echo $this->lang->line('Job Type: (Make up to 5 selections.)');?></span></h5>
                                  
                                  <!--OPTION LIST-->
									<?php
											if(isset($groupsWithCategories) and count($groupsWithCategories)>0 )
											{
												foreach($groupsWithCategories as $groupsWithCategory)
												{
													if($groupsWithCategory['num_categories']>0)
													{				
									?>
									<p style="font: italic bold 15px arial; text-transform: uppercase; border-bottom: 1px dashed rgb(204, 204, 204); padding: 10px 0px 5px ! important; margin: 0px 31px 5px 0px;"><?php echo $groupsWithCategory['group_name']?></p>
									<div id="selProgrammingOptions">
									  <table width="98%">
									  <?php $i=0;
										foreach($groupsWithCategory['categories']->result() as $category)
										{
										if($category->is_active==1)
										{
										 if($i%5 ==0)
                							//echo '<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
									  ?>
										
										  <td width="20%"><label><input onClick="count(this.form)" name="categories[]" value="<?php echo $category->id; ?>" <?php echo set_checkbox('categories[]', $category->id); ?> type="checkbox"/><?php echo $category->category_name;  ?></label></td>
										<?php if($i%5 ==3)
											   echo '</tr>';
										   $i = $i + 1; ?>
									<?php
									}
										} //Foreach End - Traverse Category
									?>
									 </table>
									</div>
									<?php
													}//Check For Cateogry Availability
											} //For Each Travesal - For Group
										}//If End - Check For Group Existence
									?>
									<?php echo form_error('categories[]'); ?>
                                 </li>
								
		<li><label><b><?php echo $this->lang->line('Country');?></b></label><select name="country" size="1"  onchange="getCountry(this.value)" style="width: 202px;">
		<option value="">Select</option>
		<?php
		
		if(isset($countries) and $countries->num_rows()>0)
		{
			foreach($countries->result() as $country)
			{
			
			//$post_country = $country->country_name;
			
			?>
			<option value="<?php echo $country->country_name; ?>" <?php //echo set_select('country', $post_country); ?>><?php echo $country->country_name; ?></option>
			<?php
			}
		//Foreach End
		}//If End
		?>
	</select>
	<?php echo form_error('country'); ?>
	</li>
	
<li><p><label><b><?php echo $this->lang->line('State');?></b></label><input name="state" value="<?php echo set_value('state'); ?>" size="30" type="text"/></p><?php echo form_error('state'); ?></li>

<li><p><label><b><?php echo $this->lang->line('City');?></b></label><input name="city" value="<?php echo set_value('city'); ?>"  size="30" type="text"/></p><?php echo form_error('city'); ?> </li> 
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
									  <?php echo form_error('attachment'); ?>
									  
									
                                    </h5>
                                    <p><small><?php echo $this->lang->line('info'); ?> <?php echo round($filesize/1024,2);?> <?php echo $this->lang->line('info1');?> <?php echo $maximum_size.' MB'; ?></small></p></li>
                                  <li>
                                    <h5><?php echo $this->lang->line('Job Budget:');?></h5>
                                    <p><?php echo $this->lang->line('Minimum:');?>&nbsp;<span> <?php echo $currency;?>
                                      <input name="budget_min" value="<?php echo set_value('budget_min'); ?>" size="5" type="text"/><?php echo form_error('budget_min'); ?>
                                      </span></p>
                                    <p><?php echo $this->lang->line('Maximum:');?><span> <?php echo $currency;?>
                                      <input name="budget_max" value="<?php echo set_value('budget_max'); ?>" size="5" type="text"/>
                                      </span></p>
									 <?php echo form_error('budget_max'); ?>
                                  </li>
								  
								  <li class="clSNoBack">
									<ul class="clsFloatedList clearfix">
									  <li class="clsPercent30">
										<input  name="is_feature" value="1" type="checkbox" <?php echo set_checkbox('is_feature', '1'); ?> onClick="check_featured(this.form)" />
										<b><?php echo $this->lang->line('Make Job');?> <a href="#" target="_blank"><?php echo $this->lang->line('Featured');?></a>&nbsp; 
										<img src="<?php echo image_url('featured.png');?>" width="14" height="14" title="Featured Job" alt="<?php echo $this->lang->line('Featured Job'); ?>" /></b> </li>
									  <li class="clsPercent10"> <?php echo $currency;?> <?php echo $feature_project; ?>
									
									  </li>
									  <li class="clsPercent50"><?php echo $this->lang->line('pro1');?> <a href="#" target="_blank"><?php echo $this->lang->line('Click here');?></a> <?php echo $this->lang->line('read');?></li>
									</ul>
									<ul class="clsFloatedList clearfix">
									  <li class="clsPercent30">
										<input name="is_urgent" value="1" type="checkbox" <?php echo set_checkbox('is_urgent', '1'); ?> onClick="check_urgent(this.form)" />
										<b><?php echo $this->lang->line('Make Job Urgent');?>&nbsp;<img src="<?php echo image_url('urgent.png');?>" width="14" height="14" title="Urgent Job" alt="<?php echo $this->lang->line('Urgent Job'); ?>" /></b> </li>
									  <li class="clsPercent10"> <?php echo $currency;?> <?php echo $urgent_project; ?></li>
									  <li class="clsPercent50"> <?php echo $this->lang->line('pro2');?> <a href="#"><?php echo $this->lang->line('urgent projects');?></a> <?php echo $this->lang->line('page. This option is free if you are a');?> <a href="#" target="_blank"><?php echo $this->lang->line('Certified Member');?></a>. <?php echo $this->lang->line('If your project is');?> <a href="#" target="_blank"><?php echo $this->lang->line('Featured');?></a> <?php echo $this->lang->line('the urgent fee is only $1.').$currency.'1';?> </li>
									</ul>
									<ul class="clsFloatedList clearfix">
									  <li class="clsPercent30">
										<input  name="is_hide_bids" value="1" type="checkbox" <?php echo set_checkbox('is_hide_bids', '1'); ?> />
										<b><?php echo $this->lang->line('Hide Job Bids');?></b></li>
									  <li class="clsPercent10"> <?php echo $currency;?> <?php echo $hide_project; ?></li>
									  <li class="clsPercent50"> <?php echo $this->lang->line('pro3');?> <a href="#" target="_blank"><?php echo $this->lang->line('Featured');?></a>, <?php echo $this->lang->line('Private or Urgent, or if you are a');?> <a href="#" target="_blank"><?php echo $this->lang->line('Certified Member');?></a>. 
							
										<?php echo $this->lang->line('This option is free if your job is');?> <a href="#" target="_blank"><?php echo $this->lang->line('Featured');?></a>, <?php echo $this->lang->line('Private or Urgent, or if you are a');?> <a href="$" target="_blank"><?php echo $this->lang->line('Certified Member');?></a>. </li>
							
									</ul>
									
									<ul class="clsFloatedList clsClearFix clsMod2">
								 	 <li class="clsPercent30">
									 <input type="checkbox" <?php echo set_checkbox('is_private', '1'); ?> name="is_private" id="is_private" value="1" onClick="check_private(this.form)" /><b> <?php echo $this->lang->line('Private Invitation'); ?>&nbsp;<img src="<?php echo image_url('private.png');?>" width="14" height="14" title="private Job" alt="<?php echo $this->lang->line('Private Job'); ?>" /></b><br /> </li>
									  <li class="clsPercent10"> <?php echo $currency;?> <?php echo $private_project; ?></li>
									  <li class="clsPercent50"> <p><?php echo $this->lang->line('Private Messages'); ?><br /><?php echo $this->lang->line('list'); ?></p></li>
									  
          <li style="margin:0px!important; padding:10px 0 0!important;clear:both; overflow:hidden;">
		 
		  <label style="font-size:13px;margin-bottom:7px;">
		   <?php echo $this->lang->line('private invitation list');  ?> ( <?php echo $this->lang->line('one username per line');  ?>): </label>
		<br />
									
									  <span>
									  <textarea name="private_list" id="private_listfill" rows="7" cols="30"  <?php if(set_value('is_private')!='1'){ ?> disabled="disabled" <?php } ?> ><?php echo set_value('private_list'); ?></textarea>
									  <?php echo form_error('private_list');  ?>
									  </span>
									 </li>
									  
									</ul>  
								  </li>
							    </ul>
								
								
									
								
							  </div>
							  <p style="padding-left:20px !important;">
							<input class="clsLoginbig_but" value="<?php echo $this->lang->line('Save Draft');?>" name="saveDraft" type="submit" />
							<input class="clsLoginbig_but" value="<?php echo $this->lang->line('Preview');?>" name="previewJob" type="submit" onClick="javascript:return formSubmit()" />
							<input class="clsLoginbig_but" value="<?php echo $this->lang->line('Submit Job');?>" name="submitJob" type="submit" />	
								
                              </p>
							  </form>
                            </div>
                          </div>    
      <!--END OF POST JOB-->
    									  </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!--end of RC -->    
	 		 
    <!--END OF MAIN-->
<script type="text/javascript">

function formSubmit()
{
var form = document.createElement("form");
//alert(form.);
form.setAttribute("target", "_blank");
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
  document.getElementById('private_listfill').disabled = !document.getElementById('is_private').checked;
  document.getElementById('private_listfill').value="";
}
</script>
</div></div></div>
<?php $this->load->view('footer'); ?>