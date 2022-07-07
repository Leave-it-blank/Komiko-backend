"use strict";

var _preact = require("preact");

const Breadcrumb = props => {
  const {
    getFolder,
    title,
    isLast
  } = props;
  return (0, _preact.h)(_preact.Fragment, null, (0, _preact.h)("button", {
    type: "button",
    className: "uppy-u-reset",
    onClick: getFolder
  }, title), !isLast ? ' / ' : '');
};

module.exports = props => {
  const {
    getFolder,
    title,
    breadcrumbsIcon,
    directories
  } = props;
  return (0, _preact.h)("div", {
    className: "uppy-Provider-breadcrumbs"
  }, (0, _preact.h)("div", {
    className: "uppy-Provider-breadcrumbsIcon"
  }, breadcrumbsIcon), directories.map((directory, i) => (0, _preact.h)(Breadcrumb, {
    key: directory.id,
    getFolder: () => getFolder(directory.id),
    title: i === 0 ? title : directory.title,
    isLast: i + 1 === directories.length
  })));
};