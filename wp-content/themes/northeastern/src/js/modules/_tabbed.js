import triggerResize from "../util/_trigger-resize";

const tabbed = document.querySelectorAll(".tabbed");

Array.from(tabbed).forEach(el => {
  /* elements */
  const buttons = el.querySelectorAll(".tabbed__nav__button");
  const item = el.querySelectorAll(".tabbed__content__item");
  /* activate first element on load */
  buttons[0].classList.add("tabbed__nav__button--active");
  item[0].classList.add("tabbed__content__item--active");
  /* trigger resize for hidden accordions */
  triggerResize();
  /* toggle */
  Array.from(buttons).forEach((button, index) => {
    button.addEventListener("click", () => {
      /* last active elements */
      const lastButton = el.querySelector(".tabbed__nav__button--active");
      const lastItem = el.querySelector(".tabbed__content__item--active");
      /* clear active elements */
      lastButton.classList.remove("tabbed__nav__button--active");
      lastItem.classList.remove("tabbed__content__item--active");
      /* activate new elements */
      buttons[index].classList.add("tabbed__nav__button--active");
      item[index].classList.add("tabbed__content__item--active");
      /* trigger resize for hidden accordions */
      triggerResize();
    });
  });
});
