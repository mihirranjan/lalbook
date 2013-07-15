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
overflow:hidden;
/*	float: left;
	background: #fff;
	width: 500px;
	padding-top: 4px;*/
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
/*	float: left;*/
}
#tabs ul li.active {
/*	border-top:2px #FFFF66 solid;
	background: #FFFFCC;*/
}
#tabs ul li.active a {
	color: #fff;
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
                          <h3><span class="clsMyOpen"><?php echo $this->lang->line('Search Results'); ?></span></h3>
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
						  <input type="hidden" class="clsST" name="c" value="search" />
						  <input type="hidden" class="clsST" name="m" value="employee" />
						  <input type="hidden" class="clsST" name="p" value="<?php echo $page; ?>" />
						 <input type="submit" class="clsLogin_but" value="Search" /></p>
						  <p><label><?php echo $this->lang->line('Popular searches:');?></label>
						  
					    <?php
						if(isset($popular_user) and $popular_user->num_rows()>0)
						{  
							  foreach($popular_user->result() as $popular_user)
							  { ?>
								<a href="<?php echo base_url()."?category=&c=search&&m=employee&keyword=".urlencode($popular_user->keyword);?>"><?php echo $popular_user->keyword;?></a> 			                        <?php } 
						} ?>

						  </p>
						  </form>
                       </div>
  </div>
						 
						  </div></div></div>
						  </div> 
                          <table cellspacing="1" cellpadding="2" width="96%">
                            <tbody>
                              <tr>
                                <td width="30" class="dt"><?php echo $this->lang->line('SI.No');?></td>
                                <td width="250" class="dt"><? 
						  $odr = 'ASC';
						  if($order == 'ASC')
						  $odr = 'DESC';
						  ?>
                             </td>
                               
                                <td width="250" class="dt"><?php echo $this->lang->line('Job Type'); ?></td>
                               
                              </tr>
                              <?php $j=0; $i=0;
						 	if(isset($users) and $users->num_rows()>0)
							{
								foreach($users->result() as $users)
								{ 
								if($users->role_id == 2)
								{
								 $j=$j+1;
								if($j%2 == 0)
								  $class = 'dt1 dt0';
								else
								  $class = 'dt2 dt0'; 
								?>
                              <tr class="odd <?php echo $class; ?>">
                                <td><?php echo $j;  ?></td>
                                <td><a href="<?php echo site_url('employee/viewProfile/'.$users->id); ?>"> <?php echo $users->user_name; ?> </td>
                                <td><?php $user_cat = explode(',',$users->user_categories); foreach($user_cat as $res) {  foreach($categories->result() as $cat) { if($res == $cat->id){ echo $cate[$i++] = getCategoryLinks($cat->category_name).' '; }   } }  ?>
                                </td>
                               
                              </tr>
                              <?php 
						  }						
								}//Traverse Jobs
							}//Check For Job Availability
							 ?>
                              <tr class="">
                                <td class="dt1 dt0" colspan="5"><form method="post" action="">
                                 <table cellspacing="0" cellpadding="0" width="100%"> 
                                    <tbody>
                                      <tr>
                                        <td align="center"><?php echo $this->lang->line('Customize Display'); ?>:</td>
                                        
                                        <td><select name="show_num" size="1">
                                            <option value="5" <?php if($this->session->userdata('show_num') == 5) echo "selected";?>>5</option>
                                            <option value="10" <?php if($this->session->userdata('show_num') == 10) echo "selected";?>>10</option>
                                            <option value="20" <?php if($this->session->userdata('show_num') == 20) echo "selected";?>>20</option>
                                            <option value="50" <?php if($this->session->userdata('show_num') == 50) echo "selected";?>>50</option>
                                            <option value="100" <?php if($this->session->userdata('show_num') == 100) echo "selected";?>>100</option>
                                          </select>
                                          <?php echo $this->lang->line('Results'); ?>
                                          <input type="submit" value="<?php echo $this->lang->line('Refresh'); ?>" class="clsLogin_but" name="customizeDisplay"/>
                                  </form></td>
                              </tr>
                            </tbody>
                          </table>
                          </td>
                          </tr>
                          </tbody>
                          </table>
                          <!--PAGING-->
                          <?php if(isset($pagination)) echo $pagination; ?>
                          <!--END OF PAGING-->
                        </div>
                      </div>
   
  <!--END OF POST JOB-->
</div>
</div></div>
<!--END OF MAIN-->
<?php $this->load->view('footer'); ?>