<?php



 /*

  ****************************************************************************

  ***                                                                      ***

  ***      BIDONN 1.0                                                      ***

  ***      File:  messages_model.php 		                               ***

  ***      Built: Mon June 14 13:10:20 2012                                ***

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





class Messages_model extends CI_Model {

	 

   

	// Constructor 

	

	  function __construct() 

	  {

	  	parent::__construct();

      }//Controller End

	

	// --------------------------------------------------------------------

		

	/* Get Users List */

	 function getUsers()   

	  {

	  	$this->db->select('users.id,users.user_name,users.role_id');

		$result = $this->db->get('users');

		return $result->result();

	  }

	 function getBidnotify($conditions)
	 {
	 $this->db->where($conditions);
		$this->db->from('buy_requirement');
		/*$this->db->join('buy_requirement', 'users.id = buy_requirement.creator_id','left');*/
		//$this->db->join('bids', 'bids.job_id = buy_requirement.id','left');
		/*$this->db->join('category', 'category.category = buy_requirement.category','inner');*/
		/*$this->db->join('services', 'services.id = buy_requirement.category','inner');*/
	 $this->db->select('buy_requirement.id as buy_id,buy_requirement.creator_id,buy_requirement.looking_for,buy_requirement.requirements,buy_requirement.category,buy_requirement.description,buy_requirement.budget,buy_requirement.end_date,buy_requirement.requirement_image,buy_requirement.created,buy_requirement.awarded_user,buy_requirement.status');	
	 $this->db->order_by('buy_id', 'DESC');
		$result =$this->db->get();
		
		return $result;
		}

	

	/**

	 * updateMailnotification

	 *

	 * @access	private

	 * @param	array	an associative array of insert values

	 * @return	void

	 */

	 function updateMailnotification($id=0,$updateData=array(),$conditions=array())

	 {

	 //pr($conditions);exit;

	 	if(is_array($conditions) and count($conditions)>0)		

	 		$this->db->where($conditions);

		else	

		    $this->db->where('id', $id);

	 	$this->db->update('messages', $updateData);

		 

	 }//End of updateMailnotification Function

	 

	 // --------------------------------------------------------------------

	

	function getJobNotifications($conditions=array())
	{
	if(count($conditions)>0)		

	 		$this->db->where($conditions);

			 

	 	$this->db->select('users.id,users.user_name,users.role_id');

		$result = $this->db->get('users');

		//pr($result);

		return $result->result();
	}

	

	/**

	 * Get logged user details

	 *

	 * @access	private

	 * @param	array	conditions to fetch data

	 * @return	object	object with result set

	 */

	 function getLoggedUser($conditions=array())

	 {

	 	if(count($conditions)>0)		

	 		$this->db->where($conditions);

			 

	 	$this->db->select('users.id,users.user_name,users.role_id');

		$result = $this->db->get('users');

		//pr($result);

		return $result->result();

		

	 }//End of getGroups Function

	 

	 // --------------------------------------------------------------------

	

		

	/**

	 * Get groups

	 *

	 * @access	private

	 * @param	array	conditions to fetch data

	 * @return	object	object with result set

	 */

	 function getTotalMessages($conditions=array())

	 {

	 	if(count($conditions)>0)		

	 		$this->db->where($conditions);

			 

	 	$this->db->select('messages.id');

		$result = $this->db->get('messages');

		return $result->num_rows();

		

	 }//End of getGroups Function

	 

	 // --------------------------------------------------------------------

		

	/**

	 * Add Project

	 *

	 * @access	private

	 * @param	array	an associative array of insert values

	 * @return	void

	 */

	 function postMessage($insertData=array())

	 {

	 	$this->db->insert('message', $insertData);

		 

	 }//End of addGroup Function

	 

	 // --------------------------------------------------------------------

		

	/**

	 * Get Project Messages

	 *

	 * @access	private

	 * @param	array	conditions to fetch data

	 * @return	object	object with result set

	 */

	 function getJobMessages($conditions=array(),$fields='',$like=array(),$limit=array(),$order=array())

	 {

	 	//Check For Conditions

	 	if(count($conditions)>0)		

	 		$this->db->where($conditions);

		

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

		if(is_array($order) and count($order)>0)			

		   $this->db->order_by($order[0],$order[1]);

	//	else   

		   //$this->db->order_by('message.created','desc');	

		

		$this->db->from('message');

		$this->db->join('users', 'users.id = message.from_id','left');

		//Check For Fields	 

		if($fields!='')

				$this->db->select($fields);

		else 		

	 		$this->db->select('message.id,message.job_id,message.from_id,message.to_id, message.message, message.created,users.user_name,message.deluserid');

			

		$result = $this->db->get();

		//pr($result->result());exit;
//print_r($this->db->last_query());exit;
		return $result;

		

	 }//End of getJobMessages Function

	 

	 /**

	 * Get getJobMessages1

	 *

	 * @access	private

	 * @param	array	conditions to fetch data

	 * @return	object	object with result set

	 */

	 function getJobMessages1($conditions=array(),$fields='',$like=array(),$limit=array())

	 {

	 	//Check For Conditions

	 	if(count($conditions)>0)		

	 		$this->db->where($conditions);

		

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

		

		$this->db->from('message');

		$this->db->join('users', 'users.id = message.to_id','left');

		//Check For Fields	 

		if($fields!='')

				$this->db->select($fields);

		else 		

	 		$this->db->select('message.id,message.job_id,message.from_id,message.to_id, message.message, message.created,users.user_name,message.deluserid');

			

		$result = $this->db->get();
//print_r($this->db->last_query());exit;
		//pr($result->result());

		return $result;

		

	 }//End of getJobMessages1 Function

	 

	 

	 /**

	 * Get Messages

	 *

	 * @access	private

	 * @param	array	conditions to fetch data

	 * @return	object	object with result set

	 */

	 function getMessages($conditions=array(),$fields='',$like=array(),$limit=array())

	 {

	 	//Check For Conditions

	 	if(count($conditions)>0)		

	 		$this->db->or_where($conditions);

		

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

		

		$this->db->from('message');

		$this->db->join('users', 'users.id = message.from_id','left');

		//Check For Fields	 

		if($fields!='')

				$this->db->select($fields);

		else 		

	 		$this->db->select('message.id,message.job_id,message.from_id,message.to_id, message.message, message.created,users.user_name,message.deluserid');

			

		$result = $this->db->get();

		//print_r($result);

		return $result;

		

	 }//End of getMessages Function

	 

	 

	function getmessage_userdetails($conditions=array(),$fields='',$like=array(),$limit=array()) 

	{

	//pr($conditions);

	 //Check For Conditions

	 	if(count($conditions)>0)		

	 		$this->db->where($conditions);

		

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

		

		$this->db->from('messages');

		$this->db->join('users', 'users.id = messages.from_id','left');

		$this->db->group_by('users.user_name');

		//Check For Fields	 

		if($fields!='')

				$this->db->select($fields);

		else 		

	 		$this->db->select('messages.id,messages.job_id,messages.from_id,messages.to_id, messages.message, messages.created,users.user_name,messages.deluserid');

			

		$result = $this->db->get();

		//pr($result->result());exit;

		return $result;

	}
	
	  function postJobMessage($insertData=array())

	 {

	 	$this->db->insert('message', $insertData);

	 }
	 
	 function getJobMsg($conditions=array(),$fields='',$like=array(),$limit=array()) 

	{

	//pr($conditions);

	 //Check For Conditions

	 	if(count($conditions)>0)		

	 		$this->db->where($conditions);

		

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

		

		$this->db->from('message');

		$this->db->join('users', 'users.id = message.from_id','left');
		
		$this->db->join('bids', 'bids.job_id = message.job_id and bids.user_id = message.from_id','left');

		//$this->db->group_by('users.user_name');

		//Check For Fields	 

		if($fields!='')

				$this->db->select($fields);

		else 		

	 		$this->db->select('message.id,message.job_id,message.from_id,message.to_id, message.message, message.created,users.user_name,message.deluserid,users.logo,users.user_rating,bids.id,bids.job_id,bids.user_id,bids.bid_days,bids.bid_days,bids.bid_hours,bids.bid_amount,bids.bid_time,bids.bid_desc');

			

		$result = $this->db->get();

		//print_r($this->db->last_query());exit;

		return $result;

	}

    /**
     *  Gets the messages from all the associated buyers of the user bids
     *
     *  @access public
     *  @param array conditions to fetch data
     *  @param string fields  to populate
     *  @param array like statements array
     *  @param array limit statements array
     *  @param string mode as inbox / outbox
     *
     */
    function getUserMessages($conditions=array(),$fields='',$like=array(),$limit=array(), $mode='inbox') {
        //pr($conditions);
        //Check For Conditions
        if(count($conditions)>0)		
            $this->db->where($conditions);

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

        $this->db->from('message');
        
        if($mode == 'inbox') {
            $this->db->join('users', 'users.id = message.to_id', 'INNER');
            $this->db->join('bids', 'bids.job_id = message.job_id','INNER');
            $this->db->join('buy_requirement', 'buy_requirement.id = bids.job_id','INNER');
        }
        else if($mode == 'outbox') {
            $this->db->join('users', 'users.id = message.to_id', 'INNER');
            $this->db->join('bids', 'bids.job_id = message.job_id' ,'left');
            $this->db->join('buy_requirement', 'buy_requirement.id = bids.job_id','INNER');
        }
        
        //Check For Fields	 
        if($fields!='')
                $this->db->select($fields);
        else 		
            $this->db->select('message.id as message_id,message.job_id,message.from_id,message.to_id, message.message, message.created,
                    users.user_name,message.deluserid, users.logo,users.user_rating,bids.id,bids.job_id,bids.user_id,
                    bids.bid_days,bids.bid_days,bids.bid_hours,bids.bid_amount,bids.bid_time,bids.bid_desc,
                    buy_requirement.id, buy_requirement.creator_id');

        $result = $this->db->get();

        //pr($this->db->last_query());exit;
        return $result;        
    }
    
    function getSellerMessages($conditions=array(),$fields='',$like=array(),$limit=array()) {
    
    }
    
}

// End Messages_model Class

   

/* End of file Messages_model.php */ 

/* Location: ./application/models/Messages_model.php */