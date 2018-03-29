new Vue({
	el: '#app',
	data: {
		full_name: '',
		sell_url: ''
	},
	computed: {
		sell_url_preview: function() {
			return this.sell_url.split(' ').join('_').toLowerCase();
		}
	},
	methods: {
		sell_url_create() {
			this.sell_url = this.full_name.split(' ').join('').toLowerCase();
		}
	}
});