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
/******/ 	return __webpack_require__(__webpack_require__.s = 268);
/******/ })
/************************************************************************/
/******/ ({

/***/ 268:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(269);


/***/ }),

/***/ 269:
/***/ (function(module, exports) {

var app = new Vue({
  el: '#root',
  data: {
    columns: [{
      label: 'Name',
      field: 'name',
      filterable: true
    }, {
      label: 'Age',
      field: 'age',
      type: 'number',
      html: false,
      filterable: true
    }, {
      label: 'Created On',
      field: 'createdAt',
      type: 'date',
      inputFormat: 'YYYYMMDD',
      outputFormat: 'MMM Do YY'
    }, {
      label: 'Percent',
      field: 'score',
      type: 'percentage',
      html: false
    }],
    rows: [{ id: 1, name: "John", age: 20, createdAt: '201-10-31:9:35 am', score: 0.03343 }, { id: 2, name: "Jane", age: 24, createdAt: '2011-10-31', score: 0.03343 }, { id: 3, name: "Susan", age: 16, createdAt: '2011-10-30', score: 0.03343 }, { id: 4, name: "Chris", age: 55, createdAt: '2011-10-11', score: 0.03343 }, { id: 5, name: "Dan", age: 40, createdAt: '2011-10-21', score: 0.03343 }, { id: 6, name: "John", age: 20, createdAt: '2011-10-31', score: 0.03343 }, { id: 7, name: "Jane", age: 24, createdAt: '20111031' }, { id: 8, name: "Susan", age: 16, createdAt: '2013-10-31', score: 0.03343 }, { id: 9, name: "Chris", age: 55, createdAt: '2012-10-31', score: 0.03343 }, { id: 10, name: "Dan", age: 40, createdAt: '2011-10-31', score: 0.03343 }, { id: 11, name: "John", age: 20, createdAt: '2011-10-31', score: 0.03343 }, { id: 12, name: "Jane", age: 24, createdAt: '2011-07-31', score: 0.03343 }, { id: 13, name: "Susan", age: 16, createdAt: '2017-02-28', score: 0.03343 }, { id: 14, name: "Chris", age: 55, createdAt: '', score: 0.03343 }, { id: 15, name: "Dan", age: 40, createdAt: '2011-10-31', score: 0.03343 }, { id: 16, name: "Chris", age: 55, createdAt: '2011-10-31', score: 0.03343 }, { id: 17, name: "Dan", age: 40, createdAt: '2011-10-31', score: 0.03343 }, { id: 18, name: "John", age: 20, createdAt: '201-10-31:9:35 am', score: 0.03343 }, { id: 19, name: "Jane", age: 24, createdAt: '2011-10-31', score: 0.03343 }, { id: 20, name: "Susan", age: 16, createdAt: '2011-10-30', score: 0.03343 }, { id: 21, name: "Chris", age: 55, createdAt: '2011-10-11', score: 0.03343 }, { id: 22, name: "Dan", age: 40, createdAt: '2011-10-21', score: 0.03343 }, { id: 23, name: "John", age: 20, createdAt: '2011-10-31', score: 0.03343 }, { id: 24, name: "Jane", age: 24, createdAt: '20111031' }, { id: 25, name: "Susan", age: 16, createdAt: '2013-10-31', score: 0.03343 }, { id: 26, name: "Chris", age: 55, createdAt: '2012-10-31', score: 0.03343 }, { id: 27, name: "Dan", age: 40, createdAt: '2011-10-31', score: 0.03343 }, { id: 28, name: "John", age: 20, createdAt: '2011-10-31', score: 0.03343 }, { id: 29, name: "Jane", age: 24, createdAt: '2011-07-31', score: 0.03343 }, { id: 30, name: "Susan", age: 16, createdAt: '2017-02-28', score: 0.03343 }, { id: 31, name: "Chris", age: 55, createdAt: '', score: 0.03343 }, { id: 32, name: "Dan", age: 40, createdAt: '2011-10-31', score: 0.03343 }, { id: 33, name: "Chris", age: 55, createdAt: '2011-10-31', score: 0.03343 }, { id: 34, name: "Dan", age: 40, createdAt: '2011-10-31', score: 0.03343 }]
  },
  methods: {},
  computed: {},
  created: function created() {},
  mounted: function mounted() {}
});

/***/ })

/******/ });