const minimodal = require("minimodal");

let targets = document.querySelectorAll("[data-minimodal]");

for (let i = 0; i < targets.length; i += 1) {
  const modal = minimodal(targets[i], {
    statusTimeout: 600,
    removeTimeout: 600,
    closeTimeout: 600,
    closeButtonHTML: '<span class="cross"></span>',
  });

  modal.init();
}
