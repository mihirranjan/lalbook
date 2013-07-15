

<?php 

		$business_id = $_REQUEST['business_id']; 
		
		//FOR PRODUCT AND SERVICES

		$condition = array('category.cate_type'=>$business_id);
		$industryResult = $this->admin_model->getIndustries($condition);
		
		if(isset($industryResult) && $industryResult->num_rows()>0){
		foreach($industryResult->result() as $industry){
		echo "<option value='".$industry->category."'>".$industry->category."</option>";
       } }

		if($business_id==3) //FOR BOTH
		{
		$industryResults = $this->admin_model->getIndustries(NULL,NULL);
	
	    if(isset($industryResults) && $industryResults->num_rows()>0){
		foreach($industryResults->result() as $industrys){
		echo "<option value='".$industrys->category."'>".$industrys->category."</option>";
		} }
	
		}
?>