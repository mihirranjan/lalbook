<?php

 /*
  ****************************************************************************
  ***                                                                      ***
  ***      BIDONN 1.0                                                      ***
  ***      File:  cancel_model.php                                         ***
  ***      Built: Mon June 12 17:58:48 2012                                ***
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

class Cancel_model extends CI_Model {
	 
  
	// Constructor 
	
	function __construct() 
	  {
	  	parent::__construct();
      }//Controller End
	
	// --------------------------------------------------------------------
		
	/**
	 * Get groups
	 *
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function getInfo($table,$fields,$conditions=array())
	 {
	 	if(count($conditions)>0)		
	 		$this->db->where($conditions);
			 
	 	$this->db->select($fields);
		$result = $this->db->get($table);
		return $result;
		
	 }//End of getInfo Function
	 
	 // --------------------------------------------------------------------
	
	/**
	 * Add Job cancellation cases
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function insertJobCase($insertData=array())
	 {
	 	$this->db->insert('job_cases', $insertData);
		 
	 }//End of insertJobCase Function
	 
	  // --------------------------------------------------------------------
	
	/**
	 * Insert values to any table
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function insertValues($table,$insertData=array())
	 {
	 	$this->db->insert($table, $insertData);
		 
	 }//End of insertValues Function
	 
	 // --------------------------------------------------------------------
		
	/**
	 * Get Job Cancellation/Dispute cases
	 *	
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function getJobCases($conditions=array(),$orCond='',$fields = '',$orderby = array(),$limit=array())
	 {
	 	
		if($orCond!='')
			$this->db->where($orCond, NULL, FALSE); 
			
		//Check For Conditions
	 	if(is_array($conditions) and count($conditions)>0)		
	 		$this->db->where($conditions);
		
		//Check for Order by
		if(is_array($orderby) and count($orderby)>0)
			$this->db->order_by($orderby[0], $orderby[1]);
			
		//Check For Limit	
		if(is_array($limit))		
		{
			if(count($limit)==1)
	 			$this->db->limit($limit[0]);
			else if(count($limit)==2)
				$this->db->limit($limit[0],$limit[1]);
		}
			
		$this->db->from('job_cases');
		$this->db->join('jobs', 'jobs.id = job_cases.job_id','left');
		//Check For Fields	 
		if($fields!='')
				$this->db->select($fields);
		else 		
	 		$this->db->select('jobs.job_name,jobs.id as job_id,job_cases.id,job_cases.user_id,job_cases.created,job_cases.case_reason,jobs.creator_id,jobs.employee_id,job_cases.case_type,job_cases.case_reason,job_cases.payment,job_cases.problem_description,job_cases.private_comments,job_cases.parent,job_cases.updates,job_cases.status,job_cases.admin_id,job_cases.review_type');
			
		$result = $this->db->get();
		//pr($result->result());exit;
		return $result;
		
	 }//End of getJobs Function
	 
	 // --------------------------------------------------------------------
	
	/**
	 * Update jobs case
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function updateJobCase($id=0,$updateData=array(),$conditions=array())
	 {
	 //pr($conditions);exit;
	 	if(is_array($conditions) and count($conditions)>0)		
	 		$this->db->where($conditions);
		else	
		    $this->db->where('id', $id);
	 	$this->db->update('job_cases', $updateData);
		 
	 }//End of updateJobCase Function
	 
	  // --------------------------------------------------------------------
	
	/**
	 * delete reviews
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function deleteReview($conditions=array())
	 {
	 	if(is_array($conditions) and count($conditions)>0)		
	 		$this->db->where($conditions);
		else	
		    $this->db->where('id', $id);
	 	$this->db->delete('reviews');
		 
	 }//End of deleteReview Function
}
// End cancel_model Class
   
/* End of file cancel_model.php */ 
/* Location: ./application/models/cancel_model.php */
?>