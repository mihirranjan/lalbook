<?php $this->load->view('header'); ?>
<div class="clsMinContent clearfix">
<?php $this->load->view('sidebar'); ?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){
$('#tabs div').hide();
$('#tabs div:first').show();
$('#tabs ul li:first').addClass('active');
$('#tabs ul li a').click(function(){ 
$('#tabs ul li').removeClass('active');
$(this).parent().addClass('active'); 
var currentTab = $(this).attr('href'); 
$('#tabs div').hide();
$(currentTab).show();
return false;
});
});
</script>
<style type="text/css">

.clsInnerCommon ul {
    overflow: none !important;
    padding:0 !important;
}

* {
	margin: 0;
	padding: 0;
}
#tabs {
/*	font-size: 90%;
	margin: 20px 0;*/
}
#tabs ul {
border-bottom:1px solid #ccc;
margin:0 20px;
/*	float: left;
	background: #fff;
	width: 500px;
	padding-top: 4px;*/
	overflow:hidden;
}
#tabs li {
	margin-right: 5px;
	list-style-type: none;
	padding:0;
	background:none;
}
* html #tabs li {
	display: inline;
}
#tabs li, #tabs li a {
	/*float: left;*/
}
#tabs ul li.active {
/*	border-top:2px #90C400 solid;
	background: #EFEFEF;
	border-left:1px solid #ccc;
	border-right:1px solid #ccc;*/
}
#tabs ul li.active a {
	color: #FFF;
}
#tabs div {
	/*background: #FFFFCC;
	clear: both;
	padding: 15px;
	min-height: 100px;*/
	float:left;
}
#tabs div h3 {
	margin-bottom: 12px;
}
#tabs div p {
	line-height: 150%;
}
#tabs ul li a {
	color: #FFF;
    font-size: 12px;
    font-weight: bold;
    line-height: 33px;
    padding: 0;
    text-align: center;
    text-decoration: none;
	text-transform:uppercase;
}
.thumbs {
	float:left;
	border:#000 solid 1px;
	margin-bottom:20px;
	margin-right:20px;
}
-->
</style>

