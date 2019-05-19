<?php
/* Template Name: Full Width Template */
/* Template Post Type: work */

// Above is required to show the template in the editor.
?>

<?php
get_header(); ?>

	<!-- Page Heading/Breadcrumb -->
<div class="container">
	<h1 class="page-heading mt-4 mb-3 text-center animated fadeIn"><?php echo ucwords(the_title()); ?></h1>
	<?php get_template_part('breadcrumb'); ?>
</div>

<!-- Page Content --> 
<main>   		
	<div class="page-section container-fluid">
		<section id="work">
			<div class="row">	
				<?php while (have_posts()) : the_post(); ?>
					<?php
						$work_date      = get_post_meta($post->ID, 'date_field', true);
				    $client_name    = get_post_meta($post->ID, 'client_field', true);
				    $client_website = get_post_meta($post->ID, 'client_website_field', true);
				    $service_type   = get_post_meta($post->ID, 'service_field', true);

						if (!empty($client_website)) {
							$client_website = str_replace( parse_url( $client_website, PHP_URL_SCHEME ) . '://', '', $client_website );
							$client_website = "<a href=http://{$client_website}>" . $client_website . "</a>";
						}
					?>
					<!--  Image Column -->
					<div class="col-xl-8 animated fadeIn">
						<?php 
						if (has_post_thumbnail()) {
  						$thumb_id             = get_post_thumbnail_id();
							$thumb_url_array      = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
							$thumb_url            = $thumb_url_array[0];
							$thumb_alt            = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
							$full_image_url_array = wp_get_attachment_image_src($thumb_id, 'full');
							$full_image_url       = $full_image_url_array[0];
						?>
						<a href="<?php echo $full_image_url; ?>"><img class="card-img-top rounded" src="<?php echo $thumb_url; ?>" alt="<?php echo esc_attr($thumb_alt); ?>"></a>
						<?php } ?>
					</div>
					<div class="col-xl-4 animated fadeIn">
						<hr>
						<strong>Title:</strong>
						<p><?php the_title(); ?></p>
						<?php if (!empty($work_date)) : ?>
							<p><strong>Project Date:</strong> <?php $yrdata = strtotime($work_date); echo date('F Y', $yrdata); ?></p>
						<?php endif; ?>	
						<?php if (!empty($client_name)) : ?>					
							<p><strong>Client:</strong> <?php echo $client_name; ?></p>
						<?php endif; ?>	
						<?php if (!empty($client_website)) : ?>
							<p><strong>Client Website:</strong> <?php echo $client_website; ?></p>
						<?php endif; ?>
						<?php if (!empty($service_type)) : ?>
							<p><strong>Services:</strong> <em><?php echo $service_type; ?></em></p>
						<?php endif; ?>

						<strong>Project Description:</strong>
						<?php echo get_the_content(); ?>

					</div>
				<?php endwhile; ?>			
			</div><!-- /.row -->
		</section>			
	</div><!-- /.container -->
</main>

<?php get_footer();