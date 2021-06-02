<?php

//set up admin menu
function wcmt_options_page() {
    add_menu_page(
        'Wombaco Multiplication Table',
        'Mult-Table',
        'manage_options',
        'wcmt',
        'wcmt_options_page_html',
        plugins_url( 'wc-mult-table/images/icon.png' ),
        // 'dashicons-grid-view'
    );

    // add_submenu_page(
    //     'wcmt',
    //     'WCMT Options',
    //     'WCMT Options',
    //     'manage_options',
    //     'wcmt_sub',
    //     'wcmt_options_page_html'
    // );
}
add_action('admin_menu', 'wcmt_options_page');


//create html for options page
function wcmt_options_page_html() {
    // check user capabilities
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<p>Use the following shortcode to add the multiplication table to a post.</p>
		<h3>[wcmt]</h3>
        <hr>

        <form action="options.php" method="post">
            <?php
            // output security fields for the registered setting "wcmt_options"
            settings_fields( 'wcmt' );
            // output setting sections and their fields
            // (sections are registered for "wcmt", each field is registered to a specific section)
            do_settings_sections( 'wcmt' );
            // output save settings button
            submit_button( __( 'Save Settings', 'textdomain' ) );
            ?>
        </form>
    </div>
    <?php
}


/**
 * Settings Template
 */
function wcmt_settings_init() {

    // Setup settings section
    add_settings_section(
        'wcmt_settings_section',
        'Settings',
        '',
        'wcmt'
    );

    // Register text field
    register_setting(
        'wcmt',
        'wcmt_settings_input_field',
        array(
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default' => ''
        )
    );

    // Add text fields
    add_settings_field(
        'wcmt_settings_input_field',
        __( 'Title', 'wcmt' ),
        'wcmt_settings_input_field_callback',
        'wcmt',
        'wcmt_settings_section'
    );

    // Register select option field
    register_setting(
        'wcmt',
        'wcmt_settings_select_field',
        array(
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default' => ''
        )
    );

    // Add select field
    add_settings_field(
        'wcmt_settings_select_field',
        __( 'Show Title', 'wcmt' ),
        'wcmt_settings_select_field_callback',
        'wcmt',
        'wcmt_settings_section'
    );
}
add_action( 'admin_init', 'wcmt_settings_init' );


/**
 * txt tempalte
 */
function wcmt_settings_input_field_callback() {
    $wcmt_input_field = get_option('wcmt_settings_input_field');
    ?>
    <input type="text" name="wcmt_settings_input_field" class="regular-text" value="<?php echo isset($wcmt_input_field) ? esc_attr( $wcmt_input_field ) : ''; ?>" />
    <?php 
}

/**
 * select template
 */
function wcmt_settings_select_field_callback() {
    $wcmt_select_field = get_option('wcmt_settings_select_field');
    ?>
    <select name="wcmt_settings_select_field" class="regular-text">
        <option value="">Select One</option>
        <option value="yes" <?php selected( 'yes', $wcmt_select_field ); ?> >Yes</option>
        <option value="no" <?php selected( 'no', $wcmt_select_field ); ?>>No</option>
    </select>
    <?php
}


