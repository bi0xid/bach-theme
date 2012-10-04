/*
 * jquery.animatedborder. Animated borders on elements
 *
 * Copyright (c) 2010 Craig Davis
 * http://there4development.com
 *
 * Licensed under MIT
 * http://www.opensource.org/licenses/mit-license.php
 *
 * Launch  : 2/20/2010 9:35:59 AM
 * Version : 0.1.0-alpha
 * Released: 2/20/2010 9:36:18 AM
 * Debug: jquery.animatedborder.js
 */

/**
 * Adds an animated border around any block level element.
 *
 * It does this by adding 4 absolutely positioned divs around
 * the element. The 4 highlight divs use an animated gif with
 * white blocks and transparent areas. This allows the background
 * of the div to be visible and be treated as the color of the
 * animated border.
 *
 * This plugin requires 3 style rules:
 * .animatedBorderSprite { position: absolute; background: url(stripe.gif); margin: 0; }
 * .animatedBorderSprite-top { -moz-border-radius-topleft: 2px; -webkit-border-radius-topleft: 2px; -moz-border-radius-topright: 2px; -webkit-border-radius-topright: 2px;}
 * .animatedBorderSprite-bottom { -moz-border-radius-bottomleft: 2px; -webkit-border-radius-bottomleft: 2px; -moz-border-radius-bottomright: 2px; -webkit-border-radius-bottomright: 2px;}
 *
 * If you have to remake the animated gif, you should build
 * an 8x8 2 frame gif animation, with a 4x4 checkerboard grid
 * made of white and transparent blocks
 *
 */

(function($){
  $.fn.extend({
    animatedBorder: function(options) {
      var defaults = {
            size: 2,
            color: '#6699CC'
            }
      var options =  $.extend(defaults, options);

      return this.each(function() {
        var o = options;

        if ($(this).hasClass('animatedBorder')) {
          $('.animatedBorderSprite',$(this)).remove();
          $(this).removeClass('animatedBorder');
          return;
        }

        $(this).addClass('animatedBorder');
        var offset = $(this).offset();
        var size = {
                   height : $(this).outerHeight(),
                   width : $(this).outerWidth()
                   }
        $(this).append(
          $('<div />')
            .addClass('animatedBorderSprite')
            .addClass('animatedBorderSprite-top')
            .css({
              'top' : offset.top - o.size,
              'left' : offset.left - o.size,
              'width' : size.width + (2 * o.size),
              'height' : o.size,
              'background-color' : o.color
              })
          );
        $(this).append(
          $('<div />')
            .addClass('animatedBorderSprite')
            .addClass('animatedBorderSprite-bottom')
            .css({
              'top' : offset.top + size.height,
              'left' : offset.left - o.size,
              'width' : size.width + (2 * o.size),
              'height' : o.size,
              'background-color' : o.color
              })
          );
        $(this).append(
          $('<div />')
            .addClass('animatedBorderSprite')
            .css({
              'top' : offset.top,
              'left' : offset.left - o.size,
              'width' : o.size,
              'height' : size.height,
              'background-color' : o.color
              })
          );
        $(this).append(
          $('<div />')
            .addClass('animatedBorderSprite')
            .css({
              'top' : offset.top,
              'left' : offset.left + size.width,
              'width' : o.size,
              'height' : size.height,
              'background-color' : o.color
              })
          );
        });
      }
  });
})(jQuery);