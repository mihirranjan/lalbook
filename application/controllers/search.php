<?php

/*
  ****************************************************************************
  ***                                                                      ***
  ***      BIDONN 1.0                                                      ***
  ***      File:  search.php                                               ***
  ***      Built: Mon June 18 18:15:10 2012                                ***
  ***      http://www.maventricks.com                                      ***
  ***                                                                      ***
  ****************************************************************************
  
    <Bidonn>
    Copyright (C) <2012> <Maventricks Technologies>.
 
    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
	If you want more information, please email me at sathick@maventricks.com or 
    contact us from http://www.maventricks.com/contactus
*/

class Search extends CI_Controller {

	//Global variable  
    public $outputData;	
	public $loggedInUser;
	
	 //Constructor 
	
	function __construct()
	{
	   parent::__construct();
	  
	     $this->load->library('settings');
		
        //Get Config Details From Db
		$this->settings->db_config_fetch();
	  
	   //Manage site Status 
		if($this->config->item('site_status') == 1)
		redirect('offline');

		//Load Models 
		$this->load->model('common_model');
		$this->load->model('skills_model');
		$this->load->model('user_model');

		//Page Title and Meta Tags
		$this->outputData = $this->common_model->getPageTitleAndMetaData();

		//Get Logged In user
		$this->loggedInUser					= $this->common_model->getLoggedInUser();
		$this->outputData['loggedInUser'] 	= $this->loggedInUser;

		//Get Footer content
		$this->outputData['pages']	= $this->common_model->getPages();
		
		//Currency Type
		$this->outputData['currency'] = $this->db->get_where('settings', array('code' => 'CURRENCY_TYPE'))->row()->string_value;

		//Get Latest Jobs
		$limit_latest = $this->config->item('latest_projects_limit');
		$limit3 = array($limit_latest);
		$this->outputData['latestJobs']	= $this->skills_model->getLatestJobs($limit3);

		//language file
		$this->lang->load('enduser/common', $this->config->item('language_code'));
		 
        $categories = $this->skills_model->getCategories(); 
		$this->outputData['categories']  =  $categories;
					
		$this->outputData['popular'] = $this->skills_model->getPopularSearch('job');
		
		$this->outputData['popular_user'] = $this->skills_model->getPopularSearch('user');

		
	} //Constructor End 
// --------------------------------------------------------------------

	/**
	 * Loads Search Page
	 *
	 * @access	public
	 * @param	nil
	 * @return	void
	 */ 
	function index()
	{	
		//Load Language
		$this->lang->load('enduser/search', $this->config->item('language_code'));

		//Load Models
		$this->load->model('search_model');
		
 		//Get Search Parameters
		if($_REQUEST['keyword']!=''){
		$keyword = html_entity_decode($_REQUEST['keyword']);
		 
		}else{
	    $keyword = '';}
		/*elseif($this->uri->segment(3,0)!="Search Job"){  
		$keyword=$this->uri->segment(3,0);}
		*/
		
		if($_REQUEST['category']!=''){
		$category = html_entity_decode($_REQUEST['category']);
 		}
		else{
		$category='';}
		
	
	  
	  	$page = $this->input->get('p',true);
		if(isset($page)===false or empty($page))
		{
			$page = 1;
		}
		$this->outputData['page']	=  $page;
		
		//Get Sorting order
		$field = $this->input->get('field',true);
		$order = $this->input->get('sort',true);
		$this->outputData['order']	=  $order;
		$orderby = array();
		if($field)
		   $orderby = array($field,$order);
		if($this->input->post('customizeDisplay'))
		{
			//Get Customize data fields
			$this->session->set_userdata('show_cat',$this->input->post('show_cat',true));
			$this->session->set_userdata('show_budget',$this->input->post('show_budget',true));
			$this->session->set_userdata('show_bids',$this->input->post('show_bids',true));
			$this->session->set_userdata('show_avgbid',$this->input->post('show_avgbid',true));
			$this->session->set_userdata('show_status',$this->input->post('show_status',true));
			$this->session->set_userdata('show_date',$this->input->post('show_date',true));
			$this->session->set_userdata('show_desc',$this->input->post('show_desc',true));
			$this->session->set_userdata('show_num',$this->input->post('show_num',true));
		}
		else{
			$this->session->set_userdata('show_cat','1');
			$this->session->set_userdata('show_budget','1');
			$this->session->set_userdata('show_bids','1');
			$this->session->set_userdata('show_desc','1');
			$this->session->set_userdata('show_num','10');
		}
		$page_rows =$this->session->userdata('show_num');
		$max = array($page_rows,($page - 1) * $page_rows); 

		//Match With The Keywords
		
		if($keyword!='') 
			 $like  = array('jobs.description' => $keyword,'jobs.job_name' => $keyword);
		else
		     $like  =  '';
		   
		if($category!=''&&$category!='Select a Category')
		  $like1 = array('jobs.job_categories' =>$category);
		else
		  $like1 = '';  
		
		$jobs	 =  $this->search_model->getJobs(NULL,NULL,$like,$max,$orderby,$like1);
		$jobs1	 =  $this->search_model->getJobs(NULL,NULL,$like,NULL,NULL,$like1);
		
		if($jobs1->num_rows() > 0 && $keyword!=''){
			$insertData = array();
			$insertData['keyword'] = $keyword;
			$insertData['type'] = 'job';
			$insertData['created'] = get_est_time();
			
			//Insert keyword for popular search
			$this->skills_model->addPopularSearch($insertData);
			
			//Page Title and Meta Tags
			$condition_key        = array('categories.category_name'=>$keyword);
			$result   = $this->common_model->getPageTitle($condition_key);
			
			$result = $result->row();
			if(count($result) > 0)
			{
			$this->outputData['page_title'] 			= $this->config->item('site_title').' - '.$result->page_title;
			$this->outputData['meta_keywords']			= $result->page_title;
			$this->outputData['meta_description']		= $result->page_title;
			}
		}
		$this->outputData['jobs'] = $jobs;

		$this->load->library('pagination');
		$config['base_url'] 	= $this->config->item('base_url')."?category=".$category."&c=search&keyword=".$keyword;
		$config['total_rows'] 	= $jobs1->num_rows();		
		$config['per_page'] = $page_rows; 
		$config['cur_page'] = $page;
		$this->pagination->initialize($config);	
		$this->outputData['base_url'] = $config['base_url'];	
		$this->outputData['pagination']   = $this->pagination->create_links(true);
		$this->outputData['category']   = $category;
		$this->outputData['keyword']    = $keyword;
	    $this->load->view('search/view_searchJob',$this->outputData);		
	} //Finction Index End
	// --------------------------------------------------------------------
	
