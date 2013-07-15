<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Debugg  Related Helper
 */	
	function pr($str='')
	{
		echo '<pre>';
		print_r($str);
		echo '<pre>';
	}

/* End of file debug_helper.php */
/* Location: ./applications/helpers/debug_helper.php */