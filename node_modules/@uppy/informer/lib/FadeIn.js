"use strict";

var _preact = require("preact");

const TRANSITION_MS = 300;

class FadeIn extends _preact.Component {
  constructor() {
    super(...arguments);
    this.ref = (0, _preact.createRef)();
  }

  componentWillEnter(callback) {
    this.ref.current.style.opacity = '1';
    this.ref.current.style.transform = 'none';
    setTimeout(callback, TRANSITION_MS);
  }

  componentWillLeave(callback) {
    this.ref.current.style.opacity = '0';
    this.ref.current.style.transform = 'translateY(350%)';
    setTimeout(callback, TRANSITION_MS);
  }

  render() {
    const {
      children
    } = this.props;
    return (0, _preact.h)("div", {
      className: "uppy-Informer-animated",
      ref: this.ref
    }, children);
  }

}

module.exports = FadeIn;