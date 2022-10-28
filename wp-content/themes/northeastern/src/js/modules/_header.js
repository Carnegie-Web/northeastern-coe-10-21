const body = $("body");
const bodyScrollLock = require("body-scroll-lock");
const disableBodyScroll = bodyScrollLock.disableBodyScroll;
const enableBodyScroll = bodyScrollLock.enableBodyScroll;

const targetElement = document.querySelector(".header__menu");

const activateMenu = function() {
  body.addClass("menu-active");
  disableBodyScroll(targetElement);
};

const deactivateMenu = function() {
  body.removeClass("menu-active");
  enableBodyScroll(targetElement);
};

const toggleMenu = function() {
  if (body.hasClass("menu-active")) {
    deactivateMenu();
  } else {
    activateMenu();
  }
};

$(".toggle-menu").on("click", () => {
  toggleMenu();
});
