<title><?php if(isset($page_title)) echo $page_title; ?></title>
<meta name="keywords" content="<?php if(isset($meta_keywords))  echo $meta_keywords; ?>" />
<meta name="description" content="<?php if(isset($meta_description))  echo $meta_description;  ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>application/css/css/common.css" /> 
<link href="<?php echo base_url(); ?>application/css/css/menus.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>application/css/css/icons.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>application/css/css/st.css" rel="stylesheet" type="text/css" />


<link rel="stylesheet" href="<?php echo base_url() ?>application/theme/development-bundle/themes/blitzer/jquery-ui.css" />
<script src="<?php echo base_url() ?>application/theme/js/jquery-1.9.1.js"></script>
<script src="<?php echo base_url() ?>application/theme/js/jquery-1.9.1.js"></script>
<script src="<?php echo base_url() ?>application/theme/js/jquery-ui-1.10.3.custom.js"></script>



<script type="text/javascript" src="<?php echo base_url() ?>application/js/script.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>application/js/jquery.watermarkinput.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>application/js/scriptpopup.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url();?>application/css/css/popupstyle.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url();?>application/css/css/jsDatePick_ltr.min.css" />
<script type="text/javascript" src='<?php echo base_url();?>application/js/ajaxpopform.js'></script>
<script type="text/javascript" src='<?php echo base_url();?>application/js/jquery.datepick.js'></script>

<link href="<?php echo base_url(); ?>application/css/css/ajaxpopform.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>application/css/lalbook.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/css/global.css" />
<!--DatePicker-->
<script type="text/javascript">
	var webroot = "<?php echo base_url();?>";
	var login_error = 0;
	var from_other_pageto_login = 0;
</script>
<body>



<div id="header">
	<div id="selLeftHeader" class="clsFloatLeft">
		<div id="selLogo">
		<h1>  <a href="<?php echo base_url();?>">Site name</a> </h1>
		</div>
		
		
			<?php if($loggedInUser){
				
				//Message
				$usr=$loggedInUser->id;
				$querry = "SELECT SUM(notification_status) as count from message where to_id=$usr";
				$querys = $this->db->query($querry,array($loggedInUser->id));
				$ncomments = $querys->result_array();
				$blog_e->n_comments = $ncomments[0]['count'];
				
				//Notification
				$keywords1='awarded';
				$keywords2='closed';

				$querys1="SELECT SUM(notification_status) as state from buy_requirement where creator_id=$usr or awarded_user=$usr";
				$queryss = $this->db->query($querys1,array($loggedInUser->id));
				$ncommentss_notification = $queryss->result_array();

				$blog_e->status = $ncommentss_notification[0]['state'];
				
				if(!($blog_e->n_comments>0 && $blog_e->status!='' && $blog_e->status!='0')){
					
				}else{
					?>
					<div <?php if($loggedInUser){ ?>class="clsCount" <?php } else {?>class="" <?php } ?> >
					<ul class="clearfix">
						<li>
							<?php if($blog_e->n_comments>0){?>
								<span>
								<?php if($blog_e->n_comments>0){
									echo $blog_e->n_comments;
								}else { 
									echo "";
								}?>
								</span>
							<?php } ?>
						</li> 
						
						<li>
							<?php if($blog_e->status!='' && $blog_e->status!='0'){?>
							<span><?php if($blog_e->status!='' && $blog_e->status!='0'){
									//print_r($count1);
									echo $blog_e->status;
								}else { 
									echo "";
								}?>
							</span><?php } ?>
							
						</li>
					</ul>
					</div>					
				<?php 
			}
				
			} 
		?>
	</div>
	  
	<?php
	$home_class = $account_class = $seller_class = $buyer_class = $about_class = $contact_class ="";
	$url_data = $_SERVER['REQUEST_URI'];
	$home = 1;
	$brdcm = "";
	if (false !== strpos($url_data,'about') ) {
		$about_class = "active";
	}else if (false !== strpos($url_data,'account') ) {
		$account_class = "active";
	}else if (false !== strpos($url_data,'seller') ) {
		$seller_class = "active";
	}else if (false !== strpos($url_data,'create') ) {
		$buyer_class = "active";
	}else if (false !== strpos($url_data,'contact') ) {
		$contact_class = "active";
	}else if($_SERVER['REQUEST_URI'] == '/lalbook/') {
		$home = 0;
		$home_class = "active";
	} else{
		echo "";
	} 

	
	?>
	

	<div id="selRightHeader" class="clsFloatRight">
		<div class="clsMenu">
			<ul class="clearfix">
