<section id="home-skills" class="page-section">
	<div class="container">
		<h1 class="page-heading text-center">Skills</h1>
		<div class="row">

		<?php $skills = new WP_Query(array('post_type' => 'skill', 'post_status'=>'publish', 'orderby' => 'post_id', 'order' => 'ASC', 'posts_per_page' => 4)); ?>
			
		<?php while ($skills->have_posts()) : $skills->the_post(); ?>

		<?php
		$iconName = get_post_meta($post->ID, 'skill_icon_field', true);
		?>

			<div class="col-sm-6 col-lg-3 mb-4">
				<div class="skill card h-100 addShadow">
					<div class="hex-wrapper">
						<?php if (!empty($iconName)) { ?>
						<div class="hexagon"><i class="material-icons text-center"><?php echo $iconName; ?></i></div>
						<?php } ?>
					</div>
					<h4 class="card-header text-center"><?php the_title(); ?></h4>
					<div class="card-body">
						<p class="card-text"><?php echo get_the_content(); ?></p>
					</div>
				</div>
			</div>
		<?php endwhile; wp_reset_postdata(); ?>
		</div>
	</div>
</section>