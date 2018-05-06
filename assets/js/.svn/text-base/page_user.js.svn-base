$(document).ready(function(){
	
	//slide home page
	$('#home-page-user-1 .slide-home-page-user .slide').owlCarousel({
	loop:false,
	nav:false,
	dots: true,
	smartSpeed:1000,
	items:1,
	});
	
	// pre next product about page
	$('#home-page-user-1 .slide-home-page-user .pre-button').click(function(){
		$('#home-page-user-1  .owl-prev').click();
	});
	$('#home-page-user-1 .slide-home-page-user .next-button').click(function(){
		$('#home-page-user-1  .owl-next').click();
	});

	// review
	$("#review .review-rating .fa").on("mouseenter",function(e){
		$("#review .review-rating .fa.fa-star").each(function(){
			$(this).attr("class","fa fa-star-o");
		})
		for(var i=1;i< parseInt($(this).attr("data-rating"))+1;i++)
		{
			$("#review .review-rating .fa[data-rating='"+i+"']").attr("class","fa fa-star")
		}
	})
	$("#review .review-rating .fa").on("click",function(e){
		$("#review .review-rating .fa.fa-star").each(function(){
			$(this).attr("class","fa fa-star-o");
		})
		for(var i=1;i< parseInt($(this).attr("data-rating"))+1;i++)
		{
			$("#review .review-rating .fa[data-rating='"+i+"']").attr("class","fa fa-star")
		}
		$("#review-rating").val(parseInt($(this).attr("data-rating")));
		e.stopPropagation();
	})
});