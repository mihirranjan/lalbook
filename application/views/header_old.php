<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if(isset($page_title)) echo $page_title; ?></title>
<meta name="keywords" content="<?php if(isset($meta_keywords))  echo $meta_keywords; ?>" />
<meta name="description" content="<?php if(isset($meta_description))  echo $meta_description;  ?>" />
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

<script type="text/javascript" src="<?php echo base_url();?>application/js/jsDatePick.min.1.3.js"></script>

<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url();?>application/css/css/jsDatePick_ltr.min.css" />
<script type="text/javascript" src="<?php echo base_url();?>application/js/jquery.1.4.2.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>application/js/jsDatePick.jquery.min.1.3.js"></script>
<!--DatePicker-->
<script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"inputField",
			dateFormat:"%d-%M-%Y"
			/*selectedDate:{				This is an example of what the full configuration offers.
				day:5,						For full documentation about these settings please see the full version of the code.
				month:9,
				year:2006
			},
			yearsRange:[1978,2020],
			limitToToday:false,
			cellColorScheme:"beige",
			dateFormat:"%m-%d-%Y",
			imgPath:"img/",
			weekStartDay:1*/
		});
		
	};
</script>

<!--DatePicker-->
<!--TextBox-->
<script type="text/javascript">
function watermarks(inputId,text){
  var inputBox = document.getElementById(inputId);
    if (inputBox.value.length > 0){
      if (inputBox.value == text)
        inputBox.value = '';
    }
    else
      inputBox.value = text;
}
</script> 
<!--TextBox-->

