<?php $this->load->view('header'); ?>
<div class="clsMinContent clearfix">
<?php //$this->load->view('sidebar'); ?>
<style>
label{
	float:left;
	display:block;
	width:100px;
	text-align:left;
}
.clsInnerpageCommon {
	margin:20px auto;
	width:550px;
	font-family:Lucida Sans Unicode;
}
.clsInnerpageCommon h2{
	/*background:#f3f5f4;border-bottom:3px solid #039CE2;*/
	margin:0 0 15px;
	padding:5px 0 5px 10px;
	text-transform:uppercase;
}
.clsInnerpageCommon h3{
	margin:0 0 10px;
	padding:0px 0 15px;
}
.clsInnerpageCommon p a{
	color:#5e5e5e;
	margin:0 5px 0 0;
	
}
.clsInnerpageCommon p a:hover{
	color:#DD472C;
}
.clsInnerCommon form p{
	clear:both;
	overflow:hidden;
	margin:7px 0;
}
.message{
	width:83% !important;
	padding:0 .5em !important;
}
.clsInnerCommon{
/*border:1px solid #ccc;*/
}
</style>
<!--MAIN-->
  <div class="clsInnerpageCommon">
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

   
                        <div class="clsInnerCommon">
                          <!--<h2><?php echo $this->lang->line('Login');?></h2>
                          <h3><span class="clsTransfer"><?php echo $this->lang->line('Login');?></span></h3>-->
                         
						<?php	
						if($this->session->userdata('private_user'))
						{?>
						 <h2><?php echo $this->lang->line('Login to Private Project');?></h2>
                         <h3><span class="clsTransfer"><?php echo $this->lang->line('Private Project'); echo $this->uri->segment(3,0); ?> <?php echo '<img src="',image_url('private.png').'" width="14" height="14" title="Private Jobs" alt="private Jobs" />';?></span></h3>
						 
						 <p><?php echo $this->lang->line('note');?></p>
						 
						 <?php 
						}
						else
						{?>

						 <h2><?php echo $this->lang->line('Login');?></h2>
						
                         <!-- <h3><span class="clsTransfer"><?php echo $this->lang->line('Login');?></span></h3>--><?php
						}
							?>
							 <?php
							//Show Flash Message
							if($msg = $this->session->flashdata('flash_message'))
							{
								echo $msg;
							}?>
						  <form method="post" action="<?php echo site_url('users/login'); ?>">
                            <p><label>Username :</label>
							  <input type="text" name="username" value="<?php echo set_value('username'); ?>" class="clsText" id="UN" onblur="SwapUsernamePlace();" style="display:none;"/>
							  <input type="text" value="Username" class="clsText" id="UNP" onfocus="javascript:SwapUsername();" style="color:#727272;border: 1px solid #CCC;    height: 23px;padding: 0 0 0 5px; "/>							 
                            </p>
                             <?php if(form_error('username')!='') echo '<p><label>&nbsp;</label><span class="clsError">'.form_error('username').'</span></p>'; ?>
                            <p><label>Password :</label>
							  <input type="text" value="Password" class="clsText" onfocus="javascript:SwapPassword();" id="PWP" style="color:#727272;border: 1px solid #CCC;    height: 23px;padding: 0 0 0 5px; "/>
                             <input type="password" name="pwd" value="" class="clsText" onblur="SwapPasswordPlace();" style="display:none;" id="PW"/>
							  
							  
                            </p><?php if(form_error('pwd')!='') echo '<p><label>&nbsp;</label><span class="clsError">'.form_error('pwd').'</span></p>'; ?>
                  
							 <p><label>&nbsp;</label> <input type="checkbox" class="checkbox"  name="remember"/>
		    					 <?php echo $this->lang->line('remember me');?>
						   </p>	
                            <p><label>&nbsp;</label> 
                              <input type="submit" name="usersLogin" value="<?php echo $this->lang->line('Login');?>" class="clsLogin_but"/>
                            </p>
                            <p style="padding-bottom:10px;"><label>&nbsp;</label> <a href="<?php echo site_url('users/forgotPassword'); ?>"><?php echo $this->lang->line('I forgot my login details');?>?</a> <a href="<?php echo site_url('owner/signup'); ?>"><?php echo $this->lang->line('Signup');?></a></p>
                          </form>
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
<!--END OF MAIN-->
</div>
 <script language="javascript" type="text/javascript">
	   function SwapPassword()
    {
	    var tfPassword = GetPageElement("PW");
	    var tfPasswordPlace = GetPageElement("PWP");

        tfPasswordPlace.style.display = "none";
        tfPassword.style.display = "";
        tfPassword.focus();
    }
    
    function SwapUsername()
    {
	    var tfUserName = GetPageElement("UN");
	    var tfUsernamePlace = GetPageElement("UNP");

        tfUsernamePlace.style.display = "none";
        tfUserName.style.display = "";
        tfUserName.focus();
    }     
    
    function SwapUsernamePlace()
    {
	    var tfUserName = GetPageElement("UN");
	    var tfUsernamePlace = GetPageElement("UNP");
	    
        if (tfUserName.value == '')
        {
            tfUsernamePlace.style.display = "";
            tfUserName.style.display = "none";
        }
    }
    
    function SwapPasswordPlace()
    {
	    var tfPassword = GetPageElement("PW");
	    var tfPasswordPlace = GetPageElement("PWP");

        if (tfPassword.value == '')
        {
            tfPasswordPlace.style.display = "";
            tfPassword.style.display = "none";
        }
    }    
	function GetPageElement(field){
		return document.getElementById(field);
	}
	  </script>
	  </div>
<?php $this->load->view('footer'); ?>