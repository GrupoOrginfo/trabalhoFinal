var timer;
var controle= -250;
var width ;

var touchXi = 0;
var touchXf = 0;

conteudo = document.getElementsByClassName("conteudo");

function readDeviceOrientation() {
                 		
    if (Math.abs(window.orientation) === 90) {
        $("meta[name=viewport]").attr('content', "width=device-height, initial-scale=1, maximum-scale=1, user-scalable=no");
    } else {
    	 $("meta[name=viewport]").attr('content', "width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no");
    }
}


function resize(){
	largura = window.innerWidth;
	if ( largura <= 650)
	{
		$("body").stop().css({"marginLeft":"-250px"});
		$("#abremenu").stop().css({"width":"100%"});
		$('#menu').stop().css({"display": "block"});
		
	}else{
		controle = -250;
		$("body").stop().css({"marginLeft":"0px"});
		$("#abremenu").stop().css({"width":"calc(100% - 250px)"});
		$('#menu').stop().css({"display": "none"});
	}
}



function controlemenu(valor){

	if((valor != "clicknot")&&(largura <= 650))
	{
		if (valor == "menuclick")
		{

			if(controle == -250)
			{
				controle = 0;
			}
				else
			{
				controle = -250;
			}

		}else{
			controle = -250;
		}

		$("body").stop().css({"marginLeft": controle+"px"});	
		
	}
}




$(window).bind('load', function(){
	width = $(window).width();
	readDeviceOrientation();
   timer && clearTimeout(timer);
   timer = setTimeout(function(){resize();}, 200);
});

$(window).bind('resize', function(){
	width2 = $(window).width();
	if (width != width2)
	{
		timer && clearTimeout(timer);
   		timer = setTimeout(function(){resize();}, 200);
   		width = width2;
	}
   
});

$( window ).on( "orientationchange", function( event ) {

	readDeviceOrientation();

});



window.addEventListener('click',function(e){
	valor = e.target.getAttribute("data-opt");
	controlemenu(valor);
});


document.addEventListener("touchstart", function(ev){
	
	touchXi = ev.changedTouches[0].clientX;

},false);


document.addEventListener("touchend", function(ev){
	
	touchXf = ev.changedTouches[0].clientX;

	valor = ev.target.getAttribute("data-opt");

	var touch = touchXf-touchXi;

	console.log(touchXf);
	console.log(touchXi);

	if(touch == 0)
	{	

		controlemenu(valor);

	}else{

		if(touch < -130)
		{
			controle = 0;
			controlemenu();
		}
		else{
			if(touch > 130)
			{
				controle = -250;
				controlemenu("menuclick");
			}
		}

		
	}
	
},false);
