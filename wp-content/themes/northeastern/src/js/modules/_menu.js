$(".menu__btn").on("click", function() {

  if ($(this).parent().hasClass("active")) {
    $(".menu__btn").parent().removeClass("active");
  }
  else {
    $(".menu__btn").parent().removeClass("active");
    $(this).parent().addClass("active");
  }

});

