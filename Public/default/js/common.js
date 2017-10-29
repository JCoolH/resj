$(window).scroll(function(){
	if($(window).scrollTop()>=110){
		$('.nav_bar').css({'position':'fixed','top':0,'width':'100%','z-index':100})
	}else{
		$('.nav_bar').css({'position':'static'})
	}
})
addHeight($('#core'));
$(window).resize(function(){
	addHeight($('#core'));
})
function addHeight(obj){
	var windowH = $(window).height();
	obj.css({'min-height':windowH});
}
function addMask(obj1,obj2){
	var caseH = obj1.outerHeight();
	obj2.outerHeight(caseH);
	obj1.hover(function(){
		var index = $(this).index();
		obj2.eq(index).fadeIn();
	},function(){
		var index = $(this).index();
	    obj2.eq(index).fadeOut();
	})
}
function removeMask(obj1,obj2){
	var caseH = obj1.outerHeight();
	obj2.outerHeight(caseH);
	obj1.hover(function(){
		var index = $(this).index();
	    obj2.eq(index).fadeOut();
	},function(){
		var index = $(this).index();
		obj2.eq(index).fadeIn();
	})
}
function setTop(obj1,obj2){
	obj1.on('mouseenter',function(){
		var index = $(this).index();
		var studioH = obj2.eq(index).height();
		obj2.eq(index).css('margin-top',-(studioH/2)+'px');
	})
}
function addPartHeight(obj,obj2){
	obj.outerHeight(obj2.outerHeight())
}