<?php
/**
 * This Wordpress snippet displays a list of any attached Word documents or PDF files.
 * Snippet can be included for both page or post templates within Wordpress. 
 *
 * @author Mark Inns
 * @dependencies Wordpress
 */
 
if ( $attachments = get_children( array(
        'post_type' => 'attachment', // Restrict query to attachments
        'post_mime_type' => array('application/doc','application/pdf'), // Only select doc and pdf files
        'post_status' => null, // Attached files can't have a status so select null
        'order' => 'DEC', // Set descending order from highest to lowest values
        'post_parent' => $post->ID // Set current post as parent of attached media
)));
		echo '<ul class="post-attachments">';
          foreach ($attachments as $attachment) {
			      $class = "post-attachment mime-" . sanitize_title( $attachment->post_mime_type ); // Set class useful for adding icons via CSS
			      $title = wp_get_attachment_link( $attachment->ID, false ); // Get link URL
			      $link = wp_get_attachment_url( $attachment->ID ); // Get attachment title 
			      echo '<li class="' . $class . '"><a href="' . $link . '">' . $title . '</a></li>';
          }
		echo '</ul>';
?>
