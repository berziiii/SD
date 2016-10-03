
// Responsive Nav Methods

var openResponsiveMenu = function () {
  $('.responsive-nav-container').toggleClass('hide');
  $('#nav-menu-button').toggleClass('hide');
  $('#close-nav-menu-button').toggleClass('hide');
  $('#masthead').toggleClass('freeze');
  $("body").toggleClass('no-scroll');
};

var closeResponsiveMenu = function () {
  $('.responsive-nav-container').toggleClass('hide');
  $('#nav-menu-button').toggleClass('show');
  $('#close-nav-menu-button').removeClass('hide');
  $('#close-nav-menu-button').addClass('show');
  $('#masthead').toggleClass('freeze');
  $("body").toggleClass('no-scroll');
};


// Scroll Prompt on mobile for table

var scrollPrompt = function () {

  $(window).scroll( function(){
    if ($('table').offset().top == $(window).scrollTop()) {
      $('.arrow-wrap-right').addClass('fade-in');
      setTimeout(function() {
        $(".arrow-wrap-right").removeClass("fade-in");
        $(".arrow-wrap-right").addClass("fade-out");
        $('.arrow-wrap-down').addClass('fade-in').delay(1500);
      }, 1500);
      setTimeout(function() {
        $(".arrow-wrap-down").removeClass("fade-in").delay(1500);
        $(".arrow-wrap-down").addClass("fade-out").delay(1500);
      }, 3000);
    }
  });
};



//  Document Ready

// $(function(){
//   console.log(this);
//
//
//   $(window).on("load resize", function(){
//     console.log("hi");
//   });
// });

$(document).ready(function(){
  $('#nav-menu-button').on('click', openResponsiveMenu);
  $('#close-nav-menu-button').on('click', openResponsiveMenu);
  $('table').floatThead({
    responsiveContainer: function($table){
        return $table.closest('.table-container');
    }
  });
  if ($(window).width() <= 820) {
    scrollPrompt();
  }
});
