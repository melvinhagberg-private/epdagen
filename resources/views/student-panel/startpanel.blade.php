@extends('student-panel.master')

@section('head')
	<title>Skapa Användare - EP-admin</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.40/css/uikit.min.css">
	<link rel="stylesheet" href="/css/student/startpanel.css">
@endsection

@section('body')
<div class='settings-wrapper'>

	<div class='panel-wrapper-4'>
		<div class='panel'>
			<span>Din försäljning</span>
			<h4>22 500 kr</h4>
		</div>
		<div class='panel'>
			<span>EP18 har sålt för</span>
			<h4>46 000 kr</h4>
		</div>
		<div class='panel'>
			<span>EP17 har sålt för</span>
			<h4>10 000 kr</h4>
		</div>
		<div class='panel'>
			<span>EP16 har sålt för</span>
			<h4>12 000 kr</h4>
		</div>
	</div>
	
	<div class='panel-wrapper-2'>
		<div class="panel single-panel">
			<h3>Dina senaste försäljningar</h3>
			<table class="uk-table uk-table-hover uk-table-divider">
				<thead>
					<tr>
						<td>Namn</td>
						<td>Antal och typ</td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Melvin Hagberg</td>
						<td>6 privatbiljetter</td>
					</tr>
				</tbody>
			</table>
			<p class='show-more'>
				<a>Visa alla</a>
			</p>
		</div>
		
		<div class="panel single-panel">
			<h3>Klasslista EP18</h3>
			<table class="uk-table uk-table-hover uk-table-divider">
				<thead>
					<tr>
						<td>Namn</td>
						<td>Sålt för</td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Melvin Hagberg</td>
						<td>6000 kr</td>
					</tr>
				</tbody>
			</table>
			<p class='show-more'>
				<a>Visa alla</a>
			</p>
		</div>
	</div>
		
</div>
@endsection