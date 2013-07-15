<?php

/*
  ****************************************************************************
  ***                                                                      ***
  ***      BIDONN 1.0                                                      ***
  ***      File:  logout.php                                               ***
  ***      Built: Mon June 25 14:51:45 2012                                ***
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

class Logout extends CI_Controller {
	   
   
	// Constructor 
	
	function __construct()
	{
	   parent::__construct();
	   
	   //Check For Admin Logged in
		if(!isAdmin())
			redirect_admin('login');
			
		//load language
		$this->lang->load('admin/logout',$this->config->item('language_code'));	
		
		//Load Models Required
		$this->load->model('auth_model');
		$this->load->model('common_model');	

	} //Controller End 
	
	// --------------------------------------------------------------------
	
	/**
	 * Clears Admin Session.
	 *
	 * @access	private
	 * @param	nil
	 * @return	void
	 */
	function index()
	{	
		$this->auth_model->clearAdminSession();	
		
		$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success',$this->lang->line('logout_success')));
		redirect_admin('login');
		
	}//End of index function
	
} 
//Class Logout End

/* End of file logout.php */
/* Location: ./application/controllers/administration/logout.php */