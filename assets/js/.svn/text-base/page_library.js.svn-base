$("form").ready(function(){
    // create_style_validate;
});

$("#frm_create_album").validate({
    validClass: "has-success",
    errorClass: "frm-error",
    rules: {
        input_album_name: {
            required: true
        },
        input_album_description: {
            required: true
        }
    },
    messages: {
        input_album_name: {
            required: "Enter album name"
        },
        input_album_description: {
            required: "Enter album description"
        }
    },
    submitHandler: function(form) {
        $(form).submitFormField();
    },
    errorPlacement: function(error, element) {
        element.attr("data-original-title", error.text());
        element.tooltip();
    },
    highlight: function(element, errorClass, validClass) {
        // $(element).parent().addClass(errorClass);
        $(element).addClass(errorClass);
    },
    unhighlight: function(element, errorClass, validClass) {
        $(element).removeAttr('data-original-title');
        $(element).removeClass(errorClass);//.addClass(validClass);
    }
});
$("body").on("click", "[data-type='album']", function(e){
    var _action = $(this).attr('data-action');
    switch(_action) {
        case 'edit': editAlbumInfo();
            break;
        case 'back':
            break;
        case 'cancel': cancelEditAlbum();
            break;
    }
});

function editAlbumInfo() {
    var _info_ele = $("#album_info");
    var _action = _info_ele.attr('data-url');
    var _code_val = _info_ele.attr('data-value');
    if(_action !='') {
        var _name = $("#album_name").text();
        var _description = $("#album_description").text();
        var html = "<form id='frm_edit_album' class='photo-save-upload' action='"+_action+"' autocomplete='off'>";
        html+="<input class='ctm edit-head' name='input_album_name' type='text' autofocus value='"+_name+"'/>";
        html+="<textarea class='ctm' name='input_album_description' rows='4' cols='50'>"+_description+"</textarea>";
        html+="<input type='hidden' name='input_album_id' value='"+_code_val+"'/>"
        html+="<input type='submit' value='SAVE'/> <span data-action='cancel' data-type='album'>CANCEL</span></form>";
        _info_ele.hide();
       _info_ele.parent().append(html);
       doSubmitEditAlbum();
    }
}

function cancelEditAlbum() {
    console.log(window.location.hostname);
    console.log($("#frm_edit_album").attr('action'));
    $("#album_info").show();
    $("#frm_edit_album").remove();
}

function doSubmitEditAlbum() {
    $("#frm_edit_album").validate({
        validClass: "has-success",
        errorClass: "frm-error",
        rules: {
            input_album_name: {
                required: true
            },
            input_album_description: {
                required: true
            }
        },
        messages: {
            input_album_name: {
                required: "Enter album name"
            },
            input_album_description: {
                required: "Enter album description"
            }
        },
        submitHandler: function(form) {
            $(form).submitFormField('doneUpdateAlbum');
        },
        errorPlacement: function(error, element) {
            element.attr("data-original-title", error.text());
            element.tooltip();
        },
        highlight: function(element, errorClass, validClass) {
            // $(element).parent().addClass(errorClass);
            $(element).addClass(errorClass);
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeAttr('data-original-title');
            $(element).removeClass(errorClass);//.addClass(validClass);
        }
    });
}

function doneUpdateAlbum(data) {
    var obj = getJSONData(data);
    if(obj != false) {
        $("#album_name").text(obj.name);
        $("#album_description").text(obj.description);
    }
    $("#album_info").show();
    $("#frm_edit_album").remove();
}

// $("li[data-type='album'][data-action='edit']").click()
function doSubmitCreateAlbum()
{
    
}

//EVENT CLICK BUTTON CHANGE ON/OFF
$(".avarta-off-on").on('click', 'span', function(){
    var val = $(this).attr('data-value');
    var is_on = ($(this).attr('id') == 'btn_on')?true:false;
    var is_off = ($(this).attr('id') == 'btn_off')?true:false;
    if(val=='on' && is_on) {
        $(this).attr('data-value', 'clicked');
        appendPromotionInfo($(this).attr('data-url'));
        $("#input_length_of_hair").change();
    }else if(val=='off' && is_off) {
        $("#btn_on").attr('data-value', 'on');
        $("#promotion_info").empty();
        $("#input_length_of_hair").change();
    }
});

