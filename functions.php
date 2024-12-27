<?php
/**
 * Includes functions and theme setup
 *
 * @since Jacqui 0.1
 */
require( get_template_directory() . '/library/theme-options.php' ); // Functions for theme options page
require_once( get_template_directory()  . '/library/class-tgm-plugin-activation.php'); // Plugin Activator
require_once( get_template_directory()  . '/library/theme-add-plugin.php'); // Plugin for this theme

/**
 * Prepare the content width
 * @since jacqui 0.5
 */
function jacqui_prepare_content_width() 
{
    $jacqui_theme_options = jacqui_theme_options();
    $array_width = array( 
        ''      => 1200, 
        'w960'  => 960, 
        'w640'  => 640, 
        'w320'  => 320, 
        'wfull' => 1200 
    );
    $array_content = array( 
        'c2'  => .17, 
        'c3'  => .25, 
        'c4'  => .34, 
        'c5'  => .42, 
        'c6'  => .5, 
        'c7'  => .58, 
        'c8'  => .66, 
        'c9'  => .75, 
        'c10' => .83, 
        'c12' => 1 
    );

    $jacqui_main_content =  
    $array_content[$jacqui_theme_options['primary']] * $array_width[$jacqui_theme_options['width']] - 40;


    // set width of external linked media players not defined
    global $content_width;
    // escape content_width
    if ( ! isset( $content_width ) ) {
	$content_width = esc_attr( $jacqui_main_content );
    }
} 
add_action( 'after_setup_theme', 'jacqui_prepare_content_width' );


add_action( 'after_setup_theme', 'jacqui_setup' );
/**
 * Initial setup for jacqui theme
 *
 * This function is attached to the 'after_setup_theme' action hook.
 *
 * @uses	load_theme_textdomain()
 * @uses	get_locale()
 * @uses	add_theme_support()
 * @uses	add_editor_style()
 * @uses	add_custom_background()
 * @uses	add_custom_image_header()
 * @uses	register_default_headers()
 *
 * @since jacqui 0.1
 */
function jacqui_setup() 
{
    load_theme_textdomain( 'jacqui', get_template_directory() . '/library/languages' );

    // Add default posts and comments RSS feed links to <head>.
    add_theme_support( 'automatic-feed-links' );

    // This theme styles the visual editor with editor-style.css to match the theme style.
    add_editor_style();

    // This functionality for WordPress 4.1 and above
    add_theme_support( 'title-tag' ); 

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(  array(
        'primary'     => __( 'Primary Menu - Header', 'jacqui' ),
        'custom-menu' => __( 'Footer Menu - Caution: limited depth ', 'jacqui' )
    ));

    // Add support for a variety of post formats
    add_theme_support( 'post-formats', array( 'gallery', 'image', 'video', 'audio', 'quote', 'link', 'status', 'aside' ) );

    // This theme uses Featured Images (also known as post thumbnails) for archive pages
    add_theme_support( 'post-thumbnails' );

    // Add a filter to jacqui_header_image_width _height to change the width and height of your custom header.
    $custom_header_support = array(
        'flex-height' => true,
        'flex-width'  => true,
        'width'  => apply_filters( 'jacqui_header_image_width', 1200 ),
        'height' => apply_filters( 'jacqui_header_image_height', 288 ),
    );
    add_theme_support( 'custom-header', $custom_header_support );

    // remove header text control from customizer and use default header in admin menu
    if( defined ('NO_HEADER_TEXT') ) define( 'NO_HEADER_TEXT', true );        // phpcs:ignore WordPress.WP.DiscouragedConstants.NO_HEADER_TEXTDeclarationFound

    // Add support for custom backgrounds
    $custom_background_support = array(
        'default-image' => get_template_directory_uri() . '/library/images/background.jpg',
        'default-color' => 'fafafa'
    );
    add_theme_support( 'custom-background', $custom_background_support );

    // Add HTML5 elements. Not required for ClassicPress v>2.
    //add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form', ) );
}

/**
 * Load all JavaScript to header
 *
 * This function is attached to the 'wp_enqueue_scripts' action hook.
 *
 * @since jacqui 0.1
 */
