<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {
		
		// constructor
       function __construct()
       {
         parent::__construct();
       }
   
	   function set_errors($fields)
	   {
		  if (is_array($fields) and count($fields))
		  {
			 foreach($fields as $key => $val)
			 {
				$error = $key.'_error';
				if (isset($this->$error) and isset($this->$key) and $this->$error != '')
				{
				   $old_error = $this->$error;
				   $new_error = $this->_error_prefix.sprintf($val, $this->$key).$this->_error_suffix;
				   $this->error_string = str_replace($old_error, $new_error, $this->error_string);
				   $this->$error = $new_error;
				}// End IF
			 }//End Foreach
		  }// End If     
	   }//End Function
   
}
//Class End 
