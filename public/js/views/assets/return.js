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
/******/ 	return __webpack_require__(__webpack_require__.s = 296);
/******/ })
/************************************************************************/
/******/ ({

/***/ 296:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(297);


/***/ }),

/***/ 297:
/***/ (function(module, exports) {

var app = new Vue({
	el: '#root',

	data: function data() {
		return {
			serial: '',
			serials: [],
			assets: []
		};
	},

	methods: {
		serialSubmit: function serialSubmit() {
			var _this = this;

			serial = this.serial;
			serials = this.serials;
			if (!serials.includes(serial)) {

				// get fee info from server and post it to form
				axios.post('/asset-items/update/return', { serial: this.serial }).then(function (response) {
					var status = response.data.status;
					if (status == 'fail') {
						alert('No such serial number exists in our system. Please try again or create the asset.');
					} else {
						_this.assets.push(response.data.data);
						_this.serials.push(_this.serial);
						_this.serial = '';
					}
				});
			} else {
				alert('You have already returned this asset in this session. Please move on to the next asset.');
			}
		},
		undoAsset: function undoAsset(asset_id) {
			var _this2 = this;

			console.log('youu clicked here');
			// get company id of last issued item
			assets = this.assets;
			last_company_id = '';
			if (assets.length > 0) {
				assets.forEach(function (v, k) {
					if (String(v.id) == String(asset_id)) {
						last_company_id = v.company_id;
					}
				});
			}

			// get fee info from server and post it to form
			axios.post('/asset-items/undo/return', { asset_id: asset_id, company_id: last_company_id }).then(function (response) {
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

/***/ })

/******/ });