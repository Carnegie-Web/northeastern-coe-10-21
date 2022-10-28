const subnav = $(".subnav");
const subnavToggle = $(".subnav__toggle");
const subnavList = $(".subnav__list");

let winWidth = $(window).width();
// accessibility

const ally = function ally() {
  winWidth = $(window).width();

  if (winWidth < 1024) {
    if (subnav.hasClass("subnav--active")) {
      subnavToggle.attr("aria-expanded", true);
      subnavList.attr("aria-hidden", false);
    } else {
      subnavToggle.attr("aria-expanded", false);
      subnavList.attr("aria-hidden", true);
    }
  } else {
    subnavToggle.removeAttr("aria-expanded");
    subnavList.removeAttr("aria-hidden");
  }
  requestAnimationFrame(ally);
};

ally();

$(".subnav__toggle").on("click", function(e) {
  if (subnav.hasClass("subnav--active")) {
    subnav.removeClass("subnav--active");
  } else {
    subnav.addClass("subnav--active");
  }
  e.preventDefault();
});

$(".subnav__link__toggle").on("click", function() {
  const item = $(this);
  const subnavItem = $(this)
    .parent()
    .parent();
  const subnavSubList = $(this)
    .parent()
    .next(".subnav__list--sub");

  if (subnavItem.hasClass("subnav__item--active")) {
    item.attr("aria-expanded", false);
    subnavItem.removeClass("subnav__item--active");
    subnavSubList.attr("aria-hidden", true);
  } else {
    item.attr("aria-expanded", true);
    subnavItem.addClass("subnav__item--active");
    subnavSubList.attr("aria-hidden", false);
  }
});
