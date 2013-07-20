
/*   
ajax popup form Version 1.0.1
Tools URI: http://www.birghtyoursite.com
Description:  ajaxpopupform  is a $ based cool , professional popup window which can be used as contact , feedback … forms on your websites .
Author: alex wang
Author URI: http://www.birghtyoursite.com/
*/


$(document).ready(function(){ 
    
  
    $('.amountedit .closebutn span').click(function(){
        $('#amountedit').fadeOut(500);
    });
    $('.submit-amt .form-submit-amt span').click(function(){  
      $('#amountedit').submit();
    });
	
    $('.amtedit').click(function(){
        
		var p = $('.amtedit').position();
		
        $('.amountedit').stop();
        $('.amountedit').css("top",(p.top-200)).css("left", (p.left+200)).fadeIn(500);
        $('.amountedit').fadeIn(500);
        $(this).blur();
    });
    
    
    
    $("#amountedit").submit(function(){
		$(".ajax_loader").show(); 						
		dataString = $("#amountedit").serialize();  
		$.ajax({
		type: "POST",
		url: webroot+"index.php/job/editamt",
		//url: "http://demo.maventricks.com/lalbook/application/views/editamt.php",
		data: dataString,
		dataType: "json",
		success: function(data) {  
			if(data.success){ 
				$(".ajax_loader").hide(); 
				$(".amtformwrapper").css('display','none'); 
				$("#amtform-success").fadeIn(500); 
				window.location.reload();
			}  
			else
			{
				$(".ajax_loader").hide();	
			  $('.amtformwrapper  .pof-error').removeClass('pof-error');
			  $('.amtformwrapper  .errormsg').remove();
			  for(var i=0 ; i < data.errors.length ; i++ )
			  { 
			    if(!$('#help-us-'+data.errors[i].field).parent().parent().hasClass('pof-error'))
                {
                  $('#help-us-'+data.errors[i].field).parent().parent().addClass('pof-error');
                  $('#help-us-'+data.errors[i].field).parent().parent().append('<div class="errormsg">'+data.errors[i].error+'</div>');
                }
              }
			}
	 	 
		} 
		
		});
		
		return false;			
		
	});
    
    });