new Swiper('.swiper-container',{
	autoplay: 5000,
	pagination : '.swiper-pagination',
	paginationClickable :true,
	autoplayDisableOnInteraction : false,
})
artPartsWidth();
$(window).resize(function(){
	artPartsWidth();
})
function artPartsWidth(){
	for(var i=0;i<$('.art-spec-info').length;i++){
		var artH = $('.swiper-container').eq(i).outerHeight();
		$('.art-texts').eq(i).outerHeight(artH+'px');
	}
}
//页面内容动效
new WOW().init();

addMask($('.design-show'),$('.design-mask'));