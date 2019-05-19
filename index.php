<?php get_header(); ?>

<?php 
	$pageNum     = get_query_var('paged');
	$count_posts = wp_count_posts();

	// echo $count_posts->publish; // number of published posts
	// echo $wp_query->post_count; // number of posts in the result
?>

<!-- Blog page banner -->
	<?php 
	if ($pageNum == 0 && get_theme_mod('add_blog_banner', 1)) :
		get_template_part('template-parts/content/content', 'blog-banner');
	endif; 
	?>

<!-- Page Heading/Breadcrumb -->
<div class="container">	
	<h1 class="page-heading mt-4 mb-3 text-center animated fadeIn">
	<?php if (!get_theme_mod('add_blog_banner', 1)) { ?>
		<?php echo ucwords(PAGENAME); ?>
	<?php } ?>	
	</h1>
	
	<?php get_template_part('breadcrumb'); ?>
</div>

<!-- Page Content --> 
<main>   		
	<div class="page-section container">
		<div class="row">							
			<!-- Blog Entries Column -->
			<div class="col-md-7 col-lg-8 animated <?php if (!get_theme_mod('add_blog_banner', 1) && $pageNum == 0) echo 'fadeInLeft'; else echo 'fadeIn'; ?>">
			<section id="blog">
				<div class="row">
				<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>						
						<?php get_template_part('template-parts/content', get_post_format()); ?>
					<?php endwhile; ?>
					<!-- Pagination -->
					<ul class="col-12 pagination justify-content-center mb-4">
						<li class="page-item">
							<?php next_posts_link("&larr; Older"); ?>
						</li>
						<li class="page-item">
							<?php previous_posts_link("Newer &rarr;"); ?>
						</li>
					</ul>
				<?php endif; ?>
				</div>
				</section>
			</div>

			<!-- Sidebar Widgets Column -->
			<?php get_sidebar(); ?>
			
		</div><!-- /.row -->			
	</div><!-- /.container -->
</main>

<?php get_footer(); ?>
