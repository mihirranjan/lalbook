<?php


/*
  ****************************************************************************
  ***                                                                      ***
  ***      BIDONN 1.0	                                                   ***
  ***      File:  rss.php                                                  ***
  ***      Built: Mon June 16 11:01:56 2012                                ***
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
 

class Rss extends CI_Controller {

	//Global variable  
    public $outputData;		
	public $loggedInUser;
		

	// Constructor 
	
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

		//Page Title and Meta Tags
		$this->outputData = $this->common_model->getPageTitleAndMetaData();
		
		//Get Logged In user
		$this->loggedInUser					= $this->common_model->getLoggedInUser();
		$this->outputData['loggedInUser'] 	= $this->loggedInUser;
		
		//Get Footer content
		$this->outputData['pages']	= $this->common_model->getPages();
		
		//Get Latest Jobs
		$limit_latest = $this->config->item('latest_projects_limit');
		$limit3 = array($limit_latest);
		$this->outputData['latestJobs']	= $this->skills_model->getLatestJobs($limit3);
		
		//language file
		$this->lang->load('enduser/common', $this->config->item('language_code'));
		$this->lang->load('enduser/rss', $this->config->item('language_code'));
		$this->outputData['current_page'] = 'rss';
		
		//Rss Feed Limit - can be modified by user input
		$this->outputData['limit_feed'] = 15;
	}//End Constructor
	// --------------------------------------------------------------------
	
	/**
	 * Loads Rss page.
	 *
	 * @access	public
	 * @param	nil
	 * @return	void
	 */ 
	function index()
	{
		//Get Categories
		$this->outputData['categories']	=	$this->skills_model->getCategories();
	 	$this->load->view('rss/view_Home',$this->outputData);
	}//Function End
	// --------------------------------------------------------------------
	
	/**
	 * Loads Rss page.
	 *
	 * @access	public
	 * @param	nil
	 * @return	void
	 */ 
	function show()
	{ 
		//Get Category Id
		$category_id 	= $this->input->get('cat', TRUE);
		$conditions = array('categories.id'=>$category_id);
		$categories = $this->skills_model->getCategories($conditions);
		 if($categories->num_rows()>0)
			$category	=  $categories->row(); 
		
		//Get Type
		$this->outputData['type']	   		= $this->input->get('type', TRUE);
		
		//Jobs List
		$like  = array('job_categories' => $category->category_name);
		$limit = array($this->outputData['limit_feed']);
		$this->outputData['jobs']	   =  $this->skills_model->getJobs(NULL,NULL,$like,$limit);
		$this->load->view('rss/view_Feeds',$this->outputData);	
	}//function show end
	// --------------------------------------------------------------------
	
	/**
	 * Loads Rss page.
	 *
	 * @access	public
	 * @param	nil
	 * @return	void
	 */ 
	function all()
	{	
		$category_name = ' ';
		$this->outputData['rss_title']			= $this->config->item('site_title').'  '.$this->lang->line('Jobs');
		//pr($this->outputData['rss_title']);exit;
		//Set Limit
		$limit = array($this->outputData['limit_feed']);
		$this->outputData['jobs']	   		= $this->skills_model->getJobs(NULL,NULL,NULL,$limit);
		//pr($this->outputData['jobs']->result());exit;
		
		$this->outputData['type']	   			= $this->input->get('type', TRUE);
		$this->outputData['rss_description']	= $this->lang->line('The newest jobs posted on').$category_name.$this->config->item('site_title');
		$this->load->view('rss/view_Feeds',$this->outputData);	
	}//function all end 
	
	// --------------------------------------------------------------------
	
	/**
	 * Loads Rss page.
	 *
	 * @access	public
	 * @param	nil
	 * @return	void
	 */ 
	function getCustom()
	{ 
		$this->outputData['rss_title']			= $this->config->item('site_title').'  '.$this->lang->line('Jobs');
		$this->outputData['rss_description']	= $this->lang->line('The newest jobs posted on').$this->config->item('site_title');
		$limit = array($this->input->get('show',TRUE));
		$key = $this->input->get('key',TRUE);
		$featured = $this->input->get('f',TRUE);
		$cat = $this->input->get('category',TRUE);
		$urgent = $this->input->get('u',TRUE);
		
		$like = array();
		if($key)
		    $like  = array('job_name' => $key,'description' => $key);
		
		$condition = array();
		if($featured)
		$condition = array('jobs.is_feature' => $featured);
		elseif($urgent)
		$condition = array('jobs.is_urgent' => $urgent);
		elseif($featured && $urgent)
		$condition = array('jobs.is_feature' => $featured,'jobs.is_urgent' => $urgent);
		//Get Type
		$this->outputData['type']	   		= $this->input->get('des', TRUE);
		
		$cg = array();
		if(is_array($cat)){
			$i = 0;
			foreach($cat as $cate){
				$conditions = array('categories.id'=>$cate);
				$categories = $this->skills_model->getCategories($conditions);
			 
				if($categories->num_rows()>0){
					$category	=  $categories->row();
					$cg[$i] = $category->category_name;
				}
				$i++;
			}
		}
		$this->outputData['jobs']= $this->skills_model->getRssProjects($condition,NULL,$like,$limit,NULL,$cg);
		$this->load->view('rss/view_Feeds',$this->outputData);
	}//function getcustom end
	
} //End  Rss Class

/* End of file rss.php */ 
/* Location: ./application/controllers/rss.php */
?>