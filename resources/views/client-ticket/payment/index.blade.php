@extends('client-ticket.master')

@section('head')
	<title>Köp biljetter - EP-dagen</title>
	<link rel='stylesheet' type='text/css' href='/css/client-ticket-css/payment.css'>
@endsection

@section('body')

	<iframe src="{{$paymentHref}}" frameborder="0"></iframe>

	<script>
		let allowRedirect = false;

		document.querySelector('iframe').onload = (e) => {
			if (allowRedirect == true) {
				e.preventDefault();
				window.location.replace(document.querySelector('iframe').contentWindow.location.href);
			}
			allowRedirect = true;
		}
	</script>

@endsection