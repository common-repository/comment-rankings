<?php
/*
Plugin Name: Comment Rankings
Plugin URI: http://www.kinggary.com/2007/04/18/comment-rankings-wordpress-plugin/
Description: Shows stars next to comment authors, depending on how many total comments they have made on your blog.
Author: Gary King
Version: 1.0
Author URI: http://www.kinggary.com/
*/

function comment_rankings($comment_author_link)
{
	global $wpdb;
	
	$comment_author = get_comment_author();
	
	// get number of comments by this person
	$number_of_comments = $wpdb->get_var("SELECT COUNT(*) AS count FROM $wpdb->comments WHERE comment_author = '" . mysql_escape_string($comment_author) . "' AND comment_approved = '1';");
	// calculate number of stars
	$number_of_stars = floor($number_of_comments / 10);
	for ($i = 1; $i <= $number_of_stars; $i ++)
		$stars .= '<img src="' . get_bloginfo('url') . '/wp-content/plugins/comment_rankings/star.png" alt="" title="' . $comment_author . ' has made ' . $number_of_comments . ' comments." />';
	
	return $comment_author_link . ' ' . $stars;
}

add_filter('get_comment_author_link', 'comment_rankings');

?>