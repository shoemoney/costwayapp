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
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
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
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/TrackCostWayProduct.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/TrackCostWayProduct.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var file_saver__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! file-saver */ "./node_modules/file-saver/dist/FileSaver.min.js");
/* harmony import */ var file_saver__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(file_saver__WEBPACK_IMPORTED_MODULE_0__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data() {
    return {
      product: {},
      productSlug: ""
    };
  },
  methods: {
    productDetails: function productDetails() {
      var _this = this;

      axios.get("/costway/product/".concat(this.productSlug)).then(function (_ref) {
        var data = _ref.data;
        _this.product = data;
      });
    },
    downloadImages: function downloadImages(images) {
      images.forEach(function (image) {
        Object(file_saver__WEBPACK_IMPORTED_MODULE_0__["saveAs"])(image, image.replace("https://www.costway.co.uk/media/catalog/product/cache/1/", ""));
      });
    },
    trackProduct: function trackProduct() {
      var _this2 = this;

      axios.post("/costway/product", {
        identifier: this.productSlug,
        name: this.product.title,
        description: this.product.description,
        price: this.product.price,
        currency: this.product.currency,
        images: this.product.images,
        stock: this.product.stock,
        rating: this.product.rating,
        reviews: this.product.reviews
      }).then(function (response) {
        _this2.$toasted.show("Product tracked.", {
          theme: "bubble",
          position: "bottom-center",
          duration: 1500
        });
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/TrackedProducts.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/TrackedProducts.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _views_TrackCostWayProduct_vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../views/TrackCostWayProduct.vue */ "./resources/js/views/TrackCostWayProduct.vue");
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  components: {
    TrackCostWayProduct: _views_TrackCostWayProduct_vue__WEBPACK_IMPORTED_MODULE_0__["default"]
  },
  props: {
    getProducts: Array,
    totalTracked: Number,
    inStockCount: Number,
    outOfStockCount: Number
  },
  data: function data() {
    return {};
  },
  methods: {
    productDetails: function productDetails(product) {
      bus.$emit("product", product);
    },
    openTrackProductModal: function openTrackProductModal() {
      this.$modal.show("track-product-modal");
    }
  },
  computed: {
    products: function products() {
      return this.getProducts;
    }
  }
});

/***/ }),

