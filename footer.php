		<?php wp_footer(); ?>

		<!-- Footer -->
    <footer class="py-5 pageFooter">
      <div class="container">
				<div class="row">
					<?php
					$args = array(
				    'theme_location'  => 'bottom',
						'container'			  => 'div',
						'container_class'	=> 'bottomNav col-lg-6',
						'menu_class'		  => 'list-inline'
			    );

					wp_nav_menu($args);

					?>
					<div class="social col-lg-6">
						<ul class="list-inline">

							<?php if (get_theme_mod('facebook_url', 'http://facebook.com') != '') : ?>
								<li class="list-inline-item"><a href="<?php echo get_theme_mod('facebook_url','http://facebook.com'); ?>"><i class="fab fa-facebook-f"></i></a></li>
							<?php endif; ?>

							<?php if (get_theme_mod('twitter_url', 'http://twitter.com') != '') : ?>
							<li class="list-inline-item"><a href="<?php echo get_theme_mod('twitter_url', 'http://twitter.com'); ?>"><i class="fab fa-twitter"></i></a></li>
							<?php endif; ?>

							<?php if (get_theme_mod('google-plus_url', 'http://aboutme.google.com') != '') : ?>
							<li class="list-inline-item"><a href="<?php echo get_theme_mod('google-plus_url','http://aboutme.google.com'); ?>"><i class="fab fa-google-plus-g"></i></a></li>
							<?php endif; ?>
							
							<?php if (get_theme_mod('linkedin_url', 'http://www.linkedin.com') != '') : ?>
							<li class="list-inline-item"><a href="<?php echo get_theme_mod('linkedin_url','http://www.linkedin.com'); ?>"><i class="fab fa-linkedin-in"></i></a></li>
							<?php endif; ?>							

							<?php if (get_theme_mod('youtube_url', 'http://youtube.com') != '') : ?>
							<li class="list-inline-item"><a href="<?php echo get_theme_mod('youtube_url','http://youtube.com'); ?>"><i class="fab fa-youtube"></i></a></li>
							<?php endif; ?>

						</ul>
					</div>										
				</div>				
      </div><!-- /.container -->
			<p class="m-0 text-center copyright">Copyright &copy; <?php bloginfo('name'); ?> <?php echo date('Y'); ?></p>
			<p class="backlink text-center">Design by <a href="https://beshsaleh.com">Beshara Saleh</a></p>
    </footer>

		<?php if(get_theme_mod('modal', 1)) : ?>
		<!-- The Modal -->
		<div class="modal fade" id="myModal">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabel"><i class="fas fa-envelope"></i> Subscribe to our Mailing List</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<!-- Modal body -->
					<div class="modal-body">
						<p><strong>Simply enter your name and email. As a thank you for joining, I'm going to give you something really cool <em>for free!</em></strong></p>
						<form class="" role="form">
							<div class="form-group">
								<label class="sr-only" for="subscribe-name">Your first name</label>
								<input type="text" class="form-control" id="subscribe-name" placeholder="Your first name">
							</div>
							<div class="form-group">
								<label class="sr-only" for="subscribe-email">and your email</label>
								<input type="text" class="form-control" id="subscribe-email" placeholder="and your email">
							</div>
							<input type="submit" class="btn btn-primary" value="Subscribe!">
						</form>
						<hr>
						<p><small><em>By providing your email you consent to receiving occasional promotional emails &amp; newsletters. No Spam. Just good stuff. We respect your privacy &amp; you may unsubscribe at any time.</em></small></p>
					</div>
					<!-- Modal footer -->
					<div class="modal-footer">
						<button type="button" class="close-btn" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<?php endif; ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS, then custom JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">      
    </script>
    <!-- If there is no internet connection, it defaults to the local jquery.js copy. -->
    <script src="<?php bloginfo('template_directory') ?>/js/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">      
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">    
    </script>
    <!-- If there is no internet connection, it defaults to the local bootstrap.min.js copy. -->
    <script src="<?php bloginfo('template_directory') ?>/js/bootstrap.min.js"></script>

		<?php if (is_front_page()) : ?>
		<script>		
		$(function() {
			var $window      = $(window);	// save the window object to a variable
			var showNav      = false;
			var topNav   		 = $('#topNav').height(); // the scroll distance will be the height of the header element
			var showCase     = $('.showcase').height();
			var skills       = $('#home-skills').height();
			var works        = $('#home-works').height();
			var testimonials = $('#home-testimonials').height();
			var about        = $('#home-about').height();

			// If there is a home banner (it's enabled), get its height.
			if ($('#home-image-banner').length) {
			  var homeBanner = $('#home-image-banner').height();
			} else {
				var homeBanner = 0;
			}

			$window.scroll(function() {
				if ($(this).scrollTop() < showCase/2) {
					$("#home-skills").css("visibility", "hidden").removeClass("animated fadeInUp");
					$("#home-works").css("visibility", "hidden").removeClass("animated fadeIn");
					$("#home-testimonials").css("visibility", "hidden").removeClass("animated fadeIn");
					$("#home-about h1").css("visibility", "hidden").removeClass("animated fadeIn");
					$("#home-about .col-lg-5").css("visibility", "hidden").removeClass("animated fadeInLeft");
					$("#home-about .col-lg-7").css("visibility", "hidden").removeClass("animated fadeInRight");
				}
			});
			
			// NAVIGATION BAR FADE-IN
			$window.scroll(function() {
				// If the top of the scrollbar (window) is leveled with or passed the set height of the scroll distance, make adjustments.
				if ($(this).scrollTop() > topNav) {
					if (!showNav) {                           
						$("#mainNav")
						.hide() // hide it
						.fadeTo('slow','1'); // slowly fade it in
						// Set the navigation visibility flag to true. 
						showNav = true;
					}
				// Else if the top of the scrollbar is higher than the set height of the scroll distance, remove it.
				} else {
					$("#mainNav").css("display", "none");
					showNav = false;
				}
			});
			
			// SHOW CASE PARALLAXAL BACKGROUND
			$window.scroll(function() {					
				// If the top of the scrollbar (window) is leveled with or passed the set height of the scroll distance, make adjustments.
				if ($(this).scrollTop() > topNav) {
					// Assign the section element (object) with the data-type of "background" to a variable.
					$('header[data-type="background"]').each(function() {
						var $bgobj = $(this);
						// Call the window object's scroll function.
						$window.scroll(function() {
						// The speed to scroll the background is set in the element's data-speed attribute.
						// yPos is a negative value because we're scrolling it UP!

						// - (number of pixels scrolled divided by 5)
						var yPos = -($window.scrollTop() / $bgobj.data('speed'));

						// Put together the final background position.
						var coords = '50% '+ yPos + 'px';

						// Move the background.
						$bgobj.css({backgroundPosition: coords});
						});
					});
				}
			});
			
			// SCROLL ANIMATION
			$window.scroll(function() {					
				if ($(window).scrollTop() >= showCase/2) {
					$("#home-skills").css("visibility", "visible");
					$("#home-skills").addClass("animated fadeInUp");         
				}
			});
			
			$window.scroll(function() {					
				if ($(window).scrollTop() >= homeBanner + showCase + skills/3) {
					$("#home-works").css("visibility", "visible");
					$("#home-works").addClass("animated fadeIn");           
				}
			});
			
			$window.scroll(function() {					
				if ($(window).scrollTop() >= homeBanner + showCase + skills + works) {
					$("#home-testimonials").css("visibility", "visible");
					$("#home-testimonials").addClass("animated fadeIn");
				}
			});
			
			$window.scroll(function() {					
				if ($(window).scrollTop() >= homeBanner + showCase + skills + works + testimonials) {
					$("#home-about h1").css("visibility", "visible");
					$("#home-about h1").addClass("animated fadeIn");
					
					$("#home-about .col-lg-5").css("visibility", "visible");
					$("#home-about .col-lg-5").addClass("animated fadeInLeft");

					$("#home-about .col-lg-7").css("visibility", "visible");
					$("#home-about .col-lg-7").addClass("animated fadeInRight");                    
				}
			});
		});
		</script>		
		<?php endif; ?>

		<?php if (PAGENAME == "blog" || is_home() || is_single() || is_archive() || is_search()) : ?>
		<script>
		var numWidgets = $(".sidebar aside").length;
		
		if(numWidgets <= 2) {
			$(".sidebar").addClass("makeSticky");
		}
		</script>
		<?php endif; ?>

		<?php if (PAGENAME == "blog") : ?>
		<script>
		// BLOG BANNER PARALLAXAL BACKGROUND
		$(function() {
		  var $window = $(window);
		  $('#blog-image-banner').each(function() {
		    var $bgobj = $(this);
		    $window.scroll(function() {
			    var yPos = -($window.scrollTop() / $bgobj.data('speed'));
			    var coords = '50% '+ yPos + 'px';
			    $bgobj.css({ backgroundPosition: coords });
		    });
		  });
		});
		</script>
		<?php endif; ?>

		<?php if (!is_front_page()) : ?> 
		<script>
		$(function() {
	    var wpAdminBarHeight = $('#wpadminbar').height();
	    $('#mainNav').css('top', wpAdminBarHeight);
  	});
	  </script>
	  <?php else : ?>
		<script>
		$(function() {
	    var wpAdminBarHeight = $('#wpadminbar').height();	    		
	    var $window          = $(window);	// save the window object to a variable
			var topNav   		     = $('#topNav').height(); // the scroll distance will be the height of the header element
			var showCase         = $('.showcase').height();
			
			// NAVIGATION
			$window.scroll(function() {
				// If the top of the scrollbar (window) is leveled with or passed the set height of the scroll distance, make adjustments.
				if ($(this).scrollTop() >= topNav + showCase) {
					$('#mainNav').css('top', wpAdminBarHeight);
				}
			});
		});
	  </script>
    <?php endif; ?>
    
  </body>
</html>