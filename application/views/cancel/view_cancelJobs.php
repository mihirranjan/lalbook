<?php $this->load->view('header'); ?>
<div class="clsMinContent clearfix">
<?php $this->load->view('sidebar'); ?>

<div id="main">
<?php
//Show Flash Message
if($msg = $this->session->flashdata('flash_message'))
{
	echo $msg;
}
?>
<!--SIGN-UP-->
<div id="selSignUp">
  <div class="clsPostProject">

                        <div class="clsInnerCommon">
						<h2><?php echo $this->lang->line('Cancel Job');?></h2>
                          <div class="clsHeads clearfix">
						  <div class="clsHeadingRight clsFloatRight">
                               <span class="clsPostProject"> <a href="<?php echo site_url('cancel/viewOpenCases');?>" class="buttonBlack"><span><?php echo $this->lang->line("view open cases");?></span></a></span>
                            </div>
                            <div class="clsHeadingLeft">
                              <h3><span class="clsOptDetial"><?php echo $this->lang->line("Select the Job");?></span></h3>
                            </div>
                            
                          </div>
                          <form method="post">
                            
                            <p>
                              <select name="project_id">
							  <option value="">--Select--</option>
                                <?php foreach($jobs->result() as $job){?>
                                <option value="<?php echo $job->id;?>"><?php echo $job->job_name;?></option>
                                <?php } ?>
                              </select>
                            </p>
                            <p>
                              <input type="submit" name="submit" value="<?php echo $this->lang->line('Submit');?>" class="clsLogin_but" >
                            </p>
                          </form>
                        </div>
                        <!--SIGN-UP-->
                      </div>
                    </div>
					</div>
					</div></div>

<!--END OF MAIN-->
<?php $this->load->view('footer'); ?>