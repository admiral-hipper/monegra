(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[6],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/LinearPartnershipProgram.vue?vue&type=script&lang=js&":
/*!***********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/LinearPartnershipProgram.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var core_js_modules_es_array_filter__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.array.filter */ "./node_modules/core-js/modules/es.array.filter.js");
/* harmony import */ var core_js_modules_es_array_filter__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_filter__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var core_js_modules_es_array_map__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! core-js/modules/es.array.map */ "./node_modules/core-js/modules/es.array.map.js");
/* harmony import */ var core_js_modules_es_array_map__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_map__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var core_js_modules_es_array_reverse__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! core-js/modules/es.array.reverse */ "./node_modules/core-js/modules/es.array.reverse.js");
/* harmony import */ var core_js_modules_es_array_reverse__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_reverse__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var core_js_modules_es_object_to_string__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! core-js/modules/es.object.to-string */ "./node_modules/core-js/modules/es.object.to-string.js");
/* harmony import */ var core_js_modules_es_object_to_string__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_to_string__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var core_js_modules_web_timers__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! core-js/modules/web.timers */ "./node_modules/core-js/modules/web.timers.js");
/* harmony import */ var core_js_modules_web_timers__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_web_timers__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var regenerator_runtime_runtime__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! regenerator-runtime/runtime */ "./node_modules/regenerator-runtime/runtime.js");
/* harmony import */ var regenerator_runtime_runtime__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(regenerator_runtime_runtime__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var _Users_ilya_Sites_ritofos_node_modules_babel_runtime_helpers_esm_asyncToGenerator__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./node_modules/@babel/runtime/helpers/esm/asyncToGenerator */ "./node_modules/@babel/runtime/helpers/esm/asyncToGenerator.js");
/* harmony import */ var gsap_TextPlugin__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! gsap/TextPlugin */ "./node_modules/gsap/TextPlugin.js");
/* harmony import */ var _util_helpers__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ../util/helpers */ "./resources/js/util/helpers.js");








//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
// import { VueAdsTable } from 'vue-ads-table-tree';


