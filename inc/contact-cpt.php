<?php
// The function for registering the meta box
function contact_meta_box(WP_Post $post) {
  add_meta_box('contact_meta', 'Contact Information', function() use ($post) {
    $field_name   = 'street_field';
    $field_name2  = 'street2_field';
    $field_name3  = 'city_field';
    $field_name4  = 'state_field';
    $field_name5  = 'zip_field';
    $field_name6  = 'phone_field';
    $field_name7  = 'email_field';
    $field_name8  = "start_time_field";
    $field_name9  = "end_time_field";
    $field_name10 = "start_day_field";
    $field_name11 = "end_day_field";

    // Retrieve the values from the form fields.
    $field_value   = get_post_meta($post->ID, $field_name, true); 
    $field_value2  = get_post_meta($post->ID, $field_name2, true);
    $field_value3  = get_post_meta($post->ID, $field_name3, true);
    $field_value4  = get_post_meta($post->ID, $field_name4, true);
    $field_value5  = get_post_meta($post->ID, $field_name5, true);
    $field_value6  = get_post_meta($post->ID, $field_name6, true);
    $field_value7  = get_post_meta($post->ID, $field_name7, true);
    $field_value8  = get_post_meta($post->ID, $field_name8, true);
    $field_value9  = get_post_meta($post->ID, $field_name9, true);
    $field_value10 = get_post_meta($post->ID, $field_name10, true);
    $field_value11 = get_post_meta($post->ID, $field_name11, true);
    // Add a nonce to the form.
    wp_nonce_field('contact_nonce', 'contact_nonce');
    ?>
      <p>
      <label for="<?php echo $field_name; ?>">Street Address</label>
      <br>
      <input type="text" 
             id="<?php echo $field_name; ?>" 
             name="<?php echo $field_name; ?>"
             value="<?php echo esc_attr($field_value); ?>"
             size="30">
      </p>
      <p>
      <label for="<?php echo $field_name2; ?>">Street Address 2</label>
      <br>
      <input type="text" 
             id="<?php echo $field_name2; ?>" 
             name="<?php echo $field_name2; ?>"
             value="<?php echo esc_attr($field_value2); ?>"
             size="30">
      </p>      
      <p>
      <label for="<?php echo $field_name3; ?>">City</label>
      <br>
      <input id="<?php echo $field_name3; ?>"
             name="<?php echo $field_name3; ?>"
             type="text"
             value="<?php echo esc_attr($field_value3); ?>"
             size="30">
      </p>

      <?php
      $states =array(
        'AL'=>"Alabama",
        'AK'=>"Alaska",
        'AZ'=>"Arizona",
        'AR'=>"Arkansas",
        'CA'=>"California",
        'CO'=>"Colorado",
        'CT'=>"Connecticut",
        'DE'=>"Delaware",
        'DC'=>"District Of Columbia",
        'FL'=>"Florida",
        'GA'=>"Georgia",
        'HI'=>"Hawaii",
        'ID'=>"Idaho",
        'IL'=>"Illinois",
        'IN'=>"Indiana",
        'IA'=>"Iowa",
        'KS'=>"Kansas",
        'KY'=>"Kentucky",
        'LA'=>"Louisiana",
        'ME'=>"Maine",
        'MD'=>"Maryland",
        'MA'=>"Massachusetts",
        'MI'=>"Michigan",
        'MN'=>"Minnesota",
        'MS'=>"Mississippi",
        'MO'=>"Missouri",
        'MT'=>"Montana",
        'NE'=>"Nebraska",
        'NV'=>"Nevada",
        'NH'=>"New Hampshire",
        'NJ'=>"New Jersey",
        'NM'=>"New Mexico",
        'NY'=>"New York",
        'NC'=>"North Carolina",
        'ND'=>"North Dakota",
        'OH'=>"Ohio",
        'OK'=>"Oklahoma",
        'OR'=>"Oregon",
        'PA'=>"Pennsylvania",
        'RI'=>"Rhode Island",
        'SC'=>"South Carolina",
        'SD'=>"South Dakota",
        'TN'=>"Tennessee",
        'TX'=>"Texas",
        'UT'=>"Utah",
        'VT'=>"Vermont",
        'VA'=>"Virginia",
        'WA'=>"Washington",
        'WV'=>"West Virginia",
        'WI'=>"Wisconsin",
        'WY'=>"Wyoming"
      );

      $days = array(
        'Mon' => 'Monday', 
        'Tue' => 'Tuesday', 
        'Wed' => 'Wednesday', 
        'Thu' => 'Thursday', 
        'Fri' => 'Friday', 
        'Sat' => 'Saturday', 
        'Sun' => 'Sunday'
      );
    ?>

    <label for="<?php echo $field_name4; ?>">State</label>
    <br>
    <select name="<?php echo $field_name4; ?>" id="<?php echo $field_name4; ?>" class="">
      <option value="">Select a state</option>
      <?php foreach ($states as $state) { ?>
        <option value="<?php echo esc_attr($state); ?>" <?php selected(esc_attr($field_value4), $state); ?>><?php echo $state; ?></option>   
      <?php } ?>
    </select>

    <p>
    <label for="<?php echo $field_name5; ?>">Zip</label> <!-- change the type to "number" to allow only numbers to be entered -->
    <br>
    <input id="<?php echo $field_name5; ?>"
           name="<?php echo $field_name5; ?>"
           maxlength="5"
           type="text"
           pattern="[0-9]*"
           title="Five digit zip code"
           value="<?php echo esc_attr($field_value5); ?>"
           size="30">
    </p>
    <p>
    <label for="<?php echo $field_name6; ?>">Phone</label>
    <br>
    <input type="tel" 
           id="<?php echo $field_name6; ?>" 
           name="<?php echo $field_name6; ?>"
           pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
           value="<?php echo esc_attr($field_value6); ?>"
           placeholder="Format: 555-555-555"
           size="30">
    </p>
    <p>
    <label for="<?php echo $field_name7; ?>">Email</label>
    <br>
    <input id="<?php echo $field_name7; ?>"
           name="<?php echo $field_name7; ?>"
           type="email"
           value="<?php echo esc_attr($field_value7); ?>"
           size="30">
    </p>
    <p>
    <label for="hours">Hours</label>
    <br>
    <input type="time" id="<?php echo $field_name8; ?>" name="<?php echo $field_name8; ?>"
           value="<?php echo esc_attr($field_value8); ?>"> <!-- min="9:00" max="18:00" -->
    <input type="time" id="<?php echo $field_name9; ?>" name="<?php echo $field_name9; ?>"
           value="<?php echo esc_attr($field_value9); ?>"> <!-- min="9:00" max="18:00" -->
    </p>

    <label for="<?php echo $field_name10; ?>">Days Opened</label>
    <br>
    <select name="<?php echo $field_name10; ?>" id="<?php echo $field_name10; ?>" class="">
      <option value="">Select first day</option>
      <?php foreach ($days as $day1) { ?>
        <option value="<?php echo esc_attr($day1); ?>" <?php selected(esc_attr($field_value10), $day1); ?>><?php echo $day1; ?></option>   
      <?php } ?>
    </select>
    <select name="<?php echo $field_name11; ?>" id="<?php echo $field_name11; ?>" class="">
      <option value="">Select last day</option>
      <?php foreach ($days as $day2) { ?>
        <option value="<?php echo esc_attr($day2); ?>" <?php selected(esc_attr($field_value11), $day2); ?>><?php echo $day2; ?></option>   
      <?php } ?>
    </select>

    <?php
  });
}

