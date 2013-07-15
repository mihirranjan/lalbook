<?php

/*
  ****************************************************************************
  ***                                                                      ***
  ***      BIDONN 1.0                                                      ***
  ***      File:  employee.php                                             ***
  ***      Built: Mon June 11 11:15:10 2012                                ***
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


class Employee extends CI_Controller {

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
		$this->load->model('user_model');
		$this->load->model('skills_model');
		$this->load->model('email_model');
		$this->load->model('credential_model');
		

		//Page Title and Meta Tags
		$this->outputData = $this->common_model->getPageTitleAndMetaData();

		//Get Logged In user
		$this->loggedInUser					= $this->common_model->getLoggedInUser();
		$this->outputData['loggedInUser'] 	= $this->loggedInUser;
		
		//Currency Type
		$this->outputData['currency'] = $this->db->get_where('settings', array('code' => 'CURRENCY_TYPE'))->row()->string_value;
		//$this->outputData['currency'] = $this->db->get_where('currency', array('currency_type' => $currency_type))->row()->currency_symbol;

		//Get Footer content
		$this->outputData['pages']	= $this->common_model->getPages();
		
		//Get Latest jobs
		$limit_latest = $this->config->item('latest_projects_limit');
		$limit3 = array($limit_latest);
		$this->outputData['latestJobs']	= $this->skills_model->getLatestJobs($limit3);

		//language file
		$this->lang->load('enduser/common', $this->config->item('language_code'));
  		$this->lang->load('enduser/employee', $this->config->item('language_code'));
		$this->outputData['current_page'] = 'employee';

		//Load helpers
		$this->load->helper('users');
		$this->load->helper('file');
	} //Controller End 
	// --------------------------------------------------------------------
	
	/**
	 * Loads Employee signup page.
	 *
	 * @access	public
	 * @param	nil
	 * @return	void
	 */ 
	function signup()
	{	
		//load language file
		$this->lang->load('enduser/employee', $this->config->item('language_code'));

		//load validation library
		$this->load->library('form_validation');

		//Load Form Helper
		$this->load->helper('form');
		
		$this->load->model('page_model');

		//Intialize values for library and helpers	
		$this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));

		//Get Form Data	
		if($this->input->post('employeeSignup'))
		{	
			//Set rules
			$this->form_validation->set_rules('email','lang:employee_email_validation','required|trim|valid_email|xss_clean|callback__check_programmer_email');
			if($this->form_validation->run())
			{	
				if(check_form_token()===false)
				 {
				  	$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('token_error')));
				  	redirect('employee/signup');
				  }				  
				$insertData              		  = array();	
			    $insertData['email']    		  = $this->input->post('email');
				$insertData['role_id']   		  = $this->user_model->getRoleId('employee');
				$insertData['activation_key']     = md5(time());
				$insertData['created']  		  = get_est_time();
				//Create User
				$this->user_model->createUser($insertData);
				  
  				//Create user balance
				$insertBalance['id']              = '';
				$insertBalance['user_id']         = $this->db->insert_id();
				$insertBalance['amount']          = '0';	
				$this->user_model->createUserBalance($insertBalance);
				  
				//Load Model For Mail
				$this->load->model('email_model');
				
				//Send Mail
				$conditionUserMail = array('email_templates.type'=>'employees_signup');
				$result            = $this->email_model->getEmailSettings($conditionUserMail);
				$rowUserMailConent = $result->row();
				$splVars = array("!site_title" => $this->config->item('site_title'), "!activation_url" => site_url('employee/confirm/'.$insertData['activation_key']), "!contact_url" => site_url('contact'));
				$mailSubject = strtr($rowUserMailConent->mail_subject, $splVars);
				$mailContent = strtr($rowUserMailConent->mail_body, $splVars);		
				$toEmail = $insertData['email'];
				$fromEmail = $this->config->item('site_admin_mail');
				$this->email_model->sendHtmlMail($toEmail,$fromEmail,$mailSubject,$mailContent);	
				
				//Set the Success Message
				$success_msg = $this->lang->line('confirmation_text').$insertData['email'].$this->lang->line('follow_the_link');
				
				//Notification message
				$this->session->set_flashdata('flash_message', $this->common_model->flash_message('success',$success_msg));
				redirect('employee/signup');
		 	}  //Form Validation End
			
		} //If - Form Submission End
	   $like = array('page.url'=>'privacy');
	   $this->outputData['page_content']	=	$this->page_model->getPages(NULL,$like,NULL);	
	   $this->load->view('employee/view_emp_signup',$this->outputData);	
	} //Function signUp End
	
	// --------------------------------------------------------------------
	/**
	 * Resending activation link 
	 *
	 * @access	public
	 * @param	nil
	 * @return	void
	 */ 
	function resendActivationLink()
	{
		//language file
		$this->lang->load('enduser/employee', $this->config->item('language_code'));
		
		//load validation library
		$this->load->library('form_validation');
		
		//Load Form Helper
		$this->load->helper('form');
		
		//Intialize values for library and helpers	
		$this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
		
		//Get Form Data	
		if($this->input->post('resend',TRUE))
		{	
			//Set rules
			$this->form_validation->set_rules('email2','lang:employee_email_validation','required|trim|valid_email|xss_clean|callback__check_resendprogrammer_email');
			if($this->form_validation->run())
			{
				$email    		  = $this->input->post('email2',TRUE);
				//Conditions
				$conditions		= array('users.email' => $email,'users.role_id'=> $this->user_model->getRoleId('employee'));
				$query 			= $this->user_model->getUsers($conditions);
				$userRow = $query->row();
				
				//Load Model For Mail
				$this->load->model('email_model');
				
				//Send Mail
				$conditionUserMail = array('email_templates.type'=>'employees_signup');
				$result            = $this->email_model->getEmailSettings($conditionUserMail);
				$rowUserMailConent = $result->row();
				$splVars = array("!site_title" => $this->config->item('site_title'), "!activation_url" => site_url('employee/confirm/'.$userRow->activation_key), "!contact_url" => site_url('contact'));
				$mailSubject = strtr($rowUserMailConent->mail_subject, $splVars);
				$mailContent = strtr($rowUserMailConent->mail_body, $splVars);		
				$toEmail = $email;
				$fromEmail = $this->config->item('site_admin_mail');
				$this->email_model->sendHtmlMail($toEmail,$fromEmail,$mailSubject,$mailContent);		
				
				//Set the Success Message
				$success_msg = $this->lang->line('confirmation_text').$userRow->email.$this->lang->line('follow_the_link');
				  
				//Notification message
				$this->session->set_flashdata('flash_message', $this->common_model->flash_message('success',$success_msg));
				redirect('employee/signup');
			}
		}
		$this->load->view('employee/view_emp_signup',$this->outputData);
	}
	// --------------------------------------------------------------------

	/**
	 * Loads confirm page for employee through activation link
	 *
	 * @access	public
	 * @param	nil
	 * @return	void
	 */ 
	function confirm()
	{
		//language file
		$this->lang->load('enduser/employee', $this->config->item('language_code'));
		$check_key = $this->uri->segment(3,0);	
		
		//load validation libraray
		$this->load->library('form_validation');

		//Load Form Helper
		$this->load->helper('form');

		//Intialize values for library and helpers	
		$this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));

		//Get Form Data	
		if($this->input->post('employeeConfirm',TRUE))
		{	
			//Set rules
			$this->form_validation->set_rules('username','lang:programmer_name_validation','required|trim|min_length[5]|xss_clean|callback__check_username|alpha_space');
			$this->form_validation->set_rules('pwd','lang:password_validation','required|trim|min_length[5]|max_length[16]|xss_clean|matches[ConfirmPassword]');
			$this->form_validation->set_rules('ConfirmPassword','ConfirmPassword','required|trim|xss_clean');
			$this->form_validation->set_rules('name','lang:name_confirm_validation','trim|min_length[5]|xss_clean');
			$this->form_validation->set_rules('rate','lang:rate_validation','required|trim|is_natural_no_zero|xss_clean|abs');
			$this->form_validation->set_rules('profile','lang:profile_validation','min_length[25]|trim|xss_clean');
			$this->form_validation->set_rules('logo','lang:logo_validation','callback__logo_check');
			$this->form_validation->set_rules('country','lang:country_validation','required');
			$this->form_validation->set_rules('state','lang:state_validation','trim|xss_clean');
			$this->form_validation->set_rules('city','lang:city_validation','trim|xss_clean');
			$this->form_validation->set_rules('categories[]','lang:categories_validation','required');
			$this->form_validation->set_rules('signup_agree_terms','lang:signup_agree_terms_validation','required');
			//$this->form_validation->set_rules('signup_agree_contact','lang:signup_agree_contact_validation','required');
			$this->form_validation->set_rules('confirmKey','Confirmation Key','callback__check_activation_key');
			$this->form_validation->set_rules('contact_msn','msn','trim|xss_clean');
			$this->form_validation->set_rules('contact_gtalk','gtalk','trim|xss_clean');
			$this->form_validation->set_rules('contact_yahoo','yahoo','trim|xss_clean');
			$this->form_validation->set_rules('contact_skype','skype','trim|xss_clean');
			$this->form_validation->set_rules('notify_project','new bid','trim|xss_clean');
			$this->form_validation->set_rules('notify_message','new message','trim|xss_clean');

			if($this->form_validation->run())
			{	
				  if(check_form_token()===false)
				  {
				  	$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('token_error')));

				  	redirect('information');

				  }				  

				  	

				  $updateData              		  = array();
				  
				  $updateData['refid'] 			  = $this->session->userdata('refId');  	

			      $updateData['user_name']    	  = $this->input->post('username');

				  //$updateData['password']    	  = md5($this->input->post('pwd'));
				  $updateData['password']    	  = hash('sha384',$this->input->post('pwd'));

				  $updateData['name']    		  = $this->input->post('name');

				  $updateData['profile_desc']     = $this->input->post('profile');

				  $updateData['rate']    		  = $this->input->post('rate');

				  $updateData['job_notify']   = $this->input->post('notify_project');

				  $updateData['message_notify']   = $this->input->post('notify_message');

				  $updateData['country_symbol']   = $this->input->post('country');

				  $updateData['state']    		  = $this->input->post('state');

				  $updateData['city']    		  = $this->input->post('city');
				  
				  $updateData['user_status']      = '1';
				  
				if(isset($this->outputData['file'])){
				$updateData['logo']    = $this->outputData['file']['file_name'];
				$thumb1 = $this->outputData['file']['file_path'].$this->outputData['file']['raw_name']."_thumb".$this->outputData['file']['file_ext'];	
				 GenerateThumbFile($this->outputData['file']['full_path'],$thumb1,49,48);
				}

				  //Create User

				  $updateKey 		= array('activation_key'=>$this->input->post('confirmKey'));

				  $this->user_model->updateUser($updateKey,$updateData);
				  
				  $this->session->unset_userdata('refId');
				  
 				  $condition     = array('users.activation_key'=>$check_key);
				  
				  $users         = $this->user_model->getUserslist($condition);
				  
				  $users         = $users->row();
				  
 				  $conditions	 = array('users.role_id' => '2','users.activation_key'=>$this->input->post('confirmKey'));
 
				  $query 		 = $this->user_model->getUsers($conditions);
				  
				  $row = $query->row();
				  
				   //Work With Job Categories

				  $categories = $this->input->post('categories');

				  $ids 							 				 = implode(',',$categories);	

				  $insertData['user_categories']       			 = $ids;


				  $insertData['user_id']         				 = $users->id;

				  $insertData['user_id']         				 = $row->id;


 				  $this->user_model->insertUserCategories($insertData);
				  
				  $contacts              	= array();
			      $contacts['msn']    	  	= $this->input->post('contact_msn',TRUE);
				  $contacts['gtalk']    	= $this->input->post('contact_gtalk',TRUE);
				  $contacts['yahoo']    	= $this->input->post('contact_yahoo',TRUE);
				  $contacts['skype']    	= $this->input->post('contact_skype',TRUE);
				  $contacts['user_id'] 		= $row->id;
				  
				  $this->user_model->insertUserContacts($contacts);
				  
				 if(count($row) > 0 )
				  {
				  //Get the last insert username
				  $condition  =  array('users.activation_key'=>$this->uri->segment(3)); 
				  $registerusers      =  $this->user_model->getUsers($condition); 
				 
				  $registerusers      =  $registerusers->row();
				 //Send email to the user after registration
				  $conditionUserMail = array('email_templates.type'=>'registration');
				  $result            = $this->email_model->getEmailSettings($conditionUserMail);
					
				  $rowUserMailConent = $result->row();
					
				  $splVars = array("!site_name" => $this->config->item('site_title'),"!username" => $updateData['user_name'],"!password" => $this->input->post('pwd'),"!usertype" => 'Employee', "!siteurl" => site_url(), "!contact_url" => site_url('contact'));
				  $mailSubject = strtr($rowUserMailConent->mail_subject, $splVars);
				  $mailContent = strtr($rowUserMailConent->mail_body, $splVars);		
				  $toEmail     = $registerusers->email;
				  $fromEmail   = $this->config->item('site_admin_mail');
 				  $this->email_model->sendHtmlMail($toEmail,$fromEmail,$mailSubject,$mailContent);
				  $insertData=array();
				  $insertData['username']=$this->input->post('username');
				  //$insertData['password']=md5($this->input->post('pwd'));
				  $insertData['password']  = hash('sha384',$this->input->post('pwd'));
				  $expire=60*60*24*100;  
				  $this->auth_model->setUserCookie('user_name',$insertData['username'], $expire);
				  $this->auth_model->setUserCookie('user_password',$insertData['password'], $expire); 
				  redirect('users/login');	
				       }
                           	      
				           
				  //Notification message

				  $this->session->set_flashdata('flash_message', $this->common_model->flash_message('success',$this->lang->line('emp_confirm_success')));

				  redirect('information/index/success');

		 	 } //Form Validation End

			

		} //If - Form Submission End	

	

		//Get Categories

		$this->outputData['categories']	=	$this->skills_model->getCategories();

		

		//Get Countries

		$this->outputData['countries']	=	$this->common_model->getCountries();

	

		//Get Activation Key


		$activation_key = $this->uri->segment(3,'0');

		

		//Conditions

		$conditions		= array('users.role_id' => '2','users.activation_key'=>$activation_key);

		

		$query 			= $this->user_model->getUsers($conditions);

		//pr($query->row());exit;

		

		if($query->num_rows==1)		

		{

			$row = $query->row();

		} else {

			$this->session->set_flashdata('flash_message', $this->common_model->flash_message('success',$this->lang->line('emp_activationkey_error')));

			redirect('employee/signup');

		}	

	
	    $like = array('page.url'=>'privacy');
	    $this->outputData['page_content']	=	$this->page_model->getPages(NULL,$like,NULL);	
		
		
		$like = array('page.url'=>'ter');
	    $like1 = array('page.url'=>'cond');
	    $this->outputData['page_content1']	=	$this->page_model->getPages(NULL,$like,$like1);			
			

		$this->outputData['confirmed_mail']	= $row->email;		

		
 		$this->load->view('employee/view_emp_confirm',$this->outputData);

 
	}//Function confirm End

	

	// --------------------------------------------------------------------

	

	/**

	 * Loads confirm page for employee

	 *

	 * @access	public

	 * @param	nil

	 * @return	void

	 */ 

	function _logo_check()

	{

		if(isset($_FILES) and $_FILES['logo']['name']=='')				

			return true;

		

		$config['upload_path'] 		='files/logos/';

		$config['allowed_types'] 	='jpeg|jpg|png|gif|JPEG|JPG|PNG';

		$config['max_size'] 		= $this->config->item('max_upload_size');

		$config['encrypt_name'] 	= TRUE;

		$config['remove_spaces'] 	= TRUE;

		

		$this->load->library('upload', $config);

		

		if ($this->upload->do_upload('logo'))

		{

			$this->outputData['file'] = $this->upload->data();			

			return true;			

		} else {

			$this->form_validation->set_message('_logo_check', $this->upload->display_errors($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag')));

			return false;

		}//If end 

	

	}//Function logo_check End

	

	// --------------------------------------------------------------------

	

	/**

	 * Loads confirm page for owner

	 *

	 * @access	public

	 * @param	nil

	 * @return	void

	 */ 

	function _check_activation_key($activation_key=0)

	{

		//Conditions

		$conditions		= array('users.activation_key'=>$activation_key);

		

		$query 			= $this->user_model->getUsers($conditions);

		

		if($query->num_rows==1)

		{		

			return true;	

		} else {

			$this->form_validation->set_message('check_activation_key', $this->lang->line('activation_key_validation'));

			return false;

		}

	}//Function check_activation_key End

	

	// --------------------------------------------------------------------

	

	/**

	 * Loads edit Programmer Profile .

	 *

	 * @access	public

	 * @param	nil

	 * @return	void

	 */	

	function editProfile()

	{	

		//language file

		$this->lang->load('enduser/editProfile', $this->config->item('language_code'));
		
		
		//Check Whether User Logged In Or Not
	    if(!isset($this->loggedInUser->id))
		  {
		  	$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('You must be login access to this page')));
		    redirect('information');
		  }

   	//Check Whether User Logged In Or Not

	    if(isLoggedIn()===false)

		{

			$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('not_access')));

			redirect('information');

		}

		//load validation library

		$this->load->library('form_validation');

		

		//Load Form Helper

		$this->load->helper('form');

		

		//Intialize values for library and helpers	

		$this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));

		

		 

		if($this->input->post('editEmpProfile'))

		{	

			//Set rules

			$this->form_validation->set_rules('logo','lang:logo_validation','callback__logo_check');
 			$this->form_validation->set_rules('name','lang:programmer_name_validation','required|trim|min_length[5]|xss_clean');
 			$this->form_validation->set_rules('categories[]','lang:categories_validation','required|xss_clean');
 			$this->form_validation->set_rules('email','Email','required|trim|min_length[5]|xss_clean');
 			$this->form_validation->set_rules('rate','lang:rate_validation','required|trim|integer|xss_clean|abs');
 			$this->form_validation->set_rules('contact_msn','msn','trim|xss_clean');
			$this->form_validation->set_rules('contact_gtalk','gtalk','trim|xss_clean');
			$this->form_validation->set_rules('contact_yahoo','yahoo','trim|xss_clean');
			$this->form_validation->set_rules('contact_skype','skype','trim|xss_clean');
			$this->form_validation->set_rules('notify_project','new bid','trim|xss_clean');
			$this->form_validation->set_rules('notify_message','new message','trim|xss_clean');
			$this->form_validation->set_rules('country','lang:country_validation','required');
			$this->form_validation->set_rules('state','lang:state_validation','trim|xss_clean');
			$this->form_validation->set_rules('city','lang:city_validation','trim|xss_clean');
			

           	if($this->form_validation->run())

			{	

					

				  $updateData              		  = array();	

				  if($this->input->post('pwd') != '')

				  {
					//echo md5($this->input->post('pwd'));
				  	//$updateData['password']    	  = md5($this->input->post('pwd'));
					$updateData['password']    	  = hash('sha384',$this->input->post('pwd'));

				  }

				  $updateData['name']    		  = $this->input->post('name',TRUE);

				  $updateData['email']    		  = $this->input->post('email',TRUE);

				  $updateData['profile_desc']     = $this->input->post('profile',TRUE);

				  $updateData['job_notify']       = $this->input->post('notify_project',TRUE);

				  $updateData['message_notify']   = $this->input->post('notify_message',TRUE);

				  

			

				  if(($this->loggedInUser->logo != '') and (isset($this->outputData['file']['file_name'])))

					{

					 	$filepath = $this->config->item('basepath').'files/logos/'.$this->loggedInUser->logo;
					//echo $filepath;exit;
						@unlink ($filepath);

						 if(isset($this->outputData['file']['file_name'])) 

						 $updateData['logo']   = $this->outputData['file']['file_name']; 
						 
						 $thumb1 = $this->outputData['file']['file_path'].$this->outputData['file']['raw_name']."_thumb".$this->outputData['file']['file_ext'];	
						 
						 GenerateThumbFile($this->outputData['file']['full_path'],$thumb1,49,48);


					}

				   else

				      {

					    if(isset($this->outputData['file']['file_name'])) {

				  		$updateData['logo']  = $this->outputData['file']['file_name'];	
						
						$thumb1 = $this->outputData['file']['file_path'].$this->outputData['file']['raw_name']."_thumb".$this->outputData['file']['file_ext'];	
						 
						 GenerateThumbFile($this->outputData['file']['full_path'],$thumb1,49,48);
						}

					 }		

			

				  $updateData['country_symbol']  		 = $this->input->post('country',TRUE);

				  $updateData['state']    		  		 = $this->input->post('state',TRUE);

				  $updateData['city']  					 = $this->input->post('city',TRUE);

				  $updateData['rate']    		  		 = $this->input->post('rate',TRUE);

				  

				  //update data's in userContacts table

				  $userContacts['msn']					=  $this->input->post('contact_msn',TRUE);

				  $userContacts['gtalk']				=  $this->input->post('contact_gtalk',TRUE);

				  $userContacts['yahoo']				=  $this->input->post('contact_yahoo',TRUE);

				  $userContacts['skype']				=  $this->input->post('contact_skype',TRUE);

				  //

				  

				  $userCategoryId                      = $this->loggedInUser->id;

				 //Get Activation Key

		          $activation_key = $this->uri->segment(3,'0');

				  //Create User

				  $updateKey 						= array('id'=>$this->loggedInUser->id);

					 				   

				   // Update process for users table

				   $this->user_model->updateUser($updateKey,$updateData);

				   

				   $updateKey1 							= array('users.activation_key'=>$this->input->post('confirmKey'));

				   $query 			        			= $this->user_model->getUsers($updateKey1);

				  	

				  $row = $query->row();

				  $userid = $row->id;

				  $updateKey2 							= array('user_contacts.user_id'=>$this->loggedInUser->id);

				  $query2			       			    = $this->user_model->getUserContacts($updateKey2);

				  $userDetails				 			= $query2->row();

				  

				  

				  //pr($query2->num_rows());exit;

				 if($query2->num_rows() == 0)

				   	{

					  $insertData              			= array();

					  $insertData['user_id'] 			= $this->loggedInUser->id;

					  $insertData['msn']    	  		= $this->input->post('contact_msn',TRUE);

					  $insertData['gtalk']    			= $this->input->post('contact_gtalk',TRUE);

					  $insertData['yahoo']    			= $this->input->post('contact_yahoo',TRUE);

					  $insertData['skype']    			= $this->input->post('contact_skype',TRUE);

					 

					  $this->user_model->insertUserContacts($insertData);

				  }

				  else

				 	 {

					  //update data's in userContacts table

					  $userContacts['msn']				=  $this->input->post('contact_msn',TRUE);

					  $userContacts['gtalk']			=  $this->input->post('contact_gtalk',TRUE);

					  $userContacts['yahoo']			=  $this->input->post('contact_yahoo',TRUE);

					  $userContacts['skype']			=  $this->input->post('contact_skype',TRUE);


					// update process for Content	  

					  $this->user_model->updateUserContacts($userContacts,$updateKey2);

				 	 }

				// user categories 

				 

				  if($this->input->post('categories') != '')

				  {

				 

				  $userid = $this->loggedInUser->id;

				  $updateKey3							= array('user_categories.user_id'=>$userid);

				  $query3			       			    = $this->user_model->getUserCategories($updateKey3);

				  $userDetails				 			= $query3->row();

				  $area_expertice	 					 = $this->input->post('categories',TRUE);	

				  $ids 							 		 = implode(',',$area_expertice);
				  
				  $i=0;
				  //pr($area_expertice);
				  foreach($area_expertice as $cat)
				   {
				    
				     $conditions = array('categories.id'=>$cat);
 		             $categories = $this->skills_model->getCategories($conditions); 
					 $categories         = $categories->row();
					 $category[$i++]    = $categories->category_name;  
				   } 
				 $category 							 		 = implode(',',$category);
				  

				  $userCategories['user_categories']    =  $ids;

				  if($query3->num_rows() == 0)

				   	{

					  $insertData1              		= array();

					  $insertData1['user_id'] 			= $this->loggedInUser->id;

					  $insertData1['user_categories']	= $ids;

					  $this->user_model->insertUserCategories($insertData1);

				  }

				  else

				 	 {

					  $userid = $this->loggedInUser->id;

					  $area_expertice	 					 = $this->input->post('categories',TRUE);	

					  $ids 							 		 = implode(',',$area_expertice);

					  $userCategories['user_categories']    =  $ids;

					// update process for Content	  

					  $this->user_model->updateCategories(array('user_categories.user_id'=>$userid),$userCategories);

				 	 }

					}
				 if($this->input->post('pwd',TRUE))
				     $data1     = 'Password            :'.$this->input->post('pwd');
				  else
				     $data1 	= ''; 
				
				  if($this->input->post('name',TRUE))
				     $data2     = 'Company Name        :'.$this->input->post('name',TRUE);
				  else
				     $data2 	= ''; 
					 
				  if($this->input->post('email',TRUE))
				     $data3     = 'Email Id            :'.$this->input->post('email');
				  else
				     $data3 	= ''; 
					 
				  if($this->input->post('profile',TRUE))
				     $data4     = 'Profile Description :'.$this->input->post('profile');
				  else
				     $data4 	= ''; 
					 
				  if($this->input->post('notify_project',TRUE))
				     $data5     = 'Job Notify      :'.$this->input->post('notify_project');
				  else
				     $data5 	= ''; 
					 
				  if($this->input->post('notify_message',TRUE))
				     $data6     = 'Message Notify      :'.$this->input->post('notify_message');
				  else
				     $data6 	= ''; 
					 
				 if($this->input->post('country',TRUE))
				     {
					 $condition = array('country.country_symbol'=>$this->input->post('country'));
				     $country   = $this->common_model->getCountries($condition);
					 $country   = $country->row();
					 $data7     = 'Country             :'.$country->country_name;
					 }
				  else
				     $data7 	= ''; 
					 
				  if($this->input->post('city',TRUE))
				     $data8     = 'City                :'.$this->input->post('city');
				  else
				     $data8 	= ''; 
					 
				 if($this->input->post('state',TRUE))
				     $data9     = 'State               :'.$this->input->post('state');
				  else
				     $data9 	= ''; 	 	 	 	 	 	 	 	 
					 
				 if($this->input->post('contact_msn',TRUE))
				     $data10     = 'MSN ID             :'.$this->input->post('contact_msn');
				  else
				     $data10   	 = ''; 
					 
				 if($this->input->post('contact_gtalk',TRUE))
				     $data11     = 'Gtalk ID           :'.$this->input->post('contact_gtalk');
				  else
				     $data11     = ''; 
					 
				 if($this->input->post('contact_yahoo',TRUE))
				     $data12     = 'Yahoo Id           :'.$this->input->post('contact_yahoo');
				  else
				     $data12 	= ''; 	
					 
				 if($this->input->post('contact_skype',TRUE))
				     $data12     = 'Skype Id           :'.$this->input->post('contact_skype');
			     else
				     $data12 	= ''; 		  	 	 
				  
				 if(isset($ids))
					 $data13    = 'Area of Expertise     :'.$category;
				 else
				     $data13 	= '';
					   	 
				//Send email to the user after update profile
				  $conditionUserMail = array('email_templates.type'=>'profile_update');
				  $result            = $this->email_model->getEmailSettings($conditionUserMail);
				  $rowUserMailConent = $result->row();
					
				  $splVars = array("!site_name" => $this->config->item('site_title'),"!username" => $this->loggedInUser->user_name,"!siteurl" => site_url(), "!contact_url" => site_url('contact'),"!data1" => $data1,"!data2" => $data2,"!data3" => $data3,"!data4" => $data4,"!data5" => $data5,"!data6" => $data6,"!data7" => $data7,"!data8" => $data8,"!data9" => $data9,"!data10" => $data10,"!data11" => $data11,"!data12" => $data12,"!data13"=>$data13);
				  $mailSubject = strtr($rowUserMailConent->mail_subject, $splVars);
				  $mailContent = strtr($rowUserMailConent->mail_body, $splVars);		
				  $toEmail     = $this->loggedInUser->email;
				  $fromEmail   = $this->config->item('site_admin_mail');
					//echo $mailContent;exit;
				  $this->email_model->sendHtmlMail($toEmail,$fromEmail,$mailSubject,$mailContent);
				  //Notification message

				  $this->session->set_flashdata('flash_message', $this->common_model->flash_message('success',$this->lang->line('update_employee_confirm_success')));

				  redirect('information/index/success');

		 	}  //Form Validation End

			

		} //If - Form Submission End	

		

		//Get Categories

		$this->outputData['categories']					=	$this->skills_model->getCategories();

 		//Get Countries

		$this->outputData['countries']					=	$this->common_model->getCountries();

    	//Conditions

		 $conditions									= array('users.id'=>$this->loggedInUser->id);
 
		 $this->outputData['userInfo'] 					= $this->user_model->getUsers($conditions);

		 
 		 // get Users Categories  from user Categories  table

	     $conditions								= array('user_categories.user_id'=>$this->loggedInUser->id);

		 $this->outputData['userCategories'] 		= $this->user_model->getUserCategories($conditions);

 
		// pr($this->outputData['userCategories']->result());exit;

		 // get Users Contact Informations from user Contacts  table
		 
		 $like = array('page.url'=>'privacy');
	    $this->outputData['page_content']	=	$this->page_model->getPages(NULL,$like,NULL);	
		
		
		$like = array('page.url'=>'ter');
	    $like1 = array('page.url'=>'cond');
	    $this->outputData['page_content1']	=	$this->page_model->getPages(NULL,$like,$like1);	

	     $conditions								= array('user_contacts.user_id'=>$this->loggedInUser->id);

		 $this->outputData['userContactInfo'] 		= $this->user_model->getUserContacts($conditions);

		 $this->load->view('employee/view_empEditProfile',$this->outputData);

				

	} //Function editProfile End

	

	// --------------------------------------------------------------------



	/**



	 * Check for programmer mail id



	 *



	 * @access	public



	 * @param	nil



	 * @return	void



	 */ 



	function _check_programmer_email($mail)

	{

		//language file



		$this->lang->load('enduser/employee', $this->config->item('language_code'));



		//Get Role Id For Owners



	  	$role_id	= $this->user_model->getRoleId('employee');

			

		//Conditions



		$conditions		= array('users.email'=>$mail,'users.role_id'=>$role_id);



		$result 		= $this->user_model->getUsers($conditions);

		

		$conditions2		= array('bans.ban_value'=>$mail,'bans.ban_type'=>'EMAIL');

		$result2 		= $this->user_model->getBans($conditions2);



		if ($result->num_rows()==0 && $result2->num_rows() == 0)

		{

			return true;			



		} else {



			$this->form_validation->set_message('_check_programmer_email', $this->lang->line('programmer_email_check'));



			return false;



		}//If end 



	}//Function  _check_usernam End
	
	// --------------------------------------------------------------------
	
	/**
	 * Check for buyer mail id
	 *
	 * @access	public
	 * @param	nil
	 * @return	void
	 */ 
	function _check_resendprogrammer_email($mail)
	{
		
		//language file
		$this->lang->load('enduser/employee', $this->config->item('language_code'));
		//Get Role Id For Owners
	  	$role_id	= $this->user_model->getRoleId('employee');
			
		//Conditions
		$conditions		= array('users.email'=>$mail,'users.role_id'=>$role_id,'users.user_status' => '0');
		$result 		= $this->user_model->getUsers($conditions);
		$conditionsmail		= array('users.email'=>$mail,'users.role_id'=>$role_id);
		$resultmail 		= $this->user_model->getUsers($conditionsmail);
		$conditions2		= array('bans.ban_value'=>$mail,'bans.ban_type'=>'EMAIL');
		$result2 		= $this->user_model->getBans($conditions2);
		//pr($result->num_rows());exit;
		if ($result2->num_rows() == 0 && $result->num_rows() == 1)
		{
			return true;			
		}
		else if ($result2->num_rows() == 0 && $resultmail->num_rows() != 0)
		{
		$this->form_validation->set_message('_check_resendprogrammer_email', $this->lang->line('buyer_email_ban'));
			return false;			
		}  
		else if($result2->num_rows() != 0 || $resultmail->num_rows() == 0) {
				$this->form_validation->set_message('_check_resendprogrammer_email', $this->lang->line('not_registered'));
			return false;
		}//If end 
	
	}//Function _check_resendbuyer_email End
	

	// --------------------------------------------------------------------

	

	function _check_username($username)

	{

		//language file



		$this->lang->load('enduser/employee', $this->config->item('language_code'));



		//Get Role Id For Buyers



	  	$role_id	= $this->user_model->getRoleId('employee');

			

		//Conditions



		$conditions		= array('users.user_name'=>$username,'users.role_id'=>$role_id);



		$result 		= $this->user_model->getUsers($conditions);

		

		$conditions2		= array('bans.ban_value'=>$username,'bans.ban_type'=>'USERNAME');

		$result2 		= $this->user_model->getBans($conditions2);



		if ($result->num_rows()==0 && $result2->num_rows() == 0)

		{

			return true;			



		} else {



			$this->form_validation->set_message('_check_username', $this->lang->line('programmer_username_check'));



			return false;



		}//If end 



	}//Function  _check_usernam End

	

	// --------------------------------------------------------------------

	

	

	/**

	 * View Employee's profile

	 *

	 * @access	public

	 * @param	nil

	 * @return	void

	 */ 

	function viewProfile()

	{

 		//Load Language

		$this->lang->load('enduser/viewProfile', $this->config->item('language_code'));

		if(!is_numeric($this->uri->segment(3)))  
		  {
		  	$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('You can not access to this page')));
			 redirect('information');
		  } 	

		$employeeId = $this->uri->segment(3,'0');
 
		//Get user details
 		$conditions = array('users.id' => $employeeId);
 
		$user = $this->user_model->getUsers($conditions);	

  		$this->outputData['userDetails'] = $user;
 
		$urow = $user->row();
 
		//Get Portfolio

		$condition = array('portfolio.user_id' => $employeeId);

		$this->outputData['portfolio']	= $this->user_model->getPortfolio($condition);

 		//Get user contacts

 		$conditions2 = array('user_contacts.user_id' => $employeeId);
 
		$this->outputData['userContacts'] = $this->user_model->getUserContacts($conditions2);

		
   		$country = $this->common_model->getCountries(array('country_symbol' => $urow->country_symbol));
 
 		$this->outputData['country'] = $country->row();
  
		// get Users Categories  from user Categories  table

	     $conditions								= array('user_categories.user_id'=>$employeeId);

		 $this->outputData['userCategories'] 		= $this->user_model->getUserCategories($conditions);
 
		 //Get Categories

		$this->outputData['categories']					=	$this->skills_model->getCategories();
 		
 		$this->load->view('employee/view_empProfile',$this->outputData);
 
	}//Function viewProfile End

	

	// --------------------------------------------------------------------

	

	/**

	 * View jobs bidding by a employee

	 *

	 * @access	Private

	 * @param	nil

	 * @return	void

	 */ 

	function viewMyJobs()
	{
		$this->load->helper('reviews');		
		//Load Language
		$this->lang->load('enduser/viewJob', $this->config->item('language_code'));
       //language file

		$this->lang->load('enduser/editProfile', $this->config->item('language_code'));
		
		//Check For Buyer Session
		if(!isEmployee())
		{
        	$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('You must be logged in as a Employee')));
			redirect('information');
		}
		  
		//Check Whether User Logged In Or Not
	    if(isLoggedIn()===false)
		{
			$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('Dont have rights to access this page')));
			redirect('information');
		}
		//Get buyer id
		$employee_id	 = $this->loggedInUser->id;
		
		$page = $this->uri->segment(3,'0');
		
		//Get Sorting order
		$field = $this->uri->segment(4,'0');
		
		$order = $this->uri->segment(5,'0');
		
		$this->outputData['order']	=  $order;
		$this->outputData['field']	=  $field;
		
		$orderby = array();
		if($field)
		$orderby = array($field,$order);
		
		//pr($page);exit;
		if(isset($page)===false or empty($page)){
			$page = 1;
		}
		
		//
		if($this->loggedInUser)
		{
			$buyer_id	 = $this->loggedInUser->id;
			
			//Get bookmark jobs
			$condition_bookmark =array('bookmark.creator_id'=>$buyer_id);
			$bookMark1 = $this->skills_model->getBookmark($condition_bookmark);
			
			//Get all users
			$this->outputData['getUsers']	= $this->user_model->getUsers();	
			
			//pagination limit
			$page_rows1         					 =  $this->config->item('mail_limit');
				
			$limit1[0]			 = $page_rows1;
			$limit1[1]			 = '0';
			 
			//Get all message trasaction with some limit
			$bookMark = $this->skills_model->getBookmark($condition_bookmark,NULL,NULL,$limit1);
	        $this->outputData['bookMark'] = $bookMark;
			
			//Pagination
			$this->load->library('pagination');
			$config['base_url'] 	 = site_url('owner/bookmarkJobs');
			$config['total_rows'] 	 = $bookMark1->num_rows();		
			$config['per_page']     = $page_rows1; 
			$config['cur_page']     = '0';
			$this->pagination->initialize($config);		
			$this->outputData['pagination1']   = $this->pagination->create_links2(false,'bookmarkProjects');
		}
		$this->outputData['page']	=  $page;
		
		$page_rows = $this->config->item('listing_limit');

		$max = array($page_rows,($page - 1) * $page_rows);

		//Conditions
		$conditions2		= array('bids.user_id '=>$employee_id,'jobs.job_status !=' => '2');

		$bids  =  $this->skills_model->getJobByBid($conditions2,NULL,NULL,$max,$orderby);
		
		$bids2  =  $this->skills_model->getJobByBid($conditions2);

		$this->outputData['biddingProjects']	= $bids;

		$this->outputData['programmer_id']	= $employee_id;

		$conditions3		= array('bids.user_id '=>$employee_id,'jobs.job_status =' => '2','jobs.employee_id' => $employee_id);

		$wonbids  =  $this->skills_model->getJobByBid($conditions3);

		$this->outputData['wonBids']	= $wonbids;
		
		//Pagination
		$this->load->library('pagination');

		$config['base_url'] 	= site_url('employee/viewMyJobs');

		$config['total_rows'] 	= $bids2->num_rows();		
		
		$config['per_page'] = $page_rows; 
		
		$config['cur_page'] = $page;

		$this->pagination->initialize($config);		

		$this->outputData['pagination']   = $this->pagination->create_links(false,'project');
		
			//pr($bids->result());exit;

		$this->load->view('employee/view_myJobs',$this->outputData);

		

	}//Function viewMyJobs End

	

	// --------------------------------------------------------------------

	

	/**

	 * Retract bids by Seller

	 *

	 * @access	priate

	 * @param	nil

	 * @return	void

	 */ 

	function retractBid()

	{

		//Load Language

		$this->lang->load('enduser/viewJob', $this->config->item('language_code'));

		//Get bid id

		$bidid	 = $this->uri->segment(3,'0');

		$this->outputData['bidid']	= $bidid;

		

		if($this->input->post('retractBid')){

			$bid = $this->input->post('bidId');

			//Condition

			$conditions		= array('bids.id '=>$bid);

			$this->skills_model->deleteBid($conditions);

			 $this->session->set_flashdata('flash_message', $this->common_model->flash_message('success',$this->lang->line('Your bid has been removed')));

			redirect('employee/viewMyJobs');

		}

		

		//pr($bids->result());exit;

		$this->load->view('employee/view_retractBid',$this->outputData);

		

	}//Function viewMyJobs End

	

	// --------------------------------------------------------------------

	

	/**

	 * review buyers

	 *

	 * @access	private

	 * @param	nil

	 * @return	void

	 */ 

	function reviewOwner()

	{
		
		//Load Language

		$this->lang->load('enduser/review', $this->config->item('language_code'));
		
		//Check For Buyer Session
		if(!isEmployee())
		{
        	$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('You must be logged in as a Employee to review Owner')));
			redirect('information');
		}
		

		if($this->input->post('reviewBuy')){

			$insertData = array();

			$insertData['comments'] = $this->input->post('comment',true);

			$insertData['rating'] = $this->input->post('rate',true);

			$insertData['review_type'] = '1';

			$insertData['review_time'] = get_est_time();

			$insertData['job_id'] = $this->input->post('pid',true);

			$insertData['owner_id'] = $this->input->post('bid',true);

			$insertData['employee_id'] = $this->loggedInUser->id;

			//Create Review

			$reviewId = $this->skills_model->createReview($insertData);

			//Update jobs

			$this->skills_model->updateJobs($insertData['job_id'],array('owner_rated' => '1'));
			
			$condition = array('reviews.job_id' => $insertData['job_id']);
			$rev = $this->skills_model->getReviews($condition);
			//pr($rev->result());exit;
			//Send Mail
			$conditionUserMail = array('email_templates.type'=>'programmer_review');
			$result            = $this->email_model->getEmailSettings($conditionUserMail);
			$rowUserMailConent = $result->row();
			
			//Get Jobs details
			$condition = array('jobs.id' => $insertData['job_id']);
			$projectDetails = $this->skills_model->getJobs($condition,'jobs.job_name');
			$prjRow = $projectDetails->row();
			
			//Get User details
			$getuser = $this->user_model->getUsers(array('users.id' => $insertData['owner_id']));
			$user = $getuser->row();
			
			$splVars = array("!programmer_name" => $this->loggedInUser->user_name, "!project_name" => $prjRow->job_name,"!site_name" => site_url(''),'!site_title' => $this->config->item('site_title'));
			$mailSubject = strtr($rowUserMailConent->mail_subject, $splVars);
			$mailContent = strtr($rowUserMailConent->mail_body, $splVars);
			$toEmail = $user->email;
			$fromEmail = $this->config->item('site_admin_mail');
			
			//Send mail
			$this->email_model->sendHtmlMail($toEmail,$fromEmail,$mailSubject,$mailContent);
			
			if($rev->num_rows() >= 1){
			
				if($rev->num_rows() < 2){
			
				$insertData2 = array();
				
				$insertData2['rating'] = $insertData['rating'];
				
				$insertData2['user_id'] = $insertData['owner_id'];
				
				$insertData2['job_id'] = $insertData['job_id'];
				
				$this->skills_model->insertRatingHold($insertData2);
				
				//$this->skills_model->updateReviews($reviewId,array('reviews.hold' => '1'));
			}
				
				//Increase number of reviews
	
				$num_reviews = ($user->num_reviews)+1;
	
				//Rating
	
				if($user->user_rating == 0)
	
					$rating = $insertData['rating'];
	
				else
	
					$rating = ($user->user_rating + $insertData['rating']) / 2;
					
				$tot_rating2 = ($rating * $num_reviews);
	
				//Update Owner
	
				$this->skills_model->updateUsers($insertData['owner_id'],array('user_rating' => $rating,'num_reviews' => $num_reviews,'tot_rating' => $tot_rating2));
				
				//Get Provider details
				/*$getHold = $this->skills_model->getRatingHold(array('rating_hold.user_id' => $this->loggedInUser->id,'rating_hold.job_id' => $insertData['job_id']));
				$holdRow = $getHold->row();
				
				if($getuser->num_rows() > 0){
				
					//Get Provider details
					$getuser = $this->user_model->getUsers(array('users.id' => $this->loggedInUser->id),'users.user_rating,users.num_reviews');
					$providerRow = $getuser->row();
				
					//Rating
					if($providerRow->user_rating == 0)
						$rating = $holdRow->rating;
					else
						$rating = ($providerRow->user_rating + $holdRow->rating) / 2;
						
					//Increase number of reviews
					$num_reviews = ($providerRow->num_reviews)+1;
					
					$tot_rating = ($rating * $num_reviews);
					
					//Update Provider
					$this->skills_model->updateUsers($this->loggedInUser->id,array('user_rating' => $rating,'num_reviews' => $num_reviews,'tot_rating' => $tot_rating));
					
					$condition2 = array('reviews.job_id' => $insertData['job_id'],'reviews.employee_id' => $this->loggedInUser->id,'reviews.review_type' => '2');
					$getrev = $this->skills_model->getReviews($condition2,'reviews.id');
					$revRow = $getrev->row();
					//echo $reviewId;exit;
					$this->skills_model->updateReviews($revRow->id,array('reviews.hold' => '0'));
				}*/
			}
			/*if($rev->num_rows() == 1){
			
				$insertData2 = array();
				
				$insertData2['rating'] = $insertData['rating'];
				
				$insertData2['user_id'] = $insertData['owner_id'];
				
				$insertData2['job_id'] = $insertData['job_id'];
				
				$this->skills_model->insertRatingHold($insertData2);
				
				$this->skills_model->updateReviews($reviewId,array('reviews.hold' => '1'));
			}*/

			//Notification message

			$this->session->set_flashdata('flash_message', $this->common_model->flash_message('success',$this->lang->line('review_added')));
			
			redirect('information/index/success');

		}

		//Get project id

		$projectid	 = $this->uri->segment(3,'0');

		$condition = array('jobs.id' => $projectid);

		$projectDetails = $this->skills_model->getJobs($condition);

		$this->outputData['projectDetails'] = $projectDetails;

		$prjRow = $projectDetails->row();

		

		$condition2 = array('reviews.job_id' => $projectid,'reviews.owner_id' => $prjRow->creator_id,'reviews.review_type' => '1');

		$this->outputData['reviewDetails'] = $this->skills_model->getReviews($condition2);

		//pr($this->outputData['reviewDetails']->result());exit;

		

		$this->load->view('employee/view_reviewOwner',$this->outputData);

		

	}//Function reviewBuyer End

	

	// --------------------------------------------------------------------

	

	/**

	 * Lists review of a provider

	 *

	 * @access	public

	 * @param	nil

	 * @return	void

	 */	

	function review()

	{	

		//Load Language

		$this->lang->load('enduser/review', $this->config->item('language_code'));

		

		//Load helper

		$this->load->helper('reviews');

		

		if(!is_numeric($this->uri->segment(3)))  
		  {
		  	$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('You can not access to this page')));
			 redirect('information');
		  } 

		$userId = $this->uri->segment(3,'0');



		//Get user details

		

		$conditions = array('users.id' => $userId);

		

		$user = $this->user_model->getUsers($conditions);	

		

		$urow = $user->row();

		 

		$this->outputData['userDetails'] = $urow;

	

		//pr($urow);exit;

		//Get reviews

		$condition2 = array('reviews.employee_id' => $urow->id,'reviews.review_type' => '2','reviews.hold' => '0');

		

		$this->outputData['reviewDetails'] = $this->skills_model->getReviews($condition2);

		

		//pr($this->outputData['reviewDetails']->result());exit;

		

		$this->load->view('employee/view_review',$this->outputData);

				

	} //Function logout End

	

	// --------------------------------------------------------------------

	

	 /**

	 * Get top programmers

	 *

	 * Returns all programmers rating reviews

	 *

	 * @access	private

	 * @param	string

	 * @return	string

	 */

	function topEmployees()
	{
	
	  //language file
		$this->lang->load('enduser/memberReview', $this->config->item('language_code'));
		
		
	
		//Get reviews

		$result     = $this->skills_model->topEmployees();

		$this->outputData['topEmployees'] =  $result;

		$this->load->view('employee/view_topEmployee',$this->outputData);

	} //End of getBuyerReview function

	// --------------------------------------------------------------------

	

	 /**

	 * Manage portfolio of Employees

	 * @access	private

	 * @param	string

	 * @return	string

	 */

	function managePortfolio()

	{

		//language file

		$this->lang->load('enduser/editProfile', $this->config->item('language_code'));
		
		//Check For Buyer Session
		if(!isEmployee())
		{
        	$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('You must be logged in as a Employee')));
			redirect('information');
		}

		//load validation libraray

		$this->load->library('form_validation');

		//Load Form Helper

		$this->load->helper('form');

		//Intialize values for library and helpers	

		$this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));

		//Get Form Data	

		if($this->input->post('createPortfolio'))

		{	

			//Set rules

			$this->form_validation->set_rules('title','lang:portfolio_title_validation','required|trim|xss_clean');

			$this->form_validation->set_rules('description','lang:portfolio_description_validation','required|trim|xss_clean');

			$this->form_validation->set_rules('categories[]','lang:portfolio_categories_validation','required');

			$this->form_validation->set_rules('thumbnail','lang:portfolio_thumbnail_validation','callback__thumbnail_check');

			$this->form_validation->set_rules('attachment1','lang:portfolio_attachment1_validation','callback__attachment1_check');

			$this->form_validation->set_rules('attachment2','lang:portfolio_attachment2_validation','callback__attachment2_check');



			if($this->form_validation->run())

			{	

				  if(check_form_token()===false)

				  {

				  	$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('token_error')));

				  	redirect('information');

				  }				  

				  //pr($this->outputData['file']);exit;

				   $categories = $this->input->post('categories');

				   $ids 	   = implode(',',$categories);

				  $insertData              	  = array();	

			      $insertData['title']    	  = $this->input->post('title');

				  $insertData['description']  = $this->input->post('description');

				  $insertData['categories']   = $ids;

				  $insertData['user_id']      = $this->loggedInUser->id;

				  $insertData['main_img']     = $this->outputData['file']['file_name'];

				  

				  if(isset($this->outputData['file1']))
				  {

				  	$insertData['attachment1']    		  = $this->outputData['file1']['file_name'];

					$thumb1 = $this->outputData['file1']['file_path'].$this->outputData['file1']['raw_name']."_thumb".$this->outputData['file1']['file_ext'];

					GenerateThumbFile($this->outputData['file1']['full_path'],$thumb1,120,90);

				  }

				  if(isset($this->outputData['file2']))
				  {

				  	$insertData['attachment2']    		  = $this->outputData['file2']['file_name'];

					$thumb2 = $this->outputData['file2']['file_path'].$this->outputData['file2']['raw_name']."_thumb".$this->outputData['file2']['file_ext'];

					GenerateThumbFile($this->outputData['file2']['full_path'],$thumb2,120,90);

				  }



				  //Create Portfolio

				  $this->user_model->insertPortfolio($insertData);

				  

				  //Notification message

				  $this->session->set_flashdata('flash_message', $this->common_model->flash_message('success',$this->lang->line('provider_portfolio_success')));

				  redirect('employee/managePortfolio');

		 	}  //Form Validation End

			

		} //If - Form Submission End	

		

		//Get Categories

		$this->outputData['categories']	=	$this->skills_model->getCategories();

		//pr($this->outputData['categories']);exit;

		//Get Portfolio
		if($this->loggedInUser)
		{
		$condition = array('portfolio.user_id' => $this->loggedInUser->id);

		$this->outputData['portfolio']	= $this->user_model->getPortfolio($condition);

		$condition2 = array('portfolio.id' => $this->uri->segment(3));

		$this->outputData['editPortfolio']	= $this->user_model->getPortfolio($condition2);
		
		 //Get Categories

		$this->outputData['categories']					=	$this->skills_model->getCategories();	

		}

		
       
		//pr($this->outputData['getPortfolio']->result());exit;

		$this->load->view('employee/view_editPortfolio',$this->outputData);

	} //End of getBuyerReview function

	

	// --------------------------------------------------------------------

	

	 /**

	 * Edit potfolio of providers

	 *

	 * Returns all programmers rating reviews

	 *

	 * @access	private

	 * @param	string

	 * @return	string

	 */

	function editPortfolio()

	{

		//language file

		$this->lang->load('enduser/editProfile', $this->config->item('language_code'));

		
		//Check For Buyer Session
		if(!isEmployee())
		{
        	$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('You must be logged in as a Programmer')));
			redirect('information');
		}
			

		//load validation libraray

		$this->load->library('form_validation');

		

		//Load Form Helper

		$this->load->helper('form');

		

		//Intialize values for library and helpers	

		$this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));

		

		//Get Form Data	

		if($this->input->post('editPortfolio'))

		{	
			//Set rules
			
			//echo $_FILES['attachment1']['name'];exit;

			$this->form_validation->set_rules('title','lang:portfolio_title_validation','required|trim|xss_clean');

			$this->form_validation->set_rules('description','lang:portfolio_description_validation','required|trim|xss_clean');

			$this->form_validation->set_rules('categories[]','lang:portfolio_categories_validation','required');

			if($_FILES['thumbnail']['name'] !='')

			$this->form_validation->set_rules('thumbnail','lang:portfolio_thumbnail_validation','callback__thumbnail_check');

			if($_FILES['attachment1']['name'] !='')

			$this->form_validation->set_rules('attachment1','lang:portfolio_attachment1_validation','callback__attachment1_check');

			if($_FILES['attachment2']['name'] !='')

			$this->form_validation->set_rules('attachment2','lang:portfolio_attachment2_validation','callback__attachment2_check');



			if($this->form_validation->run())

			{	

				  if(check_form_token()===false)

				  {

				  	$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('token_error')));

				  	redirect('information');

				  }				  

				  //pr($this->outputData['file']);exit;

				   $categories = $this->input->post('categories');

				   $ids 	   = implode(',',$categories);

				  $updateData              		  = array();	

			      $updateData['title']    	  = $this->input->post('title');

				  $updateData['description']    		  = $this->input->post('description');

				  $updateData['categories']     = $ids;

				  $updateData['user_id']    		  = $this->loggedInUser->id;


				  $condition2 = array('portfolio.id' => $this->input->post('portid'));

				  $port	= $this->user_model->getPortfolio($condition2);

				  $folio = $port->row();

				  $path = $this->config->item('basepath').'files/portfolios/';

				  if(isset($this->outputData['file'])){

				  	$files = array($folio->main_img);

					//delete image files from server

					delete_file($path,$files);

				  	$updateData['main_img']    		  = $this->outputData['file']['file_name'];
					

				  }

				  if(isset($this->outputData['file1'])){

				  	$files = array($folio->attachment1);

					//delete image files from server

					delete_file($path,$files);

				  	$updateData['attachment1']    		  = $this->outputData['file1']['file_name'];
					
					$thumb1 = $this->outputData['file1']['file_path'].$this->outputData['file1']['raw_name']."_thumb".$this->outputData['file1']['file_ext'];

					//createthumb($this->outputData['file1']['full_path'],$thumb1,120,90);
					
					GenerateThumbFile($this->outputData['file1']['full_path'],$thumb1,120,90);
					
					//$this->skills_model->cr_thumb($this->outputData['file1']['full_path']);

				  }

				  if(isset($this->outputData['file2'])){

				  	$files = array($folio->attachment2);

					//delete image files from server

					delete_file($path,$files);

				  	$updateData['attachment2']    		  = $this->outputData['file2']['file_name'];
					
					$thumb2 = $this->outputData['file2']['file_path'].$this->outputData['file2']['raw_name']."_thumb".$this->outputData['file2']['file_ext'];

					GenerateThumbFile($this->outputData['file2']['full_path'],$thumb2,120,90);
					
					//$this->skills_model->cr_thumb($this->outputData['file2']['full_path']);

				  }

					

				  $updateKey = array('portfolio.id' => $this->input->post('portid'));

				  //Edit Portfolio

				  $this->user_model->updatePortfolio($updateKey,$updateData);

				  

				  //Notification message

				  $this->session->set_flashdata('flash_message', $this->common_model->flash_message('success',$this->lang->line('provider_portfolio_success')));

				  redirect('employee/managePortfolio');

		 	}  //Form Validation End

			

		} //If - Form Submission End	

		

		//Get Categories

		$this->outputData['categories']	=	$this->skills_model->getCategories();

		

		//Get Portfolio

		$condition = array('portfolio.user_id' => $this->loggedInUser->id);

		$this->outputData['portfolio']	= $this->user_model->getPortfolio($condition);

		

		$condition2 = array('portfolio.id' => $this->uri->segment(3));

		$this->outputData['editPortfolio']	= $this->user_model->getPortfolio($condition2);

		

		 //Get Categories

		$this->outputData['categories']					=	$this->skills_model->getCategories();	

		//pr($this->outputData['getPortfolio']->result());exit;

		$this->load->view('employee/view_editPortfolio',$this->outputData);

	} //End of editPortfolio function

	

	// --------------------------------------------------------------------

	

	 /**

	 * Edit portfolio of Employees

 	 * @access	public

	 * @param	string

	 * @return	string

	 */

	function viewPortfolio()

	{

		//language file

		$this->lang->load('enduser/editProfile', $this->config->item('language_code'));

		if(!is_numeric($this->uri->segment(3)))  
		{
		$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('You can not access to this page')));
		 redirect('information');
		}

		$condition2 = array('portfolio.id' => $this->uri->segment(3));

		$this->outputData['portfolio']	= $this->user_model->getPortfolio($condition2);

		

		//Get Categories

		$this->outputData['categories']	=	$this->skills_model->getCategories();

		//pr($this->outputData['portfolio']->row());exit;

		$this->load->view('employee/view_portfolio',$this->outputData);

	}

	

	// --------------------------------------------------------------------

	

	/**

	 * Loads confirm page for buyer

	 *

	 * @access	public

	 * @param	nil

	 * @return	void

	 */ 

	function _thumbnail_check()

	{

		//pr($_FILES);exit;		

		if($_FILES['thumbnail']['name'] == ''){

		$this->form_validation->set_message('_thumbnail_check', $this->lang->line('portfolio_thumb_check'));

			return false;				

		}		

		$config['upload_path'] 		='files/portfolios/';

		$config['allowed_types'] 	='jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF';

		$config['max_size'] 		= $this->config->item('max_upload_size');

		$config['encrypt_name'] 	= TRUE;

		$config['remove_spaces'] 	= TRUE;

		

		$this->load->library('upload', $config);

		

		if ($this->upload->do_upload('thumbnail'))

		{

			$this->outputData['file'] = $this->upload->data();	

			//pr($this->outputData['file']);exit;

			$this->skills_model->cr_thumb($this->outputData['file']['full_path']);

			

			return true;			

		} else {

			$this->form_validation->set_message('_thumbnail_check', $this->lang->line('portfolio_thumb_check'));

			return false;

		}//If end 

	

	}//Function logo_check End

	

	// --------------------------------------------------------------------

	

	/**

	 * deletePortfolio function

	 *

	 * @access	public

	 * @param	nil

	 * @return	void

	 */ 

	function deletePortfolio(){

		$pid = $this->uri->segment(3,'0');

		$condition  = array('portfolio.id'=>$pid);

		$port = $this->user_model->getPortfolio($condition);

		$folio = $port->row();

		

		//Main image paths

		$path = $this->config->item('basepath').'files/portfolios/';

		$filepath = $folio->main_img;

		$attachment1 = $folio->attachment1;

		$attachment2 = $folio->attachment2;

		$files = array($filepath,$attachment1,$attachment2);

		//delete image files from server

		delete_file($path,$files);

		

		$this->user_model->deletePortfolio($condition);

		

		

		redirect('employee/managePortfolio');

	}//Function deletePortfolio End

	

	// --------------------------------------------------------------------

	

	/**

	 * Loads confirm page for buyer

	 *

	 * @access	public

	 * @param	nil

	 * @return	void

	 */ 

	function _attachment1_check()
	{
		if(isset($_FILES) and $_FILES['attachment1']['name']=='')				

			return true;

		

		$config['upload_path'] 		='files/portfolios/';

		$config['allowed_types'] 	='jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF';

		$config['max_size'] 		= $this->config->item('max_upload_size');

		$config['encrypt_name'] 	= TRUE;

		$config['remove_spaces'] 	= TRUE;
		
		$this->load->library('upload', $config);

		

		if ($this->upload->do_upload('attachment1'))
		{

			$this->outputData['file1'] = $this->upload->data();
			
			//pr($this->outputData['file1']);exit;
			//exit;
			return true;			

		} else {

			$this->form_validation->set_message('_attachment1_check', $this->lang->line('portfolio_attach_check'));

			return false;

		}//If end 

	

	}//Function logo_check End

	

	// --------------------------------------------------------------------

	

	/**

	 * Loads confirm page for buyer

	 *

	 * @access	public

	 * @param	nil

	 * @return	void

	 */ 

	function _attachment2_check()

	{

		

		if(isset($_FILES) and $_FILES['attachment2']['name']=='')				

			return true;

		

		$config['upload_path'] 		='files/portfolios/';

		$config['allowed_types'] 	='jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF';

		$config['max_size'] 		= $this->config->item('max_upload_size');

		$config['encrypt_name'] 	= TRUE;

		$config['remove_spaces'] 	= TRUE;
		
		

		$this->load->library('upload', $config);

		

		if ($this->upload->do_upload('attachment2'))

		{

			$this->outputData['file2'] = $this->upload->data();	

			return true;			

		} else {

			$this->form_validation->set_message('_attachment2_check', $this->lang->line('portfolio_attach_check'));

			return false;

		}//If end 

	

	}//Function logo_check End
	
	// --------------------------------------------------------------------
	/**

	 * Remove portfolio attachments

	 *

	 * @access	private

	 * @param	nil

	 * @return	void

	 */ 

	function removeAttachment()
	{
		//language file
		$this->lang->load('enduser/editProfile', $this->config->item('language_code'));
		
		//Check For Buyer Session
		if(!isEmployee())
		{
        	$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('You must be logged in as a Programmer')));
			redirect('information');
		}
		
		$portid = $this->uri->segment(4);
		
		$type = $this->uri->segment(3);

		$path = $this->config->item('basepath').'files/portfolios/';
		
		$condition2 = array('portfolio.id' => $portid);

		$port	= $this->user_model->getPortfolio($condition2);
		
		$folio = $port->row();
		
		$att = "attachment".$type;
		
		$files = array($folio->$att);

		//delete image files from server
		delete_file($path,$files);
		
		$updateData['attachment'.$type] = '';
		
		$updateKey = array('portfolio.id' => $portid);

		//Edit Portfolio
		$this->user_model->updatePortfolio($updateKey,$updateData);
		
		$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error','Attachment deleted successfully'));
		 redirect('employee/managePortfolio/'.$portid);
	}//Function removeAttachment End

	// --------------------------------------------------------------------
	/**

	 * Remove Profile image

	 *

	 * @access	private

	 * @param	nil

	 * @return	void

	 */ 

	function removePhoto()
	{
		//language file
		$this->lang->load('enduser/editProfile', $this->config->item('language_code'));
		
		//Check For Buyer Session
		if($this->uri->segment(4) == '2'){
			if(!isEmployee())
			{
				$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('You must be logged in as a Employee')));
				redirect('information');
			}
		}
		elseif($this->uri->segment(4) == '1'){
			if(!isOwner())
			{
				$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error','You must be logged in as a Owner'));
				redirect('information');
			}
		}
		
		$userid = $this->uri->segment(3);
		
		$path = $this->config->item('basepath').'files/logos/';
		
		$condition2 = array('users.id' => $userid);

		$port	= $this->user_model->getUsers($condition2);
		
		$folio = $port->row();
		//$arr = explode(".",$folio->logo);
		//$thumb = $arr[0]."_thumb.".$arr[1];
		$files = array($folio->logo);

		delete_file($path,$files);
		
		$updateData['users.logo'] = '';
		
		$updateKey = array('users.id' => $userid);

		//Edit Portfolio
		$this->user_model->updateUser($updateKey,$updateData);
		
		$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error','Profile photo deleted successfully'));
		if($this->uri->segment(4) == '2')
		redirect('employee/editProfile/');
		elseif($this->uri->segment(4) == '1')
		redirect('owner/editProfile/');
	}//Function removeAttachment End
	
	function remove()
	{
		$project_id = $this->uri->segment(3);
		$conditions   = array('bookmark.job_id'=>$project_id,'bookmark.creator_id'=>$this->loggedInUser->id);
		$bookMarks    = $this->common_model->deleteTableData('bookmark',$conditions);
		$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error','Bookmark deleted successfully'));
		redirect('employee/viewMyJobs/');
	}
}

//End  Employee Class

/* End of file employee.php */ 

/* Location: ./application/controllers/employee.php */

?>