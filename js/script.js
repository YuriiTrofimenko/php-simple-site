(function($){$(function(){

//$('footer').top=400;
var h=screen.height-$('body').height();
if (h>10){
	h-=115;
	$('footer').css("margin-top",h+"px");
}

$('#adduser').click(function(){

  if ($('#pass1').val()==$('#pass2').val()){
      return true;
    }
    else{
      $('form').after("<h4 class='text-danger'>пароли не совпадают</h4>");
      return false;
    }
})

var smax=screen.width;
var bmax=1920;

$('body').mousemove(function(event){
var e=event;
var x=(-e.screenX/bmax*(bmax-smax))+"px";
var y=(-e.screenY/10)+"px";
$('body').css("background-position-x",x);
$('body').css("background-position-y",y);
});

})})(jQuery)