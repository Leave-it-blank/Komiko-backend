"use strict";

var _preact = require("preact");

function _extends() { _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; }; return _extends.apply(this, arguments); }

const classNames = require("classnames");

const ItemIcon = require("./components/ItemIcon.js");

const GridListItem = require("./components/GridLi.js");

const ListItem = require("./components/ListLi.js");

module.exports = props => {
  const {
    author,
    getItemIcon,
    isChecked,
    isDisabled,
    viewType
  } = props;
  const itemIconString = getItemIcon();
  const className = classNames('uppy-ProviderBrowserItem', {
    'uppy-ProviderBrowserItem--selected': isChecked
  }, {
    'uppy-ProviderBrowserItem--disabled': isDisabled
  }, {
    'uppy-ProviderBrowserItem--noPreview': itemIconString === 'video'
  });
  const itemIconEl = (0, _preact.h)(ItemIcon, {
    itemIconString: itemIconString
  });

  switch (viewType) {
    case 'grid':
      return (0, _preact.h)(GridListItem // eslint-disable-next-line react/jsx-props-no-spreading
      , _extends({}, props, {
        className: className,
        itemIconEl: itemIconEl
      }));

    case 'list':
      return (// eslint-disable-next-line react/jsx-props-no-spreading
        (0, _preact.h)(ListItem, _extends({}, props, {
          className: className,
          itemIconEl: itemIconEl
        }))
      );

    case 'unsplash':
      return (// eslint-disable-next-line react/jsx-props-no-spreading
        (0, _preact.h)(GridListItem, _extends({}, props, {
          className: className,
          itemIconEl: itemIconEl
        }), (0, _preact.h)("a", {
          href: `${author.url}?utm_source=Companion&utm_medium=referral`,
          target: "_blank",
          rel: "noopener noreferrer",
          className: "uppy-ProviderBrowserItem-author"
        }, author.name))
      );

    default:
      throw new Error(`There is no such type ${viewType}`);
  }
};