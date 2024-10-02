<?php
/* ----------------------------------------------------

	Shortcodes Library

------------------------------------------------------ */


/* Clean shortcodes
------------------------------------------------------ */
if( !function_exists( 'si_clean_shortcodes' )) {
	function si_clean_shortcodes($content){   
		$array = array (
			'<p>[' => '[',
			']</p>' => ']',
			'<br />[' => '[', 
			']<br />' => ']'
		);
		$content = strtr($content, $array);
		return $content;
	}
	add_filter('the_content', 'si_clean_shortcodes');
}



/**
 * Accordion
 * @since v1.0
------------------------------------------------------ */

// Wrapper
if( !function_exists( 'shortcode_accordion_wrapper' )) {
	function sc_accordion_wrapper( $atts, $content = null  ) {
		
		// Enque scripts
		wp_enqueue_script('sc-toggle');
		
		// Display the accordion
		return '<div class="sc-accordion">'
			   		. do_shortcode( $content ) .
			   '</div>';
	}
	add_shortcode( 'accordion', 'sc_accordion_wrapper' );
}

// Accordion single item
if( !function_exists( 'shortcode_accordion_item' )) {
	function sc_accordion_item( $atts, $content = null  ) {
		extract( shortcode_atts( array(
		  'title' => '',
		), $atts ));
	   return '<a class="trigger" href="#">'. $title .'</a>
	   		   <div class="content">'
			  		. do_shortcode( $content ) . 
			  '</div>';
	}
	add_shortcode( 'item', 'sc_accordion_item' );
}



/**
 * Button
 * @since v1.0
------------------------------------------------------ */
if( !function_exists( 'shortcode_button' )) {
	function shortcode_button( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'color' => '',
			'text'  => '',
			'url'   => '',
			'window' => ''
		), $atts ));
		return '<a href="' . $url . '" class="sc-button bg-' . $color . ' color-' . $text . '" tagret="' . $window . '">
			   		<span>' . $content . '</span>
			    </a>';
	}
	add_shortcode( 'button', 'shortcode_button' );
}



/**
 * Info Box
 * @since v1.0
------------------------------------------------------ */
if( !function_exists( 'shortcode_infobox' ) ) {
	function shortcode_infobox( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'bg' => '',
			'opacity' => '',
			'color' => '',
			'maintitle' => '',
			'subtitle' => '',
		), $atts));
		$output = '';
		
		$output .= '<div class="sc-infobox bg-' . $bg . ' content-' . $color . ' opacity-' . $opacity . '">';
			$output .= '<div class="border">';
				$output .= '<h2>' . do_shortcode( $content ) . '</h2>';
					if ( $subtitle != '' ){
						$output .= '<div class="sep"></div>';
						$output .= '<span>' . $subtitle . '</span>';
					}
			$output .= '</div>';
		$output .= '</div>';
		return $output;
	}
	add_shortcode( 'infobox', 'shortcode_infobox' );
}



/** 
 * Columns
 * @since v1.0
------------------------------------------------------ */

// Wrapper
if( !function_exists( 'shortcode_columns_row' )) {
	function shortcode_columns_row( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'width' => ''
		), $atts ));
		return '<div class="sc-columns '.$width.' clearfix">'
			    	. do_shortcode( $content ) .
			   '</div>';
	}
	add_shortcode( 'columns_row', 'shortcode_columns_row' );
}

// Column
if( !function_exists( 'shortcode_column' )) {
	function shortcode_column( $atts, $content = null ) {
		extract( shortcode_atts(array(), $atts ));
		return '<div class="col">'
			   		. do_shortcode( $content ) .
			   '</div>';
	}
	add_shortcode( 'column', 'shortcode_column' );
}



/** 
 * Tabs
 * @since v1.0
------------------------------------------------------ */

// Wrapper
if (!function_exists( 'shortcode_tabgroup' )) {
	function shortcode_tabgroup( $atts, $content = null ) {
		
		//Enque scripts
		wp_enqueue_script('sc-tabs');
		
		// Display Tabs
		$defaults = array( 'layout' => 'tabs-horizontal' );
		extract( shortcode_atts( $defaults, $atts ) );
		preg_match_all( '/tab title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
		$tab_titles = array();
		if( isset($matches[1]) ){ $tab_titles = $matches[1]; }
		$output = '';
				
		if( count($tab_titles) ){
			if ( $layout == 'horizontal' ){
		    	$output .= '<div id="sc-tab-' . rand(1, 100) . '" class="sc-tabs clearfix">';
			} else{
				$output .= '<div id="sc-tab-' . rand(1, 100) . '" class="sc-tabs tabs-' . $layout . ' clearfix">';
			}
				$output .= '<ul class="tabs-nav clearfix">';
				foreach( $tab_titles as $tab ){
					$output .= '<li><a href="#' . sanitize_title( $tab[0] ) . '">' . $tab[0] . '</a></li>';
				}
				$output .= '</ul>';
				$output .= '<div class="panes">';
					$output .= do_shortcode( $content );
				$output .= '</div>';
		    $output .= '</div>';
		} else {
			$output .= do_shortcode( $content );
		}
		return $output;
	}
	add_shortcode( 'tabgroup', 'shortcode_tabgroup' );
}

// Tab Single Item
if (!function_exists( 'shortcode_tab' )) {
	function shortcode_tab( $atts, $content = null ) {
		$defaults = array( 'title' => '' );
		extract( shortcode_atts( $defaults, $atts ) );
		return '<div id="' . sanitize_title( $title ) . '" class="tab-content">' . do_shortcode( $content ) . '</div>';
	}
	add_shortcode( 'tab', 'shortcode_tab' );
}


/**
 * Title
 * @since v1.0
------------------------------------------------------ */
if( !function_exists( 'shortcode_title' ) ) {
	function shortcode_title( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'sep' => '',
			'maintitle'  => '',
			'subtitle'  => '',
		), $atts));
		$output = '';
		
		$output .= '<div class="sc-title ' . $sep . '">';
			$output .= '<h2 class="title"><span>' . do_shortcode( $content ) . '</span></h2>';
			if ( $subtitle != '' ){
				$output .=	'<span class="sub-title">' . $subtitle . '</span>';
			}
		$output .=	'</div>';
		return $output;
	}
	add_shortcode( 'title', 'shortcode_title' );
}


/**
 * Separator
 * @since v1.0
------------------------------------------------------ */
if( !function_exists( 'shortcode_separator' )) {
	function shortcode_separator( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'type' => ''
		), $atts));
		return '<div class="sc-separator type-' . $type . '"></div>';
	}
	add_shortcode( 'separator', 'shortcode_separator' );
}