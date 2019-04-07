// Cause Overlays to fade away when scrolled.
jQuery(window).scroll(function(){
  jQuery(".dd_overlay").css("opacity", 1 - jQuery(window).scrollTop() / 250);
});
