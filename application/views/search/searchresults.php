<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LalBook</title>
<link rel="stylesheet" type="text/css" href="css/common.css" />
<!--[if IE ]>
<link href="css/iefix.css" rel="stylesheet" type="text/css" />
<![endif]-->
</head>
	
<body>
<div class="Container">
    <!-- Header -->
   
    <!-- End of Header -->
	<?php $this->load->view('header'); ?>
	 <?php $this->load->view('home_search'); ?>
    <!--<div id="selSearch">
    <p><label>Search </label><input type="text" value="Search for product bids" class="clsSertxt"><input type="button" value="" class="clsGobut"></p>
    </div>-->
    
    
    
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
                      <div class="clsSearchResults">
<h2>Search Results</h2>
<table width="100%" cellpadding="0" cellspacing="0" class="clsSearchTable">
<tr>
<th>Sl.No.</th>
<th> Job Name</th>
<th> Job Type	</th>
 <th>Budget</th>
 <th>Bids</th>
 </tr>
 <?php   if(isset($searches) and $searches->num_rows()>0)
						 {
						 $i=0;
						 $a=0;
						//echo $buyrequirement->num_rows();
						  foreach($searches->result() as $searchresult)
						    {
							if($i%2==0){
						$clsodd="";
						}else{
						$clsodd="clsEven";
						}
						$a++;
							$reqimages=$searchresult->requirement_image;
							$jobidd=$searchresult->buy_id;
							//echo $jobidd;
							$q = "SELECT COUNT(job_id) AS count FROM bids WHERE job_id = $jobidd";
							//echo "SELECT COUNT(job_id) AS count FROM bids WHERE job_id = $jobidd";
 $query = $this->db->query($q,array($searchresult->buy_id));
       $ncomments = $query->result_array();
	   //print_r($query);exit;
	$blog_e->n_comments = $ncomments[0]['count'];
	
	//$blog_e->n_commentse = $ncomments[0]['usid'];
	 $Totalbid=$blog_e->n_comments;
			
							?>
 <tr class="" >
 <td><?php echo $a;?></td>
 <td><a href="<?php echo site_url('job/view/'.$searchresult->buy_id);?>"><?php echo ucfirst($searchresult->looking_for);?></a></td>
 <td> <?php echo $searchresult->category;?>	</td>
 <td> <?php echo $searchresult->budget;?></td>
 <td> <?php if ($blog_e->n_comments!=0) { echo  $blog_e->n_comments ;} else{echo "No bids";}?></td>
 </tr>
 <?php $i++;}
 }
 else{
 ?>
 <tr> <td colspan="5"> No Results Found</td></tr>
 <?php } ?>
</table>
<p><input type="button" class="clsRefresh_but" value="Refresh" /></p>

<!--<div class="clsPagination">
<ul class="clearfix">
<li class="prev"><a href="#">&lt;</a></li>
<li><a href="#">1</a></li>
<li><a href="#">2</a></li>
<li class="clsActive"><a href="#">3</a></li>
<li><a href="#">4</a></li>
<li><a href="#">5</a></li>
<li class="next"><a href="#">&gt;</a></li>
</ul>
</div>-->
<br />
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
    <!--<div id="selFooter">
    <div class="clsFooter clearfix">
    <div class="clsLeftfoot">
    <ul class="clearfix">
    <li><a href="#">Post </a></li>
      <li><a href="#">   Blogs  </a></li> 
      <li><a href="#">  Contact  </a></li>
        <li><a href="#"> Feeds  </a></li>
        <li class="clsNoBorder"><a href="#">    Privacy Policy</a></li>
    </ul>
    
    </div>
    <div class="clsRightFoot">
    <p>Lalbook © 2013. All Rights Reserved.</p>
    </div>
    <div class="clsCenterFoot">
    <ul class="clearfix">
    <li><a href="#"><img src="images/f_icon1.jpg" alt="" /></a></li>
     <li><a href="#"><img src="images/f_icon2.jpg" alt="" /></a></li>
      <li><a href="#"><img src="images/f_icon3.jpg" alt="" /></a></li>
    </ul>
    </div>
    
    </div>
    </div>-->
	 <?php $this->load->view('home_footer'); ?>
    
</body>
</html>
