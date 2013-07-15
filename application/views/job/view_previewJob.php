<?php $this->load->view('header'); ?>
<div class="clsMinContent clearfix">
<?php $this->load->view('sidebar'); ?>
<!--MAIN-->
<?php
		//Get Job Info
     	$jobs = $jobs->row();
?>
<div id="main" >
  <!--JOB DETAILS-->
   <div class="clsEditProfile">
     <div class="clsPostProject">
        <div class="block">
          <div class="inner_t">
            <div class="inner_r">
              <div class="inner_b">
                <div class="inner_l">
                  <div class="inner_tl">
                    <div class="inner_tr">
                      <div class="inner_bl">
                        <div class="inner_br">
                          <div class="cls100_p">
                            <div class="clsInnerCommon">
							<h2> <?php echo $this->lang->line('Preview Job');?> </h2>
                            
                            <table width="98%" cellspacing="1" cellpadding="2" class="clsTable">
						                              <tbody>
                              <tr>
                                <td width="15%" class="dt"><?php echo $this->lang->line('Job Details');?></td>
                                <td width="200" class="dt">&nbsp;</td>
                              </tr>
                          <tr>
                          <td>
							<?php echo 'Job Name';?>:</td> 
							<td><?php echo $jobs->job_name; ?></td>
                            </tr>
                            
                            <tr class="odd">
                            <td>                    
							<?php echo $this->lang->line('Status:');?></td>
                            <td><?php echo 'Pending'?></td>
                            </tr>
                            
                            <tr>
                            <td>                        
							<?php echo $this->lang->line('Budget:');?></td>
							<td><?php if($jobs->budget_min != '0' and $jobs->budget_max!='0') { echo $currency.$jobs->budget_min.' - '.$jobs->budget_max; } else echo 'N/A'; ?></td>
                            </tr>
                            <tr class="odd">
                            <td>
							<?php echo $this->lang->line('Created:');?></td>
							<td><?php echo get_date(time())." Today "; ?></td>
                            </tr>
                            
                            <tr>
                            <td>
							<?php echo $this->lang->line('Bidding Ends:');?></td>
							<td><?php echo date('d/M/Y',$jobs->enddate);?> (<?php $val =round($jobs->enddate - $jobs->created) / (60 * 60 * 24); if($val > 1) echo $val." days"; else $val." day";?> <?php echo $this->lang->line('Left');?>)</td>
                            </tr>
                            <tr class="odd">
                            <td>
							<?php echo $this->lang->line('Job Creator:');?></td>
                            <td><a href="<?php echo site_url('owner/viewProfile/'.$loggedInUser->id);?>"><?php echo $loggedInUser->user_name; ?></a><?php 
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
</td>
</tr>

<tr><td>
							<?php echo $this->lang->line('Description:');?></td><td><?php echo $jobs->description; ?></td></tr>
                            <tr class="odd">
                            <td>
							<?php echo $this->lang->line('Job Type:');?></td><td><?php echo $jobs->job_categories;?></td></tr>
                            </tbody>
                            </table>
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
	  </div>
	  </div>
      </div>
<!--END OF MAIN-->
<?php $this->load->view('footer'); ?>