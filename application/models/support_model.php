<?php

/*
  ****************************************************************************
  ***                                                                      ***
  ***      BIDONN 1.0                                                      ***
  ***      File:  support_model.php                                        ***
  ***      Built: Mon June 06 11:36:45 2012                                ***
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

	 class Support_model extends CI_Model {
	 
	
	 // Constructor 
	 
	  function __construct() 
	  {
		parent::__construct();
		
		//Load Neccessary Model
		$this->load->model('user_model');
		// load model
	    $this->load->model('page_model');
	    $this->load->model('auth_model');
				
       }//Controller End
	  
	// --------------------------------------------------------------------
	
	 //
	 function getTicketswithUsers($conditons=array(),$limit)
	 {
		if(count($conditons)>0)
		{
	 		$this->db->where($conditons);
		}	
		if(is_array($limit))		
		{
			if(count($limit)==1)
	 			$this->db->limit($limit[0]);
			else if(count($limit)==2)
				$this->db->limit($limit[0],$limit[1]);
		}	
		$this->db->from('support');
		$this->db->join('users','users.id=support.user_id');
		$this->db->join('roles','users.role_id=roles.id');
		$this->db->select('support.id,roles.role_name,users.user_name,users.name,users.role_id,users.country_symbol,users.message_notify,users.password,users.email,users.city,users.state,users.profile_desc,users.rate,users.job_notify,users.user_status,users.activation_key,users.created,support.callid,support.subject,support.category,support.description,support.priority,support.status,support.user_id,support.reply');
		$result=$this->db->get();
		
		//pr($result);
		return $result;
	 }
	}
	
?>