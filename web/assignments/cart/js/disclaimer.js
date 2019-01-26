$(function() {
  var disclaimer = { elem: $("div#disclaimer") };

  disclaimer.show = function() { disclaimer.elem.show(); };
  disclaimer.hide = function() {
    Cookies.set('disclaimer', true);
    disclaimer.elem.hide();
  };

  if (!Cookies.get('disclaimer')) {
    disclaimer.show();
  }

  $('div.disclaimer button').click(disclaimer.show);
  $('div#disclaimer button.disclaimer').click(disclaimer.hide);
});
