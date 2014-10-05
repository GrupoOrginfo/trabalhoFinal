
$(window).on('load', function(){ verificaAmigos(); });


freq = setInterval( function(){ verificaAmigos();},3000);



function verificaAmigos(){

	$.ajax({
		type: "get",
		url: "amigos",
		dataType: "json",
		beforeSend: function(){
			//$("#loader2").css({"display":"block"});
		},
		success: function (retorno) {
			for (i in retorno)
			{console.log(retorno);
				if(retorno[i]["status"] == "0"){
					status = "red";
				}else
				{
					status = "green";
				}

				if(document.getElementById(i) == undefined ){
		   			$('#contatos').append("<li><a data-opt='clicknot' id='"+i+"' href=''><img width='50'   style='border-right:3px solid "+status+";float:left; margin-right:5px'  src='img/"+retorno[i]["fotoPerfil"]+"'>"+retorno[i]["nome"]+"<br><span style='font-size:10pt;font-family:helvetica'>"+i+"</span></a></li>");
				}
				else
				{
					$('#'+i).html("<img width='50'  style='border-right:3px solid "+status+";float:left; margin-right:5px'  src='img/"+retorno[i]["fotoPerfil"]+"'>"+retorno[i]["nome"]+"<br><span style='font-size:10pt;font-family:helvetica'>"+i+"</span>");
				}
				
			}
			
		},
		error: function(){
	   		alert(" :( Alguma coisa deu errado. Tente recarregar a página");
			//$("#loader2").css({"display":"none"});
		}
	});

}