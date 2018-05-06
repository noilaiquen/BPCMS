$(document).ready(function(){
	// call function scroll mobile
	if($( window ).width() <=350){
		$('.imgaes').click(function(){
			return false;
		});
	}
	
	// home login-logout
	 $('.fancybox').fancybox({
            padding : 0,
            openEffect  : 'elastic',
            closeBtn: false,
			closeEffect	: 'elastic',
			 scrolling: 'no',
			 scrollOutside: true,
			 'speedIn'		:	800, 
			'speedOut'		:	800,
			width:'auto',
			helpers: {
			title: false,
			overlay: {
			  locked: false
			}
		}// end helper
        });// end fancybox
		
	$('.fancybox-out').fancybox({
            padding : 0,
            openEffect  : 'elastic',
            closeBtn: false,
			closeEffect	: 'elastic',
			 scrolling: 'no',
			 scrollOutside: true,
			 'speedIn'		:	800, 
			'speedOut'		:	800,
			helpers: {
				overlay: {
				  locked: false
				},
			    title: false
		}// end helper
    });// end fancybox
	
	$('.bnt-forgot-pass').fancybox({
            padding : 0,
            openEffect  : 'elastic',
            closeBtn: false,
			closeEffect	: 'elastic',
			 scrolling: 'no',
			 scrollOutside: true,
			 'speedIn'		:	800, 
			'speedOut'		:	800,
			helpers: {
				overlay: {
				  locked: false
				},
			title: false
		}// end helper
    });// end fancybox
	
	$('.imgaes').fancybox({
		padding:0,
		 // minWidth: 250,
         // width: 450,
         // minHeight: 450,
         // height: 450,
         'autoScale': true,
         'autoDimensions': false,
         'scrolling'     : 'no',
         openEffect  : 'elastic',
         closeEffect	: 'elastic',
		 closeBtn		: true,
		helpers: {
			title: false,
			overlay: {
			  locked: false
			   //css: { 'background': 'rgba(213, 17, 190, 0.1)' }
			}
		}// end helper
    });
	
	$('.bnt-forgot-pass').click(function(){
		$('#for-got form').show();
	});
	
	ControllPopupHome();
	ClickLoginOut();
	Gotodownload();
	
	
	validate();
	$("input[class*='number']").numeric();
}); // end readdy

	
	
	function ParrallaxDownload(){
		$('.download-home').css({
			'width':$(window).width() + 'px'
		});
	}
	


	
	// goto down load
	function Gotodownload(){
		$('.icon-dow').click(function(event){
			 $("html, body").animate({ scrollTop: $('.home-video').offset().top }, 1000);
			 return false;
		});
	}// end function 

	function ClickLoginOut(){
        var height_frm_login = '315px';
		$('#login-logout li').click(function(){
			var for_act = $(this).index();
			$('.popup-home ul li').removeClass('tab-active');
			if(for_act == 1){
				$('.popup-home ul li').eq(0).addClass('tab-active');
				$('.form-sign-up').show();
				$('.form-log-out').hide();
				$('.popup-home').css({'height':height_frm_login});
			}else{
				$('.popup-home ul li').eq(1).addClass('tab-active');
				// $('.form-log-out').show(); //remove when release
				$('.form-sign-up').hide();
				$('.popup-home').css({'height':'550px'});
			}
			
		});// end click
		
		// on click getstar
			$('.get-star, .get-star-two').click(function(event){
				$('.popup-home li').removeClass('tab-active');
				$('.popup-home ul li').eq(0).addClass('tab-active');
				$('.form-sign-up').show();
				$('.form-log-out').hide();
				$('.popup-home').stop(true,true).animate({'height':height_frm_login},600);
			});
		// on click getlist
			$('.get-listed').click(function(event){
				$('.popup-home li').removeClass('tab-active');
				$('.popup-home ul li').eq(0).addClass('tab-active');
				$('.form-sign-up').show();
				$('.form-log-out').hide();
				$('.popup-home').stop(true,true).animate({'height':height_frm_login},600);
			});
	}

	function ControllPopupHome(){
        var height_frm_login = '315px';
		$('.popup-home li').click(function(){
			resetForm();
			$('.popup-home li').removeClass('tab-active');
			$(this).addClass('tab-active');
			if($(this).index() == 1){
                // $('.form-log-out').show(); //remove when release
				$('.form-sign-up').hide();
				$('.popup-home').stop(true,true).animate({'height':'550px'},600);
			}else{
				$('.form-sign-up').show();
				$('.form-log-out').hide();
				$('.popup-home').stop(true,true).animate({'height':height_frm_login},600);
			}
		});
	}

