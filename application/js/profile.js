var login_error = 0;
var from_other_pageto_login = 0;

function moveMouse(id, desc, image) {
    //alert(image);
    $("#infoDiv").show();
    $("#infoDiv").html('<p>Price:' + id + '</p><p>Description:' + desc + '</p><p class="Prod"> <b>Product</b></p><p class="Prodimg"> <img src="<?php echo base_url();?>uploads/' + image + '" height=100 widht=100 class="prdct"/></p>');

}

$(function () {
    $("#tabs").tabs().addClass("ui-tabs-vertical ui-helper-clearfix");
    $("#tabs li").removeClass("ui-corner-top").addClass("ui-corner-left");
});

$(function () {
    var ig = '<img src="'+webroot+'/application/css/images/minus.png" alt="" />';
    var removeLink = '<a class="remove" href="#" onclick="$(this).parent().slideUp(function(){ $(this).remove() }); return false">' + ig + '</a>';
    $('a.add').relCopy({
        append: removeLink
    });
    $('a.addone').relCopy({
        append: removeLink
    });
    $('a.addfile').relCopy({
        append: removeLink
    });
});

$(document).ready(function () {
    $("#changeprofile").hide();
    $('#prof').hide();
    $('#tabs4').hide();
    $('#hideprof').hide();
    $('#editprof').click(function () {
        $('#prof').show();
        $('#hideprof').show();
        $("#onupload").hide();
        $("#changeprofile").show();
		 $('#tabs-1').hide();
    });
    $('#hideprof').click(function () {
        $('#prof').hide();
        $('#hideprof').hide();
    });
    $('#gallery').click(function () {
        $('#tabs-1').hide();
        $('#tabs-2').hide();
        $('#tabs3').hide();
        $('#tabs-3').hide();
        $('#tabs4').show();
    });
    $('#tabs3').click(function () {
        //alert("hi");
        $('#tabs-1').hide();
        $('#tabs-2').hide();
        $('#tabs-3').show();
        $('#tabs4').hide();
        $('#gallery').hide();
    });
    $('#tabs1').click(function () {
        //alert("hi");
        $('#tabs-1').show();
        $('#tabs-2').hide();
        $('#tabs-3').hide();
        $('#tabs4').hide();
        $("#changeprofile").hide();
        $('#tabs-1').show();
        $('#onupload').show();
    });
    $('#editprof').click(function () {
        //alert("hi");
        $('#tabs-1').show();
        $('#tabs-2').hide();
        $('#tabs-3').hide();
        $('#tabs4').hide();
        $("#onupload").hide();
        $("#changeprofile").show();
    });
    $('#tabs2').click(function () {
        $('#tabs-1').hide();
        $('#tabs-2').show();
        $('#tabs-3').hide();
        $('#tabs4').hide();
    });

    $("#message-mode-form").find("#buyerview").first().click(function() {
        $(this).closest('form').submit();
    });
    
    $("#message-mode-form").find("#sellerview").first().click(function() {
        $(this).closest('form').submit();
    });
    
    var profileer = $("#errid").val();
    if (profileer == 1) {

        $('#tabs-2').hide();
        $('#tabs-3').hide();
        $('#tabs4').hide();
        $("#onupload").hide();
        $("#changeprofile").show();
        $('#prof').show();
        $('#hideprof').show();
        $("#onupload").hide();
        $("#changeprofile").show();
    }


    var getid = $('#errorid').val();
    var phot = $('#photoimg').val();

    //alert(getid);
    if ((getid != '') && (phot == '')) {
        $('#tabs-1').hide();
        $('#tabs-2').hide();
        $('#tabs-3').hide();
        $('#tabs-4').show();
        alert("Please Enter All Fields");
    }
	
	/*
    $('#photoimg').change(function () {
       
		
		

    });
	*/
	
	$('#submitproduct').click(function () {
		if($(".add_p_class").val() !="" ){
			$("#previewid").html('<img src="'+webroot+'/application/css/images/ajax-loader.gif" alt="Uploading...."/>');
			$("#imageform").ajaxForm({
				target: '#previewid',
				success: function(response) { 
					$(".add_p_class").css("border", "1px solid #E1E1E1");
					$(".upload_suc").show(); 
					$(".add_p_class").val("");
					var url = window.location.href; 
					utl = url.replace('#', '');
					url += (url.indexOf('?') > -1)?"&":"?" + "goto=gallery";
					
					var delay = 2000;
					setTimeout(function(){ window.location.href = url; }, delay);
				}
			}).submit();
		}else{
			$(".add_p_class").css("border", "1px solid red");
			return false;
		}
		
	});
	
	
	 

    $("a.popup").click(function () {
        loading(); // loading
        setTimeout(function () { // then show popup, deley in .5 second
            loadPopup(); // function show popup
        }, 500); // .5 second
        return false;
    });

    /* event for close the popup */
    $("div.closed").hover(
        function () {
            $('span.ecsp_tooltip').show();
        },
        function () {
            $('span.ecsp_tooltip').hide();
        }
    );

    $("div.closed").click(function () {
        disablePopup(); // function close pop up
    });

    $(this).keyup(function (event) {
        if (event.which == 27) { // 27 is 'Ecs' in the keyboard
            disablePopup(); // function close pop up
        }
    });

    $('a.livebox').click(function () {
        alert('Hello World!');
        return false;
    });

    function loading() {
        $("div.loader").show();
    }

    function closeloading() {
        $("div.loader").fadeOut('normal');
    }

    var popupStatus = 0; // set value

    function loadPopup() {
        if (popupStatus == 0) { // if value is 0, show popup
            closeloading(); // fadeout loading
            $("#Popup").fadeIn(0500); // fadein popup div
            $("#backgroundPopup").css("opacity", "0.7"); // css opacity, supports IE7, IE8
            $("#backgroundPopup").fadeIn(0001);
            popupStatus = 1; // and set value to 1
        }
    }

    function disablePopup() {
        if (popupStatus == 1) { // if value is 1, close popup
            $("#Popup").fadeOut("normal");
            $("#backgroundPopup").fadeOut("normal");
            popupStatus = 0; // and set value to 0
        }
    }


    $('#tabs-2').hide();
    $('#tabs1').click(function () {
        $('#tabs-1').show();
        $('#tabs-2').hide();
    });
    $('#tabs2').click(function () {
        $('#tabs-1').hide();
        $('#tabs-2').show();
    });

    $("#rate").click(function () {
        alert("hi");
        var jobpostid = $("#jobid").val();
        $("#jobpost").val(jobpostid);
        var bidderid = $("#bidderid").val();
        $("#biduserid").val(bidderid);
        var biddermailid = $("#bidderemail").val();
        //alert(biddermailid);
        $("#bidderemailid").val(biddermailid);
        var jobname = $("#jobname").val();
        $("#jobnames").val(jobname);
        var jobposter = $("#jobowner").val();
        //alert(jobposter);
        $("#poster").val(jobposter);
        var budget = $("#jobbudged").val();
        $("#jobbudget").val(budget);
        var jobownermail = $("#owneremail").val();
        $("#ownermail").val(jobownermail);
        var jobposterid = $("#jobownerid").val();
        $("#ownerid").val(jobposterid);
    });

    $("#credits").click(function () {
        var credt = $("#creditavailable").val();
        $('div.ajaxpopforminner #showrs').html(credt);
    });

    $(".selrrating").click(function () {
        var buyids = $("#jobsid").val();
        $("#buyid").val(buyids);
        var selrid = $("#slrid").val();
        $("#selserid").val(selrid);
        var slremailid = $("#slereml").val();
        $("#selleremailid").val(slremailid);
        var buyjobname = $("#buyname").val();
        $("#jobbuynames").val(buyjobname);
        var jobername = $("#creatorname").val();
        $("#postername").val(jobername);
        var buyeremail = $("#creatormail").val();
        $("#ownermailid").val(buyeremail);
        var buyerid = $("#creatorid").val();
        // alert(buyerid);
        $("#ownersid").val(buyerid);
    });
    $("#pastwork").hide();
    $("#postfeedback").hide();
    $("#feedback").click(function () {
        //alert("hi");
        $("#feedback").addClass("clsActive");
        $('#progres').removeClass('clsActive');
        $("#paswrk").removeClass('clsActive');
        $("#postfeedback").show();
        $("#pastwork").hide();
        $("#byer").hide();
        $("#wrkin").hide();
        $("#selerwrkingp").hide();
        $("#selerfeedb").hide();
        //$("#forseller").hide();
        //$("#forbuyer").hide();
    });
    $("#progres").addClass("clsActive");
    $("#wrkin").hide();
    $("#progres").click(function () {
        //alert("wrkinp");
        $("#progres").addClass("clsActive");
        $("#paswrk").removeClass('clsActive');
        $("#feedback").removeClass('clsActive');
        $("#wrkin").hide();
        $("#pastwork").hide();
        $("#byer").show();
        $("#postfeedback").hide();
        $("#selerwrkingp").hide();
        $("#selerfeedb").hide();
    });
    $("#paswrk").click(function () {
        //alert("hi");
        //alert("paswrk");
        $("#paswrk").addClass("clsActive");
        $('#progres').removeClass('clsActive');
        $("#feedback").removeClass('clsActive');
        $("#selerwrkingp").hide();
        $("#pastwork").show();
        $("#postfeedback").hide();
        $("#byer").hide();
        $("#wrkin").hide();
        $("#selerfeedb").hide();
    });
    $("#selerwrkin").addClass("clsActive");
    $("#selerpastwrk").hide();
    $("#slerpask").click(function () {
        $("#slerpask").addClass("clsActive");
        $('#selerwrkin').removeClass('clsActive');
        $('#selerfeedback').removeClass('clsActive');
        $("#selerwrkingp").hide();
        $("#selerpastwrk").show();
        $("#selerhome").hide();
        $("#selerfeedb").hide();
    });


    $("#selerhome").show();
    $("#selerwrkingp").hide();
    $("#selerwrkin").click(function () {
        $("#slerpask").removeClass("clsActive");
        $('#selerwrkin').addClass('clsActive');
        $('#selerfeedback').removeClass('clsActive');
        $("#selerpastwrk").hide();
        $("#selerhome").show();
        $("#selerwrkingp").hide();
        $("#selerfeedb").hide();
    });
    $("#selerfeedb").hide();
    $("#selerfeedback").click(function () {
        $("#slerpask").removeClass("clsActive");
        $('#selerwrkin').removeClass('clsActive');
        $('#selerfeedback').addClass('clsActive');
        $("#selerhome").hide();
        $("#selerpastwrk").hide();
        $("#selerwrkingp").hide();
        $("#selerfeedb").show();
        $("#pastwork").hide();
    });
    $("#byer").show();
    $("#forseller").hide();
    $("#wrkin").hide();
    $("input[name$='view']").click(function () {
        var test = $(this).val();
        //alert(test);
        //$("#selerfeedb").hide();
        if (test == 1) {
            //alert(test);
            $("#forbuyer").show();
            //alert("hi");
            $("#progres").addClass("clsActive");
            $("#byer").show();
            $("#forseller").hide();
            $("#postfeedback").hide();
            $("#pastwork").hide();
            $("#wrkin").hide();
            $("#selerpastwrk").hide();
            $("#selerwrkingp").hide();
            $("#selerfeedb").hide();
        }
        if (test == 2) {
            //alert("hi");
            $("#forbuyer").hide();
            $("#selerhome").show();
            $("#forseller").show();
            $("#postfeedback").hide();
            $("#pastwork").hide();
            $("#wrkin").hide();
            $("#selerpastwrk").hide();
            $("#selerwrkingp").hide();
            $("#selerfeedb").hide();
        }
    });


});