</head>
<body>
  
  <!--Header-->
  <div class="clearfix" id="header">
    <div class="clsFloatLeft" id="selLeftHeader">
      <div id="selLogo">
        <h1> <a href="<?php echo base_url(); ?>">Bidonn</a></h1>
      </div>
    </div>
     <div class="clsFloatRight" id="selRightHeader">
     <div id="selMenu" class="clearfix">
        
		  
		   <div class="clsTopmenu">
		   
		  <?php if(!isset($current_page))
				$current_page = ''; 
	      ?>
		  <?php //if($current_page == 'home'){?>
	<!--	<ul class="clearfix">
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
			//else if ($this->session->userdata('role')!='owner') {?>
			<!--<li><a href="<?php echo site_url('employee/signup'); ?>"><span><?php echo $this->lang->line('Employees'); ?></span></a></li>-->
			<?php //} ?>

		 <!-- <li class=''><a href="<?php echo site_url('?c=rss'); ?>"><span><?php echo $this->lang->line('Feeds'); ?></span></a></li>
		    <li class=''><a href="<?php echo site_url('faq'); ?>"><span><?php echo $this->lang->line('Faq'); ?></span></a></li>
			  <li class='clsNoBorder'><a href="<?php echo site_url('page/about'); ?>"><span><?php echo $this->lang->line('About Us'); ?></span></a></li>
		</ul>-->
		<?php // } 
		//elseif($current_page == 'owner'){
		?>
		<!--<ul class="clearfix">
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
			//else if ($this->session->userdata('role')!='owner'){?>
			<!--<li><a href="<?php echo site_url('employee/signup'); ?>"><span><?php echo $this->lang->line('Employees'); ?></span></a></li>-->
			<?php //} ?>

		  <!--<li class=''><a href="<?php echo site_url('?c=rss'); ?>"><span><?php echo $this->lang->line('Feeds'); ?></span></a></li>
		  <li class=''><a href="<?php echo site_url('faq'); ?>"><span><?php echo $this->lang->line('Faq'); ?></span></a></li>
		  <li class='clsNoBorder'><a href="<?php echo site_url('page/about'); ?>"><span><?php echo $this->lang->line('About Us'); ?></span></a></li>
		</ul>-->
		<?php
		//}
		//elseif($current_page == 'employee'){
		?>
		<!--<ul class="clearfix">
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
			//else if ($this->session->userdata('role')!='owner'){?>
			<!--<li class='clsActive'><a href="<?php echo site_url('employee/signup'); ?>" class="current"><span><?php echo $this->lang->line('Employees'); ?></span></a></li>-->
			<?php //} ?>

		 <!-- <li class=''><a href="<?php echo site_url('?c=rss'); ?>"><span><?php echo $this->lang->line('Feeds'); ?></span></a></li>
		  <li class=''><a href="<?php echo site_url('faq'); ?>"><span><?php echo $this->lang->line('Faq'); ?></span></a></li>
			  <li class='clsNoBorder'><a href="<?php echo site_url('page/about'); ?>"><span><?php echo $this->lang->line('About Us'); ?></span></a></li>
		</ul>-->
		<?php
		//}
		//elseif($current_page == 'rss'){
		?>
		<!--<ul class="clearfix">
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
			//else if ($this->session->userdata('role')!='owner'){?>
			<!--<li><a href="<?php echo site_url('employee/signup'); ?>"><span><?php echo $this->lang->line('Employees'); ?></span></a></li>-->
			<?php //} ?>
           <!-- <li class='clsActive '><a href="<?php echo site_url('?c=rss'); ?>" class="current"><span><?php echo $this->lang->line('Feeds'); ?></span></a></li>
		    <li class=''><a href="<?php echo site_url('faq'); ?>"><span><?php echo $this->lang->line('Faq'); ?></span></a></li>
			  <li class='clsNoBorder'><a href="<?php echo site_url('page/about'); ?>"><span><?php echo $this->lang->line('About Us'); ?></span></a></li>
		</ul>-->
		<?php
		//}
		//elseif($current_page == 'faq'){
		?>
		<!--<ul class="clearfix">
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
			//else if ($this->session->userdata('role')!='owner'){?>
			<!--<li><a href="<?php echo site_url('employee/signup'); ?>"><span><?php echo $this->lang->line('Employees'); ?></span></a></li>-->
			<?php //} ?>
           <!-- <li><a href="<?php echo site_url('?c=rss'); ?>"><span><?php echo $this->lang->line('Feeds'); ?></span></a></li>
		    <li class='clsActive'><a href="<?php echo site_url('faq'); ?>" class="current"><span><?php echo $this->lang->line('Faq'); ?></span></a></li>
			 <li class='clsNoBorder'><a href="<?php echo site_url('page/about'); ?>"><span><?php echo $this->lang->line('About Us'); ?></span></a></li>
		</ul>-->
		<?php
		//}
		//elseif($current_page == 'page'){
		?>
	<!--	<ul class="clearfix">
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
			//else if ($this->session->userdata('role')!='owner'){?>
			<!--<li><a href="<?php echo site_url('employee/signup'); ?>"><span><?php echo $this->lang->line('Employees'); ?></span></a></li>-->
			<?php //} ?>
           <!-- <li><a href="<?php echo site_url('?c=rss'); ?>"><span><?php echo $this->lang->line('Feeds'); ?></span></a></li>
		    <li><a href="<?php echo site_url('faq'); ?>"><span><?php echo $this->lang->line('Faq'); ?></span></a></li>
			 <li class='clsActive clsNoBorder'><a href="<?php echo site_url('page/about'); ?>" class="current"><span><?php echo $this->lang->line('About Us'); ?></span></a></li>
		</ul>-->
		<?php
		//}
		//elseif($current_page == 'post_job'){
		?>
		<ul class="clearfix">
			<li><a href="<?php echo base_url(); ?>" ><span><?php echo $this->lang->line('Home');?></span></a></li>
			<li class='clsActive'><a href="<?php echo site_url('requirement/create'); ?>" class="current"><span><?php echo $this->lang->line('Post Requirement'); ?></span></a></li>
			<?php if($this->session->userdata('role')=='owner') {?>
			<li><a href="<?php echo site_url('account'); ?>"><span><?php echo $this->lang->line('user'); ?></span></a></li>
			<?php }
			else if($this->session->userdata('role')!='employee'){?>
			<li><a href="<?php echo site_url('owner/signup'); ?>"><span><?php echo $this->lang->line('Owners'); ?></span></a></li>
			<?php }?>
			<?php if($this->session->userdata('role')=='employee') {?>
			<li><a href="<?php echo site_url('account'); ?>"><span><?php echo $this->lang->line('Employees'); ?></span></a></li>
			<?php }
			//else if ($this->session->userdata('role')!='owner'){?>
			<!--<li><a href="<?php echo site_url('employee/signup'); ?>"><span><?php echo $this->lang->line('Employees'); ?></span></a></li>-->
			<?php //} ?>

		  <li class=''><a href="<?php echo site_url('?c=rss'); ?>"><span><?php echo $this->lang->line('Feeds'); ?></span></a></li>
		  <li class=''><a href="<?php echo site_url('faq'); ?>"><span><?php echo $this->lang->line('Faq'); ?></span></a></li>
		  <li class='clsNoBorder'><a href="<?php echo site_url('page/about'); ?>"><span><?php echo $this->lang->line('About Us'); ?></span></a></li>
		</ul>
		<?php
		//}
		//else {
		?>
		<!--<ul class="clearfix">
			<li><a href="<?php echo base_url(); ?>"><span><?php echo $this->lang->line('Home');?></span></a></li>
			<li><a href="<?php echo site_url('job/create'); ?>"><span><?php echo $this->lang->line('Post Job'); ?></span></a></li>
			<?php if($this->session->userdata('role')=='owner') {?>
			<li class='clsActive'><a href="<?php echo site_url('account'); ?>" ><span><?php echo $this->lang->line('Owners'); ?></span></a></li>
			<?php }
			else if($this->session->userdata('role')!='employee'){?>
			<li><a href="<?php echo site_url('owner/signup'); ?>"  ><span><?php echo $this->lang->line('Owners'); ?></span></a></li>
			<?php }?>
			<?php if($this->session->userdata('role')=='employee') {?>
			<li class='clsActive'><a href="<?php echo site_url('account'); ?>"  ><span><?php echo $this->lang->line('Employees'); ?></span></a></li>
			<?php }
			//else if ($this->session->userdata('role')!='owner'){?>
			<!--<li><a href="<?php echo site_url('employee/signup'); ?>" ><span><?php echo $this->lang->line('Employees'); ?></span></a></li>-->
			<?php //} ?>

		<!--  <li class=''><a href="<?php echo site_url('?c=rss'); ?>"><span><?php echo $this->lang->line('Feeds'); ?></span></a></li>
		  <li class=''><a href="<?php echo site_url('faq'); ?>"><span><?php echo $this->lang->line('Faq'); ?></span></a></li>
			  <li class='clsNoBorder'><a href="<?php echo site_url('page/about'); ?>"><span><?php echo $this->lang->line('About Us'); ?></span></a></li>
		</ul>-->
		<?php
		//}?>
       
 		  </div>
		  
        </div>
	 <div class="clsTop clearfix">
	 <div class="clsSearch">
	  <form action="<?php echo site_url('search/index');?>" method="get" name="search" id="search">
        <p><input id="inputTextboxes" type="text" value="Search Job" onfocus="watermarks('inputTextboxes','Search Job');" onblur="watermarks('inputTextboxes','Search Job');" name="keyword" />
		<input type="hidden" name="type" value="Search Job"/>
		<input type="hidden" name="category"/>
          <!--<input type="text" class="clsText" value="" />-->
          <img src="<?php echo image_url('s_icon.png');?>" alt="" id="sear" /></p>
		  <input type="submit" value="" class="clsSearch_icon"/>
		  </form>
      </div>
	 
	 <!--<div class="clsDropdown">
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
            </div>-->
	 <!--<div class="Topicons">
	 <ul class="clearfix">
	  <li><a href="#"><img src="<?php echo image_url();?>/f_icon.png" alt=""  width="20" height="20" /></a></li>
	  <li><a href="#"><img src="<?php echo image_url();?>/t_icon.png" alt="" width="20" height="20"/></a></li>
	  <li><a href="#"><img src="<?php echo image_url();?>/rss_icon.jpg" alt="" width="20" height="20"/></a></li>
	   <li><a href="#"><img src="<?php echo image_url();?>/linked_icon.png" alt="" width="20" height="20" /></a></li>
	 </ul>
	 </div>-->
      <ul class="clearfix">
	  <?php if($loggedInUser){
	   echo $this->lang->line('Welcome').','; 
	   if(is_object($loggedInUser)){ 
	    if(!isEmployee())
		{
	      echo '<a style="font-weight:bold;color:#DD472C;" href="'.site_url('owner/viewProfile/'.$loggedInUser->id).'">'.$loggedInUser->user_name.'</a>';
		}else{
		  echo '<a style="font-weight:bold;color:#DD472C;" href="'.site_url('employee/viewProfile/'.$loggedInUser->id).'">'.$loggedInUser->user_name.'</a>';
		}}
		?>
	  
	   <a href="<?php echo site_url('users/logout'); ?>">Logout</a>
	   <?php  }else{?>
	   
       <!-- <li><a href="#"><img src="<?php echo image_url();?>/fb_login.jpg" alt="" /></a></li>-->
        <li><a href="<?php echo site_url("owner/signup");?>">Sign Up</a></li>
        <li class="clsNoBorder"><a href="<?php echo site_url("users/login");?>">Login</a></li>
		<?php }?>
      </ul>
    </div>
	
		</div>
 </div>
  <!--Header-->
     <div id="selpost_block" style="height:15px;">

</div> 
  <!--Menu-->
 <div id="Container">

  <div class="clsCon clearfix"> 
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
<script type="text/javascript">
   
	$(document).ready(function() {

		$('a[href=#top]').click(function(){
	
			$('html, body').animate({scrollTop:0}, 'slow');
	
			return false;
	
		});

	});

     </script>
