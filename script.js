$(document).ready(function(){
	/* This code is executed after the DOM has been completely loaded */

	/* The number of event sections / years with events */
	
	$('.eventList li').click(function(e){
			showWindow('<div>'+$(this).find('div.content').html()+'</div>');
	});
	
});

function showWindow(data)
{
	/* Each event contains a set of hidden divs that hold
	   additional information about the event: */
	   
	var title = $('.title',data).text();
	var date = $('.date',data).text();
	var body = $('.body',data).html();
	
	$('<div id="overlay">').css({
								
		width:$(document).width(),
		height:$(document).height(),
		opacity:0.6
		
	}).appendTo('body').click(function(){
		
		$(this).remove();
		$('#windowBox').remove();
		
	});
	
	$('body').append('<div id="windowBox"><div id="titleDiv">'+title+'</div>'+body+'<div id="date">'+date+'</div></div>');

	$('#windowBox').css({
		width:500,
		height:350,
		//left: (window.event.clientX - 500)/2,
		//top: (window.event.clientY - 350)/2
		left: event.clientX + document.body.scrollLeft,
		top: event.clientY + document.body.scrollTop - 175
	});
	
}