function beshpress_contact_custom_post_type() {

  $labels = xcompile_post_type_labels('Contact', 'Contact');

  // Declare what the post type supports.
  $supports = ['title', 'editor', 'revisions']; // // does not include 'thumbnail'

  register_post_type('contact',
    array(
      'public'               => true,
      'supports'             => $supports,
      'hierarchical'         => false,
      'rewrite'              => ['slug' => 'contact'],
      // 'rest_base'            => 'contact',   
      // 'show_in_rest'         => true,
      'labels'               => $labels,
      'register_meta_box_cb' => 'contact_meta_box',
      'description'          => 'Contact information',
      'menu_icon'            => 'dashicons-email-alt', // 'dashicons-location-alt' 
      'has_archive'          => true,
      'exclude_from_search'  => true   
    )
  );

  // Change the placeholder text.
  add_filter('enter_title_here', function($title) {
    $screen = get_current_screen();

    if ('contact' == $screen->post_type) {
      $title = 'Enter the title for the contact form section here';
    }
    return $title;
  });

  // Change the update messages.
  add_filter('post_updated_messages', function($messages) {
    global $post, $post_ID;
    $link = esc_url( get_permalink($post_ID) );

    $messages['contact'] = array(
      0 => '',
      1 => sprintf( __('Contact updated. <a href="%s">View contact</a>'), $link ), // sprintf will replace %s with the second param value ($link in this case)
      2 => __('Custom field updated.'),
      3 => __('Custom field deleted.'),
      4 => __('Contact updated.'),
      5 => isset($_GET['revision']) ? sprintf( __('Contact restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
      6 => sprintf( __('Contact published. <a href="%s">View contact</a>'), $link ),
      7 => __('Contact saved.'),
      8 => sprintf( __('Contact submitted. <a target="_blank" href="%s">Preview contact</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
      9 => sprintf( __('Contact scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview contact</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), $link ),
      10 => sprintf( __('Contact draft updated. <a target="_blank" href="%s">Preview contact</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID))))
    );
    return $messages;
  });

  // Change the bulk messages.
  add_filter('bulk_post_updated_messages', function($bulk_messages, $bulk_counts) {
    $bulk_messages['contact'] = array(
      'updated'   => _n( "%s contact updated.", "%s contacts updated.", $bulk_counts["updated"] ),
      'locked'    => _n( "%s contact not updated, somebody is editing it.", "%s contacts not updated, somebody is editing them.", $bulk_counts["locked"] ),
      'deleted'   => _n( "%s contact permanently deleted.", "%s contacts permanently deleted.", $bulk_counts["deleted"] ),
      'trashed'   => _n( "%s contact moved to the Trash.", "%s contacts moved to the Trash.", $bulk_counts["trashed"] ),
      'untrashed' => _n( "%s contact restored from the Trash.", "%s contacts restored from the Trash.", $bulk_counts["untrashed"] )
    );

    return $bulk_messages;
  }, 10, 2);

}
add_action('init', 'beshpress_contact_custom_post_type');

// Add a help section.
add_action('admin_head', function() {
  $screen = get_current_screen();

  if ('contact' != $screen->post_type) return;

  $args = [
    'id'      => 'contact_help',
    'title'   => 'Contact Help',
    'content' => '<h3>Instructions for Adding Contact Information</h3>
                  <ul>
                  <li>Enter a title for the contact form in the title field, e.g. "Send Us a Message".</li>
                  <li>Use the additional fields to add an address and contact information.</li>
                  <li>If Google Map is enabled in the theme customizer, enter HTML code for embedding a map in the content field.</li>
                  </ul>'
  ];

  $screen->add_help_tab($args);
});

// Save and delete meta but not when restoring a revision.
add_action('save_post', function($post_id) {
  $post = get_post($post_id);
  $is_revision  = wp_is_post_revision($post_id);
  $field_name   = 'street_field';
  $field_name2  = 'street2_field';
  $field_name3  = 'city_field';
  $field_name4  = 'state_field';
  $field_name5  = 'zip_field';
  $field_name6  = 'phone_field';
  $field_name7  = 'email_field';
  $field_name8  = "start_time_field";
  $field_name9  = "end_time_field";
  $field_name10 = "start_day_field";
  $field_name11 = "end_day_field";

  // Do not save meta for a revision or on autosave.
  if ($post->post_type != 'contact' || $is_revision)
  return;

  // Do not save meta if fields are not present,
  // like during a restore.
  if (!isset($_POST[$field_name]) || !isset($_POST[$field_name2]) || !isset($_POST[$field_name3]) || !isset($_POST[$field_name4]) 
    || !isset($_POST[$field_name5]) || !isset($_POST[$field_name6]) || !isset($_POST[$field_name7]) || !isset($_POST[$field_name8]) 
    || !isset($_POST[$field_name9]) || !isset($_POST[$field_name10]) || !isset($_POST[$field_name11]))
  return;

  // Secure with a nonce field check.
  if (!check_admin_referer('contact_nonce', 'contact_nonce'))
  return;

  // Clean up data.
  $field_value   = trim($_POST[$field_name]);
  $field_value2  = trim($_POST[$field_name2]);
  $field_value3  = trim($_POST[$field_name3]);
  $field_value4  = trim($_POST[$field_name4]);
  $field_value5  = trim($_POST[$field_name5]);
  $field_value6  = trim($_POST[$field_name6]);
  $field_value7  = sanitize_email(trim($_POST[$field_name7]));
  $field_value8  = trim($_POST[$field_name8]);
  $field_value9  = trim($_POST[$field_name9]);
  $field_value10 = trim($_POST[$field_name10]);
  $field_value11 = trim($_POST[$field_name11]);

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

  // Do the saving and deleting.
  if (!empty_str($field_value4)) {
    update_post_meta($post_id, $field_name4, $field_value4);
  } elseif (empty_str($field_value4)) {
    delete_post_meta($post_id, $field_name4);
  }

  // Do the saving and deleting.
  if (!empty_str($field_value5)) {
    update_post_meta($post_id, $field_name5, $field_value5);
  } elseif (empty_str($field_value5)) {
    delete_post_meta($post_id, $field_name5);
  }

  // Do the saving and deleting.
  if (!empty_str($field_value6)) {
    update_post_meta($post_id, $field_name6, $field_value6);
  } elseif (empty_str($field_value6)) {
    delete_post_meta($post_id, $field_name6);
  }

  // Do the saving and deleting.
  if (!empty_str($field_value7)) {
    update_post_meta($post_id, $field_name7, $field_value7);
  } elseif (empty_str($field_value7)) {
    delete_post_meta($post_id, $field_name7);
  }

  // Do the saving and deleting.
  if (!empty_str($field_value8)) {
    update_post_meta($post_id, $field_name8, $field_value8);
  } elseif (empty_str($field_value8)) {
    delete_post_meta($post_id, $field_name8);
  }

  // Do the saving and deleting.
  if (!empty_str($field_value9)) {
    update_post_meta($post_id, $field_name9, $field_value9);
  } elseif (empty_str($field_value9)) {
    delete_post_meta($post_id, $field_name9);
  }

  // Do the saving and deleting.
  if (!empty_str($field_value10)) {
    update_post_meta($post_id, $field_name10, $field_value10);
  } elseif (empty_str($field_value10)) {
    delete_post_meta($post_id, $field_name10);
  }

  // Do the saving and deleting.
  if (!empty_str($field_value11)) {
    update_post_meta($post_id, $field_name11, $field_value11);
  } elseif (empty_str($field_value11)) {
    delete_post_meta($post_id, $field_name11);
  }
});

?>