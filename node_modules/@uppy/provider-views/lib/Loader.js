"use strict";

var _preact = require("preact");

module.exports = _ref => {
  let {
    i18n
  } = _ref;
  return (0, _preact.h)("div", {
    className: "uppy-Provider-loading"
  }, (0, _preact.h)("span", null, i18n('loading')));
};