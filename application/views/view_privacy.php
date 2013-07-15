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
    <!--<div id="header" class="clearfix">
      <div id="selLeftHeader" class="clsFloatLeft">
        <div id="selLogo">
          <h1> <a href="#">Site name</a> </h1>
        </div>
      </div>
      <div id="selRightHeader" class="clsFloatRight">
      <div class="clsMenu">
      <ul class="clearfix">
      <li class="clsActive"><a href="#">About</a></li>
       <li><a href="#">Seller</a></li>
       <li><a href="#">Buyer</a></li>
        <li class="clsNoBorder"><a href="#">Contact us</a></li>
        <li class="clsNoBorder"><a class="clsBut" href="#">Sign Up</a></li>
      </ul>
      </div>
       
      </div>
    </div>-->
	 <?php $this->load->view('header'); ?>
    <!-- End of Header -->
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
                      <div class="clsPoliicy">
<!--<h2>Privacy Ploicy</h2>-->
<!--<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>-->
<?php 
						        if(isset($page_content) and $page_content->num_rows()>0) 
								  { 
								  $pages = $page_content->row();
								  ?>
								  <h2><?php echo $pages->page_title; ?></h2> <?php 
								  }
								if(isset($page_content) and $page_content->num_rows()>0)
								{ 
									foreach($page_content->result() as $page)
									{
									
										echo $page->content;
									}
								}
								?>

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
