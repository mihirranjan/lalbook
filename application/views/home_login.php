<div class="clsLogin">
    <h3>Login</h3>
	<?php
							//Show Flash Message
							if($msg = $this->session->flashdata('flash_message'))
							{
								echo $msg;
							}?>
	<form action="<?php echo site_url('home/login'); ?>" method="post" name="">
    <p><input type="text" class="clsLogintxt" value="User Name" name="username"/></p>
	 <?php if(form_error('username')!='') echo '<p><label>&nbsp;</label><span class="clsError">'.form_error('username').'</span></p>'; ?>
    <p><input type="text" class="clsLogintxt" value="Password"  name="pwd" /></p>
	<?php if(form_error('pwd')!='') echo '<p><label>&nbsp;</label><span class="clsError">'.form_error('pwd').'</span></p>'; ?>
	<p><input type="checkbox" class="clsChk" value="" name="remember"/><?php echo $this->lang->line('remember me');?></p>
    <p><input type="submit"  class="clsCommonbut" value="<?php echo $this->lang->line('Login');?>" name="usersLogin"/></p>  
	</form>  
    </div>