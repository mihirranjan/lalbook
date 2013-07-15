<?php

/*
  ****************************************************************************
  ***                                                                      ***
  ***      BIDONN 1.0                                                      ***
  ***      File:  information.php                                          ***
  ***      Built: Mon June 12 15:49:52 2012                                ***
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

class Redirection extends CI_Controller {

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
		
		//Get Latest jobs
		$limit_latest = $this->config->item('latest_projects_limit');
		$limit3 = array($limit_latest);
		$this->outputData['latestJobs']	= $this->skills_model->getLatestJobs($limit3);
		
		//language file
		$this->lang->load('enduser/common', $this->config->item('language_code'));
	
	} //Controller End 
	// --------------------------------------------------------------------
	
	/**
	 * Loads Owner signup page.
	 *
	 * @access	public
	 * @param	nil
	 * @return	void
	 */ 
	function index()
	{	
		//language file
		$this->lang->load('enduser/common', $this->config->item('language_code'));
	    /*$this->load->view('view_showMessage',$this->outputData);*/
		$this->load->view('view_information',$this->outputData);
	      
	} //End index function
	
 	
	function terms()
	{
	   // get the page uri name	   
	   $like = array('page.url'=>'%ter%');
	   $like1 = array('page.url'=>'%cond%');
	   $this->outputData['page_content']	=	$this->page_model->getPages(NULL,$like,$like1);	
		
		/*	
	  pr($this->outputData['page_content']);
	  exit();
	  */
	   //Load View	
	   $this->load->view('termspage',$this->outputData);
	} //End terms function 
	
	function privacy()
	{
	   // get the page uri name	   
	   $like = array('page.url'=>'%privacy%');
	   $this->outputData['page_content']	=	$this->page_model->getPages(NULL,$like,NULL);	
		
	   $this->load->view('termspage',$this->outputData);
	} //End privacy function 

	
} //End Class Information

/* End of file information.php */ 
/* Location: ./application/controllers/information.php */