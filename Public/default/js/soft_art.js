var artW = $('.art_box > img').width();
$('.box').eq(0).css({
	marginLeft:artW+'px'
})
$('.box').eq(1).css({
	marginLeft:artW/2+'px'
})
$('.box').eq(3).css({
	marginLeft:artW+'px'
})
var containerW = $('.art_box').width()*4;
var bodyH = $('.art_box').height()*4+58+39;
$('.art_container').css({
	width:containerW+'px',
	marginLeft:-(containerW/2)+'px',
})
$('#core').css({height:bodyH+'px'});
addPartHeight($('.art_mask'),$('.art_box'));

