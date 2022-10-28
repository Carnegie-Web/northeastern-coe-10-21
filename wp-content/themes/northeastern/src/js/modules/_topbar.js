const body = $("body");
let winWidth = $(window).width();
let megaHeight = $(".mega").outerHeight();
let nuHeaderHeight = $("#nu__globalheader").outerHeight();
const trackHeight = function trackHeight() {
  winWidth = $(window).width();
  let tempMegaHeight = $(".mega").outerHeight();
  let megaHeight = tempMegaHeight + 100;
  let tempSearchHeight = $(".search").outerHeight();
  let searchHeight = tempSearchHeight + 100;
  const megaRound = Math.round(megaHeight);
  const searchRound = Math.round(searchHeight);
  if (winWidth > 1024) {
    if (body.hasClass("info-active")) {
      $(".menu").css({
        "margin-top": megaRound + "px"
      });
    } else if (body.hasClass("search-active")) {
      $(".menu").css({
        "margin-top": searchRound + "px"
      });
    } else {
      $(".menu").removeAttr("style");
    }
  } else {
    $(".menu").removeAttr("style");
  }

  requestAnimationFrame(trackHeight);
};

trackHeight();

const activateInfo = function() {
  body.addClass("info-active");
  deactivateSearch();
};

const deactivateInfo = function() {
  body.removeClass("info-active");
};

const toggleInfo = function() {
  if (body.hasClass("info-active")) {
    deactivateInfo();
  } else {
    activateInfo();
  }
};

const activateSearch = function() {
  body.addClass("search-active");
  setTimeout(() => {
    $(".search__input").focus();
  }, 250);
  deactivateInfo();
};

const deactivateSearch = function() {
  body.removeClass("search-active");
};

const toggleSearch = function() {
  if (body.hasClass("search-active")) {
    deactivateSearch();
  } else {
    activateSearch();
  }
};

$(".toggle-info").on("click", () => {
  toggleInfo();
});

$(".mega__btn").on("click", () => {
  deactivateInfo();
});

$(".toggle-search").on("click", () => {
  toggleSearch();
});
