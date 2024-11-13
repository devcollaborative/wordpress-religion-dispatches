<?php 
/*
	Not intended for display!
	This page template generates a list of all categories and all tags. Will display for pages titled "taxonomy report"
  Set page to Private and send clients the link so they can see their taxonomy
	Author: Clare
	January 2019
*/
get_header(); ?>
<?php if ( have_posts() ) : ?> 
	<?php while ( have_posts() ) : the_post(); ?> 
<div id="main-content" class="container"><?php the_content() ?>

<h2>Categories</h2>
	
<?php

$args = array(
    'taxonomy'           => 'category',
    'hide_empty'         => 0,
    'orderby'            => 'name',
    'order'              => 'ASC',
    'show_count'         => 1,
    'use_desc_for_title' => 0,
    'title_li'           => 0

);
wp_list_categories($args);
?>

<h2>Tags</h2>

<ul>
<?php
$terms = get_terms('post_tag',array('hide_empty'=>false));
foreach($terms as $t) {
  echo '<li><a href="'.get_tag_link($t->term_id).'">'.$t->name.'</a> ('.$t->count.')</li>';
}

?>
</ul>
</div>	
<?php endwhile; ?>
<?php endif; ?>


<?php get_footer(); ?>