const Flickity = require("flickity");
require("flickity-imagesloaded");

const gridSliders = document.querySelectorAll(".grid--slider");

for (let i = 0; i < gridSliders.length; i += 1) {
  const flickity = new Flickity(gridSliders[i], {
    imagesLoaded: true,
    pageDots: false,
    dragThreshold: true,
    cellAlign: "left",
    watchCSS: true,
    prevNextButtons: false
  });
}
