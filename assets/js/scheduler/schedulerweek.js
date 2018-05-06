var CalendarCollection = Backbone.Collection.extend({
		parse: function(resp, xhr) {
		  return resp.ResultSet;
		}
});
var date =  moment().format("YYYY-MM-DD");
var year =  moment().format("YYYY");


var weekCurrent =  moment(date, "YYYY-MM-DD").isoWeek();

var startWeek = moment().startOf('isoWeek') ;

function dateFromWeekNumber(year, week) {
  var d = new Date(year, 0, 1);
  var dayNum = d.getDay();
  var diff = --week * 7;

  // If 1 Jan is Friday to Sunday, go to next week
  if (!dayNum || dayNum > 4) {
    diff += 7;
  }

  // Add required number of days
  d.setDate(d.getDate() - d.getDay() + diff);
  return d;
}

var s = dateFromWeekNumber(year, weekCurrent);

	
var startDateWeek = moment(s).format("YYYY-MM-DD");
var endDateWeek   = moment(startDateWeek, "YYYY-MM-DD").add('days', 6).format("YYYY-MM-DD");



var startMonth = moment(dateFromWeekNumber(2016, weekCurrent)).format("MMMM");
var endMonth  = moment(endDateWeek).format("MMMM");

var _doStart = moment(startDateWeek).format("Do");
var _endStart = moment(endDateWeek).format("Do");

/*console.log(_doStart);
console.log(_endStart);*/

$(".month_start").text(startMonth);
$(".date_start").text(_doStart);

$(".month_end").text(endMonth);
$(".date_end").text(_endStart);
$(".year").text( moment(endDateWeek, "YYYY-MM-DD").format("YYYY") );
$(".week_number").text(weekCurrent);

$(".week-pre").click(function(){
	
	var startWeekPre =  moment(startDateWeek, "YYYY-MM-DD").subtract(7, 'days').format("YYYY-MM-DD");
	var endWeekPre = moment(startWeekPre, "YYYY-MM-DD").add('days', 6).format("YYYY-MM-DD");
	
	rederDate(startWeekPre);
	
	startDateWeek = startWeekPre;
	year = moment(startWeekPre, "YYYY-MM-DD").add('days', 7).format("YYYY");
	 
	
	$(".month_start").text( moment(startWeekPre, "YYYY-MM-DD").format("MMMM") );
	$(".date_start").text( moment(startWeekPre, "YYYY-MM-DD").format("Do") );
	
	$(".month_end").text( moment(endWeekPre, "YYYY-MM-DD").format("MMMM") );
	$(".date_end").text( moment(endWeekPre, "YYYY-MM-DD").format("Do") );
	$(".year").text( year );
	$(".week_number").text( moment(startWeekPre, "YYYY-MM-DD").isoWeek());
	
});

$(".week-next").click(function(){
	var startWeekNext =  moment(startDateWeek, "YYYY-MM-DD").add('days', 7).format("YYYY-MM-DD");
	var endWeekNext = moment(startWeekNext, "YYYY-MM-DD").add('days', 6).format("YYYY-MM-DD");
	
	rederDate(startWeekNext);
	
	startDateWeek = startWeekNext;
	year = moment(startWeekNext, "YYYY-MM-DD").add('days', 7).format("YYYY");
	
	$(".month_start").text( moment(startWeekNext, "YYYY-MM-DD").format("MMMM") );
	$(".date_start").text( moment(startWeekNext, "YYYY-MM-DD").format("Do") );
	
	$(".month_end").text( moment(endWeekNext, "YYYY-MM-DD").format("MMMM") );
	$(".date_end").text( moment(endWeekNext, "YYYY-MM-DD").format("Do") );
	$(".year").text( year );
	$(".week_number").text( moment(endWeekNext, "YYYY-MM-DD").isoWeek());
	
});


function rederDate(startDate){
	
	toggleLoadingScreen();
	
	var weekClendar = [];
	for( var i =0;i<7;i++ ){
		var rs = moment(startDate, "YYYY-MM-DD").add('days', i).format("DD");
		$(".name_"+i).text(rs);
		
		for(var j = 0; j<=23; j++){
			
			var _i = i < 10 ? '0' + i : i;
			var _j = i < 10 ? '0' + j : j;
			
			if( typeof weekClendar[j] === "undefined" ){
				weekClendar[j] = [];
			}
			
			weekClendar[j][i] = rs;
		}
	}
	 _.templateSettings.variable = "data";
	 var template = _.template( $("#day_week").html() );
     var html = template( weekClendar );
     
     $('.content_week').html(html);
     
    var dateCollection  =  new CalendarCollection();
	dateCollection.url = root+"dashboard/ajaxloadweek";
	dateCollection.fetch({
		data: { day: startDate },
		success:function(xhr, response){
			if(response.responseCd == 0 && ! _.isEmpty(response.ResultSet)){
				console.log( );
				_.each( response.ResultSet ,function(rs, key){
					$(".week_"+key).addClass('check-item');
					var count = 0;
					for( var i = 0; i < rs.length; i++ ){
						//console.log( rs[i] );
						 count ++;
						 if( count <= 2){
							  _.templateSettings.variable = "data";
							 var template = _.template( $("#a_day").html() );
							 var html = template( rs[i] );
							 $(".week_"+key).append(html);
						 }
						 
						if(rs[i]['is_vib'] == 1){
							 $(".span_week_"+key).show();
						}
						 
					}
					toggleLoadingScreen();
				} );
			}else{
				toggleLoadingScreen();
				
			}
		},
		error:function( xhr, response ){
			toggleLoadingScreen();
		}
	});
}

$(document).ready(function(){
	rederDate(startDateWeek);
});