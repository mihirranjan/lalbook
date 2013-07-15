<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/sidebar'); ?>
<style type="text/css">
table.table td {
    font-size: 13px !important;
    padding: 0.3em 0.4em !important;
    text-align: left;
    text-transform: capitalize;
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
            <li><a href="<?php echo admin_url('users/addUsers');?>"><b><?php echo $this->lang->line('Add Services'); ?></b></a></li>
			<li><a href="<?php echo admin_url('users/searchUsers');?>"><b><?php echo $this->lang->line('search_service'); ?></b></a></li>
			<li class="clsNoBorder"><a href="<?php echo admin_url('users/viewUsers');?>"><b><?php echo $this->lang->line('View Services'); ?></b></a></li>
          </ul>
        </div>
		<div class="clsTitle">
          <h3><?php echo $this->lang->line('View Services'); ?></h3>
        </div>
		
      </div>
	  
 
       <table width="700" class="table">
        <thead>
		  <tr>


		  <th>&nbsp;</th>
            <th><?php echo $this->lang->line('Sl.No');?></th>
			<th><?php echo $this->lang->line('Services Name');?></th>
           
			<th><?php echo $this->lang->line('action'); ?></th>
          <!--  <th colspan="2"><span class="functions text-center" id="tip" style="opacity: 1;"> </span></th>-->
          </tr>
        </thead>
        <tbody>
		<?php 
		
		$no=1;
		if(isset($serviecedetails) and $serviecedetails->num_rows()>0)
		{
		//print_r($userDetails);exit;
		foreach($serviecedetails->result() as $serviceDetail)
			{ //print_r($userDetail);
	if(isset($usrrequirement))
		{
		//$bidcount=$usrrequirement->num_rows();
		$usrid=$serviceDetail->service_id;
		$condition = array('users.id' => $usrid);
		//$registeron=$userDetail->created;
		//$registerdate=date('d-m-Y',$registeron);
		$getuserbids=$this->user_model->getUserbids($condition);
		$bidcount=$getuserbids->num_rows();
		foreach($getuserbids->result() as $buyrequirementcount)
		{
		//print_r($buyrequirementcount);
		}
			}
		?>
		<form name="manageuserdetail" action="" method="post" > 
          <tr>
		    <td><input type="checkbox" class="clsNoborder" name="userlist[]" id="userlist[]" value="<?php echo $serviceDetail->service_id; ?>"  /> </td>
            <td><?php echo $no++;?></td>
			<td><?php echo $serviceDetail->service_name;?></td>
           
			
            <td class="functions">
			<a title="Edit" class="icon edit tip" href="<?php echo admin_url('categories/editCategory/'.$serviceDetail->service_id);?>"><img src="<?php echo image_url('edit-new.png'); ?>" alt="Edit" title="Edit" /></a>
			<a title="Delete" href="<?php echo admin_url('users/deleteUser/'.$serviceDetail->service_id);?>" onclick="return confirm('Are you sure want to delete??');"><img src="<?php echo image_url('delete-new.png'); ?>" alt="Delete" title="Delete" /></a> </td>
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
	<a name="delete" href="javascript: document.manageuserdetail.action='<?php echo admin_url('users/deleteUser'); ?>'; document.manageuserdetail.submit();" onclick="return confirm('Are you sure want to delete??');"><img src="<?php echo image_url('delete-new.png'); ?>" alt="Delete" title="Delete" /></a></div>
	

	   <!--PAGING-->
	  		<?php if(isset($pagination)) echo $pagination;?>
	 <!--END OF PAGING-->
	 </div>
	  </div></div></div></div></div></div></div></div></div></div>   
	  
	 
    </div>
  </div>
</div>
<?php $this->load->view('admin/footer'); ?>