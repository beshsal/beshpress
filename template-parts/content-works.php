<section id="home-works" class="page-section">
	<div class="container-fluid">
		<h1 class="page-heading text-center">Works</h1>
		<div class="row">
			<?php $works = new WP_Query(array('post_type' => 'work', 'post_status'=>'publish', 'posts_per_page' => 4)); ?>

			<?php while ($works->have_posts()) : $works->the_post(); ?>
				<div class="col-xl-3 col-sm-6 portfolio-item">
					<div class="card">
					<a href="<?php the_permalink(); ?>">					
					<div class="imgHover">
						<?php 
						if (has_post_thumbnail()) { 
							$thumb_id        = get_post_thumbnail_id();
							$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
							$thumb_url       = $thumb_url_array[0];
	 						$thumb_alt       = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
						?>
						<img class="card-img-top" src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr($thumb_alt); ?>">
						<?php } ?>
						<div class="caption">
							<div class="blur"></div>
							<div class="caption-text">
								<h1><?php the_title(); ?></h1>
							</div>
						</div>
					</div>
					</a>
					</div>
				</div>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
		<div class="text-right">
			<?php
			$count_posts = wp_count_posts("work");
			if ($count_posts->publish > 4) : ?>
			<a class="seeMore" href="works">See all &rarr;</a>
			<?php endif; ?>
		</div>			
	</div>
</section>