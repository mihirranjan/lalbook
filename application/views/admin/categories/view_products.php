<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/sidebar'); ?>
<style type="text/css">
table.table td {
    font-size: 13px !important;
    padding: 0.3em 0.4em !important;
    text-align: left;
    text-transform: capitalize;
}
.clsNav li a {
   /* background: url("images/nav_sep.jpg") no-repeat scroll left center transparent;*/
    color: #777777;
    margin: 0 0 0 5px !important;
    padding: 0 0 0 15px;
}
</style>
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
            <li><a href="<?php echo admin_url('categories/addCategory');?>"><b><?php echo $this->lang->line('Add Categories'); ?></b></a></li>
			<!--<li><a href="<?php echo admin_url('users/searchUsers');?>"><b><?php echo $this->lang->line('search_category'); ?></b></a></li>-->
			<li class="clsNoBorder"><a href="<?php echo admin_url('categories/viewCategories');?>"><b><?php echo $this->lang->line('View Categories'); ?></b></a></li>
          </ul>
        </div>
		<div class="clsTitle">
          <h3><?php echo $this->lang->line('View Categories'); ?></h3>
        </div>
		
      </div>
	  
 
       <table width="700" class="table">
        <thead>
		  <tr>


		  <th>&nbsp;</th>
            <th><?php echo $this->lang->line('Sl.No');?></th>
			<th>Category Type</th>
			<th><?php echo $this->lang->line('Category Name');?></th>
           
			<th><?php echo $this->lang->line('action'); ?></th>
          <!--  <th colspan="2"><span class="functions text-center" id="tip" style="opacity: 1;"> </span></th>-->
          </tr>
        </thead>
        <tbody>
		<?php 
		
		$no=1;
		if(isset($userDetails) and $userDetails->num_rows()>0)
		{
		//print_r($userDetails);exit;
		foreach($userDetails->result() as $userDetail)
			{ //print_r($userDetail);
	
		?>
		<form name="manageuserdetail" action="" method="post" > 
          <tr>
		    <td><input type="checkbox" class="clsNoborder" name="catelist[]" id="catelist[]" value="<?php echo $userDetail->category_id; ?>"  /> </td>
            <td><?php echo $no++;?></td>
			<td><?php $catetype=$userDetail->cate_type; if($catetype==1) { echo "Products";} if($catetype==2){ echo "Services";} if($catetype==3){ echo "Both";}?></td>
			<td><?php echo $userDetail->category;?></td>
           
			
            <td class="functions">
			<a title="Edit" class="icon edit tip" href="<?php echo admin_url('categories/editCategory/'.$userDetail->category_id);?>"><img src="<?php echo image_url('edit-new.png'); ?>" alt="Edit" title="Edit" /></a>
			<a title="Delete" href="<?php echo admin_url('categories/deleteCategory/'.$userDetail->category_id);?>" onclick="return confirm('Are you sure want to delete??');"><img src="<?php echo image_url('delete-new.png'); ?>" alt="Delete" title="Delete" /></a> </td>
          </tr>
		  <?php } 
		  }
		  else{ ?>
		   <tr>
            <td colspan="5"><?php echo $this->lang->line('No Records found');?></td></tr>
		  <?php }
		  ?>
        </tbody>
      </table>
	
	
	  <div class="clscenter clearfix">
	  <div id="selLeftAlign">
	<?php echo $this->lang->line('With Selected'); ?>
	<a name="delete" href="javascript: document.manageuserdetail.action='<?php echo admin_url('categories/deleteCategory'); ?>'; document.manageuserdetail.submit();" onclick="return confirm('Are you sure want to delete??');"><img src="<?php echo image_url('delete-new.png'); ?>" alt="Delete" title="Delete" /></a></div>
	

	   <!--PAGING-->
	  		<?php if(isset($pagination)) echo $pagination;?>
	 <!--END OF PAGING-->
	 </div>
	  </div></div></div></div></div></div></div></div></div></div>   
	  
	 
    </div>
  </div>
</div>
<?php $this->load->view('admin/footer'); ?>