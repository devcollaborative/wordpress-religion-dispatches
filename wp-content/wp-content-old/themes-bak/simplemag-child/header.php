<?php
/**
 * The Header for the theme
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.0
**/
?>
<!DOCTYPE html>
<!--[if lt IE 9]><html <?php language_attributes(); ?> class="oldie"><![endif]-->
<!--[if (gte IE 9) | !(IE)]><!--><html <?php language_attributes(); ?> class="modern"><!--<![endif]-->
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php global $ti_option; ?>
<link rel="shortcut icon" href="<?php echo $ti_option['site_favicon']['url']; ?>" />
<link rel="apple-touch-icon-precomposed" href="<?php echo $ti_option['site_retina_favicon']['url']; ?>" />

<?php wp_head(); ?>
</head>


<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

    <div id="pageslide" class="st-menu st-effect">
    	<a href="#" id="close-pageslide"><i class="icomoon-remove-sign"></i></a>
    </div><!-- Sidebar in Mobile View -->
    
	<?php
    // Check for a layout options: Full Width or  Boxed
    if ( $ti_option['site_layout'] == '2' ) { $site_layout = ' class="layout-boxed"'; } else { $site_layout = ' class="layout-full"'; } ?>
    <section id="site"<?php echo isset( $site_layout ) ? $site_layout : ''; ?>>
        <div class="site-content">
    
            <header id="masthead" role="banner" class="clearfix<?php if ( $ti_option['site_main_menu'] == true ) { echo ' with-menu'; } ti_top_strip_class(); ?>" itemscope itemtype="http://schema.org/WPHeader">
           <!-- CUSTOM: USC branding -->
                <div id="usc-brand"><div class="wrapper">
<div id="usc"><a href="http://www.usc.edu"><img src="http://reldispatches.wpengine.com/cms/wp-content/uploads/2014/06/usc-shield-name-white.png" height="38" width="176" alt="University of Southern California" /></a></div>
<div id="usc-ann"><a href="http://annenberg.usc.edu"><img src="http://reldispatches.wpengine.com/cms/wp-content/uploads/2014/06/usc-annenberg-logo.png" width="160" alt="USC Annenberg" /></a></div></div>
</div>
			<!-- END CUSTOM -->
			
                <div class="no-print top-strip">
                    <div class="wrapper clearfix">
            
                        <?php 
                        // Hide Search and Social Icons if header variation with search is selected
                        if ( $ti_option['site_header'] != 'header_search' ) {
                            
                            // Search Form
                            get_search_form();
                        
                            // Social Profiles
                            if( $ti_option['top_social_profiles'] == 1 ) {
                                get_template_part ( 'inc/social', 'profiles' );
                            }
                        }
                        ?>
                        
                        <a href="#" id="open-pageslide" data-effect="st-effect"><i class="icomoon-menu"></i></a>
                        
                        <?php
                        // Pages Menu
                        if ( has_nav_menu( 'secondary_menu' ) ) :
                            echo '<nav class="secondary-menu" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">';
                            wp_nav_menu( array(
                                'theme_location' => 'secondary_menu',
                                'container' => false,
                            ));
                           echo '</nav>';
                         endif;
                        ?>
                    </div><!-- .wrapper -->
                </div><!-- .top-strip -->
                
                
                <div id="branding" class="animated">
                    <div class="wrapper">
                    <?php
                        /**
                         *  Header Variations
                        **/
                        
                        // Logo, Social Icons and Search
                        if ( $ti_option['site_header'] == 'header_search' ) {
                            get_template_part( 'inc/header', 'search' );
                        
                        // Logo and Ad unit
                        } elseif ( $ti_option['site_header'] == 'header_banner' ) {
                            get_template_part( 'inc/header', 'banner' );
                        
                        // Default - Centered Logo and Tagline
                        } else { 
                            get_template_part( 'inc/header', 'default' );
                        }
                    ?>
                    </div><!-- .wrapper -->
                </div><!-- #branding -->
                
				<?php
                // Main Menu
                if ( $ti_option['site_main_menu'] == true ):
					if ( has_nav_menu( 'main_menu' ) ) :
					echo '<div class="no-print animated main-menu-container">';
						if ( $ti_option['site_fixed_menu'] == '3' && $ti_option['site_main_menu'] == true ):
							echo '<div class="main-menu-fixed">';
						endif;
							echo '<nav class="wrapper main-menu" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">';
								wp_nav_menu( array(
									'theme_location' => 'main_menu',
									'container' => false,
									'walker' => new TI_Menu()
								 ));
							echo '</nav>';
						if ( $ti_option['site_fixed_menu'] == '3' && $ti_option['site_main_menu'] == true ):
							echo '</div>';
						endif;
						echo '</div>';
					 else:
						echo '<div class="message warning"><i class="icomoon-warning-sign"></i>' . __( 'Define your site main menu', 'themetext' ) . '</div>';
					 endif;
                endif;
                ?>

<!--Webby Roadblock-->
<script type="text/javascript">

// begin cookie code
// ++++++++++++++++++++++++++++++++++++++++++
// Run Once Per Session
//
// Replace the alerts by functions that need to
// be run once per session.
//
// Written by: Michael Regan
// Website   : www.owt4nowt.ca
//
// Released under the GPL.
// ++++++++++++++++++++++++++++++++++++++++++
var key_value = "myTestCookie=true";
var foundCookie = 0;   

// Get all the cookies from this site and store in an array
var cookieArray = document.cookie.split(';');   

    // Walk through the array
    for(var i=0;i < cookieArray.length;i++)
        {
               var checkCookie = cookieArray[i];
        // Remove any leading spaces
               while (checkCookie.charAt(0)==' ')
               {
                 checkCookie = checkCookie.substring(1,checkCookie.length);
               }   

        // Look for cookie set by key_value
                if (checkCookie.indexOf(key_value) == 0)
               {
                  // alert("Found Cookie ");
            // The cookie was found so set the variable
                   foundCookie = 1;
               }
    }
    // Check if a cookie has been found
    if ( foundCookie == 0)
    {
        // The key_value cookie was not found so set it now
        document.cookie = key_value;
        //alert("Setting Cookie");
//  }    move this to end
// end cookie code

	//Webby Roadblock code - conditional from cookie code
function webby_pv_roadblock_close(){var e=document.getElementById("webby-pv-2014-roadblock"),o=document.getElementById("webby-pv-roadblock");e&&(e.parentNode.removeChild(e),o.parentNode.removeChild(o))}function receive_webby_pv_roadblock_close(e){e.origin===iframe_host&&"webby_pv_roadblock_close"===e.data&&webby_pv_roadblock_close()}var nominee_id="3727",display_rank="true",iframe_host="http://pv.webbyawards.com",bug_html='<span id="webby-pv-2014-roadblock" style="position: fixed; z-index: 99999; left: 0; right: 0; bottom: 0; top: 0; margin: 0; padding: 0;"><iframe src="'+iframe_host+"/roadblock?nominee_id="+nominee_id+"&display_rank="+display_rank+'" style="position: relative; z-index: 99999; margin: 0; border: 0 none;" height="100%" width="100%" scrolling="no" frameborder="0" seamless></iframe></span>';document.body.insertAdjacentHTML("beforeend",bug_html),window.addEventListener?window.addEventListener("message",receive_webby_pv_roadblock_close,!1):window.attachEvent("onmessage",receive_webby_pv_roadblock_close),window.onkeyup=function(o){e=o||window.event,27==e.keyCode&&webby_pv_roadblock_close()};

	}   // moved from above
</script>
<!-- End Webby Roadblock-->
            </header><!-- #masthead -->