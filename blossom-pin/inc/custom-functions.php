<?php
/**
 * Blossom Pin Custom functions and definitions
 *
 * @package Blossom_Pin
 */

if ( ! function_exists( 'blossom_pin_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function blossom_pin_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Blossom Pin, use a find and replace
	 * to change 'blossom-pin' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'blossom-pin', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
        'primary' => esc_html__( 'Primary', 'blossom-pin' ),
		'secondary' => esc_html__( 'Secondary', 'blossom-pin' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'blossom_pin_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support( 'custom-logo', array( 
        'width'       => 250,
        'height'      => 70,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ), 
    ) );
    
    /**
     * Add support for custom header.
    */
    add_theme_support( 'custom-header', apply_filters( 'blossom_pin_custom_header_args', array(
		'default-image' => '',
        'video'         => true,
		'width'         => 1903, 
		'height'        => 660,
		'header-text'   => false
	) ) );
 
    /**
     * Add Custom Images sizes.
    */    
    add_image_size( 'blossom-pin-schema', 600, 60 );
    add_image_size( 'blossom-pin-slider', 375, 450, true );
    add_image_size( 'blossom-pin-archive', 448, 560, true );
    add_image_size( 'blossom-pin-related', 374, 249, true );
    
    // Add theme support for Responsive Videos.
    add_theme_support( 'jetpack-responsive-videos' );

    // Add excerpt support for pages
    add_post_type_support( 'page', 'excerpt' );

    // Remove widget block.
    remove_theme_support( 'widgets-block-editor' );

}
endif;
add_action( 'after_setup_theme', 'blossom_pin_setup' );

if( ! function_exists( 'blossom_pin_content_width' ) ) :
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function blossom_pin_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'blossom_pin_content_width', 790 );
}
endif;
add_action( 'after_setup_theme', 'blossom_pin_content_width', 0 );

if( ! function_exists( 'blossom_pin_template_redirect_content_width' ) ) :
/**
* Adjust content_width value according to template.
*
* @return void
*/
function blossom_pin_template_redirect_content_width(){
	$sidebar = blossom_pin_sidebar();
    if( $sidebar ){	   
        $GLOBALS['content_width'] = 790;       
	}else{
        $GLOBALS['content_width'] = 1216;
	}
}
endif;
add_action( 'template_redirect', 'blossom_pin_template_redirect_content_width' );

if( ! function_exists( 'blossom_pin_scripts' ) ) :
/**
 * Enqueue scripts and styles.
 */
