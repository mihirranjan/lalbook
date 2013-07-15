<?php  
			if(isset($searches) and $searches->num_rows()>0)
				{
			foreach($searches->result() as $searchresult)
					{
							$reqimages=$searchresult->requirement_image;
							//echo '<pre>'; print_r($searchresult);//exit;
							?>
							
            <div class="clsBrowser clearfix"> 
						 <div class="clsLeftbrowse">
							  <form name="" method="post">
										<input type="hidden" value="<?php echo $searchresult->credit; ?>"  id="usercredit"/>
									  <?php if($loggedInUser)
											{ ?>
								   
										<input type="hidden" value="<?php echo $loggedInUser->id; ?>"  id="userid"/>
										<input type="hidden" value="<?php echo $loggedInUser->email; ?>"  id="usermail"/>
									  
									  
									   <?php } ?>
							  </form>
										<?php if($reqimages){ ?>
										<img class='thumbnail' src='<?php echo base_url();?>files/job_attachment/<?php echo $reqimages;?>' alt="" />
									<?php }else{ ?>
										<img src="<?php echo image_url();?>/dgff.png" alt="" />
									<?php } ?>
									<h3><a href="<?php echo site_url('job/view/'.$searchresult->buy_id);?>"><?php echo $searchresult->looking_for;?></a></h3>
									<p><span>Location : <?php echo $searchresult->country_symbol;?>,<?php echo $searchresult->state;?></span></p>
									<p><span>Posted : <?php $postdt=$searchresult->created;  echo get_datetime($searchresult->created);?></span></p>
                      
								  <div class="clsCatg">
										<h3><span><label style="color:#333;">Type</label> :&nbsp;<?php $btype=$searchresult->requirements; if($btype==1){ echo "Products";} if($btype==2){echo "Services";} if($btype==3){echo "Products & Services";}?></span><label style="color:#333;">Category </label>:&nbsp;<?php echo $searchresult->category;?></h3>
										<div class="clsCatgDesc">
												<p><?php echo $searchresult->description;?></p>
										  </div>
												<p class="clsAlign"><a href="<?php echo site_url('job/view/'.$searchresult->buy_id);?>">More</a></p>
								  </div>
                      
						</div> 
					  
                                 <div class="clsLeftserBox">
										<div class="clsRightbar">
						 
											<p>
												<label>Buyer </label>:<span><?php echo $searchresult->user_name;?></span>
											</p>
											<?php $jobidd=$searchresult->buy_id;
											//echo "SELECT COUNT(job_id) AS count FROM bids WHERE job_id = $jobidd";
											$q = "SELECT SUM(bid_amount) AS sum,COUNT(job_id) AS count FROM bids WHERE job_id = $jobidd";
											//$rest= $this->db->query($q);
														//$results = $rest->result();
														$query = $this->db->query($q,array($searchresult->buy_id));
												   $ncomments = $query->result_array();
												   //print_r($query);exit;
												$blog_e->avgbid = $ncomments[0]['sum'];
												$blog_e->counts = $ncomments[0]['count'];
											?>
											<p><label>Avg.Bid </label>:<span><?php if($blog_e->counts>1){ if(isset($blog_e->avgbid)) { echo $blog_e->avgbid/$blog_e->counts;} } 
											elseif(isset($blog_e->avgbid) || ($blog_e->avgbid!='') || ($blog_e->avgbid!=NULL) ){ echo round($blog_e->avgbid,1);} else { echo "No bids";}?></span></p>
											<p><label>Budget </label>:<span> <?php echo $searchresult->budget;?></span><img src="<?php echo image_url();?>rupee_icon.png" /></p>
											<p><label>Bid End Date </label>:<span><?php echo $searchresult->end_date;?></span></p>
											<p><label>Project ID </label>:<span><?php echo $searchresult->buy_id;?></span></p>
											<?php $verifyusers=$searchresult->user_verify;?>

										<p style="text-align:center;">
										<?php if($verifyusers==1)
										{
										?>
										<a href="#" class="tooltip"> <input type="button" class="clsVerify" value="Verified" /> <span> <strong>User Verified By Lalbook</strong></a> 
										<?php } ?>
										<?php if($verifyusers==0)
										{
										?>
										<a href="#" class="tooltip"><input type="button" class="clsVerify" value="Not Verified" />
										<span>  <strong>User Not Verified By Lalbook</strong></a>  
										<?php } ?>
										</p> 
									</div>
										   <?php
										 //  print_r($searchresult);exit;
								$jobpostedid=$searchresult->creator_id;
										//   echo $jobpostedid;
											if($loggedInUser && $loggedInUser->id!=$jobpostedid)
										   { 
										
										   ?>
											<!--<p style="	text-align:center;clear:both;padding:10px 0;"><a href="#" class="popup-bid place" id="<?php echo $searchresult->buy_id;?>"><img src="<?php echo image_url();?>/bid_img.jpg" alt="" /></a></p>-->
											<?php }?>
											 <?php if(!$loggedInUser)
										   { 
										 //  echo $loggedInUser->user_id;exit;
											?>
														  
									<p style="	text-align:center;clear:both;padding:10px 0;"><a href="#" class="nopopup-bid place" ><img src="<?php echo image_url();?>/bid_img.jpg" alt="" /></a></p>
									<?php } ?>
								</div>
            </div>
			<?php 	}
				
				}
?>