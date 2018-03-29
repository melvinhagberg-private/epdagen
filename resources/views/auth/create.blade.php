@extends('layouts.app')

@section('head')
    <title>Registrera - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="/css/student/register.css">
@endsection

@section('content')
<div id="app">

	<div class="inner">
		<form method='POST' action='/admin/uppdatera'>
			@csrf

			<input name='signup_token' type="hidden" value='{{$token}}'>

	        <div class="uk-margin">
	            <input name='name' class="uk-input @if ($errors->has('name')) uk-form-danger @endif" type="text" placeholder="För- och efternamn" v-model='full_name' @blur="sell_url_create">
				@if ($errors->has('name'))
					@foreach ($errors->get('name') as $error)
						<span class="field-error">*{{$error}}</span>
					@endforeach
				@endif
	        </div>

	        <div class="uk-margin">
	            <input name='email' class="uk-input @if ($errors->has('email')) uk-form-danger @endif" type="email" placeholder="E-post" value='{{$email}}'>
				@if ($errors->has('email'))
					@foreach ($errors->get('email') as $error)
						<span class="field-error">*{{$error}}</span>
					@endforeach
				@endif
	        </div>

	        <div class="uk-margin">
	            <input name='password' class="uk-input @if ($errors->has('password')) uk-form-danger @endif" type="password" placeholder="Lösenord">
	            @if ($errors->has('password'))
					@foreach ($errors->get('password') as $error)
						<span class="field-error">*{{$error}}</span>
					@endforeach
				@endif
	        </div>

	        <div class="uk-margin">
	            <input name='sell_url' class="uk-input @if ($errors->has('sell_url')) uk-form-danger @endif" type="text" placeholder="Sälj-URL" v-model='sell_url'>
	            @if ($errors->has('sell_url'))
	            	@foreach ($errors->get('sell_url') as $error)
	            		<span class="field-error">*{{$error}}</span>
	            	@endforeach
	            @endif
	        </div>

	        <div class="preview-url">
				<span>
					<span class="secure">https:</span>//epdagen.se/@{{sell_url_preview}}
				</span>
	        </div>

			<button class="uk-button uk-button-primary">Registrera</button>
		</form>
	</div>

</div>

<script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.14/vue.js'></script>
<script src='/js/admin/register.js'></script>

@endsection