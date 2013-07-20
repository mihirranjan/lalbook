<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if(isset($page_title)) echo $page_title; ?></title>
<meta name="keywords" content="<?php if(isset($meta_keywords))  echo $meta_keywords; ?>" />
<meta name="description" content="<?php if(isset($meta_description))  echo $meta_description;  ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>application/css/css/common.css" /> 
<link href="<?php echo base_url(); ?>application/css/css/menus.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>application/css/css/icons.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>application/css/css/st.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>application/css/css/common1.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url();?>application/css/css/popupstyle.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url();?>application/css/css/jsDatePick_ltr.min.css" />
<link href="<?php echo base_url(); ?>application/css/css/ajaxpopform.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>application/css/lalbook.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="<?php echo base_url();?>application/css/css/jquery.datepick.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/css/global.css" />
<link rel="stylesheet" href="<?php echo base_url();?>application/css/validationEngine.jquery.css" type="text/css"/>
<link rel="stylesheet" href="<?php echo base_url();?>application/css/profile.css" type="text/css"/>
<link href="<?php echo base_url(); ?>application/css/css/bidpopup.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/application/css/css/msgpop.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/application/css/css/msgtobidder.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/application/css/css/ratingpop.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/application/css/css/buyerpop.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/application/css/css/sllerpop.css" />
<link href="<?php echo base_url(); ?>application/css/lalbook.css" rel="stylesheet" type="text/css" />
<!--[if IE ]>
<link href="css/iefix.css" rel="stylesheet" type="text/css" />
<![endif]-->

<script type="text/javascript">
    var webroot = "<?php echo base_url();?>";
</script>

<script src="<?php echo base_url();?>application/js/jquery-1.9.1.js"></script>
<script src="<?php echo base_url();?>application/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>application/js/script.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>application/js/ajaxtabs.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>application/js/jquery.watermarkinput.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>application/js/scriptpopup.js"></script>
<script type="text/javascript" src='<?php echo base_url();?>application/js/ajaxpopform.js'></script>
<script type="text/javascript" src="<?php echo base_url();?>application/js/jquery.datepick.js"></script>
<script src="<?php echo base_url();?>application/js/main.js"></script>
<script src="<?php echo base_url();?>application/js/jquery.betterTooltip.js"></script>
<script src="<?php echo base_url();?>application/js/dw_event.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>application/js/dw_contentswap.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url();?>application/js/reCopy.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>application/js/jquery.form.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/application/js/ratingpop.js" /></script>
<script type="text/javascript" src="<?php echo base_url();?>/application/js/sellerrating.js" /></script>
<script type="text/javascript" src='<?php echo base_url();?>application/js/fornotlogin.js'></script>

<script type="text/javascript" src="<?php echo base_url();?>application/js/profile.js"></script>
<script type="text/javascript" src='<?php echo base_url();?>application/js/lalbook.js'></script>
</head>

<body>
<div class="hcon">
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
 </div>