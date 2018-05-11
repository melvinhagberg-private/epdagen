<!DOCTYPE html>
<html>
	<head>
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name='viewport' content='width=device-width, initial-scale=1'>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.5/css/uikit.min.css">
		<link rel="stylesheet" href="/css/student/master.css">
		@yield('head')
	</head>
	<body>

		<div id='sidebar'>
			<ul class="uk-nav uk-nav-default">
                <li class="uk-nav-header">Navigering</li>
                <li><a href="{{url('/admin')}}"><span class="uk-margin-small-right" uk-icon="icon: home"></span>Startpanel</a></li>
                <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: settings"></span>Inställningar</a></li>
				<li><a href="{{url('/admin/senaste')}}"><span class="uk-margin-small-right" uk-icon="icon: cart"></span>Senaste försäljningar</a></li>
				<li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: users"></span>Klasslista</a></li>

				@if ($role == 1 || $role == 3)
					<li class="uk-nav-divider"></li>
					<li><a href="{{url('/admin/bjud-in')}}"><span class="uk-margin-small-right" uk-icon="icon:  plus-circle"></span>Bjud in</a></li>
				@endif

				<li class="uk-nav-divider"></li>
				<li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: question"></span>Hjälp</a></li>
                <li><a href="{{url('/admin/logga-ut')}}"><span class="uk-margin-small-right" uk-icon="icon: sign-out"></span>Logga ut</a></li>
            </ul>
		</div>

		@yield('body')

		<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.40/js/uikit.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.40/js/uikit-icons.min.js"></script>
	</body>
</html>
