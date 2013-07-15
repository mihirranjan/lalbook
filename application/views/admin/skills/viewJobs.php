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
      <div class="clsTop clsClearFixSub">
        
        <div class="clsNav">
          <ul>
            <li class="clsNoBorder"><a href="<?php echo admin_url('skills/searchJobs')?>"><b><?php echo $this->lang->line('Search'); ?></b></a></li>
          </ul>
        </div>
		<div class="clsTitle">
          <h3><?php echo $this->lang->line('View Jobs'); ?></h3>
        </div>
      </div>
    
       <table class="table" cellpadding="2" cellspacing="0">
        <th></th>
		<th><?php echo $this->lang->line('Sl.No'); ?></th>
        <th><?php echo $this->lang->line('Job Id'); ?></th>
		<th><?php echo $this->lang->line('Job Name'); ?> </th>
        <th><?php echo $this->lang->line('Post By'); ?> </th>
		<th><?php echo $this->lang->line('Start Date'); ?> </th>
		<th><?php echo $this->lang->line('End Date'); ?> </th>
      
	  <?php
			if(isset($jobs) and $jobs->num_rows()>0)
			{  $i=0;
				foreach($jobs->result() as $job)
				{
		?>
		 <form action="" name="manageProject" method="post">
			 <tr>
			  <td><input type="checkbox" class="clsNoborder" name="projectList[]" id="projectList[]" value="<?php echo $job->buy_id; ?>"  /> </td>
			  <td><?php echo $i=$i+1; ?> </td>
			  <td><?php echo $job->buy_id; ?> </td>
			  <td><?php echo $job->looking_for; ?>  </td>
			  <td><?php echo $job->user_name; ?> </td>
			  <td><?php echo date('Y-m-d',strtotime($job->created)); ?> </td>	
			  <td><?php echo date('Y-m-d',strtotime($job->end_date)); ?></td>
        	</tr>
		  
        <?php
				}//Foreach End 
			?>
			 <?php 	
			}//If End
			else
			{ 			
			  echo '<tr><td colspan="5">'.$this->lang->line('No Jobs Found').'</td></tr>'; 
			}
		?>
	</form> 
		</table>
		<br />
    <div class="clscenter clearfix">
	  <div id="selLeftAlign">
	<?php echo $this->lang->line('With Selected'); ?>
		   <a name="edit" href="javascript: document.manageProject.action='<?php echo admin_url('skills/manageJobs'); ?>'; document.manageProject.submit();"><img src="<?php echo image_url('edit-new.png'); ?>" alt="Edit" title="Edit" /></a>
           <a name="delete" href="javascript: document.manageProject.action='<?php echo admin_url('skills/deleteJobs'); ?>'; document.manageProject.submit();" onclick="return confirm('Are you sure want to delete??');"><img src="<?php echo image_url('delete-new.png'); ?>" alt="Delete" title="Delete" /></a></div>
	<!--PAGING-->
	  	<?php if(isset($pagination)) echo $pagination;?>
	 <!--END OF PAGING-->
      <!-- End clsTable-->
    </div>
	
	
	</div></div></div></div></div></div></div></div> </div></div>  
	
	</div>
    <!-- End clsMainSettings -->
  </div>
</div>
<?php $this->load->view('admin/footer'); ?>
