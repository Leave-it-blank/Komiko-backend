"use strict";

var _preact = require("preact");

// if folder:
//   + checkbox (selects all files from folder)
//   + folder name (opens folder)
// if file:
//   + checkbox (selects file)
//   + file name (selects file)
function ListItem(props) {
  const {
    className,
    isDisabled,
    restrictionReason,
    isCheckboxDisabled,
    isChecked,
    toggleCheckbox,
    recordShiftKeyPress,
    type,
    id,
    itemIconEl,
    title,
    handleFolderClick,
    showTitles,
    i18n
  } = props;
  return (0, _preact.h)("li", {
    className: className,
    title: isDisabled ? restrictionReason : null
  }, !isCheckboxDisabled ? (0, _preact.h)("input", {
    type: "checkbox",
    className: `uppy-u-reset uppy-ProviderBrowserItem-checkbox ${isChecked ? 'uppy-ProviderBrowserItem-checkbox--is-checked' : ''}`,
    onChange: toggleCheckbox,
    onKeyDown: recordShiftKeyPress // for the <label/>
    ,
    name: "listitem",
    id: id,
    checked: isChecked,
    "aria-label": type === 'file' ? null : i18n('allFilesFromFolderNamed', {
      name: title
    }),
    disabled: isDisabled,
    "data-uppy-super-focusable": true
  }) : null, type === 'file' ? // label for a checkbox
  (0, _preact.h)("label", {
    htmlFor: id,
    className: "uppy-u-reset uppy-ProviderBrowserItem-inner"
  }, (0, _preact.h)("div", {
    className: "uppy-ProviderBrowserItem-iconWrap"
  }, itemIconEl), showTitles && title) : // button to open a folder
  (0, _preact.h)("button", {
    type: "button",
    className: "uppy-u-reset uppy-ProviderBrowserItem-inner",
    onClick: handleFolderClick,
    "aria-label": i18n('openFolderNamed', {
      name: title
    })
  }, (0, _preact.h)("div", {
    className: "uppy-ProviderBrowserItem-iconWrap"
  }, itemIconEl), showTitles && (0, _preact.h)("span", null, title)));
}

module.exports = ListItem;