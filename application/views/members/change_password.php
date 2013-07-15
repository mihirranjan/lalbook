<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LalBook</title>
<link rel="stylesheet" type="text/css" href="css/common.css" />
<!--[if IE ]>
<link href="css/iefix.css" rel="stylesheet" type="text/css" />
<![endif]-->
</head>
<body>
<div class="Container"> 
<?php $this->load->view('header'); ?>
<div class="clsMinContent clearfix">
<?php //$this->load->view('sidebar'); ?>
<style>
.clsHeads {
    background: url("http://demo.maventricks.com/lalbook/application/css/images/viewh_bg.jpg") repeat-x scroll 0 0 transparent;
    height: 55px;
    line-height: 55px;
    padding: 0 0 0 10px !important;
}
label{
	float:left;
	width:160px;
	display:block;
	text-align:left;
}
.clsInnerCommon p{
	margin:7px 0;
}
</style>

<!--MAIN-->
<div id="Innermain">
  <?php
		//Show Flash Message
		if($msg = $this->session->flashdata('flash_message'))
		{
			echo $msg;
		}
	   ?>
  <!--POST JOB-->
  <div class="clsViewMyProject">
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
   
                        <div class="clsInnerCommon">
							<div class="clsHeads">
								<h2>Change Password</h2>
							</div>   
							<span style="color:red;"><?php echo $error;?></span>
							<br /> <br />
							
							<div id="selSignUp">
								<h3><span class="">Change Password</span></h3>
								
								<form method="post" action="<?php echo site_url('users/change_password'); ?>">
									<p><label>New password:</label>
									<input type="password" name="new_pass" value="" size="20" class="clsCTxt"/> 
									
								
									<p><label>Repeat password:</label>
									<input type="password" name="new_rpass" value="" size="20" class="clsCTxt"/> 
									
									
								<p><label style="width:170px;">&nbsp;</label> <input type="submit" value="Save" 
									name="Save" class="clsCommonbut"/></p> 

							</form>
							</div>
                          <br /> <br />
                         
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
                  
<!--END OF MAIN-->
</div></div> 
<?php $this->load->view('home_footer'); ?>