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
/******/ 	return __webpack_require__(__webpack_require__.s = 290);
/******/ })
/************************************************************************/
/******/ ({

/***/ 290:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(291);


/***/ }),

/***/ 291:
/***/ (function(module, exports) {



$(document).ready(function () {
	charts.fill();
});

charts = {
	fill: function fill() {
		// get fee info from server and post it to form
		axios.get('/apis/charts/admins-index').then(function (response) {
			// set variables
			var data = response.data.chart1;
			var options = charts.options('simple', data);
			// First Chart Row

			// Customers
			var ctx = $('#card-chart1');
			var cardChart1 = charts.make(ctx, data, options);

			// Employees
			data = response.data.chart2;
			options = charts.options('simple', data);
			var ctx = $('#card-chart2');
			var cardChart2 = charts.make(ctx, data, options);

			// Managers
			data = response.data.chart3;
			options = charts.options('simple', data);
			var ctx = $('#card-chart3');
			var cardChart3 = charts.make(ctx, data, options);

			// Partners
			data = response.data.chart4;
			console.log(data);
			options = charts.options('simple', data);
			var ctx = $('#card-chart4');
			var cardChart3 = charts.make(ctx, data, options);
		});
	},
	make: function make(ctx, data, options) {
		return new Chart(ctx, {
			type: data.type,
			data: {
				labels: data.labels,
				datasets: [{
					label: data.datasets.label,
					backgroundColor: data.datasets.backgroundColor,
					borderColor: data.datasets.borderColor,
					data: data.datasets.data
				}]
			},
			options: options
		});
	},
	options: function options(type, data) {
		var options = {};
		switch (type) {
			case 'simple':
				var options = {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					scales: {
						xAxes: [{
							gridLines: {
								color: 'transparent',
								zeroLineColor: 'transparent'
							},
							ticks: {
								fontSize: 2,
								fontColor: 'transparent'
							}

						}],
						yAxes: [{
							display: false,
							ticks: {
								display: false,
								min: Math.min.apply(Math, data.datasets.data) - 5,
								max: Math.max.apply(Math, data.datasets.data) + 5
							}
						}]
					},
					elements: {
						line: {
							borderWidth: 1
						},
						point: {
							radius: 4,
							hitRadius: 10,
							hoverRadius: 4
						}
					}
				};
				break;
			default:
				// statements_def
				break;
		}

		return options;
	}
};

/***/ })

/******/ });