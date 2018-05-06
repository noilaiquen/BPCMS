var preUrl = $("#user_avatar").attr("src");
$("#frm_upload_avatar :button").click(function(e){
    e.preventDefault();
    var name = $(this).attr('name');
    switch(name) {
        case 'btn_avt_upload':
            doUploadAvatar();
            break;
        case 'btn_avt_cancel':
            cancelSubmitAvatar();
            break;
        case 'btn_avt_submit':
            doSubmitAvatar();
            break;
    }
});
function toggleButton(flag) {
    if(flag) {
        $("button[name='btn_avt_upload']").hide();
        $("button[name='btn_avt_cancel']").show();
        $("button[name='btn_avt_submit']").show();
    }
    else {
        $("button[name='btn_avt_upload']").show();
        $("button[name='btn_avt_cancel']").hide();
        $("button[name='btn_avt_submit']").hide();
    }
}
function doUploadAvatar() {
    $("input[name='input_avatar']").click();
    $("input[name='input_avatar']").change(function () {
        if (typeof (FileReader) != "undefined") {
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
            $($(this)[0].files).each(function () {
                var file = $(this);
                if (regex.test(file[0].name.toLowerCase())) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $("#user_avatar").attr("src", e.target.result);
                        $("#top_menu_avatar").attr("src", e.target.result);
                    }
                    reader.readAsDataURL(file[0]);
                    toggleButton(true);
                } else {
                    alert(file[0].name + " is not a valid image file.");
                    return false;
                }
            });
        } else {
            alert("This browser does not support HTML5 FileReader.");
        }
    });
}
function doSubmitAvatar() {
        var formData = new FormData();
        formData.append('input_avatar', $('#input_upload_avatar')[0].files[0]);
        var url = $('#frm_upload_avatar').attr('action');
        $("button[name='btn_avt_submit']").hide();
        $("button[name='btn_avt_cancel']").hide();
        toggleLoadingScreen();
        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                var obj = jQuery.parseJSON(data);
                if(obj.status==1) {
                    $("#user_avatar").attr('src', obj.image);
                    $("#top_menu_avatar").attr("src", obj.image);
                }
                toggleLoadingScreen();
                showMessageNotify(obj);
                toggleButton(false);
            },
            error: function() {
                toggleLoadingScreen();
            }
        });
    // preUrl = $("#user_avatar").attr("src");
    // $("#user_avatar").attr("src", preUrl);
    // $("#top_menu_avatar").attr("src", preUrl);
}
function doSubmitAvatarNew() {
    
}
function cancelSubmitAvatar() {
    $("#user_avatar").attr("src", preUrl);
    $("#top_menu_avatar").attr("src", preUrl);
    toggleButton(false);
}
$.validator.addMethod('isname', function (value, element) {
    return (value.match(/\d+/) == null) ? true : false;
}, 'No number');
$("#frm_upload_award_image").validate({
    validClass: "has-success",
    errorClass: "frm-error",//"has-error",
    rules: {
        input_award_name: {
            required: true
        }
    },
    messages: {
        input_award_name: {
            required: "Enter award name"
        }
    },
    submitHandler: function(form) {
        doSubmitPersonalAward();
        $('#frm_upload_award_image')[0].reset();
    },
    errorPlacement: function(error, element) {
        element.attr("data-original-title", error.text());
        element.tooltip();
    },
    highlight: function(element, errorClass, validClass) {
        $(element).parent().addClass(errorClass);
    },
    unhighlight: function(element, errorClass, validClass) {
        $(element).removeAttr('data-original-title');
        $(element).parent().removeClass(errorClass);//.addClass(validClass);
    }
});

// $("#list_awards").on("click","button[data-action='delete']", function(e){
//   var type = $(this).attr("data-type");
//   var val = $(this).attr("data-value");
//   showPopupDeleteConfirm();
// });

