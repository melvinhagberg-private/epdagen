@extends('student-panel.master')

@section('head')
	<title>Bjud in - EP-admin</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.40/css/uikit.min.css">
	<link rel="stylesheet" href="/css/student/createuser.css">
@endsection

@section('body')
<div id="app" class='content'>

	<div class="settings-wrapper">
		<form @submit.prevent="addEmail">
		    <div>
		        <div class="uk-inline">
		            <span class="uk-form-icon" uk-icon="icon: mail"></span>
		            <input class="uk-input" type="email" placeholder="namn@exempel.se" v-model='add_email'>
		        </div>

		        <button class="uk-button uk-button-primary">Lägg till</button>

				<p class='atr'>Behörighet:</p>
		        <div class="select is-small">
					<select class='uk-select' v-model='type'>
						<option value='3'>Biljettansvarig</option>
						<option value='1'>Administratör</option>
					</select>
		        </div>

        		<p class='atr'>Klass:</p>
                <div class="select is-small">
					<input id='' type='text' class='uk-input' placeholder='Klass'>
					<span class='hint'>Exempelvis "EP18". För dold, använd "NOINDEX"</span>
                </div>

		    </div>
		    <span @click="autoComplete('@gmail.com')" class="uk-label emailShortcut">@gmail.com</span>
		    <span @click="autoComplete('@hotmail.com')" class="uk-label emailShortcut">@hotmail.com</span>
		</form>

		<table class="uk-table uk-margin" v-if='email_list.length !== 0'>
		    <thead>
		        <tr>
		        	<th class='del'>Radera</th>
		            <th>E-post</th>
		            <th>Behörighet</th>
		            <th>Klass</th>
		        </tr>
		    </thead>
		    <tbody>
		        <tr v-for='(email, index) in email_list'>
		        	<td @click="email_list.splice(index, 1)" class='del'><a class="uk-icon" uk-icon="trash"></a></td>
		        	<td>@{{email.email}}</td>
		        	<td>@{{getType(email.type)}}</td>
		        	<td>@{{email.grade}}</td>
		        </tr>
		    </tbody>
		</table>

		<button @click='sendRequests' id='send-inv' v-show='email_list.length !== 0' class="uk-button uk-button-default">Skicka inbjudningslänkar</button>
	</div>

</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.14/vue.min.js'></script>
	<script src='/js/admin/admin.createuser.js'></script>
@endsection
