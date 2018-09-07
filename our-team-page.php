<?php
/*
Plugin Name: Our Team Page
Plugin URI: https://widerwebs.com
Description: List the thumbnails for posts of type "our_team" (slug "our-team"). Shortcode: [our_team /]
Version: 1.0
Author: Dmitriy Cherchenko (Wider Webs)
Author URI: https://widerwebs.com
License: GPL2
*/

define('OUR_TEAM_TYPE', 'our_team');

function ourTeamPage(): string {
	$out = '';
	$q = new WP_Query(['post_type' => OUR_TEAM_TYPE, 'orderby' => 'date', 'posts_per_page' => -1]);
	if (!$q->have_posts()) {
		return $out;
	}
	while ($q->have_posts()) {
		$q->the_post();
		$out .= '<div class="our-team-member"><a href="' . get_permalink() . '">';
		$out .= get_the_post_thumbnail(null, 'medium', ['class' => 'aligncenter']);
		$out .= '</a><h4><a href="' . get_permalink() . '">';
		$out .= get_the_title() . '</a></h4></div>';
	}
	wp_reset_postdata();
	return $out;
}
add_shortcode('our_team', 'ourTeamPage');
