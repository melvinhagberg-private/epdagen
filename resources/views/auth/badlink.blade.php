@extends('layouts.app')

@section('head')
    <title>Ogiltig länk - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel='stylesheet' type='text/css' href='/css/student/badlink.css'>
    <meta name="robots" content="noindex">
@endsection

@section('content')

    <div class="wrapper flex">
        <div class="inner flex">
            <span class='fa error-icon'>
                <span>&#xf00d;</span>
            </span>

            <h1>Din länk är inte giltig</h1>
            <p>Kontakta biljettansvarig</p>
            <a href="{{route('login')}}">Har du redan registrerat dig?</a>

        </div>
    </div>

@endsection