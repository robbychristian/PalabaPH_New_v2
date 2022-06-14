/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/firebase-messaging-sw.js":
/*!***********************************************!*\
  !*** ./resources/js/firebase-messaging-sw.js ***!
  \***********************************************/
/***/ (() => {

eval("importScripts(\"https://www.gstatic.com/firebasejs/3.9.0/firebase-app.js\");\nimportScripts(\"https://www.gstatic.com/firebasejs/3.9.0/firebase-messaging.js\"); // Initialize the Firebase app in the service worker by passing in the\n// messagingSenderId.\n\nfirebase.initializeApp({\n  messagingSenderId: \"373825974217\"\n}); // Retrieve an instance of Firebase Messaging so that it can handle background\n// messages.\n\nvar messaging = firebase.messaging();\nmessaging.setBackgroundMessageHandler(function (payload) {\n  console.log(\"[firebase-messaging-sw.js] Received background message \", payload); // Customize notification here\n\n  var notificationTitle = \"Background Message Title\";\n  var notificationOptions = {\n    body: \"Background Message body.\",\n    icon: \"https://images.theconversation.com/files/93616/original/image-20150902-6700-t2axrz.jpg\" //your logo here\n\n  };\n  return self.registration.showNotification(notificationTitle, notificationOptions);\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvZmlyZWJhc2UtbWVzc2FnaW5nLXN3LmpzLmpzIiwibmFtZXMiOlsiaW1wb3J0U2NyaXB0cyIsImZpcmViYXNlIiwiaW5pdGlhbGl6ZUFwcCIsIm1lc3NhZ2luZ1NlbmRlcklkIiwibWVzc2FnaW5nIiwic2V0QmFja2dyb3VuZE1lc3NhZ2VIYW5kbGVyIiwicGF5bG9hZCIsImNvbnNvbGUiLCJsb2ciLCJub3RpZmljYXRpb25UaXRsZSIsIm5vdGlmaWNhdGlvbk9wdGlvbnMiLCJib2R5IiwiaWNvbiIsInNlbGYiLCJyZWdpc3RyYXRpb24iLCJzaG93Tm90aWZpY2F0aW9uIl0sInNvdXJjZVJvb3QiOiIiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvZmlyZWJhc2UtbWVzc2FnaW5nLXN3LmpzPzYzMjAiXSwic291cmNlc0NvbnRlbnQiOlsiaW1wb3J0U2NyaXB0cyhcImh0dHBzOi8vd3d3LmdzdGF0aWMuY29tL2ZpcmViYXNlanMvMy45LjAvZmlyZWJhc2UtYXBwLmpzXCIpO1xuaW1wb3J0U2NyaXB0cyhcImh0dHBzOi8vd3d3LmdzdGF0aWMuY29tL2ZpcmViYXNlanMvMy45LjAvZmlyZWJhc2UtbWVzc2FnaW5nLmpzXCIpO1xuXG4vLyBJbml0aWFsaXplIHRoZSBGaXJlYmFzZSBhcHAgaW4gdGhlIHNlcnZpY2Ugd29ya2VyIGJ5IHBhc3NpbmcgaW4gdGhlXG4vLyBtZXNzYWdpbmdTZW5kZXJJZC5cbmZpcmViYXNlLmluaXRpYWxpemVBcHAoe1xuICAgIG1lc3NhZ2luZ1NlbmRlcklkOiBcIjM3MzgyNTk3NDIxN1wiLFxufSk7XG5cbi8vIFJldHJpZXZlIGFuIGluc3RhbmNlIG9mIEZpcmViYXNlIE1lc3NhZ2luZyBzbyB0aGF0IGl0IGNhbiBoYW5kbGUgYmFja2dyb3VuZFxuLy8gbWVzc2FnZXMuXG5jb25zdCBtZXNzYWdpbmcgPSBmaXJlYmFzZS5tZXNzYWdpbmcoKTtcblxubWVzc2FnaW5nLnNldEJhY2tncm91bmRNZXNzYWdlSGFuZGxlcihmdW5jdGlvbiAocGF5bG9hZCkge1xuICAgIGNvbnNvbGUubG9nKFxuICAgICAgICBcIltmaXJlYmFzZS1tZXNzYWdpbmctc3cuanNdIFJlY2VpdmVkIGJhY2tncm91bmQgbWVzc2FnZSBcIixcbiAgICAgICAgcGF5bG9hZFxuICAgICk7XG4gICAgLy8gQ3VzdG9taXplIG5vdGlmaWNhdGlvbiBoZXJlXG4gICAgY29uc3Qgbm90aWZpY2F0aW9uVGl0bGUgPSBcIkJhY2tncm91bmQgTWVzc2FnZSBUaXRsZVwiO1xuICAgIGNvbnN0IG5vdGlmaWNhdGlvbk9wdGlvbnMgPSB7XG4gICAgICAgIGJvZHk6IFwiQmFja2dyb3VuZCBNZXNzYWdlIGJvZHkuXCIsXG4gICAgICAgIGljb246IFwiaHR0cHM6Ly9pbWFnZXMudGhlY29udmVyc2F0aW9uLmNvbS9maWxlcy85MzYxNi9vcmlnaW5hbC9pbWFnZS0yMDE1MDkwMi02NzAwLXQyYXhyei5qcGdcIiwgLy95b3VyIGxvZ28gaGVyZVxuICAgIH07XG5cbiAgICByZXR1cm4gc2VsZi5yZWdpc3RyYXRpb24uc2hvd05vdGlmaWNhdGlvbihcbiAgICAgICAgbm90aWZpY2F0aW9uVGl0bGUsXG4gICAgICAgIG5vdGlmaWNhdGlvbk9wdGlvbnNcbiAgICApO1xufSk7XG4iXSwibWFwcGluZ3MiOiJBQUFBQSxhQUFhLENBQUMsMERBQUQsQ0FBYjtBQUNBQSxhQUFhLENBQUMsZ0VBQUQsQ0FBYixDLENBRUE7QUFDQTs7QUFDQUMsUUFBUSxDQUFDQyxhQUFULENBQXVCO0VBQ25CQyxpQkFBaUIsRUFBRTtBQURBLENBQXZCLEUsQ0FJQTtBQUNBOztBQUNBLElBQU1DLFNBQVMsR0FBR0gsUUFBUSxDQUFDRyxTQUFULEVBQWxCO0FBRUFBLFNBQVMsQ0FBQ0MsMkJBQVYsQ0FBc0MsVUFBVUMsT0FBVixFQUFtQjtFQUNyREMsT0FBTyxDQUFDQyxHQUFSLENBQ0kseURBREosRUFFSUYsT0FGSixFQURxRCxDQUtyRDs7RUFDQSxJQUFNRyxpQkFBaUIsR0FBRywwQkFBMUI7RUFDQSxJQUFNQyxtQkFBbUIsR0FBRztJQUN4QkMsSUFBSSxFQUFFLDBCQURrQjtJQUV4QkMsSUFBSSxFQUFFLHdGQUZrQixDQUV3RTs7RUFGeEUsQ0FBNUI7RUFLQSxPQUFPQyxJQUFJLENBQUNDLFlBQUwsQ0FBa0JDLGdCQUFsQixDQUNITixpQkFERyxFQUVIQyxtQkFGRyxDQUFQO0FBSUgsQ0FoQkQifQ==\n//# sourceURL=webpack-internal:///./resources/js/firebase-messaging-sw.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/firebase-messaging-sw.js"]();
/******/ 	
/******/ })()
;