new Vue({
	el: '#app',

	data: {
		'add_email': '',
		'email_list': [],
		'type': '3'
	},

	methods: {
		addEmail: function() {
			if (this.add_email !== '') {
				this.email_list.push({
					email: this.add_email,
					type: parseInt(this.type),
					grade: $('#grade').val()
				});

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
		},
		getType: function($type) {
			if ($type == 1) {
				return 'Administratör';
			} else if ($type == 3) {
				return 'Biljettansvarig';
			}
		}
	}
})