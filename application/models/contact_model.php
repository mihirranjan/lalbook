<?php

/*
  ****************************************************************************
  ***                                                                      ***
  ***      BIDONN 1.0                                                      ***
  ***      File:  contact_model.php                                        ***
  ***      Built: Mon June 12 13:25:50 2012                                ***
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

 class Contact_model extends CI_Model {
	 
	
	  // Constructor 
	
	  function __construct() 
	  {
		parent::__construct();
				
      }//Controller End
	 
	// --------------------------------------------------------------------
		
	 /**
	 * Add contact post information 
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function insertContactPost($insertData=array())
	 {
	 	$this->db->insert('contacts', $insertData);
		return;
	 }//End of insertContactPost Function
	 
	 
}
// End Contact_model Class
   
/* End of file Contact_model.php */ 
/* Location: ./application/models/Contact_model.php */