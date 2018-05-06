$("form.blk-item-day").ready(function(){
    disFormTime();
    $("#input_start_date").datepicker();
    $("#input_end_date").datepicker();
    promo_validate;
});

/* EVENT CLICK BUTTON RIGHT */
$("p.creat-upload").click(function(){
    var _type=$(this).attr("data-type");
    var _action=$(this).attr("data-action");
    var _text=$(this).text();
    var submit=false;
    switch(_type) {
        case 'service':
            if(_action=='edit'){_action = 'save'; _text = 'SAVE';
            showMessageNotify(3,'You can edit info', 3000);}
            else{_action = 'edit'; _text = 'EDIT';submit=true;}
            break;
        case 'promo': if(_action!= '') {window.location.href = window.location.href.replace(/\/?$/, '/')+_action;}
            break;
        case 'time':
            if(_action=='edit'){_action = 'save'; _text = 'SAVE';
            showMessageNotify(3,'You can edit info', 3000);}
            else{_action = 'edit'; _text = 'EDIT';submit=true;}
            break;
    }
    $(this).attr("data-action", _action);
    $(this).text(_text);
    if(submit) {
        if(_type=='service') submitFormService();
        if(_type=='time') submitFormTime();
        submit=false;
    }
    disFormTime();
    disFormService();
});

/* EVENT CLICK CHECKBOX IN AVAILABILITY */
$("form.blk-item-day :checkbox").change(function(){
    var name = $(this).attr('data-name');
    var type = $(this).attr('data-type');
    var _parent = $(this).parents('ul');
    var _chk_time = _parent.find("[data-type=chk_time]");
    var _stt_time = _parent.find("[data-type=stt_time]");
    var _end_time = _parent.find("[data-type=end_time]");
    var _chk_break = _parent.find("[data-type=chk_break]");
    var _stt_break = _parent.find("[data-type=stt_break]");
    var _end_break = _parent.find("[data-type=end_break]");
    var _li_time = _parent.find("li[data-parent='"+name+"']");
    var _lbl_break = _parent.find("label[data-parent='"+name+"']");
    var _spn_break = _parent.find("span[data-parent='"+name+"']");
    // var isChkTime = false;
    // var isChkBreak = false;
    if($(this).is(":checked")) {
        $(this).val(1);
        $("input[name='"+name+"']").val(1);
    }
    else {
        $(this).val(0);
        $(":input[name='"+name+"']").val(0);
    }
    var isChkTime = _chk_time.is(":checked");
    var isChkBreak = _chk_break.is(":checked");
    if(isChkTime) {
        _stt_time.removeAttr('ss').removeClass('disabled');
        _end_time.removeAttr('ss').removeClass('disabled');
        _chk_break.removeAttr('disabled');
        _lbl_break.removeClass('disabled');
        _spn_break.removeClass('disabled');
        _li_time.removeClass('disabled');
        if(isChkBreak) {
            _stt_break.removeAttr('ss').removeClass('disabled');
            _end_break.removeAttr('ss').removeClass('disabled');
        }else {
            _stt_break.attr('ss', 'ss').addClass('disabled');
            _end_break.attr('ss', 'ss').addClass('disabled');
        }
    }
    else {
        _stt_time.attr('ss', 'ss').addClass('disabled');
        _end_time.attr('ss', 'ss').addClass('disabled');
        _stt_break.attr('ss', 'ss').addClass('disabled');
        _end_break.attr('ss', 'ss').addClass('disabled');
        _chk_break.attr('disabled', 'disabled');
        _lbl_break.addClass('disabled');
        _spn_break.addClass('disabled');
        _li_time.addClass('disabled');
    }
});

function disFormTime() {
    var _this = $("form.blk-item-day :input:not([type=hidden])");
    switch($("p.creat-upload").attr("data-action")) {
        case 'edit':
            _this.attr('disabled', 'disabled');
            break;
        case 'save':
            $("form.blk-item-day :input").removeAttr('disabled');
            $("form.blk-item-day :checkbox").change();
            break;
        default: _this.attr('disabled', 'disabled');
    }
}
function submitFormTime() {
    $("form.blk-item-day").submitFormField();
}

