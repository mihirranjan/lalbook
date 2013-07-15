<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/sidebar'); ?>
<style type="text/css">
table.table td {
    font-size: 13px !important;
    padding: 0.3em 0.2em !important;
    text-align: left;
    text-transform: capitalize;
}
table.table th{
  padding: 0.5em 0.1em;
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
            <li><a href="<?php echo admin_url('users/addUsers');?>"><b><?php echo $this->lang->line('Add users'); ?></b></a></li>
			<li><a href="<?php echo admin_url('users/searchUsers');?>"><b><?php echo $this->lang->line('search_user'); ?></b></a></li>
			<li class="clsNoBorder"><a href="<?php echo admin_url('users/viewUsers');?>"><b><?php echo $this->lang->line('View users'); ?></b></a></li>
          </ul>
        </div>
		<div class="clsTitle">
          <h3><?php echo $this->lang->line('View users'); ?></h3>
        </div>
		
      </div>
	  
 
       <table width="100%" class="table">
        <thead>
		  <tr>


		  <th>&nbsp;</th>
           <!-- <th><?php echo $this->lang->line('Sl.No');?></th>-->
			<th width="10%"><?php echo 'User Nm';?></th>
            <th width="15%"><?Php echo $this->lang->line('Name/Company');?></th>
            <th width="20%"><?php echo $this->lang->line('Email');?></th>
			<th width="10%"><?php //echo $this->lang->line('User Type');?>proj posted</th>
			<th width="10%"><?php //echo $this->lang->line('Balance');?>Avai Credit</th>
			<th width="10%"><?php //echo $this->lang->line('Options');?>Ip Add</th>
			<th width="5%"><?php //echo $this->lang->line('Options');?>Regi on</th>
			<th width="10%"><?php //echo $this->lang->line('Options');?>User verifi</th>
			<th width="10%"><?php echo $this->lang->line('action'); ?></th>
          <!--  <th colspan="2"><span class="functions text-center" id="tip" style="opacity: 1;"> </span></th>-->
          </tr>
        </thead>
        <tbody>
		<?php 
		if(isset($usrrequirement))
		{
		//$bidcount=$usrrequirement->num_rows();
		/*foreach($usrrequirement->result() as $buyrequirementcount)
		{
		$bidcount=$buyrequirementcount->num_rows();
		}*/
		}
		$no=1;
		if(isset($userDetails) and $userDetails->num_rows()>0)
		{
		//print_r($userDetails);exit;
		foreach($userDetails->result() as $userDetail)
			{ //print_r($userDetail);exit;
			/*if(isset($usrrequirement))
		{
		//$bidcount=$usrrequirement->num_rows();
		$usrid=$userDetail->user_id;
		$condition = array('users.id' => $usrid);
		$registeron=$userDetail->created;
		$registerdate=date('d-m-Y',$registeron);
		$getuserbids=$this->user_model->getUserbids($condition);
		$bidcount=$getuserbids->num_rows();
		foreach($getuserbids->result() as $buyrequirementcount)
		{
		//print_r($buyrequirementcount);
		}
			}*/
			 $usd=$userDetail->user_id;
$q = "SELECT COUNT(id) AS count FROM buy_requirement WHERE creator_id = $usd";
$query = $this->db->query($q,array($userDetail->user_id));
       $ncomments = $query->result_array();
			$blog_e->n_comments = $ncomments[0]['count'];
	//$blog_e->n_comments1 = $ncomments[0]['totid'];
?>
		
		<form name="manageuserdetail" action="" method="post"> 
          <tr>
		    <td><input type="checkbox" class="clsNoborder" name="userlist[]" id="userlist[]" value="<?php echo $userDetail->user_id; ?>"  /> </td>
            <!--<td><?php echo $no++;?></td>-->
			<td><?php echo $userDetail->user_name;?></td>
            <td><?php echo $userDetail->organisation;?></td>
			<td><?php echo $userDetail->email;?></td>
			<td><?php if($blog_e->n_comments!=0){ echo $blog_e->n_comments; }else { echo "No Projects";} ?></td>
			<td><?php echo $userDetail->credit;?></td>
			<td><?php echo $userDetail->ip_addrs."<br/>&nbsp;".$userDetail->ip_city;?></td>
			<td><?php echo date('d-m-Y', strtotime($userDetail->created));?> </td>
			<td><?php $uservefiy=$userDetail->user_verify; if($uservefiy==0){ echo "Not Verified"; }else{ echo "Verified";} //echo $userDetail->amount;//print_r($userDetail); ?></td>
            <td class="functions">
			<a title="Edit" class="icon edit tip" href="<?php echo admin_url('users/editUser/'.$userDetail->user_id);?>"><img src="<?php echo image_url('edit-new.png'); ?>" alt="Edit" title="Edit" /></a>
			<a title="Delete" href="<?php echo admin_url('users/deleteUser/'.$userDetail->user_id);?>" onclick="return confirm('Are you sure want to delete??');"><img src="<?php echo image_url('delete-new.png'); ?>" alt="Delete" title="Delete" /></a> </td>
          </tr>
		  <?php } 
		  }
		  else{ ?>
		   <tr>
            <td colspan="5"><?php echo $this->lang->line('No users found');?></td></tr>
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