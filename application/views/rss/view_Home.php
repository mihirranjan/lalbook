<?php $this->load->view('header'); ?>
<div class="clsMinContent clearfix">
<?php $this->load->view('sidebar'); ?>
<link href="<?php echo base_url() ?>application/css/css/rssfeed.css" rel="stylesheet" type="text/css" />
<style>
.clsList  li{
	float:left;
	width:150px;
	margin:0 10px 0 0;
}
</style>
<!--MAIN-->
<div id="main">
      <!--POST JOB-->
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
      
      <div class="clsRssFeed">
        
                            <div class="clsInnerCommon">
                              <h2><?php echo $this->config->item('site_title'); ?> <?php echo $this->lang->line('rss_feeds'); ?></h2>
                              <div style="padding-left:0;"><?php echo $this->lang->line('We_have several RSS feeds available to keep you up to date on the newest jobs posted on'); ?> <?php echo $this->config->item('site_title'); ?>. <?php echo $this->lang->line('Click any links below to see an RSS feed, or use the form below to create your custom feed'); ?>.</div>
                              <h3><span class="clsViewPro"><?php echo $this->lang->line('Jobs Feed'); ?></span></h3>
                              <table cellspacing=1 cellpadding=2 width=96% class="clsTable">
                                <tr>
                                  <td class=dt width="200"><?php echo $this->lang->line('Feed Content'); ?></td>
                                  <td class=dt width="250"><?php echo $this->lang->line('Titles'); ?></td>
                                  <td class=dt width="250"><?php echo $this->lang->line('Titles + Description'); ?></td>
                                </tr>
                                <tr class="">
                                  <td class="dt1 dt0"><a style="color:#000;" href="<?php echo site_url('?c=rss&amp;m=all') ?>"><?php echo $this->lang->line('All Jobs'); ?></a> </td>
                                  <td class=dt1><a style="color:#000;" href="<?php echo site_url('?c=rss&amp;m=all') ?>"><?php echo site_url('?c=rss&amp;m=all') ?></a></td>
                                  <td class=dt1><a style="color:#000;" href="<?php echo site_url('?c=rss&amp;m=all&amp;type=2') ?>"><?php echo site_url('?c=rss&amp;m=all&amp;type=2') ?></a></td>
                                </tr>
								
								 <?php
							if(isset($categories) and $categories->num_rows()>0)
							{
								$i=1;
								foreach($categories->result() as $category)
								{   
								  if($i%2 == 0)
								    $class ="dt1";
								  else
								    $class ="dt2";	
									?>
								
                                <tr class="odd">
                                  <td class="<?php echo $class; ?> dt0"><a style="color:#000;" href="<?php echo site_url('?c=rss&amp;m=show&amp;cat='.$category->id); ?>"><?php echo $category->category_name; ?></a></td>
                                  <td class="<?php echo $class; ?>"><a style="color:#000;" href="<?php echo site_url('?c=rss&amp;m=show&amp;cat='.$category->id); ?>"><?php echo site_url('?c=rss&amp;m=show&amp;cat='.$category->id); ?></a></td>
                                  <td class="<?php echo $class; ?>"><a style="color:#000;" href="<?php echo site_url('?c=rss&amp;m=show&amp;type=2&amp;cat='.$category->id); ?>"><?php echo site_url('?c=rss&amp;m=show&amp;type=2&amp;cat='.$category->id); ?></a></td>
                                </tr>
								<?php
								$i++;
								}//For Each End - Categories Traversal
							}//If End	- Check For Categories Availability
						  ?>
                                
                              </table>
							  <div class="clsSitelinks"> 
                              <h3><span class="clsResend"><?php echo $this->lang->line('Custom RSS Feed');?></span></h3>
							  <form method="get" action="">
                              <p><?php echo $this->lang->line('Create');?></p>
                              <ul>
                                <li>
                                  <h5><?php echo $this->lang->line('No of jobs to display:');?><span>
                                    <input type="text" class="text" name="show" value="10" size="5"/>
                                  </span></h5>
                                  
                                </li>
                                <li>
                                  <h5><?php echo $this->lang->line('Info to display:');?>
                                  <span><SELECT NAME="des" class="clsOption">
									<OPTION selected VALUE="1">Jobs titles only</OPTION>
									<OPTION VALUE="2">Titles and descriptions</OPTION>
									<OPTION VALUE="3">Titles and full descriptions</OPTION>
								  </select></span></h5>
                                </li>
                                <li>
                                  <h5><?php echo $this->lang->line('Categories');?></h5>
                                  
                                  <ul class="clsList">
								  <?php
									if(isset($categories) and $categories->num_rows()>0)
									{
										foreach($categories->result() as $category)
										{
											  ?>
											<li>
											  <label>
											  <input name="category[]" value="<?php echo $category->id; ?>" type="checkbox"/>
											  <?php echo $category->category_name; ?></label>
											</li>
														   
											<?php
										}//For Each End - Categories Traversal
									}//If End	- Check For Categories Availability
								?>               
                                  </ul>
                                  <br />
                                </li>
                                
                              </ul>
                              <p>
                                <input type="checkbox" value="1" name="f"/>
                                <?php echo $this->lang->line('Only');?> <a href="<?php echo site_url('job/viewAllJobs/is_feature');?>"><?php echo $this->lang->line('Featured');?></a> <?php echo $this->lang->line('jobs.');?></p>
                              <p>
                                <input type="checkbox" value="1" name="u"/>
                                <?php echo $this->lang->line('Only');?><a href="<?php echo site_url('job/viewAllJobs/is_urgent');?>"><?php echo $this->lang->line('Urgent');?></a>   <?php echo $this->lang->line('jobs.');?></p>
                              
                              <p><b><?php echo $this->lang->line('Keywords to match:');?></b></p>
                              <p><small>(<?php echo $this->lang->line('search');?>)</small></p>
                              <p>
                                <input type="text" class="clsPercent50" name="key"/>
                              </p>
                              <p>
								<input class="clsLoginlarge_but" type="submit" value="<?php echo $this->lang->line('Create RSS Feed');?>" name="submit"/>
								<input type="hidden" name="c" value="rss" />
								<input type="hidden" name="m" value="getCustom" />
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
                            </div>
                          </div>
                          <!--end of RC -->
 
      <!--END OF POST JOB-->

<!--END OF MAIN-->
</div></div></div>
<?php $this->load->view('footer'); ?>