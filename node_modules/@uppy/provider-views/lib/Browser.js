"use strict";

var _preact = require("preact");

const classNames = require("classnames");

const remoteFileObjToLocal = require("@uppy/utils/lib/remoteFileObjToLocal");

const Filter = require("./Filter.js");

const FooterActions = require("./FooterActions.js");

const Item = require("./Item/index.js");

const VIRTUAL_SHARED_DIR = 'shared-with-me';

function Browser(props) {
  const {
    currentSelection,
    folders,
    files,
    uppyFiles,
    viewType,
    headerComponent,
    showBreadcrumbs,
    isChecked,
    toggleCheckbox,
    recordShiftKeyPress,
    handleScroll,
    showTitles,
    i18n,
    validateRestrictions,
    showFilter,
    filterQuery,
    filterInput,
    getNextFolder,
    cancel,
    done,
    columns
  } = props;
  const selected = currentSelection.length;
  return (0, _preact.h)("div", {
    className: classNames('uppy-ProviderBrowser', `uppy-ProviderBrowser-viewType--${viewType}`)
  }, (0, _preact.h)("div", {
    className: "uppy-ProviderBrowser-header"
  }, (0, _preact.h)("div", {
    className: classNames('uppy-ProviderBrowser-headerBar', !showBreadcrumbs && 'uppy-ProviderBrowser-headerBar--simple')
  }, headerComponent)), showFilter && (0, _preact.h)(Filter, {
    i18n: i18n,
    filterQuery: filterQuery,
    filterInput: filterInput
  }), (() => {
    if (!folders.length && !files.length) {
      return (0, _preact.h)("div", {
        className: "uppy-Provider-empty"
      }, i18n('noFilesFound'));
    }

    return (0, _preact.h)("div", {
      className: "uppy-ProviderBrowser-body"
    }, (0, _preact.h)("ul", {
      className: "uppy-ProviderBrowser-list",
      onScroll: handleScroll,
      role: "listbox" // making <ul> not focusable for firefox
      ,
      tabIndex: "-1"
    }, folders.map(folder => {
      var _isChecked;

      return Item({
        columns,
        showTitles,
        viewType,
        i18n,
        id: folder.id,
        title: folder.name,
        getItemIcon: () => folder.icon,
        isChecked: isChecked(folder),
        toggleCheckbox: event => toggleCheckbox(event, folder),
        recordShiftKeyPress,
        type: 'folder',
        isDisabled: (_isChecked = isChecked(folder)) == null ? void 0 : _isChecked.loading,
        isCheckboxDisabled: folder.id === VIRTUAL_SHARED_DIR,
        handleFolderClick: () => getNextFolder(folder)
      });
    }), files.map(file => {
      const validated = validateRestrictions(remoteFileObjToLocal(file), [...uppyFiles, ...currentSelection]);
      return Item({
        id: file.id,
        title: file.name,
        author: file.author,
        getItemIcon: () => file.icon,
        isChecked: isChecked(file),
        toggleCheckbox: event => toggleCheckbox(event, file),
        recordShiftKeyPress,
        columns,
        showTitles,
        viewType,
        i18n,
        type: 'file',
        isDisabled: !validated.result && !isChecked(file),
        restrictionReason: validated.reason
      });
    })));
  })(), selected > 0 && (0, _preact.h)(FooterActions, {
    selected: selected,
    done: done,
    cancel: cancel,
    i18n: i18n
  }));
}

module.exports = Browser;