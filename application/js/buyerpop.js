
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
     
     jQuery('#buyerrating').css("top", ( jQuery(window).height() - jQuery('#buyerrating').height() ) / 2+jQuery(window).scrollTop() + "px");;
     
     
     } );  
    jQuery(window).resize(function(){
        jQuery('#buyerrating').center();
    }); 
    jQuery('.buyerrating .buyercancel span').click(function(){
        jQuery('#buyerrating').fadeOut(500);
    });
    jQuery('.buyersumbit-button .buyerform-submit-button span').click(function(){  
      jQuery('#buyerrating').submit();
    });
    jQuery('.buyerpop-button').click(function(){ 
											 
        jQuery(this).stop();
        jQuery('#buyerrating').center();
        jQuery('#buyerrating').fadeIn(500);
        jQuery(this).blur();
		//jQuery( "#tabs" ).tabs();
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
    
    jQuery(".buyerpop-button").click(function(){
										
		dataString = jQuery("#buyerrating").serialize();  
		jQuery.ajax({
		type: "POST",
		url: "http://demo.maventricks.com/lalbook/index.php/mybusiness/getComments", 
		data: dataString,
		dataType: "json",
		success: function(data) {  
			if(data.success){ 
			
				// alert("one");
			jQuery('#loose').html(data);
			
				jQuery(".buyerratingwrapper").css('display','none'); 
				jQuery("#buyerform-success").fadeIn(500); 
				jQuery('#buyerrating').center();
				window.location.reload();
			}  
			else
			{
				 //alert("two");
			  jQuery('.buyerratingwrapper  .pof-error').removeClass('pof-error');
			  jQuery('.buyerratingwrapper  .errormsg').remove();
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