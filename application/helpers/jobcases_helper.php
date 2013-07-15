<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 
/**
 * getLastResponse
 *
 * Will return the last response date of the Job cancellation/dispute cases
 *
 * @access	private
 * @param	string
 * @return	string
 */
	function getLastResponse($caseId=NULL,$type='')
	{
		$CI 	=& get_instance();
		$mod 	= $CI->load->model('dispute_model');
		$conditions = array('job_cases.case_type' => $type);
		$orCondition = "(job_cases.id = '".$caseId."' or job_cases.parent = '".$caseId."')";
		$orderby = array('job_cases.created','DESC');
		$limit = array('1');
		
		$result = $CI->dispute_model->getProjectCases($conditions,$orCondition,'job_cases.created',$orderby,$limit);
		$data = $result->row();
		$timestamp = $data->created;
		if(date('d/M/Y') == date('d/M/Y',$timestamp))
		$date = $CI->lang->line('Today at')." ".date('H:i',$timestamp)." EST";
		else 
		$date = date('d-M-Y',$timestamp)." EST";		
		return $date;
	} //End of getBidsInfo function
	
	// ------------------------------------------------------------------------

	/**
	 * getAdminDetails
	 *
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	function getAdminDetails($userId=NULL,$field='')
	{
		$CI 	=& get_instance();
		$mod 	= $CI->load->model('dispute_model');
		$conditions = array('admins.id'=>$userId);
		$fields = 'admins.'.$field;
		$result = $CI->dispute_model->getInfo('admins',$fields,$conditions);
		if($result->num_rows()>0)
		{
			$data = $result->row();
			$res = $data->$field;
		} else {
			$res = '';
		}
		return $res;	
	}//End of getAdminDetails function
	
	// ------------------------------------------------------------------------

	/**
	 * getUserDetails
	 *
	 * Create a admin URL based on the admin folder path mentioned in config file. Segments can be passed via the
	 * first parameter either as a string or an array.
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	function getUserDetails($userId=NULL,$field='')
	{
		$CI 	=& get_instance();
		$mod 	= $CI->load->model('user_model');
		$conditions = array('users.id'=>$userId);
		$result = $CI->user_model->getUsers($conditions);
		if($result->num_rows()>0)
		{
			$data = $result->row();
			$res = $data->$field;
		} else {
			$res = '';
		}
		return $res;	
	}//End of getUserDetails function

/* End of file jobcases_helper.php */
/* Location: ./application/helpers/jobcases_helper.php */
?>