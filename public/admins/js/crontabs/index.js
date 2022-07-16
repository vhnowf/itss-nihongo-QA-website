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
/******/ 	return __webpack_require__(__webpack_require__.s = 5);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./app/Modules/Admin/Resources/js/components/Pagination.vue":
/*!******************************************************************!*\
  !*** ./app/Modules/Admin/Resources/js/components/Pagination.vue ***!
  \******************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Pagination_vue_vue_type_template_id_6ef524ca_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Pagination.vue?vue&type=template&id=6ef524ca&scoped=true& */ "./app/Modules/Admin/Resources/js/components/Pagination.vue?vue&type=template&id=6ef524ca&scoped=true&");
/* harmony import */ var _Pagination_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Pagination.vue?vue&type=script&lang=js& */ "./app/Modules/Admin/Resources/js/components/Pagination.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Pagination_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Pagination_vue_vue_type_template_id_6ef524ca_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Pagination_vue_vue_type_template_id_6ef524ca_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "6ef524ca",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "app/Modules/Admin/Resources/js/components/Pagination.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./app/Modules/Admin/Resources/js/components/Pagination.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************!*\
  !*** ./app/Modules/Admin/Resources/js/components/Pagination.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Pagination_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./Pagination.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./app/Modules/Admin/Resources/js/components/Pagination.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Pagination_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./app/Modules/Admin/Resources/js/components/Pagination.vue?vue&type=template&id=6ef524ca&scoped=true&":
