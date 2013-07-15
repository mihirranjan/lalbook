<?php $this->load->view('header'); ?>
<div class="clsMinContent clearfix">
<?php $this->load->view('sidebar'); ?>
<div id="main">
      <!--POST JOB-->
      <div class="clsInnerpageCommon">
      
                            <div class="clsInnerCommon">
                              <h2><?php echo $title; ?></h2>
						       <p style="padding-left:10px !important;"><b><?php echo $this->lang->line('User Name'); ?> : </b><?php echo $loggedInUser->user_name; ?></p>
							   <table>
		 					  	<tr>
							      <td width="10%" class="dt"><?php echo $this->lang->line('Sl.No'); ?></td>								  
								  <td width="20%" class="dt"><?php echo $this->lang->line('Creator Name'); ?></td>								  
								  <td width="20%" class="dt"><?php echo $this->lang->line('Job Name'); ?></td>
								  <td width="10%" class="dt"><?php echo $this->lang->line('Budget'); ?></td>
						          <td width="15%" class="dt"><?php echo $this->lang->line('Post Date'); ?></td>
							      <td width="10%" class="dt"><?php echo $this->lang->line('Status'); ?></td><?php 
								  if(!isset($invitation) and isset($awards) ) 
									  { ?>	
								 <!-- <td width="10%" class="dt">&nbsp;</td>--> <?php } ?>
								</tr>
								<tr>
						      <?php 
							  if(isset($notifyData)) 
							  { 
							 
							  $i=1; $k=0; 
						     foreach($notifyData as $res)
							 {
								//pr($res);
								foreach($res as $rec)
								  { $i=$i+1; 
								  
								  if($i%2 == 0)
								    {
								    $class ="dt1 dt0";
									$class2 = "dt2";
									}
								  else
								    {
								    $class ="dt2 dt0";	
									$class2 = "dt1";
									}
									  $k=$k+1;
										?>
									  
									  <td class="<?php echo $class2; ?>"><?php echo $k; ?></td>
									  <td class="<?php echo $class2; ?>"><?php foreach($Users->result() as $user) { if($user->id == $rec->creator_id) { ?><a href="<?php echo site_url('owner/viewProfile/'.$user->id); ?>"> <?php  echo $user->user_name; ?></a><?php  } } ?></td>	
									  <td class="<?php echo $class2; ?>"><a href="<?php echo site_url('job/view/'.$rec->id); ?>" onclick="check1('<?php echo $k; ?>');" id="show<?php echo $k; ?>"><?php echo $rec->job_name; ?></a></td>
									  <td class="<?php echo $class2; ?>"><?php echo $currency. $rec->budget_min.' - '$currency. $rec->budget_max;?></td>
									  <td class="<?php echo $class2; ?>"><?php echo get_datetime($rec->created); ?></td>
									  <td class="<?php echo $class2; ?> etopsp"><?php if($rec->job_status == '0') echo '<b style="color:green;">'.'Open'.'</b>'; if($rec->job_status == '2') echo '<b style="color:red;">'.'Closed'.'</b>'  ?><?php 
									  //Only for job Awards notification
									  if(!isset($invitation) and isset($awards) ) 
									  { ?>	      
									     <a href="<?php echo site_url('job/acceptJob/'.$rec->id.'/'.$rec->checkstamp); ?>"> <?php echo $this->lang->line('Accept'); ?></a>  
									     <a href="<?php echo site_url('job/denyJob/'.$rec->id.'/'.$rec->checkstamp); ?>"> <?php echo $this->lang->line('Denied'); ?></a> <?php
									  } ?>
									  
									 </td></tr>  <?php
									}  
 								 } 
							   }else{
							   echo 'No Records Found';
							   }		
								?>	 	  
							</table>
                            </div>
                         
      </div>
      <!--END OF POST JOB-->
    </div> 
	 <!--PAGING-->
	  	<?php if(isset($pagination_inbox)) echo $pagination_inbox;?>
	 <!--END OF PAGING-->
 
<!--END OF MAIN-->
</div></div>
<script type="text/javascript">
  function check(value,value1)
	{
	  id = document.getElementById(value1).value;
	  ex2 = document.getElementById('msg'+value);
	 load_user(id);
	}
	
  function load_user(value1)
   {
	
	var url = '<?php echo site_url('jobNotify/invitationupdate');?>'+'/'+value1;
	
	new Ajax.Request(url,
	  {
		method:'get',
		onSuccess: function(transport){
		  var response = transport.responseText || "no response text";
		  alert();
		},
		onFailure: function(){ alert('Something went wrong...') }
	  });
													
  } //Function load_category end
  </script>
<?php $this->load->view('footer'); ?>