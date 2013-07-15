<?php $this->load->view('header'); ?>

<div class="clsMinContent clearfix">
  <?php $this->load->view('sidebar'); ?>
  <!--MAIN-->
  <div id="main">
    <!--POST JOB-->
    <div class="clsEditProfile">
      <div class="clsInnerCommon">
        <h2><?php echo $this->lang->line('NEW OWNERS SIGN-UP');?></h2>
        <!--NEW OWNERS SIGN-UP-->
        <div id="selSignUp">
          <form method="post" action=""  enctype="multipart/form-data">
            <?=form_token();?>
            <h3><span class="clsNewBuyer"><?php echo $this->lang->line('New Owner Signup (Step 2)');?></span></h3>
            <p> <?php echo $this->lang->line('Confirmed E-mail1:');?>
              <?php if(isset($confirmed_mail)) echo $confirmed_mail; ?>
            </p>
			
			 <p><span><?php echo $this->lang->line('firstname');?>
              <label style="color:red;">*</label>
              </span>
              <input type="text" size="25" name="firstname"/>
            
            </p>
            <p>
              <?php if(form_error('firstname')) { echo '<span>&nbsp;</span>';echo form_error('firstname'); echo '<br>'; }?>
            </p>
			
			<p><span><?php echo $this->lang->line('lastname');?>
              <label style="color:red;">*</label>
              </span>
              <input type="text" size="25" name="lastname"/>
            
            </p>
            <p>
              <?php if(form_error('lastname')) { echo '<span>&nbsp;</span>';echo form_error('lastname'); echo '<br>'; }?>
            </p> 
			
			<p><span><?php echo $this->lang->line('Email');?>
              <label style="color:red;">*</label>
              </span>
              <input type="text" size="25" style="width:auto" name="email" value="<?php echo $confirmed_mail; ?>"/>
            
            </p>
            <p>
              <?php if(form_error('email')) { echo '<span>&nbsp;</span>';echo form_error('email'); echo '<br>'; }?>
            </p>
			<p><span><?php echo $this->lang->line('Confirm email');?>
              <label style="color:red;">*</label>
              </span>
              <input type="text" size="25" name="csemail" value=""/>
             <p><span>&nbsp;</span><small><?php echo $this->lang->line('(Enter the above Email again to confirm it.)');?></small> </p>
            </p>
            <p>
              <?php if(form_error('csemail')) { echo '<span>&nbsp;</span>';echo form_error('csemail'); echo '<br>'; }?>
            </p>
            <p><span><?php echo $this->lang->line('Pick a Username:');?>
              <label style="color:red;">*</label>
              </span>
              <input type="text" size="25" value="<?php echo set_value('username'); ?>" name="username"/>
            </p>
            <p>
              <?php if(form_error('username')) { echo '<span>&nbsp;</span>';echo form_error('username'); echo '<br>'; }?>
            </p>
            </p>
            <p><span><?php echo $this->lang->line('Enter your password:');?>
              <label style="color:red;">*</label>
              </span>
              <input type="password" size="25" name="password"/>
            </p>
            <p>
              <?php if(form_error('password')) { echo '<span>&nbsp;</span>';echo form_error('password'); echo '<br>'; }?>
            </p>
            <p><span><?php echo $this->lang->line('Confirm Password:');?>
              <label style="color:red;">*</label>
              </span>
              <input type="password" size="25" name="ConfirmPassword"/>
            <p><span>&nbsp;</span><small><?php echo $this->lang->line('(Enter the above password again to confirm it.)');?></small> </p>
            </p>
            <p>
              <?php if(form_error('ConfirmPassword')) { echo '<span>&nbsp;</span>';echo form_error('ConfirmPassword'); echo '<br>'; }?>
            </p>
            
			
			<p><span><?php echo $this->lang->line('Goals in signingup');?>
              <label style="color:red;">&nbsp;</label>
              </span>
              <textarea rows="4" cols="15" name="signupgoal"></textarea>
            
            </p>
            <p>
              <?php if(form_error('signupgoal')) { echo '<span>&nbsp;</span>';echo form_error('signupgoal'); echo '<br>'; }?>
            </p>
			
			
			
			<!-- Business info -->		
			
			
            <h3><span class="clsOptContact"><?php echo $this->lang->line('Bussiness Info');?></span></h3>
            
            <div id="selOptional">
              <ul>
                <li> <span> <?php echo $this->lang->line('Name of the Organization:');?> <em style="color:#FF0000">*</em>&nbsp;</span>
                  <input type="text" name="organisation"  size="25"/>
				  <p>
                <?php if(form_error('organisation')) { echo '<span>&nbsp;</span>';echo form_error('organisation'); echo '<br>'; }?>
              </p>
                </li>
               
              </ul>
            </div>
            <div id="selAreaExpertise">
              <p><span><?php echo $this->lang->line('Your picture:');?></span>
                <input type="file" name="profilepic"/>
              </p>
              <p><small style="color:red;"><?php echo $this->lang->line('(Maximum 102400 bytes)');?> <?php echo $this->lang->line('allowed files'); ?></small>
              <p>
                <?php if(form_error('profilepic')) { echo '<span>&nbsp;</span>';echo form_error('profilepic'); echo '<br>'; }?>
              </p>
              <p><span><?php echo $this->lang->line('New Bid E-Mail Notifications:');?> </span>
                <select name="notify_bid" size="1">
                  <option value="">None</option>
                  <option value="Instantly" <?php echo set_select('notify_bid', 'Instantly'); ?>>Instantly</option>
                  <option value="Hourly" <?php echo set_select('notify_bid', 'Hourly'); ?>>Hourly</option>
                  <option value="Daily" <?php echo set_select('notify_bid', 'Daily'); ?>>Daily</option>
                </select>
              </p>
              <p>
                <?php if(form_error('notify_project')) { echo '<span>&nbsp;</span>';echo form_error('notify_project'); echo '<br>'; }?>
              </p>
              <p><span><?php echo $this->lang->line('New Message E-Mail Notifications:');?></span>
                <select name="notify_message" size="1">
                  <option value="">None</option>
                  <option value="Instantly" <?php echo set_select('notify_message', 'Instantly'); ?>>Instantly</option>
                  <option value="Hourly" <?php echo set_select('notify_message', 'Hourly'); ?>>Hourly</option>
                  <option value="Daily" <?php echo set_select('notify_message', 'Daily'); ?>>Daily</option>
                </select>
              </p>
              <p>
                <?php if(form_error('notify_message')) { echo '<span>&nbsp;</span>';echo form_error('notify_message'); echo '<br>'; }?>
              </p>
            </div>
            <p> <span><?php echo $this->lang->line('Country:');?><em style="color:#FF0000">*</em></span>
              <select name="country" size="1">
                <?php
											if(isset($countries) and $countries->num_rows()>0)
											{
												foreach($countries->result() as $country)
												{
										  ?>
                <option value="<?php echo $country->country_symbol; ?>" <?php echo set_select('country', $country->country_symbol); ?>><?php echo $country->country_name; ?></option>
                <?php
												}//Foreach End
											}//If End
										?>
              </select>
            </p>
            <p>
              <?php if(form_error('country')) { echo '<span>&nbsp;</span>';echo form_error('country'); echo '<br>'; }?>
            </p>
            
            <p> <span><?php echo $this->lang->line('City:');?><em style="color:#FF0000">*</em></span>
			
              <input type="text" name="city" value="<?php echo set_value('city'); ?>" maxlength="50" size="25"/>
            </p>
			<p>
              <?php if(form_error('city')) { echo '<span>&nbsp;</span>';echo form_error('city'); echo '<br>'; }?>
            </p>
			<p> <span><?php echo $this->lang->line('Address');?><em style="color:#FF0000">*</em></span>
			
             <textarea rows="4" cols="15" name="addrs"></textarea>
			 <p>
                <?php if(form_error('addrs')) { echo '<span>&nbsp;</span>';echo form_error('addrs'); echo '<br>'; }?>
              </p>
            </p>
			
			<p><span><?php echo $this->lang->line('BusinessType:');?><em style="color:#FF0000">*</em> </span>
                <select name="bstype" size="1">
                  <option value="">Select Business Type</option>
                  <option value="1">products/services</option>
                  <option value="2">products & services</option>
                  
                </select>
              </p>
              <p>
                <?php if(form_error('bstype')) { echo '<span>&nbsp;</span>';echo form_error('bstype'); echo '<br>'; }?>
              </p>
			  
			  <p><span><?php echo $this->lang->line('Phone');?><em style="color:#FF0000">*</em> </span>
               <input type="text" name="phone"  maxlength="50" size="25" />
              </p>
              <p>
                <?php if(form_error('phone')) { echo '<span>&nbsp;</span>';echo form_error('phone'); echo '<br>'; }?>
              </p>
			  
			    <p><span><?php echo $this->lang->line('Mobile');?><em style="color:#FF0000">*</em> </span>
               <input type="text" name="mobile"  maxlength="50" size="25" />
              </p>
              <p>
                <?php if(form_error('mobile')) { echo '<span>&nbsp;</span>';echo form_error('mobile'); echo '<br>'; }?>
              </p>
			  
			    <p><span><?php echo $this->lang->line('About us');?> </span>
               <textarea rows="4" cols="15" name="aboutus"></textarea>
              </p>
              <p>
                <?php if(form_error('aboutus')) { echo '<span>&nbsp;</span>';echo form_error('aboutus'); echo '<br>'; }?>
              </p>
			
			 <p><span><?php echo $this->lang->line('website');?> </span>
             <input type="text" name="website"  maxlength="50" size="25"  />
			  <p><span>&nbsp;</span><small><?php echo $this->lang->line('Valid URL');?></small> </p>
              </p>
              <p>
                <?php if(form_error('website')) { echo '<span>&nbsp;</span>';echo form_error('website'); echo '<br>'; }?>
              </p>
			
            <p class="underLine">
              <label style="color:red;">*</label>
              <input type="checkbox" name="signup_agree_terms" value="1" <?php echo set_checkbox('signup_agree_terms', '1'); ?>/>
              <?php echo $this->lang->line('I have read and agree to the');?> <a href = "javascript:void(0)" onclick = "document.getElementById('light1').style.display='block';document.getElementById('fade1').style.display='block'"><?php echo $this->lang->line('Bidonn Terms &amp; Conditions');?></a>
            <div id="light1" class="white_content">
            <div style="border-bottom: 2px solid rgb(232, 232, 232);"> <span class="clsClose"><a href = "javascript:void(0)" onclick = "document.getElementById('light1').style.display='none';document.getElementById('fade1').style.display='none'"><img src="<?php echo image_url('blacklist.png'); ?>" /></a></span>
              <?php if(isset($page_content1) and $page_content1->num_rows()>0)
													{ foreach($page_content1->result() as $page1) { echo  '<p style="padding:0 0 5px !important;"><b>'.$page1->page_title.'</b></p></div><div class="ClsPrivacyDesc">'.$page1->content.'</div>';}	} ?>
            </div>
            <div id="fade1" class="black_overlay">
              </h3>
            </div>
            </p>
            <p>
              <?php if(form_error('signup_agree_terms')) { echo form_error('signup_agree_terms'); echo '<br>'; }?>
            </p>
            <!--<p>
              <label style="color:red;">*</label>
              <input type="checkbox" name="signup_agree_contact" value="1" <?php echo set_checkbox('signup_agree_contact', '1'); ?>/ >
              <?php echo $this->lang->line('I will NOT post contact information on my projects.');?> </p>
            <p>
              <?php if(form_error('signup_agree_contact')) { echo form_error('signup_agree_contact'); echo ''; }?>
            </p>-->
            <p>
              <input type="hidden" name="confirmKey" value="<?php echo $this->uri->segment(3); ?>" />
              <input type="submit" class="clsLogin_but" value="<?php echo $this->lang->line('Signup');?>" name="ownerConfirm" />
            </p>
          </form>
          <?php  //print_r($_POST);
								//print_r($_FILES);
								?>
        </div>
        <!--SIGN-UP-->
      </div>
    </div>
  </div>
</div>
</div>
</div>
<!--END OF MAIN-->
<?php $this->load->view('footer'); ?>
<script type="text/javascript">
  function termspopups()
  {
     window.open('<?php echo site_url('info/terms'); ?>',"mywindow","menubar=1,resizable=1,width=650,height=450");
  }
   function privacypopups()
  {
     window.open('<?php echo site_url('info/privacy'); ?>',"mywindow","menubar=1,resizable=1,width=650,height=450");
  }
</script>