/*!*************************************************************************************************************!*\
  !*** ./app/Modules/Admin/Resources/js/components/Pagination.vue?vue&type=template&id=6ef524ca&scoped=true& ***!
  \*************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Pagination_vue_vue_type_template_id_6ef524ca_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./Pagination.vue?vue&type=template&id=6ef524ca&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./app/Modules/Admin/Resources/js/components/Pagination.vue?vue&type=template&id=6ef524ca&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Pagination_vue_vue_type_template_id_6ef524ca_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Pagination_vue_vue_type_template_id_6ef524ca_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./app/Modules/Admin/Resources/js/crontabs/index.js":
/*!**********************************************************!*\
  !*** ./app/Modules/Admin/Resources/js/crontabs/index.js ***!
  \**********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

if ($("#crontab").length) {
  Vue.component('pagination', __webpack_require__(/*! @admin/components/Pagination.vue */ "./app/Modules/Admin/Resources/js/components/Pagination.vue")["default"]);
  new Vue({
    el: '#crontab',
    data: {
      isLoading: false,
      isLoadingModal: false,
      items: [],
      categories: [],
      companies: [],
      formData: {},
      siteOld: null,
      addCategory: {
        id: null,
        crontab_id: null,
        category_id: null,
        name: null
      },
      modalType: 'create',
      errors: [],
      errorCategory: [],
      pagination: {
        data: [],
        current_page: 1,
        first_page_url: null,
        from: null,
        last_page: 1,
        last_page_url: null,
        next_page_url: null,
        per_page: 20,
        prev_page_url: null,
        to: null,
        total: 0
      },
      offset: 4,
      search: {
        keyword: null,
        page: 1
      }
    },
    created: function created() {
      this.defaultFormData();
      var searchParams = new URLSearchParams(window.location.search);
      var active = searchParams.get('active');
      this.getItems(this.pagination.current_page, active);
    },
    methods: {
      getItems: function getItems(page) {
        var active = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 0;
        var scop = this;
        scop.$loading(true);
        scop.search.page = page;
        axios.get('/admin/crontabs/get-data', {
          params: scop.search
        }).then(function (response) {
          scop.items = response.data.pagination.data;
          scop.categories = response.data.categories;
          scop.companies = response.data.companies;
          scop.pagination = response.data.pagination;

          if (active) {
            $.each(scop.items, function (i, item) {
              if (item.id == active) {
                scop.modalType = 'edit';
                scop.errors = [];
                scop.formData = {
                  id: item.id,
                  company_id: item.company_id,
                  site: item.site,
                  url: item.url,
                  categories: []
                };
                scop.getCategorySite();
                $('#crontabModal').modal('show');
                return;
              }
            });
          }

          scop.$loading(false);
        })["catch"](function (error) {
          console.log(error);
          scop.$loading(false);
        });
      },
      changeUrl: function changeUrl() {// let scop = this;
        // if(scop.siteUrl != scop.urlToDomain(scop.formData.url)) {
        // }
      },
      showCategoryName: function showCategoryName(category_id) {
        this.errorCategory = [];
        this.addCategory = {
          id: null,
          category_id: category_id,
          name: null
        };
        $('#addCategoryNameModal').modal('show');
      },
      addCategoryName: function addCategoryName() {
        var scop = this;
        scop.errorCategory = [];

        if (!scop.addCategory.name) {
          scop.errorCategory['name'] = 'Vùi lòng nhập giá trị';
        } else {
          $.each(scop.formData.categories, function (index, category) {
            if (category.name == scop.addCategory.name) {
              scop.errorCategory['name'] = 'Đã tồn tại';
              return;
            }
          });
        }

        if (Object.keys(scop.errorCategory).length == 0) {
          scop.formData.categories.push(scop.addCategory);
          $('#addCategoryNameModal').modal('hide');
        }
      },
      removeCategoryName: function removeCategoryName(index) {
        this.formData.categories.splice(index, 1);
      },
      defaultFormData: function defaultFormData() {
        this.formData = {
          id: null,
          company_id: null,
          site: null,
          url: null,
          status: true,
          categories: []
        };
      },
      createItem: function createItem() {
        this.modalType = 'create';
        this.errors = [];
        this.defaultFormData();
        $('#crontabModal').modal('show');
      },
      storeItem: function storeItem() {
        var scop = this;
        scop.errors = [];

        if (!scop.formData.company_id) {
          scop.errors['company_id'] = 'Vùi lòng chọn công ty';
        }

        if (!scop.formData.site) {
          scop.errors['site'] = 'Vùi lòng nhập site';
        }

        if (!scop.formData.url) {
          scop.errors['url'] = 'Vùi lòng nhập url';
        } else if (!scop.IsUrlValid(scop.formData.url)) {
          scop.errors['url'] = 'Sai định dạng';
        }

        if (Object.keys(scop.errors).length == 0) {
          scop.isLoadingModal = true;
          axios.post('/admin/crontabs/store', scop.formData).then(function (response) {
            var data = response.data;

            if (data.status === 200) {
              Swal.fire({
                icon: 'success',
                title: '',
                text: data.message
              });
              scop.items = data.pagination.data;
              scop.pagination = data.pagination;
              $('#crontabModal').modal('hide');
            } else if (data.status === 400) {
              scop.errors = [];

              if (data.datas.company_id) {
                scop.errors['company_id'] = data.datas.company_id[0];
              }

              if (data.datas.site) {
                scop.errors['site'] = data.datas.site[0];
              }

              if (data.datas.url) {
                scop.errors['url'] = data.datas.url[0];
              }
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: data.message,
                footer: ''
              });
            }

            scop.isLoadingModal = false;
          })["catch"](function (error) {
            console.log(error);
            scop.isLoadingModal = false;
          });
        }
      },
      editItem: function editItem(item) {
        var scop = this;
        scop.modalType = 'edit';
        scop.errors = [];
        scop.formData = {
          id: item.id,
          company_id: item.company_id,
          site: item.site,
          url: item.url,
          categories: []
        };
        scop.getCategorySite();
        $('#crontabModal').modal('show');
      },
      getCategorySite: function getCategorySite() {
        var scop = this;
        scop.siteOld = scop.urlToDomain(scop.formData.url);
        scop.$loading(true);
        axios.get('/admin/crontabs/get-category-site', {
          params: {
            site: scop.urlToDomain(scop.formData.url)
          }
        }).then(function (response) {
          scop.formData.categories = response.data.categories;
          scop.$loading(false);
        })["catch"](function (error) {
          console.log(error);
          scop.$loading(false);
        });
      },
      updateItem: function updateItem() {
        var scop = this;
        scop.errors = [];

        if (!scop.formData.company_id) {
          scop.errors['company_id'] = 'Vùi lòng chọn công ty';
        }

        if (!scop.formData.site) {
          scop.errors['site'] = 'Vùi lòng nhập site';
        }

        if (!scop.formData.url) {
          scop.errors['url'] = 'Vùi lòng nhập url';
        } else if (!scop.IsUrlValid(scop.formData.url)) {
          scop.errors['url'] = 'Sai định dạng';
        }

        if (Object.keys(scop.errors).length == 0) {
          scop.isLoadingModal = true;
          axios.put('/admin/crontabs/update/' + scop.formData.id, scop.formData).then(function (response) {
            var data = response.data;

            if (data.status === 200) {
              Swal.fire({
                icon: 'success',
                title: '',
                text: data.message
              });
              scop.items = data.pagination.data;
              scop.pagination = data.pagination;
              $('#crontabModal').modal('hide');
            } else if (data.status === 400) {
              scop.errors = [];

              if (data.datas.company_id) {
                scop.errors['company_id'] = data.datas.company_id[0];
              }

              if (data.datas.site) {
                scop.errors['site'] = data.datas.site[0];
              }

              if (data.datas.url) {
                scop.errors['url'] = data.datas.url[0];
              }
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: data.message,
                footer: ''
              });
            }

            scop.isLoadingModal = false;
          })["catch"](function (error) {
            console.log(error);
            scop.isLoadingModal = false;
          });
        }
      },
      changeStatus: function changeStatus(item) {
        axios.put('/admin/crontabs/change-status/' + item.id, item).then(function (response) {})["catch"](function (error) {
          console.log(error);
        });
      },
      deleteItem: function deleteItem(item) {
        var scop = this;
        Swal.fire({
          title: 'Bạn có chắc chắn muốn xóa?',
          text: "Bạn sẽ không thể khôi phục được dữ liệu sau khi xóa!",
          type: 'warning',
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Xóa',
          cancelButtonText: 'Hủy'
        }).then(function (result) {
          if (result.value) {
            axios["delete"]('/admin/crontabs/delete/' + item.id).then(function (response) {
              scop.getItems(scop.pagination.current_page);
            })["catch"](function (error) {
              console.log(error);
            });
          }
        });
      }
    }
  });
}

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./app/Modules/Admin/Resources/js/components/Pagination.vue?vue&type=script&lang=js&":
/*!***************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./app/Modules/Admin/Resources/js/components/Pagination.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
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
      offset: 5
    };
  },
  props: {
    pagination: {
      type: Object,
      require: true
    }
  },
  computed: {
    isActived: function isActived() {
      return this.pagination.current_page;
    },
    pagesNumber: function pagesNumber() {
      if (!this.pagination.to) {
        return [];
      }

      var from = this.pagination.current_page - this.offset;

      if (from < 1) {
        from = 1;
      }

      var to = from + this.offset * 2;

      if (to >= this.pagination.last_page) {
        to = this.pagination.last_page;
      }

      var pagesArray = [];

      while (from <= to) {
        pagesArray.push(from);
        from++;
      }

      return pagesArray;
    }
  },
  created: function created() {},
  methods: {
    changePage: function changePage(page) {
      if (page != this.pagination.current_page) {
        this.$emit('change', page);
      }
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./app/Modules/Admin/Resources/js/components/Pagination.vue?vue&type=template&id=6ef524ca&scoped=true&":
/*!*******************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./app/Modules/Admin/Resources/js/components/Pagination.vue?vue&type=template&id=6ef524ca&scoped=true& ***!
  \*******************************************************************************************************************************************************************************************************************************************/
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
  return _c("div", [
    _c(
      "ul",
      { staticClass: "pagination" },
      [
        _vm.pagination.current_page > 1
          ? _c("li", { staticClass: "page-item" }, [
              _c(
                "span",
                {
                  staticClass: "page-link",
                  attrs: { "aria-label": "Previous" },
                  on: {
                    click: function($event) {
                      return _vm.changePage(_vm.pagination.current_page - 1)
                    }
                  }
                },
                [_vm._v("«")]
              )
            ])
          : _vm._e(),
        _vm._v(" "),
        _vm._l(_vm.pagesNumber, function(page) {
          return _c(
            "li",
            {
              key: page,
              class: [page == _vm.isActived ? "page-item active" : "page-item"]
            },
            [
              _c(
                "a",
                {
                  staticClass: "page-link",
                  attrs: { href: "#" },
                  on: {
                    click: function($event) {
                      return _vm.changePage(page)
                    }
                  }
                },
                [_vm._v(_vm._s(page))]
              )
            ]
          )
        }),
        _vm._v(" "),
        _vm.pagination.current_page < _vm.pagination.last_page
          ? _c("li", { staticClass: "page-item" }, [
              _c(
                "span",
                {
                  staticClass: "page-link",
                  attrs: { "aria-label": "Next" },
                  on: {
                    click: function($event) {
                      return _vm.changePage(_vm.pagination.current_page + 1)
                    }
                  }
                },
                [_vm._v("»")]
              )
            ])
          : _vm._e()
      ],
      2
    ),
    _vm._v(" "),
    _c(
      "div",
      {
        directives: [
          {
            name: "show",
            rawName: "v-show",
            value: _vm.pagination.total > 0,
            expression: "pagination.total > 0"
          }
        ]
      },
      [
        _vm._v(
          _vm._s(_vm.pagination.from) +
            "-" +
            _vm._s(_vm.pagination.to) +
            " / " +
            _vm._s(_vm.pagination.total)
        )
      ]
    )
  ])
}
var staticRenderFns = []
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
      ? function () {
        injectStyles.call(
          this,
          (options.functional ? this.parent : this).$root.$options.shadowRoot
        )
      }
      : injectStyles
  }

  if (hook) {
    if (options.functional) {
      // for template-only hot-reload because in that case the render fn doesn't
      // go through the normalizer
      options._injectStyles = hook
      // register for functional component in vue file
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

/***/ 5:
/*!****************************************************************!*\
  !*** multi ./app/Modules/Admin/Resources/js/crontabs/index.js ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! E:\xampp80\htdocs\mua_ho\app\Modules\Admin\Resources\js\crontabs\index.js */"./app/Modules/Admin/Resources/js/crontabs/index.js");


/***/ })

/******/ });