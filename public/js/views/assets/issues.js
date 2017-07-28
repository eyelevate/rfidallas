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
/******/ 	return __webpack_require__(__webpack_require__.s = 292);
/******/ })
/************************************************************************/
/******/ ({

/***/ 292:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(293);


/***/ }),

/***/ 293:
/***/ (function(module, exports) {

var app = new Vue({
	el: '#root',
	props: [],
	data: {
		eEmail: '',
		eFirstName: '',
		eLastName: '',
		eId: ''
	},
	methods: {},
	computed: {},
	created: function created() {
		console.log('1st');
	},
	mounted: function mounted() {
		console.log('2nd');
	}
});

$(document).ready(function () {
	issues.events();
});

issues = {
	events: function events() {
		$(document).on("click", ".select-employee", function () {
			var id = $(this).attr('employee-id');
			var email = $(this).attr('employee-email');
			var first_name = $(this).attr('employee-first-name');
			var last_name = $(this).attr('employee-last-name');
			var string = email + ' (' + first_name + ' ' + last_name + ')';
			var tr = $(this).parents('tr:first');
			var tbody = $(this).parents('tbody:first');
			var element = $(this).parents('.modalA:first');
			// remove all previous instances of a table row class
			tbody.find('tr').removeClass('table-info');
			tr.addClass('table-info');

			element.find('.claimedConfirmedInput').val(string);
			element.find('.claimedInput').val(id);
		});
	}
};

/***/ })

/******/ });