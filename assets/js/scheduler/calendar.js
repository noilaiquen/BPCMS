// ------ START BACKBONE JS

	var CalendarCollection = Backbone.Collection.extend({
		parse: function(resp, xhr) {
		  return resp.data;
		}
	});
	
	var DayView = Backbone.View.extend({
		model : null,
		liDataDay : null,
		classDay : null,
		template : _.template($('#data-day').html()),
		initialize:function(){
			this.render();
		},
		render:function(){
			//console.log(this.model.toJSON());
			this.$el.html( this.template( this.model.toJSON() ) );
			return this;
		}
	});
	
	
	
	
	// ------ END BACKBONE JS
	
	
	var d = new Date();
	
	var day = d.getDate();
	day = day < 10 ? parseInt( "0"+day ) : day;
	
	var month = parseInt( d.getMonth() + 1 );
	month = month < 10 ?  parseInt(  "0"+month ): month;
	
	var year = d.getFullYear();
		



//get time current
function getTime() {
// initialize time-related variables with current time settings
var now = new Date()
var hour = now.getHours()
var minute = now.getMinutes()
now = null
var ampm = "" 

// validate hour values and set value of ampm
if (hour >= 12) {
hour -= 12
ampm = "PM"
} else
ampm = "AM"
hour = (hour == 0) ? 12 : hour

// add zero digit to a one digit minute
if (minute < 10)
minute = "0" + minute // do not parse this number!

// return time string
return hour + ":" + minute + " " + ampm
}



function leapYear(year) {
	if (year % 4 == 0) // basic rule
		return true // is leap year

	return false // is not leap year
}

function getDays(month, year) {
// create array to hold number of days in each month
var ar = new Array(12)
ar[0] = 31 // January
ar[1] = (leapYear(year)) ? 29 : 28 // February
ar[2] = 31 // March
ar[3] = 30 // April
ar[4] = 31 // May
ar[5] = 30 // June
ar[6] = 31 // July
ar[7] = 31 // August
ar[8] = 30 // September
ar[9] = 31 // October
ar[10] = 30 // November
ar[11] = 31 // December

// return number of days in the specified month (parameter)
return ar[month]
}

function getMonthName(month) {
// create array to hold name of each month
var ar = new Array(12)
ar[0] = "January"
ar[1] = "February"
ar[2] = "March"
ar[3] = "April"
ar[4] = "May"
ar[5] = "June"
ar[6] = "July"
ar[7] = "August"
ar[8] = "September"
ar[9] = "October"
ar[10] = "November"
ar[11] = "December"

// return name of specified month (parameter)
return ar[month];
}


function getMonthNameCurrent($month){
	var monthName = typeof $month === "undefined" ? getMonthName(d.getMonth()) : getMonthName($month);
	return monthName;
}

function getWeekNumber( date ){
	var w = moment(date, "YYYY-MM-DD").isoWeek();
	return w;
}

function getDay(date){
	
	var d = new Date(date);
	var weekday = new Array(7);
	weekday[0]=  "Sunday";
	weekday[1] = "Monday";
	weekday[2] = "Tuesday";
	weekday[3] = "Wednesday";
	weekday[4] = "Thursday";
	weekday[5] = "Friday";
	weekday[6] = "Saturday";
	
	var n = weekday[d.getDay()]; 
	return n;
}

