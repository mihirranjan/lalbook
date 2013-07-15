<div class="Container">
<?php $this->load->view('header'); ?>
<div class="clsMinContent clearfix">
<?php //$this->load->view('sidebar'); ?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"> </script>
<?php
		//Get JOB Info
     	$project = $projects->row();
		//pr($userList);
//		pr($previewMessages);
		//echo $previewMessages['to_id'];
		//foreach($previewMessages as $res)
	 	 // echo $res;
		//echo count($previewMessages)
		//$msg = $previewMessages->row(); 
?>
<!--MAIN-->
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

<div class="clsMinContent clearfix">
<?php //$this->load->view('sidebar'); ?>
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
								<!--JOB MESSAGE BOARD--> 
									  <div id="selPMB" class="clsMarginTop">
									
									 <!--<p class="clsSitelinks"><?php echo $this->lang->line('You are currently logged in as');?> <a class="glow" href="<?php if($loggedInUser->role_id == '1') $res = 'owner'; else $res = 'employee'; echo site_url($res.'/viewprofile/'.$loggedInUser->id); ?>"><?php if(isset($loggedInUser) and is_object($loggedInUser))  echo $loggedInUser->user_name;?></a> (<a href="<?php echo site_url('users/logout'); ?>"><?php echo $this->lang->line('Logout') ?></a>).
								</p>-->
								<br />
								 
								<?php
								//Check the condition for the messages are saved or not
								if(isset($previewMessages))
								 { 
								   if(count($previewMessages) != '0')
									 {
								 ?>
								<!-- Preview Mail start Here -->

  
						  <h3><span class="clsPMB"><?php echo $this->lang->line('Preview Message');?></span></h3>
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

                             
						    <p><label><?php echo $this->lang->line('From'); ?></label><?php if(isset($loggedInUser) and is_object($loggedInUser))  echo $loggedInUser->user_name;?></p>
						   
						    <p><label><?php echo $this->lang->line('To'); ?> </label> <?php $i=0; foreach($userList as $user) { if($user->id == $previewMessages['to_id']) { $i=1; echo $user->user_name; break; } } if($i == '0') echo 'All User [ Public Message ]'?> </p>
						  
						  					  
						  <p><label><?php echo $this->lang->line('Message'); ?></b></label><?php echo $previewMessages['message']; ?></p>
						  <p><label><?php echo $this->lang->line('Date'); ?></b></label><?php $date = $previewMessages['created']; echo get_date($date); ?></p>
						   <?php } ?>
						 


<!-- Preview mail end here -->
    <?php 

  } 
}
?>

                         <!-- <h3><span class="clsOptContact"><?php echo $this->lang->line('Post Message'); ?></span></h3>-->
							<?php 
							if($msg = $this->session->flashdata('flash_message'))
								{
								  echo $msg;
								}?>
							
							<form method="post" action="<?php echo site_url('messages/createMessage'); ?>" >
					  	   
								<p>
                                    <label><?php echo $this->lang->line('From'); ?>:</label>
                                    <?php if(isset($loggedInUser) and is_object($loggedInUser))  echo $loggedInUser->user_name;?>
                                </p>
								<?php 
                                if($loggedInUser->role_id == '1')
								{ 
                                ?>
                                    <p><label><?php echo $this->lang->line('Job Name'); ?> :</label>
                                    <select id="job" name="job" onchange="javascript:load_user(this.value);">
                                        <option value=""><?php echo '-- '.$this->lang->line('Select Job').' --'; ?></option>
                                        <?php 
                                        foreach($wonProjects as $res)
										{ ?>
                                                <option value="<?php echo $res->id; ?>" > <?php echo $res->looking_for; ?></option> 
                                          <?php
                                        } ?>
                                     </select>
                                     <?php echo form_error('job'); ?></p>
                                     <p>
                                        <label><?php echo $this->lang->line('To');?>:</label>
                                        <b id="prog_id"> 
                                        <select id="to" name="to"><option value=""><?php echo '-- '.$this->lang->line('Select Employee').' --'; ?></option>
                                            <option value="0"><?php echo $this->lang->line('Everyone'); ?></option>
                                        </select>
                                        </b>
                                        <?php echo form_error('to'); ?>
                                     </p>
                                <?php 
                                } 
                                else { 
                                ?>
                                    <p><label><?php echo $this->lang->line('Job Name'); ?> :</label>
								  <select id="to" name="to" onchange="javascript:load_users(this.value);">
									  <option value=""><?php echo '-- '.$this->lang->line('Select Job').' --'; ?></option>
									  <?php 
									 
									  foreach($wonProjects as $res)
										{ 
 										  if($loggedInUser->role_id == '1')
											{
											  if($res->creator_id == $loggedInUser->id)
												{ ?>
												  <option value="<?php echo $res->id; ?>" > <?php echo $res->job_name; ?></option> 
												  <?php 	
												}	
											}
 										  /*if($loggedInUser->role_id == '2')
											{
											  if($res->employee_id == $loggedInUser->id)
												{ ?>
												 <option value="<?php echo $res->id; ?>" > <?php echo $res->job_name; ?></option> <?php 	
												}	
											}	*/
									  }	//foreah end here  ?>
								 </select><?php echo form_error('to'); ?></p>
								 <p><label><?php echo $this->lang->line('To');?>:</label>
								 <b id="prog_id"> <select id="users_load" name="users_load"><option value=""><?php echo '-- '.$this->lang->line('Select Owner').' --'; ?></option>
								 </select></b><?php echo form_error('prog_id'); ?></p>
									  <?php }?>
							  <div id="projectName" name="projectName" style="display:none; color:red;">
									<?php echo $this->lang->line('Select Job'); ?>
								</div>
								<p><label><?php echo $this->lang->line('Message'); ?>:</label><textarea rows="10" name="message" cols="60"><?php echo set_value('message'); ?></textarea>
	                             </p>
							<p><label>&nbsp;</label><small><?php echo $this->lang->line('Tip');?></small></p>
							<p><label>&nbsp;</label><?php echo form_error('message'); ?></p>							
							<p><input class="clsRefresh_but" type="submit" value="<?php echo $this->lang->line('Submit');?>" name="postMessage"/>
	                           <input  class="clsRefresh_but" type="submit" value="<?php echo $this->lang->line('Preview');?>" name="previewMessage"/></p>
							</form>
						   
          </div>
        </div>
      </div>

    </div>
    <!--END OF POST JOB-->
 <script type="text/javascript">
