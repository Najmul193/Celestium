var photography_album_keyboard_navigation_loop = function (elem) {
  var photography_album_tabbable = elem.find('select, input, textarea, button, a').filter(':visible');
  var photography_album_firstTabbable = photography_album_tabbable.first();
  var photography_album_lastTabbable = photography_album_tabbable.last();
  photography_album_firstTabbable.focus();

  photography_album_lastTabbable.on('keydown', function (e) {
    if ((e.which === 9 && !e.shiftKey)) {
      e.preventDefault();
      photography_album_firstTabbable.focus();
    }
  });

  photography_album_firstTabbable.on('keydown', function (e) {
    if ((e.which === 9 && e.shiftKey)) {
      e.preventDefault();
      photography_album_lastTabbable.focus();
    }
  });

  elem.on('keyup', function (e) {
    if (e.keyCode === 27) {
      elem.hide();
    };
  });
};