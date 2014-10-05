@extends('templates.main')

@section('css')
	<link type="text/css" rel="stylesheet" href="{{asset('css/geral_logado.css')}}">

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
		<img id="logo" data-opt="clicknot" src="{{asset('img/desenho.svg')}}" />
		<span>CAYANA </span>
		
		<ul data-opt="clicknot" id="contatos"  style="font-size:10pt; list-style:none">
			
		</ul>
	</div>
@stop

@section('footer')
		<div class="rodape">
		<input type="text" id="sendmsg" />
		</div>
@stop

@section('jsAdicional')
	<script type="text/javascript" src="{{asset('js/ajax.js')}}"></script>
@stop