<?php function job_portal_enqueues(){

	wp_enqueue_style( 'job-portal-google-fonts-api', '//fonts.googleapis.com/css?family=Montserrat', array(), '1.0.0' );
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css', array(), null,false);
	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.css', array(), null,false);
    wp_enqueue_style('job-portal-main', get_template_directory_uri() . '/assets/css/main.css', array(), null, false);
	wp_enqueue_style('job-portal-default',get_template_directory_uri().'/assets/css/default.css', array(), null, false );
	wp_enqueue_style('job-portal-style', get_stylesheet_uri(), array());

	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.js', array('jquery'), null,false);
	if ( is_singular() ) wp_enqueue_script( "comment-reply" );
	wp_enqueue_script('job-portal-custom',get_template_directory_uri().'/assets/js/custom.js', array('jquery'), null, false);
	
	job_portal_custom_css();
}
add_action('wp_enqueue_scripts','job_portal_enqueues');