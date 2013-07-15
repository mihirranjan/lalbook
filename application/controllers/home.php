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
 
 
class Home extends CI_Controller {

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
		$this->lang->load('enduser/home', $this->config->item('language_code'));
		
		//load validation libraray
		$this->load->library('form_validation');
		
		
		
		//Load Form Helper
		$this->load->helper('form'); 
		$this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
		//Get Categories
		$this->outputData['categories']	=	$this->skills_model->getCategories();
		
		//Get Featured Jobs
		$feature_conditions = array('is_feature'=>1,'jobs.job_status'=>'0');
		$this->outputData['featuredJobs']	= $this->skills_model->getJobs($feature_conditions);
		
		//Get Urgent Jobs
		$urgent_conditions = array('is_urgent'=>1);
		$this->outputData['urgentProjects']	= $this->skills_model->getJobs($urgent_conditions);
		
		$this->outputData['groups'] = $this->skills_model->getGroups();
		$this->outputData['groups_num'] = $this->outputData['groups']->num_rows();
		$this->outputData['groups_row'] = $this->outputData['groups']->row();
		
		$limit = array('4');
		$this->outputData['topEmployees'] = $this->skills_model->topEmployees();
		$this->outputData['topOwners'] = $this->skills_model->topOwners();
		
		//Get total owner 
		$owner_condtition = array('users.role_id'=>'1');
		$owner      = $this->admin_model->getUsers($owner_condtition);
		$this->outputData['owners'] =  $owner->num_rows();
		
		//Get total employee
		$employee_condtition = array('users.role_id'=>'2');
		$employee      = $this->admin_model->getUsers($employee_condtition);
		$this->outputData['employees'] =  $employee->num_rows();

		//Get Footer content
		$conditions = array('page.is_active'=> 1);
		$this->outputData['pages']	=	$this->page_model->getPages($conditions);
		
