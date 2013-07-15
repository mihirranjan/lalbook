<?php 

 /*
  ****************************************************************************
  ***                                                                      ***
  ***      BIDONN 1.0                                                      ***
  ***      File:  job.php                                                  ***
  ***      Built: Mon June 14 10:36:40 2012                                ***
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

class Requirement extends CI_Controller {
 
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
		
		
		//Load the helper file reviews
		$this->load->helper('reviews');
		
		//language file
		$this->lang->load('enduser/common', $this->config->item('language_code'));
		$this->lang->load('enduser/job', $this->config->item('language_code'));
		

		//Load Models
		$this->load->model('requirement_model');
		$this->load->model('common_model');
		$this->load->model('skills_model');
		$this->load->model('user_model');
		$this->load->model('account_model');
		$this->load->model('settings_model');
		$this->load->model('file_model');
		$this->load->model('email_model');
		$this->load->model('messages_model');	
		$this->load->model('credential_model');
		$this->load->model('category_model');		
		//Page Title and Meta Tags
		$this->outputData = $this->common_model->getPageTitleAndMetaData();
		
		//Get Top programmers
		$topProgrammers = $this->common_model->getPageTitleAndMetaData();
		
		//Get Logged In user
		$this->loggedInUser					= $this->common_model->getLoggedInUser();
		$this->outputData['loggedInUser'] 	= $this->loggedInUser;
		
		//Get Countries
		$this->outputData['countries']	=	$this->common_model->getCountries();
		
		//Currency Type
		$this->outputData['currency'] = $this->db->get_where('settings', array('code' => 'CURRENCY_TYPE'))->row()->string_value;
		//$this->outputData['currency'] = $this->db->get_where('currency', array('currency_type' => $currency_type))->row()->currency_symbol;
         //Get Footer content
		$this->outputData['pages']	= $this->common_model->getPages();
		
		//Get Latest jobs
		$limit_latest = $this->config->item('latest_projects_limit');
		$limit3 = array($limit_latest);
		$this->outputData['latestJobs']	= $this->skills_model->getLatestJobs($limit3);
		
		//Get draft jobs
		if(isset($this->loggedInUser->id))
		{
		$flag=0;
		$condition = array('draftjobs.creator_id' => $this->loggedInUser->id,'draftjobs.flag'=>$flag);
		$this->outputData['draftJobs']	= $this->skills_model->getDraft($condition);

		$conditions  = array('user_list.creator_id'=>$this->loggedInUser->id,'user_list.user_role'=>'1');
		$this->outputData['favouriteUsers']  = $this->user_model->getFavourite($conditions);
		$this->outputData['project_period']    =  $this->config->item('project_period');
        }
		
		 //Post the maximum size of memory limit
		$maximum        = $this->config->item('upload_limit');
 	    $this->outputData['maximum_size'] = $maximum;
		if($this->loggedInUser)
		{
			//Conditions
			 $conditions							= array('files.user_id'=>$this->loggedInUser->id);
			 $this->outputData['fileInfo'] 			= $this->file_model->getFile($conditions);
		}
		
		//Get Certificate User 
		
		   if($this->loggedInUser)
		    {
	
		    $condition=array('subscriptionuser.username'=>$this->loggedInUser->id);
			
			$userlists= $this->credential_model->getCertificateUser($condition);
			
		    if($userlists->num_rows()>0)
			{
			 // get the validity
			 $validdate=$userlists->row();
			 $end_date=$validdate->valid; 
		     $created_date=$validdate->created;
			 $valid_date=date('d/m/Y',$created_date);
			
			   $next=$created_date+($end_date * 24 * 60 * 60);
	           $next_day= date('d/m/Y', $next) ."\n";
			
			 if(time()<=$next)
			 {
		$paymentSettings = $this->settings_model->getSiteSettings();
		
  	    $this->outputData['feature_project']   = $paymentSettings['FEATURED_PROJECT_AMOUNT_CM'];
		$this->outputData['urgent_project']    = $paymentSettings['URGENT_PROJECT_AMOUNT_CM'];
		$this->outputData['hide_project']      = $paymentSettings['HIDE_PROJECT_AMOUNT_CM'];
		$this->outputData['private_project']   = $paymentSettings['PRIVATE_PROJECT_AMOUNT_CM'];
			}
	
		else
		{
		//Initital payment settings for jobs
		$paymentSettings = $this->settings_model->getSiteSettings();
  	    $this->outputData['feature_project']   = $paymentSettings['FEATURED_PROJECT_AMOUNT'];
		$this->outputData['urgent_project']    = $paymentSettings['URGENT_PROJECT_AMOUNT'];
		$this->outputData['hide_project']      = $paymentSettings['HIDE_PROJECT_AMOUNT'];
		$this->outputData['private_project']   = $paymentSettings['PRIVATE_PROJECT_AMOUNT'];
		}
	}
	else
	{
	   $paymentSettings = $this->settings_model->getSiteSettings();
  	    $this->outputData['feature_project']   = $paymentSettings['FEATURED_PROJECT_AMOUNT'];
		$this->outputData['urgent_project']    = $paymentSettings['URGENT_PROJECT_AMOUNT'];
		$this->outputData['hide_project']      = $paymentSettings['HIDE_PROJECT_AMOUNT'];
		$this->outputData['private_project']   = $paymentSettings['PRIVATE_PROJECT_AMOUNT'];
	}		
		}
	} //Constructor End 
	// --------------------------------------------------------------------
	
	/**
	 * discard draft project by owner
	 *
	 * @access	private
	 * @param	nil
	 * @return	void
	 */ 
	function deleteDraft()
	{	
	
	if($this->uri->segment(3))
	  {
	    $condition = array('draftjobs.id'=>$this->uri->segment(3));
		$this->skills_model->deletedraftprojects($condition);
		$this->session->set_flashdata('flash_message', $this->common_model->flash_message('success',$this->lang->line('Draft Job Deleted Successfully')));
		redirect('job/create');
	  }	else{
	   $this->session->set_flashdata('flash_message', $this->common_model->flash_message('error','Already Drafted Projects were deleted'));
	   redirect('job/create');
	  }	
	  
	}
	/**
	 * Post new jobs by owner
	 *
	 * @access	private
	 * @param	nil
	 * @return	void
	 */ 
	function create(){	
		$this->load->model('common_model');
		$this->lang->load('enduser/account', $this->config->item('language_code'));

		$this->outputData['current_page'] = 'post_job';

		$result = '0';
		$manage = '1';
		$this->outputData['showPreview']			= false;
		
		//Load Language
		$this->lang->load('enduser/requirement');
		
		$this->load->model('email_model');
		//$this->outputData['created']          = get_est_time();
		//$this->outputData['enddate']          = get_est_time() + ($this->input->post('openDays') * 86400);
		
		//load validation libraray
		$this->load->library('form_validation');
		
		//Load Form Helper
		$this->load->helper('form');
		
		//Intialize values for library and helpers	
		$this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
		
		
		$field_data = array();
		$field_data['lookingfor'] = "";
		$field_data['reqtype'] = "";
		$field_data['industry'] = "";
		$field_data['budget'] = "";
		$field_data['enddate'] = "";
		$field_data['tags'] = "";
		$field_data['description'] = "";
		$field_data['f_error'] = "";
		//Get Form Data	
		if($this->input->post('submitJob')){	
			
			//Set rules
			$this->form_validation->set_rules('lookingfor','what service you need','required|trim|min_length[5]|xss_clean|alpha_space');
			$this->form_validation->set_rules('reqtype','Requirement type','required');
			$this->form_validation->set_rules('industry','Industry type','required');
			$this->form_validation->set_rules('budget','budget','required');
			$this->form_validation->set_rules('enddate','enddate','required');
			$this->form_validation->set_rules('tags','Tags','required');
			$this->form_validation->set_rules('description','description','required|trim|xss_clean|callback__emailpresent_check|callback__phonenumber_check');
			$this->form_validation->set_rules('attachments','attachment');
			
			$field_data['lookingfor'] = $this->input->post('lookingfor');
			$field_data['reqtype'] = $this->input->post('reqtype');
			$field_data['industry'] = $this->input->post('industry');
			$field_data['budget'] = $this->input->post('budget');
			$field_data['enddate'] = $this->input->post('enddate');
			$field_data['tags'] = $this->input->post('tags');
			$field_data['description'] = $this->input->post('description');
			
			
			
			if($this->form_validation->run()){
				//This is condition check for post similar job
				if(!$this->loggedInUser){
					$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('You must be login access to this page')));
					redirect('information');
				}else{ 	  
					$insertData              		  	= array();	
					$insertData['description']      	= $this->input->post('description');
					$filename =  $_FILES['attachments']['name'];
					if(isset($filename) && $filename!=''){
							$fname = explode(".",$filename);
							$ext = $fname[1];
							$config['upload_path'] 		='files/job_attachment/';
							$config['max_size'] 		= $this->config->item('max_upload_size');
							$config['encrypt_name'] 	= TRUE;
							$config['remove_spaces'] 	= TRUE;
							$config['allowed_types'] 	='jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF';
							$this->load->library('upload', $config);
			
						// check if the file is upload or not.
						if ($ext=='jpeg' || $ext=='jpg' || $ext=='png' || $ext=='gif' || $ext=='JPEG' || $ext=='JPG' || $ext=='PNG' || $ext=='GIF'){
							
							$size = getimagesize($_FILES['attachments']['tmp_name']); 
							//echo $size['mime'];
							if($size['mime'] == "image/gif" || $size['mime'] == "image/jpeg" || $size['mime'] == "image/png"){
								$rootpath =  $_SERVER['DOCUMENT_ROOT'];
								//echo $rootpath.'/lalbook/files/job_attachment/'.$filename;
								$upload = $rootpath.'/lalbook/files/job_attachment/'.$filename;
								$up =  move_uploaded_file($_FILES['attachments']['tmp_name'],$upload);

								$insertData['requirement_image']    =$_FILES['attachments']['name'];
							}else{
								
								$field_data['f_error']= "This is not a image file. Please upload a image file only";
							}
						} else {
							
							$field_data['f_error'] = "Please upload valid file formats";
						}	
					}
					if(isset($this->outputData['file'])){	
						// $insertData['requirement_image']=$this->data['file']['file_name'];  /*$insertData['attachment_name']=$this->data['file']['orig_name'];*/ 
						$insertData['requirement_image']= $this->outputData['file']['file_name'];
					}	
					
					
					if($field_data['f_error'] ==""){
						$strc=$this->input->post('enddate');
						$endngdates=date('Y-m-d',strtotime($strc));
						$insertData['description']    	= $this->input->post('description');	

						$insertData['looking_for']    	    = $this->input->post('lookingfor');	
						$insertData['requirements']    	  	    = $this->input->post('reqtype');	
						$insertData['budget']    	  	    = $this->input->post('budget'); 
						$insertData['end_date']    	  	= $endngdates;
						//  $insertData['requirement_image']       	= $this->input->post('budget_max');
						$insertData['category']       	= $this->input->post('industry');
						$insertData['tags']= $this->input->post('tags');

						$insertData['status']='open';
						$insertData['creator_id']       	= $this->loggedInUser->id;
						$creditconditions= array('users.id'=>$this->loggedInUser->id);
						$this->outputData['credits'] =$this->user_model->getUsers($creditconditions);

						$usrcredit=$this->outputData['credits'];
						$credit_detail=$usrcredit->result();

						$creatddate= get_est_time();
						$insertData['created']=$creatddate;


						$this->requirement_model->createRequirement($insertData);


						$conditionUserMail = array('email_templates.type'=>'projectpost_notification');
						$result            = $this->email_model->getEmailSettings($conditionUserMail);
						$rowUserMailConent = $result->row();
						
						$splVars = array("!site_name" => $this->config->item('site_title'),"!projectname" =>$insertData['looking_for'],"!username" => $this->loggedInUser->user_name,"!profile" =>$insertData['category'], "!projectid" => $this->db->insert_id(),"!date"=>get_datetime(time()));
						$mailSubject = strtr($rowUserMailConent->mail_subject, $splVars);
						$mailContent = strtr($rowUserMailConent->mail_body, $splVars);		

						$toEmail = $this->loggedInUser->email;
						$fromEmail = $this->config->item('site_admin_mail');
						
						
						$this->load->library('email');
						$this->email->set_newline("\r\n");
						$this->email->from($fromEmail);
						//$toEmail = "mihir.mishra85@gmail.com";
						$this->email->to($toEmail);


						$this->email->subject($mailSubject);		
						$this->email->message($mailContent);

						if($this->email->send()){
							$this->session->set_flashdata('flash_message', $this->common_model->flash_message('success',$this->lang->line('Your Requirement has been Submitted Successfully')));
							redirect('redirection');
						}else{
							redirect('redirection');
						}
						
					
					}
					
				
				}//Form Validation End
				
				
				
				
				
			}//If - Form Submission End
	
		}
		$this->outputData['field_data'] = $field_data;
		$this->load->view('requirement/view_postrequirement',$this->outputData);
	} 
	
	function industry(){
		if(isset($_REQUEST['business_id'])){
			$business_id = $_REQUEST['business_id'];
			$ind_id = $_REQUEST['ind_id'];
			
			
			if($business_id==3){
				$sql_city = "SELECT * FROM category ";
			}else{
				$sql_city = "SELECT * FROM category where cate_type='$business_id'";
			}	
			
			$query = $this->db->query($sql_city);
			$this->outputData['result_city'] = $query->result();
			$this->outputData['ind_id'] = $ind_id;
			$this->load->view('industry',$this->outputData);
		}
		
	}
	
	function download()
	{
		$this->load->library('zip');
		$this->load->helper('download');
		$this->load->helper('users');
		// initiallize the data variable in to array
		$this->data = array();
		
		 // get the key value 
		$value=$this->uri->segment(3,0); 
		 // Assign the base path.
		$base_path = base_url().'files/';
		$data = file_get_contents_curl($base_path.'job_attachment/'.$value); 
		$name = $value;
		// Apply the download function
		force_download($name, $data);
	}
	
	
	// --------------------------------------------------------------------	
	
	/**
	 * function create bid the programmer will create bid for the job
	 *
	 * @access	public for programmer
	 * @param	nil
	 * @return	void
	 */ 
	function createBid()
	{	

		//Load Language
		$this->lang->load('enduser/bid', $this->config->item('language_code'));

		//Check For owner Session
		if(!isEmployee())
		{
        	$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('You must be logged in as a Employee to bid jobs')));
			redirect('information');
		}	
		
		//load validation libraray
		$this->load->library('form_validation');
		
		//Load Form Helper
		$this->load->helper('form');
		
		//Intialize values for library and helpers	
		$this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));

		//Get Form Data	
		if($this->input->post('postBid'))
		{	
			//Set rules
			$this->form_validation->set_rules('bidAmt','lang:Bid_Amount_validation','required|is_natural_no_zero|trim|xss_clean');
			
			$this->form_validation->set_rules('days','lang:Bid_days_validation','required|numeric|trim|xss_clean');
			$this->form_validation->set_rules('hours','lang:Hours','numeric|trim|xss_clean');
			$this->form_validation->set_rules('message2','lang:description_validation','required|trim|xss_clean');
			
			if($this->form_validation->run())
			{
				  $insertData              		  	= array();	
			      $insertData['job_id']  	  		= $this->input->post('project_id');
				  $insertData['user_id']      		= $this->loggedInUser->id;
				  $insertData['bid_days']    	  	= $this->input->post('days');
				  $insertData['bid_hours']    	  	= $this->input->post('hours');
				  $insertData['bid_amount']       	= $this->input->post('bidAmt');
				  $insertData['bid_time']       	= get_est_time();
				  $insertData['bid_desc']       	= $this->input->post('message2');
				  if($this->input->post('notify'))
				    $insertData['lowbid_notify']       	= $this->input->post('notify');
				  if($this->input->post('escrow'))
				    $insertData['escrow_flag']       	= $this->input->post('escrow');
					
				 //Create bids
				 $this->skills_model->createBids($insertData);
				 
				 //Load Model For Mail
				 $this->load->model('email_model');
				  
				 //Send Mail
				 $conditionUserMail = array('email_templates.type'=>'bid_notice');
				 $result            = $this->email_model->getEmailSettings($conditionUserMail);
				 $rowUserMailConent = $result->row();
				 
				 //Job details
				 $condition = array('jobs.id' => $insertData['job_id']);
				 $job = $this->skills_model->getJobs($condition);
				 $jobDetails = $job->row();
				 
				 //User details
				 $condition2 = array('users.id' => $jobDetails->creator_id);
				 $user = $this->user_model->getUsers($condition2,'users.user_name,users.email');
				 $userDetails = $user->row();
				 
				 //employee details
				 $condition3 = array('users.id' => $insertData['user_id']);
				 $employee = $this->user_model->getUsers($condition3,'users.user_name');
				 $employeeDetails = $employee->row();
				 
				$btime = ''; 
				if($insertData['bid_hours'] == 0 && $insertData['bid_days'] == 0) 
					$btime .= $this->lang->line('Immediately'); 
				elseif($insertData['bid_days'] != 0) 
					$btime .= $insertData['bid_days'].$this->lang->line('days');
                if($insertData['bid_hours'] != 0) 
					$btime .= $insertData['bid_hours']." ".$this->lang->line('hours');
				 
				 $splVars = array("!project_name" => '<a href="'.site_url('job/view/'.$jobDetails->id).'">'.$jobDetails->job_name.'</a>',"!user_name" => $jobDetails->user_name,"!provider_name" => $employeeDetails->user_name,"!contact_url" => site_url('contact'),'!site_name' => $this->config->item('site_title'),'!bid_time' => $btime,'!bid_amt' => $this->outputData['currency'].$insertData['bid_amount']);
				  $mailSubject = strtr($rowUserMailConent->mail_subject, $splVars);
				  $mailContent = strtr($rowUserMailConent->mail_body, $splVars);
				  $toEmail     = $userDetails->email;
				  $fromEmail   = $this->config->item('site_admin_mail');
				 $this->email_model->sendHtmlMail($toEmail,$fromEmail,$mailSubject,$mailContent);
				 
				 //Notify Low bid
					$this->skills_model->lowBidNotification($insertData['bid_amount'],$jobDetails->id);

				  //Notification message
				  $this->session->set_flashdata('flash_message', $this->common_model->flash_message('success',$this->lang->line('Your bid Has Been Posted Successfully')));
				  redirect('job/view/'.$insertData['job_id']);
			}//Form Validation End
			else{
				 
				$job_id = $this->input->post('project_id');
				 
  				$conditions = array('jobs.id'=>$job_id);
				$this->outputData['jobs']	 =  $this->skills_model->getJobs($conditions);
				
				$conditions = array('bids.user_id'=>$this->loggedInUser->id,'bids.job_id'=>$job_id);
				$this->outputData['bid']  =  $this->skills_model->getBids($conditions);
				
				$this->outputData['job_id'] = $job_id;
				//Get Total Messages
				$this->load->model('messages_model');
				$message_conditions = array('messages.job_id'=>$job_id);
				$this->outputData['totalMessages']	    =  $this->messages_model->getTotalMessages($message_conditions);
			}
		}//If - Form Submission End
		else{
			 
				if($this->uri->segment(3,0))
 				$job_id = $this->uri->segment(3,0);
				
 				$conditions = array('jobs.id'=>$job_id);
				$this->outputData['jobs']	 =  $this->skills_model->getJobs($conditions);
				
				$conditions = array('bids.user_id'=>$this->loggedInUser->id,'bids.job_id'=>$job_id);
				$this->outputData['bid']  =  $this->skills_model->getBids($conditions);
				
				$this->outputData['job_id'] = $job_id;
				//Get Total Messages
				$this->load->model('messages_model');
				$message_conditions = array('messages.job_id'=>$job_id);
				$this->outputData['totalMessages']	    =  $this->messages_model->getTotalMessages($message_conditions);
		}
		$this->load->view('job/view_postBid',$this->outputData);
	} //Function create bid End
	// --------------------------------------------------------------------
	
	/**
	 * Programmer will edit the placed bid for the project
	 *
	 * @access	public for programmer
	 * @param	nil
	 * @return	void
	 */ 
	function editBid()
	{	

		//Load Language
		$this->lang->load('enduser/bid', $this->config->item('language_code'));

		//Check For owner Session
		if(!isEmployee())
		{
        	$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('You must be logged in as a Employee to bid jobs')));
			redirect('information');
		}	
		
		//load validation libraray
		$this->load->library('form_validation');
		
		//Load Form Helper
		$this->load->helper('form');
		
		//Intialize values for library and helpers	
		$this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
	
		//Get Form Data	
		if($this->input->post('postBid'))
		{	
			//Set rules
			$this->form_validation->set_rules('bidAmt','lang:Bid_Amount_validation','required|is_natural_no_zero|trim|xss_clean');
			/*if(!$this->input->post('hours') && $this->input->post('hours') == "")
			$this->form_validation->set_rules('days','lang:Bid_days_validation','required|numeric|trim|xss_clean');
			$this->form_validation->set_rules('hours','lang:Bid_days_validation','numeric|trim|xss_clean');*/
			
			$this->form_validation->set_rules('days','lang:Bid_days_validation','required|numeric|trim|xss_clean');
			$this->form_validation->set_rules('hours','lang:Hours','numeric|trim|xss_clean');
			$this->form_validation->set_rules('message2','lang:description_validation','required|trim|xss_clean');
			if($this->form_validation->run())
			{
				  $updateData              		  	= array();	
			      $updateData['job_id']  	  	= $this->input->post('project_id');
				  $updateData['user_id']      		= $this->loggedInUser->id;
				  $updateData['bid_days']    	  	= $this->input->post('days');
				  $updateData['bid_hours']    	  	= $this->input->post('hours');
				  $updateData['bid_amount']       	= $this->input->post('bidAmt');
				  $updateData['bid_desc']       	= $this->input->post('message2');
				  
				  //Create bids
				  $this->skills_model->updateBids($this->input->post('bidId'),$updateData);
				  				  
				  //Notification message
				  $this->session->set_flashdata('flash_message', $this->common_model->flash_message('success',$this->lang->line('Your bid Has Been edited Successfully')));
				  redirect('job/view/'.$updateData['job_id']);
			}//Form Validation End
			else{
				//Get Job Id
				$job_id = $this->input->post('project_id');
				$conditions = array('bids.user_id'=>$this->loggedInUser->id,'bids.job_id'=>$job_id);
				$this->outputData['bid']  =  $this->skills_model->getBids($conditions);
				
				$conditions1 = array('jobs.id'=>$job_id);
				$this->outputData['jobs']  =  $this->skills_model->getJobs($conditions1);
				$this->outputData['job_id'] = $job_id;
		
				//Get Total Messages
				$this->load->model('messages_model');
				$message_conditions = array('messages.job_id'=>$job_id);
				$this->outputData['totalMessages']	    =  $this->messages_model->getTotalMessages($message_conditions);
			}
		}//If - Form Submission End
		$this->load->view('job/view_postBid',$this->outputData);
	} //Function edit bid End
	// --------------------------------------------------------------------
	
	/**
	 * Loads Categories page.
	 *
	 * @access	public
	 * @param	nil
	 * @return	void
	 */ 
	function category()
	{	
		//Load Language
		$this->lang->load('enduser/listJobs', $this->config->item('language_code'));
		$this->lang->load('enduser/editProfile', $this->config->item('language_code'));
		$this->lang->load('enduser/common', $this->config->item('language_code'));	  	
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
			$this->session->set_userdata('show_num','5');
		}
		
		//Get Category Id
		$category_name = urldecode($this->uri->segment(3,'0'));
		
		//Page Title and Meta Tagsc
		$condition_key        = array('categories.category_name'=>$category_name);
		$result   = $this->common_model->getPageTitle($condition_key);
		$result = $result->row();
		
		if(count($result) > 0)
		{
		$this->outputData['page_title'] 			= $this->config->item('site_title').$result->page_title;
		$this->outputData['meta_keywords']			= $result->page_title;
		$this->outputData['meta_description']		= $result->meta_description;
		}
		
		//$category_name = replaceUnderscoreWithSpace($category_name);
		
		//Get current page
		$page = $this->uri->segment(4,'0');
		
		//Get Sorting order
		$field = $this->uri->segment(5,'0');
		
		$order = $this->uri->segment(6,'0');
		$this->outputData['order']	=  $order;
		$this->outputData['field']	=  $field;
		
		$orderby = array();
		if($field)
		    $orderby = array($field,$order);
				
		if(isset($page)===false or empty($page))
		 {
			$page = 1;
	 	 }
		$page_rows = $this->session->userdata('show_num');
		$max = array($page_rows,($page - 1) * $page_rows);
		
		//Get Category information
		//Set Conditions
		 $conditions = array('category_name'=>$category_name);
		 $categories = $this->skills_model->getCategories($conditions); 
		 if($categories->num_rows()>0)
			$category	=  $categories->row(); 
		else{
			 redirect('search/employee/'.$category_name);
		    }
		 
		$this->outputData['category_id']	=  $category->id;
		$this->outputData['category_name']	=  $category->category_name;
		
		//jobs List
		$like  = array('job_categories' => $category_name);
		$this->outputData['jobs']	   =  $this->skills_model->getJobs(NULL,NULL,$like,$max,$orderby);
		$jobs 						   =  $this->skills_model->getJobs(NULL,NULL,$like);
		
		//Pagination
		$this->load->library('pagination');
		$config['base_url'] 	= site_url('job/category/'.$category_name);
		$config['total_rows'] 	= $jobs->num_rows();		
		$config['per_page'] = $page_rows; 
		$config['cur_page'] = $page;
		$this->outputData['page']	=  $page;
		$this->pagination->initialize($config);		
		$this->outputData['pagination']   = $this->pagination->create_links(false,'project');
	    $this->load->view('job/view_listJobs',$this->outputData);
	} //Function category End
	// --------------------------------------------------------------------
	
	/**
	 * Loads job view page.
	 *
	 * @access	public
	 * @param	nil
	 * @return	void
	 */ 
	function view()
	{	
		//Load Language
		$this->lang->load('enduser/common', $this->config->item('language_code'));
		$this->lang->load('enduser/viewJob', $this->config->item('language_code'));
		$this->load->helper('users_helper');
		//Get Job Id
		if($this->uri->segment(3))
		   {
			$job_id	 = $this->uri->segment(3,'0');
			$conditions = array('jobs.id'=>$job_id);
			$this->outputData['jobs']  =  $this->skills_model->getJobs($conditions);
			$result=$this->outputData['jobs'];
			$job_detail=$result->result();
			//Check for the Private job view
			foreach($job_detail as $private)
			 {
					   if(isset($private->is_private))
						{
							if($private->is_private==1 and !$this->loggedInUser)
							 {
							  redirect('users/getProjectDetails/'.$job_id.'/'.$private->private_users.'/'.$private->creator_id);
							 }
							 elseif(isset($this->loggedInUser))
							 { 
								   if($private->is_private==1 and $this->loggedInUser->id!=$private->private_users and $this->loggedInUser->id!=$private->creator_id)
								   {
								   $this->session->set_flashdata('flash_message', $this->common_model->flash_message('success',$this->lang->line('This is not your private job')));
					redirect('information');
								   //redirect('users/getProjectDetails/'.$project_id.'/'.$private->private_users.'/'.$private->creator_id);
								   }
								   
								   
							 }
					  }
				 }
		   }
		else
		   {
		     $this->session->set_flashdata('flash_message', $this->common_model->flash_message('success',$this->lang->line('You can not access to this page')));
			 redirect('information');
		   }
		if(!is_numeric($this->uri->segment(3)))  
		  {
		  	$this->session->set_flashdata('flash_message', $this->common_model->flash_message('success',$this->lang->line('You can not access to this page')));
			 redirect('information');
		  } 
		if(isset($job_id) and isset($this->loggedInUser->id))
		  {
			$updateKey                         = array('job_invitation.job_id'=>$job_id,'job_invitation.receiver_id'=>$this->loggedInUser->id);
		    $updateData['notification_status'] = '1';
		    $this->user_model->updateProgrammerInvitation($updateKey,$updateData);
		  }
		  
		$conditions = array('jobs.id'=>$job_id);
		$this->outputData['jobs']  =  $this->skills_model->getJobs($conditions);
		$result=$this->outputData['jobs'];
		$this->outputData['jobRow'] = $this->outputData['jobs']->row();
		//pr($this->outputData['projectRow']);exit;
		
		if($this->outputData['jobs']->num_rows() == 0)
		{
			//Notification message
			 $this->session->set_flashdata('flash_message', $this->common_model->flash_message('success',$this->lang->line('job_not_available')));
			 redirect('information');
		}

		//echo $this->outputData['projectRow']->creator_id;exit;
		$this->outputData['creatorInfo'] = getUserInformation($this->outputData['jobRow']->creator_id);
		
		$projects = $this->outputData['jobs']->row();
		//pr($projects);exit;
		if(isset($this->loggedInUser->id) and $projects->creator_id==$this->loggedInUser->id)
		
			$conditions = array('bids.job_id'=>$job_id);	 
		else
			$conditions = array('bids.job_id'=>$job_id,'jobs.is_hide_bids' => 0);

		$this->outputData['bids']  =  $this->skills_model->getBids($conditions);
		//pr($this->outputData['bids']->result());exit;

		$this->outputData['projectId'] = $job_id;
		
		if(isset($this->loggedInUser->id))
		 {
			$conditions = array('bids.user_id' => $this->loggedInUser->id,'bids.job_id'=>$job_id);
			$totbid  =  $this->skills_model->getBids($conditions);
			$this->outputData['tot'] = $totbid->row();
		 }
		else
			$this->outputData['tot'] = array();
		
		//Get Total Messages
		$this->load->model('messages_model');
		$message_conditions = array('messages.job_id'=>$job_id);
		$this->outputData['totalMessages']	    =  $this->messages_model->getTotalMessages($message_conditions);
		
	    $this->load->view('job/view_job',$this->outputData);
	} //Function view End
	
	
	/**
	 * Loads draft job view page.
	 *
	 * @access	public
	 * @param	nil
	 * @return	void
	 */ 
	function draftView()
	{	
		 $projectid= $this->input->post('projectid1');
		
		//Load Language
		$this->lang->load('enduser/viewJob', $this->config->item('language_code'));
		$this->outputData['groupsWithCategories']	=	$this->skills_model->getGroupsWithCategory();
		
		//Get Job Id
		 $project_id	 = $this->input->post('draftId');
		  $id			 = $this->input->post('projectid1');
		
		$this->outputData['draftJobsid'] = $project_id;
		$conditions = array('draftjobs.id'=>$project_id);
		$this->outputData['projects']  =  $this->skills_model->getDraft($conditions);
		
		if($this->input->post('draftId') == 'clear')
		 {
		 	redirect('job/deleteDraft/'.$projectid);
		 }
		if($this->input->post('draftId') == 'savedraft')
		 {
		 	redirect('job/create');
		 } 
		if($this->outputData['projects']->num_rows() == 0){
		//Notification message
		  $this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('job_not_available')));
		  redirect('information');
		}
		
		//Get Total Messages
		$this->load->model('messages_model');
		$message_conditions = array('messages.job_id'=>$project_id);
		$this->outputData['totalMessages']	    =  $this->messages_model->getTotalMessages($message_conditions);	
	    $this->load->view('job/view_draftJob',$this->outputData);
	} //Function draftview End
	//-------------------------------------------------------------------------------------
	
	/**
	 * Loads Job Preview page.
	 *
	 * @access	public
	 * @param	nil
	 * @return	void
	 */ 
	function previewJob()
	{	
		//Load Language
		$this->lang->load('enduser/viewJob', $this->config->item('language_code'));
		
		//Get Job Id
		$project_id	 = $this->uri->segment(3,'0');
		$conditions = array('jobs_preview.id'=>$project_id);
		$this->outputData['jobs']  =  $this->skills_model->getpreviewJobs($conditions);
		//print_r($this->outputData['projects']->result());
	    $this->load->view('job/view_previewJob',$this->outputData);
	} //Function previewJob End
	// --------------------------------------------------------------------
	
	/**
	 * Loads postbid page.
	 *
	 * @access	public for Employee
	 * @param	nil
	 * @return	void
	 */ 
	function postBid()
	{	
		//Load Language
		$this->lang->load('enduser/postBid', $this->config->item('language_code'));
		
		//Check For Employee Session
		if(!isEmployee())
		{
        	$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('You must be logged in as a Employee to place a bid')));
			redirect('information');
		}
		  if($this->loggedInUser->suspend_status==1)
		 {
			$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('Suspend Error')));
			redirect('information');
		 }
		//load validation libraray
		$this->load->library('form_validation');
		
		//Load Form Helper
		$this->load->helper('form');
		
		//Intialize values for library and helpers	
		$this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
		
		//Get Job Id
		if($this->uri->segment(3))
    {
		$job_id	 = $this->uri->segment(3,'0');
		$conditions = array('bids.user_id'=>$this->loggedInUser->id,'bids.job_id'=>$job_id);
		$this->outputData['bid']  =  $this->skills_model->getBids($conditions);
		}
		else
		{
		$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('You can not access to this page')));
			redirect('information');
		}
		if(!is_numeric($this->uri->segment(3)))  
		  {
		  	$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('You can not access to this page')));
			 redirect('information');
		  } 
		
		$conditions1 = array('jobs.id'=>$job_id);
		$this->outputData['jobs']  =  $this->skills_model->getJobs($conditions1);
		$this->outputData['job_id'] = $job_id;
		
		//Get Total Messages
		$this->load->model('messages_model');
		$message_conditions = array('messages.job_id'=>$job_id);
		$this->outputData['totalMessages']	    =  $this->messages_model->getTotalMessages($message_conditions);	
	   
	    //Get the favourite usersList
		$favourite_condition           = array('user_list.creator_id'=>$this->loggedInUser->id);
		$this->outputData['favourite'] = $this->user_model->getFavourite($favourite_condition);
	    $this->load->view('job/view_postBid',$this->outputData);
	} //Function postBid End
	// --------------------------------------------------------------------
	
	/**
	 * Loads attachment_check for owner
	 *
	 * @access	public
	 * @param	nil
	 * @return	void
	 */ 
	function attachment_check()
	{
		
		if(isset($_FILES) and $_FILES['attachments']['name']=='')		
		//echo 	$_FILES;	
		return true;
			
		$config['upload_path'] 		='files/job_attachment/';
		$config['allowed_types'] 	='jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF';
		$config['max_size'] 		= $this->config->item('max_upload_size');
		$config['encrypt_name'] 	= TRUE;
		$config['remove_spaces'] 	= TRUE;
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('attachments'))
		{
			
			 $this->data['file'] = $this->upload->data();
			
			return true;			
		} else {
			$this->form_validation->set_message('attachment_check', $this->upload->display_errors($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag')));
			return false;
		}//If end 
	}//Function attachment_check End
	// --------------------------------------------------------------------
	

// For Description field (Check for Phone number) 
	function _phonenumber_check()
	{
		$description=$_POST['description'];
		//$reg = '/(\d)?(\s|-)?(\()?(\d){3}(\))?(\s|-){1}(\d){3}(\s|-){1}(\d){4}/';
		$reg="/\(?[0-9]{3}\)?[-. ]?[0-9]{3}[-. ]?[0-9]{3}/";
		//$reg="/^(083|086|085|086|087)\d{7}$/";

  		 if(preg_match($reg, $description)) {   
	                  $this->form_validation->set_message('_phonenumber_check','Phone numbers Not Allowed');
			  return FALSE;
		}
		else
		{
          	return TRUE;
         }
       
  	}


// For job name  field (Check for Phone number) 		 
	function _phonenumber_projectname_check()
	{
		$projectName=$_POST['projectName'];
		//$reg = '/(\d)?(\s|-)?(\()?(\d){3}(\))?(\s|-){1}(\d){3}(\s|-){1}(\d){4}/';
		$reg="/\(?[0-9]{1}\)?[-. ]?[0-9]{1}[-. ]?[0-9]{1}/";

  		 if(preg_match($reg, $projectName)) {   
	    
              $this->form_validation->set_message('_phonenumber_projectname_check','Phone numbers Not Allowed');
			  return FALSE;
		}
		else
		{
          	return TRUE;
         }
       
  	}	
	
// For Description field (Check for Email Address) 	
	 function _emailpresent_check()
	{	
		$description=$_POST['description'];
		$reg = '/[\s]*[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}/';

		if(preg_match($reg, $description)) {

		$this->form_validation->set_message('_emailpresent_check','Emails Not Allowed');
		return FALSE;
	}
	else
	{
		return TRUE;
	}
}
// For project name  field (Check for E-mail address) 	
	 function _emailpresent_projectname_check()
{
$description=$_POST['projectName'];

$reg = '/[\s]*[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}/';

if(preg_match($reg, $description)) {

$this->form_validation->set_message('_emailpresent_projectname_check','Emails Not Allowed');
return FALSE;
}
else
{
return TRUE;
}
	
}
	
	
	/**
	 * List bids on the particular job
	 *
	 * @access	public
	 * @param	job id
	 * @return	contents
	 */ 
	function showBids()
	{
		//Load Language
		$this->lang->load('enduser/viewJob', $this->config->item('language_code'));
		$this->load->helper('users_helper');
		
		//Get Job Id
		$project_id	 = $this->uri->segment(3,'0');
		
		//Get Job details
		$conditions = array('jobs.id'=>$project_id);
		$project = $this->skills_model->getJobs($conditions);
		$this->outputData['projectRow'] = $project->row();
		
		$this->outputData['creatorInfo'] = getUserInformation($this->outputData['projectRow']->creator_id);
		$conditions = array('bids.job_id'=>$project_id,'jobs.is_hide_bids' => 0);
		$order = $this->uri->segment(4,'0');
		$field = $this->uri->segment(5,'0');
		if($order != 0)
			$orderby = array($field,$order);
		else
			$orderby = array();
		
		$this->outputData['bids']  =  $this->skills_model->getBids($conditions,'',array(),array(),$orderby);
		//pr($this->outputData['bids']->result());exit;
		$this->outputData['ord'] = $order;
		$this->outputData['field'] = $field;
		$this->outputData['projectId'] = $project_id;
		
		if(isset($this->loggedInUser->id))
		 {
			$conditions = array('bids.user_id' => $this->loggedInUser->id,'bids.job_id'=>$project_id);
			$totbid  =  $this->skills_model->getBids($conditions);
			$this->outputData['tot'] = $totbid->row();
		 }
		else
			$this->outputData['tot'] = array();
		$this->load->view('job/showBids',$this->outputData);
	}//Function showBids End
	// --------------------------------------------------------------------
	
	/**
	 * List bids on the particular job to pick a Employee
	 *
	 * @access	public for owner to pick Employee
	 * @param	job id
	 * @return	contents
	 */ 
	function pickEmployee()
	{
		//Load Language
		$this->lang->load('enduser/pickEmployee', $this->config->item('language_code'));
		
		//Get Job Id
		$job_id	 = $this->uri->segment(3,'0');
		$conditions = array('bids.job_id'=>$job_id);
		$order = $this->uri->segment(4,'0');
		
		//Get the favourite usersList
		$favourite_condition           = array('user_list.creator_id'=>$this->loggedInUser->id);
		$this->outputData['favourite'] = $this->user_model->getFavourite($favourite_condition);
		
		if(isset($order))
		  $orderby = array('bid_amount',$order);
		else
		  $orderby = array();
		
		$this->outputData['bids']  =  $this->skills_model->getBids($conditions,'',array(),array(),$orderby);
		$this->outputData['ord'] = $order;
		
		$this->load->view('job/view_pickEmployee',$this->outputData);
	}//Function showBids End
	// --------------------------------------------------------------------
	
	/**
	 * List all jobs
	 *
	 * @access	public for owner
	 * @param	job id
	 * @return	contents
	 */ 
	function viewAllJobs()
	{
		//Load Language
		$this->lang->load('enduser/featuredJobs', $this->config->item('language_code'));
		$this->lang->load('enduser/common', $this->config->item('language_code'));
		$this->lang->load('enduser/editProfile', $this->config->item('language_code'));
		
		
		
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
			$this->session->set_userdata('show_num','100');
		}
		//pr($this->session->userdata);
		$type = $this->uri->segment(3,'0');
		
		if($type == 'is_feature')
		   $this->outputData['pName'] = 'Featured Jobs';
		if($type == 'is_urgent')
		   $this->outputData['pName'] = 'Urgent Jobs';
		if($type == 'all')
		   $this->outputData['pName'] = 'Latest Jobs';
		if($type == 'high_budget')
		   $this->outputData['pName'] = 'High Budget Jobs';
		
	   $page = $this->uri->segment(4,'0');
		//Get Sorting order
	   $field = $this->uri->segment(5,'0');
		
		$order = $this->uri->segment(6,'0');
		$this->outputData['order']	=  $order;
		$this->outputData['field']	=  $field;
		$this->outputData['type']	=  $type;
		$this->outputData['page']	=  $page;
		if(isset($page)===false or empty($page))
		  {
			$page = 1;
		  }
	    $page_rows = $this->session->userdata('show_num');
		$max = array($page_rows,($page - 1) * $page_rows);
	   
	    if($type == 'all')
			$feature_conditions = array('jobs.job_status' => '0');
		elseif($type == 'high_budget')
			$feature_conditions = array('jobs.job_status' => '0','budget_max >=' => '500');
		else
			$feature_conditions = array($type =>1,'jobs.job_status' => '0');
			
		$jobs1 = $this->skills_model->getJobs($feature_conditions,NULL,NULL,$max);
		$projects = $this->skills_model->getJobs($feature_conditions);
		$this->outputData['featureJobs'] = $jobs1;
		$this->load->library('pagination');
		$config['base_url'] 	= site_url('job/viewAllJobs/'.$type);
		$config['total_rows'] 	= $projects->num_rows();		
		$config['per_page'] = $page_rows; 
		$config['cur_page'] = $page;
		$this->pagination->initialize($config);		
		$this->outputData['pagination']   = $this->pagination->create_links(false,'project');
		$this->load->view('job/view_allJobs',$this->outputData);
	}//Function showBids End
	// --------------------------------------------------------------------
	
	/**
	 * List bids on the particular job to pick a Job
	 *
	 * @access	public
	 * @param	job id
	 * @return	contents
	 */ 
	function awardBid()
	{
		//Load Language
		$this->lang->load('enduser/pickEmployee', $this->config->item('language_code'));
		if($this->input->post('pickBid') && $this->input->post('bidid')!='')
		{
		   $bidid      = $this->input->post('bidid');
			$conditions = array('bids.id'=>$bidid);
			$up         = $this->skills_model->awardJob($conditions);
			
			
			if($up == 1){
				//Load Model For Mail
				$this->load->model('email_model');
				$bidres = $this->skills_model->getJobByBid(array('bids.id'=>$bidid));
				$bidres = $bidres->row();
				
				//Get all user post bids 
				$condition  =  array('bids.job_id'=>$bidres->id,'bids.user_id !='=>$bidres->employee_id);
				$bids       =  $this->skills_model->getBids($condition);
				foreach($bids->result() as $bids)
				  {
				    
				  	 $user_condition  =  array('users.id'=>$bids->user_id);
					 $users           =  $this->user_model->getUsers($user_condition);
					 $users           =  $users->row();
					 
					 //Send Mail
					 $conditionUserMail = array('email_templates.type'=>'project_end');
					 $result            = $this->email_model->getEmailSettings($conditionUserMail);
					 $rowUserMailConent = $result->row();
					 $splVars = array("!projectname" => $bidres->job_name,"!sitetitle"=>site_url(), "!contact_url" => site_url('contact'));
					 $mailSubject = strtr($rowUserMailConent->mail_subject, $splVars);
					 $mailContent = strtr($rowUserMailConent->mail_body, $splVars);
					 $toEmail     = $users->email;
					 $fromEmail   = $this->config->item('site_admin_mail');
					 $this->email_model->sendHtmlMail($toEmail,$fromEmail,$mailSubject,$mailContent);
				  }
				//Update the notification status for the proejct to zero
				$updateKey                         = array('jobs.id'=>$bidres->id);
				$updateData['notification_status'] = '0';
				$this->skills_model->updateJobs(NULL,$updateData,$updateKey);
			    
				//Send Mail
				$conditionUserMail = array('email_templates.type'=>'awardBid');
				$result            = $this->email_model->getEmailSettings($conditionUserMail);
				$rowUserMailConent = $result->row();
				$splVars = array("!project_title" => $bidres->job_name, "!bid_url" => site_url('job/acceptJob/'.$bidres->id."/".$bidres->checkstamp),"!deny_url" => site_url('job/denyJob/'.$bidres->id."/".$bidres->checkstamp), "!contact_url" => site_url('contact'));
				$mailSubject = strtr($rowUserMailConent->mail_subject, $splVars);
				$mailContent = strtr($rowUserMailConent->mail_body, $splVars);
				$toEmail = $bidres->email;
				$fromEmail = $this->config->item('site_admin_mail');
				$this->email_model->sendHtmlMail($toEmail,$fromEmail,$mailSubject,$mailContent);
				//Required Escrow
				$condition='bids.id='.$bidid ;
				$query='SELECT * FROM bids WHERE '.$condition;
				$result=$this->db->query($query);
				
				foreach($result->result() as $escrowbids)
				{
				  if($escrowbids->escrow_flag==1)
				  {
				  
						$jobRow_id=$escrowbids->job_id;
						$condition=array('transactions.type'=>'Escrow Transfer', 'transactions.job_id'=>$jobRow_id);
						$transactions=$this->account_model->getTransactions($condition);
						//$transactions->num_rows();
						$transactionrow=$transactions->row();
						if(!is_object($transactionrow)){
						$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('Please add escrow to award the job')));
						redirect('information');
		   }
				else
				{ 
					$status=$transactionrow->status;
					$escrow_projectid=$transactionrow->job_id;
						if($status='' or $escrow_projectid=='' )
						{
						$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('Please add escrow to award the job'))); 
						redirect('information');
				       }
		        
		   }
		 }				 
				}
				//Check for Escrow
				
				$paymentSettings = $this->settings_model->getSiteSettings();
		        $forced_escrow = $this->config->item('forced_escrow');
		        if($forced_escrow==1)
		          {
				//Notification message
				$this->session->set_flashdata('flash_message', $this->common_model->flash_message('success',$this->lang->line('Please send the Escrow Amount')));
				
				redirect('owner/viewMyJobs');
				}
				else
				{
				$this->session->set_flashdata('flash_message', $this->common_model->flash_message('success',$this->lang->line('You have successfully awarded the job')));
				
				redirect('owner/viewMyJobs');
				}
			}
			else
			{
						$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('Please select the Employee')));
				
				redirect('owner/viewMyJobs');
			}
		}else
			{
						$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('Please select the Employee')));
				
				redirect('owner/viewMyJobs');
			}
	
	}//Function awardbid End
	// --------------------------------------------------------------------
	
	/**
	 * Accept job from owner who accepted your bid
	 *
	 * @access	public
	 * @param	job id and checkstamp
	 * @return	contents
	 */ 
	function acceptJob()
	{
		//Load Language
		$this->lang->load('enduser/acceptJob', $this->config->item('language_code'));
		                
		//Check For Employee Session
		if(!isEmployee())
		{
        	$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('You must be logged in as a employee to accept jobs')));
			redirect('users/login');
		}
		
                            
		$job_id	 = $this->uri->segment(3,'0');
		$checkstamp = $this->uri->segment(4,'0');
		
		if(isset($job_id))
		  {
			$updateKey                         = array('jobs.id'=>$job_id);
		    $updateData['notification_status'] = '1';
		    $this->skills_model->updateJobs(NULL,$updateData,$updateKey);
		  }
		
		$conditions = array('jobs.id'=>$job_id,'jobs.checkstamp'=>$checkstamp,'jobs.job_status' => '1','jobs.employee_id' => $this->loggedInUser->id);
		$job = $this->skills_model->getJobs($conditions);
		$jobRow = $job->row();
		
		if(!is_object($jobRow)){
		$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('You cannot accept this job')));
		redirect('information');
		}
		
		//Check Ecrow Released or not
		
		$paymentSettings = $this->settings_model->getSiteSettings();
		$forced_escrow = $this->config->item('forced_escrow');
		 if($forced_escrow==1)
		   {
		    $jobRow_id=$job_id;
			$condition=array('transactions.type'=>'Escrow Transfer', 'transactions.job_id'=>$jobRow_id);
		    $transactions=$this->account_model->getTransactions($condition);
			//$transactions->num_rows();
		     $transactionrow=$transactions->row();
			 if(!is_object($transactionrow)){
		    $this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('You have not released the Escrow Amount')));
		redirect('information');
		}
		else
		{ 
			 $status=$transactionrow->status;
			 $escrow_jobid=$transactionrow->job_id;
				if($status='' or $escrow_jobid=='' )
			   {
				$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('You have not released the Escrow Amount.'))); 
				redirect('information');
			   }
		   }
		   
		  } 
		   //Check User Balance
		$this->load->model('account_model');
		$condition_balance 		 = array('user_balance.user_id'=>$this->loggedInUser->id);
		$results 	 			 = $this->account_model->getBalance($condition_balance);
		if($results->num_rows()>0)
		{
			//get balance detail
			$rowBalance = $results->row();
			$bal = $rowBalance->amount;
			$min_bal = $this->config->item('payment_settings');
			$commission = $this->config->item('provider_commission_amount');
		 
			
				$cond=array('job_id'=>$job_id,'user_id'=>$this->loggedInUser->id);
				$bid_amount=$this->common_model->getTableData('bids',$cond,'bid_amount');
				$bid_amount_fetch=$bid_amount->row();
				
				
				$commission = ($commission*$bid_amount_fetch->bid_amount)/100;
		     	$rem = $bal - $commission;
			
			/*if($bal < $min_bal || $rem < $min_bal){
				$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error','Your account balance is too low'));
				redirect('employee/viewMyJobs');
			}*/
			$updateKey 	= array('user_balance.user_id'=>$this->loggedInUser->id);
			$updateData = array('amount' => $rem);
			$results1 	= $this->account_model->updateBalance($updateKey,$updateData);
			
		}
		else{
			$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error','Your have no balance in your account to accept the jobs'));
			redirect('employee/viewMyJobs');
		}

		$ownerId = $jobRow->creator_id;
		$employeeId = $jobRow->employee_id;
		
		$conditions2 = array('users.id' => $ownerId);
		$owner = $this->user_model->getUsers($conditions2);
		$ownerRow = $owner->row();
		
		$conditions3 = array('users.id' => $employeeId);
		$employee = $this->user_model->getUsers($conditions3);
		$employeeRow = $employee->row();
				
		$updateKey = array(
					'jobs.id' => $job_id,
					'jobs.checkstamp' => $checkstamp,
					'jobs.employee_id' => $employeeId
			   		);
		$updateData = array('jobs.job_status'=> '2');
		$upJob = $this->skills_model->acceptJob($updateKey,$updateData);
		
		/*if(isset($job_id))
		  {
		  
			//Load model
			$this->load->model('settings_model');
			$this->load->model('affiliate_model');
			
			// get jobs for this user
			$condition = array('jobs.id'=>$job_id);
			$mpr = $this->skills_model->getJobs($condition);
			$prj = $mpr->row();
			
			
			// get user
			$condition = array('users.id'=>$this->loggedInUser->id);
			$user_data = $this->user_model->getUsers($condition);	
			
			//$user_data_result = $user_data->result();
			$user_data_row = $user_data->row();
			
				// get affiliate payments
			$affiliate_result 			= $this->affiliate_model->getAffiliatePayment();
			$owner_affiliate_fee 		= $affiliate_result['buyer_affiliate_fee'];
			$programmer_affiliate_fee  	= $affiliate_result['programmer_affiliate_fee'];	
			$owner_min_payout  			= $affiliate_result['buyer_min_payout'];
			$programmer_min_payout   	= $affiliate_result['programmer_min_payout'];	
			$owner_project_fee   		= $affiliate_result['buyer_project_fee'];	
			$programmer_project_fee   	= $affiliate_result['programmer_project_fee'];	
				
			//get affiliate settings
			$settings = $this->settings_model->getSiteSettings();
			
			$provider_settings_fee =  $settings['PROVIDER_COMMISSION_AMOUNT'];
			$featured_project_amount =  $settings['FEATURED_PROJECT_AMOUNT'];	
					
					if($prj->project_status ==2 and $prj->programmer_id == $this->loggedInUser->id and $prj->checkstamp == $checkstamp) {
						
						if(isset($user_data_row->refid) and $user_data_row->refid != "0") {
							$refid = $user_data_row->refid;
							$role_id = $user_data_row->role_id;
							$referral = $user_data_row->user_name;
							$signup_date = $user_data_row->created;
							
							$date_with_time = show_date($signup_date);
							$arr_str = explode(',',$date_with_time);
							$arr = explode(" ",trim($arr_str[1]));
							
							for($i=0; $i<count($arr); $i++) {
								$mon = $arr[1];
								$year = $arr[2];
							}
							
							$signup_date_format = $mon.", ".$year;
							
							$conditions = array('bids.user_id' => $prj->programmer_id,'bids.job_id'=>$prj->id);
							$totbid  =  $this->skills_model->getBids($conditions);
							$result_bid = $totbid->row();
							
							$bid_amount = $result_bid->bid_amount;
							
							if($role_id == 1) {

								if($prj->is_feature == 1) {	
									$featured_project_amount = $settings['FEATURED_PROJECT_AMOUNT'] * ($owner_project_fee/100);
									$provider_percentage_amount = $bid_amount * ($provider_settings_fee/100);
									$commision = $provider_percentage_amount * ($buyer_project_fee/100);	
									$commision_amount	=	$featured_project_amount + $commision;
								} else {
									$provider_percentage_amount = $bid_amount * ($provider_settings_fee/100);
									$commision_amount = $provider_percentage_amount * ($buyer_affiliate_fee/100);	
								}
								
								 
								
								  // insert affiliate sales 					  
								  $clientdate 			= 		$this->config->item('clientdate');
								  $clienttime 			= 		$this->config->item('clienttime');
								  $clientbrowser 		= 		$this->config->item('clientbrowser');
								  $clientip 			= 		$this->config->item('clientip');
								  
								  //prepare insert data
								  $insertData                  	= 		array();	
								  $insertData['refid']  		= 		$refid;
								  $insertData['created_date']  	= 		"$clientdate";
								  $insertData['created_time']  	= 		"$clienttime";
								  $insertData['browser']  		= 		"$clientbrowser";
								  $insertData['ipaddress']  	= 		"$clientip";
								  $insertData['payment']  		= 		$commision_amount;
								  $insertData['referral']  		= 		$referral;
								  $insertData['account_type']  	= 		$role_id;
								  $insertData['signup_date']  	= 		$signup_date;
								  $insertData['signup_date_format']  	= $signup_date_format;
								   //$insertData['is_released']='0';
								  
								  
					
								  //Add Category
								  $this->affiliate_model->addAffiliateSales($insertData);						  
								
								
							}								
							
							if($role_id == 2) {
								if($prj->is_feature == 1) {	
									$featured_project_amount = $settings['FEATURED_PROJECT_AMOUNT'] * ($programmer_project_fee/100);
									$provider_percentage_amount = $bid_amount * ($provider_settings_fee/100);
									$commision = $provider_percentage_amount * ($programmer_project_fee/100);	
									$commision_amount	=	$featured_project_amount + $commision;
					
								} else {				
									$programmer_percentage_amount = $bid_amount * ($provider_settings_fee/100);
									$commision_amount = $programmer_percentage_amount * ($programmer_affiliate_fee/100);
								}
								 
								  // insert affiliate sales 					  
								  $clientdate 			= 		$this->config->item('clientdate');
								  $clienttime 			= 		$this->config->item('clienttime');
								  $clientbrowser 		= 		$this->config->item('clientbrowser');
								  $clientip 			= 		$this->config->item('clientip');
								  
								  //prepare insert data
								  $insertData                  	= 		array();	
								  $insertData['refid']  		= 		$refid;
								  $insertData['created_date']  	= 		"$clientdate";
								  $insertData['created_time']  	= 		"$clienttime";
								  $insertData['browser']  		= 		"$clientbrowser";
								  $insertData['ipaddress']  	= 		"$clientip";
								  $insertData['payment']  		= 		$commision_amount;
								  $insertData['referral']  		= 		$referral;
								  $insertData['account_type']  	= 		$role_id;
								  $insertData['signup_date']  	= 		$signup_date;
								  $insertData['signup_date_format']  	= 		$signup_date_format;
								 // $insertData['is_released']='0';
								  //print_r($insertData);
					
								  //Add Category
								  $this->affiliate_model->addAffiliateSales($insertData);						  
								
								
							}
						
						} 
						
						else {
						
						  // get user
						  $condition1 = array('users.id'=>$prj->creator_id);
						  $user_data1 = $this->user_model->getUsers($condition1);					  
						 //$user_data_result = $user_data->result();
						  $user_data_row1 = $user_data1->row();
						  if(isset($user_data_row1->refid)) {
							$refid = $user_data_row1->refid;
							$role_id = $user_data_row1->role_id;
							$referral = $user_data_row1->user_name;
							$signup_date = $user_data_row->created;
							
							$date_with_time = show_date($signup_date);
							$arr_str = explode(',',$date_with_time);
							$arr = explode(" ",trim($arr_str[1]));
							
							for($i=0; $i<count($arr); $i++) {
								$mon = $arr[1];
								$year = $arr[2];
							}
							
							$signup_date_format = $mon.", ".$year;
							
							$conditions2 = array('bids.user_id' => $prj->programmer_id,'bids.job_id'=>$prj->id);
							$totbid  =  $this->skills_model->getBids($conditions2);
							$result_bid = $totbid->row();
							
							$bid_amount = $result_bid->bid_amount;
							
							if($role_id == 1) {

								if($prj->is_feature == 1) {	
									$featured_project_amount = $settings['FEATURED_PROJECT_AMOUNT'] * ($buyer_project_fee/100);
									$provider_percentage_amount = $bid_amount * ($provider_settings_fee/100);
									$commision = $provider_percentage_amount * ($buyer_project_fee/100);	
									$commision_amount	=	$featured_project_amount + $commision;
								} else {
									$provider_percentage_amount = $bid_amount * ($provider_settings_fee/100);
									$commision_amount = $provider_percentage_amount * ($buyer_affiliate_fee/100);	
								}
								
								
								  // insert affiliate sales 					  
								  $clientdate 			= 		$this->config->item('clientdate');
								  $clienttime 			= 		$this->config->item('clienttime');
								  $clientbrowser 		= 		$this->config->item('clientbrowser');
								  $clientip 			= 		$this->config->item('clientip');
								  
								  //prepare insert data
								  $insertData                  	= 		array();	
								  $insertData['refid']  		= 		$refid;
								  $insertData['created_date']  	= 		"$clientdate";
								  $insertData['created_time']  	= 		"$clienttime";
								  $insertData['browser']  		= 		"$clientbrowser";
								  $insertData['ipaddress']  	= 		"$clientip";
								  $insertData['payment']  		= 		$commision_amount;
								  $insertData['referral']  		= 		$referral;
								  $insertData['account_type']  	= 		$role_id;
								  $insertData['signup_date']  	= 		$signup_date;
								  $insertData['signup_date_format']  	= $signup_date_format;
								 // $insertData['is_released']='0';
								  
								  
					
								  //Add Category
								  $this->affiliate_model->addAffiliateSales($insertData);						  
								
								
							}	
							
							if($role_id == 2) {
								if($prj->is_feature == 1) {	
									$featured_project_amount = $settings['FEATURED_PROJECT_AMOUNT'] * ($programmer_project_fee/100);
									$provider_percentage_amount = $bid_amount * ($provider_settings_fee/100);
									$commision = $provider_percentage_amount * ($programmer_project_fee/100);	
									$commision_amount	=	$featured_project_amount + $commision;
								} else {				
									$programmer_percentage_amount = $bid_amount * ($provider_settings_fee/100);
									$commision_amount = $programmer_percentage_amount * ($programmer_affiliate_fee/100);
								}
								 
								
								  // insert affiliate sales 					  
								  $clientdate 			= 		$this->config->item('clientdate');
								  $clienttime 			= 		$this->config->item('clienttime');
								  $clientbrowser 		= 		$this->config->item('clientbrowser');
								  $clientip 			= 		$this->config->item('clientip');
								  
								  //prepare insert data
								  $insertData                  	= 		array();	
								  $insertData['refid']  		= 		$refid;
								  $insertData['created_date']  	= 		"$clientdate";
								  $insertData['created_time']  	= 		"$clienttime";
								  $insertData['browser']  		= 		"$clientbrowser";
								  $insertData['ipaddress']  	= 		"$clientip";
								  $insertData['payment']  		= 		$commision_amount;
								  $insertData['referral']  		= 		$referral;
								  $insertData['account_type']  	= 		$role_id;
								  $insertData['signup_date']  	= 		$signup_date;
								  $insertData['signup_date_format']  	= 		$signup_date_format;
								   //$insertData['is_released']='0';
								 
					
								  //Add Category
								  $this->affiliate_model->addAffiliateSales($insertData);						  
								
							}
											  
						  }
			  
			 		}


					   }
					}*/
		
		if($upJob == 1){
			//Load Model For Mail
			$this->load->model('email_model');
				
			//Send Mail to owner
			$conditionUserMail = array('email_templates.type'=>'project_accepted_buyer');
			$result            = $this->email_model->getEmailSettings($conditionUserMail);
			$rowUserMailConent = $result->row();
			
			$splVars = array("!programmer_username" => $employeeRow->user_name, "!project_title" => $jobRow->job_name, "!programmer_email" => $employeeRow->email,"!contact_url" => site_url('contact'));
			$mailSubject = $rowUserMailConent->mail_subject;
			$mailContent = strtr($rowUserMailConent->mail_body, $splVars);
			$toEmail = $ownerRow->email;
			$fromEmail = $this->config->item('site_admin_mail');

			$this->email_model->sendHtmlMail($toEmail,$fromEmail,$mailSubject,$mailContent);
			
			//Send Mail to Programmer
			$conditionUserMail2 = array('email_templates.type'=>'project_accepted_programmer');
			$result2           = $this->email_model->getEmailSettings($conditionUserMail2);
			$rowUserMailConent2 = $result2->row();
			
			$splVars2 = array("!project_title" => $jobRow->job_name, "!buyer_username" => $ownerRow->user_name, "!buyer_email" => $ownerRow->email,"!contact_url" => site_url('contact'));
			$mailSubject2 = $rowUserMailConent2->mail_subject;
			$mailContent2 = strtr($rowUserMailConent2->mail_body, $splVars2);
			$toEmail2 = $employeeRow->email;
			$fromEmail2 = $this->config->item('site_admin_mail');
			$this->email_model->sendHtmlMail($toEmail2,$fromEmail2,$mailSubject2,$mailContent2);
			
			//Notification message
			$this->session->set_flashdata('flash_message', $this->common_model->flash_message('success',$this->lang->line('You have successfully accepted the job')));
			redirect('information/index/success');
		}
	}//Function acceptJob End
	// --------------------------------------------------------------------
	
	/**
	 * deny project from employee 
	 *
	 * @access	public for employee
	 * @param	job id and checkstamp
	 * @return	contents
	 */ 
	function denyJob()
	{
		//Load Language
		$this->lang->load('enduser/denyJob', $this->config->item('language_code'));
		$job_id	 = $this->uri->segment(3,'0');
		$checkstamp = $this->uri->segment(4,'0');
		
		if(isset($project_id))
		  {
			$updateKey                         = array('jobs.id'=>$job_id);
		    $updateData['notification_status'] = '1';
		    $this->skills_model->updateJobs(NULL,$updateData,$updateKey);
		  }
		
		$conditions = array('jobs.id'=>$job_id,'jobs.checkstamp'=>$checkstamp,'jobs.job_status' => '1','jobs.employee_id' => $this->loggedInUser->id);
		$job = $this->skills_model->getJobs($conditions);
		$jobRow = $job->row();
		
		if(!is_object($jobRow)){
		$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('You cannot deny this job')));
		redirect('information');
		}
		
		$ownerId = $jobRow->creator_id;
		$employeeId = $jobRow->employee_id;
		
		$conditions2 = array('users.id' => $ownerId);
		$owner = $this->user_model->getUsers($conditions2);
		$ownerRow = $owner->row();
		
		$conditions3 = array('users.id' => $employeeId);
		$employee = $this->user_model->getUsers($conditions3);
		$employeeRow = $employee->row();
				
		$updateKey = array(
					'jobs.id' => $job_id,
					'jobs.checkstamp' => $checkstamp,
					'jobs.employee_id' => $employeeId
			   		);
		$updateData = array('jobs.job_status'=> '0','jobs.employee_id' => '0');
		$upJob = $this->skills_model->acceptJob($updateKey,$updateData);
		
		if($upJob == 1){
			//Load Model For Mail
			$this->load->model('email_model');
				
			//Send Mail to owner
			$conditionUserMail = array('email_templates.type'=>'project_denied_buyer');
			$result            = $this->email_model->getEmailSettings($conditionUserMail);
			$rowUserMailConent = $result->row();
			
			$splVars = array("!provider_username" => $employeeRow->user_name, "!project_title" => $jobRow->job_name,"!contact_url" => site_url('contact'));
			$mailSubject = $this->lang->line($rowUserMailConent->mail_subject);
			$mailContent = strtr($rowUserMailConent->mail_body, $splVars);
			$toEmail = $ownerRow->email;
			$fromEmail = $this->config->item('site_admin_mail');
			$this->email_model->sendHtmlMail($toEmail,$fromEmail,$mailSubject,$mailContent);
			
			//Notification message
			$this->session->set_flashdata('flash_message', $this->common_model->flash_message('success',$this->lang->line('You have successfully denied the job')));
			redirect('information/index/success');
		}
	}//Function denyJob End
	// --------------------------------------------------------------------
	
	/**
	 * Accept job from owner who accepted your bid
	 *
	 * @access	public
	 * @param	job id and checkstamp
	 * @return	contents
	 */ 
	function postJob()
	{
	 //language file
		$this->lang->load('enduser/review', $this->config->item('language_code'));
		
		//Check for Login details.
		if(!isset($this->loggedInUser->id))
		  {
		  	$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('You must be login access to this page')));
		    redirect('information');
		  }
		if($this->loggedInUser->role_id)
		  {
		  	if($this->loggedInUser->role_id == '2')
			  {
			  	$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('You must be logged in as a owner to post jobs')));
			    redirect('information');
			  }
		  }
		$job_id    =    $this->uri->segment(3,0);
		
		//Initital payment settings for jobs
		$paymentSettings = $this->settings_model->getSiteSettings();
  	    $this->outputData['feature_project']   = $paymentSettings['FEATURED_PROJECT_AMOUNT'];
		$this->outputData['urgent_project']    = $paymentSettings['URGENT_PROJECT_AMOUNT'];
		$this->outputData['hide_project']      = $paymentSettings['HIDE_PROJECT_AMOUNT'];
		
		//Get the job details for post similar jobs
		$conditions   = array('jobs.id'=>$job_id);
		$postSimilar    = $this->skills_model->getJobs($conditions);
		$this->outputData['postSimilar']   =  $postSimilar;
		
		//Laod the categories into the view page
		$this->outputData['groupsWithCategories']	=	$this->skills_model->getGroupsWithCategory();
		$this->load->view('job/view_postJob',$this->outputData);
	}//Function postJob End
	// --------------------------------------------------------------------
	
	/**
	 * manage job from owner who post job
	 *
	 * @access	public for owner
	 * @param	job id 
	 * @return	contents
	 */ 
	function manageJob()
	{
		
		//Load Language
		$this->lang->load('enduser/job', $this->config->item('language_code'));
 		$this->lang->load('enduser/review', $this->config->item('language_code'));
		//load validation library
		$this->load->library('form_validation');
		
		//Load Form Helper
		$this->load->helper('form');
		
		//Check for Login details.
		if(!isset($this->loggedInUser->id))
		  {
		 $this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('You must be login access to this page')));
		  redirect('information');
		  }
		
		//Intialize values for library and helpers	
		$this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
		
		if($this->loggedInUser->role_id)
		  {
		  	if($this->loggedInUser->role_id == '2')
			  {
			  	$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('You must be logged in as a owner to post jobs')));
			    redirect('information');
			  }
		  }
        //Get Groups
		$this->outputData['groupsWithCategories']	=	$this->skills_model->getGroupsWithCategory();

		if($this->uri->segment(3,0))
		   $project_id    =    $this->uri->segment(3,0);
		else   
		   $project_id    =    $this->input->post('projectid'); 
		//Get the job details for post similar jobs
		
		$conditions   = array('jobs.id'=>$project_id,'jobs.creator_id'=>$this->loggedInUser->id);
		//$postSimilar    = $this->skills_model->getMembersJob($conditions);
		$postSimilar    = $this->skills_model->getUsersproject_with($conditions);
		$this->outputData['postSimilar']   =  $postSimilar;  
		$res = $postSimilar->num_rows();
			//pr($postSimilar->result());
			//exit;
			if($res <= 0)
			  {
				$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('Your are not allow to manage this job')));
				redirect('job/view/'.$project_id);
			  }
		
	if($this->input->post('submit'))
	{	
		$this->form_validation->set_rules('budget_min','lang:budget_min_validation','trim|integer|is_natural|abs');
		$this->form_validation->set_rules('budget_max','lang:budget_max_validation','trim|integer|is_natural|integer|abs');
		$this->form_validation->set_rules('attachment','lang:attachment_validation','callback_attachment_check');
		$this->form_validation->set_rules('country','lang:Country','required');
 		$this->form_validation->set_rules('state','lang:State','required');
 		$this->form_validation->set_rules('city','lang:City','required');
		$this->form_validation->set_rules('categories[]','lang:categories_validation','trim|integer|is_natural|abs|xss_clean|callback__maxvalcheckcat');   

		if($this->input->post('is_private'))
			{		
					$this->form_validation->set_rules('private_list','lang:private_list','required|trim|'); 
			}
		if($this->form_validation->run())
			{
			//Initital payment settings for jobs
			$paymentSettings = $this->settings_model->getSiteSettings();
			$this->outputData['feature_project']   = $feature_project = $paymentSettings['FEATURED_PROJECT_AMOUNT'];
			$this->outputData['urgent_project']    = $urgent_project = $paymentSettings['URGENT_PROJECT_AMOUNT'];
			$this->outputData['hide_project']      = $hide_project = $paymentSettings['HIDE_PROJECT_AMOUNT'];
			 $private_project  = $paymentSettings['PRIVATE_PROJECT_AMOUNT'];
						
			$res = $postSimilar->num_rows();
			
			if($res <= 0)
			  {
				$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('Your are not allow to manage this project')));
				redirect('job/view/'.$project_id);
			  }
			
			//Create jobs before it for update the jobs datas for manage option	   
					  if($this->input->post('update') == '0')
						{
							if($this->input->post('projectid'))
							{
								
								 //initial value set for check the featured , urgent, hide jobs
								 $settingAmount=0;
								 
								 //check the values for featured, urgent, hide jobs
								 if($this->input->post('is_feature'))
									{
										$settingAmount=$settingAmount+$feature_project;
									}
								 if($this->input->post('is_urgent'))
									{
										$settingAmount=$settingAmount+$urgent_project;
									}
								 if($this->input->post('is_hide_bids'))
									{
										$settingAmount=$settingAmount+$hide_project;
									}
									if($this->input->post('is_private'))
							       {
							      $settingAmount=$settingAmount+$private_project; 
							        }
								//Check User Balance
								$condition_balance 		 = array('user_balance.user_id'=>$this->loggedInUser->id);
								$results 	 			 = $this->account_model->getBalance($condition_balance);
								
								//If Record already exists
								if($results->num_rows()>0)
								{
									//get balance detail
									$rowBalance = $results->row();
									
									$this->outputData['userAvailableBalance'] = $rowBalance->amount;
								}	
								if($this->input->post('is_hide_bids',TRUE) or $this->input->post('is_urgent',TRUE) or $this->input->post('is_feature',TRUE) or $this->input->post('is_private',TRUE)) 
								{
									 $withdrawvalue = $rowBalance->amount - ( $settingAmount + $paymentSettings['PAYMENT_SETTINGS'] );
									
									if($rowBalance->amount == 0)
									{
									   $this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('your not having sufficient balance')));
									   redirect('information');
									}
									else if( $withdrawvalue < 0 )
									{
										$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('your not having sufficient balance')));
										redirect('information');
									}
									else
									{
										//Check User Balance
										 //Update Amount	
										$updateKey 			  = array('user_balance.user_id'=>$this->loggedInUser->id);	
										$updateData 		  = array();
										$updateData['amount'] = $rowBalance->amount   -   $settingAmount;
										$results 			  = $this->account_model->updateBalance($updateKey,$updateData);
										
											 //Insert transaction for post jobs
										$insertTransaction = array(); 
										$insertTransaction['creator_id']  = $this->loggedInUser->id;
										$insertTransaction['type'] 		 = $this->lang->line('Project Fee');
										$insertTransaction['amount'] 	 = $settingAmount;
										$insertTransaction['transaction_time'] 	 	 = get_est_time();
										$insertTransaction['status'] 	 = 'Completed'; //Can Be success,failed,pending
										
										if($this->input->post('is_feature'))
										{
											$insertTransaction['description'] = $this->lang->line('Project Fee for Feature Project');
										}
									   if($this->input->post('is_urgent'))
										{
											if(($insertTransaction['description'])!='')
											{
												$insertTransaction['description'] .=$this->lang->line('plus');
											}
											$insertTransaction['description'] = $this->lang->line('Project Fee for Urgent Project');
										}
										if($this->input->post('is_hide_bids'))
										{
											if(($insertTransaction['description'])!='')
											{
												$insertTransaction['description'] .=$this->lang->line('plus');
											}
											$insertTransaction['description'] = $this->lang->line('Project Fee for hide bids Project');
										}
										if($this->input->post('is_private'))
										{
										   if(($insertTransaction['description'])!='')
										   {
											   $insertTransaction['description'] .=$this->lang->line('plus');
											} 
											$insertTransaction['description'] = $this->lang->line('Project Fee for Private Project');
										}
										$insertTransaction['description'].= $this->lang->line('Project Fee');
						
										if($this->loggedInUser->role_id == '1')
										{
											$insertTransaction['owner_id']   = $this->loggedInUser->id;
											$insertTransaction['user_type']  = $this->lang->line('Project Fee for Bid');
										}
										if($this->loggedInUser->role_id == '2')
										{
											$insertTransaction['employee_id'] = $this->loggedInUser->id;
											$insertTransaction['user_type']   = $this->lang->line('Project Fee for Bid');
										}
										$this->load->model('account_model');
										$this->account_model->addTransaction($insertTransaction);	
									}
								}
								 
								 $insertData              		  	= array();	
								 $insertData['job_name']  	  	= $this->input->post('projectName');
								 $insertData['description']      	= $this->input->post('description');
							 
				 if(isset($this->data['file']))
				{	 $insertData['attachment_url']=$this->data['file']['file_name'];  $insertData['attachment_name']=$this->data['file']['orig_name']; }	
								 
								 if($this->input->post('update') == '0')
									{
									  $insertData['description']    	= $this->input->post('description').'<br/>';
									  $insertData['description']    	.= $this->input->post('add_description');
									} 
								  else
									 $insertData['description']    	= $this->input->post('description');	
									 
								  $insertData['country']    	    = $this->input->post('country');	
 			      				  $insertData['state']    	  	    = $this->input->post('state');	
 				  				  $insertData['city']    	  	    = $this->input->post('city'); 
								  $insertData['budget_min']    	  	= $this->input->post('budget_min');
								  $insertData['budget_max']       	= $this->input->post('budget_max');
								  if($this->input->post('is_feature'))
								  $insertData['is_feature']       	= $this->input->post('is_feature');
								  if($this->input->post('is_urgent'))
								  $insertData['is_urgent']       	= $this->input->post('is_urgent');
								  if($this->input->post('is_hide_bids'))
								  $insertData['is_hide_bids']       = $this->input->post('is_hide_bids');
								  if($this->input->post('is_private'))
									{
									   $insertData['is_private']    = $this->input->post('is_private');
									  
									} 
								  $insertData['creator_id']       	= $this->loggedInUser->id;
								  $insertData['created']       		= get_est_time();
								  $insertData['enddate']       		= get_est_time() + ($this->input->post('openDays') * 86400);
								  $result                           = '0';
								
								if($this->input->post('categories'))
								{
									$categories = $this->input->post('categories');
						
									//Work With Project Categories
									$project_categoriesNameArray 	           = $this->skills_model->convertCategoryIdsToName($categories);
									$project_categoriesNameString              = implode(',',$project_categoriesNameArray);
									$insertData['job_categories']          = $project_categoriesNameString;
								}
								
								//Update the data
								$project = $this->input->post('projectid');
								$condition 		 = array('jobs.id'=>$project);
								
								$this->skills_model->manageProjects($insertData,$condition);
								
								if($this->input->post('is_private'))
							     {
																
								$private_users=$this->input->post('private_list',TRUE);
								
								if($private_users!='')
								{	
									$private_users_array=explode("\n",$private_users);
									$condition='`role_id`=2';
									foreach($private_users_array as $val)
									{
										$private_users_array1[]=" `user_name`='".$val."'";
									}
									$private_users_str1=implode(' OR ',$private_users_array1);
									$private_users_cond=$condition.' AND ('.$private_users_str1.')';
									//$sel_users=$this->user_model->getUsersfromusername($condition=array(),$private_users_array,NULL);
									$sel_users=$this->user_model->getUsersfromusername($private_users_cond);
									//pr($sel_users->result());
									if($sel_users->num_rows()>0)
									{
									  foreach($sel_users->result() as $users)
									  {
									  	$pusers[]=$users->id;
									  }
									  $pusers=array_unique($pusers);
									  $pusers1=implode(',',$pusers);
									  $data=array('private_users'=>$pusers1);
									  $condition=array('id'=>$project);
									  $table='jobs';
									  
									  $this->common_model->updateTableData($table,NULL,$data,$condition);
									  //insert job_invitation table for private users
									  $insertprivate=array('job_id'=>$project,'sender_id'=>$this->loggedInUser->id,'invite_date'=>get_est_time(),'notification_status'=>'0');	
									  $invitetable='job_invitation';
									  foreach($pusers as $val)
									  {
									  	$insertprivate['receiver_id']=$val;
										
										$this->common_model->insertData($invitetable,$insertprivate);
									  }
									}	
								}	
								
							}							
							
							if($this->input->post('is_private'))	
							{
							   	//Send Mail
								$conditionProviderMail     = array('email_templates.type'=>'private_project_provider');
								$resultProvider            = $this->email_model->getEmailSettings($conditionProviderMail);
							    $resultProvider				= $resultProvider->row();
																
								$projectpage=site_url('job/view/'.$project);
										
								$splVars_provider = array("!site_name" => $this->config->item('site_title'),"!projectname" => $this->input->post('projectName'),"!creatorname" => $this->loggedInUser->user_name,"!profile" => $project_categoriesNameString, "!projectid" => $project,"!date"=>get_datetime(time()),"!projecturl"=>$projectpage,);
							
							   
							   //pr($sel_users->result());
							   //sending emailto all the providers
							   if($private_users!='')
								{
							   
							    if($sel_users->num_rows()>0)
								{
								  foreach($sel_users->result() as $users)
								  {
								  		$insertMessageData['job_id']  	  	=  $project;
				 						$insertMessageData['to_id']      		= $users->id;
				  						$insertMessageData['from_id']    	  	= $this->loggedInUser->id;
										$insertMessageData['message']       	= "Private Job Notification --> You are Invited for the private job<br/>Follow the link given below to view the Job<br/>".site_url('job/view/'.$project);
				  						$insertMessageData['created']       	= get_est_time();	
										//pr($insertMessageData); exit;
										$this->messages_model->postMessage($insertMessageData);	
										
								  	 if($users->email!='')
									 {
									 	$toEmail_provider = $users->email;
										$fromEmail_provider = $this->config->item('site_admin_mail');
										
										
										$selusernames[]=$users->user_name;
										$splVars_provider['!username']=$users->user_name;
										$mailSubject_provider = strtr($resultProvider->mail_subject, $splVars_provider);
										$mailContent_provider = strtr($resultProvider->mail_body, $splVars_provider);	
										$this->email_model->sendHtmlMail($toEmail_provider,$fromEmail_provider,$mailSubject_provider,$mailContent_provider);
							
									 }
								}
							  }	
							  
							  }
						   }
						   if($this->input->post('is_private'))	
							{
								$conditionUserMail = array('email_templates.type'=>'privateproject_post');
							$result            = $this->email_model->getEmailSettings($conditionUserMail);
							$rowUserMailConent = $result->row();
							$splVars = array("!site_name" => $this->config->item('site_title'),"!projectname" => $insertData['job_name'],"!username" => $this->loggedInUser->user_name,"!profile" => $project_categoriesNameString, "!projectid" => $project,"!date"=>get_datetime(time()));
							if($private_users!='')
							{
							if($sel_users->num_rows()>0)
							{
								$selusernamesstr=implode(",",$selusernames);
						    }		
							else
							{
								$selusernamesstr='';
							}
							}
							else
							{
								$selusernamesstr='';
							}
							$splVars['!privateproviders']=$selusernamesstr;
							$mailSubject = strtr($rowUserMailConent->mail_subject, $splVars);
							$mailContent = strtr($rowUserMailConent->mail_body, $splVars);	
							
							$toEmail = $this->loggedInUser->email;
							$fromEmail = $this->config->item('site_admin_mail');
							$this->email_model->sendHtmlMail($toEmail,$fromEmail,$mailSubject,$mailContent);
							}
							else
							{
							//Send Mail
							$conditionUserMail = array('email_templates.type'=>'projectpost_notification');
							$result            = $this->email_model->getEmailSettings($conditionUserMail);
							$rowUserMailConent = $result->row();
							$splVars = array("!site_name" => $this->config->item('site_title'),"!projectname" => $insertData['job_name'],"!username" => $this->loggedInUser->user_name,"!profile" => $project_categoriesNameString,"!projectid" => $project,"!date"=>get_datetime(time()));
							$mailSubject = strtr($rowUserMailConent->mail_subject, $splVars);
							$mailContent = strtr($rowUserMailConent->mail_body, $splVars);		

							$toEmail = $this->loggedInUser->email;
							$fromEmail = $this->config->item('site_admin_mail');
							$this->email_model->sendHtmlMail($toEmail,$fromEmail,$mailSubject,$mailContent);
							}
								
								//Notification message
								//Load Model For Mail
								$this->load->model('email_model');
								
								//Send Mail
								$conditionUserMail = array('email_templates.type'=>'projectpost_notification');
								$result            = $this->email_model->getEmailSettings($conditionUserMail);
								$rowUserMailConent = $result->row();
								$splVars = array("!site_name" => $this->config->item('site_title'), "!username" => $this->loggedInUser->user_name,"!projectid" => $project,"!date"=>get_datetime(time()));
								 $mailSubject = strtr($rowUserMailConent->mail_subject, $splVars);
								 $mailContent = strtr($rowUserMailConent->mail_body, $splVars);		
								 $toEmail = $this->loggedInUser->email;
								 $fromEmail = $this->config->item('site_admin_mail');
								 
								$this->email_model->sendHtmlMail($toEmail,$fromEmail,$mailSubject,$mailContent);
								
								$this->session->set_flashdata('flash_message', $this->common_model->flash_message('success',$this->lang->line('Your job has been Update Successfully')));
								redirect('owner/viewMyJobs');
							}
						}
			$this->session->set_flashdata('flash_message', $this->common_model->flash_message('success',$this->lang->line('Your job has been Update Successfully')));
			redirect('owner/viewMyJobs');
			}
		}	
		$this->load->view('job/view_manageJob',$this->outputData);
			
	}//Function acceptProject End
	// --------------------------------------------------------------------
	
	/**
	 * Post report regardign the job violation
	 *
	 * @access	public for employee
	 * @param	job id
	 * @return	contents
	 */ 
	function jobReport()
	{
		//Load Language
		$this->lang->load('enduser/job', $this->config->item('language_code'));
		$job_id   =  $this->uri->segment(3,0);
		$conditions   = array('jobs.id'=>$job_id);
		$postSimilar    = $this->skills_model->getMembersJob($conditions);
		$this->outputData['postSimilar']   =   $postSimilar;
		$res = $postSimilar->num_rows();
		if($this->input->post('submitReport'))
		  {
		  	$insertData['id']    =  '';
			$insertData['job_id']    =  $job_id;
			$insertData['job_name']  =  $this->input->post('projectname');
			$insertData['post_id']       =  $this->loggedInUser->id;
			$insertData['post_name']     =  $this->loggedInUser->user_name;
			$insertData['comment']       =  $this->input->post('report');
			$insertData['report_date']   =  get_est_time();
			$insertData['report_type']   =  'Job Report';
			
			//insert the report contents into the job_reports table
			$this->skills_model->insertReport($insertData);
			$this->session->set_flashdata('flash_message', $this->common_model->flash_message('success',$this->lang->line('Your report has been send successfully')));
			redirect('job/jobReport/'.$job_id);
		  }
	    $this->load->view('job/view_jobReport',$this->outputData);
	}//Function acceptJob End
	// --------------------------------------------------------------------
	
	/**
	 * Post job bid report violation
	 *
	 * @access	public for owner
	 * @param	job id 
	 * @return	contents
	 */ 
	function bidReport()
	{
		//Load Language
		$this->lang->load('enduser/job', $this->config->item('language_code'));
		
		if($this->uri->segment(3))
		  {
			$bid_id   =  $this->uri->segment(3);
			//Get the bids details
			$bid_condition   = array('bids.id'=>$bid_id);
			$getBids     = $this->skills_model->getBids($bid_condition);
			$this->outputData['getBids']       =   $getBids;	
			$getBids     = $getBids->row();
			$bidsJobid   = $getBids->job_id;
			//Get jobs details
			$condition = array('jobs.id'=>$bidsJobid);
			$postSimilar = $this->skills_model->getMembersJob($condition);
			$this->outputData['postSimilar']   =   $postSimilar;  
			
			//Get users details
			$user_condition   = array('users.id'=>$getBids->user_id);
			$getUsers    = $this->user_model->getUsers($user_condition);
			$this->outputData['getUsers']      =   $getUsers;	
			
			$res = $postSimilar->num_rows();
		  }
		if($this->input->post('submitReport'))
		  {
		  	$insertData['id']    =  '';
			$project_id                  =  $this->input->post('projectid');
			$insertData['job_id']        =  $project_id;
			$insertData['job_name']      =  $this->input->post('projectname');
			$insertData['post_id']       =  $this->loggedInUser->id;
			$insertData['post_name']     =  $this->loggedInUser->user_name;
			$insertData['comment']       =  $this->input->post('report');
			$insertData['report_date']   =  get_est_time();
			$insertData['report_type']   =  'Bid Report';
			//insert the report contents into the job_reports table
			$this->skills_model->insertReport($insertData);
			$this->session->set_flashdata('flash_message', $this->common_model->flash_message('success',$this->lang->line('Your report has been send successfully')));
		  }
	    $this->load->view('job/view_bidReport',$this->outputData);
	}//Function acceptProject End
	// --------------------------------------------------------------------
	
	/**
	 * Create invoice report for the logged user
	 *
	 * @access	private
	 * @param	job id and checkstamp
	 * @return	contents
	 */ 
	function invoice()
	{	
	
		$this->load->helper('users');
        //Innermenu tab selection
		$this->outputData['innerClass8']   = '';
		$this->outputData['innerClass8']   = 'selected';
		
		if(!isset($this->loggedInUser->id))
		  {
		 
		  	$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('You can not access to this page')));
		    redirect('information');
		  }
		$check = '0';
		//Check will assign to 1 while the invoice submittion
		if($this->input->post('invoice'))
		 {
		
			 $check = '1';
		 }
		
		//Load Language
		$this->lang->load('enduser/job', $this->config->item('language_code'));
		$this->lang->load('enduser/invoice', $this->config->item('language_code'));
		if($check == '0')
		  {
			$project_id    =    $this->uri->segment(3,0);
			
			//Get the project details for post similar jobs
			//$conditions   = array('jobs.creator_id'=>$this->loggedInUser->id,'jobs.job_status'=>'2','jobs.job_paid'=>'1');
			if(isOwner()){
			$conditions   = array('jobs.creator_id'=>$this->loggedInUser->id,'jobs.job_status'=>'2');
			$invoiceJob   = $this->skills_model->getMembersJob($conditions);}
			
			if(isEmployee()){
			$conditions   = array('jobs.employee_id'=>$this->loggedInUser->id,'jobs.job_status'=>'2');
			$invoiceJob    = $this->skills_model->getMembersJob($conditions);}
			
			$this->outputData['invoiceJob']   =   $invoiceJob;
			$this->outputData['postSimilar']   =   $invoiceJob;
			$count = $invoiceJob->num_rows();
			$res = $invoiceJob->num_rows();
		 } 
		 
		 //Check User Balance
		 $condition_balance 	= array('user_balance.user_id'=>$this->loggedInUser->id);
		 $results 	 			 = $this->account_model->getBalance($condition_balance);
						
		//If Record already exists
		if($results->num_rows()>0)
		{
		//get balance detail
		$rowBalance = $results->row();		
		$this->outputData['userAvailableBalance'] = $rowBalance->amount;
		}	
		
		//Load the view for the invoice
		if($check == '0')
		  {
			$this->load->view('job/view_jobInvoice',$this->outputData);
		  }	
		else
		   { 
			 $this->outputData['job_name']    = $this->input->post('project_name');
			 $this->outputData['user_name']   = $this->input->post('user_name');
			 $this->outputData['bidsjobs']    = $this->input->post('invoice');
			 $this->outputData['invoice_no']  = $this->input->post('invoice_no');
			 $this->outputData['bidsjobs']    = $this->skills_model->getBidsproject();
			 $this->load->view('job/view_invoice',$this->outputData);  
		   }	 
	}//Function invoice End
	// --------------------------------------------------------------------
	
	function invoicePdf()
	{	
	
	
		$this->load->helper('users');
		$this->load->helpers('fpdf');
		// Column headings
		$pdf = new PDF();
		
		$header = array('S.No', 'Date', 'Particulars', 'Amount');
		
		$jobName=urldecode($this->uri->segment(4,0));
		$postby=$this->uri->segment(5,0);
		$totamt=$this->uri->segment(6,0);
		$bidwon=$this->uri->segment(7,0);
		$created=$this->uri->segment(8,0);
		$remamt=$this->uri->segment(9,0);
		
		$creator_id = getUserinformation($postby); 
		$creator    = ucfirst($creator_id->user_name);
		
		$won_id=getUserinformation($bidwon);
		$wonid = ucfirst($won_id->user_name);
		
		$date = get_date($created);
		$amt = $totamt-$remamt;
		if($remamt<$totamt) 
		$rem_amt=$remamt; 
		else
		$rem_amt = 'Completed';
		
		
		// Data loading
		//$data =array(array("1","$jobName","$creator","$totamt","$wonid","$date","$rem_amt"));
		$data =array(array("1","$date","Escrow","$amt"));
		$pdf->SetFont('Arial','',8);
		$pdf->AddPage();
		//$pdf->SetReportFirstPageHead('Bidonn 1.0', date('F j, Y')); 
		$date='Date: '. date('F j, Y');
		$emp_name='To: '.$wonid;
		$job_name='Job Name: '.$jobName;
		$tot_amt='Total Amount: '.$totamt.'USD';
 		$pdf->SetReportGeneralPageHead('Invoice',$date,$emp_name,$job_name,$tot_amt);  
		$pdf->BasicTable($header,$data);
		$pdf->Cell(30,8,'',0,0,'C');
		$pdf->Cell(30,8,'',0,0,'C');
		$pdf->Cell(30,8,'Total',1,0,'L');
		$pdf->Cell(30,8,$amt,1,1,'L');
		$pdf->Cell(30,8,'',0,0,'C');
		$pdf->Cell(30,8,'',0,0,'C');
		$pdf->Cell(30,8,'Remaining Amount',1,0,'L');
		$pdf->Cell(30,8,$rem_amt,1,1,'L');
	  /*$pdf->AddPage();
	    $pdf->ImprovedTable($header,$data);
     	$pdf->AddPage();
		$pdf->FancyTable($header,$data);*/
		$pdf->Output();
		/*$this->load->helper('users');
        //Innermenu tab selection
		$this->outputData['innerClass8']   = '';
		$this->outputData['innerClass8']   = 'selected';
		
		if(!isset($this->loggedInUser->id))
		  {
		 
		  	$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('You can not access to this page')));
		    redirect('information');
		  }
		$check = '0';
		//Check will assign to 1 while the invoice submittion
		if($this->input->post('invoice'))
		 {
		
			 $check = '1';
		 }
		
		//Load Language
		$this->lang->load('enduser/job', $this->config->item('language_code'));
		$this->lang->load('enduser/invoice', $this->config->item('language_code'));
		if($check == '0')
		  {
			$project_id    =    $this->uri->segment(3,0);
			
			//Get the project details for post similar jobs
			//$conditions   = array('jobs.creator_id'=>$this->loggedInUser->id,'jobs.job_status'=>'2','jobs.job_paid'=>'1');
			$conditions   = array('jobs.creator_id'=>$this->loggedInUser->id,'jobs.job_status'=>'2');
			$invoiceJob    = $this->skills_model->getMembersJob($conditions);
			$this->outputData['invoiceJob']   =   $invoiceJob;
			$this->outputData['postSimilar']   =   $invoiceJob;
			$count = $invoiceJob->num_rows();
			$res = $invoiceJob->num_rows();
		 } 
		 
		 //Check User Balance
		 $condition_balance 	= array('user_balance.user_id'=>$this->loggedInUser->id);
		 $results 	 			 = $this->account_model->getBalance($condition_balance);
						
		//If Record already exists
		if($results->num_rows()>0)
		{
		//get balance detail
		$rowBalance = $results->row();		
		$this->outputData['userAvailableBalance'] = $rowBalance->amount;
		}	
		
		//Load the view for the invoice
		if($check == '0')
		  {
			$this->load->view('job/view_jobInvoice',$this->outputData);
		  }	
		else
		   { 
			 $this->outputData['job_name']    = $this->input->post('project_name');
			 $this->outputData['user_name']   = $this->input->post('user_name');
			 $this->outputData['bidsjobs']    = $this->input->post('invoice');
			 $this->outputData['invoice_no']  = $this->input->post('invoice_no');
			 $this->outputData['bidsjobs']    = $this->skills_model->getBidsproject();
			 $this->load->view('job/view_invoice',$this->outputData);  
		   }	 */
	}//Function invoice End
	// --------------------------------------------------------------------
	/**
	 * Create invite report for the logged user
	 *
	 * @access	private
	 * @param	job id and checkstamp
	 * @return	contents
	 */ 
	function inviteUser()
	{
		//Load Language
		$this->lang->load('enduser/memberList', $this->config->item('language_code'));
		if($this->loggedInUser)
		  {
			$userid =  $this->loggedInUser->id;
			$condition = array('jobs.creator_id'=>$userid);
			$res = $this->skills_model->getMembersJob($condition);
		    if($res->num_rows() > 0)
			   {	
			  	  $condition                            = array('user_list.creator_id'=>$this->loggedInUser->id);
				  $this->outputData['favouriteList']    =   $this->user_model->getFavourite($condition);
				  $this->load->view('owner/view_inviteEmployee',$this->outputData); 
			   }
			else
			   {
			   	//Notification message
				$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('You must be post job to invite employees')));
				redirect('information');	
			   }
		  }	      
	   else
	    {
			//Notification message
			$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('You must be logged to invite employees')));
			redirect('information');
		}	
	}//Function inviteUser End
	
	// --------------------------------------------------------------------
	
	/**
	 * Check and close the jobs if their bidding end date is expired.
	 *
	 * @access	private
	 * @param	job id and checkstamp
	 * @return	contents
	 */ 
	function biddingEndCheck()
	{
		$projects = $this->skills_model->getJobs();
		foreach($projects->result() as $res)
		  {
		    $diff = $res->enddate - get_est_time();
			if($diff == 0){
				$updateKey = array('jobs.id' => $res->id);
				$updateData = array('jobs.job_status' => '3');
				$this->skills_model->updateJobs(NULL,$updateData,$updateKey);
				
				//Load Model For Mail
				$this->load->model('email_model');
					
				//Send Mail
				$conditionUserMail = array('email_templates.type'=>'project_cancelled');
				$result            = $this->email_model->getEmailSettings($conditionUserMail);
				$rowUserMailConent = $result->row();
				
				$splVars = array("!buyer_name" => $res->user_name, "!project_name" => $res->job_name,"!contact_url" => site_url('contact'));
				$mailSubject = strtr($rowUserMailConent->mail_subject, $splVars);
				$mailContent = strtr($rowUserMailConent->mail_body, $splVars);
				$toEmail = $res->email;
				$fromEmail = $this->config->item('site_admin_mail');
				$this->email_model->sendHtmlMail($toEmail,$fromEmail,$mailSubject,$mailContent);
			}
		}
	}//Function biddingEndCheck End
	
	// --------------------------------------------------------------------
	
	/**
	 * Sending new job notifications to Providers
	 *
	 * @access	private
	 * @param	job id and checkstamp
	 * @return	contents
	 */ 
	function newJobsNotify()
	{
		//Load Models
		$this->load->model('search_model');
		
		$yesterday = date('j/n/Y', mktime(0, 0, 0, date("m") , date("d") - 1, date("Y")));
		
		$conditions = array('users.role_id' => '2','users.user_status' => '1','user_categories.user_categories !=' => '');
		
		$users = $this->user_model->getUsersWithCategories($conditions);
		$prids = array();
		$i = 0;
		foreach($users->result() as $user)
		{
			$cate = explode(",",$user->user_categories);
			//Get jobs by categories
			foreach($cate as $cat){
				$cond = array('categories.id' => $cat);
				$res = $this->skills_model->getCategories($cond);
				$row = $res->row();
				$cname = $row->category_name;
				$like = array('jobs.job_categories' => $cname);
				$conditions2 = array("FROM_UNIXTIME( jobs.created, '%e/%c/%Y' ) = " => $yesterday,'jobs.job_status' => '0');
				$projects = $this->search_model->getJobs($conditions2,'jobs.id',$like);
				foreach($projects->result() as $prid){
					$prids[$i] = $prid->id;
					$i++;
				}
				
			}
			$prids = array_unique($prids);
			$mailSubject = $this->config->item('site_title')." Job Notice";
			$mailContent = "The following ".count($prids)." jobs were recently added to ".$this->config->item('site_title')." and match your expertise:<br><br>";
			foreach($prids as $prj){
				$condition3 = array('jobs.id' => $prj);
				$mpr = $this->skills_model->getJobs($condition3);
				$prj = $mpr->row();
				$mailContent .= $prj->job_name." (Posted by ".$prj->user_name.", ".get_datetime($prj->created).", Job type:".$prj->job_categories.")"."<br>".site_url('job/view/'.$prj->id)."<br><br>";
			}
			//Send mail
			$toEmail = $user->email;
			$fromEmail = $this->config->item('site_admin_mail');
			$this->email_model->sendHtmlMail($toEmail,$fromEmail,$mailSubject,$mailContent);
		}
	}//Function biddingEndCheck End
	
	// --------------------------------------------------------------------
	
	/**
	 * Extend job bid
	 *
	 * @access	private
	 * @param	job id and checkstamp
	 * @return	contents
	 */ 
	function extendBid()
	{
		//Load Language
		$this->lang->load('enduser/viewJob', $this->config->item('language_code'));
		if($this->input->post('extend'))
		{
			$jobid = $this->input->post('jobid');
			$condition2 = array('jobs.id' => $jobid);
			$res = $this->skills_model->getJobs($condition2);
			$row = $res->row();
			$left = days_left($row->enddate,$jobid);
			if($left == 'Closed')
					$enddate = get_est_time() + ($this->input->post('openDays') * 86400);
				else{
					$today = time();
					$lastday = $row->enddate;
					$left = $lastday - $today;
					$val = date('j',$left);
					$open = $val + $this->input->post('openDays');
					$enddate = get_est_time() + ($open * 86400);
					
				}
				
				$updateKey = array('jobs.id' => $this->input->post('jobid'));
				$updateData = array('jobs.enddate' => $enddate,'jobs.job_status' => '0');
				$this->skills_model->updateJobs(NULL,$updateData,$updateKey);
				
				//Notification message
				$this->session->set_flashdata('flash_message', $this->common_model->flash_message('success',$this->lang->line('Your job bid has been extended')));
				redirect('owner/viewMyJobs');
		}
		$jobid = $this->uri->segment(3,'0');
		$condition = array('jobs.id' => $jobid);
		$this->outputData['job']	= $this->skills_model->getJobs($condition);
		$this->load->view('owner/view_extendBid',$this->outputData);
	}//Function extendBid End
