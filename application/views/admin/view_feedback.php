<?php $this->load->view('admin/header');?>


<?php $this->load->view('admin/sidebar');?>

Feedback/Contact Us

<div id="feedback">

<form name="feedbackform" action="" method="post">

<p><label>Name</label><input type="text" name="aName" value="" /></p>
<?php echo form_error('aName');?>

<p><label>Admin Email Address</label><input type="text" name="email" value="" /></p>
<?php echo form_error('email');?>

<p><label>Subject</label><textarea name="subject"></textarea></p>
<?php echo form_error('subject');?>


<p><label>Content</label><textarea name="content"></textarea></p>
<?php echo form_error('content');?>

<p><label>Send Email to</label><textarea name="emailids"></textarea></p>
<?php echo form_error('emailids');?>


<p><label></label><input type="submit" value="Send" name="sendEmail" class="clsSubmitBt1" /></p>
</form>

</div>


<?php $this->load->view('admin/footer');?>