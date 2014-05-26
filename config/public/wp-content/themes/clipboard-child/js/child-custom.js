(function($) {
  var isHeaderMobile = null;

  //$('#mainLogo, #mainWidgets').append(
  $('#mainLogo').append(
    $('<div class="header-toggle"/>').click(function() {
      if (!isHeaderMobile) return;
      $('body')[$('body').hasClass('mobileHeaderOpen') ? 'removeClass' : 'addClass']('mobileHeaderOpen');
    })
  );

  $('input#search').each(function() {
    $(this).data('original-placeholder', $(this).attr('placeholder'));
  }).after(
    $('<div class="trigger"/>').click(function() {
      $(this).closest('form').submit();
    })
  );

  function mobileHeader() {
    var mobile = $(window).width() < 700;

    // Do nothing if there is no change
    if (mobile == isHeaderMobile) return;
    isHeaderMobile = mobile;

    $('body')[mobile ? 'addClass' : 'removeClass']('mobileHeader');
    $('body').removeClass('mobileHeaderOpen');
    $('input#search').attr('placeholder', mobile ? 'Search' : $('input#search').data('original-placeholder'));
  }

  $(window).load(mobileHeader);
  $(window).resize(mobileHeader);
})(jQuery);