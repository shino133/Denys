$("#menu-toggle").click(function (e) {
  e.preventDefault();
  $("#wrapper").toggleClass("toggled");
});

$(".like-btn").click(function () {
  $(this).toggleClass("active");
});