<?php $this->load->view('header'); ?>
<div class="clsMinContent clearfix">
<?php //$this->load->view('sidebar'); ?>
<style>
#selSearch{
	display:none !important;
}
</style>

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
                              <!--POST JOB-->
                       <div class="clsInnerpageCommon">
       
                            <div class="clsInnerCommon">
							
							<h2><?php echo $this->lang->line('Message_Display');?></h2>
							
                             <?php
								//Show Flash Message
								if($msg = $this->session->flashdata('flash_message'))
								{
									echo $msg;
								}
							   ?>
							   <p align="center"><input type="button" name="goback" class="clsLogin_but" value="<?php echo $this->lang->line('Go Back'); ?>" onclick="history.go(-1)"/></p>

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
                          <!--end of RC -->
    </div>
<!--END OF MAIN-->
</div></div>
<?php $this->load->view('footer'); ?>