gsap.registerPlugin(gsap_TextPlugin__WEBPACK_IMPORTED_MODULE_8__["TextPlugin"]);
/* harmony default export */ __webpack_exports__["default"] = ({
  name: 'LinearPartnershipProgram',
  // components: {
  //     VueAdsTable
  // },
  props: {
    referralLink: {
      type: String,
      required: true
    }
  },
  data: function data() {
    return {
      // columns: [],
      // tableData: []
      filter: '',
      start: 0,
      end: 2,
      rows: [{
        _id: 'tiger',
        name: 'Tiger Nixon',
        "function": 'System Architect',
        city: 'Edinburgh',
        id: '5421',
        since: '2011/04/25',
        budget: '$320,800',
        _hasChildren: true
      }, {
        name: 'Lael Greer',
        "function": 'Systems Administrator',
        city: 'London',
        id: '6733',
        since: '2009/02/27',
        budget: '$103,500',
        _showChildren: true,
        _children: [{
          name: 'Garrett Winters',
          "function": 'Accountant',
          city: 'Tokyo',
          id: '8422',
          since: '2011/07/25',
          budget: '$170,750'
        }]
      }],
      columns: [{
        property: 'id',
        title: 'ID#',
        direction: null,
        filterable: true
      }, {
        property: 'name',
        title: 'Name',
        direction: null,
        filterable: true
      }, {
        property: 'function',
        title: 'Function',
        direction: null,
        filterable: true,
        groupable: true
      }, {
        property: 'city',
        title: 'City',
        direction: null,
        filterable: true
      }, {
        property: 'since',
        title: 'Since',
        direction: null,
        filterable: true
      }, {
        property: 'budget',
        title: 'Budget',
        direction: null,
        filterable: true
      }],
      classes: {
        group: {
          'vue-ads-font-bold': true,
          'vue-ads-border-b': true,
          'vue-ads-italic': true
        },
        '0/all': {
          'vue-ads-py-3': true,
          'vue-ads-px-2': true
        },
        'even/': {
          'vue-ads-bg-blue-lighter': true
        },
        'odd/': {
          'vue-ads-bg-blue-lightest': true
        },
        '0/': {
          'vue-ads-bg-blue-lighter': false,
          'vue-ads-bg-blue-dark': true,
          'vue-ads-text-white': true,
          'vue-ads-font-bold': true
        },
        '1_/': {
          'hover:vue-ads-bg-red-lighter': true
        },
        '1_/0': {
          'leftAlign': true
        }
      }
    };
  },
  methods: {
    getData: function getData() {
      var _this = this;

      return Object(_Users_ilya_Sites_ritofos_node_modules_babel_runtime_helpers_esm_asyncToGenerator__WEBPACK_IMPORTED_MODULE_7__["default"])( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_5___default.a.mark(function _callee() {
        var _yield$axios$get, data;

        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_5___default.a.wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                _context.next = 2;
                return axios.get('/partnership-program/linear/get-referrals-for-table');

              case 2:
                _yield$axios$get = _context.sent;
                data = _yield$axios$get.data;
                _this.columns = data.columns;
                _this.tableData = data.rows;

              case 6:
              case "end":
                return _context.stop();
            }
          }
        }, _callee);
      }))();
    },
    copy: throttle(function (_ref) {
      var target = _ref.target;
      var timeline = gsap.to(target, {
        delay: 0,
        duration: 0.2,
        scale: 1.05,
        backgroundColor: '#22ca80',
        text: 'Скопировано!',
        ease: 'none'
      });
      Object(_util_helpers__WEBPACK_IMPORTED_MODULE_9__["copyToClipboard"])(this.referralLink);
      setTimeout(function () {
        timeline.reverse();
      }, 550);
    }, 1000),
    filterChanged: function filterChanged(filter) {
      this.filter = filter;
    },
    sleep: function sleep(ms) {
      return new Promise(function (resolve) {
        return setTimeout(resolve, ms);
      });
    },
    callRows: function callRows(indexesToLoad) {
      var _this2 = this;

      return Object(_Users_ilya_Sites_ritofos_node_modules_babel_runtime_helpers_esm_asyncToGenerator__WEBPACK_IMPORTED_MODULE_7__["default"])( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_5___default.a.mark(function _callee2() {
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_5___default.a.wrap(function _callee2$(_context2) {
          while (1) {
            switch (_context2.prev = _context2.next) {
              case 0:
                _context2.next = 2;
                return _this2.sleep(1000);

              case 2:
                return _context2.abrupt("return", indexesToLoad.map(function (index) {
                  return {
                    name: 'Call Rows',
                    "function": 'Developer',
                    city: 'San Francisco',
                    id: '8196',
                    since: '2010/07/14',
                    budget: '$86,500'
                  };
                }));

              case 3:
              case "end":
                return _context2.stop();
            }
          }
        }, _callee2);
      }))();
    },
    callChildren: function callChildren(parent) {
      var _this3 = this;

      return Object(_Users_ilya_Sites_ritofos_node_modules_babel_runtime_helpers_esm_asyncToGenerator__WEBPACK_IMPORTED_MODULE_7__["default"])( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_5___default.a.mark(function _callee3() {
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_5___default.a.wrap(function _callee3$(_context3) {
          while (1) {
            switch (_context3.prev = _context3.next) {
              case 0:
                _context3.next = 2;
                return _this3.sleep(1000);

              case 2:
                return _context3.abrupt("return", [{
                  name: 'Call child',
                  "function": 'Developer',
                  city: 'San Francisco',
                  id: '8196',
                  since: '2010/07/14',
                  budget: '$86,500'
                }]);

              case 3:
              case "end":
                return _context3.stop();
            }
          }
        }, _callee3);
      }))();
    },
    callTempRows: function callTempRows(filter, columns, start, end) {
      var _this4 = this;

      return Object(_Users_ilya_Sites_ritofos_node_modules_babel_runtime_helpers_esm_asyncToGenerator__WEBPACK_IMPORTED_MODULE_7__["default"])( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_5___default.a.mark(function _callee4() {
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_5___default.a.wrap(function _callee4$(_context4) {
          while (1) {
            switch (_context4.prev = _context4.next) {
              case 0:
                _context4.next = 2;
                return _this4.sleep(1000);

              case 2:
                return _context4.abrupt("return", {
                  rows: [{
                    name: 'Temp call',
                    "function": 'Developer',
                    city: 'San Francisco',
                    id: '8196',
                    since: '2010/07/14',
                    budget: '$86,500'
                  }, {
                    name: 'Temp call',
                    "function": 'Developer',
                    city: 'San Francisco',
                    id: '8196',
                    since: '2010/07/14',
                    budget: '$86,500'
                  }],
                  total: 4
                });

              case 3:
              case "end":
                return _context4.stop();
            }
          }
        }, _callee4);
      }))();
    }
  },
  created: function created() {
    alert(1); // this.getData();
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/LinearPartnershipProgram.vue?vue&type=style&index=0&lang=css&":
/*!******************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/LinearPartnershipProgram.vue?vue&type=style&index=0&lang=css& ***!
  \******************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.leftAlign {\n    text-align: left;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/LinearPartnershipProgram.vue?vue&type=style&index=0&lang=css&":
/*!**********************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/LinearPartnershipProgram.vue?vue&type=style&index=0&lang=css& ***!
  \**********************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../node_modules/css-loader??ref--6-1!../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../node_modules/postcss-loader/src??ref--6-2!../../../node_modules/vue-loader/lib??vue-loader-options!./LinearPartnershipProgram.vue?vue&type=style&index=0&lang=css& */ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/LinearPartnershipProgram.vue?vue&type=style&index=0&lang=css&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/LinearPartnershipProgram.vue?vue&type=template&id=f5a49060&":
/*!***************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/LinearPartnershipProgram.vue?vue&type=template&id=f5a49060& ***!
  \***************************************************************************************************************************************************************************************************************************/
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
  return _c("div", { staticClass: "row" }, [
    _c("div", { staticClass: "col-12" }, [
      _c("div", { staticClass: "card" }, [
        _c("div", { staticClass: "card-body" }, [
          _c("h4", { staticClass: "card-title" }, [
            _vm._v("Ваша реферальная ссылка")
          ]),
          _vm._v(" "),
          _c(
            "div",
            { staticStyle: { display: "flex", "align-items": "center" } },
            [
              _c("p", {
                staticClass: "card-text",
                staticStyle: {
                  "margin-bottom": "0",
                  "text-decoration": "underline"
                },
                domProps: { textContent: _vm._s(_vm.referralLink) }
              }),
              _vm._v(" "),
              _c("button", {
                staticClass:
                  "btn btn-sm waves-effect waves-light btn-rounded btn-primary",
                staticStyle: { "margin-left": "8px" },
                attrs: { type: "button" },
                domProps: { textContent: _vm._s("Копировать") },
                on: { click: _vm.copy }
              })
            ]
          )
        ])
      ])
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/LinearPartnershipProgram.vue":
/*!**************************************************************!*\
  !*** ./resources/js/components/LinearPartnershipProgram.vue ***!
  \**************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _LinearPartnershipProgram_vue_vue_type_template_id_f5a49060___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./LinearPartnershipProgram.vue?vue&type=template&id=f5a49060& */ "./resources/js/components/LinearPartnershipProgram.vue?vue&type=template&id=f5a49060&");
/* harmony import */ var _LinearPartnershipProgram_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./LinearPartnershipProgram.vue?vue&type=script&lang=js& */ "./resources/js/components/LinearPartnershipProgram.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _LinearPartnershipProgram_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./LinearPartnershipProgram.vue?vue&type=style&index=0&lang=css& */ "./resources/js/components/LinearPartnershipProgram.vue?vue&type=style&index=0&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _LinearPartnershipProgram_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _LinearPartnershipProgram_vue_vue_type_template_id_f5a49060___WEBPACK_IMPORTED_MODULE_0__["render"],
  _LinearPartnershipProgram_vue_vue_type_template_id_f5a49060___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/LinearPartnershipProgram.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/LinearPartnershipProgram.vue?vue&type=script&lang=js&":
/*!***************************************************************************************!*\
  !*** ./resources/js/components/LinearPartnershipProgram.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_LinearPartnershipProgram_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./LinearPartnershipProgram.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/LinearPartnershipProgram.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_LinearPartnershipProgram_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/LinearPartnershipProgram.vue?vue&type=style&index=0&lang=css&":
/*!***********************************************************************************************!*\
  !*** ./resources/js/components/LinearPartnershipProgram.vue?vue&type=style&index=0&lang=css& ***!
  \***********************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_LinearPartnershipProgram_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/style-loader!../../../node_modules/css-loader??ref--6-1!../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../node_modules/postcss-loader/src??ref--6-2!../../../node_modules/vue-loader/lib??vue-loader-options!./LinearPartnershipProgram.vue?vue&type=style&index=0&lang=css& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/LinearPartnershipProgram.vue?vue&type=style&index=0&lang=css&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_LinearPartnershipProgram_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_LinearPartnershipProgram_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_LinearPartnershipProgram_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__) if(["default"].indexOf(__WEBPACK_IMPORT_KEY__) < 0) (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_LinearPartnershipProgram_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_LinearPartnershipProgram_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/js/components/LinearPartnershipProgram.vue?vue&type=template&id=f5a49060&":
/*!*********************************************************************************************!*\
  !*** ./resources/js/components/LinearPartnershipProgram.vue?vue&type=template&id=f5a49060& ***!
  \*********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_LinearPartnershipProgram_vue_vue_type_template_id_f5a49060___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./LinearPartnershipProgram.vue?vue&type=template&id=f5a49060& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/LinearPartnershipProgram.vue?vue&type=template&id=f5a49060&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_LinearPartnershipProgram_vue_vue_type_template_id_f5a49060___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_LinearPartnershipProgram_vue_vue_type_template_id_f5a49060___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/util/helpers.js":
/*!**************************************!*\
  !*** ./resources/js/util/helpers.js ***!
  \**************************************/
/*! exports provided: clone, copyToClipboard */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "clone", function() { return clone; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "copyToClipboard", function() { return copyToClipboard; });

/**
 * Clone an array or object.
 *
 * @param payload: any
 * @returns {any}
 */

function clone(payload) {
  return JSON.parse(JSON.stringify(payload));
}
/**
 * Copy string to clipboard.
 *
 * @param string
 */

function copyToClipboard(string) {
  var fallback = function fallback(string) {
    var textArea = document.createElement('textarea');
    textArea.value = string;
    /* Place in top-left corner of screen regardless of scroll position. */

    textArea.style.position = 'fixed';
    textArea.style.top = 0;
    textArea.style.left = 0;
    /**
     * Ensure it has a small width and height. Setting to 1px / 1em.
     * Doesn't work as this gives a negative w/h on some browsers.
     */

    textArea.style.width = '2em';
    textArea.style.height = '2em';
    /* We don't need padding, reducing the size if it does flash render. */

    textArea.style.padding = 0;
    /* Clean up any borders. */

    textArea.style.border = 'none';
    textArea.style.outline = 'none';
    textArea.style.boxShadow = 'none';
    /* Avoid flash of white box if rendered for any reason. */

    textArea.style.background = 'transparent';
    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();

    try {
      document.execCommand('copy');
    } catch (error) {
      console.error('[copyToClipboard]: Oops, unable to copy.\n', error);
    }

    document.body.removeChild(textArea);
  };

  if (!navigator.clipboard) {
    fallback(string);
    return;
  }

  navigator.clipboard.writeText(string)["catch"](function (error) {
    console.error('[copyToClipboard]: Oops, unable to copy.\n', error);
  });
}

/***/ })

}]);