<!-- Commented by pramod to restrict display of Home Tab Post Login-->
			<!--<li <?php if ( $_SERVER['REQUEST_URI'] == '/lalbook/' ){ ?> class="clsActive" <?php } ?>>
					<a href="<?php echo base_url(); ?>">
					<span class="<?php echo $home_class?>"><?php //echo $this->lang->line('About Us'); ?>Home</span></a>
 				</li> -->
			<?php if(!($loggedInUser)){ ?>
				<li <?php if ( $_SERVER['REQUEST_URI'] == '/lalbook/' ){ ?> class="clsActive" <?php } ?> >
				<a href="<?php echo base_url(); ?>" >
				<span class="<?php echo $home_class?>" >Home</span></a></li>
			<?php } ?>
			
			<?php if(!($loggedInUser)){ ?>
				<li <?php if ( $_SERVER['REQUEST_URI'] == '/lalbook/index.php/page/about' ){ ?> class="clsActive" <?php } ?> >
				<a href="<?php echo site_url('page/about'); ?>" >
				<span class="<?php echo $about_class?>" ><?php echo $this->lang->line('About Us'); ?></span></a></li>
			<?php } ?>
			
			<?php if($loggedInUser){
				if(is_object($loggedInUser)){ ?>
					<li <?php if ( $_SERVER['REQUEST_URI'] == '/lalbook/index.php/account' ){ ?> class="clsActive" <?php } ?>>
					<a href="<?php echo site_url('account'); ?>">
					<span class="<?php echo $account_class?>" ><?php //echo $this->lang->line('About Us'); ?>My Lalbook</span></a></li>
			<?php } 
			}?>
			
			<li <?php if ( ($_SERVER['REQUEST_URI'] == '/lalbook/index.php/seller') || ($_SERVER['REQUEST_URI'] == '/lalbook/index.php/seller/index') )
				{ ?> class="clsActive" <?php } ?>>
					<a href="<?php echo site_url('seller'); ?>">
					<span class="<?php echo $seller_class?>" >Seller</span></a></li>
			
			<li <?php if ( $_SERVER['REQUEST_URI'] == '/lalbook/index.php/requirement/create' ){ ?> class="clsActive" <?php } ?>>
				<a href="<?php  echo site_url('requirement/create'); ?>">
				<span class="<?php echo $buyer_class?>">Buyer</span></a></li>

			
			<?php if(!($loggedInUser)) {?>
				<li  <?php if(!($loggedInUser)){
					?> <?php  if ( $_SERVER['REQUEST_URI'] == '/lalbook/index.php/contact' ){ ?> class="clsActive clsNoBorder" <?php }  
					}?>>
				<a href="<?php echo site_url('contact'); ?>">
				<span class="<?php echo $contact_class?>" >Contact us</span></a>
				</li>
			<?php } ?>
			
			
			<?php if($loggedInUser){?>
				<li><a href="<?php echo site_url('users/logout'); ?>" >Logout</a></li>
				<?php  echo "<li class='clsNoBorder' style='width: auto;background: none repeat scroll 0 0 #FCFCFC;border: 1px solid rgba(0, 0, 0, 0.2); border-radius: 7px 7px 7px 7px;
							box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.12) inset;  margin: 0 0 0 15px;'>"; 
				if(is_object($loggedInUser)){ 
				if(!isEmployee())
				{
				echo "<span style='margin-left: 15px;position: relative;right: 0;top: 14px;'>".$this->lang->line('Welcome')."</span>".'<a  style="float: right;color:#C10100;font-weight:bold;margin:0;" href="'.site_url('account').'" >'.$loggedInUser->user_name.'</a>';
				}else{
				echo "<span style='margin-left: 15px;position: relative;right: 0;top: 14px;'>".$this->lang->line('Welcome')."</span>".'<a style="float: right;color:#C10100;font-weight:bold;margin:0;"  href="'.site_url('employee/viewProfile/'.$loggedInUser->id).'">'.$loggedInUser->user_name.'</a>';
				}} echo "</li>";
				?>


				<?php  
			}else{?>
				
				<?php if ( $_SERVER['REQUEST_URI'] == '/lalbook/' ){ ?>
					<li class="clsNoBorder"><a style="cursor:pointer;" id="goto_login_form" >Login</a></li>
				<?php }else{?>
					
					<li class="clsNoBorder"><a href="<?php echo base_url(); ?>?goto=login" style="cursor:pointer;" id="goto_login_form" >Login</a></li>
				<?php }?>
				
				<li class="clsNoBorder">
					<a   class="popup-button clsBut" style='color: #3571A3;
					float: right;font-weight: bold;'>Sign Up</a></li>

				<?php 
			}?>
			<!-- <li class="clsNoBorder"><a href="<?php echo site_url('owner/signup'); ?>"><span><?php echo $this->lang->line('Owners'); ?></span></a></li>-->
			</ul>
		</div>

	</div>
	<div style="clear:both;"></div>
	</div>
	
	 <?php 	  
		$querryys = "SELECT * from page where id=24";
		//$res = $this->db->query($query);
		$tems = $this->db->query($querryys);
		 $conditions = $tems->result_array();
		 $terms->conditions = $conditions[0]['content'];
	 ?>
	
	<div class="ajax_loader">
		<img src="<?php echo image_url();?>ajax-loader.gif" />
	</div>
	
	
	<!-- SIGNUP FORM -->
	<form method="post"  id="ajaxpopform" class="ui-widget-content ajaxpopform" style="display:none;" action="">  
		<div class='ajaxpopformwrapper'>
		<div class="ajaxpopforminner">
		<h2>Signup  <a class="button cancel"><span class="inner"><img src="<?php echo image_url();?>close.png" /></span></a></h2>

		<fieldset>
		<label for="help-us-fulname">Full Name&nbsp;<span class="mandatory_label">*</span>:</label>
		<div class="field">
		<input 	class="border_class" id="fulname" onblur="placeholder='Fullname'" onfocus="placeholder=''" placeholder='Fullname' 
				type="text" name="fulname" id="help-us-fulname" value="" /></div>
		</fieldset>
		<fieldset>
		<label for="help-us-email">Your email address&nbsp;<span class="mandatory_label">*</span>:</label>
		<div class="field">
		<input 	class="border_class" id="email" onblur="placeholder='Email Address'" onfocus="placeholder=''" placeholder='Email Address' 
				type="text" name="email" id="help-us-email" value="" /></div>
		</fieldset>
		<fieldset>
		<label for="help-us-username">Public Username&nbsp;<span class="mandatory_label">*</span>:</label>
		<div class="field">
		<input 	class="border_class" id="username" onblur="placeholder='Username'" onfocus="placeholder=''" placeholder='Username' 
				type="text" name="username" id="help-us-username" value="" /></div>
		</fieldset>
		<fieldset>
		<label for="help-us-message">Goals in signing up for LalBook&nbsp;<span class="mandatory_label">*</span>:</label>
		<div class="field">
		<textarea class="border_class" onblur="placeholder='Goals'" onfocus="placeholder=''" placeholder='Goals' 
			id="message" name="message" cols="10" rows="2"></textarea>
		</div>
		</fieldset>
		<fieldset>
		<label for="help-us-password">Password&nbsp;<span class="mandatory_label">*</span>:</label>
		<div class="field">
			<input 	class="border_class" onblur="placeholder='Password'" onfocus="placeholder=''" placeholder='Password' 
					type="password" name="password" id="password" value="" /></div>
		</fieldset>
		<fieldset>
		<label for="help-us-cpassword">Confirm Password&nbsp;<span class="mandatory_label">*</span>:</label>
		<div class="field">
			<input class="border_class" onblur="placeholder='Confirm Password'" onfocus="placeholder=''" placeholder='Confirm Password' type="password" 
				name="cpassword" id="cpassword"  value="" /></div>
		</fieldset>
		<fieldset>
		<!--    <label for="help-us-email"> </label>-->

		<input type="hidden" name="terms" id="example_text" value="<?php echo $terms->conditions;?>" />
		<table>
		<tr>
			<td class="terms border_class">
				<input type="checkbox" name="terms"  id="help-us-terms" value="1" />
			</td>
			<td>
				Please accept <a href="#" onclick="example_popup()" style="color:#C10001;">Terms of Service*</a>
			</td>
		</tr>
		</table>
		<span id="terms"></span> 
		</fieldset>

		</div>
		<div class="buttons">
		<div class="submit-button">
		<input type="submit" style="cursor:pointer;" class="button form-submit-button clsBut" name="signup" value="Submit"/>
		</div>

		</div>
		</div>    
		<!-- Toggle and show this on success -->
		<div style="display:none" id="ajaxpopform-success">
		<div class="inner">
		<h2>Thank you to Signup in Lalbook</h2>
		<h4>Please check confirmation link To Register in Lalbook</h4>
		</div>
		<div class="buttons">
		<p style="  left: -120px;position: relative; right: 0; text-align: center;"> 
		<a class="button cancel" id="cancel"><span class="">
		<img src="<?php echo image_url();?>closeButton.png" /></span>
		</a></p>
		</div>
		</div>
	</form>
	
	
	