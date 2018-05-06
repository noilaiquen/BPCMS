$( document ).ready(function() {
if($('.js-fix-booking').length > 0){
	var pos_booking = $('.js-fix-booking').offset().top;
	// fixed book now
$(window).on('load resize', function(){
	$(window).scroll(function(){
		var pos_window = $(window).scrollTop();
	 if($(window).width() < 500){
		if(pos_window >= pos_booking){
			$('.js-fix-booking').css({
				'position': 'fixed',
				'top' : 0,
				'width': '100%',
				'z-index': 999,
				'left': '50%',
				'-webkit-transform': 'translateX(-50%)',
				'-moz-transform': 'translateX(-50%)',
				'-ms-transform': 'translateX(-50%)',
				'transform': 'translateX(-50%)'
			});
		}else{
			$('.js-fix-booking').css({
				'position': 'static',
				'left': '0',
				'-webkit-transform': 'translateX(0)',
				'-moz-transform': 'translateX(0)',
				'-ms-transform': 'translateX(0)',
				'transform': 'translateX(0)'
			});
		}// end window top < target element
		
		}else{
			$('.js-fix-booking').css({
				'width': 112
			});
		}
	});// end scroll window
});// on load resize
}// end check booking now 

	$('.img---fancy').fancybox({
			'padding':0,
			 'scrolling'     : 'yes',
			 openEffect  : 'elastic',
			 closeEffect	: 'elastic',
			 closeBtn		: true,
			beforeShow : function(){
				
			},
			helpers: {
				overlay: {
				  locked: false
				},
				title: null
			}// end helper
		});// fancybox
	
	//drop down
	$('#tandc.faq-term.terms-of-service .drop-down').click(
		function(){
			console.log("sad");
			if($(this).next('.slide-down-content').css("display")=="none")
			{
				$(this).next('.slide-down-content').slideDown(200);
				$(this).parent('.drop-down-questions').css({"background-color":"#f5f5f5"});
				$(this).css({"color":"#8b6ce4","font-family":"Roboto-medium"});
				$(this).children('i').css({"color":"#8b6ce4"});
				$(this).children(".fa-angle-down").addClass("active");
			}
			else
			{
				$(this).next('.slide-down-content').slideUp(200);
				$(this).parent('.drop-down-questions').css({"background-color":"white"});
				$(this).css({"color":"#000","font-family":"Roboto-Light"});
				$(this).children('i').css({"color":"#7e7e7e"});
				$(this).children(".fa-angle-down").removeClass("active");
			}
			
		}
	);

	
	//inspiration stream
	//popup video
	$("#inspiration .grid-item.videos").click(function(e){
		var url_video =$(this).children(".img").children("img").attr("src").split("/")[4];
		e.stopPropagation();
		$("#inspiration").append("<div class='wrap-popup'><div class='video-youtube'><iframe height='500px'  src='http://www.youtube.com/embed/"+url_video+"?autoplay=1' frameborder='0' allowfullscreen></iframe><button class='close-video'></button></div></div>");
		$(".wrap-popup").css({"width":$(window).width(),"height":$(window).height()});
		$("button[class='close-video']").on('click', function (e) {
			e.stopPropagation();
			$('div').remove("div.wrap-popup");
		});
	});
	$("body").click(function(){
		if($('#inspiration .wrap-popup').length>0)
		{
			$('div').remove("#inspiration div.wrap-popup");
		}
	});
	
	//open chat box
	//$('.inbox .user-name').click(function(){
		//$('#clients_review.inbox').append('<div class="chat-box"><div class="header-box">'+$(this).html()+' <div class="close-chatbox"></div></div><div class="chat-log"></div><div class="input-chat-text"><textarea placeholder="Enter the text"></textarea><input type="button"></button></div></div>');
		//$('.chat-box').slideDown('slow');
	// });
	//close chat box
	//$('#clients_review.inbox').on('click', '.close-chatbox', function() {
		//$(this).parents('.chat-box').slideUp('slow',function(){
			//$(this).remove();
		//});
	//});
	
	//send chat 
	$("#clients_review.inbox").on("click","input[type='button']",function(){
		var text_inbox=$(this).siblings("textarea").val();
		$(this).parent('.input-chat-text').siblings('.chat-log').append('<div class="me user-chat"><div class="user-photo"><img src="assets/js/avertat-chat.png" /></div><div class="chat-content">'+text_inbox+'</div></div>');
		$(this).siblings("textarea").val("");
	});
	
	// close chat box
	$('.header-box').click(function(){
		if($(this).hasClass('close-window')){
			$('.chat-box').animate({
				'bottom': '-359px'
			},500);
			$(this).removeClass('close-window');
		}else{
			$('.chat-box').animate({
				'bottom': '0'
			},300);
			$(this).addClass('close-window');
		}
	});
	
	
	
	//popup add-contact
	$('.Dashboard .wrap-popup-abc').css({"display":"none"});
	//open
	$('.icon-fc-popup li[data="add"]').click(function(e){
		e.stopPropagation();
		$('.Dashboard .wrap-popup-abc').css({"opacity":"1"});
		$('.Dashboard .wrap-popup-abc').fadeIn('slow');
	});
	//close
	$(".Dashboard .wrap-popup-abc .add-contacts").on("click",".close",function(){
		$('.Dashboard .wrap-popup-abc').fadeOut('slow');
	});
	$(".Dashboard .wrap-popup-abc .add-contacts").on("click","button[data='cancel']",function(){
		$('.Dashboard .wrap-popup-abc').fadeOut("slow");
	});
	// $(window).click(function(){
		// $('.Dashboard .wrap-popup-abc').css("display","none");
	// });
});