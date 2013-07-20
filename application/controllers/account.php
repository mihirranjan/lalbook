<?php 
/*
  ****************************************************************************
  ***                                                                      ***
  ***      BIDONN 1.0	                                                   ***
  ***      File:  account.php                                              ***
  ***      Built: Mon June 20 10:28:30 2012                                ***
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


class Account extends CI_Controller {

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
	  
 		//Load Models Common
		$this->load->model('common_model');
		$this->load->model('skills_model');
		$this->load->model('account_model');
		$this->load->model('messages_model');
		$this->load->model('credential_model');
		
		//Get Logged In user
		$this->loggedInUser					= $this->common_model->getLoggedInUser();
		$this->outputData['loggedInUser'] 	= $this->loggedInUser;
		  
		//Page Title and Meta Tags
		$this->outputData 			= $this->common_model->getPageTitleAndMetaData();
		
		//Get Logged In user
		$this->loggedInUser					= $this->common_model->getLoggedInUser();
		$this->outputData['loggedInUser'] 	= $this->loggedInUser;
		
		//Currency Type
		$this->outputData['currency'] = $this->db->get_where('settings', array('code' => 'CURRENCY_TYPE'))->row()->string_value;
		//$this->outputData['currency'] = $this->db->get_where('currency', array('currency_type' => $currency_type))->row()->currency_symbol;
		
		if($this->loggedInUser)
		{
			//Get logged user role
			$this->outputData['logged_userrole']   =  $this->loggedInUser->role_id;
			
			//Check User Balance
			$this->load->model('account_model');
			$condition_balance 		 = array('user_balance.user_id'=>$this->loggedInUser->id);
			$results 	 			 = $this->account_model->getBalance($condition_balance);
	
			//If Record already exists
			if($results->num_rows()>0)
			{
				//get balance detail
				$rowBalance = $results->row();
				
				//check balance Amount	
				$updateKey 			  = array('user_balance.user_id'=>$this->loggedInUser->id);	
				$updateData 		  = array();
				$this->outputData['userAvailableBalance'] = $rowBalance->amount;
			}
		}
		//Get Latest Jobs
		$limit_latest = $this->config->item('latest_projects_limit');
		$limit3 = array($limit_latest);
		$this->outputData['latestJobs']	= $this->skills_model->getLatestJobs($limit3);
		
		//Get all the site settings
		 $this->outputData['escrow_limit']  =   $this->config->item('escrow_page_limit');
	     $this->outputData['transaction_limit']  =   $this->config->item('transaction_page_limit'); 
		
		//language file
		$this->lang->load('enduser/common', $this->config->item('language_code'));
		$this->lang->load('enduser/account', $this->config->item('language_code'));
		
		$this->load->helper('file');
	
	} //Controller End 
	
	// --------------------------------------------------------------------
	
	/**
	 * Loads Account page.
	 *
	 * @access	Private
	 * @param	nil
	 * @return	void
	 */ 
	function index()
	{	
	
	    //Load the package_model
	    $this->load->model('package_model');
		 $this->load->model('gallery_model');
	 $this->load->model('requirement_model');
        //Load Language File
		$this->lang->load('enduser/account', $this->config->item('language_code'));
		$this->lang->load('enduser/viewJob', $this->config->item('language_code'));
		
		//Load helper file
		$this->load->helper('transaction');
		$this->load->helper('reviews');
		
		//If Admin try to access this url...redirect him
		/*if(isAdmin() === true)
		{
			$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('Dont have rights to access this page')));
			redirect('information');
		}
	    */
		
		if(!isset($this->loggedInUser->id))
		  {
		  	$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('You can not access to this page')));
		    //echo "mihir";
			//exit;
			redirect('information');
		  }
		// check Certificate User
		if($this->loggedInUser)	
		{
			if(!($this->session->userdata('profile_mode')))
				$this->session->set_userdata('profile_mode', 'view');
			
		$this->load->library('form_validation');
		
		//Load Form Helper
		$this->load->helper('form');
		
		//Intialize values for library and helpers	
		$this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
		//
		$usid=$this->loggedInUser->id;
		
		//echo $usid;exit;
		
		$condtition = array('users.id'=>$usid);
		
		
		$this->outputData['userrecords'] =  $this->user_model->getUsers1($condtition);
		
		$this->outputData['products'] =  $this->gallery_model->getProducts($condtition);
		//print_r($this->outputData['products']);exit;
		$condtitions = array('buy_requirement.creator_id'=>$usid);
		
		//echo $usid;exit;
		$this->outputData['buyrequirements'] =  $this->requirement_model->getJobs($condtitions);
		$userrequire=$this->outputData['buyrequirements'] ;
		$buyes=$userrequire->result();
		//print_r($buyes);exit;
		//echo $usid;
		foreach($buyes as  $jobsr)
		{
		  $creator=$jobsr->buy_id;
		 // print_r($creator);
		 }
		  //echo $creator;
		$condtns2=array('reviews.userid'=>$usid);
		
	
		$this->outputData['sellerfeeds'] = $sellrfeeds =   $this->skills_model->getReviews($condtns2);
		$feedselr=$this->outputData['sellerfeeds'];
		$selrefeeds=$feedselr->num_rows();
        
		if($selrefeeds>0)
		{
		$this->outputData['sellerfeeds'] = $sellrfeeds;
		        
		}else{
		
		$condtns2=array('reviews.userid'=>$usid);
		
		$this->outputData['sellerfeeds'] = $sellrfeeds =   $this->skills_model->getReviews($condtns2);
        
		}
		//foreach($selrefeeds as  $userdetil)
//		{
//		$biduser=$userdetil->userid;
//		//echo $biduser;
//		
//		$cond=array('users.id'=>$biduser);
//		$this->outputData['reivewsdetails'] =  $this->skills_model->getReviews($cond);
//		//print_r($this->outputData['reivewsdetails']);
//		}
	//print_r($selrefeeds);
		 
		// print_r($this->outputData['reivewsdetails']);exit;
		//print_r($buye);exit;
		
		/*$this->load->view('owner/view_myprofile',$this->outputData);*/
		
		$this->outputData['success']  = true;
		
		$this->load->view('myprofile',$this->outputData);
		//$this->load->view('publicprofile',$this->outputData);
		}
		
	} //Function index End
	
	function industry()
	{
	$this->load->view('myprofile',$this->outputData);
	}
	
	/**
	 * Loads Account page.
	 *
	 * @access	Private
	 * @param	nil
	 * @return	void
	 */ 
	function accounts()
	{	
		//Load Language File
		$this->lang->load('enduser/account', $this->config->item('language_code'));
		
		//Get all the site settings
		 $this->outputData['escrow_limit']  =   $this->config->item('escrow_page_limit');
	     $this->outputData['transaction_limit']  =   $this->config->item('transaction_page_limit'); 
	 
		//Get Transaction Information
		$condition 		 = array('transactions.creator_id'=>$this->loggedInUser->id);
		$transactions 	 = $this->account_model->getTransactions($condition);
		$this->outputData['transactions'] = $transactions;
		
		//Get Transaction Information
		$condition 		 = array('transactions.creator_id'=>$this->loggedInUser->id);
		$transactions 	 = $this->account_model->getTransactions($condition);
		$this->outputData['transactions'] = $transactions;
		//Get Transaction Information
		 $start = $this->uri->segment(2,0);
		 
		 //Get all the site settings
		 $this->outputData['escrow_limit']  =   $this->config->item('escrow_page_limit');
		 $this->outputData['transaction_limit']  =   $this->config->item('transaction_page_limit'); 
		 $page_rows         =  $this->config->item('escrow_page_limit'); 
		 if($start > 0)
			$start = ($start-1) * $page_rows;
		 
		  //escrow without limit
		 $condition 		 = array('transactions.creator_id'=>$this->loggedInUser->id,'transactions.reciever_id'=>$this->loggedInUser->id );
		 $escrow_transactions 	 = $this->account_model->getTransactions($condition);
		 $this->outputData['transactions1'] = $escrow_transactions;
		 
		 //escrow trasaction with some limit
		 		 
		 $condition 		 = array('transactions.creator_id'=>$this->loggedInUser->id,'transactions.reciever_id'=>$this->loggedInUser->id );
		 $limit[0]			 = $page_rows;
		 $limit[1]			 = $start;
		 
		 $transactions1 	 = $this->account_model->getTransactions($condition,NULL,NULL,$limit);
		 $this->outputData['transactions1'] = $transactions1;
	
		  //Pagination
		 $this->load->library('pagination');
		 $config['base_url'] 	 = site_url('account/accounts');
		 $config['total_rows'] 	 = $escrow_transactions->num_rows();		
		 $config['per_page']     = $page_rows; 
		 $config['cur_page']     = $start;
		 $this->pagination->initialize($config);		
		 $this->outputData['pagination']   = $this->pagination->create_links2(false,'accounts');
		
		//Get all the jobs details
		$projectList   =   $this->skills_model->getMembersJob();
		$this->outputData['projectList']    =   $projectList;
	
		// checking the role of the user
		
		
		
		//echo 1; die();
        if($this->loggedInUser->role_name == 'employee')
		 {
		 //Set the user role
		 $this->outputData['role']  =  '2';
		  //Load Programmer Account View
		 
	     $this->load->view('employee/programmerAccountManage',$this->outputData);
		 
		 }
		if($this->loggedInUser->role_name == 'owner')
		 {
		  //Load Owner Account View	
	     $this->load->view('owner/buyerAccountManage',$this->outputData);
		 
		 }
		
	} //Function accounts End
	
	/**
	 * Loads Account page.
	 *
	 * @access	Private
	 * @param	nil
	 * @return	void
	 */ 
	 
		function updateuserprofile()
		{
		
         $this->session->set_userdata('profile_mode', 'view');

		 $success  = true;
		
		//language file
		$this->lang->load('enduser/editProfile', $this->config->item('language_code'));
		
		$this->load->model('common_model');
		//Check Whether User Logged In Or Not
	    if(!isset($this->loggedInUser->id))
		  {
		  	$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('You must be login access to this page')));
		    redirect('information');
		  }
	
		
		//load validation libraray
		$this->load->library('form_validation');
		$this->load->helper('array');
		//Load Form Helper
		$this->load->helper('form');
		
		//Intialize values for library and helpers	
		$this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
			
		if($this->input->post('editmyProfile',TRUE))
		{	
			//Set rules
			
			$this->form_validation->set_rules('companyname','Companyname','trim|min_length[0]|max_length[50]|xss_clean');
			$this->form_validation->set_rules('adrs','Address','trim|min_length[0]|max_length[1000]|xss_clean');
			$this->form_validation->set_rules('landline[]','landline','trim|callback_valid_integer|min_length[0]|max_length[15]|xss_clean');
			$this->form_validation->set_rules('mobile[]','Mobile','trim|callback_valid_integer|min_length[0|max_length[13]|xss_clean');
			$this->form_validation->set_rules('bstype','BusinessType','required');
			$this->form_validation->set_rules('indsutry','Industry');
			$this->form_validation->set_rules('summary','Quick Summary','trim|max_length[1000]|trim|xss_clean');
		
			$this->form_validation->set_rules('webs','Website','min_length[0]|trim|callback_valid_url');
			$this->form_validation->set_rules('about','About us','max_length[1000]|trim|xss_clean');
		//	$this->form_validation->set_rules('profilepic','lang:logo_validation','callback__logo_check');
          
		
		
		
		
		// If from error occur.... Then from validaton will be flase.
		
		$formData  = array();
		$success  = false;
		if ($this->form_validation->run() == FALSE)
		{
			//  Saving All from info into Array
		
				$formData['organisation']    	 = $this->input->post('companyname',TRUE);
				$formData['address']    		 = $this->input->post('adrs',TRUE);
				$formData['business_type']   = $this->input->post('bstype',TRUE);
				$formData['industry_type']   = $this->input->post('indsutry',TRUE);
				$formData['website']   = $this->input->post('webs',TRUE);
				$formData['aboutus']   = $this->input->post('about',TRUE);
				$formData['summary']   = $this->input->post('summary',TRUE);	
				
				$landline = $this->input->post('landline');
				  
				  
				   $formData['phone'] = $landline;
			
				  $mobileno=$this->input->post('mobile');
				  
				
				 $formData['mobile'] = $mobileno;
				
				
			
				
				
				
		}
			
			
			//print_r($formData);
		  
		  
		  if($this->form_validation->run())
			{
			      $updateData              		  = array();	
				  
				  $success  = true;
				  
				  $values='';
				  $valuesse='';
				 
				  $updateData['organisation']    		  = $this->input->post('companyname',TRUE);
				  $updateData['address']    		  = $this->input->post('adrs',TRUE);
				  
				  $landline = $this->input->post('landline');
				  
				  
				  foreach($landline as $valuess){	
				  
				  $values.= $valuess.',';
				 
				 }
				  
				  $landline_last = trim($values,',');
				  
				   $updateData['phone'] = $landline_last;
			
				  $mobileno=$this->input->post('mobile');
				  
				  foreach($mobileno as $mobil){	
				  
				  $valuesse.= $mobil.',';
				 
				 }
				 $mobile_last = trim($valuesse,',');
				 $updateData['mobile'] = $mobile_last;
				 
					//$updateData['mobile']       = $this->input->post('mobile',TRUE);
					$updateData['business_type']   = $this->input->post('bstype',TRUE);
					$updateData['industry_type']   = $this->input->post('indsutry',TRUE);
					$updateData['website']   = $this->input->post('webs',TRUE);
					$updateData['aboutus']   = $this->input->post('about',TRUE);
					$updateData['summary']   = $this->input->post('summary',TRUE);
				 
				
				
				if(isset($this->outputData['file']))
				{	
				  // $insertData['requirement_image']=$this->data['file']['file_name'];  /*$insertData['attachment_name']=$this->data['file']['orig_name'];*/ 
				  $updateData['logo']= $this->outputData['file']['file_name'];
					}	
				  //echo $this->loggedInUser->logo;exit;
				  /*if(($this->loggedInUser->logo != '') and (isset($this->outputData['file']['file_name'])))
				  {
				  echo "exist";
			       	   $filepath = $this->config->item('basepath').'files/logos/'.$this->loggedInUser->logo;
					   //pr($this->outputData['file']);exit;
					   @unlink ($filepath);
						if(isset($this->outputData['file']['file_name'])) {
						
						$updateData['logo']    		  = $this->outputData['file']['file_name']; 
						
						$thumb1 = $this->outputData['file']['file_path'].$this->outputData['file']['raw_name']."_thumb".$this->outputData['file']['file_ext'];	
					 
						 GenerateThumbFile($this->outputData['file']['full_path'],$thumb1,49,48);	
						 }	
				  } 
				  else {
				    echo "exist";
					    if(isset($this->outputData['file']['file_name'])) {
				  		$updateData['logo']    		  = $this->outputData['file']['file_name'];
						$thumb1 = $this->outputData['file']['file_path'].$this->outputData['file']['raw_name']."_thumb".$this->outputData['file']['file_ext'];	
				  		GenerateThumbFile($this->outputData['file']['full_path'],$thumb1,49,48);	
						}
				  }			*/  
				   
				  /*$updateData['country_symbol'] 	 = $this->input->post('country',TRUE);
				  $updateData['state']    		 	 = $this->input->post('state',TRUE);
				  $updateData['city']	 		 	 = $this->input->post('city',TRUE);*/
				 			
				  //Create User
				  $updateKey 							= array('id'=>$this->loggedInUser->id);
				  $this->user_model->updateUser($updateKey,$updateData);
		
				 
				
				  
				  //Notification message
				 // $this->session->set_flashdata('flash_message', $this->common_model->flash_message('success',$this->lang->line('update_owner_confirm_success')));
				  //$this->session->set_userdata('profile_mode', 'view');
				  
				  //redirect('information/index/success');
				 redirect('account');
		 	}  //Form Validation End
			
		} //If - Form Submission End	
		
		
		 
		 
		
		$usid=$this->loggedInUser->id;
		
		
		
		$condtition = array('users.role_id'=>'1','users.id'=>$usid);
		
		
		$this->outputData['userrecords'] =  $this->user_model->getUsers1($condtition);
		
		$userdata = $this->user_model->getUsers1($condtition)->result();
		
		
		/* echo '--formdata<pre>';
		print_r($userdata); */
		
		$userInfo  = $userdata[0];
		
		$formData['user_id'] = $userInfo->user_id;
		/* $formData['phone'] = $userInfo->phone;
		$formData['mobile'] = $userInfo->mobile; */
		$formData['user_name'] = $userInfo->user_name;
		$formData['role_name'] = $userInfo->role_name;
		$formData['country_symbol'] = $userInfo->country_symbol;
		$formData['name'] = $userInfo->name;
		$formData['role_id'] = $userInfo->role_id;
		$formData['country_symbol'] = $userInfo->country_symbol;
		$formData['message_notify'] = $userInfo->message_notify;
		$formData['password'] = $userInfo->password;
		$formData['email'] = $userInfo->email;
		$formData['city'] = $userInfo->city;
		$formData['state'] = $userInfo->state;
		$formData['profile_desc'] = $userInfo->profile_desc;
		$formData['rate'] = $userInfo->rate;
		$formData['job_notify'] = $userInfo->job_notify;
		$formData['rate'] = $userInfo->rate;
		$formData['user_status'] = $userInfo->user_status;
		$formData['activation_key'] = $userInfo->activation_key;
		$formData['created'] = $userInfo->created;
		$formData['last_activity'] = $userInfo->last_activity;
		$formData['num_reviews'] = $userInfo->num_reviews;
		$formData['logo'] = $userInfo->logo;
		$formData['user_rating'] = $userInfo->user_rating;
		$formData['last_activity'] = $userInfo->last_activity;
		$formData['refid'] = $userInfo->refid;
		$formData['credit'] = $userInfo->credit;
		$formData['user_verify'] = $userInfo->user_verify;
		$formData['ip_city'] = $userInfo->ip_city;
		
		$formData  = json_decode(json_encode(array($formData)));
		
		
		/*  echo '--formdata<pre>';
		
		print_r($formData);  */
		
		
		$this->outputData['formData']  = $formData;
		$this->outputData['success']  = $success;
		
			

		 $this->load->view('myprofile',$this->outputData);
				
	} 
	

	function updateuserpicture()
 {
 //language file
		$this->lang->load('enduser/editProfile', $this->config->item('language_code'));
		
		$this->load->model('common_model');
		//Check Whether User Logged In Or Not
	    if(!isset($this->loggedInUser->id))
		  {
		  	$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('You must be login access to this page')));
		    redirect('information');
		  }
	
		
		//load validation libraray
		$this->load->library('form_validation');
		$this->load->helper('array');
		//Load Form Helper
		$this->load->helper('form');
		
		//Intialize values for library and helpers	
		$this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
 $this->form_validation->set_rules('profilepic','lang:logo_validation','callback__logo_check');
 if($this->input->post('editmyPicture',TRUE))
		{
  $filename =  $_FILES['profilepic']['name'];
 if(isset($filename))
 {
// echo "upload"; 
 $fname = explode(".",$filename);
               $ext = $fname[1];
				//echo $ext;
		
					// intialize the config items
					$config['upload_path'] 		='files/logos/';
					$config['max_size'] 		= $this->config->item('max_upload_size');
					$config['encrypt_name'] 	= TRUE;
					$config['remove_spaces'] 	= TRUE;
					$config['allowed_types'] 	='jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF';
					$this->load->library('upload', $config);
		
		// check if the file is upload or not.
			if ($ext=='jpeg' || $ext=='jpg' || $ext=='png' || $ext=='gif' || $ext=='JPEG' || $ext=='JPG' || $ext=='PNG' || $ext=='GIF')
		{
		
		          
	               $rootpath =  $_SERVER['DOCUMENT_ROOT'];
	//echo $rootpath.'/lalbook/files/job_attachment/'.$filename;
				 $upload = $rootpath.'/lalbook/files/logos/'.$filename;
 	             $up =  move_uploaded_file($_FILES['profilepic']['tmp_name'],$upload);
				
		$updateData['logo']    =$_FILES['profilepic']['name'];
		         
		 /*
				  //Notification message
				  $this->session->set_flashdata('flash_message', $this->common_model->flash_message('success',$msg));
				  redirect('users/upload');*/
		 	
		} 
		else {
	//echo "wrong";
	           $error = "Please upload valid file formats";
			 //Notification message
				 // $this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$msg));
				 $this->outputData['eror'] = $this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$error));
				
				  redirect('account');
			     
		}	
		}
		 $updateKey 							= array('id'=>$this->loggedInUser->id);
				  $this->user_model->updateUser($updateKey,$updateData);
		
				 
				
				  
				  //Notification message
				  $this->session->set_flashdata('flash_message', $this->common_model->flash_message('success',"Profile Picture Updated Succesfully"));
			      redirect('information/index/success');
 }
 $usid=$this->loggedInUser->id;
		
		
		
		$condtition = array('users.role_id'=>'1','users.id'=>$usid);
		
		
		$this->outputData['userrecords'] =  $this->user_model->getUsers1($condtition);
		
	

		 $this->load->view('myprofile',$this->outputData);
				
 }
	
	 function valid_url($str){
        if($str != "") {
            $pattern = "|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i";
            if (!preg_match($pattern, $str)){
                $this->form_validation->set_message('valid_url_format', 'The URL you entered is not correctly formatted.');
                return FALSE;
            }
        }
        return TRUE;
    }      
    
    function valid_integer($num) {
        if($num == "") {
            return true;
        }
        
        $pattern = '/^[0-9]{1,}$/';
        if(preg_match($pattern, $num)) {
            return true;
        }
        
        $this->form_validation->set_message('valid_integer', 'The input is not a valid number');
        return false;
    }
    
	function _logo_check()
	{
		if(isset($_FILES) and $_FILES['profilepic']['name']=='')				
			return true;
			
		$config['upload_path'] 		='files/logos/';
		$config['allowed_types'] 	='jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF';
		$config['max_size'] 		= $this->config->item('max_upload_size');
		$config['encrypt_name'] 	= TRUE;
		$config['remove_spaces'] 	= TRUE;
		$this->load->library('upload', $config);
		
		if ($this->upload->do_upload('profilepic'))
		{
			$this->outputData['file'] = $this->upload->data();			
			return true;			
		} else {
			$this->form_validation->set_message('_logo_check', $this->upload->display_errors($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag')));
			return false;
		}//If end 
	
	}//Function _logo_check End 
	 
	 
	function transaction()
	{	
    
	 if(!isset($this->loggedInUser->id))
		  {
		  	$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('You can not access to this page')));
		    redirect('information');
		  }
	 	 
	 //Get Transaction Information
	 $start = $this->uri->segment(3,0);
	 
	 //Get all the site settings
	 $this->outputData['escrow_limit']  	 =   $this->config->item('escrow_page_limit');
	 $this->outputData['transaction_limit']  =   $this->config->item('transaction_page_limit'); 
	 
	 $escrow_limit     						 =  $this->outputData['escrow_limit'];
	 $page_rows         					 =  $this->outputData['transaction_limit']; 
	 
	 if($start > 0)
	   $start = ($start-1) * $page_rows;
	 
	 //new test transaction
	 $condition 		 = array('transactions.creator_id'=>$this->loggedInUser->id,'transactions.reciever_id'=>$this->loggedInUser->id);
	 $transactions 	 = $this->account_model->getallTransactions($condition);
	 
	 
	 $this->outputData['transactions'] = $transactions;
	 $this->outputData['users']        = $this->user_model->getUsers();
	 $this->outputData['total_records'] = $transactions->num_rows();
	 
	 //Get the transaction values from the particular limit
 	 $condition 		 = array('transactions.creator_id'=>$this->loggedInUser->id,'transactions.reciever_id'=>$this->loggedInUser->id);
	 $limit[0]			 = $page_rows;
	 $limit[1]			 = $start;
	 
	 //Get all escrow trasaction with some limit
	 $transactions1 	 = $this->account_model->getallTransactions($condition,NULL,NULL,$limit);
	 $this->outputData['transactions1'] = $transactions1;

      //Pagination
	 $this->load->library('pagination');
	 $config['base_url'] 	 = site_url('account/transaction');
   	 $config['total_rows'] 	 = $transactions->num_rows();		
  	 $config['per_page']     = $page_rows; 
	 $config['cur_page']     = $start;
 	 $this->pagination->initialize($config);		
	 $this->outputData['pagination']   = $this->pagination->create_links2(false,'transaction');

	 //Get all the jobs details
	$projectList   =   $this->skills_model->getMembersJob();
	$this->outputData['projectList']    =   $projectList;
	if($this->loggedInUser->role_id)
       $this->load->view('owner/view_ownerTransaction',$this->outputData);
	else
	   $this->load->view('employee/view_employeeTransaction',$this->outputData);   
	} //Function viewall transaction end
    
    function editProfile() {
        $this->session->set_userdata('profile_mode', 'edit');
        redirect('account');
    }
} //End  Account Class

/* End of file Account.php */ 
/* Location: ./application/controllers/Account.php */
?>