/***/ "./node_modules/file-saver/dist/FileSaver.min.js":
/*!*******************************************************!*\
  !*** ./node_modules/file-saver/dist/FileSaver.min.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(global) {var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;(function(a,b){if(true)!(__WEBPACK_AMD_DEFINE_ARRAY__ = [], __WEBPACK_AMD_DEFINE_FACTORY__ = (b),
				__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
				(__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));else {}})(this,function(){"use strict";function b(a,b){return"undefined"==typeof b?b={autoBom:!1}:"object"!=typeof b&&(console.warn("Deprecated: Expected third argument to be a object"),b={autoBom:!b}),b.autoBom&&/^\s*(?:text\/\S*|application\/xml|\S*\/\S*\+xml)\s*;.*charset\s*=\s*utf-8/i.test(a.type)?new Blob(["\uFEFF",a],{type:a.type}):a}function c(b,c,d){var e=new XMLHttpRequest;e.open("GET",b),e.responseType="blob",e.onload=function(){a(e.response,c,d)},e.onerror=function(){console.error("could not download file")},e.send()}function d(a){var b=new XMLHttpRequest;b.open("HEAD",a,!1);try{b.send()}catch(a){}return 200<=b.status&&299>=b.status}function e(a){try{a.dispatchEvent(new MouseEvent("click"))}catch(c){var b=document.createEvent("MouseEvents");b.initMouseEvent("click",!0,!0,window,0,0,0,80,20,!1,!1,!1,!1,0,null),a.dispatchEvent(b)}}var f="object"==typeof window&&window.window===window?window:"object"==typeof self&&self.self===self?self:"object"==typeof global&&global.global===global?global:void 0,a=f.saveAs||("object"!=typeof window||window!==f?function(){}:"download"in HTMLAnchorElement.prototype?function(b,g,h){var i=f.URL||f.webkitURL,j=document.createElement("a");g=g||b.name||"download",j.download=g,j.rel="noopener","string"==typeof b?(j.href=b,j.origin===location.origin?e(j):d(j.href)?c(b,g,h):e(j,j.target="_blank")):(j.href=i.createObjectURL(b),setTimeout(function(){i.revokeObjectURL(j.href)},4E4),setTimeout(function(){e(j)},0))}:"msSaveOrOpenBlob"in navigator?function(f,g,h){if(g=g||f.name||"download","string"!=typeof f)navigator.msSaveOrOpenBlob(b(f,h),g);else if(d(f))c(f,g,h);else{var i=document.createElement("a");i.href=f,i.target="_blank",setTimeout(function(){e(i)})}}:function(a,b,d,e){if(e=e||open("","_blank"),e&&(e.document.title=e.document.body.innerText="downloading..."),"string"==typeof a)return c(a,b,d);var g="application/octet-stream"===a.type,h=/constructor/i.test(f.HTMLElement)||f.safari,i=/CriOS\/[\d]+/.test(navigator.userAgent);if((i||g&&h)&&"object"==typeof FileReader){var j=new FileReader;j.onloadend=function(){var a=j.result;a=i?a:a.replace(/^data:[^;]*;/,"data:attachment/file;"),e?e.location.href=a:location=a,e=null},j.readAsDataURL(a)}else{var k=f.URL||f.webkitURL,l=k.createObjectURL(a);e?e.location=l:location.href=l,e=null,setTimeout(function(){k.revokeObjectURL(l)},4E4)}});f.saveAs=a.saveAs=a, true&&(module.exports=a)});

//# sourceMappingURL=FileSaver.min.js.map
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./../../webpack/buildin/global.js */ "./node_modules/webpack/buildin/global.js")))

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/TrackCostWayProduct.vue?vue&type=template&id=9b95d0ee&":
/*!*****************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/TrackCostWayProduct.vue?vue&type=template&id=9b95d0ee& ***!
  \*****************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "flex overflow-hidden bg-cool-gray-100" }, [
    _c("main", { staticClass: "flex-1 relative pb-8 z-0 overflow-y-auto" }, [
      _c("div", { staticClass: "mt-2 mx-6" }, [
        _c(
          "div",
          {
            staticClass:
              "bg-white shadow overflow-hidden sm:rounded-lg m-auto w-full "
          },
          [
            _c("div", { staticClass: "w-full flex rounded-md shadow-sm" }, [
              _c(
                "span",
                {
                  staticClass:
                    "p-3 inline-flex items-center px-3 rounded-none border-solid text-gray-500 sm:text-sm"
                },
                [_vm._v("\n            https://costway.co.uk/\n          ")]
              ),
              _vm._v(" "),
              _c("input", {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model",
                    value: _vm.productSlug,
                    expression: "productSlug"
                  }
                ],
                staticClass:
                  "flex-1 form-input block w-full min-w-0 border-solid rounded-none sm:text-sm sm:leading-5",
                attrs: {
                  id: "search",
                  placeholder:
                    "2500w-oil-filled-electric-timer-thermostat-11-fin-heater"
                },
                domProps: { value: _vm.productSlug },
                on: {
                  keyup: _vm.productDetails,
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.productSlug = $event.target.value
                  }
                }
              })
            ]),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "px-4 py-5 border-b border-gray-200 sm:px-6" },
              [
                _c(
                  "h3",
                  {
                    staticClass: "text-lg leading-6 font-medium text-gray-900"
                  },
                  [_vm._v("Product Information")]
                ),
                _vm._v(" "),
                !_vm._.isEmpty(_vm.product)
                  ? _c(
                      "button",
                      {
                        staticClass:
                          "relative inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150",
                        attrs: { type: "button" },
                        on: { click: _vm.trackProduct }
                      },
                      [
                        _c(
                          "svg",
                          {
                            staticClass: "-ml-1 mr-2 h-5 w-5",
                            attrs: {
                              viewBox: "0 0 20 20",
                              fill: "currentColor"
                            }
                          },
                          [
                            _c("path", {
                              attrs: {
                                "fill-rule": "evenodd",
                                d:
                                  "M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z",
                                "clip-rule": "evenodd"
                              }
                            })
                          ]
                        ),
                        _vm._v(" "),
                        _c("span", [_vm._v("Track")])
                      ]
                    )
                  : _vm._e(),
                _vm._v(" "),
                _c("p", {
                  staticClass: "mt-1 max-w-2xl text-sm leading-5 text-gray-500",
                  domProps: { textContent: _vm._s(_vm.product.productSlug) }
                })
              ]
            ),
            _vm._v(" "),
            _c("div", { staticClass: "px-4 py-5 sm:p-0" }, [
              _c("dl", [
                _c(
                  "div",
                  {
                    staticClass:
                      "sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 sm:py-5"
                  },
                  [
                    _c(
                      "dt",
                      {
                        staticClass:
                          "text-sm leading-5 font-medium text-gray-500"
                      },
                      [_vm._v("Title")]
                    ),
                    _vm._v(" "),
                    _c(
                      "dd",
                      {
                        staticClass:
                          "mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"
                      },
                      [
                        _c("span", {
                          domProps: { textContent: _vm._s(_vm.product.title) }
                        })
                      ]
                    )
                  ]
                ),
                _vm._v(" "),
                _c(
                  "div",
                  {
                    staticClass:
                      "mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5"
                  },
                  [
                    _c(
                      "dt",
                      {
                        staticClass:
                          "text-sm leading-5 font-medium text-gray-500"
                      },
                      [_vm._v("Condition")]
                    ),
                    _vm._v(" "),
                    _c(
                      "dd",
                      {
                        staticClass:
                          "mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"
                      },
                      [
                        _c("span", {
                          domProps: {
                            textContent: _vm._s(_vm.product.condition)
                          }
                        })
                      ]
                    )
                  ]
                ),
                _vm._v(" "),
                _c(
                  "div",
                  {
                    staticClass:
                      "mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5"
                  },
                  [
                    _c(
                      "dt",
                      {
                        staticClass:
                          "text-sm leading-5 font-medium text-gray-500"
                      },
                      [_vm._v("Stock")]
                    ),
                    _vm._v(" "),
                    _c(
                      "dd",
                      {
                        staticClass:
                          "mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"
                      },
                      [
                        _c("span", {
                          domProps: { textContent: _vm._s(_vm.product.stock) }
                        })
                      ]
                    )
                  ]
                ),
                _vm._v(" "),
                _c(
                  "div",
                  {
                    staticClass:
                      "mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5"
                  },
                  [
                    _c(
                      "dt",
                      {
                        staticClass:
                          "text-sm leading-5 font-medium text-gray-500"
                      },
                      [_vm._v("£")]
                    ),
                    _vm._v(" "),
                    _c(
                      "dd",
                      {
                        staticClass:
                          "mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"
                      },
                      [
                        _c("span", {
                          domProps: { textContent: _vm._s(_vm.product.price) }
                        })
                      ]
                    )
                  ]
                ),
                _vm._v(" "),
                _c(
                  "div",
                  {
                    staticClass:
                      "mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5"
                  },
                  [
                    _c(
                      "dt",
                      {
                        staticClass:
                          "text-sm leading-5 font-medium text-gray-500"
                      },
                      [_vm._v("Description")]
                    ),
                    _vm._v(" "),
                    _c(
                      "dd",
                      {
                        staticClass:
                          "mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"
                      },
                      [
                        _c("span", {
                          domProps: {
                            textContent: _vm._s(_vm.product.description)
                          }
                        })
                      ]
                    )
                  ]
                ),
                _vm._v(" "),
                _c(
                  "div",
                  {
                    staticClass:
                      "mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5"
                  },
                  [
                    _c(
                      "dt",
                      {
                        staticClass:
                          "text-sm leading-5 font-medium text-gray-500"
                      },
                      [_vm._v("Attachments")]
                    ),
                    _vm._v(" "),
                    _c(
                      "dd",
                      {
                        staticClass:
                          "mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"
                      },
                      [
                        _c(
                          "ul",
                          { staticClass: "border border-gray-200 rounded-md" },
                          _vm._l(_vm.product.images, function(image, index) {
                            return _c(
                              "li",
                              {
                                staticClass:
                                  "pl-3 pr-4 py-3 flex items-center justify-between text-sm leading-5"
                              },
                              [
                                _c(
                                  "div",
                                  {
                                    staticClass: "w-0 flex-1 flex items-center"
                                  },
                                  [
                                    _c(
                                      "svg",
                                      {
                                        staticClass:
                                          "flex-shrink-0 h-5 w-5 text-gray-400",
                                        attrs: {
                                          viewBox: "0 0 20 20",
                                          fill: "currentColor"
                                        }
                                      },
                                      [
                                        _c("path", {
                                          attrs: {
                                            "fill-rule": "evenodd",
                                            d:
                                              "M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z",
                                            "clip-rule": "evenodd"
                                          }
                                        })
                                      ]
                                    ),
                                    _vm._v(" "),
                                    _c(
                                      "a",
                                      {
                                        attrs: { href: image, target: "_blank" }
                                      },
                                      [
                                        _c("img", {
                                          staticClass:
                                            "ml-2 flex-1 w-32 truncate",
                                          attrs: { src: image }
                                        })
                                      ]
                                    )
                                  ]
                                ),
                                _vm._v(" "),
                                _c(
                                  "div",
                                  { staticClass: "ml-4 flex-shrink-0" },
                                  [
                                    _c(
                                      "a",
                                      {
                                        attrs: { href: image, target: "_blank" }
                                      },
                                      [
                                        _vm._v(
                                          "\n                          Download\n                        "
                                        )
                                      ]
                                    )
                                  ]
                                )
                              ]
                            )
                          }),
                          0
                        )
                      ]
                    )
                  ]
                )
              ])
            ])
          ]
        )
      ])
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/TrackedProducts.vue?vue&type=template&id=2f3c26df&":
/*!*************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/TrackedProducts.vue?vue&type=template&id=2f3c26df& ***!
  \*************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    { staticClass: "flex overflow-hidden" },
    [
      _c(
        "modal",
        {
          staticClass: "flex justify-center absolute overflow-y-scroll",
          attrs: {
            name: "track-product-modal",
            width: 1100,
            height: 600,
            transition: "pop-out"
          }
        },
        [_c("div", [_c("track-cost-way-product")], 1)]
      ),
      _vm._v(" "),
      _c(
        "div",
        {
          staticClass: "flex-1 overflow-auto focus:outline-none",
          attrs: { tabindex: "0" }
        },
        [
          _c(
            "main",
            { staticClass: "flex-1 relative pb-8 z-0 overflow-y-auto" },
            [
              _c("div", { staticClass: "mt-8" }, [
                _c(
                  "div",
                  { staticClass: "max-w-6xl mx-auto px-4 sm:px-6 lg:px-8" },
                  [
                    _c(
                      "h2",
                      {
                        staticClass:
                          "text-lg leading-6 font-medium text-cool-gray-900"
                      },
                      [_vm._v("Overview")]
                    ),
                    _vm._v(" "),
                    _c(
                      "button",
                      {
                        staticClass:
                          "relative inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150",
                        attrs: { type: "button" },
                        on: { click: _vm.openTrackProductModal }
                      },
                      [
                        _c(
                          "svg",
                          {
                            staticClass: "-ml-1 mr-2 h-5 w-5",
                            attrs: {
                              viewBox: "0 0 20 20",
                              fill: "currentColor"
                            }
                          },
                          [
                            _c("path", {
                              attrs: {
                                "fill-rule": "evenodd",
                                d:
                                  "M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z",
                                "clip-rule": "evenodd"
                              }
                            })
                          ]
                        ),
                        _vm._v(" "),
                        _c("span", [_vm._v("Track Product")])
                      ]
                    ),
                    _vm._v(" "),
                    _c(
                      "div",
                      {
                        staticClass:
                          "mt-2 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3"
                      },
                      [
                        _c(
                          "div",
                          {
                            staticClass:
                              "bg-white overflow-hidden shadow rounded-lg"
                          },
                          [
                            _c("div", { staticClass: "p-5" }, [
                              _c("div", { staticClass: "flex items-center" }, [
                                _c("div", { staticClass: "flex-shrink-0" }, [
                                  _c(
                                    "svg",
                                    {
                                      staticClass: "h-6 w-6 text-cool-gray-400",
                                      attrs: {
                                        fill: "none",
                                        viewBox: "0 0 24 24",
                                        stroke: "currentColor"
                                      }
                                    },
                                    [
                                      _c("path", {
                                        attrs: {
                                          "stroke-linecap": "round",
                                          "stroke-linejoin": "round",
                                          "stroke-width": "2",
                                          d:
                                            "M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"
                                        }
                                      })
                                    ]
                                  )
                                ]),
                                _vm._v(" "),
                                _c("div", { staticClass: "ml-5 w-0 flex-1" }, [
                                  _c("dl", [
                                    _c(
                                      "dt",
                                      {
                                        staticClass:
                                          "text-sm leading-5 font-medium text-cool-gray-500 truncate"
                                      },
                                      [
                                        _vm._v(
                                          "\n                        Tracked\n                      "
                                        )
                                      ]
                                    ),
                                    _vm._v(" "),
                                    _c("dd", [
                                      _c(
                                        "div",
                                        {
                                          staticClass:
                                            "text-lg leading-7 font-medium text-cool-gray-900"
                                        },
                                        [
                                          _c("span", {
                                            domProps: {
                                              textContent: _vm._s(
                                                _vm.totalTracked
                                              )
                                            }
                                          })
                                        ]
                                      )
                                    ])
                                  ])
                                ])
                              ])
                            ])
                          ]
                        ),
                        _vm._v(" "),
                        _c(
                          "div",
                          {
                            staticClass:
                              "bg-white overflow-hidden shadow rounded-lg"
                          },
                          [
                            _c("div", { staticClass: "p-5" }, [
                              _c("div", { staticClass: "flex items-center" }, [
                                _c("div", { staticClass: "flex-shrink-0" }, [
                                  _c(
                                    "svg",
                                    {
                                      staticClass: "h-6 w-6 text-cool-gray-400",
                                      attrs: {
                                        fill: "none",
                                        viewBox: "0 0 24 24",
                                        stroke: "currentColor"
                                      }
                                    },
                                    [
                                      _c("path", {
                                        attrs: {
                                          "stroke-linecap": "round",
                                          "stroke-linejoin": "round",
                                          "stroke-width": "2",
                                          d:
                                            "M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"
                                        }
                                      })
                                    ]
                                  )
                                ]),
                                _vm._v(" "),
                                _c("div", { staticClass: "ml-5 w-0 flex-1" }, [
                                  _c("dl", [
                                    _c(
                                      "dt",
                                      {
                                        staticClass:
                                          "text-sm leading-5 font-medium text-cool-gray-500 truncate"
                                      },
                                      [
                                        _vm._v(
                                          "\n                        Instock\n                      "
                                        )
                                      ]
                                    ),
                                    _vm._v(" "),
                                    _c("dd", [
                                      _c(
                                        "div",
                                        {
                                          staticClass:
                                            "text-lg leading-7 font-medium text-cool-gray-900"
                                        },
                                        [
                                          _c("span", {
                                            domProps: {
                                              textContent: _vm._s(
                                                _vm.inStockCount
                                              )
                                            }
                                          })
                                        ]
                                      )
                                    ])
                                  ])
                                ])
                              ])
                            ])
                          ]
                        ),
                        _vm._v(" "),
                        _c(
                          "div",
                          {
                            staticClass:
                              "bg-white overflow-hidden shadow rounded-lg"
                          },
                          [
                            _c("div", { staticClass: "p-5" }, [
                              _c("div", { staticClass: "flex items-center" }, [
                                _c("div", { staticClass: "flex-shrink-0" }, [
                                  _c(
                                    "svg",
                                    {
                                      staticClass: "h-6 w-6 text-cool-gray-400",
                                      attrs: {
                                        fill: "none",
                                        viewBox: "0 0 24 24",
                                        stroke: "currentColor"
                                      }
                                    },
                                    [
                                      _c("path", {
                                        attrs: {
                                          "stroke-linecap": "round",
                                          "stroke-linejoin": "round",
                                          "stroke-width": "2",
                                          d:
                                            "M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"
                                        }
                                      })
                                    ]
                                  )
                                ]),
                                _vm._v(" "),
                                _c("div", { staticClass: "ml-5 w-0 flex-1" }, [
                                  _c("dl", [
                                    _c(
                                      "dt",
                                      {
                                        staticClass:
                                          "text-sm leading-5 font-medium text-cool-gray-500 truncate"
                                      },
                                      [
                                        _vm._v(
                                          "\n                        Out of Stock\n                      "
                                        )
                                      ]
                                    ),
                                    _vm._v(" "),
                                    _c("dd", [
                                      _c(
                                        "div",
                                        {
                                          staticClass:
                                            "text-lg leading-7 font-medium text-cool-gray-900"
                                        },
                                        [
                                          _c("span", {
                                            domProps: {
                                              textContent: _vm._s(
                                                _vm.outOfStockCount
                                              )
                                            }
                                          })
                                        ]
                                      )
                                    ])
                                  ])
                                ])
                              ])
                            ])
                          ]
                        )
                      ]
                    )
                  ]
                ),
                _vm._v(" "),
                _c("div", { staticClass: "shadow sm:hidden" }, [
                  _c(
                    "ul",
                    {
                      staticClass:
                        "mt-2 divide-y divide-cool-gray-200 overflow-hidden shadow sm:hidden"
                    },
                    [
                      _c("li", [
                        _c(
                          "a",
                          {
                            staticClass:
                              "block px-4 py-4 bg-white hover:bg-cool-gray-50",
                            attrs: { href: "#" }
                          },
                          [
                            _c(
                              "div",
                              { staticClass: "flex items-center space-x-4" },
                              [
                                _c(
                                  "div",
                                  {
                                    staticClass:
                                      "flex-1 flex space-x-2 truncate"
                                  },
                                  [
                                    _c(
                                      "svg",
                                      {
                                        staticClass:
                                          "flex-shrink-0 h-5 w-5 text-cool-gray-400",
                                        attrs: {
                                          viewBox: "0 0 20 20",
                                          fill: "currentColor"
                                        }
                                      },
                                      [
                                        _c("path", {
                                          attrs: {
                                            "fill-rule": "evenodd",
                                            d:
                                              "M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z",
                                            "clip-rule": "evenodd"
                                          }
                                        })
                                      ]
                                    ),
                                    _vm._v(" "),
                                    _vm._m(0)
                                  ]
                                ),
                                _vm._v(" "),
                                _c("div", [
                                  _c(
                                    "svg",
                                    {
                                      staticClass:
                                        "flex-shrink-0 h-5 w-5 text-cool-gray-400",
                                      attrs: {
                                        viewBox: "0 0 20 20",
                                        fill: "currentColor"
                                      }
                                    },
                                    [
                                      _c("path", {
                                        attrs: {
                                          "fill-rule": "evenodd",
                                          d:
                                            "M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z",
                                          "clip-rule": "evenodd"
                                        }
                                      })
                                    ]
                                  )
                                ])
                              ]
                            )
                          ]
                        )
                      ])
                    ]
                  ),
                  _vm._v(" "),
                  _vm._m(1)
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "hidden sm:block" }, [
                  _c(
                    "div",
                    { staticClass: "max-w-6xl mx-auto px-4 sm:px-6 lg:px-8" },
                    [
                      _c("div", { staticClass: "flex flex-col mt-2" }, [
                        _c(
                          "div",
                          {
                            staticClass:
                              "align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg"
                          },
                          [
                            _c(
                              "table",
                              {
                                staticClass:
                                  "min-w-full divide-y divide-cool-gray-200"
                              },
                              [
                                _vm._m(2),
                                _vm._v(" "),
                                _c(
                                  "tbody",
                                  {
                                    staticClass:
                                      "bg-white divide-y divide-cool-gray-200"
                                  },
                                  _vm._l(_vm.products, function(tracked) {
                                    return _c(
                                      "tr",
                                      { staticClass: "bg-white" },
                                      [
                                        _c(
                                          "td",
                                          {
                                            staticClass:
                                              "max-w-0 w-full px-6 py-4 whitespace-no-wrap text-sm leading-5 text-cool-gray-900"
                                          },
                                          [
                                            _c("div", { staticClass: "flex" }, [
                                              _c(
                                                "a",
                                                {
                                                  staticClass:
                                                    "group inline-flex space-x-2 truncate text-sm leading-5",
                                                  attrs: { href: "#" }
                                                },
                                                [
                                                  _c(
                                                    "svg",
                                                    {
                                                      staticClass:
                                                        "flex-shrink-0 h-5 w-5 text-cool-gray-400 group-hover:text-cool-gray-500 transition ease-in-out duration-150",
                                                      attrs: {
                                                        viewBox: "0 0 20 20",
                                                        fill: "currentColor"
                                                      }
                                                    },
                                                    [
                                                      _c("path", {
                                                        attrs: {
                                                          "fill-rule":
                                                            "evenodd",
                                                          d:
                                                            "M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z",
                                                          "clip-rule": "evenodd"
                                                        }
                                                      })
                                                    ]
                                                  ),
                                                  _vm._v(" "),
                                                  _c("p", {
                                                    staticClass:
                                                      "text-cool-gray-500 truncate group-hover:text-cool-gray-900 transition ease-in-out duration-150",
                                                    domProps: {
                                                      textContent: _vm._s(
                                                        tracked.product[0].name
                                                      )
                                                    }
                                                  })
                                                ]
                                              )
                                            ])
                                          ]
                                        ),
                                        _vm._v(" "),
                                        _c(
                                          "td",
                                          {
                                            staticClass:
                                              "px-6 py-4 text-right whitespace-no-wrap text-sm leading-5 text-cool-gray-500"
                                          },
                                          [
                                            _c("span", {
                                              staticClass:
                                                "text-cool-gray-900 font-medium",
                                              domProps: {
                                                textContent: _vm._s(
                                                  tracked.product[0].price
                                                )
                                              }
                                            }),
                                            _vm._v(" "),
                                            _c("span", {
                                              domProps: {
                                                textContent: _vm._s(
                                                  tracked.product[0].currency
                                                )
                                              }
                                            })
                                          ]
                                        ),
                                        _vm._v(" "),
                                        _c(
                                          "td",
                                          {
                                            staticClass:
                                              "hidden px-6 py-4 whitespace-no-wrap text-sm leading-5 text-cool-gray-500 md:block"
                                          },
                                          [
                                            _c(
                                              "span",
                                              {
                                                staticClass:
                                                  "inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-green-100 text-green-800 capitalize"
                                              },
                                              [
                                                _c("span", {
                                                  domProps: {
                                                    textContent: _vm._s(
                                                      tracked.product[0]
                                                        .metrics[0]["value"]
                                                    )
                                                  }
                                                })
                                              ]
                                            )
                                          ]
                                        ),
                                        _vm._v(" "),
                                        _c(
                                          "td",
                                          {
                                            staticClass:
                                              "px-6 py-4 text-right whitespace-no-wrap text-sm leading-5 text-cool-gray-500"
                                          },
                                          [
                                            _c("span", {
                                              domProps: {
                                                textContent: _vm._s(
                                                  tracked.product[0].updated_at
                                                )
                                              }
                                            })
                                          ]
                                        )
                                      ]
                                    )
                                  }),
                                  0
                                )
                              ]
                            ),
                            _vm._v(" "),
                            _c(
                              "nav",
                              {
                                staticClass:
                                  "bg-white px-4 py-3 flex items-center justify-between border-t border-cool-gray-200 sm:px-6"
                              },
                              [
                                _c("div", { staticClass: "hidden sm:block" }, [
                                  _c(
                                    "p",
                                    {
                                      staticClass:
                                        "text-sm leading-5 text-cool-gray-700"
                                    },
                                    [
                                      _vm._v(
                                        "\n                      Showing\n                      "
                                      ),
                                      _c(
                                        "span",
                                        { staticClass: "font-medium" },
                                        [_vm._v("1")]
                                      ),
                                      _vm._v(
                                        "\n                      to\n                      "
                                      ),
                                      _c(
                                        "span",
                                        { staticClass: "font-medium" },
                                        [_vm._v("10")]
                                      ),
                                      _vm._v(
                                        "\n                      of\n                      "
                                      ),
                                      _c(
                                        "span",
                                        { staticClass: "font-medium" },
                                        [
                                          _c("span", {
                                            domProps: {
                                              textContent: _vm._s(
                                                _vm.totalTracked
                                              )
                                            }
                                          })
                                        ]
                                      ),
                                      _vm._v(
                                        "\n                      results\n                    "
                                      )
                                    ]
                                  )
                                ]),
                                _vm._v(" "),
                                _vm._m(3)
                              ]
                            )
                          ]
                        )
                      ])
                    ]
                  )
                ])
              ])
            ]
          )
        ]
      )
    ],
    1
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "text-cool-gray-500 text-sm truncate" }, [
      _c("p", { staticClass: "truncate" }, [
        _vm._v("Payment to Molly Sanders")
      ]),
      _vm._v(" "),
      _c("p", [
        _c("span", { staticClass: "text-cool-gray-900 font-medium" }, [
          _vm._v("$20,000")
        ]),
        _vm._v(" USD")
      ]),
      _vm._v(" "),
      _c("p", [_vm._v("July 11, 2020")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c(
      "nav",
      {
        staticClass:
          "bg-white px-4 py-3 flex items-center justify-between border-t border-cool-gray-200"
      },
      [
        _c("div", { staticClass: "flex-1 flex justify-between" }, [
          _c(
            "a",
            {
              staticClass:
                "relative inline-flex items-center px-4 py-2 border border-cool-gray-300 text-sm leading-5 font-medium rounded-md text-cool-gray-700 bg-white hover:text-cool-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-cool-gray-100 active:text-cool-gray-700 transition ease-in-out duration-150",
              attrs: { href: "#" }
            },
            [_vm._v("\n                Previous\n              ")]
          ),
          _vm._v(" "),
          _c(
            "a",
            {
              staticClass:
                "ml-3 relative inline-flex items-center px-4 py-2 border border-cool-gray-300 text-sm leading-5 font-medium rounded-md text-cool-gray-700 bg-white hover:text-cool-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-cool-gray-100 active:text-cool-gray-700 transition ease-in-out duration-150",
              attrs: { href: "#" }
            },
            [_vm._v("\n                Next\n              ")]
          )
        ])
      ]
    )
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("thead", [
      _c("tr", [
        _c(
          "th",
          {
            staticClass:
              "px-6 py-3 bg-cool-gray-50 text-left text-xs leading-4 font-medium text-cool-gray-500 uppercase tracking-wider"
          },
          [_vm._v("\n                        Product\n                      ")]
        ),
        _vm._v(" "),
        _c(
          "th",
          {
            staticClass:
              "px-6 py-3 bg-cool-gray-50 text-right text-xs leading-4 font-medium text-cool-gray-500 uppercase tracking-wider"
          },
          [_vm._v("\n                        Cost\n                      ")]
        ),
        _vm._v(" "),
        _c(
          "th",
          {
            staticClass:
              "hidden px-6 py-3 bg-cool-gray-50 text-left text-xs leading-4 font-medium text-cool-gray-500 uppercase tracking-wider md:block"
          },
          [_vm._v("\n                        Status\n                      ")]
        ),
        _vm._v(" "),
        _c(
          "th",
          {
            staticClass:
              "px-6 py-3 bg-cool-gray-50 text-right text-xs leading-4 font-medium text-cool-gray-500 uppercase tracking-wider"
          },
          [_vm._v("\n                        Date\n                      ")]
        )
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c(
      "div",
      { staticClass: "flex-1 flex justify-between sm:justify-end" },
      [
        _c(
          "a",
          {
            staticClass:
              "relative inline-flex items-center px-4 py-2 border border-cool-gray-300 text-sm leading-5 font-medium rounded-md text-cool-gray-700 bg-white hover:text-cool-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-cool-gray-100 active:text-cool-gray-700 transition ease-in-out duration-150",
            attrs: { href: "#" }
          },
          [_vm._v("\n                      Previous\n                    ")]
        ),
        _vm._v(" "),
        _c(
          "a",
          {
            staticClass:
              "ml-3 relative inline-flex items-center px-4 py-2 border border-cool-gray-300 text-sm leading-5 font-medium rounded-md text-cool-gray-700 bg-white hover:text-cool-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-cool-gray-100 active:text-cool-gray-700 transition ease-in-out duration-150",
            attrs: { href: "#" }
          },
          [_vm._v("\n                      Next\n                    ")]
        )
      ]
    )
  }
]
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js":
/*!********************************************************************!*\
  !*** ./node_modules/vue-loader/lib/runtime/componentNormalizer.js ***!
  \********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return normalizeComponent; });
/* globals __VUE_SSR_CONTEXT__ */

