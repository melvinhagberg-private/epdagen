@extends('student-panel.master')

@section('head')
	<title>Senaste försäljningar - EP-admin</title>
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
						<td>
							<?php 
								$phone = $a['phone'];
								$phone = str_replace(' ', '', str_replace('-', '', str_replace('+', '', $phone)));
								
								if (substr($phone, 0, 1) === '0' && strlen($phone) === 10) {
									$phone = substr($phone, 0, 3) . ' ' . substr($phone, 3, 3) . ' ' . substr($phone, 6, 2) . ' ' . substr($phone, 8, 2);
								} else if (substr($phone, 0, 2) === '46' && $phone === 11) {
									$phone = '+' . substr($phone, 0, 2) . ' ' . substr($phone, 2, 2) . ' ' . substr($phone, 4, 3) . ' ' . substr($phone, 7, 2) . ' ' . substr($phone, 9, 2);
								}
								
								echo $phone;
							?>
						</td>
						
    					<td>{{$a['num']}} {{$a['nice_type']}}</td>
                        <td>{{number_format($a['price'], 0, '', ' ')}} kr</td>
    				</tr>
                @endforeach
			</tbody>
		</table>
	</div>

</div>
@endsection
