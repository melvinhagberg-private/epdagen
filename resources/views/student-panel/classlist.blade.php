@extends('student-panel.master')

@section('head')
	<title>Klasslista - EP-admin</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.40/css/uikit.min.css">
	<link rel="stylesheet" href="/css/student/panels/latest.css">
@endsection

@section('body')
<div class='settings-wrapper'>

	<div class="panel single-panel">
		<h3>Klasslista {{$users[0]->grade}}</h3>
		<table class="uk-table uk-table-hover uk-table-divider">
			<thead>
				<tr>
					<td>Namn</td>
                    <td>E-post</td>
                    <td>Sälj-url</td>
					<td>Total försäljning</td>
				</tr>
			</thead>
			<tbody>
                @foreach ($users as $user)
    				<tr>
    					<td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td><a href='{{url($user->sell_url)}}'>{{$user->sell_url}}</a></td>
                        <td>{{number_format($user->sold_for, 0, '', ' ')}} kr</td>
    				</tr>
                @endforeach
			</tbody>
		</table>
	</div>

</div>
@endsection
