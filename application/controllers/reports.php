<?php

/*
  ****************************************************************************
  ***                                                                      ***
  ***      BIDONN 1.0                                                      ***
  ***      File:  reports.php                                              ***
  ***      Built: Mon June 12 13:25:50 2012                                ***
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


class Reports extends CI_Controller {

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
		
		
		//Load Models Common to all the functions in this controller
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
	 * Loads Report page of the site.
	 *
	 * @access	public
	 * @param	nil
	 * @return	void
	 */	
	function index()
	{
		//Load Language File For this
		$this->lang->load('enduser/reports', $this->config->item('language_code'));
		
		//Load library Filas and Helper File
		$this->load->helper('flash');
		$this->load->view('reports',$this->outputData);
	} //Function Index End
	// --------------------------------------------------------------------
	
	/**
	 * Generates report of users.
	 *
	 * @access	public
	 * @param	nil
	 * @return	void
	 */	
	function numberOfUsersSigned()
	{
		//Load Language File For this
		$this->lang->load('enduser/reports', $this->config->item('language_code'));
		
		//Load Library File
		$this->load->library('graph');
		
		// generate some random data
		srand((double)microtime()*1000000);
		
		// NOTE: how we are filling 3 arrays full of data,
		//       one for each line on the graph
		
		$data_1 = array();
		$data_2 = array();
		$mon = array();
		$bid	= $this->user_model->getRoleId('owner');
		$pid	= $this->user_model->getRoleId('employee');
		for( $i=0; $i<6; $i++ )
		{
		  $lastmonth = mktime(0, 0, 0, date("m")-$i, date("d"),   date("Y"));
		  $month = date('n',$lastmonth);
		  $year = date('Y',$lastmonth);
		  $data_1[] = $this->user_model->getNumUsersByMonth($month,$year,$bid);
		  $data_2[] = $this->user_model->getNumUsersByMonth($month,$year,$pid);
		  $mon[] = date('M',$lastmonth);
		}
		$g = new graph();
		$g->title( $this->lang->line('Users Joined last 6 months'), '{font-size: 20px; color: #999999}' );
		
		// we add 2 sets of data:
		$g->set_data( $data_1 );
		$g->set_data( $data_2 );
		$g->set_bg_colour('0xFFFFFF');
		
		// we add the 3 line types and key labels
		$g->line_dot( 3, 5, '0x0033CC', 'Owners', 12 );
		$g->line_dot( 3, 5, '0x009900', 'Employees', 12);    // <-- 3px thick + dots
		
		$g->set_x_labels($mon );
		$g->set_x_label_style( 10, '0x000000', 0, 1 );
		
		$g->set_y_max(50);
		$g->y_label_steps( 4 );
		echo $g->render();
	}//Function numberOfUsersSigned end
	// --------------------------------------------------------------------
	
	/**
	 * Generates report of jobs created
	 *
	 * @access	public
	 * @param	nil
	 * @return	void
	 */	
	function jobsCreated()
	{
		//Load Language File For this
		$this->lang->load('enduser/reports', $this->config->item('language_code'));
		
		//Load Library File
		$this->load->library('graph');
		
		// generate some random data
		srand((double)microtime()*1000000);
		
		// NOTE: how we are filling 3 arrays full of data,
		//       one for each line on the graph
		
		$data_1 = array();
		$mon = array();
		for( $i=0; $i<6; $i++ )
		{
		  $lastmonth = mktime(0, 0, 0, date("m")-$i, date("d"),   date("Y"));
		  $month = date('n',$lastmonth);
		  $year = date('Y',$lastmonth);
		  $data_1[] = $this->skills_model->getNumProjectsByMonth($month,$year);
		  $mon[] = date('M',$lastmonth);
		}
		$g = new graph();
		$g->title( $this->lang->line('Jobs added last 6 months'), '{font-size: 20px; color: #999999}' );
		
		// we add 2 sets of data:
		$g->set_data( $data_1 );
		$g->set_bg_colour('0xFFFFFF');
		
		// we add the 3 line types and key labels
		$g->line_dot( 3, 5, 'FF6633', 'Jobs', 12);    // <-- 3px thick + dots
		
		$g->set_x_labels($mon );
		$g->set_x_label_style( 10, '0x000000', 0, 1 );
		
		$g->set_y_max(50);
		$g->y_label_steps( 4 );
		echo $g->render();
	}//Function jobsCreated end
}//End  Reports Class

/* End of file Reports.php */
/* Location: ./application/controllers/Reports.php */
?>