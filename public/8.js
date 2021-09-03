(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[8],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/BalancePanel.vue?vue&type=script&lang=js&":
/*!***********************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/BalancePanel.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var core_js_modules_es_array_join__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.array.join */ "./node_modules/core-js/modules/es.array.join.js");
/* harmony import */ var core_js_modules_es_array_join__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_join__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var core_js_modules_es_object_values__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! core-js/modules/es.object.values */ "./node_modules/core-js/modules/es.object.values.js");
/* harmony import */ var core_js_modules_es_object_values__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_values__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var core_js_modules_es_parse_float__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! core-js/modules/es.parse-float */ "./node_modules/core-js/modules/es.parse-float.js");
/* harmony import */ var core_js_modules_es_parse_float__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_parse_float__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _Users_ilya_Sites_ritofos_node_modules_babel_runtime_helpers_esm_defineProperty__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./node_modules/@babel/runtime/helpers/esm/defineProperty */ "./node_modules/@babel/runtime/helpers/esm/defineProperty.js");
/* harmony import */ var regenerator_runtime_runtime__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! regenerator-runtime/runtime */ "./node_modules/regenerator-runtime/runtime.js");
/* harmony import */ var regenerator_runtime_runtime__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(regenerator_runtime_runtime__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var _Users_ilya_Sites_ritofos_node_modules_babel_runtime_helpers_esm_asyncToGenerator__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./node_modules/@babel/runtime/helpers/esm/asyncToGenerator */ "./node_modules/@babel/runtime/helpers/esm/asyncToGenerator.js");
/* harmony import */ var sweetalert2_dist_sweetalert2_js__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! sweetalert2/dist/sweetalert2.js */ "./node_modules/sweetalert2/dist/sweetalert2.js");
/* harmony import */ var sweetalert2_dist_sweetalert2_js__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(sweetalert2_dist_sweetalert2_js__WEBPACK_IMPORTED_MODULE_7__);
/* harmony import */ var sweetalert2_src_sweetalert2_scss__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! sweetalert2/src/sweetalert2.scss */ "./node_modules/sweetalert2/src/sweetalert2.scss");
/* harmony import */ var sweetalert2_src_sweetalert2_scss__WEBPACK_IMPORTED_MODULE_8___default = /*#__PURE__*/__webpack_require__.n(sweetalert2_src_sweetalert2_scss__WEBPACK_IMPORTED_MODULE_8__);







