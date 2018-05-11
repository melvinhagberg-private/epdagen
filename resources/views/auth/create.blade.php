@extends('layouts.app')

@section('head')
    <title>Registrera - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="/css/student/register.css">
@endsection

@section('content')
<div id="app">
	<div class="register-parent">
        <div class='uk-placeholder registerPanel'>
            <h3 class='title'>Registrera</h3>

    		<form method='POST' action='/admin/uppdatera'>
    			@csrf

    			<input name='signup_token' type="hidden" value='{{$token}}'>

                <div class="uk-margin">
                    <div class='uk-inline'>
                        <input name='name' type='text' class="uk-input" placeholder='För- och efternamn' required autofocus value="{{old('name')}}" v-model='full_name' @blur="sell_url_create">
                    </div>
                    @if ($errors->has('name'))
                        <span class="error">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div class="uk-margin">
                    <div class='uk-inline'>
                        <input name='email' type='email' class="uk-input" placeholder='E-post' required value="{{old('email')}}">
                    </div>
                    @if ($errors->has('email'))
                        <span class="error">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="uk-margin">
                    <div class='uk-inline'>
                        <input name='password' type='password' class="uk-input" placeholder='Lösenord' required value="{{old('password')}}">
                    </div>
                    @if ($errors->has('password'))
                        <span class="error">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <div class="uk-margin">
                    <div class='uk-inline'>
                        <input name='sell_url' class="uk-input" type="text" placeholder="Sälj-URL" v-model='sell_url'>
                    </div>
                    @if ($errors->has('sell_url'))
                        <span class="error">{{ $errors->first('sell_url') }}</span>
                    @endif
                </div>

                <div class="preview-url">
    				<span>
    					<span class="secure">https:</span>//epdagen.se/@{{sell_url_preview}}
    				</span>
    	        </div>

                <div class="uk-margin">
                    <button type='submit' class="uk-button uk-button-primary">Logga in</button>
                </div>
    		</form>
        </div>
	</div>

</div>

<script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.14/vue.js'></script>
<script src='/js/admin/register.js'></script>

@endsection
