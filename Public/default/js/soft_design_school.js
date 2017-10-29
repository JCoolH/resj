setMarginT();
$(window).resize(function(){
	setMarginT();
})
function setMarginT(){
	var learnMoreBoxH = $('.soft-text-box').outerHeight();
	var picH = $('.soft-pic').height();
	var marginT = (learnMoreBoxH-picH)/2+'px';
	$('.soft-pic').css('marginTop',marginT);
}