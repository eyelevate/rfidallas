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
/******/ 	return __webpack_require__(__webpack_require__.s = 287);
/******/ })
/************************************************************************/
/******/ ({

/***/ 287:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(288);


/***/ }),

/***/ 288:
/***/ (function(module, exports) {

var app = new Vue({
	el: '#root',

	data: function data() {
		return {
			users: [],
			user: [],
			companies: [],
			company: [],
			companyCount: 0,
			company_id: '',
			company_name: '',
			serial: '',
			serials: [],
			assets: []
		};
	},

	methods: {
		displayCompanies: function displayCompanies(user_id) {
			// get fee info from server and post it to form
			companies = this.companies;
			company = [];
			if (this.users.length > 0) {
				this.users.forEach(function (v, k) {
					if (parseInt(v.id) == parseInt(user_id)) {
						this.user = v;
						if (companies.length > 0) {
							companies.forEach(function (cv, ck) {
								if (parseInt(cv.user_id) == parseInt(user_id)) {
									company[ck] = cv;
								}
							});
						}
					}
				});
			}
			this.companyCount = company.length;
			this.company = $.makeArray(company);
		},
		setCompany: function setCompany(obj) {
			this.company.push(obj);
		},
		setVariables: function setVariables(users, companies) {
			this.company = [];
			this.users = users;
			this.companies = companies;
		},
		selectCompanyFromUser: function selectCompanyFromUser(company_id) {

			this.company_id = company_id;
			companies = this.companies;
			company_name = '';
			//get company info
			if (companies.length > 0) {
				companies.forEach(function (v, k) {
					if (parseInt(v.id) == parseInt(company_id)) {
						company_name = v.name + ' (' + v.nick_name + ')';
					}
				});
			}

			$("#usersSelect").addClass('active');
			$("#companiesSelect").removeClass('active');
			$("#nav-select-users").addClass('active');
			$("#nav-select-company").removeClass('active');
			$("#userModal").modal('hide');
			this.company = [];
			this.user = [];
			this.company_name = company_name;
		},
		selectCompany: function selectCompany(company_id) {
			this.company_id = company_id;
			companies = this.companies;
			company_name = '';
			//get company info
			if (companies.length > 0) {
				companies.forEach(function (v, k) {
					if (parseInt(v.id) == parseInt(company_id)) {
						company_name = v.name + ' (' + v.nick_name + ')';
					}
				});
			}
			$("#companyModal").modal('hide');
			this.company = [];
			this.company_name = company_name;
		},
		serialSubmit: function serialSubmit() {
			var _this = this;

			serial = this.serial;
			serials = this.serials;
			if (!serials.includes(serial)) {

				if (this.company_id == '') {
					alert('You must select a company before submitting an asset for deployment! Please try again.');
				} else {
					// get fee info from server and post it to form
					axios.post('/asset-items/update/deploy', { serial: this.serial, company_id: this.company_id }).then(function (response) {
						var status = response.data.status;
						if (status == 'fail') {
							alert('No such serial number exists in our system. Please try again or create the asset.');
						} else {
							_this.assets.push(response.data.data);
							_this.serials.push(_this.serial);
							_this.serial = '';
						}
					});
				}
			} else {
				alert('You have already deployed this asset in this session. Please try again.');
			}
		},
		undoAsset: function undoAsset(asset_id) {
			var _this2 = this;

			// get fee info from server and post it to form
			axios.post('/asset-items/undo/deploy', { asset_id: asset_id }).then(function (response) {
				var status = response.data.status;
				if (status == 'fail') {
					alert(response.data.reason);
				} else {
					// remove assets
					assets = _this2.assets;
					if (assets.length > 0) {
						assets.forEach(function (v, k) {
							if (String(v.id) == String(asset_id)) {
								assets.splice(k, 1);
							}
						});
					}
					_this2.assets = assets;
					var serial_index = _this2.serials.indexOf(response.data.data.serial);
					if (serial_index > -1) {
						_this2.serials.splice(serial_index, 1);
					}
					// remove serials
					_this2.serial = '';

					// remove parent tr
					_this2.$parent.tr.$remove();
				}
			});
		}
	},
	computed: {},
	created: function created() {},
	mounted: function mounted() {}
});

$(document).ready(function () {
	deploy.variables();
	deploy.events();
});

deploy = {
	events: function events() {
		$(document).on('click', '.select-customer', function () {
			var user_id = $(this).attr('customer-id');
			app.displayCompanies(user_id);
			$("#usersSelect").removeClass('active');
			$("#companiesSelect").addClass('active');
			$("#nav-select-users").removeClass('active');
			$("#nav-select-company").addClass('active');
		});

		$(document).on('click', '.select-company', function () {
			var company_id = $(this).attr('company-id');
			console.log(company_id);
			app.selectCompany(company_id);
		});
	},
	variables: function variables() {
		var usersData = JSON.parse($('#get-users-data').val());
		var companyData = JSON.parse($('#get-companies-data').val());
		app.setVariables(usersData, companyData);
	}
};

/***/ })

/******/ });