addHeight($('#furContainer'));
addPartHeight($('.fur_mask'),$('#furContainer .swiper-slide a'));
setTop($('#furContainer .swiper-slide a'),$('.fur_mask_txt'));
var mySwiper = new Swiper('.swiper-container', {
	//autoplay: 5000,//可选选项，自动滑动
	pagination : '.swiper-pagination',
	paginationClickable :true,
})
$(window).resize(function(){
	addHeight($('#furContainer'));
	addPartHeight($('.fur_mask'),$('#furContainer .swiper-slide a'));
	setTop($('#furContainer .swiper-slide a'),$('.fur_mask_txt'));
})
