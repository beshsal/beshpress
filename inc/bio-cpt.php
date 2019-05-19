<?php
// The function for registering the meta box
function bio_meta_box(WP_Post $post) { // note the WP_Post object as its parameter
  // Add the form and basic text fields.
  add_meta_box('bio_meta', 'Optional Fields', function() use ($post) {
    $field_name  = 'heading_input_field';
    $field_value = get_post_meta($post->ID, $field_name, true);
    // Add a nonce to the form.
    wp_nonce_field('bio_nonce', 'bio_nonce'); ?>

    <!-- The HTML for the input field -->
    <p>
    <label for="<?php echo $field_name; ?>">Use this field as a heading or to highlight something about yourself.</label>
    <br>
    <textarea name="<?php echo $field_name; ?>" class="form-control" id="<?php echo $field_name; ?>" cols="100" rows="5"><?php echo esc_textarea($field_value); ?></textarea>
    </p>
    <?php
  });
}

/* Bio Post Type */
function beshpress_bio_custom_post_type() {
  // Call the function for specifying the post type labels and save its returned values to $labels.
  $labels = xcompile_post_type_labels('Bio', 'Bios'); // get the labels

  // Declare what the post type supports. The featured image is enabled.
  $supports = ['title', 'editor', 'thumbnail', 'revisions'];

  register_post_type('bio',
    array(
      'public'               => true,
      'supports'             => $supports, // apply supports
      'hierarchical'         => false, // hierarchy is not needed since this is not a page
      'show_in_rest'         => true, // enable the REST API (I don't need endpoints)
      'labels'               => $labels,
      'register_meta_box_cb' => 'bio_meta_box', // register the meta box   
      'description'          => 'Author\'s bio',
      'menu_icon'            => 'dashicons-id', // set icon
      'has_archive'          => false,
      'exclude_from_search'  => true 
    )
  );

  // add_filter() is used to modify the data

  // Change the placeholder text.
  add_filter('enter_title_here', function($title) {
    $screen = get_current_screen();

    if  ('bio' == $screen->post_type) {
      $title = 'Enter your full name here';
    }
    return $title;
  });

  // Change the update messages.
  add_filter('post_updated_messages', function($messages) {
    global $post, $post_ID;
    $link = esc_url(get_permalink($post_ID));

    $messages['bio'] = array(
      0 => '',
      1 => sprintf( __('Bio updated. <a href="%s">View bio</a>'), $link ), // sprintf will replace %s with the second param value ($link in this case)
      2 => __('Custom field updated.'),
      3 => __('Custom field deleted.'),
      4 => __('Bio updated.'),
      5 => isset($_GET['revision']) ? sprintf( __('Bio restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
      6 => sprintf( __('Bio published. <a href="%s">View bio</a>'), $link ),
      7 => __('Bio saved.'),
      8 => sprintf( __('Bio submitted. <a target="_blank" href="%s">Preview bio</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID)))),
      9 => sprintf( __('Bio scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview bio</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), $link ),
      10 => sprintf( __('Bio draft updated. <a target="_blank" href="%s">Preview bio</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID)))),
    );
    return $messages;
  });

  // Change the bulk messages
  add_filter('bulk_post_updated_messages', function($bulk_messages, $bulk_counts) {
    $bulk_messages['bio'] = array(
      'updated'   => _n( "%s bio updated.", "%s bios updated.", $bulk_counts["updated"] ),
      'locked'    => _n( "%s bio not updated, somebody is editing it.", "%s bios not updated, somebody is editing them.", $bulk_counts["locked"] ),
      'deleted'   => _n( "%s bio permanently deleted.", "%s bios permanently deleted.", $bulk_counts["deleted"] ),
      'trashed'   => _n( "%s bio moved to the Trash.", "%s bios moved to the Trash.", $bulk_counts["trashed"] ),
      'untrashed' => _n( "%s bio restored from the Trash.", "%s bios restored from the Trash.", $bulk_counts["untrashed"] )
    );
    return $bulk_messages;
  }, 10, 2);
}
add_action('init', 'beshpress_bio_custom_post_type');

// Add a help section.
add_action('admin_head', function() {
  $screen = get_current_screen();

  if ('bio' != $screen->post_type) return;

  $args = [
    'id'      => 'bio_help',
    'title'   => 'Bio Help',
    'content' => '<h3>How to Add a Bio:</h3>
                  <ul>
                  <li>Enter your name in the title field.</li>
                  <li>Enter your description in the content field.</li>
                  <li>Select your image as the featured image.</li>
                  <li>Use the optional field as a heading or to highlight something about yourself.</li>
                  </ul>'
  ];

  $screen->add_help_tab( $args );
});

// Save and delete meta but not when restoring a revision.
add_action('save_post', function($post_id){
  $post        = get_post($post_id);
  $is_revision = wp_is_post_revision($post_id);
  $field_name  = 'heading_input_field';

  // Do not save meta for a revision or on autosave.
  if ($post->post_type != 'bio' || $is_revision)
  return;

  // Do not save meta if fields are not present,
  // like during a restore.
  if (!isset($_POST[$field_name]))
  return;

  // Secure with a nonce field check.
  if (!check_admin_referer('bio_nonce', 'bio_nonce'))
  return;

  // Clean up data.
  $field_value = trim($_POST[$field_name]);

  // Do the saving and deleting.
  if (!empty_str($field_value)) {
    update_post_meta($post_id, $field_name, $field_value);
  } elseif (empty_str($field_value)) {
    delete_post_meta($post_id, $field_name);
  }
});

?>