
/*   
ajax popup form Version 1.0.1
Tools URI: http://www.birghtyoursite.com
Description:  ajaxpopupform  is a jquery based cool , professional popup window which can be used as contact , feedback … forms on your websites .
Author: alex wang
Author URI: http://www.birghtyoursite.com/
*/

jQuery.fn.center = function () {
	
    this.css("position","absolute");
    this.css("top", ( jQuery(window).height() - this.height() ) / 2+jQuery(window).scrollTop() + "px");
    this.css("left", ( jQuery(window).width() - this.width() ) / 2+jQuery(window).scrollLeft() + "px");
    return this;
}

    jQuery(document).ready(function(){ 
    
    jQuery(window).scroll( function() { 
     
     jQuery('#ajaxpopform').css("top", ( jQuery(window).height() - jQuery('#ajaxpopform').height() ) / 2+jQuery(window).scrollTop() + "px");;
     
     
     } );  
    jQuery(window).resize(function(){
        jQuery('#ajaxpopform').center();
    }); 
    jQuery('.ajaxpopform .cancel span').click(function(){
        jQuery('#ajaxpopform').fadeOut(500);
    });
    jQuery('.submit-button .form-submit-button span').click(function(){  
      jQuery('#ajaxpopform').submit();
    });
    jQuery('.popup-button').click(function(){
        jQuery(this).stop();
        jQuery('#ajaxpopform').center();
        jQuery('#ajaxpopform').fadeIn(500);
        jQuery(this).blur();
    });
    jQuery(".star-rating li a").click(function()
      {
            jQuery(this).stop();
          var b=this.id;
          var a = b.split("-");
          var rating = a[0];
          var score = a.slice(-1);
          jQuery("#"+rating + "-rating-input-" + score)[0].checked = true;
          jQuery("#"+rating + "-stars").css("width", 20 * score + "%");
          jQuery(this).children("input").blur();
          jQuery(this).parent().parent().children('.current-rating').css('z-index',7);
      }
    );
    jQuery(".star-rating").mouseover(function()
      {
            
          jQuery(this).children('.current-rating').css('z-index',0);
           
      }
    );
    jQuery(".star-rating").mouseout(function()
      {
             
          jQuery(this).children('.current-rating').css('z-index',7);
           
      }
    );
    
    jQuery("#ajaxpopform").submit(function(){
										
		dataString = jQuery("#ajaxpopform").serialize();  
		jQuery.ajax({
		type: "POST",
		url: "http://demo.maventricks.com/lalbook/application/views/usersignup.php",
		data: dataString,
		dataType: "json",
		success: function(data) {  
			if(data.success){ 
				jQuery(".ajaxpopformwrapper").css('display','none'); 
				jQuery("#ajaxpopform-success").fadeIn(500); 
				jQuery('#ajaxpopform').center();
			}  
			else
			{
			  jQuery('.ajaxpopformwrapper  .pof-error').removeClass('pof-error');
			  jQuery('.ajaxpopformwrapper  .errormsg').remove();
			  for(var i=0 ; i < data.errors.length ; i++ )
			  { 
			    if(!jQuery('#help-us-'+data.errors[i].field).parent().parent().hasClass('pof-error'))
                {
                  jQuery('#help-us-'+data.errors[i].field).parent().parent().addClass('pof-error');
                  jQuery('#help-us-'+data.errors[i].field).parent().parent().append('<div class="errormsg">'+data.errors[i].error+'</div>');
                }
              }
			}
	 	 
		} 
		
		});
		
		return false;			
		
	});
    
    });