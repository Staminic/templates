jQuery(function($) {

  // dropdown menu
  $('ul.dropdown-menu').each(function(){
    $(this).prev().attr({
      id: $(this).attr('aria-labelledby'),
      role: 'button',
      'data-toggle': 'dropdown',
      'aria-haspopup': 'true',
      'aria-expanded': 'false'
    });
  });

  // Storing the state of collapse element
  $(".collapse").on("hidden.bs.collapse", function() {
    localStorage.setItem("coll_" + this.id, false);
  });

  $(".collapse").on("shown.bs.collapse", function() {
    localStorage.setItem("coll_" + this.id, true);
  });

  $(".collapse").each(function() {
    if (localStorage.getItem("coll_" + this.id) == "true") {
      $(this).collapse("show");
    }
  });

});
