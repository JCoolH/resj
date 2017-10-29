//轮播图鼠标移入／移出 - 停止／开始效果
$('#carousel-example-generic').on({
	mouseenter: function(){
		$("#carousel-example-generic").carousel('pause');
	},
	mouseleave :function(){
		$("#carousel-example-generic").carousel('cycle');
	}
})
//banner图添加
$.post('http://127.0.0.1:81/index.php?g=Home&m=Abc&a=list_banner',{aid:1,limit:3},function(datas){
	console.log(JSON.parse(datas));
	var obj = JSON.parse(datas);
	if(obj.state==1){
		var pic = '',
			slider = '';
		for(var i=0;i<obj.data.length;i++){
			console.log(obj.data[i].content)
			pic += '<div class="item">'+
				      '<a href="#"><img src="'+obj.data[i].content+'"></a>'+
				    '</div>';
			slider += '<li data-target="#carousel-example-generic" data-slide-to="'+i+'"></li>';
		}
		$('.carousel-inner').html(pic);
		$('.carousel-indicators').html(slider);
		$('.carousel-inner > .item').eq(0).addClass('active');
		$('.carousel-indicators > li').eq(0).addClass('active');
	}else{
		alert(obj.msg)
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

