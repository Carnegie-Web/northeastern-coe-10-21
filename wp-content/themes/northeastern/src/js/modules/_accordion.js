import triggerResize from "../util/_trigger-resize";

const accordionToggle = document.querySelectorAll(".accordion__toggle");
const accordionContent = document.querySelectorAll(
  ".accordion__content, .tabbed__content__item"
);

const getHeight = function getHeight(el) {
  const clone = el.cloneNode(true);
  clone.classList.add("js-clone");
  el.parentNode.insertBefore(clone, el);
  const height = clone.offsetHeight;
  el.parentNode.removeChild(clone);
  return height;
};

const toggleAccordion = function toggleAccordion(el) {
  el.addEventListener("click", () => {
    el.classList.toggle("accordion__toggle--active");
    el.nextElementSibling.classList.toggle("accordion__content--active");
    /* trigger resize for hidden accordions */
    triggerResize();
  });
};

const setHeight = function setHeight(el) {
  const parent = el;
  const interior =
    el.querySelector(".tabbed__content__interior") ||
    el.querySelector(".accordion__interior");
  const height = getHeight(interior);
  parent.style.height = `${height}px`;
};

Array.from(accordionToggle).forEach(toggleAccordion);
Array.from(accordionContent)
  .reverse()
  .forEach(setHeight);

window.addEventListener("load", () => {
  Array.from(accordionContent)
    .reverse()
    .forEach(setHeight);
});

window.addEventListener("resize", () => {
  Array.from(accordionContent)
    .reverse()
    .forEach(setHeight);
});
