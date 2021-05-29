function loadStyleSheet(src){
	if (document.createStyleSheet) document.createStyleSheet(src);
	else {
		var stylesheet = document.createElement('link');
		stylesheet.href = src;
		stylesheet.rel = 'stylesheet';
		stylesheet.type = 'text/css';
		document.getElementsByTagName('head')[0].appendChild(stylesheet);
	}
}

function setCookie( cname, cvalue, exdays ) {
	var d = new Date();
	d.setTime( d.getTime() + ( exdays * 24 * 60 * 60 * 1000 ) );
	var expires = "expires=" + d.toUTCString();
	document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
function getCookie(cname) {
	var name = cname + "=";
	var decodedCookie = decodeURIComponent( document.cookie );
	var ca = decodedCookie.split( ';' );
	for( var i = 0; i < ca.length; i++ ) {
		var c = ca[i];
		while( c.charAt(0) == ' ' ) {
			c = c.substring( 1 );
		}
		if( c.indexOf( name ) == 0 ) {
			return c.substring( name.length, c.length );
		}
	}
	return "";
}

/*************************************************************
 * TOGGLE MAIN MENU
 *************************************************************/
var menuState = false;
function toggleMenu() {
    var m = document.getElementById('menu-principal');
    var t = document.getElementById('menu-toggle');
    if (menuState == false) {
        m.className = "menu open";
        t.className = "toggle topen";
        menuState = true;
    } else {
        m.className = "menu";
        t.className = "toggle";
        menuState = false;
    }
}

function findParent( tagname, el ) {
    while ( el ) {
        if( ( el.nodeName || el.tagName ).toLowerCase() === tagname.toLowerCase() ) {
            return el;
        }
        el = el.parentNode;
    }
    return null;
}
function scrollToAnchor( hash ) {
    var yOffset = -120;
    var element = document.querySelector( hash );
    if( element != null ) {
        var y = element.getBoundingClientRect().top + window.pageYOffset + yOffset;
        window.scrollTo( { top: y, behavior: 'smooth' } );
    }
}
function detectHash() {
    if( window.location.hash ) {
        scrollToAnchor( window.location.hash );
    }
}
document.addEventListener( "DOMContentLoaded", detectHash );
window.addEventListener( "hashchange", detectHash, false );
window.onhashchange = detectHash;

var fading = false;
function fadeOut(element) {
		var op = 1;
		element.style.opacity = op;
		var fading = true;
		var timer = setInterval(function () {
			if (op <= 0.1){
				clearInterval(timer);
				element.style.display = 'none';
				fading = false;
			}
			element.style.opacity = op;
			element.style.filter = 'alpha(opacity=' + op * 100 + ')';
			op -= op * 0.1;
		}, 1);
}
function fadeIn(element) {
		var op = 0.1;
		element.style.opacity = op;
		element.style.display = 'block';
		var fading = true;
		var timer = setInterval(function () {
			if (op >= 1){
				clearInterval(timer);
				fading = false;
			}
			element.style.opacity = op;
			element.style.filter = 'alpha(opacity=' + op * 100 + ')';
			op += op * 0.1;
		}, 10);
}

function toggleHeadingsBox( box ) {
	let i = box.querySelector( 'i' );
	let heading = box.parentNode;
	let content = heading.querySelector( '.content' );
	if( content.style.display != 'block' ) {
		fadeIn( content );
		heading.style.backgroundColor = '#f9f9f9';
		i.className = 'fas fa-chevron-up';
	} else {
		fadeOut( content );
		i.className = 'fas fa-chevron-down';
		heading.style.backgroundColor = '#fff';
	}
}

/*************************************************************
 * NEWSLETTER
 *************************************************************/
function newsletterHide() {
	var ns = document.getElementById( 'newsletter' );
	var nssh = document.getElementById( 'newsletterShowHideLink' );
	var columns = ns.getElementsByClassName( 'columns' )[0];
	var button = nssh.getElementsByClassName( 'button' )[0];
	var i = button.getElementsByTagName( 'i' )[0];
	ns.style.height = '60px';
	columns.style.display = 'none';
	i.className = 'fas fa-arrow-alt-circle-up';
	ns.style.position = 'static';
}
function newsletterShow() {
	var ns = document.getElementById( 'newsletter' );
	var nssh = document.getElementById( 'newsletterShowHideLink' );
	var columns = ns.getElementsByClassName( 'columns' )[0];
	var button = nssh.getElementsByClassName( 'button' )[0];
	var i = button.getElementsByTagName( 'i' )[0];
	ns.style.height = 'auto';
	columns.style.display = 'flex';
	i.className = 'fas fa-arrow-alt-circle-down';
	if( window.innerWidth > 768 ) {
		ns.style.position = 'sticky';
	} else {
		ns.style.position = 'static';
	}
}
function newsletterToggle() {
	var ns = document.getElementById( 'newsletter' );
	if( ns.style.height == 'auto' || ns.style.height == '' ) {
		newsletterHide();
		setCookie( 'BtbNewsletterState', 'closed', 365 );
	} else {
		newsletterShow();
		setCookie( 'BtbNewsletterState', 'opened', 365 );
	}
}

var newsletterScroller = function() {
		var y = document.documentElement.scrollTop;
		var limit = Math.round( document.documentElement.scrollHeight / 4 );

		var ns = document.getElementById( 'newsletter' );
		if( y > ( limit + 100 ) ) {
			if( ns.style.display == 'none' || ns.style.display == '' ) {
				/*ns.style.opacity = 1.0;
				ns.style.filter = 'alpha(opacity=1.0)';
				ns.style.display = 'block';*/
				fadeIn( ns );
			}
		}
		if( y < ( limit - 100 ) ) {
			if( ns.style.display == 'block' ) {
				/*ns.style.opacity = 0.0;
				ns.style.filter = 'alpha(opacity=0.0)';
				ns.style.display = 'none';*/
				fadeOut( ns );
			}
		}
};
window.addEventListener( 'scroll', newsletterScroller );

var newsletterInit = function() {
	if( getCookie( 'BtbNewsletterState' ) == 'closed' ) {
		newsletterHide();
	} else {
		newsletterShow();
	}
}
document.addEventListener( 'DOMContentLoaded', newsletterInit );




/******************************************************************
 *  AJAX NOTIFICATION AND NEWSLETTER
 ******************************************************************/
jQuery( 'form[name="notification-form"]' ).on( 'submit', function() {
    var form_data = jQuery( this ).serializeArray();
    form_data.push( { "name" : "security", "value" : ajax_nonce } );

    jQuery.ajax({
        url : ajax_url,
        type : 'post',
        data : form_data,
        success : function( response ) {
        	if( response.startsWith( '[ERROR]' ) || response.startsWith( '[ERREUR]' ) ) {
        		jQuery( '#notification-response' ).html( '<span class="response-error">' + response + '</span>' );
        	} else {
        		jQuery( '#notification-response' ).html( '<span class="response-ok">' + response + '</span>' )
        		jQuery( '#notification-content' ).hide();
        	}
        },
        fail : function( err ) {
        	jQuery( '#notification-response' ).html( '<span class="response-error">' + err + '</span>' )
        }
    });

    return false;
});
jQuery( 'form[name="newsletter-form"]' ).on( 'submit', function() {
    var form_data = jQuery( this ).serializeArray();
    form_data.push( { "name" : "security", "value" : ajax_nonce } );

    jQuery.ajax({
        url : ajax_url,
        type : 'post',
        data : form_data,
        success : function( response ) {
        	if( response.startsWith( '[ERROR]' ) || response.startsWith( '[ERREUR]' ) ) {
        		jQuery( '#newsletter-response' ).html( '<span class="response-error">' + response + '</span>' );
        	} else {
        		jQuery( '#newsletter-response' ).html( '<span class="response-ok">' + response + '</span>' )
        		jQuery( '#newsletter-content' ).hide();
        	}
        },
        fail : function( err ) {
        	jQuery( '#newsletter-response' ).html( '<span class="response-error">' + err + '</span>' )
        }
    });

    return false;
});



document.addEventListener("DOMContentLoaded", function() {
  var lazyloadImages;

  if ("IntersectionObserver" in window) {
    lazyloadImages = document.querySelectorAll(".lazy");
    var imageObserver = new IntersectionObserver(function(entries, observer) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          var image = entry.target;
          image.src = image.dataset.src;
          image.classList.remove("lazy");
          imageObserver.unobserve(image);
        }
      });
    });

    lazyloadImages.forEach(function(image) {
      imageObserver.observe(image);
    });
  } else {
    var lazyloadThrottleTimeout;
    lazyloadImages = document.querySelectorAll(".lazy");

    function lazyload () {
      if(lazyloadThrottleTimeout) {
        clearTimeout(lazyloadThrottleTimeout);
      }

      lazyloadThrottleTimeout = setTimeout(function() {
        var scrollTop = window.pageYOffset;
        lazyloadImages.forEach(function(img) {
            if(img.offsetTop < (window.innerHeight + scrollTop)) {
              img.src = img.dataset.src;
              img.classList.remove('lazy');
            }
        });
        if(lazyloadImages.length == 0) {
          document.removeEventListener("scroll", lazyload);
          window.removeEventListener("resize", lazyload);
          window.removeEventListener("orientationChange", lazyload);
          document.removeEventListener("load", lazyload);
        }
      }, 20);
    }

    document.addEventListener("scroll", lazyload);
    window.addEventListener("resize", lazyload);
    window.addEventListener("orientationChange", lazyload);
    document.addEventListener("load", lazyload);
  }
});