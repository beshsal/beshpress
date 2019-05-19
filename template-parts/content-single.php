<!-- Page Content -->
<article class="post-item">
	<!-- Post Image -->
	<?php 
	// Check if the post as a featured image assigned to it.
	if (has_post_thumbnail()) { 
		$thumb_id  = get_post_thumbnail_id($post->ID);
	 	$thumb_alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
	?>
	<figure>
	<div class="hideOverflow rounded">
		<img class="img-fluid rounded" src="<?php the_post_thumbnail_url(); ?>" alt="<?php echo $thumbnail_alt; ?>">
	</div>
	<?php
	$caption = get_the_post_thumbnail_caption();
	if (!empty($caption)) :
	?>
	<figcaption><em><small><?php echo $caption; ?></small></em></figcaption>
	<hr>
	<?php endif; ?>
	</figure>
	<?php } ?>
	
		
	<?php if (is_singular('post')) { ?>
	<header class="post-header">
		<!-- Post Details -->
		<div class="post-details">
			<small>
				<span class="post-detail"><i class="fas fa-user"></i> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a></span>
				<span class="post-detail"><i class="fas fa-clock"></i> <time><?php the_time('F j, Y'); ?></time></span>
				<span class="post-detail"><i class="fas fa-folder"></i> 
				<?php
				ucwords(the_category(", "));
			  ?>
				</span>
			<?php if (has_tag()) : ?>
			<span class="post-detail"><i class="fas fa-tags"></i> <?php ucwords(the_tags("", ", ")); ?></span>
			<?php endif; ?>
				<span class="post-detail"><i class="fas fa-comments"></i> <a href="<?php comments_link(); ?>"><?php comments_number( 0, 1, '%'); ?></a></span>
			</small>
		</div>
	</header>
	<hr>
	<?php } ?>	

	<section class="post-body">

		<p class="lead"><?php echo get_post_meta($post->ID, '_default_box_meta_key', true); ?></p>

		<!-- Post Content -->
		<?php the_content(); ?>
	</section>
</article>

<hr>