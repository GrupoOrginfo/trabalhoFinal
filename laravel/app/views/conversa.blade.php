@extends('templates.logged')

@section('cssAdicional')
	<link rel="stylesheet" type="text/css" href="{{asset('/css/home.css')}}">
@stop

@section('footer')
		<div class="rodape">
		<input type="text" id="sendmsg" />
		</div>
@stop