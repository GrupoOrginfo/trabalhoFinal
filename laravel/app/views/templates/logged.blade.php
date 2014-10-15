@extends('templates.main')

@section('css')
	<link type="text/css" rel="stylesheet" href="{{asset('css/geral_logado.css')}}">

@stop

@section('abremenu')
	<div id="abremenu">
			<a id="menu">
				<img data-opt="menuclick" height="40" src="{{asset('img/menu.svg')}}" />
			</a>
			
			<div id="title">CAYANA</div>
			
			<a id="showprofileoptions" href="#"><div id="usernameperfil">{{$user}}</div><img id="fotoperfil" src="{{asset('img').'/profile/'.$foto}}" /></a>

			<div id="profileoptions">
				<ul>
					<li><a href="{{URL::to('/home')}}"><img src="{{asset('/img/home.png')}}"></a></li>
					<li><a href="{{URL::to('/addamigo')}}"><img src="{{asset('/img/addfriend.png')}}"></a></li>
					<li><a href="{{URL::to('/removeamigo')}}"><img src="{{asset('/img/removefriend.png')}}"></a></li>
					<li><a href="{{URL::to('/editaperfil')}}"><img src="{{asset('/img/editaperfil.png')}}"></a></li>
					<li><a href="{{URL::to('/logout')}}"><img src="{{asset('/img/logout.png')}}"></a></li>
					
				</ul>	
			</div>
			
	</div>
@stop

@section('sidebar')
<div id="sidebar" data-opt="clicknot"  class="sidebar">
		<a href="{{URL::to('/home')}}"><img draggable="true" ondragstart="drag(event)" id="logo" data-opt="clicknot" src="{{asset('img/desenho.svg')}}" /></a>
		<span>CAYANA</span>
		
		<ul data-opt="clicknot" id="contatos"  style="font-size:10pt; list-style:none">
			
		</ul>

</div>
@stop


@section('jsAdicional')

	<script type="text/javascript" src="{{asset('js/ajax.js')}}"></script>

@stop