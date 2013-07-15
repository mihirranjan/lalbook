<?php $this->load->view('header'); ?>
<div class="clsMinContent clearfix">
<?php //$this->load->view('sidebar'); ?>
<!--MAIN-->
<?php
		//Get Work Info
     	$faq = $faqs->row();
?>
<div id="main" style="margin:0 !important;border:1px solid #ccc!important;">
	  <!--POST WORK-->
      <div class="clsContact">
        
                            <div class="clsInnerCommon">
                              <h2><?php echo $this->lang->line('title'); ?></h2>
							  

							  <!--FAQ ANSWER-->
							  <div>
							  <p style="color:#039CE2;font-weight:bold;padding-left:1em!important;"><?php echo $faq->question ?></p>
							  <p style="padding:0 0 0 1em !important;"><?php echo $faq->answer ?>.</p>
							<!--  <p><b>Related Topics:</b></p>-->
							<!-- <ul>
									<li><a href="#">Owners</a></li>		
									<li><a href="#">Employees</a></li>
								 </ul>-->
							  </div>
							  <!--END OF FAQ ANSWER-->
							</div>
							</div>

        </div>
      </div>
      <!--END OF POST WORK-->
<!--END OF MAIN-->
   </div>
      </div>
<?php $this->load->view('footer'); ?>
