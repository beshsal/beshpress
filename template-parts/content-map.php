<section class="google-map animated fadeIn">

	<?php $map = new WP_Query(array('post_type' => 'contact', 'posts_per_page' => 1)); ?>

	<?php while ($map->have_posts()) : $map->the_post(); ?>
	<?php
	echo get_the_content();
  ?>
<?php endwhile; wp_reset_postdata(); ?>

</section>