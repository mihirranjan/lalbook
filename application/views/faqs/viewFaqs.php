<?php $this->load->view('header'); ?>
<div class="clsMinContent clearfix">
<?php //$this->load->view('sidebar'); ?>
<!--MAIN-->
<div id="Innermain">
	  <!-- RC -->
    <div class="block">
      <div class="main_t">
        <div class="main_r">
          <div class="main_b">
            <div class="main_l">
              <div class="main_tl">
                <div class="main_tr">
                  <div class="main_bl">
                    <div class="main_br">
                      <div class="cls100_p">   
      <!--POST WORK-->
         <div class="clsContact">
 
                            <div class="clsInnerCommon clsSitelinks">
                              <h2><?php echo $this->lang->line('title'); ?></h2>
 							  
							   <h3><span class="clsCategory"><?php echo $this->lang->line('sub_title'); ?></span></h3>
							   <div class="clsOptionalDetails">
								<ul>
								 <?php
									if(isset($frequentFaqs) and $frequentFaqs->num_rows()>0)
									{
										foreach($frequentFaqs->result() as $frequentFaq)
										{
								  ?>		
										<li class="clSNoBack"><a href="<?php echo site_url('faq/view/'.$frequentFaq->id); ?>"><?php echo $frequentFaq->question; ?></a></li>
								   <?php
										 }//Foreach End
									}//If End
								   ?>
								</ul>
							  </div>
 							<div class="clsContactForm clSTextDec">
							<h3><span class="clsInvoice"><?php echo $this->lang->line('Guest Sales Questions'); ?></span></h3>
							
							<form method="post" action="#">
							   <p>
								  <label><?php echo $this->lang->line('your_email'); ?><span class="red">*</span></label>
								  <input class="clsText" type="text" name="faq_email" value="<?php echo set_value('faq_email'); ?>" />
								   <?php echo form_error('faq_email'); ?>
							   </p>
							    <p>
								   <label><?php echo $this->lang->line('subject'); ?><span class="red">*</span></label>
								   <input class="clsText" type="text" name="faq_subject"  value="<?php echo set_value('faq_subject'); ?>"/>
								   <?php echo form_error('faq_subject'); ?>
								</p>
								<p>
								   <label class="clsComments"><?php echo $this->lang->line('comments'); ?><span class="red">*</span></label>
								   <textarea name="faq_comments" rows="10" cols="40"><?php echo set_value('faq_comments'); ?></textarea>
								   <?php echo form_error('faq_comments'); ?>
								</p>
								<p class="clsSubmitBlock">
								   <label>&nbsp;</label>
								   <input class="clsLoginlarge_but" type="submit" value="<?php echo $this->lang->line('submit_button'); ?>" name="faqPosts"/>
								</p>
						   </form>
				           </div>
                          </div>
                         </div>
         
      <!--END OF WORK JOB-->
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
      
     </div>
<!--END OF MAIN-->
</div></div>
<?php $this->load->view('footer'); ?>