$("#list_awards").on('click', 'img', function(){
    viewAward($(this));
});
function changePersonalInfo(data) {
    var obj = jQuery.parseJSON(data);
    $("p[data-name='personal-name'] > span").text(obj.fullname);
    $("p[data-name='personal-phone'] > span").text(obj.phone);
    $("p[data-name='personal-mobile'] > span").text(obj.mobile);
}
function changeSalonInfo(data) {
    var obj = jQuery.parseJSON(data);
    $("p[data-name='salon-name'] > span").text(obj.name);
    $("p[data-name='salon-address'] > span").text(obj.address);
}
function viewAward(ele) {
    $('#modal_view_award').find("img").attr('src', ele.attr('src'));
    $('#modal_view_award').find("input[type='text']").val(ele.attr('title'));
    $('#modal_view_award').modal('show');
}
$("#frm_personal_profile").validate({
    validClass: "has-success",
    errorClass: "frm-error",//"has-error",
    rules: {
        input_first_name: {
            required: true,
            isname: true
        },
        input_last_name: {
            required: true,
            isname: true
        },
        input_email: {
            required: true,
            email: true
            },
        // input_phone: {
        //     required: true,
        //     number: true,
        // },
        input_mobile: {
            required: true,
            number: true,
        },
    },
    messages: {
        input_first_name: {
            required: "Enter your firstname",
            isname: "Firstname has no number"
        },
        input_last_name: {
            required: "Enter your lastname",
            isname: "Lastname has no number"
        },
        input_email: {
            required: "Enter your email",
            email: "Enter a valid email address"
        },
        input_phone: {
            required: "Enter your phone number",
            number: "Enter only number value"
        },
        input_mobile: {
            required: "Enter your mobile number",
            number: "Enter only number value"
        },
    },
    submitHandler: function(form) {
        $(form).submitFormField(changePersonalInfo);
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
        $(element).parent().removeClass(errorClass);//.addClass(validClass);
        $(element).removeClass(errorClass);//.addClass(validClass);
    }
});
function doSubmitPersonalAward() {
    var d = new Date();
    var rd_id = 'ps_ad_'+Math.round(Math.random()*120+d.getTime());
    var newAwardHTML = "<div class='award-library col-lg-3 col-md-4 col-sm-4 col-xs-12'><div class='awards-img' id='"+rd_id+"'><div class='loading'></div></div></div>";
    $(newAwardHTML).insertBefore($("#btn_upload_award").parent(".col-xs-12"));
    var url = $('#frm_upload_award_image').attr('action');
    $('#modal_upload_award').modal('hide');
    var data  = {
                input_award_name : $('#input_award_name').val(),
                input_image_award_url : $('#input_image_award_url').val(), 
                input_thumbnail_award_url : $('#input_thumbnail_award_url').val(),
                input_div_parent_id : rd_id
            };
            
    // var formData = new FormData();
    // formData.append('input_image_award_url', $('#input_image_award_url').val());
    // formData.append('input_thumbnail_award_url', $('#input_thumbnail_award_url').val());
    // formData.append('input_div_parent_id', rd_id);
    console.log(data);
    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        success: function(data) {
            var obj = jQuery.parseJSON(data);

            if(obj.status==1) {
                //console.log(data);
                console.log('thành công');
               // console.log('obj.status'+obj.status);
                var htmlPhotoSuccess = "<img class='award' src='"+obj.image+"' title='"+obj.image+"'><button type='button' data-action='delete' data-type='award' data-value='"+obj.code_val+"' data-url='"+obj.delete_url+"'></button>";
                _this = $("div#"+obj.parent_id);
                _this.html(htmlPhotoSuccess);
                _this.removeClass('loading');
                _this.removeAttr('id');

                // var htmlPhotoSuccess = "<img src='"+obj.thumbnail+"'><button type='button' data-action='delete' data-type='salon_photo' data-value='"+obj.code_val+"' data-url='"+obj.delete_url+"'></button>";
                // _this = $("div#"+obj.parent_id);
                // _this.html(htmlPhotoSuccess);
                // _this.removeClass('loading');
                // _this.removeAttr('id');
            }else {
                //console.log(data);
                //console.log('thất bại');
                $("div#"+obj.parent_id).parent().remove();
            }
            showMessageNotify(obj);
        }
    });
    /*var formData = new FormData();
    formData.append('input_award_image', $('#input_award_image')[0].files[0]);
    formData.append('input_award_name', $('#input_award_name').val());
    formData.append('input_div_parent_id', rd_id);
    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {
            var obj = jQuery.parseJSON(data);
            if(obj.status==1) {
                var htmlPhotoSuccess = "<img class='award' src='"+obj.image+"' title='"+obj.name+"'><button type='button' data-action='delete' data-type='award' data-value='"+obj.code_val+"' data-url='"+obj.delete_url+"'></button>";
                _this = $("div#"+obj.parent_id);
                _this.html(htmlPhotoSuccess);
                _this.removeAttr('id');
            }else {
                $("div#"+obj.parent_id).parent().remove();
            }
            showMessageNotify(obj);
        }
    }); */
}
$("button[name='add_award'], #preview_award").click(function(){
	
    // document.getElementById('input_award_image').dispatchEvent( new Event('click') );
    // $("#input_award_image")[0].click();//.click();//.trigger('click');
    //$("#input_award_image").trigger('click');//.click();//
});
$("#input_award_image").change(function () {
    if (typeof (FileReader) != "undefined") {
        var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
        $($(this)[0].files).each(function () {
            var file = $(this);
            if (regex.test(file[0].name.toLowerCase())) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("#preview_award").attr("src", e.target.result);
                }
                reader.readAsDataURL(file[0]);
                $('#modal_upload_award').modal('show');
                $("input[name='input_name_award']").focus();
            } else {
                alert(file[0].name + " is not a valid image file.");
                return false;
            }
        });
    } else {
        alert("This browser does not support HTML5 FileReader.");
    }
});

$(".popup-award #btn_cancel_upload_award, #btn_close_upload_award").click(function(){
    $('#modal_upload_award').modal('hide');
    $('#frm_upload_award_image')[0].reset();
    $("#preview_award").removeAttr("src");
});

$(".popup-award #btn_close_view_award").click(function(){
    $('#modal_view_award').modal('hide');
});

