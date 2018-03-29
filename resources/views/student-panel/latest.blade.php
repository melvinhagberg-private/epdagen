@extends('student-panel.master')

@section('head')
	<title>Skapa Användare - EP-admin</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.40/css/uikit.min.css">
	<link rel="stylesheet" href="/css/student/panels/latest.css">
@endsection

@section('body')
<div class='settings-wrapper'>

	<div class="panel single-panel">
		<h3>Dina senaste försäljningar</h3>
		<table class="uk-table uk-table-hover uk-table-divider">
			<thead>
				<tr>
					<td>Namn</td>
                    <td>E-post</td>
                    <td>Telefon</td>
					<td>Antal och typ</td>
                    <td>Försäljningsvärde</td>
				</tr>
			</thead>
			<tbody>
                @foreach ($groups as $a)
    				<tr>
    					<td>{{$a['name']}}</td>
                        <td>{{$a['email']}}</td>
                        <td>{{$a['phone']}}</td>
    					<td>{{$a['num']}} {{$a['nice_type']}}</td>
                        <td>{{$a['price']}} kr</td>
    				</tr>
                @endforeach
			</tbody>
		</table>
	</div>
		
</div>
@endsection