<?php get_header(); ?>

<!-- Page Heading/Breadcrumb -->
<div class="container">
	<h1 class="page-heading mt-4 mb-3 text-center animated fadeIn">
		<?php
		//  Add a different heading depending on what type of archive it is.
		// (consider a switch statement)

			if (is_author()) { // if it's an author archive
		    the_post();
		    echo 'By Author: <em>' . get_the_author() . "</em>"; // get the author's name
		    rewind_posts(); // used in special cases but including it anyway
		  } elseif (is_category()) { // if it's a category archive
		    echo "Category: <em>"; ucwords(single_cat_title()); echo "</em>"; // get the category name		  
		  } elseif (is_tag()) { // if it's a tag archive
		    echo "Tag: <em>"; single_tag_title(); echo "</em>"; // get the tag name
		  } elseif (is_day()) {
		    echo 'By Day: <em>' . get_the_date() . "</em>";
		  } elseif (is_month()) {
		    echo 'By Month: <em>' . get_the_date('F Y') . "</em>";
		  } elseif (is_year()) {
		    echo 'By Year: <em>' . get_the_date('Y') . "</em>";
		  } else {
		    echo 'Archives'; // if none of the above apply, just echo "Archives"
		  }
		?>			
	</h1>
	<?php get_template_part('breadcrumb'); ?>
</div>

<!-- Page Content --> 
<main>   		
	<div class="page-section container">
		<div class="row">							
			<!-- Blog Entries Column -->
			<div class="col-md-7 col-lg-8 animated fadeIn">
			<section id="archive">
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
