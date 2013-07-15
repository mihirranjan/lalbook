<div class="Container">
<?php $this->load->view('header'); ?>


<div class="clsMinContent clearfix">
<?php //$this->load->view('sidebar'); ?>
<div id="selMain clearfix"> 
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
<div id="Innermain">
      <!--POST JOB-->
      <div class="clsInnerpageCommon">        
                            <div class="clsInnerCommon">
							 <form method="post" action="<?php echo site_url('job/awardBid');?>">
								<h2><?php echo $this->lang->line('Pick Employee');?></h2>
								<table cellpadding="2" cellspacing="1" width="100%" class="clsBusiness">
								  <tr>
								   <th width="10%" class="dt">
									<?php echo $this->lang->line('Pick');?></th> 
                                    <th width="20%" class="dt"> <?php echo $this->lang->line('Employees');?> </th>
                                    <th width="20%" class="dt"> <?php echo $this->lang->line('Bid');?> </th>
                                    <th width="20%" class="dt"> <?php echo $this->lang->line('Delivery Time');?> </th>
                                    <th width="20%" class="dt"> <?php echo $this->lang->line('Time of Bid');?> </th>
                                    </tr>
								  <?php
									if(isset($bids) and $bids->num_rows()>0)
									{
										$i=1;
										foreach($bids->result() as $bid)
										{
											if($i%2==0)
											  {
												$class = 'dt1 dt0';
												$class2 = 'dt1';
											  }	
											else 
											  {
												$class = 'dt2 dt0';
												$class2 = 'dt2';
											  }	
											?>
								  <tr class="clsOdd">
									<td class="<?php echo $class2; ?>"> 
									<input type="radio" name="bidid" value="<?php echo $bid->id;?>" <?php if($i ==0) echo "checked";?>/></td>
									<td class="<?php echo $class2; ?>"> <a href="<?php echo site_url('employee/viewProfile/'.$bid->user_id);?>"><?php echo $bid->user_name;?></a>
									<?php foreach($favourite->result() as $favourite1)
									     { 
										   if($favourite1->user_id == $bid->user_id) 
										    { 
											  if($favourite1->user_role == '1') { ?> <img src="<?php echo image_url('favorite.png');?>" alt="Blocked User" /><?php }
											  if($favourite1->user_role == '2') { ?> <img src="<?php echo image_url('delete.png');?>" alt="Blocked User" /><?php }
											}
										 } ?>
									</td>
									<td class="<?php echo $class2; ?>">  $<?php echo $bid->bid_amount;?> </td> 
									<td class="<?php echo $class2; ?>">  <?php echo $bid->bid_days.$this->lang->line('days');?>&nbsp;<?php if($bid->bid_hours != 0) echo $bid->bid_hours.$this->lang->line('hours');?> </td> 
									<td class="<?php echo $class2; ?>">  <?php echo $bidstrdate=$bid->bid_time; echo $strdt=date("d-m-Y",strtotime($bidstrdate)); ?> </td> 
									
									</tr>
								  <?php		
											$i++;						
										}//For Each End - Latest job Traversal															
									}//If - End Check For Latest Jobs
								  ?>
								
							   </table>
							   <p style="padding:20px 0 0 10px !important;"><input type="submit" name="pickBid" class="clsCommonbut" value="<?php echo $this->lang->line('Pick Bid');?>"></p> 
							 </form>
                         
        </div>
      </div>
      <!--END OF POST JOB-->
    </div>
<!--END OF MAIN-->
  </div>  </div>
  
  </div></div></div></div></div></div></div></div></div></div></div>
<?php $this->load->view('home_footer'); ?>