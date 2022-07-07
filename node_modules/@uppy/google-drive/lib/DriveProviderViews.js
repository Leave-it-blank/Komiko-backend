"use strict";

var _providerViews = require("@uppy/provider-views");

class DriveProviderViews extends _providerViews.ProviderViews {
  toggleCheckbox(e, file) {
    e.stopPropagation();
    e.preventDefault(); // Shared Drives aren't selectable; for all else, defer to the base ProviderView.

    if (!file.custom.isSharedDrive) {
      super.toggleCheckbox(e, file);
    }
  }

}

module.exports = DriveProviderViews;