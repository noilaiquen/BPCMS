<?php if(!empty($data_header)){
	foreach($data_header as $key => $item) {
?>
<section class="col-full-page max-width-1170">
    <header class="logo-sigup home-popu">
		<div class="header_background_pc" style="background:url('<?=PATH_URL.DIR_UPLOAD_NEWS.$item->image?>') no-repeat; background-size: cover;"></div>
		<div class="header_background_phone" style="background:url('<?=PATH_URL.DIR_UPLOAD_NEWS.$item->image2?>') no-repeat; background-size: cover;"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-6">
                    <a href="" class="logo"></a>
                </div>
                <div class="col-md-8 col-sm-6 col-xs-6">
                    <ul id="login-logout">
                        <li  style="display: none;"><a href="#log-in" class="sing-up fancybox">Sign up</a></li>
                        <li><a href="#log-in" class="log-in fancybox-out">Log in</a></li>
                    </ul>
                </div>
            </div>
            
             <div class="row slogan-home">
                <div class="col-md-12">
                    <h2><?=$item->title?></h2>
                    <h3><?=$item->description?></h3>
                    <p class="get-star"><a href="#log-in" class="fancybox-out">You’re now in control</a></p>
                    <p class="lear-more">learn more</p>
                    <a href="#" class="icon-dow"></a>
                </div>
            </div>
            
        </div><!-- end container -->
    </header><!-- end header -->

    <!-- rice service -->
        <div class="rice-service col-full-page">
            <div class="container">
				<div class="row">
					<div class="col-md-12 blk-fix-head-extend">
						 <p class="get-star"><a href="#log-in" class="fancybox-out">You’re now in control</a></p>
						<p class="lear-more">learn more</p>
						<a href="#" class="icon-dow"></a>
					</div>
				</div>
                <div class="row">
                    <div class="col-md-12">
                        <h3><?=$item->content?></h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- end rice service -->
<?php } } ?>


    <!-- video -->
<?php if(!empty($data_video)){ 
	foreach($data_video as $key => $item) {
?>
    <div id="home-videos" class="col-full-page home-video max-width-1170" style="background:url('<?=PATH_URL.DIR_UPLOAD_NEWS.$item->image?>') no-repeat; background-size: cover">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <h2><?=$item->title?></h2>
                </div>
                <div class="col-md-6"></div>
            </div>
            <div class="row">
                <div class="col-md-12 tag-video col-sm-12" id="comment-holder" style="margin-left:auto;margin-right:auto;text-align:center;">
                    <!-- <img src="<?=get_resource_url('assets/images/home/video.png')?>" alt="" /> -->
					<?=$item->link?>
                </div>
            </div>
        </div>
    </div>
    <!-- video -->
<?php } } ?>
    <!-- work it -->
