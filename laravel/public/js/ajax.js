


var dataAtual = "0000-00-00";
var horaAtual = "00:00:00";

$(document).ready(function(){

	verificaAmigos();

	window.addEventListener("keyup",function(e){
	
		if((e.keycode == "13")||(e.which == "13"))
		{
			msg = document.getElementById("sendmsg");
			if(msg != null)
			{
				if(msg.value != "")
				{
					inseremsg(msg.value);
					lemsg();
					msg.value='';
				}
			}
			
			
		}
	});

	freq = setInterval( function(){ verificaAmigos();},3000);

	if(conversaAtiva != "CAYANA"){

		freq2 = setInterval( function(){ lemsg();},1000);

	}

});





function verificaAmigos(){

	$.ajax({
		type: "post",
		url: urlroot+"amigos",
		dataType: "json",
		success: function (retorno) {
			
			if(retorno == ""){
				$('#contatos').html("<div style='margin-top:200px'><center><h2>Você ainda não tem amigos no Cayana.</h2></center></div>");	
			}else{

				for (i in retorno)
				{
					if(retorno[i]["notify"] == "0")
					{
						wnote = "0";
					}
					else{
						wnote = "15";
					}
					

					if(retorno[i]["status"] == "0"){
						status = "#ff6d3e"; //deslogado
					}else
					{
						status = "#00ac31";//logado
					}

					if(document.getElementById(i) == undefined ){
			   			
			   			if(conversaAtiva != i){
							$('#contatos').append("<li data-opt='clicknot'><a data-opt='clicknot' id='"+i+"' href='"+urlroot+"conversa/"+retorno[i]["conversa"]+"'><span  style='width:"+wnote+"px' class='notify'><img src='"+urlroot+"img/note.png' /></span><img width='50' data-opt='clicknot'  style='border-right:3px solid "+status+";float:left; margin-right:5px'  src='"+retorno[i]["fotoPerfil"]+"'><span data-opt='clicknot' class='realnome'>"+retorno[i]["nome"]+"<span><br><span data-opt='clicknot' style='font-size:10pt;font-family:helvetica'>"+i+"</span></a></li>");
						}else{
							$('#contatos').append("<li data-opt='clicknot'><a data-opt='clicknot' style='background-color:#aaa;' id='"+i+"' href='#'><span  style='width:"+wnote+"px' class='notify'><img src='"+urlroot+"img/note.png' /></span><img width='50' data-opt='clicknot'  style='border-right:3px solid "+status+";float:left; margin-right:5px'  src='"+retorno[i]["fotoPerfil"]+"'><span data-opt='clicknot' class='realnome'>"+retorno[i]["nome"]+"<span><br><span data-opt='clicknot' style='font-size:10pt;font-family:helvetica'>"+i+"</span></a></li>");
						}

					}
					else
					{
						$("#"+i).html("<span style='width:"+wnote+"px' class='notify'><img src='"+urlroot+"img/note.png' /></span><img width='50' data-opt='clicknot'  style='border-right:3px solid "+status+";float:left; margin-right:5px'  src='"+retorno[i]["fotoPerfil"]+"'><span data-opt='clicknot' class='realnome'>"+retorno[i]["nome"]+"<span><br><span data-opt='clicknot' style='font-size:10pt;font-family:helvetica'>"+i+"</span>");
					}
					
				}
			}
			
		}
		
	});

}




function lemsg(){


	$.ajax({
		type: "post",
		url: urlroot+"leConversa",
		data:{"conversaId":conversaId, "dataAtual":dataAtual, "horaAtual":horaAtual},
		dataType: "json",
		success: function (retorno) {
			
			
			for(i in retorno)
			{
				
				item = retorno[i]["item"];
				data = retorno[i]["data"];
				hora = retorno[i]["hora"];
				pessoa = retorno[i]["pessoa"];
				euColor = retorno[i]["euColor"];

				dataAtual = data;
				horaAtual = hora;

				if(euColor == true){
					caixa = "<div class='boxtxt'><div class=txteu><div class='pessoa'>"+pessoa+"</div><div class='txt'>"+item+"</div></div></div>";	
				}
				else
				{
					caixa = "<div class='boxtxt'><div class=txtoutros><div class='pessoa'>"+pessoa+"</div><div class='txt'>"+item+"</div><div></div>";	
				}

				$("#conteudo").append(caixa);

			}

			if (retorno.length !== 0 ) {
				$("html, body").animate({"scrollTop": ($("#conteudo").height())+"px"},300);	
			}
			
			

		}
		
	});



		
}

function inseremsg(msg){

	$.ajax({

		type: "post",
		url: urlroot+"addConversa",
		data:{"msg":msg, "conversaId":conversaId},	
	});
}


