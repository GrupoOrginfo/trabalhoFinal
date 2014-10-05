@extends('templates.main')

@section('css')
	<style type="text/css">
		#link{{$pagina}}{

			color:#00b5ad;
			background-color:#2a2a2a;

		}
	</style>
	<link type="text/css" rel="stylesheet" href="{{asset('css/geral_naologado.css')}}">

@stop

@section('abremenu')
	<div id="abremenu">
			<a id="menu">
			<img data-opt="menuclick" height="40" src="{{asset('img/menu.svg')}}" />
			</a>
			CAYANA
			<img id="logomenu" src="{{asset('img/desenho.svg')}}" />
			
	</div>
@stop

@section('sidebar')
<div id="sidebar" data-opt="clicknot"  class="sidebar">
	<br>
		<img id="logo" data-opt="clicknot" src="{{asset('img/desenho.svg')}}" />
		<br> CAYANA <br>
		
		<ul data-opt="clicknot"  style="font-size:14pt; list-style:none">
			<li><a data-opt="clicknot"  id="linkSignInUp" href="{{URL::to('/')}}">Sign In / Up</a></li>
			<li><a data-opt="clicknot"  id="linkSobre" href="{{URL::to('/sobre')}}">Sobre</a></li>
			<li><a data-opt="clicknot"  id="linkSuporte" href="{{URL::to('/suporte')}}">Suporte</a></li>
		</ul>
	</div>
@stop

@section('footer')
		<div class="rodape">&copy; CAYANA - All rights reserved</div>
@stop