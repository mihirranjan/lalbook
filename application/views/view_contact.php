<div class="Container">
<?php $this->load->view('header'); ?>

<style>
.main_br {
	margin-bottom:10px !important;
}
.clsContactForm  label{
	float:left;
	width:150px;
	display:block;
	text-align:left;
}
.clsContactForm p{
   clear: both;
    margin: 5px 0;
    overflow: hidden;
}
.clsContactForm{
	margin:20px 0;
}
.clsPoliicy textarea {
    background: none repeat scroll 0 0 #FFFFFF;
    border: 1px solid #ddd;
    margin: 0;
}
</style>
<!--<div id="selSearch">
    <p><label>Search Jobs</label>
	  <form id="search" name="search" method="get" action="<?php echo site_url('home/search'); ?>">
	  <input type="text" name="keyword"  onblur="placeholder='Search Products'" onfocus="placeholder=''" placeholder='Search Products' id="inputTextboxes" class="clsSertxt">
 <!--<input type="text" value="Search for product bids" class="clsSertxt">-->
 <!--<input type="submit" value="" class="clsGobut">
 </form></p>
    </div>-->
    
    <div id="selMain clearfix">
     <!-- RC -->
      <div class="main_t">
        <div class="main_r">
          <div class="main_b">
            <div class="main_l">
              <div class="main_tl">
                <div class="main_tr">
                  <div class="main_bl">
                    <div class="main_br">
                    
<div class="clsMinContent clearfix">
<?php //$this->load->view('sidebar'); ?>
<!--START MAIN-->
<div id="Innermain">
  <!--POST JOB-->
  <div class="clsContact">
    
                        <div class="clsPoliicy">
                          <h2><?php echo $this->lang->line('contacting'); ?> <?php echo $this->config->item('site_title'); ?></h2>
                          <div class="clsContactForm clSTextDec">
						 <p style="text-align:center;">
                              <b style=" display: block;float: left; padding-bottom:12px;text-align: left;width: auto;"><?php echo $this->lang->line('note');?> <a href="<?php echo site_url('users/login');?>"><?php //echo $this->lang->line('login here');?></a>.</b></p>
						   <p>
                              
                            <!--<h3><span class="clsCategory"><?php echo $this->lang->line('Contact');?></span></h3>-->
                              <form method="post" action="<?php echo site_url('contact')?>">
       							<p>
								  <label><?php echo $this->lang->line('your_email'); ?><span class="red">*</span></label>
								  <input  onblur="placeholder='Your Email'" onfocus="placeholder=''" placeholder='Your Email' class="clspostTxt" type="text" name="c_email" value="<?php echo set_value('c_email'); ?>" />
								 
								</p>
                                <p><label>&nbsp;</label> <?php echo form_error('c_email'); ?></p>
								<p>
								  <label><?php echo $this->lang->line('subject'); ?><span class="red">*</span> </label>
								  <input  onblur="placeholder='Subject'" onfocus="placeholder=''" placeholder='Subject' class="clspostTxt" type="text" name="c_subject" value="<?php echo set_value('c_subject'); ?>" />
								
								</p>
                                 <p><label>&nbsp;</label>  <?php echo form_error('c_subject'); ?></p>
								<p>
								  <label class="clsComments"><?php echo $this->lang->line('comments'); ?><span class="red">*</span></label>
								  <textarea  onblur="placeholder='Comments'" onfocus="placeholder=''" placeholder='Comments' name="c_comments" rows="10" cols="48"><?php echo set_value('c_comments'); ?></textarea>
								  				</p>
                                                <p><label>&nbsp;</label><?php echo form_error('c_comments'); ?></p>
								<p class="clsSubmitBlock">
								  <label>&nbsp;</label>
								  <input type="submit" value="<?php echo $this->lang->line('Submit');?>" name="postContact" class="clsCommonbut" />
								  <!--<input type="image" src="<?php echo image_url('bt_sbmitmsg.jpg');?>"/>-->
								</p>
							</form>
                           
                          </div>
                        </div>
                      </div>

  <!--END OF POST JOB-->
</div>
</div>
                                             </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                        
                            <!--end of RC -->

</div></div>
<!--END OF MAIN-->
  <?php $this->load->view('home_footer'); ?>