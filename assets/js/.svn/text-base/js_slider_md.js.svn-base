$(document).ready(function(){
	var curent_scroll_window = 0;
	var count_run = 0;
	var up_down = '';
	$(window).on('load resize scroll', function(){
		var h_scroll =  $(window).scrollTop();
		var are_mb = $('.how-it-works-phone-wrapper');
		var start_event = are_mb.offset().top + 100;
		var pos_left = $('.client-experience-item-booking').offset().left - 387;
		var content_slider = $('.section-client-experience').offset().top + $('.section-client-experience').height() - 650;
		var bkl_item = $('.img-mobile-item img'); 
		var top_mb = '30px';
		var transform_mb = 'translateY(0)';
		// define scroll up or down
		if(h_scroll > curent_scroll_window){
			up_down = 'down';
			curent_scroll_window = h_scroll;
		}else{
			up_down = 'up';
			curent_scroll_window = h_scroll;
		}
		
		// event resize window goto top mobile center top
		if($(window).width() >= 1500){
			top_mb = '30%';
			transform_mb = 'translateY(-30%)';
		}
		
		// change position fixed
		if(h_scroll > start_event && h_scroll <= content_slider){
			// fixed mobile
			$('#img-mobile').css({
				'top':top_mb,
				'left': pos_left + 'px',
				'transform': transform_mb,
				'position': 'fixed'
			});
			// hide item-mobile-last
			$('.item-last-mb').css({
				'display':'none'
			});
		}else{
			// relative mobile
			$('#img-mobile').css({
				'top': 'auto',
				'left': 'auto',
				'transform': 'translateY(0)',
				'position': 'relative'
			});
			// show item-mobile-last
			$('.item-last-mb').css({
				'display':'block'
			});
			
		}// end else
			
		// on current scroll video or download controll hide mobile fix ()
		var ele_video = $('.home-video');
		var ele_dowload = $('.download-home').offset().top * 1; 
		if(h_scroll <= ((ele_video.offset().top * 1) + (ele_video.height() * 1)) || h_scroll >= ele_dowload){
			// relative mobile
			$('#img-mobile').css({
				'top': 'auto',
				'left': 'auto',
				'transform': 'translateY(0)',
				'position': 'relative'
			});
		}
		
		if(h_scroll < start_event){
			// set all item img mobile to default
			bkl_item.eq(1).css({'top': '475px'});
		}
		if(h_scroll > content_slider && count_run == 0){
			count_run = 1;
			bkl_item.css({'top': '0px'});
		}
		var index;
		var pos_tem_img = 0;
		// scroll item mobile return item scoll
		var item_Content = $('.section-client-experience .item-content-mb-slider');
		var count_item = item_Content.length;
		h_scroll = h_scroll + 600;
		item_Content.each(function(i,val){
			var offset_top = $(this).offset().top;
			var curent = $(this).offset().top + 626;
			//var bkl_item = $('.img-mobile-item img'); 
			index = i+1;
			if(h_scroll >= $(this).offset().top && h_scroll <= curent){
				$('.h-scrlltop').text('slider_curent: ' + index);
				
				// percent this
				var cur_scroll  = h_scroll - $(this).offset().top;
					cur_scroll = (cur_scroll/626) * 100;
					
				// change top img
				pos_tem_img = bkl_item.eq(index).position().top;  // define element position curent
				
				// define up or down
				if(up_down == 'down'){
					pos_tem_img = pos_tem_img - (cur_scroll * 0.35);  // para change
					
					if(index > i){
						bkl_item.eq(index - 1).css({
							'top': '0px'
						});
						
					}
				}
				if(up_down == 'up'){
					pos_tem_img = pos_tem_img + ((100 - cur_scroll) * 0.35);  // para change
	
					bkl_item.eq(index + 1).css({
						'top': '475px'
					});
					if(count_item == index){
						bkl_item.eq(count_item + 1).css({
							'top': '0'
						});
					}
					
				}
				
				if(pos_tem_img <= 0){  // check and get value = 0
					pos_tem_img = 0;
				}
				if(pos_tem_img >= 475){  // check and get value = 475
					pos_tem_img = 475;
				}
				bkl_item.eq(index).css({
					'top': pos_tem_img + 'px'
				});
				
				
				
			}
		});// end each
		
	
	
	
	});
	
});
