<!DOCTYPE html>
<html>
<head>
    <title><?=$title?></title>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="habfit">
    <meta name="keywords" content="habfit">
    
    <link rel="stylesheet" type="text/css" href="<?=get_resource_url('assets/bootstrap/css/bootstrap.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=get_resource_url('assets/css/styles_admin_pro.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=get_resource_url('assets/css/admin/font-awesome.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=get_resource_url('assets/css/smart_admin_pro.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=get_resource_url('assets/css/animate.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=get_resource_url('assets/css/jquery-ui.css')?>"> 
    <link rel="stylesheet" type="text/css" href="<?=get_resource_url('assets/css/DateTimePicker.css')?>"> 
    <link rel="stylesheet" type="text/css" href="<?=get_resource_url('assets/css/user.css')?>"> 
    <link rel="stylesheet" type="text/css" href="<?=get_resource_url('assets/css/jquery.fancybox.css')?>">
   
    
	<script type="text/javascript">
	/*BEGIN: DEBUG*/
	function pr(message){
		if(console && console.log){
			console.log(message);
		}
	}
	/*END: DEBUG*/
	
	var root = '<?=PATH_URL?>';
	</script>

    <script src="<?=get_resource_url('assets/js/jquery-1.11.3.min.js')?>" type="text/javascript"></script>
    <script src="<?=get_resource_url('assets/js/jquery.mousewheel-3.0.6.pack.js')?>" type="text/javascript"></script>
    <script src="<?=get_resource_url('assets/js/jquery.fancybox.js')?>" type="text/javascript"></script>
    <script src="<?=get_resource_url('assets/js/jquery-ui.js')?>" type="text/javascript"></script>
    <script type="text/javascript" src="<?=get_resource_url('assets/js/jquery.validate.min.js')?>"></script>
    <script src="<?=get_resource_url('assets/js/jquery.numeric.min.js')?>" type="text/javascript"></script>
    <script src="<?=get_resource_url('assets/js/DateTimePicker.js')?>" type="text/javascript"></script>
    <script src="<?=get_resource_url('assets/js/bootstrap.min.js')?>"></script>
    <script src="<?=get_resource_url('assets/js/home_user.js')?>"></script>

	<link rel="stylesheet" type="text/css" href="<?=get_resource_url('assets/css/croppic.css')?>">
	<script src="<?=get_resource_url('assets/js/croppic.js')?>"></script>
	<!-- html to canvas -->
	<script type="text/javascript" src="<?=get_resource_url('assets/js/html2canvas.js')?>"></script>
</head>
<body>
<?php /*get avatar url*/
$avatar_url = get_resource_url('assets/images/user/no_avatar.png');
if ( ! empty($this->session->userdata('avatar')))
    $avatar_url = $this->session->userdata('avatar');
?>

<?php
    $menus = array(
        array('href' => base_url('/dashboard/daily'), 'name' => 'Dashboard',
                'child' => array(
                    array('href' => base_url('/dashboard/daily'), 'name' => 'Daily'),
                    array('href' => base_url('/dashboard/scheduler'), 'name' => 'Scheduler'),
                    array('href' => base_url('/dashboard/client'), 'name' => 'Clients'),
                    array('href' => base_url('/dashboard/salesoverview'), 'name' => 'Sales Overview')
                    )
                ),
        array('href' => base_url('/account'), 'name' => 'My Account Info', 'child' => NULL),
        array('href' => base_url('/services'), 'name' => 'Manage Services',
                'child' => array(
                    array('href' => base_url('/services/mainservices'), 'name' => 'Main Services Menu'),
                    array('href' => base_url('/services/promotion'), 'name' => 'Promotion'),
                    array('href' => base_url('/services/availability'), 'name' => 'Availability')
                    )
                ),
        array('href' => base_url('/library'), 'name' => 'Photo Library',
                'child' => array(
                    array('href' => base_url('/library/myportfolio'), 'name' => 'My Portfolio'),
                    array('href' => base_url('/library/album'), 'name' => 'Albums'),
                    array('href' => base_url('/library/promotion'), 'name' => 'Promotion')
                    )
                ),
        array('href' => base_url('/grow-your-clientele'), 'name' => 'Grow Your Clientele', 'child' => NULL),
        array('href' => base_url('/t-and-c'), 'name' => 'Terms and Policies',
                'child' => array(
                    array('href' => base_url('/faqs'), 'name' => 'FAQs'),
                    array('href' => base_url('/customer-support'), 'name' => 'Customer Support'),
                    array('href' => base_url('/t-and-c'), 'name' => 'T&C'),
                    array('href' => base_url('/privacy-policy'), 'name' => 'Privacy Policy'),
                    array('href' => base_url('/service-guidelines'), 'name' => 'Service Guidelines'),
                    )
                ),
        array('href' => base_url('/payment/link-bank-account'), 'name' => 'Payment', 
              'child' => array(
                    array('href' => base_url('/payment/link-bank-account'), 'name' => 'Payment'),
                    array('href' => base_url('/payment/payment-more-services'), 'name' => 'GET BOOSTED'),
                    )
                ),
        );
