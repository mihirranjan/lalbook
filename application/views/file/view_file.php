<?php $this->load->view('header'); ?>
<?php //$this->load->view('sidebar'); ?>
<!--MAIN-->
<div id="main">
      <!--POST JOB-->
      <?php $this->load->view('view_accountMenu');?>
      <div class="clsTabs clsInnerCommon clsInfoBox">
      
                            <div class="clsInnerCommon">
                              <h3><span class="clsDepositFunds"><?php echo $this->lang->line('Shared File Download');?></span></h3>
								<?php foreach($fileView->result() as $fileInfo)
									  { ?><p>
								<?php echo $this->lang->line('You are currently logged in as');?> <a href="#"><?php
									$user = getUserInformation($fileInfo->user_id);
									if(is_object($user)) 
									echo $user->user_name; ?>
									
									</a> <?php echo $this->lang->line('(');?><a href="<?php echo site_url('users/logout') ?>"><?php echo $this->lang->line('logout');?></a><?php echo $this->lang->line(').');?></p>
								<p>
								<table>
									<tr>
									<td><?php echo $this->lang->line('File Name:');?> </td> <td><b><?php echo $fileInfo->original_name ; ?></td>
									</tr>
									<tr>
									<td><?php echo $this->lang->line('Description:');?> </td> <td><b><?php echo $fileInfo->description; ?></td>
									</tr>
									<tr>
									<td><?php echo $this->lang->line('Size:');?> </td> <td><b><?php echo $fileInfo->file_size; ?><?php echo $this->lang->line('KB');?></td>
									</tr>
									<tr>
									<td><?php echo $this->lang->line('Posted by:');?> </td> <td><b><a href="#">
									<?php
									$user = getUserInformation($fileInfo->user_id);
									if(is_object($user)) 
									echo $user->user_name; ?>
									</tr>
									<tr>
									<td>
									  <a href="<?php echo site_url('?c=file&m=download&key='); ?><?php echo $fileInfo->key;?>" > <img src="<?php echo image_url("download.png"); ?>" height="100" width="100"></a>
									
									</td>
									</tr>
								</table>
								<? }?>
                         
        </div>
      </div>
    </div>
<!--END OF MAIN-->
<?php $this->load->view('footer'); ?>