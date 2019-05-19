<?php
// The function for registering the meta box
function skill_meta_box(WP_Post $post) { // note the WP_Post object as its parameter
  // Add the form and basic text fields.
  add_meta_box('skill_meta', 'Add an Icon (Optional)', function() use ($post) { // $post used as namespace for the object
    $field_name  = 'skill_icon_field';
    $field_value = get_post_meta($post->ID, $field_name, true);
    // Add a nonce to the form.
    wp_nonce_field('skill_nonce', 'skill_nonce');
    ?>

    <!-- The HTML for the input field -->
    <p>
    <label for="<?php echo $field_name; ?>">Icon Class (<em>Note: The theme uses Google's Material Design icons.</em>)</label>    
    <br>
    <input id="<?php echo $field_name; ?>"
           name="<?php echo $field_name; ?>"
           type="text"
           value="<?php echo esc_attr($field_value); ?>"
           placeholder="Enter the icon name"
           size="30">
    </p>
    <?php
  });
}

function beshpress_skill_custom_post_type() {

	$labels = xcompile_post_type_labels('Skill', 'Skills');

	// Declare what the post type supports.
  $supports = ['title', 'editor', 'revisions']; // does not support 'thumbnail'

  register_post_type('skill',
    array(
      'public'               => true,
      'supports'             => $supports, // apply supports
      'hierarchical'         => false, // hierarchy is not needed since this is not a page
      'show_in_rest'         => true, // enable the REST API (I don't need endpoints)
      'labels'               => $labels, 
      'register_meta_box_cb' => 'skill_meta_box', // register the meta box
      'description'          => 'Your Professional Skills/Certifications',
      'menu_icon'            => 'dashicons-lightbulb', // set icon
      'has_archive'          => false,
      'exclude_from_search'  => true   
    )
  );

  // Change the placeholder text.
  add_filter('enter_title_here', function($title) {
    $screen = get_current_screen();

    if ('skill' == $screen->post_type) {
      $title = 'Enter your skill title here';
    }
    return $title;    
	});

	// Change the update messages.
  add_filter('post_updated_messages', function($messages) {
    global $post, $post_ID;
    $link = esc_url( get_permalink($post_ID) );

    $messages['skill'] = array(
      0 => '',
      1 => sprintf( __('Skill updated. <a href="%s">View skill</a>'), $link ), // sprintf will replace %s with the second param value ($link in this case)
      2 => __('Custom field updated.'),
      3 => __('Custom field deleted.'),
      4 => __('Skill updated.'),
      5 => isset($_GET['revision']) ? sprintf( __('Skill restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
      6 => sprintf( __('Skill published. <a href="%s">View skill</a>'), $link ),
      7 => __('Skill saved.'),
      8 => sprintf( __('Skill submitted. <a target="_blank" href="%s">Preview skill</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID)))),
      9 => sprintf( __('Skill scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview skill</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), $link ),
      10 => sprintf( __('Skill draft updated. <a target="_blank" href="%s">Preview skill</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID))))
    );
    return $messages;
  });

  // Change the bulk messages
  add_filter('bulk_post_updated_messages', function($bulk_messages, $bulk_counts) {
    $bulk_messages['skill'] = array(
      'updated'   => _n( "%s skill updated.", "%s skills updated.", $bulk_counts["updated"] ),
      'locked'    => _n( "%s skill not updated, somebody is editing it.", "%s skills not updated, somebody is editing them.", $bulk_counts["locked"] ),
      'deleted'   => _n( "%s skill permanently deleted.", "%s skills permanently deleted.", $bulk_counts["deleted"] ),
      'trashed'   => _n( "%s skill moved to the Trash.", "%s skills moved to the Trash.", $bulk_counts["trashed"] ),
      'untrashed' => _n( "%s skill restored from the Trash.", "%s skills restored from the Trash.", $bulk_counts["untrashed"] )
    );
    return $bulk_messages;
  }, 10, 2 );

}
add_action('init', 'beshpress_skill_custom_post_type');

// Add a help section.
add_action('admin_head', function() {
  $screen = get_current_screen();

  if ('skill' != $screen->post_type) return;

  $args = [
    'id'      => 'skill_help',
    'title'   => 'Skill Help',
    'content' => '<h3>How to Add a Skill</h3>
                  <ul>
                  <li>Enter the type of skill in the title field.</li>
                  <li>Enter the description of the skill in the content field.</li>
                  <li>Use the optional field to enter an icon for the skill.</li>
                  <em>Note: The theme uses Google\'s Material Design icons.</em>
                  </ul>'
  ];

  $screen->add_help_tab( $args );
});

// Save and delete meta but not when restoring a revision.
add_action('save_post', function($post_id){
  $post        = get_post($post_id);
  $is_revision = wp_is_post_revision($post_id);
  $field_name  = 'skill_icon_field';

  // Do not save meta for a revision or on autosave.
  if ($post->post_type != 'skill' || $is_revision)
  return;

  // Do not save meta if fields are not present,
  // like during a restore.
  if (!isset($_POST[$field_name]))
  return;

  // Secure with a nonce field check.
  if (!check_admin_referer('skill_nonce', 'skill_nonce'))
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