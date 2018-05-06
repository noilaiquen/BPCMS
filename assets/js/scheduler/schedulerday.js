var CalendarCollection = Backbone.Collection.extend({
		parse: function(resp, xhr) {
		  return resp.data;
		}
});
var date =  moment().format("YYYY-MM-DD");
var date_compare = moment().format("YYYY-MM-DD");
var time = moment().format("HH")+"00";


var dateCurrentFormat = moment(date, "YYYY-MM-DD").format("MMMM DD YYYY");




$('.day-pre').click(function(){
	var datePre = moment(date, "YYYY-MM-DD").subtract(1, 'day').format("YYYY-MM-DD");
	getData(datePre);
	date = datePre;
	$(".date").text( moment(datePre, "YYYY-MM-DD").format("MMMM DD YYYY"));
	$(".thu").text((moment(datePre, "YYYY-MM-DD").format("dddd")));
	
	if(date_compare == datePre){
		var h = moment().get('hour')+"00";
		$('.today').show();
		GotoElement(h);
	}else{
		$('.today').hide();
		GotoElement("0800");
	}
	
	
});

$('.day-next').click(function(){
	
	var datePre = moment(date, "YYYY-MM-DD").add('day', 1).format("YYYY-MM-DD");
	getData(datePre);
	date = datePre;
	$(".date").text( moment(datePre, "YYYY-MM-DD").format("MMMM DD YYYY"));
	$(".thu").text((moment(datePre, "YYYY-MM-DD").format("dddd")));
	
	if(date_compare == datePre){
		var h = moment().get('hour')+"00";
		$('.today').show();
		GotoElement(h);
	}else{
		$('.today').hide();
		GotoElement("0800");
	}
	
});


function getData(param){
	
	toggleLoadingScreen();
	
	var dateCollection  =  new CalendarCollection();
	dateCollection.url = root+"dashboard/ajaxloadday";
	dateCollection.fetch({
		data: { day: param , type:'day'},
		success:function(xhr, response){
			
			$('.page-day').removeClass('page-day-check');
			$('.remove_html').html('');
			
			if(response.responseCd == 0 && ! _.isEmpty(response.ResultSet)){
				//console.log(response.ResultSet);
				_.each(response.ResultSet , function(date, key){
					
					for(var i=0; i < date.length; i++){
						$(".pade-day-"+date[i]['hour']).addClass('page-day-check');
						if(date[i]['is_vib'] == 1){
							$(".span_"+key).removeClass("hide");
							console.log( ".span_"+key );
						}
						_.templateSettings.variable = "data";
						 var template = _.template( $("#data-hour").html() );
					     var html = template( date[i] );
					     $('.data_'+key).append(html);
					    
					}
					
				});
				toggleLoadingScreen();
			}else{
				toggleLoadingScreen();
			}
			
		},
		error:function( xhr, response ){
		//	toggleLoadingScreen();
		//	alert('error');
		}
	});
}


$(document).ready(function(){
	GotoElement(time);
	$(".date").text(dateCurrentFormat);
	$(".thu").text(moment(date, "YYYY-MM-DD").format("dddd"));
	getData(date);
});