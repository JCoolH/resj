//轮播图鼠标移入／移出 - 停止／开始效果
$('#carousel-example-generic').on({
	mouseenter: function(){
		$("#carousel-example-generic").carousel('pause');
	},
	mouseleave :function(){
		$("#carousel-example-generic").carousel('cycle');
	}
})
//页面内容动效
new WOW().init();
//加数字动态
var options = {
  useEasing : true, 
  useGrouping : true, 
  separator : ',', 
  decimal : '.', 
  prefix : '', 
  suffix : '' 
};
var num1 = new CountUp("totalNum_1", 0, 999, 0, 2.5, options);
var num2 = new CountUp("totalNum_2", 0, 999, 0, 2.5, options);
$(window).scroll(function(){
	if($(window).scrollTop()>=180){
		num1.start();
	}
})
var numH2 = 500+$('.case-photos').outerHeight(true)+84+328;
$(window).scroll(function(){
	if($(window).scrollTop()>=numH2){
		num2.start();
	}
})
//添加蒙版
addMask($('.case-photos li'),$('.case-mask'));
addMask($('.decorations-show'),$('.decoration-mask'));
removeMask($('.design-details'),$('.design-details-mask'));
setTop($('.design-details'),$('.det-text'));
setTop($('.case-photos > li'),$('.mask-text'));
$(window).resize(function(){
	addMask($('.case-photos li'),$('.case-mask'));
	addMask($('.decorations-show'),$('.decoration-mask'));
	removeMask($('.design-details'),$('.design-details-mask'));
})
$('.design-details').hover(function(){
	var index = $(this).index();
	$('.det-text').eq(index).fadeIn();
},function(){
	var index = $(this).index();
	$('.det-text').eq(index).fadeOut();
})

