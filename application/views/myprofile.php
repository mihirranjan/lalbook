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
					  <?php  if(isset($userrecords))
						 {
								
							$recorD = ($success)?$userrecords->result():$formData; 	 
						
						  foreach($recorD as $userdetails)
						    {
							$usrimg=$userdetails->logo; ?>
									<div class="clsAccDetails">
                      <ul class="clearfix">
					   
							<?php $usrcredits=$userdetails->credit;?>
                      <li <?php if($usrcredits!=0) { echo 'class="clsNoBorder"';} ?>>Bidding credits Available:<span> <?php echo $userdetails->credit;?>&nbsp;credits</span></li>
					  <?php if($usrcredits==0) 
					  {
					  ?>
                      <li class="clsNoBorder"><a href="#">Refill</a></li>
					  <?php } ?>
                      </ul>
                      </div>
					  <?php $this->load->view('view_innermenu'); ?>
                      <div id="selProfile" class="clearfix">
                      <div class="clsProfileInformation clearfix">
                      <div class="clsLeftProfileInfo">
					  
								<?php	if(!isset($usrimg))
									{
									
									?>
                      <img src="<?php echo image_url();?>/p_img.jpg" alt="" />
					  	<?php } ?>
						
						<?php if(isset($usrimg)){ ?>
										<img class='thumbnail' src='<?php echo base_url();?>files/logos/<?php echo $usrimg;?>' alt="" />
										<?php } ?>
                                     <p><span><a href="#" id="editprof">Change Profile Picture</a></span></p>
                      </div>
                      <div class="clsRightProfileInfo" style="padding:10px 0 14px 18px;">
                      <h2>User Profile</h2>
                      <div class="clsProfileRight">
                      <p>Reputation :</p>
					  <?php 
					  $usrid=$userdetails->user_id;
					  //echo "SELECT SUM(rating) AS rating,COUNT(id) as reviews FROM reviews WHERE userid = $usrid";
					  $q = "SELECT SUM(rating) AS rating,COUNT(id) as reviews FROM reviews WHERE userid = $usrid";
							//echo "SELECT COUNT(job_id) AS count FROM bids WHERE job_id = $jobidd";
 $query = $this->db->query($q,array($userdetails->user_id));
       $ncomments = $query->result_array();
	   //print_r($query);exit;
  	$blog_e->n_comments = $ncomments[0]['rating'];
	$blog_e->n_commentse = $ncomments[0]['reviews'];
	//$blog_e->n_commentse = $ncomments[0]['usid'];
	$count=$blog_e->n_commentse;
	/*if($count>1) {
	 $Totalbid=$blog_e->n_comments;
	 $ratings=$blog_e->n_comments/$blog_e->n_commentse;
	 }
	 else{
	  $ratings=$ncomments[0]['rating'];
	  echo $ratings;
	  }*/
	 
	 ?>
                      <p>
					 <?php  // echo $ratings."fghdfgh";if(($ratings<0) && ($ratings==0)  && ($ratings==NULL)){ echo "0yellow.png"; } ?>
	<?php if($count>=0) {
	 $Totalbid=$blog_e->n_comments;
	 if($count>0) $ratings=$blog_e->n_comments/$blog_e->n_commentse;
     else $ratings = 0;
	// echo $ratings;
	 ?>
	 <img src="<?php echo image_url();?>/<?php if(($ratings>1) && ($ratings<2)) {  echo "1_5yellow.png"; } elseif(($ratings>2) && ($ratings<3)) {  echo "2_5yellow.png"; } elseif(($ratings>3) && ($ratings<4)) {  echo "3_5yellow.png"; } elseif(($ratings>4) && ($ratings<5)) {  echo "4_5yellow.png"; } elseif($ratings>5) {  echo "5yellow.png"; } elseif(($ratings==1)){  echo  "1yellow.png"; } elseif(($ratings==2)){  echo  "2yellow.png"; } elseif(($ratings==3)){  echo  "3yellow.png"; } elseif(($ratings==4)){  echo  "4yellow.png"; } elseif(($ratings==5)){  echo  "5yellow.png"; } else if(($ratings<0) || ($ratings==0) || ($ratings==NULL)){ echo "0yellow.png"; } elseif(($ratings>0) && ($ratings<1)) { echo "0_5yellow.png";}  ?>" />
	 <?php 
	 }
	 else{
	  $ratings=$ncomments[0]['rating'];
	$blog_e->n_comments = $ncomments[0]['rating'];
	?>
	
	<img src="<?php echo image_url();?>/<?php if(($ratings<0) && ($ratings==0) && ($ratings==NULL)){ echo "0yellow.png"; } elseif(($ratings>0) && ($ratings<1)) { echo "0_5yellow.png";}  elseif(($ratings==1)){  echo  "1yellow.png"; } elseif(($ratings==2)){  echo  "2yellow.png"; } elseif(($ratings==3)){  echo  "3yellow.png"; } elseif(($ratings==4)){  echo  "4yellow.png"; } elseif(($ratings==5)){  echo  "5yellow.png"; } ?>" />
<?php 	
	 }
	 ?>
					  <!--<img alt="" src="<?php echo image_url();?>/<?php /*if($ratings<1.9)
					  {echo "0yellow.png";} else { echo  $ratings."yellow.png";}*/ if(($ratings<0) && ($ratings==0)  && ($ratings==NULL)){ echo "0yellow.png"; } elseif(($ratings>0) && ($ratings<1)) { echo "0_5yellow.png";} elseif(($ratings>1) && ($ratings<2)) {  echo "1_5yellow.png"; } elseif(($ratings>2) && ($ratings<3)) {  echo "2_5yellow.png"; } elseif(($ratings>3) && ($ratings<4)) {  echo "3_5yellow.png"; } elseif(($ratings>4) && ($ratings<5)) {  echo "4_5yellow.png"; } elseif($ratings>5) {  echo "5yellow.png"; } elseif(($ratings==1)){  echo  "1yellow.png"; } elseif(($ratings==2)){  echo  "2yellow.png"; } elseif(($ratings==3)){  echo  "3yellow.png"; } elseif(($ratings==4)){  echo  "4yellow.png"; } elseif(($ratings==5)){  echo  "5yellow.png"; }?>">-->
					  
					  
					  <span><?php //if($ratings==NULL){ echo "0";} else { echo $ratings;}?> <?php if($count>1) {
	 $Totalbid=$blog_e->n_comments;
	echo round($ratings=$blog_e->n_comments/$blog_e->n_commentse,1);
	}
	else if($blog_e->n_comments!=NULL){
	 $ratings=$ncomments[0]['rating'];
	echo round($blog_e->n_comments = $ncomments[0]['rating'],1);
	}
	else{
	echo "0";}
	?>/5</span></p>
                      <p class="Align"><a href="#tabs-3" id="tabs3"><?php if($blog_e->n_commentse!=0) { echo $blog_e->n_commentse." Reviews";} else { echo "No Reviews";}?> </a></p>
                      </div>
                      <div class="clsPLeft">
                      <p><label>User Name	</label>:	<?php echo $userdetails->user_name;?><span><?php $verify=$userdetails->user_verify;?><?php if($verify==1)
{
?>

<a href="#" class="tooltip"> <input type="button" class="clsVerify" value="Verified" /> <span> <!--<img class="callout" src="src/callout_black.gif" />--> <strong>User Verified By Lalbook</strong></span></a> 

<?php } ?>
<?php if($verify==0)
{
?>
<a href="#" class="tooltip"><input type="button" class="clsVerify" value="Not Verified" /><span>
<!-- <img class="callout" src="src/callout_black.gif" />--> <strong>User Not Verified By Lalbook</strong></span></a>
<?php } ?></span></p>
                         <p><label>Location		</label>:	<?php echo ucwords($userdetails->state);?>,<?php echo $userdetails->country_symbol;?></p>
                         <p><label>Member Since	</label>:	<!--March, 2013--><?php echo date('d-m-Y', strtotime($userdetails->created));?></p>
						   
</div>
                      </div>
                                            
                      </div>
					  <div class="list_id" id="tabs">
                      <div class="clsSideTab">
							  <ul class="clearfix" style="left:0; width:186px">
                      <li><a href="#tabs-1" id="tabs1">My Profile</a></li>
                      <li><a href="#tabs-2" id="tabs2">Gallery View</a></li>
                      <li><a href="#tabs-3" id="tabs3">Review & Rating</a></li>
					  
                      </ul>
                      </div>
					  <div id="tabs-1">
                      <div class="clsProfileLeft">
                      
<div class="clsCompantDetails"> 
<?php  
								//Show Flash Error Message
							
								
									
									
								 								  
								  
								  ?>
								  <div id="changeprofile">
								  <h3>Change Your Profile Picture:</h3>
								  <form name="myprof" enctype="multipart/form-data" action="<?php echo site_url('account/updateuserpicture/');?>" method="post">
								  <p id="prof" style=" margin: 0 0 12px !important;"><label>Change your image</label> <input style="margin: 0 0 5px 10px" type="file" name="profilepic" /><!--<span> <a href="#" id="hideprof"><img src="<?php echo image_url();?>/minus.png" alt="" /></a></span>--><br /><small style="color:#999;padding:5px 0 5px 140px;" ><?php echo "PNG|JPEG|GIF"; ?></small></p>
								  <p style="margin:0 !important;"><label style="width:145px;">&nbsp;</label><?php  if($msg = $this->session->flashdata('flash_message'))
								  { echo $msg; }?> 
								  <?php 
								  if($msg = $this->session->flashdata('flash_message'))
								  {
								  ?>
								  
								  <input type="hidden" value='1' id="errid" />
								  <?php } ?>
								  </p>
								  <p><label style="width:147px;">&nbsp;</label><input type="submit" class="clsCommonbut" value="Submit" name="editmyPicture"/></p>
								  </form>
								  </div>
<!--<form name="profile" enctype="multipart/form-data" action="<?php //echo site_url('account/updateuserprofile/'.$userdetails->activation_key) ;  ?>" method="post">-->


<?php if($this->session->userdata('profile_mode') != 'view') : ?>
<?php //if(0): ?>
<form name="profile" id="profileIDup" enctype="multipart/form-data" action="<?php echo site_url('account/updateuserprofile/') ;  ?>" method="post">
<div id="onupload">
<h3>Company Details</h3>

		<p>
		<label>Company Name  </label> 
			<input type="text" class="clsCTxt validate[required]"  value="<?php echo $userdetails->organisation;?>" name="companyname" />
		</p>
		<p style="margin:0 !important;">
			<label style="width:145px;">&nbsp;</label>
			<?php echo form_error('companyname'); ?>
		</p>

		<p>
		<label>Address </label>
			<textarea class="validate[required]" cols="35" rows="7" name="adrs" ><?php echo $userdetails->address;?></textarea>
		</p>
		<p style="margin:0 !important;">
			<label style="width:145px;">&nbsp;</label>
			<?php echo form_error('adrs'); ?>
		</p>

<?php 
	
	if(!empty($userdetails->phone)){
		$phc = 0;
        if(is_array($userdetails->phone)) {
            $user_landline = $userdetails->phone;
        }
        else {
            $user_landline = explode(',', $userdetails->phone);
        }
		foreach($user_landline as $ph){
	?>
		<p class="cloneone"><label>Landline  </label>
		<input type="text" class="clsCTxt validate[required]" value="<?php echo $ph;?>" name="landline[]" />&nbsp;<span>
		<a href="#" class="addone" rel=".cloneone"><img src="<?php echo image_url();?>/plus_icon.png" alt="" />
		</a>
		</span>
		<?php 
			if($phc!=0){
		?>
		<a onclick="$(this).parent().slideUp(function(){ $(this).remove() }); return false" href="#" class="remove">
		<img src="<?php echo image_url();?>/minus.png" alt="" />
		</a>
		
		<?php 
		}
		?>
	</p>
	<p style="margin:0 !important;">
		<label style="width:145px;">&nbsp;</label>
		<?php echo form_error('landline[]'); ?>
	</p>
	
	<?php
		$phc++;
		}
	}else{
	
	?>	
	<p class="cloneone"><label>Landline  </label>
		<input type="text" class="clsCTxt validate[required]" value="<?php echo $userdetails->phone;?>" name="landline[]" />&nbsp;<span>
		<a href="#" class="addone" rel=".cloneone"><img src="<?php echo image_url();?>/plus_icon.png" alt="" />
		</a>
		
		</span>	
	
	</p>
	<p style="margin:0 !important;">
		<label style="width:145px;">&nbsp;</label>
		<?php echo form_error('landline[]'); ?>
	</p>
	<?php
	}
	
	?>


	
	<?php 
	
	if(!empty($userdetails->mobile)){
		$mbc =0;
        if(is_array($userdetails->mobile)) {
            $user_mobile = $userdetails->mobile;
        }
        else {
            $user_mobile = explode(',', $userdetails->mobile);
        }
		foreach($user_mobile as $mb){
		
	?>
	<p class="clone">
		<label>Mobile No.  </label> 
		<input type="text" class="clsCTxt validate[required]" value="<?php echo $mb;?>" name="mobile[]"/>
		<span>&nbsp;<a href="#" class="add" rel=".clone">
		<img src="<?php echo image_url();?>/plus_icon.png" alt="" />
		</a>
		
		</span>
		<?php 
			if($mbc!=0){
		?>
		<a onclick="$(this).parent().slideUp(function(){ $(this).remove() }); return false" href="#" class="remove">
		<img src="<?php echo image_url();?>/minus.png" alt="" />
		</a>
		
		<?php 
		}
		?>
	</p>
	<p style="margin:0 !important;">
		<label style="width:145px;">&nbsp;</label>
		<?php echo form_error('mobile[]'); ?>
	</p>
	
	<?php
		
		$mbc++;
	
		}
	}else{
	
	?>
		<p class="clone">
		<label>Mobile No.  </label> 
		<input type="text" class="clsCTxt validate[required]" value="<?php echo $userdetails->mobile;?>" name="mobile[]"/>
		<span>&nbsp;<a href="#" class="add" rel=".clone">
		<img src="<?php echo image_url();?>/plus_icon.png" alt="" />
		</a>
		
		
		</span>
	</p>
	<p style="margin:0 !important;">
		<label style="width:145px;">&nbsp;</label>
		<?php echo form_error('mobile[]'); ?>
	</p>
	<?php
	}
	
	?>

		<?php ########################   Business Type  start ################# ?>

		<p><label>Business Type </label> 
			<select name="bstype" onChange='get_cities(this.value)'>
			<option value="1" <?php $btype=$userdetails->business_type; if($btype==1) {echo "selected";}?>>Product</option>
			<option value="2" <?php if($btype==2) { echo "selected";}?>>Service</option>
			<option value="3" <?php if($btype==3) { echo "selected";}?>>Both</option>
			</select>
		</p>
		<p style="margin:0 !important;">
		<label style="width:145px;">&nbsp;</label><?php echo form_error('bstype'); ?>
		</p>
	
		<?php ########################   Business Type  End ################# ?>
		<?php //pr($userdetails);?>
		
		<?php ########################  Industry  start ################# ?>
		<p><label>Industry</label> 
		<select name="indsutry" id="industry" class="validate[required]">
		<?php echo $userdetails->industry_type; ?>
        <option value="">Select industry</option></select>
        <input type="hidden" id="indtype" value="<?php echo $userdetails->industry_type?>" />
		</p>
		<p style="margin:0 !important;"><label style="width:145px;">&nbsp;</label>
		<?php echo form_error('indsutry'); ?></p>
		<?php ########################  Industry  End ################# ?>
		
		
		
		<?php ########################  Website  Start ################# ?>
		<p>
			<label>Website </label> 
			<input type="text" class="clsCTxt validate[required]" value="<?php echo $userdetails->website;?>" name="webs"/>
		</p>
			<small style="color:#999; padding: 0 0 0 140px;" >Example: http://example.com/</small>
		<p style="margin:0 !important;">
			<label style="width:145px;">&nbsp;</label><?php echo form_error('webs'); ?>
		</p>
		<?php ########################  Website  End ################# ?>
		
		
		
		<?php ########################  About US  Start ################# ?>
		<p>
			<label>About US  </label>
			<textarea cols="36" rows="7" name="about" class="validate[required]" ><?php echo $userdetails->aboutus;?></textarea>
		</p>
		<p style="margin:0 !important;">
				<label style="width:145px;">&nbsp;</label><?php echo form_error('about'); ?>
		</p>
		<?php ########################  About US  End ################# ?>
		
		
		
		<?php ########################  Quick Summary  Start ################# ?>

		<p>
			<label>Quick Summary  </label>
			<textarea cols="36" rows="7" name="summary" class="validate[required]" >
			<?php echo $userdetails->summary;?></textarea>
		</p>
		<p style="margin:0 !important;">
			<label style="width:145px;">&nbsp;</label>
			<?php echo form_error('about'); ?>
		</p>
	<?php ########################  Quick Summary  End ################# ?>
		
		
		<p>
			<label style="width:147px;">&nbsp;</label>
            <input type="submit" class="clsCommonbut" value="Submit" name="editmyProfile"/>
            <input type="submit" class="clsCommonbut" value="Cancel" name="cancel"/>
		</p>

</div>

</form>

<?php else: ?>
<div id="view-details">
<h3>Company Details</h3>

		<p>
		<label>Company Name  </label> 
		<label><?php echo $userdetails->organisation?>  </label> 
            </p>
		<p style="margin:0 !important;">
			<label style="width:145px;">&nbsp;</label>
					</p>

		<p>
		<label>Address </label>
		<label><?php echo $userdetails->address?> </label>
		</p>
		<p style="margin:0 !important;">
			<label style="width:145px;">&nbsp;</label>
					</p>

        <?php
        if(!empty($userdetails->phone)){
            $phc = 0;
            if(is_array($userdetails->phone)) {
                $user_landline = $userdetails->phone;
            }
            else {
                $user_landline = explode(',', $userdetails->phone);
            }
        }
        ?>
        <?php if(isset($user_landline)): ?>
        <?php foreach($user_landline as $ph): ?>
		<p class="cloneone"><label>Landline  </label>
        <label><?php echo $ph ?></label>
        <p style="margin:0 !important;">
            <label style="width:145px;">&nbsp;</label>
        </p>

        <?php endforeach; ?>
        <?php endif; ?>
        </p>

        <?php
        if(!empty($userdetails->mobile)){
            $mbc =0;
            if(is_array($userdetails->mobile)) {
                $user_mobile = $userdetails->mobile;
            }
            else {
                $user_mobile = explode(',', $userdetails->mobile);
            }
        }
        ?>
        <?php if(isset($user_mobile)): ?>
        <?php foreach($user_mobile as $ph): ?>
            <p style="margin:0 !important;">
                <label style="width:145px;">&nbsp;</label>
			</p>
			<p class="clone">
            <label>Mobile No.  </label> 
            <label><?php echo $ph?></label> 
        </p>
        
        <?php endforeach; ?>
        <?php endif; ?>

	<p style="margin:0 !important;">
		<label style="width:145px;">&nbsp;</label>
			</p>
	
	
		
		<p><label>Business Type </label> 
            <label><?php if($userdetails->business_type == 1) echo 'Product';
                        else if($userdetails->business_type == 2) echo 'Service'; 
                        else if($userdetails->business_type == 3) echo 'Both'; ?>
            </label>
		</p>
		<p style="margin:0 !important;">
		<label style="width:145px;">&nbsp;</label>		</p>
	
						
        <p><label>Industry</label> 
            <label><?php if(!empty($userdetails->industry_type)) echo $this->account_model->getIndustry($userdetails->industry_type)?></label>
		
		<p style="margin:0 !important;"><label style="width:145px;">&nbsp;</label>
		</p>
				<p>
			<label>Website </label> 
			<label><?php echo $userdetails->website?> </label> 
		</p>
		<p style="margin:0 !important;">
			<label style="width:145px;">&nbsp;</label>		</p>
				<p>
			<label>About US  </label>
			<label><?php echo $userdetails->aboutus?></label>
		</p>
		<p style="margin:0 !important;">
				<label style="width:145px;">&nbsp;</label>		</p>
		<p>
			<label>Quick Summary  </label>
			<label><?php echo $userdetails->summary?></label>
		</p>
		<p style="margin:0 !important;">
			<label style="width:145px;">&nbsp;</label>
					</p>
		<p>
            <form id="load-edit-view" action="<?php echo base_url()?>index.php/account/editProfile" method="post">
                <input type="submit" class="clsCommonbut" value="Edit Details" name="editmyProfile"/>
            </form>
		</p>

</div>
<?php endif; ?>





<!--<p><label>&nbsp;</label><input type="button" class="clsCommonbut" value="Submit" /></p>-->


<?php } }
											?>