// IMPORTANT: Do NOT use ES2015 features in this file (except for modules).
// This module is a runtime utility for cleaner component module output and will
// be included in the final webpack user bundle.

function normalizeComponent (
  scriptExports,
  render,
  staticRenderFns,
  functionalTemplate,
  injectStyles,
  scopeId,
  moduleIdentifier, /* server only */
  shadowMode /* vue-cli only */
) {
  // Vue.extend constructor export interop
  var options = typeof scriptExports === 'function'
    ? scriptExports.options
    : scriptExports

  // render functions
  if (render) {
    options.render = render
    options.staticRenderFns = staticRenderFns
    options._compiled = true
  }

  // functional template
  if (functionalTemplate) {
    options.functional = true
  }

  // scopedId
  if (scopeId) {
    options._scopeId = 'data-v-' + scopeId
  }

  var hook
  if (moduleIdentifier) { // server build
    hook = function (context) {
      // 2.3 injection
      context =
        context || // cached call
        (this.$vnode && this.$vnode.ssrContext) || // stateful
        (this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext) // functional
      // 2.2 with runInNewContext: true
      if (!context && typeof __VUE_SSR_CONTEXT__ !== 'undefined') {
        context = __VUE_SSR_CONTEXT__
      }
      // inject component styles
      if (injectStyles) {
        injectStyles.call(this, context)
      }
      // register component module identifier for async chunk inferrence
      if (context && context._registeredComponents) {
        context._registeredComponents.add(moduleIdentifier)
      }
    }
    // used by ssr in case component is cached and beforeCreate
    // never gets called
    options._ssrRegister = hook
  } else if (injectStyles) {
    hook = shadowMode
      ? function () { injectStyles.call(this, this.$root.$options.shadowRoot) }
      : injectStyles
  }

  if (hook) {
    if (options.functional) {
      // for template-only hot-reload because in that case the render fn doesn't
      // go through the normalizer
      options._injectStyles = hook
      // register for functioal component in vue file
      var originalRender = options.render
      options.render = function renderWithStyleInjection (h, context) {
        hook.call(context)
        return originalRender(h, context)
      }
    } else {
      // inject component registration as beforeCreate hook
      var existing = options.beforeCreate
      options.beforeCreate = existing
        ? [].concat(existing, hook)
        : [hook]
    }
  }

  return {
    exports: scriptExports,
    options: options
  }
}


