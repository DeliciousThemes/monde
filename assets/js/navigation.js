/*!
 * classie - class helper functions
 * from bonzo https://github.com/ded/bonzo
 * 
 * classie.has( elem, 'my-class' ) -> true/false
 * classie.add( elem, 'my-new-class' )
 * classie.remove( elem, 'my-unwanted-class' )
 * classie.toggle( elem, 'my-class' )
 */

/*jshint browser: true, strict: true, undef: true */
/*global define: false */

( function( window ) {

'use strict';

// class helper functions from bonzo https://github.com/ded/bonzo

function classReg( className ) {
  return new RegExp("(^|\\s+)" + className + "(\\s+|$)");
}

// classList support for class management
// altho to be fair, the api sucks because it won't accept multiple classes at once
var hasClass, addClass, removeClass;

if ( 'classList' in document.documentElement ) {
  hasClass = function( elem, c ) {
    return elem.classList.contains( c );
  };
  addClass = function( elem, c ) {
    elem.classList.add( c );
  };
  removeClass = function( elem, c ) {
    elem.classList.remove( c );
  };
}
else {
  hasClass = function( elem, c ) {
    return classReg( c ).test( elem.className );
  };
  addClass = function( elem, c ) {
    if ( !hasClass( elem, c ) ) {
      elem.className = elem.className + ' ' + c;
    }
  };
  removeClass = function( elem, c ) {
    elem.className = elem.className.replace( classReg( c ), ' ' );
  };
}

function toggleClass( elem, c ) {
  var fn = hasClass( elem, c ) ? removeClass : addClass;
  fn( elem, c );
}

var classie = {
  // full names
  hasClass: hasClass,
  addClass: addClass,
  removeClass: removeClass,
  toggleClass: toggleClass,
  // short names
  has: hasClass,
  add: addClass,
  remove: removeClass,
  toggle: toggleClass
};

// transport
if ( typeof define === 'function' && define.amd ) {
  // AMD
  define( classie );
} else {
  // browser global
  window.classie = classie;
}

})( window );


(function() {

    var bodyEl = document.body,
        content = document.querySelector( '.site-content'),
        openbtn = document.getElementById( 'open-button' ),
        closebtn = document.getElementById( 'close-button' ),
        isOpen = false;

    function init() {
        initEvents();
    }

    function initEvents() {
        openbtn.addEventListener( 'click', toggleMenu );
        if( closebtn ) {
            closebtn.addEventListener( 'click', toggleMenu );
        }

        // close the menu element if the target it´s not the menu element or one of its descendants..
        content.addEventListener( 'click', function(ev) {
            var target = ev.target;
            if( isOpen && target !== openbtn ) {
                toggleMenu();
            }
        } );
    }

    function toggleMenu() {
        if( isOpen ) {
            classie.remove( bodyEl, 'show-menu' );
            classie.remove( openbtn, 'open' );
        }
        else {
            classie.add( bodyEl, 'show-menu' );
            classie.add( openbtn, 'open' );
        }
        isOpen = !isOpen;
    }

    init();

})();



function fetch(callback) {
    jQuery('.menu li').each(function() {
        if (jQuery(this).children('ul').length > 0) {
            var button = jQuery('<span class="m-button"><i class="fa fa-caret-down"></i></span>');
            button.appendTo(jQuery(this));
        }
    });
    callback();
}
fetch(function() {
    jQuery(".m-button").each(function(){
        jQuery(this).click(function(){
            var ul = jQuery(this).parent().children('ul');
            if (ul.css('display') === 'none') {
                ul.slideDown(300);
                jQuery(this).addClass('ul-enabled');    
            } else {
                ul.slideUp(300);
                jQuery(this).removeClass('ul-enabled');  
            }
        });
    });    
}); 

jQuery(window).on('resize',function() { 
    var monde_wind = jQuery(window).width();

    if(monde_wind < 1024) {
        jQuery('.menu').removeClass('is-desktop').addClass('is-mobile');
    }
    else {
        jQuery('.menu').removeClass('is-mobile').addClass('is-desktop');
        jQuery('.sub-menu').removeAttr('style');
    }

});

jQuery(document).ready(function() {
    jQuery(window).trigger('resize');

    // jQuery('.menu-button').click(function(){
    //     jQuery(this).toggleClass('open');
    // });   
});