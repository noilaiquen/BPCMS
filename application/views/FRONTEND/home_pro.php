<!DOCTYPE html>
<html>
<head>
	<title><?=$title?></title>
	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="habfit">
	<meta name="keywords" content="habfit">
	
	<link rel="stylesheet" type="text/css" href="<?=get_resource_url('assets/bootstrap/css/bootstrap.min.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=get_resource_url('assets/css/styles.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=get_resource_url('assets/css/smart-phone.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=get_resource_url('assets/css/jquery.fancybox.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=get_resource_url('assets/css/admin/font-awesome.min.css')?>">
	
	

	<script src="<?=get_resource_url('assets/js/jquery-1.11.3.min.js')?>" type="text/javascript"></script>
	<script src="<?=get_resource_url('assets/js/jquery.fancybox.js')?>" type="text/javascript"></script>
	<script src="<?=get_resource_url('assets/js/js_slider_md.js')?>" type="text/javascript"></script>
	<script src="<?=get_resource_url('assets/js/js_page.js')?>" type="text/javascript"></script>
	
	<script src="<?=get_resource_url('assets/js/jquery.mousewheel-3.0.6.pack.js')?>" type="text/javascript"></script>

	<!-- PLESE DON'T REMOVE/COMMENT - BEGIN -->
	<script src="<?=get_resource_url('assets/js/helper.js')?>" type="text/javascript"></script>
	<!-- PLESE DON'T REMOVE/COMMENT - END -->
	
	<script src="<?=get_resource_url('assets/bootstrap/js/bootstrap.min.js')?>" type="text/javascript"></script>
	<!-- jQuery validate -->
	<script type="text/javascript" src="<?=get_resource_url('assets/js/jquery.validate.min.js')?>"></script>
	<!-- jQuery numeric -->
	<script type="text/javascript" src="<?=get_resource_url('assets/js/jquery.numeric.min.js')?>"></script>
	
</head>
<body>
	<main>
		<?=$content?>
	</main>
	



	<!-- footer page -->
	<footer class="ft-page col-full-page">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<p>Copyright &copy; 2016 <span style="color:#ff00ff;opacity:.9;padding-left:7px;"> Rei Wu </span></p>
				</div>
				
				<div class="col-md-8">
					 <ul class="ft-img">
					 	 <li><a href="https://www.facebook.com/habfitdotcom">
                        	<i class="fa fa-facebook-square" aria-hidden="true"></i>
                        </a></li>
                        <li><a href="https://www.instagram.com/habfitdotcom">
                        	<i class="fa fa-instagram" aria-hidden="true"></i>
                        </a></li> 
						<li><a href="https://www.pinterest.com/habfitdotcom">
							<i class="fa fa-pinterest-square" aria-hidden="true"></i>
						</a></li>
                        <!-- <li><a href="https://www.instagram.com/habfitdotcom"></a></li> -->
					</ul>  
					<ul class="footer-info">
						<li>Call or WhatsApp us</li>
						<li>Mon - Fri: 10am-11pm</li>
						<li><img src="assets/images/home/whatsapp-256.ico" alt="" /> <span class="ft-numberphone">+65 90696423</span></li>
					</ul>
				</div>
			</div>
		</div>
	</footer>
	<!-- end footer page -->
	
	<!-- call js page -->
	<!-- <script src="<?=get_resource_url('assets/js/helper.js')?>" type="text/javascript"></script> -->
</body>
</html>