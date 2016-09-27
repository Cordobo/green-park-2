<?php

// setup for admin panel
$themename = "CGP2";
$shortname = "cgp2";




/**
 * Theme Option Page Example
 */
function cgp2_theme_menu() {
    add_theme_page(__('Green Park 2 Settings', 'greenpark'), __('Green Park 2 Settings', 'greenpark'), 'manage_options', 'cgp2_theme_options.php', 'cgp2_theme_page');
}

add_action('admin_menu', 'cgp2_theme_menu');

/**
 * Callback function to the add_theme_page
 * Will display the theme options page
 */
function cgp2_theme_page() {
    ?>
    <div class="wrap" id="greenpark2_admin_styles">
        <h2>Cordobo Green Park 2 Settings</h2>
        <form method="post" enctype="multipart/form-data" action="options.php">
    <?php
    settings_fields('cgp2_theme_options');
    do_settings_sections('cgp2_theme_options.php');
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
add_action('admin_init', 'cgp2_register_settings');



/**
 * Function to register the settings
 */
function cgp2_register_settings() {

    global $shortname;


    // Register the settings with Validation callback
    register_setting('cgp2_theme_options', 'cgp2_theme_options', 'cgp2_validate_settings');

    // Add settings section
    add_settings_section('cgp2_text_section', 'Text box Title', 'cgp2_display_section', 'cgp2_theme_options.php');

// Create textbox field
    $field_args = array(
        array(
            'type' => 'text',
            'id' => 'cgp2_textbox',
            'name' => 'cgp2_textbox',
            'desc' => 'Example of textbox description',
            'std' => '',
            'label_for' => 'cgp2_textbox',
            'class' => 'css_class'
        ),
        array(
            "name" => "Hide this?",
            "id" => $shortname . "_other_posts_slider",
            "type" => "checkbox",
            "std" => "false",
            "desc" => "Yes"
        )
    );

    add_settings_field('example_textbox', 'Example Textbox', 'cgp2_display_setting', 'cgp2_theme_options.php', 'cgp2_text_section', $field_args);
}

/**
 * Function to add extra text to display on each section
 */
function cgp2_display_section($section) {

}

/**
 * Function to display the settings on the page
 * This is setup to be expandable by using a switch on the type variable.
 * In future you can add multiple types to be display from this function,
 * Such as checkboxes, select boxes, file upload boxes etc.
 */
function cgp2_display_setting($args) {

    global $field_args;

    extract($args);

    $option_name = 'cgp2_theme_options';

    $options = get_option($option_name);

    switch ($type) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr($options[$id]);
            echo "<input class='regular-text$class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            break;

        case 'checkbox':
        ?>
            <div class="rm_input rm_checkbox">
                <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
                <div class="rm_option_block">
                    <?php
                    if (get_option($value['id'])) {
                        $checked = "checked=\"checked\"";
                    } else {
                        $checked = "";
                    }
                    ?>
                    <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
                    <span class="description"><?php echo $value['desc']; ?></span>
                </div>
            </div>

<?php
            break;
    }
}

/**
 * Callback function to the register_settings function will pass through an input variable
 * You can then validate the values and the return variable will be the values stored in the database.
 */
function cgp2_validate_settings($input) {
    foreach ($input as $k => $v) {
        $newinput[$k] = trim($v);

        // Check the input is a letter or a number
        if (!preg_match('/^[A-Z0-9 _]*$/i', $v)) {
            $newinput[$k] = '';
        }
    }

    return $newinput;
}
?>
