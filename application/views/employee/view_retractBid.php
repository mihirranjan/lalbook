<?php $this->load->view('header'); ?>
<div class="clsMinContent clearfix">
<?php $this->load->view('sidebar'); ?>
<!--MAIN-->
<div id="main">
      <!--POST JOB-->
      <div class="clsInnerpageCommon">
        
						  <form method="post" action="<?php echo site_url('employee/retractBid');?>">
                            <div class="clsInnerCommon">
                              <h2><?php echo $this->lang->line('Retract Bid !');?></h2>
							  <p style="padding-left:1em !important;"><?php echo $this->lang->line('Are you sure you want to retract your bid');?></p>
							  <p style="padding-left:1em !important;">
								<input type="submit" name="retractBid" value="<?php echo $this->lang->line('Retract');?>" class="clsLogin_but" />
								<input type="hidden" name="bidId" value="<?php echo $bidid;?>" />
							  </p>
                            </div>
							</form>
                          </div>

      <!--END OF POST JOB-->
    </div>
	</div></div>
<!--END OF MAIN-->
<?php $this->load->view('footer'); ?>