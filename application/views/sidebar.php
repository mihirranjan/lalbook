 <!--SIDE BAR-->
 
     <div id="sidebar">
		 <?php 
			 //Load Login Block
			 if(isLoggedIn() === false || $this->session->userdata('role') == 'admin' || $this->session->userdata('role')=='')
			 {	 
				//$this->load->view('sidePanel/usersAccount');
			 }	
			  //Load Owner Account Area
			  if(is_object($loggedInUser) and $loggedInUser->role_name == 'owner')
			  {
					$this->load->view('sidePanel/ownerAccount');
			  }
			  //Load Employee Account Area
			  if(is_object($loggedInUser) and $loggedInUser->role_name == 'employee')
			  {
					$this->load->view('sidePanel/employeeAccount');
			  }
			  
			 //Load services and features Block
			 $this->load->view('sidePanel/servicesAndFeatures');
			 //Load latest works Block
			 $this->load->view('sidePanel/latestJobs');
		 ?>
    </div>


 <!--END OF SIDE BAR-->