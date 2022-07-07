"use strict";

var _preact = require("preact");

module.exports = _ref => {
  let {
    cancel,
    done,
    i18n,
    selected
  } = _ref;
  return (0, _preact.h)("div", {
    className: "uppy-ProviderBrowser-footer"
  }, (0, _preact.h)("button", {
    className: "uppy-u-reset uppy-c-btn uppy-c-btn-primary",
    onClick: done,
    type: "button"
  }, i18n('selectX', {
    smart_count: selected
  })), (0, _preact.h)("button", {
    className: "uppy-u-reset uppy-c-btn uppy-c-btn-link",
    onClick: cancel,
    type: "button"
  }, i18n('cancel')));
};