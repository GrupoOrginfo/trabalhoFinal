
$(window).on('load', function(){ verificaAmigos(); });


freq = setInterval( function(){ verificaAmigos();},4000);



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
					status = "#ff6d3e"; //deslogado
				}else
				{
					status = "#00ac31";//logado
				}

				if(document.getElementById(i) == undefined ){
		   			$('#contatos').append("<li data-opt='clicknot'><a data-opt='clicknot' id='"+i+"' href=''><img width='50' data-opt='clicknot'  style='border-right:3px solid "+status+";float:left; margin-right:5px'  src='"+retorno[i]["fotoPerfil"]+"'><span data-opt='clicknot' class='realnome'>"+retorno[i]["nome"]+"<span><br><span data-opt='clicknot' style='font-size:10pt;font-family:helvetica'>"+i+"</span></a></li>");
				}
				else
				{
					$("#"+i).html("<img width='50' data-opt='clicknot'  style='border-right:3px solid "+status+";float:left; margin-right:5px'  src='"+retorno[i]["fotoPerfil"]+"'><span data-opt='clicknot' class='realnome'>"+retorno[i]["nome"]+"<span><br><span data-opt='clicknot' style='font-size:10pt;font-family:helvetica'>"+i+"</span>");
				}
				
			}
			
		},
		error: function(){
	   		alert(" :( Alguma coisa deu errado. Tente recarregar a página");
		}
	});

}


	function removeamigo(id){
		$.ajax({
			type: "post",
			url: "removeamigo",
			data:{'username':""+id+""},
			dataType: "json",
			success: function () {
					alert("vc removeu"+id);
				
				
			},
			error: function(){
		   		alert(" :( Alguma coisa deu errado. Tente recarregar a página");
				//$("#loader2").css({"display":"none"});
			}
		});
	}
