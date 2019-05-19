<section id="home-testimonials" class="page-section">
	<div class="container">
		<h1 class="page-heading text-center">Testimonials</h1>
		<div class="row">
			
			<?php $testimonials = new WP_Query(array('post_type' => 'testimonial', 'post_status'=>'publish', 'posts_per_page' => 5)); ?>

			<?php
      $i = 0;
      ?>

			<?php while ($testimonials->have_posts()) : $testimonials->the_post(); ?>

				<?php 
				$org_name     = get_post_meta($post->ID, 'org_name_field', true);
				$client_title = get_post_meta($post->ID, 'client_title_field', true);
				$org_website  = get_post_meta($post->ID, 'org_website_field', true);

				if (!empty($org_website)) {
					$org_website = removeHttp($org_website);					  
					$org_website = "<a href=http://{$org_website}>" . ucfirst($org_website) . "</a>";
				}	
				?>

				<?php
        $i++;
        if ($i % 2 != 0) {
          // Odd Post
          $imageColumn   = "col-lg-3 order-1 order-lg-2";
          $contentColumn = "col-lg-9 order-2 order-lg-1";
        } else {
          // Even Post
          $imageColumn   = "col-lg-3 order-1";
          $contentColumn = "col-lg-9 order-2";
        }
        ?>

				<div class="testimonial-box <?php if ($i == 1) echo 'addShadow'; ?>"> <!-- addShadow -->
					<div class="container">
						<div class="row">
							<div class="<?php echo $contentColumn; ?>">
								<hr>
								<div class="clearfix"></div>
								<h2><?php the_title(); ?></h2>
								<h3>
									<?php 
									if (!empty($client_title)) {
										echo $client_title;										
									} 

									if (!empty($org_name) && !empty($client_title)) {
										echo " @ " . $org_name;
									} else {
										echo $org_name;
									}

									if (!empty($org_website)) {
										echo " (" . $org_website . ") ";
									} 
									?>
								</h3>
								<p class="lead"><?php echo get_the_content(); ?></p> <!-- the_content() adds extra p tags -->
							</div>
							<div class="<?php echo $imageColumn; ?>">
								<?php 
								if (has_post_thumbnail()) { 
									$thumb_id        = get_post_thumbnail_id();
									$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
									$thumb_url       = $thumb_url_array[0];
              		$thumb_alt       = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
								?>
								<img class="img-fluid rounded-circle" src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr($thumb_alt); ?>">
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
	</div>
</section>