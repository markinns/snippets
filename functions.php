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
 * Clean up the head tags generated by Wordpress
 */
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);


/**
 * Customise excerpt length. Default is 55 words this code sets a
 * custom number (20 in the example).
 */
function custom_excerpt_length($length) {
	return 20;
}
add_filter('excerpt_length', 'custom_excerpt_length');


/**
 * Customise the backend admin logo.
 * CSS override maintains logo after WP code updates.
 */
function custom_login_logo() {
	echo '<style type="text/css">
	h1 a { background-image: url('.get_bloginfo('template_directory').'/images/custom-login-logo.png) !important; }
	</style>';
}
add_action('login_head', 'custom_login_logo');


/**
 * Disable update notification message for logged in users.
 */
if (!current_user_can('edit_users')) {
	add_action('init', create_function('$a', "remove_action('init', 'wp_version_check');"), 2);
	add_filter('pre_option_update_core', create_function('$a', "return null;"));
}


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
