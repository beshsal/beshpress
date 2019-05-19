<?php
/* Template Name: Sidebar Left Template */
/* Template Post Type: post */

// Above is required to show the template in the editor.
?>

<?php get_header(); ?>

<!-- Page Heading/Breadcrumb -->
<div class="container">
	<h1 class="page-heading mt-4 mb-3 text-center animated fadeIn"><?php echo ucwords(the_title()); ?></h1>
	<?php get_template_part('breadcrumb'); ?>
</div>

<!-- Page Content --> 
<main>   		
	<div class="page-section container">
		<div class="row">

			<!-- Sidebar Widgets Column -->
			<?php
			// If the sidebar is not active, do not include the code below.
			if (!is_active_sidebar( 'sidebar-1' ) ) {
				return;
			}
			?>

			<!-- Sidebar Widgets Column -->
			<div class="col-md-5 col-lg-4 order-2 order-md-1 animated <?php if (get_query_var('paged') == 0) echo 'fadeInLeft'; else echo 'fadeIn'; ?>">
				<div class="sidebar">
					<?php dynamic_sidebar('sidebar-1'); ?>
				</div>
			</div>

			<!-- Post Content Column -->
			<div class="col-md-7 col-lg-8 order-1 order-md-2 animated fadeIn">
				<section id="post">
					<?php while (have_posts()) : the_post();
						get_template_part('template-parts/content', "single"); 

						// If comments are open or there is at least one comment, load up the comments template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
					 endwhile; ?>
				</section>
			</div>			
		</div><!-- /.row -->			
	</div><!-- /.container -->
</main>

<?php get_footer(); ?>
