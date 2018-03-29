<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.5/css/uikit.min.css">
		<link rel="stylesheet" href="/css/client-ticket-css/master.css">
		<meta name='viewport' content='width=device-width, initial-scale=1'>
		<meta charset='utf-8'>
		@yield('head')
	</head>
	<body>
		<div class="main-wrapper flex">
			<div class="main-inner flex">
				<h3 class='main-title'>{{$name}}</h3>
				<div class="step-process">
					<a href='{{url("/biljett/uppgifter")}}' class="@if($name == 'Betala' || $name == 'Bekräftelse') active @endif"><div class="step"></div></a>
					<a href='{{url("/biljett/betala")}}' class="@if($name == 'Bekräftelse') active @endif"><div class="step"></div></a>
					<a><div class="step"></div></a>
			    </div>

				@yield('body')
			</div>
		</div>
	</body>
</html>