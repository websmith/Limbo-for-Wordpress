$(document).ready(function(){
	$('.widget').addClass('well');
	
	//Duplicate dropdown page in dropdown
	$('.nav li.dropdown ul.dropdown-menu').each(function() {
		var copyThis = $(this).siblings('a');
		var cloned = copyThis.clone();
		cloned.prependTo(this).wrap('<li class="menu-item menu-item-object-page"></li>');
		cloned.removeAttr('class');
		cloned.removeAttr('data-toggle');
		cloned.removeAttr('aria-haspopup');
		cloned.find(".caret").remove();
	});
});