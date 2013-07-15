
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
     
     jQuery('#amountedit').css("top", ( jQuery(window).height() - jQuery('#amountedit').height() ) / 2+jQuery(window).scrollTop() + "px");;
   
     
     } );  
    jQuery(window).resize(function(){
        jQuery('#amountedit').center();
    }); 
    jQuery('.amountedit .closebutn span').click(function(){
        jQuery('#amountedit').fadeOut(500);
    });
    jQuery('.submit-amt .form-submit-amt span').click(function(){  
      jQuery('#amountedit').submit();
    });
    jQuery('.amtedit').click(function(){
        jQuery('.amountedit').stop();
        jQuery('.amountedit').center();
        jQuery('.amountedit').fadeIn(500);
        jQuery(this).blur();
    });
    
    
    
    jQuery("#amountedit").submit(function(){
								
		dataString = jQuery("#amountedit").serialize();  
		jQuery.ajax({
		type: "POST",
		url: "http://demo.maventricks.com/lalbook/application/views/editamt.php",
		data: dataString,
		dataType: "json",
		success: function(data) {  
			if(data.success){ 
				jQuery(".amtformwrapper").css('display','none'); 
				jQuery("#amtform-success").fadeIn(500); 
				jQuery('#amountedit').center();
				window.location.reload();
			}  
			else
			{
				
			  jQuery('.amtformwrapper  .pof-error').removeClass('pof-error');
			  jQuery('.amtformwrapper  .errormsg').remove();
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