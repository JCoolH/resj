addHeight($('#serContainer'));
$(window).resize(function(){
	addHeight($('#serContainer'));
})
addMask($('#serviceBox > li'),$('.service_mask'));
$(window).resize(function(){
	addMask($('#serviceBox > li'),$('.service_mask'));
})