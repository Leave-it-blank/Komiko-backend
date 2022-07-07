"use strict";

var _preact = require("preact");

function GridListItem(props) {
  const {
    className,
    isDisabled,
    restrictionReason,
    isChecked,
    title,
    itemIconEl,
    showTitles,
    toggleCheckbox,
    recordShiftKeyPress,
    id,
    children
  } = props;
  return (0, _preact.h)("li", {
    className: className,
    title: isDisabled ? restrictionReason : null
  }, (0, _preact.h)("input", {
    type: "checkbox",
    className: `uppy-u-reset uppy-ProviderBrowserItem-checkbox ${isChecked ? 'uppy-ProviderBrowserItem-checkbox--is-checked' : ''} uppy-ProviderBrowserItem-checkbox--grid`,
    onChange: toggleCheckbox,
    onKeyDown: recordShiftKeyPress,
    name: "listitem",
    id: id,
    checked: isChecked,
    disabled: isDisabled,
    "data-uppy-super-focusable": true
  }), (0, _preact.h)("label", {
    htmlFor: id,
    "aria-label": title,
    className: "uppy-u-reset uppy-ProviderBrowserItem-inner"
  }, (0, _preact.h)("span", {
    className: "uppy-ProviderBrowserItem-inner-relative"
  }, itemIconEl, showTitles && title, children)));
}

module.exports = GridListItem;