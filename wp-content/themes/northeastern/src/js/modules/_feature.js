const Flickity = require("flickity");
require("flickity-imagesloaded");

const featureSliders = document.querySelectorAll(".feature--slider");

for (let i = 0; i < featureSliders.length; i += 1) {
  const featureSlide = new Flickity(featureSliders[i], {
    imagesLoaded: true,
    dragThreshold: 6
  });
}
