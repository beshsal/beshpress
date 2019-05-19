<?php

// Add the default meta box to the post editor.
function default_add_meta_box() {
    $screens = ['post']; // specifying post as the post type; add multiple post types here if desired (comma separated)
    foreach ($screens as $screen) {
        add_meta_box(
          'default_box_id', // unique ID
          'Optional Fields', // box title
          'default_box_html', // content callback, must be of type callable
          $screen // post type
        );
    }
}
add_action('add_meta_boxes', 'default_add_meta_box');

// Function that structures the meta box's HTML and defines the field's key and value (see above).
function default_box_html($post) {
  $value = get_post_meta($post->ID, '_default_box_meta_key', true); // default_box_field
?>
  <p>
  <label for="default_box_field">Lead (You may also add a lead with the shortcode [leadtext]<em>your text</em>[/leadtext].)</label>
  <br>
  <textarea name="default_box_field" class="" id="default_box_field" cols="100" rows="5"><?php echo esc_textarea($value); ?></textarea>
  </p>
<?php
}

// Save the field value.
function default_box_save_postdata($post_id) {
  if (array_key_exists('default_box_field', $_POST)) { // if $_POST contains the name of the field
      update_post_meta(
        $post_id,
        '_default_box_meta_key', // note the default_box_field value is saved here
        $_POST['default_box_field']
      );
  }
}
add_action('save_post', 'default_box_save_postdata');

// Add an additional help field.
add_action('admin_head', function() {
$screen = get_current_screen();

if ('post' != $screen->post_type) return;

// Add a help section.
$args = [
    'id'      => 'post_styling_help',
    'title'   => 'Post Content Styling',
    'content' => '<h3>Styling Your Post Content</h3>
                  <ul>
                  <li>To include a lead, use the Lead field under Optional Fields or use the lead shortcode [leadtext]<em>your text</em>[/leadtext].</li>
                  <li>To include a quote, use the shortcode [blockquote]<em>your text</em>[/blockquote].</li>
                  <li>To include a citation for the quote, use the shortcode [citation]<em>your text</em>[/citation].</li>
                  <li>To add a footer to the quote, use the shortcode [quotefooter]<em>your text</em>[/quotefooter].</li>
                  </ul>
                  <p>Structure your quote the following way: <br>
                  [blockquote]Lorem ipsum dolor sit amet consectetur adipiscing elit auctor posuere tristique aptent, hac hendrerit morbi rutrum 
                  natoque erat condimentum aliquet vivamus penatibus.  
                  [quotefooter] Someone famous in [citation]A Certain Book[/citation] [/quotefooter] [/blockquote] 
                  </p>'
];

$screen->add_help_tab($args);
});

?>
