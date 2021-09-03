(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[11],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/WalletsPanelCreateForm.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/WalletsPanelCreateForm.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var regenerator_runtime_runtime__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! regenerator-runtime/runtime */ "./node_modules/regenerator-runtime/runtime.js");
/* harmony import */ var regenerator_runtime_runtime__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(regenerator_runtime_runtime__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _Users_ilya_Sites_ritofos_node_modules_babel_runtime_helpers_esm_asyncToGenerator__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./node_modules/@babel/runtime/helpers/esm/asyncToGenerator */ "./node_modules/@babel/runtime/helpers/esm/asyncToGenerator.js");
/* harmony import */ var _util_helpers__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../util/helpers */ "./resources/js/util/helpers.js");



//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
  name: 'WalletsPanelCreateForm',
  props: {
    typesForWalletAdding: {
      type: Array,
      required: true
    },
    loading: {
      type: Boolean,
      required: true
    }
  },
  data: function data() {
    return {
      wallet: {
        typeId: null,
        number: null
      }
    };
  },
  methods: {
    create: function create() {
      var _this = this;

      return Object(_Users_ilya_Sites_ritofos_node_modules_babel_runtime_helpers_esm_asyncToGenerator__WEBPACK_IMPORTED_MODULE_2__["default"])( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee() {
        var wallet;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                if (!(_this.loading || !_this.wallet.typeId || !_this.wallet.number)) {
                  _context.next = 2;
                  break;
                }

                return _context.abrupt("return");

              case 2:
                wallet = Object(_util_helpers__WEBPACK_IMPORTED_MODULE_3__["clone"])(_this.wallet);

                _this.$emit('create', wallet, _this.clear);

              case 4:
              case "end":
                return _context.stop();
            }
          }
        }, _callee);
      }))();
    },
    clear: function clear() {
      this.wallet = {
        typeId: null,
        number: null
      };
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/WalletsPanelCreateForm.vue?vue&type=template&id=06812d35&":
/*!*************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/WalletsPanelCreateForm.vue?vue&type=template&id=06812d35& ***!
  \*************************************************************************************************************************************************************************************************************************/
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
  return _c("div", { staticClass: "card" }, [
    _c("div", { staticClass: "card-body" }, [
      _c("h4", { staticClass: "card-title" }, [_vm._v("Создать кошелек")]),
      _vm._v(" "),
      _c("form", { staticClass: "mt-4" }, [
        _c("div", { staticClass: "input-group" }, [
          _c(
            "select",
            {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.wallet.typeId,
                  expression: "wallet.typeId"
                }
              ],
              staticClass: "custom-select",
              attrs: { id: "inputGroupSelect02" },
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
                    _vm.wallet,
                    "typeId",
                    $event.target.multiple ? $$selectedVal : $$selectedVal[0]
                  )
                }
              }
            },
            [
              _c("option", {
                key: "empty",
                attrs: { selected: "", value: "" },
                domProps: { textContent: _vm._s("Выберите тип кошелька") }
              }),
              _vm._v(" "),
              _vm._l(_vm.typesForWalletAdding, function(walletType) {
                return _c("option", {
                  key: walletType.id + "-type",
                  domProps: {
                    value: walletType.id,
                    textContent: _vm._s(walletType.name)
                  }
                })
              })
            ],
            2
          )
        ]),
        _vm._v(" "),
        _c(
          "div",
          { staticClass: "input-group" },
          [
            _c("app-transition", { attrs: { name: "collapse" } }, [
              _vm.wallet.typeId
                ? _c(
                    "div",
                    { staticClass: "mt-4", staticStyle: { width: "100%" } },
                    [
                      _c("div", { staticClass: "form-group" }, [
                        _c("input", {
                          directives: [
                            {
                              name: "model",
                              rawName: "v-model",
                              value: _vm.wallet.number,
                              expression: "wallet.number"
                            }
                          ],
                          staticClass: "form-control",
                          attrs: {
                            type: "text",
                            placeholder: "Введите номер кошелька"
                          },
                          domProps: { value: _vm.wallet.number },
                          on: {
                            input: function($event) {
                              if ($event.target.composing) {
                                return
                              }
                              _vm.$set(
                                _vm.wallet,
                                "number",
                                $event.target.value
                              )
                            }
                          }
                        })
                      ])
                    ]
                  )
                : _vm._e()
            ])
          ],
          1
        ),
        _vm._v(" "),
        _c(
          "div",
          { staticClass: "input-group" },
          [
            _c("app-transition", { attrs: { name: "collapse" } }, [
              _vm.wallet.typeId && _vm.wallet.number
                ? _c(
                    "div",
                    {
                      staticClass: "mt-4 col",
                      staticStyle: {
                        display: "flex",
                        "justify-content": "center"
                      }
                    },
                    [
                      _c("button", {
                        staticClass: "btn btn-block btn-primary",
                        staticStyle: { "max-width": "45%" },
                        attrs: { type: "button" },
                        domProps: { textContent: _vm._s("Создать") },
                        on: {
                          click: function($event) {
                            return _vm.create()
                          }
                        }
                      }),
                      _vm._v(" "),
                      _c("button", {
                        staticClass: "btn btn-block btn-dark",
                        staticStyle: {
                          "max-width": "45%",
                          "margin-top": "0",
                          "margin-left": "5%"
                        },
                        attrs: { type: "button" },
                        domProps: { textContent: _vm._s("Отмена") },
                        on: {
                          click: function($event) {
                            return _vm.clear()
                          }
                        }
                      })
                    ]
                  )
                : _vm._e()
            ])
          ],
          1
        )
      ])
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/WalletsPanelCreateForm.vue":
/*!************************************************************!*\
  !*** ./resources/js/components/WalletsPanelCreateForm.vue ***!
  \************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _WalletsPanelCreateForm_vue_vue_type_template_id_06812d35___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./WalletsPanelCreateForm.vue?vue&type=template&id=06812d35& */ "./resources/js/components/WalletsPanelCreateForm.vue?vue&type=template&id=06812d35&");
/* harmony import */ var _WalletsPanelCreateForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./WalletsPanelCreateForm.vue?vue&type=script&lang=js& */ "./resources/js/components/WalletsPanelCreateForm.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _WalletsPanelCreateForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _WalletsPanelCreateForm_vue_vue_type_template_id_06812d35___WEBPACK_IMPORTED_MODULE_0__["render"],
  _WalletsPanelCreateForm_vue_vue_type_template_id_06812d35___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/WalletsPanelCreateForm.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/WalletsPanelCreateForm.vue?vue&type=script&lang=js&":
/*!*************************************************************************************!*\
  !*** ./resources/js/components/WalletsPanelCreateForm.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_WalletsPanelCreateForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./WalletsPanelCreateForm.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/WalletsPanelCreateForm.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_WalletsPanelCreateForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/WalletsPanelCreateForm.vue?vue&type=template&id=06812d35&":
/*!*******************************************************************************************!*\
  !*** ./resources/js/components/WalletsPanelCreateForm.vue?vue&type=template&id=06812d35& ***!
  \*******************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_WalletsPanelCreateForm_vue_vue_type_template_id_06812d35___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./WalletsPanelCreateForm.vue?vue&type=template&id=06812d35& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/WalletsPanelCreateForm.vue?vue&type=template&id=06812d35&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_WalletsPanelCreateForm_vue_vue_type_template_id_06812d35___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_WalletsPanelCreateForm_vue_vue_type_template_id_06812d35___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



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