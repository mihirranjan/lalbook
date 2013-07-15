<?php

 /*
  ****************************************************************************
  ***                                                                      ***
  ***      BIDONN 1.0                                               	   ***
  ***      File:  settings_model.php                                       ***
  ***      Built: Mon June 14 11:46:40 2012                                ***
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

	 class Settings_model extends CI_Model {
	 
	
	  // Constructor 
	 
	  function __construct() 
	  {
	  	parent::__construct();
      }//Controller End
	 
	 // --------------------------------------------------------------------
	 
	 /**
	 * Get site settings information from database
	 *
	 * @access	private
	 * @param	array
	 * @return	array	site settings informations in array format
	 */
	 function getSiteSettings($data = array())
	 {
		$this->db->select('id, code, name, setting_type,value_type,int_value,string_value,text_value,created');
		$this->db->where('setting_type','S');
		$query    =  $this->db->get('settings');
		foreach ($query->result() as $row)
        {
			//Conditions based on value type field
		    if($row->value_type =='I' )
		    {
		         $data[$row->code] = $row->int_value;
		    }//if End
		    if($row->value_type =='T' )
		    {
				$data[$row->code] = $row->text_value;
		    }//if End
		    if($row->value_type =='S' )
		    {
					$data[$row->code] = $row->string_value;
		    } //if End 
			if($row->value_type =='P' )
		    {
					$data[$row->code] = $row->string_value;
		    } //if End 
        }// Foreach End
			return $data;
	 }//End of getSiteSettings Function

	// --------------------------------------------------------------------
	
	/**
	 * Update site settings information.
	 *
	 * @access	private
	 * @param	array	update information related to site
	 * @return	void
	 */
	 function updateSiteSettings($updateData=array())
	 {
	 	//pr($updateData);
		//Update
	 	$data = array('string_value' =>$updateData['site_title']);
		$this->db->where('code', 'SITE_TITLE');
		$this->db->update('settings', $data); 
		
		$data = array('string_value' =>$updateData['site_language']);
		$this->db->where('code', 'LANGUAGE_CODE');
		$this->db->update('settings', $data); 
		
		$data = array('string_value' =>$updateData['twitter_username']);
		$this->db->where('code', 'TWITTER_USERNAME');
		$this->db->update('settings', $data);
		
		$data = array('string_value' =>$updateData['twitter_password']);
		$this->db->where('code', 'TWITTER_PASSWORD');
		$this->db->update('settings', $data);
		
		$data = array('string_value' =>$updateData['site_slogan']);
		$this->db->where('code', 'SITE_SLOGAN');
		$this->db->update('settings', $data); 
		
		$data = array('string_value' =>$updateData['site_admin_mail']);
		$this->db->where('code', 'SITE_ADMIN_MAIL');
		$this->db->update('settings', $data); 
		
		$data = array('string_value' =>$updateData['base_url']);
		$this->db->where('code', 'BASE_URL');
		$this->db->update('settings', $data);
		
		$data = array('int_value' =>$updateData['site_status']);
		$this->db->where('code', 'SITE_STATUS');
		$this->db->update('settings', $data); 
		
		$data = array('text_value' =>$updateData['offline_message']);
		$this->db->where('code', 'OFFLINE_MESSAGE');
		$this->db->update('settings', $data); 
		
		$data = array('text_value' =>$updateData['forced_escrow']);
		$this->db->where('code', 'FORCED_ESCROW');
		$this->db->update('settings', $data); 
		
		/*$data = array('int_value' =>$updateData['payment_settings']);
		$this->db->where('code', 'PAYMENT_SETTINGS');
		$this->db->update('settings', $data); */
		
		/*$data = array('int_value' =>$updateData['featured_projects_limit']);
		$this->db->where('code', 'FEATURED_PROJECTS_LIMIT');
		$this->db->update('settings', $data);*/
		
		/*$data = array('int_value' =>$updateData['urgent_projects_limit']);
		$this->db->where('code', 'URGENT_PROJECTS_LIMIT');
		$this->db->update('settings', $data);*/
		
		/*$data = array('int_value' =>$updateData['latest_projects_limit']);
		$this->db->where('code', 'LATEST_PROJECTS_LIMIT');
		$this->db->update('settings', $data);
		
		
		$data = array('int_value' =>$updateData['provider_commission_amount']);
		$this->db->where('code', 'PROVIDER_COMMISSION_AMOUNT');
		$this->db->update('settings', $data);
		
		$data = array('int_value' =>$updateData['featured_projects_amount']);
		$this->db->where('code', 'FEATURED_PROJECT_AMOUNT');
		$this->db->update('settings', $data);
		
		$data = array('int_value' =>$updateData['urgent_projects_amount']);
		$this->db->where('code', 'URGENT_PROJECT_AMOUNT');
		$this->db->update('settings', $data);
		
		
		
		$data = array('int_value' =>$updateData['hide_projects_amount']);
		$this->db->where('code', 'HIDE_PROJECT_AMOUNT');
		$this->db->update('settings', $data);
		*/
		$data = array('int_value' =>$updateData['file_manager_limit']);
		$this->db->where('code', 'USER_FILE_LIMIT');
		$this->db->update('settings', $data);
		
		/*$data = array('int_value' =>$updateData['private_project_amount']);
		$this->db->where('code', 'PRIVATE_PROJECT_AMOUNT');
		$this->db->update('settings', $data);
		
		$data = array('int_value' =>$updateData['featured_projects_amount_cm']);
		$this->db->where('code', 'FEATURED_PROJECT_AMOUNT_CM');
		$this->db->update('settings', $data);
		
		$data = array('int_value' =>$updateData['urgent_projects_amount_cm']);
		$this->db->where('code', 'URGENT_PROJECT_AMOUNT_CM');
		$this->db->update('settings', $data);
		
		
		
		$data = array('int_value' =>$updateData['hide_projects_amount_cm']);
		$this->db->where('code', 'HIDE_PROJECT_AMOUNT_CM');
		$this->db->update('settings', $data);
		
		$data = array('int_value' =>$updateData['private_project_amount_cm']);
		$this->db->where('code', 'PRIVATE_PROJECT_AMOUNT_CM');
		$this->db->update('settings', $data);
		
		
		$data = array('int_value' =>$updateData['joblist_projects_amount']);
		$this->db->where('code', 'JOBLISTING_PROJECT_AMOUNT');
		$this->db->update('settings', $data);
		
		$data = array('int_value' =>$updateData['joblist_validity_days']);
		$this->db->where('code', 'JOBLIST_VALIDITY_LIMIT');
		$this->db->update('settings', $data);
		*/
		$data = array('string_value' =>$updateData['facebook']);
		$this->db->where('code', 'FACEBOOK');
		$this->db->update('settings', $data);
		
		$data = array('string_value' =>$updateData['twitter']);
		$this->db->where('code', 'TWITTER');
		$this->db->update('settings', $data);
		
		$data = array('string_value' =>$updateData['rss']);
		$this->db->where('code', 'RSS');
		$this->db->update('settings', $data);
		
		$data = array('string_value' =>$updateData['linkedin']);
		$this->db->where('code', 'LINKEDIN');
		$this->db->update('settings', $data);
		
		/*$data = array('string_value' =>$updateData['currency']);
		$this->db->where('code', 'CURRENCY_TYPE');
		$this->db->update('settings', $data);*/
		
	 }//End of updateSiteSettings Function
	 
	  // --------------------------------------------------------------------
	  /**
	 * Get Social Networks Information.
	 *
	 * @access	private
	 * @param	array	update information related to site
	 * @return	void
	 */
	  function updateNetworks($updateData=array())
	  {
		$data = array('site_url' =>$updateData['Facebook']);
		$this->db->where('site_name', 'Facebook');
		$this->db->update('social_networks', $data);
		
		$data = array('site_url' =>$updateData['Twitter']);
		$this->db->where('site_name', 'Twitter');
		$this->db->update('social_networks', $data);
		
		$data = array('site_url' =>$updateData['RSS']);
		$this->db->where('site_name', 'RSS');
		$this->db->update('social_networks', $data);
		
		$data = array('site_url' =>$updateData['linkedin']);
		$this->db->where('site_name', 'linkedin');
		$this->db->update('social_networks', $data);
 	  }
	  
	   // --------------------------------------------------------------------
	  /**
	 * Get Social Networks Information.
	 *
	 * @access	private
	 * @param	array	update information related to site
	 * @return	void
	 */
 	  function setCurrency($conditions=array())
	 {
	 	if(count($conditions)>0)		
	 		$this->db->where($conditions);
		
		$this->db->from('currency');
	 	$this->db->select('currency.id,currency.currency_name,currency.currency_type,currency.currency_symbol');
		$result = $this->db->get();
		return $result;
	 }
	  

	 
}
// End Settings_model Class
   
/* End of file Settings_model.php */ 
/* Location: ./application/models/Settings_model.php */