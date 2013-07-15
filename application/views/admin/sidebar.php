<style type="text/css">

/*Credits: Dynamic Drive CSS Library */
/*URL: http://www.dynamicdrive.com/style/ */

.suckerdiv li span{
	padding-right:10px;
	/*background:url(images/adminlist_icon.jpg) no-repeat right;*/
}

.suckerdiv{
/*padding:3.8em 1.5em 0 0;*/
width:189px;
border:1px solid #efefef;
border-left:0;
position:relative;
left:-2px;
top:15px;
right:0;
}
.suckerdiv ul{
margin: 0;
padding: 0;
list-style-type: none;
width: 189px; /* Width of Menu Items */
/*border-bottom: 1px solid #ccc;*/
text-align:left;
}
.suckerdiv ul li{
position: relative;
border-bottom: 1px solid #EFEFEF;
/*margin-bottom:3px;*/
}
/*Sub level menu items */
.suckerdiv ul li ul{
position: absolute;
width: 189px; /*sub menu width*/
top: 0;
visibility: hidden;
left:-189px !important;
}

/* Sub level menu links style */
.suckerdiv ul li a{
	background:url(<?php echo image_url('sidebarli_bg.jpg');?>) repeat-x;
	width:189px;
	height:33px;
	line-height:33px !important;
	display: block;
	overflow: auto; /*force hasLayout in IE7 */
	color: black;
	text-decoration: none;
/*	padding: 0px 0 0 10px;*/
	/*background:#ccc;border: 1px solid #999;*/
	border-bottom: 0;
	/*text-transform:uppercase;*/
	color:#555;
	text-align:right;
	font:14px Arial, Helvetica, sans-serif;
}
.suckerdiv ul li:visited{
	background:#fff!important;

}
.suckerdiv ul li a.linksActive{
color: #c00000;
}
.suckerdiv ul li a:visited{
/*color: #c00000;*/
}

.suckerdiv ul li a:hover{
/*	background:url(http://localhost/mavenbids/application/css/images/adminli_hoverbg.png) no-repeat;
	width:165px;
	height:31px;
	line-height:31px;
	display: block;*/
/*background-color: #000;*/
color:#c00000;
}

.suckerdiv .subfolderstyle{
/*background: url(<?php echo image_url('arrow-list.gif');?>) no-repeat center right;
background-color:#ccc;*/
background:url(<?php echo image_url('sidebarli_bg.jpg');?>) repeat-x;
width:189px;
height:33px;
line-height:33px!important;
display: block;
}

	
/* Holly Hack for IE \*/
* html .suckerdiv ul li { float: left; height: 1%; }
* html .suckerdiv ul li a { height: 1%; }
/* End */

</style>
<script type="text/javascript">

//SuckerTree Vertical Menu 1.1 (Nov 8th, 06)
//By Dynamic Drive: http://www.dynamicdrive.com/style/

var menuids=["suckertree1"] //Enter id(s) of SuckerTree UL menus, separated by commas

function buildsubmenus(){
for (var i=0; i<menuids.length; i++){
  var ultags=document.getElementById(menuids[i]).getElementsByTagName("ul")
    for (var t=0; t<ultags.length; t++){
    ultags[t].parentNode.getElementsByTagName("a")[0].className="subfolderstyle"
		if (ultags[t].parentNode.parentNode.id==menuids[i]) //if this is a first level submenu
			ultags[t].style.left=ultags[t].parentNode.offsetWidth+"px" //dynamically position first level submenus to be width of main menu item
		else //else if this is a sub level submenu (ul)
		  ultags[t].style.left=ultags[t-1].getElementsByTagName("a")[0].offsetWidth+"px" //position menu to the right of menu item that activated it
    ultags[t].parentNode.onmouseover=function(){
    this.getElementsByTagName("ul")[0].style.display="block"
    }
    ultags[t].parentNode.onmouseout=function(){
    this.getElementsByTagName("ul")[0].style.display="none"
    }
    }
		for (var t=ultags.length-1; t>-1; t--){ //loop through all sub menus again, and use "display:none" to hide menus (to prevent possible page scrollbars
		ultags[t].style.visibility="visible"
		ultags[t].style.display="none"
		}
  }
}

if (window.addEventListener)
window.addEventListener("load", buildsubmenus, false)
else if (window.attachEvent)
window.attachEvent("onload", buildsubmenus)

