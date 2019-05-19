<?php get_header(); ?>

<!-- Page Heading/Breadcrumb -->
<div class="container">
  <h1 class="page-heading mt-4 mb-3 text-center animated fadeIn">
    <?php if (strlen( trim(get_search_query()) ) == 0) :
      echo "Empty Search";
    else: ?>
    Search Results for: 
    <span><?php echo "<em>" . ucwords(get_search_query()) . "</em>"; ?></span>
  <?php endif; ?>
  </h1>
  <?php get_template_part('breadcrumb'); ?>
</div>

<!-- Page Content --> 
<main>      
  <div class="page-section container">
    <div class="row">             
      <!-- Blog Entries Column -->
      <div class="col-md-7 col-lg-8 animated fadeIn">
      <section id="search">
        <div class="row"> 
          <?php if (have_posts() && strlen( trim(get_search_query())) != 0) : ?>
            <?php while (have_posts()) : the_post(); ?>
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
          <?php elseif (strlen(trim(get_search_query())) == 0) : ?>
            <?php echo wpautop('<h3 class="warning mt-4 mb-3" style="padding-left: 15px;">Please enter a term in the search field.</h3>'); ?>
          <?php else : ?>
            <?php echo wpautop('<h3 class="mt-4 mb-3" style="padding-left: 15px;">Sorry. No posts matching the search term you entered were found.</h3>'); ?>
          <?php endif; ?>
        </section>
      </div>

      <!-- Sidebar Widgets Column -->
      <?php get_sidebar(); ?>
      
    </div><!-- /.row -->      
  </div><!-- /.container -->
</main>

<?php get_footer(); ?> 