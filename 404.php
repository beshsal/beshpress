<?php get_header(); ?>

<!-- Page Heading/Breadcrumb -->
<div class="container">
	<h1 class="page-heading mt-4 mb-3 text-center animated fadeIn"><?php echo ucwords("page not found"); ?></h1>
	<?php get_template_part('breadcrumb'); ?>
</div>

<!-- Page Content --> 
<main>   		
	<div class="page-section container">		
		<div class="row">
			<div class="col-12 animated fadeInUp">
			<section id="page-not-found">
				<div class="content-wrapper">
					<h3 class="">Oops. Looks like we can't find that page. <span>No problem. Let's get you back on track:</span></h3>

					<div class="page-not-found-directory">
						<h4>Categories</h4>
						<p>Check out one of our popular post categories:</p>
						<ul>
							<?php
								wp_list_categories(array(									
									'orderby'	  => 'count',
									'order'		  => 'DESC',
									'show_count'=> 1,
									'title_li'	=> '',
									'number'	  => 10									
								));
							?>
						</ul>
					</div><!-- .widget -->

				<div class="page-not-found-directory">
					<h4>Archives</h4>
					<p>Or you'll find what you are looking for in our archives:</p>
					<?php the_widget('WP_Widget_Archives', 'title= ', 'before_title=<h4 class="widgettitle">&after_title=</h4>'); ?>
				</div>
					
				<p class="back-home">...or just head back to the <a href="<?php echo esc_url( home_url( '/' ) ); ?>">home page</a>.</p>				
				</div>				
			</section>
			</div>
		</div><!-- /.row -->			
	</div><!-- /.container -->
</main>

<?php get_footer(); ?>