<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="<?=get_resource_url('assets/js/bootstrapValidator-min.js')?>"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#payment-form').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitHandler: function(validator, form, submitButton) {
                    // createToken returns immediately - the supplied callback submits the form if there are no errors
                    Stripe.card.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val(),
			name: $('.card-holder-name').val()
                    }, stripeResponseHandler);
                    return false; // submit from callback
        },
        fields: {
			cardholdername: {
                validators: {
                    notEmpty: {
                        message: 'The card holder name is required and can\'t be empty'
                    },
					stringLength: {
                        min: 6,
                        max: 70,
                        message: 'The card holder name must be more than 6 and less than 70 characters long'
                    }
                }
            },
			cardnumber: {
		selector: '#cardnumber',
                validators: {
                    notEmpty: {
                        message: 'The credit card number is required and can\'t be empty'
                    },
					creditCard: {
						message: 'The credit card number is invalid'
					},
                }
            },
			expMonth: {
                selector: '[data-stripe="exp-month"]',
                validators: {
                    notEmpty: {
                        message: 'The expiration month is required'
                    },
                    digits: {
                        message: 'The expiration month can contain digits only'
                    },
                    callback: {
                        message: 'Expired',
                        callback: function(value, validator) {
                            value = parseInt(value, 10);
                            var year         = validator.getFieldElements('expYear').val(),
                                currentMonth = new Date().getMonth() + 1,
                                currentYear  = new Date().getFullYear();
                            if (value < 0 || value > 12) {
                                return false;
                            }
                            if (year == '') {
                                return true;
                            }
                            year = parseInt(year, 10);
                            if (year > currentYear || (year == currentYear && value > currentMonth)) {
                                validator.updateStatus('expYear', 'VALID');
                                return true;
                            } else {
                                return false;
                            }
                        }
                    }
                }
            },
            expYear: {
                selector: '[data-stripe="exp-year"]',
                validators: {
                    notEmpty: {
                        message: 'The expiration year is required'
                    },
                    digits: {
                        message: 'The expiration year can contain digits only'
                    },
                    callback: {
                        message: 'Expired',
                        callback: function(value, validator) {
                            value = parseInt(value, 10);
                            var month        = validator.getFieldElements('expMonth').val(),
                                currentMonth = new Date().getMonth() + 1,
                                currentYear  = new Date().getFullYear();
                            if (value < currentYear || value > currentYear + 100) {
                                return false;
                            }
                            if (month == '') {
                                return false;
                            }
                            month = parseInt(month, 10);
                            if (value > currentYear || (value == currentYear && month > currentMonth)) {
                                validator.updateStatus('expMonth', 'VALID');
                                return true;
                            } else {
                                return false;
                            }
                        }
                    }
                }
            },
			cvv: {
		selector: '#cvv',
                validators: {
                    notEmpty: {
                        message: 'The cvv is required and can\'t be empty'
                    },
					cvv: {
                        message: 'The value is not a valid CVV',
                        creditCardField: 'cardnumber'
                    }
                }
            },
        }
    });
});


// iFrame - Popup Communication
if(window.postMessage) {
    if(window.addEventListener) {
        window.addEventListener("message", popup_callback, false);
    } else if(window.attachEvent) {
        window.attachEvent("onmessage", popup_callback);
    }
}
function popup_callback(event) {
	if(location.href.indexOf(event.origin) == 0){
		var data = event.data;
		if(data && data.message && data.message.indexOf('habfit_') == 0){
			if(popup_window){
				popup_window.close();
			}
			if(data.message == 'habfit_sucess'){
				alert('Link Stripe account successfully');
				location.reload();
			} else {
				alert('Link Stripe account failed!');
			}
		}
	}
}

var popup_window;
function popup_connect_with_stripe(){
	<?php
	if(!empty($stripe_connect_pro_url)){
	?>
	popup_window = window.open("<?=$stripe_connect_pro_url?>", "Link Stripe Account Popup", "");
	<?php
	}
	?>
	return false;
}
function unlink_stripe_customer() {
    var url = '<?=$unlink_url?>';
      toggleLoadingScreen();
      $.ajax({
        type: 'POST',
        url: url,
        success: function(data) {
          obj = getJSONData(data);
          if(obj!=false) {
            toggleLoadingScreen();
            if (obj.status == 1) {
                $("#btn_stripe").text('Link Stripe Account');
                // _btn.attr('onclick', 'return popup_connect_with_stripe()');
                $('div.stripe .payment-description').text('NO STRIPE ACCOUNT');

            }
            showMessageNotify(obj);
          }
          else {
            toggleLoadingScreen();
          }
        },
        error: function() {
          toggleLoadingScreen();
        }
      });
};
$("body").on('click', '#btn_stripe', function(event){
    event.preventDefault();
    var is_link = $(this).attr('data-link');
    if (is_link == 1) {
        $(this).attr('data-link', 0);
        return unlink_stripe_customer();
    } else {
        $(this).attr('data-link', 1);
        return popup_connect_with_stripe();
    }
});
</script>
<script type="text/javascript">
            Stripe.setPublishableKey('<?=!empty($stripe_public_key)?$stripe_public_key:''?>');
 
            function stripeResponseHandler(status, response) {
                if (response.error) {
                    // re-enable the submit button
                    $('.submit-button').removeAttr("disabled");
					// show hidden div
					document.getElementById('a_x200').style.display = 'block';
                    // show the errors on the form
                    $(".payment-errors").html(response.error.message);
                } else {
                    var form$ = $("#payment-form");
                    // token contains id, last4, and card type
                    var token = response['id'];
                    // insert the token into the form so it gets submitted to the server
                    //form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
					
                    //$('#stripe_token_value').val(token);
					var url = $("#myModal").attr('action');
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {stripe_token: token},
                        success: function(data){
                            var obj = getJSONData(data);
                            if(obj != false){
                                if(obj.status == 1){
									alert('Link bank account successfully');
									location.reload();
                                    // $("#myModal").hide();
                                    // $("#button_account").hide();
                                } else {
									alert('Link bank account failed!');
								}
                            }
                        }
                    });