/***/ }),

/***/ "./node_modules/webpack/buildin/global.js":
/*!***********************************!*\
  !*** (webpack)/buildin/global.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

var g;

// This works in non-strict mode
g = (function() {
	return this;
})();

try {
	// This works if eval is allowed (see CSP)
	g = g || new Function("return this")();
} catch (e) {
	// This works if the window reference is available
	if (typeof window === "object") g = window;
}

// g can still be undefined, but nothing to do about it...
// We return undefined, instead of nothing here, so it's
// easier to handle this case. if(!global) { ...}

module.exports = g;


/***/ }),

/***/ "./resources/js/products/track_products.js":
/*!*************************************************!*\
  !*** ./resources/js/products/track_products.js ***!
  \*************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _views_TrackedProducts_vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../views/TrackedProducts.vue */ "./resources/js/views/TrackedProducts.vue");
/* harmony import */ var _views_TrackCostWayProduct_vue__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../views/TrackCostWayProduct.vue */ "./resources/js/views/TrackCostWayProduct.vue");
window.bus = new Vue({});


var trackProducts = new Vue({
  components: {
    TrackedProducts: _views_TrackedProducts_vue__WEBPACK_IMPORTED_MODULE_0__["default"],
    TrackCostWayProduct: _views_TrackCostWayProduct_vue__WEBPACK_IMPORTED_MODULE_1__["default"]
  },
  el: '#track_products',
  data: {
    product: {}
  },
  mounted: function mounted() {
    this.getProductDetails;
  },
  computed: {
    getProductDetails: function getProductDetails() {
      var _this = this;

      bus.$on('product', function (product) {
        _this.product = product;
      });
    }
  }
});

