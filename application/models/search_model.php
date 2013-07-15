<?php 

/*
  ****************************************************************************
  ***                                                                      ***
  ***      BIDONN 1.0                                                      ***
  ***      File:  search_model.php                                         ***
  ***      Built: Mon June 18 18:33:45 2012                                ***
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

class Search_model extends CI_Model {

 	// Constructor 
 	function __construct() 
 	  {

	  	parent::__construct();

      }//Controller End

   	// --------------------------------------------------------------------
 	/**

	 * Get jobs

	 *	

	 * @access	private

	 * @param	array	conditions to fetch data

	 * @return	object	object with result set

	 */

	 function getJobs($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby = array(),$like1=array())

	 {

	 	//Check For Conditions

	 	if(is_array($conditions) and count($conditions)>0)		

	 		$this->db->where($conditions);

 		//Check For like statement

	 	if(is_array($like) and count($like)>0)

			$this->db->or_like($like);	

		if(is_array($like1) and count($like1)>0 and $like1 !='')

			$this->db->like($like1);	

		//pr($like1);	
 
		//Check For Limit	

		if(is_array($limit))		

		{

			if(count($limit)==1)

	 			$this->db->limit($limit[0]);

			else if(count($limit)==2)

				$this->db->limit($limit[0],$limit[1]);

		}	

		//Check for Order by
		if(is_array($orderby) and count($orderby)>0)
			$this->db->order_by($orderby[0], $orderby[1]);

		$this->db->from('jobs');

		$this->db->join('users', 'users.id = jobs.creator_id','left');

		//Check For Fields	 

		if($fields!='')

				$this->db->select($fields);

		else 		

	 		$this->db->select('jobs.id,jobs.job_name,jobs.description,jobs.budget_min,jobs.job_status,jobs.budget_max,jobs.job_categories,jobs.creator_id,jobs.is_feature,jobs.is_urgent,jobs.is_hide_bids,jobs.created,jobs.is_private,jobs.private_users,users.user_name');

			

		$result = $this->db->get();

		
		return $result;

		

	 }//End of getjobs Function
	 
	 
	 
	 
	 function getbuyRequirement($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby = array(),$like1=array())

	 {

	 	//Check For Conditions

	 	if(is_array($conditions) and count($conditions)>0)		

	 		$this->db->where($conditions);

 		//Check For like statement

	 	if(is_array($like) and count($like)>0)

			$this->db->or_like($like);	

		if(is_array($like1) and count($like1)>0 and $like1 !='')

			$this->db->like($like1);	

		//pr($like1);	
 
		//Check For Limit	

		if(is_array($limit))		

		{

			if(count($limit)==1)

	 			$this->db->limit($limit[0]);

			else if(count($limit)==2)

				$this->db->limit($limit[0],$limit[1]);

		}	

		//Check for Order by
		if(is_array($orderby) and count($orderby)>0)
			$this->db->order_by($orderby[0], $orderby[1]);

		$this->db->from('buy_requirement');

		$this->db->join('users', 'users.id = buy_requirement.creator_id','left');

		//Check For Fields	 

		if($fields!='')

				$this->db->select($fields);

		else 		

	 		$this->db->select('buy_requirement.id as buy_id,buy_requirement.creator_id,buy_requirement.looking_for,buy_requirement.requirements,buy_requirement.category,buy_requirement.description,buy_requirement.budget,buy_requirement.end_date,buy_requirement.requirement_image,buy_requirement.created,users.user_name,
	 users.id as userid,users.email,users.country_symbol,users.state,users.credit');

			

		$result = $this->db->get();

		
		return $result;

		

	 }

	  function get_results($search_term='default')
    {
        // Use the Active Record class for safer queries.
        $this->db->select('*');
        $this->db->from('members');
        $this->db->like('username',$search_term);

        // Execute the query.
        $query = $this->db->get();

        // Return the results.
        return $query->result_array();
    }

	/**

	 * getUsers

	 *	

	 * @access	private

	 * @param	array	conditions to fetch data

	 * @return	object	object with result set

	 */

	 function getUsers($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby = array(),$like1=array())

	 {
 
	 	//Check For Conditions

	 	if(is_array($conditions) and count($conditions)>0)		

	 		$this->db->where($conditions);

			

		//Check For like statement

	 	if(is_array($like) and count($like)>0 and $like !='')
 
			$this->db->or_like($like);	

		if(is_array($like1) and count($like1)>0 and $like1 !='')
 
			$this->db->like($like1);		

		//$this->db->like($like);	

		//pr($like1);

		//Check For Limit	

		if(is_array($limit))		

		{

			if(count($limit)==1)

	 			$this->db->limit($limit[0]);

			else if(count($limit)==2)

				$this->db->limit($limit[0],$limit[1]);

		}	

		//Check for Order by
		if(is_array($orderby) and count($orderby)>0)
			$this->db->order_by($orderby[0], $orderby[1]);

		$this->db->from('users');
		$this->db->join('user_categories', 'user_categories.user_id = users.id','left');	
		
		if($fields!='')
				$this->db->select($fields);
		else 		
	 		$this->db->select('users.id,user_categories.user_categories,users.user_name,users.name,users.role_id,users.country_symbol,users.message_notify,users.password,users.email,users.city,users.state,users.profile_desc,users.rate,users.job_notify,users.user_status,users.activation_key,users.created,users.last_activity,users.num_reviews,users.user_rating');
		 
		$result = $this->db->get();
		

		return $result;

		

	 }//End of getUsers Function
	 
	 

     
	 /**

	 * getUsers

	 *	
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */

	 function getSearch($conditions=array())
	 {
	 	if(is_array($conditions) and count($conditions)>0)		
	 		$this->db->where($conditions);
			
	    $this->db->from('search_keyword');
		$this->db->group_by('keyword');
		$this->db->select('search_keyword.id,search_keyword.keyword,search_keyword.type');
		$result = $this->db->get();
		
		return $result;
	 } //End Function
	 
	/**

	 * getUsers

	 *	
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */

	 function getCategory($conditions=array())
	 {
	 	if(is_array($conditions) and count($conditions)>0)		
	 		$this->db->where($conditions);
			
	    $this->db->from('categories');
		
		$this->db->select('categories.id,categories.category_name');
		$result = $this->db->get();
		
		return $result;
	 } //End Function
	 
	 
	/**
	 * insertSearch

	 *	
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */

	 function insertSearch($data=array())
	 {
	 	$this->db->insert('search_keyword',$data);
	 } //End Function
	  
	  
	 /**
	 * getUsers

	 *	
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */

	 function deleteSearch($conditions=array())
	 {
	 	if(is_array($conditions) and count($conditions)>0)		
	 		$this->db->where($conditions);
		$this->db->delete('search_keyword');
	 } //End Function 
	 
	 
}

// End Search_model Class

   

/* End of file Search_model.php */ 

/* Location: ./application/models/Search_model.php */