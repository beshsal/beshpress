<?php
// The function for registering the meta box
function testimonial_meta_box(WP_Post $post) { // note the WP_Post object as its parameter
  // Add the form and basic text fields.
  add_meta_box('testimonial_meta', 'Optional Fields', function() use ($post) {
    $field_name  = 'org_name_field';
    $field_name2 = 'client_title_field';
    $field_name3 = 'org_website_field';
    // These variables are used for saving data and persisting data to the fields.
    $field_value  = get_post_meta($post->ID, $field_name, true); 
    $field_value2 = get_post_meta($post->ID, $field_name2, true);
    $field_value3 = get_post_meta($post->ID, $field_name3, true);
    // Add a nonce to the form.
    wp_nonce_field('testimonial_nonce', 'testimonial_nonce');
    ?>
          <p>
          <label for="<?php echo $field_name; ?>">Organization Name</label>
          <br>
          <input id="<?php echo $field_name; ?>"
                 name="<?php echo $field_name; ?>"
                 type="text"
                 value="<?php echo esc_attr($field_value); ?>"
                 size="30">
          </p>

          <p>
          <label for="<?php echo $field_name2; ?>">Client's Title</label>
          <br>
          <input id="<?php echo $field_name2; ?>"
                 name="<?php echo $field_name2; ?>"
                 type="text"
                 value="<?php echo esc_attr($field_value2); ?>"
                 size="30">
          </p>

          <p>
          <label for="<?php echo $field_name3; ?>">Organization Website</label>
          <br>
          <input id="<?php echo $field_name3; ?>"
                 name="<?php echo $field_name3; ?>"
                 type="url"
                 value="<?php echo esc_attr($field_value3); ?>"
                 placeholder="example.com"
                 size="30">

          </p>
    <?php
  });
}

function beshpress_testimonial_custom_post_type() {

  $labels = xcompile_post_type_labels('Testimonial', 'Testimonials');

  // Declare what the post type supports. The featured image is enabled.
  $supports = ['title', 'editor', 'thumbnail', 'revisions'];

  register_post_type('testimonial',
    array(
      'public'               => true,
      'supports'             => $supports, // apply supports
      'hierarchical'         => false, // hierarchy is not needed since this is not a page
      'show_in_rest'         => true, // enable the REST API (I don't need endpoints)
      'labels'               => $labels, 
      'register_meta_box_cb' => 'testimonial_meta_box', // register the meta box
      'description'          => 'Client testimonials',
      'menu_icon'            => 'dashicons-thumbs-up', // set icon 
      'has_archive'          => false,
      'exclude_from_search'  => true     
    )
  );

  // Change the placeholder text.
  add_filter('enter_title_here', function($title) {
    $screen = get_current_screen();

    if ('testimonial' == $screen->post_type) {
      $title = 'Enter name of the client here';
    }
    return $title;
  });

  // Change the update messages.
  add_filter( 'post_updated_messages', function($messages) {
    global $post, $post_ID;
    $link = esc_url( get_permalink($post_ID) );

    $messages['testimonial'] = array(
      0 => '',
      1 => sprintf( __('Testimonial updated. <a href="%s">View testimonial</a>'), $link ), // sprintf will replace %s with the second param value ($link in this case)
      2 => __('Custom field updated.'),
      3 => __('Custom field deleted.'),
      4 => __('Testimonial updated.'),
      5 => isset($_GET['revision']) ? sprintf( __('Testimonial restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
      6 => sprintf( __('Testimonial published. <a href="%s">View testimonial</a>'), $link ),
      7 => __('Testimonial saved.'),
      8 => sprintf( __('Testimonial submitted. <a target="_blank" href="%s">Preview testimonial</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID)))),
      9 => sprintf( __('Testimonial scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview testimonial</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), $link ),
      10 => sprintf( __('Testimonial draft updated. <a target="_blank" href="%s">Preview testimonial</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID))))
    );
    return $messages;
  });

  // Change the bulk messages.
  add_filter( 'bulk_post_updated_messages', function( $bulk_messages, $bulk_counts ) {
    $bulk_messages['testimonial'] = array(
      'updated'   => _n( "%s testimonial updated.", "%s testimonials updated.", $bulk_counts["updated"] ),
      'locked'    => _n( "%s testimonial not updated, somebody is editing it.", "%s testimonials not updated, somebody is editing them.", $bulk_counts["locked"] ),
      'deleted'   => _n( "%s testimonial permanently deleted.", "%s testimonials permanently deleted.", $bulk_counts["deleted"] ),
      'trashed'   => _n( "%s testimonial moved to the Trash.", "%s testimonials moved to the Trash.", $bulk_counts["trashed"] ),
      'untrashed' => _n( "%s testimonial restored from the Trash.", "%s testimonials restored from the Trash.", $bulk_counts["untrashed"] )
    );
    return $bulk_messages;
  }, 10, 2 );

}
add_action('init', 'beshpress_testimonial_custom_post_type');

// Add help section.
add_action('admin_head', function() {
  $screen = get_current_screen();

  if ('testimonial' != $screen->post_type) return;

  $args = [
    'id'      => 'testimonial_help',
    'title'   => 'Testimonial Help',
    'content' => '<h3>How to Add a Testimonial</h3>
                  <ul>
                  <li>Enter the name of the client in the title field.</li>
                  <li>Enter the client\'s testimonial in the content field.</li>
                  <li>Select the client\'s image as the featured image.</li>
                  <li>Use the optional field to enter the client\'s title.</li>
                  <li>Use the optional field to enter the name of the organization.</li>
                  <li>Use the optional field to enter the organization\'s website.</li>
                  </ul>'
  ];

  $screen->add_help_tab( $args );
});

// Save and delete meta but not when restoring a revision.
add_action('save_post', function($post_id){
  $post        = get_post($post_id);
  $is_revision = wp_is_post_revision($post_id);
  $field_name  = 'org_name_field';
  $field_name2 = 'client_title_field';
  $field_name3 = 'org_website_field';

  // Do not save meta for a revision or on autosave.
  if ($post->post_type != 'testimonial' || $is_revision)
  return;

  // Do not save meta if fields are not present,
  // like during a restore.
  if (!isset($_POST[$field_name]) || !isset($_POST[$field_name2]) || !isset($_POST[$field_name3]))
  return;

  // Secure with nonce a field check.
  if (!check_admin_referer('testimonial_nonce', 'testimonial_nonce'))
  return;

  // Clean up data.
  $field_value  = trim($_POST[$field_name]);
  $field_value2 = trim($_POST[$field_name2]);
  $field_value3 = trim($_POST[$field_name3]);

  // Do the saving and deleting.
  if (!empty_str($field_value)) {
    update_post_meta($post_id, $field_name, $field_value);
  } elseif (empty_str($field_value)) {
    delete_post_meta($post_id, $field_name);
  }

  // Do the saving and deleting.
  if (!empty_str($field_value2)) {
    update_post_meta($post_id, $field_name2, $field_value2);
  } elseif (empty_str($field_value2)) {
    delete_post_meta($post_id, $field_name2);
  }

  // Do the saving and deleting.
  if (!empty_str($field_value3)) {
    update_post_meta($post_id, $field_name3, $field_value3);
  } elseif (empty_str($field_value3)) {
    delete_post_meta($post_id, $field_name3);
  }
});

?>