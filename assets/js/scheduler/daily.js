// var UserBookingModel = Backbone.Model.extend({
	// url : root+"dashboard/getbookingdetail",
	// defaults :{
		// title_booking: '',
		// status : '',
		// start_date : '',
		// end_date : '',
		// noted : '',
		// thumbnail : '',
		// fullname : '',
		// style_hair_id : 0,
		// dis_count_price : 0,
		// final_price : 0,
		// service : [],
	// },
	// parse:function( resp, xhr ){
		// return resp.ResultSet;
	// },
	// changeStatus:function(booking){
		
		// this.url = root+"dashboard/updatestatus";
		// this.save(null,{
			// success:function(xhr, response){
				// if( response.responseCd == 0 ){
					
				// }else{
					// alert('error');
					// return false;
				// }
			// },
			// error:function(){
				// alert('error');
				// return false;
			// }
		// });
	// }
// });

// var BookingDetailView = Backbone.View.extend({
	// model:null,
	// el : $("#popup-booking"),
	// template : _.template( $('#popup_detail_booking').html() ),
	// initialize:function(){
		
	// },
	// render:function(){
		
		// this.$el.html(this.template(this.model.toJSON()));
		// $("#popup-booking").html( this.$el.html() );
		
		// return this;
	// },
	// events:{
		// 'click .icon-fc-popup li' : 'changesatatus'
	// },
	// changesatatus :function(e){
		
		// var text = $(e.currentTarget).attr("data");
		
		// var chaneStatus = [0,1,2,3];
		
		// var status = $(e.currentTarget).data("status");
		// if ( _.contains( chaneStatus, status ) ){
				// booking.set('status', status);
				// booking.changeStatus(booking);
				// $("#status-tab").text(text);
		// }
		// else
		// {
			// if( status == 4 ){
				// show_popup_sanpham('#popup_datetime');
			// }
			// else if(status==10){
				// show_popup_sanpham('#add_contact');
			// }
		// }
	// }
// });

// var booking = new UserBookingModel();

// var limit = 8;

// var param = {limit:limit, page:1, date:_date, type:_type,search:''};

// var custom_popup = 1;

// var ViewDaily = Backbone.View.extend({
	// model : null,
	// el: $('.content-booking'),
	// initialize:function(){
	// },
	// render:function(){
		// if( ! _.isEmpty(this.model) ){
			
			// _.templateSettings.variable = "data";
			// var template = _.template( $("#list_booking").html() );
			// var html = template( this.model );
			
			// this.$el.find('.list-booking').append(html);
			
		// }
		// return this;
	// },
	// events: {
      // "click .icon-show-daily" : "loadmore",
      // "submit .search-dashboard" : "search",
      // "click .img-fancy" : "detail"
    // },
	// loadmore: function(){
		// loadMore();
	// },
    // search : function(){
    	// var contentSearch = this.$el.find('.content_search').val().trim();
    	// if( contentSearch !== "" ){
    		// param.page = 1;
    		// param.search = contentSearch;
    		// this.$el.find('.list-booking').html('');
    		// loadMore();
    	// }
    	// return false;
    // },
    // detail:function(e){
    	// var _id = $(e.currentTarget).data("id");
    	// booking.url = root+"dashboard/getbookingdetail"
    	// booking.fetch({
    		// type: 'POST',
    		// data : { id:_id },
    		// success:function(xhr, response){
    			// if( ! _.isEmpty( response ) && !_.isEmpty( response.ResultSet )){
    				// if(custom_popup == 1){
							// booking.set('user_booking_id', _id) ;
							// popupBooking.model = booking;
							// popupBooking.render();
							// showPopup();
							// $('.img-fancy').fancybox({
								// 'maxHeight':600,
								// 'padding':0,
								 // 'scrolling'     : 'yes',
								 // openEffect  : 'elastic',
								 // closeEffect	: 'elastic',
								 // closeBtn		: true,
								 // afterClose : function(){
								   // $('html').removeClass('admin_nc');
								   // },
								// helpers: {
									// overlay: {
									  // locked: false
									// }
								// }// end helper
							// });
							// $('.img-fancy').click();
						// custom_popup+=1;

					// }// end setTimeout call popup
					// else{
						// booking.set('user_booking_id', _id) ;
						// popupBooking.model = booking;
						// popupBooking.render();
						// showPopup();
					// }
    			// }
    		// }
    	// });
		
    // }
    
// });

// var DailyCollection = Backbone.Collection.extend({
	// parse: function(resp, xhr) {
		  // return resp.ResultSet;
	// }
// });

// var popupBooking = new BookingDetailView();

// var dailyView = new ViewDaily();

// var dailyCollection = new DailyCollection();
// dailyCollection.url = root+"/dashboard/ajaxloaddaily"


// function loadMore(){
	
	// toggleLoadingScreen();
	
	// dailyCollection.fetch({
	// data: param,
	// success:function(xhr, response){
	
		// if(response.responseCd == 0 && ! _.isEmpty(response.ResultSet)){
			// if( param.page == response.totalPage ){
				// $('.icon-show-daily').hide();
			// }
			
			// param.page = param.page + 1;
			
			// dailyView.model = response.ResultSet;
			// dailyView.render();
			// $('[data-toggle="tooltip"]').tooltip();
			// toggleLoadingScreen();
			
		// }else{
			// toggleLoadingScreen();
			// $('.icon-show-daily').hide();
		// }
		
	// },
	// error:function(xhr, response){
		// toggleLoadingScreen();
	// }
// });


// }

// $(document).ready(function(){
	// loadMore();
	
// });

$("#list_booking").on("click","button", function(){
	var user_booking_id = $(this).attr("data-id");
	var url = $(this).attr("data-url");
	$.ajax({
		url: url,
		method: 'post',
		data: {user_booking_id: user_booking_id},
		success: function(data){
			var obj = getJSONData(data);
            if(obj != false) {
                if(obj.status ==1) {
                    $("#popup-booking").html(obj.html);
                }
                else {
                    doEmptyElement();
                }
            }
		}
	});
});

// $("#add_contact").on("click", "#add", function(){
	
// });

$("#popup-booking").on("click",".confirm",function(){
	var user_booking_id = $(this).attr('data-id');
	var status = $(this).attr('data-status');
	var url = $(this).attr('data-url');
	toggleLoadingScreen();
	$.ajax({
		type: 'post',
		url: url,
		data: {
			user_booking_id: user_booking_id,
			status: status,
		},
		success: function(data) {
			var obj = getJSONData(data);
			if(obj != false) {
				if(obj.status == 1) {
					showMessageNotify(obj);
					$("#status-tab").text(obj.status_name);
				} else {
					doEmptyElement();
				}
			}
			toggleLoadingScreen();
		}
	});
});

$("#popup-booking").on("click", ".chat", function(){
	var chat_id = $(this).attr('data-chat-id');
	popup_dialog_chat(chat_id);
	$("#popup-booking").fadeOut();
	$("body").removeClass("modal-open");
});
