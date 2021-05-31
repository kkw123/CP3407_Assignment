<?php
function job_portal_setup() {
	load_theme_textdomain( 'job-portal',get_template_directory() . '/languages' );
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	
	register_nav_menus( array(
		'primary'    => esc_html__( 'Top Menu', 'job-portal' ),
	) );	
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	// repeat the following 11 lines for each format you want


	// Add theme support for Custom header.		
	add_theme_support( 'custom-header', apply_filters( 'job_portal_custom_header_args', array(
		 'default-image'         => get_template_directory_uri() . '/assets/images/header-img.jpeg',
		'default-text-color'     => '000000',
		'width'                  => 1250,
		'height'                 => 250,
		'flex-height'            => true,
		/*'wp-head-callback'       => 'job_portal_header_style',*/
		'header-text'			=>true,
	) ) );
	// This theme styles the visual editor to resemble the theme style.
   	add_editor_style( array( 'css/editor-style.css', job_portal_font_url() ) );
	add_theme_support( 'custom-background', apply_filters( 'job_portal_custom_background_args', array(
	'default-color' => 'f5f5f5',
	) ) );
	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
		'flex-height' => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );
}
add_action( 'after_setup_theme', 'job_portal_setup' );

// Filter for search form.
add_filter('get_search_form', 'job_portal_search_form');
function job_portal_search_form($html) {
	if(is_front_page()):
	 $html = '<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
	 <form action="'.esc_url(site_url()).'" role="search" method="get" id="searchformtop">
	 <input placeholder="'.esc_attr(get_theme_mod('search_header_placeholder','What are you looking for?')).'" name="s" id="s" type="text" required=""></form>
            </div>                        
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <button class="btn btn-primary search-button" type="button" onclick="jQuery(\'#searchformtop\').submit();">'.esc_html(get_theme_mod('search_header_search_btn_text','Search')).'</button>
        </div>';
	endif;
 return $html;
}
// action for content width set.
function job_portal_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'job_portal_content_width', 640 );
}
add_action( 'after_setup_theme', 'job_portal_content_width', 0 );

// theme font url set here
function job_portal_font_url() {
	$customizable_font_url = '';
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Lato, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'job-portal' ) ) {
		$customizable_font_url = add_query_arg( 'family', urlencode( 'Montserrat:300,400,700,900,300italic,400italic,700italic' ), "//fonts.googleapis.com/css" );
	}

	return $customizable_font_url;
}

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function job_portal_widgets_init() {
	register_sidebar( array(
		'name'          		=> esc_html__( 'Sidebar', 'job-portal' ),
		'id'            		=> 'sidebar-1',
		'romana_description'   	=> esc_html__( 'Add widgets here to appear in your sidebar.', 'job-portal' ),
		'before_widget' 		=> '<aside id="%1$s" class="widget %2$s" data-aos="fade-up">',
		'after_widget'  		=> '</aside>',
		'before_title'  		=> '<div class="sidebar-title"><h4>',
		'after_title'   		=> '</h4> </div>',
	) );
	register_sidebar( array(
		'name'          		=> __( 'Footer 1', 'job-portal' ),
		'id'            		=> 'footer-1',
		'romana_description'	=> esc_html__( 'Add widgets here to appear in your footer.', 'job-portal' ),
		'before_widget' 		=> '<div id="%1$s" class="%2$s footer-item">',
		'after_widget'  		=> '</div>',
		'before_title'  		=> '<div class="footer-item-heading"><h5>',
		'after_title'   		=> '</h5></div>',
	) );
	register_sidebar( array(
		'name'          		=> esc_html__( 'Footer 2', 'job-portal' ),
		'id'            		=> 'footer-2',
		'romana_description'   	=> esc_html__( 'Add widgets here to appear in your footer.', 'job-portal' ),
		'before_widget' 		=> '<div id="%1$s" class="%2$s footer-item">',
		'after_widget'  		=> '</div>',
		'before_title'  		=> '<div class="footer-item-heading"><h5>',
		'after_title'   		=> '</h5></div>',
	) );
	register_sidebar( array(
		'name'          		=> esc_html__( 'Footer 3', 'job-portal' ),
		'id'            		=> 'footer-3',
		'romana_description'   	=> esc_html__( 'Add widgets here to appear in your footer.', 'job-portal' ),
		'before_widget' 		=> '<div id="%1$s" class="%2$s footer-item">',
		'after_widget'  		=> '</div>',
		'before_title'  		=> '<div class="footer-item-heading"><h5>',
		'after_title'   		=> '</h5></div>',
	) );
	register_sidebar( array(
		'name'          		=> esc_html__( 'Footer 4', 'job-portal' ),
		'id'            		=> 'footer-4',
		'romana_description'   	=> esc_html__( 'Add widgets here to appear in your footer.', 'job-portal' ),
		'before_widget' 		=> '<div id="%1$s" class="%2$s footer-item">',
		'after_widget'  		=> '</div>',
		'before_title'  		=> '<div class="footer-item-heading"><h5>',
		'after_title'   		=> '</h5></div>',
	) );
}
add_action( 'widgets_init', 'job_portal_widgets_init' );

