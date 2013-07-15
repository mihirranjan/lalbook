<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/sidebar'); ?>
<div id="main">
  <div class="clsSettings">
    <div class="clsMainSettings">
	
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
	 <?php
		//Show Flash Message
		if($msg = $this->session->flashdata('flash_message'))
		{
			echo $msg;
		}
	  ?>
	 <!--TOP TITLE & RESET-->
        <div class="clsTop clsClearFixSub">
		<div class="clsNav4">
		  <div class="clsTitle">
          <h3><?php echo $this->lang->line('view cases'); ?></h3>
        </div>  
    
      </div>
      <!--END OF TOP TITLE & RESET-->
    </div>
    <div class="clsMidWrapper clearfix">
      <!--MID WRAPPER-->
     
      
        <table class="table" cellpadding="2" cellspacing="0" align="left">
		  <tr>
          <th><?php echo $this->lang->line('case_id'); ?></th>
		  <th><?php echo $this->lang->line('Job'); ?></th>
		  <th><?php echo $this->lang->line('case_type'); ?></th>
		  <th><?php echo $this->lang->line('case_reason'); ?></th>
		  <th><?php echo $this->lang->line('opened_by'); ?></th>
		  <th><?php echo $this->lang->line('view'); ?></th>
		  </tr>
		        
		<?php
		   	if(isset($jobCases))
			{
				foreach($jobCases->result() as $jobCases)
				{ 
					
		?>
			 <tr>
			  <td><?php echo $jobCases->id; ?></td>
			  <td><a href="<?php echo admin_url('skills/jobDeatils/'.$jobCases->job_id);?>"><?php echo $jobCases->job_name; ?></a></td>
			  <td><?php echo $jobCases->case_type;?></td>
			  <td><?php echo $jobCases->case_reason; ?></td>
			  <td><a href="<?php echo admin_url('users/userDetails/'.$jobCases->user_id);?>"><?php echo getUserDetails($jobCases->user_id,'user_name');?></a></td>
		<td>
			  <a href="<?php echo admin_url('jobCases/view/'.$jobCases->id)?>"><?php echo $this->lang->line('view'); ?></a></td>
        	</tr>
        <?php
				}//Foreach End
			}//If End
		?>
		</table>
     
    </div>
    <!--END OF MID WRAPPER-->
	
	</div></div></div></div></div></div></div></div> </div></div> 
	
  </div>
  <!-- End of clsSettings -->
</div>
</div>
<!-- End Of Main -->
<?php $this->load->view('admin/footer'); ?>