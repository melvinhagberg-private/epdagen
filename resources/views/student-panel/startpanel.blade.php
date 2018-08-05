@extends('student-panel.master')

@section('head')
	<title>Hem - EP-admin</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.40/css/uikit.min.css">
	<link rel="stylesheet" href="/css/student/startpanel.css">
@endsection

@section('body')
<div class='settings-wrapper'>

	<div class='panel-wrapper-4'>
		<div class='panel'>
			<span>Din försäljning</span>
			<h4>{{number_format($self_total, 0, '', ' ')}} kr</h4>
		</div>

		@foreach ($totals as $grade => $total)
			<div class='panel'>
				<span>{{$grade}} har sålt för</span>
				<h4>{{number_format($total, 0, '', ' ')}} kr</h4>
			</div>
		@endforeach
	</div>

	<div class='panel-wrapper-2'>
		<div class='panel-parent'>
			<div class="panel single-panel">
				<h3>Dina senaste försäljningar</h3>
				<table class="uk-table uk-table-hover uk-table-divider">
					<thead>
						<tr>
							<td>Namn</td>
							<td>Antal</td>
						</tr>
					</thead>
					<tbody>
						@foreach ($latest_tickets as $ticket)
							<tr>
								<td>{{$ticket['name']}}</td>
								@if ($ticket['num'] === 1)
									<td>{{$ticket['num']}} biljett</td>
								@else
									<td>{{$ticket['num']}} biljetter</td>
								@endif
							</tr>
						@endforeach
					</tbody>
				</table>
				<p class='show-more'>
					<a href="{{url('/admin/senaste')}}">Visa alla</a>
				</p>
			</div>
		</div>

		<div class='panel-parent'>
			<div class="panel single-panel">
				<h3>Klasslista {{$featured_peers[0]->grade}}</h3>
				<table class="uk-table uk-table-hover uk-table-divider">
					<thead>
						<tr>
							<td>Namn</td>
							<td>Sålt för</td>
						</tr>
					</thead>
					<tbody>
						@foreach ($featured_peers as $user)
							<?php
								$total = 0;
								foreach ($user->tickets as $ticket) {
									if ($ticket->type === 1) {
										$total += 350;
									} else if ($ticket->type === 2) {
										$total += 500;
									}
								}
							?>
							<tr>
								<td>{{$user->name}}</td>
								<td>{{number_format($total, 0, '', ' ')}} kr</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				<p class='show-more'>
					<a href="{{url('/admin/klasslista')}}">Visa alla</a>
				</p>
			</div>
		</div>
	</div>

</div>
@endsection
