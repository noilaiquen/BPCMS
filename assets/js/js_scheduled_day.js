$(document).ready(function(){
	Addfiexday();
});// end ready


	function GotoElement(para){
		var child = $('.child-content');
		var lastscroll = 0;
		// goto child content
		$('.child-content .col-md-12').each(function(i,val){
			var vlue = $(this).find('li:first-child').html();
			if($(val).hasClass(para)){
				i = i*1;
				$('.child-content .col-md-12').eq(i).ScrollTo({
					duration: 100,
					durationMode: 'all'
				});
				return false;
			}// end if
		});// end each
		
		}// end function


		// add class fixed
		function Addfiexday(){
			var wi_before = $('.tab-day').width();
			 $(window).scroll(function(){
				var top_page = $(this).scrollTop();
				if(top_page >= 402){
					
					 $('.header-hidden').css({
						 'height':'101px'
					 });
					 $('.scroll-content-day').addClass('child-top-add');
					 $('.fix-scheduler').addClass('posi-fixed');
					 $('.fix-scheduler').css({
						 'width':wi_before+'px'
					 });
					 $('.tab-day').addClass('posi-fixed-tabday');
					 $('.tab-day').css({
						 'width':wi_before+'px'
					 });
				}else{
					 $('.fix-scheduler').removeClass('posi-fixed');
					 $('.tab-day').removeClass('posi-fixed-tabday');
					 $('.header-hidden').css({
						 'height':'0'
					 });
					 $('.scroll-content-day').removeClass('child-top-add');
				}
			});
		}// end function