function blossom_pin_scripts() {
	// Use minified libraries if SCRIPT_DEBUG is false
    $build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

    if( blossom_pin_is_woocommerce_activated() )
    wp_enqueue_style( 'blossom-pin-woocommerce', get_template_directory_uri(). '/css' . $build . '/woocommerce' . $suffix . '.css', array(), BLOSSOM_PIN_THEME_VERSION );
    
    wp_enqueue_style( 'owl-carousel', get_template_directory_uri(). '/css' . $build . '/owl.carousel' . $suffix . '.css', array(), '2.2.1' );
    if ( get_theme_mod( 'ed_localgoogle_fonts', false ) && ! is_customize_preview() && ! is_admin() && get_theme_mod( 'ed_preload_local_fonts', false ) ) {
        blossom_pin_preload_local_fonts( blossom_pin_fonts_url() );
    }
    wp_enqueue_style( 'blossom-pin-google-fonts', blossom_pin_fonts_url(), array(), null );
    wp_enqueue_style( 'blossom-pin', get_stylesheet_uri(), array(), BLOSSOM_PIN_THEME_VERSION );
    
    wp_enqueue_script( 'all', get_template_directory_uri() . '/js' . $build . '/all' . $suffix . '.js', array( 'jquery' ), '6.1.1', true );
    wp_enqueue_script( 'v4-shims', get_template_directory_uri() . '/js' . $build . '/v4-shims' . $suffix . '.js', array( 'jquery' ), '6.1.1', true );
    wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js' . $build . '/owl.carousel' . $suffix . '.js', array( 'jquery' ), '2.0.1', true );
    wp_enqueue_script( 'owlcarousel2-a11ylayer', get_template_directory_uri() . '/js' . $build . '/owlcarousel2-a11ylayer' . $suffix . '.js', array( 'jquery', 'owl-carousel' ), '0.2.1', true );
    wp_enqueue_script( 'blossom-pin', get_template_directory_uri() . '/js' . $build . '/custom' . $suffix . '.js', array( 'jquery', 'masonry', 'owl-carousel' ), BLOSSOM_PIN_THEME_VERSION, true );
    wp_enqueue_script( 'blossom-pin-modal', get_template_directory_uri() . '/js' . $build . '/modal-accessibility' . $suffix . '.js', array( 'jquery' ), BLOSSOM_PIN_THEME_VERSION, true );
    
    $array = array( 
        'rtl'       => is_rtl(),
        'ajax_url'  => admin_url( 'admin-ajax.php' ),
        'single'    => is_single(),
    );
    
    wp_localize_script( 'blossom-pin', 'blossom_pin_data', $array );

    $pagination = get_theme_mod( 'pagination_type', 'default' );
    if( $pagination == 'infinite_scroll' ){
        
        // Add parameters for the JS
        global $wp_query;
        $max = $wp_query->max_num_pages;
        $paged = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;
        
        wp_enqueue_script( 'blossom-pin-ajax', get_template_directory_uri() . '/js' . $build . '/ajax' . $suffix . '.js', array('jquery'), BLOSSOM_PIN_THEME_VERSION, true );
        
        wp_localize_script( 
            'blossom-pin-ajax', 
            'blossom_pin_ajax',
            array(
                'url'        => admin_url( 'admin-ajax.php' ),
                'startPage'  => $paged,
                'maxPages'   => $max,
                'nextLink'   => next_posts( $max, false ), 
                'autoLoad'   => $pagination,               
            )
        );
    }
    
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
endif;
add_action( 'wp_enqueue_scripts', 'blossom_pin_scripts' );

if( ! function_exists( 'blossom_pin_admin_scripts' ) ) :
/**
 * Enqueue admin scripts and styles.
*/
function blossom_pin_admin_scripts( $hook_suffix ){
    wp_enqueue_style( 'blossom-pin-admin', get_template_directory_uri() . '/inc/css/admin.css', '', BLOSSOM_PIN_THEME_VERSION );

}
endif; 
add_action( 'admin_enqueue_scripts', 'blossom_pin_admin_scripts' );

if( ! function_exists( 'blossom_pin_body_classes' ) ) :
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function blossom_pin_body_classes( $classes ) {
    global $wp_query;
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }

    if ( $wp_query->found_posts == 0 ) {
		$classes[] = 'no-post';
	}
    
    // Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}
    
    // Adds a class of custom-background-color to sites with a custom background color.
    if ( get_background_color() != 'ffffff' ) {
		$classes[] = 'custom-background-color';
	}

    if( is_single() || is_page() ){
        $classes[] = 'underline';
    }
    
    $classes[] = blossom_pin_sidebar( true );
    
	return $classes;
}
endif;
add_filter( 'body_class', 'blossom_pin_body_classes' );

if( ! function_exists( 'blossom_pin_post_classes' ) ) :
/**
 * Add custom classes to the array of post classes.
*/
function blossom_pin_post_classes( $classes ){

    if( is_search() || is_archive()){
        $classes[] = 'search-post';
    }
    
    $classes[] = 'latest_post';
    
    return $classes;
}
endif;
add_filter( 'post_class', 'blossom_pin_post_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function blossom_pin_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'blossom_pin_pingback_header' );

if( ! function_exists( 'blossom_pin_change_comment_form_default_fields' ) ) :
/**
 * Change Comment form default fields i.e. author, email & url.
*/
function blossom_pin_change_comment_form_default_fields( $fields ){    
    // get the current commenter if available
    $commenter = wp_get_current_commenter();
 
    // core functionality
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );    
 
    // Change just the author field
    $fields['author'] = '<p class="comment-form-author"><label class="screen-reader-text">' . esc_html__( 'Full Name', 'blossom-pin' ) . '</label><input id="author" name="author" placeholder="' . esc_attr__( 'Name*', 'blossom-pin' ) . '" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>';
    
    $fields['email'] = '<p class="comment-form-email"><label class="screen-reader-text">' . esc_html__( 'Email', 'blossom-pin' ) . '</label><input id="email" name="email" placeholder="' . esc_attr__( 'Email*', 'blossom-pin' ) . '" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>';
    
    $fields['url'] = '<p class="comment-form-url"><label class="screen-reader-text">' . esc_html__( 'Website', 'blossom-pin' ) . '</label><input id="url" name="url" placeholder="' . esc_attr__( 'Website', 'blossom-pin' ) . '" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>'; 
    
    return $fields;    
}
endif;
add_filter( 'comment_form_default_fields', 'blossom_pin_change_comment_form_default_fields' );

