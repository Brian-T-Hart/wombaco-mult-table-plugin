<?php

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
    </div>
    <?php
}

//set up admin menu
add_action('admin_menu', 'wcmt_options_page');
function wcmt_options_page()
{
    add_menu_page(
        'Wombaco Multiplication Table',
        'WCMT',
        'manage_options',
        'wcmt',
        'wcmt_options_page_html'
    );
}