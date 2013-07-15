<?php $this->load->view('header'); ?>
<div class="clsMinContent clearfix">
<?php $this->load->view('sidebar'); ?>
<!--MAIN-->
<div id="main">

      <!--POST Job-->
      <div class="clsInnerpageCommon">
        
                            <div class="clsInnerCommon">
								<h2><?php echo $this->lang->line('Delete Job') ?></h2> <?php
								 if(isset($projects))
								  { 
								    foreach($projects->result() as $res)
									  { ?>
									  	<p style="padding:1em !important;"> <span><b><?php echo $this->lang->line('Job Name') ?></b></span>    	<a href="<?php echo site_url('job/view/'.$res->id); ?>"><?php echo $res->job_name;?></a></p>
										
										<?php 
									   }
								  } ?>
								<form action="<?php echo site_url('job/cancelJob/'.$res->id); ?>" method="post" name="myform" id="myform">
									<p>
									  <label><b><?php echo $this->lang->line('are you sure to delete'); ?> </b></label> &nbsp;&nbsp;
									  <input type="submit" name="delete" value="Yes" class="clsLogin_but" />
									  <input type="submit" name="viewProject" value="No" class="clsLogin_but" onclick="javascript:submit1(<?=$res->id?>)"/>
									</p>
									
								</form>
								
								</div>	
                            </div>
                          </div>
                      
        </div>
      </div>
      <!--END OF POST Job-->
<!--END OF MAIN-->
<?php $this->load->view('footer'); ?>
<script>
function submit1(id)
{
	document.myform.action='<?php echo site_url('job/view'); ?>/'+id;
}
</script>
