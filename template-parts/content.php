<div class="col-lg-6">
<!-- Blog Post -->	
<article class="card mb-4 h-100">
	<?php 
	// Check if the post has a featured image assigned to it.
	if (has_post_thumbnail()) { 
	?>
	<div class="hideOverflow">
		<a href="<?php the_permalink(); ?>"><img class="card-img-top" src="<?php the_post_thumbnail_url(); ?>" alt="Card image cap"></a>
	</div>
	<?php } ?>

	<div class="card-body">
		<h2 class="card-title post-title"><a class="" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php ucwords(the_category(", ")); ?>
		<p class="card-text">		
    <?php the_excerpt(); ?>					    	
    </p>
		<a href="<?php the_permalink(); ?>" class="btn btn-primary">Read More &rarr;</a>
	</div>
	<div class="card-footer text-muted">
		Posted on <time><?php the_time('F j, Y'); ?></time>
		by
		<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a>
	</div>
</article>
</div>