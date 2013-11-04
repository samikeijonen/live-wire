<?php
/**
 * The functions.php file is used to initialize everything in the theme. It controls how the theme is loaded and 
 * sets up the supported features, default actions, and default filters. If making customizations, users 
 * should create a child theme and make changes to its functions.php file (not this one).
 *
 * @package Live Wire
 * @subpackage Functions
 * @version 0.1.0
 * @author Sami Keijonen <sami.keijonen@foxnet.fi>
 * @copyright Copyright (c) 2012, Sami Keijonen
 * @link http://foxnet.fi
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
 
/* Load Hybrid Core theme framework. */
require_once( trailingslashit( TEMPLATEPATH ) . 'library/hybrid.php' );
new Hybrid();

/* Theme setup function using 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'live_wire_theme_setup' );

/**
 * Theme setup function.  This function adds support for theme features and defines the default theme
 * actions and filters.
 *
 * @since 0.1.0
 */
function live_wire_theme_setup() {

	/* Get action/filter hook prefix. */
	$prefix = hybrid_get_prefix();

	/* Add theme support for core framework features. */
	add_theme_support( 'hybrid-core-menus', array( 'primary', 'secondary', 'subsidiary' ) );
	add_theme_support( 'hybrid-core-sidebars', array( 'header', 'primary', 'subsidiary', 'after-singular' ) );
	add_theme_support( 'hybrid-core-widgets' );
	add_theme_support( 'hybrid-core-shortcodes' );
	add_theme_support( 'hybrid-core-theme-settings', array( 'about', 'footer' ) );
	add_theme_support( 'hybrid-core-styles', array( 'style' ) );
	add_theme_support( 'hybrid-core-scripts', array( 'drop-downs' ) );
	add_theme_support( 'hybrid-core-template-hierarchy' );
	
	/* Add theme support for framework extensions. */
	add_theme_support( 'theme-layouts', array( '1c', '2c-l', '2c-r' ) );
	add_theme_support( 'post-stylesheets' );
	add_theme_support( 'dev-stylesheet' );
	add_theme_support( 'loop-pagination' );
	add_theme_support( 'get-the-image' );
	add_theme_support( 'breadcrumb-trail' );
	add_theme_support( 'entry-views' );
	add_theme_support( 'cleaner-gallery' );
	add_theme_support( 'cleaner-caption' );
	
	/* Add theme support for WordPress features. */
	
	/* Add content editor styles. */
	add_editor_style( 'css/editor-style.css' );
	
	/* Add support for auto-feed links. */
	add_theme_support( 'automatic-feed-links' );
	
	/* Add support for post formats. */
	add_theme_support( 'post-formats', array( 'aside', 'audio', 'image', 'gallery', 'link', 'quote', 'status', 'video' ) );
	
	/* Add custom background feature. */
	add_theme_support( 'custom-background' );
	//add_custom_background( 'live_wire_custom_background_callback' );
	
	/* Set content width. */
	hybrid_set_content_width( 600 );
	
	/* Add respond.js for unsupported browsers. */
	add_action( 'wp_head', 'live_wire_respond_mediaqueries' );
	
	/* Disable primary sidebar widgets when layout is one column. */
	add_filter( 'sidebars_widgets', 'live_wire_disable_sidebars' );
	add_action( 'template_redirect', 'live_wire_one_column' );
	
	/* Add custom image sizes. */
	add_action( 'init', 'live_wire_add_image_sizes' );
	
	/* Add <blockquote> around quote posts if user have forgotten about it. */
	add_filter( 'the_content', 'live_wire_quote_content' );
	
	/* Enqueue script. */
	add_action( 'wp_enqueue_scripts', 'live_wire_scripts' );
	
}

/**
 * Function for help to unsupported browsers understand mediaqueries.
 * @link: https://github.com/scottjehl/Respond
 * @since 0.1.0
 */
function live_wire_respond_mediaqueries() {
	?>
	
	<!-- Enables media queries in some unsupported browsers. -->
	<!--[if (lt IE 9) & (!IEMobile)]>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js"></script>
	<![endif]-->
	
	<?php
}

/**
 * Function for deciding which pages should have a one-column layout.
 *
 * @since 0.1.0
 */
function live_wire_one_column() {

	if ( !is_active_sidebar( 'primary' ) || ( is_attachment() && 'layout-default' == theme_layouts_get_layout() ) )
		add_filter( 'get_theme_layout', 'live_wire_theme_layout_one_column' );

}

/**
 * Filters 'get_theme_layout' by returning 'layout-1c'.
 *
 * @since 0.1.0
 * @param string $layout The layout of the current page.
 * @return string
 */
