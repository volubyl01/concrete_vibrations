"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["app"],{

/***/ "./assets/app.js":
/*!***********************!*\
  !*** ./assets/app.js ***!
  \***********************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var core_js_modules_es_error_cause_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.error.cause.js */ "./node_modules/core-js/modules/es.error.cause.js");
/* harmony import */ var core_js_modules_es_error_cause_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_error_cause_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var core_js_modules_es_error_to_string_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! core-js/modules/es.error.to-string.js */ "./node_modules/core-js/modules/es.error.to-string.js");
/* harmony import */ var core_js_modules_es_error_to_string_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_error_to_string_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var core_js_modules_es_array_for_each_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! core-js/modules/es.array.for-each.js */ "./node_modules/core-js/modules/es.array.for-each.js");
/* harmony import */ var core_js_modules_es_array_for_each_js__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_for_each_js__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var core_js_modules_es_promise_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! core-js/modules/es.promise.js */ "./node_modules/core-js/modules/es.promise.js");
/* harmony import */ var core_js_modules_es_promise_js__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_promise_js__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var core_js_modules_esnext_iterator_constructor_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! core-js/modules/esnext.iterator.constructor.js */ "./node_modules/core-js/modules/esnext.iterator.constructor.js");
/* harmony import */ var core_js_modules_esnext_iterator_constructor_js__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_esnext_iterator_constructor_js__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var core_js_modules_esnext_iterator_for_each_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! core-js/modules/esnext.iterator.for-each.js */ "./node_modules/core-js/modules/esnext.iterator.for-each.js");
/* harmony import */ var core_js_modules_esnext_iterator_for_each_js__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_esnext_iterator_for_each_js__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var core_js_modules_web_dom_collections_for_each_js__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! core-js/modules/web.dom-collections.for-each.js */ "./node_modules/core-js/modules/web.dom-collections.for-each.js");
/* harmony import */ var core_js_modules_web_dom_collections_for_each_js__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_web_dom_collections_for_each_js__WEBPACK_IMPORTED_MODULE_7__);
/* harmony import */ var _fortawesome_fontawesome_free_css_all_min_css__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! @fortawesome/fontawesome-free/css/all.min.css */ "./node_modules/@fortawesome/fontawesome-free/css/all.min.css");
/* harmony import */ var _styles_app_css__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ./styles/app.css */ "./assets/styles/app.css");








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
document.addEventListener('DOMContentLoaded', function () {
  // Sélection des vidéos
  document.querySelectorAll('.video-vignette').forEach(function (img) {
    img.addEventListener('click', function () {
      // Retirer la sélection précédente
      document.querySelectorAll('.video-vignette.selected').forEach(function (el) {
        return el.classList.remove('selected');
      });
      // Ajouter la sélection actuelle
      img.classList.add('selected');
      // Mettre à jour le champ caché selectedvideo
      var inputSelectedVideo = document.querySelector('input[name="video_instrument[selectedvideo]"]');
      if (inputSelectedVideo) {
        inputSelectedVideo.value = img.dataset.videoId;
      }
    });
  });

  // Sélection instrument
  document.querySelectorAll('.instrument-vignette').forEach(function (img) {
    img.addEventListener('click', function () {
      // Retirer la sélection précédente
      document.querySelectorAll('.instrument-vignette.selected').forEach(function (el) {
        return el.classList.remove('selected');
      });
      // Ajouter la sélection actuelle
      img.classList.add('selected');
      // Mettre à jour le champ caché instrument
      var inputInstrument = document.querySelector('input[name="video_instrument[instrument]"]');
      if (inputInstrument) {
        inputInstrument.value = img.dataset.instrumentId;
      }
    });
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

fetch('http://localhost:8000/proxy-googleads').then(function (response) {
  if (!response.ok) {
    throw new Error('Network response was not ok');
  }
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
/******/ __webpack_require__.O(0, ["vendors-node_modules_fortawesome_fontawesome-free_css_all_min_css-node_modules_core-js_module-a3d228"], () => (__webpack_exec__("./assets/app.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,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UyxFQUFFQSxLQUFLLENBQUM7QUFBQSxFQUFDOzs7Ozs7Ozs7OztBQ3JGcEQiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvYXBwLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9zdHlsZXMvYXBwLmNzcz82YmU2Il0sInNvdXJjZXNDb250ZW50IjpbIi8qXHJcbiAqIFdlbGNvbWUgdG8geW91ciBhcHAncyBtYWluIEphdmFTY3JpcHQgZmlsZSFcclxuICpcclxuICogV2UgcmVjb21tZW5kIGluY2x1ZGluZyB0aGUgYnVpbHQgdmVyc2lvbiBvZiB0aGlzIEphdmFTY3JpcHQgZmlsZVxyXG4gKiAoYW5kIGl0cyBDU1MgZmlsZSkgaW4geW91ciBiYXNlIGxheW91dCAoYmFzZS5odG1sLnR3aWcpLlxyXG4gKi9cclxuXHJcbi8vIGFueSBDU1MgeW91IGltcG9ydCB3aWxsIG91dHB1dCBpbnRvIGEgc2luZ2xlIGNzcyBmaWxlIChhcHAuY3NzIGluIHRoaXMgY2FzZSlcclxuXHJcbmltcG9ydCBcIkBmb3J0YXdlc29tZS9mb250YXdlc29tZS1mcmVlL2Nzcy9hbGwubWluLmNzc1wiO1xyXG5cclxuaW1wb3J0IFwiLi9zdHlsZXMvYXBwLmNzc1wiO1xyXG5cclxuLy8gUG91ciByYWxlbnRpciBsYSB2aWTDqW8gw6AgMC4yeCAoNSBmb2lzIHBsdXMgbGVudClcclxuZG9jdW1lbnQuYWRkRXZlbnRMaXN0ZW5lcihcIkRPTUNvbnRlbnRMb2FkZWRcIiwgZnVuY3Rpb24gKCkge1xyXG5cdHZhciB2aWRlbyA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwiYmFja2dyb3VuZC12aWRlb1wiKTtcclxuXHRpZiAodmlkZW8pIHtcclxuXHRcdHZpZGVvLnBsYXliYWNrUmF0ZSA9IDAuMjtcclxuXHR9XHJcbn0pO1xyXG4vLyBTw6lsZWN0aW9uIGRlcyB2aWRlb3NzIHBhciB2aWduZXR0ZXNcclxuZG9jdW1lbnQuYWRkRXZlbnRMaXN0ZW5lcignRE9NQ29udGVudExvYWRlZCcsICgpID0+IHtcclxuICAgIC8vIFPDqWxlY3Rpb24gZGVzIHZpZMOpb3NcclxuICAgIGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoJy52aWRlby12aWduZXR0ZScpLmZvckVhY2goaW1nID0+IHtcclxuICAgICAgICBpbWcuYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCAoKSA9PiB7XHJcbiAgICAgICAgICAgIC8vIFJldGlyZXIgbGEgc8OpbGVjdGlvbiBwcsOpY8OpZGVudGVcclxuICAgICAgICAgICAgZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbCgnLnZpZGVvLXZpZ25ldHRlLnNlbGVjdGVkJykuZm9yRWFjaChlbCA9PiBlbC5jbGFzc0xpc3QucmVtb3ZlKCdzZWxlY3RlZCcpKTtcclxuICAgICAgICAgICAgLy8gQWpvdXRlciBsYSBzw6lsZWN0aW9uIGFjdHVlbGxlXHJcbiAgICAgICAgICAgIGltZy5jbGFzc0xpc3QuYWRkKCdzZWxlY3RlZCcpO1xyXG4gICAgICAgICAgICAvLyBNZXR0cmUgw6Agam91ciBsZSBjaGFtcCBjYWNow6kgc2VsZWN0ZWR2aWRlb1xyXG4gICAgICAgICAgICBjb25zdCBpbnB1dFNlbGVjdGVkVmlkZW8gPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCdpbnB1dFtuYW1lPVwidmlkZW9faW5zdHJ1bWVudFtzZWxlY3RlZHZpZGVvXVwiXScpO1xyXG4gICAgICAgICAgICBpZiAoaW5wdXRTZWxlY3RlZFZpZGVvKSB7XHJcbiAgICAgICAgICAgICAgICBpbnB1dFNlbGVjdGVkVmlkZW8udmFsdWUgPSBpbWcuZGF0YXNldC52aWRlb0lkO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfSk7XHJcbiAgICB9KTtcclxuXHJcblxyXG4vLyBTw6lsZWN0aW9uIGluc3RydW1lbnRcclxuZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbCgnLmluc3RydW1lbnQtdmlnbmV0dGUnKS5mb3JFYWNoKGltZyA9PiB7XHJcbiAgICBpbWcuYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCAoKSA9PiB7XHJcbiAgICAgICAgLy8gUmV0aXJlciBsYSBzw6lsZWN0aW9uIHByw6ljw6lkZW50ZVxyXG4gICAgICAgIGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoJy5pbnN0cnVtZW50LXZpZ25ldHRlLnNlbGVjdGVkJykuZm9yRWFjaChlbCA9PiBlbC5jbGFzc0xpc3QucmVtb3ZlKCdzZWxlY3RlZCcpKTtcclxuICAgICAgICAvLyBBam91dGVyIGxhIHPDqWxlY3Rpb24gYWN0dWVsbGVcclxuICAgICAgICBpbWcuY2xhc3NMaXN0LmFkZCgnc2VsZWN0ZWQnKTtcclxuICAgICAgICAvLyBNZXR0cmUgw6Agam91ciBsZSBjaGFtcCBjYWNow6kgaW5zdHJ1bWVudFxyXG4gICAgICAgIGNvbnN0IGlucHV0SW5zdHJ1bWVudCA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJ2lucHV0W25hbWU9XCJ2aWRlb19pbnN0cnVtZW50W2luc3RydW1lbnRdXCJdJyk7XHJcbiAgICAgICAgaWYgKGlucHV0SW5zdHJ1bWVudCkge1xyXG4gICAgICAgICAgICBpbnB1dEluc3RydW1lbnQudmFsdWUgPSBpbWcuZGF0YXNldC5pbnN0cnVtZW50SWQ7XHJcbiAgICAgICAgfVxyXG4gICAgfSk7XHJcbn0pO1xyXG59KTtcclxuXHJcbi8vIHByb3h5XHJcbi8vIGZldGNoKCcvcHJveHktZ29vZ2xlYWRzJylcclxuLy8gICAudGhlbihyZXNwb25zZSA9PiByZXNwb25zZS50ZXh0KCkpXHJcbi8vICAgLnRoZW4odGV4dCA9PiB7XHJcbi8vIFx0Y29uc29sZS5sb2cgKCdzY3JpcHQgY2hhcmfDqScpXHJcbi8vICAgICBjb25zb2xlLmxvZygnUsOpcG9uc2UgYnJ1dGU6JywgSlNPTi5zdHJpbmdpZnkodGV4dCkpO1xyXG5cclxuLy8gICAgIC8vIE5ldHRvaWUgdG91dCBjZSBxdWkgcHLDqWPDqGRlIGxlIHByZW1pZXIgeyBvdSBbXHJcbi8vICAgICBsZXQgY2xlYW5lZCA9IHRleHQudHJpbSgpLnJlcGxhY2UoL15bXlxcW3tdKy8sICcnKTtcclxuLy8gICAgIGNvbnNvbGUubG9nKCdBcHLDqHMgbmV0dG95YWdlOicsIEpTT04uc3RyaW5naWZ5KGNsZWFuZWQpKTtcclxuXHJcbi8vICAgICB0cnkge1xyXG4vLyAgICAgICBsZXQgZGF0YSA9IEpTT04ucGFyc2UoY2xlYW5lZCk7XHJcbi8vICAgICAgIGNvbnNvbGUubG9nKCdEb25uw6llcyBKU09OOicsIGRhdGEpO1xyXG4vLyAgICAgfSBjYXRjaCAoZSkge1xyXG4vLyAgICAgICBjb25zb2xlLmVycm9yKCdFcnJldXIgZGUgcGFyc2luZzonLCBlLCAnQ2hhw65uZSBuZXR0b3nDqWU6JywgY2xlYW5lZCk7XHJcbi8vICAgICB9XHJcbi8vICAgfSlcclxuLy8gICAuY2F0Y2goZXJyb3IgPT4gY29uc29sZS5lcnJvcignRXJyZXVyIGZldGNoOicsIGVycm9yKSk7XHJcblxyXG5cclxuZmV0Y2goJ2h0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9wcm94eS1nb29nbGVhZHMnKVxyXG4gICAgLnRoZW4ocmVzcG9uc2UgPT4ge1xyXG4gICAgICAgIGlmICghcmVzcG9uc2Uub2spIHtcclxuICAgICAgICAgICAgdGhyb3cgbmV3IEVycm9yKCdOZXR3b3JrIHJlc3BvbnNlIHdhcyBub3Qgb2snKTtcclxuICAgICAgICB9XHJcbiAgICAgICAgcmV0dXJuIHJlc3BvbnNlLmpzb24oKTtcclxuICAgIH0pXHJcbiAgICAudGhlbihkYXRhID0+IHtcclxuICAgICAgICBjb25zb2xlLmxvZygnRG9ubsOpZXMgSlNPTjonLCBkYXRhKTtcclxuICAgIH0pXHJcbiAgICAuY2F0Y2goZXJyb3IgPT4gY29uc29sZS5lcnJvcignRXJyZXVyOicsIGVycm9yKSk7XHJcblxyXG5cclxuXHJcbiIsIi8vIGV4dHJhY3RlZCBieSBtaW5pLWNzcy1leHRyYWN0LXBsdWdpblxuZXhwb3J0IHt9OyJdLCJuYW1lcyI6WyJkb2N1bWVudCIsImFkZEV2ZW50TGlzdGVuZXIiLCJ2aWRlbyIsImdldEVsZW1lbnRCeUlkIiwicGxheWJhY2tSYXRlIiwicXVlcnlTZWxlY3RvckFsbCIsImZvckVhY2giLCJpbWciLCJlbCIsImNsYXNzTGlzdCIsInJlbW92ZSIsImFkZCIsImlucHV0U2VsZWN0ZWRWaWRlbyIsInF1ZXJ5U2VsZWN0b3IiLCJ2YWx1ZSIsImRhdGFzZXQiLCJ2aWRlb0lkIiwiaW5wdXRJbnN0cnVtZW50IiwiaW5zdHJ1bWVudElkIiwiZmV0Y2giLCJ0aGVuIiwicmVzcG9uc2UiLCJvayIsIkVycm9yIiwianNvbiIsImRhdGEiLCJjb25zb2xlIiwibG9nIiwiZXJyb3IiXSwic291cmNlUm9vdCI6IiJ9