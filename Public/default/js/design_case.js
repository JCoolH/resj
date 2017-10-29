var subNavNum = $('.nav-ul > li').length;
addNavH();
$(window).resize(function(){
	addNavH();
})
function addNavH () {
	var desNavH = $(window).height()-130-30-60;
	$('.nav-ul').height(desNavH);
	$('.nav-ul > li').outerHeight(desNavH/subNavNum+'px');
	$('.nav-ul > li').css('lineHeight',desNavH/subNavNum+'px');
}