function appendPromotionInfo(url) {
    $.ajax({
        method:'POST',
        url:url,
        // data:data,
        success: function(data) {
            var obj = getJSONData(data);
            if(obj != false) {
                if(obj.status ==1) {
                    $("#promotion_info").html(obj.promotion_html);
                }
                else {
                    doEmptyElement();
                }
            }
        }
    });
}

$('#promotion_info').on('change', '#input_promotion_id', function(){
    var hair_code = $("#input_length_of_hair").val();
    if(hair_code != 'false') {
        $("#input_length_of_hair").change();
    }
});

$("#input_length_of_hair").change(function(){
    var url = $(this).attr('data-url');
    var hair_code = $(this).val();
    var promo_code = false;

    if(hair_code == 'false') {
        doEmptyElement();
        return false;
    }
    //select promotion not exsits
    if($("#input_promotion_id").length){
        url = $("#input_promotion_id").attr('data-url');
        promo_code = $("#input_promotion_id").val();

        if(promo_code == 'false') {
            return false;
        }
    }

    getServiceByLength(url, hair_code, promo_code);
});


function  getServiceByLength(url, hair_code, promo_code) {
    var data = {
        input_length_of_hair: hair_code,
        input_promotion_id: promo_code
    };
    $.ajax({
        method:'POST',
        url:url,
        data:data,
        success: function(data) {
            var obj = getJSONData(data);
            if(obj != false) {
                if(obj.status ==1) {
                    $("#ajax_data").html(obj.html);
                    $("#frm_create_style").attr('action', obj.save_url);
                    // $("#service_data").html(obj.services_html);
                    // $("#hairbrand_data").html(obj.hairbrand_html);
                    if(promo_code) {
                        $("#promo_start_date").html(obj.start_date);
                        $("#promo_end_date").html(obj.end_date);
                        $("#promo_t_of_c").html(obj.t_of_c);
                    }
                    doCalculatorPriceStyle();
                }
                else {
                    doEmptyElement();
                }
            }
        }
    });
}

function doEmptyElement() {
    var _html = "<li class='title'><p>&nbsp;</p><span>Price</span><span>Promo</span></li>";
    _html += "<li class='total'><p>Total</p><span>&nbsp;</span><span>&nbsp;</span></li>";
    $("#service_price_total").html(_html);
    $("#ajax_data").empty();
    // $("#service_data, #hairbrand_data").empty();
    $("#promo_start_date, #promo_end_date, #promo_t_of_c").html('&nbsp;');
}

/* EVENT CLICK CHECKBOX IN SERVICE */
$("#ajax_data").on('click', '#service_data :checkbox', function(){
    doCalculatorPriceStyle();
});

function doCalculatorPriceStyle() {
    var data_price = new Array();
    $(".blk-service p").each(function(){
        var _this = $(this);
        var _parent = _this.parent();
        var _price = _promo = 0;
        var _chk_counter = 0;
        _parent.find(':checkbox').each(function(){
            if($(this).is(':checked')) {
                _price += getPrice($(this).attr('data-price'));
                _promo += getPrice($(this).attr('data-promo'));
                _chk_counter++;
            }
        });
        if(_chk_counter) {
            data_price.push([_this.text(), _price, _promo]);
        }
    });
    appendTotalPrice(data_price);
    countServiceChecked();
    countHairbrandChecked();
}

function appendTotalPrice(data) {
    var len = data.length;
    var _html = "";
    var price_total = promo_total = 0;

    //make title
    _html += "<li class='title'><p>&nbsp;</p><span>Price</span><span>Promo</span></li>";
    for(var i = 0; i < len; i++) {
        var name = data[i][0];
        var price = data[i][1];
        var promo = data[i][2];

        //make item
        _html += "<li class='item' data-name='"+name+"' data-price='"+price+"' data-promo='"+promo+"'>";
        _html += "<p>"+name+"</p><span>"+printPrice(price)+"</span><span>"+printPrice(promo)+"</span></li>";
        price_total += getPrice(price);
        promo_total += getPrice(promo);
    }

    //make total
    _html += "<li class='total' data-name='Total' data-price='"+price_total+"' data-promo='"+promo_total+"'>";
    _html +="<p>Total</p><span>"+printPrice(price_total)+"</span><span>"+printPrice(promo_total)+"</span></li>";

    $("#service_price_total").html(_html);
}

