<?php  
 
class Feedback extends CI_Controller {


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
		$this->load->model('file_model');
		

		
		
	
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
		    	
	     //Load Language
		$this->lang->load('enduser/account', $this->config->item('language_code'));
		$this->lang->load('enduser/requirement');
		
		//Load model
		$this->load->model('admin_model');
		$this->load->model('file_model');
		
		//load validation library
		$this->load->library('form_validation');
		
		//Load Form Helper
		$this->load->helper('form');
		
		//Intialize values for library and helpers	
		$this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
		
		
		if($this->input->post('sendEmail'))
		{	
		
		
		$this->form_validation->set_rules('aName','Admin Name','required|trim|max_length[50]|xss_clean|alpha_space');
		$this->form_validation->set_rules('email','Admin Email','required|valid_email');
		$this->form_validation->set_rules('subject','Subject','required');
		$this->form_validation->set_rules('emailids','Email Ids to Send','required');
		$this->form_validation->set_rules('content','Email Content','required');
		
		if($this->form_validation->run())
			{	
			
			
			}
		}
		
		$this->load->view('admin/view_feedback',$this->outputData);
		
	} //Function Index End
	
	
	
}
