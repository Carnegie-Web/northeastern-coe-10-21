const log = require("debug")("northeastern:expand");

import triggerResize from "../util/_trigger-resize";

// Mobile/Tablet accordion expand section

const expandAccordionToggle = document.querySelectorAll(
  ".expand__accordion__toggle"
);
const expandAccordionContent = document.querySelectorAll(
  ".expand__accordion__content"
);

const getHeight = function getHeight(el) {
  const clone = el.cloneNode(true);
  clone.classList.add("js-clone");
  el.parentNode.insertBefore(clone, el);
  const height = clone.offsetHeight;
  el.parentNode.removeChild(clone);
  return height;
};

const expandToggleAccordion = function toggleAccordion(el) {
  el.addEventListener("click", () => {
    el.classList.toggle("expand__accordion__toggle--active");
    el.nextElementSibling.classList.toggle(
      "expand__accordion__content--active"
    );
    triggerResize();
  });
};

const setHeight = function setHeight(el) {
  const parent = el;
  const interior = el.querySelector(".expand__accordion__interior");
  const height = getHeight(interior);
  parent.style.height = `${height}px`;
};

Array.from(expandAccordionToggle).forEach(expandToggleAccordion);
Array.from(expandAccordionContent)
  .reverse()
  .forEach(setHeight);

window.addEventListener("load", () => {
  Array.from(expandAccordionContent)
    .reverse()
    .forEach(setHeight);
});

window.addEventListener("resize", () => {
  Array.from(expandAccordionContent)
    .reverse()
    .forEach(setHeight);
});

// Expand the link list section at desktop

$(".expand__btn--list").on("click", () => {
  $(".expand__container--list").toggleClass("expand-active");
});

/*
  Contact item card expand section
   If section only has 3 or less, do not have expansion as an option.

   If greater than 3, show at least 2 cards before expansion section.
*/

const contactGroups = $(".expand__container--contacts");

function collapseContactGroup(container) {
  $(container).addClass("collapsed");
  $(container)
    .parent()
    .removeClass("expand-active");

  const height = $(container)
    .find(".contact__item")
    .slice(0, 4)
    .map((idx, elem) => $(elem).outerHeight())
    .get()
    .reduce((a, b) => a + b);

  log(height);

  $(container).css("height", height + "px");
}

function expandContactGroup(container) {
  const height = $(container).children().first().outerHeight(true);


  $(container).removeClass("collapsed");
  $(container)
    .parent()
    .addClass("expand-active");

  $(container).css("height", height + "px");
}

function toggleContactGroup(container) {
  if ($(container).hasClass("collapsed")) {
    expandContactGroup(container);
  } else {
    collapseContactGroup(container);
  }
}

contactGroups.each((idx, contactGroup) => {
  const contactItems = $(contactGroup).find(".contact__item");
  if (contactItems.length <= 3) {
    $(contactGroup).addClass("no-expand");
  } else {
    const expandContainerGroup = $(contactGroup).find(
      ".expand__container__group"
    );
    collapseContactGroup(expandContainerGroup);
  }
});

$(".expand__btn--contacts").click(function() {
  const contactGroup = $(this).closest(".expand__container--contacts");

  const container = $(contactGroup).find(".expand__container__group");

  toggleContactGroup(container);
});