if( ! function_exists( 'blossom_pin_change_comment_form_defaults' ) ) :
/**
 * Change Comment Form defaults
*/
function blossom_pin_change_comment_form_defaults( $defaults ){    
    $defaults['comment_field'] = '<p class="comment-form-comment"><label class="screen-reader-text">' . esc_html__( 'Comment', 'blossom-pin' ) . '</label><textarea id="comment" name="comment" placeholder="' . esc_attr__( 'Comment', 'blossom-pin' ) . '" cols="45" rows="8" aria-required="true"></textarea></p>';
    
    return $defaults;    
}
endif;
add_filter( 'comment_form_defaults', 'blossom_pin_change_comment_form_defaults' );

if ( ! function_exists( 'blossom_pin_excerpt_more' ) ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... * 
 */
function blossom_pin_excerpt_more( $more ) {
	return is_admin() ? $more : ' &hellip; ';
}

endif;
add_filter( 'excerpt_more', 'blossom_pin_excerpt_more' );

if ( ! function_exists( 'blossom_pin_excerpt_length' ) ) :
/**
 * Changes the default 55 character in excerpt 
*/
function blossom_pin_excerpt_length( $length ) {
	$excerpt_length = get_theme_mod( 'excerpt_length', 55 );
    return is_admin() ? $length : absint( $excerpt_length );    
}
endif;
add_filter( 'excerpt_length', 'blossom_pin_excerpt_length', 999 );

if( ! function_exists( 'blossom_pin_exclude_cat' ) ) :
/**
 * Exclude post with Category from blog and archive page. 
*/
function blossom_pin_exclude_cat( $query ){
    
    $ed_banner      = get_theme_mod( 'ed_banner_section', 'slider_banner' );
    $slider_type    = get_theme_mod( 'slider_type', 'latest_posts' );
    $slider_cat     = get_theme_mod( 'slider_cat' );
    $posts_per_page = get_theme_mod( 'no_of_slides', 7 );
    
    if( ! is_admin() && $query->is_main_query() && $query->is_home() && $ed_banner == 'slider_banner' ){
        if( $slider_type === 'cat' && $slider_cat  ){            
 			$query->set( 'category__not_in', array( $slider_cat ) );    		
        }elseif( $slider_type == 'latest_posts' ){
            $args = array(
                'post_type'           => 'post',
                'post_status'         => 'publish',
                'posts_per_page'      => $posts_per_page,
                'ignore_sticky_posts' => true
            );
            $latest = get_posts( $args );
            $excludes = array();
            foreach( $latest as $l ){
                array_push( $excludes, $l->ID );
            }
            $query->set( 'post__not_in', $excludes );
        }  
    }      
}
endif;
add_filter( 'pre_get_posts', 'blossom_pin_exclude_cat' );

if( ! function_exists( 'blossom_pin_get_the_archive_title' ) ) :
/**
 * Filter Archive Title
*/
function blossom_pin_get_the_archive_title( $title ){
    
    $ed_prefix = get_theme_mod( 'ed_prefix_archive', false );

    if( is_category() ){
        if( $ed_prefix ){
             $title = '<h1 class="pate-title">' .single_cat_title( '', false ). '</h1>';
                               
        }else{
            $title = sprintf( __( '%1$s Category %2$s %3$s', 'blossom-pin'), '<span class="label">','</span>', '<h1 class="pate-title">' .single_cat_title( '', false ). '</h1>') ;
        }     
    }elseif( is_tag() ){
        if( $ed_prefix ){
             $title = '<h1 class="pate-title">' .single_cat_title( '', false ). '</h1>';
                               
        }else{
            $title = sprintf( __( '%1$s Tag %2$s %3$s', 'blossom-pin'), '<span class="label">','</span>', '<h1 class="pate-title">' .single_cat_title( '', false ). '</h1>') ;
        }
    }elseif( is_year() ){
       if( $ed_prefix ){
             $title = '<h1 class="pate-title">' . get_the_date( _x( 'Y', 'yearly archives date format', 'blossom-pin' ) ) . '</h1>';
                               
        }else{
            $title = sprintf( __( '%1$s Year %2$s %3$s', 'blossom-pin'), '<span class="label">','</span>', '<h1 class="pate-title">' . get_the_date( _x( 'Y', 'yearly archives date format', 'blossom-pin' ) ) . '</h1>') ;
        }
    }elseif( is_month() ){
        if( $ed_prefix ){
             $title = '<h1 class="pate-title">' . get_the_date( _x( 'F Y', 'monthly archives date format', 'blossom-pin' ) ) . '</h1>';
                               
        }else{
            $title = sprintf( __( '%1$s Month %2$s %3$s', 'blossom-pin'), '<span class="label">','</span>', '<h1 class="pate-title">' . get_the_date( _x( 'F Y', 'monthly archives date format', 'blossom-pin' ) ) . '</h1>') ;
        }
    }elseif( is_day() ){
        if( $ed_prefix ){
             $title = '<h1 class="pate-title">' . get_the_date( _x( 'F j, Y', 'daily archives date format', 'blossom-pin' ) ) . '</h1>';
                               
        }else{
            $title = sprintf( __( '%1$s Day %2$s %3$s', 'blossom-pin'), '<span class="label">','</span>', '<h1 class="pate-title">' . get_the_date( _x( 'F j, Y', 'daily archives date format', 'blossom-pin' ) ) .  '</h1>') ;
        }
    }elseif( is_post_type_archive() ) {
        if( $ed_prefix ){
             $title = '<h1 class="pate-title">'  . post_type_archive_title( '', false ) . '</h1>';
                               
        }else{
            $title = sprintf( __( '%1$s Archives %2$s %3$s', 'blossom-pin'), '<span class="label">','</span>', '<h1 class="pate-title">'  . post_type_archive_title( '', false ) . '</h1>') ;
        }
    }elseif( is_tax() ) {
        $tax = get_taxonomy( get_queried_object()->taxonomy );
        if( $ed_prefix ){
             $title = '<h1 class="pate-title">' . single_term_title( '', false ) . '</h1>';
                               
        }else{
            $title = sprintf( __( '%1$s: %2$s', 'blossom-pin' ), '<span>' . $tax->labels->singular_name . '</span>', '<h1 class="pate-title">' . single_term_title( '', false ) . '</h1>' );
        }
    }else {
        $title = sprintf( __( '%1$sArchives%2$s', 'blossom-pin' ), '<h1 class="pate-title">', '</h1>' );
    }
    if( is_post_type_archive( 'product' ) ){
        $title = sprintf( '%1$s%2$s%3$s', '<h1 class="pate-title">', get_the_title( get_option( 'woocommerce_shop_page_id' ) ), '</h1>' );
    }

    return $title;
    
}
endif;
add_filter( 'get_the_archive_title', 'blossom_pin_get_the_archive_title' );

if( ! function_exists( 'blossom_pin_remove_archive_description' ) ) :
/**
 * filter the_archive_description & get_the_archive_description to show post type archive
 * @param  string $description original description
 * @return string post type description if on post type archive
 */
function blossom_pin_remove_archive_description( $description ){
    $ed_shop_archive_description = get_theme_mod( 'ed_shop_archive_description', false );
    if( is_post_type_archive( 'product' ) ) {
        if( ! $ed_shop_archive_description ){
            $description = '';
        }
    }
    return wpautop( wp_kses_post( $description ) );
}
endif;
add_filter( 'get_the_archive_description', 'blossom_pin_remove_archive_description' );


if( ! function_exists( 'blossom_pin_single_post_schema' ) ) :
/**
 * Single Post Schema
 *
 * @return string
 */
function blossom_pin_single_post_schema() {
    if ( is_singular( 'post' ) ) {
        global $post;
        $custom_logo_id = get_theme_mod( 'custom_logo' );

        $site_logo   = wp_get_attachment_image_src( $custom_logo_id , 'blossom-pin-schema' );
        $images      = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
        $excerpt     = blossom_pin_escape_text_tags( $post->post_excerpt );
        $content     = $excerpt === "" ? mb_substr( blossom_pin_escape_text_tags( $post->post_content ), 0, 110 ) : $excerpt;
        $schema_type = ! empty( $custom_logo_id ) && has_post_thumbnail( $post->ID ) ? "BlogPosting" : "Blog";

        $args = array(
            "@context"  => esc_url( "http://schema.org" ),
            "@type"     => $schema_type,
            "mainEntityOfPage" => array(
                "@type" => "WebPage",
                "@id"   => esc_url( get_permalink( $post->ID ) )
            ),
            "headline"  => esc_html( get_the_title( $post->ID ) ),
            "datePublished" => esc_html( get_the_time( DATE_ISO8601, $post->ID ) ),
            "dateModified"  => esc_html( get_post_modified_time(  DATE_ISO8601, __return_false(), $post->ID ) ),
            "author"        => array(
                "@type"     => "Person",
                "name"      => blossom_pin_escape_text_tags( get_the_author_meta( 'display_name', $post->post_author ) )
            ),
            "description" => ( class_exists('WPSEO_Meta') ? WPSEO_Meta::get_value( 'metadesc' ) : $content )
        );

        if ( has_post_thumbnail( $post->ID ) ) :
            $args['image'] = array(
                "@type"  => "ImageObject",
                "url"    => esc_url( $images[0] ),
                "width"  => $images[1],
                "height" => $images[2]
            );
        endif;

        if ( ! empty( $custom_logo_id ) ) :
            $args['publisher'] = array(
                "@type"       => "Organization",
                "name"        => esc_html( get_bloginfo( 'name' ) ),
                "description" => wp_kses_post( get_bloginfo( 'description' ) ),
                "logo"        => array(
                    "@type"   => "ImageObject",
                    "url"     => esc_url( $site_logo[0] ),
                    "width"   => $site_logo[1],
                    "height"  => $site_logo[2]
                )
            );
        endif;

        echo '<script type="application/ld+json">';
        if ( version_compare( PHP_VERSION, '5.4.0' , '>=' ) ) {
            echo wp_json_encode( $args, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );
        } else {
            echo wp_json_encode( $args );
        }
        echo '</script>';
    }
}
endif;
add_action( 'wp_head', 'blossom_pin_single_post_schema' );

if( ! function_exists( 'blossom_pin_get_comment_author_link' ) ) :
/**
 * Filter to modify comment author link
 * @link https://developer.wordpress.org/reference/functions/get_comment_author_link/
 */
function blossom_pin_get_comment_author_link( $return, $author, $comment_ID ){
    $comment = get_comment( $comment_ID );
    $url     = get_comment_author_url( $comment );
    $author  = get_comment_author( $comment );
 
    if ( empty( $url ) || 'http://' == $url )
        $return = '<span itemprop="name">'. esc_html( $author ) .'</span>';
    else
        $return = '<span itemprop="name"><a href=' . esc_url( $url ) . ' rel="external nofollow noopener" class="url" itemprop="url">' . esc_html( $author ) . '</a></span>';

    return $return;
}
endif;
add_filter( 'get_comment_author_link', 'blossom_pin_get_comment_author_link', 10, 3 );

if( ! function_exists( 'blossom_pin_search_form' ) ) :
/**
 * Search Form
*/
function blossom_pin_search_form(){ 
    $placeholder = is_search() ? '' : _x( 'What are you looking for...', 'placeholder', 'blossom-pin' );
    $form = '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '"><label class="screen-reader-text">' . esc_html__( 'Looking for Something?', 'blossom-pin' ) . '</label><label for="submit-field"><span>' . esc_html__( 'Search anything and hit enter.', 'blossom-pin' ) . '</span><input type="search" class="search-field" placeholder="' . esc_attr( $placeholder ) . '" value="' . esc_attr( get_search_query() ) . '" name="s" /></label><input type="submit" class="search-submit" value="'. esc_attr_x( 'Search', 'submit button', 'blossom-pin' ) .'" /></form>';
 
    return $form;
}
endif;
add_filter( 'get_search_form', 'blossom_pin_search_form' );

if( ! function_exists( 'blossom_pin_admin_notice' ) ) :
/**
 * Adding admin notice
 */
function blossom_pin_admin_notice() {
    global $pagenow;
    $theme_args     = wp_get_theme();
    $meta           = get_option( 'blossom-pin-update-notice' );
    $name           = $theme_args->__get( 'Name' );
    $current_screen = get_current_screen();
    $dismissnonce   = wp_create_nonce( 'blossom-pin-update-notice' );

    if ( is_admin() && 'themes.php' == $pagenow && !$meta ) {
        
        if( $current_screen->id !== 'dashboard' && $current_screen->id !== 'themes' ) {
            return;
        }

        if ( is_network_admin() ) {
            return;
        }

        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        } ?>

        <div class="welcome-message notice notice-info">
            <div class="notice-wrapper">
                <div class="notice-text">
                    <h3><?php esc_html_e( 'Congratulations!', 'blossom-pin' ); ?></h3>
                    <p><?php printf( __( '%1$s is now installed and ready to use. Click below to see theme documentation, plugins to install and other details to get started.', 'blossom-pin' ), esc_html( $name ) ) ; ?></p>
                    <p><a href="<?php echo esc_url( admin_url( 'themes.php?page=blossom-pin-dashboard' ) ); ?>" class="button button-primary" style="text-decoration: none;"><?php esc_html_e( 'Go to the getting started.', 'blossom-pin' ); ?></a></p>
                    <p class="dismiss-link"><strong><a href="?blossom-pin-update-notice=1&_wpnonce=<?php echo esc_attr( $dismissnonce ); ?>"><?php esc_html_e( 'Dismiss','blossom-pin' ); ?></a></strong></p>
                </div>
            </div>
        </div>
    <?php }
}
endif;
add_action( 'admin_notices', 'blossom_pin_admin_notice' );

