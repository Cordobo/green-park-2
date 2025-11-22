<?php

// setup for admin panel
$themename = "Cordobo GreenPark 2";
$shortname = "cgp";


$options = array (

	array(
		"name" => $themename." Options",
		"type" => "title"
	),
	array(
		"name" => "Logo URL",
		"desc" => "Enter the URL to your logo",
		"id" => "logo",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Custom Favicon",
		"desc" => "Paste the URL to a .ico image that you want to use as the image",
		"id" => "favicon",
		"type" => "text",
		"std" => home_url() ."/favicon.ico"
	),
	array( "name" => "Colour Scheme",
		"desc" => "Select the colour scheme for the theme",
		"id" => "color_scheme",
		"type" => "select",
		"options" => array("Light", "Dark", "Red", "Blue"),
		"std" => "dark"
	),
	array( "name" => "Sidebar Position",
		"desc" => "Select the position of the sidebar",
		"id" => "sidebar_position",
		"type" => "select",
		"options" => array("Left", "Right"),
		"std" => "right"
	),
	array(
		"name" => "Custom CSS",
		"desc" => "Want to add any custom CSS code? Put in here, and the rest is taken care of. This overrides any other stylesheets. eg: a.button{color:green}",
		"id" => "custom_css",
		"type" => "textarea",
		"std" => ""
	),
	array(
		"name" => "Twitter Username",
		"desc" => "Enter your Twitter username (excluding the @ symbol)",
		"id" => "twitter",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Facebook URL",
		"desc" => "Enter the URL of your Facebook page",
		"id" => "facebook",
		"type" => "text",
		"std" => ""
	)

);



/**
 * Theme Option Page Example
 */
function cgp_theme_menu() {
  add_theme_page( 'Theme Option', 'Theme Options', 'manage_options', 'cgp_theme_options.php', 'cgp_theme_page');
}
add_action('admin_menu', 'cgp_theme_menu');



/**
 * Callback function to the add_theme_page
 * Will display the theme options page
 */
function cgp_theme_page() {
?>
    <div class="section panel">
      <h1>Custom Theme Options</h1>
      <form method="post" enctype="multipart/form-data" action="options.php">
        <?php
          settings_fields('cgp_theme_options');
          do_settings_sections('cgp_theme_options.php');
        ?>
            <p class="submit">
                <input type="submit" class="button-primary" value="<?php _e('Save Changes', 'greenpark') ?>" />
            </p>

      </form>
    </div>
    <?php
}



/**
 * Register the settings to use on the theme options page
 */
add_action( 'admin_init', 'cgp_register_settings' );

/**
 * Function to register the settings
 */
function cgp_register_settings() {
    global $options;

    // Register the settings with Validation callback
    register_setting( 'cgp_theme_options', 'cgp_theme_options', 'cgp_validate_settings' );

    // Add settings section
    add_settings_section( 'cgp_main_section', 'General Settings', 'cgp_display_section', 'cgp_theme_options.php' );

    // Create fields dynamically from the $options array
    foreach ( $options as $option ) {
        if ( $option['type'] == 'title' ) continue;

        add_settings_field(
            $option['id'],
            $option['name'],
            'cgp_display_setting',
            'cgp_theme_options.php',
            'cgp_main_section',
            $option // Pass the entire option array as arguments
        );
    }
}



/**
 * Function to add extra text to display on each section
 */
function cgp_display_section($section) {
    echo '<p>Configure the theme settings below.</p>';
}



/**
 * Function to display the settings on the page
 */
function cgp_display_setting($args) {
    // Get all theme options
    $options = get_option('cgp_theme_options');

    $id = $args['id'];
    $type = $args['type'];
    $desc = isset($args['desc']) ? $args['desc'] : '';
    $std = isset($args['std']) ? $args['std'] : '';

    // Get current value or default
    $value = isset($options[$id]) ? $options[$id] : $std;

    switch ( $type ) {
        case 'text':
            ?>
            <input type="text" name="cgp_theme_options[<?php echo esc_attr($id); ?>]" value="<?php echo esc_attr($value); ?>" class="regular-text" />
            <p class="description"><?php echo esc_html($desc); ?></p>
            <?php
            break;

        case 'textarea':
            ?>
            <textarea name="cgp_theme_options[<?php echo esc_attr($id); ?>]" rows="10" cols="50" class="large-text"><?php echo esc_textarea($value); ?></textarea>
            <p class="description"><?php echo esc_html($desc); ?></p>
            <?php
            break;

        case 'select':
            ?>
            <select name="cgp_theme_options[<?php echo esc_attr($id); ?>]">
                <?php foreach ($args['options'] as $option_val) : ?>
                    <option value="<?php echo esc_attr(strtolower($option_val)); ?>" <?php selected(strtolower($value), strtolower($option_val)); ?>>
                        <?php echo esc_html($option_val); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <p class="description"><?php echo esc_html($desc); ?></p>
            <?php
            break;
    }
}



/**
 * Callback function to the register_settings function will pass through an input variable
 * You can then validate the values and the return variable will be the values stored in the database.
 */
function cgp_validate_settings($input) {
    $valid_input = array();

    // Simple sanitization loop
    foreach($input as $key => $value) {
        // Allow HTML in custom css, but maybe sanitize others more strictly if needed
        if ( $key == 'custom_css' ) {
            if ( function_exists( 'wp_strip_all_tags' ) ) {
                $valid_input[$key] = wp_strip_all_tags($value);
            } else {
                $valid_input[$key] = strip_tags($value);
            }
        } else {
            $valid_input[$key] = sanitize_text_field($value);
        }
    }

    return $valid_input;
}

?>
