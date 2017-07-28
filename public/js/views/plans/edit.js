/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 299);
/******/ })
/************************************************************************/
/******/ ({

/***/ 299:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(300);


/***/ }),

/***/ 300:
/***/ (function(module, exports) {

var app = new Vue({
	el: '#root',

	data: function data() {
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
		};
	},

	methods: {
		/** 
  * Cancel FEE section
  */
		getCancelFeeData: function getCancelFeeData(fee_id) {
			var _this = this;

			var check_fee = true;
			// check if fee is inside array
			this.cancelFee.forEach(function (v, k) {
				if (v.id == fee_id) {
					check_fee = false;
				}
			});
			if (check_fee) {
				// get fee info from server and post it to form
				axios.post('/fees/retrieve', { fee_id: fee_id }).then(function (response) {
					response.data['inputName'] = 'cancelFeePlan[' + response.data.id + ']';
					_this.cancelFee.push(response.data);
					_this.cancelFeeCount = _this.cancelFee.length;
					_this.calculateCancelFees();
				});
			} else {
				alert('This fee has already been included in the Cancel-fee table. Please review the table.');
			}
		},
		removeCancelFeeRow: function removeCancelFeeRow(fee_id) {
			// create a new object for editing
			somearray = this.cancelFee;
			somearray.forEach(function (v, k) {
				if (v.id == fee_id) {
					// If id matches then delete the row from array
					somearray.splice(k, 1);
					$('tbody tr').find('.select-cancel-fee[fee-id="' + fee_id + '"]').parents('tr:first').removeClass('table-info');
				}
			});
			// reestablish the reactivity and set the label for the count
			this.cancelFee = somearray;
			this.cancelFeeCount = this.cancelFee.length;
			this.calculateCancelFees();
		},
		calculateCancelFees: function calculateCancelFees() {
			sum = 0; // start base sum
			this.cancelFee.forEach(function (v, k) {
				//iterate through array to get total sum
				sum += parseFloat(v.pretax);
			});

			$("#cancel").val(sum.toFixed(2)); // add sum to input
			this.cancelFeeSubtotal = sum.toFixed(2);
		},


		/** 
  * POST FEE section
  */
		getPostFeeData: function getPostFeeData(fee_id) {
			var _this2 = this;

			var check_fee = true;
			// check if fee is inside array
			this.postFee.forEach(function (v, k) {
				if (v.id == fee_id) {
					check_fee = false;
				}
			});
			if (check_fee) {
				// get fee info from server and post it to form
				axios.post('/fees/retrieve', { fee_id: fee_id }).then(function (response) {
					response.data['inputName'] = 'postFeePlan[' + response.data.id + ']';
					_this2.postFee.push(response.data);
					_this2.postFeeCount = _this2.postFee.length;
					_this2.calculatePostFees();
				});
			} else {
				alert('This fee has already been included in the Post-fee table. Please review the table.');
			}
		},
		removePostFeeRow: function removePostFeeRow(fee_id) {
			// create a new object for editing
			somearray = this.postFee;
			somearray.forEach(function (v, k) {
				if (v.id == fee_id) {
					// If id matches then delete the row from array
					somearray.splice(k, 1);
					$('tbody tr').find('.select-post-fee[fee-id="' + fee_id + '"]').parents('tr:first').removeClass('table-info');
				}
			});
			// reestablish the reactivity and set the label for the count
			this.postFee = somearray;
			this.postFeeCount = this.postFee.length;
			this.calculatePostFees();
		},
		calculatePostFees: function calculatePostFees() {
			sum = 0; // start base sum
			this.postFee.forEach(function (v, k) {
				//iterate through array to get total sum
				sum += parseFloat(v.pretax);
			});

			$("#post").val(sum.toFixed(2)); // add sum to input
			this.postFeeSubtotal = sum.toFixed(2);
		},


		/**
  * Pre FEE Section
  */
		getFeeData: function getFeeData(fee_id) {
			var _this3 = this;

			var check_fee = true;
			// check if fee is inside array
			this.preFee.forEach(function (v, k) {
				if (v.id == fee_id) {
					check_fee = false;
				}
			});
			if (check_fee) {
				// get fee info from server and post it to form
				axios.post('/fees/retrieve', { fee_id: fee_id }).then(function (response) {
					response.data['inputName'] = 'preFeePlan[' + response.data.id + ']';
					_this3.preFee.push(response.data);
					_this3.preFeeCount = _this3.preFee.length;
					_this3.calculatePreFees();
				});
			} else {
				alert('This fee has already been included in the Pre-fee table. Please review the table.');
			}
		},
		removePreFeeRow: function removePreFeeRow(fee_id) {
			// create a new object for editing
			somearray = this.preFee;
			somearray.forEach(function (v, k) {
				if (v.id == fee_id) {
					// If id matches then delete the row from array
					somearray.splice(k, 1);
					$('tbody tr').find('.select-pre-fee[fee-id="' + fee_id + '"]').parents('tr:first').removeClass('table-info');
				}
			});
			// reestablish the reactivity and set the label for the count
			this.preFee = somearray;
			this.preFeeCount = this.preFee.length;
			this.calculatePreFees();
		},
		calculatePreFees: function calculatePreFees() {
			sum = 0; // start base sum
			this.preFee.forEach(function (v, k) {
				//iterate through array to get total sum
				sum += parseFloat(v.pretax);
			});

			$("#pre").val(sum.toFixed(2)); // add sum to input
			this.preFeeSubtotal = sum.toFixed(2);
		},


		/*
  * SERVICE section
  */
		getServiceData: function getServiceData(service_id) {
			var _this4 = this;

			var check_service = true;
			// check if fee is inside array
			this.service.forEach(function (v, k) {
				if (v.id == service_id) {
					check_service = false;
				}
			});
			if (check_service) {
				// get fee info from server and post it to form
				axios.post('/services/retrieve', { service_id: service_id }).then(function (response) {
					response.data['inputName'] = 'planService[' + response.data.id + ']';
					_this4.service.push(response.data);
					_this4.serviceCount = _this4.service.length;
					_this4.calculateServices();
				});
			} else {
				alert('This service has already been included in the Subscriptions table. Please review the table.');
			}
		},
		removeServiceRow: function removeServiceRow(service_id) {

			// create a new object for editing
			somearray = this.service;
			somearray.forEach(function (v, k) {
				console.log(v);
				if (v.id == service_id) {
					// If id matches then delete the row from array
					somearray.splice(k, 1);

					$('tbody tr').find('.select-service[service-id="' + service_id + '"]').parents('tr:first').removeClass('table-info');
				}
			});
			// reestablish the reactivity and set the label for the count
			this.service = somearray;
			this.serviceCount = this.service.length;
			this.calculateServices();
		},
		calculateServices: function calculateServices() {
			sum = 0; // start base sum
			this.service.forEach(function (v, k) {
				//iterate through array to get total sum
				sum += parseFloat(v.monthly);
			});

			$("#price").val(sum.toFixed(2)); // add sum to input
			this.servicesSubtotal = sum.toFixed(2);
		},
		setVariables: function setVariables(cancel, pre, post, service) {

			//cancel
			this.cancelFee = cancel;
			this.cancelFeeCount = cancel.length;
			this.calculateCancelFees();
			// Post Fees
			this.postFee = post;
			this.postFeeCount = post.length;
			this.calculatePostFees();
			//pre fees
			this.preFee = pre;
			this.preFeeCount = pre.length;
			this.calculatePreFees();
			//service
			this.service = service;
			this.serviceCount = service.length;
			this.calculateServices();
		}
	},
	computed: {
		calculateFees: function calculateFees() {
			console.log('starting calculation man hold on');
		}
	},
	created: function created() {},
	mounted: function mounted() {}
});

$(document).ready(function () {
	edit.preload();
	edit.variables();
	edit.events();
});

edit = {
	preload: function preload() {},
	variables: function variables() {
		var cancelFeeData = JSON.parse($('#get-cancel-fee-data').val());
		var preFeeData = JSON.parse($('#get-pre-fee-data').val());
		var postFeeData = JSON.parse($('#get-post-fee-data').val());
		var serviceFeeData = JSON.parse($('#get-service-fee-data').val());
		app.setVariables(cancelFeeData, preFeeData, postFeeData, serviceFeeData);
		cancelFeeData.forEach(function (v, k) {
			cancel_id = v.id;
			$(".select-cancel-fee[fee-id='" + cancel_id + "']").parents('tr:first').addClass('table-info');
		});
		preFeeData.forEach(function (v, k) {
			pre_id = v.id;
			$(".select-pre-fee[fee-id='" + pre_id + "']").parents('tr:first').addClass('table-info');
		});
		postFeeData.forEach(function (v, k) {
			post_id = v.id;
			$(".select-post-fee[fee-id='" + post_id + "']").parents('tr:first').addClass('table-info');
		});
		serviceFeeData.forEach(function (v, k) {
			service_id = v.id;
			$(".select-service[service-id='" + service_id + "']").parents('tr:first').addClass('table-info');
		});
	},
	events: function events() {

		// cancel
		$(document).on("click", ".select-cancel-fee", function () {
			var fee_id = $(this).attr('fee-id');
			// update pre total table
			app.getCancelFeeData(fee_id);

			// highlight the row
			$(this).parents('tr:first').addClass('table-info');
		});

		// Pre fee
		$(document).on("click", ".select-pre-fee", function () {
			var fee_id = $(this).attr('fee-id');
			// update pre total table
			app.getFeeData(fee_id);

			// highlight the row
			$(this).parents('tr:first').addClass('table-info');
		});
		// Pricing - services - subscription
		$(document).on("click", ".select-service", function () {
			var service_id = $(this).attr('service-id');
			// update pre total table
			app.getServiceData(service_id);

			// highlight the row
			$(this).parents('tr:first').addClass('table-info');
		});
		// post fee
		$(document).on("click", ".select-post-fee", function () {
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

/***/ })

/******/ });