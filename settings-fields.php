<?php
/**
 * Plugin Name: Settings field
 * Plugin URI: https://talib.netlify.com
 * Description: Settings field guide
 * Version: 1.0.0
 * Author: TALIB
 * Author URI: https://talib.netlify.com.com
 * License: GPLv2 or later
 * Text Domain: elementor-widget
 * Domain Path: /languages/
 */
function settings_field_init() {

    //  add section
    add_settings_section( 'settings_section', __( 'Settings Fields Section', 'settings-feilds' ), 'output_section_callback', 'general' );
    //add fields
    add_settings_field( 'input_text', __( 'Field Text', 'settings-fields' ), 'output_text_callback', 'general', 'settings_section' );
    add_settings_field( 'input_dropdown', __( 'Field Dropdown', 'settings-field' ), 'output_dropdown_callback', 'general', 'settings_section' );
    add_settings_field( 'input_checkbox', __( 'Field Checkbox', 'settings-field' ), 'output_checkbox_callback', 'general', 'settings_section' );

// ===================================================

// OPTIONAL FOR SINGLE CALLBACK IF INPIUT TYPE IS SAME

// ===================================================

// add_settings_field( 'input_text', __( 'Field text', 'settings-fields' ), 'single_callback', 'general', 'settings_section', ['input_text'] );
    //register settigns
    register_setting( 'general', 'input_text', ['sanitize_callback' => 'esc_attr'] );
    register_setting( 'general', 'input_dropdown', ['sanitize_callback' => 'esc_attr'] );
    register_setting( 'general', 'input_checkbox' );
}

// ====================================

// OPTIONAL SINGLE CALLBACK

// ====================================

// function single_callback( $args ) {

//     $option = get_option( $args[0] );

//     printf( "<input type='text' id='%s' name='%s' value='%s'/>", $args[0], $args[0], $option );
// }
function output_section_callback() {
    echo 'section description';
}

function output_text_callback() {
    $text = get_option( 'input_text' );
    printf( "<input type='text' id='%s' name='%s' value='%s'/>", 'input_text', 'input_text', $text );
}

function output_dropdown_callback() {
    $option  = get_option( 'input_dropdown' );
    $numbers = [
        'one',
        'two',
        'three',
        'four',
        'five',
    ];
    printf( '<select id="%s" name="%s">', 'input_dropdown', 'input_dropdown' );

    foreach ( $numbers as $number ) {
        $selected = '';

        if ( $option == $number ) {$selected = 'selected';}

        printf( '<option value="%s"%s>%s</option>', $number, $selected, $number );
    }

}

function output_checkbox_callback() {
    $option  = get_option( 'input_checkbox' );
    $numbers = [
        'one',
        'two',
        'three',
        'four',
        'five',
    ];

    foreach ( $numbers as $number ) {
        $selected = '';

        if ( is_array( $option ) && in_array( $number, $option ) ) {
            $selected = 'checked';
        }
        ;
        printf( '<input type="checkbox" name="input_checkbox[]" value="%s"%s>%s', $number, $selected, $number );
    }

}

add_action( 'admin_init', 'settings_field_init' );
