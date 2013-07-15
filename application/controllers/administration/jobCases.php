<?php   

/*
  ****************************************************************************
  ***                                                                      ***
  ***      BIDONN 1.0                                                      ***
  ***      File:  jobCases.php                                             ***
  ***      Built: Mon June 25 14:51:45 2012                                ***
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

class JobCases extends CI_Controller {

	//Global variable  
    public $outputData;
	   
 	//Constructor 
	 
	function __construct()
	{
	   parent::__construct();
	   
	   //Check For Admin Logged in
		if(!isAdmin())
			redirect_admin('login');
		
		$this->load->library('settings');
		
        //Get Config Details From Db
		$this->settings->db_config_fetch();
 		
		// loading the lang files
		$this->lang->load('admin/common',$this->config->item('language_code'));
		$this->lang->load('admin/dispute',$this->config->item('language_code'));
		$this->lang->load('admin/validation',$this->config->item('language_code'));
		
		//Load Models Common to all the functions in this controller
		$this->load->model('common_model');
		$this->load->model('admin_model');
		$this->load->model('cancel_model');
		$this->load->model('email_model');
		$this->load->model('skills_model');
		//Load helper files
		$this->load->helper('form');
		$this->load->helper('jobcases');
		$this->load->helper('users');

	}//Controller End 
	
	// --------------------------------------------------------------------
	
	/**
	 * Lists job cancellation/dispute cases.
	 *
	 * @access	private
	 * @param	nil
	 * @return	content
	 */
	function viewCases()
	{	
		//Get job cases
		$condition = array('job_cases.parent' => '0');
		$this->outputData['jobCases']	=	$this->cancel_model->getJobCases($condition);
		
		//Load View
	   	$this->load->view('admin/dispute/view_cases',$this->outputData);
	   
	}//End of groups function
	
	// --------------------------------------------------------------------
	
	/**
	 * View case details
	 *
	 * @access	private
	 * @param	nil
	 * @return	content
	 */
	function view()
	{	
		//Load model
		
		//load validation library
		$this->load->library('form_validation');
		
		//Intialize values for library and helpers	
		$this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
		
		if($this->input->post('check'))
		{	
			//Set rules
			//$this->form_validation->set_rules('group_name','lang:group_name_validation','required|trim|xss_clean|callback_groupNameCheck');
			//$this->form_validation->set_rules('descritpion','lang:descritpion_validation');
			
			if($this->form_validation->run())
			{	
				  //prepare insert data
				  $updateData                  	  	= array();	
			      $updateData['case_type']  		= $this->input->post('type');
				  $updateData['status']  			= $this->input->post('status');
				  $updateData['created']			= get_est_time();
				  if($updateData['case_type'] == 'Dispute')
				  $updateData['updates']			= $this->lang->line('cancellation to dispute');

				  //update case
				  $this->cancel_model->updateJobCase($this->input->post('case_id'),$updateData);
				  
				  //Notification message
				  $this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success',$this->lang->line('added_success')));
				   redirect_admin('skills/viewGroups');
		 	} 
		} //If - Form Submission End
		
		$caseid = $this->uri->segment('4',0);
		$condition2 = array('job_cases.id' => $caseid);
		$res = $this->cancel_model->getJobCases($condition2);
		if($res->num_rows() == 0)
		{
			//Notification message
			$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('Invalid input given')));
			redirect_admin('jobCases/viewCases');
		}
		$this->load->model('user_model');
		$this->load->model('skills_model');
		$projectCase = $res->row();
		
	
		$uid = $projectCase->user_id;
		$prid = $projectCase->job_id;
		$ures = $this->user_model->getUsers(array('users.id' => $uid),'roles.role_name,roles.id as rid,users.id as uid');
		$urow = $ures->row();

		$conditions = array('job_id' => $prid,'review_type' => $urow->rid);
		$reviews = $this->skills_model->getReviews($conditions,'reviews.comments,reviews.review_type,reviews.job_id');
		$this->outputData['numReviews'] = $reviews->num_rows();
		$this->outputData['userReviews'] = $reviews->row();
		
		$this->outputData['projectCase'] = $res;
		
		$condition3 = array('job_cases.parent' => $caseid);
		$this->outputData['caseResolution'] = $this->cancel_model->getJobCases($condition3);
		
		//Load View
	   	$this->load->view('admin/dispute/view',$this->outputData);
	   
	}//End of view function
	
	// --------------------------------------------------------------------
	
	/**
	 * Change the case type
	 *
	 * @access	private
	 * @param	nil
	 * @return	content
	 */
	function changeCaseType()
	{
		//prepare insert data
		$updateData                  	  	= array();	
		$updateData['case_type']  		= $this->uri->segment('5');
		
		//update case
		$this->cancel_model->updateProjectCase($this->uri->segment('4'),$updateData);
		
		$insertData                  	  	= array();	
		$insertData['created']				= get_est_time();
		$insertData['parent']				= $this->uri->segment('4');
		$insertData['admin_id']				= $this->session->userdata('user_id');
		if($updateData['case_type'] == 'Dispute'){
			$insertData['updates']			= $this->lang->line('cancellation to dispute');
			
			//Create Case
			$this->cancel_model->insertJobCase($insertData);
			
			//Get case details
			$cond = array('job_cases.id' => $insertData['parent']);
			$cres = $this->cancel_model->getJobCases($cond,NULL,'job_cases.job_id');
			$crow = $cres->row();
			
			//Create disputes
			$insertData2                  	  	= array();	
			$insertData2['case_id']			= $this->uri->segment('4');
			$insertData2['job_id']			= $crow->project_id;
			$this->cancel_model->insertValues('dispute_agree',$insertData2);
		}
		
		$condition2 = array('job_cases.id' => $this->uri->segment('4'));
		$res = $this->cancel_model->getJobCases($condition2);
		$data = $res->row();
		
		$buyer_email = getUserDetails($data->creator_id,'email');
		$buyer_name = getUserDetails($data->creator_id,'user_name');
		$provider_email = getUserDetails($data->employee_id,'email');
		$provider_name = getUserDetails($data->employee_id,'user_name');
		
		//Send Mail to buyer
		$conditionUserMail = array('email_templates.type'=>'changeto_dispute_case');
		$result            = $this->email_model->getEmailSettings($conditionUserMail);
		$rowUserMailConent = $result->row();
		//Update the details
		$splVars = array("!project_name" => '<a href="'.site_url('job/view/'.$data->job_id).'">'.$data->job_name.'</a>',"!user" => $buyer_name,'!site_title' => $this->config->item('site_title'),"!contact_url" => site_url('contact'),"!link" => site_url('dispute/viewCase/'.$this->uri->segment('4')));
		
		$mailSubject = strtr($rowUserMailConent->mail_subject, $splVars);
		$mailContent = strtr($rowUserMailConent->mail_body, $splVars);
		$toEmail     = $buyer_email;
		$fromEmail   = $this->config->item('site_admin_mail');
		$this->email_model->sendHtmlMail($toEmail,$fromEmail,$mailSubject,$mailContent);
		
		//Send Mail to provider
		//Update the details
		$splVars2 = array("!project_name" => '<a href="'.site_url('job/view/'.$data->job_id).'">'.$data->job_name.'</a>',"!user" => $provider_name,'!site_title' => $this->config->item('site_title'),"!contact_url" => site_url('contact'),"!link" => site_url('dispute/viewCase/'.$this->uri->segment('4')));
		
		$mailSubject2 = strtr($rowUserMailConent->mail_subject, $splVars2);
		$mailContent2 = strtr($rowUserMailConent->mail_body, $splVars2);
		$toEmail2    = $buyer_email;
		$this->email_model->sendHtmlMail($toEmail_provider,$fromEmail_provider,$mailSubject_provider,$mailContent_provider);
		echo $this->lang->line("Case changed to dispute");
		
	}//End of changeCaseType function
	
	// --------------------------------------------------------------------
	
	/**
	 * Change the case status
	 *
	 * @access	private
	 * @param	nil
	 * @return	content
	 */
	function changeCaseStatus(){
	
		
		//prepare insert data
		$updateData                  	  	= array();	
		$updateData['status']  		= $this->uri->segment('5');
		
		//update case
		$this->cancel_model->updateProjectCase($this->uri->segment('4'),$updateData);
		
		$insertData                  	= array();	
		$insertData['created']			= get_est_time();
		$insertData['parent']			= $this->uri->segment('4');
		$insertData['admin_id']			= $this->session->userdata('user_id');
		if($updateData['status'] == 'closed'){
			$insertData['updates']		= $this->lang->line('case closed');
			//Create Case
			$this->cancel_model->insertJobCase($insertData);
		}
		
		$condition2 = array('job_cases.id' => $this->uri->segment('4'));
		$res = $this->cancel_model->getJobCases($condition2);
		$data = $res->row();
		
		$buyer_email = getUserDetails($data->creator_id,'email');
		$buyer_name = getUserDetails($data->creator_id,'user_name');
		$provider_email = getUserDetails($data->programmer_id,'email');
		$provider_name = getUserDetails($data->programmer_id,'user_name');
		
		//Send Mail to Owner
		$conditionUserMail = array('email_templates.type'=>'case_closed');
		$result            = $this->email_model->getEmailSettings($conditionUserMail);
		$rowUserMailConent = $result->row();
		//Update the details
		$splVars = array("!project_name" => '<a href="'.site_url('job/view/'.$data->job_id).'">'.$data->job_name.'</a>',"!user" => $buyer_name,'!site_title' => $this->config->item('site_title'),"!contact_url" => site_url('contact'),"!link" => site_url('dispute/viewCase/'.$this->uri->segment('4')));
		
		$mailSubject = strtr($rowUserMailConent->mail_subject, $splVars);
		$mailContent = strtr($rowUserMailConent->mail_body, $splVars);
		$toEmail     = $buyer_email;
		$fromEmail   = $this->config->item('site_admin_mail');
		$this->email_model->sendHtmlMail($toEmail,$fromEmail,$mailSubject,$mailContent);
		
		//Send Mail to Employee
		//Update the details
		$splVars2 = array("!project_name" => '<a href="'.site_url('job/view/'.$data->job_id).'">'.$data->job_name.'</a>',"!user" => $provider_name,'!site_title' => $this->config->item('site_title'),"!contact_url" => site_url('contact'),"!link" => site_url('dispute/viewCase/'.$this->uri->segment('4')));
		
		$mailSubject2 = strtr($rowUserMailConent->mail_subject, $splVars2);
		$mailContent2 = strtr($rowUserMailConent->mail_body, $splVars2);
		$toEmail2    = $buyer_email;
		$this->email_model->sendHtmlMail($toEmail_provider,$fromEmail_provider,$mailSubject_provider,$mailContent_provider);
		echo $this->lang->line("Case is closed");
		
	}//End of changeCaseStatus function
	
	// --------------------------------------------------------------------
	
	/**
	 * Cancel the job over dispute
	 *
	 * @access	private
	 * @param	nil
	 * @return	content
	 */
	function cancelProject(){
	
		$project_id = $this->uri->segment('4');
		$updateKey  = array('jobs.id'=>$project_id);
		$updateData['job_status'] = '3';

		//Cancel job
		$this->skills_model->updateJobs(NULL,$updateData,$updateKey);
		
		$insertData                  	  	= array();	
		$insertData['created']			= get_est_time();
		$insertData['parent']			= $this->uri->segment('5');
		$insertData['admin_id']			= $this->session->userdata('user_id');
		$insertData['updates']			= $this->lang->line('Job cancelled');
		
		//Update Case
		$this->cancel_model->insertJobCase($insertData);
		
		$condition2 = array('job_cases.id' => $this->uri->segment('5'));
		$res = $this->cancel_model->getJobCases($condition2);
		$data = $res->row();
		
		$buyer_email = getUserDetails($data->creator_id,'email');
		$buyer_name = getUserDetails($data->creator_id,'user_name');
		$provider_email = getUserDetails($data->employee_id,'email');
		$provider_name = getUserDetails($data->employee_id,'user_name');
		
		//Send Mail to buyer
		$conditionUserMail = array('email_templates.type'=>'project_cancelled_admin');
		$result            = $this->email_model->getEmailSettings($conditionUserMail);
		$rowUserMailConent = $result->row();
		//Update the details
		$splVars = array("!project_name" => '<a href="'.site_url('job/view/'.$data->job_id).'">'.$data->job_name.'</a>',"!user" => $buyer_name,'!site_title' => $this->config->item('site_title'),"!contact_url" => site_url('contact'),"!link" => site_url('dispute/viewCase/'.$this->uri->segment('5')),"!case_id"=>$this->uri->segment('4'));
		
		$mailSubject = strtr($rowUserMailConent->mail_subject, $splVars);
		$mailContent = strtr($rowUserMailConent->mail_body, $splVars);
		$toEmail     = $buyer_email;
		$fromEmail   = $this->config->item('site_admin_mail');
		$this->email_model->sendHtmlMail($toEmail,$fromEmail,$mailSubject,$mailContent);
		
		//Send Mail to provider
		//Update the details
		$splVars2 = array("!project_name" => '<a href="'.site_url('job/view/'.$data->job_id).'">'.$data->job_name.'</a>',"!user" => $provider_name,'!site_title' => $this->config->item('site_title'),"!contact_url" => site_url('contact'),"!link" => site_url('dispute/viewCase/'.$this->uri->segment('5')),"!case_id"=>$this->uri->segment('4'));
		
		$mailSubject2 = strtr($rowUserMailConent->mail_subject, $splVars2);
		$mailContent2 = strtr($rowUserMailConent->mail_body, $splVars2);
		$toEmail2    = $buyer_email;
		$this->email_model->sendHtmlMail($toEmail_provider,$fromEmail_provider,$mailSubject_provider,$mailContent_provider);
		
		echo $this->lang->line("Job is cancelled");
		
	}//End of cancelProject function
	
	// --------------------------------------------------------------------
	
	/**
	 * Remove reviews
	 *
	 * @access	private
	 * @param	nil
	 * @return	content
	 */
	function removeReview(){
		//Load helpers
		$this->load->helper('reviews');
		
		$project_id = $this->uri->segment('4');
		$user_type = $this->uri->segment('5');
		$userid = $this->uri->segment('6');
		
		$toEmail = getUserDetails($userid,'email');
		$uname = getUserDetails($userid,'user_name');
		$num_rev = getUserDetails($userid,'num_reviews');
		
		//remove review
		$conditions = array('job_id' => $job_id,'review_type' => $user_type);
		//pr($conditions);exit;
		$this->cancel_model->deleteReview($conditions);
		
		//Reduce number of reviews for user
		if($this->db->affected_rows() == 1){
			$rType = 'buyer_id';
			if($user_type == 2)
			$rType = 'provider_id';
			$rating = getAvgReview($userid,$rType);
			$updateData = array('user_rating' => $rating,'num_reviews' => $num_rev-1);
			$this->skills_model->updateUsers($userid,$updateData);
		}
		
		//Get job details
		$conditions2 = array('jobs.id' => $project_id);
		$res = $this->skills_model->getProjects($conditions2,'jobs.id,jobs.job_name');
		$prow = $res->row();
		
		//Send Mail to users
		$conditionUserMail = array('email_templates.type'=>'remove_review');
		$result            = $this->email_model->getEmailSettings($conditionUserMail);
		$rowUserMailConent = $result->row();
		//Update the details
		$splVars = array("!project_name" => site_url('job/view/'.$prow->id),"!user" => $uname,'!project_title' => $prow->job_name,'!site_title' => $this->config->item('site_title'),"!contact_url" => site_url('contact'));
		
		$mailSubject = strtr($rowUserMailConent->mail_subject, $splVars);
		$mailContent = strtr($rowUserMailConent->mail_body, $splVars);
		$toEmail     = $toEmail;
		$fromEmail   = $this->config->item('site_admin_mail');
		$this->email_model->sendHtmlMail($toEmail,$fromEmail,$mailSubject,$mailContent);
		
		echo $this->lang->line("Review is removed");
		
	}//End of removeReview function
	
}
//End  jobCases Class

/* End of file jobCases.php */ 
/* Location: ./application/controllers/administration/jobCases.php */
?>