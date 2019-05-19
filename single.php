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
			<!-- Post Content Column -->
			<div class="col-md-7 col-lg-8 animated fadeIn">
				<section id="post">
					<?php while ( have_posts() ) : the_post();
						get_template_part('template-parts/content', "single"); 

						// If comments are open or there is at least one comment, load up the comments template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
					 endwhile; ?>
				</section>
			</div>

			<!-- Sidebar Widgets Column -->
			<?php get_sidebar(); ?>
			
		</div><!-- /.row -->			
	</div><!-- /.container -->
</main>

<?php get_footer(); ?>
