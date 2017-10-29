$(function(){
	var mySwiper = new Swiper('.swiper-container', {
		autoplay: 5000,//可选选项，自动滑动
		prevButton:'.swiper-button-prev',
		nextButton:'.swiper-button-next',
		autoplayDisableOnInteraction : false,
	})
	addNavH();
	$(window).resize(function(){
		addNavH();
	})
	function addNavH () {
		var navH = $('.swiper-container').outerHeight();
		$('.nav-index-box').outerHeight(navH);
	}
	$(".listnav_nav").each(function(){
		$(this).hover(function(){
			$(this).children(".sub-nav").show();
			var thisW = $(this).width();
			for(var i=0;i<$(this).children(".sub-nav").length;i++){
				$(this).children(".sub-nav").eq(0).stop().animate({
					left:-thisW+'px',
					opacity:0.8
				},1000);
				$(this).children(".sub-nav").eq(i+1).stop().animate({
					left:thisW*(i+1)+'px',
					opacity:0.8
				},1000);
			}
		},function(){
			$(this).children(".sub-nav").stop().animate({
				left:0,
				opacity:0
			},1000);
		});
	});
});