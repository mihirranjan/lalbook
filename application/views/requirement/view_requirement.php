<?php $this->load->view('header'); ?>


<div class="clsMinContent clearfix">
<?php $this->load->view('sidebar'); ?>
<style>
.clsInnerCommon li{
	background:none!important;
	padding:0 !important;
}
.clsOptionalDetails li {
    list-style-type: none!important;
}
.clsOptionalDetails ul {
    padding-left: 1em !important;
}
.clsInnerCommon form p, .clsPostProject p, .clsInnerCommon p, .clsInnerCommon ul {
    padding-left: 0 !important;
}
.clsInnerCommon ul {
    padding-left: 2em !important;
}
.clsPostProject li ul {
    background: none repeat scroll 0 0 hsl(0, 0%, 97%);
    border-bottom: 1px dashed hsl(0, 0%, 87%);
    margin: 0 20px 10px 0;
    padding: 10px !important;
}
.clsFloatedList{
    clear: both;
    overflow: hidden;
    padding: 10px !important;
}
.clsPercent50 {
    width: 60%!important;
}
.clsOptionalDetails li.clSNoBack ul:hover{
	background:#EFEDED;
	}
/*.clsOptionalDetails ul:hover{
	background:#EDF8FE;
}*/
li h5{
	margin-top:5px;
}
.clsPostProject label{
	float:left;
	width:120px;
	text-align:left;
	display:block;
}
</style>
  <!--MAIN-->
    <div id="main">
	<?php $this->load->view('view_accountMenu'); ?>
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
        
                            <div class="clsPostProject clsSitelinks">
							
                              <h2><?php echo 'Post Buy Requirement';?> </h2>
							
							  <?php  
								//Show Flash Error Message
							
								if($msg = $this->session->flashdata('flash_message'))
									{
									echo $msg;
									}
									
								 								  
								  
								  ?>
								
                          
                            
                             



                             

                              <h3><span class="clsOptDetial"><?php echo $this->lang->line('Requirement Details...');?></span></h3>
							  <h3><?php echo $this->lang->line('Tell us Requriement');?></h3>
							  <form method="post" action="<?php echo site_url('requirement/create'); ?>" name="form"  enctype="multipart/form-data">
                              <ul>
                                <li>
                                  <h5><?php echo $this->lang->line('What you expect');?></h5>
                                  
                                  <p>
                                   <input name="lookingfor" value="" maxlength="50" size="50" type="text"/>
	                              
                                  </p>
								  <?php echo form_error('lookingfor'); ?>
                                </li>
								<li>
                                  <h5><?php echo $this->lang->line('Requirement Type');?></h5>
                                  
                                  <p>
                                   <select name="reqtype">
								   <option value="">Select Requirement Type</option>
								   <option value="1">Product</option>
								   <option value="2">Service</option>
								   <option value="3">Both</option>
								   </select>
	                              
                                  </p>
								  <?php echo form_error('reqtype'); ?>
                                </li>
								<li>
                                  <h5><?php echo $this->lang->line('Industry Type');?></h5>
                                  
                                  <p>
                                   <select name="industry">
								   <option value="">Select Industry Type</option>
								   <option value="1">Product</option>
								   <option value="2">Service</option>
								   <option value="3">Both</option>
								   </select>
	                              
                                  </p>
								  <?php echo form_error('industry'); ?>
                                </li>
								<li>
                                  <h5><?php echo $this->lang->line('Requirement details');?></h5>
                                  
                                  <p>
                                  <textarea rows="5" name="description" cols="42"></textarea>
	                              
                                  </p>
								  <?php echo form_error('description'); ?>
                                </li>
                                
								
                               <br />
								
		<li><label><b><?php echo $this->lang->line('Budget');?></b></label>
		<select name="budget" size="1"   style="width: 202px;">
		<option value="">Select</option>
		
			
			<option value="<10,000" >&lt;10,000</option>
                       <option value="10,000 - 1,00,000"> 10,000 - 1,00,000</option>
                        <option value="1,00,000 - 10,00,000">1,00,000 - 10,00,000</option>
                        <option value="10,00,000 - 1,00,00,000">10,00,000 - 1,00,00,000</option>
                       <option value=">1,00,00,000">&gt;1,00,00,000</option>

			
		
	</select>
	<?php echo form_error('budget'); ?>
	</li>
	<br />
	<li><label><b><?php echo $this->lang->line('End date');?></b></label>
		<input type="text" name="enddate" id="inputField" />
	<?php echo form_error('enddate'); ?>
	</li>
	

                              </ul>
                              <div class="clsOptionalDetails">
                               
                                <ul>
                                  <li>
                                    <h5><?php echo $this->lang->line('Attachment:');?>
                                      <img src="<?php echo image_url('clip.gif'); ?>" width="15" height="13" />
									  <input name="attachment" type="file"/>
									 <small style="color:red;" ><?php echo $this->lang->line('allowed files'); ?></small>	
									  <?php 
									   $filesize = '0';
									   foreach($fileInfo->result() as $fileDate)
										 {
										   $filesize =$filesize + $fileDate->file_size;
										 } ?>	 
									  <?php echo form_error('attachment'); ?>
									  
									
                                    </h5>
                                    <p><small><?php echo $this->lang->line('info'); ?> <?php echo round($filesize/1024,2);?> <?php echo $this->lang->line('info1');?> <?php echo $maximum_size.' MB'; ?></small></p></li>
                                  
								  
								  
							    </ul>
								
								
									
								
							  </div>
							  <p style="padding-left:20px !important;">
							
							<input class="clsLoginbig_but" value="<?php echo $this->lang->line('Submit Requirement');?>" name="submitJob" type="submit" />	
								
                              </p>
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
<script type="text/javascript">

function formSubmit()
{
var form = document.createElement("form");
//alert(form.);
form.setAttribute("target", "_blank");
}

/* For laod favouriteusers list into the textarea box */
function loadProgrammers(num)
{
   document.getElementById('private_listfill').value += num;
   return TRUE;
}

//Set the properties of textarea box disabled */
function check_private(formname)
{
  document.getElementById('private_listfill').disabled = !document.getElementById('is_private').checked;
  document.getElementById('private_listfill').value="";
}
</script>
</div></div></div>
<?php $this->load->view('footer'); ?>