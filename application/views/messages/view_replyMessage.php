<div class="Container">
<?php $this->load->view('header'); ?>
<div class="clsMinContent clearfix">
<?php //$this->load->view('sidebar'); ?>
<style>
	.clsPoliicy label{
	float:left;
	text-align:left;
	display:block;
	width:120px;
}
.clsPoliicy textarea{
	margin:0 !important;
	padding:7px;
}
.clsPoliicy ul{
    border-bottom: 1px dotted #ddd;
    padding: 10px 0;
}
.clsPoliicy li{
margin-bottom:7px;
}
</style>

<?php
		//Get job Info
     	$job       = $jobs->row();
		$users     = $users->row();
		$message   = $messages->row();
?>
<!--MAIN-->
<div class="clsMinContent clearfix">
<?php //$this->load->view('sidebar'); ?>
<script language="JavaScript" type="text/JavaScript">
$(window).load(function () {
// run code


document.getElementById('message').focus();

});
</script>

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
                      <div class="clsPoliicy">				
							  <h2><?php echo $this->lang->line('Post Message'); ?></h2>
							  <p class="clsSitelinks"><?php echo $this->lang->line('You are currently logged in as');?> <a class="glow" href="<?php if($loggedInUser->role_id == '1') $res = 'owner'; else $res = 'employee'; echo site_url($res.'/viewprofile/'.$loggedInUser->id); ?>"><?php if(isset($loggedInUser) and is_object($loggedInUser))  echo $loggedInUser->user_name;?></a> (<a href="<?php echo site_url('users/logout'); ?>"><?php echo $this->lang->line('Logout') ?></a>).</p><br />
								<?php
								//Check the condition for the messages are saved or not
								if(isset($previewMessages))
								 { 
								    if(count($previewMessages) != '0')
									 {
										 ?>
										<!-- Preview Mail start Here -->
				
					
										  <!--<h3><span class="clsPMB"><?php echo $this->lang->line('Preview Message');?></span></h3>-->
										  <?php 
										  $no=1;
										  if($no == '0')
											{
											 echo '<br>';
											 echo 'There is no last trasaction';
											 echo '<br><br>'; 
											 }
										   
										  if($no != '0')
											{ ?>
										  <ul>	
										  <li><label><b><?php echo $this->lang->line('From'); ?></b></label> <?php if(isset($loggedInUser) and is_object($loggedInUser))  echo $loggedInUser->user_name;?></li>
										  
										  
										  <li><label><b><?php echo $this->lang->line('To'); ?></b></label><?php echo $users->user_name;?> </li>
										  
															  
										  <li><label><b><?php echo $this->lang->line('Message'); ?></b></label><?php echo $previewMessages['message']; ?></li>
										  <li><label><b><?php echo $this->lang->line('Date'); ?></b></label><?php $date = $previewMessages['created']; echo get_date($date); ?></li>
										  </ul>
										   <?php } ?>
										   <!-- Preview mail end here -->
										<?php 
							       } 
							    }
							?>
							<!--<h3><span class="clsOptContact"><?php echo $this->lang->line('Post Message');?></span></h3>-->
							<form method="post" action="<?php echo site_url('messages/replyMessage/'.$message->id); ?>" >

								<p><label><b><?php echo $this->lang->line('From'); ?>:</b></label>
								  <?php if(isset($loggedInUser) and is_object($loggedInUser)) {  echo $loggedInUser->user_name; }?>  </p>
								   <p><label><b><?php echo $this->lang->line('To'); ?></b></label><?php echo $users->user_name;?> </p>
								   <p><label><b><?php echo $this->lang->line('Job Name'); ?>:</b></label>
										<?php $i =0 ; ?>
 										<?php echo $job->looking_for; ?>
								 </p>
								  
									  <p><label><b><?php echo $this->lang->line('Message'); ?>:</b></label>
									  <textarea rows="10" name="message" cols="60" id="message" ><?php echo set_value('message'); ?></textarea></p>
									 <p><label>&nbsp;</label><?php echo $this->lang->line('Tip');?> </p>
									 <p><label>&nbsp;</label><?php echo form_error('message'); ?></p>
									  
									  <p>
									  <input class="clsRefresh_but" type="submit" value="<?php echo $this->lang->line('Submit');?>" name="postMessage"/>
									  <input  class="clsRefresh_but" type="submit" value="<?php echo $this->lang->line('Preview');?>" name="previewMessage"/>
									</p>
							 
								<!--END OF JOB MESSAGE BOARD-->
							  </form>
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
					</div>
					</div>
					</div>

	</div>
<!--END OF MAIN-->
<?php $this->load->view('home_footer'); ?>