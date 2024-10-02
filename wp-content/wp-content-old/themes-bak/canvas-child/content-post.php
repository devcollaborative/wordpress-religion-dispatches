<?php
/**
 * Post Content Template
 *
 * This template is the default page content template. It is used to display the content of the
 * `single.php` template file, contextually, as well as in archive lists or search results.
 *
 * @package WooFramework
 * @subpackage Template
 */

/**
 * Settings for this template file.
 *
 * This is where the specify the HTML tags for the title.
 * These options can be filtered via a child theme.
 *
 * @link http://codex.wordpress.org/Plugin_API#Filters
 */

$settings = array(
				'thumb_w' => 100,
				'thumb_h' => 100,
				'thumb_align' => 'alignleft',
				'post_content' => 'excerpt',
				'comments' => 'both'
				);

$settings = woo_get_dynamic_values( $settings );

$title_before = '<h1 class="title">';
$title_after = '</h1>';

if ( ! is_single() ) {
$title_before = '<h2 class="title">';
$title_after = '</h2>';
$title_before = $title_before . '<a href="' . esc_url( get_permalink( get_the_ID() ) ) . '" rel="bookmark" title="' . the_title_attribute( array( 'echo' => 0 ) ) . '">';
$title_after = '</a>' . $title_after;
}

$page_link_args = apply_filters( 'woothemes_pagelinks_args', array( 'before' => '<div class="page-link">' . __( 'Pages:', 'woothemes' ), 'after' => '</div>' ) );

woo_post_before();
?>
<article <?php post_class(); ?>>
<?php
woo_post_inside_before();
if ( 'content' != $settings['post_content'] && ! is_singular() )
	woo_image( 'width=' . esc_attr( $settings['thumb_w'] ) . '&height=' . esc_attr( $settings['thumb_h'] ) . '&class=thumbnail ' . esc_attr( $settings['thumb_align'] ) );
?>
	<header>
	<?php the_title( $title_before, $title_after ); ?>
	<?php if(get_field('subhead'))
			{
				echo '<h3>' . get_field('subhead') . '</h3>';
			} ?>
	</header>
<?php
woo_post_meta();
?>
	<section class="entry">

<!--BOOK INFO-->
<?php
	if ( 'content' == $settings['post_content'] || is_single() ) {
		if(get_field('book_title'))
			{
				echo '<div class="book_info">';
			}
		if(get_field('book_cover'))
			{
			echo '<img src="' . get_field('book_cover') . '" class="book_cover" />';
			}
		if(get_field('book_title'))
			{
				echo '<h4>' . get_field('book_title') . '</h4>';
			}
		if(get_field('book_author'))
			{
			echo '<em>By ' . get_field('book_author') . '</em><br />';
			}
		if(get_field('book_publisher'))
			{
			echo '' . get_field('book_publisher') . '';
			}
		if(get_field('book_title'))
			{
				echo '</div>';
			}
	 }
?>

<!--MEDIA EMBED-->

<?php if ( 'content' == $settings['post_content'] || is_single() ) {
  if( have_rows('embedded_content') ): 
    
    
    $rows = get_field('embedded_content' ); // get all the rows
		$first_row = $rows[0]; // get the first row
		$first_row_content = $first_row['embedded_media' ]; // get the sub field value 
    
    if( $first_row_content != "" ) :
    ?>
    
    
  <div class="embed_area">
	  <div id="loopedSlider" class="magazine-slider has-pagination woo-slideshow" style="height:auto;">
		  <ul class="slides">
		  <?php while( have_rows('embedded_content') ): the_row(); ?>
		      <?php $embedded_media = get_sub_field('embedded_media'); ?>
		     <li class="slide">
		      <?php $embedded_media_caption = get_sub_field('embedded_media_caption'); ?>
		      <?php echo $embedded_media ?>
		     <p class="embed_caption"><?php echo $embedded_media_caption ?></p>
		     </li>
		    <?php endwhile; ?>
		  </ul>
	  </div>
  </div>

   	<script type="text/javascript">
	jQuery(window).load(function() {
		var args = {};
		args.useCSS = false;
		args.animation = 'slide';
		args.slideshow = false;
		args.smoothHeight = true;
		args.video = true;
		args.manualControls = '.pagination-wrap .flex-control-nav > li';
		args.start = function ( slider ) {
			slider.next( '.slider-pagination' ).fadeIn();
		}
		args.prevText = '<span class="icon-angle-left"></span>';
		args.nextText = '<span class="icon-angle-right"></span>';

		jQuery( '.woo-slideshow' ).each( function ( i ) {
			jQuery( this ).flexslider( args );
		});
	});
	</script>

  <?php endif;
  			endif; ?>
<?php }; ?>

<?php
if ( 'content' == $settings['post_content'] || is_single() ) { the_content( __( 'Continue Reading &rarr;', 'woothemes' ) ); } else { the_excerpt(); }
if ( 'content' == $settings['post_content'] || is_singular() ) wp_link_pages( $page_link_args );
?>

<?php if ( 'content' == $settings['post_content'] || is_single() ) { ?>
<div class="source">
<?php
if(get_field('source'))
{
	echo '<h4>Source</h4>';
	echo '<h3><a href="' . get_field('source_url') . '">' . get_field('source') . '</a></h3>';
}
?>
</div>
<?php }; ?>

	</section><!-- /.entry -->
	<div class="fix"></div>
<?php
woo_post_inside_after();
?>
</article><!-- /.post -->
<?php
woo_post_after();
$comm = $settings['comments'];
if ( ( 'post' == $comm || 'both' == $comm ) && is_single() ) { comments_template(); }
?>