function renderCalendar( monthPara , yearParam){
	
	var datesArray =  {};
	
	month = typeof monthPara === "undefined" ? month : parseInt(monthPara);
	year = typeof yearParam === "undefined" ? year :   parseInt(yearParam);
	
	var start = 1;
	var end = getDays(month-1, year);
	
	for(var i = start ; i <= end; i++){
		var _i = i<10 ? "0"+i : i;
		var _month = month <10 ? "0"+month : month;
		
		var weekNumber = "_"+getWeekNumber(year+"-"+month+"-"+_i);
		var w =  getWeekNumber(year+"-"+month+"-"+i);
		//console.log(w);
		var day  =  getDay(year+"-"+month+"-"+i);
		if( typeof datesArray[weekNumber] === 'undefined' ){
			datesArray[weekNumber] = [];
		}
		
		
		datesArray[weekNumber].push({
				date : year+"-"+month+"-"+i,
				day : day,
				week :w,
				unix : Math.round(new Date(year+"-"+month+"-"+i).getTime()/1000) ,
				day_number : i < 10 ? "0"+i : i,
				display :1,
				month : month < 10 ? "0"+month : month,
				css_class : "",
				link_daily: root+"dashboard/daily?date="+year+"-"+_month+"-"+_i+"&type=day"
		});
	}
	delete datesArray[0];
	if( _.keys(datesArray).length > 4 ){
		
		firstKey = "";
		for (var first in datesArray){
			firstKey = first;
			break;
		}
		
		if(datesArray[firstKey].length < 7){
			
			var m = parseInt( month - 1 );
			var y = m < 0 ? year - 1 : year; 
			m = m <= 0 ?  12 : m;
			var end = getDays(m-1, y);
			
			var monthName = getMonthName(m-1);
			var datesCount = parseInt(end) - parseInt(7 - datesArray[firstKey].length);
			
			for(var i = parseInt( end ) ; i > datesCount; i-- ){
				datesArray[firstKey].unshift({
						date : y+"-"+m+"-"+i,
						day :  getDay(y+"-"+m+"-"+i),
						week : datesArray[firstKey][0]['week'],
						unix : null,
						day_number : i,
						display : 0,
						month : m,
						css_class : "not-in-moth"
				});
			}
			
		}
		
		var lastKey = "";
		for (var first in datesArray){
			lastKey = first;
		}
		
		if(datesArray[lastKey].length < 7){
			
			var m = parseInt( month + 1 );
			var y = m > 12 ? year + 1 : year; 
			m = m > 12 ?  m + 1  : m;
			var end = getDays(m-1, y);
			
			var monthName = getMonthName(m-1);
			var datesCount = parseInt(end) - parseInt(7 - datesArray[lastKey].length);
			
			//console.log(parseInt(end) - datesCount);
			for(var i = 1 ; i <= parseInt(end) - datesCount; i++ ){
				
				datesArray[lastKey].push({
						date : y+"-"+m+"-"+i,
						day :  getDay(y+"-"+m+"-"+i),
						week : datesArray[lastKey][0]['week'],
						unix : null,
						day_number : i,
						display : 0,
						month : m,
						css_class : "not-in-moth"
				});
			}
		}
	}
	//console.log(datesArray);
	return datesArray;
	
}


function renderTemplateCalendar(month, year){
	 var data = renderCalendar(month, year);
	 
//	 console.log(data);
	 
	 $(".month_text").text(getMonthName(month-1));
	 $(".year_text").text(year);
	 
	 _.templateSettings.variable = "data";
	 var template = _.template( $("#list-week").html() );
     var html = template( data );
     $("#containt_scheduler").html(html);
     

}

renderTemplateCalendar(month, year);
$preFix = month < 10 ? "0"+month : month;


$(".pre_month").click(function(){
	month = month - 1; 
	if(month <=0 ){
		month = 12;
		year = year-1;
	}
	
	renderTemplateCalendar(month, year);
	
	var _month =  month < 10 ? "0"+month : month;
	getData(root+"dashboard/ajaxloadmonth" , year+"-"+_month+"-"+"01");
});

$(".next_month").click(function(){
	month = month + 1;
	console.log(month);
	if(month > 12 ){
		month = 1;
		year = year+1;
	}
	
	renderTemplateCalendar(month, year);
	
	var _month =  month < 10 ? "0"+month : month;
	getData(root+"dashboard/ajaxloadmonth" , year+"-"+_month+"-"+"01");
	
});

function getData(url , param){
	toggleLoadingScreen();
	var dateCollection  =  new CalendarCollection();
	dateCollection.url = url;
	dateCollection.fetch({
		data: { day: param , type:'month'},
		success:function(xhr, response){
			
			if(response.responseCd == 0 && ! _.isEmpty(response.ResultSet)){
				_.each(response.ResultSet , function(date, key){
					
					 _.templateSettings.variable = "data";
					 var template = _.template( $("#data-day").html() );
				     var html = template( date );
				     $('.contain-'+key).html(html);
				     $(".li-day-"+key).addClass('check-item');

				});
				toggleLoadingScreen();
			}else{
				toggleLoadingScreen();
			}
			
		},
		error:function( xhr, response ){
			toggleLoadingScreen();
			console.log('error');
		}
	});
}

$(document).ready(function(){
	getData(root+"dashboard/ajaxloadmonth" , year+"-"+$preFix+"-"+"01");

});
