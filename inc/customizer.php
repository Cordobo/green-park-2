<?php
/**
 * Green Park 2 Theme Customizer
 *
 * @package Green_Park_2
 */

function greenpark_customize_register( $wp_customize ) {
	// Add postMessage support for site title and description for the Theme Customizer.
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// -------------------------------------------------------------------------
	// Logo Section
	// -------------------------------------------------------------------------
	$wp_customize->add_section( 'greenpark_logo_section', array(
		'title'       => __( 'Logo', 'greenpark' ),
		'priority'    => 30,
		'description' => __( 'Upload a logo to replace the default site title and description.', 'greenpark' ),
	) );

	$wp_customize->add_setting( 'greenpark_logo', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'greenpark_logo', array(
		'label'    => __( 'Upload Logo', 'greenpark' ),
		'section'  => 'greenpark_logo_section',
		'settings' => 'greenpark_logo',
	) ) );

    $wp_customize->add_setting( 'greenpark_logo_show', array(
        'default'           => false,
        'sanitize_callback' => 'greenpark_sanitize_checkbox',
    ) );

    $wp_customize->add_control( 'greenpark_logo_show', array(
        'label'    => __( 'Show Logo Image', 'greenpark' ),
        'section'  => 'greenpark_logo_section',
        'type'     => 'checkbox',
    ) );


	// -------------------------------------------------------------------------
	// Accessibility Section
	// -------------------------------------------------------------------------
	$wp_customize->add_section( 'greenpark_accessibility_section', array(
		'title'       => __( 'Accessibility Links', 'greenpark' ),
		'priority'    => 35,
		'description' => __( 'Configure the accessibility navigation strip at the top of the page.', 'greenpark' ),
	) );

	$wp_customize->add_setting( 'greenpark_accessibility_disable', array(
		'default'           => false,
		'sanitize_callback' => 'greenpark_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'greenpark_accessibility_disable', array(
		'label'       => __( 'Disable All Accessibility Links', 'greenpark' ),
		'description' => __( 'Hide the entire accessibility navigation strip.', 'greenpark' ),
		'section'     => 'greenpark_accessibility_section',
		'type'        => 'checkbox',
	) );

	$wp_customize->add_setting( 'greenpark_accessibility_home', array(
		'default'           => false,
		'sanitize_callback' => 'greenpark_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'greenpark_accessibility_home', array(
		'label'    => __( 'Hide Home Link', 'greenpark' ),
		'section'  => 'greenpark_accessibility_section',
		'type'     => 'checkbox',
	) );

	$wp_customize->add_setting( 'greenpark_accessibility_content', array(
		'default'           => false,
		'sanitize_callback' => 'greenpark_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'greenpark_accessibility_content', array(
		'label'    => __( 'Hide Content Link', 'greenpark' ),
		'section'  => 'greenpark_accessibility_section',
		'type'     => 'checkbox',
	) );

	$wp_customize->add_setting( 'greenpark_accessibility_feed', array(
		'default'           => false,
		'sanitize_callback' => 'greenpark_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'greenpark_accessibility_feed', array(
		'label'    => __( 'Hide RSS Link', 'greenpark' ),
		'section'  => 'greenpark_accessibility_section',
		'type'     => 'checkbox',
	) );

	$wp_customize->add_setting( 'greenpark_accessibility_edit', array(
		'default'           => false,
		'sanitize_callback' => 'greenpark_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'greenpark_accessibility_edit', array(
		'label'       => __( 'Hide Edit Link', 'greenpark' ),
		'description' => __( 'The Edit link only appears for logged-in users with edit permissions.', 'greenpark' ),
		'section'     => 'greenpark_accessibility_section',
		'type'        => 'checkbox',
	) );

	$wp_customize->add_setting( 'greenpark_accessibility_loginout', array(
		'default'           => false,
		'sanitize_callback' => 'greenpark_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'greenpark_accessibility_loginout', array(
		'label'    => __( 'Hide Login/Logout Link', 'greenpark' ),
		'section'  => 'greenpark_accessibility_section',
		'type'     => 'checkbox',
	) );


	// -------------------------------------------------------------------------
	// Layout Section
	// -------------------------------------------------------------------------
	$wp_customize->add_section( 'greenpark_layout_section', array(
		'title'    => __( 'Layout Settings', 'greenpark' ),
		'priority' => 40,
	) );

	$wp_customize->add_setting( 'greenpark_sidebar_position', array(
		'default'           => 'right',
		'sanitize_callback' => 'greenpark_sanitize_sidebar_position',
	) );

	$wp_customize->add_control( 'greenpark_sidebar_position', array(
		'label'    => __( 'Sidebar Position', 'greenpark' ),
		'section'  => 'greenpark_layout_section',
		'type'     => 'radio',
		'choices'  => array(
			'left'  => __( 'Left', 'greenpark' ),
			'right' => __( 'Right', 'greenpark' ),
		),
	) );

    $wp_customize->add_setting( 'greenpark_sidebar_disable', array(
        'default'           => false,
        'sanitize_callback' => 'greenpark_sanitize_checkbox',
    ) );

    $wp_customize->add_control( 'greenpark_sidebar_disable', array(
        'label'    => __( 'Disable Sidebar Globally', 'greenpark' ),
        'section'  => 'greenpark_layout_section',
        'type'     => 'checkbox',
    ) );


	// -------------------------------------------------------------------------
	// Social Links Section
	// -------------------------------------------------------------------------
	$wp_customize->add_section( 'greenpark_social_section', array(
		'title'    => __( 'Social Links', 'greenpark' ),
		'priority' => 50,
	) );

	// Twitter
	$wp_customize->add_setting( 'greenpark_twitter_username', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'greenpark_twitter_username', array(
		'label'       => __( 'Twitter Username', 'greenpark' ),
		'description' => __( 'Enter your Twitter username (without @).', 'greenpark' ),
		'section'     => 'greenpark_social_section',
		'type'        => 'text',
	) );

    $wp_customize->add_setting( 'greenpark_twitter_enable', array(
        'default'           => false,
        'sanitize_callback' => 'greenpark_sanitize_checkbox',
    ) );

    $wp_customize->add_control( 'greenpark_twitter_enable', array(
        'label'    => __( 'Show Twitter Link', 'greenpark' ),
        'section'  => 'greenpark_social_section',
        'type'     => 'checkbox',
    ) );

	// Feedburner
	$wp_customize->add_setting( 'greenpark_feed_uri', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'greenpark_feed_uri', array(
		'label'       => __( 'Feedburner URI', 'greenpark' ),
		'description' => __( 'Enter your Feedburner URI.', 'greenpark' ),
		'section'     => 'greenpark_social_section',
		'type'        => 'text',
	) );

    $wp_customize->add_setting( 'greenpark_feed_enable', array(
        'default'           => false,
        'sanitize_callback' => 'greenpark_sanitize_checkbox',
    ) );

    $wp_customize->add_control( 'greenpark_feed_enable', array(
        'label'    => __( 'Use Feedburner', 'greenpark' ),
        'section'  => 'greenpark_social_section',
        'type'     => 'checkbox',
    ) );


    // -------------------------------------------------------------------------
	// About Section (Sidebar)
	// -------------------------------------------------------------------------
	$wp_customize->add_section( 'greenpark_about_section', array(
		'title'    => __( 'About Settings', 'greenpark' ),
		'priority' => 55,
	) );

    $wp_customize->add_setting( 'greenpark_about_title', array(
		'default'           => __( 'About', 'greenpark' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'greenpark_about_title', array(
		'label'       => __( 'About Title', 'greenpark' ),
		'section'     => 'greenpark_about_section',
		'type'        => 'text',
	) );

    $wp_customize->add_setting( 'greenpark_about_content', array(
		'default'           => '',
		'sanitize_callback' => 'wp_kses_post',
	) );

	$wp_customize->add_control( 'greenpark_about_content', array(
		'label'       => __( 'About Content', 'greenpark' ),
		'section'     => 'greenpark_about_section',
		'type'        => 'textarea',
	) );


	// -------------------------------------------------------------------------
	// Advertising Section
	// -------------------------------------------------------------------------
	$wp_customize->add_section( 'greenpark_ads_section', array(
		'title'    => __( 'Advertising', 'greenpark' ),
		'priority' => 60,
	) );

	$wp_customize->add_setting( 'greenpark_ads_enable', array(
		'default'           => false,
		'sanitize_callback' => 'greenpark_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'greenpark_ads_enable', array(
		'label'    => __( 'Enable Ads', 'greenpark' ),
		'section'  => 'greenpark_ads_section',
		'type'     => 'checkbox',
	) );

	$wp_customize->add_setting( 'greenpark_ads_code', array(
		'default'           => '',
		'sanitize_callback' => 'greenpark_sanitize_html', // Custom sanitization for ad code
	) );

	$wp_customize->add_control( 'greenpark_ads_code', array(
		'label'       => __( 'Ad Code (Bottom of Post)', 'greenpark' ),
		'description' => __( 'Paste your ad code here. Recommended size: 468x60.', 'greenpark' ),
		'section'     => 'greenpark_ads_section',
		'type'        => 'textarea',
	) );


    // -------------------------------------------------------------------------
	// Analytics Section
	// -------------------------------------------------------------------------
	$wp_customize->add_section( 'greenpark_analytics_section', array(
		'title'    => __( 'Analytics', 'greenpark' ),
		'priority' => 70,
	) );

    $wp_customize->add_setting( 'greenpark_analytics_code', array(
		'default'           => '',
		'sanitize_callback' => 'greenpark_sanitize_html',
	) );

	$wp_customize->add_control( 'greenpark_analytics_code', array(
		'label'       => __( 'Google Analytics Code', 'greenpark' ),
		'description' => __( 'Paste your Google Analytics code here.', 'greenpark' ),
		'section'     => 'greenpark_analytics_section',
		'type'        => 'textarea',
	) );

}
add_action( 'customize_register', 'greenpark_customize_register' );

/**
 * Sanitize Checkbox
 */
function greenpark_sanitize_checkbox( $checked ) {
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
 * Sanitize Sidebar Position
 */
function greenpark_sanitize_sidebar_position( $position ) {
	if ( ! in_array( $position, array( 'left', 'right' ) ) ) {
		return 'right';
	}
	return $position;
}

/**
 * Sanitize HTML (for ads and analytics)
 * Allows script tags which are usually stripped by wp_kses_post
 */
function greenpark_sanitize_html( $input ) {
    return wp_kses( $input, array(
        'script' => array(
            'src' => array(),
            'type' => array(),
            'async' => array(),
            'defer' => array(),
        ),
        'div' => array(
            'class' => array(),
            'id' => array(),
            'style' => array(),
        ),
        'span' => array(
            'class' => array(),
            'id' => array(),
            'style' => array(),
        ),
        'img' => array(
            'src' => array(),
            'alt' => array(),
            'width' => array(),
            'height' => array(),
            'class' => array(),
            'id' => array(),
        ),
        'a' => array(
            'href' => array(),
            'title' => array(),
            'target' => array(),
            'class' => array(),
            'id' => array(),
        ),
        'br' => array(),
        'p' => array(
            'class' => array(),
            'id' => array(),
        ),
    ) );
}
