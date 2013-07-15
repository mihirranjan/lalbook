<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/sidebar'); ?>

<style>
.clsSubmitBt1{
  margin: 0 7px 0;
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
                      
	
	 <div class="clsTop clsClearFixSub">
          <div class="clsNav">
        </div>
		<div class="clsTitle">
          <h3><?php echo $this->lang->line('Add Category'); ?></h3>
        </div>
      </div>
		    
   
      <form method="post" action="">
       <table class="table1" cellpadding="0" cellspacing="2" border="0">
          <tr>
            <td width="25%"><?php echo $this->lang->line('Category Type');?> </td>
            <td width="55%">:
			<select name="catetype">
			<option value="">Select Category Type</option>
			<option value="1">Products</option>
			<option value="2">Services</option>
			<!--<option value="3">Both</option>-->
			</select>
			
		  <tr>
            <td width="25%"><span id="valuen"><?php echo $this->lang->line('Category Name');?></span></td>
            <td width="55%">:
                <input name="category" type="text" class="textbox" id="email" value="">
				<?php echo form_error('category'); ?>
				</td>
          </tr>
		  
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr id="bansubmit" >
            <td></td>
            <td height="30" style="padding-left:6px;"><input name="addCategory" type="submit" class="clsSubmitBt1" value="<?php echo $this->lang->line('Submit');?>">
			<input type="hidden" name="categoryid" value="" />
			
			   <a href="#" onclick="history.go(-1);return false;"><input type="button" value="Back"  class="clsSubmitBt1"></a> 
            </td>
		<script type="text/javascript">
			function passwordchange()
			{
			document.getElementById('show1').style.display='block';
			document.getElementById('change').style.display='none';
			
			}
			function cancel()
			{
			document.getElementById('change').style.display='block';
			document.getElementById('show1').style.display='none';
			
			}
		</script>
          </tr>
        </table>
      </form>
	
	 </div></div></div></div></div></div></div></div> </div></div>     
	  
	  
    </div>
  </div>
</div>
<?php $this->load->view('admin/footer'); ?>