//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
  name: 'BalancePanel',
  props: {
    userBalanceState: {
      type: String,
      required: true
    },
    userDepositBalanceState: {
      type: String,
      required: true
    }
  },
  data: function data() {
    return {
      loading: false,
      amount: null,
      balanceTypes: {
        from: null,
        to: null
      },
      newUserBalanceState: null,
      newUserDepositBalanceState: null
    };
  },
  computed: {
    actualUserBalanceState: function actualUserBalanceState() {
      return this.newUserBalanceState || this.userBalanceState;
    },
    actualUserDepositBalanceState: function actualUserDepositBalanceState() {
      return this.newUserDepositBalanceState || this.userDepositBalanceState;
    },
    userBalanceAmount: function userBalanceAmount() {
      return parseFloat(this.actualUserBalanceState);
    },
    userDepositBalanceAmount: function userDepositBalanceAmount() {
      return parseFloat(this.actualUserDepositBalanceState);
    },
    maxValue: function maxValue() {
      if (!this.balanceTypes.to) return 0;
      return this.balanceTypes.to === 'balance_token_deposit' ? this.userBalanceAmount : this.userDepositBalanceAmount;
    },
    balanceTypeToOptions: function balanceTypeToOptions() {
      return [this.balanceTypes.from === 'balance_token_deposit' ? {
        text: 'На основной',
        value: 'balance_token'
      } : {
        text: 'На депозитный',
        value: 'balance_token_deposit'
      }];
    }
  },
  watch: {
    'balanceTypes.from': function balanceTypesFrom() {
      this.balanceTypes.to = this.amount = null;
    }
  },
  methods: {
    filterAmountValue: function filterAmountValue() {
      var minValue = 0,
          maxValue = this.maxValue;

      if (this.amount < minValue) {
        this.amount = 0;
      } else if (this.amount > maxValue) {
        this.amount = maxValue;
      }
    },
    transfer: function transfer() {
      var _this = this;

      return Object(_Users_ilya_Sites_ritofos_node_modules_babel_runtime_helpers_esm_asyncToGenerator__WEBPACK_IMPORTED_MODULE_6__["default"])( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_3___default.a.mark(function _callee() {
        var _yield$axios$post, data, response, errorText;

        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_3___default.a.wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                if (!(_this.loading || !_this.amount || !_this.balanceTypes.to)) {
                  _context.next = 2;
                  break;
                }

                return _context.abrupt("return");

              case 2:
                _this.loading = true;
                sweetalert2_dist_sweetalert2_js__WEBPACK_IMPORTED_MODULE_7___default.a.fire({
                  title: 'Перевод',
                  text: 'Создание транзакции на перевод',
                  timer: 0,
                  timerProgressBar: true,
                  onBeforeOpen: function onBeforeOpen() {
                    return sweetalert2_dist_sweetalert2_js__WEBPACK_IMPORTED_MODULE_7___default.a.showLoading();
                  }
                });
                _context.prev = 4;
                _context.next = 7;
                return axios.post('/balance/transfer-between-balances', Object(_Users_ilya_Sites_ritofos_node_modules_babel_runtime_helpers_esm_defineProperty__WEBPACK_IMPORTED_MODULE_4__["default"])({
                  amount: String(_this.amount)
                }, 'balance_type', _this.balanceTypes.to));

              case 7:
                _yield$axios$post = _context.sent;
                data = _yield$axios$post.data;
                _this.amount = _this.balanceTypes.from = _this.balanceTypes.to = null;
                _this.newUserBalanceState = data['user_balance_state'];
                _this.newUserDepositBalanceState = data['user_deposit_balance_state'];
                sweetalert2_dist_sweetalert2_js__WEBPACK_IMPORTED_MODULE_7___default.a.fire('Перевод', 'Перевод успешно осуществлен', 'success');
                _context.next = 20;
                break;

              case 15:
                _context.prev = 15;
                _context.t0 = _context["catch"](4);
                response = _context.t0.response;
                errorText = typeof response.data === 'string' ? response.data : Object.values(response.data.errors).join('<br>');
                sweetalert2_dist_sweetalert2_js__WEBPACK_IMPORTED_MODULE_7___default.a.fire('Ошибка', errorText, 'error');

              case 20:
                _this.loading = false;

              case 21:
              case "end":
                return _context.stop();
            }
          }
        }, _callee, null, [[4, 15]]);
      }))();
    }
  }
});

/***/ }),

/***/ "./node_modules/core-js/internals/object-to-array.js":
/*!***********************************************************!*\
  !*** ./node_modules/core-js/internals/object-to-array.js ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var DESCRIPTORS = __webpack_require__(/*! ../internals/descriptors */ "./node_modules/core-js/internals/descriptors.js");
var objectKeys = __webpack_require__(/*! ../internals/object-keys */ "./node_modules/core-js/internals/object-keys.js");
var toIndexedObject = __webpack_require__(/*! ../internals/to-indexed-object */ "./node_modules/core-js/internals/to-indexed-object.js");
var propertyIsEnumerable = __webpack_require__(/*! ../internals/object-property-is-enumerable */ "./node_modules/core-js/internals/object-property-is-enumerable.js").f;

// `Object.{ entries, values }` methods implementation
var createMethod = function (TO_ENTRIES) {
  return function (it) {
    var O = toIndexedObject(it);
    var keys = objectKeys(O);
    var length = keys.length;
    var i = 0;
    var result = [];
    var key;
    while (length > i) {
      key = keys[i++];
      if (!DESCRIPTORS || propertyIsEnumerable.call(O, key)) {
        result.push(TO_ENTRIES ? [key, O[key]] : O[key]);
      }
    }
    return result;
  };
};

module.exports = {
  // `Object.entries` method
  // https://tc39.github.io/ecma262/#sec-object.entries
  entries: createMethod(true),
  // `Object.values` method
  // https://tc39.github.io/ecma262/#sec-object.values
  values: createMethod(false)
};


/***/ }),

/***/ "./node_modules/core-js/modules/es.object.values.js":
/*!**********************************************************!*\
  !*** ./node_modules/core-js/modules/es.object.values.js ***!
  \**********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var $ = __webpack_require__(/*! ../internals/export */ "./node_modules/core-js/internals/export.js");
