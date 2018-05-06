<div id="notification">
	<div class="container">
		<p>Setting</p>
		<div class="border-setting">
			<div id="row-email" class="row">
				<div class="col-xs-12">
					<!-- email-->
					<div id="title-email" class="row">
						<div class="col-lg-8 col-sm-7 col-xs-12">
							<i class="icon-email"></i>Email
						</div>
						<!-- button-->
						<div class="col-lg-4 col-sm-5 col-xs-12">
							<div class="switch-button">
								<button type="button"  class="off">OFF</button>
								<button type="button"  class="active on">ON</button>
								<i class="fa fa-question-circle" aria-hidden="true"></i>
							</div>
						</div>
					</div>
					<!-- item 1-->
					<div class="row">
						<div class="col-lg-8 col-sm-7 col-xs-12">
							New Booking Request or Booking Unrequest
						</div>
						<!-- button-->
						<div class="col-lg-4 col-sm-5 col-xs-12">
							<div class="switch-button">
								<button type="button"  class="off">OFF</button>
								<button type="button"  class="active on">ON</button>
								<i class="fa fa-question-circle" aria-hidden="true"></i>
							</div>
						</div>
					</div>
					<!-- item 1-->
					<div class="row">
						<div class=" col-lg-8 col-sm-7 col-xs-12">
							When user replies my message
						</div>
						<!-- button-->
						<div class="col-lg-4 col-sm-5 col-xs-12">
							<div class="switch-button">
								<button type="button"  class=" off">OFF</button>
								<button type="button"  class="active on">ON</button>
								<i class="fa fa-question-circle" aria-hidden="true"></i>
							</div>
						</div>
					</div>
					<!-- item 1-->
					<div class="row">
						<div class="col-lg-8 col-sm-7 col-xs-12">
							When user writes a review on my service
						</div>
						<!-- button-->
						<div class="col-lg-4 col-sm-5 col-xs-12">
							<div class="switch-button">
								<button type="button"  class="active off">OFF</button>
								<button type="button"  class="on">ON</button>
								<i class="fa fa-question-circle" aria-hidden="true"></i>
							</div>
						</div>
					</div>
					<!-- item 1-->
					<div class="row">
						<div class=" col-lg-8 col-sm-7 col-xs-12">
							When user commented on portfolio
						</div>
						<!-- button-->
						<div class=" col-lg-4 col-sm-5 col-xs-12">
							<div class="switch-button">
								<button type="button"  class="active off">OFF</button>
								<button type="button"  class="on">ON</button>
								<i class="fa fa-question-circle" aria-hidden="true"></i>
							</div>
						</div>
					</div>
				</div>
			</div><!-- row 1-->
			<div id="row-nofication" class="row">
				<div class="col-xs-12">
					<!--item-->
					<div id="title-nofication" class="row">
						<div class="col-lg-8 col-sm-7 col-xs-12">
							<i class="icon-nofication"></i>Push Nofication
						</div>
						<!-- button-->
						<div class=" col-lg-4 col-sm-5 col-xs-12">
							<div class="switch-button">
								<button type="button"  class="active off">OFF</button>
								<button type="button"  class="on">ON</button>
								<i class="fa fa-question-circle" aria-hidden="true"></i>
							</div>
						</div>
					</div>
					<!-- item-->
					<div class="row">
						<div class="col-lg-8 col-sm-7 col-xs-12">
							New Booking Request or Booking Unrequest
						</div>
						<!-- button-->
						<div class="col-lg-4 col-sm-5 col-xs-12">
							<div class="switch-button">
								<button type="button"  class="active off">OFF</button>
								<button type="button"  class="on">ON</button>
								<i class="fa fa-question-circle" aria-hidden="true"></i>
							</div>
						</div>
					</div>
					<!--item-->
					<div class="row">
						<div class="col-lg-8 col-sm-7 col-xs-12">
							When user replies my message
						</div>
						<!-- button-->
						<div class="col-lg-4 col-sm-5 col-xs-12">
							<div class="switch-button">
								<button type="button"  class="active off">OFF</button>
								<button type="button"  class="on">ON</button>
								<i class="fa fa-question-circle" aria-hidden="true"></i>
							</div>
						</div>
					</div>
					<!-- item -->
					<div class="row">
						<div class="col-lg-8 col-sm-7 col-xs-12">
							When user writes a review on my service
						</div>
						<!-- button-->
						<div class="col-lg-4 col-sm-5 col-xs-12">
							<div class="switch-button">
								<button type="button"  class="active off">OFF</button>
								<button type="button"  class="on">ON</button>
								<i class="fa fa-question-circle" aria-hidden="true"></i>
							</div>
						</div>
					</div>
					<!-- item-->
					<div class="row">
						<div class="col-lg-8 col-sm-7 col-xs-12">
							When user commented on portfolio
						</div>
						<!-- button-->
						<div class="col-lg-4 col-sm-5 col-xs-12">
							<div class="switch-button">
								<button type="button"  class=" off">OFF</button>
								<button type="button"  class="active on">ON</button>
								<i class="fa fa-question-circle" aria-hidden="true"></i>
							</div>
						</div>
					</div>
				</div>
			</div><!-- row 2-->
		</div><!--border-->
	</div><!--container-->
</div>
<script type="text/javascript">
	$('.switch-button button').click(function(){
		$(this).addClass('active');
		var item_button = $(this).prev();
		var item_next = $(this).next();
		if(item_button){
			$(item_button).removeClass('active');
			//nếu 1 cái dưới click on thì trên tiêu đề on
			if($(this).parents("#row-email").size()>0 && $(this).parents("#title-email").size()==0)
			{
				$("#title-email .on").addClass("active");
				$("#title-email .off").removeClass("active");
			}
			if($(this).parents("#row-nofication").size()>0 && $(this).parents("#title-nofication").size()==0)
			{
				$("#title-nofication .on").addClass("active");
				$("#title-nofication .off").removeClass("active");
			}
		}
		if(item_next){
			$(item_next).removeClass('active');
		}
		
		// nếu dưới off hết thì trên cùng off
		if($("#row-email  .active.off").length>=4)
		{
			$("#title-email .off").addClass("active");
			$("#title-email .on").removeClass("active");
		}
		if($("#row-nofication  .active.off").length>=4)
		{
			$("#title-nofication .off").addClass("active");
			$("#title-nofication .on").removeClass("active");
		}
		// nếu tiêu đề nhấn on thì on hết và ngược lại
		if($(this).parents("#title-email").size()>0)
		{
			if(item_button.size()!=1)
			{
				$("#row-email .off").addClass("active");
				$("#row-email .on").removeClass("active");
			}
			else
			{
				$("#row-email .on").addClass("active");
				$("#row-email .off").removeClass("active");
			}
			
		}
		if($(this).parents("#title-nofication").size()>0)
		{
			if(item_button.size()!=1)
			{
				$("#row-nofication .off").addClass("active");
				$("#row-nofication .on").removeClass("active");
			}
			else
			{
				$("#row-nofication .on").addClass("active");
				$("#row-nofication .off").removeClass("active");
			}
			
		}
	});

</script>