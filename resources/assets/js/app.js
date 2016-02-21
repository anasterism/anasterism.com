new Vue({

	el: '#app',

	data: {

		formState: 'inactive',

		form: {
			name   : '',
			company: '',
			email  : '',
			phone  : '',
			message: '',
			types  : []
		},

		errors: {

			display : false,

			hasError: {
				name   : false,
				company: false,
				email  : false,
				phone  : false,
				message: false
			},

			messages: []

		},

		projectOptions: [
			{ value: 'Website', notes: '- Nice!', selected: false },
			{ value: 'Custom Web Application', notes: '- No one does it like us!', selected: false },
			{ value: 'Mobile Application', notes: '- Challenge accepted!', selected: false },
			/*{ value: 'Print', notes: '- Yep! We do that too', selected: false },*/
			{ value: 'Other', notes: '- Tell us about it below!', selected: false }
		]
	},

	methods: {

		process: function() {
			switch(this.formState) {
				case 'inactive':
					this.formState = 'active';
					break;
				case 'active':
					this.processForm();
					break
			}
		},

		processForm: function() {
			this.setOptionValues();
			this.formState = 'loading';

			var app = document.getElementById('app');
			var cH  = app.offsetHeight;
			app.style.height = cH + 'px';

			this.$http
				.post('/contacts', this.form)
				.then(this.postSuccess, this.postFailed);

			return true;
		},

		setOptionValues: function() {
			var values = [];

			for(var i in this.projectOptions) {
				if(this.projectOptions[i].selected) {
					values.push(this.projectOptions[i].value);
				}
			}

			this.form.types = values;

			return true;
		},

		clearForm: function() {
			this.form.name    = '';
			this.form.company = '';
			this.form.email   = '';
			this.form.phone   = '';
			this.form.message = '';
			this.form.types   = [];

			for(var i in this.projectOptions) {
				this.projectOptions[i].selected = false;
			}

			this.clearErrors();
		},

		clearErrors: function() {

			for(var property in this.errors.hasError) {
				this.errors.hasError[property] = false;
			}

			this.errors.display  = false;
			this.errors.messages = [];

			return true;
		},

		dismissErrors: function() {
			this.errors.display = false;
		},

		postSuccess: function(response) {
			this.clearForm();
			this.formState = 'success';

			var app = document.getElementById('app');
			var cH  = app.offsetHeight;
			app.style.height = 'auto';

			setTimeout(this.resetFormState, 5000);

			console.log(response);
		},

		postFailed: function(response) {
			this.clearErrors();
			this.formState = 'active';
			
			if(response.status == 422) {
				for(var property in response.data) {
					this.errors.hasError[property] = true;
					for(var i in response.data[property]) {
						this.errors.messages.push(response.data[property][i]);
					}
					this.errors.display = true;
					setTimeout(this.dismissErrors, 5000);
				}
			} else {
				console.log(response);
			}
		},

		resetFormState: function() {
			this.formState = 'inactive';
		}

	}

});