(function () {
  "use strict";

  //Full Screen Search
  $(".search-trigger").on("click", function (e) {
    e.preventDefault();
    $(".search-wrap").animate({ opacity: "toggle" }, 500);
    $(".nav-search, #search-close").addClass("open");
  });
  $(".search-close").on("click", function (e) {
    e.preventDefault();
    $(".search-wrap").animate({ opacity: "toggle" }, 500);
    $(".nav-search, #search-close").removeClass("open");
  });
  function closeSearch() {
    $(".search-wrap").fadeOut(200);
    $(".nav-search, #search-close").removeClass("open");
  }
  $(document.body).on("click", function (e) {
    closeSearch();
  });
  $(".search-trigger, .main-search-input").on("click", function (e) {
    e.stopPropagation();
  });

  //Menu Sticky
  $(".main-menu").sticky({ topSpacing: 0, bottomSpacing: 5 });

  //Preloader
  $(window).load(function () {
    // makes sure the whole site is loaded
    $("#box,#hill").fadeOut(); // will first fade out the loading animation
    $("#loader,.preloader").delay(350).fadeOut("slow"); // will fade out the white DIV that covers the website.
    $("body").delay(350).css({ overflow: "visible" });
  });
})();
