<?php $this->load->view('header_profile'); ?>

<div class="Container">
    
    <div id="selMain clearfix">
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
                      <div class="clsMessage">
<h2><?php echo $this->lang->line('Message_Display');?></h2>
<!--<p><img src="<?php echo image_url();?>/error_icon.jpg" alt="" /></p>-->

 <p><?php
								//Show Flash Message
								if($msg = $this->session->flashdata('flash_message'))
								{
									echo $msg;
								}
							   ?>
							   </p>
                              <!-- <p><a href="<?php echo site_url('seller');?>">More Information...</a></p>-->
<!--<p>You must </p>
<h3><span>Log in</span> as  <span>Buyer</span> to </h3>
<p>Post Your Requirements</p>-->
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
    
    </div>
    
    </div>
    <!--<div id="selFooter">
    <div class="clsFooter clearfix">
    <div class="clsLeftfoot">
    <ul class="clearfix">
    <li><a href="#">Post </a></li>
      <li><a href="#">   Blogs  </a></li> 
      <li><a href="#">  Contact  </a></li>
        <li><a href="#"> Feeds  </a></li>
        <li class="clsNoBorder"><a href="#">    Privacy Policy</a></li>
    </ul>
    
    </div>
    <div class="clsRightFoot">
    <p>Lalbook © 2013. All Rights Reserved.</p>
    </div>
    <div class="clsCenterFoot">
    <ul class="clearfix">
    <li><a href="#"><img src="images/f_icon1.jpg" alt="" /></a></li>
     <li><a href="#"><img src="images/f_icon2.jpg" alt="" /></a></li>
      <li><a href="#"><img src="images/f_icon3.jpg" alt="" /></a></li>
    </ul>
    </div>
    
    </div>
    </div>-->
	 <?php $this->load->view('home_footer'); ?>
    
</body>
</html>
