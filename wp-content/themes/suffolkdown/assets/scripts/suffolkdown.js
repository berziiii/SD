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

$(document).ready(function(){
  $('#nav-menu-button').on('click', openResponsiveMenu);
  $('#close-nav-menu-button').on('click', openResponsiveMenu);
});
