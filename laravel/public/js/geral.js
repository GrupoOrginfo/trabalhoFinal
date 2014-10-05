
//----------------------------------------------//
//					Variaveis					//
//----------------------------------------------//

janela = $(window);
var width ;
var timer;
var controle= -250; //isso e a margem esquerda da sidebar. Quando carrega a pagina tem valor -250.  
var touchXi = 0;	//isso e a posicao inicial do dedo no TouchMode
var touchXf = 0;	//isso e a posicao final do dedo no TouchMode

conteudo = document.getElementsByClassName("conteudo");

//----------------------------------------------//
//					Funcoes						//
//----------------------------------------------//

function readDeviceOrientation() {		//Essa funcao serve para ajustar bug do iphone na hora de mudar orientação vertical/horizontal
                 		
    if (Math.abs(window.orientation) === 90) {
        $("meta[name=viewport]").attr('content', "width=device-height, initial-scale=1, maximum-scale=1, user-scalable=no");
    } else {
    	 $("meta[name=viewport]").attr('content', "width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no");
    }
}


function resize(){	//Essa funcao verifica se a largura da janela e menor que 650px. Se for, esconde sidebar. Senao, mostra sidebar.
					//Essa funcao funciona apenas no redimensionamento da janela
	largura = window.innerWidth;
	if ( largura <= 650)
	{
		$("body").stop().css({"marginLeft":"-250px"}); //Oculta sidebar
		$("#abremenu").stop().css({"width":"100%"});
		$('#menu').stop().css({"display": "block"}); //Mostra botao de menu
		
		
	}else{
		controle = -250;
		$("body").stop().css({"marginLeft":"0px"});	//Mostra sidebar 
		$("#abremenu").stop().css({"width":"calc(100% - 250px)"});
		$('#menu').stop().css({"display": "none"}); //Oculta botao de menu
	}
}


janela.on("load",function(){//essa funcao apaga a msg depois que ele é mostrado
		$("#mainmsg").delay(1100).fadeOut(1500);
		$("#failmsg").delay(1100).fadeOut(1500);
	});

function controlemenu(valor){ //Essa funcao tambem mostra/esconde sidebar mas so funciona com as chamadas de touch e click de mouse 
//estes if's verificam qual a acao do usuario.
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



//----------------------------------------------//
//				Listeners de Eventos			//
//----------------------------------------------//


$(window).bind('load', function(){ // Função de configuração ao carregar janela (É como se fosse um construtor do Java).
	width = $(window).width();
	readDeviceOrientation(); //chama a função de orientação.
   	timer && clearTimeout(timer);
   	timer = setTimeout(function(){resize();}, 200);
});

$(window).bind('resize', function(){	//função que verifica quado a janela foi redimensionada. se for, chama a função resize.
	width2 = $(window).width();
	if (width != width2)
	{
		timer && clearTimeout(timer);
   		timer = setTimeout(function(){resize();}, 200);
   		width = width2;
	}
   
});

$( window ).on( "orientationchange", function( event ) { //verifica mudanca na orientacao da pagina e entao
	//chama a função de ajuste do bug do iphone;

	readDeviceOrientation();

});



window.addEventListener('click',function(e){ //Verifica quando o usuario clicou no menu para aparecer sidebar.
	valor = e.target.getAttribute("data-opt");
	controlemenu(valor);
});


document.addEventListener("touchstart", function(ev){ //verifica quando o usuario encostou o dedo na tela.
	
	touchXi = ev.changedTouches[0].clientX; //atribui  a posicao inicial do dedo na variavel touchXi

},false);


document.addEventListener("touchend", function(ev){ //verifica quando o usuário retirou o dedo na tela.
	
	touchXf = ev.changedTouches[0].clientX; //atribui  a posição final do dedo na variavel touchXi

	valor = ev.target.getAttribute("data-opt"); //pega valores data-opt do html e joga na variavel valor

	var touch = touchXf-touchXi; //diferença entre pontos inicial e final ao realizar a requisicao touch

	if(touch == 0) //se o usuario so tenha dado um tap na tela...
	{	

		controlemenu(valor); //chama a funcao controlemenu e passa valor como parametro

	}else{ //senao...

		if(touch < -70) //se usuario passou dedo da direita para esquerda em 70 px ou mais
		{
			controle = 0;	
			controlemenu(); //chama controlemenu() e não passa parametro
		}
		else{ //senao
			if(touch > 70)//se usuario passou dedo da esquerda para direita em 70 px ou mais
			{
				controle = -250;
				controlemenu("menuclick");//chama controlemenu() e passa "menuclick" como parâmetro
			}
		}

		
	}
	
},false);


