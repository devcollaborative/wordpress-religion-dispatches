<?php
/**
 * SimpleMag functions and definitions
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.0
**/


/* CUSTOM - allow HTML in author bio */
remove_filter('pre_user_description', 'wp_filter_post_kses');