(function($){$(function(){

$('#gallery').gallery({
count: 1,
title: false,
color: 'light',
scroll: 'auto',
lightbox: false
})

var smax=screen.width;
var bmax=1440;
$('body').css('height',screen.height-100);

$('body').mousemove(function(event){
var e=event;
var x=(-e.screenX/bmax*(bmax-smax))+"px";
var y=(-e.screenY/10)+"px";
$('body').css("background-position-x",x);
$('body').css("background-position-y",y);
});

})})(jQuery)