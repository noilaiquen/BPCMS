$(document).ready(function(){
	// Creat wow
	new WOW().init();
	// call tab click photo library
	TabClickPhoto();
	
	// call del item photo
	DellimagePhoto();
	
	$('.photo-save-upload span').click(function(){
		$('.photo-save-upload input[type=file]').click();
	});// end event click
	
	//showinfouplooad();
	
	promotioninf();
	
	// on-off promotioninf
	$('.avarta-off-on span').click(function(event){
		$('.avarta-off-on span').removeClass('check');
		$(this).addClass('check');
		if($(this).text() == 'ON'){
			$('.block-promo-on').css({'display':'block'});
		}else{
			$('.block-promo-on').css({'display':'none'});
		}
		
	});
	
	//Show picker Manager Service
	//ShowPickerPix();
	
	
	showinfouplooad();
	ShowimgaDetail();
	
	Changestatus();
	// $('.blk-check-rice span:nth-child(3) label').click(function(){
	// 	return false;
	// });
	
	
	ChangeViewtoEditphoto();
	
	
	// $('.add-icon-upload').click(function(){
	// 	$('.input-file').click();
	// })
	
}); // end readdy

	// 
	function ChangeViewtoEditphoto(){
		// $('.upload-edit li:first-child').click(function(){
		// 	$(this).text('SAVE');
			
		// 	var elem_h1 = $('.blk-info-edit > h1');
		// 	var attr_h1  = elem_h1.attr('class');
		// 	var value_h1  = elem_h1.text();
		// 	// remove elem_h1
		// 	elem_h1.remove();
		// 	$('.blk-info-edit').prepend('<input type="text" class="' + attr_h1 + '" value="'+ value_h1 +'">');
			
		// 	setTimeout(function(){
		// 		var elem_p = $('.blk-info-edit > p.info-uload');
		// 		elem_p.replaceWith($('<textarea rows="4" cols="50" class="info-uload">'+elem_p.text()+'</textarea>'));
		// 	},100);
		// });
		
		
	}// end function

	// ham chang save to edit
	function Changestatus(){
		// var item_chage = $('.blk-check-rice span:nth-child(2)');
		// $('.creat-upload').click(function(e){
		// 	// $(this).text('SAVE');
		// 	if($(this).text() == 'SAVE'){
		// 		console.log('working');
		// 		$('.blk-check-rice span:nth-child(3) label').unbind();
		// 	}
		// 	item_chage.each(function(i,val){
		// 		var vlue = $(this).find('label:last-child').text();
		// 		$(this).empty();
		// 		$(this).append('<label>$ <label>');
		// 		$(this).append('<input type="text" value="'+ vlue +'">');	
		// 	});// end each		
		// });
	}// end function

	// call fancy 
	function ShowimgaDetail(){
		$('.img-fancy').fancybox({
			minWidth: 450,
			maxHeight: 300,
			'padding':0,
			 'scrolling'     : 'yes',
			 openEffect  : 'elastic',
			 closeEffect	: 'elastic',
			 closeBtn		: true,
			beforeShow : function(){
				//console.log(this.index);
				Getinfoimage(this.index);
			},
			helpers: {
				overlay: {
				  locked: false
				},
				title: null
			}// end helper
		});// fancybox
		
	}// end function
	
	// ham lay gia tri hinh anh hien tai
	function Getinfoimage(para){
		var v_like = $('.block-images-photo1 .item-photo').eq(para).find('figcaption span:first-child').text();
		var v_rice = $('.block-images-photo1 .item-photo').eq(para).find('.add-rice-fancy').text();
		var detail_url = $('.block-images-photo1 .item-photo').eq(para).attr('data-url');
		var image_url = $('.block-images-photo1 .item-photo').eq(para).attr('data-img-url');
		var html_share = '';
		
		html_share += '<div class="facy-group-blk">';
		html_share += '<span class="facy-group"></span>';
		html_share += '<a href="mailto:?body='+image_url+'&subject=MyStyle" target="_blank"><span class="facy-mail"></span></a>';
		html_share += '<a href="https://twitter.com/intent/tweet?url='+image_url+'" target="_blank"><span class="facy-twiter"></span></a>';
		html_share += '<a href="https://www.facebook.com/sharer/sharer.php?u='+image_url+'" target="_blank"><span class="facy-facb"></span></a>';
		html_share += '</div>';
		
		$('.fancybox-outer').append('<span class="facy-heath">'+v_like+'</span>');
		//$('.fancybox-outer').append('<span class="facy-price">'+v_rice+'</span>');
		$('.fancybox-outer').append('<a href="'+detail_url+'"><span class="facy-public"></span></a>');
		// $('.fancybox-outer').append('<div class="facy-group-blk"><span class="facy-group"></span><a href="#"><span class="facy-mail"></span></a><a href="#"><span class="facy-twiter"></span></a><a href="#"><span class="facy-facb"></span></a></div>');
		$('.fancybox-outer').append(html_share);
		// $('.fancybox-outer').append('<span class="facy-group"></span>');
		// $('.fancybox-outer').append('<a href="#"><span class="facy-mail"></span></a>');
		// $('.fancybox-outer').append('<a href="#"><span class="facy-twiter"></span></a>');
		// $('.fancybox-outer').append('<a href="#"><span class="facy-facb"></span></a>');
		
		$('.fancybox-inner').on('click', '.facy-group', function() {
			$(this).toggleClass('active');
			('.facy-mail, .facy-twiter, .facy-facb').fadeToggle(400);
			
		});
	}

	// ham thiet lap time manager service
	function ShowPickerPix(){
		var item = $('.blk-item-day .service-time');
		item.click(function(event){ // top + 39
			var x = $(this).offset();
		   $('.date-time-picker').css({
			   'top': x.top + 42,
			   'left': x.left
		   });
		});
	}

	// ham hien thi an thong tin PROMOTION
	function promotioninf(){
		$("body").on('click', '.blk-service > li > p, .blk-search-term > li > p', function(){
			$(this).toggleClass('open');
			$(this).next().stop(true,true).slideToggle(400);
		});
		// $('.blk-service > li > p').click(function(event){
		// 	$(this).toggleClass('open');
		// 	$(this).next().stop(true,true).slideToggle(400);
		// });
	}// end function 

	// ham show upload info
	function showinfouplooad(){
		$('.creat-upload').click(function(event){
			event.stopPropagation();
			$('.info-upload').toggleClass('open');
		});
		$('body').click(function(){
			if($('.info-upload').hasClass('open')){
				$('.info-upload').removeClass('open');
			}
		})
	}// end function 


	function TabClickPhoto(){
		$('.blok-tab-photop > li').click(function(){
			$('.blok-tab-photop > li').removeClass('tab-curent');
			$(this).addClass('tab-curent');
		});
	}// end function
	
	// ham xoa cac item photo library
	function DellimagePhoto(){
		$('.bnt-del2').click(function(){
			var item_del = $(this).closest('.item-photo');
			item_del.css({
				'opacity': '0.01',
				'transform': 'translate(-20px , -30px)'
			});
			setTimeout(function(){
				item_del.remove();
			},1001);
			//item_del.remove();
		});
	}// end function