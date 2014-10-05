<!DOCTYPE html>
<html lang="pt-br">
<head>

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<script src="{{asset('js/jquery-1.9.1.js')}}"></script>

@yield('cssAdicional')
<link type="text/css" rel="stylesheet" href="{{asset('css/geral.css')}}">

@yield('css')

</head>
<body id="body">

	@if(Session::has("msg"))
			<div id="mainmsg" class="msgs">
				{{Session::get("msg")}}
			</div>
	@endif

	@if(Session::has("fail"))
			<div id="failmsg" class="msgs">
				{{Session::get("fail")}}
			</div>
	@endif
	
	@yield('sidebar')
	
	@yield('abremenu')
	
	<div class="content">	
		<div class="conteudo">	
			@yield('conteudo')
		</div>
		
		@yield('footer')

	</div>
	
	

	<script src="{{asset('js/geral.js')}}"></script>

	@yield('jsAdicional')
</body>

</html>
