<?php 

 /*
   ****************************************************************************
   ***                                                                      ***
   ***      BIDONN 1.0                                                      ***
   ***      File:  Subscription.php                                         ***
   ***      Built: Mon June 25 14:51:45 2012                                ***
   ***      http://www.nystatesource.com                                    ***
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

 class Subscription extends CI_Controller {
 
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
		$this->lang->load('enduser/account', $this->config->item('language_code'));
		

		//Load Models
		$this->load->model('common_model');
		$this->load->model('skills_model');
		$this->load->model('user_model');
		$this->load->model('account_model');
		$this->load->model('settings_model');
		$this->load->model('file_model');
		$this->load->model('email_model');
		$this->load->model('messages_model');	
		$this->load->model('credential_model');	
		$this->load->model('payment_model'); 
		//Page Title and Meta Tags
		$this->outputData = $this->common_model->getPageTitleAndMetaData();
		
		//Get Top programmers
		$topProgrammers = $this->common_model->getPageTitleAndMetaData();
		
		//Get Logged In user
		$this->loggedInUser					= $this->common_model->getLoggedInUser();
		$this->outputData['loggedInUser'] 	= $this->loggedInUser;
		
		
		
         //Get Footer content
		$this->outputData['pages']	= $this->common_model->getPages();
		
		//Get Latest jobs
		$limit_latest = $this->config->item('latest_projects_limit');
		$limit3 = array($limit_latest);
		$this->outputData['latestJobs']	= $this->skills_model->getLatestJobs($limit3);
		
  	
	} //Controller End 

 	// --------------------------------------------------------------------
 	/**
 	 * Loads site settings page.
 	 * @access	private
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
		 
		$conditions = array('subscriptionuser.username'=>$this->loggedInUser->id,'subscriptionuser.flag'=>1);
		
		/*$validity_check = $this->common_model->getUserSubscription($cond);
		
		foreach($validity_check->result() as $check)
		{
			$date = $check->enddate;
								 
			$days = ($date - strtotime(date("Y-m-d"))) / (60 * 60 * 24);
			
			if(round($days)>0){
			  $id = $check->id;
			}
		}
		
 		$conditions = array('id'=>isset($id));*/
		
		$this->outputData['validity'] = $this->common_model->getUserSubscription($conditions);
		 
		$paymentGateways = $this->payment_model->getPaymentSettings();
		
		$this->outputData['paymentGateways'] = $paymentGateways;
		
		$this->outputData['subscription'] = $this->common_model->getSubscription();
		
		$this->load->view('subscription/view_subscription',$this->outputData);

 	}//End of index Function

	
	function success()
	{
		
		
		 $custom = $_REQUEST['custom'];
		 $values = explode("#",$custom);
		 $id     = $values[0];
		 $type	 = $values[1];
		 $days   = $values[2];
		 $amount = $values[3];
		 
		 //print_r($_REQUEST);
		 $insertData['package_id'] = $id;
		 $insertData['username']  = $this->loggedInUser->id;
		 $insertData['valid']     = $days;
		 $insertData['amount']   = $amount;
		 $insertData['created']  = get_est_time();
		 $insertData['updated_date']  = get_est_time() + ($days * 86400);
		 $insertData['flag']   = '1';
		 $this->common_model->createUserSubscription($insertData);
		 
		  $this->session->set_flashdata('flash_message', $this->common_model->flash_message('success',"You are subscribed successfully.Now you can place your bids till end of your subscription validity"));
 		  redirect('information');
		//exit;
	}

}

//End  subscription Class

/* End of file subscription.php */ 

/* Location: ./application/controllers/subscription.php */					

?>