if( ! function_exists( 'blossom_pin_ignore_admin_notice' ) ) :
/**
 * ignore notice
 */
function blossom_pin_ignore_admin_notice() {
    if (!current_user_can('manage_options')) {
        return;
    }

    // Bail if the nonce doesn't check out
    if ( isset( $_GET['blossom-pin-update-notice'] ) && $_GET['blossom-pin-update-notice'] = '1' && wp_verify_nonce( $_GET['_wpnonce'], 'blossom-pin-update-notice' )) {

        update_option( 'blossom-pin-update-notice', true );
    }
}
endif;
add_action( 'admin_init', 'blossom_pin_ignore_admin_notice' );

if ( ! function_exists( 'blossom_pin_get_fontawesome_ajax' ) ) :
/**
 * Return an array of all icons.
 */
function blossom_pin_get_fontawesome_ajax() {
    // Bail if the nonce doesn't check out
    if ( ! isset( $_POST['blossom_pin_customize_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['blossom_pin_customize_nonce'] ), 'blossom_pin_customize_nonce' ) ) {
        wp_die();
    }

    // Do another nonce check
    check_ajax_referer( 'blossom_pin_customize_nonce', 'blossom_pin_customize_nonce' );

    // Bail if user can't edit theme options
    if ( ! current_user_can( 'edit_theme_options' ) ) {
        wp_die();
    }

    // Get all of our fonts
    $fonts = blossom_pin_get_fontawesome_list();
    
    ob_start();
    if( $fonts ){ ?>
        <ul class="font-group">
            <?php 
                foreach( $fonts as $font ){
                    echo '<li data-font="' . esc_attr( $font ) . '"><i class="' . esc_attr( $font ) . '"></i></li>';                        
                }
            ?>
        </ul>
        <?php
    }
    echo ob_get_clean();

    // Exit
    wp_die();
}
endif;
add_action( 'wp_ajax_blossom_pin_get_fontawesome_ajax', 'blossom_pin_get_fontawesome_ajax' );