function live_wire_theme_layout_one_column( $layout ) {
	return 'layout-1c';
}

/**
 * Disables sidebars if viewing a one-column page.
 *
 * @since 0.1.0
 * @param array $sidebars_widgets A multidimensional array of sidebars and widgets.
 * @return array $sidebars_widgets
 */
function live_wire_disable_sidebars( $sidebars_widgets ) {
	global $wp_query;

	if ( current_theme_supports( 'theme-layouts' ) && !is_admin() ) {

		if ( 'layout-1c' == theme_layouts_get_layout() ) {
			$sidebars_widgets['primary'] = false;
		}
	}

	return $sidebars_widgets;
}

/**
 * Adds custom image sizes for thumbnail images. 
 *
 * @since 0.1.0
 */
function live_wire_add_image_sizes() {

	add_image_size( 'live-wire-thumbnail', 194, 120, true );
	
}

/**
 * Wraps the output of the quote post format content in a <blockquote> element if the user hasn't added a 
 * <blockquote> in the post editor.
 *
 * @since 0.1.0
 * @param string $content The post content.
 * @return string $content
 */
function live_wire_quote_content( $content ) {

	if ( has_post_format( 'quote' ) ) {
		preg_match( '/<blockquote.*?>/', $content, $matches );

		if ( empty( $matches ) )
			$content = "<blockquote>{$content}</blockquote>";
	}

	return $content;
}

/**
 * Live Wire uses FitVids for responsive videos and TinyNav for dropdown navigation menu.
 *
 * @since 0.1.0
 * @note These are taken from fitvidsjs.com and tinynav.viljamis.com.
 * @link http://fitvidsjs.com/
 * @link http://tinynav.viljamis.com/
 */
function live_wire_scripts() {
	
	if ( !is_admin() ) {
		
		/* Enqueue FitVids */
		wp_enqueue_script( 'live_wire-fitvids', trailingslashit ( THEME_URI ) . 'js/jquery.fitvids.js', array( 'jquery' ), '20120222', true );
		wp_enqueue_script( 'live_wire-fitvids-settings', trailingslashit ( THEME_URI ) . 'js/fitvids.js', '', '20120222', true );
		
		/* Enqueue TinyNav */
		wp_enqueue_script( 'live_wire-tinynav', trailingslashit ( THEME_URI ) . 'js/tinynav.min.js', array( 'jquery' ), '20121228', true );
		wp_enqueue_script( 'live_wire-tinynav-settings', trailingslashit ( THEME_URI ) . 'js/tinynav.js', '', '20121228', true );
		
		/* Localize header text in TinyNav. @link: http://pippinsplugins.com/use-wp_localize_script-it-is-awesome */
		wp_localize_script( 'live_wire-tinynav-settings', 'tinynav_settings_vars', array(
			'header_primary' => __( 'Primary Navigation...', 'live-wire' ),
			'header_secondary' => __( 'Secondary Navigation...', 'live-wire' )
			)
		);
		
	}
}

/**
 * Grabs the first URL from the post content of the current post.  This is meant to be used with the link post 
 * format to easily find the link for the post. 
 *
 * @since 0.1.0
 * @return string The link if found.  Otherwise, the permalink to the post.
 *
 * @note This is a modified version of the twentyeleven_url_grabber() function in the TwentyEleven theme. And this modified version is from MyLife (themehybrid.com) theme.
 * @author wordpressdotorg
 * @copyright Copyright (c) 2011, wordpressdotorg
 * @link http://wordpress.org/extend/themes/twentyeleven
 * @license http://wordpress.org/about/license
 */
function live_wire_url_grabber() {
	if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ) )
		return get_permalink( get_the_ID() );

	return esc_url_raw( $matches[1] );
}

/**
 * This is a fix for when a user sets a custom background color with no custom background image.  What 
 * happens is the theme's background image hides the user-selected background color.  If a user selects a 
 * background image, we'll just use the WordPress custom background callback.
 *
 * @since 0.1.0
 * @deprecated since 0.1.3
 * @link http://core.trac.wordpress.org/ticket/16919
 * @note This is taken from My Life theme by Justin Tadlock
 */
function live_wire_custom_background_callback() {

	/* Get the background image. */
	$image = get_background_image();

	/* If there's an image, just call the normal WordPress callback. We won't do anything here. */
	if ( !empty( $image ) ) {
		_custom_background_cb();
		return;
	}

	/* Get the background color. */
	$color = get_background_color();

	/* If no background color, return. */
	if ( empty( $color ) )
		return;

	/* Use 'background' instead of 'background-color'. */
	$style = "background: #{$color};";

?>
<style type="text/css">body.custom-background { <?php echo trim( $style ); ?> }</style>
<?php

}

 ?>