<?php

 /*
  ****************************************************************************
  ***                                                                      ***
  ***      BIDONN 1.0                                                      ***
  ***      File:  file_model.php 		                                   ***
  ***      Built: Mon June 14 12:18:59 2012                                ***
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


class File_model extends CI_Model {
	 
   
 	// Constructor 
	
	function __construct() 
	  {
	  	parent::__construct();
      }//Controller End
	
	// --------------------------------------------------------------------
		
	/**
	 * Get File
	 *
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function getFile($conditions=array())
	 {
		if(count($conditions)>0)		
	 		$this->db->where($conditions);
			
		$result = $this->db->get('files');
			return $result;
		
	 }//End of getFile Function
	 
	 // --------------------------------------------------------------------
		
	/**
	 * Delete file
	 *
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function deleteFile($conditions=array())
	 {
		if(count($conditions)>0)		
	 		$this->db->where($conditions);
			
		$result = $this->db->delete('files');
			return $result;
		
	 }//End of deleteFile Function
	 
	 // --------------------------------------------------------------------	
		
	/**
	 * Get getFileSize
	 *
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function getFileSize($conditions=array())
	 {
		if(count($conditions)>0)		
	 		$this->db->where($conditions);
			
		$this->db->select_sum('file_size','totalsize');
		$result = $this->db->get('files');
			return $result;
		
	 }//End of getFileSize Function
	 
	 // --------------------------------------------------------------------	
		
	/**
	 * Add postFile
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function postFile($insertData=array())
	 {
	 	$this->db->insert('files', $insertData);
		return;
		 
	 }//End of postFile Function
	 
	 // --------------------------------------------------------------------
		
		// --------------------------------------------------------------------
		
	/**
	 * Update File
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function updateFile($id=0,$updateData=array())
	 {
	 	$this->db->where('faqs.id', $id);
	 	$this->db->update('faqs', $updateData);
		 
	 }//End of updateFile Function 

	 
}
// End file_model Class
   
/* End of file_model.php */ 
/* Location: ../application/models/file_model.php */