/***/ }),

/***/ "./resources/js/views/TrackCostWayProduct.vue":
/*!****************************************************!*\
  !*** ./resources/js/views/TrackCostWayProduct.vue ***!
  \****************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _TrackCostWayProduct_vue_vue_type_template_id_9b95d0ee___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./TrackCostWayProduct.vue?vue&type=template&id=9b95d0ee& */ "./resources/js/views/TrackCostWayProduct.vue?vue&type=template&id=9b95d0ee&");
/* harmony import */ var _TrackCostWayProduct_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./TrackCostWayProduct.vue?vue&type=script&lang=js& */ "./resources/js/views/TrackCostWayProduct.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _TrackCostWayProduct_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _TrackCostWayProduct_vue_vue_type_template_id_9b95d0ee___WEBPACK_IMPORTED_MODULE_0__["render"],
  _TrackCostWayProduct_vue_vue_type_template_id_9b95d0ee___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/TrackCostWayProduct.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/views/TrackCostWayProduct.vue?vue&type=script&lang=js&":
/*!*****************************************************************************!*\
  !*** ./resources/js/views/TrackCostWayProduct.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_TrackCostWayProduct_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./TrackCostWayProduct.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/TrackCostWayProduct.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_TrackCostWayProduct_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/TrackCostWayProduct.vue?vue&type=template&id=9b95d0ee&":
/*!***********************************************************************************!*\
  !*** ./resources/js/views/TrackCostWayProduct.vue?vue&type=template&id=9b95d0ee& ***!
  \***********************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_TrackCostWayProduct_vue_vue_type_template_id_9b95d0ee___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./TrackCostWayProduct.vue?vue&type=template&id=9b95d0ee& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/TrackCostWayProduct.vue?vue&type=template&id=9b95d0ee&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_TrackCostWayProduct_vue_vue_type_template_id_9b95d0ee___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_TrackCostWayProduct_vue_vue_type_template_id_9b95d0ee___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/views/TrackedProducts.vue":
/*!************************************************!*\
  !*** ./resources/js/views/TrackedProducts.vue ***!
  \************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _TrackedProducts_vue_vue_type_template_id_2f3c26df___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./TrackedProducts.vue?vue&type=template&id=2f3c26df& */ "./resources/js/views/TrackedProducts.vue?vue&type=template&id=2f3c26df&");
