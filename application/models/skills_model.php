<?php

/*
  ****************************************************************************
  ***                                                                      ***
  ***      BIDONN 1.0                                                 	   ***
  ***      File:  skills_model.php                                         ***
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

class Skills_model extends CI_Model {
	 
  
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
	 function getGroups($conditions=array())
	 {
	 	if(count($conditions)>0)		
	 		$this->db->where($conditions);
			 
	 	$this->db->select('groups.id,groups.group_name,groups.descritpion,groups.created,groups.modified');
		$result = $this->db->get('groups');
		return $result;
		
	 }//End of getGroups Function
	 
	 function getGroup($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby = array())
	 {
	 	//Check For Conditions
	 	if(is_array($conditions) and count($conditions)>0)		
	 		$this->db->where($conditions);
			
		//Check For like statement
	 	if(is_array($like) and count($like)>0)		
	 		$this->db->like($like);	
		
		
		//Check For Limit	
		if(is_array($limit))		
		{
			if(count($limit)==1)
	 			$this->db->limit($limit[0]);
			else if(count($limit)==2)
				$this->db->limit($limit[0],$limit[1]);
		}
		//pr($orderby);
		//Check for Order by
		if(is_array($orderby) and count($orderby)>0)
			$this->db->order_by($orderby[0], $orderby[1]);
			 
	 	$this->db->select('groups.id,groups.group_name,groups.descritpion,groups.created,groups.modified');
		$result = $this->db->get('groups');
		return $result;
		
	 }//End of getGroups Function
	 
	// --------------------------------------------------------------------
	
	/**
	 * Get bookmark
	 *
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function getBookmark($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby = array())
	 {
	 	
		//Check For Conditions
	 	if(is_array($conditions) and count($conditions)>0)		
	 		$this->db->where($conditions);
			
		//Check For like statement
	 	if(is_array($like) and count($like)>0)		
	 		$this->db->like($like);	
		
		
		//Check For Limit	
		if(is_array($limit))		
		{
			if(count($limit)==1)
	 			$this->db->limit($limit[0]);
			else if(count($limit)==2)
				$this->db->limit($limit[0],$limit[1]);
		}
		//pr($orderby);
		//Check for Order by
		if(is_array($orderby) and count($orderby)>0)
			$this->db->order_by($orderby[0], $orderby[1]);
			
		$this->db->from('bookmark');
		$this->db->join('jobs', 'bookmark.job_id = jobs.id','left');
		if($fields!='')
				$this->db->select($fields);
		else 		
	 		$this->db->select('jobs.id,jobs.job_name,jobs.job_status,jobs.description,jobs.budget_min,jobs.budget_max,jobs.job_categories,jobs.creator_id,jobs.is_feature,jobs.is_urgent,jobs.is_hide_bids,jobs.created,jobs.is_private,jobs.is_private,private_users,jobs.enddate,jobs.employee_id,jobs.job_award_date,jobs.job_award_date,jobs.checkstamp,jobs.owner_rated,jobs.job_paid,jobs.flag,bookmark.id,bookmark.creator_name,bookmark.job_id,bookmark.job_name,bookmark.job_creator');
			
		$result = $this->db->get();
		return $result;		
		
	 }//End of getGroups Function
	// --------------------------------------------------------------------
	
		
	/**
	 * Get getGroupsWithCategory
	 *
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function getGroupsWithCategory()
	 {
	 	//Get Groups
		$query 							=$this->getGroups();
		
		//Return Data
		$data 							=array();
		
	 	if($query->num_rows()>0)
		{
			$i=0;
			foreach($query->result() as $row)
			{
				$data[$i]['group_id']		= $row->id;
				$data[$i]['group_name']		= $row->group_name;
				$data[$i]['descritpion']	= $row->descritpion;
				$data[$i]['created']		= $row->created;
				$data[$i]['modified']		= $row->modified;
				$data[$i]['num_categories']	= 0;
				
				$conditions  		= array('group_id'=>$row->id);
				$query_categories 	= $this->getCategories($conditions);
				
				
				//Check for query categories availability
				if($query_categories->num_rows()>0)
				{
					$data[$i]['num_categories']	= $query_categories->num_rows();
					$data[$i]['categories'] = $query_categories;
					
				} //If End - Checks For categories availability
				$i++;
			}
		}//If End - check for group avaliability

		return $data;
	 }//End of getGroupsWithCategory Function
	 
	 // --------------------------------------------------------------------
		
	/**
	 * Add group
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function addGroup($insertData=array())
	 {
	 	$this->db->insert('groups', $insertData);
		 
	 }//End of addGroup Function
	 
 	// --------------------------------------------------------------------
	
	/**
	 * delete jobs
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function deleteGroups($id=0,$conditions=array())
	 {
	 	if(is_array($conditions) and count($conditions)>0)		
	 		$this->db->where($conditions);
		else	
		    $this->db->where('id', $id);
	 	$this->db->delete('groups');
		 
	 }//End of deletejobs Function
	 // --------------------------------------------------------------------
		
	/**
	 * Convert Categories Id to name
 	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function convertCategoryIdsToName($categoryIds=array())
	 {
	 	$data = array();
		if(count($categoryIds)>0)
		{
			foreach($categoryIds as $categoryId)
			{
				$condition 	= array('categories.id'=>$categoryId);
				$fields 	='categories.id,categories.category_name';
				$query 		= $this->getCategories($condition,$fields);
				$row 		=  $query->row(); 
				
				if($query->num_rows() > 0)
				$data[$categoryId] = $row->category_name;
				//pr($data[$categoryId]);
			}//ForEach End -Traverse Categories		
		}	 	
		return $data;			 
	 }//End of addGroup Function
	 
	 // --------------------------------------------------------------------
		
	/**
	 * Add job
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function createProject($insertData=array())
	 {
	 	$this->db->insert('jobs', $insertData);
		 
	 }//End of addGroup Function
	 
	 // --------------------------------------------------------------------
		
	/**
	 * Add Popular searches
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function addPopularSearch($insertData=array())
	 {
	 	$this->db->insert('popular_search', $insertData);
		 
	 }//End of addPopularSearch Function
	 
	 // --------------------------------------------------------------------
		
	/**
	 * Get Popular searches
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function getPopularSearch($type='')
	 {
	 	$query = "SELECT keyword,count(*) as cnt FROM popular_search WHERE `type` = '".$type."' GROUP BY `keyword` ORDER BY cnt DESC LIMIT 10";
		
	  	$que = $this->db->query($query);
	 	
		return $que;
		 
	 }//End of addPopularSearch Function
	 
	// --------------------------------------------------------------------
	
	/**
	 * Get jobsLists for transfer money
	 *	
	 * @access	private
	 * @param	nil
	 * @return	object	object with result set
	 */
	 function getpreviewJobs($conditions=array())
	 {
	 	if(count($conditions)>0)		
	 		$this->db->where($conditions);
		$this->db->from('jobs_preview');
		$this->db->select('jobs_preview.id,jobs_preview.job_name,jobs_preview.job_status,jobs_preview.description,,jobs_preview.country,jobs_preview.state,jobs_preview.city,jobs_preview.budget_min,jobs_preview.budget_max,jobs_preview.job_categories,jobs_preview.creator_id,jobs_preview.is_feature,jobs_preview.is_urgent,jobs_preview.is_hide_bids,jobs_preview.created,jobs_preview.enddate,jobs_preview.employee_id,jobs_preview.job_award_date,jobs_preview.flag,jobs_preview.contact,jobs_preview.salary,jobs_preview.salarytype');
			
		$result = $this->db->get();
		//pr($result->result());exit;
		return $result;
		
	 }//End of getpreviewJobs Function
	 
	 // --------------------------------------------------------------------
	
	
	
	/**
	 * Add job
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function previewJob($insertData=array())
	 {
	 	$this->db->insert('jobs_preview', $insertData);
		 
	 }//End of addGroup Function
	 
	// --------------------------------------------------------------------
	
	/**
	 * delete projects
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function deletepreviewProject($conditions=array())
	 {
	 	if(is_array($conditions) and count($conditions)>0)		
	 		$this->db->where($conditions);
	 	$this->db->delete('jobs_preview');
		 
	 }//End of deleteProjects Function
	 
	 // --------------------------------------------------------------------
	
	/**
	 * Add draft Job
	 *
	 * @access	private
	 * @param	array
	 * @return	void
	 */
	 function draftJob($insertData=array())
	 {
	 	$this->db->insert('draftjobs', $insertData);
		 
	 }//End of draftJob Function
	 
	// --------------------------------------------------------------------
	
	/**
	 * Add Bids
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function createBids($insertData=array())
	 {
	 	$this->db->insert('bids', $insertData);
		 
	 }//End of addGroup Function
	 
	 // --------------------------------------------------------------------
	
	/**
	 * Update Bids
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function updateBids($id=0,$updateData=array(),$conditions=array())
	 {
	 	if(count($conditions)>0 && is_array($conditions))		
	 		$this->db->where($conditions);
	    else		
		    $this->db->where('id', $id);
	 	$this->db->update('bids', $updateData);
		 
	 }//End of addGroup Function
	 
	  function updateAmount($id=0,$updateData=array(),$conditions=array())
	 {
	 	if(count($conditions)>0 && is_array($conditions))		
	 		$this->db->where($conditions);
	    else		
		    $this->db->where('id', $id);
	 	$this->db->update('buy_requirement', $updateData);
		 
	 }
	// --------------------------------------------------------------------
		
	/**
	 * Edit group
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function updateGroup($id=0,$updateData=array())
	 {
	 	$this->db->where('groups.id', $id);
	 	$this->db->update('groups', $updateData);
		 
	 }//End of editGroup Function
	 
	// --------------------------------------------------------------------
		
	/**
	 * Update category
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function updateCategory($id=0,$updateData=array())
	 {
	 	$this->db->where('categories.id', $id);
	 	$this->db->update('categories', $updateData);
		 
	 }//End of editGroup Function 
	 
 	 // --------------------------------------------------------------------
	
	/**
	 * delete projects
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function deleteCategory($id=0,$conditions=array())
	 {
	 	if(is_array($conditions) and count($conditions)>0)		
	 		$this->db->where($conditions);
		else	
		    $this->db->where('id', $id);
	 	$this->db->delete('categories');
		 
	 }//End of deleteProjects Function
	 // --------------------------------------------------------------------
		
	/**
	 * Add category
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function addCategory($insertData=array())
	 {
	 	$this->db->insert('categories', $insertData);
		 
	 }//End of getGroups Function
	 
	 // --------------------------------------------------------------------
		
	/**
	 * Get Categories
	 *
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function getCategories($conditions=array(),$fields='')
	 {
	 	//Check For Conditions
	 	if(count($conditions)>0)		
	 		$this->db->where($conditions);
		
		$this->db->from('categories');
		$this->db->join('groups', 'groups.id = categories.group_id','left');
		//Check For Fields	 
		if($fields!='')
				$this->db->select($fields);
		else 		
	 		$this->db->select('categories.id,categories.group_id,categories.category_name,groups.group_name, categories.description, categories.attachment_url,categories.attachment_name,categories.page_title, categories.meta_keywords, categories.meta_description, categories.is_active, categories.created, categories.modified');
			
		$result = $this->db->get();
		return $result;
		
	 }//End of getCategories Function
	 
	 function getCategory($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby=array())
	 {
	 	//Check For Conditions
	 	if(is_array($conditions) and count($conditions)>0)		
	 		$this->db->where($conditions);
			
		//Check For like statement
	 	if(is_array($like) and count($like)>0)		
	 		$this->db->like($like);	
		
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
		
		$this->db->from('categories');
		$this->db->join('groups', 'groups.id = categories.group_id','left');
		//Check For Fields	 
		if($fields!='')
				$this->db->select($fields);
		else 		
	 		$this->db->select('categories.id,categories.group_id,categories.category_name,groups.group_name, categories.description, categories.page_title, categories.meta_keywords, categories.meta_description, categories.is_active, categories.created, categories.modified');
			
		$result = $this->db->get();
		return $result;
		
	 }//End of getCategories Function
	 
 	// --------------------------------------------------------------------
		
	/**
	 * Get Jobs
	 *	
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function getJobs1($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby = array())
	 {
	 	//Check For Conditions
	 	if(is_array($conditions) and count($conditions)>0)		
	 		$this->db->where($conditions);
			
		//Check For like statement
	 	if(is_array($like) and count($like)>0)		
	 		$this->db->like($like);	
			
		//Check For Limit	
		if(is_array($limit))		
		{
			if(count($limit)==1)
	 			$this->db->limit($limit[0]);
			else if(count($limit)==2)
				$this->db->limit($limit[0],$limit[1]);
		}	
		//pr($orderby);
		//Check for Order by
		if(is_array($orderby) and count($orderby)>0)
			$this->db->order_by($orderby[0], $orderby[1]);
			
		$this->db->from('buy_requirement');
		$this->db->join('users', 'users.id = buy_requirement.creator_id','left');
		//Check For Fields	 
		if($fields!='')
				$this->db->select($fields);
		else 		
	 		$this->db->select('buy_requirement.id as buy_id,buy_requirement.looking_for,buy_requirement.creator_id,buy_requirement.category,buy_requirement.description,buy_requirement.budget,buy_requirement.end_date,buy_requirement.created,buy_requirement.awarded_user,buy_requirement.notification_status,users.user_name,users.id as userid,users.user_rating,users.num_reviews,users.email,buy_requirement.job_status,buy_requirement.awarded_user,buy_requirement.requirements,users.city,buy_requirement.status');	
		
		$result =$this->db->get();
		//print_r($this->db->last_query());exit;
		return $result;
		
	 }//End of getjobs Function
	 
	 
	 
	 function getJobs($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby = array())

	 {

	 	//Check For Conditions

	 	if(is_array($conditions) and count($conditions)>0)		

	 		$this->db->where($conditions);

			

		//Check For like statement

	 	if(is_array($like) and count($like)>0)		

	 		$this->db->like($like);	

			

		//Check For Limit	

		if(is_array($limit))		

		{

			if(count($limit)==1)

	 			$this->db->limit($limit[0]);

			else if(count($limit)==2)

				$this->db->limit($limit[0],$limit[1]);

		}	

		//pr($orderby);

		//Check for Order by

		if(is_array($orderby) and count($orderby)>0)

			$this->db->order_by($orderby[0], $orderby[1]);

			

		$this->db->from('jobs');

		$this->db->join('users', 'users.id = jobs.creator_id','left');

		//Check For Fields	 

		if($fields!='')

				$this->db->select($fields);

		else 		

	 		$this->db->select('jobs.id,jobs.job_name,jobs.job_status,jobs.description,jobs.budget_min,jobs.budget_max,jobs.job_categories,jobs.creator_id,jobs.is_feature,jobs.is_urgent,jobs.is_hide_bids,jobs.created,jobs.attachment_name,jobs.attachment_url,users.user_name,jobs.enddate,jobs.employee_id,jobs.job_award_date,jobs.job_award_date,jobs.contact,jobs.salary,jobs.flag,jobs.escrow_due,users.id as userid,jobs.checkstamp,jobs.owner_rated,jobs.job_paid,jobs.is_private,jobs.private_users,users.user_rating,users.num_reviews,users.email,users.logo,jobs.country,jobs.state,jobs.city');	

		$result =$this->db->get();

		

		return $result;

		

	 }//End of getjobs Function
	 
	  function getSearchJobs($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby = array())

	 {

	 	//Check For Conditions

	 	if(is_array($conditions) and count($conditions)>0)		

	 		$this->db->where($conditions);

			
//print_r($like);
		//Check For like statement

	 	if(is_array($like) and count($like)>0)		

	 		$this->db->like($like);	

			

		//Check For Limit	

		if(is_array($limit))		

		{

			if(count($limit)==1)

	 			$this->db->limit($limit[0]);

			else if(count($limit)==2)

				$this->db->limit($limit[0],$limit[1]);

		}	

		//pr($orderby);

		//Check for Order by

		if(is_array($orderby) and count($orderby)>0)

			$this->db->order_by($orderby[0], $orderby[1]);

			

		$this->db->from('buy_requirement');

		//$this->db->join('users', 'users.id = jobs.creator_id','left');

		//Check For Fields	 

		if($fields!='')

				$this->db->select($fields);

		else 		

	 		$this->db->select('buy_requirement.id,buy_requirement.looking_for,buy_requirement.category,buy_requirement.budget,buy_requirement.description');	

		$result =$this->db->get();

		print_r($this->db->last_query());

		return $result;

		

	 }//End of getjobs Function
	 // --------------------------------------------------------------------
		
	/**
	 * Get Projects for RSS
	 *	
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function getRssProjects($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby = array(),$orlike=array())
	 {
		//Check For Conditions
	 	if(is_array($conditions) and count($conditions)>0)		
	 		$this->db->where($conditions);
			
		//Check For like statement
	 	if(is_array($like) and count($like)>0)		
	 		$this->db->like($like);	
		
		//Check For orlike statement
	 	if(is_array($orlike) and count($orlike)>0){
			$app = '';
			foreach($orlike as $orl){
				$this->db->or_like('jobs.job_categories',$orl);
			}
		}
		//echo $app;
		//exit;
		
		//Check For Limit	
		if(is_array($limit))		
		{
			if(count($limit)==1)
	 			$this->db->limit($limit[0]);
			else if(count($limit)==2)
				$this->db->limit($limit[0],$limit[1]);
		}
		//pr($orderby);
		//Check for Order by
		if(is_array($orderby) and count($orderby)>0)
			$this->db->order_by($orderby[0], $orderby[1]);
			
		$this->db->from('jobs');
		$this->db->join('users', 'users.id = jobs.creator_id','left');
		//Check For Fields	 
		if($fields!='')
				$this->db->select($fields);
		else 		
	 		$this->db->select('jobs.id,jobs.job_name,jobs.job_status,jobs.description,jobs.country,jobs.state,jobs.city,jobs.budget_min,jobs.budget_max,jobs.job_categories,jobs.creator_id,jobs.is_feature,jobs.is_urgent,jobs.is_hide_bids,jobs.created,users.user_name,jobs.enddate,jobs.employee_id,jobs.job_award_date,users.id as userid,jobs.checkstamp,jobs.owner_rated,jobs.job_paid,users.user_rating,users.num_reviews');
			
		$result = $this->db->get();
		//pr($result->result());exit;
		return $result;
		
	 }//End of getjobs Function
	 
	 // --------------------------------------------------------------------
		
	/**
	 * Get jobs
	 *	
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function getLatestJobs($limit=array())
	 {
	 	//Check For Conditions
	$conditions = array('jobs.job_status' => '0','flag'=>'0');
	 	$this->db->where($conditions);
			
		//Check For Limit	
		if(is_array($limit))		
		{
			if(count($limit)==1)
	 			$this->db->limit($limit[0]);
			else if(count($limit)==2)
				$this->db->limit($limit[0],$limit[1]);
		}	
		//pr($orderby);
		$this->db->order_by('jobs.created','desc');
			
		$this->db->from('jobs');
		$this->db->join('users', 'users.id = jobs.creator_id','left');
		//Check For Fields	 
	 	$this->db->select('jobs.id,jobs.job_name,jobs.job_status,jobs.description,jobs.country,jobs.state,jobs.city,jobs.budget_min,jobs.budget_max,jobs.job_categories,jobs.creator_id,jobs.is_feature,jobs.is_urgent,jobs.is_hide_bids,jobs.created,users.user_name,jobs.enddate,jobs.employee_id,jobs.job_award_date,jobs.job_award_date,users.id as userid,jobs.checkstamp,jobs.owner_rated,jobs.job_paid,jobs.is_private,jobs.private_users,users.user_rating,users.num_reviews');
			
		$result = $this->db->get();
		
		return $result;
		
	 }//End of getjobs Function

	 /**
	 * Update jobs
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function updateDraftProject($updateData=array(),$conditions=array())
	 {
	// pr($conditions);exit;
	 	if(is_array($conditions) and count($conditions)>0)		
	 		$this->db->where($conditions);
		else	
		    $this->db->where('id', $id);
	 	$this->db->update('draftjobs', $updateData);
		 
	 }//End of updatejobs Function
	 // --------------------------------------------------------------------

	 
	 // --------------------------------------------------------------------
	
	/**
	 * delete jobs
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function deleteDraftProject($conditions=array())
	 {
	 	if(is_array($conditions) and count($conditions)>0)		
	 		$this->db->where($conditions);
		else	
		    $this->db->where('id', $id);
	 	$this->db->delete('draftprojects');
		 
	 }//End of deletejobs Function
	 


	 // --------------------------------------------------------------------
	
	 

	 

	 /**
	 * Get jobs
	 *	
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function getDraft($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby = array())
	 {
	 	//Check For Conditions
	 	if(is_array($conditions) and count($conditions)>0)		
	 		$this->db->where($conditions);
			
		//Check For like statement
	 	if(is_array($like) and count($like)>0)		
	 		$this->db->like($like);	
		
		//Check For Limit	
		if(is_array($limit))		
		{
			if(count($limit)==1)
	 			$this->db->limit($limit[0]);
			else if(count($limit)==2)
				$this->db->limit($limit[0],$limit[1]);
		}	
		//pr($orderby);
		//Check for Order by
		if(is_array($orderby) and count($orderby)>0)
			$this->db->order_by($orderby[0], $orderby[1]);
			
		$this->db->from('draftjobs');
		$this->db->join('users', 'users.id = draftjobs.creator_id','left');
		//Check For Fields	 
		if($fields!='')
				$this->db->select($fields);
		else 		
	 		$this->db->select('draftjobs.id,draftjobs.job_name,draftjobs.job_status,draftjobs.description,draftjobs.country,draftjobs.state,draftjobs.city,draftjobs.budget_min,draftjobs.budget_max,draftjobs.job_categories,draftjobs.creator_id,draftjobs.is_feature,draftjobs.is_urgent,draftjobs.is_hide_bids,draftjobs.created,users.user_name,draftjobs.enddate,draftjobs.employee_id,draftjobs.flag,draftjobs.salary,draftjobs.contact,draftjobs.salarytype,users.id as userid,draftjobs.checkstamp,draftjobs.employee_rated,draftjobs.owner_rated,draftjobs.job_paid,draftjobs.is_private,draftjobs.private_users');
			
		$result = $this->db->get();
		//pr($result->result());exit;
		return $result;
		
	 }//End of getDraft Function
	 
	 // --------------------------------------------------------------------
	 
	 
		
	/**
	 * Get Projects
	 *	
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function getJobsByEmployee($conditions=array(),$fields='',$like=array(),$limit=array())
	 {
	 	//Check For Conditions
	 	if(is_array($conditions) and count($conditions)>0)	
	 		$this->db->where($conditions);
			
		//Check For like statement
	 	if(is_array($like) and count($like)>0)		
	 		$this->db->like($like);	
		
		//Check For Limit	
		if(is_array($limit))		
		{
			if(count($limit)==1)
	 			$this->db->limit($limit[0]);
			else if(count($limit)==2)
				$this->db->limit($limit[0],$limit[1]);
		}	
			
		$this->db->from('jobs');
		$this->db->join('users', 'users.id = jobs.employee_id','left');
		//Check For Fields	 
		if($fields!='')
				$this->db->select($fields);
		else 		
	 		$this->db->select('jobs.id,jobs.job_name,jobs.job_status,jobs.description,jobs.country,jobs.state,jobs.city,jobs.budget_min,jobs.budget_max,jobs.job_categories,jobs.creator_id,jobs.is_feature,jobs.is_urgent,jobs.is_hide_bids,jobs.created,users.user_name,jobs.enddate,jobs.employee_id,jobs.job_award_date,users.id as userid,jobs.checkstamp,jobs.owner_rated,jobs.job_paid,jobs.is_private,jobs.flag');
			
		$result = $this->db->get();
		//pr($result->result());exit;
		return $result;
		
	 }//End of getjobs Function
	 
	 // --------------------------------------------------------------------
		
	/**
	 * getReviews
	 *	
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function getReviews($conditions=array())
	 {
	 	//Check For Conditions
	 	if(is_array($conditions) and count($conditions)>0)		
	 		$this->db->where($conditions);
			
		
		
			
		$this->db->from('reviews');
		$this->db->join('users', 'users.id = reviews.reviewer_id','left');
		$this->db->join('buy_requirement', 'buy_requirement.id=reviews.job_id','inner');
		//Check For Fields	 
		
	 		$this->db->select('reviews.id,reviews.rating,reviews.employee_id,reviews.review_time,reviews.owner_id,reviews.comments,reviews.userid,reviews.reviewer_id, users.name,reviews.job_id,buy_requirement.looking_for,buy_requirement.budget,users.user_name,users.logo,reviews.hold,reviews.awarded_amount');
			 $this->db->order_by('hold', 'DESC');
		$result = $this->db->get();
	//print_r($this->db->last_query());
		//print_r($result->result());exit;
		return $result;
		
	 }//End of getReviews Function
     
     /**
      * Add a review by the user
      * @param integer owner_id
      * @param integer emp_id
      * @param string msg
      * @param integer rate
      */
     function add_review($job_id, $owner_id, $emp_id, $userid, $reviewer_id, $msg, $hold, $by_owner, $rate = null) {
        $data = array(
            'job_id' => $job_id,
            'owner_id' => $owner_id,
            'employee_id' => $emp_id,
            'userid' => $userid,
            'reviewer_id' => $reviewer_id,
            'comments' => $msg,
            'rating' => $rate,
            'hold' => $hold,
            'by_owner' => $by_owner,
            'review_time' => time()
        );
        
        if($this->db->insert('reviews', $data)) {
            return true;
        }
        else {
            return false;
        }
     }
     
     function getMaxReviewHold($owner_id, $employee_id) {
        $condition = array(
            'owner_id' => $owner_id,
            'employee_id' => $employee_id
        );
        $this->db->where($condition);
        $this->db->from('reviews');
        $this->db->select_max('hold');
        $query = $this->db->get();
        $max_hold = $query->row()->hold;
        
        return $max_hold;
     }
     
     /**
      * Check if the review is already done by the user
      * 
      * @param integer job_id
      * @param integer by_owner
      *
      */
     function isReviewed($job_id, $by_owner) {
        $sql = "select id from reviews where job_id = $job_id and by_owner = $by_owner";
        $query = $this->db->query($sql);
        $num_rows = $query->num_rows();
        
        if($num_rows > 0) {
            return 1;
        }
        else {
            return 0;
        }
     }
	 
	 // --------------------------------------------------------------------
	
	
	/**
	 * Get Top employee List
	 *
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 
	 function topEmployees($limit=array())
	 {
	 	$conditions = array('role_id' => '2','users.user_status' => '1');
	 	$users = $this->user_model->getUsers($conditions);

		$uarray = array();
		$i = 0;
		foreach($users->result() as $user){
			if($user->user_rating != 0)
			$uarray[$user->id] = $user->user_rating * $user->num_reviews;
			$i++;
		}
		arsort($uarray);
		return $uarray;
	 }//End of topEmployees Function
	 
	 // --------------------------------------------------------------------
	
	
	/**
	 * Get Top Owner List
	 *
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function topOwners()
	 {
	 	
		$conditions = array('role_id' => '1','users.user_status' => '1');
	 	$users = $this->user_model->getUsers($conditions);
		
		$uarray = array();
		$i = 0;
		foreach($users->result() as $user){
			if($user->user_rating != 0)
			$uarray[$user->id] = $user->user_rating * $user->num_reviews;
			$i++;
		}
		arsort($uarray);
		return $uarray;
		
	 }//End of topOwners Function
	 
 	// --------------------------------------------------------------------
	
	
	
	 /*?>//
	 //* Get jobsLists
	// *	
	 //* @access	private
	 //@param	nil
	 // @return	object	object with result set
	 
	 function getjobslist()
	 {
	 	$this->db->from('jobs');
		$this->db->select('jobs.id,jobs.job_name,jobs.job_status,jobs.description,jobs.budget_min,jobs.budget_max,jobs.job_categories,jobs.creator_id,jobs.is_feature,jobs.is_urgent,jobs.is_hide_bids,jobs.created,jobs.enddate,jobs.employee_id');
			
		$result = $this->db->get();
		//pr($result->result());exit;
		return $result;
		
	 }//End of getjobs Function
	 
	 // --------------------------------------------------------------------<?php */ 
	 
	 
	 /**
	 * Get jobsLists for transfer money
	 *	
	 * @access	private
	 * @param	nil
	 * @return	object	object with result set
	 */
	 function getMembersJob($conditions=array())
	 {
	 	if(count($conditions)>0)		
	 		$this->db->where($conditions);
			
		$this->db->from('buy_requirement');
		$this->db->join('users', 'users.id = buy_requirement.creator_id','inner');
		$this->db->join('bids', 'bids.job_id = buy_requirement.id','inner');
		
		$this->db->select('buy_requirement.id,buy_requirement.looking_for,buy_requirement.status,buy_requirement.requirements,buy_requirement.category,buy_requirement.description,buy_requirement.budget,buy_requirement.end_date,buy_requirement.requirement_image,buy_requirement.created,buy_requirement.creator_id,buy_requirement.awarded_user,bids.bid_amount,bids.bid_time,users.id as userid,users.user_name');
		
		$result = $this->db->get();
		//pr($result->result());exit;
		return $result;
		
	 }//End of getjobs Function	 
     
     
	 /**
	 * Get Members Buyers 
	 *	
	 * @access	private
	 * @param	nil
	 * @return	object	object with result set
	 */
	 function getBuyers($conditions=array())
	 {
	 	if(count($conditions)>0)		
	 		$this->db->where($conditions);
			
		$this->db->from('buy_requirement');
		$this->db->join('bids', 'bids.job_id = buy_requirement.id','inner');
		$this->db->join('users', 'users.id = bids.user_id','inner');
		
		$this->db->select('buy_requirement.id,buy_requirement.looking_for,buy_requirement.status,buy_requirement.requirements,buy_requirement.category,buy_requirement.description,buy_requirement.budget,buy_requirement.end_date,buy_requirement.requirement_image,buy_requirement.created,buy_requirement.creator_id,buy_requirement.awarded_user,bids.bid_amount,bids.bid_time,users.id as userid,users.user_name');
		
		$result = $this->db->get();
		//pr($result->result());exit;
		return $result;
		
	 }//End of getjobs Function
	 
	 // --------------------------------------------------------------------
	
	 /**
	 * Get Members Sellers 
	 *	
	 * @access	private
	 * @param	nil
	 * @return	object	object with result set
	 */
	function getProjects($conditions = array())
	 {
        if(isset($conditions))
        {
         $this->db->where($conditions); 
        }
        
		$this->db->from('buy_requirement');
		$this->db->join('bids', 'bids.job_id = buy_requirement.id','inner');
		$this->db->join('users', 'users.id = bids.user_id','inner');
		$this->db->select('buy_requirement.id, buy_requirement.looking_for, 
                    bids.bid_amount,bids.bid_time,
                    users.id as userid, users.user_name');

		$result = $this->db->get();
		return $result;
		
	 }//End of getjobs Function
	/**
	 * Get user wise mail inbox
	 *	
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function getInboxmail($conditions=array())
	 {
	 	//Check For Conditions
	 	if(is_array($conditions) and count($conditions)>0)		
	 		$this->db->where($conditions);
			
		
			
		$this->db->from('jobs');
		
			
	 	$this->db->select('jobs.id,jobs.job_name,jobs.job_status,jobs.description,jobs.country,jobs.state,jobs.city,jobs.budget_min,jobs.budget_max,jobs.job_categories,jobs.creator_id,jobs.is_feature,jobs.is_urgent,jobs.is_hide_bids,jobs.created,jobs.enddate,jobs.employee_id,jobs.job_award_date');
			
		$result = $this->db->get();
		//pr($result->result());exit;
		return $result;
		
	 }//End of getjobs Function
	 
	 // --------------------------------------------------------------------
	
		
	/**
	 * Get job details
	 *	
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function getJobByBid($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby=array())
	 {
	 	//Check For Conditions
	 	if(is_array($conditions) and count($conditions)>0)		
	 		$this->db->where($conditions);
			
		//Check For like statement
	 	if(is_array($like) and count($like)>0)		
	 		$this->db->like($like);	
		
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
			
		$this->db->from('bids');
		$this->db->join('buy_requirement', 'buy_requirement.id = bids.job_id','inner');
		$this->db->join('users', 'users.id = bids.user_id','inner');
		//Check For Fields	 
		if($fields!='')
				$this->db->select($fields);
		else 		
	 		$this->db->select(
			'buy_requirement.id as buy_id,buy_requirement.looking_for,buy_requirement.creator_id,buy_requirement.category,buy_requirement.description,buy_requirement.budget,buy_requirement.end_date,users.email,buy_requirement.created,bids.id as bidid,bids.user_id,users.user_name,buy_requirement.checkstamp,buy_requirement.awarded_amount');
			
		$result = $this->db->get();
		return $result;
		
	 }//End of getjobByBid Function
	 function getBidsByJob($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby=array())
	 {
	 	//Check For Conditions
	 	if(is_array($conditions) and count($conditions)>0)		
	 		$this->db->where($conditions);
			
		//Check For like statement
	 	if(is_array($like) and count($like)>0)		
	 		$this->db->like($like);	
		
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
			
		$this->db->from('bids');
		$this->db->join('buy_requirement', 'buy_requirement.id = bids.job_id','inner');
		$this->db->join('users', 'users.id = bids.user_id','inner');
		//Check For Fields	 
		if($fields!='')
				$this->db->select($fields);
		else 		
	 		$this->db->select('bids.job_id,bids.bid_hours,bids.user_id,bids.bid_time,bids.bid_amount,bids.bid_days,bids.bid_desc,users.email,bids.id as bidid,bids.user_id,users.user_name,bids.id as bidsid,users.logo,users.user_verify,users.state,users.city,bids.awarded_amount');
			
		$result = $this->db->get();
		return $result;
		
	 }//End of getjobByBid Function
	 // --------------------------------------------------------------------
	 
	 /**
	 * Get Bids
	 *	
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function getBidsproject()
	 {
	 	//Get thebid project details for all jobs			
		$this->db->from('bids');
		$this->db->select('bids.id,bids.job_id,bids.user_id,bids.bid_days,bids.bid_days,bids.bid_hours,bids.bid_amount,bids.bid_time,bids.bid_desc');
			
		$result = $this->db->get();
		return $result;
		
	 }//End of getjobs Function
	 
	 // --------------------------------------------------------------------
	 
	 /**
	 * Get Bids
	 *	
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function getBids($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby=array())
	 {
	 	//Check For Conditions
	 	if(is_array($conditions) and count($conditions)>0)		
	 		$this->db->where($conditions);
			
		//Check For like statement
	 	if(is_array($like) and count($like)>0)		
	 		$this->db->like($like);	
		
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
			
		$this->db->from('bids');
		$this->db->join('users', 'users.id = bids.user_id','inner');
		$this->db->join('buy_requirement', 'buy_requirement.id = bids.job_id','inner');
		//Check For Fields	 
		if($fields!='')
				$this->db->select($fields);
		else 		
	 		$this->db->select('bids.id,bids.job_id,bids.user_id,bids.bid_days,bids.bid_days,bids.bid_hours,bids.bid_amount,bids.bid_time,bids.bid_desc,bids.escrow_flag,users.user_name,users.id as uid,users.user_rating,users.num_reviews,buy_requirement.looking_for,buy_requirement.creator_id');
			
		$result = $this->db->get();
		
		return $result;
		
	 }//End of getjobs Function
	 
	 // --------------------------------------------------------------------
	 
	 /**
	 * Get RatingHold
	 *	
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function getRatingHold($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby=array())
	 {
	 	//Check For Conditions
	 	if(is_array($conditions) and count($conditions)>0)		
	 		$this->db->where($conditions);
			
		//Check For like statement
	 	if(is_array($like) and count($like)>0)		
	 		$this->db->like($like);	
		
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
			
		$this->db->from('rating_hold');
		//Check For Fields	 
		if($fields!='')
				$this->db->select($fields);
		else 		
	 		$this->db->select('rating_hold.rating,rating_hold.user_id,rating_hold.job_id');
			
		$result = $this->db->get();
		return $result;
		
	 }//End of getjobs Function
	 
	  // --------------------------------------------------------------------
	 
	 /**
	 * Get Bids
	 *	
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function getSumBids($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby=array())
	 {
	 
		//Check For Conditions
	 	if(is_array($conditions) and count($conditions)>0)		
	 		$this->db->where($conditions);
			
		$this->db->from('bids');
				
	 	$this->db->select_sum('bid_amount');
			
		$result = $this->db->get();

		return $result;
		
	 }//End of getSumBids Function
	 
	 // --------------------------------------------------------------------
	 
	 /**
	 * getTotalReviews
	 *	
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function getSumReviews($conditions=array())
	 {
	 
		//Check For Conditions
	 	if(is_array($conditions) and count($conditions)>0)		
	 		$this->db->where($conditions);
			
		$this->db->from('reviews');
				
	 	$this->db->select_sum('rating');
			
		$set = $this->db->get();
		
		$row = $set->row();

		return $row->rating;
		
	 }//End of getTotalReviews Function
	 
	 // --------------------------------------------------------------------
	 
	 /**
	 * Get Bids
	 *	
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function getNumBids($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby=array())
	 {
	 
		//Check For Conditions
	 	if(is_array($conditions) and count($conditions)>0)		
	 		$this->db->where($conditions);
			
		$this->db->from('bids');
		$num = $this->db->count_all_results();
		return $num;
		
	 }//End of getSumBids Function
	 
	 // --------------------------------------------------------------------
	 
	 /**
	 * Get Lowest Bid
	 *	
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function getLowestBid($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby=array())
	 {
	 
		//Check For Conditions
	 	if(is_array($conditions) and count($conditions)>0)		
	 		$this->db->where($conditions);
			
		//Check For Limit	
		if(is_array($limit))		
		{
			if(count($limit)==1)
	 			$this->db->limit($limit[0]);
			else if(count($limit)==2)
				$this->db->limit($limit[0],$limit[10]);
		}	
			
		//Check for Order by
		if(is_array($orderby) and count($orderby)>0)
			$this->db->order_by($orderby[0], $orderby[1]);
			
		$this->db->from('bids');
		//Check For Fields	 
		if($fields!='')
				$this->db->select($fields);
		else 		
	 		$this->db->select('bids.bid_amount');
		$result = $this->db->get();
		return $result;
		
	 }//End of getLowestBid Function
	 
	 // --------------------------------------------------------------------
	 
	 /**
	 * Get Bids
	 *	
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function awardJob($conditions=array())
	 {
	 
		//Check For Conditions
	 	if(is_array($conditions) and count($conditions)>0)		
	 		$this->db->where($conditions);
			
		$this->db->from('bids');
		$result = $this->db->get();
		$row = $result->row();
		//print_r($row);exit;
		$emp_id = $row->user_id;
		$checkstamp = md5("Lalbook:".$emp_id.":".$row->job_id.":".microtime());
		//echo $checkstamp;exit;
		$data = array(
               'awarded_user' => $emp_id,
               'checkstamp' => $checkstamp, 
			   'award_date' => get_est_time(),
			   'notification_status'=>1
            );
		//print_r($data);exit;
		$this->db->where('buy_requirement.id', $row->job_id);
		$this->db->update('buy_requirement', $data);
		return $this->db->affected_rows(); 
		
		//return $num;
		
	 }//End of getSumBids Function 
	 
	 // --------------------------------------------------------------------
		
	/**
	 * accpetjob
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function acceptJob($updateKey=array(),$updateData=array())
	 {
	    $this->db->update('buy_requirement',$updateData,$updateKey);
		return $this->db->affected_rows(); 
		 //print_r()
 	 }//End of accpetjob Function 
	 
	 // --------------------------------------------------------------------
		
	/**
	 * deleteBid
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function deleteBid($conditions=array())
	 {
	    //Check For Conditions
	 	if(is_array($conditions) and count($conditions)>0)		
	 		$this->db->where($conditions);
			
		$this->db->delete('bids');
		return $this->db->affected_rows(); 
		 
 	 }//End of deleteBid Function
	 
	 
	 function deleteBids($id=0,$conditions=array())
	 {
	 	if(is_array($conditions) and count($conditions)>0)		
	 		$this->db->where($conditions);
		else	
		    $this->db->where('id', $id);
	 	$this->db->delete('bids');
		 
	 }//End of deletejobs Function
	 
	  // --------------------------------------------------------------------
	
	/**
	 * insert Reviews
	 *
	 * @access	public
	 * @param	string	the type of the flash message
	 * @param	string  flash message 
	 * @return	string	flash message with proper style
	 */
	 function createReview($insertData=array())
	 {
	 	$this->db->insert('reviews',$insertData);
		return $this->db->insert_id();
	 }//End of insertUserContacts Function
	 
	  // --------------------------------------------------------------------
	
	/**
	 * Update jobs
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function updateJobs($id=0,$updateData=array(),$conditions=array())
	 {
	 //pr($conditions);exit;
	 	if(is_array($conditions) and count($conditions)>0)	
		
	 		$this->db->where($conditions);
		else	
		    $this->db->where('id', $id);
			
	 	$this->db->update('buy_requirement', $updateData);
		 
	 }//End of updatejobs Function
	 
	 // --------------------------------------------------------------------
	
	
	/**
	 * delete jobs
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function deleteProjects($id=0,$conditions=array())
	 {
	 	if(is_array($conditions) and count($conditions)>0)		
	 		$this->db->where($conditions);
		else	
		    $this->db->where('id', $id);
	 	$this->db->delete('jobs');
		 
	 }//End of deletejobs Function
	 
	 // --------------------------------------------------------------------
	 
	 /**
	 * delete jobs
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function deletedraftprojects($conditions=array())
	 {
	 	if(is_array($conditions) and count($conditions)>0)		
	 		$this->db->where($conditions);
	 	$this->db->delete('draftjobs');
		 
	 }//End of deleteProjects Function
	 
	 // --------------------------------------------------------------------
	
	/**
	 * updateUsers
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function updateUsers($id=0,$updateData=array())
	 {
	 	$this->db->where('id', $id);
	 	$this->db->update('users', $updateData);
		 
	 }//End of updateUsers Function
	 
	 // --------------------------------------------------------------------
	
	/**
	 * updateReviews
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function updateReviews($id=0,$updateData=array())
	 {
	 	$this->db->where('id', $id);
	 	$this->db->update('reviews', $updateData);
		 
	 }//End of updateUsers Function
	 
	 // --------------------------------------------------------------------
	 
	 /**
	 * manageProjects
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function manageProjects($updateData=array(),$conditions=array())
	 {
	 	if(count($conditions)>0)		
	 		$this->db->where($conditions);
	 	$this->db->update('jobs', $updateData);
		 
	 }//End of updateUsers Function
	 
	 // --------------------------------------------------------------------
	 
	 /**
	 * insert Reviews
	 *
	 * @access	public
	 * @param	string	the type of the flash message
	 * @param	string  flash message 
	 * @return	string	flash message with proper style
	 */
	 function insertReport($insertData=array())
	 {
	 	$this->db->insert('report_violation',$insertData);
	 }//End of insertUserContacts Function
	 
	  // --------------------------------------------------------------------
	 
	 /**
	 * insert RatingHold
	 *
	 * @access	private
	 * @param	array of values

	 */
	 function insertRatingHold($insertData=array())
	 {
	 	$this->db->insert('rating_hold',$insertData);
	 }//End of insertUserContacts Function
	 
	  // --------------------------------------------------------------------
	  
	  /**
	 * insert Reviews
	 *
	 * @access	public
	 * @param	string	the type of the flash message
	 * @param	string  flash message 
	 * @return	string	flash message with proper style
	 */
	function cr_thumb($filename = '')
	{
		$config['image_library'] = 'gd2';
		$config['source_image'] = $filename;
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = 120;
		$config['height'] = 90;
		
		$this->load->library('image_lib', $config);
		
		
		if ( ! $this->image_lib->resize())
		{
			echo $this->image_lib->display_errors();
		}
	}
	
	// --------------------------------------------------------------------
	
	
	  /**
	 * insert Reviews
	 *
	 * @access	public
	 * @param	string	the type of the flash message
	 * @param	string  flash message 
	 * @return	string	flash message with proper style
	 */
	function cr_Logo($filename = '')
	{
		$config['image_library'] = 'gd2';
		$config['source_image'] = $filename;
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['raw_name']       ='h1_logo.jpg';
		pr($filename);
		exit;
		$this->load->library('image_lib', $config);
		
		
		if ( ! $this->image_lib->resize())
		{
			echo $this->image_lib->display_errors();
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * 
	 * Get number of jobs added
	 * @access	private
	 * @return	favourite and blocked users list
	 */
	 
	 function getNumProjectsByMonth($mon,$year)
	 {
	 	$query = "SELECT count(*) as cnt FROM jobs WHERE FROM_UNIXTIME(created, '%c,%Y') = '$mon,$year' ";
	  	$que = $this->db->query($query);
	 	
		$res = $que->row();
		
		return $res->cnt;
	 }//End of flash_message Function
	 
	 // --------------------------------------------------------------------
	
	/**
	 * 
	 * lowBidNotification
	 * @access	private
	 * @return	favourite and blocked users list
	 */
	 
	 function lowBidNotification($bidamt,$prjid)
	 {
	 	
		$currency = $this->db->get_where('settings', array('code' => 'CURRENCY_TYPE'))->row()->string_value;
		//echo $bidamt;
		//Check For Conditions
		$conditions = array('bids.job_id' => $prjid,'bids.lowbid_notify' => '1','bids.bid_amount >' => $bidamt);
	 	if(is_array($conditions) and count($conditions)>0)		
	 		$this->db->where($conditions);
			
		$this->db->from('bids');
		$result = $this->db->get();
		if($result->num_rows() > 0){
			foreach($result->result() as $bid){
				$user = $this->user_model->getUsers(array('users.id' => $bid->user_id),'users.email,users.user_name');
				$userRow = $user->row();
				
				$project = $this->getJobs(array('jobs.id' => $bid->job_id),'jobs.job_name');
				$projectDetails = $project->row();
				//pr($projectDetails);exit;
				
				//pr($userRow);exit;
				//Send Mail
				$conditionUserMail = array('email_templates.type'=>'lowbid_notify');
				$result            = $this->email_model->getEmailSettings($conditionUserMail);
				$rowUserMailConent = $result->row();
				
				$splVars = array("!project_name" => '<a href="'.site_url('job/view/'.$bid->job_id).'">'.$projectDetails->job_name.'</a>',"!provider_name" => $userRow->user_name,"!contact_url" => site_url('contact'),'!site_name' => $this->config->item('site_title'),'!bid_amt2' => $currency.$bid->bid_amount,'!bid_amt' => $currency.$bidamt);
				$mailSubject = strtr($rowUserMailConent->mail_subject, $splVars);
				$mailContent = strtr($rowUserMailConent->mail_body, $splVars);
				$toEmail     = $userRow->email;
				$fromEmail   = $this->config->item('site_admin_mail');
				//echo $mailContent;exit;
				$this->email_model->sendHtmlMail($toEmail,$fromEmail,$mailSubject,$mailContent);
				//exit;
				
			}
		}
		//pr($result->result());exit;
	 }//End of flash_message Function
	 
	 // --------------------------------------------------------------------
	 
	 /**
	 * 
	 * sendTwitter - sending message to twitter
	 * @access	private
	 * @return	true/false
 	 */
	function sendTwitter($message='',$user,$pass,$apiUrl='http://twitter.com/statuses/update.xml')
	{
		$curl_handle = curl_init();
		curl_setopt($curl_handle, CURLOPT_URL, "$apiUrl");
		curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_POST, 1);
		curl_setopt($curl_handle, CURLOPT_POSTFIELDS, "status=$message");
		curl_setopt($curl_handle, CURLOPT_USERPWD, "$user:$pass");
		//Attempt to send
		$buffer = @curl_exec($curl_handle);
		curl_close($curl_handle);
		if(strpos($buffer,'<error>') !== false)
		{
			return false;
		}
		else
		{
			return true;
		}
	}//End of sendTwitter Function
	
	function tinyUrl($url){
	    $tiny = 'http://tinyurl.com/api-create.php?url=';
	    return file_get_contents($tiny.urlencode(trim($url)));
	}

	 	 
}
// End Skills_model Class
   
/* End of file Skills_model.php */ 
/* Location: ./application/models/Skills_model.php */
?>