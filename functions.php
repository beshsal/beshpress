<?php
/* ========== ENQUEUE STYLESHEET (style.css) ========== */

function beshpress_add_theme_style() {
	if ( is_child_theme() ) {
  	// Load the parent stylesheet first if this is a child theme.
		wp_enqueue_style('parent-stylesheet', trailingslashit( get_template_directory_uri()) . 'style.css', false);
  }
  
  // Load the active theme stylesheet in both cases.
  wp_enqueue_style('theme-stylesheet', get_stylesheet_uri(), false);
} 
add_action('wp_enqueue_scripts', 'beshpress_add_theme_style');

/* ========== THEME SUPPORT ========== */

function beshpress_add_theme_support() {
  // Add the Featured Image option to the editor.
  add_theme_support('post-thumbnails');
  
  // Post Format Support
  // Enable the different post formats we may want to use;
  // This adds a format box with these options to our interface.
  add_theme_support('post-formats', array('aside', 'gallery', 'video', 'link'));

  // Allow uploading a logo image.
  $defaults = array(
    'height'      => 100,
    'width'       => 400,
    'flex-height' => true,
    'flex-width'  => true
  );
  add_theme_support('custom-logo', $defaults);
}
add_action('after_setup_theme', 'beshpress_add_theme_support');


/* ========== NAVIGATION MENUS ========== */

// Load the WP Navwalker class.
if (!file_exists( get_template_directory() . '/class-wp-bootstrap-navwalker.php')) {
	// If the class does not exist, return an error.
	return new WP_Error('class-wp-bootstrap-navwalker-missing', __( 'It appears the class-wp-bootstrap-navwalker.php file may be missing.', 'wp-bootstrap-navwalker'));
} else {
	// Register the class.
	require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}

// Register navigation menus.
function beshpress_register_menus() {
    register_nav_menus(
        array(
          'primary' => __('Primary Menu'),
          'top' 		=> __('Top Menu'),
          'bottom'  => __('Bottom Menu')
        )
    );
}
add_action('init', 'beshpress_register_menus');

function beshpress_footer_menu_classes($classes, $item, $args) {
  if ($args->theme_location == 'bottom') {
    $classes[] = 'list-inline-item';
  }
  return $classes;
}
add_filter('nav_menu_css_class', 'beshpress_footer_menu_classes', 1, 3);

/* ========== WIDGETS/SIDEBAR ========== */

// Widget Locations
function beshpress_widgets_init($id) {
	register_sidebar(array( 
		'name'	        => __('Primary Sidebar'),
		'id'	          => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside class="card my-4">',
		'after_widget'	=> '</aside>',
		'before_title'	=> '<h5 class="card-header">',
		'after_title'	  => '</h5>'
	));
}
add_action('widgets_init', 'beshpress_widgets_init');


/* ========== POST CONTENT FORMATTING ========== */

// Replace the excerpt "[...]" text with an "...".
function beshpress_new_excerpt_more($more) {
  global $post;
  return '<span>...</span>';
}
add_filter('excerpt_more', 'beshpress_new_excerpt_more');

/* ========== SHORTCODE ========== */

/* Lead */
function leadtext_shortcode($atts, $content = null) {
	$the_content = str_replace("<br>", "", $content);
	return '<p class="lead">' . $the_content . '</p>';
}
add_shortcode('leadtext', 'leadtext_shortcode');

/* Blockquote */
function blockquote_shortcode($atts, $content = null) {
	return '<blockquote class="blockquote"><p style="margin-bottom: 0;">' . do_shortcode($content) . '</p></blockquote>';
}
add_shortcode('blockquote', 'blockquote_shortcode');

/* Quote Footer */
function quotefooter_shortcode($atts, $content = null) {
	return '<footer class="blockquote-footer">' . do_shortcode($content) . '</footer>';
}
add_shortcode('quotefooter', 'quotefooter_shortcode');

/* Quote Citation */
function citation_shortcode( $atts, $content = null ) {
	return '<cite title="Source Title">' . $content . '</cite>';
}
add_shortcode('citation', 'citation_shortcode');


/* ========== CUSTOM POST TYPES & CUSTOM FIELDS META BOXES ========== */

function xcompile_post_type_labels($singular = 'Post', $plural = 'Posts') {
  $p_lower = strtolower($plural);
  $s_lower = strtolower($singular);

  return [
    'name'                  => $plural,
    'singular_name'         => $singular,
    'add_new_item'          => "New $singular",
    'edit_item'             => "Edit $singular",
    'view_item'             => "View $singular",
    'view_items'            => "View $plural",
    'search_items'          => "Search $plural",
    'not_found'             => "No $p_lower found",
    'not_found_in_trash'    => "No $p_lower found in trash",
    'parent_item_colon'     => "Parent $singular",
    'all_items'             => "All $plural",
    'archives'              => "$singular Archives",
    'attributes'            => "$singular Attributes",
    'insert_into_item'      => "Insert into $s_lower",
    'uploaded_to_this_item' => "Uploaded to this $s_lower",
  ];
}

