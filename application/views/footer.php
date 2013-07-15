 </div>

<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.tipsy.js"></script>
  <script type="text/javascript">
    jQuery(function ($) {
      $("*[rel=tipsy]").tipsy();
      $("*[rel=hovercard]").tipsyHoverCard();
    });
  </script> 
 <!-- Sel Footer-->  
<div id="selFooter">
<div id="selBottomFooter">
<!--<div class="clsTopArrow">
<span style="background:#98B54E; border-radius: 0 7px 7px 0; left: 990px; margin: 0; padding: 4px 3px 4px 0; position: absolute; right: 0;
    top: 135px;width: 25px;"><a  rel="tipsy" original-title="Top" href="#top" title="Move To Top"><img  height="24" width="24" src="<?php echo image_url();?>/arrow_up1.png" alt=""/></a></span>
</div>-->
<div class="clsFooter clearfix">
<ul class="clearfix">
<li>
<div class="clsFooter1">
<ul>
<li><h4>Navigate</h4></li>
<li><a href="<?php echo base_url(); ?>">Home</a></li>
<li><a href="<?php echo site_url('job/create'); ?>">Post Job</a></li>
<li> <?php if($this->session->userdata('role')=='owner') {?>
		<a href="<?php echo site_url('account'); ?>"><?php echo $this->lang->line('Owners'); ?></a>
		<?php }elseif($this->session->userdata('role')!='employee'){ ?>
		<a href="<?php echo site_url('owner/signup'); ?>"><?php echo $this->lang->line('Owners'); ?></a>
		<?php }?>
	
</li>
<li><?php if($this->session->userdata('role')=='employee') {?>
		<a href="<?php echo site_url('account'); ?>"><?php echo $this->lang->line('Employees'); ?></a>
		<?php }else if ($this->session->userdata('role')!='owner'){?>
		<a href="<?php echo site_url('employee/signup'); ?>"><?php echo $this->lang->line('Employees'); ?></a>
		<?php } ?>
</li>
<li>&nbsp;</li>

</ul>
    
</div>
</li>
<li>
<div class="clsFooter2">
<ul>
<li><h4>Take Action</h4></li>
<li><a href="<?php echo site_url('job/create'); ?>">Post Job</a></li>
<?php if(!$this->loggedInUser){?>
<li><a href="<?php echo site_url("users/login");?>"> Sign in</a></li>
<li><a href="<?php echo site_url("owner/signup");?>">Register</a></li>
<?php } ?>
<li><a href="<?php echo site_url("search");?>"> Search for Jobs</a></li>
<li><a href="<?php echo site_url("faq");?>">Ask a Question</a></li>
</ul>
    
</div>
</li>
<li>
<div class="clsFooter3">
<ul>
<li><h4>Resources</h4></li>
<li><a href="<?php echo site_url("page/about");?>">About Bidonn</a></li>
<li><a href="<?php echo site_url("faq");?>"> Help</a></li>
<li><a href="<?php echo site_url('?c=rss'); ?>">Feeds</a></li>
<li>&nbsp;</li>
<li>&nbsp;</li>
</ul>
    
</div>
</li>
<li>
<div class="clsFooter4">
<ul>
<li><h4>Necessities</h4></li>
<li><a href="<?php echo site_url("page/privacy");?>">Privacy Policy</a></li>
<li><a href="<?php echo site_url("page/condition");?>">Terms of Use</a></li>
<li>&nbsp;</li>
<li>&nbsp;</li>
<li>&nbsp;</li>
</ul>
    
</div>
</li>

</ul>

<div class="clsFooter5">
<input type="button" class="clsFoot_but" value="" onclick="location.href='<?php echo site_url("job/create");?>'"/>

<div class="clsSocialBlock">
<label>We are Social</label>
	<?php 
	     $facebook      = $this->db->get_where('settings', array('code' => 'FACEBOOK'))->row()->string_value;
	     $twitter       = $this->db->get_where('settings', array('code' => 'TWITTER'))->row()->string_value;
	     $rss           = $this->db->get_where('settings', array('code' => 'RSS'))->row()->string_value;
	     $linkedin      = $this->db->get_where('settings', array('code' => 'LINKEDIN'))->row()->string_value;
		?>
	<a class="fb" href="<?php if(isset($facebook))echo $facebook;else echo '#';?>" target="_blank">FB</a>
	<a class="twt" href="<?php if(isset($twitter))echo $twitter;else echo '#';?>" target="_blank">Twitter</a>
	<a class="skype" href="<?php if(isset($rss))echo $rss;else echo '#';?>" target="_blank">Skype</a>
	<a class="in" href="<?php if(isset($linkedin))echo $linkedin;else echo '#';?>" target="_blank">Linkedin</a>

</div>
</div>

</div>
<div class="clsLicense">
<p>&copy;&nbsp;Copyright 2012 - 2015,<a href="http://www.maventricks.com" target="_blank">MavenTricks Technologies</a> | All Rights Reserved. </p>

<p><a href="http://www.gnu.org/licenses/gpl-3.0.html"><img src="<?php echo image_url();?>gplv.png" alt="" /></a></p>
<p>This software is licensed under the <a href="http://www.gnu.org/licenses/gpl-3.0.html">CC-GNU GPL</a> version 3.0.</p>
</div>
</div>
</div>
<!-- Sel Footer-->    
</div>

</body>
</html>