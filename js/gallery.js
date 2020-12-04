(function($){
//делаем картинную галерею
$.fn.gallery=function(options){
var default_options={//установки по умолчанию
	count: 5,
	title: true,
	color: 'dark',
	scroll: 'none',
	lightbox: false
	}
options=$.extend(true, default_options, options);
//добавляем нужные элементы
this.wrap('<div>');
this.parent().wrap('<div>');
var wrap=this.parent();
var gallery=this.parent().parent();
var liLen=wrap.find('li').length;
options.count = (options.count>liLen) ? liLen : options.count;
var wImg=wrap.find('img').width();

var hImg=wrap.find('img').height();
var wWrap=options.count*(wImg+27)+15;
if (options.color!='light'){
	//темная схема
	var col1='#000';
	var col2='#999';
	var col3='#eee';
}else{
	//светлая схема
	var col1='#fff';
	var col2='#555';
	var col3='#333';
}

if (options.title){
	wrap.find('ul li').each(function(){
	$(this).append('<p>')
	var txt=$(this).find('img').attr('alt');
	$(this).children('p').text(txt);
	$(this).children('p').css({
		margin:0,
		padding:0,
		textAlign:'center',
		color:col2
	});
})
}
wrap.find('img').css({margin:0, padding:0,width:"370px",height:"100%"});
gallery.css({width: wWrap+'px',
					padding: '0',
					position: 'relative',
					});
wrap.css({width: wWrap+'px',
				overflow: 'hidden',
				background: col1,
				padding:'0',
				background:'rgba(0,0,0,0)'
				});
gallery.find('ul').css({margin: 0,
					padding: 0,
					listStyle: 'none',
					width: '1200%',
					position: 'relative',
					background:'rgba(0,0,0,0)'
					});
gallery.find('ul li').css({float: 'left',
						padding: '0',
						margin: '0 0 0 0px',
						background:'rgba(0,0,0,0)'
						});

/*завершено создание элементов*/

function nextStep(){
	var ul=gallery.find('ul');
	ul.animate({
		'left': '-='+(wImg+27)+'px'
	},300, function(){
		ul.append(gallery.find('li:first').detach());
		ul.css('left',0);
		});
	return false;
}

var li_count=document.querySelectorAll('#gallery>li').length;
console.log(li_count);
if(options.scroll=='auto' && li_count>1){//автоматическое прокручивание картинок
	setInterval(function(){nextStep()},2000);
}

if(options.lightbox==true){//возможность увеличить картинки
var pic=wrap.find('ul>li>a');
pic.each(function(){
$(this).click(function(){
	$('body').append('<div>');
	var bg=$('body>div:last');
	bg.append('<div>');
	var divImg=bg.find('div');
	divImg.append('<img>');
	img=divImg.find('img');
	divImg.append('<div>');
	close=divImg.find('div');
	close.text('close');
	img.attr('src',$(this).attr('href'));
	bg.css({
		width: '100%',
		height: '100%',
		position: 'fixed',
		top:0,
		left: 0,
		background: col1
	});
	var imgTop='-'+(hImg/2)+'px';
	var imgLeft='-'+(wImg/2)+'px';

	divImg.css({
		padding: 0,
		position: 'absolute',
		top: '50%',
		left: '50%',
		marginTop: imgTop,
		marginLeft: imgLeft
	});

	close.css({
		display: 'block',
		width: '40px',
		height: '20px',
		background: '#fff',
		color: '#000',
		fontSize: '16px',
		fontWeight: '900',
		position: 'absolute',
		top: '100%',
		left: '50%',
		cursor: 'pointer',
		textAlign: 'center',
		marginLeft: '-20px'
	});

	close.click(function(){
		bg.remove();
	
	})

	return false;
})});
}


return this;
}
})(jQuery)