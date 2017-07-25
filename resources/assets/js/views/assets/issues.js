const app = new Vue({
	el: '#root',
	props: [],
	data: {
		eEmail: '',
		eFirstName: '',
		eLastName: '',
		eId: ''
	},
	methods: {
	},
	computed: {

	},
	created() {
		console.log('1st');
	},
	mounted() {
		console.log('2nd');
	}
});

$(document).ready(function(){
	issues.events();
});

issues = {
	events: function() {
		$( document ).on( "click", ".select-employee" ,function() {
			var id = $(this).attr('employee-id');
			var email = $(this).attr('employee-email');
			var first_name = $(this).attr('employee-first-name');
			var last_name = $(this).attr('employee-last-name');
			var string = email+' ('+first_name+' '+last_name+')';
			let tr = $(this).parents('tr:first');
			let tbody = $(this).parents('tbody:first');
			let element = $(this).parents('.modalA:first');
			// remove all previous instances of a table row class
			tbody.find('tr').removeClass('table-info');
			tr.addClass('table-info');

			element.find('.claimedConfirmedInput').val(string);
			element.find('.claimedInput').val(id);

		});
	}
}
