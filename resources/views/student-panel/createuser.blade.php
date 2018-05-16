@extends('student-panel.master')

@section('head')
	<title>Bjud in - EP-admin</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.40/css/uikit.min.css">
	<link rel="stylesheet" href="/css/student/createuser.css">
@endsection

@section('body')
<div id="app" class='content'>

	<div class="settings-wrapper">
		<div id='status' class="uk-alert"></div>

		<form @submit.prevent="addEmail">
		    <div>
		        <div class="uk-inline">
		            <span class="uk-form-icon" uk-icon="icon: mail"></span>
		            <input class="uk-input" type="email" placeholder="namn@exempel.se" v-model='add_email'>
		        </div>

		        <button class="uk-button uk-button-primary">Lägg till</button>
		    </div>
		    <span @click="autoComplete('@gmail.com')" class="uk-label emailShortcut">@gmail.com</span>
		    <span @click="autoComplete('@hotmail.com')" class="uk-label emailShortcut">@hotmail.com</span>
		</form>

		<table class="uk-table uk-margin" v-if='email_list.length !== 0'>
		    <thead>
		        <tr>
		        	<th class='del'>Radera</th>
		            <th>E-post</th>
		        </tr>
		    </thead>
		    <tbody>
		        <tr v-for='email in email_list'>
		        	<td @click="email_list.splice(index, 1)" class='del'><a class="uk-icon" uk-icon="trash"></a></td>
		        	<td>@{{email}}</td>
		        </tr>
		    </tbody>
		</table>

		<button @click='sendRequests' id='send-inv' v-show='email_list.length !== 0' class="uk-button uk-button-default">Skicka inbjudningslänkar</button>
	</div>

</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.14/vue.js'></script>
	<script src='/js/admin/student.createuser.js'></script>
@endsection
