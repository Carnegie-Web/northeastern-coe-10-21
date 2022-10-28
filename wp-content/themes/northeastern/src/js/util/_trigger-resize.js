const triggerResize = function triggerResize() {
  if (typeof Event === "function") {
    window.dispatchEvent(new Event("resize"));
  } else {
    const evt = window.document.createEvent("UIEvents");
    evt.initUIEvent("resize", true, false, window, 0);
    window.dispatchEvent(evt);
  }
};

export default triggerResize;
