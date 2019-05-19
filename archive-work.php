<?php get_header(); ?>

<!-- Page Heading/Breadcrumb -->
<div class="container">
  <h1 class="page-heading mt-4 mb-3 text-center animated fadeIn"><?php echo post_type_archive_title('', false); ?></h1>
  <?php get_template_part('breadcrumb'); ?>
</div>

<main>
  <section id="works" class="page-section container animated fadeIn">
    <div class="row">
      <?php 
      $paged = (get_query_var('paged')) ? absint( get_query_var( 'paged' )) : 1;
      $work = new WP_Query( array('post_type' => 'work', 'post_status'=>'publish', 'posts_per_page' => 6, 'paged' => $paged) );
      ?>
      <?php while ( $work->have_posts() ) : $work->the_post(); ?>
      <div class="col-lg-4 col-sm-6 portfolio-item">
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
            <img class="card-img-top" src="<?php echo $thumb_url; ?>" alt="<?php echo esc_attr($thumb_alt); ?>">
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

    <!-- Pagination -->
    <ul class="pagination justify-content-center">
    <?php
    $args = array(
      'format'    => 'page/%#%',
      'current'   => $paged,
      'total'     => $work->max_num_pages,
      'mid_size'  => 2,
      'prev_text' => __('&laquo'),
      'next_text' => __('&raquo;')
    );

    echo paginate_links($args);
    ?>
    </ul>
  </section><!-- /.container -->
</main>

<?php get_footer(); ?>