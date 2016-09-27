var openResponsiveMenu = function () {
  $('.responsive-nav-container').toggleClass('hide');
  $('#nav-menu-button').toggleClass('hide');
  $('#close-nav-menu-button').toggleClass('hide');
  $('#masthead').toggleClass('freeze');
};

var closeResponsiveMenu = function () {
  $('.responsive-nav-container').toggleClass('hide');
  $('#nav-menu-button').toggleClass('show');
  $('#close-nav-menu-button').removeClass('hide');
  $('#masthead').toggleClass('freeze');
};

$(document).ready(function(){
  $('#nav-menu-button').on('click', openResponsiveMenu);
  $('#close-nav-menu-button').on('click', openResponsiveMenu);
});
