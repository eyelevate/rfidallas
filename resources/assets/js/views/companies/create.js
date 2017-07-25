$(document).ready(function(){
	create.events();
});

create = {
	events: function() {
		$( document ).on( "click", ".select-employee" ,function() {
			var id = $(this).attr('employee-id');
			var email = $(this).attr('employee-email');
			var first_name = $(this).attr('employee-first-name');
			var last_name = $(this).attr('employee-last-name');
			var string = email+' ('+first_name+' '+last_name+')';

			// Add to form
			$('#user-display').val(string);
			$('#user-id-hidden-input').val(id);

			// close modal
			$("#closeModal").click();

		});
	}
};