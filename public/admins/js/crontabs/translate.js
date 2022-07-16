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
/******/ 	return __webpack_require__(__webpack_require__.s = 6);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./app/Modules/Admin/Resources/js/crontabs/translate.js":
/*!**************************************************************!*\
  !*** ./app/Modules/Admin/Resources/js/crontabs/translate.js ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

new Vue({
  el: '#crontab_translate',
  data: {
    isLoading: false,
    items: [],
    pagination: {
      total: 0,
      per_page: 2,
      from: 1,
      to: 0,
      current_page: 1,
      limit: 20
    },
    offset: 4,
    formErrors: {},
    formErrorsUpdate: {},
    search: {
      keyword: null,
      status: 'all',
      page: 1
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
  created: function created() {
    this.getItems(this.pagination.current_page);
  },
  methods: {
    getItems: function getItems(page) {
      var scop = this;
      scop.isLoading = true;
      scop.search.page = page;
      axios.get('/admin/crontab-translates/get-data', {
        params: scop.search
      }).then(function (response) {
        scop.items = response.data.data.data;
        scop.pagination = response.data.pagination;
        scop.isLoading = false;
      })["catch"](function (error) {
        console.log(error);
        scop.isLoading = false;
      });
    },
    changePage: function changePage(page) {
      this.pagination.current_page = page;
      this.getItems(page);
    },
    createItem: function createItem() {},
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
          axios["delete"]('/admin/crontab-translates/delete/' + item.id).then(function (response) {
            scop.getItems(scop.pagination.current_page);
          })["catch"](function (error) {
            console.log(error);
          });
        }
      });
    },
    updateItem: function updateItem(item) {
      var copy = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 0;

      if (copy == 1) {
        item.translate = item.original;
      }

      axios.put('/admin/crontab-translates/update/' + item.id, {
        translate: item.translate
      }).then(function () {})["catch"](function (error) {
        console.log(error);
      });
    }
  }
});

/***/ }),

/***/ 6:
/*!********************************************************************!*\
  !*** multi ./app/Modules/Admin/Resources/js/crontabs/translate.js ***!
  \********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! E:\xampp80\htdocs\mua_ho\app\Modules\Admin\Resources\js\crontabs\translate.js */"./app/Modules/Admin/Resources/js/crontabs/translate.js");


/***/ })

/******/ });