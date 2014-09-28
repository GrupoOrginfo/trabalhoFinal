<!DOCTYPE html>
<html lang="pt-br">
<head>
<link type="text/css" rel="stylesheet" href="{{asset('css/geral.css')}}">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<script src="{{asset('js/jquery-1.9.1.js')}}"></script>

</head>
<body id="body">
	
	<div id="sidebar" data-opt="clicknot"  class="sidebar">
	<br>
		<img id="logo" data-opt="clicknot" src="{{asset('img/desenho.svg')}}" />
		<br> CAYANA <br>
		
		<ul data-opt="clicknot"  style="font-size:14pt; list-style:none">
			<li><a data-opt="clicknot"  href="#home">Home</a></li>
			<li><a data-opt="clicknot"  href="#contato">Contato</a></li>
			<li><a data-opt="clicknot"  href="#local">Localização</a></li>
		</ul>
	</div>
	
	<div id="abremenu">
		<a id="menu">
		<img data-opt="menuclick" height="40" src="{{asset('img/menu.svg')}}" />
		<a>
		CAYANA
		<img id="logomenu" src="{{asset('img/desenho.svg')}}" />
		
	</div>
	
	<div class="content">	
		<div class="conteudo">	
			@yield('conteudo')
		</div>
		
		
		<div style="height:190px" class="titulo">GHHJH</div>
	</div>
	


	<script src="{{asset('js/geral.js')}}"></script>
</body>

</html>