function getPrice(price) {
    return isNaN(parseFloat(price)) ? 0 : parseFloat(price);
}

function printPrice(price) {
    return (price>0) ? '$'+price : '&nbsp;';
}

function countServiceChecked() {
    var counter = 0;
    $("#service_data.blk-service :checkbox").each(function(){
        if($(this).is(':checked')) { counter++; }
    });
    $("#input_service_checked").val(counter);
    if(counter > 0) {
        $("#service_data").removeAttr('data-original-title');
        $("#service_data").removeClass("frm-error");
    }
}

/* EVENT CLICK CHECKBOX IN HAIRBRAND */
$("#ajax_data").on('click', '#hairbrand_data :checkbox', function(){
    countHairbrandChecked();
});
function countHairbrandChecked() {
    var counter = 0;
    $("#hairbrand_data.haircare-brands :checkbox").each(function(){
        if($(this).is(':checked')) { counter++; }
    });
    $("#input_hairbrand_checked").val(counter);
    if(counter > 0) {
        $("#hairbrand_data").removeAttr('data-original-title');
        $("#hairbrand_data").removeClass("frm-error");
    }
}
/* /END CLICK CHECKBOX IN HAIRBRAND */

// var create_style_validate = $("#frm_create_style").validate({
//     ignore: "input[type='text']:hidden",
//     validClass: "has-success",
//     errorClass: "frm-error",
//     rules: {
//         input_style_image: {
//             required: true
//         },
//         input_promotion_id: {
//             required: true,
//             min:1
//         },
//         input_length_of_hair: {
//             required: true,
//             min:1
//         },
//         input_length_of_service: {
//             required: true,
//             min:1
//         },
//         input_type_of_hair: {
//             required: true,
//             min:1
//         },
//         input_service_checked: {
//             min:1
//         },
//         input_t_of_c: {
//             required: true
//         }
//     },
//     messages: {
//         input_style_image: {
//             required: "Upload image of style",
//         },
//         input_length_of_hair: {
//             required: "Select length of hair",
//             min: "Select length of hair"
//         },
//         input_type_of_hair: {
//             required: "Select type of hair",
//             min: "Select type of hair"
//         },
//         input_length_of_service: {
//             required: "Select length of service",
//             min: "Select length of service"
//         },
//         input_service_checked: {
//             min: "Checked once service"
//         },
//         input_t_of_c: {
//             required: "Enter terms and conditions"
//         }
//     },
//     submitHandler: function(form) {
//         $(form).submitFormData();
//     },
//     errorPlacement: function(error, element) {
//         if(element.attr('name')=='input_style_image') {
//             element.parent().attr("data-original-title", error.text());
//             element.parent().tooltip();
//         }
//         if(element.attr('name')=='input_length_of_service') {
//             element.parent().attr("data-original-title", error.text());
//             element.parent().tooltip();
//         }
//         if(element.attr('name')=='input_service_checked') {
//             element = $("#service_data");
//         }
//         if(element.attr('name')=='input_hairbrand_checked') {
//             element = $("#hairbrand_data");
//         }
//         element.attr("data-original-title", error.text());
//         element.tooltip();

//         // console.log(element.attr('name'));
//     },
//     highlight: function(element, errorClass, validClass) {
//         // $(element).parent().addClass(errorClass);
//         $(element).addClass(errorClass);
//         if(element.name=='input_style_image') {
//             $(element).parent().addClass(errorClass);
//         }
//         if(element.name=='input_length_of_service') {
//             $(element).parent().addClass(errorClass);
//         }
//         if(element.name=='input_service_checked') {
//             $("#service_data").addClass(errorClass);
//         }
//         if(element.name=='input_hairbrand_checked') {
//             $("#hairbrand_data").addClass(errorClass);
//         }
//     },
//     unhighlight: function(element, errorClass, validClass) {
//         if(element.name=='input_style_image') {
//             $(element).parent().removeAttr('data-original-title');
//             $(element).parent().removeClass(errorClass);
//         }
//         $(element).removeAttr('data-original-title');
//         $(element).removeClass(errorClass);//.addClass(validClass);
//         // if(element.name=='input_service_checked') {
//         //     $("#service_data").addClass(errorClass);
//         //     $("#service_data").removeAttr('data-original-title');
//         //     $("#service_data").removeClass(errorClass);
//         // }
//     }
// });

