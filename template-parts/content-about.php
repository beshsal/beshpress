<section id="home-about" class="page-section">
	<div class="container">
		<h1 class="page-heading text-center">About</h1>
		<div class="row">

		<?php $bio = new WP_Query(array('post_type' => 'bio', 'post_status'=>'publish', 'posts_per_page' => 1)); ?>

		<?php while ($bio->have_posts()) : $bio->the_post(); ?>

			<div class="col-lg-5 text-center">
				<?php 
				if (has_post_thumbnail()) { 
					$thumb_id        = get_post_thumbnail_id();
					$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
					$thumb_url       = $thumb_url_array[0];
					$thumb_alt       = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
				?>
				<img class="img-fluid rounded" src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr($thumb_alt); ?>">
				<?php } ?>
			</div>

			<div class="col-lg-7">
				<h3><?php the_title(); ?></h3>
				<p class="lead"><?php echo get_post_meta($post->ID, 'heading_input_field', true); ?></p>
				<p><?php echo get_the_content(); ?></p> <!-- the_content() adds extra p tags -->
			</div>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
	</div>
</section>