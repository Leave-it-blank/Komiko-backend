"use strict";

var _preact = require("preact");

class CloseWrapper extends _preact.Component {
  componentWillUnmount() {
    const {
      onUnmount
    } = this.props;
    onUnmount();
  }

  render() {
    const {
      children
    } = this.props;
    return (0, _preact.toChildArray)(children)[0];
  }

}

module.exports = CloseWrapper;