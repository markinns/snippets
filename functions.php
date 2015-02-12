<?php
/**
 * Wordpress Functions
 *
 * This document provides some helper functions, which are used
 * in custom template functions files. Others override WordPress 
 * defaults to change core functionality.
 */
 
/**
 * Disable WordPress auto-paragraphing.
 * Note: also strips manually added <p> tags from content
 */
remove_filter('the_content', 'wpautop');

/**
 * Add shortcode to include iframes in pages or posts. Default
 * width and height set to 500 x 1000 and can be set with params
 * in the shortcode.
 * 
 * Example: [iframe src="http://www.domain.com/file_name.html"]
 * Example with custom size: [iframe src="http://www.yoursite.com/file_url.html" width="800" height="600"]
 */
function short_iframe($atts, $content) {
 if (!$atts['width']) { $atts['width'] = 500; }
 if (!$atts['height']) { $atts['height'] = 1000; }
 return '<iframe border="0" class="shortcode_iframe" src="' . $atts['src'] . '" width="' . $atts['width'] . '" height="' . $atts['height'] . '"></iframe>';
}
add_shortcode('iframe', 'short_iframe');

/**
 * Add a custom field to the WP General Settings page and code
 * to display the field within a template.
 * 
 * Use the below echo statement in your template to output your
 * new custom field.
 * 
 * Example: echo get_option( 'custom_field', 'Optional Default Text' );
 */
$new_general_setting = new new_general_setting();

/* Chnage 'custom_field' to your own field variable and 'Your Field Name' to your own filed name */
class new_general_setting {
    function new_general_setting( ) {
        add_filter( 'admin_init' , array( &$this , 'register_fields' ) );
    }
    function register_fields() {
        register_setting( 'general', 'custom_field', 'esc_attr' );
        add_settings_field('fav_color', '<label for="custom_field">'.__('Your Field Name' , 'custom_field' ).'</label>' , array(&$this, 'fields_html') , 'general' );
    }
    function fields_html() {
        $value = get_option( 'custom_field', '' );
        echo '<input type="text" id="custom_field" name="custom_field" value="' . $value . '" />';
    }
}
