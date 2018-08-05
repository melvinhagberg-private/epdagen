@extends('layouts.app')

@section('head')
    <title>Logga in - EP-admin</title>
    <link rel="stylesheet" href="/css/student/login.css">
@endsection

@section('content')
<div class='login-parent'>
    <div class="uk-placeholder loginPanel">
        <h3 class='title'>Logga in</h3>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="uk-margin">
                <div class="uk-inline">
                    <span class="uk-form-icon" uk-icon="icon: mail"></span>
                    <input name='email' type='email' class="uk-input" type="text" placeholder='E-post' required autofocus value="{{old('email')}}">
                </div>
            </div>

            <div class="uk-margin">
                <div class="uk-inline">
                    <span class="uk-form-icon" uk-icon="icon: lock"></span>
                    <input name='password' type='password' class="uk-input" type="text" placeholder='Lösenord'>
                </div>
            </div>
            
            @if ($errors->any())
                <span class="error">{{ $errors->first() }}</span>
            @endif

            <div class="uk-margin">
                <button type='submit' class="uk-button uk-button-primary uk-button-small">Logga in</button>
            </div>

        </form>
    </div>
</div>
@endsection
