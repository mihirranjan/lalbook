
/*   
ajax popup form Version 1.0.1
Tools URI: http://www.birghtyoursite.com
Description:  ajaxpopupform  is a $ based cool , professional popup window which can be used as contact , feedback … forms on your websites .
Author: alex wang
Author URI: http://www.birghtyoursite.com/
*/



 $(document).ready(function(){ 
    
    
   
    $('.tobiddmsgform .canceldd span').click(function(){
        $('#tobiddmsgform').fadeOut(500);
    });
    $('.submit-tomsg .form-submit-tomsg span').click(function(){  
      $('#tobiddmsgform').submit();
    });
    $('.tomsg').click(function(){
		 var p = $('.tomsg').position();
		
        $('.tobiddmsgform').stop();
        $('.tobiddmsgform').css("top",(p.top-200)).css("left", (p.left+200)).fadeIn(500);
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
    
    $("#tobiddmsgform").submit(function(){
		$(".ajax_loader").show();						
		dataString = $("#tobiddmsgform").serialize();  
		$.ajax({
		type: "POST",
		url: webroot+"index.php/job/tomsg",
		//url: "http://demo.maventricks.com/lalbook/application/views/tomsg.php",
		data: dataString,
		dataType: "json",
		success: function(data) {  
			if(data.success){ 
				$(".ajax_loader").hide();
				$(".tomsgformwrapper").css('display','none'); 
				$("#tomsgform-success").fadeIn(500); 
				window.location.reload();
			}  
			else
			{
				$(".ajax_loader").hide();
			  $('.tomsgformwrapper  .pof-error').removeClass('pof-error');
			  $('.tomsgformwrapper  .errormsg').remove();
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