
<section id="payment-more-services">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="payment-more-services-title">
					<p>GET BOSSTED</p>
					<p>Your Balance : <?=!empty($num_of_balance) ? $num_of_balance : '0'?></p>
				</div>
				<div class="payment-more-services-content">
				<form method="post" action="<?=$url_charge_package?>" id="form_package">
				<?php foreach($infoPackage as $k => $v){
                    ?>
                    <div class="payment-more-services-content-item">
						<div class="payment-more-services-content-item-name">
							<a href="#"><?=!empty($v->name)?$v->name:NULL?></a>
						</div>
						<div class="payment-more-services-content-item-description">
							<?=!empty($v->description)?$v->description:NULL?>
						</div>
						<button id="btn_price" type="button" class="payment-more-services-content-item-price" value="<?=$v->id?>">
							$<?=!empty($v->price)?$v->price:NULL?>
						</button>
					</div>
                    <?php
                    }
                ?>
					<!--<div class="payment-more-services-content-item">
						<div class="payment-more-services-content-item-name">
							<a href="#"></a>
						</div>
						<div class="payment-more-services-content-item-description">
							Upload 1 photo for only $0.50
						</div>
						<button class="payment-more-services-content-item-price">
							$0.50
						</button>
					</div>
					<!-- item
					<div class="payment-more-services-content-item">
						<div class="payment-more-services-content-item-name">
							<a href="#">Booster Pack</a>
						</div>
						<div class="payment-more-services-content-item-description">
							Upload 10 more photos for $2.50
						</div>
						<button class="payment-more-services-content-item-price">
							$2.50
						</button>
					</div>
					<!-- item 
					<div class="payment-more-services-content-item">
						<div class="payment-more-services-content-item-name">
							<a href="#">Volume Up Pack</a>
						</div>
						<div class="payment-more-services-content-item-description">
							Upload 20 more photos for $4.50
						</div>
						<button class="payment-more-services-content-item-price">
							$2.50
						</button>
					</div>
					<!-- item -->
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<script>
<?php
if(empty($check_stripe)){
?>
alert('Please link bank account to buy package!');
location.href = "<?=PATH_URL.'/payment/link-bank-account'?>";
<?php
}
?>
$(document).ready(function() {
    $("#form_package").on('click','#btn_price', function(){
		if(!confirm("Are you sure to buy the package?")){
			return;
		}
		
        var url = $("#form_package").attr('action');
        var package_id = $(this).val();
        $.ajax({
            url: url,
            type: "POST",
            data: {id_package: package_id},
            
            success: function(data){
                var obj = getJSONData(data);
                if(obj != false){
                    if(obj.status == 1){
                        // $("#promotion_content").html(obj.html);
                        // $("#btn_show_more_promotion").show();
                        // $("#select_promotion").attr('data-current-page', obj.current_page);
						alert('Buy package successfully');
						location.reload();
                    } else {
						alert('Buy package failed!');
					}
                }
            }
        });
    });
});
</script>