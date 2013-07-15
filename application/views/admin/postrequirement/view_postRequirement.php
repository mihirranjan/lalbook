<?php $this->load->view('admin/header');?>

<?php $this->load->view('admin/sidebar');?>

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
            <li class="clsNoBorder"><a href="<?php echo admin_url('skills/addGroup')?>"><?php echo $this->lang->line('create_new_group'); ?></a></li>
          </ul>
        </div>
		   <div class="clsTitle">
          <h3><?php echo 'View Post Requirements'; ?></h3>
        </div>
      </div>
	     <table class="table" cellpadding="2" cellspacing="0" width="100%">
		 <th width="5%"></th>
       <!-- <th><?php echo 'Sl.No'; ?></th>-->
        <th width="5%"><?php echo 'Req Id'; ?></th>
		<th width="10%"><?php echo 'title'; ?></th>
		<th width="20%"><?php echo 'Descr'; ?></th>
		<th width="5%"><?php echo 'NOBids'; ?></th>
		<th width="10%"><?php echo 'Buyer Name'; ?></th>
        <th width="8%"><?php echo 'S-Date'; ?></th>
		<th width="8%"><?php echo 'E-Date'; ?></th>
		<th width="15%"><?php echo 'Buyer Id'; ?></th>
		<th width="5%"><?php echo 'Status'; ?></th>
		<th width="9%"><?php echo 'Action'; ?></th>
    
	  <?php
			if(isset($postRequirement) and $postRequirement->num_rows()>0)
			{
				foreach($postRequirement->result() as $postReq)
				{
	?>
	 <form action="" name="manageReq" method="post" >
      <tr>
	   <td><input type="checkbox" class="clsNoborder" name="reqlist[]" id="reqlist[]" value="<?php echo $postReq->id; ?>"  /> </td>
        <td><?php echo $postReq->id; ?></td>
        <td><?php echo $postReq->looking_for; ?></td>
		  <td><?php echo $postReq->description; ?></td>
		    <td><?php echo 'empty'; ?></td>
			  <td><?php $userid = $postReq->creator_id;
			            $condition = array('users.id'=>$userid);
			            $usersResult = $this->admin_model->getUsers($condition);
						$usersInfo = $usersResult->row();
						//echo $usersResult->num_rows();
			             if($usersResult->num_rows()>0){echo $usersInfo->user_name; }?></td>
			     <td><?php echo date('Y-m-d',$postReq->created); ?></td>
				  <td><?php echo $postReq->end_date; ?></td>
				    <td><?php if($usersResult->num_rows()>0){echo $usersInfo->email; }?></td>
				    <td><?php echo $postReq->creator_id; ?></td>
					
					
    
		<td><a href="<?php echo admin_url('postrequirement/edit/'.$postReq->id)?>"><img src="<?php echo image_url('edit-new.png'); ?>" alt="Edit" title="Edit" /></a>
		<a href="<?php echo admin_url('postrequirement/delete/'.$postReq->id)?>" onclick="return confirm('Are you sure want to delete??');"><img src="<?php echo image_url('delete-new.png'); ?>" alt="Delete" title="Delete" /></a>
		</td>
      </tr>
	<?php
			}//Foreach End
		}//If End
		else
		{
		echo '<tr><td colspan="5">'.'No Buy Requirements Found'.'</td></tr>'; 
		}
	?>
	</table>
	</form>
	 <div class="clscenter clearfix">
	  <div id="selLeftAlign">
	<?php echo $this->lang->line('With Selected'); ?>
	<a name="delete" href="javascript: document.manageReq.action='<?php echo admin_url('postrequirement/delete'); ?>'; document.manageReq.submit();" onclick="return confirm('Are you sure want to delete??');"><img src="<?php echo image_url('delete-new.png'); ?>" alt="Delete" title="Delete" /></a></div>
    </div>
	</div>
	 <!--PAGING-->
	  	<?php if(isset($pagination)) echo $pagination;?>
	 <!--END OF PAGING-->
      <!-- End clsTable-->
</div></div></div></div></div></div></div></div></div></div>
    </div>
    <!-- End clsMainSettings -->
  </div>
</div>

<?php $this->load->view('admin/footer');?>
