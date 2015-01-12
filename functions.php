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
/*
remove_filter('the_content', 'wpautop');
*/

/**
 * Add shortcode to include iframes in pages or posts. Default
 * width and height set to 500 x 1000 and can be set with params
 * in the shortcode.
 * 
 * Example: [iframe src="http://www.domain.com/file_name.html"]
 * Example with custom size: [iframe src="http://www.yoursite.com/file_url.html" width="800" height="600"]
 */
/*
function short_iframe($atts, $content) {
 if (!$atts['width']) { $atts['width'] = 500; }
 if (!$atts['height']) { $atts['height'] = 1000; }
 return '<iframe border="0" class="shortcode_iframe" src="' . $atts['src'] . '" width="' . $atts['width'] . '" height="' . $atts['height'] . '"></iframe>';
}
add_shortcode('iframe', 'short_iframe');
*/
