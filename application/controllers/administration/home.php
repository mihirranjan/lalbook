<?php  
/*
  ****************************************************************************
  ***                                                                      ***
  ***      BIDONN 1.0                                                      ***
  ***      File:  home.php                                                 ***
  ***      Built: Mon June 25 11:35:30 2012                                ***
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
		if(!isAdmin())
			redirect_admin('login');
		
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
		$this->load->model('skills_model');
		$this->load->model('admin_model');
		
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
		if(!isAdmin())
			redirect_admin('login');
		else
		    $this->outputData['adminlogin'] = '1';
		    	
		
		//Get total owner 
		$owner_condtition = array('users.role_id'=>'1');
		$owner      = $this->admin_model->getUsers($owner_condtition);
		$this->outputData['owners'] =  $owner->num_rows();
		
		//Get total employee
		$employee_condtition = array('users.role_id'=>'2');
		$employee      = $this->admin_model->getUsers($employee_condtition);
		$this->outputData['employees'] =  $employee->num_rows();
		
		//Get total open jobs
		//$this->load->model('skills_model');
		$openjob_condition = array('buy_requirement.status'=>'open');
		$open_jobs =  $this->skills_model->getJobs1($openjob_condition);
		$this->outputData['open_jobs']   = $open_jobs->num_rows();
		
		//Get total closed jobs
		$closedjob_condition = array('buy_requirement.status'=>'closed');
		$closed_jobs  =  $this->skills_model->getJobs1($closedjob_condition);
		$this->outputData['closed_jobs']   = $closed_jobs->num_rows();
		
		//Get total users 
		$this->outputData['users']      = $this->admin_model->getUsers();
					
		$days=date('Y-m-d',get_est_time());
		$cond1 = '%Y-%m-%d';
		$cond2 = $days;
		$res   = $this->admin_model->gettodayProjects();
		$this->outputData['today']  = $res->num_rows();
	
		//Get total jobs for this week
		$days1 = date( 'W,m,Y', time() );
		$cond11 = '%u,%m,%Y';
		$cond21 = $days1;
		$res1 = $this->admin_model->getProjects($cond11,$cond21);
		$this->outputData['week']  = $res1->num_rows();
		
		//Get total jobs for this week
		$days2= date( 'm,Y', time() );
		$cond12 = '%m,%Y';
		$cond22 = $days2;
		$res2   = $this->admin_model->getProjects($cond12,$cond22);
		$this->outputData['month']  = $res2->num_rows();
		
		//Get total jobs for this week
		$days3 = date( 'Y', time() );
		$cond13 = '%Y';
		$cond23 = $days3;
		$res3   = $this->admin_model->getProjects($cond13,$cond23);
		$this->outputData['year']  = $res3->num_rows();
		
		//Get total jobs
		$days4 = date( 'd,m,Y', time() );
		$cond14 = '%d,%m,%Y';
		$cond24 = $days4;
		$status = '0';
		$projects1   = $this->admin_model->getProjectsdetails1($cond14,$cond24,NULL,$status );
		$this->outputData['open'] = $projects1->num_rows();
		
		//Get total jobs
		$days5 = date( 'd,m,Y', time() );
		$cond15 = '%d,%m,%Y';
		$cond25 = $days5;
		$status = '2';
		$projects2   = $this->admin_model->getProjectsdetails1($cond15,$cond25,NULL,$status);
		$this->outputData['closed'] = $projects2->num_rows();
		
		//Get the users Balance
		$this->load->model('account_model');
		$res6 = $this->account_model->adminBalance();
		$res6 = $res6->row();
		$this->outputData['adminBalance'] = $res6->amount;
		
		//Get Transaction Information
		$this->load->model('account_model');
		$condition 		 = array('transactions.type'=>'Withdraw','transactions.status'=>strtolower('Pending'));
		$transactions1 	 = $this->account_model->getTransactions($condition);
		$this->outputData['withdraw'] = $transactions1->num_rows();
		
		//Get total Report Violation
		$reports = $this->admin_model->getReports();
		$this->outputData['reportViolation'] = $reports->num_rows();
		
		//Get total jobs
		$this->outputData['jobs']      = $this->skills_model->getJobs();
		
		$this->load->view('admin/view_home',$this->outputData);
		
	} //Function Index End
	
}
//Class Home End 

/* End of file home.php */
/* Location: ./application/controllers/administration/login.php */