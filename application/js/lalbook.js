


$(document).ready(function() {
	
	//gallery 
	$(".trigger").mouseover(function(){
		$(this).next(".vnu-title").show();
	});
	$(".trigger").mouseout(function(){
		$(this).next(".vnu-title").hide();
	});
	
	$(".vnu-title").mouseover(function(){
		$(this).show();
	});
	$(".vnu-title").mouseout(function(){
		$(this).hide();
	});
	
	$(".show").mouseover(function(){
		$(this).parent().next().show();
	});
	$(".show").mouseout(function(){
		$(this).parent().next().hide();
	});
	
	
	
	//My Profile Tab Details to Edit
	$(".edit_option").click(function() {
		$(".profile_edit" ).show();
		$(".view_details" ).hide(); 
	});
	$("#show_details").click(function() {
		$(".profile_edit" ).hide();
		$(".view_details" ).show(); 
	});
	$("#tabs1").click(function() {
		$(".profile_edit" ).hide();
		$(".view_details" ).show(); 
	});
	
	
	$(".list_id").attr("id","removetabs");
	
	//Draggable
	$( ".bidform" ).draggable({ containment: ".Container"});
	$( ".ajaxpopform" ).draggable({ containment: ".Container"}); 
	$( ".msgform" ).draggable({ containment: ".Container"});  
	$( ".tobiddmsgform" ).draggable({ containment: ".Container"}); 
	$( ".amountedit" ).draggable({ containment: ".Container"});  
	$( ".nologin" ).draggable({ containment: ".Container"}); 
	
	
	//reset the industry if any error
	if($("#reqtype").val()!=""){
		var reqtype = $("#reqtype").val();
		var hdn_industry = $("#hdn_industry").val();
		get_cities(reqtype, hdn_industry);
	}
	
	
	//Datepicker
	var date = new Date();
	var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();
	$('#popupDatepicker').datepicker({minDate: new Date(y, m, d)});
	$('#inlineDatepicker').datepicker({minDate: new Date(y, m, d)});
	$('#help-us-deliverdate').datepicker({minDate: new Date(y, m, d)}); 
	
	$('.seller').hover(function () {
		$('.clsPostReq').addClass('clsPostReqs');
		
	}, function () {
		$('.clsPostReq').removeClass('clsPostReqs');
	});
	
	/*
	js - Animation
	if(login_error == 0){
		$('.clsLeftimg').show(1500,function(){
			$('.clsLeftimg').animate({
			marginLeft: "0px"
			}, 400,function(){
				
			});
		 });
		 
		$('.clsRightimg').show(1500,function(){
			$('.clsRightimg').animate({
				marginRight: "0px"
			}, 400,function(){
			
				
			$('.clsPostReq').slideDown(1500,function(){
				
				$('.clsPostReq').show(1500,function(){
					$('.clsPostReq').animate({
					marginTop: "0px"
					}, 400,function(){
						
					});
				 });

			
				$('.clsPostReq').animate({
					marginLeft: "250px"
				}, 400,function(){
					$('.clsPostReq').animate({
						marginLeft: "-250px"
					}, 400,function(){
						$('.clsPostReq').animate({
							marginLeft: "115px"
						}, 800,function(){
								
						});	
					});	
				});
			});
				
				
				
			});
		});
	}else{
		$('html, body').animate({
			 scrollTop: "500px"
		 }, 400);
	}
	
	*/
	
	if(login_error == 1){
		$('html, body').animate({
			 scrollTop: "500px"
		 }, 400);
	}
	 
	

	$("#goto_login_form").click(function() {
		$('html, body').animate({
			 scrollTop: "500px"
		 }, 400);
	});
 });
 
 
// Js for VIEW REQUIREMENT
//url: webroot+"index.php/requirement/industry"


//Customise file upload
var wrapper = $('#file_type').css({height:0,width:0,'overflow':'hidden'});								
$('#file_type').change(function(){
	$('#txt_file').val($(this).val());
})

$('#file_lavel').click(function(){
	$('#file_type').click();
});

$('#txt_file').click(function(){
	$('#file_type').click();
});

										


function get_cities(business_id, ind_id){
	$.ajax({
		type: "POST",
		url: webroot+"index.php/requirement/industry", /* The country id will be sent to this file */
		beforeSend: function () {
			$("#industry").html("<option>Loading ...</option>");
		},
		data: "business_id="+business_id+"&ind_id="+ind_id,
		success: function(msg){
			$("#industry").html(msg);
		}
	});
} 



function showDate(date) {
	alert('The date chosen is ' + date);
}

function validate_requirement(){
	$(".req_field").each(function(){
		if($(this).val() == ""){
			$(this).css("border","1px solid red");
			$(this).addClass("class_error");

		}else{
			$(this).css("border","1px solid #CCCCCC");
			$(this).removeClass("class_error");
		}
	});

	if($(".class_error").length == 0 ){
		return true;
	}else{
		return false;
	}
}

 
 // Js for LOGIN	
 function login_validate(id){
	var count1 = single_field_validate("username");
	var count2 = single_field_validate("pwd");
	if(count1 == true  && count2== true){
		document.getElementById("userlogin").submit();
	}else{
		return false;
	}
	
 }
 
 function single_field_validate(id){
	if($("."+id).val() == ""){
		$("."+id).css("border","1px solid red");
		return false;
	}else{
		$("."+id).css("border","1px solid #CCCCCC");
		return true;
	}
 }


function example_popup() {
	var w = window.open('', '', 'width=400,height=400,resizeable,scrollbars');
	w.document.write(document.getElementById('example_text').value);
	w.document.close(); // needed for chrome and safari
} 

function watermarks(inputId,text){
  var inputBox = document.getElementById(inputId);
    if (inputBox.value.length > 0){
      if (inputBox.value == text)
        inputBox.value = '';
    }
    else
      inputBox.value = text;
}


 
 