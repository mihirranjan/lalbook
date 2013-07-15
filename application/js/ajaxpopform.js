
/*   
ajax popup form Version 1.0.1
Tools URI: http://www.birghtyoursite.com
Description:  ajaxpopupform  is a $ based cool , professional popup window which can be used as contact , feedback … forms on your websites .
Author: alex wang
Author URI: http://www.birghtyoursite.com/
*/
var field_signup = new Array ("fulname","email","username","message","password","cpassword","help-us-terms");



$(document).ready(function(){ 
    
      
     
    $('.ajaxpopform .cancel span').click(function(){
													  // alert("tst");
        $('#ajaxpopform').fadeOut(500);
		
    });
    $('.submit-button .form-submit-button span').click(function(){  
		
      $('#ajaxpopform').submit();
    });
	
    $('.popup-button').click(function(){
        $('#ajaxpopform').fadeIn(500);
        $(this).blur();
		$(".border_class").css("border", "none");
		$(".mandatory").remove();
		field_reset(field_signup);	
			
    });
	
    $(".star-rating li a").click(function()
      {
          var b=this.id;
          var a = b.split("-");
          var rating = a[0];
          var score = a.slice(-1);
          $("#"+rating + "-rating-input-" + score)[0].checked = true;
          $("#"+rating + "-stars").css("width", 20 * score + "%");
          $(this).children("input").blur();
          $(this).parent().parent().children('.current-rating').css('z-index',7);
      }
    );
    $(".star-rating").mouseover(function()
      {
            
          $(this).children('.current-rating').css('z-index',0);
           
      }
    );
    $(".star-rating").mouseout(function()
      {
             
          $(this).children('.current-rating').css('z-index',7);
           
      }
    );
    
    $("#ajaxpopform").submit(function(){
		
		dataString = $("#ajaxpopform").serialize();
		if(field_error(field_signup)){
			$(".ajax_loader").show(); 
			$.ajax({
				type: "POST",
				url: webroot+"index.php/users/usersignup",
				data: dataString,
				dataType: "json",
				success: function(data) {  
					if(data.success){ 
						$(".ajax_loader").hide(); 
						$(".ajaxpopformwrapper").css('display','none'); 
						$("#ajaxpopform-success").fadeIn(500); 
						$('.ajaxpopform .cancel span').click(function(){
							window.location.reload();
						});
					} else{
						$(".ajax_loader").hide(); 
						$('.ajaxpopformwrapper  .mandatory').remove();
						
						for(var i=0 ; i < data.errors.length ; i++ ){ 
							
							if(!$('#'+data.errors[i].field).after().hasClass('mandatory')){
								$('#'+data.errors[i].field).after('<span class="mandatory">'+data.errors[i].error+'</span>');
							}else{
								$('#'+data.errors[i].field).css("border", "none");
							}
						}
					}
				} 
			});
		}
		return false;			
	});
    
	
	
});

function field_reset(field_signup){
	for(var i=0 ; i < field_signup.length ; i++ ){ 
		if(field_signup[i] == "help-us-terms"){
			$("#"+field_signup[i]).attr('checked', false);
		}else{
			$("#"+field_signup[i]).val("");
		}
	}
	$("#message").val(""); 
}
function field_error(field_signup){
	var fld1 = fld2 = fld3 = fld4 = fld5 = fld6 = fld7 = 0;
	for(var i=0 ; i < field_signup.length ; i++ ){ 
		if(field_signup[i] == "help-us-terms"){
			
			if(!$("#"+field_signup[i]).is(':checked')){
				$(".terms").css("border","1px solid red");
				$("#"+field_signup[i]).attr('checked', false);
				fld1 = 0;
			}else{
				$(".terms").css("border","none");
				$("#"+field_signup[i]).attr('checked', true);
				fld1 = 1;
			}
			
		}
		if(field_signup[i] == "email"){
			var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
			//var address = document.getElementById[email].value;
			
			if($("#"+field_signup[i]).val()==""){
				$("#"+field_signup[i]).css("border","1px solid red");
				fld2 = 0;
			}else if (reg.test($("#"+field_signup[i]).val() ) == false) {
				if($("#inv_email").length > 0){
					
				}else{
					$("#"+field_signup[i]).after("<span id='inv_email' class='mandatory'>Invalid email id</span>");
				}
				fld2 = 0;
				$("#"+field_signup[i]).css("border","1px solid red");
				
			}else{
				$("#inv_email").remove();
				$("#"+field_signup[i]).css("border","none");
				fld2 = 1;
			}
		}
		if(field_signup[i] == "message"){
				
				if($("#"+field_signup[i]).val()==""){
					$("#"+field_signup[i]).css("border","1px solid red");
					fld3 = 0;
				}else{
					$("#"+field_signup[i]).css("border","none");
					fld3 = 1;
				}
		}
		if(field_signup[i] == "cpassword"){
				
			if($("#"+field_signup[i]).val()==""){
				$("#"+field_signup[i]).css("border","1px solid red");
				fld4 = 0;
			}else if ($("#"+field_signup[i]).val() != $("#"+field_signup[i-1]).val()) {
				$("#"+field_signup[i]).after("<span id='not_match' class='mandatory'>password fields are not same</span>");
				$("#"+field_signup[i]).css("border","1px solid red");
				fld4 = 0;
			}else{
				$("#not_match").remove();
				$("#"+field_signup[i]).css("border","none");
				fld4 = 1;
			}
		}
		
		if(field_signup[i] == "fulname"){
				
			if($("#"+field_signup[i]).val()==""){
				$("#"+field_signup[i]).css("border","1px solid red");
				fld5 = 0;
			}else{
				$("#"+field_signup[i]).css("border","none");
				fld5 = 1;
			}
		}
		
		if(field_signup[i] == "username"){
				
			if($("#"+field_signup[i]).val()==""){
				$("#"+field_signup[i]).css("border","1px solid red");
				fld6 = 0;
			}else{
				$("#"+field_signup[i]).css("border","none");
				fld6 = 1;
			}
		}
		
		if(field_signup[i] == "password"){
				
			if($("#"+field_signup[i]).val()==""){
				$("#"+field_signup[i]).css("border","1px solid red");
				fld7 = 0;
			}else{
				$("#"+field_signup[i]).css("border","none");
				fld7 = 1;
			}
		}
	}
	if( fld1 == 1 && fld2 == 1 && fld3 == 1 && fld4 == 1 && fld5 == 1 && fld6 == 1 && fld7 == 1){
		return true;
	}else{	
		return false;
	}
	
}





