<?php 
if(!empty($data_phone)){
	$data_phone_first = $data_phone[0];
	$data_phone_end = end($data_phone);
	
?>
    <section class="how-it-works-phone-wrapper">
		<div class="container">
			<div class="row">
				<div class="float-left-50">
					<div id="img-mobile" class="img-mobile">
						<img src="<?=get_resource_url('assets/images/home/bg_mobile.png')?>" alt="bg-mobile" />
						<figure><img src="<?=get_resource_url('assets/images/home/200w.gif')?>" alt="loadding--page" /></figure>
						<div class="img-mobile-item">
							<img src="<?=PATH_URL.DIR_UPLOAD_NEWS.$data_phone_first->image?>" alt="" />
							<?php
							for($i=1; $i<count($data_phone); $i++) {
							?>
							<img src="<?=PATH_URL.DIR_UPLOAD_NEWS.$data_phone[$i]->image?>" alt="" />
							<?php
							}
							?>
						</div>
					</div>
				</div>
				<div class="client-experience-item-booking">
					<h2><?=$data_phone_first->title?></h2>
					<?php
					if(!empty($data_phone_first->description)){
					?>
					<h3><?=$data_phone_first->description?></h3>
					<?php
					}
					?>
					<p><?=$data_phone_first->content?></p>
				</div>
			</div>
		</div><!-- end container -->
	</section>
		
	<section class="section-client-experience">
		<div class="container">
			<?php
			for($i=1; $i < count($data_phone)-1; $i++){
			?>
			<div class="row item-content-mb-slider">
			<div class="float-left-50"></div>
				<div class="client-experience-item-booking">
					<h2><?=$data_phone[$i]->title?></h2>
					<p>
					<?=$data_phone[$i]->content?>
					</p>
				</div>
			</div><!-- end row -->
			<?php
			}
			?>
	  
			<div class="row item-content-mb-slider">
				<div class="float-left-50">
					<div class="img-mobile item-last-mb">
						<img src="<?=get_resource_url('assets/images/home/bg_mobile.png')?>" alt="bg-mobile" />
						<div class="img-mobile-item">
							<img src="<?=PATH_URL.DIR_UPLOAD_NEWS.$data_phone_end->image?>" alt="dashboard">		
						</div>
					</div>
				</div>
				<div class="client-experience-item-booking">
					<h2><?=$data_phone_end->title?></h2>
					<p>
					<?=$data_phone_end->content?>
					</p>
				</div>
			</div><!-- end row -->
		</div><!-- end container -->
	</section>
    <!-- end work it -->
	<div class="clearAll"></div>
		
	<!-- Slider for Mobile -->
	<section class="sli-for-mobile">
		<?php
		for($i=0; $i < count($data_phone); $i++){
		?>
		<div class="item-sli-mb--">
			<h3 class="title--sli--mb"><?=$data_phone[$i]->title?></h3>
			<h4 class="title--sli-next">
			<?=$data_phone[$i]->content?>
			</h4>	
			<img class="img-sli-mb--" src="<?=PATH_URL.DIR_UPLOAD_NEWS.$data_phone[$i]->image2?>" alt="slider-mobile" />
		</div>
		<?php
		}
		?>
	</section>
<?php
}
?>	
    
	<div class="clearAll"></div>
    <!-- download -->
    <div class="download-home col-full-page max-width-1170">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Start scheduling with MYHABFIT today !</h2>
                    <p class="get-star-two"><a href="#log-in" class="fancybox-out">get started</a></p>
                    <div style="text-align: center;padding-top: 40px;padding-bottom: 48px;">
                        <a href="" class="dwl-ios"></a>
                        <a href="" class="dwl-win"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end download -->
    
    <!-- about -->
    <div class="container about-home">
        <div class="row">
			<?php 
			if(!empty($data_about)){ 
				foreach($data_about as $key => $item){
			?>
            <div class="col-md-6">
                <h2><?=$item->title?></h2>
                <h3>
                    <?=$item->content?>                  
                </h3>
                <a href="<?=base_url('/about')?>" style="color:#d511be;font-size:18px;font-family:'Gotham-medium';">Learn More</a>
            </div>
			<?php
				}
			}
			?>
            <div class="col-md-1"></div>
            
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-6 center-tablet"><!-- opacity-05 -->
                        <h2>MEDIA </h2>
                        <ul class="home-media" style="color:#7f7f7f;">
                            <li>Beauty Blog</li>
                            <li>Press</li>
                           <!-- <li>Stories</li> -->
                            <li><a class="link-video" href="#home-videos" title="Video">Videos</a></li>
                        </ul>
                         <ul class="list-service blk-show-991">
                            <!--   <li>FIND PROFESSIONAL</li> -->
                            <li><a href="#log-in" class="fancybox-out get-listed" title="Get listed">GET LISTED</a></li>
                            <li><a href="<?php echo base_url('team') ?>" title="Team">TEAM</a></li>
                            <li><a href="" title="Careers">CAREERS</a></li>
                            <li><a href="<?php echo base_url('t-and-c') ?>" title="Terms">TERMS</a></li>
                            <li><a href="<?php echo base_url('privacy-policy') ?>" title="Privacy">PRIVACY</a></li>
                             <!-- <li>SITEMAP</li>  -->
                        </ul>
						<div class="clearAll"></div>
                        <p style="font-size:24px;padding-top:29px;color:#8b6ce4;font-family:'Roboto-Medium';">TALK TO US</p>
                        <p style="font-size:19px;padding-top:5px;">Natasalon@gmail.com</p>
                    </div>
                    <div class="col-md-6 center-tablet blk-hide-991">
                        <ul class="list-service">
                           <!-- <li>FIND PROFESSIONAL</li> -->
                            <li><a href="#log-in" class="fancybox-out get-listed" title="Get listed">GET LISTED</a></li>
                            <li><a href="<?php echo base_url('team') ?>" title="Team">TEAM</a></li>
                            <li><a href="" title="Careers">CAREERS</a></li>
                            <li><a href="<?php echo base_url('t-and-c') ?>" title="Terms">TERMS</a></li>
                            <li><a href="<?php echo base_url('privacy-policy') ?>" title="Privacy">PRIVACY</a></li>
                            <!-- <li>SITEMAP</li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end about -->
    
    
    <!-- popup  -->
	<div  id="log-in" class="popup-home">
		 <ul>
			  <li ><p>Log In</p></li>
			  <li class=""><p>Sign Up</p></li>
		 </ul>
		 
		<form id="login_frm" class="form-horizontal form-sign-up" autocomplete="off" data-action="<?=$login_url?>">
		  <div class="form-group">
			  <input id="email" type="email" class="form-control ctm" name="input_email" placeholder="Email">
		  </div>
		  <div class="form-group">
			  <input type="password" class="form-control ctm" name="input_password" placeholder="Password">
		  </div>
		  <div class="form-group">
		 
			  <button type="submit" class="btn btn-default" style="width:100%">Log in</button>
		  </div>
		  <span class="msg"></span>
		  <a href="#for-got" class="bnt-forgot-pass">Forgot Pasword?</a>
		</form>
		<!-- end form sign-in -->
		
		<!-- fomr log-out -->
		<form id="signup_frm" class="form-horizontal form-log-out" autocomplete="off" data-action="<?=$signup_url?>">
		<!-- //remove when release -->
		  <div class="form-group">
			  <input type="text" class="form-control ctm" name="input_firstname" placeholder="Firstname">
		  </div>
		  <div class="form-group">
			  <input type="text" class="form-control ctm" name="input_lastname" placeholder="Lastname">
		  </div>
		  <div class="form-group">
			  <input type="text" class="form-control ctm" name="input_username" placeholder="Username">
		  </div>
		  <div class="form-group">
			  <input type="email" class="form-control ctm" name="input_email" placeholder="Email">
		  </div>
		  <div class="form-group">
			  <input type="password" class="form-control ctm" name="input_password" placeholder="Password">
		  </div>
		  <div class="form-group">
			  <input type="text" class="form-control ctm number" name="input_mobile" placeholder="Mobile">
		  </div>
		  <div class="form-group">
			  <button type="submit" class="btn" style="width:100%" data-action="<?=$signup_url?>">Sign Up</button>
		  </div>
			<span class="msg"></span>
			<span></span>
		</form>
	</div><!-- end login -->
	
	<div id="for-got" class="popup-home blk-forgot">
		<!-- form forgot -->
		<form id="forgot_frm" class="form-horizontal" autocomplete="off" data-action="<?=$rs_pass_url?>">
			<p class="title-forgot">Forgot Password</p>
			<label>Please enter your Email address</label>
		  <div class="form-group">
			  <input type="email" class="form-control ctm" name="input_email" placeholder="Email Address..">
		  </div>
		   <div class="form-group" style="margin-bottom:10px;">
			  <button type="submit" class="btn" style="width:100%" data-action="<?=$rs_pass_url?>">Send</button>
		  </div>
		  <div class="form-group">
			  <button type="reset" class="btn" style="width:100%">Cancel</button>
		  </div>
		  <span class="msg"></span>
		</form>
		<!-- end form forgot -->
	</div>
    <!-- end popup -->

</section>

<script type="text/javascript">
$('#comment-holder').html(function(i, html) {
	var re  = /(?:https:\/\/)?(?:www\.)?(?:youtube\.com|youtu\.be)\/(?:watch\?v=)?(.+)/g,
	vid = '<iframe width="100%" height="318" src="https://www.youtube.com/embed/$1" frameborder="0" allowfullscreen></iframe>';
	return html.replace(re, vid);
});

   $('.link-video').click(function(){
	  $('html, body').stop().animate({
	   scrollTop: $('#home-videos').offset().top
	   }, 500); 
   });
</script>