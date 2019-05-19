<?php
// The function for registering the meta box
function work_meta_box(WP_Post $post) { // note the WP_Post object as its parameter
  // Add the form and basic text fields.
  add_meta_box('work_meta', 'Optional Fields', function() use ($post) {
    $field_name  = 'date_field';
    $field_name2 = 'client_field';
    $field_name3 = 'client_website_field';
    $field_name4 = 'service_field';
    // These variables are used for saving data and persisting data to the fields.
    $field_value  = get_post_meta($post->ID, $field_name, true); 
    $field_value2 = get_post_meta($post->ID, $field_name2, true);
    $field_value3 = get_post_meta($post->ID, $field_name3, true);
    $field_value4 = get_post_meta($post->ID, $field_name4, true);
    // Add a nonce to the form.
    wp_nonce_field('work_nonce', 'work_nonce');
    ?>
      <p>
      <label for="<?php echo $field_name; ?>">Project Date</label>
      <br>
      <input type="date" 
             id="<?php echo $field_name; ?>" 
             name="<?php echo $field_name; ?>"
             value="<?php echo esc_attr($field_value); ?>"
             min="2013-01-01" 
             max="2019-12-31"
             size="30">
      </p>
      <p>
      <label for="<?php echo $field_name2; ?>">Client</label>
      <br>
      <input id="<?php echo $field_name2; ?>"
             name="<?php echo $field_name2; ?>"
             type="text"
             value="<?php echo esc_attr($field_value2); ?>"
             size="30">
      </p>
      <p>
      <label for="<?php echo $field_name3; ?>">Client Website</label>
      <br>
      <input id="<?php echo $field_name3; ?>"
             name="<?php echo $field_name3; ?>"
             type="url"
             value="<?php echo esc_attr($field_value3); ?>"
             placeholder="example.com"
             size="30">
      </p>
      <p>
      <label for="<?php echo $field_name4; ?>">Service</label>
      <br>
      <input id="<?php echo $field_name4; ?>"
             name="<?php echo $field_name4; ?>"
             type="text"
             value="<?php echo esc_attr($field_value4); ?>"
             size="30">
      </p>
    <?php
  });
}

function beshpress_work_custom_post_type() {

  $labels = xcompile_post_type_labels('Work', 'Works');

  // Declare what the post type supports. The featured image is enabled.
  $supports = ['title', 'editor', 'thumbnail', 'revisions'];

  register_post_type('work',
    array(
      'public'               => true,
      'supports'             => $supports,
      'hierarchical'         => false,
      'rewrite'              => ['slug' => 'works'],
      'taxonomies'           => ['category'],
      'rest_base'            => 'works',   
      'show_in_rest'         => true,
      'labels'               => $labels,
      'register_meta_box_cb' => 'work_meta_box',
      'description'          => 'Description of portfolio projects',
      'menu_icon'            => 'dashicons-portfolio',
      'has_archive'          => true     
    )
  );

  // Change the placeholder text.
  add_filter('enter_title_here', function($title) {
    $screen = get_current_screen();

    if ('work' == $screen->post_type) {
      $title = 'Enter the title for the work here';
    }
    return $title;
  });

  // Change the update messages.
  add_filter('post_updated_messages', function($messages) {
    global $post, $post_ID;
    $link = esc_url(get_permalink($post_ID));

    $messages['work'] = array(
      0 => '',
      1 => sprintf( __('Work updated. <a href="%s">View work</a>'), $link ), // sprintf will replace %s with the second param value ($link in this case)
      2 => __('Custom field updated.'),
      3 => __('Custom field deleted.'),
      4 => __('Work updated.'),
      5 => isset($_GET['revision']) ? sprintf( __('Work restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
      6 => sprintf( __('Work published. <a href="%s">View work</a>'), $link ),
      7 => __('Work saved.'),
      8 => sprintf( __('Work submitted. <a target="_blank" href="%s">Preview work</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID)))),
      9 => sprintf( __('Work scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview work</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), $link ),
      10 => sprintf( __('Work draft updated. <a target="_blank" href="%s">Preview work</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID))))
    );
    return $messages;
  });

  // Change the bulk messages
  add_filter( 'bulk_post_updated_messages', function( $bulk_messages, $bulk_counts ) {
    $bulk_messages['work'] = array(
      'updated'   => _n( "%s work updated.", "%s works updated.", $bulk_counts["updated"] ),
      'locked'    => _n( "%s work not updated, somebody is editing it.", "%s works not updated, somebody is editing them.", $bulk_counts["locked"] ),
      'deleted'   => _n( "%s work permanently deleted.", "%s works permanently deleted.", $bulk_counts["deleted"] ),
      'trashed'   => _n( "%s work moved to the Trash.", "%s works moved to the Trash.", $bulk_counts["trashed"] ),
      'untrashed' => _n( "%s work restored from the Trash.", "%s works restored from the Trash.", $bulk_counts["untrashed"] )
    );
    return $bulk_messages;
  }, 10, 2);

}
add_action('init', 'beshpress_work_custom_post_type');

// Add a help section.
add_action('admin_head', function() {
  $screen = get_current_screen();

  if ('work' != $screen->post_type) return;

  $args = [
    'id'      => 'work_help',
    'title'   => 'Work Help',
    'content' => '<h3>How to Add a Work</h3>
                  <ul>
                  <li>Enter the title of the work in the title field.</li>
                  <li>Enter a description for the work in the content field.</li>
                  <li>Select the image for the work as the featured image.</li>
                  <li>Use the optional field to enter the project date.</li>
                  <li>Use the optional field to enter the client\'s name.</li>
                  <li>Use the optional field to enter the client\'s website.</li>
                  <li>Use the optional field to enter the type of service, e.g. web design, photography, etc.</li>
                  </ul>'
  ];

  $screen->add_help_tab($args);
});

// Save and delete meta but not when restoring a revision.
add_action('save_post', function($post_id) {
  $post        = get_post($post_id);
  $is_revision = wp_is_post_revision($post_id);
  $field_name  = 'date_field';
  $field_name2 = 'client_field';
  $field_name3 = 'client_website_field';
  $field_name4 = 'service_field';

  // Do not save meta for a revision or on autosave.
  if ($post->post_type != 'work' || $is_revision)
  return;

  // Do not save meta if fields are not present,
  // like during a restore.
  if (!isset($_POST[$field_name]) || !isset($_POST[$field_name2]) || !isset($_POST[$field_name3]) || !isset($_POST[$field_name4]))
  return;

  // Secure with a nonce field check.
  if (!check_admin_referer('work_nonce', 'work_nonce'))
  return;

  // Clean up data.
  $field_value  = trim($_POST[$field_name]);
  $field_value2 = trim($_POST[$field_name2]);
  $field_value3 = trim($_POST[$field_name3]);
  $field_value4 = trim($_POST[$field_name4]);

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
  if(!empty_str($field_value3)) {
    update_post_meta($post_id, $field_name3, $field_value3);
  } elseif ( empty_str($field_value3 ) ) {
    delete_post_meta($post_id, $field_name3);
  }

  // Do the saving and deleting.
  if (!empty_str($field_value4)) {
    update_post_meta($post_id, $field_name4, $field_value4);
  } elseif (empty_str($field_value4)) {
    delete_post_meta($post_id, $field_name4);
  }
});

add_action('pre_get_posts', function(WP_Query $query) {
  if ($query->is_main_query() && $query->is_post_type_archive('work')) {
    $query->set('posts_per_page', -1);
  }
});

?>