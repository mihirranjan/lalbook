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
<?php $this->load->view('header'); 

extract($field_data);

?>


<script type="text/javascript">
	
</script>
    <!-- End of Header -->
    <!--<div id="selSearch">
    <p><label>Search </label><input type="text" value="Search for product bids" class="clsSertxt"><input type="button" value="" class="clsGobut"></p>
    </div>-->
    
    
    
    <div class="clsMainContent clearfix"> 
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
						<div class="cls100_p clearfix">
						<div class="sidebar">
						</div>
    
						<div class="PostRequirement"> 
							<h2><?php echo 'Post Buy Requirement';?></h2> 
							
							<div class="clsLeftserBox">
								<div class="clsRightbar">
								<h3>Make an informed decision</h3>
								<p>Get quotes from merchants to help you in making the right decision for your business.</p>
								<p>This service will always be FREE for you.</p>
								</div>
							</div>
                            
							
							<?php //echo $this->lang->line('Requirement Details...');?>
							<?php echo $this->lang->line('Tell us Requriement');?>
													
							<form method="post" action="<?php  echo site_url('requirement/create'); ?>" name="form"  enctype="multipart/form-data">

								<p><label><?php echo $this->lang->line('What you expect');?></label>
								<input onblur="placeholder='Need 20 Electric Motors'" onfocus="placeholder=''" 
								placeholder='Need 20 Electric Motors' name="lookingfor" value="<?php echo $lookingfor?>"  type="text" class="clspostTxt req_field" value="<?php echo set_value('lookingfor'); ?>" /></p>
								<?php echo form_error('lookingfor'); ?>

								<p><label><?php echo $this->lang->line('Requirement Type');?></label>
								<select name="reqtype" id="reqtype" class="clspostselect req_field" onChange='get_cities(this.value,"")'>
								<option value="" selected="selected">Select Requirement Type</option>
								<option value="1" <?php echo $select = ($reqtype == 1) ? 'selected' : ""; ?> >Product</option>
								<option value="2" <?php echo $select = ($reqtype == 2) ? 'selected' : ""; ?> >Service</option>
								<option value="3" <?php echo $select = ($reqtype == 3) ? 'selected' : ""; ?> >Both</option>
								</select></p>
								<?php echo form_error('reqtype'); ?>
							
								<p><label><?php echo $this->lang->line('Industry Type');?></label>
								<input type="hidden" name="hdn_industry" id="hdn_industry" value="<?php echo $industry ?>" />
								<select name="industry" class="clspostselect req_field" id="industry">
								<option selected="selected" value="">Select industry</option>
								</select></p>
								<?php echo form_error('industry'); ?>
							
								<p><label><?php echo $this->lang->line('Requirement details');?></label> 
								<textarea onblur="placeholder='Description'" onfocus="placeholder=''" placeholder='Description' 
								cols="50" rows="7" name="description" class="req_field" ><?php echo $description ?></textarea></p>
								<?php echo form_error('description'); ?>
							
								<p><label><?php echo $this->lang->line('Budget');?></label>
								<select name="budget"  class="clspostselect req_field">
									<option value="">Select</option>
									<option value="<10,000" <?php echo $select = ($budget == "<10,000") ? 'selected' : ""; ?> >&lt;10,000</option>
									<option value="10,000 - 1,00,000" <?php echo $select = ($budget == "10,000 - 1,00,000") ? 'selected' : ""; ?>> 10,000 - 1,00,000</option>
									<option value="1,00,000 - 10,00,000" <?php echo $select = ($budget == "1,00,000 - 10,00,000") ? 'selected' : ""; ?>>1,00,000 - 10,00,000</option>
									<option value="10,00,000 - 1,00,00,000" <?php echo $select = ($budget == "10,00,000 - 1,00,00,000") ? 'selected' : ""; ?>>10,00,000 - 1,00,00,000</option>
									<option value=">1,00,00,000" <?php echo $select = ($budget == "1,00,00,000") ? 'selected' : ""; ?>>&gt;1,00,00,000</option>
								</select><span class="rupee">&nbsp;</span></p>
								<?php echo form_error('budget'); ?>
								
								<p><label><?php echo $this->lang->line('Tags');?></label>
								<input  onblur="placeholder='Tags'" onfocus="placeholder=''" placeholder='Tags' type="text" 
								name="tags" id="tags"  class="clspostTxt req_field" value="<?php echo $tags?>"/></p>
								<?php echo form_error('tags'); ?>
							
								<p><label><?php echo $this->lang->line('End date');?></label>
								<input  onblur="placeholder='End Date'" onfocus="placeholder=''" placeholder='End Date' type="text" 
								name="enddate" id="popupDatepicker"  class="clspostTxt req_field" onselect="readonly" 
									value="<?php echo $enddate; ?>"/></p>
								<?php echo form_error('enddate'); ?>

								<p><label><?php echo $this->lang->line('Attachment:');?></label>
									<input  style="width: 407px;" onblur="placeholder='Upload a image file'" onfocus="placeholder=''" placeholder='Upload a image file' 
											type="text" name="txt_file" id="txt_file"  class="clspostTxt req_field" value=""/>
									<span class="clsCommonbut" id="file_lavel">Upload</span>
									<input id="file_type" type="file" name="attachments"  />
									
									<br/>
									<span> 
										<small style="color:#999;" >
											<?php echo "jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF";//$this->lang->line('allowed files'); ?>
										</small>
									</span>
								</p>
								<?php echo form_error('attachments'); ?>
								<div style="color:red;">
								<?php  
									echo $f_error
								?>
								</div>
								
								
								<p><label>&nbsp;</label>
								<input type="submit" onclick="return validate_requirement();" value="<?php echo $this->lang->line('Submit Requirement');?>" name="submitJob"  class="clsCommonbut" />
								</p>
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
                            <!--end of RC -->
    
    </div>
    
    </div>
   <?php $this->load->view('home_footer'); ?>
    
</body>
</html>
