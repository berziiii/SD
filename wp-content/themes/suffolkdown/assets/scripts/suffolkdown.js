
// var renderResponsiveSchedule = function() {
//   var months = $('body').find('.header-month-inner');
//   // console.log(months);
//   for (i=0; i < months.length; i++) {
//     var month = months[i];
//     var printMonth = $(month).html();
//     if (i === 0) {
//       $('#month-carousel').append(
//         '<div class="carousel-item active"> \n' +
//           '<div class="month-container"> \n' +
//             '<h1>' + printMonth + '</h1> \n' +
//           '</div> \n' +
//         '</div>'
//       );
//     } else {
//       $('#month-carousel').append(
//         '<div class="carousel-item"> \n' +
//           '<div class="month-container"> \n' +
//             '<h1>' + printMonth + '</h1> \n' +
//           '</div> \n' +
//         '</div>'
//       );
//     }
// 	}
// };


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

$(window).resize(function() {
  if ($(window).width() <= 820) {
    $('[data-id="1"]').addClass('timesOneShift');
    $('[data-id="2"]').addClass('timesTwoShift');
  } else {
    $('[data-id="1"]').removeClass('timesOneShift');
    $('[data-id="2"]').removeClass('timesTwoShift');
  }
});

var viewPortCheck = function() {
  if ($(window).width() <= 820) {
    $('[data-id="1"]').addClass('timesOneShift');
    $('[data-id="2"]').addClass('timesTwoShift');
  } else {
    $('[data-id="1"]').removeClass('timesOneShift');
    $('[data-id="2"]').removeClass('timesTwoShift');
  }
};


//  Document Ready
$(document).ready(function(){
  $('#nav-menu-button').on('click', openResponsiveMenu);
  $('#close-nav-menu-button').on('click', openResponsiveMenu);
  viewPortCheck();
});
