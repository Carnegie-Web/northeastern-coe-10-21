const Flickity = require("flickity");
require("flickity-imagesloaded");

const blockquotes = document.querySelectorAll(".blockquote--slider");

for (let i = 0; i < blockquotes.length; i += 1) {
  const slide = new Flickity(blockquotes[i], {
    imagesLoaded: true,
    pageDots: false
  });
}
