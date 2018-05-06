<?php 
	$unique_url = 'myhabfit.com/profile/' . $personal_account_id;
?>
<div class="container">
	<div id="grow">
		<p>Grow Your Clientele</p>
		<div class="row">
			<div class="col-md-6 col-xs-12">
				<div class="title">YOUR UNIQUE LINK</div>
				<div class="content">
					<P>Add this to your Instagram bio & Facebook page </P>
					<div class="coppy"><p id="unique_link"><?=$unique_url?></p></div>
					<button id="btn_copy_unique_link" class="btn" data-clipboard-action="copy" data-clipboard-target="#unique_link">COPY</button>
					<div style="text-align:center;">
					<a class="twitter-share-button"
  						href="https://twitter.com/intent/tweet?url=https://<?=$unique_url?>" target="_blank"
  						>
					<i class="fa fa-twitter" aria-hidden="true" style="color:white;background-color:black;width:45px;height:45px;border-radius:50%;text-align:center;font-size:26px;line-height:30px;padding-top:7px; margin-top:35px;"></i>
					</a>
					<a href="https://www.facebook.com/sharer/sharer.php?u=https://<?=$unique_url?>" target="_blank">
					<i class="fa fa-facebook" aria-hidden="true" style="color:white;background-color:black;width:45px;height:45px;border-radius:50%;text-align:center;font-size:26px;line-height:30px;padding-top:7px;margin-left:15px"></i>
					</a>
					<a href="mailto:?body=https://<?=$unique_url?>&subject=Booknow" target="_blank">
					<i class="fa fa-envelope" aria-hidden="true" style="color:white;background-color:black;width:45px;height:45px;border-radius:50%;text-align:center;font-size:24px;line-height:24px;padding-top:10px;margin-left:15px"></i>
					</a>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-xs-12">
				<div class="title">POST TO INSTAGRAM</div>
				<div class="content">
					<P>Tap & hold to download and save to your Photo Library. Open Instagram and post !</P>
				<div class="img">
					<img src="<?=get_resource_url('assets/images/user/grow.jpg')?>"/>
					<div>
						<div>Great News !</div>
						<div>VIEW MORE OF MY WORK ON MYHABFIT </div>
						<div><?=$unique_url?></div>
						<div class="grow_text"> Available for Booking </div>
					</div>
					<div class="hover">CLICK TO DOWNLOAD</div>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?=get_resource_url('assets/js/clipboard.min.js')?>"></script>
<script type="text/javascript">
$(document).ready(function(){

	// showPopupDeleteConfirm($("#grow"));
	
	var clipboard = new Clipboard('.btn');

    clipboard.on('success', function(e) {
    	_this = $('#'+e.trigger.id);
    	_this.tooltip({title: 'Copied', placement: 'top',trigger: 'manual'});
		_this.tooltip('show');
    	_this.mouseleave(function(){
    		// _this.tooltip('destroy');
    	});
    	setTimeout(function(){
    		_this.tooltip('destroy');
        }, 1000);
    	e.clearSelection();
    });

    clipboard.on('error', function(e) {
        console.log(e);
    });

});
</script>