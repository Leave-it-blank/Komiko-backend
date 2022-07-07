"use strict";

var _preact = require("preact");

module.exports = _ref => {
  let {
    i18n,
    search
  } = _ref;
  let input;

  const validateAndSearch = () => {
    if (input.value) {
      search(input.value);
    }
  };

  const handleKeyPress = ev => {
    if (ev.keyCode === 13) {
      validateAndSearch();
    }
  };

  return (0, _preact.h)("div", {
    className: "uppy-SearchProvider"
  }, (0, _preact.h)("input", {
    className: "uppy-u-reset uppy-c-textInput uppy-SearchProvider-input",
    type: "search",
    "aria-label": i18n('enterTextToSearch'),
    placeholder: i18n('enterTextToSearch'),
    onKeyUp: handleKeyPress,
    ref: input_ => {
      input = input_;
    },
    "data-uppy-super-focusable": true
  }), (0, _preact.h)("button", {
    className: "uppy-u-reset uppy-c-btn uppy-c-btn-primary uppy-SearchProvider-searchButton",
    type: "button",
    onClick: validateAndSearch
  }, i18n('searchImages')));
};