	/**
	 * Loads the employees 
	 *
	 * @access	public
	 * @param	nil
	 * @return	void
	 */ 
	function employee()
	{
	    //Load Language
		$this->lang->load('enduser/search', $this->config->item('language_code'));
		
		//Load Models
		$this->load->model('search_model');

		//Get Search Parameters
		if($_REQUEST['keyword']!=''){
		  $keyword = html_entity_decode($_REQUEST['keyword']);
		  }else{
		  $keyword='';
		  }
		  
 	    if($_REQUEST['category']!='')
		   $category = html_entity_decode($_REQUEST['category']); 
		 else 
		   $category='';
		   
		/*if($this->uri->segment(3))
		  $keyword = $this->uri->segment(3);*/ 
		
		

		$page = $this->input->get('p',true);
		if(isset($page)===false or empty($page))
		{
			$page = 1;
		}
		$this->outputData['page']	  =  $page;
		  
		//Get Sorting order
		$field = $this->input->get('field',true);
		$order = $this->input->get('sort',true);
		$this->outputData['order']	=  $order;
		$orderby = array();
		if($field)
		    $orderby = array($field,$order);
		if($this->input->post('customizeDisplay'))
		{
			//Get Customize data fields
			$this->session->set_userdata('show_cat',$this->input->post('show_cat',true));
			$this->session->set_userdata('show_budget',$this->input->post('show_budget',true));
			$this->session->set_userdata('show_bids',$this->input->post('show_bids',true));
			$this->session->set_userdata('show_avgbid',$this->input->post('show_avgbid',true));
			$this->session->set_userdata('show_status',$this->input->post('show_status',true));
			$this->session->set_userdata('show_date',$this->input->post('show_date',true));
			$this->session->set_userdata('show_desc',$this->input->post('show_desc',true));
			$this->session->set_userdata('show_num',$this->input->post('show_num',true));
		}
		else{
			$this->session->set_userdata('show_cat','1');
			$this->session->set_userdata('show_budget','1');
			$this->session->set_userdata('show_bids','1');
			$this->session->set_userdata('show_num','10');
		}
		$page_rows =$this->session->userdata('show_num');
		$max = array($page_rows,($page - 1) * $page_rows); 

		//Match With The Keywords
		if($keyword!='')
		   $like = array('users.user_name'=> $keyword);
		else
		   $like = '';
		   
		if($category!=''&&$category!='Select a Category')
		   $like1 =array('user_categories.user_categories'=> $category);
		else
		   $like1 = '';   
		
		if($keyword!='')
		    $conditions = array('users.role_id'=>'2','users.user_name'=>$keyword);
	    else
		  	$conditions = array('users.role_id'=>'2');	
			
		$users	 =  $this->search_model->getUsers($conditions,NULL,$like,$max,$orderby,$like1);
		$users1	 =  $this->search_model->getUsers($conditions,NULL,$like,NULL,NULL,$like1);
		
		if($users1->num_rows() > 0 and  $keyword !=''){
			$insertData = array();
			$insertData['keyword'] = $keyword;
			$insertData['type'] = 'user';
			$insertData['created'] = get_est_time();
			
			//Insert keyword for popular search
			$this->skills_model->addPopularSearch($insertData);
		}
		$this->outputData['users'] = $users;
		$this->load->library('pagination');
		if(!isset($keyword))
		$keyword = '';
		if(!isset($category))
		$category = '';
		$config['base_url'] 	= $this->config->item('base_url')."?c=search&keyword=".$keyword."&category=".$category.'&m=employee';
		$config['total_rows'] 	= $users1->num_rows();		
		$config['per_page'] = $page_rows; 
		$config['cur_page'] = $page;
		$this->pagination->initialize($config);	
		$this->outputData['base_url'] = $config['base_url'];	
		$this->outputData['pagination']   = $this->pagination->create_links(false);
		 $this->outputData['keyword']   = $keyword;
		 $this->outputData['category']   = $category;
	    $this->load->view('search/view_searchEmployee',$this->outputData);		
	}//Function employee end
//--------------------------------------------------------------------------------------------

	/**
	 * Loads Buyer signUp page.
	 * @access	public
	 * @param	nil
	 * @return	void
	 */ 
	function list1()
	{	
		//Load Language
		$this->lang->load('enduser/search', $this->config->item('language_code'));
		pr($this->input->get('c'));
	} //Finction list1 End
//----------------------------------------------------------------------------------------------
} //End  search Class
/* End of file search.php */ 
/* Location: ./application/controllers/search.php */
?>