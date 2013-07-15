<?php 

/*
  ****************************************************************************
  ***                                                                      ***
  ***      BIDONN 1.0                                                      ***
  ***      File:  users.php                                                ***
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

class Users extends CI_Controller {

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
		$this->load->model('auth_model');
		$this->load->model('skills_model');
		
		//Page Title and Meta Tags
		$this->outputData = $this->common_model->getPageTitleAndMetaData();
		
		//Currency Type
		$this->outputData['currency'] = $this->db->get_where('settings', array('code' => 'CURRENCY_TYPE'))->row()->string_value;
		//$this->outputData['currency'] = $this->db->get_where('currency', array('currency_type' => $currency_type))->row()->currency_symbol;
		
		//Get Logged In user
		$this->loggedInUser					= $this->common_model->getLoggedInUser();
		$this->outputData['loggedInUser'] 	= $this->loggedInUser;
		
		//Get Footer content
		$conditions = array('page.is_active'=> 1);
		$this->outputData['pages']	=	$this->page_model->getPages($conditions);
		
		//Get Latest jobs
		$limit_latest = $this->config->item('latest_projects_limit');
		$limit3 = array($limit_latest);
		$this->outputData['latestJobs']	= $this->skills_model->getLatestJobs($limit3);
		
		//language file
		$this->lang->load('enduser/common', $this->config->item('language_code'));
		$this->lang->load('enduser/employee', $this->config->item('language_code'));
	} //Controller End 
	// --------------------------------------------------------------------
	
	/**
	 * Loads Home page of the site.
	 *
	 * @access	public
	 * @param	nil
	 * @return	void
	 */	
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
                      
					  $otp = $row->otp;
					  // update the last activity in the users table
					  $updateData = array();
                      $updateData['last_activity'] = get_est_time();
					  $updateData['login_status']=1;
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
					 redirect('users/login');
				 }
					 
				} else {
				
					 //Notification message
					 $this->session->set_flashdata('flash_message', $this->common_model->flash_message('error','Login failed! Incorrect username or password'));
				 	 redirect('users/login');
				} //If username exists			
			}//If End - Check For Validation				
		} //If End - Check For Form Submission
		$this->load->view('members/view_login',$this->outputData);
	} //Function login End
	// --------------------------------------------------------------------
	
	/**
	 * Loads forgotPassword page of the site.
	 *
	 * @access	public
	 * @param	nil
	 * @return	void
	 */	
	function forgotPassword()
	{	
		//language file
		$this->lang->load('enduser/forgot', $this->config->item('language_code'));
		
		//Load Models - for this function
		$this->load->model('user_model');
		
		//load validation libraray
		$this->load->library('form_validation');
		
		//Load Form Helper
		$this->load->helper('form');
		
		//Intialize values for library and helpers	
		$this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
		
		//Get Form Data	- Forgot Password
		if($this->input->post('forgotPassword'))
		{
			//Set rules
			$this->form_validation->set_rules('username','lang:user_name_validation','required|trim|min_length[5]|xss_clean');			
			if($this->form_validation->run())
			{
				$username 		=	$this->input->post('username');
				$conditions 	= 	array('user_name'=>$username);
				$query 			=  	$this->user_model->getUsers($conditions);
				$usersData      =   $query->row();
				
				if($query->num_rows()>0)
				{
				 $newpassword    =   '';
				 for($i=0;$i<5;$i++)
				  {
				  $newpassword .=chr(rand(65,90));
				  $newpassword .=chr(rand(97,122));
				  }
				 //Update the suers password	
				 //$updateData['password']    		  = md5($newpassword);
				 
				 $updateData['password'] = hash('sha384',$newpassword);
				 $updateData['otp'] = "1";
				 $updateKey = array('users.id'=>$usersData->userid);
			     $this->user_model->updateUser($updateKey,$updateData);
					
				//Send Mail
				$conditionUserMail = array('email_templates.type'=>'forget_password');
				$this->load->model('email_model');
				$result            = $this->email_model->getEmailSettings($conditionUserMail);
				$rowUserMailConent = $result->row();
				$splVars = array("!site_title" => $this->config->item('site_title'), "!url" => site_url(''), "!username" =>$usersData->user_name ,"!newpassword" =>$newpassword);
				
				$mailSubject = $rowUserMailConent->mail_subject;
				$mailContent = strtr($rowUserMailConent->mail_body, $splVars);		
				$toEmail = $usersData->email;
				$fromEmail = $this->config->item('site_admin_mail');
				
				$this->load->library('email');
				$this->email->set_newline("\r\n");

				$this->email->from($fromEmail);
				//$toEmail = "mihir.mishra85@gmail.com";
				$this->email->to($toEmail);


				$this->email->subject($mailSubject);		
				$this->email->message($mailContent);
				
				$this->email->send();
				
				
				

				//Notification message
				$this->session->set_flashdata('flash_message', $this->common_model->flash_message('success','Your password has been sent to your registered email address!'));
				redirect('users/forgotPassword');					
				} else {
					 //Notification message
					 $this->session->set_flashdata('flash_message', $this->common_model->flash_message('error','User Name Failed'));
				 	 redirect('users/forgotPassword');					
				}
			}//If End - Check For Validation				
		} //If End - Check For Form Submission For Forgot Password
		
		//Get Form Data	- Forgot Username
		if($this->input->post('forgotUsername'))
		{
			//Set rules
			$this->form_validation->set_rules('email','lang:email_validation','required|trim|valid_email|xss_clean');			
			if($this->form_validation->run())
			{
				$email 			=	$this->input->post('email');
				$conditions 	= 	array('email'=>$email);
				$query 			=  	$this->user_model->getUsers($conditions);
				$usersData      =   $query->row();
				if($query->num_rows()>0)
				{
				 //Create new password
				 $newpassword    =   '';
				 for($i=0;$i<5;$i++)
				  {
				  $newpassword .=chr(rand(65,90));
				  $newpassword .=chr(rand(97,122));
				  }
				//  print_r($usersData);exit;
				 //Update the suers password	
				 //$updateData['password']    		  = md5($newpassword);
				 $updateData['password'] = hash('sha384',$newpassword);
				  $updateData['otp'] = "1";
				 //184227b0a8ac4bd4332671712135e0617ec27d8b75a0a1cea757471edb539d8da31b381db8333614d48fc5a6e66a95f1
				 $updateKey 		= array('users.id'=>$usersData->userid);
			     $this->user_model->updateUser($updateKey,$updateData);
					
				//Send Mail
				$conditionUserMail = array('email_templates.type'=>'forget_password');
				$this->load->model('email_model');
				$result            = $this->email_model->getEmailSettings($conditionUserMail);
				$rowUserMailConent = $result->row();
				$splVars = array("!site_title" => $this->config->item('site_title'), "!url" => site_url(''), "!username" =>$usersData->user_name ,"!newpassword" =>$newpassword);
				$mailSubject = $rowUserMailConent->mail_subject;
				$mailContent = strtr($rowUserMailConent->mail_body, $splVars);		
				$toEmail = $usersData->email;
				$fromEmail = $this->config->item('site_admin_mail');
				
				$this->load->library('email');
				$this->email->set_newline("\r\n");

				$this->email->from($fromEmail);
				//$toEmail = "mihir.mishra85@gmail.com";
				$this->email->to($toEmail);
				

				$this->email->subject($mailSubject);		
				$this->email->message($mailContent);
				
				$this->email->send();
					
					
				//Notification message
				$this->session->set_flashdata('flash_message', $this->common_model->flash_message('success','Your username has been sent to your registered email address'));
				redirect('users/forgotPassword');					
				} else {
					 //Notification message
					 $this->session->set_flashdata('flash_message', $this->common_model->flash_message('error','Email Failed'));
				 	 redirect('users/forgotPassword');					
				}				
			}//If End - Check For Validation				
		} //If End - Check For Form Submission For Forgot Username	
		$this->load->view('members/view_forgot',$this->outputData);
	} //Function forgotPassword End
	// --------------------------------------------------------------------
	
	/**
	 * Loads logout .
	 *
	 * @access	public
	 * @param	nil
	 * @return	void
	 */	
	function logout(){	
	
		
		$this->auth_model->clearUserSession();
		//$this->session->set_flashdata('flash_message', $this->common_model->flash_message('success',$this->lang->line('logout_success')));
		$this->auth_model->clearUserCookie(array('username','password'));
		$this->auth_model->clearUserCookie(array('user_name','user_password'));
		redirect('home');
				
	} //Function logout End
	
	// --------------------------------------------------------------------
	
	/**
	 * Loads login for user to post  .
	 *
	 * @access	public
	 * @param	nil
	 * @return	void
	 */	
	function post()
	{	
		$this->auth_model->clearUserSession();
		$this->session->set_flashdata('flash_message', $this->common_model->flash_message('success',$this->lang->line('logout_success')));
		redirect('information');
	} //Function logout End
	
	/**
	 *Get the  job deatils for session check 
	 *
	 * @access	public
	 * @param	nil
	 * @return	void
	 */	
	
	function getData()
	{ 
	//language file
		$this->lang->load('enduser/loginUsers', $this->config->item('language_code'));
		
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
		$this->uri->segment(4);
		
		if($this->uri->segment(3)!='')
			{
			 
					 $this->session->set_userdata('project','project');  
					 $this->session->set_userdata('view','view');  
					 $this->session->set_userdata('id',$this->uri->segment(3,0));  
					 
				
			}
			redirect('users/login');
	}//Function getData End
	//---------------------------------------------------------------------------------
	function view()
	{	
	$this->loggedInUser					= $this->common_model->getLoggedInUser();
		$this->outputData['loggedInUser'] 	= $this->loggedInUser;
		//print_r($this->outputData['loggedInUser']);exit;
		//Load Language
		$this->lang->load('enduser/common', $this->config->item('language_code'));
		$this->lang->load('enduser/viewJob', $this->config->item('language_code'));
		$this->load->helper('users_helper');
		//Get Job Id
		 $this->load->model('package_model');
		 $this->load->model('gallery_model');
	 $this->load->model('requirement_model');
        //Load Language File
		$this->lang->load('enduser/account', $this->config->item('language_code'));
		$this->lang->load('enduser/viewJob', $this->config->item('language_code'));
		
		//Load helper file
		$this->load->helper('transaction');
		$this->load->helper('reviews');
		
		$this->load->model('skills_model');
		if($this->uri->segment(3))
		   {
			$usid	 = $this->uri->segment(3,'0');
			//echo $usid;
			$condtition = array('users.role_id'=>'1','users.id'=>$usid);
		
		
		$this->outputData['userrecords'] =  $this->user_model->getUsers($condtition);
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
		$condtns2=array('reviews.owner_id'=>$usid);
		
	
		$this->outputData['sellerfeeds'] = $sellrfeeds =   $this->skills_model->getReviews($condtns2);
		$feedselr=$this->outputData['sellerfeeds'];
		$selrefeeds=$feedselr->num_rows();
		if($selrefeeds>0)
		{
		$this->outputData['sellerfeeds'] = $sellrfeeds;
		
		}else{
		
		$condtns2=array('reviews.employee_id'=>$usid);
		
		$this->outputData['sellerfeeds'] = $sellrfeeds =   $this->skills_model->getReviews($condtns2);
		}
		   }
		/*else
		   {
		     $this->session->set_flashdata('flash_message', $this->common_model->flash_message('success',$this->lang->line('You can not access to this page')));
			 redirect('information');
		   }
		if(!is_numeric($this->uri->segment(3)))  
		  {
		  	$this->session->set_flashdata('flash_message', $this->common_model->flash_message('success',$this->lang->line('You can not access to this page')));
			 redirect('information');
		  } */
		 // echo $us;exit;
		if(isset($this->loggedInUser->id))
		{
		$us=$this->loggedInUser->id;
		//echo $usid;exit;
		if(isset($usid) and $us==$usid)
		  {
		 
			 redirect('account');
		  }
		  else{
		 
	    $this->load->view('publicprofile',$this->outputData);
		}
		  }
		  else{
		 
	    $this->load->view('publicprofile',$this->outputData);
		}
		  
	} //Function view End
	/**
	 * get the details from private job to store session
	 *
	 * @access	public
	 * @param	nil
	 * @return	void
	 */	
	function getProjectDetails()
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
		$this->uri->segment(4);
		
		if($this->uri->segment(3)!='')
			{
			 
				$this->session->set_userdata('private','project');  
				$this->session->set_userdata('type','view');  
				$this->session->set_userdata('project_id',$this->uri->segment(3,0)); 
				$this->session->set_userdata('private_user',$this->uri->segment(4,0)); 
				$this->session->set_userdata('creator_id',$this->uri->segment(5,0));
				$condition='jobs.id='.$this->uri->segment(3,0);
				$query="SELECT * FROM jobs WHERE ". $condition;
				$result=$this->db->query($query);
					foreach( $result->result() as $project)
					{
						$project_name=$project->job_name;
					}
				redirect('users/login/'.$project_name);
			}
			
	}//Function getProjectDetails End 
	//---------------------------------------------------------------------------- 
	
	
	function load_users()
	{
		if($this->input->post('type_id'))
		{
 		$user_id     =$this->loggedInUser->id;  	
		
		//Get logged user role
		$role   =  $this->loggedInUser->role_id;
		$project_id = $this->input->post('type_id');
		
		//Get the users details
	    $condition    = array('jobs.id'=>$project_id);	
		$usersJob	   =  $this->skills_model->getMembersJob($condition);
		$this->outputData['usersProject'] =  $usersJob->result();	
		foreach($usersJob->result() as $res)
		  {
		    
		  	if($role == '1')
			   $userid = $res->employee_id;
			if($role == '2')
			   $userid = $res->creator_id;
		  }
		
		//Get the users details
	    $this->load->model('user_model');
		$condition    = array('users.id'=>$userid);	
		$usersname	   =  $this->user_model->userProjectdata($condition);
		$this->outputData['usersname'] =  $usersname->result();	
		if($usersname)
		{
			foreach($usersname->result() as $users)
			{
			?>
          <option value="<?php echo $users->id; ?>"> <?php echo $users->user_name; ?></option>
          <?php				
			}
		} 
		?>
			<?php
		} else {
			if($this->input->post('type_id') == '0')
			  {
				//Get logged user role
				   $this->outputData['logged_userrole']   =  $this->loggedInUser->role_id;
				   $role                                  =  $this->loggedInUser->role_id;
				   ?>
				<select id='users_load' name="users_load">  
				<?php 
				if($role == '1')
				{ ?>
					<option value="0"> <?php echo '<b>-- '.$this->lang->line('Select Employee').' --</b>'; ?></option>	<?php 
				}
				if($role == '2')
				{ ?>
					<option value="0"> <?php echo '<b>-- '.$this->lang->line('Select Owner').' --</b>'; ?></option>	<?php  
				}
				  
			  } 
		}
		exit;
	} //Function Load_user
	
	
	
	function load_users1()
	{
	//pr($this->uri->segment_array());exit;
		if($this->input->post('type_id') or $this->uri->segment(3))
		{
		//Here the code for select if user choosed in job combo box
		$user_id     =$this->loggedInUser->id;  	
		
		//Get logged user role
		$role   =  $this->loggedInUser->role_id;
		$project_id = $this->uri->segment(3);		
		//echo $project_id;
		//Get the users details
	    if($this->uri->segment(3))
		$condition    = array('buy_requirement.id'=>$project_id);
		$usersJob	   =  $this->skills_model->getMembersJob($condition);
		$this->outputData['usersProject'] =  $usersJob->result();	
		foreach($usersJob->result() as $res)
		  {
		  // print_r($this->loggedInUser->id);
		  	if($this->loggedInUser->id == $res->creator_id)
			{
			
			$conditions    = array('bids.job_id'=>$project_id);
			$usersBids	   =  $this->skills_model->getBidsByJob($conditions);
			$this->outputData['usersProject'] =  $usersBids->result();
			foreach($usersBids->result() as $res)
		  {
			    $userid = $res->user_id;
				}}
			   else{
			   $userid = $res->creator_id;
			   }
			/*if($role == '2')
			   $userid = $res->creator_id;*/
		  }
		
		//Get the users details
	    $this->load->model('user_model');
		$condition    = array('users.id'=>$userid);	
		//print_r($condition);
		$usersname	  =  $this->user_model->userProjectdata($condition);
		$this->outputData['usersname'] =  $usersname->result();	
		//print_r($usersname->result());exit;
		$default='Everyone';
		?><?php 
		if($usersname)
		{
			$data='<select name="prog_id" id="prog_id">';
			foreach($usersname->result() as $users)
			{
			    
				$data.= '<option value="'.$users->userid.'">'.$users->user_name.'</option>';
				         		
			}
			$data.='<option value="0">'.$default.'</option>';
			$data.='</select>';
			echo $data;
		} 
		?>
			<?php
		} else {
			if($this->input->post('type_id') == '0')
			  {
				
				//Get logged user role
				$this->outputData['logged_userrole']   =  $this->loggedInUser->role_id;
				$role                                  =  $this->loggedInUser->role_id;
				echo 'Please Choose Job';
				  
			  } 
		} 
		exit;
	} //Function Load_Category
	
	function load_users2()
	{
	//pr($this->uri->segment_array());exit;
		if($this->input->post('type_id') or $this->uri->segment(3))
		{
		//Here the code for select if user choosed in job combo box
		$user_id     =$this->loggedInUser->id;  	
		
		//Get logged user role
		$role   =  $this->loggedInUser->role_id;
		$project_id = $this->uri->segment(3);		
		//echo $project_id;exit;
		//Get the users details
	    if($this->uri->segment(3))
		   $condition    = array('buy_requirement.id'=>$project_id);	
		$usersJob	   =  $this->skills_model->getMembersJob($condition);
		$this->outputData['usersProject'] =  $usersJob->result();	
		foreach($usersJob->result() as $res)
		  {
		    
		  	if($role == '1')
			   $userid = $res->awarded_user;
			/*if($role == '2')
			   $userid = $res->creator_id;*/
		  }
		
		//Get the users details
	    $this->load->model('user_model');
		$condition    = array('users.id'=>$userid);	
		$usersname	   =  $this->user_model->userProjectdata($condition);
		$this->outputData['usersname'] =  $usersname->result();	
		$default='No Owner';
		?><?php 
		if($usersname)
		{
			$data='<select name="prog_id" id="prog_id">';
			
			foreach($usersname->result() as $users)
			{
			   if($users->user_name!='')
			   {
			   $data.= '<option value="'.$users->userid.'">'.$users->user_name.'</option>';
			   }
			    else
				{
				 $data.='<option value="0" selected="selected">'.$default.'</option>';
				}
  			}
			//$data.='<option value="0">'.$default.'</option>';
			$data.='</select>';
			echo $data;
		} 
		?>
		<?php
		} else {
			if($this->input->post('type_id') == '0')
			  {
				
				//Get logged user role
				$this->outputData['logged_userrole']   =  $this->loggedInUser->role_id;
				$role                                  =  $this->loggedInUser->role_id;
				echo 'Please Choose Job';
 			  } 
		} 
		exit;
	} //Function Load_Category
	
	
	function validEmail($email){
		$expression = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.([a-zA-Z]{2,4})$/";
		if (preg_match($expression, $email)) {
			return true;
		} else {
			return false;
		} 
	}

	function usersignup(){
		
		
		$return_arr = array();
		 
		$nam=$_POST['fulname'];
		 if( !isset($_POST['fulname']) || trim($_POST['fulname'])=="")
		{ 

		// echo "{'errors': [{'field': 'message','error': 'This field is required.'}], 'success': false}";
		 $return_arr["errors"]=array(array('field'=>'fulname','error'=>'This field is required.'));
		 $return_arr["success"]= false;
		 echo json_encode($return_arr);
		 return ;
		}
		if(isset($_POST['fulname']) && strlen($nam)<5)
		{

		// echo "{'errors': [{'field': 'message','error': 'This field is required.'}], 'success': false}";
		 $return_arr["errors"]=array(array('field'=>'fulname','error'=>'Full Name must be more than 5 characters.'));
		 $return_arr["success"]= false;
		 echo json_encode($return_arr);
		 return ;
		 }

		 if(!isset($_POST['email']) || trim($_POST['email'])=="" || !$this->validEmail($_POST['email']))
		 { 
			// echo "{'errors': [{'field': 'email', 'error': 'Enter a valid e-mail address.'}], 'success': false}";
			 $return_arr["errors"]=array(array('field'=>'email','error'=>'Enter a valid e-mail address.'));
			 $return_arr["success"]= false;
			 echo json_encode($return_arr);
			 return;
		 }
		 if(isset($_POST['email']))
		 {
		 $uemailid=$_POST['email'];
		 $useremailid=mysql_query("select email from users where email='$uemailid'");
		 $rest=mysql_num_rows($useremailid);
		 if($rest>0)
		 {
		 // echo "{'errors': [{'field': 'email', 'error': 'Enter a valid e-mail address.'}], 'success': false}";
			 $return_arr["errors"]=array(array('field'=>'email','error'=>'Sorry Your Email Is Already Registered in Lalbook.'));
			 $return_arr["success"]= false;
			 echo json_encode($return_arr);
			 return;
		 
		 }
		 }
		 if( !isset($_POST['username']) || trim($_POST['username'])=="")
		{ 
		// echo "{'errors': [{'field': 'message','error': 'This field is required.'}], 'success': false}";
		 $return_arr["errors"]=array(array('field'=>'username','error'=>'This field is required.'));
		 $return_arr["success"]= false;
		 echo json_encode($return_arr);
		 return ;
		}
		$uname=$_POST['username'];
		if(isset($_POST['username']) && strlen($uname)>=16 ||  strlen($uname)<5)
		{

		// echo "{'errors': [{'field': 'message','error': 'This field is required.'}], 'success': false}";
		 $return_arr["errors"]=array(array('field'=>'username','error'=>'Full Name must be more than 5 characters.'));
		 $return_arr["success"]= false;
		 echo json_encode($return_arr);
		 return ;
		 }
		if( !isset($_POST['message']) || trim($_POST['message'])=="")
		{ 
		// echo "{'errors': [{'field': 'message','error': 'This field is required.'}], 'success': false}";
		 $return_arr["errors"]=array(array('field'=>'message','error'=>'This field is required.'));
		 $return_arr["success"]= false;
		 echo json_encode($return_arr);
		 return ;
		}
		$msssg=$_POST['message'];
		if(isset($_POST['message']) && strlen($msssg)>200 ||  strlen($msssg)<10)
		{

		// echo "{'errors': [{'field': 'message','error': 'This field is required.'}], 'success': false}";
		 $return_arr["errors"]=array(array('field'=>'message','error'=>'Goals Must be more than 10 characters.'));
		 $return_arr["success"]= false;
		 echo json_encode($return_arr);
		 return ;
		 }
		$pasw=$_POST['password'];
		if( !isset($_POST['password']) || trim($_POST['password'])=="")
		{ 
		// echo "{'errors': [{'field': 'message','error': 'This field is required.'}], 'success': false}";
		 $return_arr["errors"]=array(array('field'=>'password','error'=>'This field is required.'));
		 $return_arr["success"]= false;
		 echo json_encode($return_arr);
		 return ;
		}
		if(isset($_POST['password']) && strlen($pasw)>10)
		{

		// echo "{'errors': [{'field': 'message','error': 'This field is required.'}], 'success': false}";
		 $return_arr["errors"]=array(array('field'=>'password','error'=>'Password  Must be more than 10 characters.'));
		 $return_arr["success"]= false;
		 echo json_encode($return_arr);
		 return ;
		 }
		if( !isset($_POST['cpassword']) || trim($_POST['cpassword'])=="" || ($_POST['cpassword']!=$_POST['password']))
		{ 
		// echo "{'errors': [{'field': 'message','error': 'This field is required.'}], 'success': false}";
		 $return_arr["errors"]=array(array('field'=>'cpassword','error'=>'This field is required.or Your confirm password is not match with Password'));
		 $return_arr["success"]= false;
		 echo json_encode($return_arr);
		 return ;
		}
		if( !isset($_POST['terms']) || trim($_POST['terms'])=="" || ($_POST['terms'])!=1)
		{ 
		// echo "{'errors': [{'field': 'message','error': 'This field is required.'}], 'success': false}";
		 $return_arr["errors"]=array(array('field'=>'terms','error'=>'This field is required.'));
		 $return_arr["success"]= false;
		 echo json_encode($return_arr);
		 return ;
		}

		
		$subject = 'Lalbook signup';
		$to = $_POST['email'];
		$msg=$_POST['message'];
		$activation_key = md5(time());
		$created=date("Y-m-d H:i:s");
		$confirmationlink=base_url().'index.php/owner/confirm/'.$activation_key;
						
		$rate1="";
		$rate2="";
		$rate3="";
		$recommend="";
		 $news="";
		// if(isset($_POST['fulname']))
		 $fulnm=$_POST['fulname'];
		//  if(isset($_POST['email']))
		 $usremail=$_POST['email'];
		 // if(isset($_POST['password']))
		 $rate3=$_POST['password'];
		 //$haspwd=md5($rate3);
		$haspwd= hash('sha384',$rate3); 
		//if(isset($_POST['username']))
		$usrnm=$_POST['username'];
		//if(isset($_POST['cpassword']))
		$confmp=$_POST['cpassword'];
		//if(isset($_POST['terms']))
		$trmcond=$_POST['terms'];



		if(($fulnm!='') && ($usremail!='') && ($usrnm!='') && ($msg!='') && ($rate3!='') && ($confmp!='') && ($trmcond!='')){
		 
			$usersign="insert into users(user_name,fulname,email,role_id,password,activation_key,created,lalbook_goal) values('$usrnm','$fulnm','$usremail','1','$haspwd','$activation_key','$created','$msg')";
			$query1 = $this->db->query($usersign);
			
			if($query1){
				$message = '<html><body>';
				$message .= '<div style="background:url('.base_url().'application/css/images/email_bg.png) no-repeat center;width:727px;height:318px;border:none;padding:20px 20px 0;margin:0 auto;">';
				$message .='<h1 style="height:70px;margin:7px 0 0px;"><a href="#"><img src="'.base_url().'application/css/images/email_logo.png" alt="" style="border:none;"/></a></h1>';
				$message .='<p style="font:12px Arial, Helvetica, sans-serif;color:#333;margin:10px 0 20px;">Thank you for choosing Lalbook for your posting requirements. Please click here to continue the signup process. </p>';
				$message .='<p style="font:bold 12px Arial, Helvetica, sans-serif;color:#333;margin:0 0 5px;">User Name: </p>' ."&nbsp;" .$usrnm;

				$message .='<p style="font:bold 12px Arial, Helvetica, sans-serif;color:#333;margin:0 0 5px;">Password:</p>' ."&nbsp;" .$rate3;

				$message .='<p style="font:bold 12px Arial, Helvetica, sans-serif;color:#333;margin:0 0 5px;">Confirmation Link:</p>';
				$message .='<p style="font:12px Arial, Helvetica, sans-serif;margin:0px 0 20px;"><a href="#" style="color:#c00000;text-decoration:none;">';
				$message .='<a href="'.$confirmationlink.'">'.$confirmationlink.'</a>';
				$message .='</a></p>';
				$message .='<p style="font:bold 12px Arial, Helvetica, sans-serif;color:#333;margin:0 0 5px;">Best Regards,</p>';
				$message .='<p style="font:bold 12px Arial, Helvetica, sans-serif;color:#333;margin:0 0 5px;">Team Lalbook</p>';
				$message .= "</div>";
				$message .= "</body></html>";
				
				$this->load->library('email');
				$this->email->set_newline("\r\n");

				$fromEmail = $this->config->item('site_admin_mail');
				$this->email->from($fromEmail);

				//$to = "mihir.mishra85@gmail.com";
				$this->email->to($to);


				$this->email->subject($subject);		
				$this->email->message($message);

				if($this->email->send()){
					$return_arr["success"]= true;
					echo json_encode($return_arr);
				}else{
					$return_arr["success"]= false;
					echo json_encode($return_arr);
				}
				
				
			}else{
				$return_arr["errors"]=array(array('error'=>'error in insert.'));
				$return_arr["success"]= false;
				echo json_encode($return_arr);
				return ;
			}
			
		 }
	} 
	
	function change_password(){
		$user_details = $this->common_model->getLoggedInUser();
		$new_pass = $error = "";
		if($this->input->post('Save')){
			$new_pass = $this->input->post('new_pass');
			if($this->input->post('new_pass') == "" || $this->input->post('new_rpass') == ""){
				$error = "Please fill up the fields";
			}else{
				if($this->input->post('new_pass') == $this->input->post('new_rpass')){
					$updateData = array();
                    $updateData['password'] = hash('sha384',$this->input->post('new_pass'));
					$updateData['otp'] =  "0";
					
				    // update process for users table
				    $this->user_model->updateUser(array('id'=>$user_details->id),$updateData);
					redirect('account');	
				}else{
					$error = "Password and Renter password field are not same";
				}
			}
		
			
		}
		
		$this->outputData['error'] = $error;
		//echo "<pre>";print_r($this->loggedInUser);
		$this->load->view('members/change_password',$this->outputData);
	}
} 

/* End of file Users.php */ 
/* Location: ./application/controllers/Users.php */
?>