
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

// if (viewport.scrollTop() > 148) {
//             header.css('position', 'fixed').addClass('compressed');
//             section.css('padding-top', 148);
//         } else {
//             header.css('position', 'relative').removeClass('compressed');
//             section.css('padding-top', 0);
//         }


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



// $(window).scroll(function() {
//   var dates = $('.header-date').offset();
//   // if (dates.top < 100) {
//   //   console.log('FREEZE');
//   // }
//   console.log(dates.top);
//   // if (dates < 100) {
//   //   console.log('FREEZE');
//   // }
// });

// {
//   var dates = $('.header-date').position();
//   if (dates.top() < 100) {
//     console.log(datesPostion);
//   }
// });

// $(window).resize(function() {
//   if ($(window).width() <= 820) {
    // $('.table-container').addClass('table-responsive');
    // $('table').addClass('table-responsive');
    // $('table').floatThead({
    //   responsiveContainer: function($table){
    //       return $table.closest('.table-container');
    //   }
    // });
  // } else {
    // $('.table-container').removeClass('table-responsive');
    // $('table').removeClass('table-responsive');
    // $('table.table-container').floatThead('reflow');
//   }
// });

// var viewPortCheck = function() {
//   if ($(window).width() <= 820) {
    // $('.table-container').addClass('table-responsive');
    // $('table').addClass('table-responsive');
    // $('table').floatThead({
    //   responsiveContainer: function($table){
    //       return $table.closest('.table-container');
    //   }
    // });
  // } else {
    // $('.table-container').removeClass('table-responsive');
    // $('table').removeClass('table-responsive');
    // $('table.table-container').floatThead('reflow');
//   }
// };

//  Document Ready
$(document).ready(function(){
  $('#nav-menu-button').on('click', openResponsiveMenu);
  $('#close-nav-menu-button').on('click', openResponsiveMenu);
  // viewPortCheck();
  $('table').floatThead({
    responsiveContainer: function($table){
        return $table.closest('.table-container');
    }
  });
});
