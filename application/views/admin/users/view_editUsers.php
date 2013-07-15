<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/sidebar'); ?>

<style>
.clsSubmitBt1{
  margin: 0 7px 0;
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
                      
	
	 <div class="clsTop clsClearFixSub">
          <div class="clsNav">
        </div>
		<div class="clsTitle">
          <h3><?php echo $this->lang->line('edit_user'); ?></h3>
        </div>
      </div>
		     <?php
			//Show Flash Message
			if($msg = $this->session->flashdata('flash_message'))
			{
				echo $msg;
			}
			$userDetails = $userDetails->row();
			if(is_object($userDetails)){
			//print_r($userDetails);exit;
	  	?>
    
   
      <form method="post" action="">
       <table class="table1" cellpadding="0" cellspacing="2" border="0">
          <tr>
            <td width="25%"><?php echo $this->lang->line('Username');?> </td>
            <td width="55%">:
			<input name="username" type="text" class="textbox" id="username" value="<?php echo $userDetails->user_name; ?>">
			<?php echo form_error('username'); ?>
		    </td>
          </tr>
          <!--<tr>
            <td width="25%"><span id="valuen"><?php echo $this->lang->line('Password');?></span></td>
            <td width="55%">
                <div id="show1" <?php if(form_error('password')){?> style="display:block"<?php }?> style="display:none">
						: <input name="password" type="password" class="textbox" id="password" value="<?php echo $this->input->post('password');?>"  >&nbsp;
						<input name="passwordold" type="hidden" class="textbox" value="<?php echo $userDetails->password;?>" >
						<?php //echo form_error('password'); ?>
						<a href="#" onclick="return cancel();" >cancel</a>
						</div>
						<div id="change" >
						: <a href="#" onclick="return passwordchange();" >change password</a>
                    </div>

				<?php //echo form_error('password'); ?>
				
				</td>
				<?php //echo form_error('value'); ?>
          </tr>-->
		  
		  <tr>
            <td width="25%">Company Name: </td>
            <td width="55%">:
			<input name="companyname" type="text" class="textbox" id="username" value="<?php echo $userDetails->organisation; ?>">
			<?php echo form_error('companyname'); ?>
		    </td>
          </tr>
		  
		  
		  <tr>
            <td width="25%">Tin Number: </td>
            <td width="55%">:
			<input name="tinnumber" type="text" class="textbox" id="username" value="<?php echo $userDetails->tin_number; ?>">
			<?php echo form_error('tinnumber'); ?>
		    </td>
          </tr>
		  
		  <tr>
            <td width="25%">Pan Number: </td>
            <td width="55%">:
			<input name="pannumber" type="text" class="textbox" id="username" value="<?php echo $userDetails->pan_number; ?>">
			<?php echo form_error('pannumber'); ?>
		    </td>
          </tr>
		   <tr>
            <td width="25%">Business Name: </td>
            <td width="55%">:
			<input name="busname" type="text" class="textbox" id="username" value="<?php echo $userDetails->business_name; ?>">
			<?php echo form_error('busname'); ?>
		    </td>
          </tr>
		   <tr>
            <td width="25%">Business Type: </td>
            <td width="55%">:<?php $btype=$userDetails->business_type;?>
			 <select name="bstype" class="textbox" style="width:45.5%;">
                  <option value="1" <?php if($userDetails->business_type == 1) echo "selected"; ?>>Product</option>
				  <option value="2" <?php if($userDetails->business_type == 2) echo "selected"; ?>>Services</option>
				  <option value="3" <?php if($userDetails->business_type == 3) echo "selected"; ?>>Both</option>
                </select>
			<!--<input name="bstype" type="text" class="textbox" id="username" value="<?php $userDetails->business_type; ?>">-->
			<?php echo form_error('bstype'); ?>
		    </td>
          </tr>
		  
		  <!--<tr>
            <td width="25%"><?php echo $this->lang->line('User Type');?></td>
            <td width="55%">:
                <select name="type" class="textbox" style="width:45.5%;">
                  <option value="1" <?php if($userDetails->role_id == 1) echo "selected"; ?>>Owner</option>
				  <option value="2" <?php if($userDetails->role_id == 2) echo "selected"; ?>>Employee</option>
                </select></td>
          </tr>-->
		  <tr>
            <td width="25%"><span id="valuen"><?php echo $this->lang->line('Email');?></span></td>
            <td width="55%">:
                <input name="email" type="text" class="textbox" id="email" value="<?php echo $userDetails->email; ?>">
				<?php echo form_error('email'); ?>
				</td>
          </tr>
		 <!-- <tr>
            <td width="25%"><span id="valuen"><?php echo $this->lang->line('Name/Company');?></span></td>
            <td width="55%">:
                <input name="name" type="text" class="textbox" id="name" value="<?php echo $userDetails->name; ?>">
				<?php echo form_error('name'); ?>
				</td>
          </tr>
		    <tr>
            <td width="25%"><span id="valuen"><?php echo $this->lang->line('Balance Amount');?></span></td>
            <td width="55%">:
                <input name="balamount" type="text" class="textbox" id="balamount" value="<?php echo $userDetails->amount; ?>">
				<?php echo form_error('balamount'); ?>
				</td>
				<!-- <td height="30" id="bannosubmit" style="display:none;"><input name="editUser1" id="editUser1" type="submit" class="clsSubmitBt1" value="Submit" />
                 <input type="hidden" name="userid" value="<?php echo $userDetails->id;?>" /></td>
-->
        <!--  </tr>-->
		
		<tr>
            <td width="25%">Set Verify: </td>
            <td width="55%">:<?php $verify=$userDetails->user_verify;?>
			 <select name="verify" class="textbox" style="width:45.5%;">
                  <option value="1" <?php if($userDetails->user_verify == 1) echo "selected"; ?>>Verified</option>
				  <option value="0" <?php if($userDetails->user_verify == 0) echo "selected"; ?>>Not Verified</option>
				 
                </select>
			<!--<input name="bstype" type="text" class="textbox" id="username" value="<?php $userDetails->business_type; ?>">-->
			<?php echo form_error('bstype'); ?>
		    </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr id="bansubmit" >
            <td></td>
            <td height="30" style="padding-left:6px;"><input name="editUser" type="submit" class="clsSubmitBt1" value="<?php echo $this->lang->line('Submit');?>">
			<input type="hidden" name="userid" value="<?php echo $userDetails->id;?>" />
			
			   <a href="#" onclick="history.go(-1);return false;"><input type="button" value="Back"  class="clsSubmitBt1"></a> 
            </td>
		<script type="text/javascript">
			function passwordchange()
			{
			document.getElementById('show1').style.display='block';
			document.getElementById('change').style.display='none';
			
			}
			function cancel()
			{
			document.getElementById('change').style.display='block';
			document.getElementById('show1').style.display='none';
			
			}
		</script>
          </tr>
        </table>
      </form>
	  <?php } ?>
	  
	 </div></div></div></div></div></div></div></div> </div></div>     
	  
	  
    </div>
  </div>
</div>
<?php $this->load->view('admin/footer'); ?>

