<?php $this->load->view('header'); ?>
 <div class="clsMinContent clearfix">
<?php $this->load->view('sidebar'); ?>
<!--MAIN-->
<div id="main">
	  <!--POST PROJECT-->
        <?php
       $transactions1 = $transactions1;	  
	   $transactions = $transactions1->row();?>
	  <div class="clsTabs clsInnerCommon clsInfoBox">
     
							<div class="clsInnerCommon">
 							  <h3><span class="clsMyEscrow"><?php echo $this->lang->line('Owner Account Management');?></span></h3>
							  <p class="clsTopMar"><?php echo $this->lang->line('Welcome');?> <?php echo $loggedInUser->name?>!  <font color="#6b80a1"><?php echo $this->lang->line('Local time');?> </font><?php echo show_date(time()); ?></p>
							  <?php  
							//Show Flash error Message  after login successfully
							 if($msg = $this->session->flashdata('flash_message'))
								{
								echo $msg;
								}
							  ?>
							<h3><span class="clsHigh"><?php echo $this->lang->line('My Withdraw Transactions');?></span></h3>
							
							<table cellspacing="1" cellpadding="2" style="margin:1em 0 0 5px!important; width:98%!important;">
                                <tbody><tr>
                                  <td width="5%" class="dt"><?php echo $this->lang->line('Debit');?></td>
                                  <td width="5%" class="dt"><?php echo $this->lang->line('Credit');?></td>
                                  <td width="20%" class="dt"><?php echo $this->lang->line('Description');?></td>
								  <td width="20%" class="dt"><?php echo $this->lang->line('Job');?></td>
								  <td width="15%" class="dt"><?php echo $this->lang->line('Date');?></td>
								  <td width="15%" class="dt"><?php echo $this->lang->line('Status');?></td>
                                </tr>
                               
							   <?php $i=1; $k=0;
						      foreach($transactions1->result() as $res)
								{  $i=$i+1; $k=$k+1;
								  if($i%2 == 0)
								    {
								    $class ="dt1 dt0";
									$class2="dt2";
									}
								  else
								    {
								    $class ="dt2 dt0";	
									$class2="dt2";
									}?>
						          <tr class="<?php echo $class; ?>">
								  
								 <!-- Inly for Debit Payments -->
								 
								  <td class="<?php echo $class2; ?>"><?php 
								  if($res->type == 'Job Fee' or $res->type == 'Withdraw' or $res->type =='Certified Member Package Fee') 
								  {
								    echo '<b style="color:red">'.$res->amount.'</b>';
								  }
								  else if($res->type == 'Transfer' or $res->type == 'Escrow Transfer' or $res->type =='Package Fee') 
								  {
								     if($res->creator_id == $loggedInUser->id)
									  {
									    echo '<b style="color:red">'.$res->amount.'</b>'; 
									  } else { echo 'Nil'; }
								  } else { echo 'Nil'; }?></td>
								  								  
								 <!-- Inly for Credit Payments -->
								 
								  <td class="<?php echo $class2; ?>"><?php 
								    
									if($res->type == 'Transfer' or $res->type == 'Escrow Transfer') 
								      {
								       if($res->reciever_id == $loggedInUser->id)
									    {
									    echo '<b style="color:green">'.$res->amount.'</b>'; 
									     }  else { echo 'Nil'; }
										 
								      }
									  else if($res->type == 'Deposit') 
									  {   
										echo '<b style="color:green">'.$res->amount.'</b>';
									  }	
									  else { echo 'Nil'; }?></td>
								 
								  <td class="<?php echo $class2; ?>"><?php echo $res->description;  ?></td>
							      <td class="<?php echo $class2; ?>"><?php foreach($projectList->result() as $project) { if($project->id == $res->job_id) { echo $project->job_name; } }  ?></td>
								  <td class="<?php echo $class2; ?>"><?php echo get_datetime($transactions->transaction_time); ?></td>  							      
								  <td class="<?php echo $class2; ?>"><?php echo $res->status; ?> </td> 
							      </tr>  <?php 
								  
								} ?>	 	  
                              </tbody></table>
							  <!--PAGING-->
								<?php if(isset($pagination)) echo $pagination;?>
							 <!--END OF PAGING-->

							</div>
							</div>   
                            </div>
  <!--END OF MAIN-->
  </div></div>
<?php $this->load->view('footer'); ?>