/*** EVENT CLICK UPLOAD IMAGE ***/
$('#style_image_area').click(function(e){
    // if (!$(e.target).is('input')) {
    //     $(this).find("input[name='input_style_image']").trigger('click');//.click();
    // }
});
$("input[name='input_style_image']").change(function () {
    if (typeof (FileReader) != "undefined") {
        var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
        $($(this)[0].files).each(function () {
            var file = $(this);
            if (regex.test(file[0].name.toLowerCase())) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("#preview_style_image").attr("src", e.target.result);
                    $("#preview_style_image").show();
                }
                reader.readAsDataURL(file[0]);
                $('#style_image_area').removeAttr('data-original-title');
                $('#style_image_area').removeClass('frm-error');
            } else {
                alert(file[0].name + " is not a valid image file.");
                return false;
            }
        });
    } else {
        alert("This browser does not support HTML5 FileReader.");
    }
});


function notification(data){
	obj = getJSONData(data);
	if(obj.rs == false) {
		showPopupPublish($(this));
	}
}

/*** EVENT CLICK BUTTON SAVE ***/
$("button[data-action='save']").click(function() {
    var _value= $(this).attr('data-value');
    if($("#frm_create_style").valid()) {
        switch(_value) {
            case 'draft': 
                $("#input_publish").val(0);
                $("#frm_create_style").submitFormData();
                // $("#frm_create_style").submitFormField('changePromotionPoster');
                break;
            case 'publish': $("#input_publish").val(1);
                $("#frm_create_style").submitFormData(notification);
                break;
        }
    }
});
//calculate length of service
$("#length_hour, #length_minute").change(function(){
    _h_ele = $("#length_hour");
    _m_ele = $("#length_minute");
    var _h_val = isNaN(parseInt(_h_ele.val())) ? 0 : parseInt(_h_ele.val());
    var _m_val = isNaN(parseInt(_m_ele.val())) ? 0 : parseInt(_m_ele.val());
    var total_time = _h_val * 60 + _m_val;
    $("#input_length_of_service").val(total_time);
    if(total_time > 0) {
        $('#length_of_service').removeAttr('data-original-title');
        $('#length_of_service').removeClass('frm-error');
    }
});

/*** EVENT CHANGE SELECTBOX PROMOTION ***/
$("#select_promotion").change(function(){
	var url = $(this).val();
	var page = 0;
	$(this).attr('data-current-page', page);
	$("#promotion_content").html('');
	$.ajax({
		url: url,
		type: "POST",
		data: {current_page: page},
		success: function(data){
			var obj = getJSONData(data);
			if(obj != false){
				if(obj.status == 1){
					$("#promotion_content").html(obj.html);
					$("#btn_show_more_promotion").show();
					$("#select_promotion").attr('data-current-page', obj.current_page);
				}
			}
		}
	});
});

/*** EVENT CLICK BUTTON SHOWMORE IN PROMOTION PAGE ***/
$(".container").on("click", "#btn_show_more_promotion", function(e){
	var url = $("#select_promotion").val();
	var page = $("#select_promotion").attr('data-current-page');
	$.ajax({
		url: url,
		type: "POST",
		data: {current_page: page},
		success: function(data){
			var obj = getJSONData(data);
			if(obj != false){
				if(obj.status == 1){
					$("#promotion_content").append(obj.html);
					if(obj.showmore == false){
						$("#btn_show_more_promotion").hide();
					}
					// $("#promotion_content").append(obj.html);
					$("#select_promotion").attr('data-current-page', obj.current_page);
				}
			}
		}
	});
});

/*** EVENT CLICK BUTTON SHOWMORE IN PORTFOLIO PAGE ***/
$(".container").on("click", "#btn_show_more_portfolio", function(){
	var url = $("#portfolio_content").attr('data-info');
	var page = $("#portfolio_content").attr('data-current-page');
	$.ajax({
		url: url,
		type: "POST",
		data: {current_page: page},
		success: function(data){
			var obj = getJSONData(data);
			if(obj != false){
				if(obj.status == 1){
					$("#portfolio_content").append(obj.html);
					if(obj.showmore == false){
						$("#btn_show_more_portfolio").hide();
					}
					$("#portfolio_content").attr('data-current-page', obj.current_page);
				}
			}
		}
	});
});