function resetForm() {
	input_element = $("#login_frm, #signup_frm, #forgot_frm").find(":input");
	input_element.removeClass('frm-error').removeAttr('data-original-title');
	// $('#login_frm')[0].reset();
	// $('#signup_frm')[0].reset();
	// $('#forgot_frm')[0].reset();
	document.getElementById("login_frm").reset();
	document.getElementById("signup_frm").reset();
	document.getElementById("forgot_frm").reset();
}
function validate() {
    $.validator.addMethod('isname', function (value, element) {
        return (value.match(/\d+/) == null) ? true : false;
    }, 'No number');
    $("#login_frm").validate({
        validClass: "has-success",
        errorClass: "frm-error",
        rules: {
            input_email: {
                required: true,
                email: true
                },
            input_password: {
                required: true,
                maxlength: 25,
                minlength: 3
                },
        },
        messages: {
            input_password: {
                required: "Enter your password",
                maxlength: "Password has min 3 characters, max 25 characters",
                minlength: "Password has min 3 characters, max 25 characters"
                },
            input_email: {
                required: "Enter your email",
                email: "Enter a valid email address"
            }
        },
        submitHandler: function(form) {
            $(form).submitFormHome();
        },
        errorPlacement: function(error, element) {
            element.attr("data-original-title", error.text());
            element.tooltip();
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass(errorClass);
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeAttr('data-original-title');
            $(element).removeClass(errorClass);//.addClass(validClass);
        }
    });
    $("#signup_frm").validate({
        validClass: "has-success",
        errorClass: "frm-error",
        rules: {
            input_firstname: {
                required: true,
                isname: true
            },
            input_lastname: {
                required: true,
                isname: true
            },
            input_email: {
                required: true,
                email: true
                },
            input_password: {
                required: true,
                maxlength: 25,
                minlength: 3
                },
            input_mobile: {
                required: true,
                number: true,
            },
        },
        messages: {
            input_firstname: {
                required: "Enter your firstname",
                isname: "Firstname has no number"
            },
            input_lastname: {
                required: "Enter your lastname",
                isname: "Lastname has no number"
            },
            input_password: {
                required: "Enter your password",
                maxlength: "Password has min 3 characters, max 25 characters",
                minlength: "Password has min 3 characters, max 25 characters"
                },
            input_email: {
                required: "Enter your email",
                email: "Enter a valid email address"
            },
            input_mobile: {
                required: "Enter your mobile number",
                number: "Enter only number value"
            },
        },
        submitHandler: function(form) {
            $(form).submitFormHome();
        },
        errorPlacement: function(error, element) {
            element.attr("data-original-title", error.text());
            element.tooltip();
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass(errorClass);
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeAttr('data-original-title');
            $(element).removeClass(errorClass);//.addClass(validClass);
        }
    });
    $("#forgot_frm").validate({
        validClass: "has-success",
        errorClass: "frm-error",
        rules: {
            input_email: {
                required: true,
                email: true
                }
        },
        messages: {
            input_email: {
                required: "Enter your email",
                email: "Enter a valid email address"
            }
        },
        submitHandler: function(form) {
            $(form).submitFormHome();
        },
        errorPlacement: function(error, element) {
            element.attr("data-original-title", error.text());
            element.tooltip();
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass(errorClass);
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeAttr('data-original-title');
            $(element).removeClass(errorClass);//.addClass(validClass);
        }
    });
};