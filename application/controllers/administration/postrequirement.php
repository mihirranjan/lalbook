<?php  
 
class Postrequirement extends CI_Controller {


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
		
		
		$postreq =  $this->admin_model->getPostrequirement();
		$this->outputData['postRequirement']  = $postreq;
		
		
		
	
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
			$this->load->model('requirement_model');
			
		    $start = $this->uri->segment(4,0);
			 $page_rows         					 =  $this->config->item('mail_limit');
		
		
		$order[0]            ='id';
		$order[1]            ='asc';
		$limit[0]			 = $page_rows;
		$limit[1]			 = $start;
		
		$limit[0]			 = $page_rows;
		if($start > 0)
		   $limit[1]			 = ($start-1) * $page_rows;
		else
		    $limit[1]			 = $start * $page_rows;  
	$postreq =  $this->admin_model->getPostrequirement();
	$this->outputData['postRequirement']  = $postreq;
	//print_r($this->outputData['postRequirement']);exit;
			//$this->outputData['totalrec'] = $totalrecords;
		$this->load->library('pagination');
		$config['base_url'] 	 = admin_url('postrequirement/index');
		$config['total_rows'] 	 = $postreq->num_rows();		
		$config['per_page']     = $page_rows; 
		$config['cur_page']     = $start;
		$this->pagination->initialize($config);		
		$this->outputData['pagination']   = $this->pagination->create_links2(false,'postrequirement/index');	
	
		
		$this->load->view('admin/postrequirement/view_postRequirement',$this->outputData);
		
	} //Function Index End
	
	
		function edit()
	{	
		//Get id of the group	
		$id = is_numeric($this->uri->segment(4))?$this->uri->segment(4):0;
		
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
		
		
		if($this->input->post('editRequirement'))
		{	
		$this->form_validation->set_rules('lookingfor','lang:what service you need','required|trim|max_length[50]|xss_clean|alpha_space');
		$this->form_validation->set_rules('reqtype','lang:Requirementtype','required');
		$this->form_validation->set_rules('industry','lang:Industrytype','required');
		$this->form_validation->set_rules('budget','lang:budget_validation','required');
		$this->form_validation->set_rules('enddate','lang:enddate','required');
		$this->form_validation->set_rules('description','lang:description', 'required|min_length[25]|trim|xss_clean|callback__emailpresent_check');
			$this->form_validation->set_rules('attachment','lang:attachment_validation','callback_attachment_check');		
			
			
			if($this->form_validation->run())
			{	
				  //prepare update data
				   $updateData                  	  	= array();	
			       $updateData['description']      	= $this->input->post('description');
				   
				    if(isset($this->data['file']))
				   {	
				    $updateData['requirement_image']=$this->data['file']['file_name'];  /*$insertData['attachment_name']=$this->data['file']['orig_name'];*/ 
					}
					
				   $strc                            = $this->input->post('enddate');
				   $enddates                        = date('Y-m-d',strtotime($strc));	
				   $updateData['end_date']  		= $enddates;
					
				  $updateData['looking_for']    	= $this->input->post('lookingfor');	
 			      $updateData['requirements']    	= $this->input->post('reqtype');	
 				  $updateData['budget']    	  	    = $this->input->post('budget'); 
				  $updateData['category']       	= $this->input->post('industry');
				  

				  //Add Groups
				  $this->admin_model->updatePostrequirement($id,$updateData);
				  
				  //Notification message
				  $this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success',$this->lang->line('updated_success')));
				  redirect_admin('admin/postRequirement');
		 	} 
		} //If - Form Submission End
		
		 //Post the maximum size of memory limit
		$maximum        = $this->config->item('upload_limit');
 	    $this->outputData['maximum_size'] = $maximum;
		
		$condition = array('buy_requirement.id'=>$id);
		$this->outputData['postRequirement'] = $this->admin_model->getPostrequirement($condition);
		//Load View
	   	$this->load->view('admin/postrequirement',$this->outputData);
	   
	}
	
	function industry(){
	
	 	$this->load->view('admin/postrequirement/view_industry');
	}
	
	
	function delete()
	{	
		//Load model
		 $this->load->helper('form');
		$reqId = $this->uri->segment(4,'0');
		
	if($reqId==0)
	{	
		//Load Form Helper
		$this->load->helper('form');
		$getgroups	=	$this->admin_model->getPostrequirement();
		$requirementlist  =   $this->input->post('reqlist');
		

		if(!empty($requirementlist))
		{
			foreach($requirementlist as $res)
			 {
				
				$condition = array('buy_requirement.id'=>$res);
				$this->admin_model->deletePostrequirement(NULL,$condition);
			 }
		 }
		 else
		 {
		  $this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error',$this->lang->line('Please select Group')));
		   redirect_admin('postrequirement');
		 }
	}
	else
	{
	$condition = array('buy_requirement.id'=>$reqId);
	$this->admin_model->deletePostrequirement(NULL,$condition);
	}
		 
	$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success',$this->lang->line('delete_success')));
	redirect_admin('postrequirement');
	   
	}//End of delete Post requirement function
	
	// --------------------------------------------------------------------
	
	
	
	function attachment_check()
	{
		
		if(isset($_FILES) and $_FILES['attachment']['name']=='')				
		return true;
			
		$config['upload_path'] 		='files/job_attachment/';
		$config['allowed_types'] 	='jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF|zip|ZIP|RAR|rar|doc|DOC|txt|TXT|xls|XLS|ppt|PPT|pdf|PDF|docx|xlsx|pptx';
		$config['max_size'] 		= $this->config->item('max_upload_size');
		$config['encrypt_name'] 	= TRUE;
		$config['remove_spaces'] 	= TRUE;
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('attachment'))
		{
			
			$this->data['file'] = $this->upload->data();			
			return true;			
		} else {
			$this->form_validation->set_message('attachment_check', $this->upload->display_errors($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag')));
			return false;
		}//If end 
	}//Function attachment_check End
	// --------------------------------------------------------------------
	

// For Description field (Check for Phone number) 
	function _phonenumber_check()
	{
		$description=$_POST['description'];
		//$reg = '/(\d)?(\s|-)?(\()?(\d){3}(\))?(\s|-){1}(\d){3}(\s|-){1}(\d){4}/';
		$reg="/\(?[0-9]{3}\)?[-. ]?[0-9]{3}[-. ]?[0-9]{3}/";
		//$reg="/^(083|086|085|086|087)\d{7}$/";

  		 if(preg_match($reg, $description)) {   
	                  $this->form_validation->set_message('_phonenumber_check','Phone numbers Not Allowed');
			  return FALSE;
		}
		else
		{
          	return TRUE;
         }
       
  	}



	
}
//Class Home End 

/* End of file home.php */
/* Location: ./application/controllers/administration/login.php */