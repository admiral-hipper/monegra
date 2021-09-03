(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[10],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/WalletsPanel.vue?vue&type=script&lang=js&":
/*!***********************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/WalletsPanel.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var core_js_modules_es_array_join__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.array.join */ "./node_modules/core-js/modules/es.array.join.js");
/* harmony import */ var core_js_modules_es_array_join__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_join__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var core_js_modules_es_object_to_string__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! core-js/modules/es.object.to-string */ "./node_modules/core-js/modules/es.object.to-string.js");
/* harmony import */ var core_js_modules_es_object_to_string__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_to_string__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var core_js_modules_es_object_values__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! core-js/modules/es.object.values */ "./node_modules/core-js/modules/es.object.values.js");
/* harmony import */ var core_js_modules_es_object_values__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_values__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _Users_ilya_Sites_ritofos_node_modules_babel_runtime_helpers_esm_defineProperty__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./node_modules/@babel/runtime/helpers/esm/defineProperty */ "./node_modules/@babel/runtime/helpers/esm/defineProperty.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_4__);
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


/* harmony default export */ __webpack_exports__["default"] = ({
  name: 'WalletsPanel',
  components: {
    CreateForm: function CreateForm() {
      return __webpack_require__.e(/*! import() */ 11).then(__webpack_require__.bind(null, /*! ./WalletsPanelCreateForm */ "./resources/js/components/WalletsPanelCreateForm.vue"));
    },
    EditForm: function EditForm() {
      return __webpack_require__.e(/*! import() */ 12).then(__webpack_require__.bind(null, /*! ./WalletsPanelEditForm */ "./resources/js/components/WalletsPanelEditForm.vue"));
    }
  },
  data: function data() {
    return {
      loading: false,
      columns: [],
      rows: [],
      typesForWalletAdding: [],
      walletToEdit: {}
    };
  },
  computed: {
    walletEditing: function walletEditing() {
      return Boolean(this.walletToEdit.id);
    }
  },
  methods: {
    getData: function getData() {
      var _this = this;

      return Object(_Users_ilya_Sites_ritofos_node_modules_babel_runtime_helpers_esm_asyncToGenerator__WEBPACK_IMPORTED_MODULE_6__["default"])( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_4___default.a.mark(function _callee() {
        var _yield$axios$get, data;

        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_4___default.a.wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                if (!_this.loading) {
                  _context.next = 2;
                  break;
                }

                return _context.abrupt("return");

              case 2:
                _this.loading = true;
                _context.next = 5;
                return axios.get('/wallet/all');

              case 5:
                _yield$axios$get = _context.sent;
                data = _yield$axios$get.data;

                _this.fillData(data);

                _this.loading = false;

              case 9:
              case "end":
                return _context.stop();
            }
          }
        }, _callee);
      }))();
    },
    storeWallet: function storeWallet(_ref, done) {
      var _this2 = this;

      return Object(_Users_ilya_Sites_ritofos_node_modules_babel_runtime_helpers_esm_asyncToGenerator__WEBPACK_IMPORTED_MODULE_6__["default"])( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_4___default.a.mark(function _callee2() {
        var typeId, number, _axios$post, _yield$axios$post, data, response, errorText;

        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_4___default.a.wrap(function _callee2$(_context2) {
          while (1) {
            switch (_context2.prev = _context2.next) {
              case 0:
                typeId = _ref.typeId, number = _ref.number;
                _this2.loading = true;
                sweetalert2_dist_sweetalert2_js__WEBPACK_IMPORTED_MODULE_7___default.a.fire({
                  title: 'Создание',
                  text: 'Создание нового кошелька',
                  timer: 0,
                  timerProgressBar: true,
                  onBeforeOpen: function onBeforeOpen() {
                    return sweetalert2_dist_sweetalert2_js__WEBPACK_IMPORTED_MODULE_7___default.a.showLoading();
                  }
                });
                _context2.prev = 3;
                _context2.next = 6;
                return axios.post('/wallet/store', (_axios$post = {}, Object(_Users_ilya_Sites_ritofos_node_modules_babel_runtime_helpers_esm_defineProperty__WEBPACK_IMPORTED_MODULE_3__["default"])(_axios$post, 'type_id', typeId), Object(_Users_ilya_Sites_ritofos_node_modules_babel_runtime_helpers_esm_defineProperty__WEBPACK_IMPORTED_MODULE_3__["default"])(_axios$post, "number", number), _axios$post));

              case 6:
                _yield$axios$post = _context2.sent;
                data = _yield$axios$post.data;

                _this2.fillData(data);

                done();
                sweetalert2_dist_sweetalert2_js__WEBPACK_IMPORTED_MODULE_7___default.a.fire('Создание', 'Кошелек был успешно создан', 'success');
                _context2.next = 18;
                break;

              case 13:
                _context2.prev = 13;
                _context2.t0 = _context2["catch"](3);
                response = _context2.t0.response;
                errorText = typeof response.data === 'string' ? response.data : Object.values(response.data.errors).join('<br>');
                sweetalert2_dist_sweetalert2_js__WEBPACK_IMPORTED_MODULE_7___default.a.fire('Ошибка', errorText, 'error');

              case 18:
                _this2.loading = false;

              case 19:
              case "end":
                return _context2.stop();
            }
          }
        }, _callee2, null, [[3, 13]]);
      }))();
    },
    editWallet: function editWallet(row) {
      var id = row[0].value,
          typeId = row[0]['type_id'],
          typeName = row[1].value,
          number = row[2].value;
      this.walletToEdit = {
        id: id,
        typeId: typeId,
        typeName: typeName,
        number: number
      };
    },
    updateWallet: function updateWallet(_ref3) {
      var _this3 = this;

      return Object(_Users_ilya_Sites_ritofos_node_modules_babel_runtime_helpers_esm_asyncToGenerator__WEBPACK_IMPORTED_MODULE_6__["default"])( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_4___default.a.mark(function _callee3() {
        var id, typeId, number, _axios$post2, _yield$axios$post2, data, response, errorText;

        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_4___default.a.wrap(function _callee3$(_context3) {
          while (1) {
            switch (_context3.prev = _context3.next) {
              case 0:
                id = _ref3.id, typeId = _ref3.typeId, number = _ref3.number;
                _this3.loading = true;
                sweetalert2_dist_sweetalert2_js__WEBPACK_IMPORTED_MODULE_7___default.a.fire({
                  title: 'Редактирование',
                  html: 'Редактирование кошелька',
                  timer: 0,
                  timerProgressBar: true,
                  onBeforeOpen: function onBeforeOpen() {
                    return sweetalert2_dist_sweetalert2_js__WEBPACK_IMPORTED_MODULE_7___default.a.showLoading();
                  }
                });
                _context3.prev = 3;
                _context3.next = 6;
                return axios.post('/wallet/update', (_axios$post2 = {
                  id: id
                }, Object(_Users_ilya_Sites_ritofos_node_modules_babel_runtime_helpers_esm_defineProperty__WEBPACK_IMPORTED_MODULE_3__["default"])(_axios$post2, 'type_id', typeId), Object(_Users_ilya_Sites_ritofos_node_modules_babel_runtime_helpers_esm_defineProperty__WEBPACK_IMPORTED_MODULE_3__["default"])(_axios$post2, "number", number), _axios$post2));

              case 6:
                _yield$axios$post2 = _context3.sent;
                data = _yield$axios$post2.data;

                _this3.fillData(data);

                sweetalert2_dist_sweetalert2_js__WEBPACK_IMPORTED_MODULE_7___default.a.fire('Изменение', 'Кошелек был успешно изменен', 'success');
                _this3.walletToEdit = {};
                _context3.next = 19;
                break;

              case 13:
                _context3.prev = 13;
                _context3.t0 = _context3["catch"](3);
                response = _context3.t0.response;
                errorText = typeof response.data === 'string' ? response.data : Object.values(response.data.errors).join('<br>');
                sweetalert2_dist_sweetalert2_js__WEBPACK_IMPORTED_MODULE_7___default.a.fire('Ошибка', errorText, 'error');
                return _context3.abrupt("return");

              case 19:
                _this3.loading = false;

              case 20:
              case "end":
                return _context3.stop();
            }
          }
        }, _callee3, null, [[3, 13]]);
      }))();
    },
    cancelWalletEditing: function cancelWalletEditing() {
      if (this.loading) return;
      this.walletToEdit = {};
    },
    deleteWallet: function deleteWallet(row) {
      var _this4 = this;

      if (this.loading || this.walletEditing) return;
      var id = row[0].value,
          typeName = row[1].value;
      sweetalert2_dist_sweetalert2_js__WEBPACK_IMPORTED_MODULE_7___default.a.fire({
        title: 'Удаление',
        text: "\u0412\u044B \u0443\u0432\u0435\u0440\u0435\u043D\u044B \u0447\u0442\u043E \u0445\u043E\u0442\u0438\u0442\u0435 \u0443\u0434\u0430\u043B\u0438\u0442\u044C \u043A\u043E\u0448\u0435\u043B\u0435\u043A \"".concat(typeName, "\"?"),
        icon: 'warning',
        showCancelButton: true,
        showLoaderOnConfirm: true,
        allowOutsideClick: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Да',
        cancelButtonText: 'Отмена',
        preConfirm: function preConfirm() {
          return new Promise( /*#__PURE__*/function () {
            var _ref5 = Object(_Users_ilya_Sites_ritofos_node_modules_babel_runtime_helpers_esm_asyncToGenerator__WEBPACK_IMPORTED_MODULE_6__["default"])( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_4___default.a.mark(function _callee4(resolve) {
              var _yield$axios$delete, data;

              return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_4___default.a.wrap(function _callee4$(_context4) {
                while (1) {
                  switch (_context4.prev = _context4.next) {
                    case 0:
                      sweetalert2_dist_sweetalert2_js__WEBPACK_IMPORTED_MODULE_7___default.a.showLoading();
                      _this4.loading = true;
                      _context4.next = 4;
                      return axios["delete"]("/wallet/delete/".concat(id));

                    case 4:
                      _yield$axios$delete = _context4.sent;
                      data = _yield$axios$delete.data;

                      _this4.fillData(data);

                      resolve();
                      sweetalert2_dist_sweetalert2_js__WEBPACK_IMPORTED_MODULE_7___default.a.fire('Удаление', 'Ваш кошелек был удален', 'success');
                      _this4.loading = false;

                    case 10:
                    case "end":
                      return _context4.stop();
                  }
                }
              }, _callee4);
            }));

            return function (_x) {
              return _ref5.apply(this, arguments);
            };
          }());
        }
      });
    },
    fillData: function fillData(data) {
      this.columns = data.columns;
      this.rows = data.rows;
      this.typesForWalletAdding = data['types_for_wallet_adding'];
    }
  },
  created: function created() {
    this.getData();
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

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/WalletsPanel.vue?vue&type=template&id=d1418516&":
/*!***************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/WalletsPanel.vue?vue&type=template&id=d1418516& ***!
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
  return _c(
    "div",
    { staticClass: "row" },
    [
      _c(
        "app-transition",
        {
          staticClass: "col-12",
          attrs: { name: "collapse", tag: "div", appear: "", group: "" }
        },
        [
          _vm.typesForWalletAdding.length && !_vm.walletEditing
            ? _c(
                "div",
                { key: "creation-form" },
                [
                  _c("create-form", {
                    attrs: {
                      "types-for-wallet-adding": _vm.typesForWalletAdding,
                      loading: _vm.loading
                    },
                    on: { create: _vm.storeWallet }
                  })
                ],
                1
              )
            : _vm._e(),
          _vm._v(" "),
          _vm.walletEditing
            ? _c(
                "div",
                { key: "update-form" },
                [
                  _c("edit-form", {
                    attrs: {
                      "types-for-wallet-adding": _vm.typesForWalletAdding,
                      wallet: _vm.walletToEdit,
                      loading: _vm.loading
                    },
                    on: {
                      update: _vm.updateWallet,
                      cancel: function($event) {
                        return _vm.cancelWalletEditing()
                      }
                    }
                  })
                ],
                1
              )
            : _vm._e(),
          _vm._v(" "),
          _c("div", { key: "table" }, [
            _c("div", { staticClass: "card" }, [
              _c(
                "div",
                { staticClass: "card-body" },
                [
                  _c("h4", { staticClass: "card-title" }, [
                    _vm._v("Существующие кошельки")
                  ]),
                  _vm._v(" "),
                  _c(
                    "app-transition",
                    { attrs: { name: "fade", appear: "", mode: "out-in" } },
                    [
                      _vm.rows.length
                        ? _c(
                            "div",
                            {
                              key: "data-filled",
                              staticClass: "table-responsive"
                            },
                            [
                              _c(
                                "table",
                                {
                                  staticClass:
                                    "table table-striped table-bordered no-wrap",
                                  attrs: { id: "zero_config" }
                                },
                                [
                                  _c("thead", [
                                    _c(
                                      "tr",
                                      _vm._l(_vm.columns, function(column) {
                                        return _c("th", {
                                          key: column + "-thead",
                                          domProps: {
                                            textContent: _vm._s(column)
                                          }
                                        })
                                      }),
                                      0
                                    )
                                  ]),
                                  _vm._v(" "),
                                  _c(
                                    "tbody",
                                    _vm._l(_vm.rows, function(row, rowIndex) {
                                      return _c(
                                        "tr",
                                        { key: rowIndex + "-row" },
                                        [
                                          _vm._l(row, function(
                                            cellData,
                                            cellIndex
                                          ) {
                                            return !cellData.hidden
                                              ? _c("td", {
                                                  key:
                                                    rowIndex +
                                                    "-" +
                                                    cellIndex +
                                                    "-row-cell",
                                                  domProps: {
                                                    textContent: _vm._s(
                                                      cellData.value
                                                    )
                                                  }
                                                })
                                              : _vm._e()
                                          }),
                                          _vm._v(" "),
                                          _c(
                                            "td",
                                            {
                                              key: "actions-row-cell",
                                              staticStyle: {
                                                "text-align": "center"
                                              }
                                            },
                                            [
                                              _c("button", {
                                                staticClass:
                                                  "btn waves-effect waves-light btn-rounded btn-warning",
                                                staticStyle: {
                                                  "border-radius":
                                                    "2em 0.5em 0.5em 2em"
                                                },
                                                attrs: {
                                                  type: "button",
                                                  disabled: _vm.walletEditing
                                                },
                                                domProps: {
                                                  textContent: _vm._s(
                                                    "Изменить"
                                                  )
                                                },
                                                on: {
                                                  click: function($event) {
                                                    return _vm.editWallet(row)
                                                  }
                                                }
                                              }),
                                              _vm._v(" "),
                                              _c("button", {
                                                staticClass:
                                                  "btn waves-effect waves-light btn-rounded btn-danger",
                                                staticStyle: {
                                                  "border-radius":
                                                    "0.5em 2em 2em 0.5em"
                                                },
                                                attrs: {
                                                  type: "button",
                                                  disabled: _vm.walletEditing
                                                },
                                                domProps: {
                                                  textContent: _vm._s("Удалить")
                                                },
                                                on: {
                                                  click: function($event) {
                                                    return _vm.deleteWallet(row)
                                                  }
                                                }
                                              })
                                            ]
                                          )
                                        ],
                                        2
                                      )
                                    }),
                                    0
                                  ),
                                  _vm._v(" "),
                                  _c("tfoot", [
                                    _c(
                                      "tr",
                                      _vm._l(_vm.columns, function(column) {
                                        return _c("th", {
                                          key: column + "-tfoot",
                                          domProps: {
                                            textContent: _vm._s(column)
                                          }
                                        })
                                      }),
                                      0
                                    )
                                  ])
                                ]
                              )
                            ]
                          )
                        : _c("div", { key: "empty-data" }, [
                            _vm._v(
                              "\n                            Здесь будут ваши кошельки\n                        "
                            )
                          ])
                    ]
                  )
                ],
                1
              )
            ])
          ])
        ]
      )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/WalletsPanel.vue":
/*!**************************************************!*\
  !*** ./resources/js/components/WalletsPanel.vue ***!
  \**************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _WalletsPanel_vue_vue_type_template_id_d1418516___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./WalletsPanel.vue?vue&type=template&id=d1418516& */ "./resources/js/components/WalletsPanel.vue?vue&type=template&id=d1418516&");
