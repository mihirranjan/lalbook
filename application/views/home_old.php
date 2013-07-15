<?php $this->load->view('header1'); ?>
<?php //$this->load->view('sidebar'); ?>
<!--MAIN-->

	  <!--SelBlocks-->
	<div id="selBlocks" class="clearfix"> 
    <div id="selLeftBlock">
    <div class="clsMostPopular">
	<h3><?php echo $this->lang->line('MOST POPULAR SKILLS');?></h3>
	<ul class="clearfix"><?php 
	
			if(isset($top_skills) and $top_skills->num_rows()>0){
			 $job_categories = '';
	   
    		foreach($top_skills->result() as $cat)
			{
  				$job_categories .= $cat->job_categories.',';
 			}
			$trim_cat    = trim($job_categories,',');
			$array_cat   = explode(',',$trim_cat);
			$array_count =array_count_values($array_cat);//pr($result);
			$array_keys	 =array_keys($array_count);
				
			foreach($array_keys as $key){
				foreach($categories->result() as $category){
				    if($category->category_name==$key){
		 ?>
			<li><a href="<?php echo site_url('job/category')."/$category->category_name";?>"><span> <img src="<?php echo cimage_url($category->attachment_url);?>"/><?php echo $category->category_name;?></span></a></li>
 		 <?php }}}}else{?>
			<li><span class="clsIcon1"> Programmer</span></li>
			<li><span class="clsIcon2">Designer</span></li>
			<li><span class="clsIcon3">Mobile Developers</span></li>
			<li><span class="clsIcon4">Admins</span></li>
			<li><span  class="clsIcon5">SEO</span></li>
			<li><span class="clsIcon4">HR</span></li>
		 <?php }?>
   </ul>
 	</div>
	<div class="clsStatistics">
	<h3><?php echo $this->lang->line('Latest Statistics');?></h3>
	<ul>
	<li><label><?php echo 'Users';?></label><span><?php if(isset($owners)) echo $owners+$employees; ?></span></li>
	<li><label><?php echo $this->lang->line('Jobs');?></label><span><?php if(isset($open_jobs)) echo $open_jobs; ?></span></li>
	<li><label><?php echo $this->lang->line('Work Done');?></label><span><?php if(isset($closed_jobs)) echo $closed_jobs; ?></span></li>
   </ul>
	</div>
	
    </div>
    <div id="selRightBlock">
    <!-- Sel Featured Job-->
<div id="selFeatured" class="clearfix">
	<h3><span>Featured Jobs</span></h3>


    <table border="0" cellpadding="0" cellspacing="" width="100%">
    <tr>
		 <th width="35%" align="left"><?php echo $this->lang->line('Job Name');?></th>
		 <th width="5%" align="center">Amount</th>
		 <th width="30%" align="center"><?php echo $this->lang->line('Job Type');?></th>
		 <th width="15%" align="left" style="padding-left:15px;"><?php echo $this->lang->line('Start Date');?></th>
		 <th width="15%" align="left" style="padding-left:15px;"><?php echo $this->lang->line('End Date');?></th>
     </tr>
	</table>
	
 	<table border="0" cellpadding="0" cellspacing="" width="100%" class="clsTable">
		<?php
			if(isset($featuredJobs) and $featuredJobs->num_rows()>0)
			{
				$i=0;
				foreach($featuredJobs->result() as $featuredJob)
				{
					if($i%2==0)
					$class = 'clsOdd';
					else 
					$class = 'clsEven';	
					?>
			  <tr class="<?php echo $class;?>">
				  <td width="35%"><a href="<?php echo site_url('job/view/'.$featuredJob->id); ?>"><?php echo $featuredJob->job_name; ?></a>
					<?php  
						  if($featuredJob->is_urgent == 1)
						  echo '&nbsp<span class="clsUrgent">URGENT JOB</span>';
						  
						  if($featuredJob->is_private == 1)
						  echo '&nbsp;&nbsp;<span class="clsFea">PRIVATE JOB</span>';
					 ?>
				   </td>
				   <td width="5%" align="center"><?php echo $featuredJob->budget_max; ?></td>
				   <td width="30%" align="center"><?php echo getCategoryLinks($featuredJob->job_categories); ?></td>
				   <td width="15%"><?php echo get_date($featuredJob->created);?></td>
				   <td width="15%"><?php echo get_date($featuredJob->enddate);?></td>
			 </tr>
			<?php		
				$i++;						
			   }//For Each End															
		   }else{ ?>
			<tr><td colspan="5"><p class="clsNoResult"><?php echo  'No Results Found.';?></p></td></tr>
			<?php }?>
      </table>
    <p class="clsAlign"><input type="button" class="clsView_but" value="View All" onclick="window.location='<?php echo site_url('job/viewAllJobs/is_feature'); ?>'"/></p>
</div>     
<!-- Sel Featured Job-->   

<!-- Sel Latest Job-->
<div id="selFeatured" class="clearfix">
	<h3><span>Latest Jobs</span></h3>
	
    <table border="0" cellpadding="0" cellspacing="" width="100%">
		<tr>
			 <th width="35%" align="left"><?php echo $this->lang->line('Job Name');?></th>
			 <th width="5%" align="center">Amount</th>
			 <th width="30%" align="center"><?php echo $this->lang->line('Job Type');?></th>
			 <th width="15%" align="left" style="padding-left:15px;"><?php echo $this->lang->line('Start Date');?></th>
			 <th width="15%" align="left" style="padding-left:15px;"><?php echo $this->lang->line('End Date');?></th>
		 </tr>
	</table>

    <table border="0" cellpadding="0" cellspacing="" width="100%" class="clsTable">
		<?php
			if(isset($latestJobs) and $latestJobs->num_rows()>0)
			{
				$i=0;
				foreach($latestJobs->result() as $latestJob)
				{
					if($i%2==0)
					$class = 'clsOdd';
					else 
					$class = 'clsEven';	
					?>
			  <tr class="<?php echo $class;?>">
				  <td width="35%"><a href="<?php echo site_url('job/view/'.$latestJob->id); ?>"><?php echo $latestJob->job_name; ?></a>
					<?php  
						  if($latestJob->is_urgent == 1)
						  echo '&nbsp<span class="clsUrgent">URGENT JOB</span>';
						  
						  if($latestJob->is_feature == 1)
						  echo '&nbsp;&nbsp;<span class="clsHbgt">FEATURED JOB</span>';
							
						  if($latestJob->is_private == 1)
						  echo '&nbsp;&nbsp;<span class="clsFea">PRIVATE JOB</span>';
					 ?>
				   </td>
				   <td width="5%" align="center"><?php echo $latestJob->budget_max; ?></td>
				   <td width="30%" align="center"><?php echo getCategoryLinks($latestJob->job_categories); ?></td>
				   <td width="15%"><?php echo get_date($latestJob->created);?></td>
				   <td width="15%"><?php echo get_date($latestJob->enddate);?></td>
			 </tr>
			<?php		
				$i++;						
			   }//For Each End															
		   }else{ ?>
			<tr><td colspan="5"><p class="clsNoResult"><?php echo  'No Results Found.';?></p></td></tr>
			<?php }?>
       </table>
    <p class="clsAlign"><input type="button" class="clsView_but" value="View All" onclick="window.location='<?php echo site_url('job/viewAllJobs/all'); ?>'" /></p>
</div>     
<!-- Sel Latest Job-->  
    </div>
	</div> 
	   <!--SelBlocks-->
 <!-- Sel Post Block-->      

<!-- Sel Post Block-->        
   

</div>
<?php $this->load->view('footer'); ?>