function jacqui_custom_enqueue_scripts() 
{
    wp_enqueue_style( 'jacqui_stylesheet', get_stylesheet_uri() );
    // enable threaded comments
    if ( is_singular() AND comments_open() AND ( get_option('thread_comments') == 1) )
        wp_enqueue_script( 'comment-reply' );
    // enque font icons 
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() .'/library/fonts/font-awesome.css'); 
    
    // enqueue scripts to control responsive DOM of templates
    wp_enqueue_script( 'harvey', get_template_directory_uri() .'/library/js/harvey.js', '', '', true );
    wp_enqueue_script( 'jacqui_js', get_template_directory_uri() .'/library/js/theme.js', '', '', true );
}
    add_action( 'wp_enqueue_scripts', 'jacqui_custom_enqueue_scripts' );

    // font imported by enqueue method
    function jacqui_add_google_fonts() {
    $protocol = is_ssl() ? 'https' : 'http';
    wp_enqueue_style( 'Font-Oxygen', "$protocol://fonts.googleapis.com/css?family=Lato:300,900|Russo+One" );
    }     
    add_action( 'wp_enqueue_scripts', 'jacqui_add_google_fonts', 5);


    /*
function jacqui_add_ie_html5_shim () 
{
      echo "<!--[if lt IE 9]>\n";
        echo '<script src="', get_template_directory_uri() .'/library/js/html5.js"></script>'."\n"; // phpcs ignore: WordPress.WP.EnqueuedResources.NonEnqueuedScript
        echo '<meta http-equiv="X-UA-Compatible" content="IE=9"/>'."\n";
        echo "<![endif]-->\n";
}
    add_action('wp_head', 'jacqui_add_ie_html5_shim'); 
    */

    /**
     * Add a style block to the theme for title, post meta and link color.
     *
     * This function is attached to the 'wp_head' action hook.
     *
     * @since Jacqui 0.1
     */
    add_action( 'wp_head', 'jacqui_styles' );
    function jacqui_styles() 
    {
    $jacqui_theme_options = jacqui_theme_options(); 
        if (isset ($jacqui_theme_options['link_color'] ) ) { 
            $link_color = esc_html( $jacqui_theme_options['link_color'] ); ?>
            <style>
            .post-meta a, .entry-content a, .widget a, .site-title a, .header-wrap a, .header-wrap a:visited, .entry-title a, .profile-content a { 
                color: <?php echo esc_attr( $link_color ); ?> !important; 
            }
            .profile-content a { 
                border-color: <?php echo esc_attr( $link_color ); ?> !important; 
            }
            </style>
            <?php } else { ?>
                <style>
                .post-meta a, .entry-content a, .widget a, #site-title a, a, #site-title a:visited, .entry-title a { 
                    color: royalblue !important; 
                }
                </style>
        <?php } ?>
    <?php
    } // end function link color

   //custom footer credits option
    function jacqui_footer_credits() 
    {
        echo '<a href="http://www.tradesouthwest.com/"> <small>Jacqui by TSW =|=</small></a>';
    }
    add_action( 'jacqui_footer_credits', 'jacqui_footer_credits' );

    /**
     * Creating the two sidebars
     *
     * This function is attached to the 'widgets_init' action hook.
     *
     * @uses register_sidebar()
     *
     * @since jacqui 0.1
     */
    add_action( 'widgets_init', 'jacqui_widgets_init' );
function jacqui_widgets_init() 
{
    register_sidebar( array(
        'name' => __( 'Main Content Sidebar', 'jacqui' ),
        'id' => 'sidebar',
        'description' => __( 'This is the sidebar widgetized area. Left or Right.', 'jacqui' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __( 'Header Area', 'jacqui' ),
        'id' => 'header-area',
        'description' => __( 'Widgetized area in the header to the right of title.', 'jacqui' ),
        'before_widget' => '<div id="%1$s" class="header-widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widget-title">',
  	'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __( 'Footer Three-Wide Area', 'jacqui' ),
        'id' => 'footer-wide-area',
        'description' => __( 'Widgetized area spans across top of footer.', 'jacqui' ),
        'before_widget' => '<div id="%1$s" class="c4 %2$s">',
        'after_widget' => '</div>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
    ) );
}

if ( !function_exists( 'jacqui_pagination' ) ) :
/**
 * Add pagination
 *
 * @uses	paginate_links()
 * @uses	add_query_arg()
 *
 * @since jacqui 0.1
 */
function jacqui_pagination() {
    global $wp_query;

    $current = max( 1, get_query_var('paged') );
    $big = 999999999; // need an unlikely integer

    $pagination_return = paginate_links( array(
        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format' => '?paged=%#%',
        'current' => $current,
        'total' => $wp_query->max_num_pages, 'next_text' => '&raquo;', 'prev_text' => '&laquo;'
	) );

	if ( ! empty( $pagination_return ) ) {
		echo '<div id="pagination">';
		echo '<div class="total-pages">';
		printf( '%1$s of %2$s', esc_attr( $current ), esc_attr( $wp_query->max_num_pages ) );
		echo '</div>';
		echo wp_kses_post( $pagination_return );
		echo '</div>';
	}
}
endif; // jacqui_pagination

add_filter( 'wp_title', 'jacqui_filter_wp_title', 10, 2 );
/**
 * Filters the page title appropriately depending on the current page
 *
 * @uses	get_bloginfo()
 * @uses	is_home()
 * @uses	is_front_page()
 *
 * @since jacqui 0.1
 */
function jacqui_filter_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'jacqui' ), max( $paged, $page ) );

	return $title;
}