<!-- Function used to load the corresponding users to make transfer for corresponding job
// Argument                   --     Nil
//Return value                --     Employeename or ownername -->
function load_user(value)
{
  var utype = value;
 //alert(utype);
  //var utype = document.getElementById('type_id').value

   if(utype>0)
  {
	/*  new Ajax.Request('<?php echo base_url().'index.php/users/load_users1';?>'+'/'+utype,
	  {
		method:'post',
		onSuccess: function(transport){
		  var response = transport.responseText || "no response text";
		  if(response!="no response text")
			//response='<select name="users_load" id="users_load" class="clsListBox">'+response+'</select>';
		  document.getElementById('prog_id').innerHTML = response;
		},
		onFailure: function(){ alert('Something went wrong ...') }
	  });*/
	  
	
	  $.ajax({
	  method:"POST",
   url:'<?php echo base_url().'index.php/users/load_users1';?>'+'/'+utype,
   
   success:function(response) {
     $("#prog_id").html(response);
   }
});
	  }
	else
	{
		document.getElementById('placer').innerHTML='<select name="users_load" id="users_load"><option value="0"><?php echo $this->lang->line('Everyone'); ?></option></select>';
		
	}
} //Function load_user end


function load_users(value)
{
   var utype = value;
   //alert(utype);
  //var utype = document.getElementById('type_id').value

   if(utype>0)
  {
	  new Ajax.Request('<?php echo base_url().'index.php/users/load_users2';?>'+'/'+utype,
	  {
		method:'post',
		onSuccess: function(transport){
		  var response = transport.responseText || "no response text";
		  if(response!="no response text")
			//response='<select name="users_load" id="users_load" class="clsListBox">'+response+'</select>';
		  document.getElementById('to').innerHTML = response;
		},
		onFailure: function(){ alert('Something went wrong ...') }
	  });
	  }
	else
	{
		document.getElementById('placer').innerHTML='<select name="users_load" id="users_load"><option value="0"><?php echo $this->lang->line('Everyone'); ?></option></select>';
		
	}

} //Function load_user end
</script>


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
</div>
</div>
</div>
<!--END OF MAIN-->
<?php $this->load->view('home_footer'); ?>
