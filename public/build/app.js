"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["app"],{

/***/ "./assets/app.js":
/*!***********************!*\
  !*** ./assets/app.js ***!
  \***********************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var core_js_modules_es_array_for_each_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.array.for-each.js */ "./node_modules/core-js/modules/es.array.for-each.js");
/* harmony import */ var core_js_modules_es_array_for_each_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_for_each_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var core_js_modules_es_promise_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! core-js/modules/es.promise.js */ "./node_modules/core-js/modules/es.promise.js");
/* harmony import */ var core_js_modules_es_promise_js__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_promise_js__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var core_js_modules_esnext_iterator_constructor_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! core-js/modules/esnext.iterator.constructor.js */ "./node_modules/core-js/modules/esnext.iterator.constructor.js");
/* harmony import */ var core_js_modules_esnext_iterator_constructor_js__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_esnext_iterator_constructor_js__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var core_js_modules_esnext_iterator_for_each_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! core-js/modules/esnext.iterator.for-each.js */ "./node_modules/core-js/modules/esnext.iterator.for-each.js");
/* harmony import */ var core_js_modules_esnext_iterator_for_each_js__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_esnext_iterator_for_each_js__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var core_js_modules_web_dom_collections_for_each_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! core-js/modules/web.dom-collections.for-each.js */ "./node_modules/core-js/modules/web.dom-collections.for-each.js");
/* harmony import */ var core_js_modules_web_dom_collections_for_each_js__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_web_dom_collections_for_each_js__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var _fortawesome_fontawesome_free_css_all_min_css__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @fortawesome/fontawesome-free/css/all.min.css */ "./node_modules/@fortawesome/fontawesome-free/css/all.min.css");
/* harmony import */ var _styles_app_css__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./styles/app.css */ "./assets/styles/app.css");






/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)




// Pour ralentir la vidéo à 0.2x (5 fois plus lent)
document.addEventListener("DOMContentLoaded", function () {
  var video = document.getElementById("background-video");
  if (video) {
    video.playbackRate = 0.2;
  }
});
// Sélection des videoss par vignettes
document.addEventListener("DOMContentLoaded", function () {
  var vignettes = document.querySelectorAll(".video-vignette");
  var input = document.getElementById("{{ form.selectedvideo.vars.id }}");
  vignettes.forEach(function (vignette) {
    vignette.addEventListener("click", function () {
      vignettes.forEach(function (v) {
        return v.classList.remove("border-primary", "border", "shadow");
      });
      this.classList.add("border-primary", "border", "shadow");
      input.value = this.dataset.videoId;
    });
  });
});

// Pour la sélection de l'instrument
var instrumentVignettes = document.querySelectorAll('.instrument-vignette');
var instrumentInput = document.getElementById('{{ form.instrument.vars.id }}');
instrumentVignettes.forEach(function (vignette) {
  vignette.addEventListener('click', function () {
    instrumentVignettes.forEach(function (v) {
      return v.classList.remove('border-primary', 'border', 'shadow');
    });
    this.classList.add('border-primary', 'border', 'shadow');
    instrumentInput.value = this.dataset.instrumentId;
  });
});
// proxy
// fetch('/proxy-googleads')
//   .then(response => response.text())
//   .then(text => {
// 	console.log ('script chargé')
//     console.log('Réponse brute:', JSON.stringify(text));

//     // Nettoie tout ce qui précède le premier { ou [
//     let cleaned = text.trim().replace(/^[^\[{]+/, '');
//     console.log('Après nettoyage:', JSON.stringify(cleaned));

//     try {
//       let data = JSON.parse(cleaned);
//       console.log('Données JSON:', data);
//     } catch (e) {
//       console.error('Erreur de parsing:', e, 'Chaîne nettoyée:', cleaned);
//     }
//   })
//   .catch(error => console.error('Erreur fetch:', error));
fetch('/proxy-googleads').then(function (response) {
  return response.json();
}).then(function (data) {
  console.log('Données JSON:', data);
})["catch"](function (error) {
  return console.error('Erreur:', error);
});

/***/ }),

