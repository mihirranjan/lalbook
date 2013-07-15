<?php $this->load->view('header'); ?>
<div class="clsMinContent clearfix">
<?php $this->load->view('sidebar'); ?>
<style>
.clsHeadingRight {
    top: 15px;
	}
</style>
<!--MAIN-->
 <div id="main">
  <?php
		//Show Flash Message
		if($msg = $this->session->flashdata('flash_message'))
		{
			echo $msg;
		}
  ?>
      <!--MY JOBS-->
      <div class="clsInnerpageCommon">
      
                            <div class="clsInnerCommon">
                              <h2><?php echo $this->lang->line('Job resolution board');?> - <?php echo $this->lang->line('closed cases');?></h2>
							  <div class="clsHeads clearfix">
                            <div class="clsHeadingRight clsFloatRight">
                              <span class="clsPostProject"> <a href="<?php echo site_url('cancel/viewopenCases');?>" class="buttonBlack"><span><?php echo $this->lang->line("view open cases");?></span></a></span> 
                            </div>
							<div class="clsHeadingLeft clsFloatLeft">
                              <h3><span class="clsCancel"><?php echo $this->lang->line('Cancellation cases');?></span></h3>
                            </div>
                         </div>
							 
                             <table cellspacing="1" cellpadding="2" width="96%">
                                <tbody><tr>
                                  <td width="5%" class="dt"><?php echo $this->lang->line('SI.No');?></td>
                                  <td width="15%" class="dt"><?php echo $this->lang->line('Job Name');?></td>
                                  <td width="10%" class="dt"><?php echo $this->lang->line('Opened By');?></td>
								  <td width="15%" class="dt"><?php echo $this->lang->line('Date opened');?></td>
								  <td width="25%" class="dt"><?php echo $this->lang->line('reason');?></td>
								  <td width="20%" class="dt"><?php echo $this->lang->line('Last response');?></td>
								  <td width="8%" class="dt"><?php echo $this->lang->line('view');?></td>
                                </tr>
								<?php
						  	
						  	if(isset($cancellation) and $cancellation->num_rows()>0)
							{
								$i=0;
								foreach($cancellation->result() as $cancellation)
								{
									if($i%2==0)
										$class = 'dt1';
									else 
										$class = 'dt2';	
									?>
                                <tr>
                                  <td class="<?php echo $class;?> dt0"><?php echo $i+1;?>.</td>
                                  <td class="<?php echo $class;?>"><a href="<?php echo site_url('job/view/'.$cancellation->job_id); ?>"><?php echo $cancellation->job_name; ?></a></td>
                                  <td class="<?php echo $class;?>"><?php echo getUserDetails($cancellation->user_id,'user_name');?></td>
                                  <td class="<?php echo $class;?>"><?php echo get_date($cancellation->created); ?></td>
								  <td class="<?php echo $class;?>"><?php echo $cancellation->case_reason;?></td>
								  <td class="<?php echo $class;?>"><?php echo getLastResponse($cancellation->id,'Cancel');?></td>
                                  <td class="<?php echo $class;?>"><a href="<?php echo site_url('cancel/viewCase/'.$cancellation->id);?>" class="buttonBlack"><span><?php echo $this->lang->line('view');?></span></a></td>
                                </tr>
                              <?php		
						  			$i++;						
								}//For Each End - Latest Job Traversal															
							}//If - End Check For Latest Jobs
							else
							echo "<tr><td colspan=7 class='dt2'>".$this->lang->line('No cancellation cases')."</td></tr>";
						  ?>
                              </tbody></table>
							  
							 <div class="clsHeads clearfix">
  
							 <h3><span class="clsDisputes"><?php echo $this->lang->line('dispute_cases');?></span></h3> 
							 </div>
                             <table cellspacing="1" cellpadding="2" width="96%">
                                <tbody><tr>
                                   <td width="5%" class="dt"><?php echo $this->lang->line('SI.No');?></td>
                                  <td width="15%" class="dt"><?php echo $this->lang->line('Job Name');?></td>
                                  <td width="10%" class="dt"><?php echo $this->lang->line('Opened By');?></td>
								  <td width="15%" class="dt"><?php echo $this->lang->line('Date opened');?></td>
								  <td width="25%" class="dt"><?php echo $this->lang->line('reason');?></td>
								  <td width="20%" class="dt"><?php echo $this->lang->line('Last response');?></td>
								  <td width="8%" class="dt"><?php echo $this->lang->line('view');?></td>
                                </tr>
								 <?php
						  	
						  	if(isset($disputes) and $disputes->num_rows()>0)
							{
								$i=0;
								foreach($disputes->result() as $dispute)
								{
									if($i%2==0)
										$class = 'dt1';
									else 
										$class = 'dt2';
									?>
                               <tr>
                                 <td class="<?php echo $class;?> dt0"><?php echo $i+1;?></td>
                                  <td class="<?php echo $class;?>"><a href="<?php echo site_url('job/view/'.$dispute->job_id); ?>"><?php echo $dispute->job_name; ?></a></td>
								  <td class="<?php echo $class;?>"><?php echo getUserDetails($dispute->user_id,'user_name');?></td>
                                  <td class="<?php echo $class;?>"><?php echo get_date($dispute->created); ?></td>
								  <td class="<?php echo $class;?>"><?php echo $dispute->case_reason;?></td>
								  <td class="<?php echo $class;?>"><?php echo getLastResponse($dispute->id,'Dispute');?></td> 
								  <td class="<?php echo $class;?>"><a href="<?php echo site_url('cancel/viewCase/'.$dispute->id);?>" class="buttonBlack"><span><?php echo $this->lang->line('view');?></span></a></td>
                                </tr>
                                <?php		
						  			$i++;						
								}//For Each End - Latest Job Traversal															
							}//If - End Check For Latest Jobs
							else
							echo "<tr><td colspan=7 class='dt2'>".$this->lang->line('No dispute cases')."</td></tr>";
						  ?>
                              </tbody></table>							 
                            </div>
                          </div>
   
      <!--END OF POST JOB-->
    </div></div></div>

<!--END OF MAIN-->
</div></div></div>
<?php $this->load->view('footer'); ?>