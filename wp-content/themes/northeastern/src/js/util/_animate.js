const debounce = require('../util/_debounce');

module.exports = ({
  selector, elementChangeClass
}) => {

  const win = $(window);
  let winHeight;
  let winPosition;

  const blockSetup = function() {
    winHeight = win.height();
  }

  const blockScroll = function() {
    const element = $(selector).not(`.${elementChangeClass}`);
    winPosition = win.scrollTop() + winHeight;

    element.each(function(i) {
      const block = $(this);
      const limit = block.offset().top + 100;

      if (winPosition > limit) {
        setTimeout(function() {
          block.addClass(elementChangeClass);
        }, 200 + (i * 200));

      }
    });
  }

  const blockUpdate = function() {
    requestAnimationFrame(blockUpdate);
    blockScroll();
  }

  win.on('load resize', debounce(function() {
    blockSetup();
  }, 250));

  win.on('load', function() {
    blockUpdate();
  });
}
