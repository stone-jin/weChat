$(function($){
	var width=document.documentElement.clientWidth;
	var height=document.documentElement.clientHeight;
	$("body").width(width);
	$("body").height(height);

	var line_height = $(".test_block").height();
	$(".test_block_nav").css("line-height", line_height+"px");
});