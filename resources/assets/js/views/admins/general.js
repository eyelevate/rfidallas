$(document).ready(function(){
	bootstrap.events();
});

bootstrap = {
	events: function() {
		$('div.alert').not('.alert-important').delay(3000).fadeOut(350);

		$('.table-responsive').on('show.bs.dropdown', function () {
		     $('.table-responsive').css( "overflow", "inherit" );
		});

		$('.table-responsive').on('hide.bs.dropdown', function () {
		     $('.table-responsive').css( "overflow", "auto" );
		});
	}
};