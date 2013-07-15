<?php     
 /*
  ****************************************************************************
  ***                                                                      ***
  ***      BIDONN 1.0                                                      ***
  ***      File:  bookmark.php                                             ***
  ***      Built: Mon June 19 11:28:35 2012                                ***
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
class Bookmark extends CI_Controller {

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
 		
		//Load Models required for this controller
		$this->load->model('common_model');
		$this->load->model('skills_model');
		$this->load->model('bookmark_model');
		
		//load validation libraray
		$this->load->library('form_validation');
		
		//Load Form Helper
		$this->load->helper('form');
		
		//Intialize values for library and helpers	
		$this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
		
		//Page Title and Meta Tags
		$this->outputData = $this->common_model->getPageTitleAndMetaData();
		
		//Get Logged In user
		$this->loggedInUser					= $this->common_model->getLoggedInUser();
		$this->outputData['loggedInUser'] 	= $this->loggedInUser;
		
		//Get Footer content
		$this->outputData['pages']	= $this->common_model->getPages();	
		
		
		//language file
		$this->lang->load('enduser/common', $this->config->item('language_code'));
		
	
	
	} //Controller End 
	
	// --------------------------------------------------------------------
	
	/**
	 * Logged user can bookmark the particular job for feature reference
	 *
	 * @access	private
	 * @param	nil
	 * @return	void
	 */ 
	function index()
	{	
		//Get the bookmark job details
		$job_id = $this->uri->segment(2);
		$conditions   = array('bookmark.job_id'=>$job_id,'bookmark.creator_id'=>$this->loggedInUser->id);
		$bookMarks    = $this->bookmark_model->getBookmark($conditions);
		$res  =  $bookMarks->num_rows();
		
		if($res <= 0)
		{
			$conditions   = array('jobs.id'=>$job_id);
			$jobList  = $this->skills_model->getJobs($conditions);
			foreach($jobList->result() as $res)
			  {
				$insertData['id']               = '';
				$insertData['creator_id']       = $this->loggedInUser->id;
				$insertData['creator_name']     = $this->loggedInUser->user_name; 
				$insertData['job_creator']  = $res->creator_id;
				$insertData['job_id']       = $res->id;
				$insertData['job_name']     = $res->job_name;			
				$this->bookmark_model->createBookmark($insertData);
				$this->session->set_flashdata('flash_message', $this->common_model->flash_message('success','The Job "'.$res->job_name.'" is bookmarked successfully'));
				redirect('job/view/'.$job_id);
			  }
        }
		else
		{
 			$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error','Job already Bookmarked'));
			redirect('job/view/'.$job_id);
		}
	   redirect('job/view/'.$job_id);
	} //Function index End
	
	
	
}

//End  bookmark Class

/* End of file bookmark.php */ 
/* Location: ./application/controllers/bookmark.php */