<?php

// Add sections, settings, and controls to the theme customizer.

function beshpress_register_customizer($wp_customize) {

	/* ========== SHOW CASE ========== */

	// Show Case Section
	$wp_customize->add_section('showCase', array(
		'title'       => __('Show Case', 'beshpress'),
		'description' => __('Options for the showcase area', 'beshpress'),
		'priority'    => 25
	));

	// Show Case Image Setting
	$wp_customize->add_setting('showcase_image', array(
		'default' => get_bloginfo('template_directory') . '/img/showcase.jpg',
		'type'    => 'theme_mod'
	));

	// Show Case Image Control
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'showcase_image', array(
		'label'    => __('Background Image', 'beshpress'),
		'section'  => 'showCase',
		'settings' => 'showcase_image'
	)));

	// Show Case Heading Setting
	$wp_customize->add_setting( 'showcase_heading', array(
		'default' => _x('Heading Text', 'beshpress'),
		'type'    => 'theme_mod'
	));

	// Show Case Heading Control
	$wp_customize->add_control( 'showcase_heading', array(
		'label'   => __('Heading', 'beshpress'),
		'section' => 'showCase'
	));

	// Show Case Heading 2 Setting
	$wp_customize->add_setting( 'showcase_heading2', array(
		'default' => _x('Heading 2 Text', 'beshpress'),
		'type'    => 'theme_mod'
	));

	// Show Case Heading 2 Control
	$wp_customize->add_control( 'showcase_heading2', array(
		'label'   => __('Heading 2', 'beshpress'),
		'section' => 'showCase'
	));

	// Show Case Body Text Setting
	$wp_customize->add_setting( 'showcase_body_text', array(
		'default' => _x('Body Text', 'beshpress'),
		'type'    => 'theme_mod'
	));

	// Show Case Body Text Control
	$wp_customize->add_control( 'showcase_body_text', array(
		'label'   => __('Body Text', 'beshpress'),
		'section' => 'showCase'
	));

	/* ========== HOME BANNER ========== */

	// Home Banner Section
	$wp_customize->add_section('homeBanner', array(
		'title'       => __('Home Banner', 'beshpress'),
		'description' => __('Home banner options', 'beshpress'),
		'priority'    => 30
	));
	 
	// Home Banner Image Setting
	$wp_customize->add_setting('home_banner_image', array(
		'default' => get_bloginfo('template_directory') . '/img/default-banner.jpg',
		'type'    => 'theme_mod'
	));

	// Home Banner Image Control
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'home_banner_image', array(
		'label'    => __('Home Banner Image', 'beshpress'),
		'section'  => 'homeBanner',
		'settings' => 'home_banner_image'
	)));

	// Home Banner Heading Setting
	$wp_customize->add_setting('home_banner_heading', array(
		'default' => _x('Heading', 'beshpress'),
		'type'    => 'theme_mod'
	));

	// Home Banner Heading Control
	$wp_customize->add_control('home_banner_heading', array(
		'label'   => __('Home Banner Heading', 'beshpress'),
		'section' => 'homeBanner'
	));

	// Home Banner Body Text Setting
	$wp_customize->add_setting('home_banner_body_text', array(
		'default' => _x('Home Banner Body Text', 'beshpress'),
		'type'    => 'theme_mod'
	));

	// Home Banner Body Text Control
	$wp_customize->add_control( 'home_banner_body_text', array(
		'label'   => __('Home Banner Body Text', 'beshpress'),
		'section' => 'homeBanner'
	));

	// Setting for including/removing the home banner
	$wp_customize->add_setting('add_home_banner', array(
		'default' => '1' // 1 sets the checkbox to checked by default
	));

	$wp_customize->add_control(
		new WP_Customize_Control(
	    $wp_customize,
	    'add_home_banner',
	    array(
	        'label'    => __('Add Home Banner', 'beshpress'),
	        'section'  => 'homeBanner',
	        'settings' => 'add_home_banner',
	        'type'     => 'checkbox'
	    )
		)
	);

		/* ========== BLOG PAGE BANNER ========== */

	// Blog Banner Section
	$wp_customize->add_section('blogBanner', array(
		'title'       => __('Blog Banner', 'beshpress'),
		'description' => __('Blog banner options', 'beshpress'),
		'priority'    => 30
	));
	 
	// Blog Banner Image Setting
	$wp_customize->add_setting('blog_banner_image', array(
		'default' => get_bloginfo('template_directory') . '/img/default-banner.jpg',
		'type'    => 'theme_mod'
	));

	// Blog Banner Image Control
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'blog_banner_image', array(
		'label'    => __('Blog Banner Image', 'beshpress'),
		'section'  => 'blogBanner',
		'settings' => 'blog_banner_image'
	)));

	// Blog Banner Heading Setting
	$wp_customize->add_setting('blog_banner_heading', array(
		'default' => _x('Blog', 'beshpress'),
		'type'    => 'theme_mod'
	));

	// Blog Banner Heading Control
	$wp_customize->add_control('blog_banner_heading', array(
		'label'   => __('Blog Banner Heading', 'beshpress'),
		'section' => 'blogBanner'
	));

	// Setting for including/removing the blog banner
	$wp_customize->add_setting('add_blog_banner', array(
		'default' => '1' // 1 sets the checkbox to checked by default
	));

	$wp_customize->add_control(
		new WP_Customize_Control(
	    $wp_customize,
	    'add_blog_banner',
	    array(
	        'label'    => __('Add Blog Banner', 'beshpress'),
	        'section'  => 'blogBanner',
	        'settings' => 'add_blog_banner',
	        'type'     => 'checkbox'
	    )
		)
	);

	/* ========== SOCIAL ========== */

	// Social Section
	$wp_customize->add_section('social', array(
		'title'       => __('Social', 'beshpress'),
		'description' => __('Social media urls', 'beshpress'),
		'priority'    => 130
	));

	// Facebook URL Setting
	$wp_customize->add_setting('facebook_url', array(
		'default' => _x('http://www.facebook.com', 'beshpress'),
		'type'    => 'theme_mod'
	));

	// Facebook URL Control
	$wp_customize->add_control( 'facebook_url', array(
		'label'   => __('Facebook URL', 'beshpress'),
		'section' => 'social'
	));

	// Twitter URL Setting
	$wp_customize->add_setting('twitter_url', array(
		'default' => _x('http://www.twitter.com', 'beshpress'),
		'type'    => 'theme_mod'
	));

	// Twitter URL Control
	$wp_customize->add_control( 'twitter_url', array(
		'label'   => __('Twitter URL', 'beshpress'),
		'section' => 'social'
	));

	// Google Plus URL Setting
	$wp_customize->add_setting('google-plus_url', array(
		'default' => _x('http://aboutme.google.com', 'beshpress'),
		'type'    => 'theme_mod'
	));

	// Google Plus URL Control
	$wp_customize->add_control( 'google-plus_url', array(
		'label'   => __('Google Plus URL', 'beshpress'),
		'section' => 'social'
	));

	// Linkedin URL Setting
	$wp_customize->add_setting('linkedin_url', array(
		'default' => _x('http://www.linkedin.com', 'beshpress'),
		'type'    => 'theme_mod'
	));

	// Linkedin URL Control
	$wp_customize->add_control( 'linkedin_url', array(
		'label'    => __('LinkedIn URL', 'beshpress'),
		'section'  => 'social'
	));

	// YouTube URL Setting
	$wp_customize->add_setting('youtube_url', array(
		'default' => _x('http://youtube.com', 'beshpress'),
		'type'    => 'theme_mod'
	));

	// YouTube URL Control
	$wp_customize->add_control( 'youtube_url', array(
		'label'   => __('YouTube URL', 'beshpress'),
		'section' => 'social'
	));

	/* ========== MISCELLANEOUS ========== */

	// Misc Options Section (Add any miscellaneous features of the theme customizer here.)
	$wp_customize->add_section('misc', array(
		'title'       => __('Misc Options', 'beshpress'),
		'description' => __('Miscellaneous theme options', 'beshpress'),
		'priority'    => 205
	));
	 
	// Option for enabling/disabling the modal
	$wp_customize->add_setting('modal', array(
		'default' => '1' // 1 sets the checkbox to checked by default
	));

	$wp_customize->add_control(
		new WP_Customize_Control(
	    $wp_customize,
	    'modal',
	    array(
        'label'    => __('Enable Modal', 'beshpress'),
        'section'  => 'misc',
        'settings' => 'modal',
        'type'     => 'checkbox'
	    )
		)
	);

	// Option for enabling/disabling the animation
	$wp_customize->add_setting('animation', array(
		'default' => '1' // 1 sets the checkbox to checked by default
	));

	$wp_customize->add_control(
		new WP_Customize_Control(
	    $wp_customize,
	    'animation',
	    array(
        'label'    => __('Enable Animation', 'beshpress'),
        'section'  => 'misc',
        'settings' => 'animation',
        'type'     => 'checkbox'
	    )
		)
	);

	// Option for enabling/disabling Google Map
	$wp_customize->add_setting('google_map', array(
		'default' => '1' // 1 sets the checkbox to checked by default
	));

	$wp_customize->add_control(
		new WP_Customize_Control(
	    $wp_customize,
	    'google_map',
	    array(
        'label'    => __('Enable Google Map', 'beshpress'),
        'section'  => 'misc',
        'settings' => 'google_map',
        'type'     => 'checkbox'
	    )
		)
	);

}

add_action('customize_register','beshpress_register_customizer');