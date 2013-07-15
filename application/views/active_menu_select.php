<?php
	$dashboard_class = $members_class = $activity_class = $speeches_class = $interview_class = 
	$event_class = $achievements_class = $project_class =  $news_class = $msgapl_class = $comcou_class = "";
	$url_data = $_SERVER['REQUEST_URI'];
	
	$admin_d1 = extract($admin_d[0]['LokAdmin']);
	
	if (false !== strpos($url_data,'members') || false !== strpos($url_data,'edit_member')) {
		$members_class = "active";
	}else if (false !== strpos($url_data,'speeches') || false !== strpos($url_data,'edit_speeches')) {
		$speeches_class = "active";
	}else if (false !== strpos($url_data,'interviews') || false !== strpos($url_data,'edit_interviews')) {
		$interview_class = "active";
	}else if (false !== strpos($url_data,'achievements') || false !== strpos($url_data,'edit_achievement')) {
		$achievements_class = "active";
	}else if (false !== strpos($url_data,'events') || false !== strpos($url_data,'edit_event')) {
		$event_class = "active";
	}else if (false !== strpos($url_data,'projects') || false !== strpos($url_data,'edit_project')) {
		$project_class = "active";
	}else if (false !== strpos($url_data,'news') || false !== strpos($url_data,'edit_news')) {
		$news_class = "active";
	}else if (false !== strpos($url_data,'msgapl') || false !== strpos($url_data,'edit_msgapl')) {
		$msgapl_class = "active";
	}else if (false !== strpos($url_data,'comcou') || false !== strpos($url_data,'edit_comcou')) {
		$comcou_class = "active";
	}else{
		$dashboard_class = "active";
	}   

	
?>