<!--MAIN-->
<div id="main">
  <!--POST JOB-->
  <div class="clsInnerpageCommon">
     
                        <div class="clsInnerCommon">
                          <h2><?php echo $this->config->item('site_title'); ?> &nbsp;<?php echo $this->lang->line('Search Results'); ?></h2>
                          <h3><span class="clsViewPro"><?php echo $this->lang->line('Search Results'); ?></span></h3>
						   <div id="selSearchResult">
						   
						   <div class="clssLeft">
						  <div class="clssRight">
						  <div class="clssCen">
						  
						 <div id="tabs">
						 <ul>
						  <li><a href="#tab-1">Search Job</a> </li>
						  <li><a href="#tab-2">Search Employee</a></li>
						  </ul>
                         <div id="tab-1">
 						   <form method="get" action="" name="search">
						  <p><input type="text" class="clsST" name="keyword" value="<?php echo $keyword;?>" />
						  <select class="clsSD" name="category">
						  <option>Select a Category</option>
						  <?php
						  	$cat = $this->input->get('category');
						   	foreach($categories->result() as $category){ ?>
						    <option value="<?php echo $category->category_name;?>" <?php if($category->category_name==$cat)echo 'selected="selected"';?>><?php echo $category->category_name;?></option>
						   <?php }?>
 						  </select>
						  <input type="hidden" class="clsST" name="c" value="search" />
						  <input type="hidden" class="clsST" name="m" value="index" />
						  <input type="hidden" class="clsST" name="p" value="<?php echo $page; ?>" />
 						 <input type="submit" class="clsLogin_but" value="Search" /></p>
						  <p><label><?php echo $this->lang->line('Popular searches:');?></label>
						  
					    <?php
						if(isset($popular) and $popular->num_rows()>0)
						{  
							  foreach($popular->result() as $popular)
							  { ?>
								<a href="<?php echo base_url()."?category=&c=search&keyword=".urlencode($popular->keyword);?>"><?php echo $popular->keyword;?></a> 			                        <?php } 
						} ?>

						  </p>
						  </form>
						 
    </div>
   						 <div id="tab-2">
                          <form method="get" action="" name="search">
						  <p><input type="text" class="clsST" name="keyword" value="<?php echo $keyword;?>" />
						  <select class="clsSD" name="category">
						  <option>Select a Category</option>
						  <?php
						  	$cat = $this->input->get('category');
						   	foreach($categories->result() as $category){ ?>
						    <option value="<?php echo $category->id;?>" <?php if($category->category_name==$cat)echo 'selected="selected"';?>><?php echo $category->category_name;?></option>
						   <?php }?>
 						  </select>
						  <input type="hidden" class="clsST" name="p" value="<?php echo $page; ?>" />
						  <input type="hidden" class="clsST" name="c" value="search" />
						  <input type="hidden" class="clsST" name="m" value="employee" />
						 <input type="submit" class="clsLogin_but" value="Search" /></p>
						  <p><label><?php echo $this->lang->line('Popular searches:');?></label>
						  
					    <?php
						if(isset($popular_user) and $popular_user->num_rows()>0)
						{  
							  foreach($popular_user->result() as $popular_user)
							  { ?>
								<a href="<?php echo base_url()."?category=&c=search&m=employee&keyword=".urlencode($popular_user->keyword);?>"><?php echo $popular_user->keyword;?></a> 			                        <?php } 
						} ?>

						  </p>
						  </form>
                       </div>
  </div>
						 
						  </div></div></div>
						  </div> 
 						  <form>
                          <table cellspacing="1" cellpadding="7" width="98%">
                            <tbody>
                              <tr>
                                <td width="5%" class="dt"><?php echo $this->lang->line('SI.No');?></td>
                                <td width="15%" class="dt"><? 
						  $odr = 'ASC';
						  if($order == 'ASC')
						  $odr = 'DESC';
						  ?>
                                  <a style="color:#000;" href="<?php echo $base_url;?>&sort=<?php echo $odr;?>&field=job_name&p=<?php echo $page;?>"><?php echo $this->lang->line('Job Name'); ?></a> </td>
                                <?php if($this->session->userdata('show_cat'))
								  {
								  ?>
                                <td width="15%" class="dt"><?php echo $this->lang->line('Job Type'); ?></td>
                                <?php 
								  }
								  if($this->session->userdata('show_budget'))
								  {
								  ?>
                                <td width="10%" class="dt"><a style="color:#000;" href="<?php echo $base_url;?>&sort=<?php echo $odr;?>&field=budget_max&p=<?php echo $page;?>"><?php echo $this->lang->line('Budget'); ?></a> </td>
                                <?php
								  }
								  if($this->session->userdata('show_status'))
								  {
								  ?>
                                <td width="10%" class="dt"><?php echo $this->lang->line('Status'); ?></td>
                                <?php }
								   if($this->session->userdata('show_bids'))
								  {
								  ?>
                                <td width="13%" class="dt"><?php echo $this->lang->line('Bids'); ?></td>
                                <?php } 
								  if($this->session->userdata('show_avgbid'))
								  {
								  ?>
                                <td class="dt" width="15%"><?php echo $this->lang->line('Avg Bid'); ?></td>
                                <?php } 
								  if($this->session->userdata('show_date'))
								  {
								  ?>
                                <td class="dt" width="15%"><?php echo $this->lang->line('Start Date'); ?></td>
                                <?php } ?>
                              </tr>
                              <?php $i=0;
						 	if(isset($jobs) and $jobs->num_rows()>0)
							{
								foreach($jobs->result() as $job)
								{ 
								$i=$i+1;
								if($i%2 == 0)
								  $class = 'dt1 dt0';
								else
								  $class = 'dt2 dt0'; 
								?>
                              <tr class=" odd <?php echo $class; ?>">
                                <td><?php echo $i; ?>.</td>
                                <td><a href="<?php echo site_url('job/view/'.$job->id); ?>"> <?php echo highlight_phrase($job->job_name,$keyword,'<b>','</b>')?></a>
								 <?php if($job->is_urgent == 1) { ?>
								  &nbsp;<img src="<?php echo image_url('urgent.png');?>" width="20" height="20" title="Urgent job" alt="<?php echo $this->lang->line('Urgent Job'); ?>" />
								   <?php } 
								   if($job->is_feature == 1) { ?>
								    &nbsp;&nbsp;<img src="<?php echo image_url('featured.png');?>" width="20" height="20" title="Featured job" alt="<?php echo $this->lang->line('Featured Job'); ?>" />
								   <? } 
								    if($job->is_private == 1) { ?>
								    &nbsp;&nbsp;<img src="<?php echo image_url('private.png');?>" width="14" height="14" title="Private job" alt="<?php echo $this->lang->line('Private Job'); ?>" />
								  <?php } ?>
								</td>
                                <?php if($this->session->userdata('show_cat')):	?>
                                <td><?php echo getCategoryLinks($job->job_categories) ; ?> </td>
                                <?php endif;
								if($this->session->userdata('show_budget')):	?>
                                <td><?php echo  $currency.$job->budget_max;?></td>
                                <?php endif; 
								 if($this->session->userdata('show_status')):	?>
                                <td><?php 
								  echo getProjectStatus($job->job_status);?>
                                </td>
                                <?php endif; 
								 if($this->session->userdata('show_bids')):	?>
                                <td><?php echo getNumBid($job->id);?></td>
                                <?php endif;
								  if($this->session->userdata('show_avgbid')):	?>
                                <td><?php echo getBidsInfo($job->id); ?></td>
                                <?php endif; 
								  if($this->session->userdata('show_date')):	?>
                                <td><?php echo get_date($job->created);?></td>
                                <?php endif;?></tr>
                              <tr>
                                <td colspan="8"><?php if($this->session->userdata('show_desc')):	?>
                                  <div class="clsDecrip clsAdd">
                                    <?php $description = word_limiter($job->description,50);   echo highlight_phrase($description,$keyword,'<b>','</b>'); ?>
                                  </div></td>
                              </tr>
                                  <?php	endif;								
								}//Traverse Jobs
							}//Check For Job Availability
							else
							echo "<tr><td colspan=8 align=center><b>No records found</b></td></tr>";
							 ?>
                              <tr class="">
                                <td class="dt1 dt0" colspan="8"><table cellspacing="0" cellpadding="0" width="100%">
                                    <tbody>
                                      <tr>
                                        <td align="center"><?php echo $this->lang->line('Customize Display'); ?>:</td>
                                        <td><label>
                                          <input type="checkbox" value="1" <?php if($this->session->userdata('show_cat')) echo 'checked="checked"'; ?>  name="show_cat"/>
                                          <?php echo $this->lang->line('Type'); ?></label></td>
                                        <td><label>
                                          <input type="checkbox" value="1" <?php if($this->session->userdata('show_budget')) echo 'checked="checked"'; ?> name="show_budget"/>
                                          <?php echo $this->lang->line('Budget'); ?></label></td>
                                        <td><label>
                                          <input type="checkbox" value="1" <?php if($this->session->userdata('show_bids')) echo 'checked="checked"'; ?> name="show_bids"/>
                                          <?php echo $this->lang->line('Bids'); ?></label></td>
                                        <td><label>
                                          <input type="checkbox" value="1" <?php if($this->session->userdata('show_avgbid')) echo 'checked="checked"'; ?> name="show_avgbid"/>
                                          <?php echo $this->lang->line('Avg Bid'); ?></label></td>
                                        <td><label>
                                          <input type="checkbox" value="1" <?php if($this->session->userdata('show_status')) echo 'checked="checked"'; ?> name="show_status"/>
                                          <?php echo $this->lang->line('Status'); ?></label></td>
                                        <td><label>
                                          <input type="checkbox" value="1" <?php if($this->session->userdata('show_date')) echo 'checked="checked"'; ?> name="show_date"/>
                                          <?php echo $this->lang->line('Start Date'); ?></label></td>
                                        <td><label>
                                          <input type="checkbox" value="1" <?php if($this->session->userdata('show_desc')) echo 'checked="checked"'; ?> name="show_desc"/>
                                          <?php echo $this->lang->line('Description'); ?></label></td>
                                        <td><select name="show_num" size="1">
                                            <option value="5" <?php if($this->session->userdata('show_num') == 5) echo "selected";?>>5</option>
                                            <option value="10" <?php if($this->session->userdata('show_num') == 10) echo "selected";?>>10</option>
                                            <option value="20" <?php if($this->session->userdata('show_num') == 20) echo "selected";?>>20</option>
                                            <option value="50" <?php if($this->session->userdata('show_num') == 50) echo "selected";?>>50</option>
                                            <option value="100" <?php if($this->session->userdata('show_num') == 100) echo "selected";?>>100</option>
                                          </select>
                                          <?php echo $this->lang->line('Results'); ?>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table></td>
                              </tr>
                            </tbody>
                          </table>
						  <p style="padding-left:10px !important;"> 
						  <input type="submit" value="<?php echo $this->lang->line('Refresh'); ?>" class="clsLogin_but" name="customizeDisplay"/></p></form>
                          <!--PAGING-->
                          <?php if(isset($pagination)) echo $pagination; ?>
                          <!--END OF PAGING-->
                        </div>
                      </div>

  <!--END OF POST JOB-->
</div>
<!--END OF MAIN-->
</div></div>
<?php $this->load->view('footer'); ?>