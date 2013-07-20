<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LalBook</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>application/css/css/common.css" /> 
<!--[if IE ]>
<link href="css/iefix.css" rel="stylesheet" type="text/css" />
<![endif]-->
</head>

<body>
<div class="Container">
	
	<?php $this->load->view('header'); ?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>application/js/jquery-1.7.min.js" /> 
	
   <?php
		$remember = $username = $pwd="";
		if($this->auth_model->getUserCookie('uname') !=""){
			$username = $this->auth_model->getUserCookie('uname');
			$remember = "checked";
		}else if($this->session->flashdata('set_user_name')!=""){
			$username = $this->session->flashdata('set_user_name');
		}
		
		if($this->auth_model->getUserCookie('pwd') !=""){
			$pwd = $this->auth_model->getUserCookie('pwd');
		}
		
		
		//echo "<pre>";print_r($this->session->userdata('uname'));
		//echo "<pre>";print_r($this->session->all_userdata());
		
		
		$this->input->cookie('test_cookie');
		//Show Flash Message
		$msg = "";
		if($msg = $this->session->flashdata('flash_message')){
			
		}
		
		$csstag = "display:none;margin-buttom:-100px;";
		$cssleft = "display:none;margin-left:-100px;";
		$cssright = "display:none;margin-right:-100px;";
		$css_pass = "";
		if($msg!="" || form_error('username')!='' || form_error('pwd')!='' || isset($_REQUEST['goto']) && $_REQUEST['goto'] == "login"){
			$csstag = "display:block;";
			$cssleft = "display:block;";
			$cssright = "display:block;";
			if(isset($_REQUEST['goto']) && $_REQUEST['goto'] == "login"){
				$css_pass= "";
			}else{
				$css_pass= "border:1px solid red;";
			}
			
			?>
				<script>
					login_error = 1;
				</script>
			<?php
		}
		
	?>
	
	
   
   <?php $this->load->view('home_search'); ?>
    <div class="clsReq clearfix">
		<div class="clsPostReq" style="<?php //echo $csstag;?>">
			<a href="<?php echo site_url('requirement/create'); ?>"  id="hoverClassName">&nbsp;</a>
		</div>
		<div class="banImg clearfix">
			<div class="clsLeftimg" style="<?php //echo $cssleft;?>">
				<a href="<?php echo site_url('requirement/create'); ?>">&nbsp;</a>
			</div>
			<div class="clsRightimg" style="<?php //echo $cssright;?>">
				<a href="<?php echo site_url('seller'); ?>" class="seller">&nbsp;</a>
			</div>
		</div>
    </div>
	<p style="text-align:center;width:1000px;padding:0 0 15px;margin:15px 0 0;"> <img src="<?php echo image_url();?>/line.png" alt="" /></p>
    
    <div class="clsMainContent clearfix">
		<div class="sidebar">
		
		<?php if(!$loggedInUser){?>
			<div class="clsLogin">
				<h3>Login</h3>
				<?php
					echo $msg;
				?>
				<form action="<?php echo site_url('home/login'); ?>" method="post" name="">
					<p><input type="text" class="clsLogintxt username" onblur="placeholder='User Name'" 
						onfocus="placeholder=''" placeholder='User Name' name="username" 
						value="<?php echo $username;?>"/>
					</p>
					<?php if(form_error('username')!='') echo '<p><label>&nbsp;</label><span class="clsError">'.form_error('username').'</span></p>'; ?>
				
					<p>
						<input 	type="password" class="clsLogintxt pwd"  onblur="placeholder='Password'" onfocus="placeholder=''" 
								value="<?php echo $pwd;?>" placeholder='Password' name="pwd" style="<?php echo $css_pass;?>"/></p>
					
					<?php if(form_error('pwd')!='') echo '<p><label>&nbsp;</label><span class="clsError">'.form_error('pwd').'</span></p>'; ?>
				
					<p><input <?php echo $remember ;?> id="remember" type="checkbox" class="clsChk" value="1" name="remember"/><?php echo $this->lang->line('remember me');?></p>
					<p><a href="<?php echo site_url('users/forgotPassword');?>">Forgot login Details?</a></p>
				
					<p><input type="submit"  onclick="return login_validate();" class="clsCommonbut" value="<?php echo $this->lang->line('Login');?>" name="usersLogin"/></p>  
				</form> 
				
				
			</div>
		<?php }?>
		<div class="clsAdver">
		<p><img src="<?php echo image_url();?>/sidebar_img.jpg" alt="" /></p>
		<p class="clsAlign"><a href="#">Click Here</a></p>
		</div>
		
		</div>
		<div id="main">
		<p><img src="<?php echo image_url();?>/hitwork.jpg" alt="" /></p>
		</div>
    
    </div>
    
</div>
    <script language="javascript" type="text/javascript">
	   function SwapPassword()
    {
	    var tfPassword = GetPageElement("PW");
	    var tfPasswordPlace = GetPageElement("PWP");

        tfPasswordPlace.style.display = "none";
        tfPassword.style.display = "";
        tfPassword.focus();
    }
    
    function SwapUsername()
    {
	    var tfUserName = GetPageElement("UN");
	    var tfUsernamePlace = GetPageElement("UNP");

        tfUsernamePlace.style.display = "none";
        tfUserName.style.display = "";
        tfUserName.focus();
    }     
    
    function SwapUsernamePlace()
    {
	    var tfUserName = GetPageElement("UN");
	    var tfUsernamePlace = GetPageElement("UNP");
	    
        if (tfUserName.value == '')
        {
            tfUsernamePlace.style.display = "";
            tfUserName.style.display = "none";
        }
    }
    
    function SwapPasswordPlace()
    {
	    var tfPassword = GetPageElement("PW");
	    var tfPasswordPlace = GetPageElement("PWP");

        if (tfPassword.value == '')
        {
            tfPasswordPlace.style.display = "";
            tfPassword.style.display = "none";
        }
    }    
	function GetPageElement(field){
		return document.getElementById(field);
	}
	  </script>
     <?php $this->load->view('home_footer'); ?>
</body>
</html>