// Filter for logo layout
add_filter('get_custom_logo','job_portal_logo_class');
function job_portal_logo_class($logo_html)
{
	$logo_html = str_replace('width=', 'original-width=', $logo_html);
	$logo_html = str_replace('height=', 'original-height=', $logo_html);
	$logo_html = str_replace('class="custom-logo"', 'class="img-responsive logo-fixed"', $logo_html);	
	$logo_html = str_replace('class="custom-logo-link"', 'class="img-responsive logo-fixed"', $logo_html);
	return $logo_html;
}

// Filter with excerpt length
function job_portal_excerpt_length( $length ) {
	 if ( is_admin() ) { return $length;  }
	if(is_front_page()){ return 20; }
	return absint(get_theme_mod('blog_post_content_limit', 40));
}
add_filter( 'excerpt_length', 'job_portal_excerpt_length', 999 );
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 */
function job_portal_excerpt_more( $link ) {
	if ( is_admin() ) {		return $link;	}	
	if (!get_theme_mod( 'blog_post_readmore',false ) ) {		
		$link = sprintf( '</p><p><a href="%1$s" class="blog-read-more">%2$s</a></p>',
			esc_url( get_permalink( get_the_ID() ) ),
			/* translators: %s: Name of current post */
			esc_html__( 'Read More', 'job-portal' )
		);
	}
	return $link;
}
add_filter( 'excerpt_more', 'job_portal_excerpt_more' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function job_portal_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", esc_url(get_bloginfo( 'pingback_url' )) );
	}
}
add_action( 'wp_head', 'job_portal_pingback_header' );

add_action( 'admin_menu', 'job_portal_admin_menu');
function job_portal_admin_menu( ) {
    add_theme_page( esc_html__('Pro Feature','job-portal'), esc_html__('Job Portal Pro','job-portal'), 'manage_options', 'job-portal-pro-buynow', 'job_portal_pro_buy_now', 300 ); 
  
}
function job_portal_pro_buy_now(){ ?>  
  <div class="job_portal_pro_version">
  <a href="<?php echo esc_url('https://piperthemes.com/wordpress-themes/job-portal-pro/'); ?>" target="_blank">
    <img src ="<?php echo esc_url(get_template_directory_uri().'/assets/images/job-portal-pro-feature.png') ?>" width="70%" height="auto" />
  </a>
</div>
<?php }

include get_template_directory().'/inc/enqueues.php';
include get_template_directory().'/inc/theme-customization.php';
include get_template_directory().'/inc/theme-default-setup.php';
include get_template_directory().'/inc/class-tgm-plugin-activation.php';
