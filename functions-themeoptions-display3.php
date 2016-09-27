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
		"id" => $shortname."_logo",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Custom Favicon",
		"desc" => "Paste the URL to a .ico image that you want to use as the image",
		"id" => $shortname."_favicon",
		"type" => "text",
		"std" => home_url() ."/favicon.ico"
	),
	array( "name" => "Colour Scheme",
		"desc" => "Select the colour scheme for the theme",
		"id" => $shortname."_color_scheme",
		"type" => "select",
		"options" => array("Light", "Dark", "Red", "Blue"),
		"std" => "dark"
	),
	array( "name" => "Sidebar Position",
		"desc" => "Select the position of the sidebar",
		"id" => $shortname."_sidebar_position",
		"type" => "select",
		"options" => array("Left", "Right"),
		"std" => "right"
	),
	array(
		"name" => "Custom CSS",
		"desc" => "Want to add any custom CSS code? Put in here, and the rest is taken care of. This overrides any other stylesheets. eg: a.button{color:green}",
		"id" => $shortname."_custom_css",
		"type" => "textarea",
		"std" => ""
	),
	array(
		"name" => "Twitter Username",
		"desc" => "Enter your Twitter username (excluding the @ symbol)",
		"id" => $shortname."_twitter",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Facebook URL",
		"desc" => "Enter the URL of your Facebook page",
		"id" => $shortname."_facebook",
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

    // Register the settings with Validation callback
    register_setting( 'cgp_theme_options', 'cgp_theme_options', 'cgp_validate_settings' );

    // Add settings section
    add_settings_section( 'cgp_text_section', 'Text box Title', 'cgp_display_section', 'cgp_theme_options.php' );

    // Create textbox field
    $field_args = array(

        array(
            'type'      => 'text',
            'id'        => 'cgp_textbox',
            'name'      => 'cgp_textbox',
            'desc'      => 'Example of textbox description',
            'std'       => '',
            'label_for' => 'cgp_textbox',
            'class'     => 'css_class'
        )

    );

    add_settings_field( 'example_textbox', 'Example Textbox', 'cgp_display_setting', 'cgp_theme_options.php', 'cgp_text_section', $field_args );
}



/**
 * Function to add extra text to display on each section
 */
function cgp_display_section($section) {

}



/**
 * Function to display the settings on the page
 * This is setup to be expandable by using a switch on the type variable.
 * In future you can add multiple types to be display from this function,
 * Such as checkboxes, select boxes, file upload boxes etc.
 */
function cgp_display_setting($args) {

    global $options;

    extract( $args );

    // $option_name = 'cgp_theme_options';

    // $options = get_option( $option_name );


    foreach ($options as $value) {
    switch ( $value['type'] ) {
          case 'text':
              //$options[$id] = stripslashes($options[$id]);
              //$options[$id] = esc_attr( $options[$id]);
              //echo "<input class='regular-text$class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
              //echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            ?>
            <div class="rm_input rm_text">
            <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
            <div class="rm_option_block">
            <?php if ($value['id'] == 'moov_secondary_color') { ?>
            <span class="colour_block" style="background:<?php if (get_option($value['id']) != "") {
            echo stripslashes(get_option($value['id']));
            } else {
            echo $value['std'];
            } ?>;"></span>
            <?php } ?>
            <input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if (get_option($value['id']) != "") {
            echo stripslashes(get_option($value['id']));
            } else {
            echo $value['std'];
            } ?>" />
            <span class="description"><?php echo $value['desc']; ?></span>
            </div>
            </div>
            <?php

          break;

            case 'textarea':
            ?>
            <div class="rm_input rm_textarea">
            <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
            <div class="rm_option_block">
            <textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" style="width: 95%;" cols="" rows="10"><?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id']) ); } else { echo $value['std']; } ?></textarea>
            <span class="description"><?php echo $value['desc']; ?></span>
            </div>
            </div>
            <?php

          break;




    } /* end switch */

    } /* end foreach */
}



/**
 * Callback function to the register_settings function will pass through an input variable
 * You can then validate the values and the return variable will be the values stored in the database.
 */
function cgp_validate_settings($input) {
  foreach($input as $k => $v)
  {
    $newinput[$k] = trim($v);

    // Check the input is a letter or a number
    if(!preg_match('/^[A-Z0-9 _]*$/i', $v)) {
      $newinput[$k] = '';
    }
  }

  return $newinput;
}

?>