</div>


</div>
</div>
<div id="tabs-2">
<div id="selMainCnt" class="clearfix">
                     <?php if(isset($products) && $products->num_rows()>0)
						 {
						
						  foreach($products->result() as $getproduct)
						    {
							$primage=$getproduct->gal_image;
							$prdid=$getproduct->id;
							$desc=$getproduct->description;
							}
							
							?>
                      
                      
                      <div class="clsGalleryList ">
                      <h2>Products & Services<span><ul ><li><a href="#" id="gallery">Add Products</a></li></ul></span></h2>
                      <div class="clsProfileRight" id="infoDiv" >
                      <!--<p>Lorem ipsum is a sample text.Lorem ipsum is a sample text.Lorem ipsum is a sample text.</p>
                      <p><b>Price : Rs.76</b></p>-->
					 <p> <b style="color:#333;">Price : </b><?php echo $getproduct->price;?></p>
					 <p><b style="color:#333;"> Description :</b></p>
                     <p> <?php echo $desc;?></p>
					  <p style="text-align:center;color:#333;"><b>Product</b></p>
                      <p style="text-align:center;"> <img src="<?php echo base_url();?>uploads/<?php echo $primage;?>" alt="" class="trigger"  height="100" width="100" /></p>
					  
                      </div>
					  <div class="demo">
                      <ul class="enlarge gallery" id="proimg">
					  
					  <?php  if(isset($products) && $products->num_rows()>0)
						 {
						
						  foreach($products->result() as $getproduct)
						    {
							$primage=$getproduct->gal_image;
							$prdid=$getproduct->id;
							$desc=$getproduct->description;
							?>
					 <li><!--<img src="<?php echo base_url();?>uploads/<?php echo $primage;?>" alt="" class="trigger" height="100px" width="150px"/><span>-->
					 <a href="#" class="showInfo Link1" onmouseover="moveMouse('<?php echo $getproduct->price;?>','<?php echo $desc;?>','<?php echo $primage;?>');"> <img src="<?php echo base_url();?>uploads/<?php echo $primage;?>" alt="" class="trigger"  height="100px" width="150px" /></a>
	<!--<br /><?php echo $getproduct->description;?>
	<br/>Price :Rs.  <?php echo $getproduct->price;?></span>--></li>
                      <li>
					 <!-- <div class="bubbleInfo">--><!--<a href="<?php echo base_url();?>uploads/<?php echo $primage;?>" class="preview" title="<?php echo $getproduct->description;?>  Rs. <?php echo $getproduct->price;?>"><img src="<?php echo base_url();?>uploads/<?php echo $primage;?>" alt="" class="trigger"/></a>-->
					 <!-- <table style="opacity: 0; top: -110px; left: -33px; display: none; background-color:#FFFFFF" id="dpop" class="popup">
        	<tbody><tr>
        		<td id="topleft" class="corner"></td>
        		<td class="top"></td>
        		<td id="topright" class="corner"></td>
        	</tr>

        	<tr>
        		<td class="left"></td>
        		<td><table class="popup-contents">
        			<tbody><tr>
        				<th>Price:</th>
        				<td><?php echo $getproduct->price;?></td>
        			</tr>
        						
        			<tr id="release-notes">
        				<th>Description:</th>
        				<td><?php echo $getproduct->description;?></td>
        			</tr>
        		</tbody></table>

        		</td>
        		<td class="right"></td>    
        	</tr>

        	<tr>
        		<td class="corner" id="bottomleft"></td>
        		<td class="bottom"><!--<img alt="popup tail" src="<?php echo image_url();?>/bubble-tail2.png" height="29" width="30">--></td>
        	<!--	<td id="bottomright" class="corner"></td>
        	</tr>
        </tbody></table>-->
    <!-- your information content -->
	
  
<!--</div>--></li>
					   
					 
					  <?php } ?>
					  
					 <?php  }
					  ?>
					 
                      <!-- <li><img src="<?php echo image_url();?>/g_2.jpg" alt="" /></li>
                        <li><img src="<?php echo image_url();?>/g_3.jpg" alt="" /></li>
                        <li><img src="<?php echo image_url();?>/g_1.jpg" alt="" /></li>
                       <li><img src="<?php echo image_url();?>/g_2.jpg" alt="" /></li>
                        <li class="clsNoMargin"><img src="<?php echo image_url();?>/g_3.jpg" alt="" /></li> 
                        
                        <li><img src="<?php echo image_url();?>/g_1.jpg" alt="" /></li>                        
                       <li><img src="<?php echo image_url();?>/g_2.jpg" alt="" /></li>
                        <li><img src="<?php echo image_url();?>/g_3.jpg" alt="" /></li>
                        <li><img src="<?php echo image_url();?>/g_1.jpg" alt="" /></li>
                       <li><img src="<?php echo image_url();?>/g_2.jpg" alt="" /></li>
                        <li class="clsNoMargin"><img src="<?php echo image_url();?>/g_3.jpg" alt="" /></li> -->           
                      </ul>
					  </div>
                      </div>
                      <?php } else{  ?>
                       <h2>Products & Services<span><ul ><li><a href="#" id="gallery">Add Products</a></li></ul></span></h2>
                      <?php echo "No Products Added"; }?>
                      </div>
	</div><!--Tab end--><?php  if(isset($sellerfeeds) && $sellerfeeds->num_rows()>0)
						 {
						$i=0;
					//echo 	$loggedInUser->id;exit;
						  foreach($sellerfeeds->result() as $reviews)
						    {
							$jobname=$reviews->looking_for;
							$jobid=$reviews->job_id;
							}
							}
							?>
	<div id="tabs-3">
	<div id="selMainCnt"> 
                      <h2 style="border-bottom:1px dotted #555; font-size:16px;">Review and Rating</h2>
					<div class="clsRatinginfo clearfix">   <h2><?php //echo $jobname;?></h2>
                      <div class="clsRatingPrice">
                      
                      </div>
					  </div>
                      <ul class="clearfix"> 
					  <?php  if(isset($sellerfeeds) && $sellerfeeds->num_rows()>0)
						 {
						$i=0;
					//echo 	$loggedInUser->id;exit;
						  foreach($sellerfeeds->result() as $reviews)
						    {
							//print_r($reviews);
							$userid=$reviews->userid;
							$reviewerid=$reviews->reviewer_id;
							$jobid=$reviews->job_id;
							$ratingpoint=$reviews->rating;
							//echo $ratingpoint/5;
							if($i%2==0){
						$clsodd="clsOddReview";
						}else{
						$clsodd="clsEvenReview";
						}
							//print_r($reviews);
							?>
							
                      <li class="<?php echo $clsodd;?>">
                      <div class="clsRatinginfo clearfix">
					  <h2 ><?php echo $reviews->looking_for; 
					    $qrs = "SELECT * FROM bids WHERE user_id = '$userid'";
							//echo "SELECT COUNT(job_id) AS count FROM bids WHERE job_id = $jobidd";
 $querry = $this->db->query($qrs,array($reviews->job_id));
       $ncommenttss = $querry->result_array();
	   //print_r($query);exit;
	$blog_e->n_amount = $ncommenttss[0]['bid_amount'];?> &nbsp;&nbsp;Rs.<?php echo $reviews->awarded_amount; ?></h2>
                      <div class="clsRatingstar">
                      <p><img alt="" src="<?php echo image_url();?><?php echo $ratingpoint."yellow.png";?>"><?php echo $ratingpoint;?>/5</p>
                      </div>
                     
                      
                      </div>
                      <div class="clsReviewInfo clearfix">
					   
					   
					   
						
                      <div class="clsReviewImg">
                      <img src="<?php echo base_url();?>files/logos/<?php echo $reviews->logo;?>" alt="" width="100" height="100" />
                      </div>
                      <div class="clsReviewDesc">
                      <div class="clsLeftR">
                      <div class="clsRightR">
                      <div class="clsCenterR">
                     <ul class="clearfix">
                     <li class="clsActive"><a href="<?php if($loggedInUser->id==$userid){ echo site_url('account');} else { echo site_url('users/view/'.$userid);}?>"><?php echo $reviews->user_name;?> </a></li>
                      <li class="clsNoBorder"><!--<a href="#">  Flag</a>--></li>
                      </ul>
                      <p><?php echo $reviews->comments;?></p>
                      </div></div></div>
                     
                      </div>
                      
                      </div>
                      </li>

                      <?php $i++;  } } else{ echo "<p style='text-align:center'>"."No Ratings And Reviews"."</p>";}?>
                     
                      </div>
					  </div>  <!--tab-3-->
					  <!--Tab end-->
	
	<div id="tabs4" >
<div id="selMainCnt">
                      <h2>Add Products</h2>
                      <div id="previewid" align="center" >
</div>
                      <form name="products"  method="post" enctype="multipart/form-data" id="imageform" action='http://demo.maventricks.com/lalbook/application/views/ajaxupload.php'><input type="hidden" value="<?php if(isset($_REQUEST['id'])) echo $_REQUEST['id'];?>" id='errorid'/>
					  <p><label>Product Name:</label><input type="text" name="prname" value="" class="clsProdtxt"/></p>
					  <p><label>Upload Image:</label><div id="pimg"><input type="file" id="photoimg" name="photoimg"  /></div></p>
					  <p><label>Price:</label><input type="text" name="price" value="" class="clsProdtxt"/></p>
					  <input type="hidden" value="<?php echo $loggedInUser->id;?>" name="user"/>
					    <p><label>Description:</label><textarea name="desc" rows="5" cols="24"></textarea></p>
						<p><label>&nbsp;</label><input type="submit" class="clsCommonbut" value="Submit" name="submitproduct" onclick="reloadPage()"/></p>
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
                            <!--end of RC -->
    
    </div>
    
    </div>
	<?php $this->load->view('home_footer'); ?>
    
</body>
</html>
