<?php

/**
 * Plugin Name:       Wombaco Multiplication Table
 * Plugin URI:        https://wombaco.com/plugins/
 * Description:       Insert a multiplication table using a shortcode
 * Version:           1.0
 * Author:            Brian Hart
 * Author URI:        https://brianthart.com/
 */


if ( is_admin() ) {
    require_once __DIR__ . '/admin/view.php';
}

//enqueu the plugin styles and scripts
add_action( 'wp_enqueue_scripts', 'wcmt_assets' );
function wcmt_assets() {
    wp_enqueue_style( 'wcmt-styles', plugins_url( 'public/css/wcmt-styles.css' , __FILE__ ) );
    wp_enqueue_script( 'wcmt-script', plugins_url( 'public/js/wcmt.js' , __FILE__ ), null, null, true );
}


function wc_mult_table_shortcode( $atts = [], $content = null ) {
    // normalize attribute keys, lowercase
    $atts = array_change_key_case( (array) $atts, CASE_LOWER );
 
    // override default attributes with user attributes
    // $wcmt_atts = shortcode_atts(
    //     array(
    //         'title' => 'Multiplication Table',
    //     ), $atts
    // );

	$content = '
	<div id="wcmt-main-container">

		<div class="wcmt-message-container text-center" id="wcmt-message-container">
			<p class="wcmt-message" id="wcmt-review">
				<i>Use the table to review. Then, click the quiz button to test your knowledge.</i>
			</p>

			<p class="wcmt-message hidden" id="wcmt-instructions">
				<i>Fill in the boxes and click the submit button to check your answers.</i>
			</p>

			<h2 class="wcmt-message" id="wcmt-score"></h2>

			<p class="hidden wcmt-message" id="wcmt-timer-container"><span id="wcmt-timer"></span></p>
		</div>
		<div></div>

		<div class="wcmt-column-headers wcmt-flex-container" id="wcmt-column-headers">
			<div class="wcmt-header"></div>
		</div>

		<div class="wcmt-flex-container">
			<div class="wcmt-row-headers" id="wcmt-row-headers">
			</div>

			<div class="wcmt-boxes wcmt-flex-container" id="wcmt-boxes"></div>
		</div>

		<button class="wcmt-button" id="wcmt-quiz-button" onclick="startQuiz()">Quiz</button>
		<button class="wcmt-button hidden" id="wcmt-submit-button" onclick="submit()">Submit</button>
		<button class="wcmt-button hidden" id="wcmt-reset-button" onclick="reset()">Reset</button>
	</div>';

    return $content;
}
 
    
add_shortcode( 'wcmt', 'wc_mult_table_shortcode' );


