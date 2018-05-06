$(document).ready(function(){
	// call fancybox page Dashboard Daily
	
	
	$('.img-fancy').click(function(event){
		//$('body').disablescroll();
		$('html').addClass('admin_nc');
	});
	
	// tab popup
	$('.icon-fc-popup li').click(function(){
		var item_all = $('.icon-fc-popup li');
		// change bgcolor item
		item_all.animate({'background-color':'transparent'},200);
		$(this).animate({'background-color':'rgba(0, 0, 0, 0.13)'}, 200);

		// change status
		var content = $('#status-tab');
		var val = $(this).attr('data');
		content.html(val);
		
		// SHOW - HIDE detail
		var list_cnt = $('#popup-booking .item-tab-content');
		var ind = $(this).index();
		list_cnt.removeClass('show');
		list_cnt.eq(ind).addClass('show');
	});
	
	// call function change Avarta
	ChangeAvarta();
}); // end readdy   https://192.168.0.123/svn/Habfit

	// function change avarta popup
	function ChangeAvarta(){
		$('.item-dailt').click(function(){
			var src = $(this).find('img').attr('src');
			$('#popup-booking .avarta-right img').attr('src',src);
		});
	}// end function
function showPopup(){
		
		
	}
	