$("#salon-profile .title-salon").click(function(){
    if($(this).children("i.open").length>0) {
        $(".social-media-profile .drop-down-menu-social").slideUp();
        $(this).children("i.open").removeClass("open");
    }
    else {
        $(".social-media-profile .drop-down-menu-social").slideDown();
        $(this).children("i").addClass("open");
    }
});

$("#btn_upload_salon_photo").click(function(){
    //$("#input_salon_photo").click();
});
$("#input_salon_photo").change(function (){
    var d = new Date();
    var rd_id = 'sl_pt_'+Math.round(Math.random()*100+d.getTime());
    var newPhotoHTML = "<div class='col-lg-3 col-md-4 col-sm-4 col-xs-12 profile-library'><div class='image-salon' id='"+rd_id+"'><div class='loading'></div></div></div>";
    $(newPhotoHTML).insertBefore($("#btn_upload_salon_photo").parent());
    doSubmitSalonPhoto(rd_id);
});
function doSubmitSalonPhoto(rd_id) {
    var url = $('#frm_upload_salon_photo').attr('action');
    var formData = new FormData();
    formData.append('input_salon_thumbnail', $('#input_thumbnail_salon_url').val());
    formData.append('input_salon_photo', $('#input_image_salon_url').val());
    formData.append('input_div_parent_id', rd_id);
    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {
            var obj = jQuery.parseJSON(data);
            if(obj.status==1) {
                var htmlPhotoSuccess = "<img src='"+obj.thumbnail+"'><button type='button' data-action='delete' data-type='salon_photo' data-value='"+obj.code_val+"' data-url='"+obj.delete_url+"'></button>";
                _this = $("div#"+obj.parent_id);
                _this.html(htmlPhotoSuccess);
                _this.removeClass('loading');
                _this.removeAttr('id');
            }else {
                $("div#"+obj.parent_id).parent().remove();
            }
            showMessageNotify(obj);
        }
    });
}
$("#frm_salon_profile").validate({
    validClass: "has-success",
    errorClass: "frm-error",//"has-error",
    rules: {
        input_salon_name: {
            required: true
        },
        // input_salon_phone: {
        //     required: true,
        //     number: true
        // },
        input_address_one: {
            required: true
        },
        input_salon_city: {
            required: true
        },
        input_salon_experience: {
            number: true
        },
        input_zip: {
            number: true
        },
        input_website_url: {
            url: true
        },
        input_facebook_url: {
            url: true
        },
        input_twitter_url: {
            url: true
        },
        input_pinterest_url: {
            url: true
        },
        input_pinterest_url: {
            url: true
        },
        input_instagram_url: {
            url: true
        }
    },
    messages: {
        input_salon_name: {
            required: "Enter salon name"
        },
        input_salon_phone: {
            required: "Enter salon phone",
            number: "Enter only number value"
        },
        input_address_one: {
            required: "Enter salon address 1"
        },
        input_salon_city: {
            required: "Enter salon city"
        },
        input_salon_experience: {
            number: "Enter only number value"
        },
        input_zip: {
            number: "Enter only number value"
        },
        input_website_url: {
            url: "Enter a valid url"
        },
        input_facebook_url: {
            url: "Enter a valid url"
        },
        input_twitter_url: {
            url: "Enter a valid url"
        },
        input_pinterest_url: {
            url: "Enter a valid url"
        },
        input_instagram_url: {
            url: "Enter a valid url"
        }
    },
    submitHandler: function(form) {
        $(form).submitFormField(changeSalonInfo);
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
        // $(element).parent().removeClass(errorClass);//.addClass(validClass);
        $(element).removeClass(errorClass);//.addClass(validClass);
    }
});
$("#frm_personal_account_id").validate({
    validClass: "has-success",
    errorClass: "frm-error",//"has-error",
    rules: {
        input_personal_account_id: {
            required: true
        }
    },
    messages: {
        input_personal_account_id: {
            required: "Enter personal account id"
        }
    },
    submitHandler: function(form) {
        $(form).submitFormField(tooltipPersonalAccountId);
    },
    errorPlacement: function(error, element) {
        element.attr("data-original-title", error.text());
        element.tooltip();
    },
    highlight: function(element, errorClass, validClass) {
        $(element).addClass(errorClass);
    },
    unhighlight: function(element, errorClass, validClass) {
        $(element).removeAttr('data-original-title');
        $(element).parent().removeClass(errorClass);
        $(element).removeClass(errorClass);
    }
});
function tooltipPersonalAccountId(data) {
    var obj = jQuery.parseJSON(data);
    if(obj.status != 1) {
        $("#input_personal_account_id").addClass("frm-error");
        $("#input_personal_account_id").attr("data-original-title", obj.message);
        $("#input_personal_account_id").tooltip();
        setTimeout(function(){
            $("#input_personal_account_id").removeAttr('data-original-title');
            $("#input_personal_account_id").parent().removeClass("frm-error");
            $("#input_personal_account_id").removeClass("frm-error");
        }, 3000);
    }
}