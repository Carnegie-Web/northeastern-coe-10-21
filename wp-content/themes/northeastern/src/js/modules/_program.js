const body = $("body");

const canvas = document.querySelector(".canvas");
const hero = document.querySelector(".hero");
const program = document.querySelector(".program");

const watch = function watch() {
  const heroOffset = parseInt(
    getComputedStyle(hero).getPropertyValue("height"),
    10
  );
  const width = window.innerWidth;
  const scroll = document.body.scrollTop || document.documentElement.scrollTop;
  const limit = hero.getBoundingClientRect().top + scroll + heroOffset;

    if (scroll > limit) {
      canvas.classList.add("program-sticky--active");
    } else {
      canvas.classList.remove("program-sticky--active");
    }


  requestAnimationFrame(watch);
};

if (program) {
  watch();
}
