
/*   
ajax popup form Version 1.0.1
Tools URI: http://www.birghtyoursite.com
Description:  ajaxpopupform  is a $ based cool , professional popup window which can be used as contact , feedback … forms on your websites .
Author: alex wang
Author URI: http://www.birghtyoursite.com/
*/


$(document).ready(function(){ 
    
    
    $('.msgform .canceld span').click(function(){
        $('#msgform').fadeOut(500);
    });
    $('.submit-msg .form-submit-msg span').click(function(){  
      $('#msgform').submit();
    });
    $('.msgcls').click(function(){
        $('.msgform').stop();
        $('.msgform').fadeIn(500);
        $(this).blur();
    });
    $(".star-rating li a").click(function()
      {
            $(this).stop();
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
    
    $("#msgform").submit(function(){
										
		dataString = $("#msgform").serialize();  
		$.ajax({
		type: "POST",
		url: webroot+"index.php/job/msg",
		//url: "http://demo.maventricks.com/lalbook/application/views/msg.php",
		data: dataString,
		dataType: "json",
		success: function(data) {  
			if(data.success){ 
				$(".msgformwrapper").css('display','none'); 
				$("#msgform-success").fadeIn(500); 
				window.location.reload();
			}  
			else
			{
				
			  $('.msgformwrapper  .pof-error').removeClass('pof-error');
			  $('.msgformwrapper  .errormsg').remove();
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