/***/ "./assets/styles/app.css":
/*!*******************************!*\
  !*** ./assets/styles/app.css ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_fortawesome_fontawesome-free_css_all_min_css-node_modules_core-js_module-145b21"], () => (__webpack_exec__("./assets/app.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,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c3NldHMvc3R5bGVzL2FwcC5jc3M/NmJlNiJdLCJzb3VyY2VzQ29udGVudCI6WyIvKlxyXG4gKiBXZWxjb21lIHRvIHlvdXIgYXBwJ3MgbWFpbiBKYXZhU2NyaXB0IGZpbGUhXHJcbiAqXHJcbiAqIFdlIHJlY29tbWVuZCBpbmNsdWRpbmcgdGhlIGJ1aWx0IHZlcnNpb24gb2YgdGhpcyBKYXZhU2NyaXB0IGZpbGVcclxuICogKGFuZCBpdHMgQ1NTIGZpbGUpIGluIHlvdXIgYmFzZSBsYXlvdXQgKGJhc2UuaHRtbC50d2lnKS5cclxuICovXHJcblxyXG4vLyBhbnkgQ1NTIHlvdSBpbXBvcnQgd2lsbCBvdXRwdXQgaW50byBhIHNpbmdsZSBjc3MgZmlsZSAoYXBwLmNzcyBpbiB0aGlzIGNhc2UpXHJcblxyXG5pbXBvcnQgXCJAZm9ydGF3ZXNvbWUvZm9udGF3ZXNvbWUtZnJlZS9jc3MvYWxsLm1pbi5jc3NcIjtcclxuXHJcbmltcG9ydCBcIi4vc3R5bGVzL2FwcC5jc3NcIjtcclxuXHJcbi8vIFBvdXIgcmFsZW50aXIgbGEgdmlkw6lvIMOgIDAuMnggKDUgZm9pcyBwbHVzIGxlbnQpXHJcbmRvY3VtZW50LmFkZEV2ZW50TGlzdGVuZXIoXCJET01Db250ZW50TG9hZGVkXCIsIGZ1bmN0aW9uICgpIHtcclxuXHR2YXIgdmlkZW8gPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcImJhY2tncm91bmQtdmlkZW9cIik7XHJcblx0aWYgKHZpZGVvKSB7XHJcblx0XHR2aWRlby5wbGF5YmFja1JhdGUgPSAwLjI7XHJcblx0fVxyXG59KTtcclxuLy8gU8OpbGVjdGlvbiBkZXMgdmlkZW9zcyBwYXIgdmlnbmV0dGVzXHJcbmRvY3VtZW50LmFkZEV2ZW50TGlzdGVuZXIoXCJET01Db250ZW50TG9hZGVkXCIsIGZ1bmN0aW9uICgpIHtcclxuXHRjb25zdCB2aWduZXR0ZXMgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKFwiLnZpZGVvLXZpZ25ldHRlXCIpO1xyXG5cdGNvbnN0IGlucHV0ID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJ7eyBmb3JtLnNlbGVjdGVkdmlkZW8udmFycy5pZCB9fVwiKTtcclxuXHJcblx0dmlnbmV0dGVzLmZvckVhY2goZnVuY3Rpb24gKHZpZ25ldHRlKSB7XHJcblx0XHR2aWduZXR0ZS5hZGRFdmVudExpc3RlbmVyKFwiY2xpY2tcIiwgZnVuY3Rpb24gKCkge1xyXG5cdFx0XHR2aWduZXR0ZXMuZm9yRWFjaCgodikgPT5cclxuXHRcdFx0XHR2LmNsYXNzTGlzdC5yZW1vdmUoXCJib3JkZXItcHJpbWFyeVwiLCBcImJvcmRlclwiLCBcInNoYWRvd1wiKVxyXG5cdFx0XHQpO1xyXG5cdFx0XHR0aGlzLmNsYXNzTGlzdC5hZGQoXCJib3JkZXItcHJpbWFyeVwiLCBcImJvcmRlclwiLCBcInNoYWRvd1wiKTtcclxuXHRcdFx0aW5wdXQudmFsdWUgPSB0aGlzLmRhdGFzZXQudmlkZW9JZDtcclxuXHRcdH0pO1xyXG5cdH0pO1xyXG59KTtcclxuXHJcbi8vIFBvdXIgbGEgc8OpbGVjdGlvbiBkZSBsJ2luc3RydW1lbnRcclxuY29uc3QgaW5zdHJ1bWVudFZpZ25ldHRlcyA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoJy5pbnN0cnVtZW50LXZpZ25ldHRlJyk7XHJcbmNvbnN0IGluc3RydW1lbnRJbnB1dCA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCd7eyBmb3JtLmluc3RydW1lbnQudmFycy5pZCB9fScpO1xyXG5pbnN0cnVtZW50VmlnbmV0dGVzLmZvckVhY2goZnVuY3Rpb24odmlnbmV0dGUpIHtcclxuXHR2aWduZXR0ZS5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGZ1bmN0aW9uKCkge1xyXG5cdFx0aW5zdHJ1bWVudFZpZ25ldHRlcy5mb3JFYWNoKHYgPT4gdi5jbGFzc0xpc3QucmVtb3ZlKCdib3JkZXItcHJpbWFyeScsICdib3JkZXInLCAnc2hhZG93JykpO1xyXG5cdFx0dGhpcy5jbGFzc0xpc3QuYWRkKCdib3JkZXItcHJpbWFyeScsICdib3JkZXInLCAnc2hhZG93Jyk7XHJcblx0XHRpbnN0cnVtZW50SW5wdXQudmFsdWUgPSB0aGlzLmRhdGFzZXQuaW5zdHJ1bWVudElkO1xyXG5cdH0pO1xyXG59KTtcclxuLy8gcHJveHlcclxuLy8gZmV0Y2goJy9wcm94eS1nb29nbGVhZHMnKVxyXG4vLyAgIC50aGVuKHJlc3BvbnNlID0+IHJlc3BvbnNlLnRleHQoKSlcclxuLy8gICAudGhlbih0ZXh0ID0+IHtcclxuLy8gXHRjb25zb2xlLmxvZyAoJ3NjcmlwdCBjaGFyZ8OpJylcclxuLy8gICAgIGNvbnNvbGUubG9nKCdSw6lwb25zZSBicnV0ZTonLCBKU09OLnN0cmluZ2lmeSh0ZXh0KSk7XHJcblxyXG4vLyAgICAgLy8gTmV0dG9pZSB0b3V0IGNlIHF1aSBwcsOpY8OoZGUgbGUgcHJlbWllciB7IG91IFtcclxuLy8gICAgIGxldCBjbGVhbmVkID0gdGV4dC50cmltKCkucmVwbGFjZSgvXlteXFxbe10rLywgJycpO1xyXG4vLyAgICAgY29uc29sZS5sb2coJ0FwcsOocyBuZXR0b3lhZ2U6JywgSlNPTi5zdHJpbmdpZnkoY2xlYW5lZCkpO1xyXG5cclxuLy8gICAgIHRyeSB7XHJcbi8vICAgICAgIGxldCBkYXRhID0gSlNPTi5wYXJzZShjbGVhbmVkKTtcclxuLy8gICAgICAgY29uc29sZS5sb2coJ0Rvbm7DqWVzIEpTT046JywgZGF0YSk7XHJcbi8vICAgICB9IGNhdGNoIChlKSB7XHJcbi8vICAgICAgIGNvbnNvbGUuZXJyb3IoJ0VycmV1ciBkZSBwYXJzaW5nOicsIGUsICdDaGHDrm5lIG5ldHRvecOpZTonLCBjbGVhbmVkKTtcclxuLy8gICAgIH1cclxuLy8gICB9KVxyXG4vLyAgIC5jYXRjaChlcnJvciA9PiBjb25zb2xlLmVycm9yKCdFcnJldXIgZmV0Y2g6JywgZXJyb3IpKTtcclxuZmV0Y2goJy9wcm94eS1nb29nbGVhZHMnKVxyXG4gIC50aGVuKHJlc3BvbnNlID0+IHJlc3BvbnNlLmpzb24oKSlcclxuICAudGhlbihkYXRhID0+IHtcclxuICAgIGNvbnNvbGUubG9nKCdEb25uw6llcyBKU09OOicsIGRhdGEpO1xyXG4gIH0pXHJcbiAgLmNhdGNoKGVycm9yID0+IGNvbnNvbGUuZXJyb3IoJ0VycmV1cjonLCBlcnJvcikpO1xyXG5cclxuXHJcbiIsIi8vIGV4dHJhY3RlZCBieSBtaW5pLWNzcy1leHRyYWN0LXBsdWdpblxuZXhwb3J0IHt9OyJdLCJuYW1lcyI6WyJkb2N1bWVudCIsImFkZEV2ZW50TGlzdGVuZXIiLCJ2aWRlbyIsImdldEVsZW1lbnRCeUlkIiwicGxheWJhY2tSYXRlIiwidmlnbmV0dGVzIiwicXVlcnlTZWxlY3RvckFsbCIsImlucHV0IiwiZm9yRWFjaCIsInZpZ25ldHRlIiwidiIsImNsYXNzTGlzdCIsInJlbW92ZSIsImFkZCIsInZhbHVlIiwiZGF0YXNldCIsInZpZGVvSWQiLCJpbnN0cnVtZW50VmlnbmV0dGVzIiwiaW5zdHJ1bWVudElucHV0IiwiaW5zdHJ1bWVudElkIiwiZmV0Y2giLCJ0aGVuIiwicmVzcG9uc2UiLCJqc29uIiwiZGF0YSIsImNvbnNvbGUiLCJsb2ciLCJlcnJvciJdLCJzb3VyY2VSb290IjoiIn0=