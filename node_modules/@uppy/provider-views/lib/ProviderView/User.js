"use strict";

var _preact = require("preact");

module.exports = _ref => {
  let {
    i18n,
    logout,
    username
  } = _ref;
  return [(0, _preact.h)("span", {
    className: "uppy-ProviderBrowser-user",
    key: "username"
  }, username), (0, _preact.h)("button", {
    type: "button",
    onClick: logout,
    className: "uppy-u-reset uppy-ProviderBrowser-userLogout",
    key: "logout"
  }, i18n('logOut'))];
};