//                    form$.get(0).submit();
                }
            }
</script>
<?php
    $now = getdate(); 
    // $month = $now["mon"];
    $month = 1;
    $year =  $now["year"];
    $minYear = $now["year"]-3; // Not used?
    $maxYear = $now["year"]+20;
?>
<form action="" method="POST" id="payment-form" class="form-horizontal">
<section id="payment">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<p class="payment-title">Link Account</p>
			</div>
			<div class="col-md-3 col-xs-12 col-md-offset-3">
				<div class="payment-left">
					<div class="payment-icon"><i class="fa fa-university" aria-hidden="true"></i></div>
					<?php
                        if($check_stripe == 1){
                            ?>
                                <p class="payment-description">LINKED BANK ACCOUNT</p>
                            <?php
                        }
                        else
                        {
                            ?>
                                <p class="payment-description">NO BANK ACCOUNT</p>
					            <div class="payment-link" id="button_account"><a data-toggle="modal" href="#myModal" disable>Link Bank Account</a></div>
                            <?php
                        }
                    ?>
				</div>
			</div>
			<div class="col-md-3 col-xs-12">
				<div class="payment-right stripe">
					<div class="payment-icon"><i class="fa fa-cc-stripe" aria-hidden="true"></i></div>
					<?php
                        if($check_stripe_ofPro == 1){
                            ?>
                                <p class="payment-description">LINKED STRIPE ACCOUNT</p>
                                <div class="payment-link">
                                    <a id="btn_stripe" href="#" data-link="1">Unlink Stripe Account</a>
                                </div>
                            <?php
                        }
                        else if(!empty($stripe_connect_pro_url))
                        {
                            ?>
                                <p class="payment-description">NO STRIPE ACCOUNT</p>
					            <div class="payment-link">
                                    <a id="btn_stripe" href="#" data-link="0">Link Stripe Account</a>
                                </div>
                            <?php
                        }
                    ?>
				</div>
			</div>
			<col-md-12>
			    <div id="myModal" class="modal fade" role="dialog" action="<?=$url_insert_token?>">
                  <div class="modal-dialog">
                   <!-- Modal content-->
                    <div class="modal-content" >
                      <div class="payment-popup-title">
                        <button type="button" class="popup-payment-close" data-dismiss="modal">&times;</button>
                        <h1>Card Details</h1>
                      </div>
                      <div class="modal-body" class="">
                        <form action="">
                            <div class="col-md-10 col-md-offset-1 payment-popup-content">
                                <div class="form-group ">
                                    <p for="" class="payment-popup-name">Card Holder's Name</p>
                                    <input name="cardholdername" class="form-control card-holder-name" type="text" placeholder="Card Holder's Name">
                                </div>
                                <div class="form-group">
                                    <p for="" class="payment-popup-name">Card Expiry Date</p>
                                    <div class="form-inline">
                                      <select name="select2" data-stripe="exp-month" class="card-expiry-month stripe-sensitive required form-control">
                                       <?php
                                            for($i=$month; $i<=12; $i++){
                                                ?>
                                                    <option value="<?php echo $i;?>" ><?php echo $i;?></option>
                                                <?php
                                            }
                                        ?>
                                      </select>
                                      <span> / </span>
                                      <select name="select2" data-stripe="exp-year" class="card-expiry-year stripe-sensitive required form-control">
                                       <?php
                                          for($i=$year; $i<=$maxYear; $i++){
                                                ?>
                                                    <option value="<?php echo $i;?>" ><?php echo $i;?></option>
                                                <?php
                                            }
                                        ?>
                                        <option value="2022" >2022</option>
                                      </select>
                                      <script type="text/javascript">
                                        /*
                                        var select = $(".card-expiry-year"),
                                        year = new Date().getFullYear();

                                        for (var i = 0; i < 12; i++) {
                                            select.append($("<option value='"+(i + year)+"' "+(i === 0 ? "selected" : "")+">"+(i + year)+"</option>"))
                                        }
                                        */
                                    </script> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <p for="" class="payment-popup-name">Card Number</p>
                                    <input type="text"  id="cardnumber" maxlength="19" placeholder="Card Number" class="card-number form-control">
                                </div>
                                <div class="form-group">
                                  <p class="payment-popup-name" for="textinput">CVV/CVV2</p>
                                    <input type="text" id="cvv" placeholder="CVV" maxlength="4" class="card-cvc form-control" value="000">
                                </div>
                            </div>
                        </form>
                      </div>
                      <div class=" payment-popup-button">
                        <button type="submit"  class="btn btn-primary">Register</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                      </div>
                  </div>
                </div>
            </div>
			</col-md-12>
			<div class="col-xs-12 payment-notification">
				<p>Your money is automatically deposited 1-2 business days after payment is talken</p>
			</div>
		</div>
	</div>
</div>
</form>