(function(window, undefined) {
  'use strict';

  /*
  NOTE:
  ------
  PLACE HERE YOUR OWN JAVASCRIPT CODE IF NEEDED
  WE WILL RELEASE FUTURE UPDATES SO IN ORDER TO NOT OVERWRITE YOUR JAVASCRIPT CODE PLEASE CONSIDER WRITING YOUR SCRIPT HERE.  */

  // Cambiar icono de menú cuando tiene submenús y se hace click
  $('.nav-link-label').click(function() {
    //$("i", this).toggleClass("fa-angle-up fa-angle-down");
  });
   


})(window);


 	/* Botón Volver arriba.
 	  Con scroll a 20px del inicio del sitio, se muestra un botón volver arriba */
  $(window).scroll(function(){ 
    if ($(this).scrollTop() > 20) { 
      $('#btn-scroll').fadeIn(); 
    } else { 
      $('#btn-scroll').fadeOut(); 
    } 
  }); 

  $('#btn-scroll').click(function(){ 
    $("html, body").animate({ scrollTop: 0 }, 600);       
    return false; 
  });