$(":checkbox[data-type='service_check']").change(function(){
    var name = $(this).attr('id');
    if($(this).is(":checked")) {
        $(this).val(1);
    }
    else {
        $(this).val(0);
    }
    $("input:hidden[name="+name+"]").val($(this).val());
});
$("#smit-form").click(function(){
    submitFormTime();
});
$("form.form-promotion").ready(function(){
    disFormService();
});

function disFormService() {
    // form-promotion
    var _this = $("form.form-promotion :input");
    switch($("p.creat-upload").attr("data-action")) {
        case 'edit':
             _this.attr('class', 'disabled');
            _this.attr('disabled', 'disabled');
            convertFormService();
            break;
        case 'save':
            _this.removeAttr('disabled');
            _this.removeClass('disabled');
            convertFormService();
            break;
        default:
            _this.attr('class', 'disabled');
            _this.attr('disabled', 'disabled');
            _this.click(function(){
                return false;
            });
    }
}

function convertFormService() {
    switch($("p.creat-upload").attr("data-action")) {
        case 'edit':
        $("form.form-promotion input[data-type='service_price']").each(function(){
            var txtHTML = "<label data-type='service_price' data-name='"+$(this).attr('name')+"'>"+$(this).val()+"</label>";
            $(this).replaceWith(txtHTML);
        });
            break;
        case 'save':
        $("form.form-promotion label[data-type='service_price']").each(function(){
            // console.log($(this).attr('data-name'));
            var txtHTML = "<input class='price' data-type='service_price' type='text' name='"+$(this).attr('data-name')+"' value='"+$(this).text()+"' />";
            $(this).replaceWith(txtHTML);
        });
        $("input[class*='price']").numeric();
        $("form.form-promotion input[data-type='service_price']").change(function(){
            if($(this).val()=='')
                $(this).val(0);
        });
            break;
    }
}
function submitFormService() {
    $("form.form-promotion").submitFormField();
}
//end service
$.validator.addMethod("enddate", function(value, element) {
    var startDate = $('.start-date').val();
    return Date.parse(startDate) <= Date.parse(value) || value == "";
}, "End date must be after start date");
var promo_validate = $("#frm_promotion_detail").validate({
    validClass: "has-success",
    errorClass: "frm-error",
    rules: {
        input_title: {
            required: true
        },
        input_start_date: {
            required: true
        },
        input_end_date: {
            required: true,
            enddate: true,
        },
        input_details: {
            required: true
        },
        input_t_of_c: {
            required: true
        },
    },
    messages: {
        input_title: {
            required: "Enter your firstname",
            isname: "Firstname has no number"
        },
        input_start_date: {
            required: "Select start date"
        },
        input_end_date: {
            required: "Select end date",
            // enddate: ""
        },
        input_details: {
            required: "Enter details"
        },
        input_t_of_c: {
            required: "Enter Term of conditions"
        },
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
//EVENT CLICK UPLOAD POSTER
$("#btn_upload_poster").click(function(){
    //$("input[name='input_poster']").click()
});
$("input[name='input_poster']").change(function () {
    if (typeof (FileReader) != "undefined") {
        var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
        $($(this)[0].files).each(function () {
            var file = $(this);
            if (regex.test(file[0].name.toLowerCase())) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("#preview_poster").attr("src", e.target.result);
                    $("#preview_poster").show();
                    $("#main_poster").hide();
                }
                reader.readAsDataURL(file[0]);
            } else {
                alert(file[0].name + " is not a valid image file.");
                return false;
            }
        });
    } else {
        alert("This browser does not support HTML5 FileReader.");
    }
});
//EVENT CLICK BTN SAVE
$("button[data-action='save']").click(function() {
    var _value= $(this).attr('data-value');
    if($("#frm_promotion_detail").valid()) {
        switch(_value) {
            case 'draft':
                $("#input_publish").val(0);
                $("#frm_promotion_detail").submitFormData(changePromotionPoster);
                break;
            case 'publish': $("#input_publish").val(1);
                $("#frm_promotion_detail").submitFormData(changePromotionPoster);
                break;
        }
    }
});
function changePromotionPoster(data) {
    var obj = JSON.parse(data);

    if(obj.status==1) {
        $("#main_poster").attr("src", obj.image_url);
        $("#preview_poster").removeAttr("src");
    }
    $("#preview_poster").hide();
    $("#main_poster").show();
}