//------------------------------------------------------------------------------------------
	
	/**
	 * calculate the consolidate bids details after 12 hr and send email to the owner
	 *
	 * @access	private
	 * @param	nil
	 * @return	void
	 */	
	function bidConsolidate()
	{	
		//Get all users details
		$projects = $this->skills_model->getJobs();
		foreach($projects->result() as $res)
		  {
			$records         = '';
			$diff           = count_days($res->created,get_est_time());
			if($diff > 0)	
			{
			$projectid      =  $res->id;
			$projectname    =  $res->job_name;
			//Get all bids details for the job
			$bid_condition  = array('bids.job_id'=>$projectid);
			$bids           = $this->skills_model->getBids($bid_condition);
			if(isset($bids) and count($bids->result()) >0)
			{
				$i= 1;
				$records         .= '<table border="1"><tr><th align="center">Sl.No</th><th width="300">Job Name</th>	<th width="250">Username</th> <th width="100" align="center">Bid Amount</th> <th width="250" align="center">Bid Post Time</th></tr>';
				foreach($bids->result() as $bids)
				{
					$user_condition = array('users.id'=>$bids->user_id);
					$users          = $this->user_model->getUsers($user_condition);
					$user           = $users->row();
					$records         .= '<tr><td align="center">'.$i++.'</td><td>'.$res->job_name.'</td><td>'.$user->user_name.'</td><td align="center">'.$this->outputData['currency'].' '.$bids->bid_amount.'</td><td align="center">'.get_datetime($bids->bid_time).'</td></tr>';  
				}
			
				$records         .='</table>';  
				
				$user_condition = array('users.id'=>$res->creator_id);
				$creator          = $this->user_model->getUsers($user_condition);
				$creator             = $creator->row();
				//Send Mail to job creator
				$conditionUserMail = array('email_templates.type'=>'consolidate_bids');
				$result            = $this->email_model->getEmailSettings($conditionUserMail);
				$rowUserMailConent = $result->row();
				//Update the details 
				$splVars = array("!projectname" => '<a href="'.site_url('job/view/'.$res->id).'">'.$res->job_name.'</a>',"!username" => $creator->user_name,"!contact_url" => site_url('contact'),"!site_url" => site_url(),'!site_name' => $this->config->item('site_title'),'!records'=>$records);
				$mailSubject = strtr($rowUserMailConent->mail_subject, $splVars);
				$mailContent = strtr($rowUserMailConent->mail_body, $splVars);
				$toEmail     = $creator->email;
				$fromEmail   = $this->config->item('site_admin_mail');
				$this->email_model->sendHtmlMail($toEmail,$fromEmail,$mailSubject,$mailContent);
		    } 	
		  }	
	   }
	} //Function bidConsolidate end
	
	// --------------------------------------------------------------------
	
	/**
	 * Sending new job notifications every hour to Employees
	 *
	 * @access	private
	 * @param	job id and checkstamp
	 * @return	contents
	 */ 
	function hourlyProjectsNotify()
	{
		//Load Models
		$this->load->model('search_model');

		$prev_hour = date('j/n/Y H', get_est_time() - (60 * 60));

		$conditions = array('users.role_id' => '2','users.user_status' => '1','user_categories.user_categories !=' => '','users.job_notify' => 'Hourly');
		
		$users = $this->user_model->getUsersWithCategories($conditions);

		$prids = array();
		$i = 0;
		foreach($users->result() as $user)
		{
			$cate = explode(",",$user->user_categories);
			//Get jobs by categories
			foreach($cate as $cat){
				$cond = array('categories.id' => $cat);
				$res = $this->skills_model->getCategories($cond);
				$row = $res->row();
				$cname = $row->category_name;
				$like = array('jobs.job_categories' => $cname);
				$conditions2 = array("FROM_UNIXTIME( jobs.created, '%e/%c/%Y %H' ) = " => $prev_hour,'jobs.job_status' => '0');
				$projects = $this->search_model->getJobs($conditions2,'jobs.id',$like);
				//Get jobs
				foreach($projects->result() as $prid){
					$prids[$i] = $prid->id;
					$i++;
				}
			}
			//Check if jobs are available to send notifications
			if(count($prids) > 0){
				$prids1 = array_unique($prids);
				$mailSubject = $this->config->item('site_title')." Job Notice";
				$mailContent = "The following ".count($prids1)." jobs were recently added to ".$this->config->item('site_title')." and match your expertise:<br><br>";
				foreach($prids as $prj){
					$condition3 = array('jobs.id' => $prj);
					$mpr = $this->skills_model->getJobs($condition3);
					$prj = $mpr->row();
					$mailContent .= $prj->job_name." (Posted by ".$prj->user_name.", ".get_datetime($prj->created).", Job type:".$prj->job_categories.")"."<br>".site_url('job/view/'.$prj->id)."<br><br>";
				}
				//Send mail
				$toEmail = $user->email;
				$fromEmail = $this->config->item('site_admin_mail');
				$this->email_model->sendHtmlMail($toEmail,$fromEmail,$mailSubject,$mailContent);
			}
		}
	}//Function hourlyProjectsNotify End
	
	// -----------------------------------------------------------------------------------------------------------------
	function selEmployee()
	{
		
		//Load Language
		$this->lang->load('enduser/pickEmployee', $this->config->item('language_code'));
		if($this->uri->segment(3,0))
	    {
			$bidid      = $this->uri->segment(3,0);
			$conditions = array('bids.id'=>$bidid);
			$up         = $this->skills_model->awardJob($conditions);
			if($up == 1){
				//Load Model For Mail
				$this->load->model('email_model');
				$bidres = $this->skills_model->getJobByBid(array('bids.id'=>$bidid));
				$bidres = $bidres->row();
				
				//Get all user post bids 
				$condition  =  array('bids.job_id'=>$bidres->id,'bids.user_id !='=>$bidres->employee_id);
				$bids       =  $this->skills_model->getBids($condition);
				foreach($bids->result() as $bids)
				  {
				  	 $user_condition  =  array('users.id'=>$bids->user_id);
					 $users           =  $this->user_model->getUsers($user_condition);
					 $users           =  $users->row();
					 
					 //Send Mail
					 $conditionUserMail = array('email_templates.type'=>'project_end');
					 $result            = $this->email_model->getEmailSettings($conditionUserMail);
					 $rowUserMailConent = $result->row();
					 $splVars = array("!projectname" => $bidres->job_name,"!sitetitle"=>site_url(), "!contact_url" => site_url('contact'));
					 $mailSubject = strtr($rowUserMailConent->mail_subject, $splVars);
					 $mailContent = strtr($rowUserMailConent->mail_body, $splVars);
					 $toEmail     = $users->email;
					 $fromEmail   = $this->config->item('site_admin_mail');
					 $this->email_model->sendHtmlMail($toEmail,$fromEmail,$mailSubject,$mailContent);
				  }
				//Update the notification status for the proejct to zero
				$updateKey                         = array('jobs.id'=>$bidres->id);
				$updateData['notification_status'] = '0';
				$this->skills_model->updateJobs(NULL,$updateData,$updateKey);
			    
				//Send Mail
				$conditionUserMail = array('email_templates.type'=>'awardBid');
				$result            = $this->email_model->getEmailSettings($conditionUserMail);
				$rowUserMailConent = $result->row();
				$splVars = array("!project_title" => $bidres->job_name, "!bid_url" => site_url('job/acceptJob/'.$bidres->id."/".$bidres->checkstamp),"!deny_url" => site_url('job/denyJob/'.$bidres->id."/".$bidres->checkstamp), "!contact_url" => site_url('contact'));
				$mailSubject = strtr($rowUserMailConent->mail_subject, $splVars);
				$mailContent = strtr($rowUserMailConent->mail_body, $splVars);
				$toEmail = $bidres->email;
				$fromEmail = $this->config->item('site_admin_mail');
				$this->email_model->sendHtmlMail($toEmail,$fromEmail,$mailSubject,$mailContent);
				
					$resuser=$this->user_model->getUsers(array('users.id'=>$this->loggedInUser->id));
					$tuserdetails=$resuser->row();
				//Notification message
				$this->session->set_flashdata('flash_message', $this->common_model->flash_message('success',$this->lang->line('You have successfully awarded the job')));
				redirect('/job/view/'.$bidres->id);
			}
		}
	
	}
	
	
	
	
	
	
	
		
		
		
		
	/**
	 * owner cencel the proejct only for open proejcts
	 *
	 * @access	private
	 * @param	nil
	 * @return	void
	 */	
	 
	function cancelJob()
	{	
		if($this->uri->segment(3,0))
		{
			
			$jobid = $this->uri->segment(3,0);
			$updatekey = array('jobs.id'=>$jobid);
			
			//Get the cancelled proejcts details
			$condition  = array('jobs.id'=>$jobid);
			$jobs   = $this->skills_model->getJobs($condition);
			$this->outputData['projects'] = $jobs;
			$jobs   = $jobs->row();
			
			if($this->input->post('delete'))
			{
				//Set the job status as cancel made by owner
			    $updateData  =  array('jobs.job_status'=>'3');
			    $projects  = $this->skills_model->updateJobs(NULL,$updateData,$updatekey);
				
				//Get all bid post users to the particular job
				$condition  = array('jobs.id'=>$jobid);
				$getBids    = $this->skills_model->getBids($condition);
				if($getBids->num_rows() > 0)
				 {
					foreach($getBids->result() as $user)
					 {
						$user_condition = array('users.id'=>$user->user_id);
						$usersList      = $this->user_model->getUsers($user_condition);
						$usersList      = $usersList->row();
						//Get jobs details
						$condition  = array('jobs.id'=>$this->uri->segment(3,0));
						$jobs   = $this->skills_model->getJobs($condition);
						$jobs   = $jobs->row();
						//Send Mail to job creator
						$conditionUserMail = array('email_templates.type'=>'project_cancel');
						$result            = $this->email_model->getEmailSettings($conditionUserMail);
						$rowUserMailConent = $result->row();
						$splVars = array("!projectname" => '<a href="'.site_url('job/view/'.$jobs->id).'">'.$jobs->job_name.'</a>',"!username" => $usersList->user_name,"!contact_url" => site_url('contact'),"!site_url" => site_url(),'!site_name' => $this->config->item('site_title'),"!projectid"=>$jobs->id,"!creatorname"=>$this->loggedInUser->user_name);
						
						$mailSubject = strtr($rowUserMailConent->mail_subject, $splVars);
						$mailContent = strtr($rowUserMailConent->mail_body, $splVars);
						$toEmail     = $this->loggedInUser->email;
						$fromEmail   = $this->config->item('site_admin_mail');
						$this->email_model->sendHtmlMail($toEmail,$fromEmail,$mailSubject,$mailContent);		
					 }
				}
				
				//Get jobs details
				$condition  = array('jobs.id'=>$this->uri->segment(3,0));
				$jobs  		= $this->skills_model->getJobs($condition);
				$jobs       = $jobs->row();
				//Send Mail to job creator
				$conditionUserMail = array('email_templates.type'=>'project_cancel');
				$result            = $this->email_model->getEmailSettings($conditionUserMail);
				$rowUserMailConent = $result->row();
				$splVars = array("!projectname" => '<a href="'.site_url('job/view/'.$jobs->id).'">'.$jobs->job_name.'</a>',"!username" => $this->loggedInUser->user_name,"!contact_url" => site_url('contact'),"!site_url" => site_url(),'!site_name' => $this->config->item('site_title'),"!projectid"=>$jobs->id,"!creatorname"=>$this->loggedInUser->user_name);
				$mailSubject = strtr($rowUserMailConent->mail_subject, $splVars);
				$mailContent = strtr($rowUserMailConent->mail_body, $splVars);
				$toEmail     = $this->loggedInUser->email;
				$fromEmail   = $this->config->item('site_admin_mail');
				$this->email_model->sendHtmlMail($toEmail,$fromEmail,$mailSubject,$mailContent);		
				redirect('owner/viewMyJobs');
			}
			else if($this->input->post('viewProject'))
			 {
			 	redirect('owner/viewMyJobs');
			 }
			else
			{
				$this->load->view('job/view_deleteJob',$this->outputData);
				
				
			} 
		}
		
	}
	
	//check max value
function _maxvalcheck()
{
$min=$this->input->post('budget_min');
$max=$this->input->post('budget_max');
if($min<$max)
{
return true;
}
else
{
$this->form_validation->set_message('_maxvalcheck', $this->lang->line('max_min_check'));
return false;
}


}	

function _maxvalcheckcat()
{

 $max=$this->input->post('categories'); 
if(count($max)<6)
{
return true;
}
else
{
$this->form_validation->set_message('categories[]', $this->lang->line('Job Type: (Make up to 5 selections.)'));
return false;

}
}	



} //End job Class
/* End of file job.php */ 
/* Location: ./application/controllers/job.php */
?>