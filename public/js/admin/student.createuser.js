new Vue({
	el: '#app',

	data: {
		'add_email': '',
		'email_list': []
	},

	methods: {
		addEmail: function() {
			if (this.add_email !== '') {
				this.email_list.push(this.add_email);
				this.add_email = '';
				$('.uk-input').focus();
			}
		},

		autoComplete: function($a) {
			this.add_email += $a;
			this.addEmail();
		},

		sendRequests: function() {
			$('#send-inv').html('Skickar');

			axios.post('/admin/do?action=add_users', {
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
				'email_list': this.email_list,
			})
			.then((response) => {
				$('#send-inv').html('skickat');
				$('#send-inv').addClass('show');
				this.email_list = [];
			})
			.catch((error) => {
				$('#send-inv').html('något gick fel');
			});
		}
	}
})