/**
 * Custom function to display post/page content pagination links
 *
 * @param	array $args
 *
 * @return	Pagenum links
 *
 * @since jacqui 0.1
 */
function jacqui_link_pages( $args = '' ) {
	global $page, $numpages, $multipage, $more, $pagenow;

	$defaults = array(
        'before' => '<nav id="post-pagination"><h3 class="screen-reader-text">' . __( 'Post Pages menu', 'jacqui' ) . '</h3>',
		'after' => '</nav>'
	);

	$output = '';
	$r = wp_parse_args( $args, $defaults );
	$r = apply_filters( 'wp_link_pages_args', $r );
	extract( $r, EXTR_SKIP );                      // phpcs:ignore WordPress.PHP.DontExtract.extract_extract

	if ( $multipage ) {
	    $output .= $before;
	    for ( $i = 1; $i < ( $numpages + 1 ); $i = $i + 1 ) {
			$j = str_replace( '%', $i, '%' );

			$output .= ' ';
			$output .= ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) ) ? _wp_link_page( $i ) :'<span class="current-post-page">';
			$output .= $j;
			$output .= ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) ) ? '</a>' : '</span>';
	    }
	    $output .= $after;
	}
	return $output;
}

/*
 * Remove default gallery styles
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Create the required attributes for the #primary container
 *
 * @since jacqui 0.1
 */
function jacqui_primary_attr() {
    $jacqui_theme_options = jacqui_theme_options();
        $column           = sanitize_html_class( $jacqui_theme_options['primary'] );
        $layout           = sanitize_html_class( $jacqui_theme_options['layout'] );
            $class = ( 3 == $layout ) ? $column . ' centered' : $column;
            $style = ( 1 == $layout ) ? ' style="float: right;"' : '';
    echo 'class="' . esc_attr( $class ) . '"' . esc_attr( $style );
}

/**
 * Create the required classes for the #secondary sidebar container
 *
 * @since jacqui 0.1
 */
function jacqui_sidebar_class() {
    $jacqui_theme_options = jacqui_theme_options();
        $end = ( 2 == $jacqui_theme_options['layout'] ) ? ' end' : '';
        $class = str_replace( 'c', '', $jacqui_theme_options['primary'] );
            $class = 'c' . ( 12 - $class ) . $end;
    $output = esc_attr( force_balance_tags( $class ) );
    echo 'class="' . esc_attr( $output ) . '"';
}

add_filter( 'body_class','jacqui_custom_body_class' );
/**
 * Adds class if first sidebar located on left side
 *
 * @since jacqui 0.1
 */       
function jacqui_custom_body_class( $classes ) {
    $jacqui_theme_options = jacqui_theme_options();
        $arr = array( 1, 3, 5 );
        if ( in_array( $jacqui_theme_options['layout'], $arr ) )
            $classes[] = 'left-sidebar';
    return $classes;
}

/**
 * Retrieves the IDs for images in a gallery.
 *
 * @uses get_post_galleries() first, if available. Falls back to shortcode parsing,
 * then as last option uses a get_posts() call.
 *
 * @since jacqui 0.1
 *
 * @return array List of image IDs from the post gallery.
 */
function jacqui_get_gallery_images() {
	$images = array();

	if ( function_exists( 'get_post_galleries' ) ) {
		$galleries = get_post_galleries( get_the_ID(), false );
		if ( isset( $galleries[0]['ids'] ) )
		 	$images = explode( ',', $galleries[0]['ids'] );
	} else {
		$pattern = get_shortcode_regex();
		preg_match( "/$pattern/s", get_the_content(), $match );
		$atts = shortcode_parse_atts( $match[3] );
		if ( isset( $atts['ids'] ) )
			$images = explode( ',', $atts['ids'] );
	}

	if ( ! $images ) {
		$images = get_posts( array(
			'fields'     => 'ids',
			'numberposts' => 999,          // phpcs:ignore WordPress.WP.PostsPerPage.posts_per_page_numberposts
			'order'        => 'ASC',
			'orderby'       => 'menu_order',
			'post_mime_type' => 'image',
			'post_parent' => get_the_ID(),
			'post_type' => 'attachment',
		) );
	}

	return $images;
}
?>
