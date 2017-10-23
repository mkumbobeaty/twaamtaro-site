jQuery(document).ready(function() {

	//// hide #back-top first
	jQuery(".scrollToTop").hide();

	// fade in #back-top
	jQuery(function() {
		jQuery(window).scroll(function() {
			if (jQuery(this).scrollTop() > 100) {
				jQuery('.scrollToTop').fadeIn();
			} else {
				jQuery('.scrollToTop').fadeOut();
			}
		});

		// scroll body to 0px on click
		jQuery('.scrollToTop').click(function() {
			jQuery('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});

	
	// Hide Header on on scroll down
    var didScroll;
    var lastScrollTop = 100;
    var delta = 5;
    var navbarHeight = jQuery('#header').outerHeight();

    jQuery(window).scroll(function(event) {
        didScroll = true;
    });

    setInterval(function() {
        if (didScroll) {
            hasScrolled();
            didScroll = false;
        }
    }, 500);

    function hasScrolled() {
        var st = jQuery(this).scrollTop();

        // Make sure they scroll more than delta
        if (Math.abs(lastScrollTop - st) <= delta)
            return;

        // If they scrolled down and are past the navbar, add class .nav-up.
        // This is necessary so you never see what is "behind" the navbar.
        if (st > lastScrollTop && st > navbarHeight) {
            // Scroll Down
            jQuery('#header').removeClass('nav-down').addClass('nav-up');

        } else {
            // Scroll Up
            if (st + jQuery(window).height() < jQuery(document).height()) {
                jQuery('#header').removeClass('nav-up').addClass('nav-down');
            }
        }

        lastScrollTop = st;
    }

    //Toogle Menu

	var $navIcon = jQuery('#nav-icon2')
	var menu = jQuery('.left-menu').sliiide({place: 'left', exit_selector: '.left-exit', toggle: '#nav-icon2'});
	var notes = jQuery('.note');
	jQuery('.slider-toggle').on('click', function()  {
	  var $button = jQuery(this);
	  if ($button.hasClass('selected')) {return;}
	  $navIcon.removeClass('flip animated');
	  notes.fadeOut(700);
	  var place = $button.attr('data-link').split('-')[0];
	  var menuPlace = $button.attr('data-link');
	  var note;
	  menu.reset();
	  $button.addClass('selected');
	  jQuery('.slider-toggle').not($button).removeClass('selected');
	  menu = jQuery('.'+menuPlace).sliiide({place: place, exit_selector: '.'+place+'-exit', toggle: '#nav-icon2'});
	  $navIcon.addClass('flip');
	  jQuery('.note[data-link="'+menuPlace+'"]').fadeIn(700).css('display','').removeClass('display-off');
	})
	
	

    //Product Detail carousel
	jQuery("#product-detail-slider").owlCarousel({
		autoPlay: 5000, 
		items : 3,
		navigation: true,
		nav: true,
		 navigationText: ["<img src='images/owl-prev.png'>","<img src='images/owl-next.png'>"],
		pagination : false,
		singleItem: false,
		itemsTablet: [414,1], //2 items between 400 and 0
		itemsMobile : false ,// itemsMobile disabled - inherit from itemsTablet option
		//autoHeight: true,
		itemsDesktop : [1199,3],
		itemsDesktopSmall : [979,2],
	});

    
	//wow
	//new WOW().init();

	//to change color of astrick "placeholder"
	
	   	jQuery(function() {
		jQuery(".holder + input, .holder + textarea").keyup(function() {
			if(jQuery(this).val().length) {
				jQuery(this).prev('.holder').hide();
			} else {
				jQuery(this).prev('.holder').show();
			}
		});
		jQuery(".holder").click(function() {
			jQuery(this).next().focus();
		});
	});


	//GOOGLE MAP
	jQuery('.maps').click(function () {
		jQuery('.maps iframe').css("pointer-events", "auto");
	});
	
	jQuery( ".maps" ).mouseleave(function() {
	  jQuery('.maps iframe').css("pointer-events", "none"); 
	});

	//Bootdtrap carousel
	(function( $ ) {

		//Function to animate slider captions 
		function doAnimations( elems ) {
			//Cache the animationend event in a variable
			var animEndEv = 'webkitAnimationEnd animationend';
			
			elems.each(function () {
				var $this = jQuery(this),
					$animationType = $this.data('animation');
				$this.addClass($animationType).one(animEndEv, function () {
					$this.removeClass($animationType);
				});
			});
		}
		
		//Variables on page load 
		var $myCarousel = jQuery('#carousel-example-generic'),
			$firstAnimatingElems = $myCarousel.find('.item:first').find("[data-animation ^= 'animated']");
			
		//Initialize carousel 
		$myCarousel.carousel();
		
		//Animate captions in first slide on page load 
		doAnimations($firstAnimatingElems);
		
		//Pause carousel  
		$myCarousel.carousel('pause');
		
		
		//Other slides to be animated on carousel slide event 
		$myCarousel.on('slide.bs.carousel', function (e) {
			var $animatingElems = jQuery(e.relatedTarget).find("[data-animation ^= 'animated']");
			doAnimations($animatingElems);
		});  
		
	})(jQuery);

	// boostrap carousel slide time
	jQuery('.carousel').carousel({
	        interval: 3000
	});

	 jQuery('.toggle-bar').click(function(){
      jQuery(this).next('.gtl-menu').slideToggle();
  });

	 jQuery('.gtl-menu > ul').superfish({
      delay:       500,                            // one second delay on mouseout
      animation:   {opacity:'show',height:'show'},  // fade-in and slide-down animation
      speed:       'fast',                          // faster animation speed
  });


});
