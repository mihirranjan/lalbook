<?php

 /*
  ****************************************************************************
  ***                                                                      ***
  ***      BIDONN 1.0                                                      ***
  ***      File:  page_model.php                                           ***
  ***      Built: Mon June 13 16:25:15 2012                                ***
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


 class Page_model extends CI_Model {
	 
	/**
	 * Constructor 
	 *
	 */
	   public function __construct()
     {
         parent::__construct();
				
      }//Controller End
	
	// --------------------------------------------------------------------
		
	/**
	 * Add Pages
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function addpage($insertData=array())
	 {
	 	$this->db->insert('page', $insertData);
		 
	 }//End of addpages Function	
	 
	 // --------------------------------------------------------------------
	 
	 
	 /**
	 * Get Pages
	 *
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	
	 function getPages($conditions=array(),$like=array(),$like_or=array())
	 {
	 	//Check For like statement
	 	if(is_array($like) and count($like)>0)		
	 		$this->db->like($like);
			
		//Check For like statement
	 	if(is_array($like_or) and count($like_or)>0)		
	 		$this->db->or_like($like_or);
	
	 	if(count($conditions)>0)		
	 		$this->db->where($conditions);
		
		$this->db->from('page');
	 	$this->db->select('page.id,page.url,page.created,page.name,page.page_title,page.content,page.is_active');
		$result = $this->db->get();
		return $result;
		
	 }//End of getPages Function
   
	 
	 // --------------------------------------------------------------------
		
	/**
	 * Update Static Page
	 *
	 * @access	private
	 * @param	array	an associative array - for update key values
	 * @param	array	an associative array of update data
	 * @return	void
	 */
	 function updatePage($updateKey=array(),$updateData=array())
	 {
	 	 $this->db->update('page',$updateData,$updateKey);
		 
	 }//End of updateFaq Function 
	 
	 
	// --------------------------------------------------------------------
	
	
	/**
	 * delete page
	 *
	 * @access	private
	 * @param	array	an associative array of remove values
	 * @return	void
	 */
	 function deletePage($id=0,$conditions=array())
	 {
	 	if(is_array($conditions) and count($conditions)>0)		
	 		$this->db->where($conditions);
		else	
		    $this->db->where('id', $id);
		 $this->db->delete('page');
		 
	 }//End of deletePage Function
	 
	// --------------------------------------------------------------------

}
// End Page_model Class
   
/* End of file Page_model.php */ 
/* Location: ./application/models/Page_model.php */