// Check for empty strings and allow for a value of `0`.
function empty_str($str) {
  return ! isset($str) || $str === "";
}

/* DEFAULT CUSTOM FIELD META BOX */

require get_template_directory() . '/inc/default-metabox.php';

/* BIO CPT */

require get_template_directory() . '/inc/bio-cpt.php';

/* SKILL CPT */

require get_template_directory() . '/inc/skill-cpt.php';

/* WORK CPT */

require get_template_directory() . '/inc/work-cpt.php';

/* TESTIMONIAL CPT */

require get_template_directory() . '/inc/testimonial-cpt.php';

/* CONTACT CPT */

require get_template_directory() . '/inc/contact-cpt.php';

/* ========== THEME CUSTOMIZER ========== */

require get_template_directory() . '/inc/customizer.php';

/* ========== MAIL SERVER CONFIGURATION ========== */

add_action('phpmailer_init', 'mailer_config', 10, 1);
function mailer_config(PHPMailer $mail) {
  // $mail->SMTPDebug = 3; // enable verbose debug output
  $mail->isSMTP(); // set mailer to use SMTP
  $mail->Host = 'smtp.mailtrap.io';
  $mail->Username = '';
  $mail->Password = '';
  $mail->Port = 2525;
  $mail->SMTPSecure = 'tls'; // enable TLS encryption, `ssl` also accepted
  $mail->SMTPAuth = true; // enable SMTP authentication
  $mail->isHTML(true); // set email format to HTML
  $mail->CharSet = 'UTF-8';
}

add_action('wp_mail_failed', 'log_mailer_errors', 10, 1);
function log_mailer_errors( $wp_error ) {
  $fn = ABSPATH . '/mail.log'; // if there is a mail.log file in the server root
  $fp = fopen($fn, 'a');
  fputs($fp, "Mailer Error: " . $wp_error->get_error_message() ."\n");
  fclose($fp);
}

/* ========== CUSTOM ========== */

/* Remove "http", "https", and "www" from values. */
function removeHttp($url) {
  $pattern = array('http://', 'https://', 'www.');
  $url = esc_url($url);

  foreach ($pattern as $p) {
    if (strpos($url, $p) == 0) {
      $url = str_replace($p, '', $url);
    }
  }
  return $url;
}

/* EXTENDED SEARCH INCLUDING TAXONOMIES  */

// Use the posts_join filter to perform an INNER JOIN of the terms, term_relationship, and term_taxonomy tables on the posts table.
function beshpress_posts_join($join, $query) {

  global $wpdb;

  if (is_main_query() && is_search()) {
    $join .= "
    LEFT JOIN
    (
      {$wpdb->term_relationships}
      INNER JOIN
      {$wpdb->term_taxonomy} ON {$wpdb->term_taxonomy}.term_taxonomy_id = {$wpdb->term_relationships}.term_taxonomy_id
      INNER JOIN
      {$wpdb->terms} ON {$wpdb->terms}.term_id = {$wpdb->term_taxonomy}.term_id
    )
    ON {$wpdb->posts}.ID = {$wpdb->term_relationships}.object_id ";
  }
  return $join;
}
add_filter('posts_join', 'beshpress_posts_join', 10, 2);

// Use the posts_where filter to modify the WHERE clause to include searches against a taxonomy.
function beshpress_posts_where($where, $query) {

  global $wpdb;

  if (is_main_query() && is_search()) {
    $user_where = get_currentuser_posts_where(); // get a WHERE clause dependent on the current user's status (see the function below)
    $where .= " 
    OR (
      {$wpdb->term_taxonomy}.taxonomy IN('category', 'post_tag')
      AND
      {$wpdb->terms}.name LIKE '%" . esc_sql(get_query_var('s')) . "%'
      {$user_where}
    )";
  }
  return $where;
}
add_filter('posts_where', 'beshpress_posts_where', 10, 2);

function get_currentuser_posts_where() {

  global $wpdb;

  $user_id = get_current_user_id();
  $sql     = '';
  $status  = array("'publish'");

  if ($user_id) {
    $status[] = "'private'";

    $sql .= " AND {$wpdb->posts}.post_author = {$user_id}";
  }
  
  $sql .= " AND {$wpdb->posts}.post_status IN( " . implode(',', $status) . " ) ";
  return $sql;
}

// Use the posts_groupby filter to condense the results by post ID, i.e. set the GROUP BY clause to post IDs.
function beshpress_posts_groupby($groupby, $query) {

global $wpdb;

if (is_main_query() && is_search()) {
  $groupby = "{$wpdb->posts}.ID";
}
return $groupby;
}
add_filter('posts_groupby', 'beshpress_posts_groupby', 10, 2);

?>