		$this->load->view('home',$this->outputData);
 	}
	
	/*function get_geolocation($ip) {
        $d = file_get_contents&#40;"http://www.ipinfodb.com/ip_query.php?ip=$ip&output=xml"&#41;;
        print_r($d);
        //Use backup server if cannot make a connection
        if (!$d) {
            $backup = file_get_contents&#40;"http://backup.ipinfodb.com/ip_query.php?ip=$ip&output=xml"&#41;;
            $result = new SimpleXMLElement($backup);
            if (!$backup)
                return false; // Failed to open connection
        } else {
            $result = new SimpleXMLElement($d);
        }
        //Return the data as an array
        return array('ip'=>$ip, 'country_code'=>$result->CountryCode, 'country_name'=>$result->CountryName, 'region_name'=>$result->RegionName, 'city'=>$result->City, 'zip_postal_code'=>$result->ZipPostalCode, 'latitude'=>$result->Latitude, 'longitude'=>$result->Longitude, 'timezone'=>$result->Timezone, 'gmtoffset'=>$result->Gmtoffset, 'dstoffset'=>$result->Dstoffset);
    }*/
	
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
		if($this->auth_model->getUserCookie('user_name')!='' and $this->auth_model->getUserCookie('user_password')!=''){ 
				 
			$conditions  =  array('user_name'=>$this->auth_model->getUserCookie('user_name'),'password' =>hash('sha384',$this->auth_model->getUserCookie('user_password')),'users.user_status' => '1');
			$query		= $this->user_model->getUsers($conditions);

			if($query->num_rows() > 0){
				//$this->session->set_flashdata('flash_message', $this->common_model->flash_message('success','Logged In Successfull'));
			}
			redirect('account');
		}
				
		
		if($this->uri->segment(3,0)){
			if($this->uri->segment(3,0)=='support'){
				 $this->session->set_userdata('support','support');  
			}	
			elseif($this->uri->segment(3,0)=='project')	 {
				 $this->session->set_userdata('job','project');  
				 $this->session->set_userdata('job_view','view');  
				 $this->session->set_userdata('job_id',$this->uri->segment(5,0));  
				 
			}
		}
		
		$this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
		$set_user_name = "";
		$this->session->set_flashdata('set_user_name', $set_user_name );
		if($this->input->post('usersLogin')){
			$set_user_name = $this->input->post('username');
			$this->session->set_flashdata('set_user_name', $set_user_name );
			$ip_address = $_SERVER['REMOTE_ADDR'];
			$api_key = 'bf547d5f151895bc3ed5e22e8fa555094874c0b909b1d26469d8d90e44dffd93';

			// Get the city from the api
			//$data = file_get_contents("http://api.ipinfodb.com/v3/ip-city/?key=$api_key&ip=$ip_address&format=json");
			//$data = json_decode($data);
			//$cityname = $data->cityName;
			
			$cityname = "Kolkata";
			//Set rules
			$this->form_validation->set_rules('username','lang:user_name_validation','required|trim|min_length[5]|xss_clean');
			$this->form_validation->set_rules('pwd','lang:password_validation','required|trim|xss_clean');
			if($this->form_validation->run()){
				
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
					   $otp = $row->uotp;
					  // update the last activity in the users table
					  $updateData = array();
                      $updateData['last_activity'] = get_est_time();
					   $updateData['login_status']=1;
					   $ip=$this->input->ip_address();
					   $updateData['ip_addrs']=$ip;
					   $updateData['ip_city']=$cityname;
					  //Get Activation Key
		              $activation_key = $row->userid;
				      // update process for users table
				      $this->user_model->updateUser(array('id'=>$row->userid),$updateData);
					
					
					 if(1)
					 {
						//pr($row);
					 	//Set Session For User
						$this->auth_model->setUserSession($row);
 						if($this->input->post('remember') == 1)
						{
							
						    $insertData=array();
						    $insertData['username']=$this->input->post('username');
						    $insertData['password']=$this->input->post('pwd');
						    $expire=60*60*24*100;
							if( $this->auth_model->getUserCookie('uname')==''){ 
								$this->user_model->addRemerberme($insertData,$expire); 
								
 							}	
						 }
						 else
						 {
							$this->user_model->removeRemeberme(); 
						 }	
						
					 	 //Notification message
						 //$this->session->set_flashdata('flash_message', $this->common_model->flash_message('success','Logged In Successfull'));
						 
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
				

				if($otp == 1)
				{	
					
					redirect('users/change_password');	
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
					 $this->session->set_flashdata('flash_message', $this->common_model->flash_message('error','Login failed! <br/>Incorrect username or password'));
					 redirect('home');
				 }
					 
				} else {
				
					 //Notification message
					 $this->session->set_flashdata('flash_message', $this->common_model->flash_message('error','Login failed! <br/> Incorrect username or password'));
				 	 redirect('home');
				} 		
			}
			
			
		} 
		
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
	function search(){
		//Get Logged In user
		$this->loggedInUser					= $this->common_model->getLoggedInUser();
		$this->outputData['loggedInUser'] 	= $this->loggedInUser;
		$keywords=$this->input->post('keyword');
		$budgets  = $this->input->post('types');
		
		$cond=" order by b.id DESC";
		$condition = "";
		if($keywords !=""){
			$condition = "(b.looking_for LIKE '%$keywords%'  or b.category LIKE '%$keywords%'  
						or b.tags LIKE '%$keywords%' or b.description LIKE '%$keywords%' 
						or b.budget LIKE '%$keywords%' or u.user_name LIKE '%$keywords%' 
						or u.country_symbol LIKE '%$keywords%' )   
					AND b.creator_id = u.id ";
			
		}
		
		if($budgets !=""){
			if($budgets==1){
				$condition ="(b.looking_for LIKE '%$keywords%'  or b.category LIKE '%$keywords%' 
				or b.tags LIKE '%$keywords%' or b.description LIKE '%$keywords%' 
				or b.budget LIKE '%$keywords%' or u.user_name LIKE '%$keywords%' 
				or u.country_symbol LIKE '%$keywords%' or b.id LIKE '%$keywords%') AND b.creator_id = u.id ";
			}
			if($budgets==2){
				$condition ="(b.looking_for LIKE '%$keywords%'  or b.category LIKE '%$keywords%' 
				or b.tags LIKE '%$keywords%' or b.description LIKE '%$keywords%' or b.budget LIKE '%$keywords%' 
				or u.user_name LIKE '%$keywords%' or u.country_symbol LIKE '%$keywords%' or u.id LIKE '%$keywords%')   
				AND b.creator_id = u.id ";
			}
			
		}
		if($keywords =="" && $budgets==""){
			$condition ="b.creator_id = u.id";
		}
		
		$query = "SELECT b.id as buy_id,u.id as user_id,b.creator_id,b.looking_for,b.category,b.description,b.budget,
				b.requirement_image,b.created,b.requirements,b.end_date,u.credit,u.country_symbol,u.user_verify,
				u.city,u.state,u.user_name  FROM buy_requirement as b,users as u where ".$condition." ".$cond;
		
		
		$pagenum =  ($this->input->post('current_page'))?$this->input->post('current_page'):1;
		$start_index =($pagenum - 1) *5 ;
		$query.=' limit '.$start_index.', 5';
		
		$res= $this->db->query($query);
		$result = $res->result();
		$this->outputData['searches']=$this->db->query($query);
		$this->load->view('search/searchuser',$this->outputData);
		
		
			
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