jQuery(document).ready(function($) {
  if ($(window).width() <= 640) 
  {
    if ($('.sticky-container').length > 0) 
    {
      $(".sticky-container").removeClass( );
    }
  }

  $(window).resize(function() {
    if ($(window).width() <= 640) {
      if ($('.sticky-container').length > 0) {
        $(".sticky-container").removeClass( );
      }
    }
  });

  // search-contact overlay

  if (jQuery('body .overlay').hasClass('overlay-hugeinc', 'overlay-door') || 
      jQuery('body .overlay').hasClass('overlay-corner') || 
      jQuery('body .overlay').hasClass('overlay-slidedown') || 
      jQuery('body .overlay').hasClass('overlay-scale') || 
      jQuery('body .overlay').hasClass('overlay-door') || 
      jQuery('body .overlay').hasClass('overlay-simplegenie')) {
        (function search_overlay_hugeinc() {
          var triggerBttn = document.getElementById( 'trigger-overlay' ),
          overlay = document.querySelector( 'div.overlay' ),
          closeBttn = overlay.querySelector( 'button.overlay-close' ),
          triggerBttn2 = document.getElementById( 'trigger-overlay2' ),
          overlay2 = document.querySelector( 'div.overlay2' ),
          closeBttn2 = overlay2.querySelector( 'button.overlay-close2' );
          transEndEventNames = {
            'WebkitTransition': 'webkitTransitionEnd',
            'MozTransition': 'transitionend',
            'OTransition': 'oTransitionEnd',
            'msTransition': 'MSTransitionEnd',
            'transition': 'transitionend'
          },
          transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ],
          support = { transitions : Modernizr.csstransitions };
          function toggleOverlay() {
            if( classie.has( overlay, 'open' ) ) {
              classie.remove( overlay, 'open' );
              classie.add( overlay, 'close' );
              var onEndTransitionFn = function( ev ) {
                if( support.transitions ) {
                  if( ev.propertyName !== 'visibility' ) return;
                  this.removeEventListener( transEndEventName, onEndTransitionFn );
                }
                classie.remove( overlay, 'close' );
              };
              if( support.transitions ) {overlay.addEventListener( transEndEventName, onEndTransitionFn );}
              else { onEndTransitionFn();}
            }
            else if( !classie.has( overlay, 'close' ) ) {
              classie.add( overlay, 'open' );
            }
          }
          triggerBttn.addEventListener( 'click', toggleOverlay );
          closeBttn.addEventListener( 'click', toggleOverlay );
          function toggleOverlay2() {
            if( classie.has( overlay2, 'open' ) ) {
              classie.remove( overlay2, 'open' );
              classie.add( overlay2, 'close' );
              var onEndTransitionFn = function( ev ) {
                if( support.transitions ) {
                  if( ev.propertyName !== 'visibility' ) return;
                  this.removeEventListener( transEndEventName, onEndTransitionFn );
                }
                classie.remove( overlay2, 'close' );
              };
              if( support.transitions ) {overlay2.addEventListener( transEndEventName, onEndTransitionFn );}
              else { onEndTransitionFn();}
            }
            else if( !classie.has( overlay2, 'close' ) ) {
              classie.add( overlay2, 'open' );
            }
          }
          triggerBttn2.addEventListener( 'click', toggleOverlay2 );
          closeBttn2.addEventListener( 'click', toggleOverlay2 );
        })();
  }
  
  if (jQuery('body .overlay').hasClass('overlay-contentscale') || jQuery('body .overlay').hasClass('overlay-contentpush') ) {
    if (jQuery('body .overlay').hasClass('overlay-contentpush')) {
      jQuery(".mainclass").addClass("contentpush");
    }
    (function search_overlay_contentscale() {
      var container = document.querySelector( 'div.mainclass' ),
      triggerBttn = document.getElementById( 'trigger-overlay' ),
      overlay = document.querySelector( 'div.overlay' ),
      closeBttn = overlay.querySelector( 'button.overlay-close' ),
      triggerBttn2 = document.getElementById( 'trigger-overlay2' ),
      overlay2 = document.querySelector( 'div.overlay2' ),
      closeBttn2 = overlay2.querySelector( 'button.overlay-close2' );
      transEndEventNames = {
        'WebkitTransition': 'webkitTransitionEnd',
        'MozTransition': 'transitionend',
        'OTransition': 'oTransitionEnd',
        'msTransition': 'MSTransitionEnd',
        'transition': 'transitionend'
      },
      transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ],
      support = { transitions : Modernizr.csstransitions };
      function toggleOverlay() {
        if( classie.has( overlay, 'open' ) ) {
          classie.remove( overlay, 'open' );
          classie.remove( container, 'overlay-open' );
          classie.add( overlay, 'close' );
          var onEndTransitionFn = function( ev ) {
            if( support.transitions ) {
              if( ev.propertyName !== 'visibility' ) return;
              this.removeEventListener( transEndEventName, onEndTransitionFn );
            }
            classie.remove( overlay, 'close' );
          };
          if( support.transitions ) {
            overlay.addEventListener( transEndEventName, onEndTransitionFn );
          }
          else {
            onEndTransitionFn();
          }
        }
        else if( !classie.has( overlay, 'close' ) ) {
          classie.add( overlay, 'open' );
          classie.add( container, 'overlay-open' );
        }
      }
      triggerBttn.addEventListener( 'click', toggleOverlay );
      closeBttn.addEventListener( 'click', toggleOverlay );
      function toggleOverlay2() {
        if( classie.has( overlay2, 'open' ) ) {
          classie.remove( overlay2, 'open' );
          classie.remove( container, 'overlay-open' );
          classie.add( overlay2, 'close' );
          var onEndTransitionFn = function( ev ) {
            if( support.transitions ) {
              if( ev.propertyName !== 'visibility' ) return;
              this.removeEventListener( transEndEventName, onEndTransitionFn );
            }
            classie.remove( overlay2, 'close' );
          };
          if( support.transitions ) {
            overlay2.addEventListener( transEndEventName, onEndTransitionFn );
          }
          else {
            onEndTransitionFn();
          }
        }
        else if( !classie.has( overlay2, 'close' ) ) {
          classie.add( overlay2, 'open' );
          classie.add( container, 'overlay-open' );
        }
      }
      triggerBttn2.addEventListener( 'click', toggleOverlay2 );
      closeBttn2.addEventListener( 'click', toggleOverlay2 );
    })();
  }

  if (jQuery('body .overlay').hasClass('overlay-cornershape')) {
    (function () {
      var triggerBttn = document.getElementById( 'trigger-overlay' ),
      overlay = document.querySelector( 'div.overlay' ),
      closeBttn = overlay.querySelector( 'button.overlay-close' ),
      triggerBttn2 = document.getElementById( 'trigger-overlay2' ),
      overlay2 = document.querySelector( 'div.overlay2' ),
      closeBttn2 = overlay2.querySelector( 'button.overlay-close2' );
      transEndEventNames = {
        'WebkitTransition': 'webkitTransitionEnd',
        'MozTransition': 'transitionend',
        'OTransition': 'oTransitionEnd',
        'msTransition': 'MSTransitionEnd',
        'transition': 'transitionend'
      },
      transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ],
      support = { transitions : Modernizr.csstransitions };
      s = Snap( overlay.querySelector( 'svg' ) ), 
      path = s.select( 'path' ),
      pathConfig = {
        from : path.attr( 'd' ),
        to : overlay.getAttribute( 'data-path-to' )
      };
      function toggleOverlay() {
        if( classie.has( overlay, 'open' ) ) {
          classie.remove( overlay, 'open' );
          classie.add( overlay, 'close' );
          var onEndTransitionFn = function( ev ) {
            classie.remove( overlay, 'close' );
          };
          path.animate( { 'path' : pathConfig.from }, 400, mina.linear, onEndTransitionFn );
        }
        else if( !classie.has( overlay, 'close' ) ) {
          classie.add( overlay, 'open' );
          path.animate( { 'path' : pathConfig.to }, 400, mina.linear );
        }
      }
      triggerBttn.addEventListener( 'click', toggleOverlay );
      closeBttn.addEventListener( 'click', toggleOverlay );
      
      s2 = Snap( overlay2.querySelector( 'svg' ) ), 
      path2 = s2.select( 'path' ),
      pathConfig2 = {
        from : path2.attr( 'd' ),
        to : overlay.getAttribute( 'data-path-to' )
      };
      function toggleOverlay2() {
        if( classie.has( overlay2, 'open' ) ) {
          classie.remove( overlay2, 'open' );
          classie.add( overlay2, 'close' );
          var onEndTransitionFn = function( ev ) {
            classie.remove( overlay2, 'close' );
          };
          path2.animate( { 'path' : pathConfig2.from }, 400, mina.linear, onEndTransitionFn );
        }
        else if( !classie.has( overlay2, 'close' ) ) {
          classie.add( overlay2, 'open' );
          path2.animate( { 'path' : pathConfig2.to }, 400, mina.linear );
        }
      }
      triggerBttn2.addEventListener( 'click', toggleOverlay2 );
      closeBttn2.addEventListener( 'click', toggleOverlay2 );
    })();
  }

  if (jQuery('body .overlay').hasClass('overlay-boxes')) {
    (function () {
      function shuffle(array) {
        var currentIndex = array.length
        , temporaryValue
        , randomIndex
        ;
        while (0 !== currentIndex) {
          randomIndex = Math.floor(Math.random() * currentIndex);
          currentIndex -= 1;
          temporaryValue = array[currentIndex];
          array[currentIndex] = array[randomIndex];
          array[randomIndex] = temporaryValue;
        }
        return array;
      }
      var triggerBttn = document.getElementById( 'trigger-overlay' ),
      overlay = document.querySelector( 'div.overlay' ),
      closeBttn = overlay.querySelector( 'button.overlay-close' ),
      paths = [].slice.call( overlay.querySelectorAll( 'svg > path' ) ),
      pathsTotal = paths.length,
      triggerBttn2 = document.getElementById( 'trigger-overlay2' ),
      overlay2 = document.querySelector( 'div.overlay2' ),
      closeBttn2 = overlay2.querySelector( 'button.overlay-close2' );
      paths2 = [].slice.call( overlay2.querySelectorAll( 'svg > path' ) ),
      pathsTotal2 = paths2.length;

      function toggleOverlay() {
        var cnt = 0;
        shuffle( paths );
        if( classie.has( overlay, 'open' ) ) {
          classie.remove( overlay, 'open' );
          classie.add( overlay, 'close' );
          paths.forEach( function( p, i ) {
            setTimeout( function() {
              ++cnt;
              p.style.display = 'none';
              if( cnt === pathsTotal ) {
                classie.remove( overlay, 'close' );
              }
            }, i * 30 );
          });
        }
        else if( !classie.has( overlay, 'close' ) ) {
          classie.add( overlay, 'open' );
          paths.forEach( function( p, i ) {
            setTimeout( function() {
              p.style.display = 'block';
            }, i * 30 );
          });
        }
      }
      triggerBttn.addEventListener( 'click', toggleOverlay );
      closeBttn.addEventListener( 'click', toggleOverlay );
      
      function toggleOverlay2() {
        var cnt2 = 0;
        shuffle( paths2 );
        if( classie.has( overlay2, 'open' ) ) {
          classie.remove( overlay2, 'open' );
          classie.add( overlay2, 'close' );
          paths2.forEach( function( p, i ) {
            setTimeout( function() {
              ++cnt2;
              p.style.display = 'none';
              if( cnt2 === pathsTotal2 ) {
                classie.remove( overlay2, 'close' );
              }
            }, i * 30 );
          });
        }
        else if( !classie.has( overlay2, 'close' ) ) {
          classie.add( overlay2, 'open' );
          paths2.forEach( function( p, i ) {
            setTimeout( function() {
              p.style.display = 'block';
            }, i * 30 );
          });
        }
      }
      triggerBttn2.addEventListener( 'click', toggleOverlay2 );
      closeBttn2.addEventListener( 'click', toggleOverlay2 );
    })();
  }

  if (jQuery('body .overlay').hasClass('overlay-genie')) {
    (function () {
      var triggerBttn = document.getElementById( 'trigger-overlay' ),
      overlay = document.querySelector( 'div.overlay' ),
      closeBttn = overlay.querySelector( 'button.overlay-close' ),
      triggerBttn2 = document.getElementById( 'trigger-overlay2' ),
      overlay2 = document.querySelector( 'div.overlay2' ),
      closeBttn2 = overlay2.querySelector( 'button.overlay-close2' );
      transEndEventNames = {
        'WebkitTransition': 'webkitTransitionEnd',
        'MozTransition': 'transitionend',
        'OTransition': 'oTransitionEnd',
        'msTransition': 'MSTransitionEnd',
        'transition': 'transitionend'
      },
      transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ],
      support = { transitions : Modernizr.csstransitions };

      s = Snap( overlay.querySelector( 'svg' ) ), 
      path = s.select( 'path' ),
      steps = overlay.getAttribute( 'data-steps' ).split(';'),
      stepsTotal = steps.length;
      function toggleOverlay() {
        if( classie.has( overlay, 'open' ) ) {
          var pos = stepsTotal-1;
          classie.remove( overlay, 'open' );
          classie.add( overlay, 'close' );
          var onEndTransitionFn = function( ev ) {
              classie.remove( overlay, 'close' );
            },
            nextStep = function( pos ) {
              pos--;
              if( pos < 0 ) return;
              path.animate( { 'path' : steps[pos] }, 60, mina.linear, function() { 
                if( pos === 0 ) {
                  onEndTransitionFn();
                }
                nextStep(pos);
              } );
            };
          nextStep(pos);
        }
        else if( !classie.has( overlay, 'close' ) ) {
          var pos = 0;
          classie.add( overlay, 'open' );
          var nextStep = function( pos ) {
            pos++;
            if( pos > stepsTotal - 1 ) return;
            path.animate( { 'path' : steps[pos] }, 60, mina.linear, function() { nextStep(pos); } );
          };
          nextStep(pos);
        }
      }
      triggerBttn.addEventListener( 'click', toggleOverlay );
      closeBttn.addEventListener( 'click', toggleOverlay );

      s2 = Snap( overlay2.querySelector( 'svg' ) ), 
      path2 = s2.select( 'path' ),
      steps2 = overlay2.getAttribute( 'data-steps' ).split(';'),
      stepsTotal2 = steps2.length;
      function toggleOverlay2() {
        if( classie.has( overlay2, 'open' ) ) {
          var pos = stepsTotal2-1;
          classie.remove( overlay2, 'open' );
          classie.add( overlay2, 'close' );
          var onEndTransitionFn = function( ev ) {
              classie.remove( overlay2, 'close' );
            },
            nextStep = function( pos ) {
              pos--;
              if( pos < 0 ) return;
              path2.animate( { 'path' : steps2[pos] }, 60, mina.linear, function() { 
                if( pos === 0 ) {
                  onEndTransitionFn();
                }
                nextStep(pos);
              } );
            };
          nextStep(pos);
        }
        else if( !classie.has( overlay2, 'close' ) ) {
          var pos = 0;
          classie.add( overlay2, 'open' );
          var nextStep = function( pos ) {
            pos++;
            if( pos > stepsTotal2 - 1 ) return;
            path2.animate( { 'path' : steps2[pos] }, 60, mina.linear, function() { nextStep(pos); } );
          };
          nextStep(pos);
        }
      }
      triggerBttn2.addEventListener( 'click', toggleOverlay2 );
      closeBttn2.addEventListener( 'click', toggleOverlay2 );
    })();
  }

});


