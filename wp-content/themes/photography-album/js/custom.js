function photography_album_navigation_open() {
    jQuery(".side_gb_nav").addClass('show');
}
function photography_album_navigation_close() {
    jQuery(".side_gb_nav").removeClass('show');
}

jQuery(function($){
    $('.gb_toggle').click(function () {
        photography_album_keyboard_navigation_loop($('.side_gb_nav'));
    });
});

jQuery(document).ready(function($) {
    $(window).on('scroll', function() {
        if ($(this).scrollTop() > 100) {
            $('.scrollup').fadeIn();
        } else {
            $('.scrollup').fadeOut();
        }
    });

    $('.scrollup').on('click', function() {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });
});

jQuery(document).ready(function(){
  var owl = jQuery('#home_slider .owl-carousel');

  owl.owlCarousel({
    items: 1,
    loop: true,
    margin: 10,
    nav: true,
    dots: false
  });

  // Update custom navigation with preview images
  function updateNavArrows() {
    var totalItems = owl.find('.owl-item').length;

    // Get indices for previous and next items
    var currentIndex = owl.find('.owl-item.active').index();

    var prevIndex = (currentIndex - 1 + totalItems) % totalItems;

    var nextIndex = (currentIndex + 1) % totalItems;

    jQuery('.owl-next').html(
      '<div class="slider-owl-item">' +
        '<img src="' + owl.find('.owl-item').eq(nextIndex).find('img').attr('src') + '" alt="Next">' +
        '<span>' + owl.find('.owl-item').eq(nextIndex).find('.slider_content_box h3').text() + '</span>' +
      '</div>'
    );

  }

  // Update nav arrows on initialization and after each change
  updateNavArrows();

  owl.on('translated.owl.carousel', updateNavArrows)
  
});


window.addEventListener('load', (event) => {
    jQuery(".loading").delay(2000).fadeOut("slow");
});

// first word
jQuery(document).ready(function($) {
  $('.slider_content_box h3').each(function() {
    var titleText = $(this).text().split(' ');
    if (titleText.length > 1) {
      var firstWord = titleText[0];
      var newText = ' <span>' + firstWord + '</span> ' + titleText.slice(1).join(' ');
      $(this).html(newText);
    }
  });
});

// last word
jQuery(document).ready(function($) {
  $('#home_about h3').each(function() {
    var titleText = $(this).text().split(' ');
    if (titleText.length > 2) {
      var lasttwowords = titleText.slice(-2).join(' ');
      var newText = titleText.slice(0, -2).join(' ') + ' <span class="highlight-text" style="color: #27ADFF;">' + lasttwowords + '</span>';
      $(this).html(newText);
    }
  });
});