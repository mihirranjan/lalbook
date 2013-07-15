<?php $this->load->view('header'); ?>
<div class="clsMinContent clearfix">
<?php $this->load->view('sidebar'); ?>
<!--MAIN-->
<?php
if(isset($userDetails) and $userDetails->num_rows()>0)
{
	$user = $userDetails->row();
	$condition1=array('subscriptionuser.username'=>$user->id);
	$certified1= $this->credential_model->getCertificateUser($condition1);
	if($certified1->num_rows()>0)
	{
		// get the validity
		$validdate=$certified1->row();
		$end_date=$validdate->valid; 
		$created_date=$validdate->created;
		$valid_date=date('d/m/Y',$created_date);
		
		$next=$created_date+($end_date * 24 * 60 * 60);
		$next_day= date('d/m/Y', $next) ."\n";
		}
	}
?>
   <div id="main">
      <!--POST JOB-->
      <div class="clsInnerpageCommon">
       
                            <div class="clsInnerCommon">
                              <h2><? echo $this->lang->line('Employee Profile');?> <?php echo $this->lang->line('-');?> <?php echo $user->user_name;?>
							
							  </h2>
                             <div align="right" style="padding-right:10px;">
							 <?php if (isset($loggedInUser->role_id)) {  ?>
							  <?php if ($loggedInUser->role_id =='1') { ?>
							  
							  <a href="<?php if (!isset($loggedInUser->role_id)) echo site_url('users/login'); else  echo site_url('memberList/contactEmployee/'.$user->id); ?>">
							  <img src="<?php echo image_url('ic_mail.png'); ?>" width="22" height="22" alt="Contact Programmer" title="<?php echo $this->lang->line('Contact Employee');?>"/>
							  </a>
							  
							  					  
							  <a href="<?php if (!isset($loggedInUser->role_id)) echo site_url('users/login'); else echo site_url('memberList/inviteEmployee/'.$user->id); ?>">
						       <img src="<?php echo image_url('ic_invite.png'); ?>" width="22" height="22" alt="Invite Programmer" title="<?php echo $this->lang->line('Invite Employee');?>"/>
							  </a>
							  
							   <?php } }?>
							 <?php  if (isset($loggedInUser->role_id)) { if ($loggedInUser->role_id=='1') { ?>
							  <a href="<?php echo site_url('memberList/addFavouriteUsers/'.$user->id); ?>"><img src="<?php echo image_url('star.png'); ?>" width="22" height="22"  alt="Add To Favourite" title="<?php echo $this->lang->line('Add To Favourite');?>"/> </a>
							  <a href="<?php echo site_url('memberList/addBlockedUsers/'.$user->id); ?>"><img src="<?php echo image_url('cross.png'); ?>" width="22" height="22" alt="BlackList User" title="<?php echo $this->lang->line('BlackList User');?>"/> </a><?php } } ?>
							  
							  
							 </div>
							 <table cellspacing="1" cellpadding="2" width="96%">
                                <tbody><tr>

                                  <td width="25%" class="dt"><?php echo $this->lang->line('Profile');?></td>
								  <td width="71%" class="dt">&nbsp;</td>
                                </tr>
                                <tr>

                                  <td class="dt1 dt0"><?php echo $this->lang->line('Username:');?></td>
                                  <td class="dt1"><?php echo $user->user_name.'&nbsp;';
								  
								   if($user->logo != NULL)
									echo '<img src="'.uimage_url(get_thumb($user->logo)).'" />';
									else
									echo '<img src="'.image_url('noImage.jpg').'" width="49" height="48" />';
								   ?> 
								  <?php 
								  $condition1=array('subscriptionuser.username'=>$user->id);
								$certified1= $this->credential_model->getCertificateUser($condition1);
								if($certified1->num_rows()>0)
			                    {
							       foreach($certified1->result() as $certificate)
				                     {
									$user_id=$certificate->username;
									$id=$certificate->id;
									$condition=array('subscriptionuser.flag'=>1,'subscriptionuser.id'=>$id);
					                $userlists= $this->credential_model->getCertificateUser($condition);
									// get the validity
									$validdate=$userlists->row();
									$end_date=$validdate->valid; 
									$created_date=$validdate->created;
									$valid_date=date('d/m/Y',$created_date);
								    $next=$created_date+($end_date * 24 * 60 * 60);
									$next_day= date('d/m/Y', $next) ."\n";
							        if(time()<=$next)
								    {?>
								<img src="<?php echo image_url('certified.gif');?>"  title="<?php echo $this->lang->line('Certified Member') ?>" alt="<?php  echo $this->lang->line('Certified Member')?>"/>
								<?php } 
								  }
								   }?>
 </td>								  

                                 </tr>
                                <tr class="odd">

                                  <td class="dt2 dt0"><?php echo $this->lang->line('Name/Company:');?></td>
                                  <td class="dt2"><?php echo $user->name; ?></td>								  
                                 </tr>
								 <tr>
                                  <td class="dt1 dt0"><?php echo $this->lang->line('Email:');?></td>
                                  <td class="dt1"><?php echo $user->email; ?></td>								  
                                </tr>
                                <tr class="odd">

                                  <td class="dt1 dt0"><?php echo $this->lang->line('Ratings:');?></td>
                                  <td class="dt1">  <?php if($user->num_reviews == 0) 

                                 

							echo '(No Feedback Yet) ';
							else{ ?>
                               <img height="7" border="0" width="81" src="<?php echo image_url('rating_'.$user->user_rating.'.gif');?>"/> <?php echo $this->lang->line('(');?><b><?php echo $user->num_reviews;?> </b><a href="<?php echo site_url('employee/review/'.$user->id);?>"><?php echo $this->lang->line('reviews');?>)</a>
                              <?php } ?></td>								  
		                        </tr>
                                <tr>

                                  <td class="dt2 dt0"><?php echo $this->lang->line('Country:');?></td>
                                  <td class="dt2"><?php if(is_object($country)) echo $country->country_name; ?></td>								  
                                 </tr>
								<tr class="odd">

                                  <td class="dt1 dt0"><?php echo $this->lang->line('Communication Method:');?></td>
                                  <td class="dt1"><?php 

                                  
									$cnt = '';
									foreach($userContacts->result() as $urow){
										if($urow->msn != "")
										$cnt .= '<img src="'.image_url('msn.png').'" width="21" height="19" title="msn"/>'." ";
										if($urow->gtalk != "")
										$cnt .= '<img src="'.image_url('gtalk.png').'" width="24" height="19" title="gtalk"/>'." ";
										if($urow->yahoo != "")
										$cnt .= '<img src="'.image_url('yahoo.png').'" width="23" height="19" title="yahoo"/>'." ";
										if($urow->skype != "")
										$cnt .= '<img src="'.image_url('skype.png').'" width="19" height="19" title="skype"/>'." ";
										echo $cnt;
									} ?></td>								  
		                        </tr>
                                <tr>

                                  <td class="dt2 dt0"><?php echo $this->lang->line('Area of Expertise:');?></td>
                                  <td class="dt2"><?php 

                                  

									$userCategoryInfo = $userCategories->row();
									if(count($userCategoryInfo) > 0)
									{	
										$ids= explode(',',$userCategoryInfo->user_categories);	   
										if(isset($categories) and $categories->num_rows()>0)
										{
									?>
									<ul style="padding:0 !important;">
									  <?php 
									foreach($categories->result() as $category)
									{
									if(in_array($category->id,$ids))
									echo "<li><a href=".site_url('job/category/'.urlencode($category->category_name)).">".$category->category_name."</a></li>";
									 } ?>
									</ul>
									<?php } } ?></td>								  
                                </tr>
							    <tr class="odd">

                                  <td class="dt1 dt0"><?php echo $this->lang->line('Average Pricing:');?></td>
                                  <td class="dt1"><?php echo $currency.' ';?><?php echo $user->rate; ?><?php echo $this->lang->line('/hour');?></td>								  
 		                        </tr>
                                <tr>

                                  <td class="dt2 dt0"><?php echo $this->lang->line('Member Since:');?></td>
                                  <td class="dt2"> <?php echo get_datetime($user->created); ?></td>								  

                                 </tr>
								<tr class="odd">

                                  <td class="dt1 dt0"><?php echo $this->lang->line('Last Activity:');?></td>
                                  <td class="dt1"><?php echo get_datetime($user->last_activity); ?></td>								  
 
		                        </tr>
								<tr>

                                  <td class="dt2 dt0"><?php echo $this->lang->line('Profile:');?></td>
                                  <td class="dt2"><?php echo $user->profile_desc;?></td>								  
 
		                        </tr>
								<tr class="odd">

                                  <td class="dt1 dt0"><?php echo $this->lang->line('Portfolio:');?></td>
                                  <td class="dt1">
								  <table style="width:500px;">

                                  <td class="dt1"><?php echo $this->lang->line('Portfolio:');?></td>
                                  <td class="dt1 dt3">
								  <table style="width:500px; border:none;margin:0 !important;">

                                  <tbody>
                                   <?php
									if(isset($portfolio) and $portfolio->num_rows()>0)
									{
									foreach($portfolio->result() as $portfolio)
										{
									?>
										<tr>
										<td class="dt1 dt0"><a href="<?php echo site_url('employee/viewPortfolio/'.$portfolio->id);?>"> <img border="0" src="<?php echo pimage_url(get_thumb($portfolio->main_img));?>"/></a> </td>
										<td valign="middle" class="dt1 dt0">
										  <table style="border:none;" cellpadding="2">
										  <tbody>
											<tr>
											  <td width="50"><b><?php echo $this->lang->line('Title:');?> </b></td>
										      <td><a href="<?php echo site_url('employee/viewPortfolio/'.$portfolio->id);?>"><?php echo $portfolio->title;?></a></td>
											</tr>
											<tr>
											  <td valign="top"><b><?php echo $this->lang->line('Description:');?> </b></td>
											  <td valign="top"><?php echo word_limiter($portfolio->description,20);?></td>
											</tr>
											<tr>
											  <td><b><?php echo $this->lang->line('Category:');?> </b></td>
											  <td><?php 
												$ids= explode(',',$portfolio->categories);		
												if(isset($categories) and $categories->num_rows()>0)
												{
													foreach($categories->result() as $category)
													{
														if(in_array($category->id,$ids))
													       echo "<a href=".site_url('job/category/'.urlencode($category->category_name)).">".$category->category_name."</a> ";
													} ?> <?php
											    } ?>
											  </td>
											</tr>
											</tbody>
											</table></td>
											</tr>
										<?php }
									 }
									?>
                                    </tbody>
                                 </table>
									</td>								  
		                        </tr> 
                              </tbody></table> </table>
                            </div>
                        
      </div>
      <!--END OF POST JOB-->

    </div> </div> </div>
<!--END OF MAIN-->
<?php $this->load->view('footer'); ?>