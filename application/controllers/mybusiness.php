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
 
 
class Mybusiness extends CI_Controller {

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
		/*$openjob_condition = array('jobs.job_status'=>'0');
		$open_jobs =  $this->skills_model->getJobs($openjob_condition);*/
		//$this->outputData['open_jobs']   = $open_jobs->num_rows();
		
		//Get total closed jobs
		/*$closedjob_condition = array('jobs.job_status'=>'2');
		$closed_jobs  =  $this->skills_model->getJobs($closedjob_condition);
		$this->outputData['closed_jobs']   = $closed_jobs->num_rows();*/
		
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
 		
 		/*$this->outputData['top_skills'] = $this->skills_model->getJobs();*/
		        
       }
	
	
	public function index(){
		//Load Language File For this
		$this->lang->load('enduser/home', $this->config->item('language_code'));

		//load validation libraray
		$this->load->library('form_validation');
		$this->load->model('requirement_model');


		//Load Form Helper
		$this->load->helper('form'); 
		$this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
		
		//Get Categories
		if(!$this->loggedInUser){
			$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('You must be login access to this page')));
			redirect('information');
		}	
		
		$usid=$this->loggedInUser->id;
		
		$condtitions = array('buy_requirement.creator_id'=>$usid,'buy_requirement.status'=>'open');
		$this->outputData['buyrequirements'] =  $this->requirement_model->getBuyerview($condtitions);
		$userrequire=$this->outputData['buyrequirements'] ;
		$buye=$userrequire->result();
		
		
		$condtition = array('users.role_id'=>'1','users.id'=>$usid);
		$this->outputData['userrecords'] =  $this->user_model->getUsers($condtition);
		
		$closedjobs1=  $this->requirement_model->getRequirement();
		$closedj=$closedjobs1->row();
		$jobstatus=$closedj->status;
		
		$condt=array('buy_requirement.status'=>'awarded','buy_requirement.creator_id'=>$usid);
		$this->outputData['closedjobs'] =  $this->skills_model->getJobs1($condt);
		$jobclosed=$this->outputData['closedjobs'];
		$cls=$jobclosed->row();
		
		$condts=array('buy_requirement.status'=>'wip','buy_requirement.creator_id'=>$usid);
		$this->outputData['torate'] =  $this->skills_model->getJobs1($condts);
		
		$condt1=array('buy_requirement.status'=>'open','buy_requirement.creator_id'=>$usid);
		$this->outputData['openjobs'] =  $this->skills_model->getJobs1($condt1);
		$jobopen=$this->outputData['openjobs'];
		$opn=$jobopen->row();

		foreach($buye as $buyer){
			$avlbcredit=$buyer->buy_id;
			$condtn=array('bids.job_id'=>$avlbcredit);

			$this->outputData['ratingbids'] =  $this->skills_model->getBidsByJob($condtn);

			$buyerrate=$this->outputData['ratingbids'];
			$buyerrating=$buyerrate->row();
		}

		
		$cond=array('bids.user_id'=>$usid);
		$this->outputData['sellerview'] =  $this->requirement_model->getBuyerview($cond);
		$selrview=$this->outputData['sellerview'];
		$slr=$selrview->result();
		
		
		$condtns=array('bids.user_id'=>$usid,'buy_requirement.status'=>'completed');
		$this->outputData['sellerpast'] =  $this->requirement_model->getBuyerview($condtns);
		$pastselr=$this->outputData['sellerpast'];
		$selrepast=$pastselr->result();
		
		
		
		$condtns1=array('bids.user_id'=>$usid,'buy_requirement.status'=>'wip');
		$this->outputData['sellerworking'] =  $this->requirement_model->getSellerview($condtns1);
		$self=$this->outputData['sellerworking'];
		$selrefeedb=$self->result();
		
		foreach($selrefeedb as  $feedback){
			$creator=$feedback->creator_id;
			$condtnc=array('users.id'=>$creator);

			//print_r($condtn);
			$this->outputData['creatordetails'] =  $this->user_model->getUsers($condtnc);
			$creat=$this->outputData['creatordetails'];
			$crt=$creat->result();
			
		}
		$this->load->view('view_mybusiness',$this->outputData);
 	}
	function getComments(){
	$this->load->view('getComments');
	}
	
	function login()
	{		
		//language file
		$this->lang->load('enduser/register', $this->config->item('language_code'));
		
		//Load Models - for this function
		$this->load->model('user_model');
		
		//load validation libraray
		$this->load->library('form_validation');
		
		//Load cookie 
		$this->load->helper('cookie');
		
		//Load Form Helper
		$this->load->helper('form');
		
		//Load Library File
		$this->load->library('encrypt');
		
		// check the login for remember user 
		if($this->auth_model->getUserCookie('user_name')!='' and $this->auth_model->getUserCookie('user_password')!='')
			 { 
				 
				 //$conditions  =  array('user_name'=>$this->auth_model->getUserCookie('user_name'),'password' => md5($this->auth_model->getUserCookie('user_password')),'users.user_status' => '1');


				$conditions  =  array('user_name'=>$this->auth_model->getUserCookie('user_name'),'password' =>hash('sha384',$this->auth_model->getUserCookie('user_password')),'users.user_status' => '1');
				 $query		= $this->user_model->getUsers($conditions);
				
				if($query->num_rows() > 0)
				{
				 $this->session->set_flashdata('flash_message', $this->common_model->flash_message('success','Logged In Successfull'));
				}
				redirect('account');
			}
				
		
			if($this->uri->segment(3,0))
			{
				if($this->uri->segment(3,0)=='support')
				{
					 $this->session->set_userdata('support','support');  
				}	
				elseif($this->uri->segment(3,0)=='project')	 
				{
					 $this->session->set_userdata('job','project');  
					 $this->session->set_userdata('job_view','view');  
					 $this->session->set_userdata('job_id',$this->uri->segment(5,0));  
				   	 
				}
			}
		//Intialize values for library and helpers	
		$this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
		//pr($_POST);
		//Get Form Data	
		if($this->input->post('usersLogin'))
		{
			//Set rules
			$this->form_validation->set_rules('username','lang:user_name_validation','required|trim|min_length[5]|xss_clean');
			$this->form_validation->set_rules('pwd','lang:password_validation','required|trim|xss_clean');

			if($this->form_validation->run())
			{
				if(getBanStatus($this->input->post('username')))
				{
					$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('Ban Error')));
					redirect('information');
		 		}
			
  			 	$conditions  =  array('user_name'=>$this->input->post('username'),'password' => hash('sha384',$this->input->post('pwd')),'users.user_status' => '1');
				
 				$query		 = $this->user_model->getUsers($conditions);
 
				if($query->num_rows() > 0)
				{
					  $row =  $query->row();
                      
					  // update the last activity in the users table
					  $updateData = array();
                      $updateData['last_activity'] = get_est_time();
					  //Get Activation Key
		              $activation_key = $row->id;
				      // update process for users table
				      $this->user_model->updateUser(array('id'=>$row->id),$updateData);
					  //Check For Password
					  //if($this->input->post('pwd')==$this->common_model->getDecryptedString($row->password))
					
					
					 if(1)
					 {
						//pr($row);
					 	//Set Session For User
						$this->auth_model->setUserSession($row);
						
 						if($this->input->post('remember'))
						{
						    $insertData=array();
						    $insertData['username']=$this->input->post('username');
						    $insertData['password']=$this->input->post('pwd');
						    $expire=60*60*24*100;
							if( $this->auth_model->getUserCookie('uname')=='')
							{ 
							$this->user_model->addRemerberme($insertData,$expire); 
 							}		
						 }
						 else
						 {
							   $this->user_model->removeRemeberme(); 
						 }	
						
					 	 //Notification message
						 $this->session->set_flashdata('flash_message', $this->common_model->flash_message('success','Logged In Successfull'));
						 
					   if($this->session->userdata('job_id')!='')
						{
							$jobid=$this->session->userdata('job_id');
							$this->session->unset_userdata('job');
							$this->session->unset_userdata('view');		
							$this->session->unset_userdata('jobid');	
							redirect('job/view/'.$jobid);		
						
						}
					// check for private job user login 	
					if($this->session->userdata('private_user')!='')
					{
						if($this->session->userdata('private_user')==$row->id or $this->session->userdata('creator_id')==$row->id )
						{
							 $project_id=$this->session->userdata('project_id');
							  $this->session->unset_userdata('private');
							  $this->session->unset_userdata('type');		
							  $this->session->unset_userdata('private_user');
							  $this->session->unset_userdata('project_id');	
							  $this->session->unset_userdata('creator_id');	
							 
							  redirect('job/view/'.$project_id);			
						 
						}
						else
						{
						  $this->session->unset_userdata('private');
						  $this->session->unset_userdata('type');		
						  $this->session->unset_userdata('private_user');
						  $this->session->unset_userdata('project_id');
						  $this->session->unset_userdata('creator_id');		
						  $this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('This is not your private job')));
						  redirect('information');
						}
				     }	
						   
				if($this->session->userdata('support')=='' and $this->session->userdata('project')=='')
				{	
					redirect('account');	
				}
				elseif($this->session->userdata('support')!='')
				{
					$this->session->unset_userdata('support');
					redirect('support');	
				} 
				elseif($this->session->userdata('project')!='')
				{
					$id=$this->session->userdata('id');
					$this->session->unset_userdata('project');
					$this->session->unset_userdata('view');		
					$this->session->unset_userdata('id');	
					
					redirect('job/view/'.$id);				
				}
							
				 } else {

					 //Notification message
					 $this->session->set_flashdata('flash_message', $this->common_model->flash_message('error','Login failed! Incorrect username or password'));
					 redirect('home');
				 }
					 
				} else {
				
					 //Notification message
					 $this->session->set_flashdata('flash_message', $this->common_model->flash_message('error','Login failed! Incorrect username or password'));
				 	 redirect('home');
				} //If username exists			
			}//If End - Check For Validation				
		} //If End - Check For Form Submission
		$this->load->view('home',$this->outputData);
	}
	
	
	
	
	
	
	
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