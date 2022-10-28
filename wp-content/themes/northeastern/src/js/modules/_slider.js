const Flickity = require("flickity");
require("flickity-imagesloaded");

const sliders = document.querySelectorAll(".slider");

for (let i = 0; i < sliders.length; i += 1) {
  const slide = new Flickity(sliders[i], {
    imagesLoaded: true,
    pageDots: false,
  });
}
