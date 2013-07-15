<?php  

/*
  ****************************************************************************
  ***                                                                      ***
  ***      BIDONN 1.0                                                      ***
  ***      File:  home.php                                                 ***
  ***      Built: Mon June 11 15:27:24 2012                                ***
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
 
 
class Myprofile extends CI_Controller {

	 //Global variable  
     public $outputData;
	 public $loggedInUser;
	
	public function __construct()
     {
        parent::__construct();
		 
		$this->load->library('settings');
		
        //Get Config Details From Db
		$this->settings->db_config_fetch();
		//Manage site Status 
		if($this->config->item('site_status') == 1)
		redirect('offline');
		$this->load->model('credential_model');
			
		//Load Models
		$this->load->model('common_model');
		$this->load->model('skills_model');
		$this->load->model('page_model');
		$this->load->model('admin_model');
		
		//Page Title and Meta Tags
		$this->outputData = $this->common_model->getPageTitleAndMetaData();
		
		//Get Logged In user
		$this->loggedInUser					= $this->common_model->getLoggedInUser();
		$this->outputData['loggedInUser'] 	= $this->loggedInUser;
		
		//Get Latest Jobs
		$limit_latest = $this->config->item('latest_projects_limit');
		$limit3 = array($limit_latest);
		$this->outputData['latestJobs']	= $this->skills_model->getLatestJobs($limit3);
		
		//Get total open jobs
		//$this->load->model('skills_model');
		$openjob_condition = array('jobs.job_status'=>'0');
		$open_jobs =  $this->skills_model->getJobs($openjob_condition);
		$this->outputData['open_jobs']   = $open_jobs->num_rows();
		
		//Get total closed jobs
		$closedjob_condition = array('jobs.job_status'=>'2');
		$closed_jobs  =  $this->skills_model->getJobs($closedjob_condition);
		$this->outputData['closed_jobs']   = $closed_jobs->num_rows();
		
		$this->outputData['facebook']       = $this->db->get_where('settings', array('code' => 'FACEBOOK'))->row()->string_value;
	    $this->outputData['twitter']        = $this->db->get_where('settings', array('code' => 'TWITTER'))->row()->string_value;
	    $this->outputData['rss']            = $this->db->get_where('settings', array('code' => 'RSS'))->row()->string_value;
	    $this->outputData['linkedin']       = $this->db->get_where('settings', array('code' => 'LINKEDIN'))->row()->string_value;
		
		//language file
		$this->lang->load('enduser/common', $this->config->item('language_code'));
		$this->outputData['current_page'] = 'home';
		$this->load->helper('file');
		$this->load->helper('users');
		//$this->load->library('facebook');
		
 		$categories = $this->skills_model->getCategories(); 
		$this->outputData['categories']  =  $categories;
 		
 		$this->outputData['top_skills'] = $this->skills_model->getJobs();
		        
       }
	 
	public function index()
	 {
		//Load Language File For this
		$this->lang->load('enduser/account');
		$this->lang->load('enduser/common');
		 if(!$this->loggedInUser)
		{
        	$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('You must be login access to this page')));
			redirect('information');
		}	
		$this->load->library('form_validation');
		
		//Load Form Helper
		$this->load->helper('form');
		
		//Intialize values for library and helpers	
		$this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
		//
		$usid=$this->loggedInUser->id;
		
		
		
		$condtition = array('users.role_id'=>'1','users.id'=>$usid);
		
		
		$this->outputData['userrecords'] =  $this->user_model->getUsers1($condtition);
		
		
		$this->load->view('requirement/view_profile',$this->outputData);
 	}
	
	
	
		function editProfile()
	{	
		//language file
		$this->lang->load('enduser/editProfile', $this->config->item('language_code'));
		$this->lang->load('enduser/common', $this->config->item('language_code'));
		$this->load->model('common_model');
		
		//Check Whether User Logged In Or Not
	    if(!isset($this->loggedInUser->id))
		  {
		  	$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('You must be login access to this page')));
		    redirect('information');
		  }
	
		
		//load validation libraray
		$this->load->library('form_validation');
		
		//Load Form Helper
		$this->load->helper('form');
		
		//Intialize values for library and helpers	
		$this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
			
		if($this->input->post('cahngename',TRUE))
		{	
		
			//Set rules
			 $this->form_validation->set_rules('forimge','lang:logo_validation','required|callback__logo_check');
			$this->form_validation->set_rules('forname','lang:programmer_name_validation','required|trim|min_length[5]|xss_clean');
			/*$this->form_validation->set_rules('email','Email','required|trim|min_length[5]|xss_clean');
			$this->form_validation->set_rules('contact_msn','msn','trim|xss_clean');
			$this->form_validation->set_rules('contact_gtalk','gtalk','trim|xss_clean');
			$this->form_validation->set_rules('contact_yahoo','yahoo','trim|xss_clean');
			$this->form_validation->set_rules('contact_skype','skype','trim|xss_clean');
			$this->form_validation->set_rules('notify_project','new bid','trim|xss_clean');
			$this->form_validation->set_rules('notify_message','new message','trim|xss_clean');
			$this->form_validation->set_rules('country','lang:country_validation','required');
			$this->form_validation->set_rules('state','lang:state_validation','trim|xss_clean');
			$this->form_validation->set_rules('city','lang:city_validation','trim|xss_clean');*/
          	if($this->form_validation->run())
			{
			      $updateData              		  = array();	
				 
				  $updateData['name']    		  = $this->input->post('name',TRUE);
				  $updateData['email']    		  = $this->input->post('email',TRUE);
				  $updateData['profile_desc']     = $this->input->post('profile',TRUE);
				  $updateData['job_notify']       = $this->input->post('notify_project',TRUE);
				  $updateData['message_notify']   = $this->input->post('notify_message',TRUE);
				  //echo $this->loggedInUser->logo;exit;
				  if(($this->loggedInUser->logo != '') and (isset($this->outputData['file']['file_name'])))
				  {
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
				   
					    if(isset($this->outputData['file']['file_name'])) {
				  		$updateData['logo']    		  = $this->outputData['file']['file_name'];
						$thumb1 = $this->outputData['file']['file_path'].$this->outputData['file']['raw_name']."_thumb".$this->outputData['file']['file_ext'];	
				  		GenerateThumbFile($this->outputData['file']['full_path'],$thumb1,49,48);	
						}
				  }	
				  
				  	 //Notification message
					// echo $this->input->post('forname');exit;
					 $updateData['user_name']=$this->input->post('forname');
					  //Create User
				  $updateKey 							= array('id'=>$this->loggedInUser->id);
				  $this->user_model->updateUser($updateKey,$updateData);
				  
				  $this->session->set_flashdata('flash_message', $this->common_model->flash_message('success',$this->lang->line('update_owner_confirm_success')));
			      redirect('information/index/success');	  
				   }
				   
				   }

		$this->load->view('requirement/view_profile',$this->outputData);
			}	
			
	function _logo_check()
	{
		if(isset($_FILES) and $_FILES['forimge']['name']=='')				
			return true;
			
		$config['upload_path'] 		='files/logos/';
		$config['allowed_types'] 	='jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF';
		$config['max_size'] 		= $this->config->item('max_upload_size');
		$config['encrypt_name'] 	= TRUE;
		$config['remove_spaces'] 	= TRUE;
		$this->load->library('upload', $config);
		
		if ($this->upload->do_upload('forimge'))
		{
			$this->outputData['file'] = $this->upload->data();			
			return true;			
		} else {
			$this->form_validation->set_message('_logo_check', $this->upload->display_errors($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag')));
			return false;
		}//If end 
	
	}//Function _logo_check End
	
	function listJobs()
	{
		//Load Language File For this
		$this->lang->load('enduser/home', $this->config->item('language_code'));
		$type = $this->uri->segment('3');
		if($type =='')
		$type ='latest';
		if($type == 'latest'){
			//Get Latest Jobs
			$limit_latest = $this->config->item('latest_projects_limit');
			$limit3 = array($limit_latest);
			$this->outputData['listProjects']	= $this->skills_model->getLatestJobs($limit3);
			$this->outputData['title'] = 'Latest Jobs';
			$this->outputData['viewall'] = 'all';
			
		}
		elseif($type == 'featured'){
			//Get Featured Jobs
			$feature_conditions = array('is_feature'=>1,'job_status' => '0');
			$this->outputData['listProjects']	= $this->skills_model->getJobs($feature_conditions);
			$this->outputData['title'] = 'Featured Jobs';
			$this->outputData['viewall'] = 'is_feature';
		}
		elseif($type == 'urgent'){
			//Get Urgent Jobs
			$urgent_conditions = array('is_urgent'=>1,'job_status' => '0');
			$this->outputData['listProjects']	= $this->skills_model->getJobs($urgent_conditions);
			$this->outputData['title'] = 'Urgent Jobs';
			$this->outputData['viewall'] = 'is_urgent';
		}
		elseif($type == 'high'){
			//Get Urgent Jobs
			$urgent_conditions = array('jobs.job_status' => '0','budget_max >=' => '500');
			$order = array('budget_max','DESC');
			$this->outputData['listProjects']	= $this->skills_model->getJobs($urgent_conditions,NULL,NULL,NULL,$order);
			$this->outputData['title'] = 'High Budget Jobs';
			$this->outputData['viewall'] = 'high_budget';
		}
		$this->load->view('listJobs',$this->outputData);
	}//End listJobs function
	
//-----------------------------------------------------------------------------------

	/*Function search
	*
	* access Private
	* Parem search keyword
	*
	*/	
	function search()
	{
 		
		//pr($_POST);exit;
		$search = $this->input->post('search');
		$type = $this->input->post('type');
		
		//$type = $this->uri->segment('3');
		
		if($type == 'Search Job'){
			redirect('search/index'."/$search");
			//$urgent_conditions = array('job_status'=> '0','job_name'=>$search);
			//$openJobs	= $this->skills_model->getJobs($urgent_conditions);
			//$this->outputData['numProjects'] = $openJobs->num_rows();
			//$this->outputData['popular'] = $this->skills_model->getPopularSearch('work');
			//$this->load->view('findJob',$this->outputData);
		}
		elseif($type == 'Search Employee'){
			redirect('search/employee'."/$search");
			//$conditions = array('users.role_id'=> '2','users.user_name'=>$search);
			//$providers	= $this->user_model->getUsers($conditions);
			//$this->outputData['numProviders'] = $providers->num_rows();
			//$this->outputData['popular'] = $this->skills_model->getPopularSearch('user');
			//$this->load->view('findEmploy',$this->outputData);
		}
	 } //End search Function
	
//---------------------------------------------------------------------------------------	

	/*  Get categories
	 *  access private
	 *  param keyword
	 */	
	
	function getCategories()
	{
		$catid = $this->uri->segment('3','0');
		$conditions = array('categories.group_id' => $catid);
		$this->outputData['categories'] = $this->skills_model->getCategories($conditions);
		$this->load->view('categoryList',$this->outputData);
	}//End getCategories Function
	
}//End Home Class

/* End of file home.php */
/* Location: ./application/controllers/home.php */