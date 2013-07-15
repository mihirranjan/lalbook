<?php  

/*
  ****************************************************************************
  ***                                                                      ***
  ***      BIDONN 1.0                                                      ***
  ***      File:  login.php                                                ***
  ***      Built: Mon June 25 10:34:30 2012                                ***
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
 
class Login extends CI_Controller {

	public $outputData;
	public $loggedInUser;

	/**
	 * Constructor 
	 *
	 * Loads language files and models needed for this controller
	 */
	function __construct()
	{
		parent::__construct();
		
		//Check For Admin Logged in
		//if(isAdmin())
			//redirect_admin('home');
		
		$this->load->library('settings');
		
        //Get Config Details From Db
		$this->settings->db_config_fetch();
			
		//Load the language file
		$this->lang->load('admin/common', $this->config->item('language_code'));	
		$this->lang->load('admin/login', $this->config->item('language_code'));
		$this->lang->load('admin/validation',$this->config->item('language_code'));	
		
		//load models required
		$this->load->model('common_model');
		$this->load->model('auth_model');
		$this->load->model('admin_model');
		
		$this->load->model('admin_model');
		$owner_condtition = array('users.role_id'=>'1');
		$owner     		  = $this->admin_model->getUsers($owner_condtition);
		$employee_condtition = array('users.role_id'=>'2');
		$employee            = $this->admin_model->getUsers($employee_condtition);
		$this->outputData['$owners'] =  $owner->num_rows();
		$this->outputData['$employees'] =  $employee->num_rows();
		$this->outputData['login'] = 'TRUE';
		
	} //Controller Login End
	
	// --------------------------------------------------------------------
	
	/**
	 * Loads admin login interface.
	 *
	 * @access	public
	 * @param	nil
	 * @return	void
	 */
	function index()
	{
	
		//load validation library
		$this->load->library('form_validation');		
		
		//Load Form Helper
		$this->load->helper('form');
		
		//Intialize values for library and helpers	
		$this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));

		//Get Form Details
		if($this->input->post('loginAdmin'))
		{	
			//Set rules
			$this->form_validation->set_rules('username','lang:username_validation','required|trim|xss_clean');
			$this->form_validation->set_rules('pwd','lang:pwd_validation','required|trim|xss_clean');
			
			if($this->form_validation->run())
			{	
				$username = $this->input->post('username');
				$password = hash('sha384',$this->input->post('pwd'));
				//$password = md5($this->input->post('pwd'));
				
 				$conditions = array('admin_name'=>$username,'password'=>$password);
				
				if($this->auth_model->loginAsAdmin($conditions))
				{
					//Set Session For Admin
					$this->auth_model->setAdminSession($conditions);
					redirect_admin('home');
				
				} else {
					//Log in attempt failed
				  	$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error',$this->lang->line('login_failed')));
				 	redirect_admin('login');
				}				
			}//If End - Check For Form Validation
		} //IF End- Check For Form Submission	
		
		$this->load->view('admin/login',$this->outputData);
		
	} //Function Index End
	
}
//Class Login End 

/* End of file login.php */
/* Location: ./application/controllers/administration/login.php */