/* harmony import */ var _WalletsPanel_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./WalletsPanel.vue?vue&type=script&lang=js& */ "./resources/js/components/WalletsPanel.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _WalletsPanel_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _WalletsPanel_vue_vue_type_template_id_d1418516___WEBPACK_IMPORTED_MODULE_0__["render"],
  _WalletsPanel_vue_vue_type_template_id_d1418516___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/WalletsPanel.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/WalletsPanel.vue?vue&type=script&lang=js&":
/*!***************************************************************************!*\
  !*** ./resources/js/components/WalletsPanel.vue?vue&type=script&lang=js& ***!
  \***************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_WalletsPanel_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./WalletsPanel.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/WalletsPanel.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_WalletsPanel_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/WalletsPanel.vue?vue&type=template&id=d1418516&":
/*!*********************************************************************************!*\
  !*** ./resources/js/components/WalletsPanel.vue?vue&type=template&id=d1418516& ***!
  \*********************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_WalletsPanel_vue_vue_type_template_id_d1418516___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./WalletsPanel.vue?vue&type=template&id=d1418516& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/WalletsPanel.vue?vue&type=template&id=d1418516&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_WalletsPanel_vue_vue_type_template_id_d1418516___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_WalletsPanel_vue_vue_type_template_id_d1418516___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);