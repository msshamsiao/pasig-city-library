/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/***/ (() => {

throw new Error("Module build failed (from ./node_modules/mini-css-extract-plugin/dist/loader.js):\nModuleBuildError: Module build failed (from ./node_modules/postcss-loader/dist/cjs.js):\n/shared/httpd/library/postcss.config.cjs:1\nexport default {\n^^^^^^\n\nSyntaxError: Unexpected token 'export'\n    at Object.compileFunction (node:vm:352:18)\n    at wrapSafe (node:internal/modules/cjs/loader:1033:15)\n    at Module._compile (node:internal/modules/cjs/loader:1069:27)\n    at Object.Module._extensions..js (node:internal/modules/cjs/loader:1159:10)\n    at Module.load (node:internal/modules/cjs/loader:981:32)\n    at Function.Module._load (node:internal/modules/cjs/loader:822:12)\n    at Module.require (node:internal/modules/cjs/loader:1005:19)\n    at module.exports (/shared/httpd/library/node_modules/import-fresh/index.js:32:59)\n    at loadJs (/shared/httpd/library/node_modules/cosmiconfig/dist/loaders.js:16:18)\n    at Explorer.loadFileContent (/shared/httpd/library/node_modules/cosmiconfig/dist/Explorer.js:84:32)\n    at Explorer.createCosmiconfigResult (/shared/httpd/library/node_modules/cosmiconfig/dist/Explorer.js:89:36)\n    at Explorer.loadSearchPlace (/shared/httpd/library/node_modules/cosmiconfig/dist/Explorer.js:70:31)\n    at async Explorer.searchDirectory (/shared/httpd/library/node_modules/cosmiconfig/dist/Explorer.js:55:27)\n    at async run (/shared/httpd/library/node_modules/cosmiconfig/dist/Explorer.js:35:22)\n    at async cacheWrapper (/shared/httpd/library/node_modules/cosmiconfig/dist/cacheWrapper.js:16:18)\n    at async cacheWrapper (/shared/httpd/library/node_modules/cosmiconfig/dist/cacheWrapper.js:16:18)\n    at async cacheWrapper (/shared/httpd/library/node_modules/cosmiconfig/dist/cacheWrapper.js:16:18)\n    at async Explorer.search (/shared/httpd/library/node_modules/cosmiconfig/dist/Explorer.js:27:20)\n    at async loadConfig (/shared/httpd/library/node_modules/postcss-loader/dist/utils.js:68:16)\n    at async Object.loader (/shared/httpd/library/node_modules/postcss-loader/dist/index.js:54:22)\n    at processResult (/shared/httpd/library/node_modules/webpack/lib/NormalModule.js:764:19)\n    at /shared/httpd/library/node_modules/webpack/lib/NormalModule.js:866:5\n    at /shared/httpd/library/node_modules/loader-runner/lib/LoaderRunner.js:400:11\n    at /shared/httpd/library/node_modules/loader-runner/lib/LoaderRunner.js:252:18\n    at context.callback (/shared/httpd/library/node_modules/loader-runner/lib/LoaderRunner.js:124:13)\n    at Object.loader (/shared/httpd/library/node_modules/postcss-loader/dist/index.js:56:7)");

/***/ }),

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
Object(function webpackMissingModule() { var e = new Error("Cannot find module './bootstrap'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The require scope
/******/ 	var __webpack_require__ = {};
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	__webpack_modules__["./resources/js/app.js"](0, {}, __webpack_require__);
/******/ 	// This entry module doesn't tell about it's top-level declarations so it can't be inlined
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/sass/app.scss"](0, __webpack_exports__, __webpack_require__);
/******/ 	
/******/ })()
;