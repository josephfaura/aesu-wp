// Begin requestAnimationFrame polyfill



(function() {

    var lastTime = 0;

    var vendors = ['ms', 'moz', 'webkit', 'o'];

    for(var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {

        window.requestAnimationFrame = window[vendors[x]+'RequestAnimationFrame'];

        window.cancelAnimationFrame = window[vendors[x]+'CancelAnimationFrame']

                                   || window[vendors[x]+'CancelRequestAnimationFrame'];

    }



    if (!window.requestAnimationFrame)

        window.requestAnimationFrame = function(callback, element) {

            var currTime = new Date().getTime();

            var timeToCall = Math.max(0, 16 - (currTime - lastTime));

            var id = window.setTimeout(function() { callback(currTime + timeToCall); },

              timeToCall);

            lastTime = currTime + timeToCall;

            return id;

        };



    if (!window.cancelAnimationFrame)

        window.cancelAnimationFrame = function(id) {

            clearTimeout(id);

        };

}());



// End polyfill



(function($){



$('<style>').html('.parallax{position:relative;overflow:hidden;}.parallax > :not(.parallax__img){position:relative;z-index:2;}.parallax__img{position:absolute;left: 0;width:100%;}').appendTo('body');



var parallaxItems = $('.parallax'),

    windowHeight = $(window).outerHeight(),

    docHeight = $('body').outerHeight(),

    speed = .5;



parallaxItems.each(function(){

  var bgImg = $(this).css('background-image');

  var parallaxBlock = $('<div>').addClass('parallax__img').css('background-image', bgImg);

  $(this).prepend(parallaxBlock);

  $(this).css('background-image', 'none');

});



function setUpPosition (el) {

  var thisLayout = el[0].getBoundingClientRect();



  if ((el.offset().top + (thisLayout.height / 2)) < (windowHeight / 2)) {

    el.data('distance', el.offset().top * speed * 2);

    el.data('anchor', 'top');

    var distance = el.data('distance');

  } else if ((el.offset().top + (thisLayout.height / 2)) > (docHeight - (windowHeight / 2))) {

    el.data('distance', (docHeight - (el.offset().top + thisLayout.height)) * speed * 2);

    el.data('anchor', 'bottom');

    var distance = el.data('distance');

  } else {

    el.data('distance', (windowHeight - thisLayout.height) * speed);

    el.data('anchor', 'middle');

    var distance = el.data('distance');

  }



  el.children('.parallax__img').css({

    'height': 'calc(100% + ' + distance + 'px)',

    'top': (0 - distance / 2) + 'px'

  });



  if (thisLayout.top >= windowHeight) {

    el.children('.parallax__img')

           .css('transform', 'translateY(' + ((distance / 2)) + 'px)');

  } else if (thisLayout.bottom <= 0) {

    el.children('.parallax__img')

           .css('transform', 'translateY(' + (0 - (distance / 2)) + 'px)');

  } else {

    if (el.data('anchor') === 'top') {

      var fromMiddle = (thisLayout.top + thisLayout.height / 2) - (el.offset().top + thisLayout.height / 2);

    } else if (el.data('anchor') === 'bottom') {

      var fromMiddle =  (docHeight - (el.offset().top + thisLayout.height / 2)) - (windowHeight - (thisLayout.top + thisLayout.height  / 2));

    } else {

      var fromMiddle = thisLayout.top + thisLayout.height / 2 - windowHeight / 2;

    }



    el.children('.parallax__img')

           .css('transform', 'translateY(' + (0 - Math.round(fromMiddle * speed)) + 'px)');

  }

  var el = 0;

}



parallaxItems.each(function(){

  var el = $(this);

  requestAnimationFrame(function(){

    setUpPosition(el)

  });

});



function updatePosition (el) {

  var thisLayout = el[0].getBoundingClientRect();



  if (thisLayout.top >= windowHeight || thisLayout.bottom <= 0) return;



  if (el.data('anchor') === 'top') {

    var fromMiddle = (thisLayout.top + thisLayout.height / 2) - (el.offset().top + thisLayout.height / 2);

  } else if (el.data('anchor') === 'bottom') {

    var fromMiddle =  (docHeight - (el.offset().top + thisLayout.height / 2)) - (windowHeight - (thisLayout.top + thisLayout.height  / 2));

  } else {

    var fromMiddle = thisLayout.top + thisLayout.height / 2 - windowHeight / 2;

  }



  el.children('.parallax__img')

         .css('transform', 'translateY(' + (0 - Math.round(fromMiddle * speed)) + 'px)');

}



$(window).resize(function(){

  windowHeight = $(window).outerHeight();

  docHeight = $('body').outerHeight();

  parallaxItems.each(function(){

    var el = $(this);

    requestAnimationFrame(function(){

      setUpPosition(el)

    });

  });

});



$(window).on('load', function(){

  windowHeight = $(window).outerHeight();

  docHeight = $('body').outerHeight();

  parallaxItems.each(function(){

    var el = $(this);

    requestAnimationFrame(function(){

      setUpPosition(el)

    });

  });

})



$(window).scroll(function(){

  parallaxItems.each(function(){

    var el = $(this);

    requestAnimationFrame(function(){

      updatePosition(el)

    });

  });

});



})(jQuery)

