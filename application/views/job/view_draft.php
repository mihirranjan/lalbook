<form name="gotopage" id="draftForm" method="post" action="<?php echo site_url('job/draftView'); ?>">
  <p><b><?php echo $this->lang->line('My Saved Jobs:');?></b>
    <select name="draftId" id="draftId"  onChange="javascript:submitDraft();">
      <option value="savedraft">-- Select a job to load a saved draft --</option>
      <?php 
		  foreach($draftJobs->result() as $draft)
		    { ?>
      <option value="<?php echo $draft->id; ?>" <?php if(isset($draftJobsid)) { if($draftJobsid == $draft->id) echo "selected"; } ?>><?php echo get_datetime($draft->created).' '.$draft->job_name; ?></option>
      <?php 
			} ?>
      <option value="clear">-- Clear form and create new job... --</option>
    </select>
	<input name="projectid1" value="<?php if(isset($draftJobsid)) echo $draftJobsid; ?>"type="hidden"/>
  </p>
</form>
<script type="text/javascript">
function submitDraft()
{
	if($('#draftId').value!='')
	{
		$('#draftForm').submit();
	}
}
</script>

