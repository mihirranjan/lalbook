<?php $this->load->view('admin/header');?>

<?php $this->load->view('admin/sidebar');?>


<script type="text/javascript" src="<?php echo base_url();?>application/js/jquery.js"></script>

<script type="text/javascript">

 function getindustry(business_id)
{

    $.ajax({
       type: "POST",
       url: "<?php echo admin_url('postrequirement/industry');?>", 
       beforeSend: function () {
       $("#industry").html("<option>Loading ...</option>");
        },
		
       data: "business_id="+business_id,
       success: function(msg){
         $("#industry").html(msg);
		// $(".clspostselect").hide();
       }
       });
} 

			
</script>

<style>
label, .clsLable {
    display: block;
    float: left;
    font-size: 13px;
    margin: 0.5em 0 0;
    text-align: left;
    width: 40%;
}
.PostRequirement p{
	clear:both;
	overflow:hidden;
	margin:15px 0;
}
input,select,textarea{
   background: none repeat scroll 0 0 #FFFFFF;
    border: 1px solid #DDDDDD;
    float: left;
    padding: 5px;
	color:#565656;
}
select.clspostselect,select#industry,select.clspostselect{
	width:355px;
}
textarea{
	height:auto;
}
span.help{
	margin-left:5%;
}
</style> 
<div id="main"> 
  <div class="clsSettings"> 
    <div class="clsMainSettings"> 
	
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


<div class="PostRequirement">   
<div class="clsTop clsClearFixSub">
            <div class="clsNav">
          <ul>
            <li class="clsNoBorder"><a href="<?php echo admin_url('skills/addGroup')?>"><?php echo $this->lang->line('create_new_group'); ?></a></li>
          </ul>
        </div>
		   <div class="clsTitle">
          <h3><?php echo 'Edit Post Buy Requirement';?></h3>
        </div>
      </div>


 <?php  
								//Show Flash Error Message
							
								if($msg = $this->session->flashdata('flash_message'))
									{
									echo $msg;
									}
									
								 								  
								  
								  ?>
								  
								    <?php
	  	//Content of a group
		if(isset($postRequirement) and $postRequirement->num_rows()>0)
		{
			$postReq = $postRequirement->row();
	  ?>
	 <!-- <div style="text-align:left;font-size:13px;margin:10px 0;color:#C00000;">
								  <?php echo $this->lang->line('Requirement Details...');?>
								  <?php echo $this->lang->line('Tell us Requriement');?>
                                  </div>-->
								   <form method="post" action="<?php echo admin_url('postrequirement/edit/'.$this->uri->segment(4,0)); ?>" name="editPostreq"  enctype="multipart/form-data">
								   
<p><label><?php echo $this->lang->line('What you expect');?></label><input name="lookingfor" value="<?php echo $postReq->looking_for;?>"  type="text" class="clspostTxt"/></p>
 <?php echo form_error('lookingfor'); ?>

<p><label><?php echo $this->lang->line('Requirement Type');?></label><select name="reqtype" class="clspostselect" onChange='getindustry(this.value);'>
								   <option value="" >Select Requirement Type</option>
								   <option value="1" <?php if($postReq->requirements==1){ echo 'selected="selected"';}?>>Product</option>
								   <option value="2" <?php if($postReq->requirements==2){ echo 'selected="selected"';}?>>Service</option>
								   <option value="3" <?php if($postReq->requirements==3){ echo 'selected="selected"';}?>>Both</option>
								   </select></p>
								   <?php echo form_error('reqtype'); ?>
								   
								   
<p><label><?php echo $this->lang->line('Industry Type');?></label><select name="industry" class="clspostselect" id="industry">
								   <option selected="selected" value="">--Select industry--</option>
								   </select></p>
								   <?php echo form_error('industry'); ?>
								   
<p><label><?php echo $this->lang->line('Requirement details');?></label> 
<textarea cols="40" rows="7" name="description" ><?php echo $postReq->description;?></textarea></p>
 <?php echo form_error('description'); ?>
<p><label><?php echo $this->lang->line('Budget');?></label><select name="budget"  class="clspostselect">
		<option value="">Select</option>
		 <?php $a = '<10,000';
		       $b = '10,000 - 1,00,000';
			   $c = '1,00,000 - 10,00,000';
			   $d = '10,00,000 - 1,00,00,000';
			   $e = '>1,00,00,000';
		 
		 ?>
			
			          <option value="<10,000" <?php if($postReq->budget==$a){ echo 'selected="selected"';}?> >&lt;10,000</option>
                       <option value="10,000 - 1,00,000" <?php if($postReq->budget==$b){ echo 'selected="selected"';}?>> 10,000 - 1,00,000</option>
                        <option value="1,00,000 - 10,00,000" <?php if($postReq->budget==$c){ echo 'selected="selected"';}?>>1,00,000 - 10,00,000</option>
                        <option value="10,00,000 - 1,00,00,000" <?php if($postReq->budget==$d){ echo 'selected="selected"';}?>>10,00,000 - 1,00,00,000</option>
                       <option value=">1,00,00,000" <?php if($postReq->budget==$e){ echo 'selected="selected"';}?>>&gt;1,00,00,000</option>

			
		
	</select></p>
	<?php echo form_error('budget'); ?>
<p><label><?php echo $this->lang->line('End date');?></label><input type="text" name="enddate" id="enddate"  class="clspostTxt" value="<?php echo $postReq->end_date;?>"/></p>
<?php echo form_error('enddate'); ?>

<p><label><?php echo $this->lang->line('Attachment:');?></label><input type="file" class="clspostTxt" value="" name="attachment"  /><small style="position: relative; right: 0px; top: 5px; left: -160px;"><?php echo $maximum_size.' MB'; ?></small></p>
 <p><label>&nbsp;</label> <span> <small style="color:red;" ><?php echo $this->lang->line('allowed files'); ?></small>	</span></p>
 <?php 
									 /*  $filesize = '0';
									   foreach($fileInfo->result() as $fileDate)
										 {
										   $filesize =$filesize + $fileDate->file_size;
										 }*/ ?>	 
									  <?php //echo form_error('attachment'); ?>
									  <!-- <p><label>&nbsp;</label><span><small><?php echo $this->lang->line('info'); ?> <?php //echo round($filesize/1024,2);?> <?php //echo $this->lang->line('info1');?> </small></span></p>-->
<p><label>&nbsp;</label><input type="submit" value="<?php echo 'Edit Requirement';?>" name="editRequirement"  class="clsCommonbut" /></p>


<?php } ?>
</div> 

</div></div></div></div></div></div></div></div></div></div> 

</div></div></div>

<?php $this->load->view('admin/footer');?>