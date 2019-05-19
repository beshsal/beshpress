
<?php 
// Constant for the base URL
define("PAGENAME", get_query_var("pagename"));

$postType = get_post_type_object(get_post_type());

if ($postType) {
  $curPostType = esc_html($postType->labels->singular_name);
}
?>

<!doctype html>
<html <?php language_attributes(); ?>>
  <head>
    <!-- Required meta tags -->
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- If there is no internet connection, it defaults to the local bootstrap.min.css copy. -->
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/bootstrap.css">
    <!-- CSS Effects -->
    <?php if (get_theme_mod('animation', 1)) : ?>
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/animate.css">
  	<?php endif; ?>
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/img-hover-effect.css">
		<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:700,800,900" rel="stylesheet">
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/fonts/css/fontawesome.css">
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/fonts/css/brands.css">
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/fonts/css/solid.css">
		<!-- Material Icons -->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

		<title><?php bloginfo('name'); ?> | 
			<?php 
			if (is_front_page()) {
		 		bloginfo('description');
		 	} elseif (!empty($curPostType) && $curPostType == "Contact") {
		 		echo $curPostType;
		 	} else {
		 		wp_title('');
		 	} 			
			?>				
		</title>
		
		<style>	
		<?php if (is_front_page()) : ?>    		
			body {
				padding-top: 0 !important;
				background: url(<?php bloginfo('template_url'); ?>/img/tile.jpg) top left repeat;
			}
			
			/* SHOW CASE & TOP NAVIGATION */ 
			.showcase {
				position: relative;
				width: 100%;       
				min-height: 100vh;
				background: url(<?php echo get_theme_mod('showcase_image', get_bloginfo('template_url') . '/img/showcase.jpg'); ?>);
				background-position: center; /* center the image */
				background-repeat: no-repeat; /* do not repeat the image */
				background-size: auto 120%;
			}
				
			@media only screen and (min-width: 1327px) {
				.showcase {
					background-size: cover;
				}
			}
				
			#topNav {
				padding-top: 0;
				padding-bottom: 0;
				display: none;
			}
				
	    @media only screen and (min-width: 992px) {
				#topNav {
					display: block;
					background-image: none;
					background-color: transparent !important;
				}

				#topNav form {
					display: none;
				}
	    }
				
			#topNav .navbar-brand {
				text-shadow: 3px 3px 3px rgba(0, 0, 0, 0.18);
				color: #fff;
			}
				
			#topNav .navbar-brand:hover {
				color: #fff;
			}
				
			#topNav .navbar-nav {
			}
				
			#topNav .navbar-nav li {
				padding: 0;
			} 
				
			#topNav .navbar-nav li:hover {
				background-color: #de6f66;
			}
				
			#topNav .navbar-nav a {
				color: #de6f66;
				padding: 1em;
			}
				
			#topNav .navbar-nav a:hover {
				color: #fff;
				transition: 0.3s;
			}
				
			@media only screen and (min-width: 992px) {
	    	#topNav .navbar-nav a {
					padding: 1.5em;
				}
	    }
				
			#topNav .navbar-toggler i.fas.fa-bars {
				color: #303030;
			}
			
			/* HOME BANNER */

			#home-image-banner {
				height: 400px;
				background: url(<?php echo get_theme_mod('home_banner_image', get_bloginfo('template_url') . '/img/default-banner.jpg'); ?>);
				background-attachment: fixed;
				background-position: top;
				background-repeat: no-repeat;
				background-size: cover;
				display: flex;
			  align-items: center;
			  justify-content: center;
			}

			<?php if (get_theme_mod('add_home_banner', 1)) : ?>
				section:nth-child(odd) {
					background-color: #fff;
				}
			<?php else: ?>
				section:nth-child(even) {
					background-color: #fff;
				}
			<?php endif; ?>
			
			section:first-child { 
				/*background: url(<?php // bloginfo('template_url'); ?>/img/tile.jpg) top left repeat;*/
				background-color: transparent;
			}
    
		<?php endif; ?>
		
		<?php if (PAGENAME == "work" || is_single()) : ?>
			@media screen and (min-width: 1200px) {	
				.page-heading {
					width: 85%;
					margin: auto;
				}
			}		
		<?php endif; ?>
		
		/* PAGE BANNER */

		<?php if (PAGENAME == "blog") : ?>
			#blog-image-banner {
				height: 400px;
				background: url(<?php echo get_theme_mod('blog_banner_image', get_bloginfo('template_url') . '/img/default-banner.jpg'); ?>);
				background-attachment: fixed;
				background-position: top;
				background-repeat: no-repeat;
				background-size: cover;
				display: flex;
			  align-items: center;
			  justify-content: center;
			  resize: both;
			}
		<?php endif; ?>

		<?php if (is_front_page() || PAGENAME == "blog") : ?>
			.banner-text-wrapper h1 {
				color: #fff;
				font-size: 2.5em;
				font-weight: 800;
				text-shadow: 0px 1px 2px rgba(31,13,8,0.85);
				text-align: center;
				padding-left: 15px;
				padding-right: 15px;
			}

			@media screen and (min-width: 576px) {
				.banner-text-wrapper h1 {
					font-size: 3em;
					font-weight: 700;
				}
			}

			@media screen and (min-width: 992px) {
				.banner-text-wrapper h1 {
					font-size: 3.5em;
				}
			}

			@media screen and (min-width: 1200px) {
				.banner-text-wrapper h1 {
					font-size: 4.1em;
				}
			}

			.banner-text-wrapper p {
				color: #fff;
				font-size: 1.5em;
				font-weight: 600;
				text-shadow: 0px 1px 2px rgba(31,13,8,0.74);
				text-align: center;
				padding-left: 15px;
				padding-right: 15px;
			}

			@media screen and (min-width: 576px) {
				.banner-text-wrapper p {
					font-size: 1.8em;
				}
			}
		<?php endif; ?>
		</style>

    <?php wp_head(); ?> <!-- wp_enqueue_style() did not work until I added this -->
  </head>
  <body>
		<?php 
		// If on the home page, display the showcase image and the top navigation bar.
		if (is_front_page()) : ?>	
		<header class="showcase" data-type="background" data-speed="5">
			<div class="headerBox">
				<div class="headerContent animated fadeIn">
					<h1><?php echo get_theme_mod('showcase_heading', 'Heading'); ?></h1>
					<h2><?php echo get_theme_mod('showcase_heading2', 'Heading 2'); ?></h2>
					<p><?php echo get_theme_mod('showcase_body_text', 'Body'); ?></p>
					<div>
						<?php if(get_theme_mod('modal', 1)) : ?>
						<button class="btn btn-outline-success my-2 my-sm-0" type="button" data-toggle="modal" data-target="#myModal">Join</button>
						<?php endif; ?>
					</div>
				</div>				
			</div>
			<nav id="topNav" class="navbar navbar-expand-lg">
				<div class="container-fluid">
					<?php
					// Add a logo image if selected.
					if (has_custom_logo()) {
					  if (function_exists( 'the_custom_logo')) {
							the_custom_logo();
						}
					} else { ?>
						<a class="navbar-brand" href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>
					<?php } ?>					

					<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
						<i class="fas fa-bars"></i>
					</button>

					<?php
					wp_nav_menu(array(
						'theme_location'  => 'top',
						'depth'           => 2,
						'container'       => 'div',
						'container_class' => 'collapse navbar-collapse',
						'container_id'		=> 'navbarResponsive',
						'menu_class'      => 'navbar-nav mr-auto',
						'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
						'walker'          => new WP_Bootstrap_Navwalker()
					));
	        ?>

				</div>
			</nav>
    </header>
		<?php endif; ?>
		<!-- Primary Navigation -->
		<nav id="mainNav" 
				 class="navbar navbar-expand-lg <?php if (is_front_page()) echo 'sticky-top'; else echo 'fixed-top'; ?>"
				 <?php if (is_front_page()) : ?>
				 style="display: none"
				 <?php endif; ?>>
			<div class="container">
				<?php
				if (has_custom_logo()) {
				  if ( function_exists('the_custom_logo')) {
						the_custom_logo();
					}
				} else { ?>
				  <a class="navbar-brand" href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>
				<?php } ?>

				<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
					<i class="fas fa-bars"></i>
				</button>
				<div class="collapse navbar-collapse" id="navbarResponsive">
					<?php
					// Note: I cannot place the search form inside div.collapse.navbar-collapse, so I created div.menuWrapper to be the container for
					// the menu (ul). I removed .ml-auto from the ul and added it to div.menuWrapper to fix the formatting issue.
					wp_nav_menu( array(
						'theme_location'	=> 'primary',
						'depth'				=> 1, // 1 = with dropdowns, 0 = no dropdowns.
						'container'			=> 'div',
						'container_class'	=> 'menuWrapper ml-auto',
						'menu_class'		=> 'navbar-nav',
						'fallback_cb'		=> 'WP_Bootstrap_Navwalker::fallback',
						'walker'			=> new WP_Bootstrap_Navwalker()
					) );
					?>
					<!-- Adding "echo" to "esc_url(home_url('/'))" solved the search issue; "echo home_url()" works too. -->
					<form method="get" action="<?php echo esc_url(home_url('/')); ?>" class="search-form form-inline my-2 my-lg-0">
						<input name="s" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
						<button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>
					</form>
				</div>
			</div>
		</nav>