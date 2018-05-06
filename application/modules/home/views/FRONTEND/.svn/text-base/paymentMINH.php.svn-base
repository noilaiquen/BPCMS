<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript" src="../../../../../assets/js/bootstrapValidator-min.js"></script>
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
</script>
<script type="text/javascript">
            // this identifies your website in the createToken call below
            // Stripe.setPublishableKey('<Stripe Publishable Key>');
            // Stripe.setPublishableKey('sk_live_MJ47PNocgosADBbv6pjIJ9tq'); // TODO
            Stripe.setPublishableKey('pk_test_eoN6cmIiM1lHsxcu4hrO0cui'); // TODO
    <?php
    ?>
 
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
                                    $("#promotion_content").html(obj.html);
                                    $("#btn_show_more_promotion").show();
                                    $("#select_promotion").attr('data-current-page', obj.current_page);
                                }
                            }
                        }
                    });
                    form$.get(0).submit();
                    $("#myModal").hide();
                    $("#button_account").hide();
                }
            }
</script>
<?php
    if(isset($_POST['stripe_id'])) $stripe = $_POST['stripe_id'];
    
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
					            <div class="payment-link"><a data-toggle="modal" href="#myModal" disable>Link Bank Account</a></div>
                            <?php
                        }
                    ?>
				</div>
			</div>
			<div class="col-md-3 col-xs-12">
				<div class="payment-right">
					<div class="payment-icon"><i class="fa fa-cc-stripe" aria-hidden="true"></i></div>
					<p class="payment-description">NO STRIPE ACCOUNT</p>
					<div class="payment-link"><a href="#">Link Stripe Account</a></div>
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
                      <div class="modal-body" class="payment-popup-content">
                        <form action="">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="form-group ">
                                    <label for="" class="payment-popup-name">Card Holder's Name</label>
                                    <input name="cardholdername" class="form-control card-holder-name" type="text" placeholder="Card Holder's Name">
                                </div>
                                <div class="form-group">
                                    <label for="" class="payment-popup-name">Card Expiry Date</label>
                                    <div class="form-inline">
                                      <select name="select2" data-stripe="exp-month" class="card-expiry-month stripe-sensitive required form-control">
                                        <option value="01" selected="selected">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                      </select>
                                      <span> / </span>
                                      <select name="select2" data-stripe="exp-year" class="card-expiry-year stripe-sensitive required form-control">
                                        <option value="2022" selected="selected">2022</option>
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
                                    <label for="" class="payment-popup-name">Card Number</label>
                                    <input type="text"  id="cardnumber" maxlength="19" placeholder="Card Number" class="card-number form-control">
                                </div>
                            </div>
                        </form>
                      </div>
                      <div class="modal-footer payment-popup-button">
                        <button type="submit" class="btn btn-primary">Pay now</button>
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