var $values = __webpack_require__(/*! ../internals/object-to-array */ "./node_modules/core-js/internals/object-to-array.js").values;

// `Object.values` method
// https://tc39.github.io/ecma262/#sec-object.values
$({ target: 'Object', stat: true }, {
  values: function values(O) {
    return $values(O);
  }
});


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/BalancePanel.vue?vue&type=template&id=465cf71a&":
/*!***************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/BalancePanel.vue?vue&type=template&id=465cf71a& ***!
  \***************************************************************************************************************************************************************************************************************/
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
    _c("div", { staticClass: "col-xs-12 col-sm-10 col-md-8 col-lg-6" }, [
      _c("div", { staticClass: "card" }, [
        _c("div", { staticClass: "card-body" }, [
          _c("h4", { staticClass: "card-title" }, [_vm._v("Баланс")]),
          _vm._v(" "),
          _c("p", { staticClass: "card-text" }, [
            _vm._v("Перевод между балансами")
          ]),
          _vm._v(" "),
          _c(
            "div",
            {
              staticStyle: {
                display: "flex",
                "justify-content": "flex-start",
                "margin-bottom": "15px",
                color: "#525252"
              }
            },
            [
              _c("div", { staticStyle: { "text-align": "left" } }, [
                _c("div", [
                  _vm._v("\n                            Основной баланс: "),
                  _c("strong", {
                    domProps: {
                      textContent: _vm._s(_vm.actualUserBalanceState)
                    }
                  })
                ]),
                _vm._v(" "),
                _c("div", [
                  _vm._v("\n                            Депозитний баланс: "),
                  _c("strong", {
                    domProps: {
                      textContent: _vm._s(_vm.actualUserDepositBalanceState)
                    }
                  })
                ])
              ])
            ]
          ),
          _vm._v(" "),
          _c(
            "div",
            { staticClass: "row", staticStyle: { "flex-direction": "column" } },
            [
              _c("div", { staticClass: "col-md-12" }, [
                _c(
                  "div",
                  { staticClass: "form-group" },
                  [
                    _c(
                      "select",
                      {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.balanceTypes.from,
                            expression: "balanceTypes.from"
                          }
                        ],
                        staticClass: "custom-select",
                        on: {
                          change: function($event) {
                            var $$selectedVal = Array.prototype.filter
                              .call($event.target.options, function(o) {
                                return o.selected
                              })
                              .map(function(o) {
                                var val = "_value" in o ? o._value : o.value
                                return val
                              })
                            _vm.$set(
                              _vm.balanceTypes,
                              "from",
                              $event.target.multiple
                                ? $$selectedVal
                                : $$selectedVal[0]
                            )
                          }
                        }
                      },
                      [
                        _c("option", {
                          attrs: { selected: "", value: "" },
                          domProps: {
                            textContent: _vm._s("Выберите тип баланса")
                          }
                        }),
                        _vm._v(" "),
                        _c("option", {
                          attrs: { value: "balance_token_deposit" },
                          domProps: { textContent: _vm._s("С депозитного") }
                        }),
                        _vm._v(" "),
                        _c("option", {
                          attrs: { value: "balance_token" },
                          domProps: { textContent: _vm._s("С основного") }
                        })
                      ]
                    ),
                    _vm._v(" "),
                    _c("app-transition", { attrs: { name: "collapse" } }, [
                      _vm.balanceTypes.from === "balance_token_deposit"
                        ? _c(
                            "div",
                            {
                              staticStyle: {
                                "margin-left": "2px",
                                "font-size": "12px"
                              }
                            },
                            [
                              _vm._v(
                                "Ограничение при выводе с депозитного баланса составляет 8% от недельного оборота\n                                "
                              )
                            ]
                          )
                        : _vm._e()
                    ])
                  ],
                  1
                )
              ]),
              _vm._v(" "),
              _vm.balanceTypes.from
                ? _c("div", { staticClass: "col-md-12" }, [
                    _c("div", { staticClass: "form-group" }, [
                      _c(
                        "select",
                        {
                          directives: [
                            {
                              name: "model",
                              rawName: "v-model",
                              value: _vm.balanceTypes.to,
                              expression: "balanceTypes.to"
                            }
                          ],
                          staticClass: "custom-select",
                          on: {
                            change: [
                              function($event) {
                                var $$selectedVal = Array.prototype.filter
                                  .call($event.target.options, function(o) {
                                    return o.selected
                                  })
                                  .map(function(o) {
                                    var val = "_value" in o ? o._value : o.value
                                    return val
                                  })
                                _vm.$set(
                                  _vm.balanceTypes,
                                  "to",
                                  $event.target.multiple
                                    ? $$selectedVal
                                    : $$selectedVal[0]
                                )
                              },
                              function($event) {
                                _vm.amount = null
                              }
                            ]
                          }
                        },
                        [
                          _c("option", {
                            attrs: { value: "", selected: "" },
                            domProps: {
                              textContent: _vm._s("Выберите тип баланса")
                            }
                          }),
                          _vm._v(" "),
                          _vm._l(_vm.balanceTypeToOptions, function(ref) {
                            var text = ref.text
                            var value = ref.value
                            return _c("option", {
                              key: value,
                              domProps: {
                                value: value,
                                textContent: _vm._s(text)
                              }
                            })
                          })
                        ],
                        2
                      )
                    ])
                  ])
                : _vm._e(),
              _vm._v(" "),
              _vm.balanceTypes.to
                ? _c("div", { staticClass: "col-md-12" }, [
                    _c("div", { staticClass: "form-group" }, [
                      _c("div", { staticClass: "form-group" }, [
                        _c("input", {
                          directives: [
                            {
                              name: "model",
                              rawName: "v-model",
                              value: _vm.amount,
                              expression: "amount"
                            }
                          ],
                          staticClass: "form-control",
                          attrs: {
                            type: "number",
                            step: "0.00000001",
                            placeholder: "Сумма перевода"
                          },
                          domProps: { value: _vm.amount },
                          on: {
                            input: [
                              function($event) {
                                if ($event.target.composing) {
                                  return
                                }
                                _vm.amount = $event.target.value
                              },
                              function($event) {
                                return _vm.filterAmountValue()
                              }
                            ]
                          }
                        })
                      ])
                    ])
                  ])
                : _vm._e(),
              _vm._v(" "),
              _vm.amount
                ? _c("div", { staticClass: "col-md-12" }, [
                    _c("div", { staticClass: "form-group" }, [
                      _c("button", {
                        staticClass: "btn btn-primary",
                        staticStyle: { "max-width": "45%" },
                        attrs: { type: "button" },
                        domProps: { textContent: _vm._s("Перевести") },
                        on: {
                          click: function($event) {
                            return _vm.transfer()
                          }
                        }
                      })
                    ])
                  ])
                : _vm._e()
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

/***/ "./resources/js/components/BalancePanel.vue":
/*!**************************************************!*\
  !*** ./resources/js/components/BalancePanel.vue ***!
  \**************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _BalancePanel_vue_vue_type_template_id_465cf71a___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./BalancePanel.vue?vue&type=template&id=465cf71a& */ "./resources/js/components/BalancePanel.vue?vue&type=template&id=465cf71a&");
/* harmony import */ var _BalancePanel_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./BalancePanel.vue?vue&type=script&lang=js& */ "./resources/js/components/BalancePanel.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _BalancePanel_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _BalancePanel_vue_vue_type_template_id_465cf71a___WEBPACK_IMPORTED_MODULE_0__["render"],
  _BalancePanel_vue_vue_type_template_id_465cf71a___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/BalancePanel.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/BalancePanel.vue?vue&type=script&lang=js&":
/*!***************************************************************************!*\
  !*** ./resources/js/components/BalancePanel.vue?vue&type=script&lang=js& ***!
  \***************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_BalancePanel_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./BalancePanel.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/BalancePanel.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_BalancePanel_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/BalancePanel.vue?vue&type=template&id=465cf71a&":
/*!*********************************************************************************!*\
  !*** ./resources/js/components/BalancePanel.vue?vue&type=template&id=465cf71a& ***!
  \*********************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_BalancePanel_vue_vue_type_template_id_465cf71a___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./BalancePanel.vue?vue&type=template&id=465cf71a& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/BalancePanel.vue?vue&type=template&id=465cf71a&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_BalancePanel_vue_vue_type_template_id_465cf71a___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_BalancePanel_vue_vue_type_template_id_465cf71a___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);