<?php
 /*
  ****************************************************************************
  ***                                                                      ***
  ***      BIDONN 1.0                                                      ***
  ***      File:  transfer.php                                             ***
  ***      Built: Mon June 22 16:22:45 2012                                ***
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

class Transfer extends CI_Controller {

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
		$this->load->model('messages_model');
		$this->load->model('credential_model');
		
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
		
		//Load Language
		$this->lang->load('enduser/transfer', $this->config->item('language_code'));
		if($this->loggedInUser)
		{
			$user_id           =  $this->loggedInUser->id;  	
			$conditions        =  array('jobs.creator_id'=>$user_id);
			$postuserslist	   =  $this->skills_model->getMembersJob($conditions);
		
		//Get logged user role
		   $this->outputData['logged_userrole']   =  $this->loggedInUser->role_id;
		}
		//Get the users details
		$usersList	   =  $this->user_model->getUserslist();
		$this->outputData['usersList'] =  $usersList->result();	
		
		//Get the jobs details
		$condition=array('jobs.job_status'=>'2');
		$projectList	   =  $this->skills_model->getMembersJob($condition);
		//pr($projectList->result());
		$this->outputData['projectList'] =  $projectList->result();	
		
		//Innermenu tab selection
		$this->outputData['innerClass3']   = '';
		$this->outputData['innerClass3']   = 'selected';
		
		//Currency Type
		$this->outputData['currency'] = $this->db->get_where('settings', array('code' => 'CURRENCY_TYPE'))->row()->string_value;
		//$this->outputData['currency'] = $this->db->get_where('currency', array('currency_type' => $currency_type))->row()->currency_symbol;
		
	} //Controller End 
	// --------------------------------------------------------------------
	
	/**
	 * Loads deposit page of the site.
	 *
	 * @access	public
	 * @param	nil
	 * @return	void
	 */	
	function index()
	{	
		if(!isset($this->loggedInUser->id))
		  {
		  	$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('You can not access to this page')));
		    redirect('information');
		  }
		  if($this->loggedInUser->suspend_status==1)
		 {
			$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('Suspend Error')));
			redirect('information');
		 }	
		//Check Whether User Logged In Or Not
	    if(isLoggedIn()===false)
		{
			$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('Dont have rights to access this page')));
			redirect('information');
		}
		$condition=array('jobs.job_status'=>'2');
		$projectList	   =  $this->skills_model->getMembersJob($condition);
		$this->outputData['projectList_tranferamount'] =  $projectList->result();	
		//load validation libraray
		$this->load->library('form_validation');
		
		//Load Form Helper
		$this->load->helper('form');
		
		//Load escrow transaction
		//Load helper file
		$this->load->helper('transaction');
		$creator_condition 		 = array('transactions.creator_id'=>$this->loggedInUser->id);
		$transaction_condition 	 = array('transactions.creator_id'=>$this->loggedInUser->id,'type'=>'Transfer' );
		$url                     = 'transfer/index'; 
		$page                    = $this->uri->segment(3,0); 
		$escrow                  =  loadTransaction($creator_condition,$transaction_condition,$url,$page);
		
		//Intialize values for library and helpers	
		$this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
        
		//Check User Balance
		$this->load->model('account_model');
		$condition_balance 		 = array('user_balance.user_id'=>$this->loggedInUser->id);
		$results 	 			 = $this->account_model->getBalance($condition_balance);
		if($results->num_rows()>0)
		{
		  //get balance detail
		  $rowBalance = $results->row();		
		  $this->outputData['userAvailableBalance'] = $rowBalance->amount;
		  $avail_balance                            = $rowBalance->amount;
		}			
		
		//Get Form Data	
		if($this->input->post('transferMoney'))
		{
			//Set Validation Rules
			$this->form_validation->set_rules('total','lang:total_validation','required|trim|integer|xss_clean|abs');
			$this->form_validation->set_rules('type_id','lang:buyer_id_validation','required|trim|xss_clean|abs');
			
			if($this->form_validation->run() and $this->input->post('type_id') != '0')
			{
				  //redirect it to appropriate payment method
				  if($this->input->post('total') <= '0')
				  {
				  	//echo $this->input->post('amount');
					$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('Transfer Amount should not be empty')));
			        redirect('transfer');
				  }
				  //Get the Minimum Balance amount	
				  $this->load->model('settings_model');
				  $paymentSettings = $this->settings_model->getSiteSettings();
				  $paymentSettings['PAYMENT_SETTINGS'];
				  $bal_amount = $avail_balance  -  ( $paymentSettings['PAYMENT_SETTINGS'] +  $this->input->post('total') );
				  if( $bal_amount < 0)
				    {
						$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('You are not having Sufficient Balance to Transfer')));
			            redirect('transfer');
					}
				  else
				    {
					  if($this->input->post('paymentMethod')=='paypal')
					  {
					   $view	=  'view_paypalDeposit';
					   $method  =  'Paypal';
					  }
					  $method  =  'Paypal';
					  $this->outputData['amount']  	  		= $this->input->post('total');
					  //Register Transaction
					  $insertData = array(); 
					  $insertData['creator_id']   			= $this->loggedInUser->id;
					  $insertData['reciever_id'] 			= $this->input->post('users_load');
					  $insertData['job_id']  	  			= $this->input->post('type_id');
					  $insertData['type'] 		 			= 'Transfer';
					  $insertData['amount'] 				= $this->input->post('total');
					  $insertData['transaction_time'] 	 	= get_est_time();
					  $insertData['status'] 				= 'Completed'; //Can Be success,failed,pending
					  $insertData['description'] 			= 'Transfer Amount for';
					  //Check User Balance
					  $condition_balance 		 = array('user_balance.user_id'=>$this->loggedInUser->id);
					  $results 	 			     = $this->account_model->getBalance($condition_balance);
							
					  if(getSuspendStatus($this->input->post('users_load')))
					  {
					  	$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('The user you are trying to Transfer is currently Suspended')));
			            redirect('transfer');
					  }		
							
					 //If Record already exists
					  if($results->num_rows()>0)
						{
						 //get balance detail
					 	 $rowBalance = $results->row();
								
						 //Update Amount	
						  $updateKey 			  = array('user_balance.user_id'=>$this->loggedInUser->id);	
						  $updateData 		  = array();
								
						  $updateData['amount'] = $rowBalance->amount   -   $this->input->post('total');
						  $results1 			  = $this->account_model->updateBalance($updateKey,$updateData);
						 
						  $condition           =  array('users.id'=>$insertData['reciever_id']); 
						  $registerusers       =  $this->user_model->getUsers($condition); 
						  $registerusers       =  $registerusers->row();
						  
						  //Update Amount to the receiver id	
						  $updateKey 			  = array('user_balance.user_id'=>$insertData['reciever_id']);	
						  $updateData 		     = array();
								
						// Getting the account balance of the receiver ---->stat
							
		  	   				$condition_balance_receiver 		 = array('user_balance.user_id'=>$insertData['reciever_id']);
		     				$results_receiver 	 			     = $this->account_model->getBalance($condition_balance_receiver);	
						 
					    	 if($results_receiver->num_rows()>0)		
							 {
								 $rowBalance_receiver=$results_receiver->row();  			  
								 $updateData['amount'] = $rowBalance_receiver->amount   +   $this->input->post('total');
						  	     $results1 			  = $this->account_model->updateBalance($updateKey,$updateData);
                             }
							 
						 //  Getting the account balance of the receiver -->End		
															
						//  $updateData['amount'] = $rowBalance->amount   +   $this->input->post('total');
						//  $results1 			  = $this->account_model->updateBalance($updateKey,$updateData);
						  
						  $jobs_condition  =  array('jobs.id'=>$insertData['job_id']); 
						  $jobs            =  $this->skills_model->getMembersJob($jobs_condition);
						  $jobs            =  $jobs->row();
						  
						 //Send email to the user after registration
						  $this->load->model('email_model');
						  $conditionUserMail = array('email_templates.type'=>'transaction');
						  $result            = $this->email_model->getEmailSettings($conditionUserMail);
						  $rowUserMailConent = $result->row();
						  $splVars = array("!site_name" => $this->config->item('site_title'),"!username" => $this->loggedInUser->user_name,"!siteurl" => site_url(),"!amount"=>$insertData['amount'],"!type"=>'Transfer',"!others"=>'Receiver Name   :'.$registerusers->user_name,"!others1"=>'Job Name   :'.$jobs->job_name, "!contact_url" => site_url('contact'));
						  $mailSubject = strtr($rowUserMailConent->mail_subject, $splVars);
						  $mailContent = strtr($rowUserMailConent->mail_body, $splVars);		
						  $toEmail     = $this->loggedInUser->email;
						  $fromEmail   = $this->config->item('site_admin_mail');
						  $this->email_model->sendHtmlMail($toEmail,$fromEmail,$mailSubject,$mailContent);
						}	
					  $this->load->model('account_model');
					  $res = $this->account_model->addTransaction($insertData);
					  $this->session->set_flashdata('flash_message', $this->common_model->flash_message('success',$this->lang->line('Your Transaction successfully Completed')));
					  redirect('account');
				    }
			} //Validation Failed
			
		}//If End - Check For Form Submission
		
		$this->load->view('paypal/view_transfer',$this->outputData);
	} //Function index End

}  //End  Transfer Class 
	
	
	/* End of file Transfer.php */ 
/* Location: ./application/controllers/Transfer.php */
?>