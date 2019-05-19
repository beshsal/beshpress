<?php get_header(); ?>

<!-- Page Content --> 
<main>	
	<!-- Home Page Banner -->
	<?php if (get_theme_mod('add_home_banner', 1)) : ?>
		<?php get_template_part('template-parts/content', 'home-banner'); ?>
	<?php endif; ?>
	
	<!-- Skills/Services -->
	<?php get_template_part('template-parts/content', 'skills'); ?>
	
	<!-- Works/Portfolio -->
	<?php get_template_part('template-parts/content', 'works'); ?>
	
	<!-- Testimonials -->
	<?php get_template_part('template-parts/content', 'testimonials'); ?>
	
	<!-- About -->
	<?php get_template_part('template-parts/content', 'about'); ?>

</main>

<?php get_footer(); ?>