/* harmony import */ var _TrackedProducts_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./TrackedProducts.vue?vue&type=script&lang=js& */ "./resources/js/views/TrackedProducts.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _TrackedProducts_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _TrackedProducts_vue_vue_type_template_id_2f3c26df___WEBPACK_IMPORTED_MODULE_0__["render"],
  _TrackedProducts_vue_vue_type_template_id_2f3c26df___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/TrackedProducts.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/views/TrackedProducts.vue?vue&type=script&lang=js&":
/*!*************************************************************************!*\
  !*** ./resources/js/views/TrackedProducts.vue?vue&type=script&lang=js& ***!
  \*************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_TrackedProducts_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./TrackedProducts.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/TrackedProducts.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_TrackedProducts_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/TrackedProducts.vue?vue&type=template&id=2f3c26df&":
/*!*******************************************************************************!*\
  !*** ./resources/js/views/TrackedProducts.vue?vue&type=template&id=2f3c26df& ***!
  \*******************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_TrackedProducts_vue_vue_type_template_id_2f3c26df___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./TrackedProducts.vue?vue&type=template&id=2f3c26df& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/TrackedProducts.vue?vue&type=template&id=2f3c26df&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_TrackedProducts_vue_vue_type_template_id_2f3c26df___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_TrackedProducts_vue_vue_type_template_id_2f3c26df___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ 1:
/*!*******************************************************!*\
  !*** multi ./resources/js/products/track_products.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/joshuacallis/web/costwayapp/resources/js/products/track_products.js */"./resources/js/products/track_products.js");


/***/ })

/******/ });