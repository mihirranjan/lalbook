<?php 
 
 /*
  ****************************************************************************
  ***                                                                      ***
  ***      BIDONN 1.0                                                      ***
  ***      File:  cancel.php                                               ***
  ***      Built: Mon June 12 17:58:48 2012                                ***
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
 
class Cancel extends CI_Controller {
 
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
		$this->load->model('cancel_model');
		$this->load->model('email_model');
					 
		//Page Title and Meta Tags
		$this->outputData = $this->common_model->getPageTitleAndMetaData();
		
		//Get Top employees
		$topProgrammers = $this->common_model->getPageTitleAndMetaData();
		
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
		$this->lang->load('enduser/job', $this->config->item('language_code'));
		//$this->lang->load('enduser/createJob', $this->config->item('language_code'));
		$this->outputData['project_period']    =  $this->config->item('project_period');
	} //Constructor End 
	
	// --------------------------------------------------------------------
	
	/**
	 * Open the job cancel case
	 *
	 * @access	private
	 * @param	NULL
	 * @return	contents
	 */ 
	function openCase()
	{
		//Load Language
		$this->lang->load('enduser/cancel', $this->config->item('language_code'));
		
		//Check Whether User Logged In Or Not
	    if(isLoggedIn() === false)
		{
			$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('Please login to open case')));
			redirect('information');
		}
		//language file
		$this->lang->load('enduser/review', $this->config->item('language_code'));
		
		//Check for Login details.
		if(!isset($this->loggedInUser->id))
		  {
		  	$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('You must be login access to this page')));
		    redirect('information');
		  }
		//check for admin login
		if(isAdmin() === true)
		{
			$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('Please login to open case')));
			redirect('information');
		}

		//load validation libraray
		$this->load->library('form_validation');
		
		//Load Form Helper
		$this->load->helper('form');
		
		//Intialize values for library and helpers	
		$this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));

		//Get Form Data	
		if($this->input->post('submit'))
		{	
			//Set rules
			$this->form_validation->set_rules('project_id','lang:projectid_validation','required|is_natural_no_zero|trim|xss_clean');
			
			if($this->form_validation->run())
			{
				$prjid = $this->input->post('project_id');
				$condition2 = array('jobs.id' => $prjid);
				$res = $this->skills_model->getJobs($condition2);
				$row = $res->row();
				
				if(is_object($row)){
					redirect('cancel/createCase/'.$prjid);
				}
				else{				
					//Notification message
					$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('invalid project id')));
					redirect('cancel/openCase');
				}
			}
		}
		//Check For Employee Session
		if(isEmployee())
		{
        	$employee_id = $this->loggedInUser->id;
			$conditions3		= array('bids.user_id '=>$employee_id,'jobs.job_status =' => '2','jobs.employee_id' => $employee_id);
			$this->outputData['jobs']  =  $this->skills_model->getJobByBid($conditions3);
		}
		//Check For Owner Session
		if(isOwner())
		{
        	$owner_id = $this->loggedInUser->id;
			$conditions		= array('jobs.creator_id'=>$owner_id,'jobs.job_status =' => '2');
			$this->outputData['jobs']  =  $this->skills_model->getJobsByEmployee($conditions);
		}
		
		$this->load->view('cancel/view_cancelJobs',$this->outputData);
	}//Function opencase End
	
	// --------------------------------------------------------------------
	
	/**
	 * Open the job cancel case
	 *
	 * @access	private
	 * @param	NULL
	 * @return	contents
	 */ 
	function createCase()
	{
		//Load Language
		$this->lang->load('enduser/cancel', $this->config->item('language_code'));
		
		//Check Whether User Logged In Or Not
	    if(isLoggedIn() === false)
		{
			$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('Please login to create case')));
			redirect('information');
		}
		//If Admin try to access this url...redirect him
		if(isAdmin() === true)
		{
			$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('Please login to create case')));
			redirect('information');
		}
		
		//Load helpers
		$this->load->helper('users');
		$this->load->helper('jobcases');
		
		//load validation libraray

		$this->load->library('form_validation');

		//Load Form Helper

		$this->load->helper('form');

		//Intialize values for library and helpers	

		$this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
		
		//Get Form Data	

		if($this->input->post('createCase'))
		{
			//Set rules
			$this->form_validation->set_rules('problem_description','lang:problem_description_validation','required|trim|xss_clean');
			$this->form_validation->set_rules('comments','','trim|xss_clean');
			$this->form_validation->set_rules('payment','lang:payment_validation','is_natural_no_zero|trim|xss_clean');
			
			if($this->form_validation->run())
			{	
				  if(check_form_token()===false)
				  {
				  	$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('token_error')));
				  	redirect('information');
				  }
				  
				  $insertData              	  			= array();	
			      $insertData['job_id']    	  		    = $this->input->post('project_id');
				  $insertData['case_type']  			= $this->input->post('case_type');
				  $insertData['case_reason']   			= $this->input->post('case_reason');
				  $insertData['problem_description']    = $this->input->post('problem_description');
				  $insertData['private_comments']    	= $this->input->post('comments');
				  $insertData['review_type']    		= $this->input->post('review');
				  $insertData['payment']    			= $this->input->post('payment');
				  $insertData['user_id']    			= $this->loggedInUser->id;
				  $insertData['created']    			= get_est_time();
				  
				  //Create Case
				  $this->cancel_model->insertJobCase($insertData);
				  
				  $job_id = $insertData['job_id'];
				  $condition2 = array('jobs.id' => $job_id);
				  $res = $this->skills_model->getJobs($condition2);
				  $prj = $res->row();
				  
				  if(isEmployee()){
				  	$other_user = $prj->user_name;
					$user_type = 'Employee';
				  }
				  if(isOwner()){
				  	$provider_id = $prj->employee_id;
					$providerRow = getUserInformation($provider_id);
					$other_user = $providerRow->user_name;
					$user_type = 'Owner';
				  }
				  
				//Send Mail to other user about the case
				$conditionUserMail = array('email_templates.type'=>'cancellation_case');
				$result            = $this->email_model->getEmailSettings($conditionUserMail);
				$rowUserMailConent = $result->row();
				//Update the details
				$splVars = array("!project_name" => '<a href="'.site_url('job/view/'.$prj->id).'">'.$prj->job_name.'</a>',"!other_user" => $other_user,"!contact_url" => site_url('contact'),"!user" => $this->loggedInUser->user_name,'!site_title' => $this->config->item('site_title'),"!link" => site_url('cancel/viewCase/'.$this->db->insert_id()));
				
				$mailSubject = strtr($rowUserMailConent->mail_subject, $splVars);
				$mailContent = strtr($rowUserMailConent->mail_body, $splVars);
				$toEmail     = $prj->email;
				$fromEmail   = $this->config->item('site_admin_mail');
				$this->email_model->sendHtmlMail($toEmail,$fromEmail,$mailSubject,$mailContent);
				
				//Send acknowledgement Mail to siteadmin
				$conditionUserMail = array('email_templates.type'=>'project_cancel_admin');
				$result            = $this->email_model->getEmailSettings($conditionUserMail);
				$rowUserMailConent = $result->row();
				//Update the details
				$splVars = array("!project_name" => '<a href="'.site_url('job/view/'.$prj->id).'">'.$prj->job_name.'</a>',"!user" => $this->loggedInUser->user_name,'!user_type' => $user_type,'!user_type' => $user_type,'!case_id' => $this->db->insert_id());

				$mailSubject = strtr($rowUserMailConent->mail_subject, $splVars);
				$mailContent = strtr($rowUserMailConent->mail_body, $splVars);
				$toEmail     = $this->config->item('site_admin_mail');
				$fromEmail   = $prj->email;
				$this->email_model->sendHtmlMail($toEmail,$fromEmail,$mailSubject,$mailContent);
				//Notification message
				$this->session->set_flashdata('flash_message', $this->common_model->flash_message('success',$this->lang->line('Case opened successfully')));
				redirect('information');
			}	
		}
		
		$project_id = $this->uri->segment(3);
		$condition2 = array('jobs.id' => $project_id);
		$res = $this->skills_model->getJobs($condition2);
		$this->outputData['job'] = $res->row();
		$this->outputData['employee'] = getUserInformation($this->outputData['job']->employee_id);
		$this->load->view('cancel/view_createCase',$this->outputData);
	}//End of createCase function
	
	// --------------------------------------------------------------------
	
	/**
	 * View the cancellation/cancel case
	 *
	 * @access	private
	 * @param	case id
	 * @return	contents
	 */ 
	function viewCase()
	{
		//Load Language
		$this->lang->load('enduser/cancel', $this->config->item('language_code'));
		
		//Check Whether User Logged In Or Not
	    if(isLoggedIn() === false)
		{
			$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('Please login to view case')));
			redirect('information');
		}
		//If Admin try to access this url...redirect him
		if(isAdmin() === true)
		{
			$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('Please login to view case')));
			redirect('information');
		}
		
		//Load model
		$this->load->helper('users');
		$this->load->helper('jobcases');
		
		//load validation libraray

		$this->load->library('form_validation');

		//Load Form Helper

		$this->load->helper('form');

		//Intialize values for library and helpers	

		$this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
		
		//Get Form Data	

		if($this->input->post('respondCase'))
		{
			//Set rules
			if($this->input->post('updates') == '0')
				$this->form_validation->set_rules('problem_description','lang:problem_description_validation','required|trim|xss_clean');
			else
				$this->form_validation->set_rules('problem_description','lang:problem_description_validation','trim|xss_clean');
			$this->form_validation->set_rules('comments','','trim|xss_clean');
			
			if($this->form_validation->run())
			{	
				  if(check_form_token()===false)
				  {
				  	$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('token_error')));
				  	redirect('information');
				  }
				  
				  $insertData              	  			= array();	
			      $insertData['parent']    	  			= $this->input->post('case_id');
				  $insertData['problem_description']    = $this->input->post('problem_description');
				  $insertData['private_comments']    	= $this->input->post('comments');
				  $insertData['user_id']    			= $this->loggedInUser->id;
				  $insertData['created']    			= get_est_time();
				  if($this->input->post('updates') != '0')
				  $insertData['updates']    	= $this->input->post('updates');
				  
				  //Create Case
				  $this->cancel_model->insertJobCase($insertData);
				  
				  $job_id = $this->input->post('project_id');
				  $condition2 = array('jobs.id' => $job_id);
				  $res = $this->skills_model->getJobs($condition2);
				  $prj = $res->row();
				  
				  if(isEmployee()){
				  	$other_user = $prj->user_name;
					$user_type = 'Employee';
				  }
				  if(isOwner()){
				  	$provider_id = $prj->employee_id;
					$providerRow = getUserInformation($provider_id);
					$other_user = $providerRow->user_name;
					$user_type = 'Owner';
				  }
				  
				//Send Mail to other user about the case
				$conditionUserMail = array('email_templates.type'=>'respond_case');
				$result            = $this->email_model->getEmailSettings($conditionUserMail);
				$rowUserMailConent = $result->row();
				//Update the details
				$splVars = array("!project_name" => '<a href="'.site_url('job/view/'.$prj->id).'">'.$prj->job_name.'</a>',"!pr_name" => $prj->job_name,"!other_user" => $other_user,"!contact_url" => site_url('contact'),"!user" => $this->loggedInUser->user_name,'!site_title' => $this->config->item('site_title'),"!link" => site_url('cancel/viewCase/'.$insertData['parent']));
				
				$mailSubject = strtr($rowUserMailConent->mail_subject, $splVars);
				$mailContent = strtr($rowUserMailConent->mail_body, $splVars);
				$toEmail     = $prj->email;
				$fromEmail   = $this->config->item('site_admin_mail');
				$this->email_model->sendHtmlMail($toEmail,$fromEmail,$mailSubject,$mailContent);
				
				//Send acknowledgement Mail to siteadmin
				$conditionUserMail = array('email_templates.type'=>'response_case_admin');
				$result            = $this->email_model->getEmailSettings($conditionUserMail);
				$rowUserMailConent = $result->row();
				//Update the details
				$splVars = array("!project_name" => '<a href="'.site_url('job/view/'.$prj->id).'">'.$prj->job_name.'</a>',"!user" => $this->loggedInUser->user_name,'!user_type' => $user_type,'!case_id' => $insertData['parent']);

				$mailSubject = strtr($rowUserMailConent->mail_subject, $splVars);
				$mailContent = strtr($rowUserMailConent->mail_body, $splVars);
				$toEmail     = $this->config->item('site_admin_mail');
				$fromEmail   = $prj->email;
				$this->email_model->sendHtmlMail($toEmail,$fromEmail,$mailSubject,$mailContent);
				
				//Notification message
				$this->session->set_flashdata('flash_message', $this->common_model->flash_message('success',$this->lang->line('response added successfully')));
				redirect('cancel/viewCase/'.$insertData['parent']);
			}	
		}
		if($this->input->post('reopen')){
			$insertData              	  = array();	
			$insertData['parent']    	  = $this->input->post('case_id');
			$insertData['user_id']    	  = $this->loggedInUser->id;
			$insertData['created']    	  = get_est_time();
			$insertData['updates']    	  = $this->lang->line('case reopened');
			
			//Create Case
			$this->cancel_model->insertJobCase($insertData);
			
			//prepare update data
			$updateData                 = array();	
			$updateData['status']  		= 'open';
		
			//update case
			$this->skills_model->updateJobCase($this->input->post('case_id'),$updateData);
			
			//Notification message
			$this->session->set_flashdata('flash_message', $this->common_model->flash_message('success',$this->lang->line('Case reopened successfully')));
			redirect('cancel/viewCase/'.$insertData['parent']);
		}
		
		$caseid = $this->uri->segment('3',0);
		$condition2 = array('job_cases.id' => $caseid);
		$res = $this->cancel_model->getJobCases($condition2);
		if($res->num_rows() == 0)
		{
			//Notification message
			$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('Invalid input given')));
			redirect('information');
		}
		$this->outputData['jobCase'] = $res->row();
		
		$condition3 = array('job_cases.parent' => $caseid);
		$this->outputData['caseResolution'] = $this->cancel_model->getJobCases($condition3);

		//pr($this->outputData['projectCase']);exit;
		//$this->outputData['provider'] = getUserInformation($this->outputData['project']->programmer_id);
		$this->load->view('cancel/view_case',$this->outputData);
	}//End of ViewCase function
	
	// --------------------------------------------------------------------
	
	/**
	 * View all open job Cancellation/cancel cases
	 *
	 * @access	private
	 * @param	NULL
	 * @return	contents
	 */ 
	function viewOpenCases()
	{
		//Load Language
		$this->lang->load('enduser/cancel', $this->config->item('language_code'));
		
		//Check Whether User Logged In Or Not
	    if(isLoggedIn() === false)
		{
			$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('Please login to view open cases')));
			redirect('information');
		}
		//If Admin
		if(isAdmin() === true)
		{
			$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('Please login to view open cases')));
			redirect('information');
		}
		
		//Load model
		$this->load->helper('users');
		$this->load->helper('jobcases');
		
		$condition2 = array('job_cases.case_type' => 'cancel','job_cases.parent' => '0','job_cases.status' => 'open');
		$orCondition = "(jobs.creator_id = '".$this->loggedInUser->id."' or jobs.employee_id = '".$this->loggedInUser->id."')";
		//'jobs.creator_id' => $this->loggedInUser->id,'jobs.employee_id' => $this->loggedInUser->id;
		$this->outputData['cancellation'] = $this->cancel_model->getJobCases($condition2,$orCondition);
		
		$condition3 = array('job_cases.case_type' => 'cancel','job_cases.parent' => '0','job_cases.status' => 'open');
		$orCondition2 = "(jobs.creator_id = '".$this->loggedInUser->id."' or jobs.employee_id = '".$this->loggedInUser->id."')";
		$this->outputData['disputes'] = $this->cancel_model->getJobCases($condition3,$orCondition2);
		//pr($this->outputData['disputes']->result());exit;
		
		$this->load->view('cancel/view_openCases',$this->outputData);
	}//End of viewOpenCases function
	
	// --------------------------------------------------------------------
	
	/**
	 * View all closed job Cancellation/cancel cases
	 *
	 * @access	private
	 * @param	NULL
	 * @return	contents
	 */ 
	function viewClosedCases()
	{
		//Load Language
		$this->lang->load('enduser/cancel', $this->config->item('language_code'));
		
		//Check Whether User Logged In Or Not
	    if(isLoggedIn() === false)
		{
			$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('Please login to view closed cases')));
			redirect('information');
		}
		//If Admin try to access this url...redirect him
		if(isAdmin() === true)
		{
			$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('Please login to view closed cases')));
			redirect('information');
		}
		
		//Load model
		$this->load->helper('users');
		$this->load->helper('jobcases');
		
		$condition2 = array('job_cases.case_type' => 'cancel','job_cases.parent' => '0','job_cases.status' => 'closed');
		$orCondition = "(jobs.creator_id = '".$this->loggedInUser->id."' or jobs.employee_id = '".$this->loggedInUser->id."')";
		//'jobs.creator_id' => $this->loggedInUser->id,'jobs.employee_id' => $this->loggedInUser->id;
		$this->outputData['cancellation'] = $this->cancel_model->getJobCases($condition2,$orCondition);
		
		$condition3 = array('job_cases.case_type' => 'dispute','job_cases.parent' => '0','job_cases.status' => 'closed');
		$orCondition2 = "(jobs.creator_id = '".$this->loggedInUser->id."' or jobs.employee_id = '".$this->loggedInUser->id."')";
		$this->outputData['disputes'] = $this->cancel_model->getJobCases($condition3,$orCondition2);
		//pr($this->outputData['disputes']->result());exit;
		
		$this->load->view('cancel/view_closedCases',$this->outputData);
	}//End of viewClosedCases function
	
	} //End cancel class
/* End of file cancel.php */ 
/* Location: ./application/controllers/cancel.php */
?>