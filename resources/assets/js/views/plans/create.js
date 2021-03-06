const app = new Vue({
	el: '#root',

	data() {
		return {
			// Cancel Fees
			cancelFeeCount: 0,
			cancelFeeSubtotal: 0,
			cancelFee: [],
			// Post Fees
			postFeeCount: 0,
			postFeeSubtotal: 0,
			postFee: [],
			//pre fees
			preFeeCount: 0,
			preFeeSubtotal: 0,
			preFee: [],
			//service
			serviceCount: 0,
			serviceSubtotal: 0,
			service: []
		}
		
	},
	methods: {
		/** 
		* Cancel FEE section
		*/
		getCancelFeeData(fee_id){
			var check_fee = true;
			// check if fee is inside array
			this.cancelFee.forEach( function(v, k) {
				if (v.id == fee_id) {
					check_fee = false;

				}	
			});
			if (check_fee) {
				// get fee info from server and post it to form
				axios.post('/fees/retrieve',{fee_id:fee_id}).then(response => {
					response.data['inputName'] = 'cancelFeePlan['+response.data.id+']';
					this.cancelFee.push(response.data);
					this.cancelFeeCount = this.cancelFee.length;
					this.calculateCancelFees();
				});
				
			} else {
				alert('This fee has already been included in the Cancel-fee table. Please review the table.');
			}
			
			
		},
		removeCancelFeeRow(fee_id){
			// create a new object for editing
			somearray = this.cancelFee;
			somearray.forEach(function(v, k){
				if (v.id == fee_id) { // If id matches then delete the row from array
					somearray.splice(k,1);
					$('tbody tr').find('.select-cancel-fee[fee-id="'+fee_id+'"]').parents('tr:first').removeClass('table-info');
				}
			});
			// reestablish the reactivity and set the label for the count
			this.cancelFee = somearray;
			this.cancelFeeCount = this.cancelFee.length;
			this.calculateCancelFees();

		},
		calculateCancelFees(){
			sum = 0; // start base sum
			this.cancelFee.forEach(function(v, k){ //iterate through array to get total sum
				sum += parseFloat(v.pretax); 
			});

			$("#cancel").val(sum.toFixed(2)); // add sum to input
			this.cancelFeeSubtotal = sum.toFixed(2);
		},

		/** 
		* POST FEE section
		*/
		getPostFeeData(fee_id){
			var check_fee = true;
			// check if fee is inside array
			this.postFee.forEach( function(v, k) {
				if (v.id == fee_id) {
					check_fee = false;

				}	
			});
			if (check_fee) {
				// get fee info from server and post it to form
				axios.post('/fees/retrieve',{fee_id:fee_id}).then(response => {
					response.data['inputName'] = 'postFeePlan['+response.data.id+']';
					this.postFee.push(response.data);
					this.postFeeCount = this.postFee.length;
					this.calculatePostFees();
				});
				
			} else {
				alert('This fee has already been included in the Post-fee table. Please review the table.');
			}
			
			
		},
		removePostFeeRow(fee_id){
			// create a new object for editing
			somearray = this.postFee;
			somearray.forEach(function(v, k){
				if (v.id == fee_id) { // If id matches then delete the row from array
					somearray.splice(k,1);
					$('tbody tr').find('.select-post-fee[fee-id="'+fee_id+'"]').parents('tr:first').removeClass('table-info');
				}
			});
			// reestablish the reactivity and set the label for the count
			this.postFee = somearray;
			this.postFeeCount = this.postFee.length;
			this.calculatePostFees();

		},
		calculatePostFees(){
			sum = 0; // start base sum
			this.postFee.forEach(function(v, k){ //iterate through array to get total sum
				sum += parseFloat(v.pretax); 
			});

			$("#post").val(sum.toFixed(2)); // add sum to input
			this.postFeeSubtotal = sum.toFixed(2);
		},

		/**
		* Pre FEE Section
		*/
		getFeeData(fee_id){
			var check_fee = true;
			// check if fee is inside array
			this.preFee.forEach( function(v, k) {
				if (v.id == fee_id) {
					check_fee = false;

				}	
			});
			if (check_fee) {
				// get fee info from server and post it to form
				axios.post('/fees/retrieve',{fee_id:fee_id}).then(response => {
					response.data['inputName'] = 'preFeePlan['+response.data.id+']';
					this.preFee.push(response.data);
					this.preFeeCount = this.preFee.length;
					this.calculatePreFees();
				});
				
			} else {
				alert('This fee has already been included in the Pre-fee table. Please review the table.');
			}
			
			
		},
		removePreFeeRow(fee_id){
			// create a new object for editing
			somearray = this.preFee;
			somearray.forEach(function(v, k){
				if (v.id == fee_id) { // If id matches then delete the row from array
					somearray.splice(k,1);
					$('tbody tr').find('.select-pre-fee[fee-id="'+fee_id+'"]').parents('tr:first').removeClass('table-info');
				}
			});
			// reestablish the reactivity and set the label for the count
			this.preFee = somearray;
			this.preFeeCount = this.preFee.length;
			this.calculatePreFees();

		},
		calculatePreFees(){
			sum = 0; // start base sum
			this.preFee.forEach(function(v, k){ //iterate through array to get total sum
				sum += parseFloat(v.pretax); 
			});

			$("#pre").val(sum.toFixed(2)); // add sum to input
			this.preFeeSubtotal = sum.toFixed(2);
		},

		/*
		* SERVICE section
		*/
		getServiceData(service_id){
			var check_service = true;
			// check if fee is inside array
			this.service.forEach( function(v, k) {
				if (v.id == service_id) {
					check_service = false;

				}	
			});
			if (check_service) {
				// get fee info from server and post it to form
				axios.post('/services/retrieve',{service_id:service_id}).then(response => {
					response.data['inputName'] = 'planService['+response.data.id+']';
					this.service.push(response.data);
					this.serviceCount = this.service.length;
					this.calculateServices();
				});
				
			} else {
				alert('This service has already been included in the Subscriptions table. Please review the table.');
			}
			
			
		},
		removeServiceRow(service_id){
		
			// create a new object for editing
			somearray = this.service;
			somearray.forEach(function(v, k){
				console.log(v);
				if (v.id == service_id) { // If id matches then delete the row from array
					somearray.splice(k,1);
					
					$('tbody tr').find('.select-service[service-id="'+service_id+'"]').parents('tr:first').removeClass('table-info');
				}
			});
			// reestablish the reactivity and set the label for the count
			this.service = somearray;
			this.serviceCount = this.service.length;
			this.calculateServices();

		},
		calculateServices(){
			sum = 0; // start base sum
			this.service.forEach(function(v, k){ //iterate through array to get total sum
				sum += parseFloat(v.monthly); 
			});

			$("#price").val(sum.toFixed(2)); // add sum to input
			this.servicesSubtotal = sum.toFixed(2);
		}

	},
	computed: {
		calculateFees(){
			console.log('starting calculation man hold on');
		}
	},
	created() {
	},
	mounted() {

	}
});


$(document).ready(function(){
	create.events();
});

create = {
	events: function() {
		// cancel
		$( document ).on( "click", ".select-cancel-fee" ,function() {
			var fee_id = $(this).attr('fee-id');
			// update pre total table
			app.getCancelFeeData(fee_id);

			// highlight the row
			$(this).parents('tr:first').addClass('table-info');

		});

		// Pre fee
		$( document ).on( "click", ".select-pre-fee" ,function() {
			var fee_id = $(this).attr('fee-id');
			// update pre total table
			app.getFeeData(fee_id);

			// highlight the row
			$(this).parents('tr:first').addClass('table-info');

		});
		// Pricing - services - subscription
		$( document ).on( "click", ".select-service" ,function() {
			var service_id = $(this).attr('service-id');
			// update pre total table
			app.getServiceData(service_id);

			// highlight the row
			$(this).parents('tr:first').addClass('table-info');

		});
		// post fee
		$( document ).on( "click", ".select-post-fee" ,function() {
			var fee_id = $(this).attr('fee-id');
			// update pre total table
			app.getPostFeeData(fee_id);

			// highlight the row
			$(this).parents('tr:first').addClass('table-info');

		});

		$("#start-date").datepicker();

		$("#end-date").datepicker();

	}
};