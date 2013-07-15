<?php $this->load->view('header'); ?>
<div class="clsMinContent clearfix">
<?php $this->load->view('sidebar'); ?>
<!--MAIN-->
<div id="main">
  <!--POST JOB-->
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
                          <h2><?php echo $this->lang->line('Top Owners');?></h2>
                          <table cellspacing="1" cellpadding="2" width="96%">
                            <tbody>
                              <tr>
                                <td width="30" class="dt"><?php echo $this->lang->line('Sl.No');?></td>
                                <td width="250" class="dt"><?php echo 'Owner Name';?></td>
                                <td width="60" class="dt"><?php echo $this->lang->line('Rating');?></td>
                                <td width="250" class="dt"><?php echo $this->lang->line('Reviews');?></td>
                              </tr>
                              <?php 
							   if(isset($topOwners) and count($topOwners)>0){
							  	 $i=0;
								  foreach($topOwners as $key=>$value)
									{
									  $user = getUserInformation($key);
									  if( $i%2 ==0 )
										$class = 'dt1 dt0';
									  else 
										$class = 'dt2 dt0';		
									   ?>
                              <tr class="<?php echo $class; ?>">
                                <td><?php echo $i=$i+1;?></td>
                                <td><a href="<?php echo site_url('owner/viewProfile/'.$user->id);?>"><?php echo $user->user_name;?></a>
								<?php 
								$condition1=array('subscriptionuser.username'=>$user->id);
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
                                <td><?php echo $user->user_rating;?></td>
                                <td><?php echo $user->num_reviews;?></td>
                              </tr>
                              <?php  
								} //foreach end
									
								} else{ ?>
 									<tr><td colspan="4"><p class="clsNoResult"><?php echo  'No Results Found.';?></p></td></tr>
								<?php }?>	
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
                          <!--end of RC -->  
  <!--END OF POST JOB-->
</div>
<!--END OF MAIN-->
</div></div>
<?php $this->load->view('footer'); ?>