?>
    <!-- ĐÂY LÀ TEMPLATE DÀNH CHO PRO SAU KHI LOGIN THÀNH CÔNG -->
    <!-- header page -->
        <header class="header-page">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-xs-6 logo-explore">
                        <ul>
                            <li><img src="<?=get_resource_url('assets/images/Photo_library/logo.png')?>" alt="logo-page" /></li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-xs-6 avata-help">
                        <ul>
                            <li class="avarta">
                                <img id="top_menu_avatar" src="<?=$avatar_url?>" alt="avarta" />
								 <!--setting-->
								<div class="setting-admin-pro">
									<div class="inbox"><a href="<?=base_url('/chatservice')?>"><i></i>Inbox</a></div>
									<div class="tutorial"><a href="<?=base_url('/tutorial')?>"><i></i>Tutorial</a></div>
									<div class="setting"><a href="<?=base_url('/setting')?>"><i></i>Setting</a></div>
									<div class="signout"><a href="<?=base_url('/logout')?>"><i></i>Sign Out</a></div>
								</div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- menu top -->
		 <div class="menu-top col-full-page menu-header">
			<div class="container">
				<div id="menu-lmt">
					<div class="icon-responsive"><i class="fa fa-bars" aria-hidden="true"></i></div>
					<ul class="main-menu-lmt ">
					<?php foreach ($menus as $key => $menu) {
                        if($menu['child'] != NULL)
                        {
                            echo "<li class='has-child'><a data-url={$menu['href']} href='{$menu['href']}'>{$menu['name']} <i class='fa fa-angle-down' aria-hidden='true'></i></a>";
                        }
                        else
                        {
                            echo "<li><a href='{$menu['href']}'>{$menu['name']}</a>";
                        }
                        if($menu['child'] != NULL) {
                            echo "<ul class='sub-menu-lmt'>";
                            foreach ($menu['child'] as $key => $submenu) {
                                echo "<li><a href='{$submenu['href']}'>{$submenu['name']}</a></li>";
                            }
                            echo "</ul>";
                        }
                        echo "</li>";
                    } ?>
					</ul>
				</div>
			</div>
			<div class="wrap-menu"></div>
		</div>
            <!-- end menu top -->
        </header>
                <span class="nav-bg"></span>
                <!-- <span class="nav-bg-fix"></span> -->
    <!-- end header page -->
    <main>
        <?=$content?>
    </main>
    <!-- footer page -->
    <footer class="ft-page col-full-page fs">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <p>Copyright &copy; 2016 <span style="color:#ff00ff;opacity:.9;padding-left:7px;"> Rei Wu </span></p>
                </div>
                <div class="col-md-8 col-sm-8">
                    <ul class="ft-img">
                        <li><a href="https://www.pinterest.com/habfitdotcom"></a></li>
                        <li><a href="https://www.facebook.com/habfitdotcom"></a></li>
                        <!-- <li><a href="https://twitter.com/habfitdotcom"></a></li> -->
                        <li><a href="https://www.instagram.com/habfitdotcom"></a></li>
                    </ul>
					<ul class="footer-info">
						<li>Call or WhatsApp us</li>
						<li>Mon - Fri: 10am-11pm</li>
						<li><img src="<?=get_resource_url('assets/images/home/whatsapp-256.ico')?>" alt="image" /> <span class="ft-numberphone">+65 90696423</span></li>
					</ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- end footer page -->
    <!-- window chat -->
	<!-- <div class="chat-box" style="display: block;">
		<div id="title_msg" class="header-box">
			<?=$this->session->userdata('username')?>
			<div class="close-chatbox"></div>
		</div>
		<div class="chat-log"></div>
		<div class="input-chat-text">
		<form class="form-inline" role="form" method="POST" action="" onsubmit="return submit_handler(this)">
			<textarea id="chat_msg" placeholder="Enter the text"></textarea>
			<input type="button" onclick="sendMessage()";>
		</form>
		</div>
	</div> -->
	<!-- end chat -->
    <script>
    $(document).ready(function(){
    	changeHref();
		$("#date_datetime").datepicker();
    });

    //convert html to image
    var count_image_convert=0;
    if($("#grow .content .img").length>0){
  		html2canvas($("#grow .content .img"), {
		  onrendered: function(canvas) {
		  	var image_convert =	convertCanvasToImage(canvas);
		  		// $("body").append("<a id='download-image-myhabfit' style='display:none' href='"+$(image_convert).attr("src")+"' download='myhabfit.jpg'>download</a>");
		  		// console.log($("#grow .content .img")[0].outerHTML);
		  		$("#grow .content .img").replaceWith("<a href='"+$(image_convert).attr("src")+"' download='myhabfit.jpg'>"+$("#grow .content .img")[0].outerHTML+"</a>");
		 	}
		});
    }
    	
   $("#grow .content .img").on("click",function(){
   		
   		$("#download-image-myhabfit").click();
   })
	function convertCanvasToImage(canvas) {
		var image = new Image();
		image.src = canvas.toDataURL("image/png");
		// $("body").append(image);
		return image;
	}

        // $("ul.menu-main a").each(function(){
        //     var path = window.location.pathname;
        //     var href = $(this).attr('href');
        //     var prnt = $(this).parents('ul').hasClass('menu-main');
        //     if($(this).parents('ul').hasClass('menu-main') && path.search(href) >= 0) {
        //         $(this).parents('li').addClass('tab-curent');//tab-curent
        //     }
        //     if($(this).parents('li').hasClass('tab-curent')) {//tab-curent
        //         $(this).parents('li').find('ul').addClass('active');
        //     }
        // });
        //setting
        $("body").on("click",function(){
            $(".setting-admin-pro").slideUp();
			// if($(window).outerWidth(true) < 1200)
			// {
			// 	$('#menu-lmt .main-menu-lmt').slideUp();
			// 	$("#menu-lmt .main-menu-lmt > li ").each(function(){
			// 		$(this).removeClass("active");
			// 		$(this).children(".sub-menu-lmt").removeClass("active");
			// 		if($(this).find(".current").length ==0)
			// 		{
			// 			$(this).children(".sub-menu-lmt").slideUp("active");
			// 		}
			// 	});
			// }
        });
        $(".avata-help ul .avarta").on("click",function(event){
            if($(".setting-admin-pro").css("display")=="none")
            {
                event.stopPropagation();
                $(".setting-admin-pro").slideDown();
            }
            else
            {
                $(".setting-admin-pro").slideUp();
            }
        });
       
        $("input[class*='number']").numeric();
        
        //menu responsive
		$('#menu-lmt .icon-responsive').on("click",function(e){
			e.stopPropagation();
			if($(this).next('.main-menu-lmt').css("display")=="block")
			{
				$(this).next('.main-menu-lmt').slideUp();
			}
			else
			{
				$(this).next('.main-menu-lmt').slideDown();
			}
		});
		function changeHref() {
			if($(window).outerWidth()>=1200)
			{
				$('#menu-lmt .main-menu-lmt li.has-child > a').each(function(){
					$(this).attr('href', $(this).attr('data-url'));
				});
			}
			else
			{
				$('#menu-lmt .main-menu-lmt li.has-child > a').each(function(){
					$(this).attr('href', 'javascript:void(0)');
				});
			}
		}
       //menu
		function nagative(item){
			if($(window).outerWidth(true)>=992)
			{
				//reset
				$(item).children(".sub-menu-lmt").css({"margin-left":"0"});
				// position main 
				var position_left_main=$("#menu-lmt .main-menu-lmt").offset().left;
				var width_main=$("#menu-lmt .main-menu-lmt").width();
				var position_right_main=position_left_main+width_main;
				//position sub
				var position_left_sub=$(item).children(".sub-menu-lmt").offset().left;
				var width_sub=$(item).children(".sub-menu-lmt").width()
				var position_right_sub=position_left_sub+width_sub;
				//position top
				var position_top_main=$("#menu-lmt .main-menu-lmt").offset().top + $("#menu-lmt .main-menu-lmt").height();
				var position_top_sub=$(item).offset().top + $(item).height();
				// position left sub present
				if(position_right_sub > position_right_main)
				{
					var negative=position_right_main - position_right_sub;
					$(item).children(".sub-menu-lmt").css("margin-left",negative);
				}
				else if(position_left_sub <= position_left_main)
				{
					$(item).children(".sub-menu-lmt").css("margin-left","0");
				}
				else if(position_right_sub < position_right_main)
				{
					$(item).children(".sub-menu-lmt").css("margin-left",-(width_sub/2)+$(item).width()/2);
				}
				//position top sub present
				if(position_top_main > position_top_sub)
				{
					$(item).children(".sub-menu-lmt").css("top",position_top_main - position_top_sub + 53);
				}
				else
				{
					$(item).children(".sub-menu-lmt").css("top",53);
				}
			}
		}
		//menu begin
		$("#menu-lmt .main-menu-lmt a").each(function(){
			var url = window.location.href;
			var pattern =  new RegExp($(this).attr("href"));
			if (pattern.test(url))
			{
				if($(this).parents('li').length>=2)
				{
					$(".wrap-menu").addClass("current");
				}
				else
				{
					$(this).parents('li').addClass("no-child");
				}
				$(this).parents('li').addClass("current")
			}
		});
		$("#menu-lmt .main-menu-lmt > li").each(function(){
			if($(this).children(".sub-menu-lmt").length>="1")
			{
				nagative(this);
			}
		});
		//menu resize
		$( window ).resize(function() {
			changeHref();
			if($(window).outerWidth()>=1200)
			{
				$('#menu-lmt .main-menu-lmt').css("display","block");
			}
			else
			{
				$('#menu-lmt .main-menu-lmt').css("display","none");
			}
			$("#menu-lmt .main-menu-lmt > li").each(function(){
				$(this).removeClass("active");
				$(this).children(".sub-menu-lmt").removeClass("active");
				$(this).children(".sub-menu-lmt").removeAttr("style");
				$(".wrap-menu").addClass("active").removeClass("active");
				if($(this).children(".sub-menu-lmt").length=="1")
				{
					nagative(this);
				}
			});
		});
		//menu hover
		$("#menu-lmt .main-menu-lmt > li").hover(function(e){
			e.stopPropagation();
			if($(window).outerWidth(true) >= 1200)
			{
				if($(this).find(".current").length>="1" || $(this).find(".sub-menu-lmt").length=="0" || $(this).attr("class")=="current")
				{
					return false;
				}
				if($(".wrap-menu.current").length=="0")
				{
					$(".wrap-menu").addClass("active");
				}
				$(this).addClass("active");
				$('#menu-lmt .main-menu-lmt').find('.current').children('ul').css("display","none");
				// $(this).children(".sub-menu-lmt").addClass("active");
				nagative(this);
			}
		},
		function(e){
			e.stopPropagation();
			if($(window).outerWidth(true) >= 1200)
			{
				$(this).removeClass("active");
				$('#menu-lmt .main-menu-lmt').find('.current').children('ul').css("display","");
				// $(this).children(".sub-menu-lmt").removeClass("active");
				$(".wrap-menu").removeClass("active");
			}
		});
		//menu click
		$("#menu-lmt .main-menu-lmt > li").on("click",function(e){
			e.stopPropagation();
			if($(window).outerWidth(true) < 1200)
			{
				if($(this).find(".active").length=="1")
				{
					$(this).removeClass("active");
					$(this).children(".sub-menu-lmt").removeClass("active");
					$(this).children(".sub-menu-lmt").slideUp();
					$(".wrap-menu").removeClass("active");
				}
				else
				{
					if($(this).find(".current").length=="1" || $(this).find(".sub-menu-lmt").length=="0")
					{
						// break;
					}
					else
					{
						if($(".wrap-menu.current").length=="0")
						{
							$(".wrap-menu").addClass("active");
						}
						$("#menu-lmt .main-menu-lmt > li ").each(function(){
							$(this).removeClass("active");
							$(this).children(".sub-menu-lmt").removeClass("active");
							if($(this).find(".current").length ==0)
							{
								$(this).children(".sub-menu-lmt").slideUp("active");
							}
						});
						$(this).addClass("active");
						$(this).children(".sub-menu-lmt").addClass("active");
						$(this).children(".sub-menu-lmt").slideDown();
						nagative(this);
					}
				}
			}
		});

        // }
    </script>

    <?php if($this->session->flashdata('msg')){ ?>
    <script id='myscript' type="text/javascript">
        $(document).ready(function(){
            var data = '<?=$this->session->flashdata('msg')?>';
            obj = getJSONData(data);
            showMessageNotify(obj);
            setTimeout(function(){
                $("#myscript").remove();
            }, 3000);
        });
    </script>
    <?php } ?>
    <script src="<?=get_resource_url('assets/js/helper.js')?>" type="text/javascript"></script>
</body>
</html>