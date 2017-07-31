const app = new Vue({
	el: '#root',
	data: {
		days: ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'],
	},
	methods: {
		select_name(key, name) {
			return 'hours['+key+']['+name+']';
		},
		setClosed($event) {
			select = $event.target;
			tr = $(select).parents('tr:first');

			if ($(tr).hasClass('table-active')) {
				
				$(tr).removeClass('table-active');
				$(tr).find('.open-hours,.open-minutes,.open-ampm,.closed-hours,.closed-minutes,.closed-ampm').removeAttr('readonly');
			} else {
				
				$(tr).addClass('table-active');
				$(tr).find('.open-hours,.open-minutes,.open-ampm,.closed-hours,.closed-minutes,.closed-ampm').attr('readonly','true');
			}
		}
	},
	computed: {

	},
	created() {
		this.days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];

	},
	mounted() {

	}
});

$(document).ready(function() {
	stores.events();
});
stores = {
	events: function() {

	}
}