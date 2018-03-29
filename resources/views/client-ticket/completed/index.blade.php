@extends('client-ticket.master')

@section('head')
	<title>Köp biljetter - EP-dagen</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel='stylesheet' type='text/css' href='/css/client-ticket-css/completed.css'>
	<meta name="robots" content="noindex">
@endsection

@section('body')

	<div class="confirm-wrapper">
		
		<span class='fa check-icon'>
			<span>&#xf00c;</span>
		</span>

		<h1>Tack för ditt köp</h1>
		<p>Biljetterna är skickade till {{$email}}</p>
		<a href="#">Inte mottagit några biljetter?</a>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script> jQuery(window).ready(() => { jQuery('.check-icon span').addClass('initCheck'); }); </script>
@endsection