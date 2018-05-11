@extends('client-ticket.master')

@section('head')
	<title>Köp biljetter - EP-dagen</title>
	<link rel='stylesheet' type='text/css' href='/css/client-ticket-css/info.css'>
@endsection

@section('body')
<div id='app'>
	<form method='POST' action='/biljett/uppgifter'>

		{{ csrf_field() }}
		<input type="hidden" name='form-type' value='privat'>

		<div class="types">
			<div data-type='privat' class='type type-active'>
				<h5>Privat</h5>
			</div><div data-type='foretag' class='type'>
				<h5>Företag</h5>
			</div>
		</div>

		<div class='form-group'>
			<label for='name'>Namn</label>
			<input autofocus id='name' type="text" name="Namn" value="{{old('Namn')}}">
			@if ($errors->has('Namn')) <span class='error'>{{$errors->first('Namn')}}</span> @endif
		</div>

		<div class='form-group'>
			<label for='email'>E-post</label>
			<input id='email' type="email" name="E-post" value="{{old('E-post')}}">
			@if ($errors->has('E-post')) <span class='error'>{{$errors->first('E-post')}}</span> @endif
		</div>

		<div class='form-group'>
			<label for='phone'>Telefon</label>
			<input id='phone' type="text" name="Telefonnummer" value="{{old('Telefonnummer')}}">
			@if ($errors->has('Telefonnummer')) <span class='error'>{{$errors->first('Telefonnummer')}}</span> @endif
		</div>

		<div class='form-group'>
			@if ($affiliate)
				<input type='hidden' name='student_name' value='{{$affiliate["name"]}}'>
			@else
				<label for='student_name'>Säljare</label>
				<div class="select" id='student_name'>
					<select name='student_name'>
						<option value='none' selected>Välj säljare</option>
						@foreach($grades as $grade)
							<optgroup label="{{$grade['grade']}}">
								@foreach ($students as $student)
									@if ($student['grade'] == $grade['grade'])
										<option>{{$student['name']}}</option>
									@endif
								@endforeach
							</optgroup>
						@endforeach
					</select>
				</div>
			@endif
		</div>

		<div class='form-group'>
			<label for='form-ticket-count'>Antal Biljetter</label>
			<div class="select">
				<select name='Biljettantal' id='numTickets'>
					<option value='none' disabled selected>Antal biljetter</option>
				    <option value='1'>1 biljett</option>
				    <option value='2'>2 biljetter</option>
				    <option value='3'>3 biljetter</option>
				    <option value='4'>4 biljetter</option>
				    <option value='5'>5 biljetter</option>
				    <option value='6'>6 biljetter</option>
				    <option value='7'>7 biljetter</option>
				    <option value='8'>8 biljetter</option>
				    <option value='9'>9 biljetter</option>
				    <option value='10'>10 biljetter</option>
				</select>
			</div>
			@if ($errors->has('Biljettantal')) <span class='error'>{{$errors->first('Biljettantal')}}</span> @endif
		</div>

		<span id='total'></span>
		<button type='submit' disabled>Betala</button>

	</form>

	<a href='https://www.melvinhagberg.com' class='madeby'>System av <span>Melvin Hagberg</span></a>
</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src='/js/client-ticket/info.js'></script>
@endsection
