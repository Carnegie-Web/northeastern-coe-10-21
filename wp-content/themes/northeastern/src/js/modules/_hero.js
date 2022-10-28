// hero home
const backgrounds = $(".hero__background");
let formerBackground = "#background-1";

const heroInit = () => {
  $(formerBackground).css("opacity", 1);
};

const heroHover = elem => {
  let target = $(elem);
  let backgroundId = "#" + target.attr("data-id");

  $(".hero__link").removeClass("active");
  target.addClass("active");

  if (formerBackground != backgroundId) {
    $(formerBackground).css("opacity", "0");
    formerBackground = backgroundId;
    $(backgroundId).css("opacity", "1");
    console.log(backgroundId);
  }
};

heroInit();

$(".hero__link").on("mouseenter focus", function() {
  heroHover(this);
});

// hero slider
const Flickity = require("flickity");
require("flickity-imagesloaded");

const heroSliders = document.querySelectorAll(".hero--slider");

for (let i = 0; i < heroSliders.length; i += 1) {
  const heroSlide = new Flickity(heroSliders[i], {
    imagesLoaded: true,
    contain: true,
    pageDots: true,
    prevNextButtons: false,
    autoPlay: false,
    draggable: false
  });

  window.addEventListener("load", function() {
    setTimeout(() => {
      heroSlide.resize();
    }, 600);
  });
}

// hero video

if ($(".hero__video").length > 0) {
  const videoAll = document.querySelectorAll(".hero__video video");

  const check = function(video, source) {
    if (window.innerWidth >= 768) {
      video.pause();
      source.setAttribute("src", source.getAttribute("data-src"));
      video.load();
      video.play();
    } else {
      source.setAttribute("src", "javascript:void(0)");
      requestAnimationFrame(() => {
        check(video, source);
      });
    }
  };
  Array.prototype.forEach.call(videoAll, video => {
    const source = video.querySelector("source");
    check(video, source);
  });
}
