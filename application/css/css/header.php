<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php if(isset($page_title)) echo $page_title; ?></title>
<meta name="keywords" content="<?php if(isset($meta_keywords))  echo $meta_keywords; ?>" />
<meta name="description" content="<?php if(isset($meta_description))  echo $meta_description;  ?>" />
<!--<link rel="stylesheet" type="text/css" href="css/common.css" />-->
<link href="<?php echo base_url(); ?>application/css/css/common.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>application/css/css/menus.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>application/css/css/icons.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>application/css/css/st.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>application/css/css/common1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url() ?>application/js/prototype.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>application/js/scriptaculous.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>application/js/script.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>application/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>application/js/jquery.watermarkinput.js"></script>
<style>
.clsDrop{
	float: right;
    left: -200px;
    position: relative;
    right: 0;
    top: 3px;
}
.clsSearch_icon{
	width:18px;
	padding:0;
	background:transparent;
	border:none;
	position:relative;
	float:right;
}
</style>
</head>
<body>
<div id="Container">
  <!--Header-->
  <div class="clearfix" id="header">
    <div class="clsFloatLeft" id="selLeftHeader">
      <div id="selLogo">
        <h1> <a href="<?php echo base_url(); ?>">Bidonn</a></h1>
      </div>
    </div>
    <div class="clsFloatRight" id="selRightHeader">
      <ul class="clearfix">
	  <?php if($loggedInUser){
	   echo $this->lang->line('Welcome').','; if(is_object($loggedInUser))  echo $loggedInUser->user_name."&nbsp;";?>
	   <a href="<?php echo site_url('users/logout'); ?>">Logout</a>
	   <?php  }else{?>
        <li><img src="<?php echo image_url();?>/fb_login.jpg" alt="" /></li>
        <li><a href="<?php echo site_url("owner/signup");?>">Sign Up</a></li>
        <li class="clsNoBorder"><a href="<?php echo site_url("users/login");?>">Login</a></li>
		<? }?>
      </ul>
    </div>
  </div>
  <!--Header-->
  <!--Menu-->
  <div id="selMenu">
    <div class="clsLeft_menu">
      <div class="clsRight_menu">
        <div class="clsCen_menu">
          <div class="clsDropdown">
            <!--<span class="clsDropArrow">&nbsp;</span>-->
            <!--<select class="clsSelect">
              <option>Search for Projects...</option>
              <option>php projects</option>
            </select>-->
			<form method="post" action="<?php echo site_url('home/search');?>" name="search">
			<span class="clsDrop">
			<input type="text" name="search" id="searchbox"/>
			<select name="type" id="id">
				<option value="Search Job">Search Job</option>
				<option value="Search Employee">Search Employee</option>
			</select>
			<input type="submit" name="" class="clsSearch_icon"/>
			</span>
			</form>
			
			
			
           </div>
		  <?php if(!isset($current_page))
				$current_page = ''; 
	      ?>
		  <?php if($current_page == 'home'){?>
		<ul class="clearfix">
			<li class='clsActive'><a href="<?php echo base_url(); ?>" class="current"><span><?php echo $this->lang->line('Home');?></span></a></li>
			<li><a href="<?php echo site_url('job/create'); ?>"><span><?php echo $this->lang->line('Post Job'); ?></span></a></li>
			<?php if($this->session->userdata('role')=='owner') {?>
			<li><a href="<?php echo site_url('account'); ?>"><span><?php echo $this->lang->line('Owners'); ?></span></a></li>
			<?php }
			else if($this->session->userdata('role')!='employee'){?>
			<li><a href="<?php echo site_url('owner/signup'); ?>"><span><?php echo $this->lang->line('Owners'); ?></span></a></li>
			<?php }?>
			<?php if($this->session->userdata('role')=='employee') {?>
			<li><a href="<?php echo site_url('account'); ?>"><span><?php echo $this->lang->line('Employees'); ?></span></a></li>
			<?php }
			else if ($this->session->userdata('role')!='owner') {?>
			<li><a href="<?php echo site_url('employee/signup'); ?>"><span><?php echo $this->lang->line('Employees'); ?></span></a></li>
			<?php } ?>

		  <li class='clsNoBorder'><a href="<?php echo site_url('?c=rss'); ?>"><span><?php echo $this->lang->line('Feeds'); ?></span></a></li>
		</ul>
		<?php } 
		elseif($current_page == 'owner'){
		?>
		<ul class="clearfix">
			<li><a href="<?php echo base_url(); ?>" ><span><?php echo $this->lang->line('Home');?></span></a></li>
			<li><a href="<?php echo site_url('job/create'); ?>"><span><?php echo $this->lang->line('Post Job'); ?></span></a></li>
			<?php if($this->session->userdata('role')=='owner') {?>
			<li class='clsActive'><a href="<?php echo site_url('account'); ?>" class="current"><span><?php echo $this->lang->line('Owners'); ?></span></a></li>
			<?php }
			else if($this->session->userdata('role')!='employee'){?>
			<li class='clsActive'><a href="<?php echo site_url('owner/signup'); ?>" class="current"><span><?php echo $this->lang->line('Owners'); ?></span></a></li>
			<?php }?>
			<?php if($this->session->userdata('role')=='employee') {?>
			<li><a href="<?php echo site_url('account'); ?>"><span><?php echo $this->lang->line('Employees'); ?></span></a></li>
			<?php }
			else if ($this->session->userdata('role')!='owner'){?>
			<li><a href="<?php echo site_url('employee/signup'); ?>"><span><?php echo $this->lang->line('Employees'); ?></span></a></li>
			<?php } ?>

		  <li class='clsNoBorder'><a href="<?php echo site_url('?c=rss'); ?>"><span><?php echo $this->lang->line('Feeds'); ?></span></a></li>
		</ul>
		<?php
		}
		elseif($current_page == 'employee'){
		?>
		<ul class="clearfix">
			<li><a href="<?php echo base_url(); ?>" ><span><?php echo $this->lang->line('Home');?></span></a></li>
			<li><a href="<?php echo site_url('job/create'); ?>"><span><?php echo $this->lang->line('Post Job'); ?></span></a></li>
			<?php if($this->session->userdata('role')=='owner') {?>
			<li><a href="<?php echo site_url('account'); ?>"><span><?php echo $this->lang->line('Owners'); ?></span></a></li>
			<?php }
			else if($this->session->userdata('role')!='employee'){?>
			<li><a href="<?php echo site_url('owner/signup'); ?>"><span><?php echo $this->lang->line('Owners'); ?></span></a></li>
			<?php }?>
			<?php if($this->session->userdata('role')=='employee') {?>
			<li class='clsActive'><a href="<?php echo site_url('account'); ?>" class="current"><span><?php echo $this->lang->line('Employees'); ?></span></a></li>
			<?php }
			else if ($this->session->userdata('role')!='owner'){?>
			<li class='clsActive'><a href="<?php echo site_url('employee/signup'); ?>" class="current"><span><?php echo $this->lang->line('Employees'); ?></span></a></li>
			<?php } ?>

		  <li class='clsNoBorder'><a href="<?php echo site_url('?c=rss'); ?>"><span><?php echo $this->lang->line('Feeds'); ?></span></a></li>
		</ul>
		<?php
		}
		elseif($current_page == 'rss'){
		?>
		<ul class="clearfix">
			<li><a href="<?php echo base_url(); ?>" ><span><?php echo $this->lang->line('Home');?></span></a></li>
			<li><a href="<?php echo site_url('job/create'); ?>"><span><?php echo $this->lang->line('Post Job'); ?></span></a></li>
			<?php if($this->session->userdata('role')=='owner') {?>
			<li><a href="<?php echo site_url('account'); ?>"><span><?php echo $this->lang->line('Owners'); ?></span></a></li>
			<?php }
			else if($this->session->userdata('role')!='employee'){?>
			<li><a href="<?php echo site_url('owner/signup'); ?>"><span><?php echo $this->lang->line('Owners'); ?></span></a></li>
			<?php }?>
			<?php if($this->session->userdata('role')=='employee') {?>
			<li><a href="<?php echo site_url('account'); ?>"><span><?php echo $this->lang->line('Employees'); ?></span></a></li>
			<?php }
			else if ($this->session->userdata('role')!='owner'){?>
			<li><a href="<?php echo site_url('employee/signup'); ?>"><span><?php echo $this->lang->line('Employees'); ?></span></a></li>
			<?php } ?>

		  <li class='clsActive clsNoBorder'><a href="<?php echo site_url('?c=rss'); ?>" class="current"><span><?php echo $this->lang->line('Feeds'); ?></span></a></li>
		</ul>
		<?php
		}
		elseif($current_page == 'post_job'){
		?>
		<ul class="clearfix">
			<li><a href="<?php echo base_url(); ?>" ><span><?php echo $this->lang->line('Home');?></span></a></li>
			<li class='clsActive'><a href="<?php echo site_url('job/create'); ?>" class="current"><span><?php echo $this->lang->line('Post Job'); ?></span></a></li>
			<?php if($this->session->userdata('role')=='owner') {?>
			<li><a href="<?php echo site_url('account'); ?>"><span><?php echo $this->lang->line('Owners'); ?></span></a></li>
			<?php }
			else if($this->session->userdata('role')!='employee'){?>
			<li><a href="<?php echo site_url('owner/signup'); ?>"><span><?php echo $this->lang->line('Owners'); ?></span></a></li>
			<?php }?>
			<?php if($this->session->userdata('role')=='employee') {?>
			<li><a href="<?php echo site_url('account'); ?>"><span><?php echo $this->lang->line('Employees'); ?></span></a></li>
			<?php }
			else if ($this->session->userdata('role')!='owner'){?>
			<li><a href="<?php echo site_url('employee/signup'); ?>"><span><?php echo $this->lang->line('Employees'); ?></span></a></li>
			<?php } ?>

		  <li class='clsNoBorder'><a href="<?php echo site_url('?c=rss'); ?>"><span><?php echo $this->lang->line('Feeds'); ?></span></a></li>
		</ul>
		<?php
		}
		else {
		?>
		<ul class="clearfix">
			<li><a href="<?php echo base_url(); ?>"><span><?php echo $this->lang->line('Home');?></span></a></li>
			<li><a href="<?php echo site_url('job/create'); ?>"><span><?php echo $this->lang->line('Post Job'); ?></span></a></li>
			<?php if($this->session->userdata('role')=='owner') {?>
			<li class='clsActive'><a href="<?php echo site_url('account'); ?>"><span><?php echo $this->lang->line('Owners'); ?></span></a></li>
			<?php }
			else if($this->session->userdata('role')!='employee'){?>
			<li><a href="<?php echo site_url('owner/signup'); ?>"><span><?php echo $this->lang->line('Owners'); ?></span></a></li>
			<?php }?>
			<?php if($this->session->userdata('role')=='employee') {?>
			<li class='clsActive'><a href="<?php echo site_url('account'); ?>"><span><?php echo $this->lang->line('Employees'); ?></span></a></li>
			<?php }
			else if ($this->session->userdata('role')!='owner'){?>
			<li><a href="<?php echo site_url('employee/signup'); ?>"><span><?php echo $this->lang->line('Employees'); ?></span></a></li>
			<?php } ?>

		  <li class='clsNoBorder'><a href="<?php echo site_url('?c=rss'); ?>"><span><?php echo $this->lang->line('Feeds'); ?></span></a></li>
		</ul>
		<?php
		}?>
        <!--  <ul class="clearfix">
            <li <?php if($current_page == 'home'){ echo "class='clsActive'";}?>><a href="<?php echo base_url(); ?>"><?php echo $this->lang->line('Home');?></a></li>
            <li <?php if($current_page == 'post_job'){ echo "class='clsActive'";}?>>
			   <a href="<?php echo site_url('job/create'); ?>"><?php echo $this->lang->line('Post Job'); ?></a>
			</li>
            <li <?php if($current_page == 'owner'){ echo "class='clsActive'";}?>>
			    <?php if($this->session->userdata('role')=='owner') {?>
			    <a href="<?php echo site_url('account'); ?>"><?php echo $this->lang->line('Owners'); ?></a>
				<?php }elseif($this->session->userdata('role')!='employee'){ ?>
				<a href="<?php echo site_url('owner/signup'); ?>"><?php echo $this->lang->line('Owners'); ?></a>
				<?php }?>
			</li>
            <li <?php if($current_page == 'employee'){ echo "class='clsActive'";}?>>
			    <?php if($this->session->userdata('role')=='employee') {?>
			    <a href="<?php echo site_url('account'); ?>"><?php echo $this->lang->line('Employees'); ?></a>
				<?php }else if ($this->session->userdata('role')!='owner'){?>
			    <a href="<?php echo site_url('employee/signup'); ?>"><?php echo $this->lang->line('Employees'); ?></a>
			<?php } ?>
			</li>
             <li <?php if($current_page == 'rss'){ echo "class='clsActive clsNoBorder'";}else{echo "class='clsNoBorder'";}?>><a href="<?php echo site_url('?c=rss'); ?>"><?php echo $this->lang->line('Feeds'); ?></a></li>
          </ul>-->
        </div>
      </div>
    </div>
  </div>
<script type="text/javascript">
$("select").change(function () {
   var name = $(this).attr("value");
   var a =$('#searchbox').val(); 
   if(a=='Search Job' || a=='Search Employee'){
  	$('#searchbox').val(name);
	}
});
jQuery(function($){
	$("#searchbox").Watermark("Search Job");
	$("#searchbox").Watermark("Search Employee");
});
 </script>
  <!--Menu-->
 <!-- <div class="clear">&nbsp;</div>-->