</script>
<div id="sideBar">
  <div class="sideBar1 clsFloatRight">
      <div class="suckerdiv">
        <ul id="suckertree1">
		
		<?php  $url =  $this->uri->segment(2,0);?>
          <li><a href="<?php echo admin_url('home');?>" <?php if($url=='home') echo 'class="linksActive"';?>><span><?php echo $this->lang->line('Dash Board'); ?></span></a></li>
          <li><a href="<?php echo admin_url('siteSettings');?>" <?php if($url=='siteSettings') echo 'class="linksActive"';?>><span><?php echo $this->lang->line('website_settings'); ?></span></a></li>
          <!--<li><a href="<?php echo admin_url('paymentSettings');?>" <?php if($url=='paymentSettings') echo 'class="linksActive"';?>><span><?php echo $this->lang->line('payment_settings'); ?></span></a></li>-->
          <li><a href="<?php echo admin_url('emailSettings');?>" <?php if($url=='emailSettings') echo 'class="linksActive"';?>><span><?php echo $this->lang->line('Email Settings'); ?></span></a></li>
		  
		  <!--<li><a href="#" <?php //if($url=='payments') echo 'class="linksActive"';?>><span class="clsblue_arrow1"><?php echo $this->lang->line('Payments'); ?></span></a>
            <ul>
              <li><a href="#"><span><?php echo $this->lang->line('Transaction'); ?></span></a>
                <ul>
                  <li><a href="<?php echo admin_url('payments/addTransaction');?>" ><span><?php echo $this->lang->line('Add Transaction'); ?></span></a></li>
                  <li><a href="<?php echo admin_url('payments/searchTransaction');?>"><span><?php echo $this->lang->line('Search'); ?></span></a></li>
                  <li><a href="<?php echo admin_url('payments/viewTransaction');?>"><span><?php echo $this->lang->line('View All'); ?></span></a></li>
                </ul>
              </li>
			<li><a href="#"><span><?php echo $this->lang->line('Withdrawal Queue'); ?></span></a>
			    <ul>
                  <li><a href="<?php echo admin_url('payments/releaseWithdraw');?>"><span><?php echo $this->lang->line('Release Withdraw'); ?></span></a></li>
                  <li><a href="<?php echo admin_url('payments/viewWithdraw');?>"><span><?php echo $this->lang->line('View All'); ?></span></a></li>
                 </ul>
			  </li>
			  
              <li><a href="#"><span><?php echo $this->lang->line('Escrow Transaction'); ?></span></a>
                <ul>
                  <li><a href="<?php echo admin_url('payments/releaseEscrow');?>"><span><?php echo $this->lang->line('Escrow Release'); ?></span></a></li>
                  <li><a href="<?php echo admin_url('payments/viewEscrow');?>"><span><?php echo $this->lang->line('View All'); ?></span></a></li>
                </ul>
				</li>
			</ul>	
          </li>-->
           <li><a href="#" <?php //if($url=='users') echo 'class="linksActive"';?>><span class="clsblue_arrow2"><?php echo $this->lang->line('Manage Users'); ?></span></span></a>
            <ul>
				<li><a href="#"><span><?php echo $this->lang->line('Users'); ?></span></a>
                <ul>
				<li><a href="<?php echo admin_url('users/searchUsers');?>"><span><?php echo $this->lang->line('search_user'); ?></span></a></li>
                  <li><a href="<?php echo admin_url('users/addUsers');?>"><span><?php echo $this->lang->line('Add users'); ?></span></a></li>
                  <li><a href="<?php echo admin_url('users/viewUsers');?>"><span><?php echo $this->lang->line('View users'); ?></span></a></li>
                  
                </ul>
				</li>
             <!-- <li><a href="#"><span><?php echo $this->lang->line('Bans'); ?></span></a>
                <ul>
                  <li><a href="<?php echo admin_url('users/addBans');?>"><span><?php echo $this->lang->line('Add bans'); ?></span></a></li>
                  <li><a href="<?php echo admin_url('users/editBans');?>"><span><?php echo $this->lang->line('Edit bans'); ?></span></a></li>
                </ul>
              </li>-->
              
			   <!-- <li><a href="#"><span><?php echo $this->lang->line('Suspend'); ?></span></a>
			  	<ul>
					<li><a href="<?php echo admin_url('users/addSuspend'); ?>"><span><?php echo $this->lang->line('Add Suspend'); ?></span></a></li>  
					<li><a href="<?php echo admin_url('users/editSuspend'); ?>"><span><?php echo $this->lang->line('Edit Suspend'); ?></span></a></li>     
		 		</ul>
			  </li>-->
            </ul>
          </li>
		  <!--<li><a href="#" <?php //if($url=='packages') echo 'class="linksActive"';?>><span class="clsblue_arrow3"><?php echo $this->lang->line('Manage Packages'); ?></span></a>
            <ul>
              <li><a href="#"><span><?php echo $this->lang->line('Packages'); ?></span></a>-->
                <!--<ul>
                  <li><a href="<?php echo admin_url('packages/addPackages');?>" ><span><?php echo $this->lang->line('Add Package'); ?></span></a></li>
                  <!--<li><a href="<?php echo admin_url('packages/searchPackage');?>"><?php echo $this->lang->line('Search'); ?></a></li>-->
                  <!--<li><a href="<?php echo admin_url('packages/viewpackage');?>"><span><?php echo $this->lang->line('View All'); ?></span></a></li>
                </ul>
              </li>-->
              <!--<li><a href="<?php echo admin_url('packages/viewsubscriptionuser');?>"><span><?php echo $this->lang->line('Subscription Users'); ?></span></a>
			  <ul>
                  <li><a href="<?php echo admin_url('packages/viewsubscriptionuser');?>" ><span><?php echo $this->lang->line('View subscription user'); ?></span></a></li>
                  <li><a href="<?php echo admin_url('packages/searchsubscriptionuser');?>"><span><?php echo $this->lang->line('Search Subscription user'); ?></span></a></li>
                </ul>
				</li>-->
              <!--<li><a href="<?php echo admin_url('packages/viewsubscriptionpayment');?>"><span><?php echo $this->lang->line('Subscription payment'); ?></span></a>
			  <ul>
			   <li><a href="<?php echo admin_url('packages/viewsubscriptionpayment');?>"><span><?php echo $this->lang->line('View subscription Payment'); ?></span></a></li>
                  <li><a href="<?php echo admin_url('packages/searchsubscriptionpayment');?>"><span><?php echo $this->lang->line('Search Subscription Payment'); ?></span></a></li>
				  </ul>
			  </li>--> 
			<!--</ul>	
          </li>-->
		  
		  <?php  $url_one = $this->uri->segment(3,0); ?>
		   <li><a href="<?php echo admin_url('postrequirement');?>" <?php if($url=='postrequirement') echo 'class="linksActive"';?>><span><?php echo 'Post Requirement'; ?></span></a></li>
		  <li><a href="<?php echo admin_url('users/viewAdmin');?>" <?php if($url_one=='viewAdmin' && $url_one!='') echo 'class="linksActive"';?> ><span><?php echo $this->lang->line('View Admin'); ?></span></a></li>
         <!-- <li><a href="<?php echo admin_url('skills/viewGroups');?>" <?php if($url_one=='viewGroups' && $url_one!='') echo 'class="linksActive"';?>><span><?php echo $this->lang->line('groups'); ?></span></a></li>-->
          <li><a href="<?php echo admin_url('categories/viewCategories');?>" <?php if($url_one=='viewCategories' && $url_one!='') echo 'class="linksActive"';?>><span><?php echo $this->lang->line('categories'); ?></span></a>
		 <!-- <ul>
		  <li><a href="<?php echo admin_url('categories/viewCategories');?>"><span>Products</span></a></li>
		  <li><a href="<?php echo admin_url('categories/viewServices');?>"><span>Services</span></a></li>
		  </ul>-->
		  </li>
          <li><a href="<?php echo admin_url('skills/viewBids');?>" <?php if($url_one=='viewBids' && $url_one!='') echo 'class="linksActive"';?>><span><?php echo $this->lang->line('Bids'); ?></span></a></li>
         <!-- <li><a href="<?php echo admin_url('skills/viewJobs');?>" <?php if($url_one=='viewJobs' && $url_one!='') echo 'class="linksActive"';?>><span><?php echo $this->lang->line('Jobs'); ?></span></a></li>-->
		 <!-- <li><a href="<?php echo admin_url('support/viewSupport');?>" <?php if($url=='support') echo 'class="linksActive"';?>><span><?php echo $this->lang->line('support'); ?></span></a></li>-->
		  <li><a href="<?php echo admin_url('jobCases/viewCases');?>" <?php if($url=='jobCases') echo 'class="linksActive"';?>><span><?php echo $this->lang->line('dispute'); ?></span></a></li>
          <!--<li><a href="<?php echo admin_url('faq/viewFaqs');?>" <?php if($url=='faq') echo 'class="linksActive"';?>><span><?php echo $this->lang->line('faqs'); ?></span></a></li>-->
          <li><a href="<?php echo admin_url('page/viewPages');?>" <?php if($url=='page') echo 'class="linksActive"';?>><span><?php echo $this->lang->line('Manage Static pages'); ?></span></a></li>
         </ul>
      </div> 
  </div>
</div>