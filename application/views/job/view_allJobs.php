<?php $this->load->view('header'); ?>
<div class="clsMinContent clearfix">
<?php $this->load->view('sidebar'); ?>
<!--MAIN-->

<div id="main">
  <!--POST job-->
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
  <div class="clsInnerpageCommon">
  
                        <div class="clsInnerCommon">
                          <h2><?php echo $this->config->item('site_title'); ?> -&nbsp;<?php echo $pName; ?></h2>
                          <h3><span class="clsFeatured"><?php echo $pName; ?></span></h3>
						 
                          <form method="post" action="">
                            <table cellspacing="1" cellpadding="2" width="98%">
                              <tbody>
                                <tr>
                                  <td width="5%" class="dt"><?php echo $this->lang->line('SI.No');?></td>
                                  <?php
								  if($order == 'DESC')
								 $order = 'ASC';
								 elseif($order == 'ASC')
								 $order = 'DESC';
								 else
								 $order = 'ASC';
								  ?>
                                  <td width="15%" class="dt"><a style="color:#000;" href="<?php echo site_url('job/viewAllJobs/'.$type."/".$page."/job_name/".$order);?>"> <?php echo $this->lang->line('Job Name'); ?> </a>
                                    <?php
								  if($order == 'ASC' && $field == 'project_name')
								  echo '<img src="'.image_url('arrow_up.gif').'" />';
								  elseif($order == 'DESC' && $field == 'project_name')
								  echo '<img src="'.image_url('arrow.gif').'" />';
								  ?>
                                  </td>
                                   <?php if($this->session->userdata('show_cat')){?> 
								   		<td width="20%" class="dt">
										<?php  echo $this->lang->line('Job Type'); ?>
										</td>
										<?php  }?>
										  
										  <?php if($this->session->userdata('show_budget'))
										  {
										  ?>
                                   <td width="10%" class="dt"><a style="color:#000;" href="<?php echo site_url('job/viewAllJobs/'.$type."/".$page."/budget_max/".$order);?>"> <?php echo $this->lang->line('Budget'); ?> </a>
                                    <?php
								  if($order == 'ASC' && $field == 'budget_max')
								  echo '<img src="'.image_url('arrow_up.gif').'" />';
								  elseif($order == 'DESC' && $field == 'budget_max')
								  echo '<img src="'.image_url('arrow.gif').'" />';
								  ?>
                                  </td>
                                  <?php
										  }
										  if($this->session->userdata('show_status'))
										  {
										  ?>
                                  <td class="dt" width="10%"><?php echo $this->lang->line('Status'); ?></td>
                                  <?php }
										   if($this->session->userdata('show_bids'))
										  {
										  ?>
                                  <td width="15%" class="dt"><?php echo $this->lang->line('Bids'); ?></td>
                                  <?php } 
										  if($this->session->userdata('show_avgbid'))
										  {
										  ?>
                                  <td class="dt" width="10%"><?php echo $this->lang->line('Avg Bid'); ?></td>
                                  <?php } 
										  if($this->session->userdata('show_date'))
										  {
										  ?>
                                  <td class="dt" width="13%"><a href="<?php echo site_url('job/viewAllJobs/'.$type."/".$page."/created/".$order);?>"> <?php echo $this->lang->line('Start Date'); ?> </a>
                                    <?php
									  if($order == 'ASC' && $field == 'created')
									  echo '<img src="'.image_url('arrow_up.gif').'" />';
									  elseif($order == 'DESC' && $field == 'created')
									  echo '<img src="'.image_url('arrow.gif').'" />';
									  ?>
                                  </td>
                                  <?php } ?>
								  </tr>

                                  <?php $i=0; 
									if(isset($featureJobs) and $featureJobs->num_rows()>0)
									{
										foreach($featureJobs->result() as $job)
										{
										$i=$i+1;
										  if($i%2 == 0)
											$class = 'dt1 dt0';
										  else
											$class = 'dt2 dt0';	
										?>
                                <tr class="<?php echo $class;?>">
                                  <td><?php echo $i;  ?></td>
                                  <td><a href="<?php echo site_url('job/view/'.$job->id); ?>"> <?php echo $job->job_name; ?></a>
                                     <?php if($job->is_urgent == 1) { ?>
                                    &nbsp;<img src="<?php echo image_url('urgent2.gif');?>" width="14" height="14" title="Urgent job" alt="<?php echo $this->lang->line('Urgent Job'); ?>" />
                                    <?php } 
								   if($job->is_feature == 1) { ?>
                                    &nbsp;&nbsp;<img src="<?php echo image_url('featured2.gif');?>" width="14" height="14" title="Featured job" alt="<?php echo $this->lang->line('Featured Job'); ?>" />
                                    <? }
									if($job->is_private == 1) {?>
									
									 &nbsp;&nbsp;<img src="<?php echo image_url('private.png');?>" width="14" height="14" title="private job" alt="<?php echo $this->lang->line('Private Job'); ?>" />
									
									<?php }?>
                                  </td>
                                  <?php if($this->session->userdata('show_cat')):	?>
                                  <td><?php echo getCategoryLinks($job->job_categories) ; ?> </td>
                                  <?php endif;
										if($this->session->userdata('show_budget')):	?>
                                  <td>$<?php echo  $job->budget_max;?></td>
                                  <?php endif; 
										 if($this->session->userdata('show_status')):	?>
                                  <td><?php 
										  echo getProjectStatus($job->job_status);
										  ?>
                                  </td>
                                  <?php endif; 
										 if($this->session->userdata('show_bids')):	?>
                                  <td><?php echo getNumBid($job->id);?></td>
                                  <?php endif;
										  if($this->session->userdata('show_avgbid')):	?>
                                  <td><?php echo getBidsInfo($job->id); ?></td>
                                  <?php endif; 
										  if($this->session->userdata('show_date')):	?>
                                  <td><?php echo get_date($job->created);?></td>
                                  <?php endif;?>
                                </tr>
                                <tr class="odd <?php echo $class; ?>">
                                  <td colspan="8"><?php 
								  if($this->session->userdata('show_desc')):?>
                                    <div class="clsDecrip clsAdd"  style="padding:3px 0 3px 10px;"> <?php echo $description = word_limiter($job->description,50); ?> </div>
                                    <?php endif;?></td>
                                </tr>
                                <?php								
										}//Traverse Jobs
									}//Check For Job Availability
									else{ ?>
									<tr><td colspan="4"><p class="clsNoResult"><?php echo  'No Results Found.';?></p></td></tr>
								<?php }?>
                                 <tr>
                                  <td class="dt1 dt0" colspan="9"><table class="custom" cellspacing="0" cellpadding="0" width="100%">
                                      <tbody>
                                        <tr>
                                          <td align="center"><?php echo $this->lang->line('Customize Display'); ?>:</td>
                                          <td><label>
                                            <input type="checkbox" value="1" <?php if($this->session->userdata('show_cat')) echo 'checked="checked"'; ?>  name="show_cat"/>
                                            <?php echo $this->lang->line('Type'); ?></label></td>
                                          <td><label>
                                            <input type="checkbox" value="1" <?php if($this->session->userdata('show_budget')) echo 'checked="checked"'; ?> name="show_budget"/>
                                            <?php echo $this->lang->line('Budget'); ?></label></td>
                                          <td><label>
                                            <input type="checkbox" value="1" <?php if($this->session->userdata('show_bids')) echo 'checked="checked"'; ?> name="show_bids"/>
                                            <?php echo $this->lang->line('Bids'); ?></label></td>
                                          <td><label>
                                            <input type="checkbox" value="1" <?php if($this->session->userdata('show_avgbid')) echo 'checked="checked"'; ?> name="show_avgbid"/>
                                            <?php echo $this->lang->line('Avg Bid'); ?></label></td>
                                          <td><label>
                                            <input type="checkbox" value="1" <?php if($this->session->userdata('show_status')) echo 'checked="checked"'; ?> name="show_status"/>
                                            <?php echo $this->lang->line('Status'); ?></label></td>
                                          <td><label>
                                            <input type="checkbox" value="1" <?php if($this->session->userdata('show_date')) echo 'checked="checked"'; ?> name="show_date"/>
                                            <?php echo $this->lang->line('Start Date'); ?></label></td>
                                          <td><label>
                                            <input type="checkbox" value="1" <?php if($this->session->userdata('show_desc')) echo 'checked="checked"'; ?> name="show_desc"/>
                                            <?php echo $this->lang->line('Description'); ?></label></td>
                                          <td><select name="show_num" size="1">
                                              <option value="5" <?php if($this->session->userdata('show_num') == 5) echo "selected='selected'";?>>5</option>
                                              <option value="10" <?php if($this->session->userdata('show_num') == 10) echo "selected='selected'";?>>10</option>
                                              <option value="20" <?php if($this->session->userdata('show_num') == 20) echo "selected='selected'";?>>20</option>
                                              <option value="50" <?php if($this->session->userdata('show_num') == 50) echo "selected='selected'";?>>50</option>
                                              <option value="100" <?php if($this->session->userdata('show_num') == 100) echo "selected='selected'";?>>100</option>
                                            </select>
                                            <?php echo $this->lang->line('Results'); ?> </td>
                                        </tr>
                                      </tbody>
                                    </table></td>
                                </tr>
                              </tbody>
                            </table>
                            <p style="text-align:right;margin:0 10px 0 0!important;padding:0;">
                              <input type="submit" value="<?php echo $this->lang->line('Refresh'); ?>" class="clsLoginbig_but" name="customizeDisplay"/>
                            </p>
                          </form>
                          <!--PAGING-->
                          <?php if(isset($pagination)) echo $pagination; ?>
                          <!--END OF PAGING-->
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
                            </div>
                          </div>
                          <!--end of RC -->
 
  <!--END OF POST job-->
</div>
<!--END OF MAIN-->
</div></div>
<?php $this->load->view('footer'); ?>
