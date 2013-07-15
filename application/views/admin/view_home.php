<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/sidebar'); ?>
 <!--MAIN-->
    <div id="main">
      <!--COL-RIGHT-->
          <!--CONTENT-->
      <div class="content">  
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
     

	  
	  <div class="clsLeft_hmenu">
      <div class="clsRight_hmenu">
        <div class="clsCen_hmenu">		
        <h2><b><?php echo $this->lang->line('Dashboard'); ?></b></h2>
		</div></div></div>
	       
        <div id="selLatest">
		
  <div class="inner_t">
      <div class="inner_r">
        <div class="inner_b">
          <div class="inner_l">
            <div class="inner_tl">
              <div class="inner_tr">
                <div class="inner_bl">
                  <div class="inner_br">
		
		 <h3><?php echo $this->lang->line('Latest Activity'); ?></h3>
          <div class="selQuickStatus clearfix">
            <!--<div class="selQuickStatusleft clsFloatRight">
      <p><img src="<?php echo image_url('chat.jpg'); ?>" height="80" width="85" alt="img" /></p>
            </div>-->         
            <div class="selQuickStatusRight clsFloatLeft">
             <!-- <h2><span style="padding:0px 0 0 0px; float:right;"><?php echo $this->lang->line('Admin Balance'); ?>:$<?php if(isset($adminBalance)) echo sprintf("%01.2f",$adminBalance); else echo '0.00'; ?></span><?php echo $this->lang->line('Quick Status'); ?></h2>-->
             <ul class="clearfix">
             
             
             <li class="clsMember"><table width=""><tr><td width="60%"><?php echo $this->lang->line('Total Users'); ?> </td> </tr><tr><td width="10%"><?php if(isset($owners)) echo $owners+$employees; ?></td> </tr><tr><td width="30%"><a href="<?php echo admin_url('users/viewUsers'); ?>"><?php echo $this->lang->line('Members'); ?></a></td></tr></table></li>
		
             
             
			  <li class="clsToday"><table width="">
              <tr><td width="60%"><?php echo $this->lang->line('Today'); ?> </td> </tr>
              <tr><td width="10%"><?php if(isset($today)) echo $today; ?></td></tr>
              <tr><td width="30%"><a href="<?php echo admin_url('skills/todayJobs'); ?>">  <?php echo $this->lang->line('Jobs'); ?></a></td></tr></table></li>
              
			  
                <li class="clsWeek"><table width=""><tr><td width="60%"><?php echo $this->lang->line('This Week'); ?> </td></tr>
                <tr><td width="10%"> <?php if(isset($week)) echo $week; ?></td></tr>
                <tr><td width="30%"><a href="<?php echo admin_url('skills/thisWeek'); ?>"> <?php echo $this->lang->line('Jobs'); ?> </a></td></tr></table></li>
                
                 <li class="clsMonth"><table width=""><tr><td width="60%"><?php echo $this->lang->line('This Month'); ?> </td> </tr><tr><td width="10%"><?php if(isset($month)) echo $month; ?></td></tr><tr><td width="30%"><a href="<?php echo admin_url('skills/thisMonth'); ?>"><?php echo $this->lang->line('Jobs'); ?></a></td></tr></table></li> 
				          
				<li class="clsYear"><table width=""><tr><td width="60%"><?php echo $this->lang->line('This Year'); ?>  </td> </tr>
                <tr><td width="10%"><?php if(isset($year)) echo $year; ?></td></tr>
                <tr><td width="30%"><a href="<?php echo admin_url('skills/thisYear'); ?>">  <?php echo $this->lang->line('Jobs'); ?></a></td></tr></table></li>
                
				
                <li class="clsOpenPros"><table width=""><tr><td width="60%"><?php echo $this->lang->line('Total Open Jobs'); ?> </td> </tr><tr><td width="10%"> <?php if(isset($open_jobs)) echo $open_jobs; ?></td></tr>
                <tr><td width="30%"><a href="<?php echo admin_url('skills/openJobs'); ?>"><?php echo $this->lang->line('Jobs'); ?></a></td></tr></table></li>
				 
                 <li class="clsClosedprojects"><table width=""><tr><td width="60%"><?php echo $this->lang->line('Total Closed Jobs'); ?>  </td></tr>
                 <tr> <td width="10%"><?php if(isset($closed_jobs)) echo $closed_jobs; ?></td></tr><tr><td width="30%"><a href="<?php echo admin_url('skills/closedJobs'); ?>"> <?php echo $this->lang->line('Jobs'); ?> </a></td></tr></table></li>

	              	 <li class="clsWidthdraw"><table width=""><tr><td width="60%"><?php echo $this->lang->line('Latest Open Jobs'); ?>  </td></tr><tr> <td width="10%"><?php if(isset($open)) echo $open; ?></td></tr><tr><td width="30%"><a href="<?php echo admin_url('skills/todayOpen'); ?>"> <?php echo $this->lang->line('Jobs'); ?></a></td></tr></table></li>
				 
                 <li class="clsLatestClosed"><table width=""><tr><td width="60%"><?php echo $this->lang->line('Latest Closed Jobs'); ?> </td> </tr><tr><td width="10%"> <?php if(isset($closed)) echo $closed; ?></td></tr><tr><td width="30%"><a href="<?php echo admin_url('skills/todayClosed'); ?>"><?php echo $this->lang->line('Jobs'); ?></a></td></tr></table></li>

                <li class="clsReport"><table width=""><tr><td width="60%"><?php echo $this->lang->line('Report Violation'); ?></td> </tr><tr><td width="10%"> <?php if(isset($reportViolation)) echo $reportViolation; ?></td></tr><tr><td width="30%"><a href="<?php echo admin_url('skills/reportViolation'); ?>"> <?php echo $this->lang->line('Jobs'); ?></a></td></tr></table></li>			
              	
				 
                 <li class="clsOpenPros"><table width=""><tr><td width="60%"><?php echo $this->lang->line('Withdrawal Request'); ?>  </td></tr><tr> <td width="10%"><?php if(isset($withdraw)) echo $withdraw; ?></td></tr><tr><td width="30%"><a href="<?php echo admin_url('payments/releaseWithdraw'); ?>"><?php echo $this->lang->line('View'); ?></a></td></tr></table></li>

				 </ul>
            </div>
          </div>
		</div></div></div></div></div></div></div></div>
		
		
        </div>
		<!--<div class="clsBottom clearfix"> 
		<div class="clsBottomleft clsFloatLeft">
		<h3 class="clsNoborder"><?php echo $this->lang->line('Version'); ?></h3>
		<ul>
		<li><a href="#"><?php echo $this->lang->line('Installed Version'); ?> - 2.0</a></li>
		</ul>
		</div>
		<div class="clsBottomRight clsFloatRight">
		</div>
      </div>-->
    </div>
    <!--END OF CONTENT-->
    
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
  </div>
  <!--END OF MAIN-->
<?php $this->load->view('admin/footer'); ?>